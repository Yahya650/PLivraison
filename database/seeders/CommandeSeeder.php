<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commande;
use App\Models\User;
use Faker\Factory as Faker;

class CommandeSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $clients = User::role('client')->get();

        foreach ($clients as $client) {
            for ($i = 0; $i < 3; $i++) {
                Commande::create([
                    'client_id' => $client->id,
                    'quartier' => $faker->city,
                    'adresse' => $faker->streetAddress,
                    'province' => $faker->state,
                    'total' => $faker->randomFloat(2, 100, 3000),
                    'delivery_price' => $faker->randomFloat(2, 20, 100),
                    'is_valid' => $faker->boolean,
                ]);
            }
        }
    }
}
