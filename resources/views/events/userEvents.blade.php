@extends('layouts.app')

@section('header')
  <header>
    <h1 class="display-4 text-center p-4">Vos événements</h1>
  </header>
@endsection

@section('content')
<section class="py-4">
  @if (session('message'))
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="alert alert-success">
            {{ session('message') }}
          </div>
        </div>
      </div>
    </div>
  @endif
        @foreach ($events as $event)
        <div class="container-fluid">
          <article class="row justify-content-center">
            <div class="col-md-8 mb-3">
              @component('events.article', ['event'=>$event])
                <div class="card-footer">
                  <div class="container-fluid">
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
              @endcomponent
            </div>
          </article>
        </div>
        @endforeach
      </section>
@endsection
