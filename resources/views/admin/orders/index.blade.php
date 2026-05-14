@extends('layouts.admin')

@section('title', 'Commandes')
@section('page-title', 'Gestion des Commandes')

@push('styles')
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
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
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
        background: linear-gradient(135deg, #d4af37 0%, #f59e0b 100%);
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
    
    /* Filter Sidebar Toggle */
    .filter-sidebar-wrapper {
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .filter-sidebar-wrapper.hidden {
        width: 0 !important;
        margin: 0 !important;
        opacity: 0;
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
        background: #FEF3C7;
        border-color: #FDE68A;
        color: #92400E;
    }
    .filter-toggle-btn.has-filters:hover {
        background: #FDE68A;
    }
    .filter-count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 20px;
        height: 20px;
        padding: 0 6px;
        background: #D97706;
        color: white;
        border-radius: 10px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .orders-content {
        transition: all 0.3s ease;
    }
</style>
@endpush

@section('content')
<div class="space-y-6">
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Orders -->
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Commandes</p>
                    <h3 class="text-3xl font-bold text-gray-900">{{ number_format($stats['total']) }}</h3>
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
                    <h3 class="text-3xl font-bold text-amber-600">{{ number_format($stats['pending']) }}</h3>
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
                    <h3 class="text-3xl font-bold text-green-600">{{ number_format($stats['revenue'], 2) }}</h3>
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="fas fa-coins mr-1"></i>
                        DH (confirmées)
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
                    <h3 class="text-3xl font-bold text-purple-600">{{ number_format($stats['average'], 2) }}</h3>
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
    
    <!-- Search Bar & Quick Filters -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex flex-wrap gap-4 items-center">
            <!-- Filter Toggle Button -->
            <button type="button" id="filterToggleBtn" onclick="toggleFilterSidebar()" 
                    class="filter-toggle-btn {{ request()->hasAny(['status_filter', 'date_from', 'date_to', 'amount_min', 'amount_max', 'payment_filter']) ? 'has-filters' : '' }}">
                <i class="fas fa-sliders-h"></i>
                <span id="filterToggleText">Masquer les filtres</span>
                @php
                    $filterCount = 0;
                    if(request('status_filter')) $filterCount += count(request('status_filter'));
                    if(request('date_from') || request('date_to')) $filterCount++;
                    if(request('amount_min') || request('amount_max')) $filterCount++;
                    if(request('payment_filter')) $filterCount += count(request('payment_filter'));
                @endphp
                @if($filterCount > 0)
                    <span class="filter-count-badge">{{ $filterCount }}</span>
                @endif
            </button>
            
            <!-- Search -->
            <div class="flex-1 min-w-[300px]">
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" id="searchInput" placeholder="Rechercher par N° commande, nom, email, téléphone..." 
                           value="{{ request('search') }}"
                           class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
            </div>
            
            <!-- Quick Filter Buttons -->
            <div class="flex gap-2">
                <a href="{{ route('admin.orders.index', ['date_from' => date('Y-m-d'), 'date_to' => date('Y-m-d')]) }}" 
                   class="px-4 py-2 text-sm bg-gray-100 hover:bg-primary hover:text-white rounded-lg transition-colors">
                    <i class="fas fa-calendar-day mr-1"></i>
                    Aujourd'hui
                </a>
                <a href="{{ route('admin.orders.index', ['date_from' => date('Y-m-d', strtotime('-7 days')), 'date_to' => date('Y-m-d')]) }}" 
                   class="px-4 py-2 text-sm bg-gray-100 hover:bg-primary hover:text-white rounded-lg transition-colors">
                    <i class="fas fa-calendar-week mr-1"></i>
                    Cette semaine
                </a>
                <a href="{{ route('admin.orders.index', ['status_filter' => ['pending']]) }}" 
                   class="px-4 py-2 text-sm bg-amber-100 text-amber-800 hover:bg-amber-200 rounded-lg transition-colors">
                    <i class="fas fa-clock mr-1"></i>
                    En attente
                </a>
            </div>
        </div>
    </div>
    
    <!-- Main Content: Filter Sidebar + Orders Table -->
    <div class="flex gap-6">
        <!-- Filter Sidebar (Left) -->
        <div class="w-64 flex-shrink-0 filter-sidebar-wrapper" id="filterSidebarWrapper">
            @include('admin.orders.partials.filter-sidebar')
        </div>
        
        <!-- Orders Content (Right) -->
        <div class="flex-1 space-y-6 orders-content" id="ordersContent">
            
            <!-- Active Filter Chips -->
            @if(request()->hasAny(['status_filter', 'date_from', 'date_to', 'amount_min', 'amount_max', 'payment_filter', 'search']))
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-sm font-medium text-gray-700">
                            <i class="fas fa-filter mr-1"></i>
                            Filtres actifs:
                        </span>
                        
                        @if(request('search'))
                            <span class="filter-chip">
                                <i class="fas fa-search mr-1"></i>
                                Recherche: "{{ request('search') }}"
                                <a href="{{ route('admin.orders.index', array_merge(request()->except('search'))) }}" class="ml-2 hover:text-red-600">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                        
                        @if(request('status_filter'))
                            @foreach(request('status_filter') as $status)
                                <span class="filter-chip">
                                    Statut: {{ ucfirst($status) }}
                                    <a href="{{ route('admin.orders.index', array_merge(request()->except('status_filter'), ['status_filter' => array_diff(request('status_filter'), [$status])])) }}" 
                                       class="ml-2 hover:text-red-600">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </span>
                            @endforeach
                        @endif
                        
                        @if(request('date_from') || request('date_to'))
                            <span class="filter-chip">
                                <i class="fas fa-calendar mr-1"></i>
                                Période: {{ request('date_from') }} - {{ request('date_to') }}
                                <a href="{{ route('admin.orders.index', request()->except(['date_from', 'date_to'])) }}" class="ml-2 hover:text-red-600">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                        
                        @if(request('amount_min') || request('amount_max'))
                            <span class="filter-chip">
                                <i class="fas fa-dollar-sign mr-1"></i>
                                Montant: {{ request('amount_min', 0) }} - {{ request('amount_max', '∞') }} DH
                                <a href="{{ route('admin.orders.index', request()->except(['amount_min', 'amount_max'])) }}" class="ml-2 hover:text-red-600">
                                    <i class="fas fa-times"></i>
                                </a>
                            </span>
                        @endif
                        
                        @if(request('payment_filter'))
                            @foreach(request('payment_filter') as $payment)
                                <span class="filter-chip">
                                    Paiement: {{ ucfirst($payment) }}
                                    <a href="{{ route('admin.orders.index', array_merge(request()->except('payment_filter'), ['payment_filter' => array_diff(request('payment_filter'), [$payment])])) }}" 
                                       class="ml-2 hover:text-red-600">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </span>
                            @endforeach
                        @endif
                        
                        <a href="{{ route('admin.orders.index') }}" class="ml-auto text-sm text-red-600 hover:text-red-800 font-medium">
                            <i class="fas fa-times-circle mr-1"></i>
                            Tout effacer
                        </a>
                    </div>
                </div>
            @endif
    
    <!-- Orders Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        N° Commande
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Date
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Articles
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Total
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Statut
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Static Order Row 1 -->
                <tr class="hover:bg-gray-50 cursor-pointer">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-hashtag text-gray-400 text-xs"></i>
                            <span class="text-primary font-semibold">ORD-1024</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1"><i class="far fa-clock mr-1"></i> Il y a 15 min</p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm">
                            <p class="font-medium text-gray-900">14/05/2026</p>
                            <p class="text-gray-500">13:20</p>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-box text-gray-400"></i>
                            <span class="font-medium text-gray-900">3</span>
                            <span class="text-xs text-gray-500">article(s)</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <p class="text-lg font-bold text-gray-900">450.00 DH</p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="status-badge status-pending">
                            <i class="fas fa-clock"></i> <span>En attente</span>
                        </span>
                    </td>
                </tr>
                <!-- Static Order Row 2 -->
                <tr class="hover:bg-gray-50 cursor-pointer">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-hashtag text-gray-400 text-xs"></i>
                            <span class="text-primary font-semibold">ORD-1023</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1"><i class="far fa-clock mr-1"></i> Il y a 2h</p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm">
                            <p class="font-medium text-gray-900">14/05/2026</p>
                            <p class="text-gray-500">11:45</p>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-box text-gray-400"></i>
                            <span class="font-medium text-gray-900">1</span>
                            <span class="text-xs text-gray-500">article(s)</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <p class="text-lg font-bold text-gray-900">890.50 DH</p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="status-badge status-confirmed">
                            <i class="fas fa-check-circle"></i> <span>Confirmée</span>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination Placeholder -->
    <div class="mt-6 flex justify-center">
        <nav class="inline-flex rounded-md shadow">
            <a href="#" class="px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">Précédent</a>
            <a href="#" class="px-4 py-2 border-t border-b border-gray-300 bg-primary text-white text-sm font-medium">1</a>
            <a href="#" class="px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">Suivant</a>
        </nav>
    </div>
    
</div>
@endsection

@push('scripts')
<script>
    // Toggle Filter Sidebar
    function toggleFilterSidebar() {
        const wrapper = document.getElementById('filterSidebarWrapper');
        const btn = document.getElementById('filterToggleBtn');
        const btnText = document.getElementById('filterToggleText');
        const isHidden = wrapper.classList.contains('hidden');
        
        if (isHidden) {
            // Show sidebar
            wrapper.classList.remove('hidden');
            btnText.textContent = 'Masquer les filtres';
            localStorage.setItem('orderFilterSidebarVisible', 'true');
        } else {
            // Hide sidebar
            wrapper.classList.add('hidden');
            btnText.textContent = 'Afficher les filtres';
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
    
    // Search with debounce (500ms)
    let searchTimeout;
    const searchInput = document.getElementById('searchInput');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const searchValue = this.value;
            
            searchTimeout = setTimeout(function() {
                const url = new URL(window.location.href);
                if (searchValue) {
                    url.searchParams.set('search', searchValue);
                } else {
                    url.searchParams.delete('search');
                }
                window.location.href = url.toString();
            }, 500);
        });
    }
</script>
@endpush
