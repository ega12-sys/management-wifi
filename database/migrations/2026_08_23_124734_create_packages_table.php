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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('code', 5)->unique();
            $table->string('name', 100);
            $table->string('package_type_code');
            $table->foreign('package_type_code')
                ->references('code')
                ->on('package_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('speed', 20);
            $table->double('price');
            $table->string('description', 100);
            $table->enum('status', [0, 1]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};

/**
 * id
package_type_id
name
speed
price
description
status
created_at
updated_at
 */
