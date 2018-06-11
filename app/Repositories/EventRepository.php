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

    public function getAgenda()
    {
        $startDate = new \DateTime();
        $endDate = clone $startDate;
        $endDate->add(new \DateInterval('P3M'));
        $events = [];

        while ($startDate <= $endDate) {
            $events[$startDate->format('Y')][$startDate->format('m')][$startDate->format('d')] = $this->getByDate($startDate);

            $startDate->add(new \DateInterval('P1D')) ;
        }

        return $events;
    }

    public function getByDate($date)
    {
        return $this->event->with('user')->whereDate('events.date_start', '<=', $date)->whereDate('events.date_end', '>=', $date)->orderBy('events.time_start', 'asc')->get();
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
