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
    <h2 class="display-4 text-center p-4">Recherche par mot-clé : {{ $tag }}</h2>
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
      @component('search.results', ['events' => $events])
      @endcomponent
    @endif
  @endisset
@endsection

@section('scripts')
@if (!isset($events))
  <script>
        $(function(){
          $('body').addClass('background');
        });
  </script>
  <script src="/js/searchCity.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps_api_key') }}&libraries=places&callback=initAutocomplete" async defer></script>
@else
  <script src="/js/pikaday/moment.min.js"></script>
  <script src="/js/pikaday/fr.js"></script>
  <script src="/js/pikaday/pikaday.js"></script>
  <script>
  var dateArray = {!! json_encode($datesEvents) !!};
  function eventDate(date) {
    let dateString = moment(date).format('YYYY.MMMM.dddd DD');
    return !dateArray.includes(dateString);
  }
  </script>
  <script src="/js/results.js"></script>
@endif
@endsection
