<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $provinceMap = DB::table('provinces')
            ->pluck('id', 'province_name');

        $cities = [
            'DKI Jakarta' => [
                ['name' => 'Jakarta Pusat', 'type' => 'Kota', 'slug' => 'jakarta-pusat'],
                ['name' => 'Jakarta Utara', 'type' => 'Kota', 'slug' => 'jakarta-utara'],
                ['name' => 'Jakarta Barat', 'type' => 'Kota', 'slug' => 'jakarta-barat'],
                ['name' => 'Jakarta Selatan', 'type' => 'Kota', 'slug' => 'jakarta-selatan'],
                ['name' => 'Jakarta Timur', 'type' => 'Kota', 'slug' => 'jakarta-timur'],
            ],

            'Jawa Barat' => [
                ['name' => 'Bandung', 'type' => 'Kota', 'slug' => 'bandung'],
                ['name' => 'Bekasi', 'type' => 'Kota', 'slug' => 'bekasi'],
                ['name' => 'Bogor', 'type' => 'Kota', 'slug' => 'bogor'],
                ['name' => 'Depok', 'type' => 'Kota', 'slug' => 'depok'],
                ['name' => 'Cimahi', 'type' => 'Kota', 'slug' => 'cimahi'],
                ['name' => 'Bandung Barat', 'type' => 'Kabupaten', 'slug' => 'bandung-barat'],
            ],

            'Jawa Timur' => [
                ['name' => 'Surabaya', 'type' => 'Kota', 'slug' => 'surabaya'],
                ['name' => 'Malang', 'type' => 'Kota', 'slug' => 'malang'],
                ['name' => 'Sidoarjo', 'type' => 'Kabupaten', 'slug' => 'sidoarjo'],
            ],
        ];

        foreach ($cities as $provinceName => $cityList) {
            foreach ($cityList as $city) {
                DB::table('cities')->insert([
                    'province_id' => $provinceMap[$provinceName],
                    'city_name' => $city['name'],
                    'city_type' => $city['type'],
                    'slug' => $city['slug'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
