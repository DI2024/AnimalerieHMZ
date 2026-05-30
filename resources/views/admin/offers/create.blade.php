@extends('layouts.admin')

@php
    $isPack = request('type') === 'pack';

    $formattedProducts = $products->map(function($p) {
        return [
            'id' => $p->id,
            'name' => $p->name,
            'price' => (float)$p->price,
            'category_id' => $p->category_id,
            'subcategory_id' => $p->subcategory_id,
            'category_name' => $p->category ? $p->category->name : '',
        ];
    });

    $formattedCategories = $categories->map(function($c) {
        return [
            'id' => $c->id,
            'name' => $c->name,
            'subcategories' => $c->subcategories->map(function($s) {
                return [
                    'id' => $s->id,
                    'name' => $s->name,
                ];
            })
        ];
    });
@endphp

@section('title', $isPack ? 'Nouveau Pack' : 'Nouvelle Offre')
@section('page-title', $isPack ? 'Créer un Pack' : 'Créer une Offre')

@section('content')
<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('admin.offers.index') }}" 
       class="inline-flex items-center text-gray-600 transition-colors" 
       style="color: #6b7280;"
       onmouseover="this.style.color='#003e87'" 
       onmouseout="this.style.color='#6b7280'">
        <i class="fas fa-arrow-left mr-2"></i>
        <span>Retour à la liste des offres</span>
    </a>
</div>

