

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-b from-surface-container-low to-white py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-sm text-on-surface-variant mb-8">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-primary transition">Accueil</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span class="font-bold text-primary">Panier</span>
        </nav>

        <h1 class="font-headline text-[clamp(2rem,5vw,3rem)] font-bold text-primary mb-12">Mon Panier</h1>

        <div id="cartContent">
            <!-- Le contenu sera chargé dynamiquement -->
            <div class="flex items-center justify-center py-20">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary"></div>
            </div>
        </div>
    </div>
</div>

<!-- Empty Cart Template -->
<template id="emptyCartTemplate">
    <div class="text-center py-20">
        <div class="inline-flex items-center justify-center w-32 h-32 bg-surface-container-low rounded-full mb-8">
            <span class="material-symbols-outlined text-6xl text-on-surface-variant">shopping_cart</span>
        </div>
        <h2 class="text-2xl font-bold text-on-surface mb-4">Votre panier est vide</h2>
        <p class="text-on-surface-variant mb-8">Découvrez nos produits et ajoutez-les à votre panier</p>
        <a href="<?php echo e(route('products.index')); ?>" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-container text-white font-bold py-4 px-8 rounded-full transition shadow-lg hover:shadow-xl">
            <span class="material-symbols-outlined">shopping_bag</span>
            Découvrir nos produits
        </a>
    </div>
</template>

<!-- Cart Items Template -->
<template id="cartItemsTemplate">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left: Cart Items -->
        <div class="lg:col-span-8 space-y-4" id="cartItemsList">
            <!-- Items will be inserted here -->
        </div>

        <!-- Right: Summary -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-gray-100 sticky top-32">
                <h2 class="font-headline text-2xl font-bold mb-6">Résumé</h2>
                
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between text-on-surface-variant">
                        <span>Sous-total (<span id="itemCount">0</span> articles)</span>
                        <span id="subtotalAmount">0,00€</span>
                    </div>
                    <div class="flex justify-between text-on-surface-variant">
                        <span>Frais de livraison</span>
                        <span id="shippingAmount" class="text-green-600 font-bold">Calculé au checkout</span>
                    </div>
                    <div class="h-px bg-gray-200"></div>
                    <div class="flex justify-between items-center text-xl font-bold">
                        <span>Total estimé</span>
                        <span class="text-primary" id="totalAmount">0,00€</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="<?php echo e(route('checkout')); ?>" id="checkoutBtn" class="block w-full bg-primary hover:bg-primary-container text-white font-bold py-4 px-6 rounded-full transition text-center shadow-lg hover:shadow-xl hover:-translate-y-1 active:translate-y-0">
                        Passer la commande
                    </a>
                    <a href="<?php echo e(route('products.index')); ?>" class="block w-full bg-surface-container-low hover:bg-surface-container text-on-surface font-bold py-4 px-6 rounded-full transition text-center">
                        Continuer mes achats
                    </a>
                </div>

                <div class="mt-6 p-4 bg-green-50 rounded-2xl border border-green-200">
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-green-600 text-sm mt-0.5">local_shipping</span>
                        <p class="text-xs text-green-800">
                            <strong>Livraison gratuite</strong> pour les commandes de plus de 100€
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Single Cart Item Template -->
<template id="cartItemTemplate">
    <div class="cart-item bg-white rounded-2xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition" data-product-id="">
        <div class="flex gap-6">
            <!-- Image -->
            <div class="w-24 h-24 flex-shrink-0 bg-surface-container-low rounded-xl overflow-hidden">
                <img src="" alt="" class="w-full h-full object-contain p-2 item-image">
            </div>

            <!-- Info -->
            <div class="flex-1 min-w-0">
                <div class="flex justify-between items-start gap-4 mb-3">
                    <div class="flex-1">
                        <h3 class="font-bold text-lg text-on-surface mb-1 item-name"></h3>
                        <p class="text-sm text-on-surface-variant item-category"></p>
                    </div>
                    <button class="remove-btn w-10 h-10 flex items-center justify-center rounded-full hover:bg-red-50 text-on-surface-variant hover:text-red-600 transition">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>

                <div class="flex items-center justify-between">
                    <!-- Quantity Controls -->
                    <div class="flex items-center bg-surface-container-low rounded-full border border-gray-200">
                        <button class="qty-minus w-10 h-10 flex items-center justify-center text-xl font-bold hover:bg-white rounded-full transition">-</button>
                        <span class="item-quantity w-12 text-center font-bold">1</span>
                        <button class="qty-plus w-10 h-10 flex items-center justify-center text-xl font-bold hover:bg-white rounded-full transition">+</button>
                    </div>

                    <!-- Price -->
                    <div class="text-right">
                        <p class="text-2xl font-bold text-primary item-subtotal">0,00€</p>
                        <p class="text-xs text-on-surface-variant item-unit-price">0,00€ / unité</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadCart();
});

