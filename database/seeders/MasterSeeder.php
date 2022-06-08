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

        DB::table('payment_methods')->insert([
            [
                'name' => 'Bank Mandiri',
                'icon' => 'mandiri.png',
            ],
            [
                'name' => 'Bank BRI',
                'icon' => 'bri.png',
            ],
            [
                'name' => 'Bank BNI',
                'icon' => 'bni.png',
            ],
            [
                'name' => 'Bank BCA',
                'icon' => 'bca.png',
            ],
            [
                'name' => 'Bank BTN',
                'icon' => 'btn.png',
            ],
            [
                'name' => 'Bank Bukopin',
                'icon' => 'bukopin.png',
            ],
            [
                'name' => 'Bank CIMB',
                'icon' => 'cimb.png',
            ],
            [
                'name' => 'Bank Permata',
                'icon' => 'permata.png',
            ],

        ]);

        // DB::table('location_categories')->insert([
        //     [
        //         'name' => 'Perguruan Tinggi',
        //     ],
        //     [
        //         'name' => 'Sekolah',
        //     ],
        //     [
        //         'name' => 'Rumah Makan',
        //     ],
        //     [
        //         'name' => 'Tempat Wisata',
        //     ],
        //     [
        //         'name' => 'Shopping Mall',
        //     ],
        //     [
        //         'name' => 'Fasilitas Umum',
        //     ]
        // ]);

        // DB::table('locations')->insert([
        //     [
        //         'name' => 'UNAND',
        //         'latitude' => '-0.914518',
        //         'longitude' => '100.459526',
        //         'location_category_id' => 1,
        //     ],
        //     [
        //         'name' => 'UNP',
        //         'latitude' => '-0.8969444444444444',
        //         'longitude' => '100.35027777777778',
        //         'location_category_id' => 1,
        //     ],
        //     [
        //         'name' => 'UBH',
        //         'latitude' => '-0.8777777777777778',
        //         'longitude' => '100.38222222222221',
        //         'location_category_id' => 1,
        //     ],
        //     [
        //         'name' => 'UNIDHA',
        //         'latitude' => '-0.9444444444444444',
        //         'longitude' => '100.37555555555555',
        //         'location_category_id' => 1,
        //     ],
        //     [
        //         'name' => 'UNIV. PGRI',
        //         'latitude' => '-0.9097222222222222',
        //         'longitude' => '100.36722222222221',
        //         'location_category_id' => 1,
        //     ],
        //     [
        //         'name' => 'IAIN IMAM BONJOL',
        //         'latitude' => '-0.9302777777777778',
        //         'longitude' => '100.3863888888889',
        //         'location_category_id' => 1,
        //     ],
        //     [
        //         'name' => 'UNIV. MUHAMMADIYAH',
        //         'latitude' => '-0.8555555555555555',
        //         'longitude' => '100.33277777777778',
        //         'location_category_id' => 1,
        //     ],
        //     [
        //         'name' => 'PNP',
        //         'latitude' => '-0.9144444444444445',
        //         'longitude' => '100.46611111111112',
        //         'location_category_id' => 1,
        //     ],
        //     [
        //         'name' => 'ITP',
        //         'latitude' => '-0.8694444444444445',
        //         'longitude' => '100.37888888888888',
        //         'location_category_id' => 1,
        //     ],
        //     [
        //         'name' => 'UNIV. BAITURRAHMAH',
        //         'latitude' => '-0.87',
        //         'longitude' => '100.38333333333334',
        //         'location_category_id' => 1,
        //     ],
        //     [
        //         'name' => 'SMP MUHAMMADIYAH 1',
        //         'latitude' => '-0.9465164',
        //         'longitude' => '100.3698501',
        //         'location_category_id' => 2,
        //     ],
        //     [
        //         'name' => 'SD NEGERI PERCOBAAN',
        //         'latitude' => '-0.93403405',
        //         'longitude' => '100.36011478472',
        //         'location_category_id' => 2,
        //     ],
        //     [
        //         'name' => 'SD BHAYANGKARI I',
        //         'latitude' => '-0.9267184',
        //         'longitude' => '100.3644989361',
        //         'location_category_id' => 2,
        //     ],
        //     [
        //         'name' => 'SMP NEGERI 39 PADANG',
        //         'latitude' => '-0.9336358',
        //         'longitude' => '100.3518965999',
        //         'location_category_id' => 2,
        //     ],
        //     [
        //         'name' => 'SMP N 20 Padang',
        //         'latitude' => '-0.97309985',
        //         'longitude' => '100.37926341964',
        //         'location_category_id' => 2,
        //     ],
        //     [
        //         'name' => 'SMP N 33 PADANG',
        //         'latitude' => '-0.97079715',
        //         'longitude' => '100.39222975782',
        //         'location_category_id' => 2,
        //     ],
        //     [
        //         'name' => 'SMPN 35 PADANG',
        //         'latitude' => '-0.9640499',
        //         'longitude' => '100.37223125',
        //         'location_category_id' => 2,
        //     ],
        //     [
        //         'name' => 'SMK PGRI',
        //         'latitude' => '-0.95945575',
        //         'longitude' => '100.40090394674',
        //         'location_category_id' => 2,
        //     ],
        //     [
        //         'name' => 'MTs N PARAK LAWEH',
        //         'latitude' => '-0.96527675',
        //         'longitude' => '100.39395645416',
        //         'location_category_id' => 2,
        //     ],
        //     [
        //         'name' => 'ADABIAH',
        //         'latitude' => '-0.93360875',
        //         'longitude' => '100.36799898526',
        //         'location_category_id' => 2,
        //     ]
        //     ,
        //     [
        //         'name' => 'SDN 03 ALAI TIMUR',
        //         'latitude' => '-0.92332965',
        //         'longitude' => '100.36653126786',
        //         'location_category_id' => 2,
        //     ]
        //     ,
        //     [
        //         'name' => 'SDIT BUAH HATI',
        //         'latitude' => '-0.90026225',
        //         'longitude' => '100.3479034',
        //         'location_category_id' => 2,
        //     ]
        //     ,
        //     [
        //         'name' => 'SD SABIHISMA',
        //         'latitude' => '-0.8890041',
        //         'longitude' => '100.36407475048',
        //         'location_category_id' => 2,
        //     ]
        //     ,
        //     [
        //         'name' => 'SMP 29 KURAU PAGANG',
        //         'latitude' => '-0.88740015',
        //         'longitude' => '100.36841802242',
        //         'location_category_id' => 2,
        //     ]
        //     ,
        //     [
        //         'name' => 'MAN 1 PADANG',
        //         'latitude' => '-0.92608165',
        //         'longitude' => '100.40487844395',
        //         'location_category_id' => 2,
        //     ]
        //     ,
        //     [
        //         'name' => 'MTS N DURIAN TARUNG',
        //         'latitude' => '-0.9259828',
        //         'longitude' => '100.40447863036',
        //         'location_category_id' => 2,
        //     ]
        //     ,
        //     [
        //         'name' => 'MTsN KURANJI',
        //         'latitude' => '-0.915157',
        //         'longitude' => '100.41898137405',
        //         'location_category_id' => 2,
        //     ]
        //     ,
        //     [
        //         'name' => 'SD NEGERI 17 PASAR AMBACANG',
        //         'latitude' => '-0.9326284',
        //         'longitude' => '100.40776692511',
        //         'location_category_id' => 2,
        //     ]
        //     ,
        //     [
        //         'name' => 'SD NEGERI 06 PASAR AMBACANG',
        //         'latitude' => '-0.9329886',
        //         'longitude' => '100.40757744577',
        //         'location_category_id' => 2,
        //     ]
        //     ,
        //     [
        //         'name' => 'SD NEGERI 23 PASAR AMBACANG',
        //         'latitude' => '-0.93278935',
        //         'longitude' => '100.4074877',
        //         'location_category_id' => 2,
        //     ]
        //     ,
        //     [
        //         'name' => 'SMA YAPI Padang',
        //         'latitude' => '-0.9352044',
        //         'longitude' => '100.35393092049',
        //         'location_category_id' => 2,
        //     ]
        //     ,
        //     [
        //         'name' => 'AROMA KITCHEN',
        //         'latitude' => '-0.87027',
        //         'longitude' => '100.34477',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'CAFE ANGKRINGAN',
        //         'latitude' => '-0.92324',
        //         'longitude' => '100.39303',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'RM RIZKY FAJAR',
        //         'latitude' => '-0.95943',
        //         'longitude' => '100.36774',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'AW RESTO',
        //         'latitude' => '-0.96585',
        //         'longitude' => '100.35329',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'KFC VETERAN',
        //         'latitude' => '-0.9424',
        //         'longitude' => '100.35424',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'DAMAR SHAKER',
        //         'latitude' => '-0.92607',
        //         'longitude' => '100.43717',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'O Chicken',
        //         'latitude' => '-0.91725',
        //         'longitude' => '100.36476',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'AYAM PENYET RIA',
        //         'latitude' => '-0.92726',
        //         'longitude' => '100.35283',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'KFC PLAZA ANDALAS',
        //         'latitude' => '-0.95067',
        //         'longitude' => '100.35571',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'CFC',
        //         'latitude' => '-0.9786',
        //         'longitude' => '100.38098',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'TEXAS CHICKEN',
        //         'latitude' => '-0.92843',
        //         'longitude' => '100.35166',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'J SIX CAFE',
        //         'latitude' => '-0.92963',
        //         'longitude' => '100.35242',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'ES DURIAN IKO GANTINYO',
        //         'latitude' => '-0.95933',
        //         'longitude' => '100.36091',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'RUMAH MAKAN LAMAK BASAMO',
        //         'latitude' => '-0.91114',
        //         'longitude' => '100.36406',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'BAKSO LAPANGAN TEMBAK',
        //         'latitude' => '-0.92537',
        //         'longitude' => '100.35116',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'SOERABI BANDUNG ENHAII',
        //         'latitude' => '-0.9302',
        //         'longitude' => '100.36062',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'BAKSO MALANG MAS PEPEN',
        //         'latitude' => '-0.93857',
        //         'longitude' => '100.36578',
        //         'location_category_id' => 3,
        //     ]
        //     ,
        //     [
        //         'name' => 'GUNUNG PADANG',
        //         'latitude' => '-0.97096',
        //         'longitude' => '100.365945',
        //         'location_category_id' => 4,
        //     ]
        //     ,
        //     [
        //         'name' => 'TAMAN SITI NURBAYA',
        //         'latitude' => '-0.9670142',
        //         'longitude' => '100.3490775',
        //         'location_category_id' => 4,
        //     ]
        //     ,
        //     [
        //         'name' => 'TIGER CAMP',
        //         'latitude' => '-0.8104904',
        //         'longitude' => '100.4012313',
        //         'location_category_id' => 4,
        //     ]
        //     ,
        //     [
        //         'name' => 'TAMAN IMAM BONJOL',
        //         'latitude' => '-0.9523754',
        //         'longitude' => '100.3631675',
        //         'location_category_id' => 4,
        //     ]
        //     ,
        //     [
        //         'name' => 'TAMAN NANGGALO',
        //         'latitude' => '-0.8964599',
        //         'longitude' => '100.3657407',
        //         'location_category_id' => 4,
        //     ]
        //     ,
        //     [
        //         'name' => 'CHRISTINE HAKIM IDEA PARK',
        //         'latitude' => '-0.8105761',
        //         'longitude' => '100.3159567',
        //         'location_category_id' => 4,
        //     ]
        //     ,
        //     [
        //         'name' => 'BUKIT NOBITA',
        //         'latitude' => '-0.9740308',
        //         'longitude' => '100.4160553',
        //         'location_category_id' => 4,
        //     ]
        //     ,
        //     [
        //         'name' => 'PANTAI AIR MANIS',
        //         'latitude' => '-0.994045972264',
        //         'longitude' => '100.364343388',
        //         'location_category_id' => 4,
        //     ]
        //     ,
        //     [
        //         'name' => 'SWIMMING POOL ABG',
        //         'latitude' => '-0.894954015987',
        //         'longitude' => '100.404077744',
        //         'location_category_id' => 4,
        //     ]
        //     ,
        //     [
        //         'name' => 'ARAU MINI WATERPARK',
        //         'latitude' => '-0.963670996067',
        //         'longitude' => '100.360701902',
        //         'location_category_id' => 4,
        //     ]
        //     ,
        //     [
        //         'name' => 'TAMAN MELATI ADITYAWARMAN',
        //         'latitude' => '-0.957037441',
        //         'longitude' => '100.355614723',
        //         'location_category_id' => 4,
        //     ]
        //     ,
        //     [
        //         'name' => 'PANTAI CAROLINA',
        //         'latitude' => '-0.89704',
        //         'longitude' => '100.37946',
        //         'location_category_id' => 4,
        //     ],
        //     [
        //         'name' => 'PANTAI BUNGUS',
        //         'latitude' => '-1.04729',
        //         'longitude' => '100.41217',
        //         'location_category_id' => 4,
        //     ]
        //     ,
        //     [
        //         'name' => 'PLAZA ANDALAS',
        //         'latitude' => '-0.8812737',
        //         'longitude' => '100.3626188',
        //         'location_category_id' => 5,
        //     ]
        //     ,
        //     [
        //         'name' => 'BASKO GRAND MALL',
        //         'latitude' => '-0.8793',
        //         'longitude' => '100.34893',
        //         'location_category_id' => 5,
        //     ]
        //     ,
        //     [
        //         'name' => 'ATM BERSAMA',
        //         'latitude' => '-0.9100513',
        //         'longitude' => '100.354059',
        //         'location_category_id' => 6,
        //     ]
        //     ,
        //     [
        //         'name' => 'ATM MANDIRI UNAND',
        //         'latitude' => '-0.9146157',
        //         'longitude' => '100.4601111',
        //         'location_category_id' => 6,
        //     ]
        //     ,
        //     [
        //         'name' => 'ATM CIMB NIAGA',
        //         'latitude' => '-0.952006',
        //         'longitude' => '100.3587335',
        //         'location_category_id' => 6,
        //     ]
        //     ,
        //     [
        //         'name' => 'ATM BSM PAUH',
        //         'latitude' => '-0.9183035',
        //         'longitude' => '100.4584305',
        //         'location_category_id' => 6,
        //     ]
            
        // ]);
    }
}
