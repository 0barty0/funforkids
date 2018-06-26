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
  <script src="/js/moment.min.js"></script>
  <script src="/js/fr.js"></script>
  <script src="/js/pikaday.js"></script>
  <script>
      function eventDate(date) {
        let dateString = moment(date).format('YYYY.MMMM.dddd DD');
        let dateArray = {!! json_encode($datesEvents) !!};
        return !dateArray.includes(dateString);
      }

    $(function(){
      $(window).on('scroll', function() {
        if ($('body').scrollTop() > 20 || $('html').scrollTop() > 20) {
          $('#scroll-top').show();
        } else {
          $('#scroll-top').hide();
        }
      });

      $('#scroll-top').on('click', function() {
        $('#date-event').val('');
        $('html,body').animate({scrollTop: 0-100},'slow');
      });

      moment.locale('fr');
      var picker = new Pikaday({
        field: document.getElementById('date-event'),
        format: 'dddd DD MMMM YYYY',
        minDate: moment().toDate(),
        disableDayFn: eventDate
        });

      $('#date-event-container').on('click', function() {
        picker.show();
      });

      $('#date-event').on('change', function(){
        let dateId =picker.toString('YYYY-MMMM-DD');
        $('html,body').animate({scrollTop: $('#'+dateId).offset().top-100},'slow');
      });
    });
  </script>
@endif
@endsection
