<?php

namespace Database\Factories;

use App\Models\PackageType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PackageType>
 */
class PackageTypeFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'code' => 'PT' . fake()->unique()->numerify('###'),
      'name' => fake()->randomElement([
        'Internet',
        'Hotspot',
        'CCTV',
        'Network',
      ]),
      'description' => fake()->optional()->sentence(),
    ];
  }
}
