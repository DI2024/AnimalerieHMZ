# 📊 Analyse du Projet - Animalerie HMZ

## 🎯 Vue d'ensemble

**Animalerie HMZ** est une application e-commerce Laravel 12 pour la vente de produits animaliers avec un dashboard administrateur complet.

---

## 🏗️ Architecture Technique

### Stack Technologique

#### Backend
- **Framework**: Laravel 12 (PHP 8.2+)
- **Base de données**: SQLite (par défaut) / MySQL / PostgreSQL
- **ORM**: Eloquent
- **Authentification**: Laravel Auth (session-based)

#### Frontend
- **CSS Framework**: Tailwind CSS 4.3
- **Build Tool**: Vite 7.0
- **JavaScript**: Vanilla JS (ES6+)
- **Icons**: Material Symbols Outlined
- **Fonts**: Plus Jakarta Sans, Manrope

#### Outils de développement
- **Package Manager**: Composer (PHP), NPM (JS)
- **Testing**: PHPUnit 11.5
- **Code Quality**: Laravel Pint
- **Dev Tools**: Laravel Sail, Laravel Pail, Laravel Tinker

---

## 📁 Structure du Projet

```
AnimalerieHMZ/
├── app/
│   ├── Http/Controllers/
│   │   └── Admin/
│   │       ├── CategoryController.php
│   │       ├── DashboardController.php
│   │       ├── OfferController.php
│   │       ├── OrderController.php
│   │       ├── ProductController.php
│   │       ├── SectionController.php
│   │       └── SettingController.php
│   ├── Models/
│   │   ├── Category.php
│   │   ├── Offer.php
│   │   ├── Product.php
│   │   ├── SubCategory.php
│   │   └── User.php
│   └── Providers/
├── database/
│   ├── migrations/
│   │   ├── 2026_05_16_000001_create_categories_table.php
│   │   ├── 2026_05_16_000002_create_sub_categories_table.php
│   │   ├── 2026_05_16_000003_create_offers_table.php
│   │   └── 2026_05_16_000004_create_products_table.php
│   ├── factories/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── admin/ (Dashboard views)
│   │   ├── auth/ (Login/Register)
│   │   ├── layouts/
│   │   └── welcome.blade.php
│   ├── css/app.css
│   └── js/app.js
├── routes/
│   ├── web.php
│   └── console.php
└── public/
    └── images/
```

---

## 🗄️ Schéma de Base de Données

### Tables Existantes

#### 1. **categories**
```sql
- id (PK)
- name (string)
- slug (string, unique)
- icon (string, nullable) - Material symbol name
- image (string, nullable) - Banner image
- is_active (boolean, default: true)
- timestamps
```

**Relations:**
- `hasMany` SubCategory
- `hasMany` Product

#### 2. **sub_categories**
```sql
- id (PK)
- category_id (FK → categories)
- name (string)
- slug (string, unique)
- image (string, nullable)
- is_active (boolean, default: true)
- timestamps
```

**Relations:**
- `belongsTo` Category
- `hasMany` Product

#### 3. **products**
```sql
- id (PK)
- category_id (FK → categories)
- subcategory_id (FK → sub_categories, nullable)
- name (string)
- slug (string, unique)
- description (text, nullable)
- short_description (string, nullable)
- price (decimal 10,2)
- price_old (decimal 10,2, nullable)
- stock (integer, default: 0)
- sku (string, unique, nullable)
- image (string, nullable)
- is_active (boolean, default: true)
- is_new (boolean, default: false)
- is_bestseller (boolean, default: false)
- is_featured (boolean, default: false)
- discount_percentage (integer, default: 0)
- rating (decimal 2,1, default: 5.0)
- review_count (integer, default: 0)
- timestamps
```

**Relations:**
- `belongsTo` Category
- `belongsTo` SubCategory

#### 4. **offers**
```sql
- id (PK)
- title (string)
- subtitle (string, nullable)
- badge (string, nullable)
- image (string, nullable)
- link (string, nullable)
- bg_color (string, nullable)
- is_active (boolean, default: true)
- timestamps
```

#### 5. **users** (Laravel default)
```sql
- id (PK)
- name (string)
- email (string, unique)
- email_verified_at (timestamp, nullable)
- password (string)
- remember_token (string, nullable)
- timestamps
```

---

## 🎨 Interface Utilisateur

### Pages Client (Frontend)

1. **Page d'accueil** (`/`)
   - Hero section avec image
   - Section offres (3 cartes promotionnelles)
   - Catégories d'animaux (Oiseaux, Pigeons, Chats, Chiens, Poissons)
   - Best Sellers carousel
   - Sections par catégorie (Oiseaux, Chats)
   - Footer avec réseaux sociaux

2. **Authentification**
   - Login (`/login`) - Design moderne avec hero section
   - Register (`/register`) - Formulaire complet avec validation
   - Mode sombre disponible

### Dashboard Admin (`/admin`)

**Contrôleurs existants:**
- ✅ DashboardController - Vue d'ensemble
- ✅ ProductController - Gestion produits (actuellement avec données mockées)
- ✅ CategoryController - Gestion catégories
- ✅ OfferController - Gestion offres
- ✅ OrderController - Gestion commandes
- ✅ SectionController - Gestion sections homepage
- ✅ SettingController - Paramètres

---

## 🔧 État Actuel du Projet

### ✅ Complété
- [x] Structure Laravel 12 configurée
- [x] Migrations de base de données créées et exécutées
- [x] Modèles Eloquent définis avec relations
- [x] Interface client (frontend) complète avec design moderne
- [x] Pages d'authentification (login/register)
- [x] Layout admin avec sidebar
- [x] Vues admin pour tous les modules
- [x] Mode sombre implémenté
- [x] Panier JavaScript (localStorage)
- [x] Design responsive

