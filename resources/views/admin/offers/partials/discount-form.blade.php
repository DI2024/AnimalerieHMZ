<div class="form-container">
    <!-- Left Column: Form Fields -->
    <div class="space-y-6">
        
        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="section-header">
                <span class="section-icon-badge info">
                    <i class="fas fa-info-circle"></i>
                </span>
                <span>Informations de base</span>
            </h3>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nom de l'offre *
                </label>
                <div class="input-group">
                    <span class="input-prefix">
                        <i class="fas fa-tag"></i>
                    </span>
                    <input type="text" name="name" id="offerName" value="{{ old('name') }}" required
                           oninput="updatePreview()"
                           class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-lg input-with-prefix"
                           placeholder="Ex: Soldes d'été 2024">
                </div>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Target Selection -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="section-header">
                <span class="section-icon-badge target">
                    <i class="fas fa-bullseye"></i>
                </span>
                <span>Cible de l'offre</span>
            </h3>
            
            <!-- Discount Percentage -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Réduction (%) *
                </label>
                <div class="input-group">
                    <span class="input-prefix">
                        <i class="fas fa-percentage text-primary"></i>
                    </span>
                    <input type="number" name="discount_percentage" id="discountPercentage" 
                           value="{{ old('discount_percentage', 20) }}" required
                           min="0" max="100" step="0.01"
                           oninput="updatePreview()"
                           class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-lg input-with-prefix input-with-suffix">
                    <span class="input-suffix">%</span>
                </div>
                <p class="text-xs text-gray-500 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>
                    Valeur entre 0 et 100
                </p>
                @error('discount_percentage')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Target Type Tabs -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Type de cible *
                </label>
                <input type="hidden" name="target_type" id="targetType" value="categories">
                <div class="target-tabs">
                    <button type="button" class="tab-btn active" data-target="categories" onclick="switchTab('categories', this)">
                        <span class="tab-btn-icon text-pink-600"><i class="fas fa-folder"></i></span>
                        <div class="font-semibold">Par Catégorie</div>
                        <div class="text-xs text-gray-500 mt-1">Toute la catégorie</div>
                    </button>
                    <button type="button" class="tab-btn" data-target="products" onclick="switchTab('products', this)">
                        <span class="tab-btn-icon text-indigo-600"><i class="fas fa-box"></i></span>
                        <div class="font-semibold">Par Produit</div>
                        <div class="text-xs text-gray-500 mt-1">Produits spécifiques</div>
                    </button>
                </div>
            </div>
            
            <!-- Categories Multi-Select (Tab 1) -->
            <div id="categories-section" class="target-section">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Sélectionner les catégories *
                </label>
                <select name="categories[]" multiple class="select2-multi w-full" id="categoriesSelect">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }} ({{ $category->products()->count() }} produits)
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    L'offre s'appliquera à <strong>TOUS les produits</strong> des catégories sélectionnées
                </p>
            </div>
            
            <!-- Products Multi-Select with Category Filter (Tab 2) -->
            <div id="products-section" class="target-section" style="display:none;">
                <!-- Optional Category Filter (Single-Select) -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-filter mr-1"></i>
                        Filtrer par catégorie (optionnel)
                    </label>
                    <select id="categoryFilter" class="select2-single w-full">
                        <option value="">-- Sélectionnez une catégorie --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        <option value="all">Toutes les catégories</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-lightbulb mr-1"></i>
                        Sélectionnez une catégorie pour afficher ses produits
                    </p>
                </div>
                
                <!-- Product Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Sélectionner les produits *
                    </label>
                    <select name="products[]" multiple class="select2-multi w-full" id="productsSelect">
                        <!-- Products will be loaded dynamically via AJAX -->
                    </select>
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Sélectionnez d'abord une catégorie pour afficher les produits
                    </p>
                </div>
            </div>
            
            @error('target')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Schedule -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="section-header">
                <span class="section-icon-badge calendar">
                    <i class="fas fa-calendar-alt"></i>
                </span>
                <span>Période de validité</span>
            </h3>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Date de début *
                    </label>
                    <div class="input-group">
                        <span class="input-prefix">
                            <i class="fas fa-calendar-day"></i>
                        </span>
                        <input type="date" name="start_date" id="startDate" 
                               value="{{ old('start_date', date('Y-m-d')) }}" required
                               onchange="updateDuration(); updatePreview()"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary input-with-prefix">
                    </div>
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Date de fin *
                    </label>
                    <div class="input-group">
                        <span class="input-prefix">
                            <i class="fas fa-calendar-check"></i>
                        </span>
                        <input type="date" name="end_date" id="endDate" 
                               value="{{ old('end_date', date('Y-m-d', strtotime('+7 days'))) }}" required
                               onchange="updateDuration(); updatePreview()"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary input-with-prefix">
                    </div>
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-3">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">
                        <i class="fas fa-clock mr-1"></i>
                        Durée:
                    </span>
                    <span class="font-semibold text-gray-900" id="durationDisplay">7 jours</span>
                </div>
            </div>
        </div>
        
        <!-- Settings -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="section-header">
                <span class="section-icon-badge settings">
                    <i class="fas fa-cog"></i>
                </span>
                <span>Paramètres</span>
            </h3>
            
            <label class="flex items-center space-x-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                       class="rounded text-primary focus:ring-primary w-5 h-5">
                <div class="flex-1">
                    <span class="text-sm font-medium text-gray-900">Offre active</span>
                    <p class="text-xs text-gray-500">L'offre sera immédiatement disponible</p>
                </div>
            </label>
        </div>
        
        <!-- Actions -->
        <div class="flex justify-between items-center bg-white rounded-lg shadow p-6">
            <a href="{{ route('admin.offers.index') }}" 
               class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Annuler
            </a>
            <button type="submit"
                    class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-colors">
                <i class="fas fa-save mr-2"></i>Créer l'offre
            </button>
        </div>
    </div>
    
    <!-- Right Column: Preview -->
    <div>
        <div class="preview-card">
            <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b">
                <h3 class="text-sm font-semibold text-gray-700">
                    <i class="fas fa-eye mr-2"></i>Aperçu en direct
                </h3>
            </div>
            
            <div class="p-6 text-center">
                <div class="discount-badge">
                    <div class="discount-value" id="previewDiscount">-20%</div>
                </div>
                
                <h4 class="text-xl font-bold text-gray-900 mb-2" id="previewName">Nom de l'offre</h4>
                
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-700 mb-4" id="previewTarget">
                    <i class="fas fa-box"></i>
                    <span>Sélectionnez des produits</span>
                </div>
                
                <div class="text-sm text-gray-600 mb-4" id="previewDates">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    <span id="previewDateRange">{{ date('d/m/Y') }} - {{ date('d/m/Y', strtotime('+7 days')) }}</span>
                </div>
                
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                    <i class="fas fa-check-circle"></i>
                    <span>Actif</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- jQuery & Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Select2 for multi-select
    $('.select2-multi').select2({
        placeholder: 'Sélectionner...',
        allowClear: true,
        width: '100%',
        language: {
            noResults: function() {
                return "Aucun résultat trouvé";
            },
            searching: function() {
                return "Recherche en cours...";
            }
        }
    });
    
    // Initialize Select2 for single-select (category filter)
    $('.select2-single').select2({
        placeholder: 'Sélectionnez une catégorie',
        allowClear: false,
        width: '100%',
        language: {
            noResults: function() {
                return "Aucun résultat trouvé";
            }
        }
    });
    
    // Store to track all selected products across category changes
    let allSelectedProducts = [];
    
    // Dynamic product loading when category changes
    $('#categoryFilter').on('change', function() {
        const selectedCategory = $(this).val();
        const $productsSelect = $('#productsSelect');
        
        // Get currently selected product IDs before clearing
        const currentSelections = $productsSelect.val() || [];
        
        // Merge with stored selections
        currentSelections.forEach(id => {
            if (!allSelectedProducts.find(p => p.id === id)) {
                // Find product name from current options
                const productName = $productsSelect.find(`option[value="${id}"]`).text();
                allSelectedProducts.push({ id: id, name: productName });
            }
        });
        
        // If no category selected, show message
        if (!selectedCategory || selectedCategory === '') {
            $productsSelect.empty();
            $productsSelect.append('<option value="" disabled>Sélectionnez d\'abord une catégorie</option>');
            $productsSelect.trigger('change.select2');
            return;
        }
        
        // Show loading state
        $productsSelect.empty();
        $productsSelect.append('<option value="" disabled>Chargement...</option>');
        $productsSelect.trigger('change.select2');
        
        // Load products via AJAX
        $.ajax({
            url: '{{ route("admin.offers.products-by-category") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                category_id: selectedCategory
            },
            success: function(response) {
                $productsSelect.empty();
                
                // Add loaded products
                response.products.forEach(product => {
                    $productsSelect.append(
                        `<option value="${product.id}">
                            ${product.name} (${product.category_name})
                        </option>`
                    );
                });
                
                // Re-add previously selected products that are not in current category
                allSelectedProducts.forEach(selectedProduct => {
                    // Check if product is already in the list
                    if (!$productsSelect.find(`option[value="${selectedProduct.id}"]`).length) {
                        // Add it as a selected option
                        $productsSelect.append(
                            `<option value="${selectedProduct.id}" selected>
                                ${selectedProduct.name}
                            </option>`
                        );
                    }
                });
                
                // Restore selections
                const selectionsToRestore = allSelectedProducts.map(p => p.id);
                $productsSelect.val(selectionsToRestore);
                $productsSelect.trigger('change.select2');
                
                updatePreview();
            },
            error: function(error) {
                console.error('Error loading products:', error);
                $productsSelect.empty();
                $productsSelect.append('<option value="" disabled>Erreur lors du chargement</option>');
                $productsSelect.trigger('change.select2');
                alert('Erreur lors du chargement des produits');
            }
        });
    });
    
    // Update stored selections when products are selected/deselected
    $('#productsSelect').on('change', function() {
        const selectedIds = $(this).val() || [];
        
        // Update allSelectedProducts array
        allSelectedProducts = [];
        selectedIds.forEach(id => {
            const productName = $(this).find(`option[value="${id}"]`).text();
            allSelectedProducts.push({ id: id, name: productName });
        });
        
        updatePreview();
    });
    
    // Update preview on category select change
    $('#categoriesSelect').on('change', updatePreview);
    
    // Initialize
    updateDuration();
    updatePreview();
});

