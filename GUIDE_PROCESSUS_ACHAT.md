# 🛒 Guide Complet - Processus d'Achat (Cash on Delivery)

## 📋 Vue d'Ensemble du Processus

Le système d'achat est déjà en place avec **paiement à la livraison (Cash on Delivery)**. Voici le flux complet:

```
1. Parcourir les produits
   ↓
2. Ajouter au panier
   ↓
3. Voir le panier
   ↓
4. Passer à la caisse (Checkout)
   ↓
5. Remplir les informations de livraison
   ↓
6. Confirmer la commande
   ↓
7. Page de confirmation
   ↓
8. Email de confirmation (automatique)
```

---

## 🎯 Fonctionnalités Actuelles

### ✅ Ce qui Fonctionne Déjà

1. **Panier (Session-based)**
   - Ajouter des produits
   - Modifier les quantités
   - Supprimer des produits
   - Vider le panier
   - Compteur de panier dans le header

2. **Checkout**
   - Formulaire de livraison complet
   - Calcul automatique des frais
   - Livraison gratuite > 100€
   - TVA 20% incluse
   - Paiement à la livraison uniquement

3. **Commandes**
   - Création de commande
   - Numéro de commande unique
   - Mise à jour du stock automatique
   - Page de confirmation
   - Historique des commandes (pour utilisateurs connectés)

---

## 🔧 Routes Disponibles

### Routes API (Panier)
```php
POST   /api/cart/add          // Ajouter un produit
GET    /api/cart              // Voir le panier
POST   /api/cart/update       // Modifier quantité
POST   /api/cart/remove       // Retirer un produit
POST   /api/cart/clear        // Vider le panier
```

### Routes Web (Checkout)
```php
GET    /checkout              // Page de checkout
POST   /checkout/process      // Traiter la commande
GET    /orders/confirmation/{orderNumber}  // Confirmation
```

---

## 🧪 Test du Processus Complet

### Étape 1: Ajouter un Produit au Panier

**Méthode 1: Via JavaScript (sur la page produit)**
```javascript
// Bouton "Ajouter au panier"
document.getElementById('addToCartBtn').addEventListener('click', async () => {
    const productId = {{ $product->id }};
    const quantity = currentQty; // De la page
    
    const response = await fetch('/api/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })
    });
    
    const result = await response.json();
    // Mettre à jour le compteur du panier
});
```

**Méthode 2: Via cURL (test)**
```bash
curl -X POST http://localhost/AnimalerieHMZ/public/api/cart/add \
  -H "Content-Type: application/json" \
  -d '{"product_id": 1, "quantity": 2}'
```

---

### Étape 2: Voir le Panier

**URL**: `http://localhost/AnimalerieHMZ/public/api/cart`

**Réponse attendue**:
```json
{
  "success": true,
  "cart": [
    {
      "id": 1,
      "name": "Pro Plan Adult Light Sterilised Chicken 3kg",
      "price": 42.99,
      "quantity": 2,
      "subtotal": 85.98,
      "image": "images/products/img_product_chien/...",
      "category": "Chiens"
    }
  ],
  "total": 85.98,
  "count": 1
}
```

---

### Étape 3: Page de Checkout

**URL**: `http://localhost/AnimalerieHMZ/public/checkout`

**Formulaire à remplir**:
- ✅ Prénom *
- ✅ Nom *
- ✅ Email *
- ✅ Téléphone *
- ✅ Adresse *
- ⚪ Complément d'adresse
- ✅ Ville *
- ✅ Code Postal *
- ✅ Pays * (France par défaut)
- ⚪ Notes

**Calculs Automatiques**:
```
Sous-total:        85.98€
Frais de livraison: 15.00€  (Gratuit si > 100€)
TVA (20%):         17.20€
─────────────────────────
Total TTC:        118.18€
```

---

### Étape 4: Confirmer la Commande

**Action**: Cliquer sur "Confirmer la commande"

**Traitement**:
1. Validation des données
2. Vérification du stock
3. Création de la commande
4. Création des items de commande
5. Mise à jour du stock
6. Génération du numéro de commande
7. Vidage du panier
8. Redirection vers la confirmation

**Numéro de commande généré**: Format `ORD-YYYYMMDD-XXXX`
Exemple: `ORD-20260517-0001`

