# Admin Panel - Responsivité Mobile

## Modifications Effectuées

### 1. **Sidebar Mobile avec Menu Hamburger**

#### Layout Admin (`admin.blade.php`)
✅ **Sidebar responsive**
- Desktop : Sidebar fixe à gauche (280px)
- Mobile : Sidebar cachée par défaut, slide depuis la gauche
- Overlay sombre quand le menu est ouvert
- Animation smooth (0.3s ease-in-out)

#### Bouton Hamburger
```html
<button class="mobile-menu-btn" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>
```

**Caractéristiques :**
- Visible uniquement en mobile (< 1024px)
- Style : 44×44px, bordure arrondie, ombre
- Position : À gauche du titre de page

#### Overlay
```html
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
```

**Comportement :**
- Fond noir semi-transparent (rgba(0,0,0,0.5))
- Clic sur overlay → ferme le menu
- Bloque le scroll du body quand ouvert

### 2. **Dashboard - Cartes en Scroll Horizontal**

#### Section Alerts (3 cartes)
- **Mobile** : Scroll horizontal, 1 carte visible (85%)
- **Desktop** : Grid auto-fit
- **Dots** : Indicateurs animés en bas

#### Section Metrics (4 cartes)
- **Mobile** : Scroll horizontal, 1 carte visible (85%)
- **Desktop** : Grid auto-fit
- **Dots** : Indicateurs animés en bas

#### CSS Mobile
```css
@media (max-width: 767px) {
    .alerts-grid, .metrics-grid {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scrollbar-width: none;
    }
    
    .alert-card, .metric-card {
        flex: 0 0 85%;
        scroll-snap-align: center;
    }
}
```

### 3. **Tableau Commandes - Mode Carte Mobile**

#### Desktop
```
┌─────────────────────────────────────────────┐
│ ID  │ Client │ Total │ Statut │ Date │ ... │
├─────────────────────────────────────────────┤
│ #001│ John   │ 150 DH│ Pending│ 2h   │ 👁  │
└─────────────────────────────────────────────┘
```

#### Mobile
```
┌─────────────────────────────────────┐
│ ID:        #001                     │
│ CLIENT:    John Doe                 │
│ TOTAL:     150,00 DH                │
│ STATUT:    🕐 En attente            │
│ DATE:      Il y a 2 heures          │
│            [👁 Voir]                │
└─────────────────────────────────────┘
```

**Transformation :**
- `thead` caché
- `tr` → block avec bordure et padding
- `td` → flex avec label avant le contenu
- Attribut `data-label` pour les labels

### 4. **Header Admin Responsive**

#### Desktop
```
┌─────────────────────────────────────────────┐
│ Tableau de bord              [A] Admin      │
│ Bienvenue...                 En ligne       │
└─────────────────────────────────────────────┘
```

#### Mobile
```
┌─────────────────────────────────────────────┐
│ ☰  Tableau de bord                          │
│    Bienvenue...                             │
└─────────────────────────────────────────────┘
```

**Changements :**
- Titre : 3xl → 1.5rem (md) → 1.25rem (sm)
- Avatar admin : caché en mobile
- Padding : 40px → 20px (md) → 16px (sm)

### 5. **JavaScript**

#### Fonction `toggleSidebar()`
```javascript
function toggleSidebar() {
    sidebar.classList.toggle('active');
    overlay.classList.toggle('active');
    
    // Bloque le scroll du body
    if (sidebar.classList.contains('active')) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = '';
    }
}
```

#### Auto-fermeture
- Clic sur un lien → ferme le menu (mobile uniquement)
- Clic sur overlay → ferme le menu

#### Indicateurs Dashboard
```javascript
initDashboardScrollIndicators()
- Détecte le scroll
- Met à jour les dots actifs
- Gère le redimensionnement
```

## Breakpoints

| Breakpoint | Comportement |
|------------|--------------|
| ≥ 1024px   | Sidebar fixe, layout desktop |
| < 1024px   | Sidebar cachée, bouton hamburger visible |
| < 768px    | Cartes en scroll horizontal, tableau en mode carte |
| < 640px    | Padding réduit, textes plus petits |

## Fichiers Modifiés

| Fichier | Modifications |
|---------|--------------|
| `resources/views/layouts/admin.blade.php` | ✅ Sidebar mobile + overlay + hamburger |
| `resources/views/admin/dashboard.blade.php` | ✅ Cartes scroll + tableau responsive + dots |

## Résultat Mobile

### Sidebar
```
[Fermée]                    [Ouverte]
┌──────────────┐           ┌──────────────┐
│ ☰ Dashboard  │           │█████████████ │
│              │           │█ Sidebar    █│
│ Content...   │           │█ Menu...    █│
│              │           │█            █│
└──────────────┘           └──────────────┘
```

### Dashboard
```
┌─────────────────────────────────────┐
│ ☰  Dashboard                        │
├─────────────────────────────────────┤
│ ALERTS                              │
│ [Carte 1 visible] →                 │
│         ● ○ ○                       │
├─────────────────────────────────────┤
│ METRICS                             │
│ [Carte 1 visible] →                 │
│       ● ○ ○ ○                       │
├─────────────────────────────────────┤
│ COMMANDES                           │
│ ┌─────────────────────────────────┐ │
│ │ ID:     #001                    │ │
│ │ CLIENT: John                    │ │
│ │ TOTAL:  150 DH                  │ │
│ └─────────────────────────────────┘ │
└─────────────────────────────────────┘
```

---

**Date:** 19 Mai 2026  
**Status:** ✅ Complété  
**Breakpoint Mobile:** < 1024px (sidebar), < 768px (cartes)  
**Animations:** Sidebar slide, dots animés, smooth transitions
