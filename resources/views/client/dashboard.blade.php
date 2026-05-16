@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-surface dark:bg-[#0f1117] py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold font-headline text-on-surface dark:text-white mb-2">
                Bonjour, {{ $user->name }} 👋
            </h1>
            <p class="text-on-surface-variant dark:text-gray-400">
                Bienvenue sur votre tableau de bord
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Total Orders -->
            <div class="bg-white dark:bg-[#1a1d2e] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-2xl">shopping_bag</span>
                    </div>
                    <span class="text-3xl font-black text-primary">{{ $stats['total_orders'] }}</span>
                </div>
                <h3 class="font-bold text-on-surface dark:text-white">Commandes totales</h3>
                <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">Depuis votre inscription</p>
            </div>

            <!-- Pending Orders -->
            <div class="bg-white dark:bg-[#1a1d2e] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-orange-500/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-orange-500 text-2xl">pending</span>
                    </div>
                    <span class="text-3xl font-black text-orange-500">{{ $stats['pending_orders'] }}</span>
                </div>
                <h3 class="font-bold text-on-surface dark:text-white">En attente</h3>
                <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">Commandes en cours</p>
            </div>

            <!-- Total Spent -->
            <div class="bg-white dark:bg-[#1a1d2e] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-green-500/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-green-500 text-2xl">euro</span>
                    </div>
                    <span class="text-3xl font-black text-green-500">{{ number_format($stats['total_spent'], 0, ',', ' ') }}€</span>
                </div>
                <h3 class="font-bold text-on-surface dark:text-white">Total dépensé</h3>
                <p class="text-sm text-on-surface-variant dark:text-gray-400 mt-1">Commandes payées</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <a href="{{ route('products.index') }}" class="bg-gradient-to-br from-primary to-primary-container text-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-xl mb-2">Continuer mes achats</h3>
                        <p class="text-white/80 text-sm">Découvrez nos produits</p>
                    </div>
                    <span class="material-symbols-outlined text-5xl opacity-50">shopping_cart</span>
                </div>
            </a>

            <a href="{{ route('orders.index') }}" class="bg-gradient-to-br from-secondary to-blue-600 text-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-xl mb-2">Mes commandes</h3>
                        <p class="text-white/80 text-sm">Voir l'historique complet</p>
                    </div>
                    <span class="material-symbols-outlined text-5xl opacity-50">receipt_long</span>
                </div>
            </a>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white dark:bg-[#1a1d2e] rounded-2xl p-8 border border-gray-100 dark:border-gray-800 shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold font-headline dark:text-white">Commandes récentes</h2>
                <a href="{{ route('orders.index') }}" class="text-primary hover:underline font-bold text-sm flex items-center gap-1">
                    Voir tout
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

            @if($recentOrders->count() > 0)
                <div class="space-y-4">
                    @foreach($recentOrders as $order)
                        <div class="border border-gray-100 dark:border-gray-800 rounded-xl p-4 hover:shadow-md transition">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <a href="{{ route('orders.show', $order->order_number) }}" class="font-bold text-primary hover:underline">
                                        {{ $order->order_number }}
                                    </a>
                                    <p class="text-sm text-on-surface-variant dark:text-gray-400">
                                        {{ $order->created_at->format('d/m/Y à H:i') }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-{{ $order->status_color }}/10 text-{{ $order->status_color }}">
                                        {{ $order->status_label }}
                                    </span>
                                    <p class="text-lg font-bold text-primary mt-1">{{ number_format($order->total, 2, ',', ' ') }}€</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-on-surface-variant dark:text-gray-400">
                                <span class="material-symbols-outlined text-sm">inventory_2</span>
                                {{ $order->items->count() }} article{{ $order->items->count() > 1 ? 's' : '' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-6xl text-gray-300 dark:text-gray-700 mb-4">shopping_bag</span>
                    <p class="text-lg text-on-surface-variant dark:text-gray-400 mb-4">Aucune commande pour le moment</p>
                    <a href="{{ route('products.index') }}" class="inline-block bg-primary hover:bg-primary-container text-white font-bold py-3 px-6 rounded-full transition">
                        Découvrir nos produits
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
