@extends('layouts.app')

@section('content')
  <section class="row justify-content-center">
    <div class="col-md-8">
      <article class="card">
        <div class="card-header">
          <h1>{{ $event->title }}</h1>
          <p>du {{ $event->date_start->format('d/m/Y') }} au {{ $event->date_end->format('d/m/Y') }}</p>
        </div>
        <div class="card-body">
          {{ $event->content }}
        </div>
        <div class="card-footer">
          <p class="text-right">
            Par {{ $event->user->name }} le {{ $event->created_at->format('d/m/Y') }}
          </p>
        </div>
      </article>
      <a href="javascript:history.back()" class="btn btn-primary">Retour</a>
    </div>
  </section>
@endsection
