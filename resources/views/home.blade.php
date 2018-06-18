@extends('layouts.app')

@section('content')
<div class="grid">
  <div class="grid-sizer"></div>
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
columnWidth: '.grid-sizer'
});
// layout Masonry after each image loads
$grid.imagesLoaded().progress( function() {
$grid.masonry();
});
  </script>
@endsection
