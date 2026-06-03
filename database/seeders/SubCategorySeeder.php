<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubCategory;

class SubCategorySeeder extends Seeder
{
    public function run(): void
    {
        $subCategories = [
            // Chiens (category_id: 1)
            [
                'id' => 1,
                'category_id' => 1,
                'name' => 'Croquettes pour chien',
                'slug' => 'croquettes-chien',
                'is_active' => true,
            ],
            [
                'id' => 2,
                'category_id' => 1,
                'name' => 'Jouets pour chien',
                'slug' => 'jouets-chien',
                'is_active' => true,
            ],
            [
                'id' => 3,
                'category_id' => 1,
                'name' => 'Accessoires chien',
                'slug' => 'accessoires-chien',
                'is_active' => true,
            ],
            [
                'id' => 4,
                'category_id' => 1,
                'name' => 'Soins & Hygiène chien',
                'slug' => 'soins-chien',
                'is_active' => true,
            ],
            
            // Chats (category_id: 2)
            [
                'id' => 5,
                'category_id' => 2,
                'name' => 'Croquettes pour chat',
                'slug' => 'croquettes-chat',
                'is_active' => true,
            ],
            [
                'id' => 6,
                'category_id' => 2,
                'name' => 'Litière',
                'slug' => 'litiere',
                'is_active' => true,
            ],
            [
                'id' => 7,
                'category_id' => 2,
                'name' => 'Arbres à chat',
                'slug' => 'arbres-chat',
                'is_active' => true,
            ],
            [
                'id' => 8,
                'category_id' => 2,
                'name' => 'Jouets pour chat',
                'slug' => 'jouets-chat',
                'is_active' => true,
            ],
            
            // Oiseaux (category_id: 3)
            [
                'id' => 9,
                'category_id' => 3,
                'name' => 'Cages & Volières',
                'slug' => 'cages-volieres',
                'is_active' => true,
            ],
            [
                'id' => 10,
                'category_id' => 3,
                'name' => 'Graines & Nutrition',
                'slug' => 'graines-oiseaux',
                'is_active' => true,
            ],
            [
                'id' => 11,
                'category_id' => 3,
                'name' => 'Jouets & Balançoires',
                'slug' => 'jouets-oiseaux',
                'is_active' => true,
            ],
            
            // Poissons (category_id: 4)
            [
                'id' => 12,
                'category_id' => 4,
                'name' => 'Aquariums',
                'slug' => 'aquariums',
                'is_active' => true,
            ],
            [
                'id' => 13,
                'category_id' => 4,
                'name' => 'Nourriture poissons',
                'slug' => 'nourriture-poissons',
                'is_active' => true,
            ],
            [
                'id' => 14,
                'category_id' => 4,
                'name' => 'Accessoires aquarium',
                'slug' => 'accessoires-aquarium',
                'is_active' => true,
            ],
            
            // Pigeons (category_id: 5)
            [
                'id' => 15,
                'category_id' => 5,
                'name' => 'Graines pigeons',
                'slug' => 'graines-pigeons',
                'is_active' => true,
            ],
            [
                'id' => 16,
                'category_id' => 5,
                'name' => 'Cages pigeons',
                'slug' => 'cages-pigeons',
                'is_active' => true,
            ],
            [
                'id' => 17,
                'category_id' => 5,
                'name' => 'Compléments alimentaires',
                'slug' => 'complements-alimentaires',
                'is_active' => true,
            ],
        ];

        foreach ($subCategories as $subCategory) {
            SubCategory::updateOrCreate(['id' => $subCategory['id']], $subCategory);
        }
    }
}
