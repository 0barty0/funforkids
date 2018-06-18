<?php

use Illuminate\Database\Seeder;

class EventTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 30; $i++) {
            $numbers = range(1, 20);
            shuffle($numbers);
            $n = rand(3, 6);

            for ($j = 1; $j < $n; $j++) {
                DB::table('event_tag')->insert([
              'event_id' => $i,
              'tag_id' => $numbers[$j]
            ]);
            }
        }
    }
}
