@extends('layouts.app')

@section('content')
<div class="bg-surface-container-low min-h-screen py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-sm text-on-surface-variant mb-8">
            <a href="/" class="hover:text-primary transition">Accueil</a>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span class="font-bold text-primary">Confirmation de commande</span>
        </nav>

        <h1 class="font-headline text-[clamp(2rem,5vw,2.5rem)] font-bold tracking-tight text-primary mb-12">Finaliser votre commande</h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Left: Delivery Form -->
            <div class="lg:col-span-7">
                <div class="ticket-card bg-white p-1">
                    <div class="ticket-inner">
                        <div class="flex items-center gap-3 mb-8">
                            <span class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                                <span class="material-symbols-outlined">local_shipping</span>
                            </span>
                            <h2 class="font-headline text-2xl font-bold">Informations de livraison</h2>
                        </div>

                        <form id="checkoutForm" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="firstName" class="text-sm font-bold text-on-surface-variant ml-1">Prénom</label>
                                    <input type="text" id="firstName" placeholder="Jean" class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" required>
                                </div>
                                <div class="space-y-2">
                                    <label for="lastName" class="text-sm font-bold text-on-surface-variant ml-1">Nom</label>
                                    <input type="text" id="lastName" placeholder="Dupont" class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" required>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="email" class="text-sm font-bold text-on-surface-variant ml-1">Email</label>
                                <input type="email" id="email" placeholder="jean.dupont@example.com" class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" required>
                            </div>

                            <div class="space-y-2">
                                <label for="phone" class="text-sm font-bold text-on-surface-variant ml-1">Téléphone</label>
                                <input type="tel" id="phone" placeholder="06 12 34 56 78" class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" required>
                            </div>

                            <div class="space-y-2">
                                <label for="address" class="text-sm font-bold text-on-surface-variant ml-1">Adresse complète</label>
                                <textarea id="address" rows="3" placeholder="123 Rue de la Paix" class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition resize-none" required></textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="city" class="text-sm font-bold text-on-surface-variant ml-1">Ville</label>
                                    <input type="text" id="city" placeholder="Paris" class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" required>
                                </div>
                                <div class="space-y-2">
                                    <label for="zip" class="text-sm font-bold text-on-surface-variant ml-1">Code Postal</label>
                                    <input type="text" id="zip" placeholder="75000" class="w-full bg-surface-container-low border border-outline-variant rounded-xl px-4 py-3 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" required>
                                </div>
                            </div>

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
                </div>

                <!-- Payment Method (Visual Only) -->
                <div class="mt-8 ticket-card bg-white p-1">
                    <div class="ticket-inner !py-8">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="w-10 h-10 rounded-full bg-secondary/10 text-secondary flex items-center justify-center">
                                <span class="material-symbols-outlined">payments</span>
                            </span>
                            <h2 class="font-headline text-xl font-bold">Méthode de paiement</h2>
                        </div>
                        <div class="flex items-center gap-4 p-4 border-2 border-primary bg-primary/5 rounded-2xl">
                            <span class="material-symbols-outlined text-primary">account_balance_wallet</span>
                            <div class="flex-1">
                                <p class="font-bold">Paiement à la livraison</p>
                                <p class="text-xs text-on-surface-variant">Payez en espèces ou par carte lors de la réception.</p>
                            </div>
                            <span class="material-symbols-outlined text-primary">check_circle</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Order Summary -->
            <div class="lg:col-span-5 sticky top-32">
                <div class="bg-primary-container text-white rounded-[3rem] p-8 shadow-xl relative overflow-hidden">
                    <!-- Decorative background element -->
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                    
                    <h2 class="font-headline text-2xl font-bold mb-8 relative z-10">Résumé de la commande</h2>
                    
                    <div class="space-y-6 relative z-10">
                        <!-- Placeholder items -->
                        <div class="flex gap-4 items-center border-b border-white/10 pb-4">
                            <div class="w-16 h-16 bg-white rounded-2xl p-2 flex-shrink-0">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw" alt="Product" class="w-full h-full object-contain">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-sm leading-tight">Volière Design White Edition</h4>
                                <p class="text-white/70 text-xs mt-1">Quantité: 1</p>
                            </div>
                            <p class="font-bold">89,00€</p>
                        </div>

                        <div class="flex gap-4 items-center border-b border-white/10 pb-4">
                            <div class="w-16 h-16 bg-white rounded-2xl p-2 flex-shrink-0">
                                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A" alt="Product" class="w-full h-full object-contain">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-sm leading-tight">Croquettes Royal Canin Sterilised</h4>
                                <p class="text-white/70 text-xs mt-1">Quantité: 2</p>
                            </div>
                            <p class="font-bold">69,98€</p>
                        </div>
                    </div>

                    <!-- Totals -->
                    <div class="mt-12 space-y-3 pt-6 border-t border-white/20 relative z-10">
                        <div class="flex justify-between text-white/80">
                            <span>Sous-total</span>
                            <span>158,98€</span>
                        </div>
                        <div class="flex justify-between text-white/80">
                            <span>Frais de livraison</span>
                            <span class="text-green-400 font-bold uppercase text-xs">Gratuit</span>
                        </div>
                        <div class="flex justify-between items-end pt-4">
                            <span class="text-xl font-headline font-bold">Total TTC</span>
                            <span class="text-3xl font-headline font-extrabold tracking-tight">158,98€</span>
                        </div>
                    </div>

                    <button type="submit" form="checkoutForm" class="w-full mt-12 bg-white text-primary hover:bg-primary-light hover:text-primary-container font-extrabold py-5 rounded-full transition shadow-xl hover:-translate-y-1 active:translate-y-0 text-lg flex items-center justify-center gap-3">
                        Confirmer la commande
                        <span class="material-symbols-outlined">verified_user</span>
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
    document.getElementById('checkoutForm').addEventListener('submit', (e) => {
        e.preventDefault();
        // Visual confirmation for now
        alert('Merci pour votre commande ! L\'administrateur a été notifié.');
        window.location.href = '/';
    });
</script>
@endsection
