@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
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
    }
    
    .orders-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .orders-table thead {
        background: #F9FAFB;
    }
    
    .orders-table th {
        text-align: left;
        padding: 16px;
        font-size: 12px;
        font-weight: 700;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #E5E7EB;
    }
    
    .orders-table td {
        padding: 16px;
        border-bottom: 1px solid #F3F4F6;
        font-size: 14px;
        color: #374151;
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
        color: #111827;
        font-family: 'Courier New', monospace;
    }
    
    .order-customer {
        font-weight: 600;
        color: #111827;
    }
    
    .order-total {
        font-weight: 700;
        color: #059669;
        white-space: nowrap;
    }
    
    .order-time {
        color: #9CA3AF;
        font-size: 13px;
        white-space: nowrap;
    }
    
    .order-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
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
</style>
@endpush

@section('content')
<div class="dashboard-container">
    
    <!-- Header with Period Selector -->
    <div class="section-header">
        <h2 class="section-title">
            <div class="section-icon"><i class="fas fa-chart-line"></i></div>
            Aperçu de l'activité
        </h2>
        
        <form id="period-form" method="GET" action="{{ route('admin.dashboard') }}">
            <select name="period" class="period-select" onchange="this.form.submit()">
                <option value="today" {{ $stats['period'] === 'today' ? 'selected' : '' }}>Aujourd'hui</option>
                <option value="week" {{ $stats['period'] === 'week' ? 'selected' : '' }}>7 derniers jours</option>
                <option value="month" {{ $stats['period'] === 'month' ? 'selected' : '' }}>Ce mois</option>
                <option value="year" {{ $stats['period'] === 'year' ? 'selected' : '' }}>Cette année</option>
            </select>
        </form>
    </div>

    <!-- ZONE 1: Alerts -->
    <div class="alerts-grid">
        <!-- Out of Stock -->
        <div class="alert-card critical">
            <div class="alert-header">
                <div class="alert-icon critical"><i class="fas fa-exclamation-circle"></i></div>
                <div class="alert-content">
                    <p class="alert-title">Rupture de stock</p>
                    <p class="alert-value">{{ $stats['out_of_stock'] }}</p>
                </div>
            </div>
            <p class="text-sm text-gray-500">Produits nécessitant un réapprovisionnement immédiat.</p>
            <div class="alert-action">
                <a href="{{ route('admin.products.index') }}?stock[]=out_of_stock" class="alert-btn">
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
                    <p class="alert-value">{{ $stats['pending_orders'] }}</p>
                </div>
            </div>
            <p class="text-sm text-gray-500">Nouvelles commandes à confirmer et préparer.</p>
            <div class="alert-action">
                <a href="{{ route('admin.orders.index') }}?status_filter[0]=pending" class="alert-btn">
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
                    <p class="alert-value">{{ $stats['low_stock_products'] }}</p>
                </div>
            </div>
            <p class="text-sm text-gray-500">Produits dont le stock est inférieur au seuil d'alerte.</p>
            <div class="alert-action">
                <a href="{{ route('admin.products.index') }}?stock[]=low_stock" class="alert-btn">
                    <i class="fas fa-list"></i> Voir la liste
                </a>
            </div>
        </div>
    </div>

    <!-- ZONE 2: Metrics -->
    <div class="metrics-grid">
        <!-- Revenue -->
        <div class="metric-card">
            <div class="metric-header">
                <div class="metric-icon" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                    <i class="fas fa-wallet"></i>
                </div>
                <span class="metric-label">Chiffre d'affaires</span>
            </div>
            <p class="metric-value">{{ number_format($stats['total_revenue'], 2) }} DH</p>
            <div class="flex items-center gap-2">
                <span class="metric-trend {{ $stats['revenue_growth'] >= 0 ? 'positive' : 'negative' }}">
                    <i class="fas fa-arrow-{{ $stats['revenue_growth'] >= 0 ? 'up' : 'down' }}"></i> {{ abs($stats['revenue_growth']) }}%
                </span>
                <span class="metric-subtitle">{{ $stats['comparison_label'] }}</span>
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
            <p class="metric-value">{{ $stats['current_orders'] }}</p>
            <div class="flex items-center gap-2">
                <span class="metric-trend {{ $stats['orders_growth'] >= 0 ? 'positive' : 'negative' }}">
                    <i class="fas fa-arrow-{{ $stats['orders_growth'] >= 0 ? 'up' : 'down' }}"></i> {{ abs($stats['orders_growth']) }}%
                </span>
                <span class="metric-subtitle">{{ $stats['comparison_label'] }}</span>
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
            <p class="metric-value">{{ $stats['new_customers'] }}</p>
            <div class="flex items-center gap-2">
                <span class="metric-trend {{ $stats['customers_growth'] >= 0 ? 'positive' : 'negative' }}">
                    <i class="fas fa-user-plus"></i> {{ abs($stats['customers_growth']) }}%
                </span>
                <span class="metric-subtitle">{{ $stats['period'] === 'today' ? 'aujourd\'hui' : 'cette période' }}</span>
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
            <p class="metric-value">{{ $stats['active_products'] }} / {{ $stats['total_products'] }}</p>
            <div class="metric-subtitle">{{ round(($stats['active_products'] / max($stats['total_products'], 1)) * 100, 1) }}% du catalogue total</div>
        </div>
    </div>

    <!-- ZONE 3: Recent Activity -->
    <div class="mb-8">
        <div class="section-header">
            <h2 class="section-title">
                <div class="section-icon"><i class="fas fa-history"></i></div>
                Commandes Récentes
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="section-link">
                Voir toutes les commandes <i class="fas fa-chevron-right"></i>
            </a>
        </div>

        <div class="orders-card">
            <div class="orders-table-container">
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client</th>
                            <th>Total</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td><span class="order-number">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span></td>
                            <td><span class="order-customer">{{ $order->shipping_name }}</span></td>
                            <td><span class="order-total">{{ number_format($order->total, 2) }} DH</span></td>
                            <td>
                                @php
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
                                @endphp
                                <span class="order-status {{ $statusClasses[$order->status] ?? 'status-pending' }}">
                                    <i class="fas {{ $statusIcons[$order->status] ?? 'fa-clock' }}"></i> {{ $statusLabels[$order->status] ?? 'En attente' }}
                                </span>
                            </td>
                            <td>
                                <span class="order-time">
                                    <i class="far fa-clock mr-1"></i> {{ $order->created_at->diffForHumans() }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.orders.show', $order) }}" class="order-action-btn" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2"></i>
                                <p>Aucune commande récente</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection

@push('scripts')
<script>
    // Real-time Dashboard Updates
    let lastUpdateTime = null;
    let updateInterval = null;
    const REFRESH_INTERVAL = 10000; // 10 seconds

    function updateDashboard() {
        fetch('{{ route("admin.dashboard.data") }}', {
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
            html += `
                <tr>
                    <td><span class="order-number">#${order.order_number}</span></td>
                    <td><span class="order-customer">${order.shipping_name}</span></td>
                    <td><span class="order-total">${order.total} DH</span></td>
                    <td>
                        <span class="order-status ${statusClasses[order.status] || 'status-pending'}">
                            <i class="fas ${statusIcons[order.status] || 'fa-clock'}"></i> ${order.status_label}
                        </span>
                    </td>
                    <td>
                        <span class="order-time">
                            <i class="far fa-clock mr-1"></i> ${order.created_at}
                        </span>
                    </td>
                    <td style="text-align: center;">
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
@endpush
