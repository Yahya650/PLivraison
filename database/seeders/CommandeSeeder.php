<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commande;
use App\Models\User;

class CommandeSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        Commande::insert([
            [
                'client_id' => $user->id,
                'quartier' => 'Centre ville',
                'adresse' => '123 rue principale',
                'province' => 'Rabat',
                'total' => 1200,
                'delivery_price' => 50,
                'is_valid' => true,
            ]
        ]);
    }
}
