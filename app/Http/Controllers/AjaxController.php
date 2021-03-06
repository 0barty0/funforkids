<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function searchDate(Request $request)
    {
        $date = $request->input('date');
        $events = Event::where('date_start', '<=', $date)->where('date_end', '>=', $date)->orderBy('time_start')->get();
        return response()->json(['events'=> $events], 200);
    }

    public function checkTitle(Request $request)
    {
        $title = $request->input('title');
        $event = Event::where('title', $title)->count();
        return response()->json($event, 200);
    }
}
