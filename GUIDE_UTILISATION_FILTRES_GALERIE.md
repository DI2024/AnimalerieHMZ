# 📱 GUIDE D'UTILISATION - FILTRES & GALERIE MOBILE

## 🎯 VUE D'ENSEMBLE

Ce guide explique comment utiliser les nouvelles fonctionnalités mobile pour les pages produits.

---

## 1️⃣ FILTRES BOTTOM SHEET (Page Liste Produits)

### 📍 Où le trouver ?
- **URL** : `http://localhost:8000/products`
- **Mode** : Mobile uniquement (< 1024px)

### 🎨 Apparence
```
┌─────────────────────────────┐
│                             │
│   [Produits affichés]       │
│                             │
│                             │
│                             │
│         ┌─────────┐         │
│         │ Filtres │ ← Bouton fixe en bas
│         └─────────┘         │
└─────────────────────────────┘
```

### 🔄 Fonctionnement

#### Étape 1 : Cliquer sur "Filtres"
```
┌─────────────────────────────┐
│ ████████████████████████████│ ← Overlay sombre
│ ████████████████████████████│
│ ╔═══════════════════════════╗
│ ║  Filtres            [X]   ║ ← Header sticky
│ ╠═══════════════════════════╣
│ ║ 📂 Catégories             ║
│ ║   ○ Toutes                ║
│ ║   ○ Chiens (12)           ║
│ ║   ○ Chats (8)      [▼]    ║
│ ║                           ║
│ ║ 💰 Prix                   ║
│ ║   [Min] [Max]             ║
│ ║                           ║
│ ║ ⚙️ Options                ║
│ ║   ☑ Nouveautés            ║
│ ║   ☐ Best Sellers          ║
│ ║                           ║
│ ║ [Appliquer les filtres]   ║
│ ║ [Réinitialiser]           ║
│ ╚═══════════════════════════╝
└─────────────────────────────┘
```

#### Étape 2 : Sélectionner les filtres
- **Catégories** : Cliquer sur une catégorie ou sous-catégorie
- **Prix** : Entrer min/max
- **Options** : Cocher Nouveautés ou Best Sellers

#### Étape 3 : Appliquer ou Fermer
- **Appliquer** : Soumet le formulaire et filtre les produits
- **Réinitialiser** : Supprime tous les filtres
- **[X]** ou **Overlay** : Ferme sans appliquer

### 🎭 Animations
- **Ouverture** : Slide du bas vers le haut (300ms)
- **Fermeture** : Slide du haut vers le bas (300ms)
- **Overlay** : Fade in/out (300ms)

### 🔧 Détails Techniques
- **Z-index** : 9999 (au-dessus de tout)
- **Hauteur max** : 85vh (scrollable si plus)
- **Coins** : Arrondis en haut (rounded-t-3xl)
- **Scroll body** : Bloqué quand ouvert

---

## 2️⃣ GALERIE PRODUIT SCROLL (Page Détails Produit)

### 📍 Où le trouver ?
- **URL** : `http://localhost:8000/products/{slug}`
- **Mode** : Mobile uniquement (< 768px)
- **Condition** : Produit avec plusieurs images

### 🎨 Apparence

#### Avec plusieurs images (Mobile)
```
┌─────────────────────────────┐
│ ╔═══════════════════════════╗│
│ ║                           ║│
│ ║      [Image 1]            ║│ ← Swipe →
│ ║                           ║│
│ ╚═══════════════════════════╝│
│         ● ○ ○ ○              │ ← Dots indicateurs
└─────────────────────────────┘
```

#### Avec une seule image (Mobile + Desktop)
```
┌─────────────────────────────┐
│ ╔═══════════════════════════╗│
│ ║                           ║│
│ ║      [Image unique]       ║│
│ ║                           ║│
│ ╚═══════════════════════════╝│
│         (pas de dots)        │
└─────────────────────────────┘
```

### 🔄 Fonctionnement

#### Navigation
1. **Swipe gauche** : Image suivante
2. **Swipe droite** : Image précédente
3. **Dots** : Indiquent la position actuelle

#### Comportement
- **Snap** : L'image se centre automatiquement
- **Smooth scroll** : Animation fluide
- **Touch-friendly** : Optimisé pour le tactile

### 🎭 Animations
- **Scroll** : Snap smooth (CSS)
- **Dots** : Transition 300ms
  - Inactif : Cercle 8px gris
  - Actif : Rectangle 24px bleu

