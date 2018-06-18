@extends('layouts.app')

@section('content')
<div id="home-text" class="mb-3">
  <h1 class="display-2 text-center p-4">Fun for kids <br><small class="display-4">on occupe vos enfants</small></h1>
  <h4 class="text-center">Trouvez près de chez vous des événements pour les petits</h4>
  <div class="row justify-content-center p-4">
    <div class="col-sm-8 col-md-5">
      {!! Form::open(['route'=>'search.city', 'class'=>'form-inline']) !!}
      <div class="input-group" id="search-city">
        {!! Form::label('place', 'Votre ville', ['class' => 'sr-only']) !!}
        {!! Form::text('place', null, ['id' => 'place', 'class' => 'form-control' .($errors->has('place')? 'is-invalid':''), 'required' => 'true', 'placeholder' => 'Votre ville']) !!}
        {!! Form::hidden('place_verification') !!}
        <div class="input-group-append">
          {!! Form::submit('Chercher', ['class'=>'btn btn-primary']) !!}
        </div>
        <div class="invalid-feedback">
          {{ $errors->first('place', ':message') }}
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<div class="grid">
  <div class="grid-sizer"></div>
  <div class="gutter-sizer"></div>
  <div class="grid-item"><img src="images/home1.jpg" alt=""></div>
  <div class="grid-item"><img src="images/home7.jpg" alt=""></div>
  <div class="grid-item"><img src="images/home2.jpg" alt=""></div>
  <div class="grid-item"><img src="images/home3.jpg" alt=""></div>
  <div class="grid-item"><img src="images/home4.jpg" alt=""></div>
  <div class="grid-item"><img src="images/home8.jpg" alt=""></div>
  <div class="grid-item"><img src="images/home9.jpg" alt=""></div>
  <div class="grid-item"><img src="images/home5.jpg" alt=""></div>
  <div class="grid-item"><img src="images/home6.jpg" alt=""></div>
</div>
@endsection

@section('scripts')
  <script src="js/masonry.pkgd.min.js"></script>
  <script src="js/imagesloaded.pkgd.min.js"></script>
  <script>
  // init Masonry
var $grid = $('.grid').masonry({
itemSelector: '.grid-item',
percentPosition: true,
columnWidth: '.grid-sizer',
gutter: '.gutter-sizer'
});
// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
$grid.masonry();
});
  </script>
  <script src="/js/searchCity.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_maps_api_key') }}&libraries=places&callback=initAutocomplete" async defer></script>
@endsection
