@extends('layouts.admin')

@section('title', 'Offres')
@section('page-title', 'Gestion des Offres')

@push('styles')
<style>
    /* Statistics Cards */
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    /* Layout with Sidebar */
    .content-with-sidebar {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 24px;
        align-items: start;
    }
    @media (max-width: 1024px) {
        .content-with-sidebar {
            grid-template-columns: 1fr;
        }
    }
    
    /* Filter Chips */
    .filter-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 16px;
    }
    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: #fef3c7;
        color: #92400e;
        border-radius: 9999px;
        font-size: 13px;
        font-weight: 500;
    }
    .filter-chip button {
        background: none;
        border: none;
        color: inherit;
        cursor: pointer;
        padding: 0;
        display: flex;
        align-items: center;
    }
    
    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 500;
        gap: 4px;
    }
    .status-active { background: #d1fae5; color: #065f46; }
    .status-expiring { background: #fef3c7; color: #92400e; }
    .status-expired { background: #fee2e2; color: #991b1b; }
    .status-inactive { background: #f3f4f6; color: #4b5563; }
    
    /* Countdown Timer */
    .countdown {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        color: #059669;
        background: #d1fae5;
        padding: 2px 8px;
        border-radius: 4px;
    }
    .countdown.warning { color: #d97706; background: #fef3c7; }
    .countdown.danger { color: #dc2626; background: #fee2e2; }
    
    /* Bulk Action Bar */
    .bulk-action-bar {
        position: fixed;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%);
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        padding: 16px 24px;
        display: none;
        align-items: center;
        gap: 16px;
        z-index: 50;
        min-width: 600px;
    }
    .bulk-action-bar.active {
        display: flex;
    }
    
    /* Quick Actions Dropdown */
    .dropdown {
        position: relative;
    }
    .dropdown-menu {
        position: absolute;
        right: 0;
        top: 100%;
        margin-top: 8px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        min-width: 200px;
        display: none;
        z-index: 10;
    }
    .dropdown-menu.active {
        display: block;
    }
    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: #374151;
        text-decoration: none;
        transition: background 0.2s;
        cursor: pointer;
    }
    .dropdown-item:hover {
        background: #f3f4f6;
    }
    .dropdown-item:first-child {
        border-radius: 8px 8px 0 0;
    }
    .dropdown-item:last-child {
        border-radius: 0 0 8px 8px;
    }
    .dropdown-divider {
        height: 1px;
        background: #e5e7eb;
        margin: 4px 0;
    }
    
    /* Type Filter */
    .type-filter {
        display: flex;
        gap: 8px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 4px;
        background: #f9fafb;
    }
    .type-filter button {
        padding: 8px 16px;
        background: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 14px;
        font-weight: 500;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .type-filter button:hover {
        background: #f3f4f6;
        color: #374151;
    }
    .type-filter button.active {
        background: #d4af37;
        color: white;
        box-shadow: 0 2px 4px rgba(212, 175, 55, 0.3);
    }
    .type-filter .count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 20px;
        height: 20px;
        padding: 0 6px;
        background: rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        font-size: 11px;
        font-weight: 600;
    }
    .type-filter button.active .count-badge {
        background: rgba(255, 255, 255, 0.3);
    }
    
    /* View Toggle */
    .view-toggle {
        display: flex;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
    }
    .view-toggle button {
        padding: 8px 16px;
        background: white;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    .view-toggle button.active {
        background: #d4af37;
        color: white;
    }
    
    /* Grid View */
    .offers-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    
    /* Responsive breakpoints */
    @media (max-width: 1400px) {
        .offers-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .offers-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .offer-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .offer-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        border-color: #d4af37;
    }
    
    /* Line clamp utility */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Inline Edit */
    .inline-edit {
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 4px;
        transition: background 0.2s;
    }
    .inline-edit:hover {
        background: #f3f4f6;
    }
    .inline-edit-input {
        padding: 4px 8px;
        border: 2px solid #d4af37;
        border-radius: 4px;
        font-size: inherit;
        font-weight: inherit;
    }
    
    /* Details Modal */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        backdrop-filter: blur(4px);
    }
    .modal-overlay.hidden {
        display: none;
    }
    .modal-container {
        background: white;
        border-radius: 16px;
        max-width: 1200px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: modalSlideIn 0.3s ease-out;
    }
    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 24px;
        border-bottom: 1px solid #e5e7eb;
        position: sticky;
        top: 0;
        background: white;
        z-index: 10;
    }
    .close-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f4f6;
        color: #6b7280;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    .close-btn:hover {
        background: #e5e7eb;
        color: #374151;
    }
    .modal-body {
        padding: 24px;
    }
    .modal-grid {
        display: grid;
        grid-template-columns: 60% 40%;
        gap: 24px;
    }
    .modal-left, .modal-right {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    /* Modal Sections */
    .modal-section {
        background: #f9fafb;
        border-radius: 12px;
        padding: 20px;
    }
    .modal-section-title {
        font-size: 14px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    /* Pack Image */
    .pack-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .pack-image-placeholder {
        width: 100%;
        height: 300px;
        background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 80px;
        color: white;
    }
    
    /* Pricing Card */
    .pricing-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    .pricing-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .pricing-row:last-child {
        border-bottom: none;
    }
    .pricing-row.highlight {
        background: #d1fae5;
        margin: 0 -20px;
        padding: 12px 20px;
        border-radius: 8px;
        border-bottom: none;
    }
    
    /* Products Grid */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 16px;
        margin-top: 16px;
    }
    .product-card-modal {
        background: white;
        border-radius: 8px;
        padding: 12px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s;
    }
    .product-card-modal:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .product-card-modal img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 6px;
        margin-bottom: 8px;
    }
    .product-card-modal h4 {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 4px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .product-card-modal .price {
        font-size: 16px;
        font-weight: 700;
        color: #d4af37;
        margin-bottom: 4px;
    }
    .product-card-modal .discounted-price {
        font-size: 14px;
        color: #10b981;
        font-weight: 600;
    }
    .product-card-modal .original-price {
        font-size: 12px;
        color: #9ca3af;
        text-decoration: line-through;
    }
    .category-badge-modal {
        display: inline-block;
        padding: 4px 8px;
        background: #e5e7eb;
        color: #6b7280;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 500;
    }
    
    /* Categories List */
    .categories-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 16px;
    }
    .category-item {
        background: white;
        padding: 12px 16px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    .category-item-name {
        font-weight: 600;
        color: #374151;
    }
    .category-item-count {
        background: #e5e7eb;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        color: #6b7280;
    }
    
    /* Info Rows */
    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #e5e7eb;
    }
    .info-row:last-child {
        border-bottom: none;
    }
    .info-label {
        color: #6b7280;
        font-size: 14px;
    }
    .info-value {
        color: #374151;
        font-weight: 600;
        font-size: 14px;
    }
    
    /* Action Buttons */
    .modal-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    .modal-action-btn {
        padding: 12px 16px;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .modal-action-btn.full-width {
        grid-column: 1 / -1;  /* Span all columns for delete button */
    }
    .modal-action-btn.primary {
        background: #d4af37;
        color: white;
    }
    .modal-action-btn.primary:hover {
        background: #c19b2e;
    }
    .modal-action-btn.secondary {
        background: #f3f4f6;
        color: #374151;
    }
    .modal-action-btn.secondary:hover {
        background: #e5e7eb;
    }
    .modal-action-btn.danger {
        background: #fee2e2;
        color: #dc2626;
    }
    .modal-action-btn.danger:hover {
        background: #fecaca;
    }
    
    /* Type Badges */
    .type-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
    }
    .badge-pack {
        background: #e9d5ff;
        color: #7c3aed;
    }
    .badge-percentage {
        background: #dbeafe;
        color: #2563eb;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .modal-grid {
            grid-template-columns: 1fr;
        }
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .modal-actions {
            grid-template-columns: 1fr;  /* Stack all buttons on mobile */
        }
        .modal-action-btn.full-width {
            grid-column: 1;  /* Reset to single column on mobile */
        }
    }
</style>
@endpush

@section('content')
<div class="space-y-6">
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Offres</p>
                    <p class="text-3xl font-bold text-gray-900">12</p>
                </div>
                <div class="stat-icon bg-blue-100 text-blue-600">
                    <i class="fas fa-tags"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Offres Actives</p>
                    <p class="text-3xl font-bold text-green-600">8</p>
                </div>
                <div class="stat-icon bg-green-100 text-green-600">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Expire Bientôt</p>
                    <p class="text-3xl font-bold text-yellow-600">3</p>
                    <p class="text-xs text-gray-500 mt-1">< 7 jours</p>
                </div>
                <div class="stat-icon bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Revenu des Packs</p>
                    <p class="text-3xl font-bold text-green-600">15,400.00</p>
                    <p class="text-xs text-gray-500 mt-1">Commandes confirmées</p>
                </div>
                <div class="stat-icon bg-green-100 text-green-600">
                    <i class="fas fa-box-open"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Search & Actions Bar -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="flex items-center gap-3 flex-1 flex-wrap">
                <!-- Search -->
                <div class="relative flex-1 max-w-md">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" 
                           id="searchInput" 
                           class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" 
                           placeholder="Rechercher par nom..."
                           value="{{ request('search') }}">
                </div>
                
                <!-- Type Filter -->
                <div class="type-filter">
                    <button onclick="filterByType('all')" id="filterAll" class="active">
                        <i class="fas fa-th-large"></i>
                        <span>Tout</span>
                        <span class="count-badge" id="countAll">{{ $stats['total'] }}</span>
                    </button>
                    <button onclick="filterByType('pack')" id="filterPack">
                        <i class="fas fa-box-open"></i>
                        <span>Packs</span>
                        <span class="count-badge" id="countPack">0</span>
                    </button>
                    <button onclick="filterByType('offer')" id="filterOffer">
                        <i class="fas fa-percent"></i>
                        <span>Offres</span>
                        <span class="count-badge" id="countOffer">0</span>
                    </button>
                </div>
                
                <!-- View Toggle -->
                <div class="view-toggle">
                    <button onclick="switchView('table')" id="tableViewBtn" class="active">
                        <i class="fas fa-list"></i>
                    </button>
                    <button onclick="switchView('grid')" id="gridViewBtn">
                        <i class="fas fa-th"></i>
                    </button>
                </div>
            </div>
            
            <!-- New Offer Button -->
            <a href="{{ route('admin.offers.create') }}" 
               class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-colors flex items-center gap-2">
                <i class="fas fa-plus"></i>
                <span>Nouvelle Offre</span>
            </a>
        </div>
    </div>
    
    <!-- Content with Sidebar -->
    <div class="content-with-sidebar">
        <!-- Filter Sidebar -->
        <div>
            @include('admin.offers.partials.filter-sidebar')
        </div>
        
        <!-- Main Content -->
        <div class="space-y-4">
            <!-- Active Filter Chips -->
            @if(request()->hasAny(['status_filter', 'type_filter', 'target_filter', 'start_date_from', 'end_date_to', 'value_min', 'value_max']))
                <div class="filter-chips">
                    @foreach(request('status_filter', []) as $status)
                        <span class="filter-chip">
                            {{ ucfirst($status) }}
                            <button onclick="removeFilter('status_filter', '{{ $status }}')">
                                <i class="fas fa-times"></i>
                            </button>
                        </span>
                    @endforeach
                    @foreach(request('type_filter', []) as $type)
                        <span class="filter-chip">
                            Type: {{ ucfirst($type) }}
                            <button onclick="removeFilter('type_filter', '{{ $type }}')">
                                <i class="fas fa-times"></i>
                            </button>
                        </span>
                    @endforeach
                    @foreach(request('target_filter', []) as $target)
                        <span class="filter-chip">
                            Cible: {{ ucfirst($target) }}
                            <button onclick="removeFilter('target_filter', '{{ $target }}')">
                                <i class="fas fa-times"></i>
                            </button>
                        </span>
                    @endforeach
                </div>
            @endif
            
            <!-- Table View -->
            <div id="tableView" class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left">
                                <input type="checkbox" id="selectAll" onchange="toggleSelectAll(this)" 
                                       class="rounded text-primary focus:ring-primary">
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Offre
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Type & Valeur
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Cible
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Période
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Static Offer Row 1 -->
                        <tr class="hover:bg-gray-50 transition-colors" data-offer-type="percentage">
                            <td class="px-6 py-4"><input type="checkbox" class="rounded text-primary"></td>
                            <td class="px-6 py-4">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary to-yellow-600 flex items-center justify-center text-white font-bold text-sm">-20%</div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Promo Été</p>
                                        <p class="text-sm text-gray-500 font-mono mt-1"><i class="fas fa-ticket-alt mr-1"></i>SUMMER20</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">Pourcentage</span>
                                <p class="text-lg font-bold text-gray-900 mt-1">-20%</p>
                            </td>
                            <td class="px-6 py-4"><span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-xs font-medium">Tous</span></td>
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    <p class="text-gray-600">01/06/2026 - 31/08/2026</p>
                                    <span class="countdown">15 jours restants</span>
                                </div>
                            </td>
                            <td class="px-6 py-4"><label class="toggle-switch"><input type="checkbox" checked><span class="toggle-slider"></span></label></td>
                            <td class="px-6 py-4 text-center">
                                <button class="text-gray-400 hover:text-gray-600"><i class="fas fa-ellipsis-v"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Grid View (Hidden by default) -->
            <div id="gridView" class="offers-grid hidden">
                @foreach($offers as $offer)
                    @php
                        $isExpired = $offer->end_date < now();
                        $isExpiringSoon = !$isExpired && $offer->end_date <= now()->addDays(7);
                        $isActive = $offer->is_active && !$isExpired && $offer->start_date <= now();
                        $daysRemaining = $offer->days_remaining;
                    @endphp
                    <div class="offer-card" 
                         data-offer-id="{{ $offer->id }}"
                         data-offer-type="{{ $offer->type === 'pack' ? 'pack' : 'offer' }}">
                        <!-- Card Header -->
                        <div class="flex items-start justify-between mb-4">
                            <!-- Checkbox -->
                            <input type="checkbox" 
                                   class="offer-checkbox rounded text-primary focus:ring-primary mt-1" 
                                   value="{{ $offer->id }}" 
                                   onchange="updateBulkBar()">
                            
                            <!-- Status Badge -->
                            <span class="status-badge
                                @if($isActive) status-active
                                @elseif($isExpiringSoon && $offer->is_active) status-expiring
                                @elseif($isExpired) status-expired
                                @else status-inactive
                                @endif">
                                @if($isActive) 
                                    <i class="fas fa-check-circle mr-1"></i>Actif
                                @elseif($isExpiringSoon && $offer->is_active) 
                                    <i class="fas fa-exclamation-triangle mr-1"></i>Expire Bientôt
                                @elseif($isExpired) 
                                    <i class="fas fa-times-circle mr-1"></i>Expiré
                                @else 
                                    <i class="fas fa-pause-circle mr-1"></i>Inactif
                                @endif
                            </span>
                        </div>

                        <!-- Icon/Badge -->
                        <div class="flex justify-center mb-4">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary to-yellow-600 flex items-center justify-center text-white shadow-lg">
                                @if($offer->type === 'percentage')
                                    <div class="text-center">
                                        <div class="text-2xl font-bold">{{ $offer->value }}%</div>
                                        <div class="text-xs opacity-90">OFF</div>
                                    </div>
                                @elseif($offer->type === 'pack')
                                    <i class="fas fa-box-open text-4xl"></i>
                                @else
                                    <i class="fas fa-tag text-4xl"></i>
                                @endif
                            </div>
                        </div>

                        <!-- Offer Name -->
                        <h3 class="font-bold text-lg text-gray-900 mb-2 text-center px-2 line-clamp-2" title="{{ $offer->name }}">
                            {{ $offer->name }}
                        </h3>

                        <!-- Type Badge -->
                        <div class="flex justify-center mb-3">
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium
                                @if($offer->type === 'percentage') bg-blue-100 text-blue-800
                                @elseif($offer->type === 'pack') bg-purple-100 text-purple-800
                                @else bg-green-100 text-green-800
                                @endif">
                                @if($offer->type === 'percentage')
                                    <i class="fas fa-percent"></i> Réduction
                                @elseif($offer->type === 'pack')
                                    <i class="fas fa-box-open"></i> Pack
                                @else
                                    <i class="fas fa-tag"></i> Offre
                                @endif
                            </span>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200 my-3"></div>

                        <!-- Dates -->
                        <div class="space-y-2 mb-3">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">
                                    <i class="fas fa-calendar-alt mr-1"></i>Début
                                </span>
                                <span class="font-medium text-gray-700">{{ $offer->start_date->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">
                                    <i class="fas fa-calendar-check mr-1"></i>Fin
                                </span>
                                <span class="font-medium text-gray-700">{{ $offer->end_date->format('d/m/Y') }}</span>
                            </div>
                        </div>

                        <!-- Countdown -->
                        @if($isActive && $daysRemaining <= 7)
                            <div class="mb-3">
                                <span class="countdown {{ $daysRemaining <= 1 ? 'danger' : 'warning' }} w-full justify-center">
                                    <i class="fas fa-clock"></i>
                                    @if($daysRemaining <= 0)
                                        Expire aujourd'hui
                                    @elseif($daysRemaining == 1)
                                        Expire demain
                                    @else
                                        {{ $daysRemaining }} jours restants
                                    @endif
                                </span>
                            </div>
                        @endif

                        <!-- Divider -->
                        <div class="border-t border-gray-200 my-3"></div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between">
                            <!-- Quick View Button -->
                            <button onclick="quickView({{ $offer->id }}, '{{ $offer->type === 'pack' ? 'pack' : 'offer' }}')" 
                                    class="flex-1 px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-colors text-sm font-medium flex items-center justify-center gap-2">
                                <i class="fas fa-eye"></i>
                                <span>Voir Détails</span>
                            </button>

                            <!-- Dropdown Menu -->
                            <div class="dropdown ml-2">
                                <button onclick="toggleDropdown(this)" 
                                        class="px-3 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu">
                                    @if($offer->type === 'pack')
                                        <a href="#" onclick="alert('Édition de pack à venir'); return false;" class="dropdown-item">
                                            <i class="fas fa-edit text-green-600"></i>
                                            <span>Modifier</span>
                                        </a>
                                    @else
                                        <a href="{{ route('admin.offers.edit', $offer->id) }}" class="dropdown-item">
                                            <i class="fas fa-edit text-green-600"></i>
                                            <span>Modifier</span>
                                        </a>
                                    @endif
                                    <a href="#" onclick="extendOffer({{ $offer->id }}); return false;" class="dropdown-item">
                                        <i class="fas fa-calendar-plus text-orange-600"></i>
                                        <span>Prolonger</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" onclick="deleteOffer({{ $offer->id }}); return false;" class="dropdown-item text-red-600">
                                        <i class="fas fa-trash"></i>
                                        <span>Supprimer</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    
</div>

<!-- Bulk Action Bar -->
<div id="bulkActionBar" class="bulk-action-bar">
    <span id="selectedCount" class="font-semibold text-gray-700">0 sélectionné(s)</span>
    <div class="flex gap-2">
        <button onclick="bulkAction('activate')" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
            <i class="fas fa-check mr-2"></i>Activer
        </button>
        <button onclick="bulkAction('deactivate')" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
            <i class="fas fa-ban mr-2"></i>Désactiver
        </button>
        <button onclick="bulkAction('extend')" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
            <i class="fas fa-calendar-plus mr-2"></i>Prolonger
        </button>
        <button onclick="bulkAction('export')" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-download mr-2"></i>Exporter
        </button>
        <button onclick="bulkAction('delete')" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
            <i class="fas fa-trash mr-2"></i>Supprimer
        </button>
    </div>
    <button onclick="clearSelection()" class="text-gray-600 hover:text-gray-800">
        <i class="fas fa-times"></i>
    </button>
</div>

<!-- Details Modal -->
<div id="detailsModal" class="modal-overlay hidden">
    <div class="modal-container">
        <div class="modal-header">
            <div class="flex items-center gap-3">
                <span id="modalTypeBadge" class="type-badge"></span>
                <h2 id="modalTitle" class="text-2xl font-bold text-gray-900"></h2>
            </div>
            <button onclick="closeDetailsModal()" class="close-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="modal-body">
            <div id="modalLoading" class="text-center py-12">
                <i class="fas fa-spinner fa-spin text-4xl text-primary mb-4"></i>
                <p class="text-gray-600">Chargement...</p>
            </div>
            
            <div id="modalContent" class="modal-grid hidden">
                <!-- Left Column -->
                <div class="modal-left">
                    <div id="modalImageSection"></div>
                    <div id="modalPricingSection"></div>
                    <div id="modalProductsSection"></div>
                </div>
                
                <!-- Right Column -->
                <div class="modal-right">
                    <div id="modalPeriodSection"></div>
                    <div id="modalStatusSection"></div>
                    <div id="modalInfoSection"></div>
                    <div id="modalActionsSection"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Number Formatting Utilities
    function formatPrice(value, decimals = 2) {
        if (value === null || value === undefined || value === '') return '0.00';
        return parseFloat(value).toFixed(decimals);
    }

    function formatPercentage(value, decimals = 0) {
        if (value === null || value === undefined || value === '') return '0';
        return parseFloat(value).toFixed(decimals);
    }

    // Filter Accordion Functions
    function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        const icon = document.getElementById(sectionId + 'Icon');
        
        if (section && icon) {
            section.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }
    }

    function clearAllFilters() {
        const url = new URL(window.location.href);
        const search = url.searchParams.get('search');
        
        window.location.href = search 
            ? '{{ route("admin.offers.index") }}?search=' + search
            : '{{ route("admin.offers.index") }}';
    }

    // Search with debounce
    let searchTimeout;
    const searchInput = document.getElementById('searchInput');
    
    searchInput?.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const url = new URL(window.location.href);
            if (this.value) {
                url.searchParams.set('search', this.value);
            } else {
                url.searchParams.delete('search');
            }
            window.location.href = url.toString();
        }, 500);
    });
    
    // View Toggle
    function switchView(view) {
        const tableView = document.getElementById('tableView');
        const gridView = document.getElementById('gridView');
        const tableBtn = document.getElementById('tableViewBtn');
        const gridBtn = document.getElementById('gridViewBtn');
        
        if (view === 'table') {
            tableView.classList.remove('hidden');
            gridView.classList.add('hidden');
            tableBtn.classList.add('active');
            gridBtn.classList.remove('active');
            localStorage.setItem('offersView', 'table');
        } else {
            tableView.classList.add('hidden');
            gridView.classList.remove('hidden');
            tableBtn.classList.remove('active');
            gridBtn.classList.add('active');
            localStorage.setItem('offersView', 'grid');
        }
    }
    
    // Load saved view preference
    document.addEventListener('DOMContentLoaded', function() {
        const savedView = localStorage.getItem('offersView') || 'table';
        switchView(savedView);
        
        // Initialize type filter counts
        updateTypeCounts();
        
        // Load saved type filter
        const savedFilter = localStorage.getItem('offersTypeFilter') || 'all';
        filterByType(savedFilter);
    });
    
    // Type Filter
    function filterByType(type) {
        // Update button states
        document.querySelectorAll('.type-filter button').forEach(btn => {
            btn.classList.remove('active');
        });
        document.getElementById('filter' + type.charAt(0).toUpperCase() + type.slice(1)).classList.add('active');
        
        // Filter table rows
        const tableRows = document.querySelectorAll('#tableView tbody tr[data-offer-type]');
        tableRows.forEach(row => {
            const rowType = row.dataset.offerType;
            if (type === 'all' || rowType === type) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        // Filter grid cards
        const gridCards = document.querySelectorAll('#gridView .offer-card[data-offer-type]');
        gridCards.forEach(card => {
            const cardType = card.dataset.offerType;
            if (type === 'all' || cardType === type) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
        
        // Save preference
        localStorage.setItem('offersTypeFilter', type);
        
        // Update empty state visibility
        updateEmptyState();
    }
    
    // Update type counts
    function updateTypeCounts() {
        const allItems = document.querySelectorAll('[data-offer-type]');
        const packs = document.querySelectorAll('[data-offer-type="pack"]');
        const offers = document.querySelectorAll('[data-offer-type="offer"]');
        
        // Count unique items (avoid counting both table and grid)
        const uniqueIds = new Set();
        allItems.forEach(item => uniqueIds.add(item.dataset.offerId));
        
        const packIds = new Set();
        packs.forEach(item => packIds.add(item.dataset.offerId));
        
        const offerIds = new Set();
        offers.forEach(item => offerIds.add(item.dataset.offerId));
        
        document.getElementById('countAll').textContent = uniqueIds.size;
        document.getElementById('countPack').textContent = packIds.size;
        document.getElementById('countOffer').textContent = offerIds.size;
    }
    
    // Update empty state based on filter
    function updateEmptyState() {
        const tableView = document.getElementById('tableView');
        const gridView = document.getElementById('gridView');
        const currentView = tableView.classList.contains('hidden') ? 'grid' : 'table';
        
        if (currentView === 'table') {
            const visibleRows = document.querySelectorAll('#tableView tbody tr[data-offer-type]:not([style*="display: none"])');
            const emptyRow = document.querySelector('#tableView tbody tr:not([data-offer-type])');
            
            if (visibleRows.length === 0 && !emptyRow) {
                // Add empty state row
                const tbody = document.querySelector('#tableView tbody');
                const emptyHtml = `
                    <tr class="empty-state-row">
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <i class="fas fa-filter text-6xl mb-4"></i>
                                <p class="text-lg font-medium text-gray-600">Aucun résultat</p>
                                <p class="text-sm text-gray-500 mt-1">Essayez un autre filtre</p>
                            </div>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', emptyHtml);
            } else if (visibleRows.length > 0) {
                // Remove empty state if exists
                const emptyStateRow = document.querySelector('.empty-state-row');
                if (emptyStateRow) emptyStateRow.remove();
            }
        } else {
            const visibleCards = document.querySelectorAll('#gridView .offer-card[data-offer-type]:not([style*="display: none"])');
            const emptyState = document.querySelector('#gridView .empty-state-grid');
            
            if (visibleCards.length === 0 && !emptyState) {
                // Add empty state
                const gridView = document.getElementById('gridView');
                const emptyHtml = `
                    <div class="empty-state-grid col-span-full flex flex-col items-center justify-center text-gray-400 py-12">
                        <i class="fas fa-filter text-6xl mb-4"></i>
                        <p class="text-lg font-medium text-gray-600">Aucun résultat</p>
                        <p class="text-sm text-gray-500 mt-1">Essayez un autre filtre</p>
                    </div>
                `;
                gridView.insertAdjacentHTML('beforeend', emptyHtml);
            } else if (visibleCards.length > 0) {
                // Remove empty state if exists
                const emptyStateGrid = document.querySelector('.empty-state-grid');
                if (emptyStateGrid) emptyStateGrid.remove();
            }
        }
    }
    
    // Bulk Selection
    function toggleSelectAll(checkbox) {
        const checkboxes = document.querySelectorAll('.offer-checkbox');
        checkboxes.forEach(cb => cb.checked = checkbox.checked);
        updateBulkBar();
    }
    
    function updateBulkBar() {
        const checkboxes = document.querySelectorAll('.offer-checkbox:checked');
        const bulkBar = document.getElementById('bulkActionBar');
        const selectedCount = document.getElementById('selectedCount');
        
        if (checkboxes.length > 0) {
            bulkBar.classList.add('active');
            selectedCount.textContent = checkboxes.length + ' sélectionné(s)';
        } else {
            bulkBar.classList.remove('active');
        }
    }
    
    function clearSelection() {
        document.querySelectorAll('.offer-checkbox').forEach(cb => cb.checked = false);
        document.getElementById('selectAll').checked = false;
        updateBulkBar();
    }
    
    function getSelectedIds() {
        return Array.from(document.querySelectorAll('.offer-checkbox:checked')).map(cb => cb.value);
    }
    
    // Bulk Actions
    async function bulkAction(action) {
        const ids = getSelectedIds();
        if (ids.length === 0) return;
        
        if (action === 'delete' && !confirm(`Supprimer ${ids.length} offre(s) ?`)) {
            return;
        }
        
        let extendDays = null;
        if (action === 'extend') {
            extendDays = prompt('Prolonger de combien de jours ?', '7');
            if (!extendDays) return;
        }
        
        try {
            const response = await fetch('{{ route("admin.offers.bulk-action") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    action: action,
                    offers: ids,
                    extend_days: extendDays
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                if (action === 'export') {
                    // Download CSV
                    const blob = new Blob([data.csv], { type: 'text/csv' });
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = data.filename;
                    a.click();
                    alert(data.message || 'Export réussi');
                } else {
                    alert(data.message);
                    window.location.reload();
                }
            } else {
                alert(data.message || 'Une erreur est survenue');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Une erreur est survenue');
        }
    }
    
    // Dropdown Toggle
    function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;
        const isOpen = dropdown.classList.contains('active');
        
        // Close all dropdowns
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.remove('active');
        });
        
        // Toggle current dropdown
        if (!isOpen) {
            dropdown.classList.add('active');
        }
    }
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu').forEach(d => d.classList.remove('active'));
        }
    });
    
    // Toggle Offer Status (AJAX)
    async function toggleOfferStatus(offerId, checkbox) {
        try {
            const response = await fetch(`/admin/offers/${offerId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            
            const data = await response.json();
            if (!data.success) {
                checkbox.checked = !checkbox.checked;
                alert('Erreur lors de la mise à jour');
            }
        } catch (error) {
            checkbox.checked = !checkbox.checked;
            alert('Erreur lors de la mise à jour');
        }
    }
    
    // Quick View - Open Details Modal
    async function quickView(offerId, offerType = 'offer') {
        // Show modal with loading state
        const modal = document.getElementById('detailsModal');
        const loading = document.getElementById('modalLoading');
        const content = document.getElementById('modalContent');
        
        modal.classList.remove('hidden');
        loading.classList.remove('hidden');
        content.classList.add('hidden');
        
        try {
            const response = await fetch(`/admin/offers/${offerType}/${offerId}/details`);
            const result = await response.json();
            
            if (result.success) {
                // Hide loading, show content
                loading.classList.add('hidden');
                content.classList.remove('hidden');
                
                // Render based on type
                if (result.type === 'pack') {
                    renderPackDetails(result.data);
                } else {
                    renderOfferDetails(result.data);
                }
            } else {
                throw new Error('Failed to load details');
            }
        } catch (error) {
            console.error('Error fetching details:', error);
            alert('Erreur lors du chargement des détails');
            closeDetailsModal();
        }
    }
    
    // Render Pack Details
    function renderPackDetails(pack) {
        // Set header
        document.getElementById('modalTypeBadge').innerHTML = '<i class="fas fa-box-open"></i> Pack';
        document.getElementById('modalTypeBadge').className = 'type-badge badge-pack';
        document.getElementById('modalTitle').textContent = pack.name;
        
        // Set image
        const imageHTML = pack.image 
            ? `<img src="/storage/${pack.image}" alt="${pack.name}" class="pack-image">`
            : `<div class="pack-image-placeholder"><i class="fas fa-box-open"></i></div>`;
        document.getElementById('modalImageSection').innerHTML = imageHTML;
        
        // Set pricing
        document.getElementById('modalPricingSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-coins"></i> Tarification
                </div>
                <div class="pricing-card">
                    <div class="pricing-row">
                        <span>Prix Total Produits:</span>
                        <span class="text-gray-500 line-through">${formatPrice(pack.total_product_price)} DH</span>
                    </div>
                    <div class="pricing-row">
                        <span>Prix du Pack:</span>
                        <span class="text-primary font-bold text-xl">${formatPrice(pack.pack_price)} DH</span>
                    </div>
                    <div class="pricing-row highlight">
                        <span class="font-semibold">Économie Client:</span>
                        <span class="text-green-600 font-bold text-lg">${formatPrice(pack.savings)} DH (-${formatPercentage(pack.savings_percentage)}%)</span>
                    </div>
                </div>
            </div>
        `;
        
        // Set products
        const productsHTML = pack.products.map(p => `
            <div class="product-card-modal">
                <img src="/storage/${p.image}" alt="${p.name}" onerror="this.src='/storage/products/default.jpg'">
                <h4 title="${p.name}">${p.name}</h4>
                <p class="price">${formatPrice(p.price)} DH</p>
                <span class="category-badge-modal">${p.category}</span>
            </div>
        `).join('');
        
        document.getElementById('modalProductsSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-box"></i> Produits Inclus (${pack.products.length})
                </div>
                <div class="products-grid">${productsHTML}</div>
            </div>
        `;
        
        // Set period
        const daysRemaining = pack.days_remaining;
        const countdownClass = daysRemaining <= 1 ? 'danger' : (daysRemaining <= 7 ? 'warning' : '');
        const countdownText = daysRemaining <= 0 ? 'Expiré' : 
                             daysRemaining === 1 ? 'Expire demain' : 
                             `${daysRemaining} jours restants`;
        
        document.getElementById('modalPeriodSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-calendar-alt"></i> Période
                </div>
                <div class="info-row">
                    <span class="info-label">Début:</span>
                    <span class="info-value">${pack.start_date}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Fin:</span>
                    <span class="info-value">${pack.end_date}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Temps restant:</span>
                    <span class="countdown ${countdownClass}">
                        <i class="fas fa-clock"></i> ${countdownText}
                    </span>
                </div>
            </div>
        `;
        
        // Set status
        document.getElementById('modalStatusSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-toggle-on"></i> Statut
                </div>
                <div class="flex items-center justify-between">
                    <span class="font-semibold">${pack.is_active ? 'Actif' : 'Inactif'}</span>
                    <span class="status-badge ${pack.is_active ? 'status-active' : 'status-inactive'}">
                        ${pack.is_active ? 'Actif' : 'Inactif'}
                    </span>
                </div>
            </div>
        `;
        
        // Set info
        document.getElementById('modalInfoSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-info-circle"></i> Informations
                </div>
                <div class="info-row">
                    <span class="info-label">Créé le:</span>
                    <span class="info-value">${pack.created_at}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Modifié le:</span>
                    <span class="info-value">${pack.updated_at}</span>
                </div>
            </div>
        `;
        
        // Set actions
        document.getElementById('modalActionsSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-cog"></i> Actions
                </div>
                <div class="modal-actions">
                    <button class="modal-action-btn secondary" onclick="alert('Édition de pack à venir')">
                        <i class="fas fa-edit"></i> Modifier
                    </button>
                    <button class="modal-action-btn secondary" onclick="closeDetailsModal(); extendOffer(${pack.id})">
                        <i class="fas fa-calendar-plus"></i> Prolonger
                    </button>
                    <button class="modal-action-btn danger full-width" onclick="closeDetailsModal(); deleteOffer(${pack.id})">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </div>
            </div>
        `;
    }
    
    // Render Offer Details
    function renderOfferDetails(offer) {
        // Set header
        document.getElementById('modalTypeBadge').innerHTML = '<i class="fas fa-percent"></i> Réduction';
        document.getElementById('modalTypeBadge').className = 'type-badge badge-percentage';
        document.getElementById('modalTitle').textContent = offer.name;
        
        // Set discount icon
        document.getElementById('modalImageSection').innerHTML = `
            <div class="pack-image-placeholder">
                <i class="fas fa-percent"></i>
            </div>
        `;
        
        // Set pricing
        document.getElementById('modalPricingSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-tag"></i> Réduction
                </div>
                <div class="pricing-card">
                    <div class="pricing-row">
                        <span>Type:</span>
                        <span class="font-bold">Pourcentage</span>
                    </div>
                    <div class="pricing-row highlight">
                        <span class="font-semibold">Valeur:</span>
                        <span class="text-primary font-bold text-2xl">-${formatPercentage(offer.discount_percentage)}%</span>
                    </div>
                    ${offer.code ? `
                    <div class="pricing-row">
                        <span>Code Promo:</span>
                        <span class="font-mono font-bold">${offer.code}</span>
                    </div>
                    ` : ''}
                </div>
            </div>
        `;
        
        // Set products or categories
        if (offer.target_type === 'products' && offer.products.length > 0) {
            const productsHTML = offer.products.map(p => `
                <div class="product-card-modal">
                    <img src="/storage/${p.image}" alt="${p.name}" onerror="this.src='/storage/products/default.jpg'">
                    <h4 title="${p.name}">${p.name}</h4>
                    <p class="original-price">${formatPrice(p.price)} DH</p>
                    <p class="discounted-price">${formatPrice(p.discounted_price)} DH</p>
                    <span class="category-badge-modal">${p.category}</span>
                </div>
            `).join('');
            
            document.getElementById('modalProductsSection').innerHTML = `
                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="fas fa-box"></i> Produits Ciblés (${offer.products.length})
                    </div>
                    <div class="products-grid">${productsHTML}</div>
                </div>
            `;
        } else if (offer.target_type === 'categories' && offer.categories.length > 0) {
            const categoriesHTML = offer.categories.map(c => `
                <div class="category-item">
                    <span class="category-item-name">
                        <i class="fas fa-folder mr-2"></i>${c.name}
                    </span>
                    <span class="category-item-count">${c.products_count} produits</span>
                </div>
            `).join('');
            
            document.getElementById('modalProductsSection').innerHTML = `
                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="fas fa-folder"></i> Catégories Ciblées (${offer.categories.length})
                    </div>
                    <div class="categories-list">${categoriesHTML}</div>
                    <p class="text-sm text-gray-600 mt-3">
                        <i class="fas fa-info-circle mr-1"></i>
                        Cette offre s'applique à tous les produits de ces catégories
                    </p>
                </div>
            `;
        } else {
            document.getElementById('modalProductsSection').innerHTML = `
                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="fas fa-globe"></i> Cible
                    </div>
                    <p class="text-gray-600">Cette offre s'applique à tous les produits</p>
                </div>
            `;
        }
        
        // Set period
        const daysRemaining = offer.days_remaining;
        const countdownClass = daysRemaining <= 1 ? 'danger' : (daysRemaining <= 7 ? 'warning' : '');
        const countdownText = daysRemaining <= 0 ? 'Expiré' : 
                             daysRemaining === 1 ? 'Expire demain' : 
                             `${daysRemaining} jours restants`;
        
        document.getElementById('modalPeriodSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-calendar-alt"></i> Période
                </div>
                <div class="info-row">
                    <span class="info-label">Début:</span>
                    <span class="info-value">${offer.start_date}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Fin:</span>
                    <span class="info-value">${offer.end_date}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Temps restant:</span>
                    <span class="countdown ${countdownClass}">
                        <i class="fas fa-clock"></i> ${countdownText}
                    </span>
                </div>
            </div>
        `;
        
        // Set status
        document.getElementById('modalStatusSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-toggle-on"></i> Statut
                </div>
                <div class="flex items-center justify-between">
                    <span class="font-semibold">${offer.is_active ? 'Actif' : 'Inactif'}</span>
                    <span class="status-badge ${offer.is_active ? 'status-active' : 'status-inactive'}">
                        ${offer.is_active ? 'Actif' : 'Inactif'}
                    </span>
                </div>
            </div>
        `;
        
        // Set info
        document.getElementById('modalInfoSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-info-circle"></i> Informations
                </div>
                ${offer.code ? `
                <div class="info-row">
                    <span class="info-label">Code:</span>
                    <span class="info-value font-mono">${offer.code}</span>
                </div>
                ` : ''}
                <div class="info-row">
                    <span class="info-label">Créé le:</span>
                    <span class="info-value">${offer.created_at}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Modifié le:</span>
                    <span class="info-value">${offer.updated_at}</span>
                </div>
            </div>
        `;
        
        // Set actions
        document.getElementById('modalActionsSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-cog"></i> Actions
                </div>
                <div class="modal-actions">
                    <button class="modal-action-btn primary" onclick="window.location.href='/admin/offers/${offer.id}/edit'">
                        <i class="fas fa-edit"></i> Modifier
                    </button>
                    <button class="modal-action-btn secondary" onclick="closeDetailsModal(); extendOffer(${offer.id})">
                        <i class="fas fa-calendar-plus"></i> Prolonger
                    </button>
                    <button class="modal-action-btn danger full-width" onclick="closeDetailsModal(); deleteOffer(${offer.id})">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </div>
            </div>
        `;
    }
    
    // Close Details Modal
    function closeDetailsModal() {
        document.getElementById('detailsModal').classList.add('hidden');
    }
    
    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDetailsModal();
        }
    });
    
    // Close modal on overlay click
    document.getElementById('detailsModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDetailsModal();
        }
    });
    
    // Duplicate Offer
    async function duplicateOffer(offerId) {
        if (!confirm('Dupliquer cette offre ?')) return;
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/offers/${offerId}/duplicate`;
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);
        
        document.body.appendChild(form);
        form.submit();
    }
    
    // Extend Offer
    async function extendOffer(offerId) {
        const days = prompt('Prolonger de combien de jours ?', '7');
        if (!days) return;
        
        try {
            const response = await fetch('{{ route("admin.offers.bulk-action") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    action: 'extend',
                    offers: [offerId],
                    extend_days: days
                })
            });
            
            const data = await response.json();
            if (data.success) {
                alert(data.message);
                window.location.reload();
            }
        } catch (error) {
            alert('Erreur lors de la prolongation');
        }
    }
    
    // Delete Offer
    async function deleteOffer(offerId) {
        if (!confirm('Supprimer cette offre ?')) return;
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/offers/${offerId}`;
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);
        
        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'DELETE';
        form.appendChild(method);
        
        document.body.appendChild(form);
        form.submit();
    }
    
    // Inline Edit
    function startInlineEdit(element) {
        const offerId = element.dataset.offerId;
        const field = element.dataset.field;
        const currentValue = element.textContent.trim();
        
        if (field === 'end_date') {
            // Extract date from text
            const dateMatch = currentValue.match(/\d{2}\/\d{2}\/\d{4}/);
            if (!dateMatch) return;
            
            const [day, month, year] = dateMatch[0].split('/');
            const dateValue = `${year}-${month}-${day}`;
            
            const input = document.createElement('input');
            input.type = 'date';
            input.value = dateValue;
            input.className = 'inline-edit-input';
            
            element.textContent = '';
            element.appendChild(input);
            input.focus();
            
            input.addEventListener('blur', () => saveInlineEdit(element, offerId, field, input.value));
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    saveInlineEdit(element, offerId, field, input.value);
                }
            });
        } else {
            const input = document.createElement('input');
            input.type = 'text';
            input.value = currentValue;
            input.className = 'inline-edit-input';
            
            element.textContent = '';
            element.appendChild(input);
            input.focus();
            input.select();
            
            input.addEventListener('blur', () => saveInlineEdit(element, offerId, field, input.value));
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    saveInlineEdit(element, offerId, field, input.value);
                }
            });
        }
    }
    
    async function saveInlineEdit(element, offerId, field, value) {
        try {
            const response = await fetch(`/admin/offers/${offerId}/inline-update`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ field, value })
            });
            
            const data = await response.json();
            
            if (data.success) {
                if (field === 'end_date') {
                    const date = new Date(value);
                    const formatted = date.toLocaleDateString('fr-FR');
                    element.innerHTML = `<i class="fas fa-calendar-check mr-1"></i>${formatted}`;
                } else {
                    element.textContent = value;
                }
            } else {
                alert('Erreur lors de la mise à jour');
                window.location.reload();
            }
        } catch (error) {
            alert('Erreur lors de la mise à jour');
            window.location.reload();
        }
    }
    
    // Remove Filter
    function removeFilter(filterName, value) {
        const url = new URL(window.location.href);
        const params = url.searchParams.getAll(filterName + '[]');
        
        // Remove all instances of this filter
        url.searchParams.delete(filterName + '[]');
        
        // Re-add all except the one we're removing
        params.forEach(param => {
            if (param !== value) {
                url.searchParams.append(filterName + '[]', param);
            }
        });
        
        window.location.href = url.toString();
    }
</script>
@endpush
