# 📦 Mise à Jour des Produits - AnimalerieHMZ

## 📋 Résumé des Modifications

Ce fichier SQL met à jour complètement les produits de votre base de données avec des produits basés sur les **images locales** disponibles dans le dossier `public/images/products/`.

### ✅ Ce qui a été fait :

1. **Suppression des anciens produits** (avec URLs Google)
2. **Mise à jour des sous-catégories** selon votre nouvelle structure
3. **Création de 59 nouveaux produits** avec images locales

---

## 📊 Répartition des Produits

| Catégorie | Nombre de Produits | Sous-catégories |
|-----------|-------------------|-----------------|
| **Chiens** | 12 produits | Croquettes (5), Cages (0), Accessoires (7) |
| **Chats** | 16 produits | Croquettes (7), Cage transport (2), Accessoires (7) |
| **Oiseaux** | 9 produits | Cages & Volières (2), Graines (4), Accessoires (3) |
| **Poissons** | 9 produits | Aquariums (3), Nourriture (3), Accessoires (3) |
| **Pigeons** | 13 produits | Cages & Volières (4), Graines (3), Accessoires (6) |
| **TOTAL** | **59 produits** | |

---

## 🗂️ Nouvelle Structure des Sous-catégories

### 🐕 Chiens (category_id = 1)
- Croquettes pour chien
- Cages pour chien
- Accessoires chien

### 🐱 Chats (category_id = 2)
- Cage de transport
- Croquettes pour chat
- Accessoires

### 🦜 Oiseaux (category_id = 3)
- Cages & Volières
- Graines & Nutrition
- Accessoires

### 🐠 Poissons (category_id = 4)
- Aquariums
- Nourriture poissons
- Accessoires aquarium

### 🕊️ Pigeons (category_id = 5)
- Cages & Volières
- Graines & Nutrition
- Accessoires

---

## 🚀 Comment Exécuter le Fichier SQL

### Méthode 1 : Via phpMyAdmin (Recommandé)

1. Ouvrez **phpMyAdmin** dans votre navigateur
2. Sélectionnez la base de données `animaleriehmz`
3. Cliquez sur l'onglet **"SQL"**
4. Ouvrez le fichier `update_products.sql` avec un éditeur de texte
5. **Copiez tout le contenu** du fichier
6. **Collez-le** dans la zone de texte SQL de phpMyAdmin
7. Cliquez sur **"Exécuter"**

### Méthode 2 : Via Ligne de Commande MySQL

```bash
mysql -u root -p animaleriehmz < update_products.sql
```

### Méthode 3 : Via Laravel Artisan (Alternative)

Si vous préférez utiliser Laravel :

```bash
php artisan db:seed --class=ProductSeeder
```

*(Note : Cette méthode nécessite de créer un seeder Laravel)*

---

## ⚠️ IMPORTANT - Avant d'Exécuter

### 🔴 Sauvegarde Obligatoire

**FAITES UNE SAUVEGARDE** de votre base de données avant d'exécuter ce script !

```bash
# Via ligne de commande
mysqldump -u root -p animaleriehmz > backup_animaleriehmz_$(date +%Y%m%d).sql
```

Ou via phpMyAdmin : **Exporter** → **Exécuter**

### ⚠️ Ce Script Va :

- ✅ **SUPPRIMER** tous les produits existants
- ✅ **SUPPRIMER** toutes les sous-catégories existantes
- ✅ **CRÉER** 15 nouvelles sous-catégories
- ✅ **CRÉER** 59 nouveaux produits

### 🔄 Impact sur les Commandes

**ATTENTION** : Si vous avez des commandes existantes dans la table `orders`, elles ne seront **PAS affectées** car :
- Les `order_items` stockent une **copie** des informations produit
- Les relations sont préservées via `product_id` (peut être NULL)

---

## 🖼️ Chemins des Images

Tous les produits utilisent maintenant des **chemins locaux** :

```
images/products/img_product_chien/...
images/products/img_product_chat/...
images/products/img_product_oiseau/...
images/products/img_product_poisson/...
images/products/img_product_peigon/...
```

### ✅ Vérification des Images

Assurez-vous que les images existent bien dans :
```
C:\Users\User\Desktop\animx\AnimalerieHMZ\public\images\products\
```

---

## 📝 Caractéristiques des Produits

Chaque produit inclut :

- ✅ **Nom** descriptif et réaliste
- ✅ **Description** complète
- ✅ **Description courte**
- ✅ **Prix** actuel
- ✅ **Prix ancien** (pour certains produits)
- ✅ **Stock** disponible
- ✅ **SKU** unique
- ✅ **Image** locale
- ✅ **Badges** : Nouveau, Bestseller, Featured
- ✅ **Réduction** (0-32%)
- ✅ **Note** (4.3 - 4.9/5)
- ✅ **Nombre d'avis**

---

## 🔍 Vérification Après Exécution

### 1. Vérifier les Sous-catégories

```sql
SELECT * FROM sub_categories ORDER BY category_id, id;
```

Vous devriez voir **15 sous-catégories**.

### 2. Vérifier les Produits

```sql
SELECT COUNT(*) as total FROM products;
```

Vous devriez voir **59 produits**.

### 3. Vérifier par Catégorie

```sql
SELECT 
    c.name as categorie,
    COUNT(p.id) as nombre_produits
FROM categories c
LEFT JOIN products p ON c.id = p.category_id
GROUP BY c.id, c.name
ORDER BY c.id;
```

### 4. Vérifier les Images

```sql
SELECT id, name, image FROM products LIMIT 10;
```

---

## 🐛 Dépannage

### Erreur : "Foreign key constraint fails"

**Solution** : Le script désactive temporairement les contraintes de clés étrangères.
Si l'erreur persiste, exécutez manuellement :

```sql
SET FOREIGN_KEY_CHECKS = 0;
-- Votre script ici
SET FOREIGN_KEY_CHECKS = 1;
```

### Erreur : "Table doesn't exist"

**Solution** : Vérifiez que vous êtes bien dans la base de données `animaleriehmz` :

```sql
USE animaleriehmz;
```

### Les Images ne s'Affichent Pas

**Solution** : Vérifiez que :
1. Les images existent dans `public/images/products/`
2. Les permissions sont correctes
3. Le lien symbolique storage est créé : `php artisan storage:link`

---

## 📞 Support

Si vous rencontrez des problèmes :

1. Vérifiez les logs Laravel : `storage/logs/laravel.log`
2. Vérifiez les logs MySQL
3. Restaurez votre sauvegarde si nécessaire

---

## ✅ Checklist de Mise à Jour

- [ ] Sauvegarde de la base de données effectuée
- [ ] Fichier `update_products.sql` vérifié
- [ ] Images présentes dans `public/images/products/`
- [ ] Script SQL exécuté avec succès
- [ ] Vérification du nombre de produits (59)
- [ ] Vérification du nombre de sous-catégories (15)
- [ ] Test de l'affichage des produits sur le site
- [ ] Test de l'affichage des images

---

**Date de création** : 17 Mai 2026  
**Version** : 1.0  
**Auteur** : Kiro AI Assistant
