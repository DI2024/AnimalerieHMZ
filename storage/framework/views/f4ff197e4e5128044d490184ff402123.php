<?php $__env->startSection('title', 'Commandes'); ?>
<?php $__env->startSection('page-title', 'Gestion des Commandes'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Statistics Cards */
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 600;
    }
    @media (min-width: 768px) {
        .status-badge {
            gap: 6px;
            padding: 6px 12px;
            font-size: 12px;
        }
    }
    .status-pending { background: #FEF3C7; color: #92400E; }
    .status-confirmed { background: #DBEAFE; color: #1E40AF; }
    .status-delivered { background: #D1FAE5; color: #065F46; }
    .status-cancelled { background: #FEE2E2; color: #991B1B; }
    
    /* Filter Chips */
    .filter-chip {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        background: #F3F4F6;
        border: 1px solid #E5E7EB;
        border-radius: 20px;
        font-size: 13px;
        color: #374151;
        font-weight: 500;
    }
    .filter-chip:hover {
        background: #E5E7EB;
    }
    
    /* Customer Avatar */
    .customer-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #003e87 0%, #0855b1 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 14px;
    }
    
    /* Payment Method Icons */
    .payment-icon {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        background: #F3F4F6;
        border-radius: 6px;
        font-size: 11px;
        color: #6B7280;
    }
    
    /* Table Hover */
    tbody tr {
        transition: all 0.2s ease;
    }
    tbody tr:hover {
        background: #F9FAFB;
        cursor: pointer;
    }
    
    /* Action Buttons */
    .action-btn {
        padding: 8px 12px;
        border-radius: 8px;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .action-btn:hover {
        transform: scale(1.05);
    }
    
    /* Filter Sidebar Wrapper - desktop behavior */
    @media (min-width: 1024px) {
        .filter-sidebar-wrapper {
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .filter-sidebar-wrapper.hidden {
            width: 0 !important;
            margin: 0 !important;
            opacity: 0;
        }
    }
    
    /* Mobile Filter Bottom Sheet */
    @media (max-width: 1023px) {
        /* Wrapper overlay */
        .filter-sidebar-wrapper {
            position: fixed !important;
            inset: 0 !important;
            z-index: 1000 !important;
            pointer-events: none !important;
            opacity: 0 !important;
            transition: opacity 0.3s ease !important;
            display: block !important;
            width: 100% !important;
            height: 100% !important;
            max-width: 100% !important;
            margin: 0 !important;
        }
        
        .filter-sidebar-wrapper:not(.hidden) {
            pointer-events: all !important;
            opacity: 1 !important;
        }
        
        .filter-sidebar-wrapper::before {
            content: '' !important;
            position: absolute !important;
            inset: 0 !important;
            background: rgba(0, 0, 0, 0.5) !important;
            opacity: 0 !important;
            transition: opacity 0.3s ease !important;
        }
        
        .filter-sidebar-wrapper:not(.hidden)::before {
            opacity: 1 !important;
        }
        
        .filter-sidebar {
            position: absolute !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            top: auto !important;
            height: auto !important;
            max-height: 85vh !important;
            width: 100% !important;
            box-shadow: 0 -4px 24px rgba(0, 0, 0, 0.15) !important;
            border-radius: 24px 24px 0 0 !important;
            transform: translateY(100%) !important;
            transition: transform 0.3s ease !important;
            overflow-y: auto !important;
            z-index: 1010 !important;
        }
        
        .filter-sidebar-wrapper:not(.hidden) .filter-sidebar {
            transform: translateY(0) !important;
        }
    }
    
    .filter-toggle-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        background: #F3F4F6;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        cursor: pointer;
        transition: all 0.2s;
    }
    .filter-toggle-btn:hover {
        background: #E5E7EB;
        border-color: #D1D5DB;
    }
    .filter-toggle-btn.has-filters {
        background: #DBEAFE;
        border-color: #93C5FD;
        color: #1E40AF;
    }
    .filter-toggle-btn.has-filters:hover {
        background: #BFDBFE;
    }
    .filter-count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 20px;
        height: 20px;
        padding: 0 6px;
        background: #003e87;
        color: white;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .orders-content {
        transition: all 0.3s ease;
    }
    
    /* Hide mobile-specific truncated elements inside mobile row details modal */
    #mobileRowDetailsContent [class*="md:hidden"] {
        display: none !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mobile-cards-scroll">
        <!-- Total Orders -->
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Commandes</p>
                    <h3 class="text-3xl font-bold text-gray-900"><?php echo e(number_format($stats['total'])); ?></h3>
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="fas fa-chart-line mr-1"></i>
                        Toutes les commandes
                    </p>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);">
                    <i class="fas fa-shopping-cart text-white"></i>
                </div>
            </div>
        </div>
        
        <!-- Pending Orders -->
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">En Attente</p>
                    <h3 class="text-3xl font-bold text-amber-600"><?php echo e(number_format($stats['pending'])); ?></h3>
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="fas fa-clock mr-1"></i>
                        Nécessite action
                    </p>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
                    <i class="fas fa-hourglass-half text-white"></i>
                </div>
            </div>
        </div>
        
        <!-- Total Revenue -->
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Revenu Total</p>
                    <h3 class="text-3xl font-bold text-green-600"><?php echo e(number_format($stats['revenue'], 2)); ?></h3>
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="fas fa-coins mr-1"></i>
                        DH (livrées + expédiées)
                    </p>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                    <i class="fas fa-dollar-sign text-white"></i>
                </div>
            </div>
        </div>
        
        <!-- Average Order Value -->
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Panier Moyen</p>
                    <h3 class="text-3xl font-bold text-purple-600"><?php echo e(number_format($stats['average'], 2)); ?></h3>
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="fas fa-calculator mr-1"></i>
                        DH par commande
                    </p>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%);">
                    <i class="fas fa-chart-bar text-white"></i>
                </div>
            </div>
        </div>
    </div>
    
    <?php
        $filterCount = 0;
        if(request('status_filter')) $filterCount += count(request('status_filter'));
        if(request('date_from') || request('date_to')) $filterCount++;
        if(request('amount_min') || request('amount_max')) $filterCount++;
        if(request('payment_filter')) $filterCount += count(request('payment_filter'));
    ?>

    <!-- Search Bar & Quick Filters - Desktop -->
    <div class="hidden md:block bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex flex-wrap gap-4 items-center">
            <!-- Filter Toggle Button -->
            <button type="button" id="filterToggleBtn" onclick="toggleFilterSidebar()" 
                    class="filter-toggle-btn <?php echo e(request()->hasAny(['status_filter', 'date_from', 'date_to', 'amount_min', 'amount_max', 'payment_filter']) ? 'has-filters' : ''); ?>">
                <i class="fas fa-sliders-h"></i>
                <span id="filterToggleText">Masquer les filtres</span>
                <?php if($filterCount > 0): ?>
                    <span class="filter-count-badge"><?php echo e($filterCount); ?></span>
                <?php endif; ?>
            </button>
            
            <!-- Search -->
            <div class="flex-1 min-w-[300px]">
                <form method="GET" action="<?php echo e(route('admin.orders.index')); ?>" class="relative">
                    <!-- Preserve existing filters -->
                    <?php $__currentLoopData = request()->except(['search', 'page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(is_array($value)): ?>
                            <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="<?php echo e($key); ?>[]" value="<?php echo e($item); ?>">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" placeholder="Rechercher par N° commande, nom, email, téléphone..." 
                           value="<?php echo e(request('search')); ?>"
                           class="w-full pl-11 pr-24 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#003e87] focus:border-transparent">
                    <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 px-4 py-1.5 bg-[#003e87] text-white rounded-md hover:bg-[#0855b1] text-sm font-medium transition-colors">
                        <i class="fas fa-search mr-1"></i>Rechercher
                    </button>
                </form>
            </div>
            
            <!-- Quick Filter Buttons - Desktop (Aujourd'hui and Calendrier) -->
            <div class="flex gap-2">
                <a href="<?php echo e(route('admin.orders.index', ['date_from' => date('Y-m-d'), 'date_to' => date('Y-m-d')])); ?>" 
                   class="px-4 py-2 text-sm bg-gray-100 hover:bg-[#003e87] hover:text-white rounded-lg transition-colors flex items-center gap-2">
                    <i class="fas fa-calendar-day"></i>
                    Aujourd'hui
                </a>
                <div class="relative inline-block">
                    <input type="date" onchange="applyCalendarFilter(this.value)" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                    <button type="button" class="px-4 py-2 text-sm bg-gray-100 hover:bg-[#003e87] hover:text-white rounded-lg transition-colors flex items-center gap-2">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Calendrier</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Bar & Quick Filters - Mobile -->
    <div class="block md:hidden bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex flex-col gap-4">
            <!-- 1. Search Input (no inline button) -->
            <div>
                <form id="mobileSearchForm" method="GET" action="<?php echo e(route('admin.orders.index')); ?>" class="relative">
                    <!-- Preserve existing filters -->
                    <?php $__currentLoopData = request()->except(['search', 'page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(is_array($value)): ?>
                            <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <input type="hidden" name="<?php echo e($key); ?>[]" value="<?php echo e($item); ?>">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" placeholder="Rechercher par N° commande, nom..." 
                           value="<?php echo e(request('search')); ?>"
                           class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#003e87] focus:border-transparent">
                </form>
            </div>

            <!-- 3. Filter Toggle Button and Search Button side-by-side (Bottom part) -->
            <div class="flex gap-2 w-full">
                <button type="button" onclick="toggleFilterSidebar()" 
                        class="flex-1 filter-toggle-btn flex items-center justify-center gap-2 py-2.5 text-sm <?php echo e(request()->hasAny(['status_filter', 'date_from', 'date_to', 'amount_min', 'amount_max', 'payment_filter']) ? 'has-filters' : ''); ?>">
                    <i class="fas fa-sliders-h"></i>
                    <span>Filtres</span>
                    <?php if($filterCount > 0): ?>
                        <span class="filter-count-badge"><?php echo e($filterCount); ?></span>
                    <?php endif; ?>
                </button>
                <button type="submit" form="mobileSearchForm" 
                        class="flex-1 px-4 py-2.5 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] text-sm font-semibold flex items-center justify-center gap-2 transition-colors">
                    <i class="fas fa-search"></i>
                    Rechercher
                </button>
            </div>
        </div>
    </div>
    
    <!-- Main Content: Filter Sidebar + Orders Table -->
    <div class="flex gap-6">
        <!-- Filter Sidebar (Left) -->
        <div class="w-64 flex-shrink-0 filter-sidebar-wrapper" id="filterSidebarWrapper">
            <?php echo $__env->make('admin.orders.partials.filter-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
        
        <!-- Orders Content (Right) -->
        <div class="flex-1 space-y-6 orders-content" id="ordersContent">
            
            <!-- Active Filter Chips -->
            <?php if(request()->hasAny(['status_filter', 'date_from', 'date_to', 'amount_min', 'amount_max', 'payment_filter', 'search'])): ?>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-sm font-medium text-gray-700">
                            <i class="fas fa-filter mr-1"></i>
                            Filtres actifs:
                        </span>
                        
                        <?php if(request('search')): ?>
                            <span class="filter-chip">
                                <i class="fas fa-search mr-1"></i>
                                Recherche: "<?php echo e(request('search')); ?>"
                                <a href="<?php echo e(route('admin.orders.index', array_merge(request()->except('search')))); ?>" class="ml-2 hover:text-red-600">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        <?php endif; ?>
                        
                        <?php if(request('status_filter')): ?>
                            <?php $__currentLoopData = request('status_filter'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="filter-chip">
                                    Statut: <?php echo e(ucfirst($status)); ?>

                                    <a href="<?php echo e(route('admin.orders.index', array_merge(request()->except('status_filter'), ['status_filter' => array_diff(request('status_filter'), [$status])]))); ?>" 
                                       class="ml-2 hover:text-red-600">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        
                        <?php if(request('date_from') || request('date_to')): ?>
                            <span class="filter-chip">
                                <i class="fas fa-calendar mr-1"></i>
                                Période: <?php echo e(request('date_from')); ?> - <?php echo e(request('date_to')); ?>

                                <a href="<?php echo e(route('admin.orders.index', request()->except(['date_from', 'date_to']))); ?>" class="ml-2 hover:text-red-600">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        <?php endif; ?>
                        
                        <?php if(request('amount_min') || request('amount_max')): ?>
                            <span class="filter-chip">
                                <i class="fas fa-dollar-sign mr-1"></i>
                                Montant: <?php echo e(request('amount_min', 0)); ?> - <?php echo e(request('amount_max', '∞')); ?> DH
                                <a href="<?php echo e(route('admin.orders.index', request()->except(['amount_min', 'amount_max']))); ?>" class="ml-2 hover:text-red-600">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        <?php endif; ?>
                        
                        <?php if(request('payment_filter')): ?>
                            <?php $__currentLoopData = request('payment_filter'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="filter-chip">
                                    Paiement: <?php echo e(ucfirst($payment)); ?>

                                    <a href="<?php echo e(route('admin.orders.index', array_merge(request()->except('payment_filter'), ['payment_filter' => array_diff(request('payment_filter'), [$payment])]))); ?>" 
                                       class="ml-2 hover:text-red-600">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        
                        <a href="<?php echo e(route('admin.orders.index')); ?>" class="ml-auto text-sm text-red-600 hover:text-red-800 font-medium">
                            <i class="fas fa-times-circle mr-1"></i>
                            Tout effacer
                        </a>
                    </div>
                </div>
            <?php endif; ?>
    
    <!-- Orders Table -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full md:min-w-[800px]">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-2 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        N° Commande
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:table-cell">
                        Client
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:table-cell">
                        Date
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider hidden md:table-cell">
                        Articles
                    </th>
                    <th class="px-2 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Total
                    </th>
                    <th class="px-2 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Statut
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-gray-50 cursor-pointer clickable-row" data-href="<?php echo e(route('admin.orders.show', $order->id)); ?>">
                    <td class="px-2 md:px-6 py-3 md:py-4 whitespace-nowrap">
                        <div class="flex items-center gap-1 md:gap-2">
                            <i class="fas fa-hashtag text-gray-400 text-[10px] md:text-xs"></i>
                            <span class="text-[#003e87] font-semibold hidden md:inline"><?php echo e($order->order_number); ?></span>
                            <span class="text-[#003e87] font-semibold text-xs md:text-sm md:hidden">...<?php echo e(substr($order->order_number, -3)); ?></span>
                        </div>
                        <p class="text-[10px] md:text-xs text-gray-500 mt-1">
                            <i class="far fa-clock mr-1 text-[10px] md:text-xs"></i> 
                            <?php echo e($order->created_at->diffForHumans()); ?>

                        </p>
                    </td>
                    <td class="px-6 py-4 hidden md:table-cell">
                        <div class="flex items-center gap-3">
                            <div class="customer-avatar hidden md:flex">
                                <?php echo e(strtoupper(substr($order->shipping_first_name ?? 'U', 0, 1))); ?><?php echo e(strtoupper(substr($order->shipping_last_name ?? 'N', 0, 1))); ?>

                            </div>
                            <div>
                                <p class="font-medium text-gray-900">
                                    <?php echo e($order->shipping_first_name); ?> <?php echo e($order->shipping_last_name); ?>

                                </p>
                                <p class="text-xs text-gray-500 hidden md:block">
                                    <i class="far fa-envelope mr-1"></i><?php echo e($order->shipping_email); ?>

                                </p>
                                <?php if($order->shipping_phone): ?>
                                <p class="text-xs text-gray-500 hidden md:block">
                                    <i class="fas fa-phone mr-1"></i><?php echo e($order->shipping_phone); ?>

                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                        <div class="text-sm">
                            <p class="font-medium text-gray-900"><?php echo e($order->created_at->format('d/m/Y')); ?></p>
                            <p class="text-gray-500"><?php echo e($order->created_at->format('H:i')); ?></p>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap hidden md:table-cell">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-box text-gray-400"></i>
                            <span class="font-medium text-gray-900"><?php echo e($order->items->count()); ?></span>
                            <span class="text-xs text-gray-500">article(s)</span>
                        </div>
                    </td>
                    <td class="px-2 md:px-6 py-3 md:py-4 whitespace-nowrap">
                        <p class="text-sm md:text-lg font-bold text-gray-900"><?php echo e(number_format($order->total, 2)); ?> DH</p>
                    </td>
                    <td class="px-2 md:px-6 py-3 md:py-4 whitespace-nowrap">
                        <?php
                            $statusClasses = [
                                'pending' => 'status-pending',
                                'confirmed' => 'status-confirmed',
                                'processing' => 'status-confirmed',
                                'shipped' => 'status-confirmed',
                                'delivered' => 'status-delivered',
                                'cancelled' => 'status-cancelled',
                            ];
                            $statusIcons = [
                                'pending' => 'fa-clock',
                                'confirmed' => 'fa-check-circle',
                                'processing' => 'fa-cog',
                                'shipped' => 'fa-truck',
                                'delivered' => 'fa-check-double',
                                'cancelled' => 'fa-times-circle',
                            ];
                            $statusLabels = [
                                'pending' => 'En attente',
                                'confirmed' => 'Confirmée',
                                'processing' => 'En traitement',
                                'shipped' => 'Expédiée',
                                'delivered' => 'Livrée',
                                'cancelled' => 'Annulée',
                            ];
                        ?>
                        <span class="status-badge <?php echo e($statusClasses[$order->status] ?? 'status-pending'); ?>">
                            <i class="fas <?php echo e($statusIcons[$order->status] ?? 'fa-clock'); ?>"></i>
                            <span><?php echo e($statusLabels[$order->status] ?? ucfirst($order->status)); ?></span>
                        </span>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-2"></i>
                        <p>Aucune commande trouvée</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <?php if($orders->hasPages()): ?>
    <div class="mt-6 flex justify-center">
        <?php echo e($orders->links()); ?>

    </div>
    <?php endif; ?>
    
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Filtrage calendrier
    function applyCalendarFilter(dateValue) {
        if (!dateValue) return;
        const url = new URL(window.location.href);
        url.searchParams.set('date_from', dateValue);
        url.searchParams.set('date_to', dateValue);
        url.searchParams.delete('page');
        window.location.href = url.toString();
    }

    // Toggle Filter Sidebar
    function toggleFilterSidebar() {
        const wrapper = document.getElementById('filterSidebarWrapper');
        const btnText = document.getElementById('filterToggleText');
        const isHidden = wrapper.classList.contains('hidden');
        
        if (isHidden) {
            // Show sidebar
            wrapper.classList.remove('hidden');
            if (btnText) btnText.textContent = 'Masquer les filtres';
            localStorage.setItem('orderFilterSidebarVisible', 'true');
            
            // Close on overlay click (mobile only)
            if (window.innerWidth < 1024) {
                const clickHandler = function(e) {
                    if (e.target === wrapper) {
                        toggleFilterSidebar();
                        wrapper.removeEventListener('click', clickHandler);
                    }
                };
                wrapper.addEventListener('click', clickHandler);
            }
        } else {
            // Hide sidebar
            wrapper.classList.add('hidden');
            if (btnText) btnText.textContent = 'Afficher les filtres';
            localStorage.setItem('orderFilterSidebarVisible', 'false');
        }
    }
    
    // Restore sidebar state from localStorage
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarVisible = localStorage.getItem('orderFilterSidebarVisible');
        
        // Default to visible, hide only if explicitly set to false
        if (sidebarVisible === 'false') {
            const wrapper = document.getElementById('filterSidebarWrapper');
            const btnText = document.getElementById('filterToggleText');
            wrapper.classList.add('hidden');
            btnText.textContent = 'Afficher les filtres';
        }
        
        // Auto-hide on mobile screens
        if (window.innerWidth < 1024) {
            const wrapper = document.getElementById('filterSidebarWrapper');
            const btnText = document.getElementById('filterToggleText');
            wrapper.classList.add('hidden');
            btnText.textContent = 'Afficher les filtres';
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>