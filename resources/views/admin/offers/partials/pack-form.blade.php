<div class="form-container">
    <!-- Left Column: Form Fields -->
    <div class="space-y-6">
        
        <!-- 1. Pack Information (Name + Image) -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="section-header">
                <span class="section-icon-badge info">
                    <i class="fas fa-info-circle"></i>
                </span>
                <span>Informations du pack</span>
            </h3>
            
            <div class="pack-info-grid">
                <!-- Left: Image Upload Zone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Image du pack *
                    </label>
                    <div class="pack-image-upload-zone" id="packImageUploadZone">
                        <!-- Empty State -->
                        <div class="upload-empty-state" id="uploadEmptyState">
                            <i class="fas fa-camera upload-icon"></i>
                            <p class="upload-text-primary">Cliquez ou glissez pour télécharger</p>
                            <p class="upload-text-secondary">JPG, PNG, GIF • Max 2MB</p>
                        </div>
                        
                        <!-- Image Preview (Hidden by default) -->
                        <img id="packImagePreview" src="" alt="Preview" class="pack-image-preview hidden">
                        
                        <!-- Overlay on hover (when image exists) -->
                        <div class="pack-image-overlay" id="packImageOverlay">
                            <button type="button" class="change-image-btn">
                                <i class="fas fa-sync-alt"></i>
                                <span>Changer l'image</span>
                            </button>
                        </div>
                        
                        <!-- Hidden file input -->
                        <input type="file" name="image" id="packImage" accept="image/*" required class="hidden">
                    </div>
                    @error('image')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Right: Name Input Zone -->
                <div class="pack-name-input-zone">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nom du pack *
                    </label>
                    <div class="input-group">
                        <span class="input-prefix">
                            <i class="fas fa-tag"></i>
                        </span>
                        <input type="text" name="name" id="packName" value="{{ old('name') }}" required
                               oninput="updatePackPreview()"
                               class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-lg input-with-prefix"
                               placeholder="Ex: Pack Été 2024">
                    </div>
                    <p class="pack-name-hint">
                        <i class="fas fa-lightbulb mr-1"></i>
                        Donnez un nom attractif et descriptif à votre pack
                    </p>
                    @error('name')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <!-- 2. Product Selection -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="section-header">
                <span class="section-icon-badge products">
                    <i class="fas fa-box"></i>
                </span>
                <span>Produits du pack</span>
            </h3>
            
            <!-- Category Filter (Single-Select) -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-filter mr-1"></i>
                    Filtrer par catégorie (optionnel)
                </label>
                <select id="packCategoryFilter" class="select2-single w-full">
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
            
            <!-- Product Multi-Select -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Sélectionner les produits * (minimum 2)
                </label>
                <select name="products[]" multiple class="select2-multi w-full" id="packProductsSelect">
                    <!-- Products will be loaded dynamically via AJAX -->
                </select>
                <p class="text-xs text-gray-500 mt-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    Sélectionnez au moins 2 produits pour créer un pack
                </p>
                @error('products')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- 3. Pricing (Simplified Two-Input System) -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="section-header">
                <span class="section-icon-badge target">
                    <i class="fas fa-coins"></i>
                </span>
                <span>Tarification du pack</span>
            </h3>
            
            <!-- Two-Input Grid -->
            <div class="pricing-inputs-grid">
                <!-- Pack Price Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Prix du pack *
                    </label>
                    <div class="input-group">
                        <span class="input-prefix">
                            <i class="fas fa-coins text-primary"></i>
                        </span>
                        <input type="number" 
                               name="pack_price" 
                               id="packPriceInput" 
                               value="{{ old('pack_price', '0') }}" 
                               required
                               min="0" 
                               step="0.01"
                               oninput="syncFromPrice(this.value)"
                               class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-lg input-with-prefix input-with-suffix">
                        <span class="input-suffix">DH</span>
                    </div>
                </div>
                
                <!-- Discount Percentage Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Réduction *
                    </label>
                    <div class="input-group">
                        <span class="input-prefix">
                            <i class="fas fa-percentage text-primary"></i>
                        </span>
                        <input type="number" 
                               id="discountPercentageInput"
                               value="0" 
                               min="0" 
                               max="100" 
                               step="0.01"
                               oninput="syncFromPercentage(this.value)"
                               class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-lg input-with-prefix input-with-suffix">
                        <span class="input-suffix">%</span>
                    </div>
                </div>
            </div>
            
            <!-- Simple Hint -->
            <p class="text-xs text-gray-500 mt-3 text-center">
                <i class="fas fa-lightbulb mr-1"></i>
                Ajustez le prix ou le pourcentage - l'autre se mettra à jour automatiquement
            </p>
            
            @error('pack_price')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- 4. Schedule -->
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
                        <input type="date" name="start_date" id="packStartDate" 
                               value="{{ old('start_date', date('Y-m-d')) }}" required
                               onchange="updatePackDuration(); updatePackPreview()"
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
                        <input type="date" name="end_date" id="packEndDate" 
                               value="{{ old('end_date', date('Y-m-d', strtotime('+7 days'))) }}" required
                               onchange="updatePackDuration(); updatePackPreview()"
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
                    <span class="font-semibold text-gray-900" id="packDurationDisplay">7 jours</span>
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
                    <span class="text-sm font-medium text-gray-900">Pack actif</span>
                    <p class="text-xs text-gray-500">Le pack sera immédiatement disponible</p>
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
                <i class="fas fa-save mr-2"></i>Créer le pack
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
            
            <div class="p-6">
                <!-- Pack Image Preview -->
                <div id="packPreviewImageContainer" class="mb-4 hidden">
                    <img id="packPreviewImage" src="" alt="Pack" class="pack-preview-image">
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-white text-2xl">
                        <i class="fas fa-box-open"></i>
                    </div>
                    
                    <h4 class="text-xl font-bold text-gray-900 mb-2" id="packPreviewName">Nom du pack</h4>
                    
                    <div class="mb-4">
                        <div class="pack-price-display" id="packPreviewPrice">0.00 DH</div>
                        <div class="pack-savings hidden" id="packPreviewSavings">
                            <i class="fas fa-tag mr-1"></i>
                            Économisez <span id="packPreviewSavingsAmount">0.00 DH</span>
                        </div>
                    </div>
                    
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-purple-100 rounded-full text-sm text-purple-800 mb-4" id="packPreviewProducts">
                        <i class="fas fa-box"></i>
                        <span>0 produits</span>
                    </div>
                    
                    <div class="text-sm text-gray-600 mb-4" id="packPreviewDates">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        <span id="packPreviewDateRange">{{ date('d/m/Y') }} - {{ date('d/m/Y', strtotime('+7 days')) }}</span>
                    </div>
                    
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                        <i class="fas fa-check-circle"></i>
                        <span>Actif</span>
                    </div>
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
// Global state for pricing
let packPricingState = {
    totalProductPrice: 0,
    packPrice: 0,
    discountPercentage: 0,
    isUpdating: false,
    selectedProducts: []
};

