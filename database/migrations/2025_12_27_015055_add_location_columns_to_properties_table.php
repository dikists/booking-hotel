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
        Schema::table('properties', function (Blueprint $table) {

            // lokasi terstruktur
            $table->foreignId('province_id')
                ->nullable()
                ->after('address')
                ->constrained('reg_provinces')
                ->restrictOnDelete();

            $table->foreignId('regency_id')
                ->nullable()
                ->after('province_id')
                ->constrained('reg_regencies')
                ->restrictOnDelete();

            $table->foreignId('district_id')
                ->nullable()
                ->after('regency_id')
                ->constrained('reg_districts')
                ->nullOnDelete();

            // koordinat (penting untuk nearby search)
            $table->decimal('latitude', 10, 7)
                ->nullable()
                ->after('district_id');

            $table->decimal('longitude', 10, 7)
                ->nullable()
                ->after('latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {

            $table->dropForeign(['province_id']);
            $table->dropForeign(['regency_id']);
            $table->dropForeign(['district_id']);

            $table->dropColumn([
                'province_id',
                'regency_id',
                'district_id',
                'latitude',
                'longitude',
            ]);
        });
    }
};
