<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $cityMap = DB::table('cities')
            ->pluck('id', 'city_name');

        $districts = [
            'Bandung' => [
                'Andir',
                'Antapani',
                'Arcamanik',
                'Astanaanyar',
                'Babakan Ciparay',
                'Bandung Kidul',
                'Bandung Kulon',
                'Bandung Wetan',
                'Batununggal',
                'Bojongloa Kaler',
                'Bojongloa Kidul',
                'Buahbatu',
                'Cibeunying Kaler',
                'Cibeunying Kidul',
                'Cibiru',
                'Cicendo',
                'Coblong',
                'Gedebage',
                'Kiaracondong',
                'Lengkong',
                'Mandalajati',
                'Panyileukan',
                'Rancasari',
                'Regol',
                'Sukajadi',
                'Sukasari',
                'Sumur Bandung',
                'Ujungberung',
            ],

            'Jakarta Selatan' => [
                'Cilandak',
                'Jagakarsa',
                'Kebayoran Baru',
                'Kebayoran Lama',
                'Mampang Prapatan',
                'Pancoran',
                'Pasar Minggu',
                'Pesanggrahan',
                'Setiabudi',
                'Tebet',
            ],

            'Surabaya' => [
                'Asemrowo',
                'Benowo',
                'Bubutan',
                'Bulak',
                'Dukuh Pakis',
                'Gayungan',
                'Genteng',
                'Gubeng',
                'Gunung Anyar',
                'Jambangan',
                'Karang Pilang',
                'Kenjeran',
                'Krembangan',
                'Lakarsantri',
                'Mulyorejo',
                'Pabean Cantian',
                'Pakal',
                'Rungkut',
                'Sawahan',
                'Sukolilo',
                'Sukomanunggal',
                'Tambaksari',
                'Tandes',
                'Tegalsari',
                'Wiyung',
                'Wonocolo',
                'Wonokromo',
            ],
        ];

        foreach ($districts as $cityName => $districtList) {

            if (!isset($cityMap[$cityName])) {
                continue;
            }

            foreach ($districtList as $district) {
                DB::table('districts')->insert([
                    'city_id' => $cityMap[$cityName],
                    'district_name' => $district,
                    'slug' => Str::slug($district),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
