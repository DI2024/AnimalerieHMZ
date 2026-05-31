@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-surface transition-colors duration-300 pb-20">
    <!-- Breadcrumbs -->
    <div class="max-w-[1280px] mx-auto px-6 py-6">
        <nav class="flex text-sm font-medium text-on-surface-variant/60">
            <a href="/" class="hover:text-primary transition">Accueil</a>
            <span class="mx-2 text-gray-400">/</span>
            <a href="#" class="hover:text-primary transition">Chats</a>
            <span class="mx-2 text-gray-400">/</span>
            <span class="hidden md:inline text-on-surface">Arbre à chat HMZ Premium Luxe</span>
            <span class="inline md:hidden text-on-surface">Arbre à chat...</span>
        </nav>
    </div>

    <!-- Main Product Section -->
    <div class="max-w-[1280px] mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Left: Gallery -->
        <div class="lg:col-span-7 space-y-4">
            <div class="relative aspect-[3/2] rounded-[2.5rem] overflow-hidden bg-white shadow-xl group">
                <img id="mainImage" src="{{ asset('images/products/cat-tree-1.png') }}" alt="Arbre à chat HMZ Premium Luxe" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                
                <!-- Floating Badge -->
                <div class="absolute top-6 left-6 bg-primary/90 text-white px-4 py-2 rounded-full text-sm font-bold backdrop-blur-md shadow-lg animate-float-slow">
                    HMZ EXCLUSIVE
                </div>

                <!-- Like Button -->
                <button id="likeBtn" class="absolute top-6 right-6 w-12 h-12 bg-white/80 backdrop-blur-md rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition group/like">
                    <span class="material-symbols-outlined text-error transition duration-300" style="font-variation-settings: 'FILL' 0;">favorite</span>
                </button>
            </div>

            <!-- Thumbnails -->
            <div class="flex gap-4 overflow-x-auto pb-2 hide-scrollbar">
                <button class="thumb-btn active w-24 h-24 rounded-2xl overflow-hidden border-2 border-primary ring-4 ring-primary/10 transition-all flex-shrink-0" onclick="changeImage('{{ asset('images/products/cat-tree-1.png') }}', this)">
                    <img src="{{ asset('images/products/cat-tree-1.png') }}" class="w-full h-full object-cover opacity-100">
                </button>
                <button class="thumb-btn w-24 h-24 rounded-2xl overflow-hidden border-2 border-transparent hover:border-primary/50 transition-all flex-shrink-0" onclick="changeImage('{{ asset('images/products/dog-bed-1.png') }}', this)">
                    <img src="{{ asset('images/products/dog-bed-1.png') }}" class="w-full h-full object-cover opacity-60 hover:opacity-100 transition">
                </button>
                <button class="thumb-btn w-24 h-24 rounded-2xl overflow-hidden border-2 border-transparent hover:border-primary/50 transition-all flex-shrink-0" onclick="changeImage('{{ asset('images/products/cat-bowl-1.png') }}', this)">
                    <img src="{{ asset('images/products/cat-bowl-1.png') }}" class="w-full h-full object-cover opacity-60 hover:opacity-100 transition">
                </button>
            </div>
        </div>

        <!-- Right: Info -->
        <div class="lg:col-span-5 flex flex-col gap-8">
            <div class="space-y-4">

                
                <h1 class="text-3xl md:text-4xl font-extrabold font-headline leading-tight">
                    Arbre à chat <span class="text-primary-container">Premium Luxe</span> Modern Design
                </h1>
                

            </div>

            <div class="flex items-center gap-6">
                <div class="space-y-1">
                    <span class="text-2xl md:text-4xl font-black text-primary whitespace-nowrap">189,00 MAD</span>
                    <div class="flex items-center gap-2">
                        <span class="text-sm md:text-lg text-on-surface-variant/50 line-through whitespace-nowrap">249,00 MAD</span>
                        <span class="bg-error/10 text-error px-2 py-0.5 rounded-md text-xs font-bold">-24%</span>
                    </div>
                </div>
                <div class="h-12 w-px bg-gray-200"></div>
                <div class="text-sm font-medium text-on-surface-variant">
                    <div class="flex items-center gap-2 text-green-600">
                        <span class="material-symbols-outlined text-lg">check_circle</span>
                        En stock
                    </div>
                    <p>Livraison estimée : 2-3 jours</p>
                </div>
            </div>


            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                <div class="flex items-center bg-surface-container-low rounded-full p-1 border border-gray-100">
                    <button class="w-12 h-12 flex items-center justify-center text-xl font-bold hover:bg-white rounded-full transition" onclick="updateQty(-1)">-</button>
                    <input type="number" id="qtyInput" value="1" min="1" class="w-12 text-center bg-transparent border-none font-bold focus:ring-0">
                    <button class="w-12 h-12 flex items-center justify-center text-xl font-bold hover:bg-white rounded-full transition" onclick="updateQty(1)">+</button>
                </div>
                <button id="addToCartBtn" class="flex-1 bg-primary hover:bg-primary-container text-white font-bold py-4 px-8 rounded-full transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1 active:translate-y-0 flex items-center justify-center gap-3 group">
                    <span class="material-symbols-outlined group-hover:animate-bounce">shopping_cart</span>
                    Ajouter au panier
                </button>
            </div>

            <!-- Perks -->
            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-100">
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
        <div class="flex gap-10 border-b border-gray-100 mb-10 overflow-x-auto hide-scrollbar">
            <button class="tab-btn active pb-4 text-lg font-bold border-b-2 border-primary transition relative group" onclick="switchTab('description', this)">
                Description
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-primary rounded-full scale-100 transition"></div>
            </button>

            <button class="tab-btn pb-4 text-lg font-bold text-on-surface-variant border-b-2 border-transparent hover:text-primary transition relative group" onclick="switchTab('reviews', this)">
                Avis Clients ({{ $product->reviews->count() }})
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-primary rounded-full scale-0 group-hover:scale-50 transition"></div>
            </button>
        </div>

        <div id="tabContent" class="min-h-[300px]">
            <div id="description" class="tab-pane animate-in fade-in slide-in-from-bottom-4 duration-500">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
                    <div class="space-y-6">
                        <p class="text-on-surface-variant leading-relaxed text-lg line-clamp-2">
                            L'arbre à chat HMZ Premium a été conçu pour satisfaire les instincts naturels de votre chat tout en respectant l'esthétique de votre foyer. Chaque niveau est recouvert d'un tissu ultra-doux, et les poteaux sont entourés de sisal naturel pour le griffage.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary">done_all</span>
                                <span class="dark:text-gray-300">Stabilité exceptionnelle grâce à une base lestée.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary">done_all</span>
                                <span class="dark:text-gray-300">Matériaux éco-responsables et non toxiques.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-surface-container-low p-8 rounded-3xl border border-gray-100">
                        <h3 class="text-xl font-bold mb-6">Spécifications</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="font-bold text-on-surface-variant text-sm">Hauteur</span>
                                <span class="dark:text-white text-sm">165 cm</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="font-bold text-on-surface-variant text-sm">Matériaux</span>
                                <span class="dark:text-white text-sm">Bois, Sisal, Velours</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-100">
                                <span class="font-bold text-on-surface-variant text-sm">Poids</span>
                                <span class="dark:text-white text-sm">18 kg</span>
                            </div>
                            <div class="flex justify-between py-3">
                                <span class="font-bold text-on-surface-variant text-sm">Assemblage</span>
                                <span class="dark:text-white text-sm">Inclus</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            


            <div id="reviews" class="tab-pane hidden animate-in fade-in slide-in-from-bottom-4 duration-500">
                @php
                    $approvedReviews = $product->reviews;
                    $totalReviewsCount = $approvedReviews->count();
                    
                    $starsCount = [
                        5 => 0,
                        4 => 0,
                        3 => 0,
                        2 => 0,
                        1 => 0
                    ];
                    
                    foreach ($approvedReviews as $rev) {
                        $starsCount[$rev->rating] = ($starsCount[$rev->rating] ?? 0) + 1;
                    }
                @endphp
                <div class="flex flex-col gap-8">
                    <div class="bg-surface-container-low p-8 rounded-3xl flex flex-col md:flex-row items-center gap-10 shadow-sm border border-gray-100">
                        <div class="text-center">
                            <div class="text-6xl font-black text-primary">{{ number_format($product->rating ?? 5.0, 1) }}</div>
                            <div class="flex text-amber-400 mt-2 justify-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="material-symbols-outlined {{ $i <= ($product->rating ?? 5) ? 'fill-1' : '' }}">star</span>
                                @endfor
                            </div>
                            <div class="text-sm font-bold text-on-surface-variant/60 mt-2">
                                Basé sur {{ $totalReviewsCount }} {{ $totalReviewsCount > 1 ? 'avis' : 'avis' }}
                            </div>
                        </div>
                        
                        <div class="flex-1 space-y-3 w-full">
                            @for($star = 5; $star >= 1; $star--)
                                @php
                                    $count = $starsCount[$star];
                                    $pct = $totalReviewsCount > 0 ? ($count / $totalReviewsCount) * 100 : 0;
                                @endphp
                                <div class="flex items-center gap-4">
                                    <span class="w-4 text-xs font-bold text-gray-700">{{ $star }}</span>
                                    <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-primary rounded-full" style="width: {{ $pct }}%"></div>
                                    </div>
                                    <span class="w-8 text-xs text-right text-on-surface-variant/60 font-bold">{{ $count }}</span>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Individual Reviews List -->
                    <div class="space-y-6">
                        @forelse($approvedReviews as $review)
                            <div class="p-6 rounded-2xl border border-gray-100 hover:shadow-md transition bg-white">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-[#003e87]/10 flex items-center justify-center font-bold text-[#003e87]">
                                            {{ strtoupper(substr($review->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900">{{ $review->user->name }}</div>
                                            <div class="text-xs text-on-surface-variant/60">Acheteur vérifié • {{ $review->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    <div class="flex text-amber-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="material-symbols-outlined text-sm {{ $i <= $review->rating ? 'fill-1' : '' }}">star</span>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm whitespace-pre-line leading-relaxed">{{ $review->comment }}</p>
                            </div>
                        @empty
                            <div class="text-center py-12 text-on-surface-variant/60 bg-surface-container-low rounded-2xl border border-dashed border-gray-200">
                                <span class="material-symbols-outlined text-4xl mb-2 text-gray-400">rate_review</span>
                                <p class="text-sm font-medium">Aucun avis pour le moment. Soyez le premier à donner votre avis après votre achat !</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="max-w-[1280px] mx-auto px-6 mt-32">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-extrabold font-headline">Articles Similaires</h2>
                <p class="text-on-surface-variant/60 mt-2">D'autres coups de cœur pour votre félin.</p>
            </div>
            <a href="#" class="flex items-center gap-2 font-bold text-primary hover:gap-4 transition-all">
                Voir tout <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 related-products-scroll">
            <!-- Product Card 1 -->
            <div class="group relative bg-ticket rounded-[2rem] p-4 shadow-ticket hover:shadow-2xl transition duration-500 hover:-translate-y-2 related-product-card">
                <div class="aspect-square rounded-[1.5rem] overflow-hidden mb-4 relative">
                    <img src="{{ asset('images/products/dog-bed-1.png') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    <button class="absolute top-3 right-3 w-10 h-10 bg-white/80 backdrop-blur-md rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition translate-y-2 group-hover:translate-y-0">
                        <span class="material-symbols-outlined text-error">favorite</span>
                    </button>
                </div>
                <h3 class="font-bold text-base px-2">Lit Velours Royal</h3>
                <p class="text-on-surface-variant/60 text-sm px-2 mb-4">Confort et élégance</p>
                <div class="flex justify-between items-center px-2">
                    <span class="text-xl font-black text-primary">89,00 MAD</span>
                    <a href="{{ route('checkout') }}" class="w-10 h-10 rounded-full bg-primary/5 text-primary hover:bg-primary hover:text-white transition-colors flex items-center justify-center">
                        <span class="material-symbols-outlined">add_shopping_cart</span>
                    </a>
                </div>
            </div>

            <!-- Product Card 2 -->
            <div class="group relative bg-ticket rounded-[2rem] p-4 shadow-ticket hover:shadow-2xl transition duration-500 hover:-translate-y-2 related-product-card">
                <div class="aspect-square rounded-[1.5rem] overflow-hidden mb-4 relative">
                    <img src="{{ asset('images/products/cat-bowl-1.png') }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                </div>
                <h3 class="font-bold text-base px-2">Bol Céramique Zen</h3>
                <p class="text-on-surface-variant/60 text-sm px-2 mb-4">Minimalisme scandinave</p>
                <div class="flex justify-between items-center px-2">
                    <span class="text-xl font-black text-primary">34,00 MAD</span>
                    <a href="{{ route('checkout') }}" class="w-10 h-10 rounded-full bg-primary/5 text-primary hover:bg-primary hover:text-white transition-colors flex items-center justify-center">
                        <span class="material-symbols-outlined">add_shopping_cart</span>
                    </a>
                </div>
            </div>
            
            <!-- Repeat or more cards -->
        </div>
        <!-- Indicateurs (dots) pour les produits similaires en mobile -->
        <div class="related-products-indicators"></div>
    </div>
</div>




<style>
    .fill-1 { font-variation-settings: 'FILL' 1; }
    .tab-pane.hidden { display: none; }
    #sideCart.open { transform: translateX(0); }
    #sideCartOverlay.show { display: block; opacity: 1; }
    
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-in { animation: slideIn 0.5s ease forwards; }
</style>

<script>
    function changeImage(src, btn) {
        const main = document.getElementById('mainImage');
        main.style.opacity = '0';
        setTimeout(() => {
            main.src = src;
            main.style.opacity = '1';
        }, 200);
        
        document.querySelectorAll('.thumb-btn').forEach(b => {
            b.classList.remove('active', 'border-primary', 'ring-4', 'ring-primary/10');
            b.classList.add('border-transparent');
            b.querySelector('img').style.opacity = '0.6';
        });
        
        btn.classList.add('active', 'border-primary', 'ring-4', 'ring-primary/10');
        btn.classList.remove('border-transparent');
        btn.querySelector('img').style.opacity = '1';
    }

    function updateQty(delta) {
        const input = document.getElementById('qtyInput');
        let val = parseInt(input.value) + delta;
        if (val < 1) val = 1;
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


    document.getElementById('addToCartBtn').addEventListener('click', () => {
        const btn = document.getElementById('addToCartBtn');
        const originalContent = btn.innerHTML;
        
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Ajout...';
        btn.disabled = true;
        
        setTimeout(() => {
            btn.innerHTML = '<span class="material-symbols-outlined">check_circle</span> Ajouté !';
            
            // Update cart badge visually
            const badge = document.getElementById('cartBadge');
            if (badge) {
                let count = parseInt(badge.textContent) || 0;
                badge.textContent = count + 1;
                badge.classList.remove('opacity-0', 'scale-0');
                badge.classList.add('opacity-100', 'scale-100');
            }

            setTimeout(() => {
                btn.innerHTML = originalContent;
                btn.disabled = false;
            }, 1500);
        }, 600);
    });

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
