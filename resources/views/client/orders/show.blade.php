@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">
                    {{ $order->order_number }}
                </h1>
                <p class="text-gray-600">
                    Commandé le {{ $order->created_at->format('d/m/Y à H:i') }}
                </p>
            </div>
            <a href="{{ route('orders.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition flex items-center gap-2">
                <span class="material-symbols-outlined">arrow_back</span>
                Retour
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left: Order Details -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Status Card -->
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <h2 class="font-semibold text-xl mb-4 text-gray-900">Statut de la commande</h2>
                    <div class="flex items-center gap-4">
                        <span class="inline-block px-6 py-3 rounded-full text-lg font-semibold bg-{{ $order->status_color }}/10 text-{{ $order->status_color }}">
                            {{ $order->status_label }}
                        </span>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <h2 class="font-semibold text-xl mb-6 text-gray-900">Articles commandés</h2>
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            @php
                                $imageUrl = $item->product_image && str_starts_with($item->product_image, 'http') 
                                    ? $item->product_image 
                                    : asset($item->product_image);
                            @endphp
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                                <img src="{{ $imageUrl }}" 
                                     alt="{{ $item->product_name }}" 
                                     class="w-20 h-20 object-contain rounded-lg"
                                     onerror="this.src='https://via.placeholder.com/100x100?text=No+Image'">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">{{ $item->product_name }}</h4>
                                    @if($item->product_sku)
                                        <p class="text-xs text-gray-500">SKU: {{ $item->product_sku }}</p>
                                    @endif
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ number_format($item->price, 2, ',', ' ') }} MAD × {{ $item->quantity }}
                                    </p>
                                </div>
                                <p class="text-xl font-bold text-gray-900">{{ number_format($item->subtotal, 2, ',', ' ') }} MAD</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Customer Notes -->
                @if($order->customer_notes)
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                        <h3 class="font-semibold text-lg mb-3 text-blue-900 flex items-center gap-2">
                            <span class="material-symbols-outlined">note</span>
                            Vos notes
                        </h3>
                        <p class="text-blue-800">{{ $order->customer_notes }}</p>
                    </div>
                @endif
            </div>

            <!-- Right: Summary & Info -->
            <div class="lg:col-span-1 space-y-6">
                
                <!-- Order Summary -->
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm sticky top-6">
                    <h2 class="font-semibold text-xl mb-6 text-gray-900">Résumé</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Sous-total</span>
                            <span>{{ number_format($order->subtotal, 2, ',', ' ') }} MAD</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Livraison</span>
                            @if($order->shipping_cost == 0)
                                <span class="text-green-500 font-semibold">Gratuit</span>
                            @else
                                <span>{{ number_format($order->shipping_cost, 2, ',', ' ') }} MAD</span>
                            @endif
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>TVA</span>
                            <span>{{ number_format($order->tax, 2, ',', ' ') }} MAD</span>
                        </div>
                        @if($order->discount > 0)
                            <div class="flex justify-between text-green-500">
                                <span>Réduction</span>
                                <span>-{{ number_format($order->discount, 2, ',', ' ') }} MAD</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-semibold text-gray-900">Total</span>
                            <span class="text-3xl font-bold text-gray-900">{{ number_format($order->total, 2, ',', ' ') }} MAD</span>
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <h3 class="font-semibold text-lg mb-4 text-gray-900 flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-600">local_shipping</span>
                        Livraison
                    </h3>
                    <div class="text-gray-700 space-y-1">
                        <p class="font-semibold text-gray-900">{{ $order->shipping_name }}</p>
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
                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <h3 class="font-semibold text-lg mb-4 text-gray-900 flex items-center gap-2">
                        <span class="material-symbols-outlined text-blue-600">payments</span>
                        Paiement
                    </h3>
                    <p class="text-gray-700">
                        {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
