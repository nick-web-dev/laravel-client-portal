<?php

namespace Database\Seeders;

use App\Models\SubscriptionLevel;
use App\Services\Rushmore;
use Illuminate\Database\Seeder;

class SubscriptionLevelsSeeder extends Seeder
{
    public function run()
    {
        foreach (Rushmore::$subscriptions as $sub_level) {
            SubscriptionLevel::create(['name' => $sub_level]);
        }
    }
}
