<?php

use Faker\Generator as Faker;

$factory->define(App\Event::class, function (Faker $faker) {
    $dateStart = $faker->dateTimeBetween('now', '+3 months');
    $nbDays = '+' .$faker->biasedNumberBetween(0, 5, 'Faker\Provider\Biased::linearLow'). ' days';
    $dateEnd = $faker->dateTimeInInterval($dateStart, $nbDays);

    $h_time_start = rand(8, 23);
    $h_time_end = ($h_time_start + rand(1, (24-$h_time_start)));

    $timeStart = $h_time_start . ":" ."00".":00";
    $timeEnd = $h_time_end . ":" ."00".":00";
    return [
        'title' => $faker->sentence(rand(4, 10)),
        'content' => $faker->paragraph,
        'user_id' => rand(1, 10),
        'date_start' => $dateStart,
        'date_end' => $dateEnd,
        'time_start'=> $timeStart,
        'time_end' => $timeEnd,
        'created_at' => $faker->dateTimeBetween('-3 months', 'now')
    ];
});