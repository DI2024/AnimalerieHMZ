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
        background: #d4af37;
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
    @media (max-width: 1024px) {
        /* Wrapper overlay */
        .filter-sidebar-wrapper {
            position: fixed;
            inset: 0;
            z-index: 1000;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            display: block;
        }
        
        .filter-sidebar-wrapper:not(.hidden) {
            pointer-events: all;
            opacity: 1;
        }
        
        .filter-sidebar-wrapper::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .filter-sidebar-wrapper:not(.hidden)::before {
            opacity: 1;
        }
        
        .filter-sidebar {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            top: auto;
            height: auto;
            max-height: 85vh;
            width: 100%;
            box-shadow: 0 -4px 24px rgba(0, 0, 0, 0.15);
            border-radius: 24px 24px 0 0;
            transform: translateY(100%);
            transition: transform 0.3s ease;
            overflow-y: auto;
        }
        
        .filter-sidebar-wrapper:not(.hidden) .filter-sidebar {
            transform: translateY(0);
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
        <div class="bg-white rounded-lg shadow p-4 sticky top-0 z-30 before:content-[''] before:absolute before:left-0 before:right-0 before:bottom-full before:h-16 before:bg-gradient-to-b before:from-transparent before:via-white/60 before:to-white before:backdrop-blur-lg before:pointer-events-none">
            <!-- Primary Actions Row -->
            <div class="flex items-center gap-3 mb-3">
                <!-- Large Search Input -->
                <div class="relative flex-1 min-w-[200px] max-w-[600px]">
                    <input type="text" id="quick-search" placeholder="Rechercher des produits..." 
                           class="w-full pl-10 pr-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm">
                    <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                </div>

                <!-- Primary Action Buttons -->
                <button onclick="window.location.reload()" 
                        class="px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium whitespace-nowrap transition-colors">
                    <i class="fas fa-sync-alt mr-2"></i>Actualiser
                </button>

                <a href="{{ route('admin.products.create') }}" 
                   class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-yellow-600 text-sm font-medium whitespace-nowrap transition-colors">
                    <i class="fas fa-plus mr-2"></i>Nouveau Produit
                </a>
            </div>

            <!-- Secondary Controls Row -->
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <!-- Filter Toggle -->
                    <button onclick="toggleFilters()" id="filter-toggle-btn"
                            class="px-4 py-2 border rounded-lg hover:bg-gray-50 text-sm font-medium transition-colors">
                        <i class="fas fa-filter mr-2"></i>Filtres
                    </button>

                    <!-- Sort Dropdown -->
                    <select onchange="sortProducts(this.value)" 
                            class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary text-sm">
                        <option value="">Trier par...</option>
                        <option value="name_asc">Nom (A-Z)</option>
                        <option value="name_desc">Nom (Z-A)</option>
                        <option value="price_asc">Prix (croissant)</option>
                        <option value="price_desc">Prix (décroissant)</option>
                        <option value="stock_asc">Stock (croissant)</option>
                        <option value="stock_desc">Stock (décroissant)</option>
                        <option value="created_desc">Plus récent</option>
                    </select>

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
                                class="px-3 py-1.5 bg-primary text-white rounded text-sm hover:bg-yellow-600 transition-colors">
                            Appliquer
                        </button>
                    </div>
                </div>

                <!-- View Mode Toggle -->
                <div class="view-toggle flex rounded-lg overflow-hidden border">
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
            <div id="card-view" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @include('admin.products.partials.card')
                @include('admin.products.partials.card')
                @include('admin.products.partials.card')
                @include('admin.products.partials.card')
            </div>

            <!-- Table View (Hidden) -->
            <div id="table-view" class="hidden bg-white rounded-lg shadow overflow-hidden">
                @include('admin.products.partials.table')
            </div>

            <!-- List View (Hidden) -->
            <div id="list-view" class="hidden bg-white rounded-lg shadow">
                @include('admin.products.partials.list')
                @include('admin.products.partials.list')
            </div>
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
        currentView = view;
        
        // Update buttons
        document.querySelectorAll('.view-toggle button').forEach(btn => btn.classList.remove('active'));
        document.getElementById('view-' + view).classList.add('active');
        
        // Show/hide views
        document.getElementById('card-view').classList.toggle('hidden', view !== 'card');
        document.getElementById('table-view').classList.toggle('hidden', view !== 'table');
        document.getElementById('list-view').classList.toggle('hidden', view !== 'list');
        
        localStorage.setItem('products-view', view);
    }

    // Restore view from localStorage
    document.addEventListener('DOMContentLoaded', function() {
        const savedView = localStorage.getItem('products-view');
        if (savedView) {
            switchView(savedView);
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

    // Quick Search
    let searchTimeout;
    document.getElementById('quick-search').addEventListener('input', function(e) {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const url = new URL(window.location.href);
            url.searchParams.set('search', e.target.value);
            window.location.href = url.toString();
        }, 500);
    });

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
            confirmBtn.className = 'flex-1 px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-yellow-600 font-medium transition-colors';
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
</script>
@endpush
