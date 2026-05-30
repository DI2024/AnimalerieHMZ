@extends('layouts.admin')

@section('title', 'Produits')
@section('page-title', 'Gestion des Produits')

@push('styles')
<style>
    /* View Mode Styles */
    .view-toggle button {
        padding: 8px 16px;
        border: none;
        border-right: 1px solid #e5e7eb;
        background: white;
        transition: all 0.2s;
    }
    .view-toggle button:last-child {
        border-right: none;
    }
    .view-toggle button.active {
        background: #003e87;
        color: white;
    }
    .view-toggle button:hover:not(.active) {
        background: #f9fafb;
    }

    /* Filter Sidebar */
    .filter-sidebar {
        width: 300px;
        transition: transform 0.3s ease, opacity 0.3s ease;
        position: sticky;
        top: 0;
        align-self: flex-start;
        max-height: 100vh;
        overflow-y: auto;
    }
    .filter-sidebar.hidden {
        transform: translateX(-100%);
        opacity: 0;
        position: absolute;
        pointer-events: none;
    }
    
    /* Filter Sidebar Wrapper - desktop behavior */
    .filter-sidebar-wrapper {
        display: contents;
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

    /* Responsive Header Layout */
    @media (max-width: 1024px) {
        /* Stack primary actions on tablet */
        .flex.items-center.gap-3.mb-3 {
            flex-wrap: wrap;
        }
    }

    @media (max-width: 768px) {
        /* Full mobile layout */
        .flex.items-center.gap-3.mb-3,
        .flex.items-center.justify-between.gap-3 {
            flex-direction: column;
            align-items: stretch;
        }
        
        .flex.items-center.justify-between.gap-3 > div {
            width: 100%;
        }
        
        .view-toggle {
            width: 100%;
        }
        
        .view-toggle button {
            flex: 1;
        }
    }

    /* Accordion Styles */
    .filter-accordion {
        border-bottom: 1px solid #e5e7eb;
    }
    .filter-accordion-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
        cursor: pointer;
        transition: background 0.2s;
        user-select: none;
    }
    .filter-accordion-header:hover {
        background: #f9fafb;
    }
    .filter-accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }
    .filter-accordion-content.open {
        max-height: 500px;
        padding: 0 16px 16px 16px;
    }
    .filter-accordion-icon {
        transition: transform 0.3s ease;
    }
    .filter-accordion-icon.open {
        transform: rotate(180deg);
    }

    /* Filter Chips */
    .filter-chip {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        background: #dbeafe;
        color: #1e40af;
        border-radius: 16px;
        font-size: 12px;
        font-weight: 500;
        gap: 6px;
    }
    .filter-chip button {
        color: #1e40af;
        hover:color: #1e3a8a;
    }

    /* Product Card View */
    .product-card {
        transition: all 0.3s ease;
        position: relative;
    }
    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }
    .product-card .quick-actions {
        opacity: 0;
        transition: opacity 0.2s;
    }
    .product-card:hover .quick-actions {
        opacity: 1;
    }

    /* Stock Progress Bar */
    .stock-progress {
        height: 6px;
        background: #e5e7eb;
        border-radius: 3px;
        overflow: hidden;
    }
    .stock-progress-bar {
        height: 100%;
        transition: width 0.3s ease;
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

    /* Bulk Actions Bar */
    .bulk-actions-bar {
        position: fixed;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%) translateY(100px);
        transition: transform 0.3s ease;
        z-index: 50;
    }
    .bulk-actions-bar.show {
        transform: translateX(-50%) translateY(0);
    }

    /* List View */
    .list-view-item {
        display: flex;
        align-items: center;
        padding: 12px;
        border-bottom: 1px solid #e5e7eb;
        transition: background 0.2s;
    }
    .list-view-item:hover {
        background: #f9fafb;
    }
</style>
@endpush

