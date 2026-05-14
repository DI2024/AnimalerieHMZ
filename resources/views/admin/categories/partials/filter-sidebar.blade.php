<aside id="filter-sidebar" class="filter-sidebar bg-white rounded-lg shadow flex-shrink-0 overflow-hidden hidden">
    <!-- Header -->
    <div class="flex items-center justify-between p-4 border-b bg-gradient-to-r from-gray-50 to-gray-100">
        <div class="flex items-center space-x-2">
            <i class="fas fa-filter text-primary"></i>
            <h3 class="text-lg font-semibold text-gray-900">Filtres</h3>
            <span id="filter-active-count" class="hidden px-2 py-0.5 bg-primary text-white text-xs rounded-full">0</span>
        </div>
        <button onclick="toggleFilterSidebar()" class="text-gray-400 hover:text-gray-600 transition-colors lg:hidden">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <!-- Active Filters Chips -->
    <div id="active-filters-chips" class="hidden p-4 border-b bg-blue-50">
        <div class="flex flex-wrap gap-2 mb-2" id="filter-chips-container">
            <!-- Chips added dynamically -->
        </div>
        <button onclick="clearAllFilters()" class="text-xs text-blue-600 hover:text-blue-800 font-medium transition-colors">
            <i class="fas fa-times-circle mr-1"></i>Effacer tout
        </button>
    </div>

    <form method="GET" id="filter-form" class="overflow-y-auto" style="max-height: calc(100vh - 200px);">
        
        <!-- Status Filter -->
        <div class="filter-accordion">
            <div class="filter-accordion-header" onclick="toggleFilterAccordion(this)">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-toggle-on text-primary"></i>
                    <span class="text-sm font-medium text-gray-900">Statut</span>
                    <span class="filter-count hidden px-1.5 py-0.5 bg-gray-200 text-gray-700 text-xs rounded">0</span>
                </div>
                <i class="fas fa-chevron-down filter-accordion-icon text-gray-400 text-sm"></i>
            </div>
            <div class="filter-accordion-content">
                <div class="space-y-1">
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                        <input type="radio" name="status" value=""
                               {{ request('status') == '' ? 'checked' : '' }}
                               onchange="updateFilterChips()"
                               class="text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">Tous</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                        <input type="radio" name="status" value="active"
                               {{ request('status') == 'active' ? 'checked' : '' }}
                               onchange="updateFilterChips()"
                               class="text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">Actif</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                        <input type="radio" name="status" value="inactive"
                               {{ request('status') == 'inactive' ? 'checked' : '' }}
                               onchange="updateFilterChips()"
                               class="text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">Inactif</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Products Count Filter -->
        <div class="filter-accordion">
            <div class="filter-accordion-header" onclick="toggleFilterAccordion(this)">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-box text-primary"></i>
                    <span class="text-sm font-medium text-gray-900">Nombre de produits</span>
                </div>
                <i class="fas fa-chevron-down filter-accordion-icon text-gray-400 text-sm"></i>
            </div>
            <div class="filter-accordion-content">
                <div class="space-y-1">
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                        <input type="radio" name="products" value=""
                               {{ request('products') == '' ? 'checked' : '' }}
                               onchange="updateFilterChips()"
                               class="text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">Tous</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                        <input type="radio" name="products" value="none"
                               {{ request('products') == 'none' ? 'checked' : '' }}
                               onchange="updateFilterChips()"
                               class="text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">Aucun produit</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                        <input type="radio" name="products" value="1-10"
                               {{ request('products') == '1-10' ? 'checked' : '' }}
                               onchange="updateFilterChips()"
                               class="text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">1-10 produits</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                        <input type="radio" name="products" value="10-50"
                               {{ request('products') == '10-50' ? 'checked' : '' }}
                               onchange="updateFilterChips()"
                               class="text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">10-50 produits</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                        <input type="radio" name="products" value="50+"
                               {{ request('products') == '50+' ? 'checked' : '' }}
                               onchange="updateFilterChips()"
                               class="text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">50+ produits</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="p-4 border-t bg-gray-50 flex space-x-2">
            <button type="button" onclick="resetFilters()" 
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-white text-sm font-medium transition-colors">
                Réinitialiser
            </button>
            <button type="submit" 
                    class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-yellow-600 text-sm font-medium transition-colors">
                Appliquer
            </button>
        </div>
    </form>
</aside>
