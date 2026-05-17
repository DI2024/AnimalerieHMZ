-- =====================================================
-- ÉTAPE 1: PRÉPARATION
-- Désactiver les contraintes et supprimer les anciennes données
-- =====================================================

-- Désactiver les vérifications de clés étrangères
SET FOREIGN_KEY_CHECKS = 0;

-- Supprimer les anciens produits
DELETE FROM `products`;

-- Réinitialiser l'auto-increment
ALTER TABLE `products` AUTO_INCREMENT = 1;

-- Supprimer les anciennes sous-catégories
DELETE FROM `sub_categories`;

-- Réinitialiser l'auto-increment
ALTER TABLE `sub_categories` AUTO_INCREMENT = 1;

-- Réactiver les vérifications
SET FOREIGN_KEY_CHECKS = 1;

-- ✅ ÉTAPE 1 TERMINÉE
-- Passez à ETAPE_2_Sous_Categories.sql
