<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Animalerie HMZ') }} - Tout pour vos animaux</title>
    
    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --color-primary: #003e87;
            --color-primary-container: #0855b1;
            --color-primary-light: #acc7ff;
            --color-secondary: #4e599d;
            --color-tertiary: #4fa5d8;
            --color-surface: #fbf8ff;
            --color-surface-container: #edecff;
            --color-surface-container-low: #f6f5ff;
            --color-on-surface: #13183f;
            --color-on-surface-variant: #424752;
            --color-on-primary: #ffffff;
            --color-outline: #737783;
            --color-outline-variant: #c2c6d4;
        }
        
        .bg-primary { background-color: var(--color-primary); }
        .bg-primary-container { background-color: var(--color-primary-container); }
        .bg-secondary { background-color: var(--color-secondary); }
        .bg-tertiary { background-color: var(--color-tertiary); }
        .bg-surface { background-color: var(--color-surface); }
        .bg-surface-container { background-color: var(--color-surface-container); }
        .bg-surface-container-low { background-color: var(--color-surface-container-low); }
        
        .text-primary { color: var(--color-primary); }
        .text-primary-container { color: var(--color-primary-container); }
        .text-secondary { color: var(--color-secondary); }
        .text-tertiary { color: var(--color-tertiary); }
        .text-on-surface { color: var(--color-on-surface); }
        .text-on-surface-variant { color: var(--color-on-surface-variant); }
        .text-on-primary { color: var(--color-on-primary); }
        
        .border-primary { border-color: var(--color-primary); }
        .border-outline { border-color: var(--color-outline); }
        .border-outline-variant { border-color: var(--color-outline-variant); }
        
        .hover\:bg-primary:hover { background-color: var(--color-primary); }
        .hover\:bg-primary-container:hover { background-color: var(--color-primary-container); }
        .hover\:text-primary:hover { color: var(--color-primary); }
        .hover\:border-primary:hover { border-color: var(--color-primary); }
        
        /* Gradient utilities */
        .from-primary-container { --tw-gradient-from: var(--color-primary-container); --tw-gradient-to: rgb(8 85 177 / 0); --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to); }
        .to-primary { --tw-gradient-to: var(--color-primary); }
        .from-tertiary { --tw-gradient-from: var(--color-tertiary); --tw-gradient-to: rgb(79 165 216 / 0); --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to); }
        .to-blue-600 { --tw-gradient-to: #2563eb; }
        .from-surface-container-low { --tw-gradient-from: var(--color-surface-container-low); --tw-gradient-to: rgb(246 245 255 / 0); --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to); }
        .border-primary\/20 { border-color: rgb(0 62 135 / 0.2); }
        .hover\:border-primary:hover { border-color: var(--color-primary); }
        .from-primary\/10 { --tw-gradient-from: rgb(0 62 135 / 0.1); --tw-gradient-to: rgb(0 62 135 / 0); --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to); }
        .to-tertiary\/10 { --tw-gradient-to: rgb(79 165 216 / 0.1); }
        
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .material-symbols-outlined.fill-1 {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        
        /* Navbar hover underline animation */
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--color-primary);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>
<body class="font-sans antialiased bg-white">
    
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-outline-variant">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo animalerie.png') }}" alt="Animalerie HMZ" class="h-12 w-auto transition-transform group-hover:scale-105">
                    <div class="flex flex-col">
                        <span class="font-headline text-xl font-bold text-primary">Animalerie HMZ</span>
                    </div>
                </a>

                <!-- Navigation Links - Desktop -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#pigeons" class="nav-link text-on-surface hover:text-primary font-medium transition-all hover:scale-105">Pigeons</a>
                    <a href="#chats" class="nav-link text-on-surface hover:text-primary font-medium transition-all hover:scale-105">Chats</a>
                    <a href="#oiseaux" class="nav-link text-on-surface hover:text-primary font-medium transition-all hover:scale-105">Oiseaux</a>
                    <a href="#offres" class="nav-link text-on-surface hover:text-primary font-medium transition-all hover:scale-105">Offres</a>
                    <a href="#contact" class="nav-link text-on-surface hover:text-primary font-medium transition-all hover:scale-105">Contact</a>
                </div>

                <!-- Right Side - Cart & Auth -->
                <div class="flex items-center gap-4">
                    <!-- Cart Icon -->
                    <a href="{{ route('api.cart.index') }}" class="relative p-2 hover:bg-surface-container-low rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-on-surface">shopping_cart</span>
                        <span class="absolute -top-1 -right-1 bg-primary text-on-primary text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center" id="cartCount">0</span>
                    </a>

                    @auth
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 bg-surface-container-low hover:bg-surface-container rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-primary">account_circle</span>
                                <span class="text-sm font-medium text-on-surface hidden lg:block">{{ Auth::user()->name }}</span>
                                <span class="material-symbols-outlined text-on-surface-variant text-sm">expand_more</span>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-outline-variant py-2">
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-on-surface hover:bg-surface-container-low transition-colors">
                                        <span class="material-symbols-outlined text-lg">dashboard</span>
                                        Admin Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-on-surface hover:bg-surface-container-low transition-colors">
                                        <span class="material-symbols-outlined text-lg">dashboard</span>
                                        Mon Compte
                                    </a>
                                    <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-on-surface hover:bg-surface-container-low transition-colors">
                                        <span class="material-symbols-outlined text-lg">shopping_bag</span>
                                        Mes Commandes
                                    </a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-on-surface hover:bg-surface-container-low transition-colors">
                                    <span class="material-symbols-outlined text-lg">settings</span>
                                    Paramètres
                                </a>
                                <hr class="my-2 border-outline-variant">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors w-full text-left">
                                        <span class="material-symbols-outlined text-lg">logout</span>
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Login & Register Buttons -->
                        <a href="{{ route('login') }}" class="text-sm font-medium text-on-surface hover:text-primary transition-colors px-4 py-2">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="text-sm font-medium text-on-primary bg-primary hover:bg-primary-container px-6 py-2 rounded-lg transition-all shadow-md hover:shadow-lg">
                            Inscription
                        </a>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button class="md:hidden p-2 hover:bg-surface-container-low rounded-lg transition-colors" onclick="toggleMobileMenu()">
                        <span class="material-symbols-outlined text-on-surface">menu</span>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden pb-4 border-t border-outline-variant mt-2 pt-4">
                <div class="flex flex-col gap-2">
                    <a href="#pigeons" class="px-4 py-2 text-on-surface hover:bg-surface-container-low rounded-lg transition-colors">Pigeons</a>
                    <a href="#chats" class="px-4 py-2 text-on-surface hover:bg-surface-container-low rounded-lg transition-colors">Chats</a>
                    <a href="#oiseaux" class="px-4 py-2 text-on-surface hover:bg-surface-container-low rounded-lg transition-colors">Oiseaux</a>
                    <a href="#offres" class="px-4 py-2 text-on-surface hover:bg-surface-container-low rounded-lg transition-colors">Offres</a>
                    <a href="#contact" class="px-4 py-2 text-on-surface hover:bg-surface-container-low rounded-lg transition-colors">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-primary text-on-primary py-16">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- About -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('images/logo animalerie.png') }}" alt="Animalerie HMZ" class="h-12 w-auto brightness-0 invert">
                    </div>
                    <h3 class="font-headline text-xl font-bold mb-2">Animalerie HMZ</h3>
                    <p class="text-primary-light text-sm leading-relaxed">Votre partenaire de confiance pour le bien-être de vos animaux depuis 2020.</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Liens Rapides</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2"><span class="material-symbols-outlined text-sm">chevron_right</span> Accueil</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2"><span class="material-symbols-outlined text-sm">chevron_right</span> Produits</a></li>
                        <li><a href="#offres" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2"><span class="material-symbols-outlined text-sm">chevron_right</span> Offres</a></li>
                        <li><a href="#contact" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2"><span class="material-symbols-outlined text-sm">chevron_right</span> Contact</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Catégories</h3>
                    <ul class="space-y-3">
                        <li><a href="#chiens" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2"><span class="material-symbols-outlined text-sm">chevron_right</span> Chiens</a></li>
                        <li><a href="#chats" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2"><span class="material-symbols-outlined text-sm">chevron_right</span> Chats</a></li>
                        <li><a href="#oiseaux" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2"><span class="material-symbols-outlined text-sm">chevron_right</span> Oiseaux</a></li>
                        <li><a href="#pigeons" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2"><span class="material-symbols-outlined text-sm">chevron_right</span> Pigeons</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Contact</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-primary-light text-sm">
                            <span class="material-symbols-outlined text-white">location_on</span>
                            <span>123 Rue des Animaux<br>75001 Paris, France</span>
                        </li>
                        <li class="flex items-center gap-3 text-primary-light text-sm">
                            <span class="material-symbols-outlined text-white">phone</span>
                            <span>+33 1 23 45 67 89</span>
                        </li>
                        <li class="flex items-center gap-3 text-primary-light text-sm">
                            <span class="material-symbols-outlined text-white">mail</span>
                            <span>contact@animaleriehmz.fr</span>
                        </li>
                    </ul>
                    
                    <!-- Social Media -->
                    <div class="flex gap-3 mt-6">
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-colors">
                            <span class="material-symbols-outlined text-sm">facebook</span>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-colors">
                            <span class="material-symbols-outlined text-sm">photo_camera</span>
                        </a>
                        <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-colors">
                            <span class="material-symbols-outlined text-sm">mail</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-white/20 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-primary-light text-sm">© {{ date('Y') }} Animalerie HMZ. Tous droits réservés.</p>
                <div class="flex gap-6">
                    <a href="#" class="text-primary-light hover:text-white transition-colors text-sm">Mentions Légales</a>
                    <a href="#" class="text-primary-light hover:text-white transition-colors text-sm">CGV</a>
                    <a href="#" class="text-primary-light hover:text-white transition-colors text-sm">Politique de Confidentialité</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        // Update cart count from session
        document.addEventListener('DOMContentLoaded', function() {
            // You can fetch cart count via AJAX here
            // For now, it will show 0
        });
    </script>
</body>
</html>
