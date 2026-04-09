<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\Household;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with synthetic demo data only (safe for a public repo).
     */
    public function run(): void
    {
        $count = (int) env('DEMO_HOUSEHOLD_COUNT', 75);
        $count = max(1, min($count, 150));

        for ($i = 0; $i < $count; $i++) {
            $household = Household::factory()->create();
            Guest::factory()
                ->count(fake()->numberBetween(1, 5))
                ->create(['household_id' => $household->id]);
        }
    }
}
