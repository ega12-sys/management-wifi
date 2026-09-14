<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'invoice_code' => Invoice::factory(),

      'tgl_bayar' => now()->format('Y-m-d'),

      'amount' => 150000,

      'metode_pembayaran' => fake()->randomElement([
        'cash',
        'transfer',
        'qris',
      ]),

      'reference' => fake()->optional()->bothify('PAY-########'),

      'notes' => null,
    ];
  }
}
