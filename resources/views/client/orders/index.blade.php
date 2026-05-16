@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-surface dark:bg-[#0f1117] py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold font-headline text-on-surface dark:text-white mb-2">
                    Mes Commandes
                </h1>
                <p class="text-on-surface-variant dark:text-gray-400">
                    {{ $orders->total() }} commande{{ $orders->total() > 1 ? 's' : '' }}
                </p>
            </div>
            <a href="{{ route('home') }}" class="bg-primary hover:bg-primary-container text-white font-bold py-3 px-6 rounded-full transition flex items-center gap-2">
                <span class="material-symbols-outlined">arrow_back</span>
                Retour
            </a>
        </div>

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white dark:bg-[#1a1d2e] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-lg hover:shadow-xl transition">
                        <!-- Order Header -->
                        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 pb-6 border-b border-gray-100 dark:border-gray-800">
                            <div>
                                <a href="{{ route('orders.show', $order->order_number) }}" class="text-2xl font-bold text-primary hover:underline">
                                    {{ $order->order_number }}
                                </a>
                                <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">
                                    Commandé le {{ $order->created_at->format('d/m/Y à H:i') }}
                                </p>
                            </div>
                            <div class="flex items-center gap-4 mt-4 md:mt-0">
                                <span class="inline-block px-4 py-2 rounded-full text-sm font-bold bg-{{ $order->status_color }}/10 text-{{ $order->status_color }}">
                                    {{ $order->status_label }}
                                </span>
                                <span class="text-2xl font-black text-primary">{{ number_format($order->total, 2, ',', ' ') }}€</span>
                            </div>
                        </div>

                        <!-- Order Items Preview -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            @foreach($order->items->take(2) as $item)
                                @php
                                    $imageUrl = $item->product_image && str_starts_with($item->product_image, 'http') 
                                        ? $item->product_image 
                                        : asset('storage/' . $item->product_image);
                                @endphp
                                <div class="flex items-center gap-4 p-3 bg-surface dark:bg-[#13162a] rounded-xl">
                                    <img src="{{ $imageUrl }}" 
                                         alt="{{ $item->product_name }}" 
                                         class="w-16 h-16 object-contain rounded-lg"
                                         onerror="this.src='https://via.placeholder.com/100x100?text=No+Image'">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-sm dark:text-white line-clamp-1">{{ $item->product_name }}</h4>
                                        <p class="text-xs text-on-surface-variant dark:text-gray-400">Qté: {{ $item->quantity }}</p>
                                    </div>
                                    <p class="font-bold text-primary text-sm">{{ number_format($item->subtotal, 2, ',', ' ') }}€</p>
                                </div>
                            @endforeach
                        </div>

                        @if($order->items->count() > 2)
                            <p class="text-sm text-on-surface-variant dark:text-gray-400 mb-4">
                                + {{ $order->items->count() - 2 }} autre{{ $order->items->count() - 2 > 1 ? 's' : '' }} article{{ $order->items->count() - 2 > 1 ? 's' : '' }}
                            </p>
                        @endif

                        <!-- Order Info -->
                        <div class="flex flex-col md:flex-row gap-4 text-sm">
                            <div class="flex items-center gap-2 text-on-surface-variant dark:text-gray-400">
                                <span class="material-symbols-outlined text-sm">local_shipping</span>
                                <span>{{ $order->shipping_city }}, {{ $order->shipping_country }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-on-surface-variant dark:text-gray-400">
                                <span class="material-symbols-outlined text-sm">payments</span>
                                <span>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-on-surface-variant dark:text-gray-400">
                                <span class="material-symbols-outlined text-sm">inventory_2</span>
                                <span>{{ $order->items->count() }} article{{ $order->items->count() > 1 ? 's' : '' }}</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3 mt-6 pt-6 border-t border-gray-100 dark:border-gray-800">
                            <a href="{{ route('orders.show', $order->order_number) }}" class="flex-1 bg-primary hover:bg-primary-container text-white font-bold py-3 px-4 rounded-xl transition text-center flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm">visibility</span>
                                Voir les détails
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <div class="bg-white dark:bg-[#1a1d2e] rounded-2xl p-12 text-center border border-gray-100 dark:border-gray-800">
                <span class="material-symbols-outlined text-8xl text-gray-300 dark:text-gray-700 mb-4">shopping_bag</span>
                <h3 class="text-2xl font-bold dark:text-white mb-2">Aucune commande</h3>
                <p class="text-on-surface-variant dark:text-gray-400 mb-6">Vous n'avez pas encore passé de commande</p>
                <a href="{{ route('products.index') }}" class="inline-block bg-primary hover:bg-primary-container text-white font-bold py-4 px-8 rounded-full transition">
                    Découvrir nos produits
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