$(document).ready(function() {
    // Initialize Select2
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
    
    // Initialize drag & drop for image upload
    initializeImageUpload();
    
    // Store product prices for calculation
    let productPrices = {};
    let allSelectedProducts = [];
    
    // Dynamic product loading when category changes
    $('#packCategoryFilter').on('change', function() {
        const selectedCategory = $(this).val();
        const $productsSelect = $('#packProductsSelect');
        
        // Get currently selected product IDs before clearing
        const currentSelections = $productsSelect.val() || [];
        
        // Merge with stored selections
        currentSelections.forEach(id => {
            if (!allSelectedProducts.find(p => p.id === id)) {
                const productName = $productsSelect.find(`option[value="${id}"]`).text();
                const productPrice = parseFloat($productsSelect.find(`option[value="${id}"]`).data('price')) || 0;
                allSelectedProducts.push({ id: id, name: productName, price: productPrice });
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
                    productPrices[product.id] = parseFloat(product.price);
                    $productsSelect.append(
                        `<option value="${product.id}" data-price="${product.price}">
                            ${product.name} - ${product.price} DH
                        </option>`
                    );
                });
                
                // Re-add previously selected products that are not in current category
                allSelectedProducts.forEach(selectedProduct => {
                    if (!$productsSelect.find(`option[value="${selectedProduct.id}"]`).length) {
                        $productsSelect.append(
                            `<option value="${selectedProduct.id}" data-price="${selectedProduct.price}" selected>
                                ${selectedProduct.name}
                            </option>`
                        );
                    }
                });
                
                // Restore selections
                const selectionsToRestore = allSelectedProducts.map(p => p.id);
                $productsSelect.val(selectionsToRestore);
                $productsSelect.trigger('change.select2');
                
                updatePackPreview();
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
    $('#packProductsSelect').on('change', function() {
        const selectedIds = $(this).val() || [];
        
        // Update allSelectedProducts array
        allSelectedProducts = [];
        packPricingState.selectedProducts = [];
        
        selectedIds.forEach(id => {
            const productName = $(this).find(`option[value="${id}"]`).text();
            const productPrice = parseFloat($(this).find(`option[value="${id}"]`).data('price')) || 0;
            allSelectedProducts.push({ id: id, name: productName, price: productPrice });
            packPricingState.selectedProducts.push({ id: id, name: productName, price: productPrice });
            productPrices[id] = productPrice;
        });
        
        // Recalculate total product price
        onProductsSelected();
        updatePackPreview();
    });
    
    // Initialize
    updatePackDuration();
    updatePackPreview();
});

// Calculate total price when products are selected
function onProductsSelected() {
    packPricingState.totalProductPrice = packPricingState.selectedProducts.reduce((sum, product) => {
        return sum + parseFloat(product.price);
    }, 0);
    
    // Set default values: pack price = total price, discount = 0%
    packPricingState.packPrice = packPricingState.totalProductPrice;
    packPricingState.discountPercentage = 0;
    
    // Update inputs
    document.getElementById('packPriceInput').value = packPricingState.packPrice.toFixed(2);
    document.getElementById('discountPercentageInput').value = '0';
    
    // Update preview
    updatePackPreview();
}

// Sync from pack price input
function syncFromPrice(value) {
    if (packPricingState.isUpdating) return;
    packPricingState.isUpdating = true;
    
    packPricingState.packPrice = parseFloat(value) || 0;
    
    // Calculate percentage
    if (packPricingState.totalProductPrice > 0) {
        packPricingState.discountPercentage = 
            ((packPricingState.totalProductPrice - packPricingState.packPrice) / packPricingState.totalProductPrice) * 100;
        packPricingState.discountPercentage = Math.max(0, Math.min(100, packPricingState.discountPercentage));
    } else {
        packPricingState.discountPercentage = 0;
    }
    
    // Update percentage input
    document.getElementById('discountPercentageInput').value = packPricingState.discountPercentage.toFixed(2);
    
    // Update preview
    updatePackPreview();
    
    packPricingState.isUpdating = false;
}

// Sync from percentage input
function syncFromPercentage(value) {
    if (packPricingState.isUpdating) return;
    packPricingState.isUpdating = true;
    
    packPricingState.discountPercentage = parseFloat(value) || 0;
    packPricingState.discountPercentage = Math.max(0, Math.min(100, packPricingState.discountPercentage));
    
    // Calculate pack price
    packPricingState.packPrice = packPricingState.totalProductPrice * (1 - packPricingState.discountPercentage / 100);
    
    // Update pack price input
    document.getElementById('packPriceInput').value = packPricingState.packPrice.toFixed(2);
    
    // Update preview
    updatePackPreview();
    
    packPricingState.isUpdating = false;
}

// Initialize image upload with drag & drop
function initializeImageUpload() {
    const uploadZone = document.getElementById('packImageUploadZone');
    const fileInput = document.getElementById('packImage');
    const emptyState = document.getElementById('uploadEmptyState');
    const imagePreview = document.getElementById('packImagePreview');
    
    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    // Highlight on drag over
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadZone.addEventListener(eventName, () => {
            uploadZone.classList.add('drag-over');
        }, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, () => {
            uploadZone.classList.remove('drag-over');
        }, false);
    });
    
    // Handle dropped files
    uploadZone.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            fileInput.files = files;
            handleImageFile(files[0]);
        }
    }, false);
    
    // Click to upload
    uploadZone.addEventListener('click', (e) => {
        // Don't trigger if clicking the overlay button
        if (!e.target.closest('.pack-image-overlay')) {
            fileInput.click();
        }
    });
    
    // Handle file input change
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            handleImageFile(e.target.files[0]);
        }
    });
    
    // Handle image file
    function handleImageFile(file) {
        // Validate file type
        if (!file.type.match('image.*')) {
            alert('Veuillez sélectionner une image (JPG, PNG, GIF)');
            return;
        }
        
        // Validate file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('L\'image ne doit pas dépasser 2MB');
            return;
        }
        
        // Read and preview
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('hidden');
            emptyState.style.display = 'none';
            uploadZone.classList.add('has-image');
            
            // Update preview card
            $('#packPreviewImage').attr('src', e.target.result);
            $('#packPreviewImageContainer').removeClass('hidden');
        };
        reader.readAsDataURL(file);
    }
}

