@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-surface-container-low to-white py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-sm text-on-surface-variant mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary transition">Accueil</a>
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
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-container text-white font-bold py-4 px-8 rounded-full transition shadow-lg hover:shadow-xl">
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
                        <span id="subtotalAmount">0,00 MAD</span>
                    </div>
                    <div class="flex justify-between text-on-surface-variant">
                        <span>Frais de livraison</span>
                        <span id="shippingAmount" class="text-green-600 font-bold">Calculé au checkout</span>
                    </div>
                    <div class="h-px bg-gray-200"></div>
                    <div class="flex justify-between items-center text-xl font-bold">
                        <span>Total estimé</span>
                        <span class="text-primary" id="totalAmount">0,00 MAD</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('checkout') }}" id="checkoutBtn" class="block w-full bg-primary hover:bg-primary-container text-white font-bold py-4 px-6 rounded-full transition text-center shadow-lg hover:shadow-xl hover:-translate-y-1 active:translate-y-0">
                        Passer la commande
                    </a>
                    <a href="{{ route('products.index') }}" class="block w-full bg-surface-container-low hover:bg-surface-container text-on-surface font-bold py-4 px-6 rounded-full transition text-center">
                        Continuer mes achats
                    </a>
                </div>

                <div class="mt-6 p-4 bg-green-50 rounded-2xl border border-green-200">
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-green-600 text-sm mt-0.5">local_shipping</span>
                        <p class="text-xs text-green-800">
                            <strong>Livraison gratuite</strong> pour les commandes de plus de 500 MAD
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Single Cart Item Template -->
<template id="cartItemTemplate">
    <div class="cart-item bg-white rounded-2xl p-4 md:p-6 shadow-md border border-gray-100 hover:shadow-lg transition" data-product-id="" data-stock="">
        <div class="flex flex-col md:flex-row gap-4 md:gap-6">
            <!-- Image -->
            <div class="w-20 h-20 md:w-24 md:h-24 flex-shrink-0 bg-surface-container-low rounded-xl overflow-hidden">
                <img src="" alt="" class="w-full h-full object-contain p-2 item-image">
            </div>

            <!-- Info -->
            <div class="flex-1 min-w-0">
                <div class="flex justify-between items-start gap-4 mb-3">
                    <div class="flex-1">
                        <h3 class="font-bold text-base md:text-lg text-on-surface mb-1 item-name line-clamp-2"></h3>
                        <p class="text-xs md:text-sm text-on-surface-variant item-category"></p>
                        <p class="text-xs text-gray-500 item-stock"></p>
                    </div>
                    <button class="remove-btn w-10 h-10 flex items-center justify-center rounded-full hover:bg-red-50 text-on-surface-variant hover:text-red-600 transition flex-shrink-0">
                        <span class="material-symbols-outlined">delete</span>
                    </button>
                </div>

                <div class="flex flex-row items-center justify-between gap-3">
                    <!-- Quantity Controls -->
                    <div class="flex items-center bg-surface-container-low rounded-full border border-gray-200">
                        <button class="qty-minus w-9 h-9 md:w-10 md:h-10 flex items-center justify-center text-lg md:text-xl font-bold hover:bg-white rounded-full transition">-</button>
                        <span class="item-quantity w-10 md:w-12 text-center font-bold text-sm md:text-base">1</span>
                        <button class="qty-plus w-9 h-9 md:w-10 md:h-10 flex items-center justify-center text-lg md:text-xl font-bold hover:bg-white rounded-full transition">+</button>
                    </div>

                    <!-- Price -->
                    <div class="text-right">
                        <p class="text-xl md:text-2xl font-bold text-primary item-subtotal mb-0.5 leading-tight">0,00 MAD</p>
                        <p class="text-xs text-on-surface-variant item-unit-price whitespace-nowrap">0,00 MAD / unité</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Custom Confirmation Modal -->
<div id="deleteConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all">
        <div class="p-6">
            <!-- Icon -->
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-red-100">
                <span class="material-symbols-outlined text-3xl text-red-600">delete</span>
            </div>
            
            <!-- Title -->
            <h3 class="text-xl font-bold text-gray-900 text-center mb-2">
                Retirer cet article ?
            </h3>
            
            <!-- Message -->
            <p class="text-gray-600 text-center mb-6">
                Voulez-vous vraiment retirer cet article de votre panier ?
            </p>
            
            <!-- Actions -->
            <div class="flex space-x-3">
                <button onclick="closeDeleteModal()" 
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                    Annuler
                </button>
                <button onclick="confirmDelete()" 
                        class="flex-1 px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium transition-colors">
                    Retirer
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let pendingDeleteProductId = null;

document.addEventListener('DOMContentLoaded', function() {
    loadCart();
    setupModalListeners();
});

function setupModalListeners() {
    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });

    // Close modal on outside click
    const modal = document.getElementById('deleteConfirmModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    }
}