@section('content')
<div class="flex gap-6 relative">
    
    <!-- Filter Sidebar Wrapper (for mobile overlay) -->
    <div id="filter-sidebar-wrapper" class="filter-sidebar-wrapper hidden lg:contents">
        <!-- Filter Sidebar -->
        @include('admin.products.partials.filter-sidebar', ['categories' => $categories])
    </div>

    <!-- Main Content -->
    <div class="flex-1 min-w-0 space-y-6">
        
        <!-- Header Bar - Two Row Layout -->
        <div class="bg-white rounded-lg shadow p-4 sticky top-0 z-30">
            <!-- Primary Actions Row -->
            <div class="flex flex-col md:flex-row md:items-center gap-3 mb-3">
                <form id="search-form" method="GET" action="{{ route('admin.products.index') }}" class="flex items-center gap-3 flex-1">
                    <!-- Large Search Input -->
                    <div class="relative flex-1 min-w-[200px] max-w-[600px]">
                        <input type="text" id="quick-search" name="search" value="{{ request('search') }}" placeholder="Rechercher des produits..." 
                               class="w-full pl-10 pr-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm">
                        <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                    </div>

                    <!-- Primary Action Buttons (Desktop) -->
                    <button type="submit" 
                            class="hidden md:inline-flex px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium whitespace-nowrap transition-colors">
                        <i class="fas fa-sync-alt mr-2"></i>Actualiser
                    </button>

                    <!-- Button "Entrer" (Mobile only) -->
                    <button type="submit" 
                            class="md:hidden px-4 py-2.5 bg-[#003e87] text-white border-2 border-[#003e87] rounded-lg hover:bg-white hover:text-[#003e87] text-sm font-bold whitespace-nowrap transition-all shadow-md">
                        Entrer
                    </button>
                </form>

                <!-- Row 2 for Mobile: Nouveau Produit (50%) & Actualiser (50%) -->
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <a href="{{ route('admin.products.create') }}" 
                       class="flex-1 md:flex-none text-center px-4 py-2.5 bg-[#003e87] text-white border-2 border-[#003e87] rounded-lg hover:bg-white hover:text-[#003e87] text-sm font-bold whitespace-nowrap transition-all shadow-md hover:shadow-lg">
                        <i class="fas fa-plus mr-2"></i>Nouveau Produit
                    </a>

                    <!-- Button "Actualiser" (Mobile only, placed side-by-side with Nouveau Produit) -->
                    <button type="submit" form="search-form"
                            class="md:hidden flex-1 px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium whitespace-nowrap transition-colors flex items-center justify-center">
                        <i class="fas fa-sync-alt mr-2"></i>Actualiser
                    </button>
                </div>
            </div>

            <!-- Secondary Controls Row -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <!-- Sort Dropdown -->
                    <select onchange="sortProducts(this.value)" 
                            class="flex-1 md:flex-none px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary text-sm">
                        <option value="">Trier par...</option>
                        <option value="name_asc">Nom (A-Z)</option>
                        <option value="name_desc">Nom (Z-A)</option>
                        <option value="price_asc">Prix (croissant)</option>
                        <option value="price_desc">Prix (décroissant)</option>
                        <option value="stock_asc">Stock (croissant)</option>
                        <option value="stock_desc">Stock (décroissant)</option>
                        <option value="created_desc">Plus récent</option>
                    </select>

                    <!-- Filter Button (Mobile only) -->
                    <button type="button" id="filter-toggle-btn" onclick="toggleFilters()"
                            class="md:hidden flex-1 px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium text-gray-700 flex items-center justify-center gap-2">
                        <i class="fas fa-filter text-gray-500"></i> Filtrer
                    </button>

                    <!-- Bulk Actions (shown when products selected) -->
                    <div id="bulk-actions" class="hidden items-center gap-2 px-3 py-2 bg-blue-50 rounded-lg border border-blue-200">
                        <input type="checkbox" id="select-all" onchange="toggleSelectAll(this)" 
                               class="rounded text-primary focus:ring-primary">
                        <span id="selected-count" class="text-sm font-medium text-gray-700">0 sélectionné(s)</span>
                        
                        <select id="bulk-action-select" class="px-3 py-1.5 border rounded text-sm bg-white">
                            <option value="">Actions...</option>
                            <option value="activate">Activer</option>
                            <option value="deactivate">Désactiver</option>
                            <option value="delete">Supprimer</option>
                        </select>
                        
                        <button onclick="applyBulkAction()" 
                                class="px-3 py-1.5 bg-primary text-white rounded text-sm hover:bg-primary-container transition-colors">
                            Appliquer
                        </button>
                    </div>
                </div>

                <!-- View Mode Toggle -->
                <div class="view-toggle hidden md:flex rounded-lg overflow-hidden border">
                    <button onclick="switchView('card')" id="view-card" class="active" title="Vue Cartes">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button onclick="switchView('table')" id="view-table" title="Vue Tableau">
                        <i class="fas fa-table"></i>
                    </button>
                    <button onclick="switchView('list')" id="view-list" title="Vue Liste">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Display -->
        <div id="products-container">
            <!-- Card View (Default) -->
            <div id="card-view" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mobile-cards-scroll">
                @forelse($products as $product)
                    @include('admin.products.partials.card', ['product' => $product])
                @empty
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">Aucun produit trouvé</p>
                    </div>
                @endforelse
            </div>

            <!-- Table View (Hidden) -->
            <div id="table-view" class="hidden bg-white rounded-lg shadow overflow-x-auto">
                @include('admin.products.partials.table', ['products' => $products])
            </div>

            <!-- List View (Hidden) -->
            <div id="list-view" class="hidden bg-white rounded-lg shadow">
                @forelse($products as $product)
                    @include('admin.products.partials.list', ['product' => $product])
                @empty
                    <div class="text-center py-12">
                        <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">Aucun produit trouvé</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="mt-6 flex justify-center">
            <nav class="inline-flex items-center gap-1 rounded-lg shadow-sm">
                <!-- Previous Arrow -->
                @if($products->onFirstPage())
                    <span class="px-3 py-2 border border-gray-300 bg-gray-100 text-gray-400 rounded-l-lg cursor-not-allowed">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                @else
                    <a href="{{ $products->previousPageUrl() }}" class="px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-l-lg transition-colors">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                @endif
                
                <!-- Page Numbers -->
                @foreach(range(1, $products->lastPage()) as $page)
                    @if($page == $products->currentPage())
                        <span class="px-4 py-2 border-t border-b border-gray-300 bg-[#003e87] text-white text-sm font-medium">{{ $page }}</span>
                    @else
                        <a href="{{ $products->url($page) }}" class="px-4 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">{{ $page }}</a>
                    @endif
                @endforeach
                
                <!-- Next Arrow -->
                @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" class="px-3 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-r-lg transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                @else
                    <span class="px-3 py-2 border border-gray-300 bg-gray-100 text-gray-400 rounded-r-lg cursor-not-allowed">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                @endif
            </nav>
        </div>
        @endif
    </div>
