<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' =>  $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'date_time' => $this->faker->dateTime(),
            'address' => $this->faker->address(),
        ];
    }
}
