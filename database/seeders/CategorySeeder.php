<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Chiens',
                'slug' => 'chiens',
                'icon' => 'pets',
                'image' => 'images/img_category/cat_chien.webp',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Chats',
                'slug' => 'chats',
                'icon' => 'pets',
                'image' => 'images/img_category/cat_chat.webp',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'id' => 3,
                'name' => 'Oiseaux',
                'slug' => 'oiseaux',
                'icon' => 'flutter',
                'image' => 'images/img_category/cat_oiseau.webp',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'id' => 4,
                'name' => 'Poissons',
                'slug' => 'poissons',
                'icon' => 'water_drop',
                'image' => 'images/img_category/cat_poisson.png',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'id' => 5,
                'name' => 'Pigeons',
                'slug' => 'pigeons',
                'icon' => 'flutter',
                'image' => 'images/img_category/cat_pigeon.png',
                'order' => 1,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::updateOrCreate(['id' => $category['id']], $category);
        }
    }
}
