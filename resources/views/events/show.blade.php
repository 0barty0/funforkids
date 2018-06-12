@extends('layouts.app')

@section('content')
  <section class="row justify-content-center">
    <div class="col-md-8">
      @component('events.article', ['event'=>$event])
        <div class="card-body">
          {{ $event->content }}
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
