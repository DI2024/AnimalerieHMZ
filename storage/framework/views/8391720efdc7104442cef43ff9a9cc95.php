<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Admin - <?php echo $__env->yieldContent('title', 'Dashboard'); ?> | Animalerie HMZ</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo animalerie.png')); ?>">
    
    <!-- Material Symbols -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS (via CDN for now as requested for front-end focus) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F9FAFB;
        }
        
        .sidebar {
            width: 280px;
            height: 100vh;
            background: #FFFFFF;
            color: #1F2937;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 50;
            border-right: 1px solid #E5E7EB;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
            transition: transform 0.3s ease-in-out;
        }
        
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            padding: 40px;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #6B7280;
            text-decoration: none;
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }
        
        .nav-link:hover {
            background: #F3F4F6;
            color: #111827;
        }
        
        .nav-link.active {
            background: #EEF2FF;
            color: #003e87;
            border-left-color: #003e87;
        }
        
        .logo-container {
            padding: 32px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid #E5E7EB;
            margin-bottom: 24px;
        }
        
        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
        }
        
        .mobile-navbar {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 64px;
            background: white;
            border-bottom: 1px solid #E5E7EB;
            z-index: 70;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .mobile-navbar-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            padding: 0 16px;
        }
        
        .mobile-navbar .hamburger-btn {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #F3F4F6;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .mobile-navbar .hamburger-btn:hover {
            background: #E5E7EB;
        }
        
        .mobile-navbar .logo-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .mobile-navbar .logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #003e87 0%, #0855b1 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }
        
        .mobile-navbar .logout-btn {
            width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #FEE2E2;
            color: #DC2626;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        
        .mobile-navbar .logout-btn:hover {
            background: #FEE2E2;
            transform: scale(1.05);
        }
        
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 40;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }
        
        .sidebar-overlay.active {
            opacity: 1;
        }
        
        /* Mobile Responsive */
        @media (max-width: 1024px) {
            .mobile-navbar {
                display: block;
            }
            
            .sidebar {
                transform: translateX(-100%);
                z-index: 60;
                top: 64px;
                height: calc(100vh - 64px);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 80px 16px 20px 16px;
            }
            
            .mobile-menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 44px;
                height: 44px;
                background: white;
                border: 1px solid #E5E7EB;
                border-radius: 12px;
                cursor: pointer;
                transition: all 0.2s;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            }
            
            .mobile-menu-btn:hover {
                background: #F3F4F6;
            }
            
            .sidebar-overlay {
                display: block;
                pointer-events: none;
                top: 64px;
            }
            
            .sidebar-overlay.active {
                pointer-events: auto;
            }
            
            /* Header mobile */
            header h1 {
                font-size: 1.5rem !important;
            }
            
            header p {
                font-size: 0.875rem !important;
                display: none;
            }
            
            .admin-avatar {
                display: none;
            }
        }
        
        @media (max-width: 640px) {
            .main-content {
                padding: 80px 12px 16px 12px;
            }
            
            header h1 {
                font-size: 1.25rem !important;
            }
            
            .mobile-navbar .logo-center span {
                display: none;
            }
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Mobile Navbar (visible uniquement en mobile) -->
    <nav class="mobile-navbar">
        <div class="mobile-navbar-content">
            <!-- Hamburger (Gauche) -->
            <button class="hamburger-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars text-gray-700 text-lg"></i>
            </button>
            
            <!-- Logo (Centre) -->
            <div class="logo-center">
                <div class="logo-icon">
                    <i class="fas fa-paw"></i>
                </div>
                <span class="text-lg font-extrabold text-gray-900">Admin <span class="text-[#003e87]">HMZ</span></span>
            </div>
            
            <!-- Déconnexion (Droite) -->
            <form method="POST" action="<?php echo e(route('logout')); ?>" style="margin: 0;">
                <?php echo csrf_field(); ?>
                <button type="submit" class="logout-btn" title="Déconnexion">
                    <i class="fas fa-sign-out-alt text-lg"></i>
                </button>
            </form>
        </div>
    </nav>
    
    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
    
    <!-- Sidebar -->
    <aside class="sidebar" id="adminSidebar">
        <div class="logo-container">
            <div class="w-10 h-10 bg-gradient-to-br from-[#003e87] to-[#0855b1] rounded-xl flex items-center justify-center text-white text-xl shadow-lg">
                <i class="fas fa-paw"></i>
            </div>
            <span class="text-xl font-extrabold tracking-tight text-gray-900">Admin <span class="text-[#003e87]">HMZ</span></span>
        </div>
        
        <nav class="flex flex-col gap-1">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                <i class="fas fa-grid-2"></i>
                <span class="font-semibold">Dashboard</span>
            </a>
            
            <div class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest mt-4">Boutique</div>
            
            <a href="<?php echo e(route('admin.products.index')); ?>" class="nav-link <?php echo e(request()->is('admin/products*') ? 'active' : ''); ?>">
                <i class="fas fa-box"></i>
                <span class="font-semibold">Produits</span>
            </a>
            <a href="<?php echo e(route('admin.categories.index')); ?>" class="nav-link <?php echo e(request()->is('admin/categories*') ? 'active' : ''); ?>">
                <i class="fas fa-tags"></i>
                <span class="font-semibold">Catégories</span>
            </a>
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="nav-link <?php echo e(request()->is('admin/orders*') ? 'active' : ''); ?>">
                <i class="fas fa-shopping-cart"></i>
                <span class="font-semibold">Commandes</span>
            </a>
            
            <div class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest mt-4">Marketing</div>
            
            <a href="<?php echo e(route('admin.offers.index')); ?>" class="nav-link <?php echo e(request()->is('admin/offers*') ? 'active' : ''); ?>">
                <i class="fas fa-percentage"></i>
                <span class="font-semibold">Offres & Packs</span>
            </a>
            
            <div class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest mt-4">Système</div>
            
            <a href="<?php echo e(route('admin.sections.index')); ?>" class="nav-link <?php echo e(request()->is('admin/sections*') ? 'active' : ''); ?>">
                <i class="fas fa-layer-group"></i>
                <span class="font-semibold">Sections Accueil</span>
            </a>
            <a href="<?php echo e(route('admin.settings.index')); ?>" class="nav-link <?php echo e(request()->is('admin/settings*') ? 'active' : ''); ?>">
                <i class="fas fa-cog"></i>
                <span class="font-semibold">Paramètres</span>
            </a>
        </nav>
        
        <div class="absolute bottom-0 w-full p-6 border-t border-gray-200">
            <a href="/" class="flex items-center gap-3 text-gray-500 hover:text-[#003e87] transition text-sm font-bold">
                <i class="fas fa-external-link-alt"></i>
                Voir le site
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <header class="flex justify-between items-center mb-6 md:mb-10">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight"><?php echo $__env->yieldContent('page-title', 'Tableau de bord'); ?></h1>
                <p class="text-gray-500 font-medium mt-1">Bienvenue sur votre espace de gestion.</p>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="admin-avatar flex items-center gap-3 pl-4">
                    <div class="text-right">
                        <div class="text-sm font-bold text-gray-900">Administrateur</div>
                        <div class="text-xs font-medium text-green-500">En ligne</div>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-[#003e87] flex items-center justify-center text-white font-bold text-lg shadow-lg">
                        A
                    </div>
                </div>
            </div>
        </header>

        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            
            // Empêcher le scroll du body quand le menu est ouvert
            if (sidebar.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }
        
        // Fermer la sidebar quand on clique sur un lien (mobile)
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 1024) {
                        toggleSidebar();
                    }
                });
            });
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/layouts/admin.blade.php ENDPATH**/ ?>