async function loadCart() {
    try {
        const response = await fetch('{{ route('api.cart.index') }}');
        const data = await response.json();
        
        if (data.success && data.cart && data.cart.length > 0) {
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
    if (template) {
        container.innerHTML = template.innerHTML;
    }
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
        div.dataset.stock = item.stock || 0;
        div.querySelector('.item-image').src = item.image.startsWith('http') ? item.image : '/' + item.image;
        div.querySelector('.item-image').alt = item.name;
        div.querySelector('.item-name').textContent = item.name;
        div.querySelector('.item-category').textContent = item.category;
        div.querySelector('.item-stock').textContent = `Stock disponible: ${item.stock || 0} unités`;
        div.querySelector('.item-quantity').textContent = item.quantity;
        div.querySelector('.item-subtotal').textContent = formatPrice(item.subtotal);
        div.querySelector('.item-unit-price').textContent = formatPrice(item.price) + ' / unité';
        
        // Event listeners with proper closure
        const minusBtn = div.querySelector('.qty-minus');
        const plusBtn = div.querySelector('.qty-plus');
        const removeBtn = div.querySelector('.remove-btn');
        
        minusBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            handleDecrease(item.id, item.quantity);
        });
        
        plusBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            handleIncrease(item.id, item.quantity, item.stock);
        });
        
        removeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            showDeleteModal(item.id);
        });
        
        itemsList.appendChild(itemElement);
    });
    
    // Update summary
    document.getElementById('itemCount').textContent = items.length;
    document.getElementById('subtotalAmount').textContent = formatPrice(total);
    document.getElementById('totalAmount').textContent = formatPrice(total);
}

function handleDecrease(productId, currentQuantity) {
    if (currentQuantity <= 1) {
        // Show custom modal instead of browser confirm
        showDeleteModal(productId);
    } else {
        // Just decrease quantity
        updateQuantity(productId, currentQuantity - 1);
    }
}

function handleIncrease(productId, currentQuantity, availableStock) {
    if (currentQuantity >= availableStock) {
        showNotification('Stock insuffisant pour ce produit', 'error');
        return;
    }
    
    updateQuantity(productId, currentQuantity + 1);
}

async function updateQuantity(productId, newQuantity) {
    if (newQuantity < 1) {
        return;
    }
    
    try {
        const response = await fetch('{{ route('api.cart.update') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: newQuantity
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            await loadCart();
            updateCartCount(data.cart_count);
        } else {
            showNotification(data.message || 'Erreur lors de la mise à jour', 'error');
        }
    } catch (error) {
        console.error('Error updating quantity:', error);
        showNotification('Une erreur est survenue', 'error');
    }
}

function showDeleteModal(productId) {
    pendingDeleteProductId = productId;
    const modal = document.getElementById('deleteConfirmModal');
    if (modal) {
        modal.classList.remove('hidden');
    }
}

function closeDeleteModal() {
    pendingDeleteProductId = null;
    const modal = document.getElementById('deleteConfirmModal');
    if (modal) {
        modal.classList.add('hidden');
    }
}

function confirmDelete() {
    if (pendingDeleteProductId) {
        removeItem(pendingDeleteProductId);
    }
    closeDeleteModal();
}

async function removeItem(productId) {
    try {
        const response = await fetch('{{ route('api.cart.remove') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                product_id: productId
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            await loadCart();
            updateCartCount(data.cart_count);
            showNotification('Article retiré du panier', 'success');
        }
    } catch (error) {
        console.error('Error removing item:', error);
        showNotification('Une erreur est survenue', 'error');
    }
}

function showNotification(message, type = 'info') {
    // Remove any existing notifications
    const existing = document.querySelectorAll('.cart-notification');
    existing.forEach(n => n.remove());
    
    const notification = document.createElement('div');
    notification.className = 'cart-notification';
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#10B981' : type === 'error' ? '#EF4444' : '#3B82F6'};
        color: white;
        padding: 16px 24px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        z-index: 10000;
        font-weight: 600;
        animation: slideIn 0.3s ease-out;
        display: flex;
        align-items: center;
        gap: 8px;
    `;
    
    const icon = type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ';
    notification.innerHTML = `<span style="font-size: 20px;">${icon}</span> ${message}`;
    
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease-in';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

function formatPrice(price) {
    return new Intl.NumberFormat('fr-MA', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(price) + ' MAD';
}

function updateCartCount(count) {
    ['cartCount', 'cartCountMobile'].forEach(id => {
        const badge = document.getElementById(id);
        if (badge) {
            badge.textContent = count;
            if (count > 0) {
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }
    });
}

// Make functions globally accessible
window.closeDeleteModal = closeDeleteModal;
window.confirmDelete = confirmDelete;
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slideIn {
    from { transform: translateX(400px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes slideOut {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(400px); opacity: 0; }
}

.cart-item {
    animation: fadeIn 0.3s ease-out;
}
</style>
@endsection
