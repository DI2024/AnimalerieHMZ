@extends('layouts.admin')

@section('title', 'Modifier Offre')
@section('page-title', 'Modifier l\'Offre')

@push('styles')
<style>
    /* Two-column layout */
    .form-container {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 24px;
    }
    
    @media (max-width: 1024px) {
        .form-container {
            grid-template-columns: 1fr;
        }
    }
    
    /* Section headers */
    .section-header {
        font-size: 16px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 2px solid #f3f4f6;
    }
    
    /* Character counter */
    .char-counter {
        font-size: 12px;
        color: #6b7280;
        text-align: right;
        margin-top: 4px;
    }
    .char-counter.warning { color: #f59e0b; }
    .char-counter.error { color: #ef4444; }
    
    /* Type Cards */
    .type-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }
    .type-card {
        padding: 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .type-card:hover {
        border-color: #d4af37;
        background: #fffbeb;
    }
    .type-card.active {
        border-color: #d4af37;
        background: #fef3c7;
    }
    .type-card input[type="radio"] {
        display: none;
    }
    .type-card-icon {
        font-size: 32px;
        margin-bottom: 8px;
    }
    
    /* Target Cards */
    .target-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }
    .target-card {
        padding: 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .target-card:hover {
        border-color: #d4af37;
        background: #fffbeb;
    }
    .target-card.active {
        border-color: #d4af37;
        background: #fef3c7;
    }
    .target-card input[type="radio"] {
        display: none;
    }
    
    /* Preview Card */
    .preview-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 24px;
    }
    
    /* Discount Badge */
    .discount-badge {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #d4af37 0%, #f59e0b 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 8px 16px rgba(212, 175, 55, 0.3);
    }
    .discount-value {
        font-size: 36px;
        font-weight: bold;
        color: white;
    }
    
    /* Date Presets */
    .date-presets {
        display: flex;
        gap: 8px;
        margin-top: 8px;
    }
    .date-preset-btn {
        padding: 6px 12px;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .date-preset-btn:hover {
        background: #fef3c7;
        border-color: #d4af37;
    }
    
    /* Calculation Example */
    .calculation-box {
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 16px;
        margin-top: 16px;
    }
    .calculation-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
    }
    .calculation-row.total {
        border-top: 2px solid #d4af37;
        margin-top: 8px;
        padding-top: 12px;
        font-weight: bold;
        color: #059669;
    }
    
    /* Select2 Custom Styling */
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 35px;
        user-select: none;
        -webkit-user-select: none;
    }
    
    .select2-container--default .select2-selection--single {
        height: 40px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 6px 12px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 28px;
        color: #374151;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
    }
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #d4af37;
        box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }
    .select2-dropdown {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .select2-search--dropdown .select2-search__field {
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        padding: 8px 12px;
    }
    .select2-search--dropdown .select2-search__field:focus {
        border-color: #d4af37;
        outline: none;
    }
    .select2-results__option--highlighted {
        background-color: #fef3c7 !important;
        color: #92400e !important;
    }
</style>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Custom Select2 Theme -->
<style>
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #fef3c7 !important;
        color: #92400e !important;
    }
    
    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #fef3c7;
        color: #92400e;
    }
</style>
@endpush

@section('content')
<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('admin.offers.index') }}" 
       class="inline-flex items-center text-gray-600 hover:text-primary transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>
        <span>Retour à la liste des offres</span>
    </a>
</div>