### ⚠️ En Cours / À Faire
- [ ] **Seeders** - Données de test manquantes
- [ ] **Admin Controllers** - Utilisent des données mockées
- [ ] **Frontend dynamique** - Produits hardcodés en JS
- [ ] **Système de commandes** - Tables et logique manquantes
- [ ] **Upload d'images** - Gestion fichiers à implémenter
- [ ] **API REST** - Pour le panier et checkout
- [ ] **Validation** - FormRequests à créer
- [ ] **Tests** - Aucun test écrit

---

## 🚀 Plan de Développement (4 Phases)

### **Phase 1: Database Setup & Seeders** 🎯 CURRENT
**Objectif:** Peupler la base de données avec des données réalistes

**Tâches:**
1. Créer CategorySeeder avec catégories réelles
2. Créer SubCategorySeeder
3. Créer ProductSeeder (50-100 produits)
4. Créer OfferSeeder
5. Créer AdminUserSeeder (admin@hmz.com / password)
6. Configurer DatabaseSeeder

**Livrables:**
- Seeders fonctionnels
- Base de données peuplée
- Commande: `php artisan db:seed`

---

### **Phase 2: Admin Dashboard - Real Data**
**Objectif:** Connecter le dashboard admin aux vraies données

**Tâches:**
1. **ProductController**
   - Index: Liste paginée depuis DB
   - Create: Formulaire avec upload image
   - Store: Validation + sauvegarde
   - Edit: Chargement produit
   - Update: Modification
   - Delete: Suppression

2. **CategoryController**
   - CRUD complet
   - Gestion sous-catégories

3. **OfferController**
   - CRUD offres promotionnelles

4. **DashboardController**
   - Statistiques réelles (produits, commandes, revenus)

**Livrables:**
- Admin fonctionnel avec vraies données
- Upload d'images
- Validation des formulaires

---

### **Phase 3: Client Interface - Dynamic Loading**
**Objectif:** Charger les produits depuis la base de données

**Tâches:**
1. **HomeController**
   - Charger catégories actives
   - Charger offres actives
   - Charger bestsellers
   - Charger nouveautés

2. **ProductController (Client)**
   - Liste produits par catégorie
   - Détail produit
   - Recherche

3. **API Routes**
   - GET /api/products
   - GET /api/products/{slug}
   - GET /api/categories

4. **JavaScript Update**
   - Remplacer données mockées
   - Fetch API pour charger produits
   - Filtres dynamiques

**Livrables:**
- Homepage dynamique
- Produits chargés depuis DB
- Filtres fonctionnels

---

### **Phase 4: Orders & Checkout**
**Objectif:** Système de commandes complet

**Tâches:**
1. **Migrations**
   - create_orders_table
   - create_order_items_table
   - create_addresses_table

2. **Models**
   - Order
   - OrderItem
   - Address

3. **Controllers**
   - CartController (API)
   - CheckoutController
   - OrderController (Client)

4. **Views**
   - Panier
   - Checkout
   - Confirmation
   - Historique commandes

5. **Admin**
   - Gestion commandes réelles
   - Changement de statut
   - Impression factures

**Livrables:**
- Système de commandes fonctionnel
- Panier persistant
- Checkout complet
- Gestion admin des commandes

---

## 🔐 Authentification

### Credentials Admin
- **Email:** admin@hmz.com
- **Password:** password

### Guards
- `web` - Session-based (default)
- Provider: Eloquent (User model)

---

## 🎨 Design System

### Couleurs (Tailwind Config)
```css
--color-primary: #003e87 (Bleu foncé)
--color-primary-container: #0855b1
--color-secondary: #4e599d
--color-tertiary: #4fa5d8 (Bleu clair)
--color-surface: #fbf8ff
--color-error: #ba1a1a
```

### Typographie
- **Headlines:** Plus Jakarta Sans (Bold, Extrabold)
- **Body:** Manrope (Regular, Medium, Bold)

### Composants
- Boutons arrondis (rounded-full)
- Cards avec shadow-xl
- Animations (float, blob, fade)
- Glassmorphism effects
- Dark mode support

---

## 📦 Dépendances Principales

### PHP (composer.json)
```json
{
  "laravel/framework": "^12.0",
  "laravel/tinker": "^2.10.1"
}
```

### JavaScript (package.json)
```json
{
  "tailwindcss": "^4.3.0",
  "vite": "^7.0.7",
  "axios": "^1.11.0",
  "@tailwindcss/vite": "^4.0.0"
}
```

---

## 🚦 Commandes Utiles

```bash
# Développement
composer install
npm install
php artisan key:generate
php artisan migrate
php artisan db:seed
npm run dev
php artisan serve

# Production
npm run build
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Tests
php artisan test
php artisan pint (code style)
```

---

## 📝 Notes Importantes

1. **Images:** Actuellement stockées dans `public/images/` - À migrer vers `storage/app/public`
2. **Panier:** Utilise localStorage - À migrer vers session/DB
3. **Paiement:** Non implémenté - À ajouter (Stripe, PayPal, etc.)
4. **Email:** Configuration mail à faire pour notifications
5. **Sécurité:** CSRF activé, validation à renforcer
6. **Performance:** Pas de cache implémenté (Redis recommandé)

---

## 🎯 Prochaine Étape

**Phase 1 en cours:** Création des seeders pour peupler la base de données avec des données réalistes.

---

*Dernière mise à jour: 16 Mai 2026*
