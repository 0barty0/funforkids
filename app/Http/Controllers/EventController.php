<?php

namespace App\Http\Controllers;

use App\Repositories\EventRepository;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    protected $eventRepository;

    protected $nbrPerPage = 6;

    public function __construct(EventRepository $eventRepository)
    {
        $this->middleware('auth', ['except' => 'index']);
        $this->eventRepository = $eventRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = $this->eventRepository->getPaginate($this->nbrPerPage);
        $links = $events->render();

        return view('events.liste', compact('events', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventCreateRequest $request)
    {
        $inputs = array_merge($request->all(), ['user_id' => $request->user()->id]);

        $this->eventRepository->store($inputs);

        return redirect('event.index')->withMessage('L\'événement "' .$inputs['title']. '" a été créé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = $this->eventRepository->getById($id);

        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = $this->eventRepository->getById($id);

        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventUpdateRequest $request, $id)
    {
        $this->eventRepository->update($id, $request->all());

        return redirect('view.index')->withMessage('L\'événement "' .$request->input('title'). '" a été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->eventRepository->destroy($id);

        return redirect()->back();
    }
}
