<?php

namespace App\Repositories;

use App\Event;
use Jenssegers\Date\Date;

class EventRepository
{
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function getPaginate($nb)
    {
        return $this->event->with('user', 'tags')->whereDate('events.date_start', '>=', date('Y-m-d'))->orderBy('events.date_start', 'asc')->paginate($nb);
    }

    public function getAgenda()
    {
        $startDate = new Date();
        $endDate = clone $startDate;
        $endDate->add(new \DateInterval('P6M'));
        $events = [];

        while ($startDate <= $endDate) {
            $events[$startDate->format('Y')][$startDate->format('F')][$startDate->format('l d')] = $this->getByDate($startDate->format('Y-m-d'));

            $startDate->add(new \DateInterval('P1D')) ;
        }

        return $events;
    }

    public function getByTag($tag)
    {
        $startDate = new Date();
        $endDate = clone $startDate;
        $endDate->add(new \DateInterval('P6M'));
        $events = [];

        while ($startDate <= $endDate) {
            $result=$this->getByDateAndTag($startDate->format('Y-m-d'), $tag);
            if (count($result)!= 0) {
                $events[$startDate->format('Y')][$startDate->format('F')][$startDate->format('l d')] = $result;
            }

            $startDate->add(new \DateInterval('P1D')) ;
        }

        return $events;
    }

    public function getByCity($city)
    {
        $startDate = new Date();
        $endDate = clone $startDate;
        $endDate->add(new \DateInterval('P6M'));
        $events = [];


        while ($startDate <= $endDate) {
            $result=$this->getByDateAndCity($startDate->format('Y-m-d'), $city);
            if (count($result)!= 0) {
                $events[$startDate->format('Y')][$startDate->format('F')][$startDate->format('l d')] = $result;
            }

            $startDate->add(new \DateInterval('P1D')) ;
        }

        return $events;
    }

    public function getByDate($date)
    {
        return $this->event->with('user', 'tags')->where('events.date_start', '<=', $date)->where('events.date_end', '>=', $date)->orderBy('events.time_start', 'asc')->get();
    }

    public function getByDateAndCity($date, $city)
    {
        return $this->event->with('user', 'tags')->whereRaw('locate("'.$city.'",place)')->where('events.date_start', '<=', $date)->where('events.date_end', '>=', $date)->orderBy('events.time_start', 'asc')->get();
    }

    public function getByDateAndTag($date, $tag)
    {
        $query = $this->event->with('user', 'tags')->where('events.date_start', '<=', $date)->where('events.date_end', '>=', $date)->orderBy('events.time_start', 'asc');

        $events = $query->whereHas('tags', function ($q) use ($tag) {
            $q->where('tags.tag_url', $tag);
        })->get();

        return $events;
    }

    public function store($inputs)
    {
        return $this->event->create($inputs);
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
        $event = $this->event->findOrFail($id);
        $event->tags()->detach();
        $event->delete();
    }
}
