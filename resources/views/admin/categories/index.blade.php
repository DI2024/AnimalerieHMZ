@extends('layouts.admin')

@section('title', 'Catégories')
@section('page-title', 'Gestion des Catégories')

@push('styles')
<style>
    /* Drag handle cursor */
    .drag-handle {
        cursor: move;
        cursor: grab;
    }
    .drag-handle:active {
        cursor: grabbing;
    }
    
    /* Drag handle for grid view */
    .drag-handle-grid {
        cursor: move;
        cursor: grab;
    }
    .drag-handle-grid:active {
        cursor: grabbing;
    }
    
    /* Toggle switch */
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 48px;
        height: 24px;
    }
    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #cbd5e1;
        transition: 0.3s;
        border-radius: 24px;
    }
    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        transition: 0.3s;
        border-radius: 50%;
    }
    input:checked + .toggle-slider {
        background-color: #22c55e;
    }
    input:checked + .toggle-slider:before {
        transform: translateX(24px);
    }
    
    /* Sortable ghost */
    .sortable-ghost {
        opacity: 0.4;
        background: #f3f4f6;
    }
    
    /* Dropdown Menu */
    .dropdown {
        position: relative;
        display: inline-block;
    }
    .dropdown-menu {
        position: absolute;
        right: 0;
        top: 100%;
        margin-top: 4px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        min-width: 180px;
        z-index: 1000;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.2s ease;
    }
    .dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    .dropdown-item {
        display: flex;
        align-items: center;
        padding: 10px 16px;
        color: #374151;
        text-decoration: none;
        transition: background 0.2s;
        cursor: pointer;
        font-size: 14px;
    }
    .dropdown-item:hover {
        background: #f3f4f6;
    }
    .dropdown-item i {
        width: 20px;
        margin-right: 10px;
    }
    .dropdown-divider {
        height: 1px;
        background: #e5e7eb;
        margin: 4px 0;
    }
    
    /* Inline Edit */
    .inline-edit-input {
        border: 2px solid #d4af37;
        border-radius: 4px;
        padding: 4px 8px;
        font-size: 14px;
        width: 100%;
    }
    .inline-edit-input:focus {
        outline: none;
        border-color: #b8941f;
    }
    
    /* Filter Sidebar */
    .filter-sidebar {
        width: 280px;
        transition: transform 0.3s ease, opacity 0.3s ease;
        position: relative;
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
    
    /* Filter Accordion */
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
</style>
@endpush

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Total Categories -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Catégories</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['total'] }}</p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-tags text-blue-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Active Categories -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Actives</p>
                <p class="text-3xl font-bold text-green-600 mt-1">{{ $stats['active'] }}</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-check-circle text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Inactive Categories -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Inactives</p>
                <p class="text-3xl font-bold text-gray-600 mt-1">{{ $stats['inactive'] }}</p>
            </div>
            <div class="bg-gray-100 p-3 rounded-full">
                <i class="fas fa-times-circle text-gray-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Products -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Produits</p>
                <p class="text-3xl font-bold text-primary mt-1">{{ $stats['total_products'] }}</p>
            </div>
            <div class="bg-yellow-100 p-3 rounded-full">
                <i class="fas fa-box text-primary text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="flex gap-6 relative">
    
    <!-- Filter Sidebar Wrapper (for mobile overlay) -->
    <div id="filter-sidebar-wrapper" class="filter-sidebar-wrapper hidden lg:contents">
        <!-- Filter Sidebar -->
        @include('admin.categories.partials.filter-sidebar')
    </div>

    <!-- Main Content -->
    <div class="flex-1 min-w-0 space-y-6">

    <!-- Two-Row Header -->
    <div class="bg-white rounded-lg shadow p-4">
        <!-- Primary Actions Row -->
        <div class="flex items-center gap-3 mb-3">
            <!-- Search Bar -->
            <div class="relative flex-1 min-w-[200px] max-w-[600px]">
                <form method="GET" action="{{ route('admin.categories.index') }}">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Rechercher une catégorie..." 
                           class="w-full pl-10 pr-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm">
                    <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                </form>
            </div>

            <!-- Refresh Button -->
            <button onclick="window.location.reload()" 
                    class="px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium whitespace-nowrap transition-colors">
                <i class="fas fa-sync-alt mr-2"></i>Actualiser
            </button>

            <!-- New Category Button -->
            <a href="{{ route('admin.categories.create') }}" 
               class="px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-yellow-600 text-sm font-medium whitespace-nowrap transition-colors">
                <i class="fas fa-plus mr-2"></i>Nouvelle Catégorie
            </a>
        </div>

        <!-- Secondary Controls Row -->
        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <!-- Filter Toggle -->
                <button onclick="toggleFilterSidebar()" id="filter-toggle-btn"
                        class="px-4 py-2 border rounded-lg hover:bg-gray-50 text-sm font-medium transition-colors">
                    <i class="fas fa-filter mr-2"></i>Filtres
                    @if(request()->hasAny(['status', 'products']))
                        <span class="ml-1 px-1.5 py-0.5 bg-primary text-white text-xs rounded-full">
                            {{ collect([request('status'), request('products')])->filter()->count() }}
                        </span>
                    @endif
                </button>



                <!-- Reorder Mode Toggle -->
                <button onclick="toggleReorderMode()" id="reorder-btn"
                        class="px-4 py-2 border rounded-lg hover:bg-gray-50 text-sm font-medium transition-colors">
                    <i class="fas fa-arrows-alt mr-2"></i>Réorganiser
                </button>

                <!-- Save Order Button (hidden by default) -->
                <button onclick="saveOrder()" id="save-order-btn"
                        class="hidden px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm font-medium transition-colors">
                    <i class="fas fa-save mr-2"></i>Enregistrer l'ordre
                </button>

                <!-- Cancel Button (hidden by default) -->
                <button onclick="cancelReorder()" id="cancel-order-btn"
                        class="hidden px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm font-medium transition-colors">
                    <i class="fas fa-times mr-2"></i>Annuler
                </button>
                
                <!-- Inline Bulk Actions (hidden by default) -->
                <div id="inline-bulk-actions" class="hidden flex items-center gap-2 ml-4 pl-4 border-l border-gray-300">
                    <span class="text-sm text-gray-700 flex items-center">
                        <i class="fas fa-check-circle text-primary mr-2"></i>
                        <span id="inline-selected-count" class="font-medium">0 sélectionné(s)</span>
                    </span>
                    <select id="inline-bulk-action-select" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="">Actions...</option>
                        <option value="activate">Activer tout</option>
                        <option value="deactivate">Désactiver tout</option>
                        <option value="delete">Supprimer</option>
                        <option value="export">Exporter sélection</option>
                    </select>
                    <button onclick="applyInlineBulkAction()" 
                            class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-yellow-600 text-sm font-medium transition-colors">
                        Appliquer
                    </button>
                    <button onclick="clearSelection()" 
                            class="px-3 py-2 text-gray-600 hover:text-gray-900 text-sm transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="text-sm text-gray-600">
                <span id="category-count">{{ $categories->count() }}</span> catégorie(s)
            </div>
        </div>
    </div>
    
    <!-- Categories Table -->
    <div id="table-view" class="bg-white rounded-lg shadow">
        <div class="overflow-x-auto">
        <table class="w-full" id="categories-table">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left w-12">
                        <input type="checkbox" id="select-all" onchange="toggleSelectAll(this)"
                               class="rounded text-primary focus:ring-primary cursor-pointer">
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-12">
                        <span id="drag-header" class="hidden">
                            <i class="fas fa-grip-vertical text-gray-400"></i>
                        </span>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Catégorie</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produits</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ordre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200" id="sortable-categories">
                <!-- Static Category Row 1 -->
                <tr class="category-row hover:bg-gray-50">
                    <td class="px-6 py-4"><input type="checkbox" class="rounded text-primary cursor-pointer"></td>
                    <td class="px-6 py-4"><div class="text-gray-400"><i class="fas fa-grip-vertical"></i></div></td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gray-200 rounded mr-4 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Chiens</p>
                                <p class="text-sm text-gray-500">chiens</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">45 produit(s)</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">1</td>
                    <td class="px-6 py-4">
                        <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-slider"></span></label>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <button class="px-3 py-1.5 text-gray-600 hover:bg-gray-100 rounded"><i class="fas fa-ellipsis-v"></i></button>
                    </td>
                </tr>
                <!-- Static Category Row 2 -->
                <tr class="category-row hover:bg-gray-50">
                    <td class="px-6 py-4"><input type="checkbox" class="rounded text-primary cursor-pointer"></td>
                    <td class="px-6 py-4"><div class="text-gray-400"><i class="fas fa-grip-vertical"></i></div></td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gray-200 rounded mr-4 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">Chats</p>
                                <p class="text-sm text-gray-500">chats</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">32 produit(s)</span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">2</td>
                    <td class="px-6 py-4">
                        <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-slider"></span></label>
                    </td>
                    <td class="px-6 py-4 text-sm">
                        <button class="px-3 py-1.5 text-gray-600 hover:bg-gray-100 rounded"><i class="fas fa-ellipsis-v"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>

    <!-- Grid View -->
    <div id="grid-view" class="hidden space-y-6">
        @forelse($categories as $category)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-4" data-id="{{ $category->id }}">
                <div class="flex items-center gap-4">
                    <!-- Drag Handle -->
                    <div class="drag-handle-grid hidden cursor-move text-gray-400 hover:text-gray-600">
                        <i class="fas fa-grip-vertical text-lg"></i>
                    </div>
                    
                    <!-- Checkbox -->
                    <input type="checkbox" class="category-checkbox rounded text-primary focus:ring-primary cursor-pointer"
                           value="{{ $category->id }}" onchange="toggleCategorySelection(this)">
                    
                    <!-- Category Image -->
                    <div class="flex-shrink-0">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" 
                                 class="w-16 h-16 object-cover rounded"
                                 onerror="this.src='{{ asset('images/placeholder-category.svg') }}'; this.onerror=null;">
                        @else
                            <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-2xl"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Category Info -->
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 mb-1 category-name"
                            data-id="{{ $category->id }}"
                            data-name="{{ $category->name }}"
                            onclick="enableInlineEdit(this, 'name')"
                            title="Cliquer pour modifier">
                            {{ $category->name }}
                        </h3>
                        <p class="text-sm text-gray-500 mb-2">{{ $category->slug }}</p>
                        
                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            <span>
                                <i class="fas fa-box text-gray-400 mr-1"></i>
                                {{ $category->products_count }} produit{{ $category->products_count > 1 ? 's' : '' }}
                            </span>
                            <span>
                                <i class="fas fa-sort text-gray-400 mr-1"></i>
                                Ordre: <span class="order-value">{{ $category->order + 1 }}</span>
                            </span>
                        </div>
                    </div>

                    <!-- Status Toggle -->
                    <label class="toggle-switch flex-shrink-0">
                        <input type="checkbox" 
                               {{ $category->is_active ? 'checked' : '' }}
                               onchange="toggleStatus({{ $category->id }}, this)"
                               class="status-toggle">
                        <span class="toggle-slider"></span>
                    </label>
                    
                    <!-- Actions -->
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" 
                           class="px-3 py-2 bg-blue-50 text-blue-600 rounded text-sm hover:bg-blue-100 transition-colors">
                            <i class="fas fa-edit mr-1"></i>Modifier
                        </a>
                        
                        <div class="dropdown">
                            <button onclick="toggleDropdown(this)" 
                                    class="px-3 py-2 bg-gray-100 text-gray-600 rounded text-sm hover:bg-gray-200 transition-colors">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu">
                                <div class="dropdown-item" onclick="quickView({{ $category->id }})">
                                    <i class="fas fa-eye"></i>
                                    Aperçu rapide
                                </div>
                                <a href="{{ route('admin.products.index') }}?categories[]={{ $category->id }}" 
                                   class="dropdown-item">
                                    <i class="fas fa-box"></i>
                                    Voir les produits
                                </a>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-item text-red-600" onclick="deleteCategory({{ $category->id }})">
                                    <i class="fas fa-trash"></i>
                                    Supprimer
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                @if(request('search'))
                    <!-- Search No Results -->
                    <div class="flex flex-col items-center justify-center text-gray-500 py-12">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-search text-gray-300 text-4xl"></i>
                        </div>
                        <p class="text-xl font-semibold text-gray-700 mb-2">Aucun résultat trouvé</p>
                        <p class="text-sm text-gray-500 mb-4">Aucune catégorie ne correspond à "{{ request('search') }}"</p>
                        <a href="{{ route('admin.categories.index') }}" 
                           class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                            <i class="fas fa-times mr-2"></i>Effacer la recherche
                        </a>
                    </div>
                @else
                    <!-- No Categories at All -->
                    <div class="flex flex-col items-center justify-center text-gray-500 py-12">
                        <div class="w-32 h-32 bg-gradient-to-br from-blue-50 to-primary/10 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-tags text-primary text-6xl"></i>
                        </div>
                        <p class="text-2xl font-bold text-gray-900 mb-2">Aucune catégorie</p>
                        <p class="text-sm text-gray-500 mb-6 max-w-md text-center">
                            Organisez vos produits en créant des catégories. Les catégories aident vos clients à naviguer facilement dans votre boutique.
                        </p>
                        <a href="{{ route('admin.categories.create') }}" 
                           class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-colors shadow-lg">
                            <i class="fas fa-plus mr-2"></i>Créer votre première catégorie
                        </a>
                    </div>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Quick View Modal -->
    <div id="quick-view-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
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

    </div> <!-- End Main Content -->
    
