<?php

namespace Database\Factories;

use App\Models\Package;
use App\Models\PackageType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Package>
 */
class PackageFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'code' => 'PK' . fake()->unique()->numerify('###'),
      'package_type_code' => PackageType::factory(),
      'name' => fake()->randomElement([
        'Paket 10 Mbps',
        'Paket 20 Mbps',
        'Paket 30 Mbps',
        'Paket 50 Mbps',
      ]),
      'price' => fake()->randomElement([
        100000,
        150000,
        200000,
        250000,
        300000,
      ]),
      'description' => fake()->optional()->sentence(),
      'status' => 'active',
    ];
  }
}
