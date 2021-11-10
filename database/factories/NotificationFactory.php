<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->randomNumber,
            'media' => 'media/placeholder-ann_size.png',
            'action_link' => '#',
            'action_text' => ucwords($this->faker->word),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'author' => 'One World Direct',
            'publish_date' => $this->faker->dateTimeThisMonth
        ];
    }
}
