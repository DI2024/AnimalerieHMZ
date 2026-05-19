# 🔍 DIAGNOSTIC - ICÔNES MATERIAL SYMBOLS

## ✅ CONFIGURATION ACTUELLE

### Lien CDN dans `layouts/public.blade.php`
```html
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
```

**Statut**: ✅ Correctement configuré

---

## 📍 UTILISATION DANS L'APPLICATION

### Exemples d'icônes utilisées:
```html
<!-- Navigation -->
<span class="material-symbols-outlined">menu</span>
<span class="material-symbols-outlined">close</span>
<span class="material-symbols-outlined">shopping_cart</span>
<span class="material-symbols-outlined">account_circle</span>

<!-- Sections -->
<span class="material-symbols-outlined">home</span>
<span class="material-symbols-outlined">pets</span>
<span class="material-symbols-outlined">flutter</span>
<span class="material-symbols-outlined">flutter_dash</span>
<span class="material-symbols-outlined">local_offer</span>
<span class="material-symbols-outlined">shopping_bag</span>
<span class="material-symbols-outlined">contact_mail</span>

<!-- Footer -->
<span class="material-symbols-outlined">chevron_right</span>
<span class="material-symbols-outlined">location_on</span>
<span class="material-symbols-outlined">phone</span>
<span class="material-symbols-outlined">mail</span>

<!-- Boutons -->
<span class="material-symbols-outlined">arrow_forward</span>
<span class="material-symbols-outlined">expand_more</span>
<span class="material-symbols-outlined">dashboard</span>
<span class="material-symbols-outlined">settings</span>
<span class="material-symbols-outlined">logout</span>
```

---

## 🐛 PROBLÈMES POSSIBLES ET SOLUTIONS

### 1. Les icônes ne s'affichent pas du tout

**Causes possibles:**
- ❌ Connexion internet coupée (CDN Google Fonts inaccessible)
- ❌ Bloqueur de publicités/contenu bloque Google Fonts
- ❌ Pare-feu d'entreprise bloque googleapis.com
- ❌ Cache du navigateur corrompu

**Solutions:**
```bash
# 1. Vérifier la connexion internet
ping fonts.googleapis.com

# 2. Vider le cache du navigateur
# Chrome/Edge: Ctrl + Shift + Delete
# Firefox: Ctrl + Shift + Delete

# 3. Tester dans un autre navigateur

# 4. Vérifier la console du navigateur (F12)
# Chercher des erreurs de chargement de fonts.googleapis.com
```

### 2. Les icônes s'affichent comme des carrés vides

**Causes possibles:**
- ❌ Nom d'icône incorrect
- ❌ Font pas complètement chargée
- ❌ Classe CSS manquante

**Solutions:**
```html
<!-- Vérifier que la classe est correcte -->
<span class="material-symbols-outlined">check_circle</span>

<!-- PAS comme ça: -->
<span class="material-icons">check_circle</span>
```

### 3. Les icônes s'affichent mais avec un style incorrect

**Causes possibles:**
- ❌ Paramètres de variation de font incorrects
- ❌ CSS personnalisé qui interfère

**Solutions:**
```css
/* Ajouter dans le CSS si nécessaire */
.material-symbols-outlined {
    font-family: 'Material Symbols Outlined';
    font-weight: normal;
    font-style: normal;
    font-size: 24px;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-rendering: optimizeLegibility;
    font-feature-settings: 'liga';
}
```

---

## 🧪 TEST DE DIAGNOSTIC

### Étape 1: Vérifier le chargement du CDN
1. Ouvrir le navigateur (Chrome/Firefox)
2. Appuyer sur F12 (DevTools)
3. Aller dans l'onglet "Network" (Réseau)
4. Recharger la page (F5)
5. Chercher "fonts.googleapis.com" dans la liste
6. Vérifier que le statut est **200 OK** (vert)

### Étape 2: Vérifier dans la console
```javascript
// Ouvrir la console (F12 > Console)
// Taper cette commande:
document.fonts.check('24px "Material Symbols Outlined"')
// Résultat attendu: true
```