async function loadCart() {
    try {
        const response = await fetch('<?php echo e(route('api.cart.index')); ?>');
        const data = await response.json();
        
        if (data.success && data.cart.length > 0) {
            renderCart(data.cart, data.total);
        } else {
            renderEmptyCart();
        }
    } catch (error) {
        console.error('Error loading cart:', error);
        renderEmptyCart();
    }
}

function renderEmptyCart() {
    const container = document.getElementById('cartContent');
    const template = document.getElementById('emptyCartTemplate');
    container.innerHTML = template.innerHTML;
}

function renderCart(items, total) {
    const container = document.getElementById('cartContent');
    const mainTemplate = document.getElementById('cartItemsTemplate');
    container.innerHTML = mainTemplate.innerHTML;
    
    const itemsList = document.getElementById('cartItemsList');
    const itemTemplate = document.getElementById('cartItemTemplate');
    
    items.forEach(item => {
        const itemElement = itemTemplate.content.cloneNode(true);
        const div = itemElement.querySelector('.cart-item');
        
        div.dataset.productId = item.id;
        div.querySelector('.item-image').src = item.image.startsWith('http') ? item.image : '/' + item.image;
        div.querySelector('.item-image').alt = item.name;
        div.querySelector('.item-name').textContent = item.name;
        div.querySelector('.item-category').textContent = item.category;
        div.querySelector('.item-quantity').textContent = item.quantity;
        div.querySelector('.item-subtotal').textContent = formatPrice(item.subtotal);
        div.querySelector('.item-unit-price').textContent = formatPrice(item.price) + ' / unité';
        
        // Event listeners
        div.querySelector('.qty-minus').addEventListener('click', () => updateQuantity(item.id, item.quantity - 1));
        div.querySelector('.qty-plus').addEventListener('click', () => updateQuantity(item.id, item.quantity + 1));
        div.querySelector('.remove-btn').addEventListener('click', () => removeItem(item.id));
        
        itemsList.appendChild(itemElement);
    });
    
    // Update summary
    document.getElementById('itemCount').textContent = items.length;
    document.getElementById('subtotalAmount').textContent = formatPrice(total);
    document.getElementById('totalAmount').textContent = formatPrice(total);
}

async function updateQuantity(productId, newQuantity) {
    if (newQuantity < 1) {
        removeItem(productId);
        return;
    }
    
    try {
        const response = await fetch('<?php echo e(route('api.cart.update')); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: newQuantity
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            loadCart();
            updateCartCount(data.cart_count);
        } else {
            alert(data.message || 'Erreur lors de la mise à jour');
        }
    } catch (error) {
        console.error('Error updating quantity:', error);
        alert('Une erreur est survenue');
    }
}

async function removeItem(productId) {
    if (!confirm('Voulez-vous vraiment retirer cet article du panier ?')) {
        return;
    }
    
    try {
        const response = await fetch('<?php echo e(route('api.cart.remove')); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                product_id: productId
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            loadCart();
            updateCartCount(data.cart_count);
        }
    } catch (error) {
        console.error('Error removing item:', error);
        alert('Une erreur est survenue');
    }
}

function formatPrice(price) {
    return new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR'
    }).format(price);
}

function updateCartCount(count) {
    const badge = document.getElementById('cartCount');
    if (badge) {
        badge.textContent = count;
    }
}
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.cart-item {
    animation: fadeIn 0.3s ease-out;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/cart.blade.php ENDPATH**/ ?>