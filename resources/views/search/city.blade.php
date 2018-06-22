@extends('layouts.app')

@section('header')
@if (!isset($events))
    <header id="search-container" class="vertical-center p-4">
      @component('search.cityForm')
      @endcomponent
    </header>
@endif
@isset($events)
  <header>
    <h1 class="display-4 text-center p-4">Prochains événements de prévus à {{ $city }}</h1>
  </header>
@endisset
@endsection


@section('content')
 @isset($events)
   @if (count($events) == 0)
     <div class="alert alert-info my-4" role="alert">
       Pas d'événements de prévus
     </div>
   @else
     <button id="scroll-top" class="btn btn-primary"><i class="fas fa-chevron-up"></i></button>

     <div class="row justify-content-center pt-4">
       <div class="col-sm-4">
         <select name="date-event" id="date-event" class="custom-select custom-select-lg">
          <option selected>Choisir une date</option>
           @foreach ($events as $yearName => $yearEvents)
             @foreach ($yearEvents as $monthName => $monthEvents)
               @foreach ($monthEvents as $dayName => $value)
                 <option value="{{ $yearName.'-'.$monthName.'-'.(explode(' ',$dayName)[1]) }}">{{ ucfirst($dayName).' '.$monthName.' '.$yearName }}</option>
               @endforeach
             @endforeach
           @endforeach
         </select>
       </div>
     </div>
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
                   <div class="card day py-2" id="{{ $yearName.'-'.$monthName.'-'.(explode(' ',$dayName)[1]) }}">
                     <div class="card-header">
                         <h4 class="day-name">{{ ucfirst($dayName) }}</h4>
                     </div>
                     @foreach ($dayEvents as $event)
                       <article class="row mb-3">
                         <div class="col-sm-2 vertical-center">
                           <div class="text-right text-sm-center p-3">
                             <h5>{{ $event->time_start }}</h5>
                             <h5>{{ $event->time_end }}</h5>
                           </div>
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
   @endif
 @endisset

@endsection

@section('scripts')
@if (!isset($events))
  <script src="/js/searchCity.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps_api_key') }}&libraries=places&callback=initAutocomplete" async defer></script>
@else
  <script>
    $(function(){
      $(window).on('scroll', function() {
        if ($('body').scrollTop() > 20 || $('html').scrollTop() > 20) {
          $('#scroll-top').show();
        } else {
          $('#scroll-top').hide();
        }
      });

      $('#scroll-top').on('click', function() {
        $('html,body').animate({scrollTop: 0-100},'slow');
      });
      $('#date-event').on('change', function(){
        let dateId =$(this).val();
        $('html,body').animate({scrollTop: $('#'+dateId).offset().top-100},'slow');
      });
    });
  </script>
@endif

@endsection
