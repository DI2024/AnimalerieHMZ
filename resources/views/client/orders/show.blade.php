@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-surface dark:bg-[#0f1117] py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold font-headline text-primary mb-2">
                    {{ $order->order_number }}
                </h1>
                <p class="text-on-surface-variant dark:text-gray-400">
                    Commandé le {{ $order->created_at->format('d/m/Y à H:i') }}
                </p>
            </div>
            <a href="{{ route('orders.index') }}" class="bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-on-surface dark:text-white font-bold py-3 px-6 rounded-full transition flex items-center gap-2">
                <span class="material-symbols-outlined">arrow_back</span>
                Retour
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left: Order Details -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Status Card -->
                <div class="bg-white dark:bg-[#1a1d2e] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-lg">
                    <h2 class="font-bold text-xl mb-4 dark:text-white">Statut de la commande</h2>
                    <div class="flex items-center gap-4">
                        <span class="inline-block px-6 py-3 rounded-full text-lg font-bold bg-{{ $order->status_color }}/10 text-{{ $order->status_color }}">
                            {{ $order->status_label }}
                        </span>
                        <span class="inline-block px-6 py-3 rounded-full text-lg font-bold bg-blue-500/10 text-blue-500">
                            {{ $order->payment_status_label }}
                        </span>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-white dark:bg-[#1a1d2e] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-lg">
                    <h2 class="font-bold text-xl mb-6 dark:text-white">Articles commandés</h2>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            @php
                                $imageUrl = $item->product_image && str_starts_with($item->product_image, 'http') 
                                    ? $item->product_image 
                                    : asset('storage/' . $item->product_image);
                            @endphp
                            <div class="flex items-center gap-4 p-4 bg-surface dark:bg-[#13162a] rounded-xl">
                                <img src="{{ $imageUrl }}" 
                                     alt="{{ $item->product_name }}" 
                                     class="w-20 h-20 object-contain rounded-lg"
                                     onerror="this.src='https://via.placeholder.com/100x100?text=No+Image'">
                                <div class="flex-1">
                                    <h4 class="font-bold dark:text-white">{{ $item->product_name }}</h4>
                                    @if($item->product_sku)
                                        <p class="text-xs text-on-surface-variant dark:text-gray-400">SKU: {{ $item->product_sku }}</p>
                                    @endif
                                    <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">
                                        {{ number_format($item->price, 2, ',', ' ') }}€ × {{ $item->quantity }}
                                    </p>
                                </div>
                                <p class="text-xl font-bold text-primary">{{ number_format($item->subtotal, 2, ',', ' ') }}€</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Customer Notes -->
                @if($order->customer_notes)
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-2xl p-6 border border-blue-200 dark:border-blue-800">
                        <h3 class="font-bold text-lg mb-3 text-blue-900 dark:text-blue-300 flex items-center gap-2">
                            <span class="material-symbols-outlined">note</span>
                            Vos notes
                        </h3>
                        <p class="text-blue-800 dark:text-blue-200">{{ $order->customer_notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Right: Summary & Info -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Order Summary -->
                <div class="bg-white dark:bg-[#1a1d2e] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-lg sticky top-6">
                    <h2 class="font-bold text-xl mb-6 dark:text-white">Résumé</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-on-surface-variant dark:text-gray-400">
                            <span>Sous-total</span>
                            <span>{{ number_format($order->subtotal, 2, ',', ' ') }}€</span>
                        </div>
                        <div class="flex justify-between text-on-surface-variant dark:text-gray-400">
                            <span>Livraison</span>
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
                        @if($order->discount > 0)
                            <div class="flex justify-between text-green-500">
                                <span>Réduction</span>
                                <span>-{{ number_format($order->discount, 2, ',', ' ') }}€</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="pt-6 border-t border-gray-100 dark:border-gray-800">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold dark:text-white">Total</span>
                            <span class="text-3xl font-black text-primary">{{ number_format($order->total, 2, ',', ' ') }}€</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white dark:bg-[#1a1d2e] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-lg">
                    <h3 class="font-bold text-lg mb-4 dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">local_shipping</span>
                        Livraison
                    </h3>
                    <div class="text-on-surface-variant dark:text-gray-300 space-y-1">
                        <p class="font-bold dark:text-white">{{ $order->shipping_name }}</p>
                        <p>{{ $order->shipping_address_line_1 }}</p>
                        @if($order->shipping_address_line_2)
                            <p>{{ $order->shipping_address_line_2 }}</p>
                        @endif
                        <p>{{ $order->shipping_postal_code }} {{ $order->shipping_city }}</p>
                        <p>{{ $order->shipping_country }}</p>
                        <p class="mt-3 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">phone</span>
                            {{ $order->shipping_phone }}
                        </p>
                        <p class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">email</span>
                            {{ $order->shipping_email }}
                        </p>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white dark:bg-[#1a1d2e] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-lg">
                    <h3 class="font-bold text-lg mb-4 dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">payments</span>
                        Paiement
                    </h3>
                    <p class="text-on-surface-variant dark:text-gray-300">
                        {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
