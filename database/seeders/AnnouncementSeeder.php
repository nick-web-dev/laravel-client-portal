<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\SubscriptionLevel;
use Faker\Generator;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{

    public function run(Generator $faker)
    {
        $levels = SubscriptionLevel::pluck('id');
        Announcement::factory()->count(75)->create()
            ->each(fn($ann) => $ann->subscriptionLevels()->attach($faker->randomElements($levels)));
    }
}
