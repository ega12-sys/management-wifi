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
    Schema::create('invoices', function (Blueprint $table) {
      $table->id();
      $table->string('code', 15)->unique();
      $table->date('Tgl');
      $table->string('customer_code', 10);
      $table->string('subscription_code', 15);
      $table->string('invoice_number', 20)->unique();
      $table->string('periode_tagihan', 7)->nullable();
      $table->date('tgl_jatuh_tempo');
      $table->decimal('amount', 12, 2);
      $table->enum('status', ['unpaid', 'paid', 'overdue'])->default('unpaid');
      $table->dateTime('paid_at')->nullable();

      $table->foreign('customer_code')
        ->references('code')
        ->on('customers')
        ->cascadeOnUpdate()
        ->restrictOnDelete();
      $table->foreign('subscription_code')
        ->references('code')
        ->on('subscriptions')
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
    Schema::dropIfExists('invoices');
  }
};

/**
invoices
-------------------------
id
customer_id
subscription_id
invoice_number
billing_period
due_date
amount
status
paid_at
created_at
updated_at
 */