<form action="{{ route('admin.offers.update', $offer) }}" method="POST" id="offerForm">
    @csrf
    @method('PUT')
    
    <div class="form-container">
        <!-- Left Column: Form Fields -->
        <div class="space-y-6">
            
            <!-- Basic Information Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="section-header">
                    <i class="fas fa-info-circle text-primary mr-2"></i>
                    Informations de base
                </h3>
                
                <!-- Name -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nom de l'offre *
                    </label>
                    <input type="text" name="name" id="offerName" value="{{ old('name', $offer->name) }}" required
                           oninput="updatePreview(); countChars('offerName', 100)"
                           class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-lg"
                           placeholder="Ex: Soldes d'été 2024">
                    <div class="char-counter" id="nameCounter">0/100</div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Discount Configuration Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="section-header">
                    <i class="fas fa-percent text-primary mr-2"></i>
                    Configuration de la réduction
                </h3>
                
                <!-- Type Selection -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Type de réduction *
                    </label>
                    <div class="type-cards">
                        <label class="type-card {{ $offer->type === 'percentage' ? 'active' : '' }}" onclick="selectType('percentage', this)">
                            <input type="radio" name="type" value="percentage" {{ old('type', $offer->type) === 'percentage' ? 'checked' : '' }}>
                            <div class="type-card-icon text-blue-600"><i class="fas fa-percent"></i></div>
                            <div class="font-semibold text-sm">Pourcentage</div>
                            <div class="text-xs text-gray-500 mt-1">Ex: 20%</div>
                        </label>
                        <label class="type-card {{ $offer->type === 'fixed' ? 'active' : '' }}" onclick="selectType('fixed', this)">
                            <input type="radio" name="type" value="fixed" {{ old('type', $offer->type) === 'fixed' ? 'checked' : '' }}>
                            <div class="type-card-icon text-green-600"><i class="fas fa-coins"></i></div>
                            <div class="font-semibold text-sm">Fixe</div>
                            <div class="text-xs text-gray-500 mt-1">Ex: 50 DH</div>
                        </label>
                        <label class="type-card {{ $offer->type === 'category' ? 'active' : '' }}" onclick="selectType('category', this)">
                            <input type="radio" name="type" value="category" {{ old('type', $offer->type) === 'category' ? 'checked' : '' }}>
                            <div class="type-card-icon text-purple-600"><i class="fas fa-layer-group"></i></div>
                            <div class="font-semibold text-sm">Catégorie</div>
                            <div class="text-xs text-gray-500 mt-1">Par catégorie</div>
                        </label>
                    </div>
                    @error('type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Value Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <span id="valueLabel">Réduction (%)</span> *
                    </label>
                    <div class="relative">
                        <input type="number" name="value" id="offerValue" value="{{ old('value', $offer->value) }}" required
                               min="0" max="{{ $offer->type === 'percentage' ? '100' : '' }}" step="{{ $offer->type === 'percentage' ? '1' : '0.01' }}"
                               oninput="updatePreview(); validateValue()"
                               class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary text-lg">
                        <span id="valueUnit" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 font-semibold">{{ $offer->type === 'percentage' ? '%' : 'DH' }}</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1" id="valueHint">
                        <i class="fas fa-info-circle mr-1"></i>
                        <span id="valueHintText">Valeur entre 0 et 100</span>
                    </p>
                    @error('value')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Target Selection Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="section-header">
                    <i class="fas fa-bullseye text-primary mr-2"></i>
                    Cible de l'offre
                </h3>
                
                <!-- Target Type -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Appliquer à *
                    </label>
                    <div class="target-cards">
                        <label class="target-card {{ $offer->target_type === 'product' ? 'active' : '' }}" onclick="selectTarget('product', this)">
                            <input type="radio" name="target_type" value="product" {{ old('target_type', $offer->target_type) === 'product' ? 'checked' : '' }}>
                            <div class="text-3xl mb-2 text-indigo-600"><i class="fas fa-box"></i></div>
                            <div class="font-semibold text-sm">Produit</div>
                            <div class="text-xs text-gray-500 mt-1">Un produit</div>
                        </label>
                        <label class="target-card {{ $offer->target_type === 'category' ? 'active' : '' }}" onclick="selectTarget('category', this)">
                            <input type="radio" name="target_type" value="category" {{ old('target_type', $offer->target_type) === 'category' ? 'checked' : '' }}>
                            <div class="text-3xl mb-2 text-pink-600"><i class="fas fa-folder"></i></div>
                            <div class="font-semibold text-sm">Catégorie</div>
                            <div class="text-xs text-gray-500 mt-1">Une catégorie</div>
                        </label>
                        <label class="target-card {{ $offer->target_type === 'all' ? 'active' : '' }}" onclick="selectTarget('all', this)">
                            <input type="radio" name="target_type" value="all" {{ old('target_type', $offer->target_type) === 'all' ? 'checked' : '' }}>
                            <div class="text-3xl mb-2 text-gray-600"><i class="fas fa-globe"></i></div>
                            <div class="font-semibold text-sm">Tous</div>
                            <div class="text-xs text-gray-500 mt-1">Tous produits</div>
                        </label>
                    </div>
                    @error('target_type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Product Selector -->
                <div id="productSelector" class="{{ $offer->target_type === 'product' ? '' : 'hidden' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Sélectionner un produit *
                    </label>
                    <select name="target_id" id="productSelect" 
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">-- Choisir un produit --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('target_id', $offer->target_id) == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} ({{ number_format($product->price, 2) }} DH)
                            </option>
                        @endforeach
                    </select>
                    @error('target_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Category Selector -->
                <div id="categorySelector" class="{{ $offer->target_type === 'category' ? '' : 'hidden' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Sélectionner une catégorie *
                    </label>
                    <select name="target_id" id="categorySelect" 
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">-- Choisir une catégorie --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('target_id', $offer->target_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('target_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- All Products Message -->
                <div id="allMessage" class="bg-blue-50 border border-blue-200 rounded-lg p-4 {{ $offer->target_type === 'all' ? '' : 'hidden' }}">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-info-circle text-blue-600 mt-1"></i>
                        <div class="text-sm text-blue-800">
                            <p class="font-medium mb-1">Offre globale</p>
                            <p>Cette offre s'appliquera à tous les produits du site.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Schedule Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="section-header">
                    <i class="fas fa-calendar-alt text-primary mr-2"></i>
                    Période de validité
                </h3>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Start Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Date de début *
                        </label>
                        <input type="date" name="start_date" id="startDate" 
                               value="{{ old('start_date', $offer->start_date->format('Y-m-d')) }}" required
                               onchange="updateDuration(); updatePreview()"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        @error('start_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- End Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Date de fin *
                        </label>
                        <input type="date" name="end_date" id="endDate" 
                               value="{{ old('end_date', $offer->end_date->format('Y-m-d')) }}" required
                               onchange="updateDuration(); updatePreview()"
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                        @error('end_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Duration Display -->
                <div class="bg-gray-50 rounded-lg p-3 mb-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Durée:</span>
                        <span class="font-semibold text-gray-900" id="durationDisplay">7 jours</span>
                    </div>
                </div>
                
                <!-- Quick Presets -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Raccourcis rapides
                    </label>
                    <div class="date-presets">
                        <button type="button" class="date-preset-btn" onclick="setDuration(7)">
                            +7 jours
                        </button>
                        <button type="button" class="date-preset-btn" onclick="setDuration(14)">
                            +14 jours
                        </button>
                        <button type="button" class="date-preset-btn" onclick="setDuration(30)">
                            +30 jours
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Settings Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="section-header">
                    <i class="fas fa-cog text-primary mr-2"></i>
                    Paramètres
                </h3>
                
                <label class="flex items-center space-x-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $offer->is_active) ? 'checked' : '' }}
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
                    <i class="fas fa-save mr-2"></i>Mettre à jour
                </button>
            </div>
        </div>
        
        <!-- Right Column: Live Preview -->
        <div>
            <div class="preview-card">
                <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b">
                    <h3 class="text-sm font-semibold text-gray-700">
                        <i class="fas fa-eye mr-2"></i>Aperçu en direct
                    </h3>
                </div>
                
                <div class="p-6 text-center">
                    <!-- Discount Badge -->
                    <div class="discount-badge">
                        <div class="discount-value" id="previewDiscount">-20%</div>
                    </div>
                    
                    <!-- Offer Name -->
                    <h4 class="text-xl font-bold text-gray-900 mb-2" id="previewName">{{ $offer->name }}</h4>
                    
                    <!-- Target Info -->
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-gray-100 rounded-full text-sm text-gray-700 mb-4" id="previewTarget">
                        <i class="fas fa-globe"></i>
                        <span>Tous les produits</span>
                    </div>
                    
                    <!-- Date Range -->
                    <div class="text-sm text-gray-600 mb-4" id="previewDates">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        <span id="previewDateRange">{{ $offer->start_date->format('d/m/Y') }} - {{ $offer->end_date->format('d/m/Y') }}</span>
                    </div>
                    
                    <!-- Status -->
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                        <i class="fas fa-check-circle"></i>
                        <span>Actif</span>
                    </div>
                </div>
                
                <!-- Calculation Example -->
                <div class="p-6 border-t">
                    <h5 class="text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-calculator mr-2"></i>Exemple de calcul
                    </h5>
                    <div class="calculation-box">
                        <div class="calculation-row">
                            <span class="text-gray-600">Prix original:</span>
                            <span class="font-semibold">100.00 DH</span>
                        </div>
                        <div class="calculation-row">
                            <span class="text-gray-600">Réduction:</span>
                            <span class="font-semibold text-red-600" id="previewSavings">-20.00 DH</span>
                        </div>
                        <div class="calculation-row total">
                            <span>Prix final:</span>
                            <span id="previewFinal">80.00 DH</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Tips -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h4 class="text-sm font-semibold text-blue-900 mb-2">
                    <i class="fas fa-lightbulb mr-2"></i>Conseils
                </h4>
                <ul class="text-xs text-blue-800 space-y-1">
                    <li>• Utilisez un nom clair et attractif</li>
                    <li>• Les réductions de 15-25% sont les plus efficaces</li>
                    <li>• Limitez la durée pour créer l'urgence</li>
                    <li>• Testez différentes cibles pour optimiser</li>
                </ul>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<!-- Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Initialize Select2 for product and category selectors
    $(document).ready(function() {
        // Product selector with search
        $('#productSelect').select2({
            placeholder: '-- Choisir un produit --',
            allowClear: true,
            width: '100%',
            language: {
                noResults: function() {
                    return "Aucun produit trouvé";
                },
                searching: function() {
                    return "Recherche en cours...";
                }
            }
        });
        
        // Category selector with search
        $('#categorySelect').select2({
            placeholder: '-- Choisir une catégorie --',
            allowClear: true,
            width: '100%',
            language: {
                noResults: function() {
                    return "Aucune catégorie trouvée";
                },
                searching: function() {
                    return "Recherche en cours...";
                }
            }
        });
        
        // Update preview when Select2 changes
        $('#productSelect, #categorySelect').on('change', function() {
            updatePreview();
        });
    });
    
    // Character counter
    function countChars(fieldId, maxChars) {
        const field = document.getElementById(fieldId);
        const counter = document.getElementById(fieldId === 'offerName' ? 'nameCounter' : 'descriptionCounter');
        const length = field.value.length;
        
        counter.textContent = `${length}/${maxChars}`;
        counter.classList.remove('warning', 'error');
        
        if (length > maxChars * 0.9) {
            counter.classList.add('warning');
        }
        if (length > maxChars) {
            counter.classList.add('error');
        }
    }
    
    // Type Selection
    function selectType(type, element) {
        // Update active state
        document.querySelectorAll('.type-card').forEach(card => card.classList.remove('active'));
        element.classList.add('active');
        
        // Update value input
        const valueInput = document.getElementById('offerValue');
        const valueLabel = document.getElementById('valueLabel');
        const valueUnit = document.getElementById('valueUnit');
        const valueHintText = document.getElementById('valueHintText');
        
        if (type === 'percentage') {
            valueLabel.textContent = 'Réduction (%)';
            valueUnit.textContent = '%';
            valueInput.max = 100;
            valueInput.step = 1;
            valueInput.value = Math.min(valueInput.value || 20, 100);
            valueHintText.textContent = 'Valeur entre 0 et 100';
        } else {
            valueLabel.textContent = 'Montant (DH)';
            valueUnit.textContent = 'DH';
            valueInput.max = '';
            valueInput.step = 0.01;
            valueInput.value = valueInput.value || 50;
            valueHintText.textContent = 'Montant de la réduction en dirhams';
        }
        
        updatePreview();
    }
    
    // Target Selection
    function selectTarget(target, element) {
        // Update active state
        document.querySelectorAll('.target-card').forEach(card => card.classList.remove('active'));
        element.classList.add('active');
        
        // Show/hide selectors
        const productSelector = document.getElementById('productSelector');
        const categorySelector = document.getElementById('categorySelector');
        const allMessage = document.getElementById('allMessage');
        
        productSelector.classList.add('hidden');
        categorySelector.classList.add('hidden');
        allMessage.classList.add('hidden');
        
        if (target === 'product') {
            productSelector.classList.remove('hidden');
            document.getElementById('productSelect').required = true;
            document.getElementById('categorySelect').required = false;
        } else if (target === 'category') {
            categorySelector.classList.remove('hidden');
            document.getElementById('categorySelect').required = true;
            document.getElementById('productSelect').required = false;
        } else {
            allMessage.classList.remove('hidden');
            document.getElementById('productSelect').required = false;
            document.getElementById('categorySelect').required = false;
        }
        
        updatePreview();
    }
    
    // Validate Value
    function validateValue() {
        const type = document.querySelector('input[name="type"]:checked').value;
        const valueInput = document.getElementById('offerValue');
        const value = parseFloat(valueInput.value);
        
        if (type === 'percentage' && value > 100) {
            valueInput.value = 100;
        }
        if (value < 0) {
            valueInput.value = 0;
        }
    }
    
    // Update Duration
    function updateDuration() {
        const startDate = new Date(document.getElementById('startDate').value);
        const endDate = new Date(document.getElementById('endDate').value);
        
        if (startDate && endDate && endDate > startDate) {
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            document.getElementById('durationDisplay').textContent = diffDays + ' jour' + (diffDays > 1 ? 's' : '');
        }
    }
    
    // Set Duration (Quick Presets)
    function setDuration(days) {
        const startDate = new Date(document.getElementById('startDate').value);
        const endDate = new Date(startDate);
        endDate.setDate(endDate.getDate() + days);
        
        document.getElementById('endDate').value = endDate.toISOString().split('T')[0];
        updateDuration();
        updatePreview();
    }
    
    // Update Preview
    function updatePreview() {
        // Name
        const name = document.getElementById('offerName').value || 'Nom de l\'offre';
        document.getElementById('previewName').textContent = name;
        
        // Discount
        const type = document.querySelector('input[name="type"]:checked').value;
        const value = parseFloat(document.getElementById('offerValue').value) || 0;
        
        if (type === 'percentage') {
            document.getElementById('previewDiscount').textContent = '-' + value + '%';
        } else {
            document.getElementById('previewDiscount').textContent = '-' + value.toFixed(2) + ' DH';
        }
        
        // Target
        const targetType = document.querySelector('input[name="target_type"]:checked').value;
        const previewTarget = document.getElementById('previewTarget');
        
        if (targetType === 'product') {
            const productSelect = document.getElementById('productSelect');
            const productName = productSelect.options[productSelect.selectedIndex]?.text || 'Produit';
            previewTarget.innerHTML = '<i class="fas fa-box"></i><span>' + productName + '</span>';
        } else if (targetType === 'category') {
            const categorySelect = document.getElementById('categorySelect');
            const categoryName = categorySelect.options[categorySelect.selectedIndex]?.text || 'Catégorie';
            previewTarget.innerHTML = '<i class="fas fa-folder"></i><span>' + categoryName + '</span>';
        } else {
            previewTarget.innerHTML = '<i class="fas fa-globe"></i><span>Tous les produits</span>';
        }
        
        // Dates
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        if (startDate && endDate) {
            const start = new Date(startDate).toLocaleDateString('fr-FR');
            const end = new Date(endDate).toLocaleDateString('fr-FR');
            document.getElementById('previewDateRange').textContent = start + ' - ' + end;
        }
        
        // Calculation
        const examplePrice = 100;
        let savings = 0;
        
        if (type === 'percentage') {
            savings = examplePrice * (value / 100);
        } else {
            savings = Math.min(value, examplePrice);
        }
        
        const finalPrice = examplePrice - savings;
        
        document.getElementById('previewSavings').textContent = '-' + savings.toFixed(2) + ' DH';
        document.getElementById('previewFinal').textContent = finalPrice.toFixed(2) + ' DH';
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateDuration();
        updatePreview();
        countChars('offerName', 100);
        
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('startDate').min = today;
        document.getElementById('endDate').min = today;
    });
    
    // Form validation
    document.getElementById('offerForm').addEventListener('submit', function(e) {
        const startDate = new Date(document.getElementById('startDate').value);
        const endDate = new Date(document.getElementById('endDate').value);
        
        if (endDate <= startDate) {
            e.preventDefault();
            alert('La date de fin doit être après la date de début');
            return false;
        }
        
        const targetType = document.querySelector('input[name="target_type"]:checked').value;
        if (targetType === 'product') {
            const productSelect = document.getElementById('productSelect');
            if (!productSelect.value) {
                e.preventDefault();
                alert('Veuillez sélectionner un produit');
                return false;
            }
        } else if (targetType === 'category') {
            const categorySelect = document.getElementById('categorySelect');
            if (!categorySelect.value) {
                e.preventDefault();
                alert('Veuillez sélectionner une catégorie');
                return false;
            }
        }
    });
</script>
@endpush
