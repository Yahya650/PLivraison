<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\CommandProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommandProductSeeder extends Seeder
{
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        CommandProduct::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


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
                    'total_remise' => $qty * $prix_remise,
                    'unit_price' => $produit->price,
                    'total' => $qty * $produit->price,
                ]);
            }
        }
    }
}