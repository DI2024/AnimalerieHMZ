@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-surface to-primary/5 dark:from-[#0f1117] dark:via-[#13162a] dark:to-[#0f1117] py-12">
    <div class="max-w-[800px] mx-auto px-6">
        
        <!-- Success Icon -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-green-500 rounded-full mb-6 animate-bounce">
                <span class="material-symbols-outlined text-white text-5xl">check_circle</span>
            </div>
            <h1 class="text-4xl font-extrabold font-headline text-on-surface dark:text-white mb-3">
                Commande confirmée !
            </h1>
            <p class="text-lg text-on-surface-variant dark:text-gray-400">
                Merci pour votre confiance
            </p>
        </div>

        <!-- Order Info Card -->
        <div class="bg-white dark:bg-[#1a1d2e] rounded-3xl p-8 shadow-2xl border border-gray-100 dark:border-gray-800 mb-8">
            <div class="flex items-center justify-between mb-6 pb-6 border-b border-gray-100 dark:border-gray-800">
                <div>
                    <p class="text-sm text-on-surface-variant dark:text-gray-400 mb-1">Numéro de commande</p>
                    <p class="text-2xl font-bold text-primary">{{ $order->order_number }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-on-surface-variant dark:text-gray-400 mb-1">Date</p>
                    <p class="font-bold dark:text-white">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <!-- Order Items -->
            <div class="space-y-4 mb-6">
                <h3 class="font-bold text-lg dark:text-white">Articles commandés</h3>
                @foreach($order->items as $item)
                    @php
                        $imageUrl = $item->product_image && str_starts_with($item->product_image, 'http') 
                            ? $item->product_image 
                            : asset('storage/' . $item->product_image);
                    @endphp
                    <div class="flex items-center gap-4 p-4 bg-surface dark:bg-[#13162a] rounded-xl">
                        <img src="{{ $imageUrl }}" 
                             alt="{{ $item->product_name }}" 
                             class="w-16 h-16 object-contain rounded-lg"
                             onerror="this.src='https://via.placeholder.com/100x100?text=No+Image'">
                        <div class="flex-1">
                            <h4 class="font-bold dark:text-white">{{ $item->product_name }}</h4>
                            <p class="text-sm text-on-surface-variant dark:text-gray-400">Quantité: {{ $item->quantity }}</p>
                        </div>
                        <p class="font-bold text-primary">{{ number_format($item->subtotal, 2, ',', ' ') }}€</p>
                    </div>
                @endforeach
            </div>

            <!-- Totals -->
            <div class="space-y-2 pt-6 border-t border-gray-100 dark:border-gray-800">
                <div class="flex justify-between text-on-surface-variant dark:text-gray-400">
                    <span>Sous-total</span>
                    <span>{{ number_format($order->subtotal, 2, ',', ' ') }}€</span>
                </div>
                <div class="flex justify-between text-on-surface-variant dark:text-gray-400">
                    <span>Frais de livraison</span>
                    @if($order->shipping_cost == 0)
                        <span class="text-green-500 font-bold">Gratuit</span>
                    @else
                        <span>{{ number_format($order->shipping_cost, 2, ',', ' ') }}€</span>
                    @endif
                </div>
                <div class="flex justify-between text-on-surface-variant dark:text-gray-400">
                    <span>TVA</span>
                    <span>{{ number_format($order->tax, 2, ',', ' ') }}€</span>
                </div>
                <div class="flex justify-between items-center pt-4 text-xl font-bold">
                    <span class="dark:text-white">Total</span>
                    <span class="text-primary">{{ number_format($order->total, 2, ',', ' ') }}€</span>
                </div>
            </div>
        </div>

        <!-- Delivery Info -->
        <div class="bg-white dark:bg-[#1a1d2e] rounded-3xl p-8 shadow-2xl border border-gray-100 dark:border-gray-800 mb-8">
            <h3 class="font-bold text-lg mb-4 dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">local_shipping</span>
                Adresse de livraison
            </h3>
            <div class="text-on-surface-variant dark:text-gray-300">
                <p class="font-bold dark:text-white">{{ $order->shipping_name }}</p>
                <p>{{ $order->shipping_address_line_1 }}</p>
                @if($order->shipping_address_line_2)
                    <p>{{ $order->shipping_address_line_2 }}</p>
                @endif
                <p>{{ $order->shipping_postal_code }} {{ $order->shipping_city }}</p>
                <p>{{ $order->shipping_country }}</p>
                <p class="mt-2">
                    <span class="material-symbols-outlined text-sm align-middle">phone</span>
                    {{ $order->shipping_phone }}
                </p>
                <p>
                    <span class="material-symbols-outlined text-sm align-middle">email</span>
                    {{ $order->shipping_email }}
                </p>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-3xl p-8 border border-blue-200 dark:border-blue-800 mb-8">
            <h3 class="font-bold text-lg mb-4 text-blue-900 dark:text-blue-300 flex items-center gap-2">
                <span class="material-symbols-outlined">info</span>
                Prochaines étapes
            </h3>
            <ul class="space-y-3 text-blue-800 dark:text-blue-200">
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-sm mt-0.5">check</span>
                    <span>Vous recevrez un email de confirmation à <strong>{{ $order->shipping_email }}</strong></span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-sm mt-0.5">check</span>
                    <span>Notre équipe prépare votre commande</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-sm mt-0.5">check</span>
                    <span>Livraison estimée: 2-3 jours ouvrés</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-sm mt-0.5">check</span>
                    <span>Paiement à la livraison (espèces ou carte)</span>
                </li>
            </ul>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('home') }}" class="flex-1 bg-primary hover:bg-primary-container text-white font-bold py-4 px-6 rounded-full transition text-center flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">home</span>
                Retour à l'accueil
            </a>
            @auth
                <a href="{{ route('orders.show', $order->order_number) }}" class="flex-1 bg-white dark:bg-[#1a1d2e] hover:bg-gray-50 dark:hover:bg-[#13162a] text-primary border-2 border-primary font-bold py-4 px-6 rounded-full transition text-center flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">receipt_long</span>
                    Voir ma commande
                </a>
            @endauth
        </div>
    </div>
</div>

<style>
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce {
        animation: bounce 1s ease-in-out 3;
    }
</style>
@endsection
