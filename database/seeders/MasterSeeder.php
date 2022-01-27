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
        DB::table('types')->insert([
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
    }
}
