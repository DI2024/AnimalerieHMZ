# 🎠 GUIDE D'UTILISATION - SYSTÈME DE CAROUSEL

## 🚀 Démarrage Rapide

### 1. Structure HTML de Base

```html
<div class="carousel-container">
  <div class="carousel-header">
    <h2 class="carousel-title">Nos Produits</h2>
    <div class="carousel-controls">
      <button class="carousel-btn prev">
        <span class="material-symbols-outlined">chevron_left</span>
      </button>
      <button class="carousel-btn next">
        <span class="material-symbols-outlined">chevron_right</span>
      </button>
    </div>
  </div>
  
  <div class="carousel-wrapper">
    <div class="carousel-track">
      <!-- Vos items ici -->
      <div class="carousel-item">
        <div class="product-card">
          <!-- Contenu carte produit -->
        </div>
      </div>
      <!-- Plus d'items... -->
    </div>
  </div>
  
  <div class="carousel-indicators"></div>
</div>
```

### 2. Initialisation Automatique

Le carousel s'initialise automatiquement au chargement de la page. Aucun code JavaScript nécessaire!

### 3. Options via Data Attributes

```html
<div class="carousel-container" 
     data-autoplay="true" 
     data-interval="3000"
     data-indicators="true"
     data-swipe="true"
     data-keyboard="true">
  <!-- ... -->
</div>
```

---

## 📦 EXEMPLES D'UTILISATION

### Exemple 1: Carousel Produits Simple

```blade
<section class="py-12 bg-white">
  <div class="container-custom">
    <div class="carousel-container">
      <div class="carousel-header">
        <h2 class="carousel-title">Best Sellers</h2>
        <div class="carousel-controls">
          <button class="carousel-btn prev" aria-label="Précédent">
            <span class="material-symbols-outlined">chevron_left</span>
          </button>
          <button class="carousel-btn next" aria-label="Suivant">
            <span class="material-symbols-outlined">chevron_right</span>
          </button>
        </div>
      </div>
      
      <div class="carousel-wrapper">
        <div class="carousel-track">
          @foreach($products as $product)
            <div class="carousel-item w-[230px] md:w-[250px]">
              <div class="product-card group">
                <div class="product-card-image">
                  <img src="{{ $product->image }}" 
                       alt="{{ $product->name }}"
                       loading="lazy">
                </div>
                <div class="product-card-content">
                  <span class="product-card-category">{{ $product->category }}</span>
                  <h3 class="product-card-title">{{ $product->name }}</h3>
                  <div class="product-card-footer">
                    <span class="product-card-price">{{ $product->price }} MAD</span>
                    <button class="product-card-btn">
                      <span class="material-symbols-outlined">shopping_cart</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      
      <div class="carousel-indicators"></div>
    </div>
  </div>
</section>
```

### Exemple 2: Carousel avec Auto-Play

```blade
<div class="carousel-container" 
     data-autoplay="true" 
     data-interval="5000">
  <!-- Structure identique -->
</div>
```

### Exemple 3: Carousel Catégories

```blade
<section class="py-12">
  <div class="container-custom">
    <div class="carousel-container" data-indicators="false">
      <div class="carousel-header">
        <h2 class="carousel-title">Nos Catégories</h2>
        <div class="carousel-controls">
          <button class="carousel-btn prev">←</button>
          <button class="carousel-btn next">→</button>
        </div>
      </div>
      
      <div class="carousel-wrapper">
        <div class="carousel-track">
          @foreach($categories as $category)
            <a href="{{ route('products.index', ['category' => $category->slug]) }}" 
               class="carousel-item w-[180px] md:w-[220px]">
              <div class="flex flex-col items-center gap-3 group">
                <img src="{{ $category->image }}" 
                     alt="{{ $category->name }}"
                     class="w-full h-[180px] md:h-[220px] rounded-3xl object-cover transition transform group-hover:-translate-y-1 group-hover:shadow-lg">
                <span class="font-semibold text-sm text-on-surface group-hover:text-primary">
                  {{ $category->name }}
                </span>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
```

### Exemple 4: Carousel Témoignages

