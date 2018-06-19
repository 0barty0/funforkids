@extends('layouts.app')

@section('content')
  @empty ($events)
      <div id="search-container" class="vertical-center">
        @component('search.cityForm')
        @endcomponent
      </div>
  @endempty

 @isset($events)
   <section class="py-4">
     <h1 class="text-center">Prochains événements de prévus à {{ $city }}</h1>

     @foreach ($events as $yearName => $yearEvents)
       @if (collect($yearEvents)->flatten()->isNotEmpty())
         <div class="year">
           @if (!$loop->first)
           <h2>{{ $yearName }}</h2>
           @endif
         @foreach ($yearEvents as $monthName => $monthEvents)
           @if (collect($monthEvents)->flatten()->isNotEmpty())
             <div class="month">
               <h3>{{ ucfirst($monthName) }}</h3>
               @foreach ($monthEvents as $dayName => $dayEvents)
                 @if (count($dayEvents) != 0)
                   <div class="day">
                     <h4>{{ ucfirst($dayName) }}</h4>
                     @foreach ($dayEvents as $event)
                       <article class="row mb-3">
                         <div class="col-sm-2 text-right vertical-center">
                           <h5>{{ $event->time_start }}</h5>
                           <h5>{{ $event->time_end }}</h5>
                         </div>
                         <div class="col-sm-10">
                               @component('events.article', ['event' => $event])
                               @endcomponent
                         </div>
                       </article>
                     @endforeach
                   </div>
                 @endif
               @endforeach
             </div>
           @endif
         @endforeach
         </div>
       @endif
     @endforeach
   </section>
 @endisset

@endsection

@section('scripts')
@empty ($events)
  <script src="/js/searchCity.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps_api_key') }}&libraries=places&callback=initAutocomplete" async defer></script>
@endempty

@endsection
