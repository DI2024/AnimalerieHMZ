<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // CHIENS - Croquettes
            [
                'category_id' => 1, 'subcategory_id' => 1,
                'name' => 'Croquettes Royal Canin Medium Adult',
                'slug' => 'croquettes-royal-canin-medium-adult',
                'description' => 'Aliment complet pour chiens adultes de taille moyenne (11 à 25 kg) à partir de 12 mois.',
                'short_description' => 'Nutrition équilibrée pour chiens moyens',
                'price' => 45.99, 'price_old' => 52.99, 'stock' => 50,
                'sku' => 'RC-MED-001', 'is_active' => true, 'is_bestseller' => true,
                'discount_percentage' => 13, 'rating' => 4.8, 'review_count' => 127,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A',
            ],
            [
                'category_id' => 1, 'subcategory_id' => 1,
                'name' => 'Croquettes Premium Vitality 15kg',
                'slug' => 'croquettes-premium-vitality-15kg',
                'description' => 'Croquettes premium pour chiens actifs avec poulet frais et légumes.',
                'short_description' => 'Haute énergie pour chiens actifs',
                'price' => 38.50, 'price_old' => 45.00, 'stock' => 35,
                'sku' => 'VIT-DOG-15', 'is_active' => true, 'is_new' => true,
                'discount_percentage' => 14, 'rating' => 4.6, 'review_count' => 89,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A',
            ],
            
            // CHIENS - Jouets
            [
                'category_id' => 1, 'subcategory_id' => 2,
                'name' => 'Jouet Interactif Kong Classic',
                'slug' => 'jouet-interactif-kong-classic',
                'description' => 'Jouet résistant en caoutchouc naturel pour chiens. Idéal pour le jeu et la mastication.',
                'short_description' => 'Jouet indestructible pour chiens',
                'price' => 12.90, 'price_old' => null, 'stock' => 80,
                'sku' => 'KONG-CL-M', 'is_active' => true, 'is_featured' => true,
                'discount_percentage' => 0, 'rating' => 4.9, 'review_count' => 234,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAx-idpF478hzoaaBIUHLUhWNsH922i7ik4yZ4LO2wsFxOXaaH0vCZmjypSNPW30ShDtsjn1yqpnEmIm97kK9VU2iG19ZN0Q_Bc01sr9tKItR4y8LpQcFN8bjT3Gitg7YSmWhoFXxNmov5igt9yvFvKOsFHinogyokHHUyUpIb_jSnIM_foyONoR63ppruzz3Kjj8Q09IM4NcqFWBLcnyUiLmE9JLA5fHEoOWGVZ_SAE5fIRWwLEjQDLqOAa20bHz9MgNHftU0xCdA',
            ],
            
            // CHATS - Croquettes
            [
                'category_id' => 2, 'subcategory_id' => 5,
                'name' => 'Croquettes Royal Canin Sterilised 10kg',
                'slug' => 'croquettes-royal-canin-sterilised-10kg',
                'description' => 'Aliment complet pour chats stérilisés. Aide au maintien du poids idéal.',
                'short_description' => 'Spécial chats stérilisés',
                'price' => 54.99, 'price_old' => 62.99, 'stock' => 45,
                'sku' => 'RC-CAT-ST10', 'is_active' => true, 'is_bestseller' => true,
                'discount_percentage' => 13, 'rating' => 4.7, 'review_count' => 156,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A',
            ],
            
            // CHATS - Litière
            [
                'category_id' => 2, 'subcategory_id' => 6,
                'name' => 'Litière Agglomérante Premium 15L',
                'slug' => 'litiere-agglomerante-premium-15l',
                'description' => 'Litière agglomérante ultra-absorbante avec contrôle des odeurs. 100% naturelle.',
                'short_description' => 'Contrôle des odeurs 30 jours',
                'price' => 18.90, 'price_old' => 22.90, 'stock' => 120,
                'sku' => 'LIT-PREM-15', 'is_active' => true, 'is_bestseller' => true,
                'discount_percentage' => 17, 'rating' => 4.5, 'review_count' => 98,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCIgvNYgMNUX5dDqy9Ji_Xgxifl2RujROG1NGbtl-Mih2srLRpvr-ALYegp6tS66MyQnjGxpl4olvyw9hCamdiCkFivkf896OtEa385MGru_6Q019kTiqpbFtKgGowNvA-C_TqIx5l22H157bz1Kcvgw2kJCLW2ErRaYX-3bMGsSF7HTL6rLtQi-kLHDBGF2tudqZjjiCzdZKJopX7DanJL1aNaI1FjSwc8AKJscFoxJWMwFwX9dD2EIjNlqIw5XwkaHGF8gSSmNmY',
            ],
            
            // CHATS - Arbres à chat
            [
                'category_id' => 2, 'subcategory_id' => 7,
                'name' => 'Arbre à Chat Oasis 120cm',
                'slug' => 'arbre-a-chat-oasis-120cm',
                'description' => 'Arbre à chat avec griffoirs, plateformes et hamac. Structure stable et design moderne.',
                'short_description' => 'Arbre à chat 3 niveaux',
                'price' => 79.00, 'price_old' => 99.00, 'stock' => 25,
                'sku' => 'TREE-OAS-120', 'is_active' => true, 'is_featured' => true,
                'discount_percentage' => 20, 'rating' => 4.8, 'review_count' => 67,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCf13j3hn9fIiDpqfSIlA9_FGHwtCP_eI4a3XaBc8PRii4W1Xpek9f00xWvJE9IUbjlRXdu8-LuGY5LKKcih9AXo-YkFHi7qYjMJd47ArOAqqoOoWn9leyXVBBQuw1n3PCI2GBC55QG4gMu1HBDQkpsFbkZS_WJ0_q_vf2YXJFxlB0HrVo3E1bjSgW_uyEks74dsBVn7FKDLKCduZjyu-6-aJScVW_a1dPEPCDq1rgNwr8q4NCWWeiWomcEutvwHdKGXHPcFYJEMAw',
            ],
            
            // OISEAUX - Cages
            [
                'category_id' => 3, 'subcategory_id' => 9,
                'name' => 'Volière Design White Edition',
                'slug' => 'voliere-design-white-edition',
                'description' => 'Grande volière élégante avec mangeoires et perchoirs. Facile à nettoyer.',
                'short_description' => 'Volière spacieuse et design',
                'price' => 129.00, 'price_old' => 159.00, 'stock' => 15,
                'sku' => 'VOL-WHT-L', 'is_active' => true, 'is_featured' => true,
                'discount_percentage' => 19, 'rating' => 4.6, 'review_count' => 43,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw',
            ],
            
            // OISEAUX - Graines
            [
                'category_id' => 3, 'subcategory_id' => 10,
                'name' => 'Mélange Graines Premium 5kg',
                'slug' => 'melange-graines-premium-5kg',
                'description' => 'Mélange équilibré de graines pour oiseaux. Riche en vitamines et minéraux.',
                'short_description' => 'Nutrition complète pour oiseaux',
                'price' => 24.50, 'price_old' => null, 'stock' => 60,
                'sku' => 'SEED-PREM-5', 'is_active' => true, 'is_bestseller' => true,
                'discount_percentage' => 0, 'rating' => 4.7, 'review_count' => 112,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko',
            ],
            
            // OISEAUX - Jouets
            [
                'category_id' => 3, 'subcategory_id' => 11,
                'name' => 'Balançoire en Bois Naturel',
                'slug' => 'balancoire-bois-naturel',
                'description' => 'Balançoire en bois naturel non traité. Stimule l\'activité physique.',
                'short_description' => 'Jouet naturel pour oiseaux',
                'price' => 8.90, 'price_old' => null, 'stock' => 95,
                'sku' => 'SWING-NAT-S', 'is_active' => true,
                'discount_percentage' => 0, 'rating' => 4.4, 'review_count' => 56,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC4n77pofZu0M7VUhuXGR57lrTtl_tb-uNTk86gHkIkGqm1VFQc7Ht2jLvyEZKkW0AIbNxsAawhHLmTYSyIluEMqF1ZTczZNvtpUpaEaABo4njvV99IleGHi4r6DK88eCwSmUKJI6JGjFSXwyIX_a05sHUoItu8TmjYM6jQ4Qa4yXFWe19SAQJdSHxcvN0O8vOKKeF-cOkmKKYTsKwPH218RptL2fIyj5VYNURR36Np6h6wrZFTBawkN2X8PygsVeVd_OzbAr9Lpp8',
            ],
            
            // POISSONS - Aquariums
            [
                'category_id' => 4, 'subcategory_id' => 12,
                'name' => 'Aquarium Design 60L Complet',
                'slug' => 'aquarium-design-60l-complet',
                'description' => 'Aquarium complet avec filtre, éclairage LED et décoration. Prêt à l\'emploi.',
                'short_description' => 'Kit aquarium tout inclus',
                'price' => 189.00, 'price_old' => 229.00, 'stock' => 12,
                'sku' => 'AQU-60L-KIT', 'is_active' => true, 'is_new' => true,
                'discount_percentage' => 17, 'rating' => 4.8, 'review_count' => 34,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBqASyV7URQYtB7AufDQq3zsXl7XSv9FkFZ2rS7cvCY8SjFBpNtd44dmKeXIseCB9VNUADcDBsTZFb6lITNOv2FLAuO2mwJu_CqbbtFdL1nnCHvOh3gcNgP6etzuggSPuFxOHrjFd94gobAlyjJdlEbFYg-J5N8E9XGz90YLgl0NJs0XhBpPwWcq_WERVUX8hBqXIcEE5Wjyp6mSiNEde_o2uE8CHpFJxQr9iCfpJSCMSWgZ8U6B2nbcBOlsTz53qAdUrzB7JupVkA',
            ],
            
            // POISSONS - Nourriture
            [
                'category_id' => 4, 'subcategory_id' => 13,
                'name' => 'Flocons Premium Poissons Tropicaux',
                'slug' => 'flocons-premium-poissons-tropicaux',
                'description' => 'Nourriture en flocons pour poissons tropicaux. Formule enrichie en vitamines.',
                'short_description' => 'Nutrition équilibrée poissons',
                'price' => 12.90, 'price_old' => null, 'stock' => 75,
                'sku' => 'FLAKE-TROP-250', 'is_active' => true,
                'discount_percentage' => 0, 'rating' => 4.6, 'review_count' => 89,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBqASyV7URQYtB7AufDQq3zsXl7XSv9FkFZ2rS7cvCY8SjFBpNtd44dmKeXIseCB9VNUADcDBsTZFb6lITNOv2FLAuO2mwJu_CqbbtFdL1nnCHvOh3gcNgP6etzuggSPuFxOHrjFd94gobAlyjJdlEbFYg-J5N8E9XGz90YLgl0NJs0XhBpPwWcq_WERVUX8hBqXIcEE5Wjyp6mSiNEde_o2uE8CHpFJxQr9iCfpJSCMSWgZ8U6B2nbcBOlsTz53qAdUrzB7JupVkA',
            ],
            
            // PIGEONS - Graines
            [
                'category_id' => 5, 'subcategory_id' => 15,
                'name' => 'Mélange Graines Pigeons Sport 20kg',
                'slug' => 'melange-graines-pigeons-sport-20kg',
                'description' => 'Mélange spécial pour pigeons de compétition. Haute énergie.',
                'short_description' => 'Graines haute performance',
                'price' => 42.00, 'price_old' => 48.00, 'stock' => 30,
                'sku' => 'PIG-SPORT-20', 'is_active' => true,
                'discount_percentage' => 13, 'rating' => 4.7, 'review_count' => 45,
                'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko',
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
