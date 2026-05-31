<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Animalerie HMZ')); ?> - Tout pour vos animaux</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo animalerie.png')); ?>">
    
    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <!-- Prevent FOUT for Material Symbols -->
    <script>
        (function() {
            var timeout = setTimeout(function() {
                document.documentElement.classList.add('icons-loaded');
            }, 1000); // 1s fallback

            if (document.fonts && document.fonts.load) {
                document.fonts.load('1em "Material Symbols Outlined"').then(function() {
                    clearTimeout(timeout);
                    document.documentElement.classList.add('icons-loaded');
                });
            } else {
                document.documentElement.classList.add('icons-loaded');
            }
        })();
    </script>

    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <!-- Mobile Scroll CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/mobile-scroll.css')); ?>">
    
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
<body class="font-sans antialiased bg-white min-h-screen flex flex-col">
    
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-outline-variant">
        <div class="max-w-[1280px] mx-auto px-6">
            <!-- Desktop Navigation -->
            <div class="hidden md:flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3 group">
                    <img src="<?php echo e(asset('images/logo animalerie.png')); ?>" alt="Animalerie HMZ" class="h-12 w-auto transition-transform group-hover:scale-105">
                    <div class="flex flex-col">
                        <span class="font-headline text-xl font-bold text-primary">Animalerie HMZ</span>
                    </div>
                </a>

                <!-- Navigation Links - Desktop -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="<?php echo e(route('products.index', ['category' => 'pigeons'])); ?>" class="nav-link text-on-surface hover:text-primary font-medium transition-all hover:scale-105">Pigeons</a>
                    <a href="<?php echo e(route('products.index', ['category' => 'chats'])); ?>" class="nav-link text-on-surface hover:text-primary font-medium transition-all hover:scale-105">Chats</a>
                    <a href="<?php echo e(route('products.index', ['category' => 'oiseaux'])); ?>" class="nav-link text-on-surface hover:text-primary font-medium transition-all hover:scale-105">Oiseaux</a>
                    <a href="<?php echo e(route('home')); ?>#offres" class="nav-link text-on-surface hover:text-primary font-medium transition-all hover:scale-105">Offres</a>
                    <a href="#contact" class="nav-link text-on-surface hover:text-primary font-medium transition-all hover:scale-105" onclick="scrollToContact(event)">Contact</a>
                </div>

                <!-- Right Side - Cart & Auth -->
                <div class="flex items-center gap-4">
                    <!-- Cart Icon -->
                    <a href="<?php echo e(route('cart.show')); ?>" class="relative p-2 hover:bg-surface-container-low rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-on-surface">shopping_cart</span>
                        <span class="absolute -top-1 -right-1 bg-primary text-on-primary text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center" id="cartCount">0</span>
                    </a>

                    <?php if(auth()->guard()->check()): ?>
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 bg-surface-container-low hover:bg-surface-container rounded-lg transition-colors">
                                <span class="material-symbols-outlined text-primary">account_circle</span>
                                <span class="text-sm font-medium text-on-surface hidden lg:block"><?php echo e(Auth::user()->name); ?></span>
                                <span class="material-symbols-outlined text-on-surface-variant text-sm">expand_more</span>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-outline-variant py-2">
                                <?php if(Auth::user()->role === 'admin'): ?>
                                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 px-4 py-2 text-sm text-on-surface hover:bg-surface-container-low transition-colors">
                                        <span class="material-symbols-outlined text-lg">dashboard</span>
                                        Admin Dashboard
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 px-4 py-2 text-sm text-on-surface hover:bg-surface-container-low transition-colors">
                                        <span class="material-symbols-outlined text-lg">dashboard</span>
                                        Mon Compte
                                    </a>
                                    <a href="<?php echo e(route('orders.index')); ?>" class="flex items-center gap-3 px-4 py-2 text-sm text-on-surface hover:bg-surface-container-low transition-colors">
                                        <span class="material-symbols-outlined text-lg">shopping_bag</span>
                                        Mes Commandes
                                    </a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-3 px-4 py-2 text-sm text-on-surface hover:bg-surface-container-low transition-colors">
                                    <span class="material-symbols-outlined text-lg">settings</span>
                                    Paramètres
                                </a>
                                <hr class="my-2 border-outline-variant">
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors w-full text-left">
                                        <span class="material-symbols-outlined text-lg">logout</span>
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Login & Register Buttons -->
                        <a href="<?php echo e(route('login')); ?>" class="text-sm font-medium text-on-surface hover:text-primary transition-colors px-4 py-2">
                            Connexion
                        </a>
                        <a href="<?php echo e(route('register')); ?>" class="text-sm font-medium text-on-primary bg-primary hover:bg-primary-container px-6 py-2 rounded-lg transition-all shadow-md hover:shadow-lg">
                            Inscription
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <div class="md:hidden flex justify-between items-center h-16">
                <!-- Hamburger Menu (Gauche) -->
                <button class="p-2 hover:bg-surface-container-low rounded-lg transition-colors" id="mobileMenuToggle">
                    <span class="material-symbols-outlined text-on-surface">menu</span>
                </button>
                
                <!-- Logo (Centre) -->
                <a href="<?php echo e(route('home')); ?>" class="absolute left-1/2 transform -translate-x-1/2">
                    <img src="<?php echo e(asset('images/logo animalerie.png')); ?>" alt="Animalerie HMZ" class="h-10 w-auto">
                </a>
                
                <!-- Panier + Profil (Droite) -->
                <div class="flex items-center gap-2">
                    <!-- Cart Icon -->
                    <a href="<?php echo e(route('cart.show')); ?>" class="relative p-2 hover:bg-surface-container-low rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-on-surface">shopping_cart</span>
                        <span class="absolute -top-1 -right-1 bg-primary text-on-primary text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center" id="cartCountMobile">0</span>
                    </a>
                    
                    <?php if(auth()->guard()->check()): ?>
                        <!-- Profile Icon -->
                        <a href="<?php echo e(route('dashboard')); ?>" class="p-2 hover:bg-surface-container-low rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-primary">account_circle</span>
                        </a>
                    <?php else: ?>
                        <!-- Login Icon -->
                        <a href="<?php echo e(route('login')); ?>" class="p-2 hover:bg-surface-container-low rounded-lg transition-colors">
                            <span class="material-symbols-outlined text-on-surface">person</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Mobile Menu Overlay -->
            <div class="mobile-menu-overlay"></div>
            
            <!-- Mobile Menu Sidebar -->
            <div class="mobile-menu">
                <div class="mobile-menu-header">
                    <div class="flex items-center gap-3">
                        <img src="<?php echo e(asset('images/logo animalerie.png')); ?>" alt="Logo" class="h-10 w-auto">
                        <span class="font-headline text-lg font-bold text-primary">Animalerie HMZ</span>
                    </div>
                    <button class="mobile-menu-close" data-mobile-menu-close>
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <nav class="mobile-menu-nav">
                    <a href="<?php echo e(route('home')); ?>" class="mobile-menu-link">
                        <span class="material-symbols-outlined">home</span>
                        Accueil
                    </a>
                    <a href="<?php echo e(route('products.index', ['category' => 'pigeons'])); ?>" class="mobile-menu-link">
                        <span class="material-symbols-outlined">flutter</span>
                        Pigeons
                    </a>
                    <a href="<?php echo e(route('products.index', ['category' => 'chats'])); ?>" class="mobile-menu-link">
                        <span class="material-symbols-outlined">pets</span>
                        Chats
                    </a>
                    <a href="<?php echo e(route('products.index', ['category' => 'oiseaux'])); ?>" class="mobile-menu-link">
                        <span class="material-symbols-outlined">flutter_dash</span>
                        Oiseaux
                    </a>
                    <a href="<?php echo e(route('home')); ?>#offres" class="mobile-menu-link">
                        <span class="material-symbols-outlined">local_offer</span>
                        Offres
                    </a>
                    <a href="<?php echo e(route('products.index')); ?>" class="mobile-menu-link">
                        <span class="material-symbols-outlined">shopping_bag</span>
                        Tous les produits
                    </a>
                    <a href="<?php echo e(route('home')); ?>#contact" class="mobile-menu-link" onclick="scrollToContact(event)">
                        <span class="material-symbols-outlined">contact_mail</span>
                        Contact
                    </a>
                    
                    <?php if(auth()->guard()->check()): ?>
                        <hr class="my-4 border-gray-200">
                        <div class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            <?php echo e(Auth::user()->name); ?>

                        </div>
                        <a href="<?php echo e(Auth::user()->role === 'admin' ? route('admin.dashboard') : route('dashboard')); ?>" class="mobile-menu-link">
                            <span class="material-symbols-outlined">dashboard</span>
                            Mon Espace
                        </a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="w-full">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="mobile-menu-link text-red-600 hover:bg-red-50 hover:text-red-700 w-full text-left">
                                <span class="material-symbols-outlined">logout</span>
                                Déconnexion
                            </button>
                        </form>
                    <?php else: ?>
                        <hr class="my-4 border-gray-200">
                        <a href="<?php echo e(route('login')); ?>" class="mobile-menu-link text-primary hover:bg-primary/5">
                            <span class="material-symbols-outlined">login</span>
                            Connexion
                        </a>
                        <a href="<?php echo e(route('register')); ?>" class="mobile-menu-link text-primary hover:bg-primary/5">
                            <span class="material-symbols-outlined">person_add</span>
                            Inscription
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer id="contact" class="bg-primary text-on-primary py-16">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <!-- About -->
                <div class="md:col-span-1 text-center md:text-left">
                    <div class="flex items-center gap-3 mb-6 justify-center md:justify-start">
                        <img src="<?php echo e(asset('images/logo animalerie.png')); ?>" alt="Animalerie HMZ" class="h-12 w-auto brightness-0 invert">
                    </div>
                    <h3 class="font-headline text-xl font-bold mb-2">Animalerie HMZ</h3>
                    <p class="text-primary-light text-sm leading-relaxed"><?php echo e($siteSettings['footer_description']); ?></p>
                </div>

                <!-- Quick Links & Categories - 2 colonnes en mobile, 1 colonne chacune en desktop -->
                <div class="grid grid-cols-2 md:grid-cols-1 gap-8 md:gap-0 md:col-span-1">
                    <!-- Quick Links -->
                    <div class="text-center md:text-left">
                        <h3 class="font-bold text-lg mb-4">Liens Rapides</h3>
                        <ul class="space-y-3">
                            <li><a href="<?php echo e(route('home')); ?>" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2 justify-center md:justify-start"><span class="material-symbols-outlined text-sm">chevron_right</span> Accueil</a></li>
                            <li><a href="<?php echo e(route('products.index')); ?>" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2 justify-center md:justify-start"><span class="material-symbols-outlined text-sm">chevron_right</span> Produits</a></li>
                            <li><a href="<?php echo e(route('home')); ?>#offres" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2 justify-center md:justify-start"><span class="material-symbols-outlined text-sm">chevron_right</span> Offres</a></li>
                            <li><a href="#contact" onclick="scrollToContact(event)" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2 justify-center md:justify-start"><span class="material-symbols-outlined text-sm">chevron_right</span> Contact</a></li>
                        </ul>
                    </div>

                    <!-- Categories -->
                    <div class="text-center md:text-left">
                        <h3 class="font-bold text-lg mb-4">Catégories</h3>
                        <ul class="space-y-3">
                            <li><a href="<?php echo e(route('products.index', ['category' => 'chiens'])); ?>" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2 justify-center md:justify-start"><span class="material-symbols-outlined text-sm">chevron_right</span> Chiens</a></li>
                            <li><a href="<?php echo e(route('products.index', ['category' => 'chats'])); ?>" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2 justify-center md:justify-start"><span class="material-symbols-outlined text-sm">chevron_right</span> Chats</a></li>
                            <li><a href="<?php echo e(route('products.index', ['category' => 'oiseaux'])); ?>" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2 justify-center md:justify-start"><span class="material-symbols-outlined text-sm">chevron_right</span> Oiseaux</a></li>
                            <li><a href="<?php echo e(route('products.index', ['category' => 'pigeons'])); ?>" class="text-primary-light hover:text-white transition-colors text-sm flex items-center gap-2 justify-center md:justify-start"><span class="material-symbols-outlined text-sm">chevron_right</span> Pigeons</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact -->
                <div class="text-center md:text-left">
                    <h3 class="font-bold text-lg mb-4">Contact</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-primary-light text-sm justify-center md:justify-start">
                            <span class="material-symbols-outlined text-white">location_on</span>
                            <span>Casablanca, Maroc</span>
                        </li>
                        <li class="flex items-center gap-3 text-primary-light text-sm justify-center md:justify-start">
                            <span class="material-symbols-outlined text-white">phone</span>
                            <span><?php echo e($siteSettings['contact_phone']); ?></span>
                        </li>
                        <li class="flex items-center gap-3 text-primary-light text-sm justify-center md:justify-start">
                            <span class="material-symbols-outlined text-white">mail</span>
                            <span><?php echo e($siteSettings['contact_email']); ?></span>
                        </li>
                    </ul>
                    
                    <!-- Social Media -->
                    <div class="flex gap-3 mt-6 justify-center md:justify-start">
                        <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-colors" aria-label="Facebook">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-colors" aria-label="Instagram">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://wa.me/33123456789" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-lg flex items-center justify-center transition-colors" aria-label="WhatsApp">
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-white/20 pt-8">
                <p class="text-primary-light text-sm text-center md:text-left"><?php echo e($siteSettings['footer_copyright']); ?></p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.querySelector('.mobile-menu');
            const overlay = document.querySelector('.mobile-menu-overlay');
            
            if (menu && overlay) {
                menu.classList.toggle('active');
                overlay.classList.toggle('active');
                
                // Empêcher le scroll du body quand le menu est ouvert
                if (menu.classList.contains('active')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            }
        }

        // Fermer le menu mobile
        function closeMobileMenu() {
            const menu = document.querySelector('.mobile-menu');
            const overlay = document.querySelector('.mobile-menu-overlay');
            
            if (menu && overlay) {
                menu.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }

        // Event listeners pour le menu mobile
        document.addEventListener('DOMContentLoaded', function() {
            // Bouton hamburger
            const menuOpenBtn = document.getElementById('mobileMenuToggle');
            if (menuOpenBtn) {
                menuOpenBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleMobileMenu();
                });
            }
            
            // Bouton fermer
            const menuCloseBtn = document.querySelector('[data-mobile-menu-close]');
            if (menuCloseBtn) {
                menuCloseBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    closeMobileMenu();
                });
            }
            
            // Clic sur l'overlay
            const overlay = document.querySelector('.mobile-menu-overlay');
            if (overlay) {
                overlay.addEventListener('click', closeMobileMenu);
            }
            
            // Fermer le menu quand on clique sur un lien
            const menuLinks = document.querySelectorAll('.mobile-menu-link');
            menuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    closeMobileMenu();
                });
            });
        });

        function scrollToContact(event) {
            event.preventDefault();
            const contactSection = document.getElementById('contact');
            if (contactSection) {
                contactSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            } else {
                // Si on n'est pas sur la page d'accueil, rediriger vers la page d'accueil avec l'ancre
                window.location.href = "<?php echo e(route('home')); ?>#contact";
            }
        }

        // Update cart count from session
        document.addEventListener('DOMContentLoaded', function() {
            // You can fetch cart count via AJAX here
            // For now, it will show 0
        });
    </script>

    <!-- Toast Notifications -->
    <?php echo $__env->make('components.toast-notification', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Cart Management Script -->
    <script src="<?php echo e(asset('js/cart.js')); ?>"></script>
    
    <!-- Mobile Scroll & Product Gallery Script -->
    <script src="<?php echo e(asset('js/testimonials-scroll.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/layouts/app.blade.php ENDPATH**/ ?>