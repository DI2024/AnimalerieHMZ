@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                Bonjour, {{ $user->name }} 👋
            </h1>
            <p class="text-gray-600">
                Bienvenue sur votre tableau de bord
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Total Orders -->
            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-600 text-2xl">shopping_bag</span>
                    </div>
                    <span class="text-3xl font-bold text-blue-600">{{ $stats['total_orders'] }}</span>
                </div>
                <h3 class="font-semibold text-gray-900">Commandes totales</h3>
                <p class="text-sm text-gray-500 mt-1">Depuis votre inscription</p>
            </div>

            <!-- Pending Orders -->
            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-orange-500 text-2xl">pending</span>
                    </div>
                    <span class="text-3xl font-bold text-orange-500">{{ $stats['pending_orders'] }}</span>
                </div>
                <h3 class="font-semibold text-gray-900">En attente</h3>
                <p class="text-sm text-gray-500 mt-1">Commandes en cours</p>
            </div>

            <!-- Total Spent -->
            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-green-500 text-2xl">payments</span>
                    </div>
                    <span class="text-3xl font-bold text-green-500">{{ number_format($stats['total_spent'], 0, ',', ' ') }} MAD</span>
                </div>
                <h3 class="font-semibold text-gray-900">Total dépensé</h3>
                <p class="text-sm text-gray-500 mt-1">Commandes payées</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <!-- Mobile Action: Modifier mes informations -->
            <a href="{{ route('profile.edit') }}" class="block md:hidden bg-blue-600 hover:bg-blue-700 text-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-xl mb-2">Modifier mes informations</h3>
                        <p class="text-blue-100 text-sm">Mettre à jour mon profil</p>
                    </div>
                    <span class="material-symbols-outlined text-5xl opacity-50">settings</span>
                </div>
            </a>

            <!-- Desktop Action: Continuer mes achats -->
            <a href="{{ route('products.index') }}" class="hidden md:block bg-blue-600 hover:bg-blue-700 text-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-xl mb-2">Continuer mes achats</h3>
                        <p class="text-blue-100 text-sm">Découvrez nos produits</p>
                    </div>
                    <span class="material-symbols-outlined text-5xl opacity-50">shopping_cart</span>
                </div>
            </a>

            <a href="{{ route('orders.index') }}" class="bg-gray-800 hover:bg-gray-900 text-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-xl mb-2">Mes commandes</h3>
                        <p class="text-gray-300 text-sm">Voir l'historique complet</p>
                    </div>
                    <span class="material-symbols-outlined text-5xl opacity-50">receipt_long</span>
                </div>
            </a>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-xl p-4 md:p-8 border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Commandes récentes</h2>
                <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-700 hover:underline font-semibold text-sm flex items-center gap-1">
                    Voir tout
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

            @if($recentOrders->count() > 0)
                <div class="space-y-4">
                    @foreach($recentOrders as $order)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-sm transition">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-3">
                                <div>
                                    <a href="{{ route('orders.show', $order->order_number) }}" class="font-semibold text-blue-600 hover:text-blue-700 hover:underline text-sm md:text-base break-all">
                                        {{ $order->order_number }}
                                    </a>
                                    <p class="text-xs md:text-sm text-gray-500">
                                        {{ $order->created_at->format('d/m/Y à H:i') }}
                                    </p>
                                </div>
                                <div class="text-left sm:text-right">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-{{ $order->status_color }}/10 text-{{ $order->status_color }}">
                                        {{ $order->status_label }}
                                    </span>
                                    <p class="text-base md:text-lg font-bold text-gray-900 mt-1">{{ number_format($order->total, 2, ',', ' ') }} MAD</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <span class="material-symbols-outlined text-sm">inventory_2</span>
                                {{ $order->items->count() }} article{{ $order->items->count() > 1 ? 's' : '' }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">shopping_bag</span>
                    <p class="text-lg text-gray-600 mb-4">Aucune commande pour le moment</p>
                    <a href="{{ route('products.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                        Découvrir nos produits
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