```blade
<section class="py-16 bg-surface-container-low">
  <div class="container-custom">
    <div class="carousel-container" 
         data-autoplay="true" 
         data-interval="7000">
      <div class="carousel-header">
        <h2 class="carousel-title">Ce que disent nos clients</h2>
        <div class="carousel-controls">
          <button class="carousel-btn prev">←</button>
          <button class="carousel-btn next">→</button>
        </div>
      </div>
      
      <div class="carousel-wrapper">
        <div class="carousel-track">
          @foreach($testimonials as $testimonial)
            <div class="carousel-item w-[300px] md:w-[350px]">
              <div class="bg-white rounded-2xl p-6 shadow-md h-full flex flex-col">
                <div class="flex items-center gap-1 mb-4">
                  @for($i = 0; $i < 5; $i++)
                    <span class="material-symbols-outlined text-yellow-400 fill-1">star</span>
                  @endfor
                </div>
                <p class="text-gray-700 mb-6 flex-grow">{{ $testimonial->content }}</p>
                <div class="flex items-center gap-3 pt-4 border-t">
                  <img src="{{ $testimonial->avatar }}" 
                       alt="{{ $testimonial->name }}"
                       class="w-12 h-12 rounded-full">
                  <div>
                    <p class="font-bold text-gray-900">{{ $testimonial->name }}</p>
                    <p class="text-sm text-gray-500">{{ $testimonial->date }}</p>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      
      <div class="carousel-indicators"></div>
    </div>
  </div>
</section>
```

---

## 🎨 PERSONNALISATION

### Largeur des Items

```html
<!-- Mobile: 280px, Desktop: 230px -->
<div class="carousel-item w-[280px] md:w-[230px]">
  <!-- Contenu -->
</div>

<!-- Mobile: 90% de la largeur, Desktop: 300px -->
<div class="carousel-item w-[90%] md:w-[300px]">
  <!-- Contenu -->
</div>
```

### Espacement entre Items

```html
<!-- Gap par défaut: 1.5rem (24px) -->
<div class="carousel-track">
  <!-- Items -->
</div>

<!-- Gap personnalisé: 2rem (32px) -->
<div class="carousel-track gap-8">
  <!-- Items -->
</div>
```

### Style des Boutons

```html
<!-- Boutons par défaut -->
<button class="carousel-btn prev">←</button>

<!-- Boutons personnalisés -->
<button class="carousel-btn prev bg-primary text-white hover:bg-primary-container">
  <span class="material-symbols-outlined">arrow_back</span>
</button>
```

### Masquer les Indicateurs

```html
<!-- Avec indicateurs (défaut) -->
<div class="carousel-container">
  <!-- ... -->
  <div class="carousel-indicators"></div>
</div>

<!-- Sans indicateurs -->
<div class="carousel-container" data-indicators="false">
  <!-- ... -->
  <!-- Pas de div.carousel-indicators -->
</div>
```

---

## ⚙️ OPTIONS AVANCÉES

### Initialisation Manuelle

```javascript
// Sélectionner l'élément
const element = document.querySelector('#mon-carousel');

// Créer instance avec options
const carousel = new Carousel(element, {
  itemsToScroll: 2,           // Nombre d'items à scroller
  autoPlay: true,             // Auto-play activé
  autoPlayInterval: 3000,     // Intervalle 3s
  showIndicators: true,       // Afficher dots
  enableSwipe: true,          // Swipe gestures
  enableKeyboard: true        // Navigation clavier
});

// Méthodes disponibles
carousel.next();              // Aller au suivant
carousel.prev();              // Aller au précédent
carousel.scrollToIndex(3);    // Aller à l'index 3
carousel.startAutoPlay();     // Démarrer auto-play
carousel.stopAutoPlay();      // Arrêter auto-play
carousel.destroy();           // Détruire instance
```

### Events Personnalisés

```javascript
const carousel = new Carousel(element);

// Écouter les changements
carousel.wrapper.addEventListener('scroll', () => {
  console.log('Scroll position:', carousel.currentIndex);
});
```

---

## 📱 RESPONSIVE

### Breakpoints Recommandés

```html
<!-- Mobile: 1 item visible (280px) -->
<!-- Tablette: 2-3 items visibles (220px) -->
<!-- Desktop: 4-5 items visibles (230px) -->

<div class="carousel-item w-[280px] sm:w-[220px] lg:w-[230px]">
  <!-- Contenu -->
</div>
```

### Masquer Contrôles sur Mobile

```html
<div class="carousel-controls hidden md:flex">
  <button class="carousel-btn prev">←</button>
  <button class="carousel-btn next">→</button>
</div>
```

