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
                'image' => 'images/cat_chien.jpg',
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Chats',
                'slug' => 'chats',
                'icon' => 'pets',
                'image' => 'images/cat_chat.png',
                'is_active' => true,
            ],
            [
                'id' => 3,
                'name' => 'Oiseaux',
                'slug' => 'oiseaux',
                'icon' => 'flutter',
                'image' => 'images/cat_oiseaux.png',
                'is_active' => true,
            ],
            [
                'id' => 4,
                'name' => 'Poissons',
                'slug' => 'poissons',
                'icon' => 'water_drop',
                'image' => 'images/cat_poissons.png',
                'is_active' => true,
            ],
            [
                'id' => 5,
                'name' => 'Pigeons',
                'slug' => 'pigeons',
                'icon' => 'flutter',
                'image' => 'images/cat_pigeons.png.png',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::updateOrCreate(['id' => $category['id']], $category);
        }
    }
}
