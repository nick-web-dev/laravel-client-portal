<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Notification;
use Faker\Generator as Faker;

$factory->define(Notification::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomNumber,
        'media' => 'media/placeholder-ann_size.png',
        'action_link' => '#',
        'action_text' => ucwords($faker->word),
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'author' => 'One World Direct',
        'publish_date' => $faker->dateTimeThisMonth
    ];
});
