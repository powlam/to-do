<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Bag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bag>
 */
final class BagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'is_active' => Bag::active()->doesntExist(),
        ];
    }
}
