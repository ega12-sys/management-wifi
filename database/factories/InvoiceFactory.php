<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'invoice_number' => 'INV-' . now()->format('Ym') . '-' . fake()->unique()->numerify('####'),

      'customer_code' => Customer::factory(),

      'billing_period' => now()->format('Y-m'),

      'due_date' => now()->addDays(10)->format('Y-m-d'),

      'amount' => 150000,

      'status' => 'unpaid',

      'paid_at' => null,
    ];
  }
}
