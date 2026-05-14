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
        background: linear-gradient(135deg, #d4af37 0%, #f59e0b 100%);
        color: white;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .alert-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(212, 175, 55, 0.4);
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
        background: linear-gradient(135deg, #d4af37 0%, #f59e0b 100%);
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
        border-color: #d4af37;
    }
    
    .period-select:focus {
        border-color: #d4af37;
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
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
        
        <form id="period-form">
            <select name="period" class="period-select" onchange="this.form.submit()">
                <option value="today" selected>Aujourd'hui</option>
                <option value="week">7 derniers jours</option>
                <option value="month">Ce mois</option>
                <option value="year">Cette année</option>
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
                    <p class="alert-value">5</p>
                </div>
            </div>
            <p class="text-sm text-gray-500">Produits nécessitant un réapprovisionnement immédiat.</p>
            <div class="alert-action">
                <a href="#" class="alert-btn">
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
                    <p class="alert-value">8</p>
                </div>
            </div>
            <p class="text-sm text-gray-500">Nouvelles commandes à confirmer et préparer.</p>
            <div class="alert-action">
                <a href="#" class="alert-btn">
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
                    <p class="alert-value">12</p>
                </div>
            </div>
            <p class="text-sm text-gray-500">Produits dont le stock est inférieur au seuil d'alerte.</p>
            <div class="alert-action">
                <a href="#" class="alert-btn">
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
            <p class="metric-value">12,450 DH</p>
            <div class="flex items-center gap-2">
                <span class="metric-trend positive">
                    <i class="fas fa-arrow-up"></i> 15.4%
                </span>
                <span class="metric-subtitle">vs hier</span>
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
            <p class="metric-value">24</p>
            <div class="flex items-center gap-2">
                <span class="metric-trend positive">
                    <i class="fas fa-arrow-up"></i> 8.2%
                </span>
                <span class="metric-subtitle">vs hier</span>
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
            <p class="metric-value">45</p>
            <div class="flex items-center gap-2">
                <span class="metric-trend positive">
                    <i class="fas fa-user-plus"></i> 12%
                </span>
                <span class="metric-subtitle">ce mois</span>
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
            <p class="metric-value">145 / 160</p>
            <div class="metric-subtitle">90.6% du catalogue total</div>
        </div>
    </div>

    <!-- ZONE 3: Recent Activity -->
    <div class="mb-8">
        <div class="section-header">
            <h2 class="section-title">
                <div class="section-icon"><i class="fas fa-history"></i></div>
                Commandes Récentes
            </h2>
            <a href="#" class="section-link">
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
                        <!-- Mock Row 1 -->
                        <tr>
                            <td><span class="order-number">#ORD-1024</span></td>
                            <td><span class="order-customer">Ahmed Alaoui</span></td>
                            <td><span class="order-total">450.00 DH</span></td>
                            <td>
                                <span class="order-status status-pending">
                                    <i class="fas fa-clock"></i> En attente
                                </span>
                            </td>
                            <td>
                                <span class="order-time">
                                    <i class="far fa-clock mr-1"></i> Il y a 15 min
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <a href="#" class="order-action-btn" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Mock Row 2 -->
                        <tr>
                            <td><span class="order-number">#ORD-1023</span></td>
                            <td><span class="order-customer">Sara Mansouri</span></td>
                            <td><span class="order-total">890.50 DH</span></td>
                            <td>
                                <span class="order-status status-confirmed">
                                    <i class="fas fa-check-circle"></i> Confirmée
                                </span>
                            </td>
                            <td>
                                <span class="order-time">
                                    <i class="far fa-clock mr-1"></i> Il y a 2h
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <a href="#" class="order-action-btn" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <!-- Mock Row 3 -->
                        <tr>
                            <td><span class="order-number">#ORD-1022</span></td>
                            <td><span class="order-customer">Karim Benjelloun</span></td>
                            <td><span class="order-total">120.00 DH</span></td>
                            <td>
                                <span class="order-status status-delivered">
                                    <i class="fas fa-check-double"></i> Livrée
                                </span>
                            </td>
                            <td>
                                <span class="order-time">
                                    <i class="far fa-clock mr-1"></i> Il y a 5h
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <a href="#" class="order-action-btn" title="Voir détails">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
@endsection
