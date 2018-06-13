@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <h2 class="card-header text-white bg-primary">Ajout d'un événement</h2>
        <div class="card-body">
          {!! Form::open(['route' => 'event.store', 'files' => 'true']) !!}
            <div class="form-group">
              {!! Form::label('title', 'Titre') !!}
              {!! Form::text('title', null, ['class' => 'form-control' .($errors->has('title')? ' is-invalid' : ''), 'required' => 'true']) !!}

              {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('date_start', 'Date du début') !!}
                  {!! Form::date('date_start', Carbon\Carbon::now(), ['class' => 'form-control' .($errors->has('date_start')? ' is-invalid' : ''), 'required' => 'true']) !!}

                  {!! $errors->first('date_start', '<div class="invalid-feedback">:message</div>') !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('date_end', 'Date de fin') !!}
                  {!! Form::date('date_end', Carbon\Carbon::now(), ['class' => 'form-control' .($errors->has('date_end')? ' is-invalid' : ''), 'required' => 'true']) !!}

                  {!! $errors->first('date_start', '<div class="invalid-feedback">:message</div>') !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('time_start', 'Heure du début') !!}
                  {!! Form::time('time_start', null, ['class' => 'form-control' .($errors->has('time_start')? ' is-invalid' : ''), 'placeholder' => 'hh:mm', 'required' => 'true']) !!}

                  {!! $errors->first('date_start', '<div class="invalid-feedback">:message</div>') !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  {!! Form::label('time_end', 'Heure de la fin') !!}
                  {!! Form::time('time_end', null, ['class' => 'form-control' .($errors->has('time_end')? ' is-invalid' : ''), 'placeholder' => 'hh:mm', 'required' => 'true']) !!}

                  {!! $errors->first('date_start', '<div class="invalid-feedback">:message</div>') !!}
                </div>
              </div>
            </div>
            <div class="form-group">
              {{ Form::label('place', 'Lieu')}}
              {{ Form::text('place', null, ['class' => 'form-control' .($errors->has('place')? 'is-invalid' : ''), 'required' => 'true'])}}
              {{ Form::hidden('place_id') }}
              {{ Form::hidden('place_verification') }}

              {!! $errors->first('place', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
              {!! Form::textarea('content', null, ['class' => 'form-control' .($errors->has('content')? ' is-invalid' : ''), 'placeholder' => 'Présentation', 'required' => 'true']) !!}
              {!! $errors->first('content', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
              <div class="custom-file">
                {!! Form::file('image', ['class' => 'custom-file-input', 'id' => 'file-input']) !!}
                {!! Form::label('image', 'Choisir une image pour illustrer', ['class' => 'custom-file-label']) !!}
              </div>
            </div>
            {!! Form::submit('Publier', ['class' => 'btn btn-primary float-right']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="/js/form.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjExSHAuBYPmeKLtZAoVtnPRt43yA6bpw&libraries=places&callback=initAutocomplete" async defer></script>
@endsection
