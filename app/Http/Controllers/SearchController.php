<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SearchCityRequest;
use App\Repositories\EventRepository;
use App\Event;

class SearchController extends Controller
{
    protected $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->middleware('validCity', ['only' => 'showCity']);
        $this->eventRepository = $eventRepository;
    }

    public function showSearchDate()
    {
        return view('search.date');
    }

    public function showSearchCity()
    {
        if (Auth::check()) {
            $city = Auth::user()->city;
            return redirect('search/city/'.$city);
        }
        return view('search.city');
    }

    public function searchCity(SearchCityRequest $request)
    {
        $city = $request->input('place');

        $city = explode(', ', $city)[0];

        return redirect('search/city/'.$city);
    }

    public function showCity($city)
    {
        $events = $this->eventRepository->getByCity($city);

        return view('search.city', compact('events', 'city'));
    }

    public function searchTag($tag)
    {
        $events = $this->eventRepository->getByTag($tag);

        return view('search.tag', compact('events', 'tag'));
    }
}
