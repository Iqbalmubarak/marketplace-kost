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

        // DB::table('koordinar')->insert([
        //     [
        //         'name' => 'UNAND',
        //         'latitude' => '-0.914518',
        //         'longitude' => '100.459526'
        //     ],
        //     [
        //         'name' => 'UNP',
        //         'latitude' => '-0.8969444444444444',
        //         'longitude' => '100.35027777777778'
        //     ],
        //     [
        //         'name' => 'UBH',
        //         'latitude' => '-0.8777777777777778',
        //         'longitude' => '100.38222222222221'
        //     ],
        //     [
        //         'name' => 'UNIDHA',
        //         'latitude' => '-0.9444444444444444',
        //         'longitude' => '100.37555555555555'
        //     ],
        //     [
        //         'name' => 'UNIV. PGRI',
        //         'latitude' => '-0.9097222222222222',
        //         'longitude' => '100.36722222222221'
        //     ],
        //     [
        //         'name' => 'IAIN IMAM BONJOL',
        //         'latitude' => '-0.9302777777777778',
        //         'longitude' => '100.3863888888889'
        //     ],
        //     [
        //         'name' => 'UNIV. MUHAMMADIYAH',
        //         'latitude' => '-0.8555555555555555',
        //         'longitude' => '100.33277777777778'
        //     ],
        //     [
        //         'name' => 'PNP',
        //         'latitude' => '-0.9144444444444445',
        //         'longitude' => '100.46611111111112'
        //     ],
        //     [
        //         'name' => 'ITP',
        //         'latitude' => '-0.8694444444444445',
        //         'longitude' => '100.37888888888888'
        //     ],
        //     [
        //         'name' => 'UNIV. BAITURRAHMAH',
        //         'latitude' => '-0.87',
        //         'longitude' => '100.38333333333334'
        //     ],
        //     [
        //         'name' => 'Ada jam malam',
        //         'latitude' => 'Ada jam malam',
        //         'longitude' => 'Ada jam malam'
        //     ]
            
        // ]);
    }
}
