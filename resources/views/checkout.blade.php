@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-sm text-on-surface-variant mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary transition">Accueil</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span class="font-bold text-primary">Confirmation de commande</span>
        </nav>

        <h1 class="font-headline text-[clamp(2rem,5vw,2.5rem)] font-bold tracking-tight text-primary mb-12">Finaliser votre commande</h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Left: Delivery Form -->
            <div class="lg:col-span-7">
                <div class="bg-white rounded-3xl p-8 border border-gray-200 shadow-lg">
                    <div class="flex items-center gap-3 mb-8">
                        <span class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined">local_shipping</span>
                        </span>
                        <h2 class="font-headline text-2xl font-bold text-on-surface">Informations de livraison</h2>
                    </div>

                    <form id="checkoutForm" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="shipping_first_name" class="text-sm font-bold text-on-surface-variant ml-1">Prénom *</label>
                                <input type="text" 
                                       name="shipping_first_name" 
                                       id="shipping_first_name" 
                                       value="{{ auth()->check() ? auth()->user()->name : '' }}"
                                       placeholder="Jean" 
                                       class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" 
                                       required>
                            </div>
                            <div class="space-y-2">
                                <label for="shipping_last_name" class="text-sm font-bold text-on-surface-variant ml-1">Nom *</label>
                                <input type="text" 
                                       name="shipping_last_name" 
                                       id="shipping_last_name" 
                                       placeholder="Dupont" 
                                       class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" 
                                       required>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="shipping_email" class="text-sm font-bold text-on-surface-variant ml-1">Email *</label>
                            <input type="email" 
                                   name="shipping_email" 
                                   id="shipping_email" 
                                   value="{{ auth()->check() ? auth()->user()->email : '' }}"
                                   placeholder="jean.dupont@example.com" 
                                   class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" 
                                   required>
                        </div>

                        <div class="space-y-2">
                            <label for="shipping_phone" class="text-sm font-bold text-on-surface-variant ml-1">Téléphone *</label>
                            <input type="tel" 
                                   name="shipping_phone" 
                                   id="shipping_phone" 
                                   placeholder="06 12 34 56 78" 
                                   class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" 
                                   required>
                        </div>

                        <div class="space-y-2">
                            <label for="shipping_address_line_1" class="text-sm font-bold text-on-surface-variant ml-1">Adresse *</label>
                            <input type="text" 
                                   name="shipping_address_line_1" 
                                   id="shipping_address_line_1" 
                                   placeholder="123 Rue de la Paix" 
                                   class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" 
                                   required>
                        </div>

                        <div class="space-y-2">
                            <label for="shipping_city" class="text-sm font-bold text-on-surface-variant ml-1">Ville *</label>
                            <input type="text" 
                                   name="shipping_city" 
                                   id="shipping_city" 
                                   placeholder="Paris" 
                                   class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" 
                                   required>
                        </div>

                        <div class="space-y-2">
                            <label for="shipping_country" class="text-sm font-bold text-on-surface-variant ml-1">Pays *</label>
                            <input type="text" 
                                   name="shipping_country" 
                                   id="shipping_country" 
                                   value="France" 
                                   class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" 
                                   required>
                        </div>

                        <div class="space-y-2">
                            <label for="customer_notes" class="text-sm font-bold text-on-surface-variant ml-1">Notes (optionnel)</label>
                            <textarea name="customer_notes" 
                                      id="customer_notes" 
                                      rows="3" 
                                      placeholder="Instructions de livraison, commentaires..." 
                                      class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition resize-none"></textarea>
                        </div>

                        <input type="hidden" name="billing_same_as_shipping" value="1">
                        <input type="hidden" name="payment_method" value="cash_on_delivery">
                        <input type="hidden" name="shipping_address_line_2" value="">
                        <input type="hidden" name="shipping_postal_code" value="00000">

                        <div class="pt-4">
                            <div class="flex items-start gap-3 p-4 bg-primary/5 rounded-2xl border border-primary/10">
                                <span class="material-symbols-outlined text-primary mt-0.5">info</span>
                                <p class="text-sm text-on-surface-variant leading-relaxed">
                                    En confirmant votre commande, une notification sera envoyée à notre équipe pour validation. Vous recevrez un email de confirmation dès que possible.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Payment Method -->
                <div class="mt-8 bg-white rounded-3xl p-8 border border-gray-200 shadow-lg">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-10 h-10 rounded-full bg-secondary/10 text-secondary flex items-center justify-center">
                            <span class="material-symbols-outlined">payments</span>
                        </span>
                        <h2 class="font-headline text-xl font-bold text-on-surface">Méthode de paiement</h2>
                    </div>
                    <div class="flex items-center gap-4 p-4 border-2 border-primary bg-primary/5 rounded-2xl">
                        <span class="material-symbols-outlined text-primary">account_balance_wallet</span>
                        <div class="flex-1">
                            <p class="font-bold text-on-surface">Paiement à la livraison</p>
                            <p class="text-xs text-on-surface-variant">Payez en espèces ou par carte lors de la réception.</p>
                        </div>
                        <span class="material-symbols-outlined text-primary">check_circle</span>
                    </div>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="lg:col-span-5 sticky top-32">
                <div class="bg-gradient-to-br from-primary/5 to-primary/10 rounded-3xl p-8 shadow-xl border border-primary/20 relative overflow-hidden">
                    
                    <h2 class="font-headline text-2xl font-bold mb-8 text-on-surface relative z-10">Résumé de la commande</h2>
                    
                    <div class="space-y-6 relative z-10">
                        @foreach($cartItems as $item)
                            @php
                                $imageUrl = $item['product']->image && str_starts_with($item['product']->image, 'http') 
                                    ? $item['product']->image 
                                    : asset($item['product']->image);
                            @endphp
                            <div class="cart-item flex gap-4 items-center border-b border-gray-200 pb-4 transition-transform duration-200" data-product-id="{{ $item['product']->id }}">
                                <div class="w-16 h-16 bg-surface-container-low rounded-2xl p-2 flex-shrink-0">
                                    <img src="{{ $imageUrl }}" 
                                         alt="{{ $item['product']->name }}" 
                                         class="w-full h-full object-contain"
                                         onerror="this.src='https://via.placeholder.com/100x100?text=No+Image'">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-sm leading-tight mb-1 text-on-surface">{{ $item['product']->name }}</h4>
                                    <div class="flex items-center gap-3 mt-2">
                                        <!-- Quantity Controls -->
                                        <div class="flex items-center bg-surface-container-low rounded-full border border-gray-200">
                                            <button onclick="updateCartQuantity({{ $item['product']->id }}, {{ $item['quantity'] - 1 }})" 
                                                    class="w-7 h-7 flex items-center justify-center text-sm font-bold hover:bg-gray-100 rounded-full transition text-on-surface">-</button>
                                            <span class="item-quantity w-8 text-center text-sm font-bold text-on-surface">{{ $item['quantity'] }}</span>
                                            <button onclick="updateCartQuantity({{ $item['product']->id }}, {{ $item['quantity'] + 1 }})" 
                                                    class="w-7 h-7 flex items-center justify-center text-sm font-bold hover:bg-gray-100 rounded-full transition text-on-surface">+</button>
                                        </div>
                                        <!-- Remove Button -->
                                        <button onclick="removeFromCart({{ $item['product']->id }})" 
                                                class="text-on-surface-variant hover:text-red-600 transition" 
                                                title="Retirer">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                    <p class="text-on-surface-variant text-xs mt-1">{{ number_format($item['product']->price, 2, ',', ' ') }} MAD / unité</p>
                                </div>
                                <p class="font-bold item-subtotal text-primary">{{ number_format($item['subtotal'], 2, ',', ' ') }} MAD</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Totals -->
                    <div class="mt-12 space-y-3 pt-6 border-t border-gray-200 relative z-10">
                        <div class="flex justify-between text-on-surface-variant">
                            <span>Sous-total</span>
                            <span>{{ number_format($subtotal, 2, ',', ' ') }} MAD</span>
                        </div>
                        <div class="flex justify-between text-on-surface-variant">
                            <span>Frais de livraison</span>
                            @if($shippingCost == 0)
                                <span class="text-green-600 font-bold uppercase text-xs">Gratuit</span>
                            @else
                                <span>{{ number_format($shippingCost, 2, ',', ' ') }} MAD</span>
                            @endif
                        </div>
                        <div class="flex justify-between text-on-surface-variant">
                            <span>TVA (20%)</span>
                            <span>{{ number_format($tax, 2, ',', ' ') }} MAD</span>
                        </div>
                        <div class="flex justify-between items-end pt-4">
                            <span class="text-xl font-headline font-bold text-on-surface">Total TTC</span>
                            <span class="text-3xl font-headline font-extrabold tracking-tight text-primary transition-transform duration-200">{{ number_format($total, 2, ',', ' ') }} MAD</span>
                        </div>
                    </div>

                    <button type="submit" 
                            form="checkoutForm" 
                            id="submitBtn"
                            class="w-full mt-12 bg-primary text-white hover:bg-primary-container font-extrabold py-5 rounded-full transition shadow-xl hover:-translate-y-1 active:translate-y-0 text-lg flex items-center justify-center gap-3">
                        <span id="btnText">Confirmer la commande</span>
                        <span class="material-symbols-outlined" id="btnIcon">verified_user</span>
                    </button>

                    <a href="{{ route('products.index') }}" 
                       class="w-full mt-4 bg-surface-container-low hover:bg-surface-container text-on-surface font-bold py-4 rounded-full transition text-center flex items-center justify-center gap-2 border border-gray-200">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Continuer mes achats
                    </a>

                    <p class="text-center text-on-surface-variant text-[10px] mt-6 px-4">
                        En cliquant sur "Confirmer la commande", vous acceptez nos conditions générales de vente.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('checkoutForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnIcon = document.getElementById('btnIcon');
        
        // Disable button
        submitBtn.disabled = true;
        btnText.textContent = 'Traitement...';
        btnIcon.textContent = 'sync';
        btnIcon.classList.add('animate-spin');
        
        const formData = new FormData(e.target);
        const data = Object.fromEntries(formData);
        
        try {
            const response = await fetch('{{ route('checkout.process') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            });
            
            const result = await response.json();
            
            if (result.success) {
                btnText.textContent = 'Commande confirmée !';
                btnIcon.textContent = 'check_circle';
                btnIcon.classList.remove('animate-spin');
                
                setTimeout(() => {
                    window.location.href = result.redirect;
                }, 1000);
            } else {
                alert('Erreur: ' + result.message);
                submitBtn.disabled = false;
                btnText.textContent = 'Confirmer la commande';
                btnIcon.textContent = 'verified_user';
                btnIcon.classList.remove('animate-spin');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Une erreur est survenue. Veuillez réessayer.');
            submitBtn.disabled = false;
            btnText.textContent = 'Confirmer la commande';
            btnIcon.textContent = 'verified_user';
            btnIcon.classList.remove('animate-spin');
        }
    });

    // Update cart quantity
    async function updateCartQuantity(productId, newQuantity) {
        if (newQuantity < 1) {
            removeFromCart(productId);
            return;
        }

        // Find the cart item element
        const cartItem = document.querySelector(`.cart-item[data-product-id="${productId}"]`);
        if (!cartItem) return;

        // Show loading state
        const quantitySpan = cartItem.querySelector('.item-quantity');
        const originalQuantity = quantitySpan.textContent;
        quantitySpan.style.opacity = '0.5';

        try {
            const response = await fetch('/api/cart/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: newQuantity
                })
            });

            const data = await response.json();

            if (data.success) {
                // Update quantity display
                quantitySpan.textContent = newQuantity;
                quantitySpan.style.opacity = '1';

                // Update item subtotal
                const pricePerUnit = parseFloat(cartItem.querySelector('.text-xs').textContent.match(/[\d,]+/)[0].replace(',', '.'));
                const newSubtotal = pricePerUnit * newQuantity;
                cartItem.querySelector('.item-subtotal').textContent = newSubtotal.toFixed(2).replace('.', ',') + ' MAD';

                // Recalculate totals
                updateTotals();

                // Show success animation
                cartItem.style.transform = 'scale(1.02)';
                setTimeout(() => {
                    cartItem.style.transform = 'scale(1)';
                }, 200);
            } else {
                // Revert on error
                quantitySpan.textContent = originalQuantity;
                quantitySpan.style.opacity = '1';
                
                if (window.showToast) {
                    showToast({
                        type: 'error',
                        title: 'Erreur',
                        message: data.message || 'Impossible de mettre à jour la quantité',
                        duration: 3000
                    });
                } else {
                    alert(data.message || 'Impossible de mettre à jour la quantité');
                }
            }
        } catch (error) {
            console.error('Error:', error);
            quantitySpan.textContent = originalQuantity;
            quantitySpan.style.opacity = '1';
            alert('Une erreur est survenue');
        }
    }

    // Update totals without page reload
    function updateTotals() {
        let subtotal = 0;
        
        // Calculate new subtotal from all items
        document.querySelectorAll('.cart-item').forEach(item => {
            const subtotalText = item.querySelector('.item-subtotal').textContent;
            const itemSubtotal = parseFloat(subtotalText.replace('MAD', '').replace(',', '.').trim());
            subtotal += itemSubtotal;
        });

        // Calculate shipping (free if > 500 MAD)
        const shippingCost = subtotal >= 500 ? 0 : 50;
        
        // Calculate tax (20%)
        const tax = subtotal * 0.20;
        
        // Calculate total
        const total = subtotal + shippingCost + tax;

        // Update display
        const totalsSection = document.querySelector('.mt-12.space-y-3');
        const totalsElements = totalsSection.querySelectorAll('.flex.justify-between');
        
        // Update subtotal
        totalsElements[0].querySelector('span:last-child').textContent = subtotal.toFixed(2).replace('.', ',') + ' MAD';
        
        // Update shipping
        if (shippingCost === 0) {
            totalsElements[1].querySelector('span:last-child').innerHTML = '<span class="text-green-600 font-bold uppercase text-xs">Gratuit</span>';
        } else {
            totalsElements[1].querySelector('span:last-child').textContent = shippingCost.toFixed(2).replace('.', ',') + ' MAD';
        }
        
        // Update tax
        totalsElements[2].querySelector('span:last-child').textContent = tax.toFixed(2).replace('.', ',') + ' MAD';
        
        // Update total
        const totalElement = totalsSection.querySelector('.text-3xl');
        totalElement.textContent = total.toFixed(2).replace('.', ',') + ' MAD';
        
        // Animate total
        totalElement.style.transform = 'scale(1.1)';
        setTimeout(() => {
            totalElement.style.transform = 'scale(1)';
        }, 200);
    }

    // Remove from cart
    async function removeFromCart(productId) {
        if (!confirm('Voulez-vous vraiment retirer cet article du panier ?')) {
            return;
        }

        try {
            const response = await fetch('/api/cart/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId
                })
            });

            const data = await response.json();

            if (data.success) {
                // Reload page
                window.location.reload();
            } else {
                alert('Erreur lors de la suppression');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Une erreur est survenue');
        }
    }
</script>
@endsection
