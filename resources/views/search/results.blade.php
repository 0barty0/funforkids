<button id="scroll-top" class="btn btn-primary" title="Revenir en haut"><i class="fas fa-chevron-up"></i></button>

<div class="container-fluid">
  <div class="row justify-content-center pt-4">
      <div id="date-event-container" class="input-group">
        <label for="date-event" hidden="true">Choisir une date</label>
        <input type="text" name="date-event" id="date-event" class="form-control" placeholder="Choisir une date">
        <div class="input-group-append">
          <span class="input-group-text bg-danger text-white"><i class="fas fa-2x fa-caret-down"></i></span>
        </div>
      </div>
  </div>
</div>
@foreach ($events as $yearName => $yearEvents)
  @if (collect($yearEvents)->flatten()->isNotEmpty())
    <div class="year py-4">
      @if (!$loop->first)
      <h2 class="year-name text-center">{{ $yearName }}</h2>
      @endif
    @foreach ($yearEvents as $monthName => $monthEvents)
      @if (collect($monthEvents)->flatten()->isNotEmpty())
        <div class="month pb-3">
              <h3 class="month-name text-center display-4">{{ ucfirst($monthName) }}</h3>
          @foreach ($monthEvents as $dayName => $dayEvents)
            @if (count($dayEvents) != 0)
              <div class="card day py-2" id="{{ $yearName.'-'.$monthName.'-'.(explode(' ',$dayName)[1]) }}">
                <div class="card-header">
                    <h4 class="day-name">{{ ucfirst($dayName) }}</h4>
                </div>
                @foreach ($dayEvents as $event)
                  <div class="container-fluid">
                    <article class="row mb-3">
                      <div class="col-sm-2 vertical-center">
                        <div class="text-right text-sm-center p-3">
                          <h5>{{ $event->time_start }}</h5>
                          <h5>{{ $event->time_end }}</h5>
                        </div>
                      </div>
                      <div class="col-sm-10">
                            @component('events.article', ['event' => $event])
                            @endcomponent
                      </div>
                    </article>
                  </div>
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
