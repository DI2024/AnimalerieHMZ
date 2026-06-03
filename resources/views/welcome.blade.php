@extends('layouts.public')

@section('title', 'Accueil - Animalerie HMZ')

@section('content')
    <!-- Hero Section avec Grid - Largeur limitée et centrée -->
    <section class="bg-white py-8">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-rows-[92px_1fr] gap-4">
                <!-- Bande du haut - Marques de produits (Desktop uniquement) -->
                <div class="hidden md:block relative overflow-hidden rounded-2xl">
                    <div class="flex items-center">
                        <img src="{{ asset('images/img brand.png') }}" alt="Marques de produits" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Grid 2 colonnes en bas - 65% gauche / 35% droite (Desktop) -->
                <!-- Mobile: Scroll horizontal pour les slides -->
                <div class="grid grid-cols-1 md:grid-cols-[65%_35%] gap-4">
                    <!-- Colonne gauche - Hero Slides -->
                    <div class="hero-slides-container">
                        <div class="hero-slides-scroll">
                            @forelse($heroSlides as $index => $slide)
                                <div class="hero-slide relative rounded-2xl h-[460px] overflow-hidden {{ $index > 0 ? 'hidden md:block' : '' }}">
                                    <!-- Image de fond -->
                                    @php
                                        $slideImageUrl = filter_var($slide->image, FILTER_VALIDATE_URL) 
                                            ? $slide->image 
                                            : asset($slide->image);
                                    @endphp
                                    <img src="{{ $slideImageUrl }}" alt="{{ $slide->title }}" class="w-full h-full object-cover">
                                    
                                    <!-- Bouton positionné en bas à droite -->
                                    @if($slide->button_text)
                                        <div class="absolute bottom-6 right-6">
                                            <a href="{{ $slide->button_link ?: route('products.index') }}" class="bg-[#003e87] hover:bg-[#0855b1] text-white font-bold py-3 px-6 md:py-4 md:px-8 rounded-full transition shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 text-sm flex items-center justify-center gap-2 w-fit">
                                                {{ $slide->button_text }}
                                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="hero-slide relative rounded-2xl h-[460px] overflow-hidden">
                                    <img src="{{ asset('images/sec her.png') }}" alt="Hero" class="w-full h-full object-cover">
                                    <div class="absolute bottom-6 right-6">
                                        <a href="{{ route('products.index') }}" class="bg-[#003e87] hover:bg-[#0855b1] text-white font-bold py-3 px-6 md:py-4 md:px-8 rounded-full transition shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 text-sm flex items-center justify-center gap-2 w-fit">
                                            Découvrir la boutique
                                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <!-- Indicateurs pour mobile -->
                        <div class="hero-indicators"></div>
                    </div>

                    <!-- Colonne droite - 2 images d'offres empilées (Desktop uniquement) -->
                    <div class="hidden md:grid grid-rows-2 gap-4">
                        @php
                            $rightSlides = $heroSlides->slice(1, 2); // Get slides 2 and 3
                        @endphp
                        @if($rightSlides->count() >= 2)
                            @foreach($rightSlides as $slide)
                                <a href="{{ $slide->button_link ?: '#' }}" class="bg-yellow-100 overflow-hidden relative group rounded-2xl h-[222px] cursor-pointer">
                                    @php
                                        $slideImageUrl = filter_var($slide->image, FILTER_VALIDATE_URL) 
                                            ? $slide->image 
                                            : asset($slide->image);
                                    @endphp
                                    <img src="{{ $slideImageUrl }}" alt="{{ $slide->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                    @if($slide->title || $slide->subtitle)
                                        <div class="absolute bottom-6 left-6 text-white">
                                            @if($slide->subtitle)
                                                <span class="bg-[#003e87] px-4 py-2 rounded-full text-sm font-bold mb-2 inline-block">{{ $slide->subtitle }}</span>
                                            @endif
                                            @if($slide->title)
                                                <h3 class="font-headline text-2xl font-bold">{{ $slide->title }}</h3>
                                            @endif
                                        </div>
                                    @endif
                                </a>
                            @endforeach
                        @else
                            <!-- Fallback: Default images if not enough slides -->
                            <a href="{{ route('products.index', ['category' => 'chiens']) }}" class="bg-yellow-100 overflow-hidden relative group rounded-2xl h-[222px] cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=800&q=80" alt="Offre Chien" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <div class="absolute bottom-6 left-6 text-white">
                                    <span class="bg-[#003e87] px-4 py-2 rounded-full text-sm font-bold mb-2 inline-block">-25%</span>
                                    <h3 class="font-headline text-2xl font-bold">Gamme Chien</h3>
                                </div>
                            </a>
                            <a href="{{ route('products.index', ['category' => 'chats']) }}" class="bg-blue-100 overflow-hidden relative group rounded-2xl h-[222px] cursor-pointer">
                                <img src="https://images.unsplash.com/photo-1574158622682-e40e69881006?w=800&q=80" alt="Offre Chat" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                <div class="absolute bottom-6 left-6 text-white">
                                    <span class="bg-tertiary px-4 py-2 rounded-full text-sm font-bold mb-2 inline-block">-15%</span>
                                    <h3 class="font-headline text-2xl font-bold">Accessoires Chat</h3>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Offers Section -->
    <section class="py-12 md:py-20 bg-gradient-to-b from-surface-container-low to-white" id="offres">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="font-headline text-[clamp(1.75rem,4vw,2.5rem)] font-bold text-primary mb-3">Offres Exceptionnelles</h2>
                <p class="text-on-surface-variant text-lg">Profitez de nos promotions exclusives</p>
            </div>
            <div class="offers-mobile-scroll grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($offers as $offer)
                    @php
                        $offerImageUrl = $offer->image 
                            ? (filter_var($offer->image, FILTER_VALIDATE_URL) ? $offer->image : asset('storage/' . $offer->image)) 
                            : asset('images/placeholder.svg');
                            
                        $offerLink = $offer->link ?: route('products.index');
                    @endphp
                    
                    @if($offer->type === 'pack')
                        <!-- Pack Offer: Fond blanc, bordure violette (ou couleur personnalisée) -->
                        <a href="{{ $offerLink }}" 
                           class="relative flex items-center justify-between p-8 rounded-3xl overflow-hidden min-h-[200px] border-2 border-purple-500/20 group transition-all duration-500 md:hover:scale-105 md:hover:shadow-2xl md:hover:border-purple-600 cursor-pointer {{ $offer->bg_color ? 'text-white' : 'bg-white text-purple-700' }}"
                           style="{{ $offer->bg_color ? 'background-color: ' . $offer->bg_color . ';' : '' }}">
                            <div class="flex-1 pr-4 z-10">
                                <h3 class="font-headline text-lg font-bold leading-tight mb-2 {{ $offer->bg_color ? 'text-white' : 'text-purple-950' }}">{{ $offer->title }}</h3>

                                <div class="mt-2 md:mt-4 flex flex-col items-start gap-1">
                                    <span class="text-base md:text-2xl font-bold {{ $offer->bg_color ? 'text-white' : 'text-purple-600' }}">{{ number_format($offer->pack_price, 2, ',', ' ') }} MAD</span>
                                    @if($offer->total_original_price > 0 && $offer->total_original_price > $offer->pack_price)
                                        <span class="text-xs md:text-sm line-through {{ $offer->bg_color ? 'text-white/70' : 'text-gray-400' }}">{{ number_format($offer->total_original_price, 2, ',', ' ') }} MAD</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-shrink-0 w-24 h-24 z-10">
                                <img src="{{ $offerImageUrl }}" alt="{{ $offer->title }}" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110 drop-shadow-xl" onerror="this.src='{{ asset('images/placeholder.svg') }}'">
                            </div>
                        </a>
                    @elseif($offer->type === 'percentage')
                        <!-- Percentage Offer: bg-gradient-to-br from-tertiary to-blue-600 text-white (ou couleur personnalisée) -->
                        <a href="{{ $offerLink }}" 
                           class="relative flex items-center justify-between p-8 rounded-3xl overflow-hidden min-h-[200px] text-white group transition-all duration-500 md:hover:scale-105 md:hover:shadow-2xl cursor-pointer {{ $offer->bg_color ? '' : 'bg-gradient-to-br from-tertiary to-blue-600' }}"
                           style="{{ $offer->bg_color ? 'background-color: ' . $offer->bg_color . ';' : '' }}">
                            <div class="flex-1 pr-4 z-10">
                                @if($offer->badge)
                                    <span class="hidden md:inline-block bg-white/30 backdrop-blur-sm px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider mb-4 shadow-lg">
                                        {{ $offer->badge }}
                                    </span>
                                @endif
                                <h3 class="font-headline text-lg font-bold leading-tight mb-2">{{ $offer->title }}</h3>
                                @if($offer->subtitle)
                                    <p class="text-white/90 text-sm font-medium">{{ $offer->subtitle }}</p>
                                @endif
                            </div>
                            <div class="flex-shrink-0 w-24 h-24 z-10">
                                <img src="{{ $offerImageUrl }}" alt="{{ $offer->title }}" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110 drop-shadow-2xl" onerror="this.src='{{ asset('images/placeholder.svg') }}'">
                            </div>
                        </a>
                    @else
                        <!-- Standard Offer: bg-gradient-to-br from-primary-container to-primary text-white (ou couleur personnalisée) -->
                        <a href="{{ $offerLink }}" 
                           class="relative flex items-center justify-between p-8 rounded-3xl overflow-hidden min-h-[200px] text-white group transition-all duration-500 md:hover:scale-105 md:hover:shadow-2xl cursor-pointer {{ $offer->bg_color ? '' : 'bg-gradient-to-br from-primary-container to-primary' }}"
                           style="{{ $offer->bg_color ? 'background-color: ' . $offer->bg_color . ';' : '' }}">
                            <div class="flex-1 pr-4 z-10">
                                @if($offer->badge)
                                    <span class="hidden md:inline-block bg-white/30 backdrop-blur-sm px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider mb-4 shadow-lg">
                                        {{ $offer->badge }}
                                    </span>
                                @endif
                                <h3 class="font-headline text-lg font-bold leading-tight mb-2">{{ $offer->title }}</h3>
                                @if($offer->subtitle)
                                    <p class="text-white/90 text-sm font-medium">{{ $offer->subtitle }}</p>
                                @endif
                            </div>
                            <div class="flex-shrink-0 w-24 h-24 z-10">
                                <img src="{{ $offerImageUrl }}" alt="{{ $offer->title }}" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110 drop-shadow-2xl" onerror="this.src='{{ asset('images/placeholder.svg') }}'">
                            </div>
                        </a>
                    @endif
                @empty
                    <!-- Fallback 1 -->
                    <a href="{{ route('products.index', ['category' => 'chiens']) }}" class="relative flex items-center justify-between p-8 rounded-3xl overflow-hidden min-h-[200px] bg-gradient-to-br from-primary-container to-primary text-white group transition-all duration-500 hover:scale-105 hover:shadow-2xl cursor-pointer">
                        <div class="flex-1 pr-4">
                            <span class="inline-block bg-white/30 backdrop-blur-sm px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider mb-4 shadow-lg">🔥 Offre Spéciale</span>
                            <h3 class="font-headline text-lg font-bold leading-tight mb-2">Jusqu'à 25% de remise</h3>
                            <p class="text-white/90 text-sm font-medium">Sur toute la gamme Chien</p>
                        </div>
                        <div class="flex-shrink-0 w-24 h-24">
                            <img src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=400&h=400&fit=crop&q=80" alt="Chien" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110 drop-shadow-2xl">
                        </div>
                    </a>
                    <!-- Fallback 2 -->
                    <a href="{{ route('products.index', ['category' => 'chats']) }}" class="relative flex items-center justify-between p-8 rounded-3xl overflow-hidden min-h-[200px] bg-gradient-to-br from-tertiary to-blue-600 text-white group transition-all duration-500 hover:scale-105 hover:shadow-2xl cursor-pointer">
                        <div class="flex-1 pr-4">
                            <span class="inline-block bg-white/30 backdrop-blur-sm px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider mb-4 shadow-lg">✨ Exclusivité Web</span>
                            <h3 class="font-headline text-lg font-bold leading-tight mb-2">-15% Accessoires</h3>
                            <p class="text-white/90 text-sm font-medium">Pour Chats et Rongeurs</p>
                        </div>
                        <div class="flex-shrink-0 w-24 h-24">
                            <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=400&h=400&fit=crop&q=80" alt="Chat" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110 drop-shadow-2xl">
                        </div>
                    </a>
                    <!-- Fallback 3 (Pack) -->
                    <a href="{{ route('products.index') }}" class="relative flex items-center justify-between p-8 rounded-3xl overflow-hidden min-h-[200px] bg-white border-2 border-purple-500/20 text-purple-700 group transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:border-purple-600 cursor-pointer">
                        <div class="flex-1 pr-4">
                            <h3 class="font-headline text-lg font-bold leading-tight mb-2 text-purple-950">Pack Bienvenue</h3>
                            <div class="mt-4 flex flex-col items-start gap-1">
                                <span class="text-2xl font-bold text-purple-600">89,00 DH</span>
                                <span class="text-sm text-gray-400 line-through">120,00 DH</span>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-24 h-24">
                            <img src="https://images.unsplash.com/photo-1520763185298-1b434c919102?w=400&h=400&fit=crop&q=80" alt="Oiseau" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110 drop-shadow-xl">
                        </div>
                    </a>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-12 md:py-20 bg-white">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="categories-mobile-scroll flex justify-center items-center gap-6 overflow-x-visible pb-2" id="categoriesGrid">
                @foreach($categories as $category)
                    @php
                        $catImageUrl = $category->image 
                            ? (filter_var($category->image, FILTER_VALIDATE_URL) 
                                ? $category->image 
                                : (str_starts_with($category->image, 'images/') 
                                    ? asset($category->image) 
                                    : asset('storage/' . $category->image))) 
                            : asset('images/placeholder.svg');
                    @endphp
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="flex flex-col items-center gap-3 transition min-w-[220px] shrink-0 group">
                        <img src="{{ $catImageUrl }}" alt="{{ $category->name }}" class="w-[220px] h-[220px] rounded-3xl object-contain transition transform group-hover:-translate-y-1 group-hover:shadow-lg">
                        <span class="font-semibold text-[0.875rem] text-on-surface transition group-hover:text-primary group-hover:font-bold">{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
            
            <!-- Indicateurs (dots) pour mobile uniquement -->
            <div class="categories-indicators"></div>
        </div>
    </section>

    <!-- Best Sellers Section - CAROUSEL HORIZONTAL -->
    <section class="py-8 md:py-16 bg-surface-container-low">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="font-headline text-[clamp(1.5rem,4vw,2rem)] font-semibold leading-[1.3] tracking-tight text-primary">Nos Best Sellers</h2>
                    <p class="text-on-surface-variant mt-2">Les produits préférés de notre communauté</p>
                </div>
                <div class="flex items-center gap-3">
                    <button id="scrollLeft" class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button id="scrollRight" class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-primary hover:bg-primary hover:text-white transition-all">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
            </div>
            <!-- Carousel horizontal avec produits dynamiques -->
            <div class="relative">
                <div class="overflow-x-auto hide-scrollbar scroll-smooth" id="productsCarousel">
                    <div class="flex gap-6 pb-4">
                        @foreach($bestsellers as $product)
                            @php
                                $imageUrl = $product->image_url;
                            @endphp
                            <!-- Carte Produit -->
                            <div class="min-w-[230px] w-[230px] bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col group border border-gray-200 flex-shrink-0">
                                <a href="{{ route('products.show', $product->slug) }}" class="relative w-full h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-4 overflow-hidden">
                                    <img src="{{ $imageUrl }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110"
                                         onerror="this.src='{{ asset('images/placeholder.svg') }}'">
                                    @if($product->rating)
                                        <div class="absolute top-2 right-2 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full">⭐ {{ number_format($product->rating, 1) }}</div>
                                    @endif
                                </a>
                                <div class="p-4 flex flex-col flex-grow">
                                    <span class="text-xs font-bold uppercase tracking-wider text-primary/70 mb-1">
                                        {{ $product->category->name ?? 'Produit' }}
                                    </span>
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        <h4 class="font-bold text-sm text-gray-900 mb-2 line-clamp-2 min-h-[40px] hover:text-primary transition">
                                            {{ $product->name }}
                                        </h4>
                                    </a>
                                    <div class="flex items-center justify-between mt-auto">
                                        <p class="font-headline text-xl font-bold text-primary">{{ number_format($product->price, 2, ',', ' ') }} MAD</p>
                                        <button class="bg-primary text-white p-2 rounded-lg hover:bg-primary-container transition-colors product-add-btn" 
                                                data-product-id="{{ $product->id }}"
                                                aria-label="Ajouter au panier">
                                            <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Script pour le carousel de produits
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('productsCarousel');
            const scrollLeftBtn = document.getElementById('scrollLeft');
            const scrollRightBtn = document.getElementById('scrollRight');

            if (carousel && scrollLeftBtn && scrollRightBtn) {
                // Scroll vers la gauche
                scrollLeftBtn.addEventListener('click', function() {
                    carousel.scrollBy({
                        left: -250,
                        behavior: 'smooth'
                    });
                });

                // Scroll vers la droite
                scrollRightBtn.addEventListener('click', function() {
                    carousel.scrollBy({
                        left: 250,
                        behavior: 'smooth'
                    });
                });

                // Optionnel: Cacher les boutons si on est au début/fin
                carousel.addEventListener('scroll', function() {
                    const maxScroll = carousel.scrollWidth - carousel.clientWidth;
                    
                    if (carousel.scrollLeft <= 0) {
                        scrollLeftBtn.style.opacity = '0.5';
                        scrollLeftBtn.style.cursor = 'not-allowed';
                    } else {
                        scrollLeftBtn.style.opacity = '1';
                        scrollLeftBtn.style.cursor = 'pointer';
                    }

                    if (carousel.scrollLeft >= maxScroll - 5) {
                        scrollRightBtn.style.opacity = '0.5';
                        scrollRightBtn.style.cursor = 'not-allowed';
                    } else {
                        scrollRightBtn.style.opacity = '1';
                        scrollRightBtn.style.cursor = 'pointer';
                    }
                });

                // Initialiser l'état des boutons
                carousel.dispatchEvent(new Event('scroll'));
            }
        });
    </script>

    <!-- Section Pigeons -->
    <section class="py-12 md:py-20 bg-white" id="pigeons">
        <div class="max-w-[1280px] mx-auto px-6">
            <!-- Banner Pigeons - IMAGE PLEINE LARGEUR -->
            <div class="relative rounded-3xl overflow-hidden mb-12 min-h-[300px] flex items-center shadow-2xl">
                <img src="{{ asset('images/sec peigon.png') }}" alt="Pigeon" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent"></div>
                <div class="relative z-10 max-w-md p-12 text-white">
                    <span class="block text-lg uppercase tracking-widest mb-3 opacity-90 font-semibold">Tout pour les</span>
                    <h1 class="font-headline text-4xl font-extrabold mb-4">Pigeons</h1>
                    <p class="text-gray-200 text-base">Découvrez notre gamme complète pour vos pigeons</p>
                </div>
            </div>
            
            <!-- Category Cards Pigeons -->
            <div class="subcategories-mobile-scroll grid grid-cols-1 sm:grid-cols-3 gap-6 mb-16">
                <a href="{{ route('products.index', ['subcategory' => 'cages-volieres-pigeons']) }}" class="bg-gradient-to-br from-slate-100 to-slate-200 hover:from-slate-200 hover:to-slate-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Cages & Volières</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw" alt="Cage" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
                <a href="{{ route('products.index', ['subcategory' => 'graines-nutrition-pigeons']) }}" class="bg-gradient-to-br from-emerald-100 to-emerald-200 hover:from-emerald-200 hover:to-emerald-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Graines & Nutrition</span>
                    <img src="{{ asset('images/products/img_product_peigon/grit-20kg-beyers-plus-003622-beyers-plus-un-melange-de-mineraux-compose-de-grit-de-coquillage-de-grit-de-coquille-dhuitre-de-gra-_1.webp') }}" alt="Graines" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
                <a href="{{ route('products.index', ['subcategory' => 'accessoires-pigeons']) }}" class="bg-gradient-to-br from-amber-100 to-amber-200 hover:from-amber-200 hover:to-amber-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Accessoires</span>
                    <img src="{{ asset('images/products/img_product_peigon/bagues-elastiques-e-z-par-50-pieces-taille-8-mm-couleur-jaune-650-eur-880err08-yellow-rings-4-wings-voila-une-nouvelle-conceptio.jpg') }}" alt="Accessoires" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
            </div>
        </div>
    </section>


    <!-- Section Chats -->
    <section class="py-12 md:py-20 bg-white" id="chats">
        <div class="max-w-[1280px] mx-auto px-6">
            <!-- Banner Chats - IMAGE PLEINE LARGEUR -->
            <div class="relative rounded-3xl overflow-hidden mb-12 min-h-[300px] flex items-center shadow-2xl">
                <img src="{{ asset('images/sec chat.png') }}" alt="Chat" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent"></div>
                <div class="relative z-10 max-w-md p-12 text-white">
                    <span class="block text-lg uppercase tracking-widest mb-3 opacity-90 font-semibold">Tout pour les</span>
                    <h1 class="font-headline text-4xl font-extrabold mb-4">Chats</h1>
                    <p class="text-gray-200 text-base">Tout ce dont votre félin a besoin pour être heureux</p>
                </div>
            </div>
            
            <!-- Category Cards Chats -->
            <div class="subcategories-mobile-scroll grid grid-cols-1 sm:grid-cols-3 gap-6 mb-16">
                <a href="{{ route('products.index', ['subcategory' => 'cage-transport']) }}" class="bg-gradient-to-br from-purple-100 to-purple-200 hover:from-purple-200 hover:to-purple-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Cage de transport</span>
                    <img src="{{ asset('images/products/img_product_chat/jlsb.jpg') }}" alt="Cage" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
                <a href="{{ route('products.index', ['subcategory' => 'croquettes-chat']) }}" class="bg-gradient-to-br from-blue-100 to-blue-200 hover:from-blue-200 hover:to-blue-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Croquettes pour chat</span>
                    <img src="{{ asset('images/products/img_product_chat/rc_vet_dry_caturinarysomc_mv_eretailkit_de_de_7.jpg') }}" alt="Croquettes" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
                <a href="{{ route('products.index', ['subcategory' => 'accessoires-chat']) }}" class="bg-gradient-to-br from-green-100 to-green-200 hover:from-green-200 hover:to-green-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Accessoires</span>
                    <img src="{{ asset('images/products/img_product_chat/527097_pla_tiaki_scratching_stairs_puzzle_fg_6858_3.jpg') }}" alt="Arbre à chat" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
            </div>
        </div>
    </section>

        <!-- Section Oiseaux -->
    <section class="py-12 md:py-20 bg-surface-container-low" id="oiseaux">
        <div class="max-w-[1280px] mx-auto px-6">
            <!-- Banner Oiseaux - IMAGE PLEINE LARGEUR -->
            <div class="relative rounded-3xl overflow-hidden mb-12 min-h-[300px] flex items-center shadow-2xl">
                <img src="{{ asset('images/sec oiseau.png') }}" alt="Oiseau" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent"></div>
                <div class="relative z-10 max-w-md p-12 text-white">
                    <span class="block text-lg uppercase tracking-widest mb-3 opacity-90 font-semibold">Tout pour les</span>
                    <h1 class="font-headline text-4xl font-extrabold mb-4">Oiseaux</h1>
                    <p class="text-gray-200 text-base">Une sélection complète pour le bien-être de vos oiseaux</p>
                </div>
            </div>
            
            <!-- Category Cards Oiseaux -->
            <div class="subcategories-mobile-scroll grid grid-cols-1 sm:grid-cols-3 gap-6 mb-16">
                <a href="{{ route('products.index', ['subcategory' => 'cages-volieres']) }}" class="bg-gradient-to-br from-blue-100 to-blue-200 hover:from-blue-200 hover:to-blue-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Cages & Volières</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw" alt="Cage" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
                <a href="{{ route('products.index', ['subcategory' => 'graines-nutrition']) }}" class="bg-gradient-to-br from-green-100 to-green-200 hover:from-green-200 hover:to-green-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Graines & Nutrition</span>
                    <img src="{{ asset('images/products/img_product_oiseau/Melange-pour-calopsitte-e1714228585714-510x510-1.webp') }}" alt="Graines" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
                <a href="{{ route('products.index', ['subcategory' => 'accessoires-oiseaux']) }}" class="bg-gradient-to-br from-purple-100 to-purple-200 hover:from-purple-200 hover:to-purple-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Accessoires</span>
                    <img src="{{ asset('images/products/img_product_oiseau/61i5pYks9dL._AC_UF1000,1000_QL80_.jpg') }}" alt="Jouets" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-12 md:py-16 bg-surface-container-low">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="text-center mb-10">
                <h2 class="font-headline text-[clamp(1.75rem,4vw,2.5rem)] font-bold text-primary mb-3">Galerie Photos</h2>
                <p class="text-on-surface-variant text-lg">Nos clients et leurs compagnons heureux</p>
            </div>
            
            <!-- Mobile: Grid 2×3 avec images carrées -->
            <div class="grid grid-cols-2 gap-4 md:hidden">
                <!-- Ligne 1: Chien -->
                <div class="relative overflow-hidden rounded-xl aspect-square group">
                    <img src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=600&h=600&fit=crop&q=80" alt="Chien" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
                <!-- Ligne 1: Pigeon -->
                <div class="relative overflow-hidden rounded-xl aspect-square group">
                    <img src="{{ asset('images/téléchargement.jpg') }}" alt="Pigeon" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
                
                <!-- Ligne 2: Oiseau -->
                <div class="relative overflow-hidden rounded-xl aspect-square group">
                    <img src="https://images.unsplash.com/photo-1552728089-57bdde30beb3?w=600&h=600&fit=crop&q=80" alt="Oiseau" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
                <!-- Ligne 2: Poisson -->
                <div class="relative overflow-hidden rounded-xl aspect-square group">
                    <img src="{{ asset('images/gal fish.jpg') }}" alt="Poisson" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
                
                <!-- Ligne 3: Pigeon -->
                <div class="relative overflow-hidden rounded-xl aspect-square group">
                    <img src="https://images.unsplash.com/photo-1606567595334-d39972c85dbe?w=600&h=600&fit=crop&q=80" alt="Pigeon" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
                <!-- Ligne 3: Chat -->
                <div class="relative overflow-hidden rounded-xl aspect-square group">
                    <img src="https://images.unsplash.com/photo-1574158622682-e40e69881006?w=600&h=600&fit=crop&q=80" alt="Chat" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                </div>
            </div>
            
            <!-- Desktop: Grid 3 colonnes avec layout asymétrique -->
            <div class="hidden md:grid grid-cols-3 gap-3">
                <!-- Colonne 1 (Gauche) -->
                <div class="flex flex-col gap-3">
                    <!-- Image horizontale - Pigeon 1 -->
                    <div class="relative overflow-hidden rounded-xl h-[180px] group">
                        <img src="{{ asset('images/gal peg1.png') }}" alt="Pigeon" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <!-- Image verticale - Chat -->
                    <div class="relative overflow-hidden rounded-xl h-[280px] group">
                        <img src="{{ asset('images/gal cat.jpg') }}" alt="Chat" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                </div>

                <!-- Colonne 2 (Centre) -->
                <div class="flex flex-col gap-3">
                    <!-- Image verticale grande - Chien -->
                    <div class="relative overflow-hidden rounded-xl h-[280px] group">
                        <img src="{{ asset('images/gal peg2.jpg') }}" alt="Chien" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <!-- Image horizontale - Oiseau -->
                    <div class="relative overflow-hidden rounded-xl h-[180px] group">
                        <img src="{{ asset('images/gal dog.jpg') }}" alt="Oiseau" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                </div>

                <!-- Colonne 3 (Droite) -->
                <div class="flex flex-col gap-3">
                    <!-- Image horizontale - Poisson -->
                    <div class="relative overflow-hidden rounded-xl h-[180px] group">
                        <img src="{{ asset('images/gal fish.jpg') }}" alt="Poisson" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <!-- Image verticale grande - Pigeon 2 -->
                    <div class="relative overflow-hidden rounded-xl h-[280px] group">
                        <img src="{{ asset('images/gal oiseau.jpg') }}" alt="Pigeon" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 md:py-32 bg-white relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-secondary/5 rounded-full blur-3xl"></div>
        
        <div class="max-w-[1280px] mx-auto px-6 relative z-10">
            <div class="text-center mb-20">
                <h2 class="font-headline text-4xl md:text-5xl font-bold text-on-surface mb-4">Ils nous font confiance</h2>
                <p class="text-on-surface-variant text-lg">Découvrez les retours de nos clients satisfaits</p>
            </div>
            
            <div class="testimonials-mobile-scroll grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($testimonials as $testimonial)
                    <!-- Avis {{ $loop->iteration }} -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 hover:border-primary/30 transition-all duration-300 hover:shadow-xl group">
                        <!-- Stars -->
                        <div class="flex gap-1 mb-6">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-gray-300' }} fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            @endfor
                        </div>
                        
                        <!-- Review -->
                        <p class="text-gray-700 text-base leading-relaxed mb-8 min-h-[100px]">
                            {{ $testimonial->content }}
                        </p>
                        
                        <!-- Author -->
                        <div class="flex items-center gap-4">
                            @if($testimonial->avatar)
                                @php
                                    $avatarUrl = filter_var($testimonial->avatar, FILTER_VALIDATE_URL) 
                                        ? $testimonial->avatar 
                                        : asset('storage/' . $testimonial->avatar);
                                @endphp
                                <img src="{{ $avatarUrl }}" 
                                     alt="{{ $testimonial->name }}" 
                                     class="w-16 h-16 rounded-full flex-shrink-0 shadow-md object-cover">
                            @else
                                <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-user text-gray-400 text-2xl"></i>
                                </div>
                            @endif
                            <div>
                                <p class="font-semibold text-gray-900">{{ $testimonial->name }}</p>
                                <p class="text-sm text-gray-500">{{ $testimonial->role ?: 'Client vérifié' }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Avis 1 - Default -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 hover:border-primary/30 transition-all duration-300 hover:shadow-xl group">
                        <!-- Stars -->
                        <div class="flex gap-1 mb-6">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            @endfor
                        </div>
                        
                        <!-- Review -->
                        <p class="text-gray-700 text-base leading-relaxed mb-8 min-h-[100px]">
                            Excellent service et produits de qualité. Mon chat adore ses nouvelles croquettes Royal Canin!
                        </p>
                        
                        <!-- Author -->
                        <div class="flex items-center gap-4">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop&crop=faces" 
                                 alt="Sophie Martin" 
                                 class="w-16 h-16 rounded-full flex-shrink-0 shadow-md object-cover">
                            <div>
                                <p class="font-semibold text-gray-900">Sophie Martin</p>
                                <p class="text-sm text-gray-500">Cliente vérifiée</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Avis 2 - Default -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 hover:border-primary/30 transition-all duration-300 hover:shadow-xl group">
                        <!-- Stars -->
                        <div class="flex gap-1 mb-6">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            @endfor
                        </div>
                        
                        <!-- Review -->
                        <p class="text-gray-700 text-base leading-relaxed mb-8 min-h-[100px]">
                            Livraison rapide et emballage soigné. La volière est magnifique et mes oiseaux sont ravis!
                        </p>
                        
                        <!-- Author -->
                        <div class="flex items-center gap-4">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=faces" 
                                 alt="Marc Dubois" 
                                 class="w-16 h-16 rounded-full flex-shrink-0 shadow-md object-cover">
                            <div>
                                <p class="font-semibold text-gray-900">Marc Dubois</p>
                                <p class="text-sm text-gray-500">Client vérifié</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Avis 3 - Default -->
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 hover:border-primary/30 transition-all duration-300 hover:shadow-xl group">
                        <!-- Stars -->
                        <div class="flex gap-1 mb-6">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 text-amber-400 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            @endfor
                        </div>
                        
                        <!-- Review -->
                        <p class="text-gray-700 text-base leading-relaxed mb-8 min-h-[100px]">
                            Super boutique! Les prix sont compétitifs et le service client est très réactif. Je recommande!
                        </p>
                        
                        <!-- Author -->
                        <div class="flex items-center gap-4">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=faces" 
                                 alt="Laura Petit" 
                                 class="w-16 h-16 rounded-full flex-shrink-0 shadow-md object-cover">
                            <div>
                                <p class="font-semibold text-gray-900">Laura Petit</p>
                                <p class="text-sm text-gray-500">Cliente vérifiée</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <!-- Indicateurs (dots) pour mobile uniquement -->
            <div class="testimonials-indicators"></div>
        </div>
    </section>
@endsection
