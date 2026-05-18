<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlide;

class HeroSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing slides
        HeroSlide::truncate();
        
        $slides = [
            // Slide 1: Main hero image (left side) - NO TEXT, just button
            [
                'title' => null,
                'subtitle' => null,
                'image' => 'images/sec her.png', // Local image path
                'button_text' => 'Découvrir la boutique',
                'button_link' => '/products',
                'order' => 1,
                'is_active' => true,
            ],
            // Slide 2: Dog offer (right top)
            [
                'title' => 'Gamme Chien',
                'subtitle' => '-25%',
                'image' => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=800&q=80',
                'button_text' => null,
                'button_link' => '/products?category=chiens',
                'order' => 2,
                'is_active' => true,
            ],
            // Slide 3: Cat offer (right bottom)
            [
                'title' => 'Accessoires Chat',
                'subtitle' => '-15%',
                'image' => 'https://images.unsplash.com/photo-1574158622682-e40e69881006?w=800&q=80',
                'button_text' => null,
                'button_link' => '/products?category=chats',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::create($slide);
        }
    }
}
