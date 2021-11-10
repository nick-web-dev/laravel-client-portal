<?php

use Illuminate\Database\Seeder;
use App\Models\Announcement;
use App\Models\SubscriptionLevel;

class AnnouncementSeeder extends Seeder {
    public function run() {
		Announcement::factory()->count(75)->create()
		->each(function ($ann) {
			$subs = [];

			for ($i=rand(0, SubscriptionLevel::count()); $i > 0; $i--) {
				$subs[] = rand(1, SubscriptionLevel::count());
			}

			$subs = array_unique($subs);
			$ann->subscriptionLevels()->sync($subs);
		});
    }
}
