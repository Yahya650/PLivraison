<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CommandProduct;
use Faker\Factory as Faker;

class CommandProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $commandes = \App\Models\Commande::all();
        $produits = \App\Models\Produit::all();
        $categories = \App\Models\Category::all();
        $productCategories = \App\Models\ProductCategory::all();
        $magasins = \App\Models\Magasin::all();

        foreach ($commandes as $commande) {
            for ($i = 0; $i < rand(1, 5); $i++) {
                $produit = $produits->random();
                CommandProduct::create([
                    'command_id' => $commande->id,
                    'product_id' => $produit->id,
                    'magasin_id' => $produit->magasin_id,
                    'category_id' => $categories->random()->id,
                    'product_category_id' => $productCategories->random()->id,
                    'quantity' => $qty = rand(1, 3),
                    'remise' => $discount = $faker->randomFloat(2, 0, 100),
                    'prix_remise' => $prix_remise = $produit->price - $discount,
                    'total' => $qty * $prix_remise,
                ]);
            }
        }
    }
}
