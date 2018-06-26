<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SearchCityRequest;
use App\Repositories\EventRepository;
use App\Event;
use Jenssegers\Date\Date;

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
            $city = urlencode(Auth::user()->city);
            return redirect('search/city/'.$city);
        }
        return view('search.city');
    }

    public function searchCity(SearchCityRequest $request)
    {
        $city = $request->input('place');

        $city = urlencode(explode(', ', $city)[0]);

        return redirect('search/city/'.$city);
    }

    public function showCity($city)
    {
        $city = urldecode($city);
        $events = $this->eventRepository->getByCity($city);
        $datesEvents = array_keys(array_dot($events));//Retrieve only the dates

        return view('search.city', compact('events', 'city', 'datesEvents'));
    }

    public function searchTag($tag)
    {
        $events = $this->eventRepository->getByTag($tag);
        $datesEvents = array_keys(array_dot($events));

        return view('search.tag', compact('events', 'tag', 'datesEvents'));
    }
}