---

## ♿ ACCESSIBILITÉ

### ARIA Labels

```html
<button class="carousel-btn prev" aria-label="Produit précédent">
  <span class="material-symbols-outlined" aria-hidden="true">chevron_left</span>
</button>

<button class="carousel-btn next" aria-label="Produit suivant">
  <span class="material-symbols-outlined" aria-hidden="true">chevron_right</span>
</button>
```

### Navigation Clavier

Le carousel supporte automatiquement:
- **Flèche gauche**: Item précédent
- **Flèche droite**: Item suivant
- **Tab**: Focus sur contrôles

### Focus Visible

```css
/* Déjà inclus dans app.css */
*:focus-visible {
  outline: 2px solid var(--color-primary);
  outline-offset: 2px;
}
```

---

## 🐛 DÉPANNAGE

### Le carousel ne s'initialise pas

**Vérifier:**
1. Le script `carousel.js` est bien chargé
2. La structure HTML est correcte (`.carousel-container`, `.carousel-wrapper`, `.carousel-track`)
3. Il y a au moins 1 item dans `.carousel-track`
4. Pas d'erreurs JavaScript dans la console

### Les boutons ne fonctionnent pas

**Vérifier:**
1. Les classes `.carousel-btn`, `.prev`, `.next` sont présentes
2. Les boutons sont à l'intérieur de `.carousel-container`
3. Pas de `disabled` sur les boutons

### Le swipe ne fonctionne pas

**Vérifier:**
1. `data-swipe="true"` (ou non spécifié, true par défaut)
2. Tester sur un vrai device mobile (pas émulateur)
3. Pas de `touch-action: none` sur les parents

### Les indicateurs ne s'affichent pas

**Vérifier:**
1. `<div class="carousel-indicators"></div>` est présent
2. `data-indicators="true"` (ou non spécifié, true par défaut)
3. Il y a plusieurs items (> visibleItems)

---

## 💡 BONNES PRATIQUES

### 1. Lazy Loading Images

```html
<img data-src="{{ $product->image }}" 
     alt="{{ $product->name }}"
     loading="lazy"
     class="lazy">
```

Le script `carousel.js` charge automatiquement les images avec `data-src`.

### 2. Largeur Fixe des Items

Toujours définir une largeur fixe pour les items:

```html
<!-- ✅ BON -->
<div class="carousel-item w-[230px]">

<!-- ❌ MAUVAIS -->
<div class="carousel-item">
```

### 3. Gap Cohérent

Utiliser le même gap partout:

```html
<div class="carousel-track gap-6">
  <!-- Items -->
</div>
```

### 4. Hauteur Uniforme

Assurer que tous les items ont la même hauteur:

```html
<div class="carousel-item w-[230px]">
  <div class="product-card h-full">
    <!-- Contenu -->
  </div>
</div>
```

### 5. Performance

- Limiter le nombre d'items (max 50)
- Utiliser lazy loading pour images
- Éviter animations lourdes dans items

---

## 📚 RESSOURCES

### Fichiers Concernés
- `resources/css/app.css`: Styles carousel
- `public/js/carousel.js`: Logique JavaScript
- `resources/views/layouts/public.blade.php`: Intégration

### Documentation Complète
- `ANALYSE_ULTRA_DETAILLEE_RESPONSIVITE.md`: Analyse technique
- `AMELIORATIONS_RESPONSIVITE_IMPLEMENTEES.md`: Implémentation

### Support
- GitHub Issues: [Lien vers repo]
- Documentation Laravel: https://laravel.com/docs
- Tailwind CSS: https://tailwindcss.com/docs

---

## ✅ CHECKLIST INTÉGRATION

Avant de déployer un nouveau carousel:

- [ ] Structure HTML correcte
- [ ] Largeur fixe sur items
- [ ] ARIA labels sur boutons
- [ ] Alt text sur images
- [ ] Lazy loading activé
- [ ] Testé sur mobile
- [ ] Testé swipe gestures
- [ ] Testé navigation clavier
- [ ] Testé avec 1, 5, 10, 20 items
- [ ] Pas de débordement horizontal
- [ ] Animations fluides (60fps)

---

*Guide créé le 19 Mai 2026*
*Version: 1.0.0*
*Auteur: Kiro AI*
