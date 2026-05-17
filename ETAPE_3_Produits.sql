
> INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `slug`, `image`, `is_active`, `created_at`, 
`updated_at`) VALUES
  -- Chiens (category_id = 1)
  (1, 1, 'Croquettes pour chien', 'croquettes-chien', NULL, 1, NOW(), NOW()),
  (2, 1, 'Cages pour chien', 'cages-chien', NULL, 1, NOW(), NOW()),
  (3, 1, 'Accessoires chien', 'accessoires-chien', NULL, 1, NOW(), NOW()),
  
  -- Chats (category_id = 2)
  (4, 2, 'Cage de transport', 'cage-transport', NULL, 1, NOW(), NOW()),
  (5, 2, 'Croquettes pour chat', 'croquettes-chat', NULL, 1, NOW(), NOW()),
  (6, 2, 'Accessoires', 'accessoires-chat', NULL, 1, NOW(), NOW()),
  
  -- Oiseaux (category_id = 3)
  (7, 3, 'Cages & VoliÃ¨res', 'cages-volieres', NULL, 1, NOW(), NOW()),
  (8, 3, 'Graines & Nutrition', 'graines-nutrition', NULL, 1, NOW(), NOW()),
  (9, 3, 'Accessoires', 'accessoires-oiseaux', NULL, 1, NOW(), NOW()),
  
  -- Poissons (category_id = 4)
  (10, 4, 'Aquariums', 'aquariums', NULL, 1, NOW(), NOW()),
  (11, 4, 'Nourriture poissons', 'nourriture-poissons', NULL, 1, NOW(), NOW()),
  (12, 4, 'Accessoires aquarium', 'accessoires-aquarium', NULL, 1, NOW(), NOW()),
  
  -- Pigeons (category_id = 5)
  (13, 5, 'Cages & VoliÃ¨res', 'cages-volieres-pigeons', NULL, 1, NOW(), NOW()),
  (14, 5, 'Graines & Nutrition', 'graines-nutrition-pigeons', NULL, 1, NOW(), NOW()),
  (15, 5, 'Accessoires', 'accessoires-pigeons', NULL, 1, NOW(), NOW());
  
  -- =====================================================
  -- 3. INSERTION DES NOUVEAUX PRODUITS
  -- =====================================================
  
  -- =====================================================
  -- CATÃ‰GORIE: CHIENS (category_id = 1)
  -- =====================================================
  
> INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `name`, `slug`, `description`, 
`short_description`, `price`, `price_old`, `stock`, `sku`, `image`, `is_active`, `is_new`, 
`is_bestseller`, `is_featured`, `discount_percentage`, `rating`, `review_count`, `created_at`, 
`updated_at`) VALUES
  
  -- Croquettes pour chien
  (1, 1, 1, 'Pro Plan Adult Light Sterilised Chicken 3kg', 
'pro-plan-adult-light-sterilised-chicken-3kg', 'Croquettes Pro Plan pour chiens adultes stÃ©rilisÃ©s 
avec poulet. Formule lÃ©gÃ¨re pour maintenir un poids optimal.', 'Croquettes lÃ©gÃ¨res pour chiens 
stÃ©rilisÃ©s', 42.99, 49.99, 45, 'CHIEN-CRO-001', 'images/products/img_product_chien/07613035123779_C1L1_
ProPlanDogALLSIZESADULTLIGHTSTERILISEDChicken3kg_43743769_5d9befbb-1605-4c4e-a33d-57b13bcc4cc6_800x-300x3
00.webp', 1, 0, 1, 1, 14, 4.7, 89, NOW(), NOW()),
  
  (2, 1, 1, 'Hills Science Plan Adult', 'hills-science-plan-adult', 'Nutrition scientifiquement 
formulÃ©e pour les chiens adultes. IngrÃ©dients de haute qualitÃ© pour une santÃ© optimale.', 'Nutrition 
scientifique pour chiens adultes', 54.99, 64.99, 38, 'CHIEN-CRO-002', 
'images/products/img_product_chien/384029_494696_107507_pla_hills_hs_01_8.jpg', 1, 1, 1, 1, 15, 4.8, 
124, NOW(), NOW()),
  
  (3, 1, 1, 'Royal Canin Giant Adult Bonus Bag', 'royal-canin-giant-adult-bonus-bag', 'Croquettes 
spÃ©cialement formulÃ©es pour les chiens de trÃ¨s grande taille. Soutient les articulations et la 
digestion.', 'Pour chiens de trÃ¨s grande taille', 68.99, 79.99, 28, 'CHIEN-CRO-003', 
'images/products/img_product_chien/456900_pla_royal_canin_giant_adult_bonusbag_9.jpg', 1, 0, 1, 0, 14, 
4.6, 67, NOW(), NOW()),
  
  (4, 1, 1, 'Eukanuba Premium Large & Giant Breed 15kg', 'eukanuba-premium-large-giant-breed-15kg', 
'Nutrition premium pour chiens de grande et trÃ¨s grande taille. Riche en protÃ©ines de poulet.', 
'Premium pour grandes races', 72.99, NULL, 32, 'CHIEN-CRO-004', 'images/products/img_product_chien/609711
_pla_eukanuba_premium_nutrition_adult_large_giant_breed_huhn_15kg_2.jpg', 1, 1, 0, 1, 0, 4.9, 156, 
NOW(), NOW()),
  
  (5, 1, 1, 'Purina Pro Plan Medium Adult Sensitive Skin 7kg', 
'purina-pro-plan-medium-sensitive-skin-7kg', 'Croquettes pour chiens de taille moyenne avec peau 
sensible. Formule OptiDerma pour une peau saine.', 'Pour peaux sensibles', 48.99, 55.99, 41, 
'CHIEN-CRO-005', 'images/products/img_product_chien/99204_pla_purina_proplan_medium_adult_sensitiveskin_o
ptiderma_7kg_hs_01_5.jpg', 1, 0, 1, 0, 13, 4.7, 93, NOW(), NOW()),
  
  -- Accessoires chien
  (6, 1, 3, 'Gamelle Break Reserve 15L Nordic Sky', 'gamelle-break-reserve-15l-nordic-sky', 'Gamelle 
automatique avec rÃ©serve d\'eau de 15 litres. Design moderne Nordic Sky.', 'Gamelle automatique 15L', 
34.99, 42.99, 25, 'CHIEN-ACC-001', 
'images/products/img_product_chien/BREAK-RESERVE-15LT-ACQUA-NORDIC-SKY-04206-300x300.jpg', 1, 1, 0, 0, 
19, 4.5, 48, NOW(), NOW()),
  
  (7, 1, 3, 'Laisse Flexi Classic S Cord 5m Bleu', 'laisse-flexi-classic-s-cord-5m-bleu', 'Laisse 
enrouleur Flexi Classic avec cordon de 5 mÃ¨tres. IdÃ©ale pour petits chiens.', 'Laisse enrouleur 5m', 
24.99, 29.99, 52, 'CHIEN-ACC-002', 
'images/products/img_product_chien/flexi_Classic_S_Cord_5m_blue-300x300.jpg', 1, 0, 1, 0, 17, 4.6, 78, 
NOW(), NOW()),
  
  (8, 1, 3, 'Harnais Confort RÃ©glable M Moov Noir', 'harnais-confort-reglable-m-moov-noir', 'Harnais 
confortable et rÃ©glable taille M. Design Moov en noir Ã©lÃ©gant.', 'Harnais rÃ©glable confort', 19.99, 
24.99, 48, 'CHIEN-ACC-003', 
'images/products/img_product_chien/harnais-conf-reg-m-moov-noir-300x300.jpg', 1, 0, 0, 0, 20, 4.4, 62, 
NOW(), NOW()),
  
  (9, 1, 3, 'Jouet Interactif pour Chien', 'jouet-interactif-chien', 'Jouet interactif stimulant pour 
chien. Favorise l\'activitÃ© mentale et physique.', 'Jouet stimulant', 15.99, NULL, 67, 'CHIEN-ACC-004', 
'images/products/img_product_chien/telechargement-2025-05-03T101138.052.jpg', 1, 1, 0, 0, 0, 4.3, 41, 
NOW(), NOW()),
  
  (10, 1, 3, 'Collier Ajustable Premium', 'collier-ajustable-premium', 'Collier ajustable de qualitÃ© 
premium. Confortable et rÃ©sistant.', 'Collier premium', 12.99, 16.99, 73, 'CHIEN-ACC-005', 
'images/products/img_product_chien/telechargement.jpg', 1, 0, 0, 0, 24, 4.5, 55, NOW(), NOW()),
  
  (11, 1, 3, 'Coussin Confort pour Chien', 'coussin-confort-chien', 'Coussin moelleux et confortable 
pour le repos de votre chien. DÃ©houssable et lavable.', 'Coussin moelleux', 29.99, 39.99, 34, 
'CHIEN-ACC-006', 'images/products/img_product_chien/w400 8.jpg', 1, 0, 1, 0, 25, 4.7, 88, NOW(), NOW()),
  
  (12, 1, 3, 'Sac de Transport Confort', 'sac-transport-confort-chien', 'Sac de transport confortable et 
sÃ©curisÃ© pour petits chiens. Ventilation optimale.', 'Sac de transport', 44.99, NULL, 19, 
'CHIEN-ACC-007', 'images/products/img_product_chien/659193_cbb512588dd044959f8fcba3a2030b23~mv2.avif', 
1, 1, 0, 1, 0, 4.6, 37, NOW(), NOW());
  
  
  -- =====================================================
  -- CATÃ‰GORIE: CHATS (category_id = 2)
  -- =====================================================
  
  -- Croquettes pour chat
  (13, 2, 5, 'Hills Prescription Diet i/d Digestive Care 3kg', 
'hills-prescription-diet-id-digestive-care-3kg', 'Aliment vÃ©tÃ©rinaire pour chats avec troubles 
digestifs. Formule hautement digestible.', 'Soin digestif vÃ©tÃ©rinaire', 38.99, 45.99, 28, 
'CHAT-CRO-001', 'images/products/img_product_chat/242425_pla_hills_prescriptiondiet_id_digestivecare_katz
enfutter_huhn_3kg_hs_01_6.jpg', 1, 0, 1, 1, 15, 4.8, 112, NOW(), NOW()),
  
  (14, 2, 5, 'Hills Prescription Diet z/d Food Sensitivities', 
'hills-prescription-diet-zd-food-sensitivities', 'Aliment hypoallergÃ©nique pour chats sensibles. 
RÃ©duit les rÃ©actions alimentaires.', 'HypoallergÃ©nique', 42.99, 49.99, 24, 'CHAT-CRO-002', 'images/pro
ducts/img_product_chat/242430_242431_pla_hills_prescriptiondiet_zd_food_sensitivities_katzenfutter_origin
al_hs_01_1.jpg', 1, 1, 0, 1, 14, 4.7, 87, NOW(), NOW()),
  
  (15, 2, 5, 'Royal Canin Fussy Cat', 'royal-canin-fussy-cat', 'Croquettes pour chats difficiles. 
AppÃ©tence optimale et nutrition Ã©quilibrÃ©e.', 'Pour chats difficiles', 34.99, 39.99, 42, 
'CHAT-CRO-003', 'images/products/img_product_chat/610398_610211_610214_610216_610399_pla_royal_canin_fuss
y_cat_1000x1000_hs_01_0.jpg', 1, 0, 1, 0, 13, 4.6, 95, NOW(), NOW()),
  
  (16, 2, 5, 'Hills Prescription Diet Metabolic Weight Management', 
'hills-prescription-diet-metabolic-weight-management', 'Gestion du poids pour chats. Formule 
cliniquement prouvÃ©e pour la perte de poids.', 'Gestion du poids', 46.99, 54.99, 31, 'CHAT-CRO-004', 'im
ages/products/img_product_chat/64126_243997_70882_243996_pla_hills_prescriptiondiet_metabolic_felineweigh
t_management_huhn_hs_02_3.jpg', 1, 0, 1, 1, 15, 4.9, 143, NOW(), NOW()),
  
  (17, 2, 5, 'Purina Pro Plan Delicate Dinde', 'purina-pro-plan-delicate-dinde', 'Croquettes pour chats Ã
 digestion sensible. Riche en dinde de qualitÃ©.', 'Digestion sensible', 36.99, 42.99, 38, 
'CHAT-CRO-005', 
'images/products/img_product_chat/84311_pla_purina_proplan_delicate_reichtruthahn_hs_01_8.jpg', 1, 1, 0, 
0, 14, 4.7, 76, NOW(), NOW()),
  
  (18, 2, 5, 'Royal Canin Vet Urinary S/O Moderate Calorie', 
'royal-canin-vet-urinary-so-moderate-calorie', 'Aliment vÃ©tÃ©rinaire pour la santÃ© urinaire. Calories 
modÃ©rÃ©es.', 'SantÃ© urinaire', 44.99, NULL, 26, 'CHAT-CRO-006', 
'images/products/img_product_chat/rc_vet_dry_caturinarysomc_mv_eretailkit_de_de_7.jpg', 1, 0, 1, 1, 0, 
4.8, 98, NOW(), NOW()),
  
  (19, 2, 5, 'Croquettes Premium Chat Adulte', 'croquettes-premium-chat-adulte', 'Croquettes premium 
pour chats adultes. Nutrition complÃ¨te et Ã©quilibrÃ©e.', 'Premium chat adulte', 29.99, 34.99, 55, 
'CHAT-CRO-007', 'images/products/img_product_chat/w400.jpg', 1, 0, 0, 0, 14, 4.5, 64, NOW(), NOW()),
  
  -- Accessoires chat
  (20, 2, 6, 'Arbre Ã Chat Cat Flower', 'arbre-chat-cat-flower', 'Arbre Ã chat design avec motif fleur. 
Plusieurs niveaux et griffoirs.', 'Arbre Ã chat design', 89.99, 109.99, 18, 'CHAT-ACC-001', 
'images/products/img_product_chat/63085_PLA_Kratzbaum_Cat_Flower_1_6.jpg', 1, 1, 1, 1, 18, 4.7, 142, 
NOW(), NOW()),
  
  (21, 2, 6, 'Tour Pliable pour Chat', 'tour-pliable-chat', 'Tour de jeu pliable pour chat. Facile Ã 
ranger et transporter.', 'Tour pliable', 34.99, 44.99, 27, 'CHAT-ACC-002', 
'images/products/img_product_chat/75300_foldable_tower_fg_3805_7.jpg', 1, 0, 0, 0, 22, 4.4, 58, NOW(), 
NOW()),
  
  (22, 2, 6, 'Escalier Griffoir Puzzle Tiaki', 'escalier-griffoir-puzzle-tiaki', 'Escalier griffoir avec 
puzzle intÃ©grÃ©. Stimule l\'activitÃ© physique et mentale.', 'Griffoir puzzle', 42.99, 49.99, 22, 
'CHAT-ACC-003', 
'images/products/img_product_chat/527097_pla_tiaki_scratching_stairs_puzzle_fg_6858_3.jpg', 1, 1, 0, 1, 
14, 4.6, 73, NOW(), NOW()),
  
  (23, 2, 6, 'Fontaine Ã Eau pour Chat', 'fontaine-eau-chat', 'Fontaine Ã eau automatique. Encourage 
l\'hydratation de votre chat.', 'Fontaine automatique', 38.99, NULL, 34, 'CHAT-ACC-004', 
'images/products/img_product_chat/28e1c5be-fbda-4056-bb29-2cb5fe00f7ee-700x700.webp', 1, 1, 1, 0, 0, 
4.8, 126, NOW(), NOW()),
  
  (24, 2, 6, 'Jouet Interactif Petiz', 'jouet-interactif-petiz', 'Jouet interactif Ã©lectronique pour 
chat. Stimule l\'instinct de chasse.', 'Jouet Ã©lectronique', 24.99, 29.99, 46, 'CHAT-ACC-005', 
'images/products/img_product_chat/Products-Image-Petiz-55-700x700.webp', 1, 0, 0, 0, 17, 4.5, 81, NOW(), 
NOW()),
  
  (25, 2, 6, 'LitiÃ¨re Autonettoyante', 'litiere-autonettoyante', 'LitiÃ¨re autonettoyante moderne. 
HygiÃ¨ne optimale et facilitÃ© d\'utilisation.', 'LitiÃ¨re automatique', 149.99, 179.99, 12, 
'CHAT-ACC-006', 'images/products/img_product_chat/8003507986428-1_368x368_crop_center.webp', 1, 1, 1, 1, 
17, 4.9, 167, NOW(), NOW()),
  
  (26, 2, 6, 'Bac Ã LitiÃ¨re Design', 'bac-litiere-design', 'Bac Ã litiÃ¨re au design moderne. Facile Ã 
nettoyer avec filtre anti-odeurs.', 'Bac litiÃ¨re moderne', 32.99, NULL, 38, 'CHAT-ACC-007', 
'images/products/img_product_chat/jlsb.jpg', 1, 0, 0, 0, 0, 4.4, 52, NOW(), NOW()),
  
  -- Cage de transport
  (27, 2, 4, 'Cage de Transport Premium', 'cage-transport-premium-chat', 'Cage de transport robuste et 
confortable. Ventilation optimale et sÃ©curitÃ© renforcÃ©e.', 'Transport sÃ©curisÃ©', 44.99, 54.99, 29, 
'CHAT-CAGE-001', 'images/products/img_product_chat/IMG_20250311_151750-removebg-preview-150x150.webp', 
1, 0, 1, 0, 18, 4.6, 94, NOW(), NOW()),
  
  (28, 2, 4, 'Sac de Transport Souple', 'sac-transport-souple-chat', 'Sac de transport souple et 
confortable. IdÃ©al pour les dÃ©placements courts.', 'Transport souple', 29.99, 36.99, 41, 
'CHAT-CAGE-002', 'images/products/img_product_chat/New-Project-7-1-150x150.webp', 1, 1, 0, 0, 19, 4.5, 
67, NOW(), NOW());
  
  
  -- =====================================================
  -- CATÃ‰GORIE: OISEAUX (category_id = 3)
  -- =====================================================
  
  -- Cages & VoliÃ¨res
  (29, 3, 7, 'Cage d\'Ã‰levage Zolux Primo', 'cage-elevage-zolux-primo', 'Cage d\'Ã©levage spacieuse 
Zolux Primo. IdÃ©ale pour petits oiseaux.', 'Cage Ã©levage Zolux', 54.99, 64.99, 22, 'OISEAU-CAGE-001', 
'images/products/img_product_oiseau/Cage-delevage-Zolux-Primo-cati-671-300x300 (1).jpg', 1, 0, 1, 1, 15, 
4.7, 86, NOW(), NOW()),
  
  (30, 3, 7, 'VoliÃ¨re Design Moderne', 'voliere-design-moderne', 'VoliÃ¨re spacieuse au design moderne. 
Parfaite pour plusieurs oiseaux.', 'VoliÃ¨re spacieuse', 129.99, 149.99, 14, 'OISEAU-CAGE-002', 
'images/products/img_product_oiseau/VL422174-e1737985565383-700x779.webp', 1, 1, 1, 1, 13, 4.8, 124, 
NOW(), NOW()),
  
  -- Graines & Nutrition
  (31, 3, 8, 'MÃ©lange pour Calopsitte', 'melange-calopsitte', 'MÃ©lange de graines spÃ©cialement 
formulÃ© pour calopsittes. Nutrition complÃ¨te.', 'Graines calopsitte', 12.99, 15.99, 58, 
'OISEAU-GRAIN-001', 
'images/products/img_product_oiseau/Melange-pour-calopsitte-e1714228585714-510x510-1.webp', 1, 0, 1, 0, 
19, 4.6, 73, NOW(), NOW()),
  
  (32, 3, 8, 'MÃ©lange pour Canaries avec Alpiste', 'melange-canaries-alpiste', 'MÃ©lange premium pour 
canaries enrichi en alpiste. Favorise le chant.', 'Graines canaries', 9.99, 12.99, 67, 
'OISEAU-GRAIN-002', 
'images/products/img_product_oiseau/Melange-pour-canaries-avec-alpiste-e1714147138859-510x510-1.webp', 
1, 0, 1, 0, 23, 4.7, 91, NOW(), NOW()),
  
  (33, 3, 8, 'Aliment pour Perroquet', 'aliment-perroquet', 'Aliment complet pour perroquets. Riche en 
vitamines et minÃ©raux.', 'Nutrition perroquet', 18.99, 22.99, 42, 'OISEAU-GRAIN-003', 
'images/products/img_product_oiseau/Aliment-pour-perroquet-510x510-1.webp', 1, 1, 0, 1, 17, 4.8, 108, 
NOW(), NOW()),
  
  (34, 3, 8, 'Graines Premium Mix', 'graines-premium-mix-oiseaux', 'MÃ©lange premium de graines 
variÃ©es. Pour tous types d\'oiseaux.', 'Mix premium', 14.99, NULL, 51, 'OISEAU-GRAIN-004', 
'images/products/img_product_oiseau/575434__53870-700x700.webp', 1, 0, 0, 0, 0, 4.5, 64, NOW(), NOW()),
  
  -- Accessoires
  (35, 3, 9, 'Abreuvoir pour Oiseaux', 'abreuvoir-oiseaux', 'Abreuvoir automatique pour oiseaux. Facile Ã
 installer et nettoyer.', 'Abreuvoir automatique', 8.99, 11.99, 74, 'OISEAU-ACC-001', 
'images/products/img_product_oiseau/Abreuvoir-oiseaux-510x510-1.webp', 1, 0, 0, 0, 25, 4.4, 56, NOW(), 
NOW()),
  
  (36, 3, 9, 'HidraPlus 1kg Avianvet', 'hidraplus-1kg-avianvet', 'ComplÃ©ment d\'Ã©lectrolytes 
HidraPlus. Ã€ dissoudre dans l\'eau pour une hydratation optimale.', 'Ã‰lectrolytes', 18.25, NULL, 33, 
'OISEAU-ACC-002', 'images/products/img_product_oiseau/hidraplus-1kg-avianvet-1825-eur-26251-avianvet-hidr
aplus-avianvet-est-un-complement-a-base-delectrolytes-a-dissoudre-dans-leau-o.jpg', 1, 1, 0, 0, 0, 4.7, 
47, NOW(), NOW()),
  
  (37, 3, 9, 'Perchoir Naturel', 'perchoir-naturel-oiseaux', 'Perchoir en bois naturel. Favorise le 
bien-Ãªtre et l\'exercice des pattes.', 'Perchoir bois', 6.99, 8.99, 82, 'OISEAU-ACC-003', 'images/produc
ts/img_product_oiseau/045671b0f8370fb4e7f6f50230430e5285a325d2_33b04a0f1aa325976f5c117aee20eb1053e3f3de.w
ebp', 1, 0, 0, 0, 22, 4.3, 38, NOW(), NOW());
  
  
  -- =====================================================
  -- CATÃ‰GORIE: POISSONS (category_id = 4)
  -- =====================================================
  
  -- Aquariums
  (38, 4, 10, 'EHEIM Vivaline LED 126L', 'eheim-vivaline-led-126l', 'Aquarium complet EHEIM Vivaline 
126L avec Ã©clairage LED. Design moderne et Ã©lÃ©gant.', 'Aquarium LED 126L', 189.99, 229.99, 12, 
'POISSON-AQU-001', 'images/products/img_product_poisson/EHEIM-vivalineLED-126--300x300.jpg', 1, 1, 1, 1, 
17, 4.8, 134, NOW(), NOW()),
  
  (39, 4, 10, 'Aquarium DÃ©butant Complet', 'aquarium-debutant-complet', 'Kit aquarium complet pour 
dÃ©butants. Tout le nÃ©cessaire pour dÃ©marrer.', 'Kit dÃ©butant', 79.99, 99.99, 24, 'POISSON-AQU-002', 
'images/products/img_product_poisson/401438-300x300.jpg', 1, 0, 1, 0, 20, 4.6, 87, NOW(), NOW()),
  
  (40, 4, 10, 'Nano Aquarium Design', 'nano-aquarium-design', 'Nano aquarium au design Ã©purÃ©. Parfait 
pour petits espaces.', 'Nano aquarium', 54.99, 64.99, 31, 'POISSON-AQU-003', 'images/products/img_product
_poisson/789e13160e60e4f591114fc3149abb7e5259aac8_9f6d373777204c04c4b83b37e56d1eabc5aa59d1.webp', 1, 1, 
0, 1, 15, 4.7, 96, NOW(), NOW()),
  
  -- Nourriture poissons
  (41, 4, 11, 'Basic Tropical Flakes Dajana', 'basic-tropical-flakes-dajana', 'Flocons tropicaux Dajana. 
Alimentation complÃ¨te pour poissons tropicaux.', 'Flocons tropicaux', 8.99, 10.99, 68, 
'POISSON-NOUR-001', 'images/products/img_product_poisson/basic-tropical-flakes-dajana1-300x300.jpg', 1, 
0, 1, 0, 18, 4.5, 72, NOW(), NOW()),
  
  (42, 4, 11, 'Sera KOI Royal 5.65kg', 'sera-koi-royal-565kg', 'Nourriture premium Sera pour KoÃ¯. 
Formule enrichie pour couleurs Ã©clatantes.', 'Nourriture KoÃ¯ premium', 42.99, 49.99, 19, 
'POISSON-NOUR-002', 'images/products/img_product_poisson/sera-KOI-ROYAL-5-65-300x300.jpg', 1, 1, 1, 1, 
14, 4.9, 143, NOW(), NOW()),
  
  (43, 4, 11, 'GranulÃ©s Poissons Tropicaux', 'granules-poissons-tropicaux', 'GranulÃ©s nutritifs pour 
poissons tropicaux. Haute digestibilitÃ©.', 'GranulÃ©s tropicaux', 12.99, NULL, 54, 'POISSON-NOUR-003', 
'images/products/img_product_poisson/178538_PHO_PRO_CLIP_8853-1.jpg', 1, 0, 0, 0, 0, 4.6, 58, NOW(), 
NOW()),
  
  -- Accessoires aquarium
  (44, 4, 12, 'Ã‰ponge de Filtration Trixie', 'eponge-filtration-trixie', 'Ã‰ponge de filtration pour 
aquarium Trixie. Filtration biologique efficace.', 'Ã‰ponge filtre', 6.99, 8.99, 89, 'POISSON-ACC-001', 
'images/products/img_product_poisson/EPONGE-POUR-AQUARIUM-trixie-300x300.jpg', 1, 0, 0, 0, 22, 4.4, 45, 
NOW(), NOW()),
  
  (45, 4, 12, 'Perles de Verre Lapis Lazuli', 'perles-verre-lapis-lazuli', 'Perles dÃ©coratives en verre 
Lapis Lazuli. Embellissent votre aquarium.', 'DÃ©coration verre', 9.99, 12.99, 62, 'POISSON-ACC-002', 
'images/products/img_product_poisson/Perles-de-Verre-Lapi-Lazuli--300x300.jpg', 1, 1, 0, 0, 23, 4.5, 51, 
NOW(), NOW()),
  
  (46, 4, 12, 'Kit d\'Ã‰levage Zolux', 'kit-elevage-zolux-poisson', 'Kit d\'Ã©levage complet pour 
alevins. SÃ©curise et protÃ¨ge les jeunes poissons.', 'Kit Ã©levage', 24.99, 29.99, 37, 
'POISSON-ACC-003', 'images/products/img_product_poisson/Cage-delevage-Zolux-Primo-cati-671-300x300.jpg', 
1, 0, 0, 0, 17, 4.6, 42, NOW(), NOW());
  
  
  -- =====================================================
  -- CATÃ‰GORIE: PIGEONS (category_id = 5)
  -- =====================================================
  
  -- Cages & VoliÃ¨res
  (47, 5, 13, 'Panier d\'EntraÃ®nement Aluminium Mira 110x28x61cm', 
'panier-entrainement-aluminium-mira', 'Panier d\'entraÃ®nement en aluminium Demster Mira. Dimensions 
110x28x61cm, lÃ©ger et rÃ©sistant.', 'Panier alu Mira', 89.99, 109.99, 15, 'PIGEON-CAGE-001', 
'images/products/img_product_peigon/panier-d-entrainement-en-aluminium-mira-110x28x61-cm-demster.jpg', 
1, 1, 1, 1, 18, 4.8, 67, NOW(), NOW()),
  
  (48, 5, 13, 'Panier d\'EntraÃ®nement Bois Limoges 89.90x26x46cm', 'panier-entrainement-bois-limoges', 
'Panier d\'entraÃ®nement en bois Demster Limoges. Dimensions 89.90x26x46cm, traditionnel et robuste.', 
'Panier bois Limoges', 74.99, 89.99, 18, 'PIGEON-CAGE-002', 'images/products/img_product_peigon/panier-d-
entrainement-pour-pigeon-en-bois-limoges-89-90x26x46cm-demster.jpg', 1, 0, 1, 0, 17, 4.7, 54, NOW(), 
NOW()),
  
  (49, 5, 13, 'Panier d\'Exposition Petit Natural', 'panier-exposition-petit-natural', 'Panier 
d\'exposition petit modÃ¨le en matÃ©riaux naturels. IdÃ©al pour concours.', 'Panier exposition', 34.99, 
42.99, 26, 'PIGEON-CAGE-003', 
'images/products/img_product_peigon/panier-d-exposition-petit-natural-2.jpg', 1, 0, 0, 0, 19, 4.5, 38, 
NOW(), NOW()),
  
  (50, 5, 13, 'Mangeoire Pigeons Qubus 80cm Demster', 'mangeoire-pigeons-qubus-80cm', 'Mangeoire Qubus 
80cm Demster. Design pratique pour alimentation collective.', 'Mangeoire Qubus 80cm', 44.99, 54.99, 22, 
'PIGEON-CAGE-004', 'images/products/img_product_peigon/mangeoire-pigeons-qubus-80-cm-demster.jpg', 1, 1, 
0, 1, 18, 4.6, 49, NOW(), NOW()),
  
  -- Graines & Nutrition
  (51, 5, 14, 'MÃ©langes Premium Pigeons', 'melanges-premium-pigeons', 'MÃ©langes de graines premium 
pour pigeons. SÃ©lection de qualitÃ© supÃ©rieure.', 'Graines premium', 28.99, 34.99, 45, 
'PIGEON-GRAIN-001', 'images/products/img_product_peigon/melanges-premium.jpg', 1, 0, 1, 1, 17, 4.7, 89, 
NOW(), NOW()),
  
  (52, 5, 14, 'Enzymix 7-50 MS Mue MÃ©thionine 20kg Beyers', 'enzymix-7-50-ms-mue-methionine-20kg', 
'Enzymix 7-50 MS Beyers 20kg. MÃ©lange de mue haute qualitÃ© enrichi en mÃ©thionine.', 'MÃ©lange mue 
20kg', 22.70, NULL, 34, 'PIGEON-GRAIN-002', 'images/products/img_product_peigon/enzymix-7-50-ms-mue-methi
onine-20kg-beyers-2270-eur-070050-beyers-enzymix-7-50-ms-mue-methionine-20-kg-melange-de-mue-haute-qual.j
pg', 1, 1, 1, 0, 0, 4.8, 112, NOW(), NOW()),
  
  (53, 5, 14, 'Colombine Vita 4kg Versele Laga', 'colombine-vita-4kg-versele-laga', 'Colombine Vita 4kg 
Versele Laga. Vitamines, oligo-Ã©lÃ©ments et minÃ©raux en poudre.', 'Vitamines 4kg', 15.60, 18.99, 52, 
'PIGEON-GRAIN-003', 'images/products/img_product_peigon/colombine-vita-4kg-vitamines-oligo-elements-et-mi
neraux-en-poudre-1560-eur-412361-versele-laga-vitamines-oligoelements-et-minera.jpg', 1, 0, 0, 0, 18, 
4.6, 73, NOW(), NOW()),
  
  -- Accessoires
  (54, 5, 15, 'Abreuvoir-Mangeoire 8L Bleu Gaun', 'abreuvoir-mangeoire-8l-bleu-gaun', 
'Abreuvoir-mangeoire 8 litres bleu Gaun. Double fonction pratique.', 'Abreuvoir 8L', 12.95, 15.99, 38, 
'PIGEON-ACC-001', 'images/products/img_product_peigon/abreuvoir-mangeoire-pour-pigeons-8-l-bleu-gaun-1295
-eur-30102-gaun-abreuvoir-mangeoire-pour-pigeons-8-l-bleu-gaun.jpg', 1, 0, 0, 0, 19, 4.5, 56, NOW(), 
NOW()),
  
  (55, 5, 15, 'Bagues Ã‰lastiques E-Z 50 piÃ¨ces 8mm Jaune', 'bagues-elastiques-ez-50-pieces-8mm', 
'Bagues Ã©lastiques E-Z par 50 piÃ¨ces, taille 8mm couleur jaune. Nouvelle conception 4 wings.', 'Bagues 
8mm x50', 6.50, 8.99, 67, 'PIGEON-ACC-002', 'images/products/img_product_peigon/bagues-elastiques-e-z-par
-50-pieces-taille-8-mm-couleur-jaune-650-eur-880err08-yellow-rings-4-wings-voila-une-nouvelle-conceptio.j
pg', 1, 1, 0, 0, 28, 4.4, 42, NOW(), NOW()),
  
  (56, 5, 15, 'Grattoir 16cm Manche Vert Plastique', 'grattoir-16cm-manche-vert', 'Grattoir 16cm manche 
vert en plastique Ornibird. Permet de nettoyer facilement les cages.', 'Grattoir 16cm', 4.75, 6.99, 84, 
'PIGEON-ACC-003', 'images/products/img_product_peigon/grattoir-16cm-manche-vert-en-plastique-475-eur-2602
8-private-label-ornibird-grattoir-16cm-manche-vert-en-plastique-permet-de-net.jpg', 1, 0, 0, 0, 32, 4.3, 
31, NOW(), NOW()),
  
  (57, 5, 15, 'BactAir Spray', 'bactair-spray', 'BactAir Spray dÃ©sinfectant pour colombier. Assainit 
l\'environnement des pigeons.', 'Spray dÃ©sinfectant', 14.99, 17.99, 46, 'PIGEON-ACC-004', 
'images/products/img_product_peigon/bactair-spray.jpg', 1, 0, 1, 0, 17, 4.6, 64, NOW(), NOW()),
  
  (58, 5, 15, 'BetaChol 1L', 'betachol-1l', 'BetaChol 1 litre. ComplÃ©ment alimentaire pour la santÃ© 
hÃ©patique des pigeons.', 'ComplÃ©ment 1L', 24.99, 29.99, 29, 'PIGEON-ACC-005', 
'images/products/img_product_peigon/betachol-1l.jpg', 1, 1, 0, 1, 17, 4.7, 58, NOW(), NOW()),
  
  (59, 5, 15, 'TaubenFit E-50 Vit E Konzentrat 100ml Rohnfried', 'taubenfit-e50-vit-e-konzentrat-100ml', 
'TaubenFit E-50 Rohnfried 100ml. Vitamine E et sÃ©lÃ©nium pour pÃ©riode d\'Ã©levage et de vol.', 
'Vitamine E 100ml', 18.99, NULL, 41, 'PIGEON-ACC-006', 'images/products/img_product_peigon/taubenfit-e-50
-vit-e-konzentrat-vit-e-et-selenium-la-periode-d-elevage-et-de-vol-100ml-rohnfried.jpg', 1, 0, 0, 0, 0, 
4.8, 76, NOW(), NOW());
  
  -- =====================================================
  -- FIN DES INSERTIONS DE PRODUITS
  -- =====================================================
  
  -- RÃ©activer les vÃ©rifications de clÃ©s Ã©trangÃ¨res
  SET FOREIGN_KEY_CHECKS = 1;
  
  -- =====================================================
  -- RÃ‰SUMÃ‰
  -- =====================================================
  -- Total produits insÃ©rÃ©s: 59
  -- - Chiens: 12 produits
  -- - Chats: 16 produits
  -- - Oiseaux: 9 produits
  -- - Poissons: 9 produits
  -- - Pigeons: 13 produits
  -- =====================================================


