-- =====================================================
-- PRODUITS CHATS UNIQUEMENT (16 produits)
-- =====================================================
-- Utilisez ce fichier si vous avez déjà les produits Chiens
-- mais qu'il vous manque les produits Chats
-- =====================================================

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `name`, `slug`, `description`, `short_description`, `price`, `price_old`, `stock`, `sku`, `image`, `is_active`, `is_new`, `is_bestseller`, `is_featured`, `discount_percentage`, `rating`, `review_count`, `created_at`, `updated_at`) VALUES

-- =====================================================
-- CROQUETTES POUR CHAT (Sous-catégorie ID: 5)
-- =====================================================
(13, 2, 5, 'Hills Prescription Diet i/d Digestive Care 3kg', 'hills-prescription-diet-id-digestive-care-3kg', 'Aliment vétérinaire pour chats avec troubles digestifs. Formule hautement digestible.', 'Soin digestif vétérinaire', 38.99, 45.99, 28, 'CHAT-CRO-001', 'images/products/img_product_chat/242425_pla_hills_prescriptiondiet_id_digestivecare_katzenfutter_huhn_3kg_hs_01_6.jpg', 1, 0, 1, 1, 15, 4.8, 112, NOW(), NOW()),

(14, 2, 5, 'Hills Prescription Diet z/d Food Sensitivities', 'hills-prescription-diet-zd-food-sensitivities', 'Aliment hypoallergénique pour chats sensibles. Réduit les réactions alimentaires.', 'Hypoallergénique', 42.99, 49.99, 24, 'CHAT-CRO-002', 'images/products/img_product_chat/242430_242431_pla_hills_prescriptiondiet_zd_food_sensitivities_katzenfutter_original_hs_01_1.jpg', 1, 1, 0, 1, 14, 4.7, 87, NOW(), NOW()),

(15, 2, 5, 'Royal Canin Fussy Cat', 'royal-canin-fussy-cat', 'Croquettes pour chats difficiles. Appétence optimale et nutrition équilibrée.', 'Pour chats difficiles', 34.99, 39.99, 42, 'CHAT-CRO-003', 'images/products/img_product_chat/610398_610211_610214_610216_610399_pla_royal_canin_fussy_cat_1000x1000_hs_01_0.jpg', 1, 0, 1, 0, 13, 4.6, 95, NOW(), NOW()),

(16, 2, 5, 'Hills Prescription Diet Metabolic Weight Management', 'hills-prescription-diet-metabolic-weight-management', 'Gestion du poids pour chats. Formule cliniquement prouvée pour la perte de poids.', 'Gestion du poids', 46.99, 54.99, 31, 'CHAT-CRO-004', 'images/products/img_product_chat/64126_243997_70882_243996_pla_hills_prescriptiondiet_metabolic_felineweight_management_huhn_hs_02_3.jpg', 1, 0, 1, 1, 15, 4.9, 143, NOW(), NOW()),

(17, 2, 5, 'Purina Pro Plan Delicate Dinde', 'purina-pro-plan-delicate-dinde', 'Croquettes pour chats à digestion sensible. Riche en dinde de qualité.', 'Digestion sensible', 36.99, 42.99, 38, 'CHAT-CRO-005', 'images/products/img_product_chat/84311_pla_purina_proplan_delicate_reichtruthahn_hs_01_8.jpg', 1, 1, 0, 0, 14, 4.7, 76, NOW(), NOW()),

(18, 2, 5, 'Royal Canin Vet Urinary S/O Moderate Calorie', 'royal-canin-vet-urinary-so-moderate-calorie', 'Aliment vétérinaire pour la santé urinaire. Calories modérées.', 'Santé urinaire', 44.99, NULL, 26, 'CHAT-CRO-006', 'images/products/img_product_chat/rc_vet_dry_caturinarysomc_mv_eretailkit_de_de_7.jpg', 1, 0, 1, 1, 0, 4.8, 98, NOW(), NOW()),

(19, 2, 5, 'Croquettes Premium Chat Adulte', 'croquettes-premium-chat-adulte', 'Croquettes premium pour chats adultes. Nutrition complète et équilibrée.', 'Premium chat adulte', 29.99, 34.99, 55, 'CHAT-CRO-007', 'images/products/img_product_chat/w400.jpg', 1, 0, 0, 0, 14, 4.5, 64, NOW(), NOW()),

