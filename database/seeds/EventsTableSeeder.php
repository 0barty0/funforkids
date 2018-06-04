<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventsTableSeeder extends Seeder
{
    private function randDate()
    {
        return Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
    }

    private function randEventTimes()
    {
        $h_time_start = rand(8, 23);
        $h_time_end = ($h_time_start + rand(1, (24-$h_time_start)));

        $time_start = $h_time_start . ":" ."00".":00";
        $time_end = $h_time_end . ":" ."00".":00";

        return ['time_start' => $time_start, 'time_end' => $time_end];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->delete();

        for ($i=1; $i<=20; $i++) {
            $date = $this->randDate();
            $date_start = $date->addDays(rand(1, 90));
            $date_end = $date_start->addDays(rand(0, 3));
            $eventTimes = $this->randEventTimes();

            DB::table('events')->insert([
            'title' => 'Titre' .$i,
            'content' => 'Contenu ' .$i. ' Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo error voluptates autem corporis maiores illum numquam dolore aliquid, perferendis eum quaerat. Illo nihil quaerat hic culpa quos assumenda molestias dolore.',
            'user_id' => rand(1, 10),
            'created_at' => $date,
            'updated_at' => $date,
            'date_start' => $date_start->format('Y:m:d'),
            'date_end' => $date_end->format('Y:m:d'),
            'time_start' => $eventTimes['time_start'],
            'time_end' => $eventTimes['time_end']
          ]);
        }
    }
}
