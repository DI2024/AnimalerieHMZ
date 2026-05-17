-- =====================================================
-- MISE À JOUR DES PRODUITS - Version SAFE
-- AnimalerieHMZ - Compatible phpMyAdmin
-- =====================================================

-- Désactiver les vérifications de clés étrangères
SET FOREIGN_KEY_CHECKS = 0;

-- =====================================================
-- 1. SUPPRESSION DES ANCIENNES DONNÉES
-- =====================================================

-- Supprimer les anciens produits
DELETE FROM `products`;

-- Réinitialiser l'auto-increment
ALTER TABLE `products` AUTO_INCREMENT = 1;

-- Supprimer les anciennes sous-catégories
DELETE FROM `sub_categories`;

-- Réinitialiser l'auto-increment
ALTER TABLE `sub_categories` AUTO_INCREMENT = 1;

-- =====================================================
-- 2. MISE À JOUR DES SOUS-CATÉGORIES
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

-- =====================================================
-- 3. INSERTION DES NOUVEAUX PRODUITS - CHIENS
-- =====================================================

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `name`, `slug`, `description`, `short_description`, `price`, `price_old`, `stock`, `sku`, `image`, `is_active`, `is_new`, `is_bestseller`, `is_featured`, `discount_percentage`, `rating`, `review_count`, `created_at`, `updated_at`) VALUES

-- Croquettes pour chien
(1, 1, 1, 'Pro Plan Adult Light Sterilised Chicken 3kg', 'pro-plan-adult-light-sterilised-chicken-3kg', 'Croquettes Pro Plan pour chiens adultes stérilisés avec poulet. Formule légère pour maintenir un poids optimal.', 'Croquettes légères pour chiens stérilisés', 42.99, 49.99, 45, 'CHIEN-CRO-001', 'images/products/img_product_chien/07613035123779_C1L1_ProPlanDogALLSIZESADULTLIGHTSTERILISEDChicken3kg_43743769_5d9befbb-1605-4c4e-a33d-57b13bcc4cc6_800x-300x300.webp', 1, 0, 1, 1, 14, 4.7, 89, NOW(), NOW()),

(2, 1, 1, 'Hills Science Plan Adult', 'hills-science-plan-adult', 'Nutrition scientifiquement formulée pour les chiens adultes. Ingrédients de haute qualité pour une santé optimale.', 'Nutrition scientifique pour chiens adultes', 54.99, 64.99, 38, 'CHIEN-CRO-002', 'images/products/img_product_chien/384029_494696_107507_pla_hills_hs_01_8.jpg', 1, 1, 1, 1, 15, 4.8, 124, NOW(), NOW()),

(3, 1, 1, 'Royal Canin Giant Adult Bonus Bag', 'royal-canin-giant-adult-bonus-bag', 'Croquettes spécialement formulées pour les chiens de très grande taille. Soutient les articulations et la digestion.', 'Pour chiens de très grande taille', 68.99, 79.99, 28, 'CHIEN-CRO-003', 'images/products/img_product_chien/456900_pla_royal_canin_giant_adult_bonusbag_9.jpg', 1, 0, 1, 0, 14, 4.6, 67, NOW(), NOW()),

(4, 1, 1, 'Eukanuba Premium Large & Giant Breed 15kg', 'eukanuba-premium-large-giant-breed-15kg', 'Nutrition premium pour chiens de grande et très grande taille. Riche en protéines de poulet.', 'Premium pour grandes races', 72.99, NULL, 32, 'CHIEN-CRO-004', 'images/products/img_product_chien/609711_pla_eukanuba_premium_nutrition_adult_large_giant_breed_huhn_15kg_2.jpg', 1, 1, 0, 1, 0, 4.9, 156, NOW(), NOW()),

