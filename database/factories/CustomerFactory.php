<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Customer>
 */
class CustomerFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'code' => 'C' . now()->format('ymd') . fake()->unique()->numerify('###'),
      'name' => fake()->name(),
      'phone' => fake()->numerify('08##########'),
      'email' => fake()->optional()->safeEmail(),
      'address' => fake()->address(),
      'status' => 'active',
      'installation_date' => fake()->dateTimeBetween(
        '-1 year',
        'now'
      )->format('Y-m-d'),
    ];
  }
}
