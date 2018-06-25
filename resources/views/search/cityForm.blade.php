<div class="container-fluid">
  <div class="row justify-content-center py-4">
    <div class="col-sm-8 col-md-4">
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
