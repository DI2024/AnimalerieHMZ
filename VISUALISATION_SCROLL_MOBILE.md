# 📱 VISUALISATION - SCROLL HORIZONTAL MOBILE

## 🎨 APERÇU VISUEL DU COMPORTEMENT

Ce document illustre visuellement comment les sections se comportent en mode mobile.

---

## 1️⃣ SECTION OFFRES (Offers)

### Mode Mobile (< 768px)
```
┌─────────────────────────────────────────┐
│  📱 ÉCRAN MOBILE (375px)                │
├─────────────────────────────────────────┤
│                                         │
│  ┌───────────────────────────────┐     │
│  │  🔥 Offre Spéciale            │ ◄── Carte visible (85%)
│  │  Jusqu'à 25% de remise        │
│  │  Sur toute la gamme Chien  🐕 │
│  └───────────────────────────────┘     │
│                                         │
│  ◄─────────────────────────────────►   │
│         Swipe pour voir plus           │
│                                         │
└─────────────────────────────────────────┘

Après swipe vers la gauche:
┌─────────────────────────────────────────┐
│  📱 ÉCRAN MOBILE (375px)                │
├─────────────────────────────────────────┤
│                                         │
│     ┌───────────────────────────────┐  │
│     │  ✨ Exclusivité Web           │ ◄── Carte 2 visible
│     │  -15% Accessoires             │
│     │  Pour Chats et Rongeurs   🐱 │
│     └───────────────────────────────┘  │
│                                         │
│  ◄─────────────────────────────────►   │
│         Swipe pour voir plus           │
│                                         │
└─────────────────────────────────────────┘

PAS d'indicateurs (dots)
```

### Mode Desktop (≥ 768px)
```
┌─────────────────────────────────────────────────────────────────────┐
│  💻 ÉCRAN DESKTOP (1280px)                                          │
├─────────────────────────────────────────────────────────────────────┤
│                                                                     │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐            │
│  │ 🔥 Offre 1   │  │ ✨ Offre 2   │  │ 🎁 Offre 3   │            │
│  │ -25% Chien   │  │ -15% Chat    │  │ Pack Cadeau  │            │
│  │          🐕  │  │          🐱  │  │          🎁  │            │
│  └──────────────┘  └──────────────┘  └──────────────┘            │
│                                                                     │
│  Grid 3 colonnes - Toutes visibles en même temps                   │
│                                                                     │
└─────────────────────────────────────────────────────────────────────┘
```

---

## 2️⃣ SECTION PIGEONS

### Mode Mobile (< 768px)
```
┌─────────────────────────────────────────┐
│  📱 ÉCRAN MOBILE (375px)                │
├─────────────────────────────────────────┤
│                                         │
│  ┌─────────────────────────────────┐   │
│  │  🕊️ BANNER PIGEONS (FIXE)       │   │
│  │  Tout pour les Pigeons          │   │
│  └─────────────────────────────────┘   │
│                                         │
│  ┌───────────────────────────────┐     │
│  │  Cages & Volières         🏠  │ ◄── Carte 1 visible (85%)
│  └───────────────────────────────┘     │
│                                         │
│  ◄─────────────────────────────────►   │
│         Swipe pour voir plus           │
│                                         │
└─────────────────────────────────────────┘

Après swipe:
┌─────────────────────────────────────────┐
│  📱 ÉCRAN MOBILE (375px)                │
├─────────────────────────────────────────┤
│                                         │
│  ┌─────────────────────────────────┐   │
│  │  🕊️ BANNER PIGEONS (FIXE)       │   │
│  │  Tout pour les Pigeons          │   │
│  └─────────────────────────────────┘   │
│                                         │
│     ┌───────────────────────────────┐  │
│     │  Graines & Nutrition      🌾  │ ◄── Carte 2 visible
│     └───────────────────────────────┘  │
│                                         │
│  ◄─────────────────────────────────►   │
│         Swipe pour voir plus           │
│                                         │
└─────────────────────────────────────────┘

PAS d'indicateurs (dots)
Banner reste FIXE, seules les cartes scrollent
```

### Mode Desktop (≥ 768px)
```
┌─────────────────────────────────────────────────────────────────────┐
│  💻 ÉCRAN DESKTOP (1280px)                                          │
├─────────────────────────────────────────────────────────────────────┤
│                                                                     │
│  ┌───────────────────────────────────────────────────────────┐    │
│  │  🕊️ BANNER PIGEONS - Image pleine largeur                 │    │
│  │  Tout pour les Pigeons                                     │    │
│  └───────────────────────────────────────────────────────────┘    │
│                                                                     │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐            │
│  │ Cages &      │  │ Graines &    │  │ Accessoires  │            │
│  │ Volières 🏠  │  │ Nutrition 🌾 │  │          🎨  │            │
│  └──────────────┘  └──────────────┘  └──────────────┘            │
│                                                                     │
│  Grid 3 colonnes - Toutes visibles en même temps                   │
│                                                                     │
└─────────────────────────────────────────────────────────────────────┘
```

