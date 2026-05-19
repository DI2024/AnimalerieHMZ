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
        
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
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
        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight"><?php echo $__env->yieldContent('page-title', 'Tableau de bord'); ?></h1>
                <p class="text-gray-500 font-medium mt-1">Bienvenue sur votre espace de gestion.</p>
            </div>
            
            <div class="flex items-center gap-4">
                <button class="w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center text-gray-500 hover:text-[#003e87] transition">
                    <i class="fas fa-bell"></i>
                </button>
                <div class="flex items-center gap-3 pl-4 border-l border-gray-200">
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

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/layouts/admin.blade.php ENDPATH**/ ?>