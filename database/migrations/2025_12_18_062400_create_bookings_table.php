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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('property_id')->constrained('properties');
            $table->foreignId('room_id')->constrained('rooms');
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->decimal('total_price', 14, 2);
            $table->enum('booking_status', ['pending', 'paid', 'cancel', 'checkin', 'checkout'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
