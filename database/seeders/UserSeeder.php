<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name' => 'Yahya',
            'last_name' => 'Hamdy',
            'email' => 'yahya@example.com',
            'phone_number' => '0600000000',
            'adresse' => 'Hay Mohammadi',
            'quartier' => 'Sidi Moumen',
            'province' => 'Casablanca',
            'password' => Hash::make('password'),
        ]);
    }
}
