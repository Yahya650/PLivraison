<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        ProductCategory::insert([
            ['name' => 'Smartphones', 'slug' => 'smartphones', 'description' => 'Téléphones intelligents.'],
            ['name' => 'TV', 'slug' => 'tv', 'description' => 'Téléviseurs.'],
        ]);
    }
}
