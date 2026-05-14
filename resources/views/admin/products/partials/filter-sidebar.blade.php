<aside id="filter-sidebar" class="filter-sidebar bg-white rounded-lg shadow flex-shrink-0 overflow-hidden">
    <!-- Header -->
    <div class="flex items-center justify-between p-4 border-b bg-gradient-to-r from-gray-50 to-gray-100">
        <div class="flex items-center space-x-2">
            <i class="fas fa-filter text-primary"></i>
            <h3 class="text-lg font-semibold text-gray-900">Filtres</h3>
            <span id="active-count" class="hidden px-2 py-0.5 bg-primary text-white text-xs rounded-full">0</span>
        </div>
        <button onclick="toggleFilters()" class="text-gray-400 hover:text-gray-600 transition-colors lg:hidden">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <!-- Active Filters Chips -->
    <div id="active-filters-section" class="hidden p-4 border-b bg-blue-50">
        <div class="flex flex-wrap gap-2 mb-2" id="filter-chips">
            <!-- Chips added dynamically -->
        </div>
        <button onclick="clearAllFilters()" class="text-xs text-blue-600 hover:text-blue-800 font-medium transition-colors">
            <i class="fas fa-times-circle mr-1"></i>Effacer tout
        </button>
    </div>

    <form method="GET" id="filter-form" class="overflow-y-auto" style="max-height: calc(100vh - 200px);">
        
        <!-- Quick Search -->
        <div class="p-4 border-b bg-gray-50">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Recherche rapide..."
                       oninput="updateFilterChips()"
                       class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary text-sm">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>

        <!-- Category Accordion -->
        <div class="filter-accordion">
            <div class="filter-accordion-header" onclick="toggleAccordion(this)">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-folder text-primary"></i>
                    <span class="text-sm font-medium text-gray-900">Catégorie</span>
                    <span class="filter-count hidden px-1.5 py-0.5 bg-gray-200 text-gray-700 text-xs rounded">0</span>
                </div>
                <i class="fas fa-chevron-down filter-accordion-icon text-gray-400 text-sm"></i>
            </div>
            <div class="filter-accordion-content">
                <div class="space-y-1 max-h-64 overflow-y-auto">
                    @foreach($categories as $category)
                        <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                   {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                   onchange="updateFilterChips()"
                                   class="rounded text-primary focus:ring-primary">
                            <span class="text-sm text-gray-700 flex-1">{{ $category->name }}</span>
                            <span class="text-xs text-gray-400">({{ $category->products_count ?? 0 }})</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Price Range Accordion -->
        <div class="filter-accordion">
            <div class="filter-accordion-header" onclick="toggleAccordion(this)">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-dollar-sign text-primary"></i>
                    <span class="text-sm font-medium text-gray-900">Prix</span>
                </div>
                <i class="fas fa-chevron-down filter-accordion-icon text-gray-400 text-sm"></i>
            </div>
            <div class="filter-accordion-content">
                <div class="space-y-3">
                    <!-- Price Inputs -->
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="text-xs text-gray-600 mb-1 block">Min (DH)</label>
                            <input type="number" name="price_min" value="{{ request('price_min', 0) }}" 
                                   min="0" step="10"
                                   oninput="updateFilterChips()"
                                   class="w-full px-3 py-1.5 border rounded text-sm focus:ring-2 focus:ring-primary">
                        </div>
                        <div>
                            <label class="text-xs text-gray-600 mb-1 block">Max (DH)</label>
                            <input type="number" name="price_max" value="{{ request('price_max', 5000) }}" 
                                   min="0" step="10"
                                   oninput="updateFilterChips()"
                                   class="w-full px-3 py-1.5 border rounded text-sm focus:ring-2 focus:ring-primary">
                        </div>
                    </div>
                    
                    <!-- Quick Price Ranges -->
                    <div class="flex flex-wrap gap-1">
                        <button type="button" onclick="setPriceRange(0, 100)" class="px-2 py-1 text-xs border rounded hover:bg-gray-50">0-100</button>
                        <button type="button" onclick="setPriceRange(100, 500)" class="px-2 py-1 text-xs border rounded hover:bg-gray-50">100-500</button>
                        <button type="button" onclick="setPriceRange(500, 1000)" class="px-2 py-1 text-xs border rounded hover:bg-gray-50">500-1000</button>
                        <button type="button" onclick="setPriceRange(1000, 5000)" class="px-2 py-1 text-xs border rounded hover:bg-gray-50">1000+</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock Status Accordion -->
        <div class="filter-accordion">
            <div class="filter-accordion-header" onclick="toggleAccordion(this)">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-box text-primary"></i>
                    <span class="text-sm font-medium text-gray-900">Stock</span>
                    <span class="filter-count hidden px-1.5 py-0.5 bg-gray-200 text-gray-700 text-xs rounded">0</span>
                </div>
                <i class="fas fa-chevron-down filter-accordion-icon text-gray-400 text-sm"></i>
            </div>
            <div class="filter-accordion-content">
                <div class="space-y-1">
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                        <input type="checkbox" name="stock[]" value="in_stock"
                               {{ in_array('in_stock', request('stock', [])) ? 'checked' : '' }}
                               onchange="updateFilterChips()"
                               class="rounded text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">En stock</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                        <input type="checkbox" name="stock[]" value="low_stock"
                               {{ in_array('low_stock', request('stock', [])) ? 'checked' : '' }}
                               onchange="updateFilterChips()"
                               class="rounded text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">Stock faible</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                        <input type="checkbox" name="stock[]" value="out_of_stock"
                               {{ in_array('out_of_stock', request('stock', [])) ? 'checked' : '' }}
                               onchange="updateFilterChips()"
                               class="rounded text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">Rupture</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Badges Accordion -->
        <div class="filter-accordion">
            <div class="filter-accordion-header" onclick="toggleAccordion(this)">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-tag text-primary"></i>
                    <span class="text-sm font-medium text-gray-900">Badges</span>
                    <span class="filter-count hidden px-1.5 py-0.5 bg-gray-200 text-gray-700 text-xs rounded">0</span>
                </div>
                <i class="fas fa-chevron-down filter-accordion-icon text-gray-400 text-sm"></i>
            </div>
            <div class="filter-accordion-content">
                <div class="space-y-1">
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                        <input type="checkbox" name="badges[]" value="new"
                               {{ in_array('new', request('badges', [])) ? 'checked' : '' }}
                               onchange="updateFilterChips()"
                               class="rounded text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">Nouveau</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                        <input type="checkbox" name="badges[]" value="bestseller"
                               {{ in_array('bestseller', request('badges', [])) ? 'checked' : '' }}
                               onchange="updateFilterChips()"
                               class="rounded text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">Bestseller</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded transition-colors">
                        <input type="checkbox" name="badges[]" value="featured"
                               {{ in_array('featured', request('badges', [])) ? 'checked' : '' }}
                               onchange="updateFilterChips()"
                               class="rounded text-primary focus:ring-primary">
                        <span class="text-sm text-gray-700">Featured</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Status Accordion -->
        <div class="filter-accordion">
            <div class="filter-accordion-header" onclick="toggleAccordion(this)">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-check-circle text-primary"></i>
                    <span class="text-sm font-medium text-gray-900">Statut</span>
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

<script>
// Accordion Toggle
function toggleAccordion(header) {
    const content = header.nextElementSibling;
    const icon = header.querySelector('.filter-accordion-icon');
    const isOpen = content.classList.contains('open');
    
    content.classList.toggle('open');
    icon.classList.toggle('open');
    
    // Save state to localStorage
    const sectionName = header.querySelector('span').textContent;
    localStorage.setItem('filter-' + sectionName, !isOpen);
}

// Update Filter Chips
function updateFilterChips() {
    const form = document.getElementById('filter-form');
    const formData = new FormData(form);
    const chips = [];
    
    // Search
    const search = formData.get('search');
    if (search) {
        chips.push({type: 'search', label: `Recherche: ${search}`, value: search});
    }
    
    // Categories
    const categories = formData.getAll('categories[]');
    categories.forEach(catId => {
        const label = document.querySelector(`input[name="categories[]"][value="${catId}"]`).nextElementSibling.textContent.trim();
        chips.push({type: 'categories[]', label: label, value: catId});
    });
    
    // Price
    const priceMin = formData.get('price_min');
    const priceMax = formData.get('price_max');
    if (priceMin > 0 || priceMax < 5000) {
        chips.push({type: 'price', label: `Prix: ${priceMin}-${priceMax} DH`, value: `${priceMin}-${priceMax}`});
    }
    
    // Stock
    const stock = formData.getAll('stock[]');
    stock.forEach(s => {
        const labels = {in_stock: 'En stock', low_stock: 'Stock faible', out_of_stock: 'Rupture'};
        chips.push({type: 'stock[]', label: labels[s], value: s});
    });
    
    // Badges
    const badges = formData.getAll('badges[]');
    badges.forEach(b => {
        const labels = {new: 'Nouveau', bestseller: 'Bestseller', featured: 'Featured'};
        chips.push({type: 'badges[]', label: labels[b], value: b});
    });
    
    // Status
    const status = formData.get('status');
    if (status) {
        const labels = {active: 'Actif', inactive: 'Inactif'};
        chips.push({type: 'status', label: labels[status], value: status});
    }
    
    // Render chips
    const chipsContainer = document.getElementById('filter-chips');
    const activeSection = document.getElementById('active-filters-section');
    const activeCount = document.getElementById('active-count');
    
    if (chips.length > 0) {
        chipsContainer.innerHTML = chips.map(chip => `
            <span class="filter-chip">
                ${chip.label}
                <button type="button" onclick="removeFilter('${chip.type}', '${chip.value}')" class="hover:text-red-600">
                    <i class="fas fa-times text-xs"></i>
                </button>
            </span>
        `).join('');
        activeSection.classList.remove('hidden');
        activeCount.classList.remove('hidden');
        activeCount.textContent = chips.length;
    } else {
        activeSection.classList.add('hidden');
        activeCount.classList.add('hidden');
    }
    
    // Update section counts
    updateSectionCounts();
}

// Update Section Counts
function updateSectionCounts() {
    const form = document.getElementById('filter-form');
    const formData = new FormData(form);
    
    // Count categories
    const catCount = formData.getAll('categories[]').length;
    updateCountBadge('Catégorie', catCount);
    
    // Count stock
    const stockCount = formData.getAll('stock[]').length;
    updateCountBadge('Stock', stockCount);
    
    // Count badges
    const badgeCount = formData.getAll('badges[]').length;
    updateCountBadge('Badges', badgeCount);
}

function updateCountBadge(sectionName, count) {
    const headers = document.querySelectorAll('.filter-accordion-header');
    headers.forEach(header => {
        const span = header.querySelector('span');
        if (span && span.textContent === sectionName) {
            const countBadge = header.querySelector('.filter-count');
            if (count > 0) {
                countBadge.textContent = count;
                countBadge.classList.remove('hidden');
            } else {
                countBadge.classList.add('hidden');
            }
        }
    });
}

// Remove Filter
function removeFilter(type, value) {
    if (type === 'search') {
        document.querySelector('input[name="search"]').value = '';
    } else if (type === 'price') {
        document.querySelector('input[name="price_min"]').value = 0;
        document.querySelector('input[name="price_max"]').value = 5000;
    } else if (type === 'status') {
        document.querySelector('input[name="status"][value=""]').checked = true;
    } else {
        const input = document.querySelector(`input[name="${type}"][value="${value}"]`);
        if (input) {
            input.checked = false;
        }
    }
    updateFilterChips();
}

// Clear All Filters
function clearAllFilters() {
    document.getElementById('filter-form').reset();
    updateFilterChips();
}

// Reset Filters
function resetFilters() {
    clearAllFilters();
    window.location.href = '{{ route("admin.products.index") }}';
}

// Set Price Range
function setPriceRange(min, max) {
    document.querySelector('input[name="price_min"]').value = min;
    document.querySelector('input[name="price_max"]').value = max;
    updateFilterChips();
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateFilterChips();
    
    // All accordions closed by default - no auto-open logic
    // Users can manually expand the sections they need
});
</script>
