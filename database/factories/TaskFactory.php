<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Bag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
final class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bag_id' => Bag::factory(),
            'text' => $this->faker->paragraph(),
            'done_at' => $this->faker->dateTime,
        ];
    }
}
