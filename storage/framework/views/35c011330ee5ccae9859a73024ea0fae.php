<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Simplified Dashboard Styles */
    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
    }
    
    /* ZONE 1: Alerts */
    .alerts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }
    
    /* Mobile: Scroll horizontal pour alerts */
    @media (max-width: 767px) {
        .alerts-grid {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            gap: 16px;
            padding-bottom: 16px;
        }
        
        .alerts-grid::-webkit-scrollbar {
            display: none;
        }
        
        .alert-card {
            flex: 0 0 85%;
            scroll-snap-align: center;
            scroll-snap-stop: always;
        }
    }
    
    .alert-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .alert-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
    }
    
    .alert-card.critical {
        border-left: 4px solid #EF4444;
        background: linear-gradient(135deg, #FEE2E2 0%, #ffffff 100%);
    }
    
    .alert-card.warning {
        border-left: 4px solid #F59E0B;
        background: linear-gradient(135deg, #FEF3C7 0%, #ffffff 100%);
    }
    
    .alert-card.info {
        border-left: 4px solid #3B82F6;
        background: linear-gradient(135deg, #DBEAFE 0%, #ffffff 100%);
    }
    
    .alert-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 16px;
    }
    
    .alert-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        flex-shrink: 0;
    }
    
    .alert-icon.critical {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
    }
    
    .alert-icon.warning {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
    }
    
    .alert-icon.info {
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    }
    
    .alert-content {
        flex: 1;
    }
    
    .alert-title {
        font-size: 14px;
        font-weight: 600;
        color: #6B7280;
        margin-bottom: 4px;
    }
    
    .alert-value {
        font-size: 32px;
        font-weight: 800;
        color: #111827;
        line-height: 1;
    }
    
    .alert-action {
        margin-top: 16px;
    }
    
    .alert-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: linear-gradient(135deg, #003e87 0%, #0855b1 100%);
        color: white;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .alert-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 62, 135, 0.4);
    }
    
    /* ZONE 2: Metrics */
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }
    
    /* Mobile: Scroll horizontal pour metrics */
    @media (max-width: 767px) {
        .metrics-grid {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            gap: 16px;
            padding-bottom: 16px;
        }
        
        .metrics-grid::-webkit-scrollbar {
            display: none;
        }
        
        .metric-card {
            flex: 0 0 85%;
            scroll-snap-align: center;
            scroll-snap-stop: always;
        }
    }
    
    .metric-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .metric-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }
    
    .metric-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }
    
    .metric-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }
    
    .metric-label {
        font-size: 13px;
        font-weight: 600;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .metric-value {
        font-size: 36px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 8px;
        line-height: 1;
    }
    
    .metric-trend {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
    }
    
    .metric-trend.positive {
        background: #D1FAE5;
        color: #059669;
    }
    
    .metric-trend.negative {
        background: #FEE2E2;
        color: #DC2626;
    }
    
    .metric-subtitle {
        font-size: 13px;
        color: #9CA3AF;
        margin-top: 8px;
    }
    
    /* Section Headers */
    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    
    .section-title {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .section-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: linear-gradient(135deg, #003e87 0%, #0855b1 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 16px;
    }
    
    /* Period Selector */
    .period-select {
        padding: 8px 16px;
        border: 2px solid #E5E7EB;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        background: white;
        cursor: pointer;
        transition: all 0.2s;
        outline: none;
    }
    
    .period-select:hover {
        border-color: #003e87;
    }
    
    .period-select:focus {
        border-color: #003e87;
        box-shadow: 0 0 0 3px rgba(0, 62, 135, 0.1);
    }
    
    #period-form {
        margin: 0;
    }
    
    .section-link {
        color: #3B82F6;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    
    .section-link:hover {
        color: #2563EB;
        gap: 8px;
    }
    
    /* Recent Orders Table */
    .orders-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .orders-table-container {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .orders-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }
    
    /* Mobile: Affichage en cartes - DESACTIVE pour conserver le format tableau épuré */
    @media (max-width: 767px) {
        .orders-table {
            min-width: 100%;
        }
    }
    
    .orders-table thead {
        background: #F9FAFB;
    }
    
    .orders-table th {
        text-align: left;
        padding: 12px 8px;
        font-size: 11px;
        font-weight: 700;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #E5E7EB;
    }
    @media (min-width: 768px) {
        .orders-table th {
            padding: 16px;
            font-size: 12px;
        }
    }
    
    .orders-table td {
        padding: 12px 8px;
        border-bottom: 1px solid #F3F4F6;
        font-size: 13px;
        color: #374151;
    }
    @media (min-width: 768px) {
        .orders-table td {
            padding: 16px;
            font-size: 14px;
        }
    }
    
    .orders-table tbody tr {
        transition: all 0.2s;
    }
    
    .orders-table tbody tr:hover {
        background: #F9FAFB;
    }
    
    .orders-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .order-number {
        font-weight: 700;
        color: #003e87;
        font-family: inherit;
        font-size: 13px;
    }
    @media (min-width: 768px) {
        .order-number {
            font-size: 14px;
        }
    }
    
    .order-customer {
        font-weight: 600;
        color: #111827;
    }
    
    .order-total {
        font-weight: 700;
        color: #111827;
        white-space: nowrap;
        font-size: 13px;
    }
    @media (min-width: 768px) {
        .order-total {
            font-size: 15px;
        }
    }
    
    .order-time {
        color: #9CA3AF;
        font-size: 10px;
        white-space: nowrap;
    }
    @media (min-width: 768px) {
        .order-time {
            font-size: 13px;
        }
    }
    
    .order-status {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        white-space: nowrap;
    }
    @media (min-width: 768px) {
        .order-status {
            gap: 6px;
            padding: 6px 12px;
            font-size: 12px;
        }
    }
    
    .status-pending { background: #FEF3C7; color: #92400E; }
    .status-confirmed { background: #DBEAFE; color: #1E40AF; }
    .status-delivered { background: #D1FAE5; color: #065F46; }
    .status-cancelled { background: #FEE2E2; color: #B91C1C; }
    
    .order-action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: #F3F4F6;
        color: #6B7280;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .order-action-btn:hover {
        background: #E5E7EB;
        color: #111827;
        transform: scale(1.1);
    }
    
    /* Indicateurs (dots) pour mobile */
    .dashboard-indicators {
        display: none;
        justify-content: center;
        gap: 8px;
        margin-top: 16px;
        margin-bottom: 16px;
    }
    
    @media (max-width: 767px) {
        .dashboard-indicators {
            display: flex;
        }
    }
    
    .dashboard-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #d1d5db;
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .dashboard-dot.active {
        width: 24px;
        border-radius: 4px;
        background-color: #003e87;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    
    <!-- Header with Period Selector -->
    <div class="section-header">
        <h2 class="section-title">
            <div class="section-icon"><i class="fas fa-chart-line"></i></div>
            Aperçu de l'activité
        </h2>
    </div>

    <!-- ZONE 1: Alerts -->
    <div class="alerts-grid" id="alertsGrid">
        <!-- Out of Stock -->
        <div class="alert-card critical">
            <div class="alert-header">
                <div class="alert-icon critical"><i class="fas fa-exclamation-circle"></i></div>
                <div class="alert-content">
                    <p class="alert-title">Rupture de stock</p>
                    <p class="alert-value"><?php echo e($stats['out_of_stock']); ?></p>
                </div>
            </div>
            <p class="text-sm text-gray-500">Produits nécessitant un réapprovisionnement immédiat.</p>
            <div class="alert-action">
                <a href="<?php echo e(route('admin.products.index')); ?>?stock[]=out_of_stock" class="alert-btn">
                    <i class="fas fa-boxes"></i> Gérer le stock
                </a>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="alert-card warning">
            <div class="alert-header">
                <div class="alert-icon warning"><i class="fas fa-clock"></i></div>
                <div class="alert-content">
                    <p class="alert-title">Commandes en attente</p>
                    <p class="alert-value"><?php echo e($stats['pending_orders']); ?></p>
                </div>
            </div>
            <p class="text-sm text-gray-500">Nouvelles commandes à confirmer et préparer.</p>
            <div class="alert-action">
                <a href="<?php echo e(route('admin.orders.index')); ?>?status_filter[0]=pending" class="alert-btn">
                    <i class="fas fa-shopping-bag"></i> Voir les commandes
                </a>
            </div>
        </div>

        <!-- Low Stock -->
        <div class="alert-card info">
            <div class="alert-header">
                <div class="alert-icon info"><i class="fas fa-info-circle"></i></div>
                <div class="alert-content">
                    <p class="alert-title">Stock faible</p>
                    <p class="alert-value"><?php echo e($stats['low_stock_products']); ?></p>
                </div>
            </div>
            <p class="text-sm text-gray-500">Produits dont le stock est inférieur au seuil d'alerte.</p>
            <div class="alert-action">
                <a href="<?php echo e(route('admin.products.index')); ?>?stock[]=low_stock" class="alert-btn">
                    <i class="fas fa-list"></i> Voir la liste
                </a>
            </div>
        </div>
    </div>
    
    <!-- Indicateurs pour alerts (mobile uniquement) -->
    <div class="dashboard-indicators" id="alertsIndicators"></div>

    <!-- ZONE 2: Metrics Header & Period Dropdown -->
    <div class="flex justify-end items-center mb-4 mt-6">
        <select onchange="changeDashboardPeriod(this.value)" class="period-select" style="padding: 6px 12px; font-size: 14px; font-weight: 600; border-color: #E5E7EB; background-color: white; border-radius: 8px; width: auto;">
            <option value="today" <?php echo e($stats['period'] === 'today' ? 'selected' : ''); ?>>Jour</option>
            <option value="week" <?php echo e($stats['period'] === 'week' ? 'selected' : ''); ?>>Semaine</option>
            <option value="month" <?php echo e($stats['period'] === 'month' ? 'selected' : ''); ?>>Mois</option>
        </select>
    </div>

    <!-- ZONE 2: Metrics -->
    <div class="metrics-grid" id="metricsGrid">
        <!-- Revenue -->
        <div class="metric-card">
            <div class="metric-header">
                <div class="metric-icon" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                    <i class="fas fa-wallet"></i>
                </div>
                <span class="metric-label">Chiffre d'affaires</span>
            </div>
            <p class="metric-value"><?php echo e(number_format($stats['total_revenue'], 2)); ?> DH</p>
            <div class="flex items-center gap-2">
                <span class="metric-trend <?php echo e($stats['revenue_growth'] >= 0 ? 'positive' : 'negative'); ?>">
                    <i class="fas fa-arrow-<?php echo e($stats['revenue_growth'] >= 0 ? 'up' : 'down'); ?>"></i> <?php echo e(abs($stats['revenue_growth'])); ?>%
                </span>
                <span class="metric-subtitle"><?php echo e($stats['comparison_label']); ?></span>
            </div>
        </div>

        <!-- Orders -->
        <div class="metric-card">
            <div class="metric-header">
                <div class="metric-icon" style="background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <span class="metric-label">Commandes</span>
            </div>
            <p class="metric-value"><?php echo e($stats['current_orders']); ?></p>
            <div class="flex items-center gap-2">
                <span class="metric-trend <?php echo e($stats['orders_growth'] >= 0 ? 'positive' : 'negative'); ?>">
                    <i class="fas fa-arrow-<?php echo e($stats['orders_growth'] >= 0 ? 'up' : 'down'); ?>"></i> <?php echo e(abs($stats['orders_growth'])); ?>%
                </span>
                <span class="metric-subtitle"><?php echo e($stats['comparison_label']); ?></span>
            </div>
        </div>

        <!-- Customers -->
        <div class="metric-card">
            <div class="metric-header">
                <div class="metric-icon" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
                    <i class="fas fa-users"></i>
                </div>
                <span class="metric-label">Nouveaux clients</span>
            </div>
            <p class="metric-value"><?php echo e($stats['new_customers']); ?></p>
            <div class="flex items-center gap-2">
                <span class="metric-trend <?php echo e($stats['customers_growth'] >= 0 ? 'positive' : 'negative'); ?>">
                    <i class="fas fa-user-plus"></i> <?php echo e(abs($stats['customers_growth'])); ?>%
                </span>
                <span class="metric-subtitle"><?php echo e($stats['period'] === 'today' ? 'aujourd\'hui' : 'cette période'); ?></span>
            </div>
        </div>

        <!-- Products -->
        <div class="metric-card">
            <div class="metric-header">
                <div class="metric-icon" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
                    <i class="fas fa-paw"></i>
                </div>
                <span class="metric-label">Produits actifs</span>
            </div>
            <p class="metric-value"><?php echo e($stats['active_products']); ?> / <?php echo e($stats['total_products']); ?></p>
            <div class="metric-subtitle"><?php echo e(round(($stats['active_products'] / max($stats['total_products'], 1)) * 100, 1)); ?>% du catalogue total</div>
        </div>
    </div>
    
    <!-- Indicateurs pour metrics (mobile uniquement) -->
    <div class="dashboard-indicators" id="metricsIndicators"></div>

    <!-- ZONE 3: Recent Activity -->
    <div class="mb-8">
        <div class="section-header">
            <h2 class="section-title">
                <div class="section-icon"><i class="fas fa-history"></i></div>
                Commandes Récentes
            </h2>
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="section-link">
                Voir toutes les commandes <i class="fas fa-chevron-right"></i>
            </a>
        </div>

        <div class="orders-card">
            <div class="orders-table-container">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>N° Commande</th>
                            <th class="hidden md:table-cell">Client</th>
                            <th>Total</th>
                            <th>Statut</th>
                            <th class="hidden md:table-cell">Date</th>
                            <th class="hidden md:table-cell" style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 clickable-row cursor-pointer" data-href="<?php echo e(route('admin.orders.show', $order)); ?>">
                            <td data-label="N° Commande">
                                <div class="flex items-center gap-1 md:gap-2">
                                    <i class="fas fa-hashtag text-gray-400 text-[10px] md:text-xs"></i>
                                    <span class="text-[#003e87] font-semibold hidden md:inline"><?php echo e($order->order_number); ?></span>
                                    <span class="text-[#003e87] font-semibold text-xs md:text-sm md:hidden">...<?php echo e(substr($order->order_number, -3)); ?></span>
                                </div>
                                <p class="text-[10px] md:text-xs text-gray-500 mt-1 md:hidden">
                                    <i class="far fa-clock mr-1 text-[10px] md:text-xs"></i> 
                                    <?php echo e($order->created_at->diffForHumans()); ?>

                                </p>
                            </td>
                            <td class="hidden md:table-cell" data-label="Client"><span class="order-customer"><?php echo e($order->shipping_name); ?></span></td>
                            <td data-label="Total"><span class="order-total text-sm md:text-lg font-bold text-gray-900"><?php echo e(number_format($order->total, 2)); ?> DH</span></td>
                            <td data-label="Statut">
                                <?php
                                    $statusClasses = [
                                        'pending' => 'status-pending',
                                        'processing' => 'status-pending',
                                        'confirmed' => 'status-confirmed',
                                        'shipped' => 'status-confirmed',
                                        'delivered' => 'status-delivered',
                                        'cancelled' => 'status-cancelled',
                                    ];
                                    $statusIcons = [
                                        'pending' => 'fa-clock',
                                        'processing' => 'fa-cog',
                                        'confirmed' => 'fa-check-circle',
                                        'shipped' => 'fa-truck',
                                        'delivered' => 'fa-check-double',
                                        'cancelled' => 'fa-times-circle',
                                    ];
                                    $statusLabels = [
                                        'pending' => 'En attente',
                                        'processing' => 'En traitement',
                                        'confirmed' => 'Confirmée',
                                        'shipped' => 'Expédiée',
                                        'delivered' => 'Livrée',
                                        'cancelled' => 'Annulée',
                                    ];
                                ?>
                                <span class="order-status <?php echo e($statusClasses[$order->status] ?? 'status-pending'); ?>">
                                    <i class="fas <?php echo e($statusIcons[$order->status] ?? 'fa-clock'); ?>"></i> <span><?php echo e($statusLabels[$order->status] ?? 'En attente'); ?></span>
                                </span>
                            </td>
                            <td class="hidden md:table-cell" data-label="Date">
                                <span class="order-time">
                                    <i class="far fa-clock mr-1"></i> <?php echo e($order->created_at->diffForHumans()); ?>

                                </span>
                            </td>
                            <td class="hidden md:table-cell">
                                <a href="<?php echo e(route('admin.orders.show', $order)); ?>" class="order-action-btn" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2"></i>
                                <p>Aucune commande récente</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Change dashboard statistics period
    function changeDashboardPeriod(period) {
        const url = new URL(window.location.href);
        url.searchParams.set('period', period);
        window.location.href = url.toString();
    }
    // Dashboard Scroll Indicators (Mobile)
    function initDashboardScrollIndicators() {
        if (window.innerWidth > 767) return;

        // Alerts indicators
        initScrollIndicators('alertsGrid', 'alertsIndicators', '.alert-card');
        
        // Metrics indicators
        initScrollIndicators('metricsGrid', 'metricsIndicators', '.metric-card');
    }

    function initScrollIndicators(containerId, indicatorsId, itemSelector) {
        const container = document.getElementById(containerId);
        const indicatorsContainer = document.getElementById(indicatorsId);
        
        if (!container || !indicatorsContainer) return;

        const items = container.querySelectorAll(itemSelector);
        const count = items.length;

        if (count <= 1) return;

        // Créer les dots
        indicatorsContainer.innerHTML = '';
        for (let i = 0; i < count; i++) {
            const dot = document.createElement('div');
            dot.className = 'dashboard-dot';
            if (i === 0) dot.classList.add('active');
            indicatorsContainer.appendChild(dot);
        }

        // Mettre à jour les dots lors du scroll
        let scrollTimeout;
        container.addEventListener('scroll', function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(function() {
                const scrollLeft = container.scrollLeft;
                const itemWidth = items[0].offsetWidth;
                const gap = parseFloat(getComputedStyle(container).gap) || 16;
                const currentIndex = Math.round(scrollLeft / (itemWidth + gap));

                const dots = indicatorsContainer.querySelectorAll('.dashboard-dot');
                dots.forEach((dot, index) => {
                    if (index === currentIndex) {
                        dot.classList.add('active');
                    } else {
                        dot.classList.remove('active');
                    }
                });
            }, 100);
        });
    }

    // Initialiser au chargement
    document.addEventListener('DOMContentLoaded', function() {
        initDashboardScrollIndicators();
    });

    // Réinitialiser lors du redimensionnement
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            initDashboardScrollIndicators();
        }, 250);
    });

    // Real-time Dashboard Updates
    let lastUpdateTime = null;
    let updateInterval = null;
    const REFRESH_INTERVAL = 10000; // 10 seconds

    function updateDashboard() {
        fetch('<?php echo e(route("admin.dashboard.data")); ?>', {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update pending orders count
            const pendingElement = document.querySelector('.alert-card.warning .alert-value');
            if (pendingElement) {
                const currentCount = parseInt(pendingElement.textContent);
                const newCount = data.pending_orders;
                
                if (currentCount !== newCount) {
                    pendingElement.textContent = newCount;
                    pendingElement.classList.add('animate-pulse');
                    setTimeout(() => pendingElement.classList.remove('animate-pulse'), 1000);
                    
                    // Show notification if new orders
                    if (newCount > currentCount) {
                        showNotification(`${newCount - currentCount} nouvelle(s) commande(s) reçue(s)!`, 'success');
                        playNotificationSound();
                    }
                }
            }

            // Update recent orders table
            updateOrdersTable(data.recent_orders);
            
            lastUpdateTime = new Date(data.timestamp);
            updateLastRefreshIndicator();
        })
        .catch(error => {
            console.error('Error updating dashboard:', error);
        });
    }

    function updateOrdersTable(orders) {
        const tbody = document.querySelector('.orders-table tbody');
        if (!tbody || orders.length === 0) return;

        const statusClasses = {
            'pending': 'status-pending',
            'processing': 'status-pending',
            'confirmed': 'status-confirmed',
            'shipped': 'status-confirmed',
            'delivered': 'status-delivered',
            'cancelled': 'status-cancelled',
        };

        const statusIcons = {
            'pending': 'fa-clock',
            'processing': 'fa-cog',
            'confirmed': 'fa-check-circle',
            'shipped': 'fa-truck',
            'delivered': 'fa-check-double',
            'cancelled': 'fa-times-circle',
        };

        let html = '';
        orders.forEach(order => {
            const shortNum = order.order_number.length > 3 ? order.order_number.substring(order.order_number.length - 3) : order.order_number;
            html += `
                <tr class="hover:bg-gray-50 clickable-row cursor-pointer" data-href="${order.url}">
                    <td data-label="N° Commande">
                        <div class="flex items-center gap-1 md:gap-2">
                            <i class="fas fa-hashtag text-gray-400 text-[10px] md:text-xs"></i>
                            <span class="text-[#003e87] font-semibold hidden md:inline">${order.order_number}</span>
                            <span class="text-[#003e87] font-semibold text-xs md:text-sm md:hidden">...${shortNum}</span>
                        </div>
                        <p class="text-[10px] md:text-xs text-gray-500 mt-1 md:hidden">
                            <i class="far fa-clock mr-1 text-[10px] md:text-xs"></i> 
                            ${order.created_at}
                        </p>
                    </td>
                    <td class="hidden md:table-cell" data-label="Client"><span class="order-customer">${order.shipping_name}</span></td>
                    <td data-label="Total"><span class="order-total text-sm md:text-lg font-bold text-gray-900">${order.total} DH</span></td>
                    <td data-label="Statut">
                        <span class="order-status ${statusClasses[order.status] || 'status-pending'}">
                            <i class="fas ${statusIcons[order.status] || 'fa-clock'}"></i> <span>${order.status_label}</span>
                        </span>
                    </td>
                    <td class="hidden md:table-cell" data-label="Date">
                        <span class="order-time">
                            <i class="far fa-clock mr-1"></i> ${order.created_at}
                        </span>
                    </td>
                    <td class="hidden md:table-cell" style="text-align: center;">
                        <a href="${order.url}" class="order-action-btn" title="Voir détails">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            `;
        });

        tbody.innerHTML = html;
    }

    function updateLastRefreshIndicator() {
        let indicator = document.getElementById('last-refresh-indicator');
        if (!indicator) {
            indicator = document.createElement('div');
            indicator.id = 'last-refresh-indicator';
            indicator.style.cssText = 'position: fixed; bottom: 20px; right: 20px; background: rgba(0,0,0,0.7); color: white; padding: 8px 16px; border-radius: 20px; font-size: 12px; z-index: 1000; display: flex; align-items: center; gap: 8px;';
            document.body.appendChild(indicator);
        }
        
        const now = new Date();
        const diff = Math.floor((now - lastUpdateTime) / 1000);
        indicator.innerHTML = `
            <i class="fas fa-sync-alt" style="animation: spin 2s linear infinite;"></i>
            Mis à jour il y a ${diff}s
        `;
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#10B981' : '#3B82F6'};
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            z-index: 10000;
            font-weight: 600;
            animation: slideIn 0.3s ease-out;
        `;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'}" style="margin-right: 8px;"></i>
            ${message}
        `;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.animation = 'slideOut 0.3s ease-in';
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }

    function playNotificationSound() {
        // Create a simple beep sound
        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const oscillator = audioContext.createOscillator();
        const gainNode = audioContext.createGain();
        
        oscillator.connect(gainNode);
        gainNode.connect(audioContext.destination);
        
        oscillator.frequency.value = 800;
        oscillator.type = 'sine';
        
        gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
        gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);
        
        oscillator.start(audioContext.currentTime);
        oscillator.stop(audioContext.currentTime + 0.5);
    }

    // Add CSS animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(400px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(400px); opacity: 0; }
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-pulse {
            animation: pulse 0.5s ease-in-out;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); color: #10B981; }
        }
    `;
    document.head.appendChild(style);

    // Start auto-refresh when page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Initial update after 2 seconds
        setTimeout(() => {
            updateDashboard();
            // Then update every 10 seconds
            updateInterval = setInterval(updateDashboard, REFRESH_INTERVAL);
        }, 2000);

        // Update indicator every second
        setInterval(() => {
            if (lastUpdateTime) {
                updateLastRefreshIndicator();
            }
        }, 1000);

        // Pause updates when tab is not visible
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                if (updateInterval) {
                    clearInterval(updateInterval);
                    updateInterval = null;
                }
            } else {
                updateDashboard();
                updateInterval = setInterval(updateDashboard, REFRESH_INTERVAL);
            }
        });
    });

    // Clean up on page unload
    window.addEventListener('beforeunload', function() {
        if (updateInterval) {
            clearInterval(updateInterval);
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>