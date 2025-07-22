<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $name = $faker->unique()->word;
            $pc = ProductCategory::create([
                'name' => ucfirst($name),
                'slug' => Str::slug($name),
                'description' => $faker->sentence,
            ]);

            $imageUrl = 'https://placehold.co/300x300.png?text=PC+' . urlencode($pc->name);
            $pc->addAttachmentFromLink($imageUrl);
        }
    }
}