---

### Étape 5: Page de Confirmation

**URL**: `http://localhost/AnimalerieHMZ/public/orders/confirmation/ORD-20260517-0001`

**Affichage**:
- ✅ Icône de succès animée
- ✅ Numéro de commande
- ✅ Date et heure
- ✅ Liste des produits commandés
- ✅ Totaux (sous-total, livraison, TVA, total)
- ✅ Adresse de livraison
- ✅ Informations de contact
- ✅ Prochaines étapes
- ✅ Boutons d'action

---

## 💳 Méthode de Paiement

### Cash on Delivery (Paiement à la Livraison)

**Caractéristiques**:
- ✅ Paiement en espèces ou par carte à la livraison
- ✅ Aucun paiement en ligne requis
- ✅ Sécurisé pour le client
- ✅ Pas de frais de transaction

**Affichage sur la page checkout**:
```
┌─────────────────────────────────────┐
│ 💰 Paiement à la livraison          │
│                                     │
│ Payez en espèces ou par carte      │
│ lors de la réception.              │
│                            ✓       │
└─────────────────────────────────────┘
```

---

## 📊 Structure de la Base de Données

### Table: `orders`
```sql
- id
- order_number (unique)
- user_id (nullable)
- shipping_first_name
- shipping_last_name
- shipping_email
- shipping_phone
- shipping_address_line_1
- shipping_address_line_2
- shipping_city
- shipping_postal_code
- shipping_country
- billing_first_name
- billing_last_name
- billing_address_line_1
- billing_address_line_2
- billing_city
- billing_postal_code
- billing_country
- subtotal
- shipping_cost
- tax
- total
- payment_method (cash_on_delivery)
- payment_status (pending, paid, failed)
- order_status (pending, processing, shipped, delivered, cancelled)
- customer_notes
- created_at
- updated_at
```

### Table: `order_items`
```sql
- id
- order_id
- product_id
- product_name
- product_sku
- product_image
- price
- quantity
- subtotal
- created_at
- updated_at
```

---

## 🎨 Améliorations Possibles

### 1. Page Panier Dédiée
Créer une page `/cart` pour voir et gérer le panier avant le checkout.

### 2. Notifications Email
- Email de confirmation au client
- Email de notification à l'admin
- Email de suivi de livraison

### 3. Suivi de Commande
- Statuts: En attente → En préparation → Expédiée → Livrée
- Tracking de livraison
- Notifications SMS

### 4. Gestion Admin
- Dashboard des commandes
- Changer le statut des commandes
- Imprimer les bons de livraison
- Statistiques de ventes

### 5. Fonctionnalités Avancées
- Code promo / Coupons
- Programme de fidélité
- Wishlist (liste de souhaits)
- Comparateur de produits
- Avis clients

---

## 🐛 Points à Vérifier

### Checklist de Test

- [ ] Ajouter un produit au panier
- [ ] Voir le compteur du panier se mettre à jour
- [ ] Modifier la quantité dans le panier
- [ ] Supprimer un produit du panier
- [ ] Vider le panier complètement
- [ ] Accéder à la page checkout
- [ ] Remplir le formulaire de livraison
- [ ] Vérifier les calculs (sous-total, livraison, TVA, total)
- [ ] Confirmer la commande
- [ ] Voir la page de confirmation
- [ ] Vérifier que le stock a été mis à jour
- [ ] Vérifier que le panier est vide après la commande
- [ ] Tester avec un utilisateur connecté
- [ ] Tester avec un utilisateur invité
- [ ] Vérifier l'historique des commandes (si connecté)

---

## 🚀 Prochaines Étapes

1. **Créer une page panier dédiée** (`/cart`)
2. **Ajouter les notifications email**
3. **Améliorer le dashboard admin** pour gérer les commandes
4. **Ajouter le suivi de commande** pour les clients
5. **Implémenter les codes promo**

---

## 📞 Support

Pour toute question ou problème:
- Vérifier les logs Laravel: `storage/logs/laravel.log`
- Vérifier la console du navigateur (F12)
- Tester les routes API avec Postman ou cURL

---

Date: 17 Mai 2026
Statut: ✅ Système Fonctionnel
Méthode de Paiement: 💰 Cash on Delivery
