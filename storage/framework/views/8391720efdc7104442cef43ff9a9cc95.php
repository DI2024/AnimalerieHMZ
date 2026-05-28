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
            display: flex;
            flex-direction: column;
        }

        /* Scroll horizontal pour les cartes sur mobile */
        @media (max-width: 767px) {
            .mobile-cards-scroll {
                display: flex !important;
                overflow-x: auto !important;
                scroll-snap-type: x mandatory !important;
                -webkit-overflow-scrolling: touch !important;
                scrollbar-width: none !important;
                gap: 16px !important;
                padding-bottom: 12px !important;
                padding-left: 4px !important;
                padding-right: 4px !important;
            }
            .mobile-cards-scroll::-webkit-scrollbar {
                display: none !important;
            }
            .mobile-cards-scroll > * {
                flex: 0 0 85% !important;
                min-width: 0 !important;
                scroll-snap-align: center !important;
                scroll-snap-stop: always !important;
                margin-bottom: 0 !important;
            }
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
                <img src="<?php echo e(asset('images/logo animalerie.png')); ?>" alt="Logo" class="h-8 w-auto object-contain">
                <span class="text-lg font-extrabold text-gray-900 ml-2">Admin <span class="text-[#003e87]">HMZ</span></span>
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
        <div class="logo-container flex-shrink-0">
            <div class="w-10 h-10 bg-gradient-to-br from-[#003e87] to-[#0855b1] rounded-xl flex items-center justify-center text-white text-xl shadow-lg">
                <i class="fas fa-paw"></i>
            </div>
            <span class="text-xl font-extrabold tracking-tight text-gray-900">Admin <span class="text-[#003e87]">HMZ</span></span>
        </div>
        
        <!-- Conteneur défilant pour éviter les débordements verticaux -->
        <div class="flex-grow overflow-y-auto py-2">
            <nav class="flex flex-col gap-1">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                    <i class="fas fa-grid-2"></i>
                    <span class="font-semibold">Dashboard</span>
                </a>
                
                <div class="px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-widest mt-2">Boutique</div>
                
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
                
                <div class="px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-widest mt-2">Marketing</div>
                
                <a href="<?php echo e(route('admin.offers.index')); ?>" class="nav-link <?php echo e(request()->is('admin/offers*') ? 'active' : ''); ?>">
                    <i class="fas fa-percentage"></i>
                    <span class="font-semibold">Offres & Packs</span>
                </a>
                
                <div class="px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-widest mt-2">Système</div>
                
                <a href="<?php echo e(route('admin.sections.index')); ?>" class="nav-link <?php echo e(request()->is('admin/sections*') ? 'active' : ''); ?>">
                    <i class="fas fa-layer-group"></i>
                    <span class="font-semibold">Sections Accueil</span>
                </a>
                <a href="<?php echo e(route('admin.settings.index')); ?>" class="nav-link <?php echo e(request()->is('admin/settings*') ? 'active' : ''); ?>">
                    <i class="fas fa-cog"></i>
                    <span class="font-semibold">Paramètres</span>
                </a>
            </nav>
        </div>
        
        <div class="p-6 border-t border-gray-200 mt-auto flex-shrink-0 bg-white">
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
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight whitespace-nowrap"><?php echo $__env->yieldContent('page-title', 'Tableau de bord'); ?></h1>
                <p class="text-gray-500 font-medium mt-1">Bienvenue sur votre espace de gestion.</p>
            </div>
            
            <div class="hidden md:flex items-center gap-4">
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

    <!-- Unified Global Table Row Details Modal (Mobile Only) -->
    <div id="mobileRowDetailsModal" class="hidden fixed inset-0 bg-black bg-opacity-60 z-[100] flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all scale-95 duration-200">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-[#003e87] text-white">
                <h3 class="text-lg font-bold flex items-center gap-2">
                    <i class="fas fa-info-circle"></i>
                    Détails
                </h3>
                <button onclick="closeMobileRowDetailsModal()" class="text-white hover:text-gray-200 focus:outline-none p-1 rounded-full hover:bg-white/10 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="p-6 max-h-[60vh] overflow-y-auto space-y-4" id="mobileRowDetailsContent">
                <!-- Key-value pairs loaded here dynamically -->
            </div>
            <!-- Modal Footer (Actions) -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-end gap-3" id="mobileRowDetailsActions">
                <!-- Actions cloned here -->
            </div>
        </div>
    </div>

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

        // Global Table Row Click Listener for Mobile Details Modal
        function closeMobileRowDetailsModal() {
            const modal = document.getElementById('mobileRowDetailsModal');
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Click listener for table rows
            document.body.addEventListener('click', function(e) {
                // Only on mobile
                if (window.innerWidth >= 768) return;

                // Find closest row inside a table body
                const row = e.target.closest('tbody tr');
                if (!row) return;

                const table = row.closest('table');
                if (!table) return;

                // Avoid triggering on table headers or empty state rows
                if (row.classList.contains('empty-state-row') || row.cells.length <= 1) return;

                // Detect if clicked element is an interactive element we want to let through
                const isEyeButton = e.target.closest('.order-action-btn') || 
                                    e.target.closest('.action-btn') ||
                                    e.target.closest('.dropdown-item[onclick*="quickView"]') ||
                                    e.target.classList.contains('fa-eye') || 
                                    e.target.closest('button')?.querySelector('.fa-eye') ||
                                    e.target.closest('a')?.querySelector('.fa-eye');
                
                if (isEyeButton) {
                    // It's the eye button/link! Open modal instead of navigating
                    e.preventDefault();
                    e.stopPropagation();
                } else if (
                    e.target.closest('a') || 
                    e.target.closest('button') || 
                    e.target.closest('input') || 
                    e.target.closest('.dropdown') || 
                    e.target.closest('label') || 
                    e.target.closest('form')
                ) {
                    // Let default browser click actions work on other items (toggles, edit, delete, etc.)
                    return;
                }

                // Gather headers and cell values
                const headers = Array.from(table.querySelectorAll('thead th')).map(th => th.textContent.trim());
                const cells = Array.from(row.cells);

                if (headers.length === 0 || cells.length === 0) return;

                let contentHtml = '<div class="divide-y divide-gray-100">';
                let actionsHtml = '';

                cells.forEach((cell, idx) => {
                    // Ignore index column or checkboxes
                    const header = headers[idx] || '';
                    if (!header && idx === 0) return;

                    const clone = cell.cloneNode(true);
                    
                    // Unhide any hidden responsive/normal elements so they show in details modal
                    clone.querySelectorAll('.hidden, [class*="hidden"]').forEach(el => {
                        el.classList.remove('hidden', 'md:block', 'md:flex', 'md:table-cell', 'lg:block', 'lg:flex');
                    });
                    
                    // Identify if cell is an Action cell
                    const hasButtons = clone.querySelector('a, button, form');
                    const isActionHeader = header.toLowerCase() === 'actions' || header.toLowerCase() === 'action';

                    if (idx === cells.length - 1 || isActionHeader || hasButtons) {
                        // Action buttons
                        actionsHtml = clone.innerHTML;
                    } else {
                        // Standard details
                        const val = clone.innerHTML.trim();
                        contentHtml += `
                            <div class="py-3 flex flex-col gap-1">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">${header || 'Champ'}</span>
                                <div class="text-sm font-medium text-gray-800">${val}</div>
                            </div>
                        `;
                    }
                });

                contentHtml += '</div>';

                // Display in modal
                document.getElementById('mobileRowDetailsContent').innerHTML = contentHtml;
                
                const footerActions = document.getElementById('mobileRowDetailsActions');
                if (actionsHtml.trim() || row.classList.contains('clickable-row')) {
                    footerActions.innerHTML = actionsHtml;
                    
                    // Automatically unwrap dropdown menus to show direct buttons in the modal footer
                    const dropdownMenu = footerActions.querySelector('.dropdown-menu');
                    if (dropdownMenu) {
                        let items = Array.from(dropdownMenu.querySelectorAll('.dropdown-item, a.dropdown-item'));
                        
                        // Filter category action items to display only Modifier and Supprimer
                        if (row.closest('#categories-table')) {
                            items = items.filter(item => {
                                const text = item.textContent.trim().toLowerCase();
                                return !text.includes('aperçu') && !text.includes('produits');
                            });
                        }
                        
                        const flexContainer = document.createElement('div');
                        flexContainer.className = 'flex flex-wrap gap-2 w-full justify-end';
                        
                        items.forEach(item => {
                            const btn = item.cloneNode(true);
                            btn.className = 'px-3 py-2 rounded-lg text-sm font-semibold flex items-center gap-1.5 transition-colors border ';
                            
                            const text = item.textContent.trim().toLowerCase();
                            if (text.includes('supprimer')) {
                                btn.className += 'bg-red-50 text-red-600 border-red-200 hover:bg-red-100';
                            } else if (text.includes('modifier') || text.includes('éditer')) {
                                btn.className += 'bg-blue-50 text-blue-600 border-blue-200 hover:bg-blue-100';
                            } else if (text.includes('aperçu') || text.includes('détails')) {
                                btn.className += 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100';
                            } else {
                                btn.className += 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100';
                            }
                            
                            // If it has onclick or is a div, make sure click triggers it and closes the modal
                            const onclickAttr = item.getAttribute('onclick');
                            if (item.tagName === 'DIV' || item.onclick || onclickAttr) {
                                btn.style.cursor = 'pointer';
                                btn.addEventListener('click', function(e) {
                                    closeMobileRowDetailsModal();
                                    if (item.onclick) {
                                        item.onclick();
                                    } else if (onclickAttr) {
                                        new Function(onclickAttr)();
                                    }
                                });
                            }
                            
                            flexContainer.appendChild(btn);
                        });
                        
                        footerActions.innerHTML = '';
                        footerActions.appendChild(flexContainer);
                    }
                    
                    // If the row was clickable itself (e.g. Orders index), add "Voir Détails" button
                    if (row.classList.contains('clickable-row') && row.dataset.href) {
                        const viewBtn = document.createElement('a');
                        viewBtn.href = row.dataset.href;
                        viewBtn.className = 'px-4 py-2 bg-[#003e87] text-white rounded-lg text-sm font-medium inline-flex items-center gap-2';
                        viewBtn.innerHTML = '<i class="fas fa-eye"></i> Voir Détails';
                        footerActions.appendChild(viewBtn);
                    }
                    
                    footerActions.classList.remove('hidden');
                } else {
                    footerActions.innerHTML = '';
                    footerActions.classList.add('hidden');
                }

                // Show the modal
                const modal = document.getElementById('mobileRowDetailsModal');
                if (modal) {
                    modal.classList.remove('hidden');
                    document.body.style.overflow = 'hidden';
                }
            });

            // Close on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeMobileRowDetailsModal();
                }
            });

            // Close on backdrop click
            const modal = document.getElementById('mobileRowDetailsModal');
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        closeMobileRowDetailsModal();
                    }
                });
            }
        });

        // Click handler for clickable rows on desktop
        document.addEventListener('click', function(e) {
            const row = e.target.closest('.clickable-row');
            if (!row) return;

            const href = row.dataset.href;
            if (!href) return;

            if (window.innerWidth >= 768) {
                // If clicking inside interactive elements, don't trigger row navigation
                if (
                    e.target.closest('a') || 
                    e.target.closest('button') || 
                    e.target.closest('input') || 
                    e.target.closest('.dropdown') || 
                    e.target.closest('label') || 
                    e.target.closest('form')
                ) {
                    return;
                }
                window.location.href = href;
            }
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/layouts/admin.blade.php ENDPATH**/ ?>