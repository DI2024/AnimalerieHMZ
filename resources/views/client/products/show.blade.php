@extends('layouts.app')

@section('content')
@php
    $imageUrl = $product->image && str_starts_with($product->image, 'http') 
        ? $product->image 
        : asset($product->image);
    $discount = $product->discount_percentage ?? 0;
@endphp

<div class="min-h-screen bg-gradient-to-b from-surface-container-low to-white transition-colors duration-300 pb-20">
    <!-- Breadcrumbs -->
    <div class="max-w-[1280px] mx-auto px-6 py-6">
        <nav class="flex text-sm font-medium text-on-surface-variant/60">
            @foreach($breadcrumbs as $breadcrumb)
                @if($breadcrumb['url'])
                    <a href="{{ $breadcrumb['url'] }}" class="hover:text-primary transition">{{ $breadcrumb['name'] }}</a>
                    <span class="mx-2 text-gray-400">/</span>
                @else
                    <span class="text-on-surface">{{ $breadcrumb['name'] }}</span>
                @endif
            @endforeach
        </nav>
    </div>

    <!-- Main Product Section -->
    <div class="max-w-[1280px] mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Left: Gallery -->
        <div class="lg:col-span-6 space-y-4">
            <div class="relative aspect-square rounded-[2.5rem] overflow-hidden bg-white shadow-xl group max-w-[500px] mx-auto">
                <img id="mainImage" 
                     src="{{ $imageUrl }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-105 p-8"
                     onerror="this.src='https://via.placeholder.com/800x800?text=No+Image'">
                
                <!-- Wishlist Button - Top Right -->
                <button id="likeBtn" class="absolute top-6 right-6 w-12 h-12 bg-white/80 backdrop-blur-md rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition group/like">
                    <span class="material-symbols-outlined text-error transition duration-300" style="font-variation-settings: 'FILL' 0;">favorite</span>
                </button>
            </div>
        </div>

        <!-- Right: Info -->
        <div class="lg:col-span-6 flex flex-col gap-8">
            <div class="space-y-4">
                <h1 class="text-3xl md:text-4xl font-extrabold font-headline leading-tight text-gray-900">
                    {{ $product->name }}
                </h1>
                
                @if($product->short_description)
                    <p class="text-on-surface-variant">
                        {{ $product->short_description }}
                    </p>
                @endif

                @if($product->rating)
                    <div class="flex items-center gap-2">
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' {{ $i <= $product->rating ? 1 : 0 }};">star</span>
                            @endfor
                        </div>
                        <span class="text-sm text-on-surface-variant">({{ $product->rating }}/5)</span>
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-6">
                <div class="space-y-1">
                    <span class="text-4xl font-black text-primary">{{ number_format($product->price, 2, ',', ' ') }} MAD</span>
                    @if($product->old_price && $product->old_price > $product->price)
                        <div class="flex items-center gap-2">
                            <span class="text-lg text-on-surface-variant/50 line-through">{{ number_format($product->old_price, 2, ',', ' ') }} MAD</span>
                            <span class="bg-error/10 text-error px-2 py-0.5 rounded-md text-xs font-bold">-{{ $discount }}%</span>
                        </div>
                    @endif
                </div>
                <div class="h-12 w-px bg-gray-200"></div>
                <div class="text-sm font-medium text-on-surface-variant">
                    @if($product->stock > 0)
                        <div class="flex items-center gap-2 text-green-600">
                            <span class="material-symbols-outlined text-lg">check_circle</span>
                            En stock ({{ $product->stock }})
                        </div>
                        <p>Livraison estimée : 2-3 jours</p>
                    @else
                        <div class="flex items-center gap-2 text-red-600">
                            <span class="material-symbols-outlined text-lg">cancel</span>
                            Rupture de stock
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <div class="flex items-center bg-surface-container-low rounded-full p-1 border border-gray-200">
                    <button class="w-12 h-12 flex items-center justify-center text-xl font-bold hover:bg-white rounded-full transition" onclick="updateQty(-1)">-</button>
                    <span id="qtyDisplay" class="w-12 text-center font-bold text-lg">1</span>
                    <button class="w-12 h-12 flex items-center justify-center text-xl font-bold hover:bg-white rounded-full transition" onclick="updateQty(1)">+</button>
                </div>
                <button id="addToCartBtn" 
                        data-product-id="{{ $product->id }}"
                        {{ $product->stock <= 0 ? 'disabled' : '' }}
                        class="flex-1 bg-primary hover:bg-primary-container text-white font-bold py-4 px-8 rounded-full transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1 active:translate-y-0 flex items-center justify-center gap-3 group disabled:opacity-50 disabled:cursor-not-allowed">
                    <span class="material-symbols-outlined group-hover:animate-bounce">shopping_cart</span>
                    {{ $product->stock > 0 ? 'Ajouter au panier' : 'Rupture de stock' }}
                </button>
            </div>

            <!-- Perks -->
            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary/5 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">local_shipping</span>
                    </div>
                    <span class="text-xs font-bold leading-tight">Livraison Gratuite</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-secondary/5 flex items-center justify-center text-secondary">
                        <span class="material-symbols-outlined">verified</span>
                    </div>
                    <span class="text-xs font-bold leading-tight">Garantie 2 ans HMZ</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Section -->
    <div class="max-w-[1280px] mx-auto px-6 mt-24">
        <div class="flex gap-10 border-b border-gray-200 mb-10 overflow-x-auto hide-scrollbar">
            <button class="tab-btn active pb-4 text-lg font-bold border-b-2 border-primary transition relative group" onclick="switchTab('description', this)">
                Description
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-primary rounded-full scale-100 transition"></div>
            </button>
        </div>

        <div id="tabContent" class="min-h-[300px]">
            <div id="description" class="tab-pane animate-in fade-in slide-in-from-bottom-4 duration-500">
                <div class="prose max-w-none">
                    @if($product->description)
                        {!! nl2br(e($product->description)) !!}
                    @else
                        <p class="text-on-surface-variant">Aucune description disponible pour ce produit.</p>
                    @endif
                </div>
                
                @if($product->sku)
                    <div class="mt-8 p-6 bg-surface-container-low rounded-2xl border border-gray-200">
                        <h3 class="text-lg font-bold mb-4">Informations produit</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="font-bold text-on-surface-variant text-sm">SKU</span>
                                <span class="text-sm">{{ $product->sku }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="font-bold text-on-surface-variant text-sm">Catégorie</span>
                                <span class="text-sm">{{ $product->category->name }}</span>
                            </div>
                            @if($product->subcategory)
                                <div class="flex justify-between py-2">
                                    <span class="font-bold text-on-surface-variant text-sm">Sous-catégorie</span>
                                    <span class="text-sm">{{ $product->subcategory->name }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="max-w-[1280px] mx-auto px-6 mt-16">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold font-headline">Articles Similaires</h2>
                    <p class="text-on-surface-variant/60 mt-2">D'autres produits qui pourraient vous plaire</p>
                </div>
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="flex items-center gap-2 font-bold text-primary hover:gap-4 transition-all">
                    Voir tout <span class="material-symbols-outlined">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($relatedProducts->take(4) as $related)
                    @php
                        $relatedImageUrl = $related->image && str_starts_with($related->image, 'http') 
                            ? $related->image 
                            : asset($related->image);
                    @endphp
                    
                    <div class="group relative bg-white rounded-[2rem] p-4 shadow-md hover:shadow-2xl transition duration-500 border border-gray-200">
                        <a href="{{ route('products.show', $related->slug) }}">
                            <div class="aspect-square rounded-[1.5rem] overflow-hidden mb-4 relative bg-gradient-to-br from-gray-50 to-gray-100">
                                <img src="{{ $relatedImageUrl }}" 
                                     class="w-full h-full object-contain p-4"
                                     onerror="this.src='https://via.placeholder.com/300x300?text=No+Image'">
                            </div>
                            <h3 class="font-bold text-base px-2 line-clamp-2">{{ $related->name }}</h3>
                            <p class="text-on-surface-variant/60 text-sm px-2 mb-4">{{ $related->category->name }}</p>
                            <div class="flex justify-between items-center px-2">
                                <span class="text-xl font-black text-primary">{{ number_format($related->price, 2, ',', ' ') }} MAD</span>
                                <button class="w-10 h-10 rounded-full bg-primary/5 text-primary hover:bg-primary hover:text-white transition-colors flex items-center justify-center product-add-btn" data-product-id="{{ $related->id }}">
                                    <span class="material-symbols-outlined">add_shopping_cart</span>
                                </button>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<style>
    .tab-pane.hidden { display: none; }
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-in { animation: slideIn 0.5s ease forwards; }
</style>

<script>
    let currentQty = 1;
    const maxStock = {{ $product->stock }};

    function updateQty(delta) {
        currentQty += delta;
        if (currentQty < 1) currentQty = 1;
        if (currentQty > maxStock) currentQty = maxStock;
        document.getElementById('qtyDisplay').textContent = currentQty;
    }

    function switchTab(id, btn) {
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.add('hidden'));
        document.getElementById(id).classList.remove('hidden');
        
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('active', 'border-primary');
            b.classList.add('text-on-surface-variant', 'border-transparent');
            b.querySelector('div').classList.remove('scale-100');
            b.querySelector('div').classList.add('scale-0');
        });
        
        btn.classList.add('active', 'border-primary');
        btn.classList.remove('text-on-surface-variant', 'border-transparent');
        btn.querySelector('div').classList.remove('scale-0');
        btn.querySelector('div').classList.add('scale-100');
    }

    document.getElementById('likeBtn').addEventListener('click', function() {
        const icon = this.querySelector('.material-symbols-outlined');
        const isFilled = icon.style.fontVariationSettings.includes("'FILL' 1");
        icon.style.fontVariationSettings = isFilled ? "'FILL' 0" : "'FILL' 1";
        if (!isFilled) {
            icon.classList.add('scale-150', 'text-error');
            setTimeout(() => icon.classList.remove('scale-150'), 300);
        }
    });
</script>
@endsection