### Étape 3: Test visuel
Créer un fichier HTML de test:
```html
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .material-symbols-outlined {
            font-size: 48px;
            color: #003e87;
        }
    </style>
</head>
<body>
    <h1>Test Material Symbols</h1>
    <span class="material-symbols-outlined">home</span>
    <span class="material-symbols-outlined">shopping_cart</span>
    <span class="material-symbols-outlined">pets</span>
    <span class="material-symbols-outlined">menu</span>
</body>
</html>
```

---

## 🔧 SOLUTION ALTERNATIVE: HÉBERGEMENT LOCAL

Si le CDN ne fonctionne pas, héberger les fonts localement:

### Étape 1: Télécharger les fonts
```bash
# Aller sur: https://fonts.google.com/icons
# Télécharger "Material Symbols Outlined"
```

### Étape 2: Placer les fichiers
```
public/
  fonts/
    material-symbols/
      MaterialSymbolsOutlined.woff2
      MaterialSymbolsOutlined.woff
```

### Étape 3: Modifier le CSS
```css
/* Dans resources/css/app.css */
@font-face {
    font-family: 'Material Symbols Outlined';
    font-style: normal;
    font-weight: 100 700;
    src: url('/fonts/material-symbols/MaterialSymbolsOutlined.woff2') format('woff2'),
         url('/fonts/material-symbols/MaterialSymbolsOutlined.woff') format('woff');
}

.material-symbols-outlined {
    font-family: 'Material Symbols Outlined';
    font-weight: normal;
    font-style: normal;
    font-size: 24px;
    line-height: 1;
    letter-spacing: normal;
    text-transform: none;
    display: inline-block;
    white-space: nowrap;
    word-wrap: normal;
    direction: ltr;
    -webkit-font-smoothing: antialiased;
}
```

### Étape 4: Retirer le lien CDN
```html
<!-- Supprimer cette ligne dans layouts/public.blade.php -->
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined..." /> -->
```

---

## 📊 CHECKLIST DE VÉRIFICATION

- [ ] Le lien CDN est présent dans `<head>`
- [ ] La classe `material-symbols-outlined` est utilisée (pas `material-icons`)
- [ ] Les noms d'icônes sont corrects (voir: https://fonts.google.com/icons)
- [ ] Le navigateur peut accéder à fonts.googleapis.com
- [ ] Le cache du navigateur a été vidé
- [ ] La console ne montre pas d'erreurs de chargement
- [ ] Les fonts sont chargées (vérifier dans DevTools > Network)

---

## 🎯 ICÔNES RECOMMANDÉES POUR L'APPLICATION

### Navigation
- `home` - Accueil
- `menu` - Menu mobile
- `close` - Fermer
- `shopping_cart` - Panier
- `account_circle` - Compte utilisateur

### Catégories
- `pets` - Chats/Chiens
- `flutter` - Pigeons
- `flutter_dash` - Oiseaux
- `water_drop` - Poissons

### Actions
- `add_shopping_cart` - Ajouter au panier
- `favorite` - Favoris
- `search` - Recherche
- `filter_list` - Filtres

### Interface
- `chevron_right` - Flèche droite
- `chevron_left` - Flèche gauche
- `expand_more` - Dérouler
- `expand_less` - Replier
- `arrow_forward` - Suivant
- `arrow_back` - Retour

### Contact
- `location_on` - Adresse
- `phone` - Téléphone
- `mail` - Email
- `contact_mail` - Contact

---

## 📞 SUPPORT

Si les icônes ne fonctionnent toujours pas après avoir suivi ce guide:

1. **Vérifier la version du navigateur** (mettre à jour si nécessaire)
2. **Tester en navigation privée** (pour exclure les extensions)
3. **Vérifier les paramètres de sécurité** (pare-feu, antivirus)
4. **Utiliser la solution d'hébergement local** (voir ci-dessus)

---

**Date de création**: 19 Mai 2026  
**Version**: 1.0  
**Statut**: ✅ DIAGNOSTIC COMPLET
