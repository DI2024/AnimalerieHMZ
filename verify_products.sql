-- =====================================================
-- SCRIPT DE VÉRIFICATION DES PRODUITS
-- AnimalerieHMZ - Vérification après mise à jour
-- =====================================================

-- 1. Vérifier le nombre total de produits (devrait être 59)
SELECT '=== NOMBRE TOTAL DE PRODUITS ===' as '';
SELECT COUNT(*) as total_produits FROM products;

-- 2. Vérifier le nombre de sous-catégories (devrait être 15)
SELECT '=== NOMBRE TOTAL DE SOUS-CATÉGORIES ===' as '';
SELECT COUNT(*) as total_subcategories FROM sub_categories;

-- 3. Répartition des produits par catégorie
SELECT '=== RÉPARTITION PAR CATÉGORIE ===' as '';
SELECT 
    c.name as categorie,
    COUNT(p.id) as nombre_produits
FROM categories c
LEFT JOIN products p ON c.id = p.category_id
GROUP BY c.id, c.name
ORDER BY c.id;

-- 4. Répartition des produits par sous-catégorie
SELECT '=== RÉPARTITION PAR SOUS-CATÉGORIE ===' as '';
SELECT 
    c.name as categorie,
    sc.name as sous_categorie,
    COUNT(p.id) as nombre_produits
FROM categories c
LEFT JOIN sub_categories sc ON c.id = sc.category_id
LEFT JOIN products p ON sc.id = p.subcategory_id
GROUP BY c.id, c.name, sc.id, sc.name
ORDER BY c.id, sc.id;

-- 5. Vérifier les produits avec images locales
SELECT '=== VÉRIFICATION DES CHEMINS D\'IMAGES ===' as '';
SELECT 
    COUNT(*) as produits_avec_images_locales
FROM products 
WHERE image LIKE 'images/products/%';

-- 6. Vérifier les produits actifs
SELECT '=== PRODUITS ACTIFS ===' as '';
SELECT 
    COUNT(*) as produits_actifs
FROM products 
WHERE is_active = 1;

-- 7. Vérifier les produits nouveaux
SELECT '=== PRODUITS NOUVEAUX ===' as '';
SELECT 
    COUNT(*) as produits_nouveaux
FROM products 
WHERE is_new = 1;

-- 8. Vérifier les bestsellers
SELECT '=== BESTSELLERS ===' as '';
SELECT 
    COUNT(*) as bestsellers
FROM products 
WHERE is_bestseller = 1;

-- 9. Vérifier les produits en vedette
SELECT '=== PRODUITS EN VEDETTE ===' as '';
SELECT 
    COUNT(*) as produits_featured
FROM products 
WHERE is_featured = 1;

-- 10. Afficher quelques exemples de produits par catégorie
SELECT '=== EXEMPLES DE PRODUITS CHIENS ===' as '';
SELECT id, name, price, stock, image 
FROM products 
WHERE category_id = 1 
LIMIT 3;

SELECT '=== EXEMPLES DE PRODUITS CHATS ===' as '';
SELECT id, name, price, stock, image 
FROM products 
WHERE category_id = 2 
LIMIT 3;

SELECT '=== EXEMPLES DE PRODUITS OISEAUX ===' as '';
SELECT id, name, price, stock, image 
FROM products 
WHERE category_id = 3 
LIMIT 3;

SELECT '=== EXEMPLES DE PRODUITS POISSONS ===' as '';
SELECT id, name, price, stock, image 
FROM products 
WHERE category_id = 4 
LIMIT 3;

SELECT '=== EXEMPLES DE PRODUITS PIGEONS ===' as '';
SELECT id, name, price, stock, image 
FROM products 
WHERE category_id = 5 
LIMIT 3;

-- 11. Vérifier les produits avec réduction
SELECT '=== PRODUITS AVEC RÉDUCTION ===' as '';
SELECT 
    name,
    price,
    price_old,
    discount_percentage,
    CONCAT(ROUND(((price_old - price) / price_old * 100), 0), '%') as reduction_calculee
FROM products 
WHERE price_old IS NOT NULL
LIMIT 10;

-- 12. Vérifier les notes moyennes
SELECT '=== STATISTIQUES DES NOTES ===' as '';
SELECT 
    MIN(rating) as note_min,
    MAX(rating) as note_max,
    AVG(rating) as note_moyenne,
    SUM(review_count) as total_avis
FROM products;

-- 13. Vérifier le stock total
SELECT '=== STATISTIQUES DE STOCK ===' as '';
SELECT 
    SUM(stock) as stock_total,
    AVG(stock) as stock_moyen,
    MIN(stock) as stock_min,
    MAX(stock) as stock_max
FROM products;

-- 14. Liste des sous-catégories par catégorie
SELECT '=== LISTE DES SOUS-CATÉGORIES ===' as '';
SELECT 
    c.name as categorie,
    sc.id as subcategory_id,
    sc.name as sous_categorie,
    sc.slug
FROM categories c
LEFT JOIN sub_categories sc ON c.id = sc.category_id
ORDER BY c.id, sc.id;

-- =====================================================
-- FIN DES VÉRIFICATIONS
-- =====================================================
