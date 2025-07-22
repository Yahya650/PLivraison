<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;
use App\Models\Magasin;
use App\Models\ProductCategory;

class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        $magasin = Magasin::first();
        $productCategory = ProductCategory::first();

        Produit::insert([
            [
                'name' => 'iPhone 14',
                'slug' => 'iphone-14',
                'description' => 'Dernier modèle Apple.',
                'price' => 9999,
                'compare_price' => 10999,
                'magasin_id' => $magasin->id,
                'category_id' => $productCategory->id,
            ]
        ]);
    }
}