### 🔧 Détails Techniques
- **Largeur slide** : 100% (1 image visible)
- **Scroll snap** : Mandatory (force le snap)
- **Dots position** : Absolute, bottom 1rem
- **Z-index dots** : 5 (au-dessus de l'image)

---

## 3️⃣ STRUCTURE DES FICHIERS

### CSS (`public/css/mobile-scroll.css`)
```css
/* Bottom Sheet Filtres */
@media (max-width: 1023px) {
  #filtersBottomSheet { ... }
  #filtersSheet { ... }
}

/* Galerie Produit */
@media (max-width: 767px) {
  .product-gallery-scroll { ... }
  .product-gallery-slide { ... }
  .product-gallery-indicators { ... }
  .product-gallery-dot { ... }
}
```

### JavaScript (`public/js/testimonials-scroll.js`)
```javascript
// Bottom Sheet
const openFiltersBtn = ...
const closeFiltersBtn = ...
function closeFiltersBottomSheet() { ... }

// Galerie Produit
function initProductGalleryIndicators() { ... }
function updateActiveDot() { ... }
```

### Blade (`resources/views/client/products/`)
```php
// index.blade.php
<button id="openFiltersBtn">Filtres</button>
<div id="filtersBottomSheet">...</div>

// show.blade.php
@if(count($productImages) > 1)
  <div class="product-gallery-scroll">...</div>
  <div class="product-gallery-indicators">...</div>
@else
  <img>
@endif
```

---

## 4️⃣ PERSONNALISATION

### Changer la hauteur du Bottom Sheet
```css
/* Dans mobile-scroll.css */
#filtersSheet {
  max-h-[85vh] /* Changer ici (ex: 90vh, 80vh) */
}
```

### Changer la couleur des dots
```css
/* Dans mobile-scroll.css */
.product-gallery-dot {
  background-color: #d1d5db; /* Inactif */
}
.product-gallery-dot.active {
  background-color: #003e87; /* Actif (bleu primaire) */
}
```

### Changer la vitesse d'animation
```css
/* Dans mobile-scroll.css */
#filtersSheet {
  transition-transform duration-300 /* Changer ici (ex: 500ms) */
}
```

### Ajouter plusieurs images à un produit
```php
// Dans show.blade.php, ligne 8-11
@php
    $productImages = [
        $product->image,
        $product->image2,  // Ajouter colonne dans DB
        $product->image3,  // Ajouter colonne dans DB
    ];
@endphp
```

---

## 5️⃣ COMPATIBILITÉ

### Navigateurs supportés
- ✅ Chrome (mobile + desktop)
- ✅ Safari (iOS + macOS)
- ✅ Firefox (mobile + desktop)
- ✅ Edge (mobile + desktop)

### Breakpoints
- **Mobile** : < 768px (galerie)
- **Tablet** : < 1024px (bottom sheet)
- **Desktop** : ≥ 1024px (sidebar visible)

### Features CSS utilisées
- `scroll-snap-type` (scroll snap)
- `transform: translateY()` (animation)
- `backdrop-filter` (blur - optionnel)
- `transition` (animations smooth)

---

## 6️⃣ DÉPANNAGE

### Le bottom sheet ne s'ouvre pas
1. Vérifier que `mobile-scroll.css` est bien lié
2. Vérifier que `testimonials-scroll.js` est bien lié
3. Ouvrir la console (F12) pour voir les erreurs
4. Vérifier que le bouton a l'ID `openFiltersBtn`

### Les dots ne s'affichent pas
1. Vérifier qu'il y a plusieurs images (`count($productImages) > 1`)
2. Vérifier que la classe `product-gallery-indicators` existe
3. Vérifier que le JavaScript s'exécute (console)

### Le scroll ne fonctionne pas
1. Vérifier que `overflow-x: auto` est appliqué
2. Vérifier que `scroll-snap-type: x mandatory` est appliqué
3. Tester sur un vrai appareil mobile (pas seulement DevTools)

### Le layout desktop est cassé
1. Vérifier les media queries (`@media (max-width: ...)`)
2. Vérifier que les classes `hidden lg:block` sont présentes
3. Vérifier que le CSS n'affecte pas le desktop

---

## 7️⃣ AMÉLIORATIONS FUTURES

### Possibles ajouts
- [ ] Swipe pour fermer le bottom sheet
- [ ] Zoom sur les images de la galerie
- [ ] Lightbox pour voir les images en plein écran
- [ ] Lazy loading des images
- [ ] Préchargement de l'image suivante
- [ ] Indicateur de chargement
- [ ] Animation de transition entre images
- [ ] Support du clavier (flèches gauche/droite)

---

## 📞 SUPPORT

Si vous rencontrez des problèmes :
1. Vérifier ce guide
2. Consulter `TASK_5_RESPONSIVITE_PRODUITS_COMPLETE.md`
3. Vérifier la console du navigateur (F12)
4. Tester sur un vrai appareil mobile

---

**Dernière mise à jour** : 2026-05-19
**Version** : 1.0.0
