<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kost_types')->insert([
            [
                'name' => 'Putra',
            ],
            [
                'name' => 'Putri',
            ],
            [
                'name' => 'Campur',
            ]
        ]);

        DB::table('rent_durations')->insert([
            [
                'name' => 'Per bulan',
                'day' => 30,
            ],
            [
                'name' => 'Per minggu',
                'day' => 7,
            ],
            [
                'name' => 'Per 3 bulan',
                'day' => 90,
            ],
            [
                'name' => 'Per 6 bulan',
                'day' => 180,
            ],
            [
                'name' => 'Per tahun',
                'day' => 360,
            ]
        ]);

        DB::table('sections')->insert([
            [
                'name' => 'Foto bangunan dari depan',
            ],
            [
                'name' => 'Foto bagian dalam bangunan',
            ],
            [
                'name' => 'Foto bangunan dari jalan',
            ],
            [
                'name' => 'Foto bagian depan kamar',
            ],
            [
                'name' => 'Foto bagian dalam kamar',
            ],
            [
                'name' => 'Foto kamar mandi',
            ],
            [
                'name' => 'Foto tambahan',
            ]
        ]);

        DB::table('facility_types')->insert([
            [
                'name' => 'Fasilitas Umum',
            ],
            [
                'name' => 'Parkir',
            ],
            [
                'name' => 'Fasilitas Kamar',
            ],
            [
                'name' => 'Fasilitas Kamar Mandi',
            ]
            
        ]);

        DB::table('facilities')->insert([
            [
                'name' => 'Balcon',
                'icon' => '',
                'facility_type_id' => '1',
            ],
            [
                'name' => 'Wifi',
                'icon' => 'fa fa-wifi',
                'facility_type_id' => '1',
            ],
            [
                'name' => 'CCTV',
                'icon' => '',
                'facility_type_id' => '1',
            ],
            [
                'name' => 'Dapur',
                'icon' => '',
                'facility_type_id' => '1',
            ],
            [
                'name' => 'Dispenser',
                'icon' => '',
                'facility_type_id' => '1',
            ],
            [
                'name' => 'Gazebo',
                'icon' => '',
                'facility_type_id' => '1',
            ],
            [
                'name' => 'Kantin',
                'icon' => 'fa fa-cutlery',
                'facility_type_id' => '1',
            ],
            [
                'name' => 'Jemuran',
                'icon' => '',
                'facility_type_id' => '1',
            ],
            [
                'name' => 'Parkir mobil',
                'icon' => 'fa fa-automobile',
                'facility_type_id' => '2',
            ],
            [
                'name' => 'Parkir motor',
                'icon' => '',
                'facility_type_id' => '2',
            ],
            [
                'name' => 'Parkir sepeda',
                'icon' => 'fa fa-bicycle',
                'facility_type_id' => '2',
            ],
            [
                'name' => 'AC',
                'icon' => '',
                'facility_type_id' => '3',
            ],
            [
                'name' => 'Air panas',
                'icon' => '',
                'facility_type_id' => '3',
            ],
            [
                'name' => 'Kasur',
                'icon' => '',
                'facility_type_id' => '3',
            ],
            [
                'name' => 'Kulkas',
                'icon' => '',
                'facility_type_id' => '3',
            ],
            [
                'name' => 'Bak mandi',
                'icon' => '',
                'facility_type_id' => '4',
            ],
            [
                'name' => 'Bathtub',
                'icon' => 'fa fa-bath',
                'facility_type_id' => '4',
            ],
            [
                'name' => 'Shower',
                'icon' => 'fa fa-shower',
                'facility_type_id' => '4',
            ],
            [
                'name' => 'Ember',
                'icon' => '',
                'facility_type_id' => '4',
            ],
            [
                'name' => 'Kloset duduk',
                'icon' => '',
                'facility_type_id' => '4',
            ],
            [
                'name' => 'Kloset jongkok',
                'icon' => '',
                'facility_type_id' => '4',
            ]
        ]);

        DB::table('rules')->insert([
            [
                'name' => 'Ada jam malam',
            ],
            [
                'name' => 'Akses 24',
            ],
            [
                'name' => 'Ada jam malam untuk tamu',
            ],
            [
                'name' => 'Denda kerusakan barang kos',
            ]
        ]);
    }
}
