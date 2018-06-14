<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SearchCityRequest;
use App\Repositories\EventRepository;
use App\Event;

class SearchController extends Controller
{
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function showSearchDate()
    {
        return view('search.date');
    }

    public function showSearchCity()
    {
        return view('search.city');
    }

    public function searchCity(SearchCityRequest $request)
    {
        $city = $request->input('place');

        $city = explode(', ', $city)[0];

        $events = $this->eventRepository->getByCity($city);

        return view('search.city', compact('events', 'city'));
    }
}
