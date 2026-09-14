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
    Schema::create('subscriptions', function (Blueprint $table) {
      $table->id();
      $table->string('code', 15)->unique();

      $table->string('customer_code', 10);
      $table->string('package_code');

      $table->date('tgl_mulai')->nullable();
      $table->date('tgl_akhir')->default("9999-12-31");

      $table->decimal('price', 12, 2);

      $table->string('status', 20)->default('active');

      $table->foreign('customer_code')
        ->references('code')
        ->on('customers')
        ->cascadeOnUpdate()
        ->restrictOnDelete();

      $table->foreign('package_code')
        ->references('code')
        ->on('packages')
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
    Schema::dropIfExists('subscriptions');
  }
};
