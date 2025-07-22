<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Magasin;
use App\Models\Category;

class MagasinSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::first();

        Magasin::insert([
            [
                'name' => 'Magasin Central',
                'slug' => 'magasin-central',
                'description' => 'Magasin principal.',
                'category_id' => $category->id,
            ]
        ]);
    }
}
