<div class="bg-white rounded-lg shadow p-6 space-y-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900">
            <i class="fas fa-filter mr-2"></i>Filtres
        </h3>
        <button onclick="clearAllFilters()" class="text-sm text-red-600 hover:text-red-800">
            <i class="fas fa-times-circle mr-1"></i>Effacer tout
        </button>
    </div>

    <form id="filterForm" method="GET" action="{{ route('admin.offers.index') }}">
        <!-- Keep search parameter -->
        <input type="hidden" name="search" value="{{ request('search') }}">

        <!-- Status Filter -->
        <div class="filter-section">
            <button type="button" onclick="toggleSection('statusSection')" 
                    class="w-full flex items-center justify-between py-2 text-sm font-medium text-gray-700">
                <span><i class="fas fa-toggle-on mr-2 text-primary"></i>Statut</span>
                <i class="fas fa-chevron-down transition-transform" id="statusSectionIcon"></i>
            </button>
            <div id="statusSection" class="mt-3 space-y-2 hidden">
                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded">
                    <input type="checkbox" name="status_filter[]" value="active" 
                           {{ in_array('active', request('status_filter', [])) ? 'checked' : '' }}
                           class="rounded text-primary focus:ring-primary">
                    <span class="text-sm text-gray-700">Actives</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded">
                    <input type="checkbox" name="status_filter[]" value="expiring_soon" 
                           {{ in_array('expiring_soon', request('status_filter', [])) ? 'checked' : '' }}
                           class="rounded text-primary focus:ring-primary">
                    <span class="text-sm text-gray-700">Expire Bientôt</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded">
                    <input type="checkbox" name="status_filter[]" value="expired" 
                           {{ in_array('expired', request('status_filter', [])) ? 'checked' : '' }}
                           class="rounded text-primary focus:ring-primary">
                    <span class="text-sm text-gray-700">Expirées</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded">
                    <input type="checkbox" name="status_filter[]" value="inactive" 
                           {{ in_array('inactive', request('status_filter', [])) ? 'checked' : '' }}
                           class="rounded text-primary focus:ring-primary">
                    <span class="text-sm text-gray-700">Inactives</span>
                </label>
            </div>
        </div>

        <hr class="my-4">

        <!-- Type Filter -->
        <div class="filter-section">
            <button type="button" onclick="toggleSection('typeSection')" 
                    class="w-full flex items-center justify-between py-2 text-sm font-medium text-gray-700">
                <span><i class="fas fa-tag mr-2 text-primary"></i>Type de réduction</span>
                <i class="fas fa-chevron-down transition-transform" id="typeSectionIcon"></i>
            </button>
            <div id="typeSection" class="mt-3 space-y-2 hidden">
                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded">
                    <input type="checkbox" name="type_filter[]" value="percentage" 
                           {{ in_array('percentage', request('type_filter', [])) ? 'checked' : '' }}
                           class="rounded text-primary focus:ring-primary">
                    <span class="text-sm text-gray-700">Pourcentage</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded">
                    <input type="checkbox" name="type_filter[]" value="fixed" 
                           {{ in_array('fixed', request('type_filter', [])) ? 'checked' : '' }}
                           class="rounded text-primary focus:ring-primary">
                    <span class="text-sm text-gray-700">Fixe</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded">
                    <input type="checkbox" name="type_filter[]" value="category" 
                           {{ in_array('category', request('type_filter', [])) ? 'checked' : '' }}
                           class="rounded text-primary focus:ring-primary">
                    <span class="text-sm text-gray-700">Catégorie</span>
                </label>
            </div>
        </div>

        <hr class="my-4">

        <!-- Target Filter -->
        <div class="filter-section">
            <button type="button" onclick="toggleSection('targetSection')" 
                    class="w-full flex items-center justify-between py-2 text-sm font-medium text-gray-700">
                <span><i class="fas fa-bullseye mr-2 text-primary"></i>Cible</span>
                <i class="fas fa-chevron-down transition-transform" id="targetSectionIcon"></i>
            </button>
            <div id="targetSection" class="mt-3 space-y-2 hidden">
                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded">
                    <input type="checkbox" name="target_filter[]" value="product" 
                           {{ in_array('product', request('target_filter', [])) ? 'checked' : '' }}
                           class="rounded text-primary focus:ring-primary">
                    <span class="text-sm text-gray-700">Produit</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded">
                    <input type="checkbox" name="target_filter[]" value="category" 
                           {{ in_array('category', request('target_filter', [])) ? 'checked' : '' }}
                           class="rounded text-primary focus:ring-primary">
                    <span class="text-sm text-gray-700">Catégorie</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded">
                    <input type="checkbox" name="target_filter[]" value="all" 
                           {{ in_array('all', request('target_filter', [])) ? 'checked' : '' }}
                           class="rounded text-primary focus:ring-primary">
                    <span class="text-sm text-gray-700">Tous</span>
                </label>
            </div>
        </div>

        <hr class="my-4">

        <!-- Date Range Filter -->
        <div class="filter-section">
            <button type="button" onclick="toggleSection('dateSection')" 
                    class="w-full flex items-center justify-between py-2 text-sm font-medium text-gray-700">
                <span><i class="fas fa-calendar-alt mr-2 text-primary"></i>Période</span>
                <i class="fas fa-chevron-down transition-transform" id="dateSectionIcon"></i>
            </button>
            <div id="dateSection" class="mt-3 space-y-3 hidden">
                <div>
                    <label class="text-xs text-gray-600 mb-1 block">Date de début</label>
                    <input type="date" name="start_date_from" value="{{ request('start_date_from') }}"
                           class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="text-xs text-gray-600 mb-1 block">Date de fin</label>
                    <input type="date" name="end_date_to" value="{{ request('end_date_to') }}"
                           class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
            </div>
        </div>

        <hr class="my-4">

        <!-- Value Range Filter -->
        <div class="filter-section">
            <button type="button" onclick="toggleSection('valueSection')" 
                    class="w-full flex items-center justify-between py-2 text-sm font-medium text-gray-700">
                <span><i class="fas fa-dollar-sign mr-2 text-primary"></i>Valeur</span>
                <i class="fas fa-chevron-down transition-transform" id="valueSectionIcon"></i>
            </button>
            <div id="valueSection" class="mt-3 space-y-3 hidden">
                <div>
                    <label class="text-xs text-gray-600 mb-1 block">Minimum</label>
                    <input type="number" name="value_min" value="{{ request('value_min') }}" min="0" step="0.01"
                           class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                <div>
                    <label class="text-xs text-gray-600 mb-1 block">Maximum</label>
                    <input type="number" name="value_max" value="{{ request('value_max') }}" min="0" step="0.01"
                           class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
            </div>
        </div>

        <!-- Apply Button -->
        <button type="submit" class="w-full mt-6 px-4 py-3 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-colors font-medium">
            <i class="fas fa-check mr-2"></i>Appliquer les filtres
        </button>
    </form>
</div>