-- =====================================================
-- ACCESSOIRES CHAT (Sous-catégorie ID: 6)
-- =====================================================
(20, 2, 6, 'Arbre à Chat Cat Flower', 'arbre-chat-cat-flower', 'Arbre à chat design avec motif fleur. Plusieurs niveaux et griffoirs.', 'Arbre à chat design', 89.99, 109.99, 18, 'CHAT-ACC-001', 'images/products/img_product_chat/63085_PLA_Kratzbaum_Cat_Flower_1_6.jpg', 1, 1, 1, 1, 18, 4.7, 142, NOW(), NOW()),

(21, 2, 6, 'Tour Pliable pour Chat', 'tour-pliable-chat', 'Tour de jeu pliable pour chat. Facile à ranger et transporter.', 'Tour pliable', 34.99, 44.99, 27, 'CHAT-ACC-002', 'images/products/img_product_chat/75300_foldable_tower_fg_3805_7.jpg', 1, 0, 0, 0, 22, 4.4, 58, NOW(), NOW()),

(22, 2, 6, 'Escalier Griffoir Puzzle Tiaki', 'escalier-griffoir-puzzle-tiaki', 'Escalier griffoir avec puzzle intégré. Stimule l\'activité physique et mentale.', 'Griffoir puzzle', 42.99, 49.99, 22, 'CHAT-ACC-003', 'images/products/img_product_chat/527097_pla_tiaki_scratching_stairs_puzzle_fg_6858_3.jpg', 1, 1, 0, 1, 14, 4.6, 73, NOW(), NOW()),

(23, 2, 6, 'Fontaine à Eau pour Chat', 'fontaine-eau-chat', 'Fontaine à eau automatique. Encourage l\'hydratation de votre chat.', 'Fontaine automatique', 38.99, NULL, 34, 'CHAT-ACC-004', 'images/products/img_product_chat/28e1c5be-fbda-4056-bb29-2cb5fe00f7ee-700x700.webp', 1, 1, 1, 0, 0, 4.8, 126, NOW(), NOW()),

(24, 2, 6, 'Jouet Interactif Petiz', 'jouet-interactif-petiz', 'Jouet interactif électronique pour chat. Stimule l\'instinct de chasse.', 'Jouet électronique', 24.99, 29.99, 46, 'CHAT-ACC-005', 'images/products/img_product_chat/Products-Image-Petiz-55-700x700.webp', 1, 0, 0, 0, 17, 4.5, 81, NOW(), NOW()),

(25, 2, 6, 'Litière Autonettoyante', 'litiere-autonettoyante', 'Litière autonettoyante moderne. Hygiène optimale et facilité d\'utilisation.', 'Litière automatique', 149.99, 179.99, 12, 'CHAT-ACC-006', 'images/products/img_product_chat/8003507986428-1_368x368_crop_center.webp', 1, 1, 1, 1, 17, 4.9, 167, NOW(), NOW()),

(26, 2, 6, 'Bac à Litière Design', 'bac-litiere-design', 'Bac à litière au design moderne. Facile à nettoyer avec filtre anti-odeurs.', 'Bac litière moderne', 32.99, NULL, 38, 'CHAT-ACC-007', 'images/products/img_product_chat/jlsb.jpg', 1, 0, 0, 0, 0, 4.4, 52, NOW(), NOW()),

-- =====================================================
-- CAGE DE TRANSPORT (Sous-catégorie ID: 4)
-- =====================================================
(27, 2, 4, 'Cage de Transport Premium', 'cage-transport-premium-chat', 'Cage de transport robuste et confortable. Ventilation optimale et sécurité renforcée.', 'Transport sécurisé', 44.99, 54.99, 29, 'CHAT-CAGE-001', 'images/products/img_product_chat/IMG_20250311_151750-removebg-preview-150x150.webp', 1, 0, 1, 0, 18, 4.6, 94, NOW(), NOW()),

(28, 2, 4, 'Sac de Transport Souple', 'sac-transport-souple-chat', 'Sac de transport souple et confortable. Idéal pour les déplacements courts.', 'Transport souple', 29.99, 36.99, 41, 'CHAT-CAGE-002', 'images/products/img_product_chat/New-Project-7-1-150x150.webp', 1, 1, 0, 0, 19, 4.5, 67, NOW(), NOW());

-- ✅ 16 PRODUITS CHATS AJOUTÉS