// Preview pack image (legacy function - now handled by initializeImageUpload)
function previewPackImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const imagePreview = document.getElementById('packImagePreview');
            const emptyState = document.getElementById('uploadEmptyState');
            const uploadZone = document.getElementById('packImageUploadZone');
            
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('hidden');
            emptyState.style.display = 'none';
            uploadZone.classList.add('has-image');
            
            $('#packPreviewImage').attr('src', e.target.result);
            $('#packPreviewImageContainer').removeClass('hidden');
        };
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Update pack duration
function updatePackDuration() {
    const startDate = new Date(document.getElementById('packStartDate').value);
    const endDate = new Date(document.getElementById('packEndDate').value);
    
    if (startDate && endDate && endDate > startDate) {
        const diffTime = Math.abs(endDate - startDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        document.getElementById('packDurationDisplay').textContent = diffDays + ' jour' + (diffDays > 1 ? 's' : '');
    }
}

// Update pack preview
function updatePackPreview() {
    // Name
    const name = document.getElementById('packName').value || 'Nom du pack';
    document.getElementById('packPreviewName').textContent = name;
    
    // Price
    const price = packPricingState.packPrice || 0;
    document.getElementById('packPreviewPrice').textContent = price.toFixed(2) + ' DH';
    
    // Products count
    const selectedCount = packPricingState.selectedProducts.length || 0;
    const productText = selectedCount > 1 ? 'produits' : 'produit';
    document.getElementById('packPreviewProducts').innerHTML = `<i class="fas fa-box"></i><span>${selectedCount} ${productText}</span>`;
    
    // Savings (show in preview card)
    const savings = packPricingState.totalProductPrice - packPricingState.packPrice;
    if (savings > 0 && packPricingState.totalProductPrice > 0) {
        $('#packPreviewSavings').removeClass('hidden');
        $('#packPreviewSavingsAmount').text(
            savings.toFixed(2) + ' DH (-' + packPricingState.discountPercentage.toFixed(0) + '%)'
        );
    } else {
        $('#packPreviewSavings').addClass('hidden');
    }
    
    // Dates
    const startDate = document.getElementById('packStartDate').value;
    const endDate = document.getElementById('packEndDate').value;
    if (startDate && endDate) {
        const start = new Date(startDate).toLocaleDateString('fr-FR');
        const end = new Date(endDate).toLocaleDateString('fr-FR');
        document.getElementById('packPreviewDateRange').textContent = start + ' - ' + end;
    }
}

// Form validation
document.getElementById('offerForm').addEventListener('submit', function(e) {
    const selectedProducts = packPricingState.selectedProducts;
    
    if (!selectedProducts || selectedProducts.length < 2) {
        e.preventDefault();
        alert('Veuillez sélectionner au moins 2 produits pour créer un pack');
        return false;
    }
    
    const packPrice = packPricingState.packPrice || 0;
    if (packPrice <= 0) {
        e.preventDefault();
        alert('Veuillez entrer un prix valide pour le pack');
        return false;
    }
    
    if (packPrice >= packPricingState.totalProductPrice) {
        e.preventDefault();
        alert('Le prix du pack doit être inférieur au prix total des produits');
        return false;
    }
});
</script>
@endpush
