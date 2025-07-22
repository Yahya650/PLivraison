<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CommandProduct;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\Magasin;
use App\Models\Category;
use App\Models\ProductCategory;

class CommandProductSeeder extends Seeder
{
    public function run(): void
    {
        $commande = Commande::first();
        $produit = Produit::first();
        $magasin = Magasin::first();
        $category = Category::first();
        $productCategory = ProductCategory::first();

        CommandProduct::create([
            'command_id' => $commande->id,
            'product_id' => $produit->id,
            'magasin_id' => $magasin->id,
            'category_id' => $category->id,
            'product_category_id' => $productCategory->id,
            'quantity' => 2,
            'remise' => 100,
            'prix_remise' => 900,
            'total' => 1800,
        ]);
    }
}
