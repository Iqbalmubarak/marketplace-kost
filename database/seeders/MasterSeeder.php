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
