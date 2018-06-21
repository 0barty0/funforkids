<article class="event card">
  <div class="card-header text-white bg-secondary">
    <div class="row">
      <div class="col-sm-8 d-flex flex-column justify-content-between">
        <a href="/event/{{ $event->id }}" class="text-white"><h2>{{ $event->title }}</h2></a>
            <p>
            @if ($event->date_start == $event->date_end)
              le {{ $event->date_start->format('d/m/Y') }}
            @else
              du {{ $event->date_start->format('d/m/Y') }} au {{ $event->date_end->format('d/m/Y') }}
            @endif
             de {{ $event->time_start }} à {{ $event->time_end }}
            </p>
            <p>Lieu : {{ $event->place }}</p>

            <div class="tag-container pb-3 d-flex flex-wrap justify-content-start">
              @foreach ($event->tags as $tag)
                  {!! link_to('search/tag/' .$tag->tag_url, $tag->tag, ['class' => 'btn btn-danger btn-sm']) !!}
              @endforeach
            </div>
      </div>
      <div class="col-sm-4">
        <img class="card-img-top" src="{{ $event->getImage() }}" alt="">
      </div>
    </div>
  </div>
  {{ $slot }}
</article>
