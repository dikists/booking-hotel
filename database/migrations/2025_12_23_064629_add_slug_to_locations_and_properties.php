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
        Schema::table('provinces', function (Blueprint $table) {
            $table->string('slug')->unique()->after('province_name');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->string('slug')->unique()->after('city_name');
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->string('slug')->unique()->after('district_name');
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('provinces', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
