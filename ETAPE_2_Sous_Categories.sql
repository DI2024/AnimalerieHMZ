-- =====================================================
-- ÉTAPE 2: SOUS-CATÉGORIES
-- Créer les 15 nouvelles sous-catégories
-- =====================================================

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `slug`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
-- Chiens (category_id = 1)
(1, 1, 'Croquettes pour chien', 'croquettes-chien', NULL, 1, NOW(), NOW()),
(2, 1, 'Cages pour chien', 'cages-chien', NULL, 1, NOW(), NOW()),
(3, 1, 'Accessoires chien', 'accessoires-chien', NULL, 1, NOW(), NOW()),

-- Chats (category_id = 2)
(4, 2, 'Cage de transport', 'cage-transport', NULL, 1, NOW(), NOW()),
(5, 2, 'Croquettes pour chat', 'croquettes-chat', NULL, 1, NOW(), NOW()),
(6, 2, 'Accessoires', 'accessoires-chat', NULL, 1, NOW(), NOW()),

-- Oiseaux (category_id = 3)
(7, 3, 'Cages & Volières', 'cages-volieres', NULL, 1, NOW(), NOW()),
(8, 3, 'Graines & Nutrition', 'graines-nutrition', NULL, 1, NOW(), NOW()),
(9, 3, 'Accessoires', 'accessoires-oiseaux', NULL, 1, NOW(), NOW()),

-- Poissons (category_id = 4)
(10, 4, 'Aquariums', 'aquariums', NULL, 1, NOW(), NOW()),
(11, 4, 'Nourriture poissons', 'nourriture-poissons', NULL, 1, NOW(), NOW()),
(12, 4, 'Accessoires aquarium', 'accessoires-aquarium', NULL, 1, NOW(), NOW()),

-- Pigeons (category_id = 5)
(13, 5, 'Cages & Volières', 'cages-volieres-pigeons', NULL, 1, NOW(), NOW()),
(14, 5, 'Graines & Nutrition', 'graines-nutrition-pigeons', NULL, 1, NOW(), NOW()),
(15, 5, 'Accessoires', 'accessoires-pigeons', NULL, 1, NOW(), NOW());

-- ✅ ÉTAPE 2 TERMINÉE
-- Passez à ETAPE_3_Produits.sql
