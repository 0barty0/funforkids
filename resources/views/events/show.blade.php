@extends('layouts.app')

@section('content')
  <section class="row justify-content-center">
    <div class="col-md-8">
      @component('events.article', ['event'=>$event])
        <div class="card-body">
          {{ $event->content }}

          <div class="row mt-4">
                <div id="map"></div>
          </div>
        </div>
        <div class="card-footer">
          <p class="text-right">
            Par {{ $event->user->name }} le {{ $event->created_at->format('d/m/Y') }}
          </p>
        </div>
      @endcomponent
      <a href="javascript:history.back()" class="btn btn-primary">Retour</a>
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
            map.setZoom(13);
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
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqStiRO-JbZtB1XKxtn1z32f07vRdhTLY&callback=initMap">
    </script>

@endsection
