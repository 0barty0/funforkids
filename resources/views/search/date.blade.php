@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-sm-4">
      <input type="date" name="date" id="date">
      <button id="search" class="btn btn-primary" onclick="searchDate()">Voir les événements</button>
    </div>
  </div>
  <div id="results"></div>
@endsection

@section('scripts')
  <script src="/js/jquery.loadTemplate-1.4.4.min.js"></script>
  <script src="/js/search.js"></script>
@endsection
