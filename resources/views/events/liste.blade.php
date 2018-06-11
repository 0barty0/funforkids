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
            <h2>{{ $yearName }}</h2>
          @foreach ($yearEvents as $monthName => $monthEvents)
            @if (collect($monthEvents)->flatten()->isNotEmpty())
              <div class="month">
                <h3>{{ ucfirst($monthName) }}</h3>
                @foreach ($monthEvents as $dayName => $dayEvents)
                  @if (count($dayEvents) != 0)
                    <div class="day">
                      <h4>{{ ucfirst($dayName) }}</h4>
                      @foreach ($dayEvents as $event)
                        <article class="row">
                          <div class="col-sm-4 text-right">
                            <h5>{{ substr($event->time_start, 0, 5) }}</h5>
                            <h5>{{ substr($event->time_end, 0, 5) }}</h5>
                          </div>
                          <div class="col-sm-7 bg-primary text-white mb-1">
                                <a href="event/{{ $event->id }}" class="text-white"><h2>{{ $event->title }}</h2></a>
                                @if ($event->date_start == $event->date_end)
                                  <p>le {{ $event->date_start->format('d/m/Y') }}</p>
                                @else
                                  <p>du {{ $event->date_start->format('d/m/Y') }} au {{ $event->date_end->format('d/m/Y') }}</p>
                                @endif
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