</div> <!-- End Flex Container -->

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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    let sortableTable = null;
    let sortableGrid = null;
    let reorderMode = false;
    let originalOrder = [];
    let selectedCategories = new Set();
    let currentView = 'table';
    let confirmCallback = null;

    // Confirmation Modal Functions
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

    // Switch View
    function switchView(view) {
        currentView = view;
        
        // Update buttons - removed, no more view toggle buttons
        
        // Show/hide views - always show grid view (which is now list view)
        document.getElementById('table-view').classList.toggle('hidden', view !== 'table');
        document.getElementById('grid-view').classList.toggle('hidden', view !== 'grid');
        
        // Save preference
        localStorage.setItem('categories-view', view);
    }

    // Restore view on page load
    document.addEventListener('DOMContentLoaded', function() {
        const savedView = localStorage.getItem('categories-view');
        // Default to table view (which is now vertical list)
        if (savedView && savedView === 'grid') {
            switchView('grid');
        } else {
            switchView('table');
        }
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        });
    });

    // Toggle Dropdown
    function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;
        const isOpen = dropdown.classList.contains('show');
        
        // Close all dropdowns
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.remove('show');
        });
        
        // Toggle current dropdown
        if (!isOpen) {
            dropdown.classList.add('show');
        }
    }

    // Enable Inline Edit
    function enableInlineEdit(element, field) {
        if (reorderMode) return; // Don't allow inline edit during reorder mode
        
        const categoryId = element.dataset.id;
        const currentValue = field === 'name' ? element.dataset.name : element.dataset.order;
        
        // Create input
        const input = document.createElement('input');
        input.type = field === 'order' ? 'number' : 'text';
        input.value = currentValue;
        input.className = 'inline-edit-input';
        
        if (field === 'order') {
            input.min = 0;
            input.style.width = '60px';
        }
        
        // Replace element with input
        const originalHTML = element.innerHTML;
        element.innerHTML = '';
        element.appendChild(input);
        input.focus();
        input.select();
        
        // Save on Enter
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                saveInlineEdit(categoryId, field, input.value, element, originalHTML);
            } else if (e.key === 'Escape') {
                element.innerHTML = originalHTML;
            }
        });
        
        // Save on blur
        input.addEventListener('blur', function() {
            setTimeout(() => {
                if (element.contains(input)) {
                    saveInlineEdit(categoryId, field, input.value, element, originalHTML);
                }
            }, 200);
        });
    }

    // Save Inline Edit
    function saveInlineEdit(categoryId, field, newValue, element, originalHTML) {
        const oldValue = field === 'name' ? element.dataset.name : element.dataset.order;
        
        // Check if value changed
        if (newValue === oldValue) {
            element.innerHTML = originalHTML;
            return;
        }
        
        // Validate
        if (field === 'name' && !newValue.trim()) {
            showNotification('Le nom ne peut pas être vide', 'error');
            element.innerHTML = originalHTML;
            return;
        }
        
        if (field === 'order' && (isNaN(newValue) || newValue < 0)) {
            showNotification('L\'ordre doit être un nombre positif', 'error');
            element.innerHTML = originalHTML;
            return;
        }
        
        // Show loading
        element.innerHTML = '<i class="fas fa-spinner fa-spin text-gray-400"></i>';
        
        // Send AJAX request
        fetch(`/admin/categories/${categoryId}/inline-update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                field: field,
                value: newValue
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Erreur lors de la mise à jour');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update element
                if (field === 'name') {
                    element.dataset.name = newValue;
                    element.innerHTML = newValue;
                } else {
                    element.dataset.order = newValue;
                    element.innerHTML = newValue;
                }
                showNotification('Mis à jour avec succès', 'success');
            } else {
                element.innerHTML = originalHTML;
                showNotification(data.message || 'Erreur lors de la mise à jour', 'error');
            }
        })
        .catch(error => {
            element.innerHTML = originalHTML;
            console.error('Inline edit error:', error);
            showNotification(error.message || 'Erreur de connexion', 'error');
        });
    }

    // Toggle Select All
    function toggleSelectAll(checkbox) {
        const checkboxes = document.querySelectorAll('.category-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = checkbox.checked;
            if (checkbox.checked) {
                selectedCategories.add(parseInt(cb.value));
            } else {
                selectedCategories.delete(parseInt(cb.value));
            }
        });
        updateBulkActionsBar();
    }

    // Toggle Category Selection
    function toggleCategorySelection(checkbox) {
        const categoryId = parseInt(checkbox.value);
        if (checkbox.checked) {
            selectedCategories.add(categoryId);
        } else {
            selectedCategories.delete(categoryId);
            document.getElementById('select-all').checked = false;
        }
        updateBulkActionsBar();
    }

    // Update Bulk Actions Bar
    function updateBulkActionsBar() {
        const inlineActions = document.getElementById('inline-bulk-actions');
        const count = selectedCategories.size;
        
        if (count > 0) {
            inlineActions.classList.remove('hidden');
            document.getElementById('inline-selected-count').textContent = `${count} sélectionné(s)`;
        } else {
            inlineActions.classList.add('hidden');
        }
    }

    // Clear Selection
    function clearSelection() {
        selectedCategories.clear();
        document.querySelectorAll('.category-checkbox').forEach(cb => cb.checked = false);
        document.getElementById('select-all').checked = false;
        updateBulkActionsBar();
    }

    // Apply Bulk Action
    function applyBulkAction() {
        const action = document.getElementById('bulk-action-select')?.value || document.getElementById('inline-bulk-action-select')?.value;
        
        if (!action) {
            showNotification('Veuillez sélectionner une action', 'error');
            return;
        }
        
        if (selectedCategories.size === 0) {
            showNotification('Veuillez sélectionner au moins une catégorie', 'error');
            return;
        }
        
        // Show confirmation modal for delete action
        if (action === 'delete') {
            showConfirmation(
                'Supprimer les catégories',
                `Êtes-vous sûr de vouloir supprimer ${selectedCategories.size} catégorie(s) ?`,
                () => executeBulkAction(action),
                'danger'
            );
            return;
        }
        
        // Execute other actions directly
        executeBulkAction(action);
    }
    
    // Execute Bulk Action (separated for confirmation modal)
    function executeBulkAction(action) {
        fetch('/admin/categories/bulk-action', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                action: action,
                categories: Array.from(selectedCategories)
            })
        })
        .then(response => {
            // Check if response is ok (status 200-299)
            if (!response.ok) {
                // For non-2xx responses, still try to parse JSON for error message
                return response.json().then(data => {
                    throw new Error(data.message || 'Erreur lors de l\'action');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showNotification(data.message || 'Action appliquée avec succès', 'success');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showNotification(data.message || 'Erreur lors de l\'action', 'error');
            }
        })
        .catch(error => {
            console.error('Bulk action error:', error);
            showNotification(error.message || 'Erreur de connexion', 'error');
        });
    }
    
    // Apply Inline Bulk Action (alias)
    function applyInlineBulkAction() {
        applyBulkAction();
    }

    // Toggle Status via AJAX
    function toggleStatus(categoryId, checkbox) {
        const isActive = checkbox.checked;
        
        fetch(`/admin/categories/${categoryId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ is_active: isActive })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Erreur lors de la mise à jour');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showNotification('Statut mis à jour avec succès', 'success');
            } else {
                checkbox.checked = !isActive;
                showNotification(data.message || 'Erreur lors de la mise à jour', 'error');
            }
        })
        .catch(error => {
            checkbox.checked = !isActive;
            console.error('Toggle status error:', error);
            showNotification(error.message || 'Erreur de connexion', 'error');
        });
    }

    // Toggle Reorder Mode
    function toggleReorderMode() {
        reorderMode = !reorderMode;
        
        const dragHandles = document.querySelectorAll('.drag-handle');
        const dragHandlesGrid = document.querySelectorAll('.drag-handle-grid');
        const dragHeader = document.getElementById('drag-header');
        const reorderBtn = document.getElementById('reorder-btn');
        const saveBtn = document.getElementById('save-order-btn');
        const cancelBtn = document.getElementById('cancel-order-btn');
        
        if (reorderMode) {
            // Enable reorder mode
            dragHandles.forEach(handle => handle.classList.remove('hidden'));
            dragHandlesGrid.forEach(handle => handle.classList.remove('hidden'));
            dragHeader.classList.remove('hidden');
            reorderBtn.classList.add('hidden');
            saveBtn.classList.remove('hidden');
            cancelBtn.classList.remove('hidden');
            
            // Store original order based on current view
            if (currentView === 'table') {
                originalOrder = Array.from(document.querySelectorAll('.category-row')).map(row => ({
                    id: row.dataset.id,
                    order: row.querySelector('.order-value').textContent
                }));
            } else {
                originalOrder = Array.from(document.querySelectorAll('#grid-view > div[data-id]')).map(card => ({
                    id: card.dataset.id,
                    order: card.querySelector('.text-sm.text-gray-600:last-of-type').textContent.replace('Ordre: ', '').trim()
                }));
            }
            
            // Initialize Sortable
            initSortable();
            
            showNotification('Mode réorganisation activé - Glissez-déposez les éléments', 'info');
        } else {
            // Disable reorder mode
            disableReorderMode();
        }
    }

    // Initialize Sortable.js
    function initSortable() {
        // Initialize table sortable
        const tbody = document.getElementById('sortable-categories');
        if (tbody) {
            sortableTable = new Sortable(tbody, {
                animation: 150,
                handle: '.drag-handle',
                ghostClass: 'sortable-ghost',
                onEnd: function(evt) {
                    updateOrderNumbers();
                }
            });
        }
        
        // Initialize grid sortable
        const gridView = document.getElementById('grid-view');
        if (gridView) {
            sortableGrid = new Sortable(gridView, {
                animation: 150,
                handle: '.drag-handle-grid',
                ghostClass: 'sortable-ghost',
                filter: '.col-span-full',
                onEnd: function(evt) {
                    updateOrderNumbers();
                }
            });
        }
    }

    // Update order numbers in UI
    function updateOrderNumbers() {
        if (currentView === 'table') {
            const rows = document.querySelectorAll('.category-row');
            rows.forEach((row, index) => {
                row.querySelector('.order-value').textContent = index + 1;
            });
        } else {
            const cards = document.querySelectorAll('#grid-view > div[data-id]');
            cards.forEach((card, index) => {
                const orderSpan = card.querySelector('.text-sm.text-gray-600:last-of-type');
                if (orderSpan) {
                    orderSpan.innerHTML = `<i class="fas fa-sort text-gray-400 mr-1"></i>Ordre: ${index + 1}`;
                }
            });
        }
    }

    // Save Order
    function saveOrder() {
        let rows;
        
        if (currentView === 'table') {
            rows = document.querySelectorAll('.category-row');
        } else {
            rows = document.querySelectorAll('#grid-view > div[data-id]');
        }
        
        const categories = Array.from(rows).map((row, index) => ({
            id: parseInt(row.dataset.id),
            order: index
        }));
        
        fetch('/admin/categories/reorder', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ categories: categories })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Erreur lors de l\'enregistrement');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showNotification('Ordre enregistré avec succès', 'success');
                disableReorderMode();
            } else {
                showNotification(data.message || 'Erreur lors de l\'enregistrement', 'error');
            }
        })
        .catch(error => {
            console.error('Save order error:', error);
            showNotification(error.message || 'Erreur de connexion', 'error');
        });
    }

    // Cancel Reorder
    function cancelReorder() {
        // Restore original order
        const tbody = document.getElementById('sortable-categories');
        const rows = Array.from(document.querySelectorAll('.category-row'));
        
        // Sort rows by original order
        rows.sort((a, b) => {
            const orderA = originalOrder.find(o => o.id == a.dataset.id).order;
            const orderB = originalOrder.find(o => o.id == b.dataset.id).order;
            return orderA - orderB;
        });
        
        // Re-append in correct order
        rows.forEach(row => tbody.appendChild(row));
        
        // Update order numbers
        rows.forEach((row, index) => {
            const originalOrderValue = originalOrder.find(o => o.id == row.dataset.id).order;
            row.querySelector('.order-value').textContent = originalOrderValue;
        });
        
        disableReorderMode();
        showNotification('Modifications annulées', 'info');
    }

    // Disable Reorder Mode
    function disableReorderMode() {
        reorderMode = false;
        
        const dragHandles = document.querySelectorAll('.drag-handle');
        const dragHandlesGrid = document.querySelectorAll('.drag-handle-grid');
        const dragHeader = document.getElementById('drag-header');
        const reorderBtn = document.getElementById('reorder-btn');
        const saveBtn = document.getElementById('save-order-btn');
        const cancelBtn = document.getElementById('cancel-order-btn');
        
        dragHandles.forEach(handle => handle.classList.add('hidden'));
        dragHandlesGrid.forEach(handle => handle.classList.add('hidden'));
        dragHeader.classList.add('hidden');
        reorderBtn.classList.remove('hidden');
        saveBtn.classList.add('hidden');
        cancelBtn.classList.add('hidden');
        
        if (sortableTable) {
            sortableTable.destroy();
            sortableTable = null;
        }
        if (sortableGrid) {
            sortableGrid.destroy();
            sortableGrid = null;
        }
    }

    // Delete Category
    function deleteCategory(categoryId) {
        showConfirmation(
            'Supprimer la catégorie',
            'Êtes-vous sûr de vouloir supprimer cette catégorie ?',
            () => executeDeleteCategory(categoryId),
            'danger'
        );
    }
    
    // Execute Delete Category (separated for confirmation modal)
    function executeDeleteCategory(categoryId) {
        fetch(`/admin/categories/${categoryId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Erreur lors de la suppression');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showNotification('Catégorie supprimée avec succès', 'success');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showNotification(data.message || 'Erreur lors de la suppression', 'error');
            }
        })
        .catch(error => {
            console.error('Delete category error:', error);
            showNotification(error.message || 'Erreur de connexion', 'error');
        });
    }

    // Show Notification
    function showNotification(message, type = 'info') {
        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            info: 'bg-blue-500'
        };
        
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Auto-submit search on input (debounced)
    let searchTimeout;
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                this.form.submit();
            }, 500);
        });
    }

    // Toggle Filter Sidebar
    function toggleFilterSidebar() {
        const wrapper = document.getElementById('filter-sidebar-wrapper');
        const btn = document.getElementById('filter-toggle-btn');
        const isHidden = wrapper.classList.contains('hidden');
        
        wrapper.classList.toggle('hidden');
        
        // Update button appearance
        if (isHidden) {
            btn.classList.add('bg-primary', 'text-white', 'border-primary');
            btn.classList.remove('hover:bg-gray-50');
        } else {
            btn.classList.remove('bg-primary', 'text-white', 'border-primary');
            btn.classList.add('hover:bg-gray-50');
        }
        
        // Close on overlay click (mobile only)
        if (window.innerWidth < 1024 && isHidden) {
            wrapper.addEventListener('click', function(e) {
                if (e.target === wrapper) {
                    toggleFilterSidebar();
                }
            });
        }
    }

    // Toggle Filter Accordion
    function toggleFilterAccordion(header) {
        const content = header.nextElementSibling;
        const icon = header.querySelector('.filter-accordion-icon');
        
        content.classList.toggle('open');
        icon.classList.toggle('open');
    }

    // Update Filter Chips
    function updateFilterChips() {
        const form = document.getElementById('filter-form');
        if (!form) return;
        
        const formData = new FormData(form);
        const chips = [];
        
        // Status
        const status = formData.get('status');
        if (status) {
            const labels = {active: 'Actif', inactive: 'Inactif'};
            chips.push({type: 'status', label: labels[status], value: status});
        }
        
        // Type
        const type = formData.get('type');
        if (type) {
            const labels = {parent: 'Parentes', child: 'Sous-catégories'};
            chips.push({type: 'type', label: labels[type], value: type});
        }
        
        // Products
        const products = formData.get('products');
        if (products) {
            const labels = {none: 'Aucun produit', '1-10': '1-10 produits', '10-50': '10-50 produits', '50+': '50+ produits'};
            chips.push({type: 'products', label: labels[products], value: products});
        }
        
        // Has Image
        const hasImage = formData.get('has_image');
        if (hasImage) {
            const labels = {yes: 'Avec image', no: 'Sans image'};
            chips.push({type: 'has_image', label: labels[hasImage], value: hasImage});
        }
        
        // Render chips
        const chipsContainer = document.getElementById('filter-chips-container');
        const activeSection = document.getElementById('active-filters-chips');
        const activeCount = document.getElementById('filter-active-count');
        
        if (chips.length > 0 && chipsContainer) {
            chipsContainer.innerHTML = chips.map(chip => `
                <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                    ${chip.label}
                    <button type="button" onclick="removeFilter('${chip.type}')" class="ml-2 hover:text-blue-900">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </span>
            `).join('');
            activeSection.classList.remove('hidden');
            activeCount.classList.remove('hidden');
            activeCount.textContent = chips.length;
        } else if (activeSection) {
            activeSection.classList.add('hidden');
            activeCount.classList.add('hidden');
        }
    }

    // Remove Filter
    function removeFilter(type) {
        const input = document.querySelector(`input[name="${type}"][value=""]`);
        if (input) {
            input.checked = true;
            document.getElementById('filter-form').submit();
        }
    }

    // Clear All Filters
    function clearAllFilters() {
        window.location.href = '{{ route("admin.categories.index") }}';
    }

    // Reset Filters
    function resetFilters() {
        clearAllFilters();
    }

    // Quick View Modal
    function quickView(categoryId) {
        document.getElementById('quick-view-modal').classList.remove('hidden');
        document.getElementById('quick-view-content').innerHTML = '<div class="text-center py-12"><i class="fas fa-spinner fa-spin text-4xl text-primary"></i></div>';
        
        fetch(`/admin/categories/${categoryId}/quick-view`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const category = data.category;
                    document.getElementById('quick-view-content').innerHTML = `
                        <div class="space-y-6">
                            ${category.image ? `
                                <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden">
                                    <img src="${category.image}" alt="${category.name}" class="w-full h-full object-cover">
                                </div>
                            ` : ''}
                            
                            <div>
                                <h4 class="text-2xl font-bold text-gray-900 mb-2">${category.name}</h4>
                                <p class="text-sm text-gray-500 mb-4">${category.slug}</p>
                                ${category.description ? `<p class="text-gray-700">${category.description}</p>` : '<p class="text-gray-400 italic">Aucune description</p>'}
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500 mb-1">Produits</p>
                                    <p class="text-2xl font-bold text-gray-900">${category.products_count}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500 mb-1">Statut</p>
                                    <p class="text-lg font-semibold ${category.is_active ? 'text-green-600' : 'text-gray-600'}">${category.is_active ? 'Actif' : 'Inactif'}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500 mb-1">Ordre</p>
                                    <p class="text-2xl font-bold text-gray-900">${category.order}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-500 mb-1">Créée le</p>
                                    <p class="text-sm text-gray-900">${new Date(category.created_at).toLocaleDateString('fr-FR')}</p>
                                </div>
                            </div>
                            
                            <div class="flex gap-3 pt-4 border-t">
                                <a href="/admin/categories/${category.id}/edit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-center transition-colors">
                                    <i class="fas fa-edit mr-2"></i>Modifier
                                </a>
                                <button onclick="toggleStatus(${category.id}, this); closeQuickView();" class="flex-1 px-4 py-2 ${category.is_active ? 'bg-gray-600' : 'bg-green-600'} text-white rounded-lg hover:opacity-90 transition-colors">
                                    <i class="fas fa-toggle-${category.is_active ? 'off' : 'on'} mr-2"></i>${category.is_active ? 'Désactiver' : 'Activer'}
                                </button>
                            </div>
                        </div>
                    `;
                } else {
                    document.getElementById('quick-view-content').innerHTML = '<p class="text-center text-red-500">Erreur de chargement</p>';
                }
            })
            .catch(error => {
                document.getElementById('quick-view-content').innerHTML = '<p class="text-center text-red-500">Erreur de chargement</p>';
            });
    }

    function closeQuickView() {
        document.getElementById('quick-view-modal').classList.add('hidden');
    }

    // Close modal on outside click
    document.getElementById('quick-view-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeQuickView();
        }
    });

    // Close confirmation modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeConfirmation();
        }
    });

    // Close confirmation modal on outside click
    document.getElementById('confirmation-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeConfirmation();
        }
    });
</script>
@endpush
