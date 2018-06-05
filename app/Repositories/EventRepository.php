<?php

namespace App\Repositories;

use App\Event;

class EventRepository
{
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function getPaginate($nb)
    {
        return $this->event->with('user')->whereDate('events.date_start', '>=', date('Y-m-d'))->orderBy('events.date_start', 'asc')->paginate($nb);
    }

    public function store($inputs)
    {
        $this->event->create($inputs);
    }

    public function getById($id)
    {
        return $this->event->findOrFail($id);
    }

    public function getByUserId($id)
    {
        return $this->event->where('user_id', '=', $id)->orderBy('date_start')->get();
    }

    public function update($id, $inputs)
    {
        $this->event->findOrFail($id)->update($inputs);
    }

    public function destroy($id)
    {
        $this->event->findOrFail($id)->delete();
    }
}
