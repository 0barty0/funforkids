<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TagsTableSeeder extends Seeder
{
    private function randDate()
    {
        return Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->delete();

        for ($i=1; $i < 21; $i++) {
            $date = $this->randDate();

            DB::table('tags')->insert([
            'tag' => 'tag'.$i,
            'tag_url' => 'tag'.$i,
            'created_at' => $date,
            'updated_at' => $date
          ]);
        }
    }
}
