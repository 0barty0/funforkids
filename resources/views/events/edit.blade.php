@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <h2 class="card-header text-white bg-primary">Ajout d'un événement</h2>
        <div class="card-body">
          {!! Form::model($event, ['route' => ['event.update', $event->id], 'method' => 'PUT']) !!}
            <div class="form-group">
              {!! Form::text('title', null, ['class' => 'form-control' .($errors->has('title')? ' is-invalid' : ''), 'placeholder' => 'Titre']) !!}

              {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                {!! Form::label('date_start', 'Date du début') !!}
                {!! Form::date('date_start', null, ['class' => 'form-control' .($errors->has('date_start')? ' is-invalid' : '')]) !!}

                {!! $errors->first('date_start', '<div class="invalid-feedback">:message</div>') !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('date_end', 'Date de fin') !!}
                {!! Form::date('date_end', null, ['class' => 'form-control' .($errors->has('date_end')? ' is-invalid' : '')]) !!}

                {!! $errors->first('date_start', '<div class="invalid-feedback">:message</div>') !!}
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                {!! Form::label('time_start', 'Heure du début') !!}
                {!! Form::text('time_start', null, ['class' => 'form-control' .($errors->has('time_start')? ' is-invalid' : ''), 'placeholder' => 'hh:mm']) !!}

                {!! $errors->first('date_start', '<div class="invalid-feedback">:message</div>') !!}
              </div>
              <div class="col-md-6">
                {!! Form::label('time_end', 'Heure de la fin') !!}
                {!! Form::text('time_end', null, ['class' => 'form-control' .($errors->has('time_end')? ' is-invalid' : ''), 'placeholder' => 'hh:mm']) !!}

                {!! $errors->first('date_start', '<div class="invalid-feedback">:message</div>') !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::textarea('content', null, ['class' => 'form-control' .($errors->has('content')? ' is-invalid' : ''), 'placeholder' => 'Présentation']) !!}
              {!! $errors->first('content', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            {!! Form::submit('Modifier', ['class' => 'btn btn-primary float-right']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
