@extends('layouts.app')

@section('content')
<div class="bg-surface-container-low dark:bg-[#0f1117] min-h-screen py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-sm text-on-surface-variant dark:text-gray-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary transition">Accueil</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span class="font-bold text-primary">Confirmation de commande</span>
        </nav>

        <h1 class="font-headline text-[clamp(2rem,5vw,2.5rem)] font-bold tracking-tight text-primary mb-12">Finaliser votre commande</h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Left: Delivery Form -->
            <div class="lg:col-span-7">
                <div class="bg-white dark:bg-[#1a1d2e] rounded-3xl p-8 border border-gray-100 dark:border-gray-800 shadow-lg">
                    <div class="flex items-center gap-3 mb-8">
                        <span class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined">local_shipping</span>
                        </span>
                        <h2 class="font-headline text-2xl font-bold dark:text-white">Informations de livraison</h2>
                    </div>

                    <form id="checkoutForm" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="shipping_first_name" class="text-sm font-bold text-on-surface-variant dark:text-gray-300 ml-1">Prénom *</label>
                                <input type="text" 
                                       name="shipping_first_name" 
                                       id="shipping_first_name" 
                                       value="{{ auth()->check() ? auth()->user()->name : '' }}"
                                       placeholder="Jean" 
                                       class="w-full bg-surface-container-low dark:bg-[#13162a] border border-outline-variant dark:border-gray-700 rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition dark:text-white" 
                                       required>
                            </div>
                            <div class="space-y-2">
                                <label for="shipping_last_name" class="text-sm font-bold text-on-surface-variant dark:text-gray-300 ml-1">Nom *</label>
                                <input type="text" 
                                       name="shipping_last_name" 
                                       id="shipping_last_name" 
                                       placeholder="Dupont" 
                                       class="w-full bg-surface-container-low dark:bg-[#13162a] border border-outline-variant dark:border-gray-700 rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition dark:text-white" 
                                       required>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="shipping_email" class="text-sm font-bold text-on-surface-variant dark:text-gray-300 ml-1">Email *</label>
                            <input type="email" 
                                   name="shipping_email" 
                                   id="shipping_email" 
                                   value="{{ auth()->check() ? auth()->user()->email : '' }}"
                                   placeholder="jean.dupont@example.com" 
                                   class="w-full bg-surface-container-low dark:bg-[#13162a] border border-outline-variant dark:border-gray-700 rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition dark:text-white" 
                                   required>
                        </div>

                        <div class="space-y-2">
                            <label for="shipping_phone" class="text-sm font-bold text-on-surface-variant dark:text-gray-300 ml-1">Téléphone *</label>
                            <input type="tel" 
                                   name="shipping_phone" 
                                   id="shipping_phone" 
                                   placeholder="06 12 34 56 78" 
                                   class="w-full bg-surface-container-low dark:bg-[#13162a] border border-outline-variant dark:border-gray-700 rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition dark:text-white" 
                                   required>
                        </div>

                        <div class="space-y-2">
                            <label for="shipping_address_line_1" class="text-sm font-bold text-on-surface-variant dark:text-gray-300 ml-1">Adresse *</label>
                            <input type="text" 
                                   name="shipping_address_line_1" 
                                   id="shipping_address_line_1" 
                                   placeholder="123 Rue de la Paix" 
                                   class="w-full bg-surface-container-low dark:bg-[#13162a] border border-outline-variant dark:border-gray-700 rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition dark:text-white" 
                                   required>
                        </div>

                        <div class="space-y-2">
                            <label for="shipping_address_line_2" class="text-sm font-bold text-on-surface-variant dark:text-gray-300 ml-1">Complément d'adresse</label>
                            <input type="text" 
                                   name="shipping_address_line_2" 
                                   id="shipping_address_line_2" 
                                   placeholder="Appartement, étage, etc." 
                                   class="w-full bg-surface-container-low dark:bg-[#13162a] border border-outline-variant dark:border-gray-700 rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition dark:text-white">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="shipping_city" class="text-sm font-bold text-on-surface-variant dark:text-gray-300 ml-1">Ville *</label>
                                <input type="text" 
                                       name="shipping_city" 
                                       id="shipping_city" 
                                       placeholder="Paris" 
                                       class="w-full bg-surface-container-low dark:bg-[#13162a] border border-outline-variant dark:border-gray-700 rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition dark:text-white" 
                                       required>
                            </div>
                            <div class="space-y-2">
                                <label for="shipping_postal_code" class="text-sm font-bold text-on-surface-variant dark:text-gray-300 ml-1">Code Postal *</label>
                                <input type="text" 
                                       name="shipping_postal_code" 
                                       id="shipping_postal_code" 
                                       placeholder="75000" 
                                       class="w-full bg-surface-container-low dark:bg-[#13162a] border border-outline-variant dark:border-gray-700 rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition dark:text-white" 
                                       required>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="shipping_country" class="text-sm font-bold text-on-surface-variant dark:text-gray-300 ml-1">Pays *</label>
                            <input type="text" 
                                   name="shipping_country" 
                                   id="shipping_country" 
                                   value="France" 
                                   class="w-full bg-surface-container-low dark:bg-[#13162a] border border-outline-variant dark:border-gray-700 rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition dark:text-white" 
                                   required>
                        </div>

                        <div class="space-y-2">
                            <label for="customer_notes" class="text-sm font-bold text-on-surface-variant dark:text-gray-300 ml-1">Notes (optionnel)</label>
                            <textarea name="customer_notes" 
                                      id="customer_notes" 
                                      rows="3" 
                                      placeholder="Instructions de livraison, commentaires..." 
                                      class="w-full bg-surface-container-low dark:bg-[#13162a] border border-outline-variant dark:border-gray-700 rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition resize-none dark:text-white"></textarea>
                        </div>

                        <input type="hidden" name="billing_same_as_shipping" value="1">
                        <input type="hidden" name="payment_method" value="cash_on_delivery">

                        <div class="pt-4">
                            <div class="flex items-start gap-3 p-4 bg-primary/5 dark:bg-primary/10 rounded-2xl border border-primary/10 dark:border-primary/20">
                                <span class="material-symbols-outlined text-primary mt-0.5">info</span>
                                <p class="text-sm text-on-surface-variant dark:text-gray-300 leading-relaxed">
                                    En confirmant votre commande, une notification sera envoyée à notre équipe pour validation. Vous recevrez un email de confirmation dès que possible.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Payment Method -->
                <div class="mt-8 bg-white dark:bg-[#1a1d2e] rounded-3xl p-8 border border-gray-100 dark:border-gray-800 shadow-lg">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-10 h-10 rounded-full bg-secondary/10 text-secondary flex items-center justify-center">
                            <span class="material-symbols-outlined">payments</span>
                        </span>
                        <h2 class="font-headline text-xl font-bold dark:text-white">Méthode de paiement</h2>
                    </div>
                    <div class="flex items-center gap-4 p-4 border-2 border-primary bg-primary/5 dark:bg-primary/10 rounded-2xl">
                        <span class="material-symbols-outlined text-primary">account_balance_wallet</span>
                        <div class="flex-1">
                            <p class="font-bold dark:text-white">Paiement à la livraison</p>
                            <p class="text-xs text-on-surface-variant dark:text-gray-400">Payez en espèces ou par carte lors de la réception.</p>
                        </div>
                        <span class="material-symbols-outlined text-primary">check_circle</span>
                    </div>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="lg:col-span-5 sticky top-32">
                <div class="bg-primary-container text-white rounded-[3rem] p-8 shadow-xl relative overflow-hidden">
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                    
                    <h2 class="font-headline text-2xl font-bold mb-8 relative z-10">Résumé de la commande</h2>
                    
                    <div class="space-y-6 relative z-10">
                        @foreach($cartItems as $item)
                            @php
                                $imageUrl = $item['product']->image && str_starts_with($item['product']->image, 'http') 
                                    ? $item['product']->image 
                                    : asset('storage/' . $item['product']->image);
                            @endphp
                            <div class="flex gap-4 items-center border-b border-white/10 pb-4">
                                <div class="w-16 h-16 bg-white rounded-2xl p-2 flex-shrink-0">
                                    <img src="{{ $imageUrl }}" 
                                         alt="{{ $item['product']->name }}" 
                                         class="w-full h-full object-contain"
                                         onerror="this.src='https://via.placeholder.com/100x100?text=No+Image'">
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-sm leading-tight">{{ $item['product']->name }}</h4>
                                    <p class="text-white/70 text-xs mt-1">Quantité: {{ $item['quantity'] }}</p>
                                </div>
                                <p class="font-bold">{{ number_format($item['subtotal'], 2, ',', ' ') }}€</p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Totals -->
                    <div class="mt-12 space-y-3 pt-6 border-t border-white/20 relative z-10">
                        <div class="flex justify-between text-white/80">
                            <span>Sous-total</span>
                            <span>{{ number_format($subtotal, 2, ',', ' ') }}€</span>
                        </div>
                        <div class="flex justify-between text-white/80">
                            <span>Frais de livraison</span>
                            @if($shippingCost == 0)
                                <span class="text-green-400 font-bold uppercase text-xs">Gratuit</span>
                            @else
                                <span>{{ number_format($shippingCost, 2, ',', ' ') }}€</span>
                            @endif
                        </div>
                        <div class="flex justify-between text-white/80">
                            <span>TVA (20%)</span>
                            <span>{{ number_format($tax, 2, ',', ' ') }}€</span>
                        </div>
                        <div class="flex justify-between items-end pt-4">
                            <span class="text-xl font-headline font-bold">Total TTC</span>
                            <span class="text-3xl font-headline font-extrabold tracking-tight">{{ number_format($total, 2, ',', ' ') }}€</span>
                        </div>
                    </div>

                    <button type="submit" 
                            form="checkoutForm" 
                            id="submitBtn"
                            class="w-full mt-12 bg-white text-primary hover:bg-primary-light hover:text-primary-container font-extrabold py-5 rounded-full transition shadow-xl hover:-translate-y-1 active:translate-y-0 text-lg flex items-center justify-center gap-3">
                        <span id="btnText">Confirmer la commande</span>
                        <span class="material-symbols-outlined" id="btnIcon">verified_user</span>
                    </button>

                    <p class="text-center text-white/50 text-[10px] mt-6 px-4">
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
</script>
@endsection
