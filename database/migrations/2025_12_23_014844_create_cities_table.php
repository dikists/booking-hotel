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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('province_id')
                ->constrained('provinces')
                ->restrictOnDelete();

            $table->string('city_name', 100);
            $table->enum('city_type', ['Kota', 'Kabupaten']);
            $table->timestamps();

            $table->index(['province_id', 'city_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
