@extends('layouts.app')

@section('header')
@empty ($events)
    <header id="search-container" class="vertical-center">
      @component('search.cityForm')
      @endcomponent
    </header>
@endempty
@isset($events)
  <header>
    <h1 class="display-4 text-center p-4">Prochains événements de prévus à {{ $city }}</h1>
  </header>
@endisset
@endsection


@section('content')
 @isset($events)
     @foreach ($events as $yearName => $yearEvents)
       @if (collect($yearEvents)->flatten()->isNotEmpty())
         <div class="year py-4">
           @if (!$loop->first)
           <h2 class="year-name text-center">{{ $yearName }}</h2>
           @endif
         @foreach ($yearEvents as $monthName => $monthEvents)
           @if (collect($monthEvents)->flatten()->isNotEmpty())
             <div class="month pb-3">
                   <h3 class="month-name text-center display-4">{{ ucfirst($monthName) }}</h3>
               @foreach ($monthEvents as $dayName => $dayEvents)
                 @if (count($dayEvents) != 0)
                   <div class="card day py-2">
                     <div class="card-header">
                         <h4 class="day-name">{{ ucfirst($dayName) }}</h4>
                     </div>
                     @foreach ($dayEvents as $event)
                       <article class="row mb-3">
                         <div class="col-sm-2 text-sm-right vertical-center">
                           <h5 class="p-2">{{ $event->time_start }}</h5>
                           <h5 class="p-2">{{ $event->time_end }}</h5>
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
 @endisset

@endsection

@section('scripts')
@empty ($events)
  <script src="/js/searchCity.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps_api_key') }}&libraries=places&callback=initAutocomplete" async defer></script>
@endempty

@endsection
