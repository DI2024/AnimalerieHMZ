@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-surface dark:bg-[#0f1117] py-8">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold font-headline text-on-surface dark:text-white mb-2">
                Nos Produits
            </h1>
            <p class="text-on-surface-variant dark:text-gray-400">
                {{ $products->total() }} produit{{ $products->total() > 1 ? 's' : '' }} disponible{{ $products->total() > 1 ? 's' : '' }}
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Sidebar Filters -->
            <aside class="lg:col-span-1">
                <div class="bg-white dark:bg-[#1a1d2e] rounded-2xl p-6 border border-gray-100 dark:border-gray-800 sticky top-6">
                    <h3 class="font-bold text-lg mb-4 dark:text-white">Filtres</h3>
                    
                    <form method="GET" action="{{ route('products.index') }}" class="space-y-6">
                        
                        <!-- Categories -->
                        <div>
                            <h4 class="font-bold text-sm mb-3 dark:text-white">Catégories</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="category" value="" {{ !request('category') ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="ml-2 text-sm dark:text-gray-300">Toutes</span>
                                </label>
                                @foreach($categories as $category)
                                <label class="flex items-center">
                                    <input type="radio" name="category" value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="ml-2 text-sm dark:text-gray-300">{{ $category->name }} ({{ $category->products_count }})</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range -->
                        <div>
                            <h4 class="font-bold text-sm mb-3 dark:text-white">Prix</h4>
                            <div class="space-y-2">
                                <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-surface dark:bg-[#13162a] text-sm dark:text-white">
                                <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-surface dark:bg-[#13162a] text-sm dark:text-white">
                            </div>
                        </div>

                        <!-- Flags -->
                        <div>
                            <h4 class="font-bold text-sm mb-3 dark:text-white">Options</h4>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_new" value="1" {{ request('is_new') ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="ml-2 text-sm dark:text-gray-300">Nouveautés</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_bestseller" value="1" {{ request('is_bestseller') ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="ml-2 text-sm dark:text-gray-300">Best Sellers</span>
                                </label>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="space-y-2">
                            <button type="submit" class="w-full bg-primary hover:bg-primary-container text-white font-bold py-3 px-4 rounded-xl transition">
                                Appliquer
                            </button>
                            <a href="{{ route('products.index') }}" class="block w-full text-center bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-on-surface dark:text-white font-bold py-3 px-4 rounded-xl transition">
                                Réinitialiser
                            </a>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                
                <!-- Sorting -->
                <div class="flex justify-between items-center mb-6">
                    <p class="text-sm text-on-surface-variant dark:text-gray-400">
                        Affichage de {{ $products->firstItem() ?? 0 }} à {{ $products->lastItem() ?? 0 }} sur {{ $products->total() }} produits
                    </p>
                    <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-2">
                        @foreach(request()->except('sort') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <select name="sort" onchange="this.form.submit()" class="px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-[#1a1d2e] text-sm dark:text-white">
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Plus récents</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nom A-Z</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Mieux notés</option>
                        </select>
                    </form>
                </div>

                <!-- Products -->
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        @foreach($products as $product)
                            @php
                                $imageUrl = $product->image && str_starts_with($product->image, 'http') 
                                    ? $product->image 
                                    : asset('storage/' . $product->image);
                                $discount = $product->discount_percentage ?? 0;
                            @endphp
                            
                            <article class="bg-white dark:bg-[#1a1d2e] border border-gray-200 dark:border-gray-800 rounded-2xl p-4 flex flex-col h-full transition duration-300 hover:shadow-xl hover:-translate-y-1">
                                <a href="{{ route('products.show', $product->slug) }}" class="block">
                                    <div class="relative bg-surface dark:bg-[#13162a] rounded-xl overflow-hidden aspect-square flex items-center justify-center p-4 mb-4">
                                        @if($discount > 0)
                                            <span class="absolute top-2 left-2 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full">-{{ $discount }}%</span>
                                        @endif
                                        @if($product->is_new)
                                            <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">Nouveau</span>
                                        @endif
                                        <img src="{{ $imageUrl }}" 
                                             alt="{{ $product->name }}" 
                                             class="w-full h-full object-contain" 
                                             loading="lazy"
                                             onerror="this.src='https://via.placeholder.com/300x300?text=No+Image'">
                                    </div>
                                    <div class="flex-grow flex flex-col">
                                        <span class="text-xs font-bold uppercase tracking-wider text-blue-400 mb-1">
                                            {{ $product->category->name ?? 'Produit' }}
                                        </span>
                                        <h3 class="text-sm font-bold mb-2 leading-tight dark:text-white line-clamp-2">
                                            {{ $product->name }}
                                        </h3>
                                        @if($product->rating)
                                            <div class="flex gap-0.5 mb-2 text-yellow-400 text-sm">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' {{ $i <= $product->rating ? 1 : 0 }};">star</span>
                                                @endfor
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                <div class="flex justify-between items-center mt-auto pt-2">
                                    <div>
                                        <span class="font-headline text-lg font-bold text-primary">{{ number_format($product->price, 2, ',', ' ') }}€</span>
                                        @if($product->old_price && $product->old_price > $product->price)
                                            <span class="text-xs text-gray-400 line-through ml-1">{{ number_format($product->old_price, 2, ',', ' ') }}€</span>
                                        @endif
                                    </div>
                                    <button class="bg-primary text-white w-8 h-8 rounded-md flex items-center justify-center transition hover:bg-primary-container product-add-btn" 
                                            data-product-id="{{ $product->id }}" 
                                            aria-label="Ajouter au panier">
                                        <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'wght' 200;">shopping_cart</span>
                                    </button>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <span class="material-symbols-outlined text-6xl text-gray-300 dark:text-gray-700 mb-4">search_off</span>
                        <p class="text-lg text-on-surface-variant dark:text-gray-400">Aucun produit trouvé</p>
                        <a href="{{ route('products.index') }}" class="inline-block mt-4 text-primary hover:underline">Réinitialiser les filtres</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
