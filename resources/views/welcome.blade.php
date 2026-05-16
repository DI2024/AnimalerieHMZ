@extends('layouts.app')

@section('content')
    <!-- Hero Section avec Grid - Largeur limitée et centrée -->
    <section class="bg-white py-8">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="grid grid-rows-[92px_1fr] gap-4">
                <!-- Bande du haut - Marques de produits -->
                <div class="relative flex items-center rounded-2xl overflow-hidden">
                    <img src="{{ asset('images/img brand product.png') }}" alt="Marques de produits" class="w-full h-full object-cover">
                </div>

                <!-- Grid 2 colonnes en bas - 65% gauche / 35% droite -->
                <div class="grid grid-cols-1 md:grid-cols-[65%_35%] gap-4">
                    <!-- Colonne gauche - Texte principal (Rouge) - HAUTEUR 460px -->
                    <div class="bg-red-50 flex items-center justify-center p-6 rounded-2xl h-[460px] overflow-hidden">
                        <div class="max-w-[42rem]">
                            <h1 class="font-headline text-[clamp(1.5rem,5vw,2.5rem)] font-bold leading-[1.2] tracking-tight text-primary mb-4 md:mb-6">Tout pour le bonheur de vos compagnons</h1>
                            <p class="text-[1rem] md:text-[1.125rem] leading-[1.6] text-on-surface-variant mb-6 md:mb-12">Découvrez une sélection premium de produits pour prendre soin de vos animaux avec l'expertise et la fiabilité PetTrust.</p>
                            <button class="bg-primary hover:bg-primary-container text-white font-bold py-3 px-6 md:py-4 md:px-8 rounded-full transition shadow-md hover:-translate-y-0.5 active:translate-y-0 text-sm flex items-center justify-center gap-2" id="heroBtn">Découvrir la boutique</button>
                        </div>
                    </div>

                    <!-- Colonne droite - 2 images d'offres empilées -->
                    <div class="hidden md:grid grid-rows-2 gap-4">
                        <!-- Image offre 1 (Jaune) - HAUTEUR 222px -->
                        <div class="bg-yellow-100 overflow-hidden relative group rounded-2xl h-[222px]">
                            <img src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=800&q=80" alt="Offre Chien" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <span class="bg-primary px-4 py-2 rounded-full text-sm font-bold mb-2 inline-block">-25%</span>
                                <h3 class="font-headline text-2xl font-bold">Gamme Chien</h3>
                            </div>
                        </div>

                        <!-- Image offre 2 (Bleu) - HAUTEUR 222px -->
                        <div class="bg-blue-100 overflow-hidden relative group rounded-2xl h-[222px]">
                            <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=800&q=80" alt="Offre Chat" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <span class="bg-tertiary px-4 py-2 rounded-full text-sm font-bold mb-2 inline-block">-15%</span>
                                <h3 class="font-headline text-2xl font-bold">Accessoires Chat</h3>
                            </div>
                        </div>
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Offer 1 -->
                <div class="relative flex items-center justify-between p-8 rounded-3xl overflow-hidden min-h-[200px] bg-gradient-to-br from-primary-container to-primary text-white group transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                    <div class="flex-1 pr-4">
                        <span class="inline-block bg-white/30 backdrop-blur-sm px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider mb-4 shadow-lg">🔥 Offre Spéciale</span>
                        <h3 class="font-headline text-lg font-bold leading-tight mb-2">Jusqu'à 25% de remise</h3>
                        <p class="text-white/90 text-sm font-medium">Sur toute la gamme Chien</p>
                    </div>
                    <div class="flex-shrink-0 w-24 h-24">
                        <img src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=400&h=400&fit=crop&q=80" alt="Chien" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110 drop-shadow-2xl">
                    </div>
                </div>
                <!-- Offer 2 -->
                <div class="relative flex items-center justify-between p-8 rounded-3xl overflow-hidden min-h-[200px] bg-gradient-to-br from-tertiary to-blue-600 text-white group transition-all duration-500 hover:scale-105 hover:shadow-2xl">
                    <div class="flex-1 pr-4">
                        <span class="inline-block bg-white/30 backdrop-blur-sm px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider mb-4 shadow-lg">✨ Exclusivité Web</span>
                        <h3 class="font-headline text-lg font-bold leading-tight mb-2">-15% Accessoires</h3>
                        <p class="text-white/90 text-sm font-medium">Pour Chats et Rongeurs</p>
                    </div>
                    <div class="flex-shrink-0 w-24 h-24">
                        <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=400&h=400&fit=crop&q=80" alt="Chat" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110 drop-shadow-2xl">
                    </div>
                </div>
                <!-- Offer 3 -->
                <div class="relative flex items-center justify-between p-8 rounded-3xl overflow-hidden min-h-[200px] bg-white border-2 border-primary/20 text-primary group transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:border-primary">
                    <div class="flex-1 pr-4">
                        <span class="inline-block bg-gradient-to-r from-primary/10 to-tertiary/10 text-primary px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider mb-4 shadow-md">🎁 Nouveauté</span>
                        <h3 class="font-headline text-lg font-bold leading-tight mb-2">Pack Bienvenue</h3>
                        <p class="text-on-surface-variant text-sm font-medium">Offert pour votre 1ère commande</p>
                    </div>
                    <div class="flex-shrink-0 w-24 h-24">
                        <img src="https://images.unsplash.com/photo-1520763185298-1b434c919102?w=400&h=400&fit=crop&q=80" alt="Oiseau" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110 drop-shadow-xl">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-12 md:py-20 bg-white">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="flex justify-center items-center gap-6 overflow-x-visible pb-8" id="categoriesGrid">
                <button class="flex flex-col items-center gap-3 transition min-w-[180px] shrink-0 group active" data-category="oiseaux">
                    <img src="{{ asset('images/img_category/cat_oiseau.png') }}" alt="Oiseaux" class="w-[180px] h-[180px] rounded-3xl object-contain transition transform group-hover:-translate-y-1">
                    <span class="font-semibold text-[0.875rem] text-on-surface transition group-[.active]:text-primary group-[.active]:font-bold group-hover:text-primary group-hover:font-bold">Oiseaux</span>
                </button>
                <button class="flex flex-col items-center gap-3 transition min-w-[180px] shrink-0 group" data-category="pigeons">
                    <img src="{{ asset('images/img_category/cat_pigeon.png') }}" alt="Pigeons" class="w-[180px] h-[180px] rounded-3xl object-contain transition transform group-hover:-translate-y-1">
                    <span class="font-semibold text-[0.875rem] text-on-surface transition group-[.active]:text-primary group-[.active]:font-bold group-hover:text-primary group-hover:font-bold">Pigeons</span>
                </button>
                <button class="flex flex-col items-center gap-3 transition min-w-[180px] shrink-0 group" data-category="chats">
                    <img src="{{ asset('images/img_category/cat_chat.png') }}" alt="Chat" class="w-[180px] h-[180px] rounded-3xl object-contain transition transform group-hover:-translate-y-1">
                    <span class="font-semibold text-[0.875rem] text-on-surface transition group-[.active]:text-primary group-[.active]:font-bold group-hover:text-primary group-hover:font-bold">Chat</span>
                </button>
                <button class="flex flex-col items-center gap-3 transition min-w-[180px] shrink-0 group" data-category="chiens">
                    <img src="{{ asset('images/img_category/cat_chien.png') }}" alt="Chien" class="w-[180px] h-[180px] rounded-3xl object-contain transition transform group-hover:-translate-y-1">
                    <span class="font-semibold text-[0.875rem] text-on-surface transition group-[.active]:text-primary group-[.active]:font-bold group-hover:text-primary group-hover:font-bold">Chien</span>
                </button>
                <button class="flex flex-col items-center gap-3 transition min-w-[180px] shrink-0 group" data-category="poissons">
                    <img src="{{ asset('images/img_category/cat_poisson.png') }}" alt="Poissons" class="w-[180px] h-[180px] rounded-3xl object-contain transition transform group-hover:-translate-y-1">
                    <span class="font-semibold text-[0.875rem] text-on-surface transition group-[.active]:text-primary group-[.active]:font-bold group-hover:text-primary group-hover:font-bold">Poissons</span>
                </button>
            </div>
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
            <!-- Carousel horizontal avec 5 produits visibles -->
            <div class="relative">
                <div class="overflow-x-auto hide-scrollbar scroll-smooth" id="productsCarousel">
                    <div class="flex gap-6 pb-4">
                <!-- Carte 1 - Design Innovant -->
                <div class="min-w-[230px] w-[230px] bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col group border border-gray-200 flex-shrink-0">
                    <div class="relative w-full h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-4 overflow-hidden">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw" alt="Volière" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-2 right-2 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full">⭐ 5.0</div>
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h4 class="font-bold text-sm text-gray-900 mb-2 line-clamp-2 min-h-[40px]">Volière Design White Edition</h4>
                        <div class="flex items-center justify-between mt-auto">
                            <p class="font-headline text-xl font-bold text-primary">89€</p>
                            <button class="bg-primary text-white p-2 rounded-lg hover:bg-primary-container transition-colors">
                                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Carte 2 -->
                <div class="min-w-[230px] w-[230px] bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col group border border-gray-200 flex-shrink-0">
                    <div class="relative w-full h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-4 overflow-hidden">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A" alt="Croquettes" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-2 right-2 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full">⭐ 5.0</div>
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h4 class="font-bold text-sm text-gray-900 mb-2 line-clamp-2 min-h-[40px]">Croquettes Royal Canin Sterilised</h4>
                        <div class="flex items-center justify-between mt-auto">
                            <p class="font-headline text-xl font-bold text-primary">35€</p>
                            <button class="bg-primary text-white p-2 rounded-lg hover:bg-primary-container transition-colors">
                                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Carte 3 -->
                <div class="min-w-[230px] w-[230px] bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col group border border-gray-200 flex-shrink-0">
                    <div class="relative w-full h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-4 overflow-hidden">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko" alt="Graines" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-2 right-2 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full">⭐ 5.0</div>
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h4 class="font-bold text-sm text-gray-900 mb-2 line-clamp-2 min-h-[40px]">Mélange Graines Premium</h4>
                        <div class="flex items-center justify-between mt-auto">
                            <p class="font-headline text-xl font-bold text-primary">15€</p>
                            <button class="bg-primary text-white p-2 rounded-lg hover:bg-primary-container transition-colors">
                                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Carte 4 -->
                <div class="min-w-[230px] w-[230px] bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col group border border-gray-200 flex-shrink-0">
                    <div class="relative w-full h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-4 overflow-hidden">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCf13j3hn9fIiDpqfSIlA9_FGHwtCP_eI4a3XaBc8PRii4W1Xpek9f00xWvJE9IUbjlRXdu8-LuGY5LKKcih9AXo-YkFHi7qYjMJd47ArOAqqoOoWn9leyXVBBQuw1n3PCI2GBC55QG4gMu1HBDQkpsFbkZS_WJ0_q_vf2YXJFxlB0HrVo3E1bjSgW_uyEks74dsBVn7FKDLKCduZjyu-6-aJScVW_a1dPEPCDq1rgNwr8q4NCWWeiWomcEutvwHdKGXHPcFYJEMAw" alt="Arbre" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-2 right-2 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full">⭐ 5.0</div>
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h4 class="font-bold text-sm text-gray-900 mb-2 line-clamp-2 min-h-[40px]">Arbre à chat 'Oasis' 120cm</h4>
                        <div class="flex items-center justify-between mt-auto">
                            <p class="font-headline text-xl font-bold text-primary">49€</p>
                            <button class="bg-primary text-white p-2 rounded-lg hover:bg-primary-container transition-colors">
                                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Carte 5 -->
                <div class="min-w-[230px] w-[230px] bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col group border border-gray-200 flex-shrink-0">
                    <div class="relative w-full h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-4 overflow-hidden">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4n77pofZu0M7VUhuXGR57lrTtl_tb-uNTk86gHkIkGqm1VFQc7Ht2jLvyEZKkW0AIbNxsAawhHLmTYSyIluEMqF1ZTczZNvtpUpaEaABo4njvV99IleGHi4r6DK88eCwSmUKJI6JGjFSXwyIX_a05sHUoItu8TmjYM6jQ4Qa4yXFWe19SAQJdSHxcvN0O8vOKKeF-cOkmKKYTsKwPH218RptL2fIyj5VYNURR36Np6h6wrZFTBawkN2X8PygsVeVd_OzbAr9Lpp8" alt="Balançoire" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-2 right-2 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full">⭐ 4.0</div>
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h4 class="font-bold text-sm text-gray-900 mb-2 line-clamp-2 min-h-[40px]">Balançoire en Bois Naturel</h4>
                        <div class="flex items-center justify-between mt-auto">
                            <p class="font-headline text-xl font-bold text-primary">8€</p>
                            <button class="bg-primary text-white p-2 rounded-lg hover:bg-primary-container transition-colors">
                                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Carte 6 -->
                <div class="min-w-[230px] w-[230px] bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col group border border-gray-200 flex-shrink-0">
                    <div class="relative w-full h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-4 overflow-hidden">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCIgvNYgMNUX5dDqy9Ji_Xgxifl2RujROG1NGbtl-Mih2srLRpvr-ALYegp6tS66MyQnjGxpl4olvyw9hCamdiCkFivkf896OtEa385MGru_6Q019kTiqpbFtKgGowNvA-C_TqIx5l22H157bz1Kcvgw2kJCLW2ErRaYX-3bMGsSF7HTL6rLtQi-kLHDBGF2tudqZjjiCzdZKJopX7DanJL1aNaI1FjSwc8AKJscFoxJWMwFwX9dD2EIjNlqIw5XwkaHGF8gSSmNmY" alt="Litière" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-2 right-2 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full">⭐ 4.0</div>
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h4 class="font-bold text-sm text-gray-900 mb-2 line-clamp-2 min-h-[40px]">Litière agglomérante Premium</h4>
                        <div class="flex items-center justify-between mt-auto">
                            <p class="font-headline text-xl font-bold text-primary">13€</p>
                            <button class="bg-primary text-white p-2 rounded-lg hover:bg-primary-container transition-colors">
                                <span class="material-symbols-outlined text-[18px]">shopping_cart</span>
                            </button>
                        </div>
                    </div>
                </div>
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
                <img src="https://images.unsplash.com/photo-1520763185298-1b434c919102?w=1200&q=80" alt="Pigeon" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent"></div>
                <div class="relative z-10 max-w-md p-12 text-white">
                    <span class="block text-lg uppercase tracking-widest mb-3 opacity-90 font-semibold">Tout pour les</span>
                    <h1 class="font-headline text-4xl font-extrabold mb-4">Pigeons</h1>
                    <p class="text-gray-200 text-base">Découvrez notre gamme complète pour vos pigeons</p>
                </div>
            </div>
            
            <!-- Category Cards Pigeons -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-16">
                <a href="#" class="bg-gradient-to-br from-slate-100 to-slate-200 hover:from-slate-200 hover:to-slate-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Cages & Volières</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw" alt="Cage" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
                <a href="#" class="bg-gradient-to-br from-emerald-100 to-emerald-200 hover:from-emerald-200 hover:to-emerald-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Graines & Nutrition</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko" alt="Graines" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
                <a href="#" class="bg-gradient-to-br from-amber-100 to-amber-200 hover:from-amber-200 hover:to-amber-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Accessoires</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4n77pofZu0M7VUhuXGR57lrTtl_tb-uNTk86gHkIkGqm1VFQc7Ht2jLvyEZKkW0AIbNxsAawhHLmTYSyIluEMqF1ZTczZNvtpUpaEaABo4njvV99IleGHi4r6DK88eCwSmUKJI6JGjFSXwyIX_a05sHUoItu8TmjYM6jQ4Qa4yXFWe19SAQJdSHxcvN0O8vOKKeF-cOkmKKYTsKwPH218RptL2fIyj5VYNURR36Np6h6wrZFTBawkN2X8PygsVeVd_OzbAr9Lpp8" alt="Accessoires" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
            </div>
        </div>
    </section>


    <!-- Section Chats -->
    <section class="py-12 md:py-20 bg-white" id="chats">
        <div class="max-w-[1280px] mx-auto px-6">
            <!-- Banner Chats - IMAGE PLEINE LARGEUR -->
            <div class="relative rounded-3xl overflow-hidden mb-12 min-h-[300px] flex items-center shadow-2xl">
                <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=1200&q=80" alt="Chat" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/70 via-indigo-900/40 to-transparent"></div>
                <div class="relative z-10 max-w-md p-12 text-white">
                    <span class="block text-lg uppercase tracking-widest mb-3 opacity-90 font-semibold">Tout pour les</span>
                    <h1 class="font-headline text-4xl font-extrabold mb-4">Chats</h1>
                    <p class="text-indigo-50 text-base">Tout ce dont votre félin a besoin pour être heureux</p>
                </div>
            </div>
            
            <!-- Category Cards Chats -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-16">
                <a href="#" class="bg-gradient-to-br from-purple-100 to-purple-200 hover:from-purple-200 hover:to-purple-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Cage de transport</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCIgvNYgMNUX5dDqy9Ji_Xgxifl2RujROG1NGbtl-Mih2srLRpvr-ALYegp6tS66MyQnjGxpl4olvyw9hCamdiCkFivkf896OtEa385MGru_6Q019kTiqpbFtKgGowNvA-C_TqIx5l22H157bz1Kcvgw2kJCLW2ErRaYX-3bMGsSF7HTL6rLtQi-kLHDBGF2tudqZjjiCzdZKJopX7DanJL1aNaI1FjSwc8AKJscFoxJWMwFwX9dD2EIjNlqIw5XwkaHGF8gSSmNmY" alt="Cage" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
                <a href="#" class="bg-gradient-to-br from-blue-100 to-blue-200 hover:from-blue-200 hover:to-blue-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Croquettes pour chat</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDT4uP4tjFYK2FyqRUBsgeX_3U1Sa0cnbKyWDNkkOIJ2qiF_tZzDvPMGr8qy-CJN0FYgWdskAw7NgJXfBKXvkBg4qCXvtdGBmGnFGFQ7Cl6ILs9iRxZROeBNnJ2Xbz6aSDyNjwv1U3ScEX2ApndJiQL7YxbpeV8_6sl0Zbo1DBMpmaVDHdsRAJXLUFCxqAN71D1h41oWGvXOhQOYWuN5u2bYKehj_7IV0ipdrG4TfMOEnhmA7iCCfOBb_h_SvgahbCPaN9BSaNpX9k" alt="Croquettes" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
                <a href="#" class="bg-gradient-to-br from-green-100 to-green-200 hover:from-green-200 hover:to-green-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Accessoires</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCf13j3hn9fIiDpqfSIlA9_FGHwtCP_eI4a3XaBc8PRii4W1Xpek9f00xWvJE9IUbjlRXdu8-LuGY5LKKcih9AXo-YkFHi7qYjMJd47ArOAqqoOoWn9leyXVBBQuw1n3PCI2GBC55QG4gMu1HBDQkpsFbkZS_WJ0_q_vf2YXJFxlB0HrVo3E1bjSgW_uyEks74dsBVn7FKDLKCduZjyu-6-aJScVW_a1dPEPCDq1rgNwr8q4NCWWeiWomcEutvwHdKGXHPcFYJEMAw" alt="Arbre à chat" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
            </div>
        </div>
    </section>

        <!-- Section Oiseaux -->
    <section class="py-12 md:py-20 bg-surface-container-low" id="oiseaux">
        <div class="max-w-[1280px] mx-auto px-6">
            <!-- Banner Oiseaux - IMAGE PLEINE LARGEUR -->
            <div class="relative rounded-3xl overflow-hidden mb-12 min-h-[300px] flex items-center shadow-2xl">
                <img src="https://images.unsplash.com/photo-1552728089-57bdde30beb3?w=1200&q=80" alt="Oiseau" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/70 via-blue-900/40 to-transparent"></div>
                <div class="relative z-10 max-w-md p-12 text-white">
                    <span class="block text-lg uppercase tracking-widest mb-3 opacity-90 font-semibold">Tout pour les</span>
                    <h1 class="font-headline text-4xl font-extrabold mb-4">Oiseaux</h1>
                    <p class="text-blue-50 text-base">Une sélection complète pour le bien-être de vos oiseaux</p>
                </div>
            </div>
            
            <!-- Category Cards Oiseaux -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-16">
                <a href="#" class="bg-gradient-to-br from-blue-100 to-blue-200 hover:from-blue-200 hover:to-blue-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Cages & Volières</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw" alt="Cage" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
                <a href="#" class="bg-gradient-to-br from-green-100 to-green-200 hover:from-green-200 hover:to-green-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Graines & Nutrition</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko" alt="Graines" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
                </a>
                <a href="#" class="bg-gradient-to-br from-purple-100 to-purple-200 hover:from-purple-200 hover:to-purple-300 transition-all duration-300 p-8 rounded-2xl flex justify-between items-center group shadow-md hover:shadow-xl">
                    <span class="font-bold text-gray-900 text-lg">Accessoires</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4n77pofZu0M7VUhuXGR57lrTtl_tb-uNTk86gHkIkGqm1VFQc7Ht2jLvyEZKkW0AIbNxsAawhHLmTYSyIluEMqF1ZTczZNvtpUpaEaABo4njvV99IleGHi4r6DK88eCwSmUKJI6JGjFSXwyIX_a05sHUoItu8TmjYM6jQ4Qa4yXFWe19SAQJdSHxcvN0O8vOKKeF-cOkmKKYTsKwPH218RptL2fIyj5VYNURR36Np6h6wrZFTBawkN2X8PygsVeVd_OzbAr9Lpp8" alt="Jouets" class="w-20 h-20 object-cover rounded-full group-hover:scale-110 transition-transform duration-300 shadow-lg">
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
            <!-- Grid 3 colonnes avec layout asymétrique - Taille réduite -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <!-- Colonne 1 (Gauche) -->
                <div class="flex flex-col gap-3">
                    <!-- Image horizontale - Pigeon 1 -->
                    <div class="relative overflow-hidden rounded-xl h-[180px] group">
                        <img src="https://images.unsplash.com/photo-1520763185298-1b434c919102?w=600&q=80" alt="Pigeon" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <!-- Image verticale - Chat -->
                    <div class="relative overflow-hidden rounded-xl h-[280px] group">
                        <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?w=600&q=80" alt="Chat" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                </div>

                <!-- Colonne 2 (Centre) -->
                <div class="flex flex-col gap-3">
                    <!-- Image verticale grande - Chien -->
                    <div class="relative overflow-hidden rounded-xl h-[280px] group">
                        <img src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?w=600&q=80" alt="Chien" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <!-- Image horizontale - Oiseau -->
                    <div class="relative overflow-hidden rounded-xl h-[180px] group">
                        <img src="https://images.unsplash.com/photo-1552728089-57bdde30beb3?w=600&q=80" alt="Oiseau" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                </div>

                <!-- Colonne 3 (Droite) -->
                <div class="flex flex-col gap-3">
                    <!-- Image horizontale - Poisson -->
                    <div class="relative overflow-hidden rounded-xl h-[180px] group">
                        <img src="https://images.unsplash.com/photo-1524704654690-b56c05c78a00?w=600&q=80" alt="Poisson" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    <!-- Image verticale grande - Pigeon 2 -->
                    <div class="relative overflow-hidden rounded-xl h-[280px] group">
                        <img src="https://images.unsplash.com/photo-1605460375648-278bcbd579a6?w=600&q=80" alt="Pigeon" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-12 md:py-20 bg-white">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="font-headline text-[clamp(1.75rem,4vw,2.5rem)] font-bold text-primary mb-3">Avis Clients</h2>
                <p class="text-on-surface-variant text-lg">Ce que nos clients disent de nous</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Avis 1 -->
                <div class="ticket-card group">
                    <div class="ticket-inner h-full flex flex-col">
                        <div class="flex items-center gap-1 mb-6 text-amber-400 text-xl">
                            <span class="material-symbols-outlined fill-1">star</span>
                            <span class="material-symbols-outlined fill-1">star</span>
                            <span class="material-symbols-outlined fill-1">star</span>
                            <span class="material-symbols-outlined fill-1">star</span>
                            <span class="material-symbols-outlined fill-1">star</span>
                        </div>
                        <p class="text-on-surface-variant dark:text-gray-400 mb-8 flex-grow leading-relaxed italic">"Excellent service et produits de qualité. Mon chat adore ses nouvelles croquettes Royal Canin!"</p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center font-bold text-primary">S</div>
                            <div>
                                <p class="font-bold dark:text-white">Sophie Martin</p>
                                <p class="text-xs text-on-surface-variant/60">Cliente depuis 2024</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Avis 2 -->
                <div class="ticket-card group">
                    <div class="ticket-inner h-full flex flex-col">
                        <div class="flex items-center gap-1 mb-6 text-amber-400 text-xl">
                            <span class="material-symbols-outlined fill-1">star</span>
                            <span class="material-symbols-outlined fill-1">star</span>
                            <span class="material-symbols-outlined fill-1">star</span>
                            <span class="material-symbols-outlined fill-1">star</span>
                            <span class="material-symbols-outlined fill-1">star</span>
                        </div>
                        <p class="text-on-surface-variant dark:text-gray-400 mb-8 flex-grow leading-relaxed italic">"Livraison rapide et emballage soigné. La volière est magnifique et mes oiseaux sont ravis!"</p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center font-bold text-secondary">M</div>
                            <div>
                                <p class="font-bold dark:text-white">Marc Dubois</p>
                                <p class="text-xs text-on-surface-variant/60">Client depuis 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Avis 3 -->
                <div class="ticket-card group">
                    <div class="ticket-inner h-full flex flex-col">
                        <div class="flex items-center gap-1 mb-6 text-amber-400 text-xl">
                            <span class="material-symbols-outlined fill-1">star</span>
                            <span class="material-symbols-outlined fill-1">star</span>
                            <span class="material-symbols-outlined fill-1">star</span>
                            <span class="material-symbols-outlined fill-1">star</span>
                            <span class="material-symbols-outlined fill-1">star</span>
                        </div>
                        <p class="text-on-surface-variant dark:text-gray-400 mb-8 flex-grow leading-relaxed italic">"Super boutique! Les prix sont compétitifs et le service client est très réactif. Je recommande!"</p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-tertiary/10 flex items-center justify-center font-bold text-tertiary">L</div>
                            <div>
                                <p class="font-bold dark:text-white">Laura Petit</p>
                                <p class="text-xs text-on-surface-variant/60">Cliente depuis 2025</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
