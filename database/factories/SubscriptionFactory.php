<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Package;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Subscription>
 */
class SubscriptionFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $startDate = fake()->dateTimeBetween('-1 year', 'now');

    return [
      'code' => 'SUB' . now()->format('ymd') . fake()->unique()->numerify('###'),

      'customer_code' => Customer::factory(),

      'package_code' => Package::factory(),

      'start_date' => $startDate->format('Y-m-d'),

      'end_date' => null,

      'price' => fake()->randomElement([
        100000,
        150000,
        200000,
        250000,
        300000,
      ]),

      'status' => 'active',
    ];
  }
}
