<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name' => 'Électronique', 'slug' => 'electronique', 'description' => 'Produits électroniques.'],
            ['name' => 'Maison', 'slug' => 'maison', 'description' => 'Articles de maison.'],
        ]);
    }
}
