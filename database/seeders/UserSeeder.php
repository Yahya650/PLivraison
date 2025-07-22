<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Create 1 admin
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'phone_number' => '0700000000',
            'adresse' => 'Admin Street',
            'quartier' => 'Centre',
            'province' => 'Rabat',
            'password' => Hash::make('password'),
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
