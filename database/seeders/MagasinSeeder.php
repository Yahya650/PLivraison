<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Magasin;
use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class MagasinSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 0; $i < 3; $i++) {
                $name = $faker->company;
                $magasin = Magasin::create([
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => $faker->paragraph,
                    'category_id' => $category->id,
                ]);

                $imageUrl = 'https://placehold.co/300x300.png?text=Magasin+' . urlencode($magasin->name);
                $magasin->addAttachmentFromLink($imageUrl); // from HasAttachment trait
            }
        }
    }
}