(5, 1, 1, 'Purina Pro Plan Medium Adult Sensitive Skin 7kg', 'purina-pro-plan-medium-sensitive-skin-7kg', 'Croquettes pour chiens de taille moyenne avec peau sensible. Formule OptiDerma pour une peau saine.', 'Pour peaux sensibles', 48.99, 55.99, 41, 'CHIEN-CRO-005', 'images/products/img_product_chien/99204_pla_purina_proplan_medium_adult_sensitiveskin_optiderma_7kg_hs_01_5.jpg', 1, 0, 1, 0, 13, 4.7, 93, NOW(), NOW()),

-- Accessoires chien
(6, 1, 3, 'Gamelle Break Reserve 15L Nordic Sky', 'gamelle-break-reserve-15l-nordic-sky', 'Gamelle automatique avec réserve d\'eau de 15 litres. Design moderne Nordic Sky.', 'Gamelle automatique 15L', 34.99, 42.99, 25, 'CHIEN-ACC-001', 'images/products/img_product_chien/BREAK-RESERVE-15LT-ACQUA-NORDIC-SKY-04206-300x300.jpg', 1, 1, 0, 0, 19, 4.5, 48, NOW(), NOW()),

(7, 1, 3, 'Laisse Flexi Classic S Cord 5m Bleu', 'laisse-flexi-classic-s-cord-5m-bleu', 'Laisse enrouleur Flexi Classic avec cordon de 5 mètres. Idéale pour petits chiens.', 'Laisse enrouleur 5m', 24.99, 29.99, 52, 'CHIEN-ACC-002', 'images/products/img_product_chien/flexi_Classic_S_Cord_5m_blue-300x300.jpg', 1, 0, 1, 0, 17, 4.6, 78, NOW(), NOW()),

(8, 1, 3, 'Harnais Confort Réglable M Moov Noir', 'harnais-confort-reglable-m-moov-noir', 'Harnais confortable et réglable taille M. Design Moov en noir élégant.', 'Harnais réglable confort', 19.99, 24.99, 48, 'CHIEN-ACC-003', 'images/products/img_product_chien/harnais-conf-reg-m-moov-noir-300x300.jpg', 1, 0, 0, 0, 20, 4.4, 62, NOW(), NOW()),

(9, 1, 3, 'Jouet Interactif pour Chien', 'jouet-interactif-chien', 'Jouet interactif stimulant pour chien. Favorise l\'activité mentale et physique.', 'Jouet stimulant', 15.99, NULL, 67, 'CHIEN-ACC-004', 'images/products/img_product_chien/telechargement-2025-05-03T101138.052.jpg', 1, 1, 0, 0, 0, 4.3, 41, NOW(), NOW()),

(10, 1, 3, 'Collier Ajustable Premium', 'collier-ajustable-premium', 'Collier ajustable de qualité premium. Confortable et résistant.', 'Collier premium', 12.99, 16.99, 73, 'CHIEN-ACC-005', 'images/products/img_product_chien/telechargement.jpg', 1, 0, 0, 0, 24, 4.5, 55, NOW(), NOW()),

(11, 1, 3, 'Coussin Confort pour Chien', 'coussin-confort-chien', 'Coussin moelleux et confortable pour le repos de votre chien. Déhoussable et lavable.', 'Coussin moelleux', 29.99, 39.99, 34, 'CHIEN-ACC-006', 'images/products/img_product_chien/w400 8.jpg', 1, 0, 1, 0, 25, 4.7, 88, NOW(), NOW()),

(12, 1, 3, 'Sac de Transport Confort', 'sac-transport-confort-chien', 'Sac de transport confortable et sécurisé pour petits chiens. Ventilation optimale.', 'Sac de transport', 44.99, NULL, 19, 'CHIEN-ACC-007', 'images/products/img_product_chien/659193_cbb512588dd044959f8fcba3a2030b23~mv2.avif', 1, 1, 0, 1, 0, 4.6, 37, NOW(), NOW());

-- Réactiver les vérifications de clés étrangères
SET FOREIGN_KEY_CHECKS = 1;