</div>

<!-- Quick View Modal -->
<div id="quick-view-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b flex items-center justify-between sticky top-0 bg-white z-10">
            <h3 class="text-xl font-semibold">Aperçu Rapide</h3>
            <button onclick="closeQuickView()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div id="quick-view-content" class="p-6">
            <!-- Content loaded dynamically -->
        </div>
    </div>
</div>

<!-- Custom Confirmation Modal -->
<div id="confirmation-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full transform transition-all">
        <div class="p-6">
            <!-- Icon -->
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full" id="confirm-icon-container">
                <i class="fas fa-exclamation-triangle text-3xl" id="confirm-icon"></i>
            </div>
            
            <!-- Title -->
            <h3 class="text-xl font-bold text-gray-900 text-center mb-2" id="confirm-title">
                Confirmer l'action
            </h3>
            
            <!-- Message -->
            <p class="text-gray-600 text-center mb-6" id="confirm-message">
                Êtes-vous sûr de vouloir effectuer cette action ?
            </p>
            
            <!-- Actions -->
            <div class="flex space-x-3">
                <button onclick="closeConfirmation()" 
                        class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                    Annuler
                </button>
                <button onclick="confirmAction()" 
                        id="confirm-button"
                        class="flex-1 px-4 py-2.5 rounded-lg font-medium transition-colors">
                    Confirmer
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let selectedProducts = new Set();
    let currentView = 'card';

    // Toggle Filters
    function toggleFilters() {
        const wrapper = document.getElementById('filter-sidebar-wrapper');
        const toggleBtn = document.getElementById('filter-toggle-btn');
        const isHidden = wrapper.classList.contains('hidden');
        
        wrapper.classList.toggle('hidden');
        
        // Update button appearance
        if (isHidden) {
            toggleBtn.classList.add('bg-primary', 'text-white', 'border-primary');
            toggleBtn.classList.remove('hover:bg-gray-50');
        } else {
            toggleBtn.classList.remove('bg-primary', 'text-white', 'border-primary');
            toggleBtn.classList.add('hover:bg-gray-50');
        }
        
        // Close on overlay click (mobile only)
        if (window.innerWidth < 1024 && isHidden) {
            wrapper.addEventListener('click', function(e) {
                if (e.target === wrapper) {
                    toggleFilters();
                }
            });
        }
    }

    // Switch View
    function switchView(view) {
        if (window.innerWidth < 768) {
            view = 'card';
        }
        currentView = view;
        
        // Update buttons
        document.querySelectorAll('.view-toggle button').forEach(btn => btn.classList.remove('active'));
        const activeBtn = document.getElementById('view-' + view);
        if (activeBtn) {
            activeBtn.classList.add('active');
        }
        
        // Show/hide views
        const cardViewEl = document.getElementById('card-view');
        if (cardViewEl) cardViewEl.classList.toggle('hidden', view !== 'card');
        
        const tableViewEl = document.getElementById('table-view');
        if (tableViewEl) tableViewEl.classList.toggle('hidden', view !== 'table');
        
        const listViewEl = document.getElementById('list-view');
        if (listViewEl) listViewEl.classList.toggle('hidden', view !== 'list');
        
        if (window.innerWidth >= 768) {
            localStorage.setItem('products-view', view);
        }
    }

    // Restore view from localStorage
    document.addEventListener('DOMContentLoaded', function() {
        if (window.innerWidth < 768) {
            switchView('card');
        } else {
            const savedView = localStorage.getItem('products-view');
            if (savedView) {
                switchView(savedView);
            }
        }
    });

    // Sort Products
    function sortProducts(sortBy) {
        const url = new URL(window.location.href);
        url.searchParams.set('sort', sortBy);
        window.location.href = url.toString();
    }

    // Toggle Select All
    function toggleSelectAll(checkbox) {
        const checkboxes = document.querySelectorAll('.product-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = checkbox.checked;
            if (checkbox.checked) {
                selectedProducts.add(cb.value);
            } else {
                selectedProducts.delete(cb.value);
            }
        });
        updateBulkActions();
    }

    // Toggle Product Selection
    function toggleProductSelection(checkbox, productId) {
        if (checkbox.checked) {
            selectedProducts.add(productId);
        } else {
            selectedProducts.delete(productId);
        }
        updateBulkActions();
    }

    // Update Bulk Actions
    function updateBulkActions() {
        const bulkActions = document.getElementById('bulk-actions');
        const count = selectedProducts.size;
        
        if (count > 0) {
            bulkActions.classList.remove('hidden');
            bulkActions.classList.add('flex');
            document.getElementById('selected-count').textContent = count + ' sélectionné(s)';
        } else {
            bulkActions.classList.add('hidden');
            bulkActions.classList.remove('flex');
        }
    }

    // Apply Bulk Action
    function applyBulkAction() {
        const action = document.getElementById('bulk-action-select').value;
        if (!action) {
            alert('Veuillez sélectionner une action');
            return;
        }
        
        if (selectedProducts.size === 0) {
            alert('Veuillez sélectionner au moins un produit');
            return;
        }
        
        // Show confirmation for sensitive actions
        if (action === 'delete') {
            showConfirmation(
                'Supprimer les produits',
                `Êtes-vous sûr de vouloir supprimer ${selectedProducts.size} produit(s) ? Cette action est irréversible.`,
                () => executeBulkAction(action),
                'danger'
            );
        } else if (action === 'deactivate') {
            showConfirmation(
                'Désactiver les produits',
                `Êtes-vous sûr de vouloir désactiver ${selectedProducts.size} produit(s) ?`,
                () => executeBulkAction(action),
                'warning'
            );
        } else {
            executeBulkAction(action);
        }
    }

    // Execute Bulk Action
    function executeBulkAction(action) {
        // Send AJAX request
        fetch('{{ route("admin.products.bulk-action") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                action: action,
                products: Array.from(selectedProducts)
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert('Erreur: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue');
        });
    }

    // Quick View
    function quickView(productId) {
        document.getElementById('quick-view-modal').classList.remove('hidden');
        document.getElementById('quick-view-content').innerHTML = '<div class="text-center py-12"><i class="fas fa-spinner fa-spin text-4xl text-primary"></i></div>';
        
        fetch(`/admin/products/${productId}/quick-view`)
            .then(response => response.text())
            .then(html => {
                document.getElementById('quick-view-content').innerHTML = html;
            })
            .catch(error => {
                document.getElementById('quick-view-content').innerHTML = '<p class="text-center text-red-500">Erreur de chargement</p>';
            });
    }

    function closeQuickView() {
        document.getElementById('quick-view-modal').classList.add('hidden');
    }

    // Inline Edit Stock
    function editStock(productId, currentStock) {
        const element = document.getElementById('stock-' + productId);
        const input = document.createElement('input');
        input.type = 'number';
        input.value = currentStock;
        input.className = 'w-20 px-2 py-1 border rounded';
        input.min = 0;
        
        input.onblur = function() {
            updateStock(productId, this.value);
        };
        
        input.onkeypress = function(e) {
            if (e.key === 'Enter') {
                updateStock(productId, this.value);
            }
        };
        
        element.innerHTML = '';
        element.appendChild(input);
        input.focus();
    }

    function updateStock(productId, newStock) {
        fetch(`/admin/products/${productId}/update-stock`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ stock: newStock })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        });
    }

    // Close modal on outside click
    document.getElementById('quick-view-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeQuickView();
        }
    });

    // Confirmation Modal Functions
    let confirmCallback = null;

    function showConfirmation(title, message, onConfirm, type = 'danger') {
        const modal = document.getElementById('confirmation-modal');
        const iconContainer = document.getElementById('confirm-icon-container');
        const icon = document.getElementById('confirm-icon');
        const confirmBtn = document.getElementById('confirm-button');
        
        // Set content
        document.getElementById('confirm-title').textContent = title;
        document.getElementById('confirm-message').textContent = message;
        
        // Set style based on type
        if (type === 'danger') {
            iconContainer.className = 'flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-red-100';
            icon.className = 'fas fa-exclamation-triangle text-3xl text-red-600';
            confirmBtn.className = 'flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium transition-colors';
            confirmBtn.textContent = 'Supprimer';
        } else if (type === 'warning') {
            iconContainer.className = 'flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-yellow-100';
            icon.className = 'fas fa-exclamation-circle text-3xl text-yellow-600';
            confirmBtn.className = 'flex-1 px-4 py-2.5 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 font-medium transition-colors';
            confirmBtn.textContent = 'Désactiver';
        } else {
            iconContainer.className = 'flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-blue-100';
            icon.className = 'fas fa-info-circle text-3xl text-blue-600';
            confirmBtn.className = 'flex-1 px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-container font-medium transition-colors';
            confirmBtn.textContent = 'Confirmer';
        }
        
        confirmCallback = onConfirm;
        modal.classList.remove('hidden');
    }

    function closeConfirmation() {
        document.getElementById('confirmation-modal').classList.add('hidden');
        confirmCallback = null;
    }

    function confirmAction() {
        if (confirmCallback) {
            confirmCallback();
        }
        closeConfirmation();
    }

    // Close confirmation modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeConfirmation();
        }
    });

    // Close confirmation modal on outside click
    document.getElementById('confirmation-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeConfirmation();
        }
    });

    // Delete Product
    function deleteProduct(productId) {
        showConfirmation(
            'Supprimer le produit',
            'Êtes-vous sûr de vouloir supprimer ce produit ? Cette action est irréversible.',
            () => {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/products/${productId}`;
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            },
            'danger'
        );
    }

    // Toggle Product Status
    function toggleProductStatus(productId, isActive) {
        fetch(`/admin/products/${productId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ is_active: isActive })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                alert('Erreur lors de la mise à jour du statut');
                // Revert checkbox
                event.target.checked = !isActive;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur est survenue');
            // Revert checkbox
            event.target.checked = !isActive;
        });
    }
</script>
@endpush
