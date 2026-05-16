@extends('layouts.app')

@section('content')
@php
    $imageUrl = $product->image && str_starts_with($product->image, 'http') 
        ? $product->image 
        : asset('storage/' . $product->image);
    $discount = $product->discount_percentage ?? 0;
@endphp

<div class="min-h-screen bg-surface dark:bg-[#0f1117] transition-colors duration-300 pb-20">
    <!-- Breadcrumbs -->
    <div class="max-w-[1280px] mx-auto px-6 py-6">
        <nav class="flex text-sm font-medium text-on-surface-variant/60 dark:text-gray-500">
            @foreach($breadcrumbs as $breadcrumb)
                @if($breadcrumb['url'])
                    <a href="{{ $breadcrumb['url'] }}" class="hover:text-primary transition">{{ $breadcrumb['name'] }}</a>
                    <span class="mx-2 text-gray-400">/</span>
                @else
                    <span class="text-on-surface dark:text-white">{{ $breadcrumb['name'] }}</span>
                @endif
            @endforeach
        </nav>
    </div>

    <!-- Main Product Section -->
    <div class="max-w-[1280px] mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Left: Gallery -->
        <div class="lg:col-span-7 space-y-4">
            <div class="relative aspect-[3/2] rounded-[2.5rem] overflow-hidden bg-white dark:bg-[#1a1d2e] shadow-xl group">
                <img id="mainImage" 
                     src="{{ $imageUrl }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-105"
                     onerror="this.src='https://via.placeholder.com/800x600?text=No+Image'">
                
                <!-- Floating Badges -->
                @if($product->is_featured)
                    <div class="absolute top-6 left-6 bg-primary/90 text-white px-4 py-2 rounded-full text-sm font-bold backdrop-blur-md shadow-lg animate-float-slow">
                        HMZ EXCLUSIVE
                    </div>
                @endif

                @if($product->is_new)
                    <div class="absolute top-6 right-6 bg-green-500/90 text-white px-4 py-2 rounded-full text-sm font-bold backdrop-blur-md shadow-lg">
                        NOUVEAU
                    </div>
                @endif

                <!-- Like Button -->
                <button id="likeBtn" class="absolute bottom-6 right-6 w-12 h-12 bg-white/80 dark:bg-black/40 backdrop-blur-md rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition group/like">
                    <span class="material-symbols-outlined text-error transition duration-300" style="font-variation-settings: 'FILL' 0;">favorite</span>
                </button>
            </div>
        </div>

        <!-- Right: Info -->
        <div class="lg:col-span-5 flex flex-col gap-8">
            <div class="space-y-4">
                <h1 class="text-3xl md:text-4xl font-extrabold font-headline leading-tight dark:text-white">
                    {{ $product->name }}
                </h1>
                
                @if($product->short_description)
                    <p class="text-on-surface-variant dark:text-gray-400">
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
                        <span class="text-sm text-on-surface-variant dark:text-gray-400">({{ $product->rating }}/5)</span>
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-6">
                <div class="space-y-1">
                    <span class="text-4xl font-black text-primary dark:text-primary-light">{{ number_format($product->price, 2, ',', ' ') }}€</span>
                    @if($product->old_price && $product->old_price > $product->price)
                        <div class="flex items-center gap-2">
                            <span class="text-lg text-on-surface-variant/50 line-through">{{ number_format($product->old_price, 2, ',', ' ') }}€</span>
                            <span class="bg-error/10 text-error px-2 py-0.5 rounded-md text-xs font-bold">-{{ $discount }}%</span>
                        </div>
                    @endif
                </div>
                <div class="h-12 w-px bg-gray-200 dark:bg-gray-800"></div>
                <div class="text-sm font-medium text-on-surface-variant dark:text-gray-500">
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
                <div class="flex items-center bg-surface-container-low dark:bg-[#13162a] rounded-full p-1 border border-gray-100 dark:border-gray-800">
                    <button class="w-12 h-12 flex items-center justify-center text-xl font-bold hover:bg-white dark:hover:bg-gray-800 rounded-full transition" onclick="updateQty(-1)">-</button>
                    <input type="number" id="qtyInput" value="1" min="1" max="{{ $product->stock }}" class="w-12 text-center bg-transparent border-none font-bold focus:ring-0 dark:text-white">
                    <button class="w-12 h-12 flex items-center justify-center text-xl font-bold hover:bg-white dark:hover:bg-gray-800 rounded-full transition" onclick="updateQty(1)">+</button>
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
            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-100 dark:border-gray-800">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary/5 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">local_shipping</span>
                    </div>
                    <span class="text-xs font-bold leading-tight dark:text-gray-300">Livraison Gratuite</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-secondary/5 flex items-center justify-center text-secondary">
                        <span class="material-symbols-outlined">verified</span>
                    </div>
                    <span class="text-xs font-bold leading-tight dark:text-gray-300">Garantie 2 ans HMZ</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Section -->
    <div class="max-w-[1280px] mx-auto px-6 mt-24">
        <div class="flex gap-10 border-b border-gray-100 dark:border-gray-800 mb-10 overflow-x-auto hide-scrollbar">
            <button class="tab-btn active pb-4 text-lg font-bold border-b-2 border-primary transition relative group" onclick="switchTab('description', this)">
                Description
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-primary rounded-full scale-100 transition"></div>
            </button>
        </div>

        <div id="tabContent" class="min-h-[300px]">
            <div id="description" class="tab-pane animate-in fade-in slide-in-from-bottom-4 duration-500">
                <div class="prose dark:prose-invert max-w-none">
                    @if($product->description)
                        {!! nl2br(e($product->description)) !!}
                    @else
                        <p class="text-on-surface-variant dark:text-gray-400">Aucune description disponible pour ce produit.</p>
                    @endif
                </div>
                
                @if($product->sku)
                    <div class="mt-8 p-6 bg-surface-container-low dark:bg-[#13162a] rounded-2xl border border-gray-100 dark:border-gray-800">
                        <h3 class="text-lg font-bold mb-4 dark:text-white">Informations produit</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-800">
                                <span class="font-bold text-on-surface-variant text-sm">SKU</span>
                                <span class="dark:text-white text-sm">{{ $product->sku }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100 dark:border-gray-800">
                                <span class="font-bold text-on-surface-variant text-sm">Catégorie</span>
                                <span class="dark:text-white text-sm">{{ $product->category->name }}</span>
                            </div>
                            @if($product->subcategory)
                                <div class="flex justify-between py-2">
                                    <span class="font-bold text-on-surface-variant text-sm">Sous-catégorie</span>
                                    <span class="dark:text-white text-sm">{{ $product->subcategory->name }}</span>
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
        <div class="max-w-[1280px] mx-auto px-6 mt-32">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold font-headline dark:text-white">Articles Similaires</h2>
                    <p class="text-on-surface-variant/60 dark:text-gray-500 mt-2">D'autres produits qui pourraient vous plaire</p>
                </div>
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="flex items-center gap-2 font-bold text-primary hover:gap-4 transition-all">
                    Voir tout <span class="material-symbols-outlined">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($relatedProducts as $related)
                    @php
                        $relatedImageUrl = $related->image && str_starts_with($related->image, 'http') 
                            ? $related->image 
                            : asset('storage/' . $related->image);
                    @endphp
                    
                    <div class="group relative bg-white dark:bg-[#1a1d2e] rounded-[2rem] p-4 shadow-md hover:shadow-2xl transition duration-500 hover:-translate-y-2 border border-gray-100 dark:border-gray-800">
                        <a href="{{ route('products.show', $related->slug) }}">
                            <div class="aspect-square rounded-[1.5rem] overflow-hidden mb-4 relative bg-surface dark:bg-[#13162a]">
                                <img src="{{ $relatedImageUrl }}" 
                                     class="w-full h-full object-contain transition duration-700 group-hover:scale-110 p-4"
                                     onerror="this.src='https://via.placeholder.com/300x300?text=No+Image'">
                            </div>
                            <h3 class="font-bold text-base px-2 dark:text-white line-clamp-2">{{ $related->name }}</h3>
                            <p class="text-on-surface-variant/60 text-sm px-2 mb-4 dark:text-gray-500">{{ $related->category->name }}</p>
                            <div class="flex justify-between items-center px-2">
                                <span class="text-xl font-black text-primary">{{ number_format($related->price, 2, ',', ' ') }}€</span>
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
    function updateQty(delta) {
        const input = document.getElementById('qtyInput');
        const max = parseInt(input.max) || 999;
        let val = parseInt(input.value) + delta;
        if (val < 1) val = 1;
        if (val > max) val = max;
        input.value = val;
    }

    function switchTab(id, btn) {
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.add('hidden'));
        document.getElementById(id).classList.remove('hidden');
        
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('active', 'border-primary');
            b.classList.add('text-on-surface-variant', 'dark:text-gray-500', 'border-transparent');
            b.querySelector('div').classList.remove('scale-100');
            b.querySelector('div').classList.add('scale-0');
        });
        
        btn.classList.add('active', 'border-primary');
        btn.classList.remove('text-on-surface-variant', 'dark:text-gray-500', 'border-transparent');
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
