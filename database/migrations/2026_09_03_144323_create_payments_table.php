<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('payments', function (Blueprint $table) {
      $table->id();
      $table->string('code', 15)->unique();
      $table->string('invoice_code', 15);
      $table->date('tgl_bayar');
      $table->decimal('amount', 12, 2);
      $table->string('metode_pembayaran', 20);
      $table->string('reference', 50)->nullable();
      $table->text('notes')->nullable();

      $table->foreign('invoice_code')
        ->references('code')
        ->on('invoices')
        ->cascadeOnUpdate()
        ->restrictOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('payments');
  }
};
/**
 payments
-------------------------
id
invoice_id
payment_date
amount
payment_method
reference
notes
created_at
updated_at
 */
