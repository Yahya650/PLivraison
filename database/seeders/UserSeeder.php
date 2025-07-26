<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $faker = Faker::create();

        // Create 1 admin
        $admin = User::create([
            'first_name' => 'Youssef',
            'last_name' => 'Chamlal',
            'email' => 'youssefchamlal@gmail.com',
            'phone_number' => '0700000000',
            'adresse' => 'Admin Street',
            'quartier' => 'Centre',
            'province' => 'Rabat',
            'password' => Hash::make('ysfcrm@1999@'),
        ]);
        $admin->assignRole('admin');

        // Create 20 clients
        for ($i = 0; $i < 20; $i++) {
            $client = User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->phoneNumber,
                'adresse' => $faker->streetAddress,
                'quartier' => $faker->citySuffix,
                'province' => $faker->state,
                'password' => Hash::make('password'),
            ]);
            $client->assignRole('client');
        }
    }
}
