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

        DB::table('kost_types')->insert([
            [
                'name' => 'Putra',
            ]
            ,
            [
                'name' => 'Putri',
            ]
            ,
            [
                'name' => 'Campur',
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

        
        DB::table('location_categories')->insert([
            [
                'name' => 'Perguruan Tinggi',
                'icon' => 'kampus.png',
            ],
            [
                'name' => 'Sekolah',
                'icon' => 'sekolah.png',
            ],
            [
                'name' => 'COFFEE & RESTO',
                'icon' => 'resto.png',
            ],
            [
                'name' => 'Tempat Wisata',
                'icon' => 'wisata.png',
            ],
            [
                'name' => 'Pusat Perbelanjaan',
                'icon' => 'belanja.png',
            ],
            [
                'name' => 'BANK & ATM',
                'icon' => 'bank.png',
            ],
            [
                'name' => 'Toko Kue',
                'icon' => 'kue.png',
            ]
        ]);

        DB::table('locations')->insert([
            [
                'name' => 'UNAND',
                'latitude' => '-0.914518',
                'longitude' => '100.459526',
                'location_category_id' => 1,
            ],
            [
                'name' => 'UNP',
                'latitude' => '-0.8969444444444444',
                'longitude' => '100.35027777777778',
                'location_category_id' => 1,
            ],
            [
                'name' => 'UBH',
                'latitude' => '-0.8777777777777778',
                'longitude' => '100.38222222222221',
                'location_category_id' => 1,
            ],
            [
                'name' => 'UNIDHA',
                'latitude' => '-0.9444444444444444',
                'longitude' => '100.37555555555555',
                'location_category_id' => 1,
            ],
            [
                'name' => 'UNIV. PGRI',
                'latitude' => '-0.9097222222222222',
                'longitude' => '100.36722222222221',
                'location_category_id' => 1,
            ],
            [
                'name' => 'IAIN IMAM BONJOL',
                'latitude' => '-0.9302777777777778',
                'longitude' => '100.3863888888889',
                'location_category_id' => 1,
            ],
            [
                'name' => 'UNIV. MUHAMMADIYAH',
                'latitude' => '-0.8555555555555555',
                'longitude' => '100.33277777777778',
                'location_category_id' => 1,
            ],
            [
                'name' => 'PNP',
                'latitude' => '-0.9144444444444445',
                'longitude' => '100.46611111111112',
                'location_category_id' => 1,
            ],
            [
                'name' => 'ITP',
                'latitude' => '-0.8694444444444445',
                'longitude' => '100.37888888888888',
                'location_category_id' => 1,
            ],
            [
                'name' => 'UNIV. BAITURRAHMAH',
                'latitude' => '-0.87',
                'longitude' => '100.38333333333334',
                'location_category_id' => 1,
            ],
            [
                'name' => 'SMP MUHAMMADIYAH 1',
                'latitude' => '-0.9465164',
                'longitude' => '100.3698501',
                'location_category_id' => 2,
            ],
            [
                'name' => 'SD NEGERI PERCOBAAN',
                'latitude' => '-0.93403405',
                'longitude' => '100.36011478472',
                'location_category_id' => 2,
            ],
            [
                'name' => 'SD BHAYANGKARI I',
                'latitude' => '-0.9267184',
                'longitude' => '100.3644989361',
                'location_category_id' => 2,
            ],
            [
                'name' => 'SMP NEGERI 39 PADANG',
                'latitude' => '-0.9336358',
                'longitude' => '100.3518965999',
                'location_category_id' => 2,
            ],
            [
                'name' => 'SMP N 20 Padang',
                'latitude' => '-0.97309985',
                'longitude' => '100.37926341964',
                'location_category_id' => 2,
            ],
            [
                'name' => 'SMP N 33 PADANG',
                'latitude' => '-0.97079715',
                'longitude' => '100.39222975782',
                'location_category_id' => 2,
            ],
            [
                'name' => 'SMPN 35 PADANG',
                'latitude' => '-0.9640499',
                'longitude' => '100.37223125',
                'location_category_id' => 2,
            ],
            [
                'name' => 'SMK PGRI',
                'latitude' => '-0.95945575',
                'longitude' => '100.40090394674',
                'location_category_id' => 2,
            ],
            [
                'name' => 'MTs N PARAK LAWEH',
                'latitude' => '-0.96527675',
                'longitude' => '100.39395645416',
                'location_category_id' => 2,
            ],
            [
                'name' => 'ADABIAH',
                'latitude' => '-0.93360875',
                'longitude' => '100.36799898526',
                'location_category_id' => 2,
            ]
            ,
            [
                'name' => 'SDN 03 ALAI TIMUR',
                'latitude' => '-0.92332965',
                'longitude' => '100.36653126786',
                'location_category_id' => 2,
            ]
            ,
            [
                'name' => 'SDIT BUAH HATI',
                'latitude' => '-0.90026225',
                'longitude' => '100.3479034',
                'location_category_id' => 2,
            ]
            ,
            [
                'name' => 'SD SABIHISMA',
                'latitude' => '-0.8890041',
                'longitude' => '100.36407475048',
                'location_category_id' => 2,
            ]
            ,
            [
                'name' => 'SMP 29 KURAU PAGANG',
                'latitude' => '-0.88740015',
                'longitude' => '100.36841802242',
                'location_category_id' => 2,
            ]
            ,
            [
                'name' => 'MAN 1 PADANG',
                'latitude' => '-0.92608165',
                'longitude' => '100.40487844395',
                'location_category_id' => 2,
            ]
            ,
            [
                'name' => 'MTS N DURIAN TARUNG',
                'latitude' => '-0.9259828',
                'longitude' => '100.40447863036',
                'location_category_id' => 2,
            ]
            ,
            [
                'name' => 'MTsN KURANJI',
                'latitude' => '-0.915157',
                'longitude' => '100.41898137405',
                'location_category_id' => 2,
            ]
            ,
            [
                'name' => 'SD NEGERI 17 PASAR AMBACANG',
                'latitude' => '-0.9326284',
                'longitude' => '100.40776692511',
                'location_category_id' => 2,
            ]
            ,
            [
                'name' => 'SD NEGERI 06 PASAR AMBACANG',
                'latitude' => '-0.9329886',
                'longitude' => '100.40757744577',
                'location_category_id' => 2,
            ]
            ,
            [
                'name' => 'SD NEGERI 23 PASAR AMBACANG',
                'latitude' => '-0.93278935',
                'longitude' => '100.4074877',
                'location_category_id' => 2,
            ]
            ,
            [
                'name' => 'SMA YAPI Padang',
                'latitude' => '-0.9352044',
                'longitude' => '100.35393092049',
                'location_category_id' => 2,
            ]
            ,
            [
                'name' => 'AROMA KITCHEN',
                'latitude' => '-0.87027',
                'longitude' => '100.34477',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'CAFE ANGKRINGAN',
                'latitude' => '-0.92324',
                'longitude' => '100.39303',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'RM RIZKY FAJAR',
                'latitude' => '-0.95943',
                'longitude' => '100.36774',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'AW RESTO',
                'latitude' => '-0.96585',
                'longitude' => '100.35329',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'KFC VETERAN',
                'latitude' => '-0.9424',
                'longitude' => '100.35424',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'DAMAR SHAKER',
                'latitude' => '-0.92607',
                'longitude' => '100.43717',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'O Chicken',
                'latitude' => '-0.91725',
                'longitude' => '100.36476',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'AYAM PENYET RIA',
                'latitude' => '-0.92726',
                'longitude' => '100.35283',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'KFC PLAZA ANDALAS',
                'latitude' => '-0.95067',
                'longitude' => '100.35571',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'CFC',
                'latitude' => '-0.9786',
                'longitude' => '100.38098',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'TEXAS CHICKEN',
                'latitude' => '-0.92843',
                'longitude' => '100.35166',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'J SIX CAFE',
                'latitude' => '-0.92963',
                'longitude' => '100.35242',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'ES DURIAN IKO GANTINYO',
                'latitude' => '-0.95933',
                'longitude' => '100.36091',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'RUMAH MAKAN LAMAK BASAMO',
                'latitude' => '-0.91114',
                'longitude' => '100.36406',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'BAKSO LAPANGAN TEMBAK',
                'latitude' => '-0.92537',
                'longitude' => '100.35116',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'SOERABI BANDUNG ENHAII',
                'latitude' => '-0.9302',
                'longitude' => '100.36062',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'BAKSO MALANG MAS PEPEN',
                'latitude' => '-0.93857',
                'longitude' => '100.36578',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'GUNUNG PADANG',
                'latitude' => '-0.97096',
                'longitude' => '100.365945',
                'location_category_id' => 4,
            ]
            ,
            [
                'name' => 'TAMAN SITI NURBAYA',
                'latitude' => '-0.9670142',
                'longitude' => '100.3490775',
                'location_category_id' => 4,
            ]
            ,
            [
                'name' => 'TIGER CAMP',
                'latitude' => '-0.8104904',
                'longitude' => '100.4012313',
                'location_category_id' => 4,
            ]
            ,
            [
                'name' => 'TAMAN IMAM BONJOL',
                'latitude' => '-0.9523754',
                'longitude' => '100.3631675',
                'location_category_id' => 4,
            ]
            ,
            [
                'name' => 'TAMAN NANGGALO',
                'latitude' => '-0.8964599',
                'longitude' => '100.3657407',
                'location_category_id' => 4,
            ]
            ,
            [
                'name' => 'CHRISTINE HAKIM IDEA PARK',
                'latitude' => '-0.8105761',
                'longitude' => '100.3159567',
                'location_category_id' => 4,
            ]
            ,
            [
                'name' => 'BUKIT NOBITA',
                'latitude' => '-0.9740308',
                'longitude' => '100.4160553',
                'location_category_id' => 4,
            ]
            ,
            [
                'name' => 'PANTAI AIR MANIS',
                'latitude' => '-0.994045972264',
                'longitude' => '100.364343388',
                'location_category_id' => 4,
            ]
            ,
            [
                'name' => 'SWIMMING POOL ABG',
                'latitude' => '-0.894954015987',
                'longitude' => '100.404077744',
                'location_category_id' => 4,
            ]
            ,
            [
                'name' => 'ARAU MINI WATERPARK',
                'latitude' => '-0.963670996067',
                'longitude' => '100.360701902',
                'location_category_id' => 4,
            ]
            ,
            [
                'name' => 'TAMAN MELATI ADITYAWARMAN',
                'latitude' => '-0.957037441',
                'longitude' => '100.355614723',
                'location_category_id' => 4,
            ]
            ,
            [
                'name' => 'PANTAI CAROLINA',
                'latitude' => '-0.89704',
                'longitude' => '100.37946',
                'location_category_id' => 4,
            ],
            [
                'name' => 'PANTAI BUNGUS',
                'latitude' => '-1.04729',
                'longitude' => '100.41217',
                'location_category_id' => 4,
            ]
            ,
            [
                'name' => 'PLAZA ANDALAS',
                'latitude' => '-0.8812737',
                'longitude' => '100.3626188',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'BASKO GRAND MALL',
                'latitude' => '-0.8793',
                'longitude' => '100.34893',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'ATM BERSAMA',
                'latitude' => '-0.9100513',
                'longitude' => '100.354059',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM MANDIRI UNAND',
                'latitude' => '-0.9146157',
                'longitude' => '100.4601111',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM CIMB NIAGA',
                'latitude' => '-0.952006',
                'longitude' => '100.3587335',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM BSM PAUH',
                'latitude' => '-0.9183035',
                'longitude' => '100.4584305',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'RILI SWALAYAN ANDALAS',
                'latitude' => '-0.9419272',
                'longitude' => '100.3800919',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'X MART AIR TAWAR',
                'latitude' => '-0.8908129',
                'longitude' => '100.3519603',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'GRAND CITRA SWALAYAN LUBUK BUAYA',
                'latitude' => '-0.8227534',
                'longitude' => '100.3258006',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'BUDIMAN SWALAYAN SAWAHAN',
                'latitude' => '-0.9462259',
                'longitude' => '100.3670607',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'MILAGROS JATI',
                'latitude' => '-0.9358686',
                'longitude' => '100.3638265',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'ACIAK MART SEBERANG PADANG',
                'latitude' => '-0.9568591',
                'longitude' => '100.373958',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'FOODMART PADANG',
                'latitude' => '-0.951068',
                'longitude' => '100.359233',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'SUZUA ROCKY PADANG',
                'latitude' => '-0.9468917',
                'longitude' => '100.3593527',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'BUDIMAN SWALAYAN PONDOK',
                'latitude' => '-0.9562335',
                'longitude' => '100.3605634',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'LISTRIK MART KURANJI',
                'latitude' => '-0.9212706',
                'longitude' => '100.3886947',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'CITRA SWALAYAN GAJAH MADA',
                'latitude' => '-0.9072796',
                'longitude' => '100.363483',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'YOWAY SWALAYAN LAPAI',
                'latitude' => '-0.9045208',
                'longitude' => '100.3580273',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'BI MART VETERAN',
                'latitude' => '-0.9351502',
                'longitude' => '100.3546582',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'OKY MART',
                'latitude' => '-0.9441589',
                'longitude' => '100.3563781',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'X MART DIPONEGORO',
                'latitude' => '-0.9555839',
                'longitude' => '100.3552815',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'ANRINA SWALAYAN LUBUK BEGALUNG',
                'latitude' => '-0.9647607',
                'longitude' => '100.4119243',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'CITRA SWALAYAN ANDALAS',
                'latitude' => '-0.937528',
                'longitude' => '100.3879249',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'YOSSIE SWALAYAN TABING',
                'latitude' => '-0.8774219',
                'longitude' => '100.3479362',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'YOSSIE SUPERMARKET ADINEGORO',
                'latitude' => '-0.8651281',
                'longitude' => '100.3419458',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'PROCOM SWALAYAN ANDURING',
                'latitude' => '-0.9317379',
                'longitude' => '100.3877157',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'WIRDA SWALAYAN SITEBA',
                'latitude' => '-0.8964998',
                'longitude' => '100.3728716',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'SWALAYAN MINIMARKET KURANJI',
                'latitude' => '-0.8982105',
                'longitude' => '100.4207508',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'PUSAT OLEH-OLEH UMMI AUFA HAKIM',
                'latitude' => '-0.935582',
                'longitude' => '100.3544641',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'HARIZ PERTAMA',
                'latitude' => '-0.947571',
                'longitude' => '100.354954',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'DAYU MART LUBUK BEGALUNG',
                'latitude' => '-0.9683757',
                'longitude' => '100.3914587',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'FOODMART BASKO PADANG',
                'latitude' => '-0.9022152',
                'longitude' => '100.3509108',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'ACIAK MART SITEBA',
                'latitude' => '-0.8978036',
                'longitude' => '100.3745028',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'SPR PLAZA',
                'latitude' => '-0.9511944',
                'longitude' => '100.3592035',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'DAMAR PLAZA',
                'latitude' => '-0.9443992',
                'longitude' => '100.3548929',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'TRANSMART PADANG',
                'latitude' => '-0.9123177',
                'longitude' => '100.3575272',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'SJS PLAZA',
                'latitude' => '-0.9042411',
                'longitude' => '100.3585655',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'EIGER STORE ULAK KARANG',
                'latitude' => '-0.9149954',
                'longitude' => '100.3499851',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'TREND SHOP PADANG',
                'latitude' => '-0.9483268',
                'longitude' => '100.3593504',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'PASAR RAYA PADANG',
                'latitude' => '-0.9485474',
                'longitude' => '100.3616591',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'CITRA SWALAYAN GANTING',
                'latitude' => '-0.9523737',
                'longitude' => '100.3759455',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'NEW DEWATA',
                'latitude' => '-0.9095133',
                'longitude' => '100.3638598',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'D-COST PLAZA ANDALAS',
                'latitude' => '-0.9497',
                'longitude' => '100.355272',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'TOKO BUKU MAJU JAYA',
                'latitude' => '-0.940228',
                'longitude' => '100.355332',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'TOKO BUKU AL-FAHMU',
                'latitude' => '-0.924949',
                'longitude' => '100.3688381',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'TOKO BUKU AT TAQWA',
                'latitude' => '-0.952011',
                'longitude' => '100.359961',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'GRAMEDIA',
                'latitude' => '-0.944374',
                'longitude' => '100.35443',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'TOKO BUKU ANEKA',
                'latitude' => '-0.929348',
                'longitude' => '100.4284531',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'TOKO BUKU NESA',
                'latitude' => '-0.8973093',
                'longitude' => '100.3674557',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'TOKO BUKU NURUL ILMI',
                'latitude' => '-0.9109235',
                'longitude' => '100.3488918',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'SARI ANGGREK',
                'latitude' => '-0.945999',
                'longitude' => '100.3587884',
                'location_category_id' => 5,
            ]
            ,
            [
                'name' => 'TOKO KUE YASMIN',
                'latitude' => '-0.996442',
                'longitude' => '100.41999',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'MAGENTA COKLAT',
                'latitude' => '-0.915999',
                'longitude' => '100.352281',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'TOKO KUE HOKKY',
                'latitude' => '-0.9608064',
                'longitude' => '100.3629338',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'SONIA CAKE & COOKIES THAMRIN',
                'latitude' => '-0.9553841',
                'longitude' => '100.3628533',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'HAIL CAKE',
                'latitude' => '-0.8964951',
                'longitude' => '100.3722555',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'MINANG MANDE CAKE',
                'latitude' => '-0.9515276',
                'longitude' => '100.3642018',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'NELLA CAKE RIMBO KALUANG',
                'latitude' => '-0.9283351',
                'longitude' => '100.3610404',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'LAPIS MINANG NANTIGO',
                'latitude' => '-0.9458796',
                'longitude' => '100.3679636',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'HOYA BAKERY & RESTO',
                'latitude' => '-0.9515601',
                'longitude' => '100.4241391',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'TOKO KUE FIZZA',
                'latitude' => '-0.9359886',
                'longitude' => '100.3617979',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'SUPER BREAD',
                'latitude' => '-0.9126286',
                'longitude' => '100.350058',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'BASHO CAKE',
                'latitude' => '-0.9401928',
                'longitude' => '100.3832911',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'SONIA CAKE SUTOMO',
                'latitude' => '-0.9572667',
                'longitude' => '100.3966022',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'NELLA CAKE LUBUK BEGALUNG',
                'latitude' => '-0.9576809',
                'longitude' => '100.400515',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'SAFARI BAKERY',
                'latitude' => '-0.9435038',
                'longitude' => '100.3546444',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'IKO CAKE',
                'latitude' => '-0.9495655',
                'longitude' => '100.3655284',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'QUETA CAKES',
                'latitude' => '-0.9239585',
                'longitude' => '100.3731624',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'DALLAS BAKERY LAPAI',
                'latitude' => '-0.9027652',
                'longitude' => '100.3611813',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'HOT STATION',
                'latitude' => '-0.9577241',
                'longitude' => '100.366467',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'MARTABAK MALABAR ARHAM THAMRIN',
                'latitude' => '-0.9559157',
                'longitude' => '100.3619182',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'WEEKEND CAFE',
                'latitude' => '-0.962403',
                'longitude' => '100.362271',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'KUBIK COFFEE',
                'latitude' => '-0.943074',
                'longitude' => '100.353348',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'PAVILON COFFEE',
                'latitude' => '-0.9603565',
                'longitude' => '100.3538197',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'RESTORAN SARI RASO',
                'latitude' => '-0.9546623',
                'longitude' => '100.3608152',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'KUBANG HAYUDA',
                'latitude' => '-0.9515342',
                'longitude' => '100.3564114',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'RM PAUH PIAMAN',
                'latitude' => '-0.9142609',
                'longitude' => '100.3577151',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'OLD SCHOOL RESTO',
                'latitude' => '-0.9383024',
                'longitude' => '100.3519421',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'ES DURIAN GANTI NAN LAMO',
                'latitude' => '-0.9591681',
                'longitude' => '100.3610455',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'RIMBUN ESPRESSO & BREW BAR',
                'latitude' => '-0.934162',
                'longitude' => '100.363158',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'CLAYTON CAFE & RESTO',
                'latitude' => '-0.924628145718',
                'longitude' => '100.440503454',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'THE GADE CAFE',
                'latitude' => '-0.950508166667',
                'longitude' => '100.3675529',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'CAFE MERJER',
                'latitude' => '-0.934689005',
                'longitude' => '100.354866381',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'POCHAJJANG',
                'latitude' => '-0.9341',
                'longitude' => '100.36375',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'OMASEMI',
                'latitude' => '-0.938161113069',
                'longitude' => '100.365393807',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'PECEL AYAM LAMUN OMBAK',
                'latitude' => '-0.908432',
                'longitude' => '100.353301',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'SUKO KOPI',
                'latitude' => '-0.9451198',
                'longitude' => '100.3639615',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'KOPMIL OMPING',
                'latitude' => '-0.9289424',
                'longitude' => '100.366767',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'AYAM ULEG TIRTASARI',
                'latitude' => '-0.9239373',
                'longitude' => '100.4436898',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'PAREWA COFFEE',
                'latitude' => '-0.9244372',
                'longitude' => '100.4409204',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'ALVANZA FOOD COURT',
                'latitude' => '-0.9257238',
                'longitude' => '100.4360847',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'CAFE PRESIDENT',
                'latitude' => '-0.9354278',
                'longitude' => '100.3881861',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'MARTABAK DJOERAGAN A.YANI',
                'latitude' => '-0.9429956',
                'longitude' => '100.3569189',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'O CHICKEN JATI',
                'latitude' => '-0.9421096',
                'longitude' => '100.3664787',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'ALOOHA ISLAND',
                'latitude' => '-0.9519788',
                'longitude' => '100.3532591',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'COFFEE THEORY',
                'latitude' => '-0.9585604',
                'longitude' => '100.3609798',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'BARISTO STREET BAR',
                'latitude' => '-0.933982',
                'longitude' => '100.364273',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'LALITO COFFEE BAR',
                'latitude' => '-0.9567326',
                'longitude' => '100.3545122',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'EL NINO CAFE',
                'latitude' => '-0.956815',
                'longitude' => '100.360831',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'ENAGOYA COFFEE',
                'latitude' => '-0.903825',
                'longitude' => '100.3594933',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'OPUNG WAFFLE & COFFEE',
                'latitude' => '-0.929257',
                'longitude' => '100.356032',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'BAKMI J.A',
                'latitude' => '-0.9226998',
                'longitude' => '100.3511408',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'KEDAI CISANGKUY',
                'latitude' => '-0.9288975',
                'longitude' => '100.3571068',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'ROEMAH PANCAKE',
                'latitude' => '-0.9227518',
                'longitude' => '100.3510941',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'KADAI BUN BUN',
                'latitude' => '-0.914232',
                'longitude' => '100.3502573',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'OISHII CAFE',
                'latitude' => '-0.8973888',
                'longitude' => '100.363648',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'HQ CAFE',
                'latitude' => '-0.9610606',
                'longitude' => '100.3697792',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'SPASS BOX',
                'latitude' => '-0.9243236',
                'longitude' => '100.4394529',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'MAMA OKY SEAFOOD & PEMPEK',
                'latitude' => '-0.944169',
                'longitude' => '100.356126',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'SOP IKAN BAGAN',
                'latitude' => '-0.934194',
                'longitude' => '100.3636942',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'PIZZA ALA PIZZA',
                'latitude' => '-0.9492038',
                'longitude' => '100.383786',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'TOMODACHI BAKERY & RESTO',
                'latitude' => '-0.9459542',
                'longitude' => '100.3586218',
                'location_category_id' => 7,
            ]
            ,
            [
                'name' => 'SWEETTOOTH CAFE',
                'latitude' => '-0.9341863',
                'longitude' => '100.3543862',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'CAFE 99',
                'latitude' => '-0.9334084',
                'longitude' => '100.3543221',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'ATEH PAGU CAFE & RESTO',
                'latitude' => '-0.93758',
                'longitude' => '100.35767',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'TOKO KOPI KITA JATI',
                'latitude' => '-0.9402777777777778',
                'longitude' => '100.36472222222221',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'TOKO KOPI KITA VETERAN',
                'latitude' => '-0.9394444444444444',
                'longitude' => '100.35444444444444',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'BANK NAGARI PS BARU',
                'latitude' => '-0.870976',
                'longitude' => '100.506649',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'BANK BRI PS LUBUK BUAYA',
                'latitude' => '-0.834563',
                'longitude' => '100.3274043',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'BANK BARI UJUNG GURUN',
                'latitude' => '-0.9345023',
                'longitude' => '100.3587874',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM BNI PS AMBACANG',
                'latitude' => '-0.92683',
                'longitude' => '100.3980147',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'BANK OCBC SIMPANG HARU',
                'latitude' => '-0.9448274',
                'longitude' => '100.3862871',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM BNI KURANJI',
                'latitude' => '-0.9219256',
                'longitude' => '100.3900503',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM BNI SPBU MATA AIR',
                'latitude' => '-0.9787806',
                'longitude' => '100.3810649',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM BNI SIMPANG HARU',
                'latitude' => '-0.9473391',
                'longitude' => '100.3809811',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM BNI PARAK KARAKAH',
                'latitude' => '-0.941073',
                'longitude' => '100.381253',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM BNI SAWAHAN',
                'latitude' => '-0.943761',
                'longitude' => '100.372139',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM BNI SPBU PALAPA',
                'latitude' => '-0.773588',
                'longitude' => '100.314422',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM BNI DRIVE THRU',
                'latitude' => '-0.9547612',
                'longitude' => '100.35986',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'BANK BCA KAMP. OLO',
                'latitude' => '-0.948618',
                'longitude' => '100.3549661',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM BNI IBNU SINA',
                'latitude' => '-0.915593',
                'longitude' => '100.364083',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'BANK CIMB NIAGA',
                'latitude' => '-0.9514591',
                'longitude' => '100.3556523',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'BANK MANDIRI PAUH',
                'latitude' => '-0.940962',
                'longitude' => '100.400253',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'MAYBANK KAMP. OLO',
                'latitude' => '-0.9455555555555556 ',
                'longitude' => '100.35499999999999',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'PANIN BANK LUBUK BEGALUNG',
                'latitude' => '-0.9553448',
                'longitude' => '100.4023214',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'BANK MANDIRI SYARIAH',
                'latitude' => '-0.9610897',
                'longitude' => '100.3940089',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM DANAMON SPBU BANDAR BUAT',
                'latitude' => '-0.949319',
                'longitude' => '100.433817',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'OCBC NISP ANDALAS',
                'latitude' => '-0.9448274',
                'longitude' => '100.386287',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'BANK SINARMAS MARAPALAM',
                'latitude' => '-0.9491344',
                'longitude' => '100.3837471',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM DANAMON SUDIRMAN',
                'latitude' => '-0.9426014',
                'longitude' => '100.3625862',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM DANAMON PLAZA ANDALAS',
                'latitude' => '-0.950262',
                'longitude' => '100.355631',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'BANK PERMATA PONDOK',
                'latitude' => '-0.9571176',
                'longitude' => '100.3610871',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM BNI RS SEMEN PADANG',
                'latitude' => '-0.94153',
                'longitude' => '100.399575',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'DANAMON GAJAH MADA',
                'latitude' => '-0.9015277',
                'longitude' => '100.3631377',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'BANK BTN SITEBA',
                'latitude' => '-0.8990198',
                'longitude' => '100.3705519',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'PANIN BANK PONDOK',
                'latitude' => '-0.9571175',
                'longitude' => '100.3610872',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'BANK SYARIAH MANDIRI ULAK KARANG',
                'latitude' => '-0.9151974',
                'longitude' => '100.3500175',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'BANK DANAMON S. PARMAN',
                'latitude' => '-0.9150688',
                'longitude' => '100.3499952',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM BNI DOLBI',
                'latitude' => '-0.9549043',
                'longitude' => '100.3596746',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'BANK  NAGARI INDARUNG',
                'latitude' => '-0.9490801',
                'longitude' => '100.4351633',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM BNI SUNGAI SAPIH',
                'latitude' => '-0.948254',
                'longitude' => '100.418586',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'ATM MANDIRI IMAM BONJOL',
                'latitude' => '-0.951546',
                'longitude' => '100.3639',
                'location_category_id' => 6,
            ]
            ,
            [
                'name' => 'AIRO CAFE & RESTO',
                'latitude' => '-0.9264608',
                'longitude' => '100.4379958',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => "EL'S CAFE",
                'latitude' => '-0.961545',
                'longitude' => '100.354621',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'GOLDEN CAFE',
                'latitude' => '-0.943321111111',
                'longitude' => '100.376851111',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'RAJA MINAS',
                'latitude' => '-0.8862298',
                'longitude' => '100.3860448',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'DOO DOO',
                'latitude' => '-0.96021',
                'longitude' => '100.35586',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'MOKKO FACTORY PLAZA ANDALAS',
                'latitude' => '-0.9505136',
                'longitude' => '100.3557416',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'TAMAN PALEM RESTO & CAFE',
                'latitude' => '-0.9797237',
                'longitude' => '100.3739694',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'KFC AXANA HOTEL',
                'latitude' => '-0.954566436389',
                'longitude' => '100.358780575',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'MIE ACEH LAPAI',
                'latitude' => '-0.904829573759',
                'longitude' => '100.357840574',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'THE KAFE',
                'latitude' => '-0.96142',
                'longitude' => '100.35448',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'KEBAB DARA',
                'latitude' => '-0.935864828098',
                'longitude' => '100.354520589',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'HD RESTO',
                'latitude' => '-0.955889',
                'longitude' => '100.3607112',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => "HAUS'S TEA JUANDA",
                'latitude' => '-0.928401449812',
                'longitude' => '100.351985197',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'NYAM AN CAFE',
                'latitude' => '-0.935020628',
                'longitude' => '100.366030845',
                'location_category_id' => 3,
            ]
            ,
            [
                'name' => 'MANDYS CAFE',
                'latitude' => '-0.9579905',
                'longitude' => '100.3555198',
                'location_category_id' => 3,
            ]
            
        ]);
    }
}
