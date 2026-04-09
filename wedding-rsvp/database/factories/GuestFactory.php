<?php

namespace Database\Factories;

use App\Models\Guest;
use App\Models\Household;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Guest>
 */
class GuestFactory extends Factory
{
    protected $model = Guest::class;

    public function definition(): array
    {
        return [
            'household_id' => Household::factory(),
            'name' => fake()->name(),
        ];
    }
}