---

## 3️⃣ SECTION AVIS (Testimonials)

### Mode Mobile (< 768px)
```
┌─────────────────────────────────────────┐
│  📱 ÉCRAN MOBILE (375px)                │
├─────────────────────────────────────────┤
│                                         │
│  ┌───────────────────────────────────┐ │
│  │  ⭐⭐⭐⭐⭐                          │ │
│  │                                   │ │
│  │  "Excellent service et produits  │ │ ◄── Avis 1 visible (90%)
│  │   de qualité. Mon chat adore     │ │
│  │   ses nouvelles croquettes!"     │ │
│  │                                   │ │
│  │  👤 Sophie Martin                │ │
│  │     Cliente vérifiée             │ │
│  └───────────────────────────────────┘ │
│                                         │
│  ◄─────────────────────────────────►   │
│         Swipe pour voir plus           │
│                                         │
│         ● ○ ○                          │ ◄── Indicateurs (dots)
│      (Avis 1 actif)                    │
│                                         │
└─────────────────────────────────────────┘

Après swipe vers la gauche:
┌─────────────────────────────────────────┐
│  📱 ÉCRAN MOBILE (375px)                │
├─────────────────────────────────────────┤
│                                         │
│   ┌───────────────────────────────────┐│
│   │  ⭐⭐⭐⭐⭐                          ││
│   │                                   ││
│   │  "Livraison rapide et emballage  ││ ◄── Avis 2 visible
│   │   soigné. La volière est         ││
│   │   magnifique!"                   ││
│   │                                   ││
│   │  👤 Marc Dubois                  ││
│   │     Client vérifié               ││
│   └───────────────────────────────────┘│
│                                         │
│  ◄─────────────────────────────────►   │
│         Swipe pour voir plus           │
│                                         │
│         ○ ● ○                          │ ◄── Dot 2 actif
│      (Avis 2 actif)                    │
│                                         │
└─────────────────────────────────────────┘

✨ AVEC indicateurs (dots) animés
Les dots changent automatiquement selon la position
```

### Mode Desktop (≥ 768px)
```
┌─────────────────────────────────────────────────────────────────────┐
│  💻 ÉCRAN DESKTOP (1280px)                                          │
├─────────────────────────────────────────────────────────────────────┤
│                                                                     │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐            │
│  │ ⭐⭐⭐⭐⭐     │  │ ⭐⭐⭐⭐⭐     │  │ ⭐⭐⭐⭐⭐     │            │
│  │              │  │              │  │              │            │
│  │ "Excellent   │  │ "Livraison   │  │ "Super       │            │
│  │  service..." │  │  rapide..."  │  │  boutique!"  │            │
│  │              │  │              │  │              │            │
│  │ 👤 Sophie    │  │ 👤 Marc      │  │ 👤 Laura     │            │
│  │    Martin    │  │    Dubois    │  │    Petit     │            │
│  └──────────────┘  └──────────────┘  └──────────────┘            │
│                                                                     │
│  Grid 3 colonnes - Tous les avis visibles en même temps            │
│  PAS d'indicateurs (dots cachés)                                   │
│                                                                     │
└─────────────────────────────────────────────────────────────────────┘
```

---

## 🎯 COMPORTEMENT DES INDICATEURS (DOTS)

### Dots Inactifs
```
○ ○ ○
│ │ │
└─┴─┴─ Cercles gris (8px × 8px)
```

### Dot Actif
```
● ○ ○
│ │ │
│ └─┴─ Cercles gris (8px × 8px)
│
└─ Rectangle arrondi bleu (24px × 8px)
```

### Animation de Transition
```
Avant scroll:  ● ○ ○
Pendant:       ●─○ ○  (transition 0.3s)
Après:         ○ ● ○
```

---

## 📐 DIMENSIONS ET ESPACEMENTS

### Mobile (< 768px)
```
┌─────────────────────────────────────────┐
│  Viewport: 375px                        │
├─────────────────────────────────────────┤
│                                         │
│  ┌─────────────────────────┐           │
│  │  Carte: 85% = 319px     │  Gap: 16px│
│  └─────────────────────────┘           │
│                                         │
│  Scroll horizontal →                    │
│                                         │
└─────────────────────────────────────────┘

Offres/Sous-catégories: 85% de largeur
Avis: 90% de largeur
Gap entre éléments: 1rem (16px)
```

