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
    <section class="container">
      <h1 class="text-center">Prochains événements de prévus</h1>

      @foreach ($events as $yearName => $yearEvents)
        @if (collect($yearEvents)->flatten()->isNotEmpty())
          <div class="year">
            @if (!$loop->first)
            <h2>{{ $yearName }}</h2>
            @endif
          @foreach ($yearEvents as $monthName => $monthEvents)
            @if (collect($monthEvents)->flatten()->isNotEmpty())
              <div class="month">
                <h3>{{ ucfirst($monthName) }}</h3>
                @foreach ($monthEvents as $dayName => $dayEvents)
                  @if (count($dayEvents) != 0)
                    <div class="day">
                      <h4>{{ ucfirst($dayName) }}</h4>
                      @foreach ($dayEvents as $event)
                        <article class="row mb-3">
                          <div class="col-sm-2 text-right">
                            <h5>{{ substr($event->time_start, 0, 5) }}</h5>
                            <h5>{{ substr($event->time_end, 0, 5) }}</h5>
                          </div>
                          <div class="col-sm-10">
                                @component('events.article', ['event' => $event])
                                @endcomponent
                          </div>
                        </article>
                      @endforeach
                    </div>
                  @endif
                @endforeach
              </div>
            @endif
          @endforeach
          </div>
        @endif
      @endforeach
    </section>

@endsection
