@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[600px] flex items-center overflow-hidden bg-white">
        <div class="absolute right-0 top-0 w-1/2 h-full bg-contain bg-right bg-no-repeat z-0 hidden md:block" style="background-image: url('{{ asset('images/hero.png') }}');"></div>
        <div class="max-w-[1280px] mx-auto px-6 relative z-10 w-full flex justify-start">
            <div class="max-w-[42rem] pr-8 text-left">
                <h1 class="font-headline text-[clamp(2rem,5vw,2.5rem)] font-bold leading-[1.2] tracking-tight text-primary mb-6">Tout pour le bonheur de vos compagnons</h1>
                <p class="text-[1.125rem] leading-[1.6] text-on-surface-variant mb-12">Découvrez une sélection premium de produits pour prendre soin de vos animaux avec l'expertise et la fiabilité PetTrust.</p>
                <!-- Mobile Image -->
                <img src="{{ asset('images/hero.png') }}" alt="Animaux heureux" class="md:hidden w-full max-w-sm mx-auto mb-8">
                <button class="bg-primary hover:bg-primary-container text-white font-bold py-4 px-8 rounded-full transition shadow-md hover:-translate-y-0.5 active:translate-y-0 text-sm flex items-center justify-center gap-2" id="heroBtn">Découvrir la boutique</button>
            </div>
        </div>
    </section>

    <!-- Offers Section -->
    <section class="py-8 md:py-16 bg-surface-container-low" id="offres">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Offer 1 -->
                <div class="flex justify-between items-center p-8 rounded-3xl overflow-hidden relative min-h-[180px] bg-primary-container text-white group transition duration-300">
                    <div class="z-10 flex-1">
                        <span class="inline-block bg-white/20 px-3 py-1 rounded-full text-[0.75rem] font-bold uppercase tracking-[0.05em]">Offre Spéciale</span>
                        <h3 class="font-headline text-[clamp(1.25rem,3vw,2rem)] font-semibold leading-[1.3] tracking-tight mt-4">Jusqu'à 25% de remise</h3>
                        <p class="mt-2 opacity-90 text-[0.875rem]">Sur toute la gamme Chien</p>
                    </div>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAx-idpF478hzoaaBIUHLUhWNsH922i7ik4yZ4LO2wsFxOXaaH0vCZmjypSNPW30ShDtsjn1yqpnEmIm97kK9VU2iG19ZN0Q_Bc01sr9tKItR4y8LpQcFN8bjT3Gitg7YSmWhoFXxNmov5igt9yvFvKOsFHinogyokHHUyUpIb_jSnIM_foyONoR63ppruzz3Kjj8Q09IM4NcqFWBLcnyUiLmE9JLA5fHEoOWGVZ_SAE5fIRWwLEjQDLqOAa20bHz9MgNHftU0xCdA" alt="Chien" class="w-32 h-32 object-contain transition duration-300 group-hover:scale-110">
                </div>
                <!-- Offer 2 -->
                <div class="flex justify-between items-center p-8 rounded-3xl overflow-hidden relative min-h-[180px] bg-tertiary text-white group transition duration-300">
                    <div class="z-10 flex-1">
                        <span class="inline-block bg-white/20 px-3 py-1 rounded-full text-[0.75rem] font-bold uppercase tracking-[0.05em]">Exclusivité Web</span>
                        <h3 class="font-headline text-[clamp(1.25rem,3vw,2rem)] font-semibold leading-[1.3] tracking-tight mt-4">-15% sur les Accessoires</h3>
                        <p class="mt-2 opacity-90 text-[0.875rem]">Pour Chats et Rongeurs</p>
                    </div>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAD1AcP45gJpBLS8Tr-pXiMNBhB2iQJSA2af3qaDZ7Y417iW3jYCPMEXodTymh_btgwzlODtmGfx9-9WBkmqrr92jmmOl6Hza6t5TQcw34Wpzi1TDXqjiwXuSGQQifpo2cGqNLGMLJfYc4Aj2c7zH9Fns2agYHMc6JfqKBDoNvaF9nY6Bo7nEr_DfAPkZIxRgoqa0c5x6SpMwoaoUhfwM8UHOGaNy0FYVCh2S0XffBGisL1pEt11w0B4A0aiW25uQwPR5_UGGg2YU4" alt="Chat" class="w-32 h-32 object-contain transition duration-300 group-hover:scale-110">
                </div>
                <!-- Offer 3 -->
                <div class="flex justify-between items-center p-8 rounded-3xl overflow-hidden relative min-h-[180px] bg-white border border-gray-200 text-primary group transition duration-300">
                    <div class="z-10 flex-1">
                        <span class="inline-block bg-surface-container-low text-primary px-3 py-1 rounded-full text-[0.75rem] font-bold uppercase tracking-[0.05em]">Nouveauté</span>
                        <h3 class="font-headline text-[clamp(1.25rem,3vw,2rem)] font-semibold leading-[1.3] tracking-tight mt-4">Pack Bienvenue</h3>
                        <p class="mt-2 text-on-surface-variant text-[0.875rem]">Offert pour votre 1ère commande</p>
                    </div>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqASyV7URQYtB7AufDQq3zsXl7XSv9FkFZ2rS7cvCY8SjFBpNtd44dmKeXIseCB9VNUADcDBsTZFb6lITNOv2FLAuO2mwJu_CqbbtFdL1nnCHvOh3gcNgP6etzuggSPuFxOHrjFd94gobAlyjJdlEbFYg-J5N8E9XGz90YLgl0NJs0XhBpPwWcq_WERVUX8hBqXIcEE5Wjyp6mSiNEde_o2uE8CHpFJxQr9iCfpJSCMSWgZ8U6B2nbcBOlsTz53qAdUrzB7JupVkA" alt="Aquarium" class="w-32 h-32 object-contain transition duration-300 group-hover:scale-110">
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-8 md:py-16 bg-white">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="flex justify-center items-center gap-6 overflow-x-visible pb-8" id="categoriesGrid">
                <button class="flex flex-col items-center gap-3 transition min-w-[180px] shrink-0 group active" data-category="oiseaux">
                    <img src="{{ asset('images/cat_oiseaux.png') }}" alt="Oiseaux" class="w-[180px] h-[120px] rounded-3xl object-cover transition transform group-hover:-translate-y-1">
                    <span class="font-semibold text-[0.875rem] text-on-surface transition group-[.active]:text-primary group-[.active]:font-bold group-hover:text-primary group-hover:font-bold">Oiseaux</span>
                </button>
                <button class="flex flex-col items-center gap-3 transition min-w-[180px] shrink-0 group" data-category="pigeons">
                    <img src="{{ asset('images/cat_pigeons.png.png') }}" alt="Pigeons" class="w-[180px] h-[120px] rounded-3xl object-cover transition transform group-hover:-translate-y-1">
                    <span class="font-semibold text-[0.875rem] text-on-surface transition group-[.active]:text-primary group-[.active]:font-bold group-hover:text-primary group-hover:font-bold">Pigeons</span>
                </button>
                <button class="flex flex-col items-center gap-3 transition min-w-[180px] shrink-0 group" data-category="chats">
                    <img src="{{ asset('images/cat_chat.png') }}" alt="Chat" class="w-[180px] h-[120px] rounded-3xl object-cover transition transform group-hover:-translate-y-1">
                    <span class="font-semibold text-[0.875rem] text-on-surface transition group-[.active]:text-primary group-[.active]:font-bold group-hover:text-primary group-hover:font-bold">Chat</span>
                </button>
                <button class="flex flex-col items-center gap-3 transition min-w-[180px] shrink-0 group" data-category="chiens">
                    <img src="{{ asset('images/cat_chien.jpg') }}" alt="Chien" class="w-[180px] h-[120px] rounded-3xl object-cover transition transform group-hover:-translate-y-1">
                    <span class="font-semibold text-[0.875rem] text-on-surface transition group-[.active]:text-primary group-[.active]:font-bold group-hover:text-primary group-hover:font-bold">Chien</span>
                </button>
                <button class="flex flex-col items-center gap-3 transition min-w-[180px] shrink-0 group" data-category="poissons">
                    <img src="{{ asset('images/cat_poissons.png') }}" alt="Poissons" class="w-[180px] h-[120px] rounded-3xl object-cover transition transform group-hover:-translate-y-1">
                    <span class="font-semibold text-[0.875rem] text-on-surface transition group-[.active]:text-primary group-[.active]:font-bold group-hover:text-primary group-hover:font-bold">Poissons</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Best Sellers Section -->
    <section class="py-8 md:py-16 bg-surface-container-low">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="font-headline text-[clamp(1.5rem,4vw,2rem)] font-semibold leading-[1.3] tracking-tight text-primary">Nos Best Sellers</h2>
                    <p class="text-on-surface-variant mt-2">Les produits préférés de notre communauté</p>
                </div>
                <button class="inline-flex items-center gap-2 text-primary font-bold text-[0.875rem] transition hover:underline">
                    Tout voir <span class="material-symbols-outlined text-[24px]">arrow_forward</span>
                </button>
            </div>
            <!-- Best Sellers Static Carousel -->
            <div class="flex gap-6 overflow-x-auto pb-4 hide-scrollbar snap-x">
                <!-- Item 1 -->
                <div class="min-w-[210px] flex-shrink-0 snap-start bg-white border border-gray-100 rounded-3xl p-5 flex flex-col group transition hover:shadow-xl hover:-translate-y-1">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw" alt="Volière" class="w-full h-32 object-contain mb-4">
                    <h4 class="font-bold text-sm leading-tight flex-grow mb-4">Volière Design White Edition</h4>
                    <div class="flex justify-between items-center mt-auto">
                        <p class="font-headline text-lg font-bold text-primary">89,00€</p>
                        <button class="bg-primary text-white w-8 h-8 rounded-md flex items-center justify-center transition hover:bg-primary-container product-add-btn" data-product-id="3" aria-label="Ajouter au panier">
                            <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'wght' 200;">shopping_cart</span>
                        </button>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="min-w-[210px] flex-shrink-0 snap-start bg-white border border-gray-100 rounded-3xl p-5 flex flex-col group transition hover:shadow-xl hover:-translate-y-1">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A" alt="Croquettes" class="w-full h-32 object-contain mb-4">
                    <h4 class="font-bold text-sm leading-tight flex-grow mb-4">Croquettes Royal Canin Sterilised</h4>
                    <div class="flex justify-between items-center mt-auto">
                        <p class="font-headline text-lg font-bold text-primary">34,99€</p>
                        <button class="bg-primary text-white w-8 h-8 rounded-md flex items-center justify-center transition hover:bg-primary-container product-add-btn" data-product-id="6" aria-label="Ajouter au panier">
                            <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'wght' 200;">shopping_cart</span>
                        </button>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="min-w-[210px] flex-shrink-0 snap-start bg-white border border-gray-100 rounded-3xl p-5 flex flex-col group transition hover:shadow-xl hover:-translate-y-1">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko" alt="Graines" class="w-full h-32 object-contain mb-4">
                    <h4 class="font-bold text-sm leading-tight flex-grow mb-4">Mélange Graines Premium</h4>
                    <div class="flex justify-between items-center mt-auto">
                        <p class="font-headline text-lg font-bold text-primary">14,50€</p>
                        <button class="bg-primary text-white w-8 h-8 rounded-md flex items-center justify-center transition hover:bg-primary-container product-add-btn" data-product-id="8" aria-label="Ajouter au panier">
                            <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'wght' 200;">shopping_cart</span>
                        </button>
                    </div>
                </div>
                <!-- Item 4 -->
                <div class="min-w-[210px] flex-shrink-0 snap-start bg-white border border-gray-100 rounded-3xl p-5 flex flex-col group transition hover:shadow-xl hover:-translate-y-1">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCf13j3hn9fIiDpqfSIlA9_FGHwtCP_eI4a3XaBc8PRii4W1Xpek9f00xWvJE9IUbjlRXdu8-LuGY5LKKcih9AXo-YkFHi7qYjMJd47ArOAqqoOoWn9leyXVBBQuw1n3PCI2GBC55QG4gMu1HBDQkpsFbkZS_WJ0_q_vf2YXJFxlB0HrVo3E1bjSgW_uyEks74dsBVn7FKDLKCduZjyu-6-aJScVW_a1dPEPCDq1rgNwr8q4NCWWeiWomcEutvwHdKGXHPcFYJEMAw" alt="Arbre à chat" class="w-full h-32 object-contain mb-4">
                    <h4 class="font-bold text-sm leading-tight flex-grow mb-4">Arbre à chat 'Oasis' 120cm</h4>
                    <div class="flex justify-between items-center mt-auto">
                        <p class="font-headline text-lg font-bold text-primary">49,00€</p>
                        <button class="bg-primary text-white w-8 h-8 rounded-md flex items-center justify-center transition hover:bg-primary-container product-add-btn" data-product-id="10" aria-label="Ajouter au panier">
                            <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'wght' 200;">shopping_cart</span>
                        </button>
                    </div>
                </div>
                <!-- Item 5 -->
                <div class="min-w-[210px] flex-shrink-0 snap-start bg-white border border-gray-100 rounded-3xl p-5 flex flex-col group transition hover:shadow-xl hover:-translate-y-1">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4n77pofZu0M7VUhuXGR57lrTtl_tb-uNTk86gHkIkGqm1VFQc7Ht2jLvyEZKkW0AIbNxsAawhHLmTYSyIluEMqF1ZTczZNvtpUpaEaABo4njvV99IleGHi4r6DK88eCwSmUKJI6JGjFSXwyIX_a05sHUoItu8TmjYM6jQ4Qa4yXFWe19SAQJdSHxcvN0O8vOKKeF-cOkmKKYTsKwPH218RptL2fIyj5VYNURR36Np6h6wrZFTBawkN2X8PygsVeVd_OzbAr9Lpp8" alt="Balançoire" class="w-full h-32 object-contain mb-4">
                    <h4 class="font-bold text-sm leading-tight flex-grow mb-4">Balançoire en Bois Naturel</h4>
                    <div class="flex justify-between items-center mt-auto">
                        <p class="font-headline text-lg font-bold text-primary">7,90€</p>
                        <button class="bg-primary text-white w-8 h-8 rounded-md flex items-center justify-center transition hover:bg-primary-container product-add-btn" data-product-id="11" aria-label="Ajouter au panier">
                            <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'wght' 200;">shopping_cart</span>
                        </button>
                    </div>
                </div>
                <!-- Item 6 -->
                <div class="min-w-[210px] flex-shrink-0 snap-start bg-white border border-gray-100 rounded-3xl p-5 flex flex-col group transition hover:shadow-xl hover:-translate-y-1">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCIgvNYgMNUX5dDqy9Ji_Xgxifl2RujROG1NGbtl-Mih2srLRpvr-ALYegp6tS66MyQnjGxpl4olvyw9hCamdiCkFivkf896OtEa385MGru_6Q019kTiqpbFtKgGowNvA-C_TqIx5l22H157bz1Kcvgw2kJCLW2ErRaYX-3bMGsSF7HTL6rLtQi-kLHDBGF2tudqZjjiCzdZKJopX7DanJL1aNaI1FjSwc8AKJscFoxJWMwFwX9dD2EIjNlqIw5XwkaHGF8gSSmNmY" alt="Litière" class="w-full h-32 object-contain mb-4">
                    <h4 class="font-bold text-sm leading-tight flex-grow mb-4">Litière agglomérante Premium</h4>
                    <div class="flex justify-between items-center mt-auto">
                        <p class="font-headline text-lg font-bold text-primary">12,50€</p>
                        <button class="bg-primary text-white w-8 h-8 rounded-md flex items-center justify-center transition hover:bg-primary-container product-add-btn" data-product-id="2" aria-label="Ajouter au panier">
                            <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'wght' 200;">shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Oiseaux -->
    <section class="py-8 md:py-16 bg-white">
        <div class="max-w-[1280px] mx-auto px-6">
            <!-- Banner -->
            <div class="relative bg-tertiary text-white p-10 rounded-3xl overflow-hidden mb-12 min-h-[250px] flex items-center">
                <div class="relative z-10">
                    <span class="block text-base uppercase tracking-wider mb-2 opacity-90">Tout pour les</span>
                    <h1 class="font-headline text-3xl font-bold text-blue-500">Oiseaux</h1>
                </div>
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko" alt="Oiseau" class="absolute right-0 bottom-0 h-full object-contain max-w-[50%]">
            </div>
            
            <!-- Category Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-16">
                <a href="#" class="bg-blue-100 hover:bg-blue-200 transition p-6 rounded-2xl flex justify-between items-center group">
                    <span class="font-bold text-gray-900 text-lg">Cages & Volières</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw" alt="Cage" class="w-16 h-16 object-cover rounded-full group-hover:scale-110 transition">
                </a>
                <a href="#" class="bg-green-100 hover:bg-green-200 transition p-6 rounded-2xl flex justify-between items-center group">
                    <span class="font-bold text-gray-900 text-lg">Graines & Nutrition</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko" alt="Graines" class="w-16 h-16 object-cover rounded-full group-hover:scale-110 transition">
                </a>
                <a href="#" class="bg-purple-100 hover:bg-purple-200 transition p-6 rounded-2xl flex justify-between items-center group">
                    <span class="font-bold text-gray-900 text-lg">Jouets & Balançoires</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4n77pofZu0M7VUhuXGR57lrTtl_tb-uNTk86gHkIkGqm1VFQc7Ht2jLvyEZKkW0AIbNxsAawhHLmTYSyIluEMqF1ZTczZNvtpUpaEaABo4njvV99IleGHi4r6DK88eCwSmUKJI6JGjFSXwyIX_a05sHUoItu8TmjYM6jQ4Qa4yXFWe19SAQJdSHxcvN0O8vOKKeF-cOkmKKYTsKwPH218RptL2fIyj5VYNURR36Np6h6wrZFTBawkN2X8PygsVeVd_OzbAr9Lpp8" alt="Jouets" class="w-16 h-16 object-cover rounded-full group-hover:scale-110 transition">
                </a>
            </div>
            
            <!-- Best Sellers Carousel Oiseaux -->
            <div>
                <h3 class="font-headline text-xl font-semibold mb-6">Meilleures ventes Oiseaux</h3>
                <div class="flex gap-6 overflow-x-auto pb-4 hide-scrollbar snap-x">
                    <!-- Item -->
                    <div class="min-w-[210px] flex-shrink-0 snap-start bg-white border border-gray-100 rounded-3xl p-5 flex flex-col group transition hover:shadow-xl hover:-translate-y-1">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw" alt="Volière" class="w-full h-32 object-contain mb-4">
                        <h4 class="font-bold text-sm leading-tight flex-grow mb-4">Volière Design White Edition</h4>
                        <div class="flex justify-between items-center mt-auto">
                            <p class="font-headline text-lg font-bold text-primary">89,00€</p>
                            <button class="bg-primary text-white w-8 h-8 rounded-md flex items-center justify-center transition hover:bg-primary-container" aria-label="Ajouter au panier">
                                <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'wght' 200;">shopping_cart</span>
                            </button>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="min-w-[210px] flex-shrink-0 snap-start bg-white border border-gray-100 rounded-3xl p-5 flex flex-col group transition hover:shadow-xl hover:-translate-y-1">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko" alt="Graines" class="w-full h-32 object-contain mb-4">
                        <h4 class="font-bold text-sm leading-tight flex-grow mb-4">Mélange Graines Premium</h4>
                        <div class="flex justify-between items-center mt-auto">
                            <p class="font-headline text-lg font-bold text-primary">14,50€</p>
                            <button class="bg-primary text-white w-8 h-8 rounded-md flex items-center justify-center transition hover:bg-primary-container" aria-label="Ajouter au panier">
                                <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'wght' 200;">shopping_cart</span>
                            </button>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="min-w-[210px] flex-shrink-0 snap-start bg-white border border-gray-100 rounded-3xl p-5 flex flex-col group transition hover:shadow-xl hover:-translate-y-1">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuC4n77pofZu0M7VUhuXGR57lrTtl_tb-uNTk86gHkIkGqm1VFQc7Ht2jLvyEZKkW0AIbNxsAawhHLmTYSyIluEMqF1ZTczZNvtpUpaEaABo4njvV99IleGHi4r6DK88eCwSmUKJI6JGjFSXwyIX_a05sHUoItu8TmjYM6jQ4Qa4yXFWe19SAQJdSHxcvN0O8vOKKeF-cOkmKKYTsKwPH218RptL2fIyj5VYNURR36Np6h6wrZFTBawkN2X8PygsVeVd_OzbAr9Lpp8" alt="Balançoire" class="w-full h-32 object-contain mb-4">
                        <h4 class="font-bold text-sm leading-tight flex-grow mb-4">Balançoire en Bois Naturel</h4>
                        <div class="flex justify-between items-center mt-auto">
                            <p class="font-headline text-lg font-bold text-primary">7,90€</p>
                            <button class="bg-primary text-white w-8 h-8 rounded-md flex items-center justify-center transition hover:bg-primary-container" aria-label="Ajouter au panier">
                                <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'wght' 200;">shopping_cart</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Chats -->
    <section class="py-8 md:py-16 bg-surface-container-low">
        <div class="max-w-[1280px] mx-auto px-6">
            <!-- Banner -->
            <div class="relative bg-secondary text-white p-10 rounded-3xl overflow-hidden mb-12 min-h-[250px] flex items-center">
                <div class="relative z-10">
                    <span class="block text-base uppercase tracking-wider mb-2 opacity-90">Tout pour les</span>
                    <h1 class="font-headline text-3xl font-bold text-blue-500">Chats</h1>
                </div>
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuA34Rd-HA7Iz17ItWdCZ5pbIF4djnrLkEITzLCPY4A8JPutqk7SwAaJBEhZzwZFtU_9f0xxJxgsuij7ur29Fq2YRhay2NmMwl06VdmiEeYy9h8YH_3HdoyymZcJCrhw8hAl3kyhL1kRjygegf8b7MplNd4304nNSTtNUFiEla9x1QXtWMyhiQeaI81g8Y1-_Maki1z3JC-hf4oV4ybLg_LDfCUtxzu303ZK_-Gi4JSMdvFckHYVulg9zdhP25cUSR9WtEu3g-5lqpc" alt="Chat" class="absolute right-0 bottom-0 h-full object-contain max-w-[50%]">
            </div>
            
            <!-- Category Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-16">
                <a href="#" class="bg-blue-100 hover:bg-blue-200 transition p-6 rounded-2xl flex justify-between items-center group">
                    <span class="font-bold text-gray-900 text-lg">Croquettes pour chat</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDT4uP4tjFYK2FyqRUBsgeX_3U1Sa0cnbKyWDNkkOIJ2qiF_tZzDvPMGr8qy-CJN0FYgWdskAw7NgJXfBKXvkBg4qCXvtdGBmGnFGFQ7Cl6ILs9iRxZROeBNnJ2Xbz6aSDyNjwv1U3ScEX2ApndJiQL7YxbpeV8_6sl0Zbo1DBMpmaVDHdsRAJXLUFCxqAN71D1h41oWGvXOhQOYWuN5u2bYKehj_7IV0ipdrG4TfMOEnhmA7iCCfOBb_h_SvgahbCPaN9BSaNpX9k" alt="Croquettes" class="w-16 h-16 object-cover rounded-full group-hover:scale-110 transition">
                </a>
                <a href="#" class="bg-green-100 hover:bg-green-200 transition p-6 rounded-2xl flex justify-between items-center group">
                    <span class="font-bold text-gray-900 text-lg">Arbre à chat</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCf13j3hn9fIiDpqfSIlA9_FGHwtCP_eI4a3XaBc8PRii4W1Xpek9f00xWvJE9IUbjlRXdu8-LuGY5LKKcih9AXo-YkFHi7qYjMJd47ArOAqqoOoWn9leyXVBBQuw1n3PCI2GBC55QG4gMu1HBDQkpsFbkZS_WJ0_q_vf2YXJFxlB0HrVo3E1bjSgW_uyEks74dsBVn7FKDLKCduZjyu-6-aJScVW_a1dPEPCDq1rgNwr8q4NCWWeiWomcEutvwHdKGXHPcFYJEMAw" alt="Arbre à chat" class="w-16 h-16 object-cover rounded-full group-hover:scale-110 transition">
                </a>
                <a href="#" class="bg-purple-100 hover:bg-purple-200 transition p-6 rounded-2xl flex justify-between items-center group">
                    <span class="font-bold text-gray-900 text-lg">Cage de transport</span>
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCIgvNYgMNUX5dDqy9Ji_Xgxifl2RujROG1NGbtl-Mih2srLRpvr-ALYegp6tS66MyQnjGxpl4olvyw9hCamdiCkFivkf896OtEa385MGru_6Q019kTiqpbFtKgGowNvA-C_TqIx5l22H157bz1Kcvgw2kJCLW2ErRaYX-3bMGsSF7HTL6rLtQi-kLHDBGF2tudqZjjiCzdZKJopX7DanJL1aNaI1FjSwc8AKJscFoxJWMwFwX9dD2EIjNlqIw5XwkaHGF8gSSmNmY" alt="Cage" class="w-16 h-16 object-cover rounded-full group-hover:scale-110 transition">
                </a>
            </div>
            
            <!-- Best Sellers Carousel Chats -->
            <div>
                <h3 class="font-headline text-xl font-semibold mb-6">Meilleures ventes Chat</h3>
                <div class="flex gap-6 overflow-x-auto pb-4 hide-scrollbar snap-x">
                    <!-- Item -->
                    <div class="min-w-[210px] flex-shrink-0 snap-start bg-white border border-gray-100 rounded-3xl p-5 flex flex-col group transition hover:shadow-xl hover:-translate-y-1">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCIgvNYgMNUX5dDqy9Ji_Xgxifl2RujROG1NGbtl-Mih2srLRpvr-ALYegp6tS66MyQnjGxpl4olvyw9hCamdiCkFivkf896OtEa385MGru_6Q019kTiqpbFtKgGowNvA-C_TqIx5l22H157bz1Kcvgw2kJCLW2ErRaYX-3bMGsSF7HTL6rLtQi-kLHDBGF2tudqZjjiCzdZKJopX7DanJL1aNaI1FjSwc8AKJscFoxJWMwFwX9dD2EIjNlqIw5XwkaHGF8gSSmNmY" alt="Litière" class="w-full h-32 object-contain mb-4">
                        <h4 class="font-bold text-sm leading-tight flex-grow mb-4">Litière agglomérante Premium</h4>
                        <div class="flex justify-between items-center mt-auto">
                            <p class="font-headline text-lg font-bold text-primary">12,50€</p>
                            <button class="bg-primary text-white w-8 h-8 rounded-md flex items-center justify-center transition hover:bg-primary-container" aria-label="Ajouter au panier">
                                <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'wght' 200;">shopping_cart</span>
                            </button>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="min-w-[210px] flex-shrink-0 snap-start bg-white border border-gray-100 rounded-3xl p-5 flex flex-col group transition hover:shadow-xl hover:-translate-y-1">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A" alt="Croquettes" class="w-full h-32 object-contain mb-4">
                        <h4 class="font-bold text-sm leading-tight flex-grow mb-4">Croquettes Royal Canin Sterilised</h4>
                        <div class="flex justify-between items-center mt-auto">
                            <p class="font-headline text-lg font-bold text-primary">34,99€</p>
                            <button class="bg-primary text-white w-8 h-8 rounded-md flex items-center justify-center transition hover:bg-primary-container" aria-label="Ajouter au panier">
                                <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'wght' 200;">shopping_cart</span>
                            </button>
                        </div>
                    </div>
                    <!-- Item -->
                    <div class="min-w-[210px] flex-shrink-0 snap-start bg-white border border-gray-100 rounded-3xl p-5 flex flex-col group transition hover:shadow-xl hover:-translate-y-1">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCf13j3hn9fIiDpqfSIlA9_FGHwtCP_eI4a3XaBc8PRii4W1Xpek9f00xWvJE9IUbjlRXdu8-LuGY5LKKcih9AXo-YkFHi7qYjMJd47ArOAqqoOoWn9leyXVBBQuw1n3PCI2GBC55QG4gMu1HBDQkpsFbkZS_WJ0_q_vf2YXJFxlB0HrVo3E1bjSgW_uyEks74dsBVn7FKDLKCduZjyu-6-aJScVW_a1dPEPCDq1rgNwr8q4NCWWeiWomcEutvwHdKGXHPcFYJEMAw" alt="Arbre à chat" class="w-full h-32 object-contain mb-4">
                        <h4 class="font-bold text-sm leading-tight flex-grow mb-4">Arbre à chat 'Oasis' 120cm</h4>
                        <div class="flex justify-between items-center mt-auto">
                            <p class="font-headline text-lg font-bold text-primary">49,00€</p>
                            <button class="bg-primary text-white w-8 h-8 rounded-md flex items-center justify-center transition hover:bg-primary-container" aria-label="Ajouter au panier">
                                <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'wght' 200;">shopping_cart</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-8 md:py-16 bg-white">
        <div class="max-w-[1280px] mx-auto px-6">
            <h2 class="font-headline text-[clamp(1.5rem,4vw,2rem)] font-semibold text-center text-primary">Nos Moments Heureux</h2>
            <p class="text-on-surface-variant mt-2 text-center">Découvrez les plus beaux moments avec nos compagnons</p>
            
            <div class="flex gap-4 mt-8 overflow-x-auto pb-4 hide-scrollbar justify-center">
                <div class="relative overflow-hidden rounded-2xl flex-shrink-0 w-[192px] h-[200px] cursor-pointer transition transform hover:-translate-y-1 hover:shadow-xl group">
                    <img src="https://images.pexels.com/photos/1108099/pexels-photo-1108099.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Chien Golden Retriever" class="w-full h-full object-cover transition duration-300 group-hover:scale-110" loading="lazy">
                </div>
                <div class="relative overflow-hidden rounded-2xl flex-shrink-0 w-[192px] h-[200px] cursor-pointer transition transform hover:-translate-y-1 hover:shadow-xl group">
                    <img src="https://images.pexels.com/photos/349758/hummingbird-bird-birds-349758.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Pigeon" class="w-full h-full object-cover transition duration-300 group-hover:scale-110" loading="lazy">
                </div>
                <div class="relative overflow-hidden rounded-2xl flex-shrink-0 w-[192px] h-[200px] cursor-pointer transition transform hover:-translate-y-1 hover:shadow-xl group">
                    <img src="https://images.pexels.com/photos/45201/kitty-cat-kitten-pet-45201.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Chat tigré" class="w-full h-full object-cover transition duration-300 group-hover:scale-110" loading="lazy">
                </div>
                <div class="relative overflow-hidden rounded-2xl flex-shrink-0 w-[192px] h-[200px] cursor-pointer transition transform hover:-translate-y-1 hover:shadow-xl group">
                    <img src="https://images.pexels.com/photos/1661179/pexels-photo-1661179.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Oiseau coloré" class="w-full h-full object-cover transition duration-300 group-hover:scale-110" loading="lazy">
                </div>
                <div class="relative overflow-hidden rounded-2xl flex-shrink-0 w-[192px] h-[200px] cursor-pointer transition transform hover:-translate-y-1 hover:shadow-xl group">
                    <img src="https://images.pexels.com/photos/158471/ibis-bird-red-animals-158471.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Pigeon roux" class="w-full h-full object-cover transition duration-300 group-hover:scale-110" loading="lazy">
                </div>
                <div class="relative overflow-hidden rounded-2xl flex-shrink-0 w-[192px] h-[200px] cursor-pointer transition transform hover:-translate-y-1 hover:shadow-xl group">
                    <img src="https://images.pexels.com/photos/1618606/pexels-photo-1618606.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Poisson tropical" class="w-full h-full object-cover transition duration-300 group-hover:scale-110" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-8 md:py-16 bg-surface-container-low">
        <div class="max-w-[1280px] mx-auto px-6">
            <h2 class="font-headline text-[clamp(1.5rem,4vw,2rem)] font-semibold text-center text-primary">Ce que disent nos clients</h2>
            <p class="text-on-surface-variant mt-2 text-center">Des milliers de propriétaires satisfaits nous font confiance</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <div class="bg-white rounded-3xl p-8 shadow-sm transition hover:shadow-xl hover:-translate-y-1">
                    <div class="flex gap-1 mb-6 text-yellow-400">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                    <p class="italic mb-6">"Excellente qualité de produits ! Mon chat adore ses nouvelles croquettes et l'arbre à chat est magnifique. Livraison rapide et service client au top."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://i.pravatar.cc/150?img=1" alt="Sophie Martin" class="w-12 h-12 rounded-full">
                        <div>
                            <h4 class="font-bold text-on-surface">Sophie Martin</h4>
                            <p class="text-sm text-on-surface-variant">Propriétaire de 2 chats</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-3xl p-8 shadow-sm transition hover:shadow-xl hover:-translate-y-1">
                    <div class="flex gap-1 mb-6 text-yellow-400">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                    <p class="italic mb-6">"Je recommande vivement PetTrust ! Les prix sont compétitifs et la sélection de produits pour chiens est impressionnante. Mon golden retriever est ravi !"</p>
                    <div class="flex items-center gap-4">
                        <img src="https://i.pravatar.cc/150?img=12" alt="Thomas Dubois" class="w-12 h-12 rounded-full">
                        <div>
                            <h4 class="font-bold text-on-surface">Thomas Dubois</h4>
                            <p class="text-sm text-on-surface-variant">Propriétaire d'un chien</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-3xl p-8 shadow-sm transition hover:shadow-xl hover:-translate-y-1">
                    <div class="flex gap-1 mb-6 text-yellow-400">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                    </div>
                    <p class="italic mb-6">"Site très professionnel avec des conseils utiles. J'ai trouvé tout ce dont j'avais besoin pour mes oiseaux. Les graines sont de qualité premium !"</p>
                    <div class="flex items-center gap-4">
                        <img src="https://i.pravatar.cc/150?img=5" alt="Marie Lefebvre" class="w-12 h-12 rounded-full">
                        <div>
                            <h4 class="font-bold text-on-surface">Marie Lefebvre</h4>
                            <p class="text-sm text-on-surface-variant">Propriétaire d'oiseaux</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