// Tab switching
function switchTab(target, element) {
    $('.tab-btn').removeClass('active');
    $(element).addClass('active');
    
    // Update hidden input for target_type
    $('#targetType').val(target);
    
    $('.target-section').hide();
    $('#' + target + '-section').show();
    
    updatePreview();
}

// Update duration
function updateDuration() {
    const startDate = new Date(document.getElementById('startDate').value);
    const endDate = new Date(document.getElementById('endDate').value);
    
    if (startDate && endDate && endDate > startDate) {
        const diffTime = Math.abs(endDate - startDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        document.getElementById('durationDisplay').textContent = diffDays + ' jour' + (diffDays > 1 ? 's' : '');
    }
}

// Update preview
function updatePreview() {
    // Name
    const name = document.getElementById('offerName').value || 'Nom de l\'offre';
    document.getElementById('previewName').textContent = name;
    
    // Discount
    const discount = parseFloat(document.getElementById('discountPercentage').value) || 0;
    document.getElementById('previewDiscount').textContent = '-' + discount + '%';
    
    // Target
    const activeTab = $('.tab-btn.active').data('target');
    const previewTarget = document.getElementById('previewTarget');
    
    if (activeTab === 'categories') {
        const selectedCount = $('#categoriesSelect').val()?.length || 0;
        const categoryText = selectedCount > 1 ? 'catégories' : 'catégorie';
        previewTarget.innerHTML = `<i class="fas fa-folder"></i><span>${selectedCount} ${categoryText} (tous les produits)</span>`;
    } else {
        const selectedCount = $('#productsSelect').val()?.length || 0;
        const productText = selectedCount > 1 ? 'produits' : 'produit';
        previewTarget.innerHTML = `<i class="fas fa-box"></i><span>${selectedCount} ${productText} spécifique(s)</span>`;
    }
    
    // Dates
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    if (startDate && endDate) {
        const start = new Date(startDate).toLocaleDateString('fr-FR');
        const end = new Date(endDate).toLocaleDateString('fr-FR');
        document.getElementById('previewDateRange').textContent = start + ' - ' + end;
    }
}

// Form validation
document.getElementById('offerForm').addEventListener('submit', function(e) {
    const activeTab = $('#targetType').val();
    
    if (activeTab === 'categories') {
        const selectedCategories = $('#categoriesSelect').val();
        if (!selectedCategories || selectedCategories.length === 0) {
            e.preventDefault();
            alert('Veuillez sélectionner au moins une catégorie');
            return false;
        }
    } else if (activeTab === 'products') {
        const selectedProducts = $('#productsSelect').val();
        
        if (!selectedProducts || selectedProducts.length === 0) {
            e.preventDefault();
            alert('Veuillez sélectionner au moins un produit');
            return false;
        }
    }
});
</script>
@endpush
