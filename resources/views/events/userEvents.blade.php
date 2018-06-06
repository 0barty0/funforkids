@extends('layouts.app')

@section('content')
  @if (session('message'))
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="alert alert-success">
          {{ session('message') }}
        </div>
      </div>
    </div>
  @endif
  
      <section>
        <h1 class="text-center">Vos événements</h1>
        @foreach ($events as $event)
          <article class="row justify-content-center">
            <div class="col-md-8 mb-3">
              <div class="card">
                <div class="card-header text-white bg-primary">
                  <a href="/event/{{ $event->id }}" class="text-white"><h2>{{ $event->title }}</h2></a>
                  <p>du {{ $event->date_start->format('d/m/Y') }} au {{ $event->date_end->format('d/m/Y') }}</p>
                </div>
                <div class="card-body">
                  {{ $event->content }}
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-md-6">
                      <a href="/event/{{ $event->id }}/edit" class="btn btn-warning">Modifier</a>
                      <button class="btn btn-danger" onclick="if (confirm('Voulez-vous vraiment supprimer cet événement ?')) {document.getElementById('delete-form').submit();}">Supprimer</button>
                      {!! Form::open(['route' => ['event.destroy', $event->id], 'method' => 'DELETE', 'id' => 'delete-form']) !!}
                      {!! Form::close() !!}
                    </div>
                    <p class="col-md-6 text-right">
                      Par {{ $event->user->name }} le {{ $event->created_at->format('d/m/Y') }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </article>
        @endforeach
      </section>
@endsection
