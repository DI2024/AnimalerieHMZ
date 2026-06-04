@extends('layouts.app')

@section('content')
@php
    $imageUrl = $pack->image 
        ? (filter_var($pack->image, FILTER_VALIDATE_URL) ? $pack->image : asset('storage/' . $pack->image))
        : asset('images/placeholder.svg');
    $discount = $pack->total_original_price > $pack->pack_price 
        ? round((($pack->total_original_price - $pack->pack_price) / $pack->total_original_price) * 100) 
        : 0;
    
    // Minimum stock of components defines the pack stock limit
    $packStock = $pack->products->isEmpty() ? 0 : $pack->products->min('stock');
@endphp

<div class="min-h-screen bg-gradient-to-b from-purple-50 via-white to-white transition-colors duration-300 pb-20">
    <!-- Breadcrumbs -->
    <div class="max-w-[1280px] mx-auto px-6 py-6">
        <nav class="flex text-sm font-medium text-on-surface-variant/60">
            @foreach($breadcrumbs as $breadcrumb)
                @if($breadcrumb['url'])
                    <a href="{{ $breadcrumb['url'] }}" class="hover:text-purple-600 transition">{{ $breadcrumb['name'] }}</a>
                    <span class="mx-2 text-gray-400">/</span>
                @else
                    <span class="text-on-surface font-bold">{{ $breadcrumb['name'] }}</span>
                @endif
            @endforeach
        </nav>
    </div>

    <!-- Main Section -->
    <div class="max-w-[1280px] mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Left: Images Gallery of Components -->
        <div class="lg:col-span-6 space-y-6">
            <!-- Thumbnails of component products above main image -->
            @if($pack->products->count() > 0)
                <div class="flex flex-wrap gap-3 justify-center">
                    <!-- Pack Main Image Thumbnail -->
                    <div class="w-16 h-16 rounded-xl border-2 border-purple-600 overflow-hidden bg-white cursor-pointer hover:border-purple-600 transition p-1 thumbnail-item active-thumbnail" 
                         onclick="changeMainImage('{{ $imageUrl }}', this)">
                        <img src="{{ $imageUrl }}" class="w-full h-full object-contain" alt="{{ $pack->title }}">
                    </div>
                    <!-- Components Thumbnails -->
                    @foreach($pack->products as $product)
                        @php
                            $prodImgUrl = $product->image_url;
                        @endphp
                        <div class="w-16 h-16 rounded-xl border-2 border-gray-200 overflow-hidden bg-white cursor-pointer hover:border-purple-600 transition p-1 thumbnail-item" 
                             onclick="changeMainImage('{{ $prodImgUrl }}', this)">
                            <img src="{{ $prodImgUrl }}" class="w-full h-full object-contain" alt="{{ $product->name }}">
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Main Image -->
            <div class="relative aspect-square rounded-[2.5rem] overflow-hidden bg-white shadow-xl group border-2 border-purple-100 max-w-[500px] mx-auto">
                <span class="absolute top-6 left-6 bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg z-10">PACK SPÉCIAL</span>
                <img id="mainImage" 
                     src="{{ $imageUrl }}" 
                     alt="{{ $pack->title }}" 
                     class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-105 p-8"
                     onerror="this.src='{{ asset('images/placeholder.svg') }}'">
            </div>
        </div>

        <!-- Right: Info -->
        <div class="lg:col-span-6 flex flex-col gap-6">
            <div class="space-y-4">
                @if($pack->badge)
                    <span class="inline-block bg-purple-100 text-purple-800 text-xs font-bold px-3 py-1 rounded-full">{{ $pack->badge }}</span>
                @endif
                <h1 class="text-3xl md:text-4xl font-extrabold font-headline leading-tight text-gray-900">
                    {{ $pack->title }}
                </h1>
                
                @if($pack->subtitle)
                    <p class="text-lg text-gray-600 font-medium leading-relaxed">
                        {{ $pack->subtitle }}
                    </p>
                @endif
            </div>

            <!-- Pricing Box -->
            <div class="bg-purple-50/50 rounded-3xl p-6 border border-purple-100 flex items-center justify-between">
                <div>
                    <span class="text-sm font-bold text-purple-600 uppercase tracking-wider block mb-1">Prix Spécial Pack</span>
                    <span class="text-3xl md:text-4xl font-black text-purple-700 whitespace-nowrap">{{ number_format($pack->pack_price, 2, ',', ' ') }} MAD</span>
                    @if($pack->total_original_price > $pack->pack_price)
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-sm text-gray-400 line-through whitespace-nowrap">{{ number_format($pack->total_original_price, 2, ',', ' ') }} MAD</span>
                            <span class="bg-purple-100 text-purple-700 px-2 py-0.5 rounded-md text-xs font-bold">Économisez -{{ $discount }}%</span>
                        </div>
                    @endif
                </div>
                <div class="h-16 w-px bg-purple-200"></div>
                <div class="text-sm font-medium text-gray-600">
                    @if($packStock > 0)
                        <div class="flex items-center gap-2 text-green-600 font-bold mb-1">
                            <span class="material-symbols-outlined text-lg">check_circle</span>
                            En stock ({{ $packStock }} packs)
                        </div>
                        <p class="text-xs">Chaque produit est prêt à l'expédition</p>
                    @else
                        <div class="flex items-center gap-2 text-red-600 font-bold">
                            <span class="material-symbols-outlined text-lg">cancel</span>
                            Victime de son succès
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Button -->
            <div class="pt-2">
                <button class="w-full bg-purple-600 hover:bg-purple-700 text-white font-extrabold py-5 rounded-full transition shadow-xl hover:shadow-2xl hover:-translate-y-1 active:translate-y-0 text-lg flex items-center justify-center gap-3 pack-add-btn disabled:opacity-50 disabled:cursor-not-allowed" 
                        data-pack-id="{{ $pack->id }}"
                        {{ $packStock <= 0 ? 'disabled' : '' }}>
                    <span class="material-symbols-outlined text-2xl">shopping_cart</span>
                    <span>{{ $packStock > 0 ? 'Ajouter le pack au panier' : 'Rupture de stock' }}</span>
                </button>
            </div>

            <!-- Perks -->
            <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-150">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600">
                        <span class="material-symbols-outlined">local_shipping</span>
                    </div>
                    <span class="text-xs font-bold leading-tight">Livraison Gratuite</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center text-purple-600">
                        <span class="material-symbols-outlined">verified</span>
                    </div>
                    <span class="text-xs font-bold leading-tight">Garantie HMZ</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Included List -->
    <div class="max-w-[1280px] mx-auto px-6 mt-20">
        <h2 class="text-2xl md:text-3xl font-extrabold font-headline mb-8 text-purple-950 flex items-center gap-2">
            <span class="material-symbols-outlined text-purple-600">inventory_2</span>
            Produits inclus dans ce pack
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($pack->products as $product)
                @php
                    $prodUrl = route('products.show', $product->slug);
                    $prodImg = $product->image_url;
                @endphp
                <div class="bg-white border border-gray-200 rounded-3xl p-5 flex flex-col transition hover:shadow-lg relative overflow-hidden group">
                    <a href="{{ $prodUrl }}" class="flex gap-4 items-center">
                        <div class="w-24 h-24 bg-gray-50 rounded-2xl p-2 flex-shrink-0 flex items-center justify-center overflow-hidden border border-gray-100">
                            <img src="{{ $prodImg }}" alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition duration-300">
                        </div>
                        <div class="min-w-0 flex-1">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-purple-600 mb-1 block">{{ $product->category->name ?? 'Produit' }}</span>
                            <h3 class="font-bold text-sm text-gray-900 leading-snug line-clamp-2 hover:text-purple-600 transition mb-1">{{ $product->name }}</h3>
                            <div class="flex items-center gap-1.5 mt-2">
                                <span class="font-bold text-primary text-sm">{{ number_format($product->price, 2, ',', ' ') }} MAD</span>
                                @if($product->old_price && $product->old_price > $product->price)
                                    <span class="text-[10px] text-gray-400 line-through">{{ number_format($product->old_price, 2, ',', ' ') }} MAD</span>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .thumbnail-item {
        transition: all 0.2s ease;
    }
    .thumbnail-item.active-thumbnail {
        border-color: #7c3aed; /* Purple-600 */
        transform: scale(1.05);
        box-shadow: 0 4px 6px -1px rgba(124, 58, 237, 0.2);
    }
</style>

<script>
    function changeMainImage(url, element) {
        const mainImage = document.getElementById('mainImage');
        if (mainImage) {
            mainImage.src = url;
        }
        
        // Remove active classes
        document.querySelectorAll('.thumbnail-item').forEach(el => {
            el.classList.remove('border-purple-600', 'active-thumbnail');
            el.classList.add('border-gray-200');
        });
        
        // Add active classes
        element.classList.add('border-purple-600', 'active-thumbnail');
        element.classList.remove('border-gray-200');
    }
</script>
@endsection
