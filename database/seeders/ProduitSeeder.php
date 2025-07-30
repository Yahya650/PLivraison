<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;
use App\Models\Magasin;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $magasins = Magasin::all();
        $productCategories = ProductCategory::all();

        foreach ($magasins as $magasin) {
            for ($i = 0; $i < 20; $i++) {
                $name = $faker->words(2, true);
                $category = $productCategories->random();

                $produit = Produit::create([
                    'name' => ucfirst($name),
                    'slug' => Str::slug($name),
                    'description' => $faker->paragraph,
                    'price' => $faker->numberBetween(100, 5000),
                    'compare_price' => $faker->numberBetween(5000, 10000),
                    'magasin_id' => $magasin?->id,
                    'category_id' => $category?->id,
                ]);

                $imageUrl = 'https://placehold.co/300x300.png?text=Produit+' . urlencode($produit->name);
                $produit->addAttachmentFromLink($imageUrl);
            }
        }
    }
}
