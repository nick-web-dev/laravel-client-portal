<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

    public function definition(): array
    {
        $start_date = $this->faker->dateTimeBetween('-2 months', '2 months');
        $end_date = $this->faker->dateTimeBetween($start_date, '3 month');
        return [
            'action_link' => '#',
            'action_text' => ucwords($this->faker->word),
            'media' => $this->faker->randomElement(['media/placeholder-ann_size.png', '', null]),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'author' => 'One World Direct',
            'status' => $this->faker->randomElement(['draft', 'scheduled']),
            'publish_start_date' => $start_date,
            'publish_end_date' => $end_date
        ];
    }
}
