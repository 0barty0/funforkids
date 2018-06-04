@extends('layouts.app')

@section('content')

    <section>
      <h1 class="text-center">Prochains événements de prévus</h1>
      <div class="row justify-content-center">{!! $links !!}</div>
      @foreach ($events as $event)
        <article class="row justify-content-center">
          <div class="col-md-8 mb-3">
            <div class="card">
              <div class="card-header text-white bg-primary">
                <a href="event/{{ $event->id }}" class="text-white"><h2>{{ $event->title }}</h2></a>
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
            </div>
          </div>
        </article>
      @endforeach
      <div class="row justify-content-center">{!! $links !!}</div>
    </section>

@endsection
