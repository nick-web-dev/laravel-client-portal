<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Announcement;
use Faker\Generator as Faker;

$factory->define(Announcement::class, function (Faker $faker) {
    $start_date = $faker->dateTimeBetween('-2 months', '2 months');
    $end_date = $faker->dateTimeBetween($start_date, '3 month');
    return [
        'action_link' => '#',
        'action_text' => ucwords($faker->word),
        'media' => ['media/placeholder-ann_size.png', '', null][rand(0,2)],
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'author' => 'One World Direct',
        'status' => (rand(0,1) ? 'draft' : 'scheduled'),
        'publish_start_date' => $start_date,
        'publish_end_date' => $end_date
    ];
});
