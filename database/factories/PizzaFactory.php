<?php

namespace Database\Factories;

use App\Models\Enums\PizzaStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pizza>
 */
class PizzaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(PizzaStatus::cases()),
        ];
    }

    public function prepping(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'status' => PizzaStatus::Prepping,
        ]);
    }
}
