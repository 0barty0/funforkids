<article class="card">
  <div class="card-header text-white bg-primary">
    <div class="row">
      <div class="col-md-8">
        <a href="/event/{{ $event->id }}" class="text-white"><h2>{{ $event->title }}</h2></a>
        @if ($event->date_start == $event->date_end)
          <p>le {{ $event->date_start->format('d/m/Y') }}</p>
        @else
          <p>du {{ $event->date_start->format('d/m/Y') }} au {{ $event->date_end->format('d/m/Y') }}</p>
        @endif
      </div>
      <div class="col-md-4">
        <img class="card-img-top" src="{{ $event->getImage() }}" alt="">
      </div>
    </div>
  </div>
  {{ $slot }}
</article>
