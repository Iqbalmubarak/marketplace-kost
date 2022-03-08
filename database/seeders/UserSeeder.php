<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('users')->insert([
            [
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'password' => Hash::make('password'),
            ],
            [
                'email' => 'owner@owner.com',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'password' => Hash::make('password'),
            ],
            [
                'email' => 'customer@customer.com',
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'password' => Hash::make('password'),
            ]
        ]);

        DB::table('admins')->insert([
            'first_name' => 'Super',
            'last_name' => 'Administrator',
            'handphone' => $faker->phoneNumber(),
            'address' => $faker->address(),
            'user_id' => 1,
        ]);

        DB::table('kost_owners')->insert([
            'first_name' => 'Kost',
            'last_name' => 'Owner',
            'handphone' => $faker->phoneNumber(),
            'address' => $faker->address(),
            'user_id' => 2,
        ]);

        DB::table('kost_seekers')->insert([
            'first_name' => 'Kost',
            'last_name' => 'Seeker',
            'handphone' => $faker->phoneNumber(),
            'address' => $faker->address(),
            'user_id' => 3,
        ]);
    }
}
