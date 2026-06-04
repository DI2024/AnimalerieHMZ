@extends('layouts.app')

@section('content')
@php
    $imageUrl = $offer->image 
        ? (filter_var($offer->image, FILTER_VALIDATE_URL) ? $offer->image : asset('storage/' . $offer->image))
        : null;
@endphp

<div class="min-h-screen bg-gradient-to-b from-blue-50 via-white to-white transition-colors duration-300 pb-20">
    <!-- Breadcrumbs -->
    <div class="max-w-[1280px] mx-auto px-6 py-6">
        <nav class="flex text-sm font-medium text-on-surface-variant/60">
            @foreach($breadcrumbs as $breadcrumb)
                @if($breadcrumb['url'])
                    <a href="{{ $breadcrumb['url'] }}" class="hover:text-primary transition">{{ $breadcrumb['name'] }}</a>
                    <span class="mx-2 text-gray-400">/</span>
                @else
                    <span class="text-on-surface font-bold">{{ $breadcrumb['name'] }}</span>
                @endif
            @endforeach
        </nav>
    </div>

    <!-- Offer Header Banner -->
    <div class="max-w-[1280px] mx-auto px-6 mb-12">
        <div class="relative rounded-[2rem] overflow-hidden bg-gradient-to-br from-primary/90 to-primary-container p-8 md:p-12 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-8 min-h-[220px]">
            @if($offer->bg_color)
                <!-- Custom background fallback if needed, but the gradient is already extremely premium -->
                <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-color: {{ $offer->bg_color }}"></div>
            @endif
            
            <div class="space-y-4 relative z-10 flex-1">
                @if($offer->badge)
                    <span class="inline-block bg-white/20 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full border border-white/10 uppercase tracking-wider">{{ $offer->badge }}</span>
                @endif
                <h1 class="text-3xl md:text-5xl font-black font-headline tracking-tight leading-tight">
                    {{ $offer->title }}
                </h1>
                @if($offer->subtitle)
                    <p class="text-lg text-white/80 max-w-2xl font-medium">
                        {{ $offer->subtitle }}
                    </p>
                @endif
                <div class="text-xs text-white/60 font-bold uppercase tracking-widest pt-2">
                    {{ $offer->products->count() }} produit{{ $offer->products->count() > 1 ? 's associés' : ' associé' }} à cette offre
                </div>
            </div>

            @if($imageUrl)
                <div class="w-48 h-48 md:w-56 md:h-56 relative z-10 flex-shrink-0 bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 shadow-2xl overflow-hidden flex items-center justify-center">
                    <img src="{{ $imageUrl }}" alt="{{ $offer->title }}" class="w-full h-full object-contain filter drop-shadow-md">
                </div>
            @endif
        </div>
    </div>

    <!-- Products Grid -->
    <div class="max-w-[1280px] mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-extrabold font-headline mb-8 text-primary flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">local_offer</span>
            Découvrir les offres
        </h2>

        @if($offer->products->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($offer->products as $product)
                    @php
                        $prodUrl = route('products.show', $product->slug);
                        $prodImg = $product->image_url;
                        $discount = $product->discount_percentage ?? 0;
                    @endphp
                    <article class="bg-white border border-gray-200 rounded-3xl p-4 flex flex-col h-full transition duration-300 hover:shadow-xl group relative overflow-hidden">
                        <a href="{{ $prodUrl }}" class="block">
                            <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl overflow-hidden aspect-square flex items-center justify-center p-3 mb-4">
                                @if($discount > 0)
                                    <span class="absolute top-3 left-3 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">-{{ $discount }}%</span>
                                @endif
                                @if($product->is_new)
                                    <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">Nouveau</span>
                                @endif
                                <img src="{{ $prodImg }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-contain group-hover:scale-105 transition duration-300" 
                                     loading="lazy"
                                     onerror="this.src='{{ asset('images/placeholder.svg') }}'">
                            </div>
                            <div class="flex-grow flex flex-col">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-primary mb-1">
                                    {{ $product->category->name ?? 'Produit' }}
                                </span>
                                <h3 class="text-xs lg:text-sm font-bold mb-2 leading-tight text-gray-900 line-clamp-2 min-h-[36px] lg:min-h-[40px]">
                                    {{ $product->name }}
                                </h3>
                                @if($product->rating)
                                    <div class="flex gap-0.5 mb-3 text-yellow-400 text-xs">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' {{ $i <= $product->rating ? 1 : 0 }};">star</span>
                                        @endfor
                                    </div>
                                @endif
                            </div>
                        </a>
                        <div class="flex justify-between items-center mt-auto pt-3 border-t border-gray-100">
                            <div class="flex flex-col">
                                <span class="font-headline text-base lg:text-lg font-bold text-primary">{{ number_format($product->price, 2, ',', ' ') }} MAD</span>
                                @if($product->old_price && $product->old_price > $product->price)
                                    <span class="text-xs text-gray-400 line-through">{{ number_format($product->old_price, 2, ',', ' ') }} MAD</span>
                                @endif
                            </div>
                            <button class="bg-primary text-white p-2.5 rounded-xl flex items-center justify-center transition hover:bg-primary-container hover:scale-110 shadow-md product-add-btn" 
                                    data-product-id="{{ $product->id }}" 
                                    aria-label="Ajouter au panier">
                                <span class="material-symbols-outlined text-sm lg:text-base">shopping_cart</span>
                            </button>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-2xl border border-gray-200">
                <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">search_off</span>
                <p class="text-lg text-on-surface-variant mb-2">Aucun produit associé à cette offre pour le moment.</p>
                <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-container transition font-bold">Retour aux produits</a>
            </div>
        @endif
    </div>
</div>
@endsection