<!-- Form Container -->
<div class="bg-white rounded-lg shadow p-8">
    <form action="{{ route('admin.offers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Hidden input for type -->
        <input type="hidden" name="type" value="{{ $isPack ? 'pack' : 'offer' }}">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Title / Pack Name -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ $isPack ? 'Nom du pack' : 'Titre' }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}"
                           required
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='{{ $isPack ? '#7c3aed' : '#003e87' }}'; this.style.boxShadow='0 0 0 3px {{ $isPack ? 'rgba(124,58,237,0.1)' : 'rgba(0,62,135,0.1)' }}'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="{{ $isPack ? 'Ex: Pack Chiot Premium' : 'Ex: Jusqu\'à 25% de remise' }}">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                @if(!$isPack)
                <!-- Subtitle -->
                <div>
                    <label for="subtitle" class="block text-sm font-semibold text-gray-700 mb-2">
                        Sous-titre
                    </label>
                    <input type="text" 
                           name="subtitle" 
                           id="subtitle" 
                           value="{{ old('subtitle') }}"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='#003e87'; this.style.boxShadow='0 0 0 3px rgba(0,62,135,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="Ex: Sur toute la gamme Chien">
                    @error('subtitle')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Badge -->
                <div>
                    <label for="badge" class="block text-sm font-semibold text-gray-700 mb-2">
                        Badge
                    </label>
                    <input type="text" 
                           name="badge" 
                           id="badge" 
                           value="{{ old('badge') }}"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='#003e87'; this.style.boxShadow='0 0 0 3px rgba(0,62,135,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="Ex: 🔥 Offre Spéciale">
                    @error('badge')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Link -->
                <div>
                    <label for="link" class="block text-sm font-semibold text-gray-700 mb-2">
                        Lien de redirection
                    </label>
                    <input type="text" 
                           name="link" 
                           id="link" 
                           value="{{ old('link') }}"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='#003e87'; this.style.boxShadow='0 0 0 3px rgba(0,62,135,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="Ex: /categories/chiens">
                    @error('link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                @else
                <!-- Pack Price -->
                <div>
                    <label for="pack_price" class="block text-sm font-semibold text-gray-700 mb-2">
                        Prix du Pack (DH) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           name="pack_price" 
                           id="pack_price" 
                           value="{{ old('pack_price') }}"
                           required
                           min="0"
                           step="0.01"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='#7c3aed'; this.style.boxShadow='0 0 0 3px rgba(124,58,237,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="Ex: 199.00">
                    @error('pack_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Products Selection by Category / Subcategory -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Sélectionner les produits du pack <span class="text-red-500">*</span>
                    </label>

                    <!-- Hidden inputs container for form submission -->
                    <div id="hidden_inputs_container">
                        @if(is_array(old('product_ids')))
                            @foreach(old('product_ids') as $pId)
                                <input type="hidden" name="product_ids[]" value="{{ $pId }}" id="hidden_input_{{ $pId }}">
                            @endforeach
                        @endif
                    </div>

                    <!-- Category Selector -->
                    <div class="mb-3">
                        <label for="categorySelect" class="block text-xs font-semibold text-gray-500 mb-1">Catégorie :</label>
                        <select id="categorySelect" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" style="border-color: #e5e7eb;">
                            <option value="">Sélectionner une catégorie</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Subcategory Selector -->
                    <div class="mb-3">
                        <label for="subcategorySelect" class="block text-xs font-semibold text-gray-500 mb-1">Sous-catégorie :</label>
                        <select id="subcategorySelect" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" style="border-color: #e5e7eb;" disabled>
                            <option value="">Sélectionner une sous-catégorie</option>
                        </select>
                    </div>

                    <!-- Products Checklist (Dynamic) -->
                    <div id="productsChecklistContainer" class="hidden border rounded-lg p-4 max-h-60 overflow-y-auto space-y-2 mb-4 animate-fadeIn" style="border-color: #e5e7eb;">
                        <!-- JS renders matching products here -->
                    </div>

                    <!-- Persistent Selected Products List -->
                    <div class="mb-4">
                        <h4 class="text-sm font-semibold text-gray-700 mb-2">Produits inclus dans le pack :</h4>
                        <div id="selectedProductsList" class="border rounded-lg p-4 bg-gray-50 min-h-16 space-y-2 max-h-60 overflow-y-auto" style="border-color: #e5e7eb;">
                            <p class="text-sm text-gray-500 text-center py-4 italic" id="emptySelectedMsg">Aucun produit sélectionné</p>
                        </div>
                    </div>
                    @error('product_ids')
                        <p class="mt-1 text-sm text-red-600 mb-4">{{ $message }}</p>
                    @enderror

                    <!-- Real-time Summary Card -->
                    <div class="mt-4 p-4 bg-purple-50 border border-purple-100 rounded-xl space-y-2">
                        <div class="flex justify-between text-sm text-purple-900">
                            <span>Prix total normal (barré) :</span>
                            <span class="font-bold"><span id="totalOriginalDisplay">0,00</span> DH</span>
                        </div>
                        <div class="flex justify-between text-sm text-purple-900">
                            <span>Prix du pack :</span>
                            <span class="font-bold"><span id="packPriceDisplay">0,00</span> DH</span>
                        </div>
                        <div class="h-px bg-purple-200 my-2"></div>
                        <div class="flex justify-between text-base font-bold text-purple-950">
                            <span>Économie client :</span>
                            <span><span id="savingsDisplay">0,00</span> DH (<span id="savingsPercentDisplay">0</span>%)</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        {{ $isPack ? 'Photo du pack' : 'Image' }}
                    </label>
                    <div class="border-2 border-dashed rounded-lg p-6 text-center" style="border-color: #d1d5db;">
                        <input type="file" 
                               name="image" 
                               id="image" 
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(event)">
                        <label for="image" class="cursor-pointer">
                            <div id="imagePreview" class="mb-4">
                                <i class="fas fa-cloud-upload-alt text-5xl text-gray-400"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">Cliquez pour télécharger une image</p>
                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF jusqu'à 2MB</p>
                        </label>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Background Color -->
                <div>
                    <label for="bg_color" class="block text-sm font-semibold text-gray-700 mb-2">
                        Couleur de fond
                    </label>
                    <div class="flex items-center gap-3">
                        @php
                            $currentColor = old('bg_color', $isPack ? '#7c3aed' : '#003e87');
                        @endphp
                        <!-- Custom Color Picker Trigger -->
                        <div class="relative w-10 h-10 rounded-lg border border-gray-200 overflow-hidden hover:scale-105 transition-transform flex-shrink-0" title="Choisir une couleur">
                            <input type="color" 
                                   id="custom_color_picker" 
                                   value="{{ $currentColor }}"
                                   class="absolute inset-0 w-full h-full p-0 border-0 cursor-pointer"
                                   style="transform: scale(2);"
                                   oninput="updateColorFromPicker(this.value)">
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none bg-black/5">
                                <i class="fas fa-eye-dropper text-sm text-gray-700 drop-shadow-sm"></i>
                            </div>
                        </div>

                        <!-- Editable text input -->
                        <div class="flex-grow">
                            <input type="text" 
                                   name="bg_color" 
                                   id="bg_color" 
                                   value="{{ $currentColor }}"
                                   class="w-full px-4 py-2 border rounded-lg font-mono text-sm text-gray-700 focus:outline-none focus:ring-2 {{ $isPack ? 'focus:ring-purple-500' : 'focus:ring-blue-500' }}"
                                   style="border-color: #e5e7eb;"
                                   oninput="updatePickerFromText(this.value)"
                                   placeholder="{{ $isPack ? '#7c3aed' : '#003e87' }}">
                        </div>
                    </div>
                    @error('bg_color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">
                        Ordre d'affichage <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           name="order" 
                           id="order" 
                           value="{{ old('order', 0) }}"
                           required
                           min="0"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='{{ $isPack ? '#7c3aed' : '#003e87' }}'; this.style.boxShadow='0 0 0 3px {{ $isPack ? 'rgba(124,58,237,0.1)' : 'rgba(0,62,135,0.1)' }}'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="Ex: 0">
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active Status -->
                <div>
                    <label class="flex items-center cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" 
                               name="is_active" 
                               value="1" 
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="w-5 h-5 rounded" 
                               style="color: {{ $isPack ? '#7c3aed' : '#003e87' }};">
                        <span class="ml-3 text-sm font-semibold text-gray-700">{{ $isPack ? 'Pack actif' : 'Offre active' }}</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="mt-8 flex items-center gap-4">
            <button type="submit" 
                    class="px-6 py-3 text-white rounded-lg font-semibold transition-colors" 
                    style="background: {{ $isPack ? '#7c3aed' : '#003e87' }};"
                    onmouseover="this.style.background='{{ $isPack ? '#6d28d9' : '#0855b1' }}'" 
                    onmouseout="this.style.background='{{ $isPack ? '#7c3aed' : '#003e87' }}'">
                <i class="fas fa-save mr-2"></i>{{ $isPack ? 'Créer le pack' : 'Créer l\'offre' }}
            </button>
            <a href="{{ route('admin.offers.index') }}" 
               class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                Annuler
            </a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
function updateColorFromPicker(hex) {
    document.getElementById('bg_color').value = hex;
}

function updatePickerFromText(hex) {
    if (/^#[0-9A-F]{6}$/i.test(hex) || /^#[0-9A-F]{3}$/i.test(hex)) {
        document.getElementById('custom_color_picker').value = hex;
    }
}

function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="max-h-48 mx-auto rounded-lg">`;
        }
        reader.readAsDataURL(file);
    }
}

@if($isPack)
document.addEventListener('DOMContentLoaded', function () {
    // Data structures
    const allProducts = @json($formattedProducts);

    const categories = @json($formattedCategories);

    // Dom elements
    const categorySelect = document.getElementById('categorySelect');
    const subcategorySelect = document.getElementById('subcategorySelect');
    const productsChecklistContainer = document.getElementById('productsChecklistContainer');
    const selectedProductsList = document.getElementById('selectedProductsList');
    const emptySelectedMsg = document.getElementById('emptySelectedMsg');
    const hiddenInputsContainer = document.getElementById('hidden_inputs_container');
    const totalOriginalDisplay = document.getElementById('totalOriginalDisplay');
    const packPriceInput = document.getElementById('pack_price');
    const packPriceDisplay = document.getElementById('packPriceDisplay');
    const savingsDisplay = document.getElementById('savingsDisplay');
    const savingsPercentDisplay = document.getElementById('savingsPercentDisplay');

    // Selected products map
    let selectedProductsMap = new Map();

    // Initialize with old values if present
    const oldProductIds = @json(old('product_ids', []));
    oldProductIds.forEach(id => {
        const prod = allProducts.find(p => p.id == id);
        if (prod) {
            selectedProductsMap.set(prod.id, prod);
        }
    });

    // Populate subcategories based on category
    categorySelect.addEventListener('change', function () {
        const catId = this.value;
        
        // Reset subcategory select
        subcategorySelect.innerHTML = '<option value="">Toutes les sous-catégories</option>';
        subcategorySelect.disabled = true;
        
        if (!catId) {
            productsChecklistContainer.classList.add('hidden');
            return;
        }

        const cat = categories.find(c => c.id == catId);
        if (cat && cat.subcategories.length > 0) {
            cat.subcategories.forEach(sub => {
                const opt = document.createElement('option');
                opt.value = sub.id;
                opt.textContent = sub.name;
                subcategorySelect.appendChild(opt);
            });
            subcategorySelect.disabled = false;
        }

        renderProductsList();
    });

    subcategorySelect.addEventListener('change', renderProductsList);
    packPriceInput.addEventListener('input', calculateTotals);

    function renderProductsList() {
        const catId = categorySelect.value;
        const subcatId = subcategorySelect.value;

        if (!catId) {
            productsChecklistContainer.innerHTML = '';
            productsChecklistContainer.classList.add('hidden');
            return;
        }

        // Filter products
        let filtered = allProducts.filter(p => p.category_id == catId);
        if (subcatId) {
            filtered = filtered.filter(p => p.subcategory_id == subcatId);
        }

        productsChecklistContainer.innerHTML = '';

        if (filtered.length === 0) {
            productsChecklistContainer.innerHTML = '<p class="text-sm text-gray-500 text-center py-4">Aucun produit disponible dans cette catégorie</p>';
            productsChecklistContainer.classList.remove('hidden');
            return;
        }

        filtered.forEach(p => {
            const isChecked = selectedProductsMap.has(p.id);
            const label = document.createElement('label');
            label.className = 'flex items-center justify-between p-2 rounded-lg hover:bg-purple-50/50 cursor-pointer product-checkbox-label';
            
            const formattedPrice = p.price.toLocaleString('fr-FR', { minimumFractionDigits: 2 }) + ' DH';
            
            label.innerHTML = `
                <div class="flex items-center gap-3">
                    <input type="checkbox" 
                           value="${p.id}" 
                           class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500 product-checkbox"
                           ${isChecked ? 'checked' : ''}>
                    <div>
                        <span class="font-medium text-gray-800 product-name">${p.name}</span>
                    </div>
                </div>
                <span class="font-semibold text-gray-700">${formattedPrice}</span>
            `;

            // Event listener on checkbox change
            const checkbox = label.querySelector('input');
            checkbox.addEventListener('change', function () {
                if (this.checked) {
                    addProduct(p);
                } else {
                    removeProduct(p.id);
                }
            });

            productsChecklistContainer.appendChild(label);
        });

        productsChecklistContainer.classList.remove('hidden');
    }

    function addProduct(p) {
        if (selectedProductsMap.has(p.id)) return;
        selectedProductsMap.set(p.id, p);
        
        // Add hidden input
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'product_ids[]';
        input.value = p.id;
        input.id = `hidden_input_${p.id}`;
        hiddenInputsContainer.appendChild(input);

        renderSelectedProducts();
        calculateTotals();
    }

    function removeProduct(id) {
        if (!selectedProductsMap.has(id)) return;
        selectedProductsMap.delete(id);

        // Remove hidden input
        const input = document.getElementById(`hidden_input_${id}`);
        if (input) input.remove();

        // Uncheck if currently rendered in checklist
        const chk = productsChecklistContainer.querySelector(`input[value="${id}"]`);
        if (chk) chk.checked = false;

        renderSelectedProducts();
        calculateTotals();
    }

    function renderSelectedProducts() {
        // Clear list
        selectedProductsList.innerHTML = '';

        if (selectedProductsMap.size === 0) {
            selectedProductsList.appendChild(emptySelectedMsg);
            return;
        }

        selectedProductsMap.forEach(p => {
            const item = document.createElement('div');
            item.className = 'flex items-center justify-between p-2 bg-white rounded-lg border shadow-sm';
            item.style.borderColor = '#e5e7eb';
            
            const formattedPrice = p.price.toLocaleString('fr-FR', { minimumFractionDigits: 2 }) + ' DH';
            
            item.innerHTML = `
                <div class="flex-grow pr-4">
                    <span class="text-sm font-semibold text-gray-800">${p.name}</span>
                    <span class="text-xs text-purple-600 block">${p.category_name}</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm font-bold text-gray-700">${formattedPrice}</span>
                    <button type="button" class="text-red-500 hover:text-red-700 flex items-center justify-center p-1 rounded hover:bg-red-50 transition-colors">
                        <i class="fas fa-times text-base"></i>
                    </button>
                </div>
            `;

            const btn = item.querySelector('button');
            btn.addEventListener('click', function () {
                removeProduct(p.id);
            });

            selectedProductsList.appendChild(item);
        });
    }

    function calculateTotals() {
        let totalOriginal = 0;
        selectedProductsMap.forEach(p => {
            totalOriginal += p.price;
        });

        const packPrice = parseFloat(packPriceInput.value) || 0;
        const savings = totalOriginal - packPrice;
        const savingsPercent = totalOriginal > 0 ? Math.round((savings / totalOriginal) * 100) : 0;

        totalOriginalDisplay.textContent = totalOriginal.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        packPriceDisplay.textContent = packPrice.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        if (savings > 0) {
            savingsDisplay.textContent = savings.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            savingsPercentDisplay.textContent = savingsPercent;
        } else {
            savingsDisplay.textContent = '0,00';
            savingsPercentDisplay.textContent = '0';
        }
    }

    // Initial renders
    renderSelectedProducts();
    calculateTotals();
});
@endif
</script>
@endpush
