-- =====================================================
-- VÉRIFICATION DES PRODUITS DANS LA BASE DE DONNÉES
-- =====================================================

-- Compter le total de produits
SELECT 'TOTAL PRODUITS' as Type, COUNT(*) as Nombre FROM products;

-- Compter par catégorie
SELECT 
    c.name as Categorie,
    COUNT(p.id) as Nombre_Produits
FROM categories c
LEFT JOIN products p ON c.id = p.category_id
GROUP BY c.id, c.name
ORDER BY c.id;

-- Détail des produits Chats
SELECT 
    p.id,
    p.name as Nom_Produit,
    sc.name as Sous_Categorie,
    p.price as Prix,
    p.stock as Stock
FROM products p
JOIN categories c ON p.category_id = c.id
LEFT JOIN sub_categories sc ON p.subcategory_id = sc.id
WHERE c.name = 'Chats'
ORDER BY p.id;

-- Vérifier si les produits 13-28 existent (ce sont les produits Chats)
SELECT 
    CASE 
        WHEN COUNT(*) = 16 THEN 'TOUS LES PRODUITS CHATS SONT PRÉSENTS (16/16)'
        ELSE CONCAT('MANQUE ', 16 - COUNT(*), ' PRODUITS CHATS')
    END as Statut
FROM products
WHERE id BETWEEN 13 AND 28;
