@extends('layouts.app')

@section('content')
  <section class="row justify-content-center py-4">
    <div class="col-md-8">
      @component('events.article', ['event'=>$event])
        <div class="card-body">
          <p>{{ $event->content }}</p>

          <div class="row mt-4">
                <div id="map"></div>
          </div>
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-6">
              <a href="javascript:history.back()" class="btn btn-primary">Retour</a>
            </div>
            <p class="text-right col-6">
              <i class="fas fa-pencil-alt"></i> Par {{ $event->user->name }} le {{ $event->created_at->format('d/m/Y') }}
            </p>
          </div>
        </div>
      @endcomponent

    </div>
  </section>
@endsection

@section('scripts')
  <script>
    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'));
      var geocoder = new google.maps.Geocoder;
      var placeId = "{{ $event->place_id }}";
      geocoder.geocode({'placeId' : placeId}, function(results, status) {
        if (status === 'OK') {
          if (results[0]) {
            map.setZoom(14);
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
            });
          } else {
            window.alert('No results found');
          }
        } else {
          window.alert('Geocoder failed due to: ' + status);
        }
      });
    }
  </script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps_api_key') }}&callback=initMap">
    </script>

@endsection