### Desktop (≥ 768px)
```
┌─────────────────────────────────────────────────────────────────────┐
│  Max-width: 1280px (centré)                                         │
├─────────────────────────────────────────────────────────────────────┤
│                                                                     │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐            │
│  │  33.33%      │  │  33.33%      │  │  33.33%      │            │
│  │  (426px)     │  │  (426px)     │  │  (426px)     │            │
│  └──────────────┘  └──────────────┘  └──────────────┘            │
│                                                                     │
│  Grid 3 colonnes égales avec gap de 2rem (32px)                    │
│                                                                     │
└─────────────────────────────────────────────────────────────────────┘
```

---

## 🎨 STYLES VISUELS

### Cartes Offres
```
┌─────────────────────────────────────┐
│  Gradient: from-primary to-primary  │
│  Padding: 2rem (32px)               │
│  Border-radius: 1.5rem (24px)       │
│  Min-height: 200px                  │
│                                     │
│  🔥 Badge: bg-white/30              │
│  Titre: text-lg font-bold           │
│  Image: 96px × 96px (droite)        │
│                                     │
│  Hover: scale-105 + shadow-2xl      │
└─────────────────────────────────────┘
```

### Cartes Sous-catégories
```
┌─────────────────────────────────────┐
│  Gradient: from-blue-100 to-blue-200│
│  Padding: 2rem (32px)               │
│  Border-radius: 1rem (16px)         │
│  Layout: flex justify-between       │
│                                     │
│  Texte: text-lg font-bold (gauche)  │
│  Image: 80px × 80px rounded-full    │
│         (droite)                    │
│                                     │
│  Hover: gradient change + shadow-xl │
└─────────────────────────────────────┘
```

### Cartes Avis
```
┌─────────────────────────────────────┐
│  Background: white                  │
│  Border: 1px solid gray-100         │
│  Border-radius: 1rem (16px)         │
│  Padding: 2rem (32px)               │
│                                     │
│  ⭐⭐⭐⭐⭐ (haut)                    │
│                                     │
│  "Texte de l'avis..."               │
│  (min-height: 100px)                │
│                                     │
│  👤 Avatar: 64px × 64px rounded-full│
│     Nom + Rôle                      │
│                                     │
│  Hover: border-primary/30 + shadow  │
└─────────────────────────────────────┘
```

---

## 🔄 ANIMATIONS ET TRANSITIONS

### Scroll Snap
```
Comportement:
1. User commence à swiper →
2. Scroll fluide pendant le swipe
3. User relâche →
4. Snap automatique au centre de l'élément le plus proche
5. Animation smooth (0.3s)
```

### Dots Animation
```
État initial:  ● ○ ○
                ↓
User swipe →   ●─○ ○  (transition commence)
                ↓
Snap center →  ○ ● ○  (transition complète)
                ↓
Dot actif:     Rectangle arrondi bleu (24px × 8px)
Dots inactifs: Cercles gris (8px × 8px)
```

### Hover Effects (Desktop)
```
État normal:   scale(1) shadow-md
                ↓
Hover →        scale(1.05) shadow-2xl
                ↓
Transition:    duration-300 ease-in-out
```

---

## 📱 BREAKPOINTS

```
Mobile:    0px  ─────────► 767px   (Scroll horizontal)
                           │
                           │ Breakpoint
                           │
Desktop:   768px ─────────► ∞      (Grid 3 colonnes)
```

### Comportement aux breakpoints:
```
@ 767px (Mobile max):
- Scroll horizontal actif
- 1 élément visible
- Dots visibles (avis uniquement)

@ 768px (Desktop min):
- Grid 3 colonnes
- Tous les éléments visibles
- Dots cachés
```

---

## 🎯 RÉSUMÉ VISUEL

### Sections SANS dots:
```
📱 Mobile:  [Carte 1] → swipe → [Carte 2] → swipe → [Carte 3]
            (pas d'indicateurs)

💻 Desktop: [Carte 1] [Carte 2] [Carte 3]
            (grid 3 colonnes)
```

### Section AVEC dots (Avis):
```
📱 Mobile:  [Avis 1] → swipe → [Avis 2] → swipe → [Avis 3]
               ●  ○  ○           ○  ●  ○           ○  ○  ●
            (indicateurs animés)

💻 Desktop: [Avis 1] [Avis 2] [Avis 3]
            (grid 3 colonnes, pas de dots)
```

---

## ✨ EXPÉRIENCE UTILISATEUR

### Gestes Mobile:
```
Swipe gauche:  ←──────  Voir l'élément suivant
Swipe droite:  ──────→  Voir l'élément précédent
Tap sur dot:   (non implémenté - scroll uniquement)
```

### Feedback Visuel:
```
1. Scroll commence → Mouvement fluide
2. Scroll en cours → Éléments glissent
3. Relâche → Snap au centre (smooth)
4. Dots update → Animation 0.3s
5. État stable → Élément centré + dot actif
```

---

**Date de création**: 19 Mai 2026  
**Version**: 1.0  
**Statut**: ✅ DOCUMENTATION VISUELLE COMPLÈTE
