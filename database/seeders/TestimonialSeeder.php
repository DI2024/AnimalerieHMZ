<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing testimonials
        Testimonial::truncate();
        
        $testimonials = [
            [
                'name' => 'Sophie Martin',
                'role' => 'Cliente vérifiée',
                'content' => 'Excellent service et produits de qualité. Mon chat adore ses nouvelles croquettes Royal Canin!',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop&crop=faces',
                'rating' => 5,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Marc Dubois',
                'role' => 'Client vérifié',
                'content' => 'Livraison rapide et emballage soigné. La volière est magnifique et mes oiseaux sont ravis!',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=faces',
                'rating' => 5,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Laura Petit',
                'role' => 'Cliente vérifiée',
                'content' => 'Super boutique! Les prix sont compétitifs et le service client est très réactif. Je recommande!',
                'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=faces',
                'rating' => 5,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Ahmed Alaoui',
                'role' => 'Propriétaire de chien',
                'content' => 'Très satisfait de mon achat! Les jouets pour chien sont de très bonne qualité et mon Golden Retriever les adore.',
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=100&h=100&fit=crop&crop=faces',
                'rating' => 5,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Fatima Zahra',
                'role' => 'Éleveuse de pigeons',
                'content' => 'Excellent choix de graines et accessoires pour pigeons. Les prix sont raisonnables et la qualité est au rendez-vous.',
                'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&h=100&fit=crop&crop=faces',
                'rating' => 4,
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Youssef Bennani',
                'role' => 'Propriétaire d\'aquarium',
                'content' => 'Parfait pour les amateurs de poissons! Large gamme de produits aquatiques et conseils professionnels.',
                'avatar' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&h=100&fit=crop&crop=faces',
                'rating' => 5,
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
