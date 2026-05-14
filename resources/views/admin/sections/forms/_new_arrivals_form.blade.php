{{-- New Arrivals Section Form - With Drag & Drop --}}

<div class="grid grid-cols-1 gap-6">
    
    <!-- Info Banner -->
    <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-4">
        <div class="flex items-start space-x-3">
            <i class="fas fa-info-circle text-blue-600 text-xl"></i>
            <div>
                <h3 class="text-base font-semibold text-blue-900 mb-1">New Arrivals Section</h3>
                <p class="text-sm text-blue-800">
                    Sélectionnez jusqu'à 20 produits récents et réorganisez-les par glisser-déposer.
                </p>
            </div>
        </div>
    </div>

    <!-- Product Selection -->
    <div class="bg-white rounded-lg border-2 border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-box-open text-primary mr-2"></i>
                Sélection des Produits (Max 20)
            </h3>
            <span class="text-sm text-gray-600">
                <span id="selected-count">0</span> / 20 sélectionnés
            </span>
        </div>

        @php
            $recentProducts = \App\Models\Product::where('is_active', true)
                                                  ->with('category')
                                                  ->orderBy('created_at', 'desc')
                                                  ->limit(50)
                                                  ->get();
            
            $selectedProductsData = $section->data['selected_products'] ?? [];
            // Décoder si c'est une chaîne JSON
            if (is_string($selectedProductsData)) {
                $selectedProducts = json_decode($selectedProductsData, true) ?? [];
            } else {
                $selectedProducts = is_array($selectedProductsData) ? $selectedProductsData : [];
            }
        @endphp

        <!-- Selected Products (Sortable) -->
        <div class="mb-6">
            <h4 class="text-sm font-semibold text-gray-700 mb-3">Produits Sélectionnés (Glissez pour réorganiser)</h4>
            <div id="selected-products-list" class="space-y-2 min-h-[100px] bg-gray-50 rounded-lg p-4 border-2 border-dashed border-gray-300">
                @if(count($selectedProducts) > 0)
                    @foreach($selectedProducts as $productId)
                        @php
                            $product = \App\Models\Product::find($productId);
                        @endphp
                        @if($product)
                            <div class="selected-product-item bg-white border-2 border-gray-200 rounded-lg p-3 flex items-center space-x-3 cursor-move hover:shadow-md transition-all" data-product-id="{{ $product->id }}">
                                <i class="fas fa-grip-vertical text-gray-400"></i>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $product->category->name ?? 'N/A' }} • ${{ number_format($product->price, 2) }}</p>
                                </div>
                                <button type="button" onclick="removeProduct({{ $product->id }})" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="text-sm text-gray-500 text-center py-8">Aucun produit sélectionné. Cliquez sur les produits ci-dessous pour les ajouter.</p>
                @endif
            </div>
            <input type="hidden" name="data[selected_products]" id="selected-products-input" value="{{ json_encode($selectedProducts) }}">
        </div>

        <!-- Available Products -->
        <div>
            <h4 class="text-sm font-semibold text-gray-700 mb-3">Produits Disponibles (Cliquez pour ajouter)</h4>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 max-h-[400px] overflow-y-auto p-2">
                @foreach($recentProducts as $product)
                    <div class="available-product border-2 border-gray-200 rounded-lg p-3 cursor-pointer hover:border-primary hover:shadow-md transition-all {{ in_array($product->id, $selectedProducts) ? 'opacity-50 pointer-events-none' : '' }}" 
                         data-product-id="{{ $product->id }}"
                         onclick="addProduct({{ $product->id }}, '{{ addslashes($product->name) }}', '{{ $product->category->name ?? 'N/A' }}', {{ $product->price }}, '{{ $product->image ? asset('storage/' . $product->image) : '' }}')">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-24 object-cover rounded mb-2">
                        @else
                            <div class="w-full h-24 bg-gray-100 rounded mb-2 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-xl"></i>
                            </div>
                        @endif
                        <p class="text-xs font-semibold text-gray-900 truncate">{{ $product->name }}</p>
                        <p class="text-xs text-gray-500">{{ $product->category->name ?? 'N/A' }}</p>
                        <p class="text-sm font-bold text-primary mt-1">${{ number_format($product->price, 2) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Settings -->
    <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-6">
        <label class="flex items-center space-x-3 cursor-pointer">
            <input type="checkbox" 
                   name="is_active" 
                   value="1" 
                   {{ old('is_active', $section->is_active) ? 'checked' : '' }}
                   class="w-6 h-6 rounded text-primary focus:ring-primary">
            <div>
                <span class="text-base font-semibold text-gray-900">Section Active</span>
                <p class="text-sm text-gray-600">Afficher cette section sur la page d'accueil</p>
            </div>
        </label>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
let selectedProducts = @json($selectedProducts);

// Initialize Sortable
document.addEventListener('DOMContentLoaded', function() {
    const selectedList = document.getElementById('selected-products-list');
    
    new Sortable(selectedList, {
        animation: 150,
        handle: '.selected-product-item',
        ghostClass: 'bg-blue-100',
        onEnd: function() {
            updateSelectedProducts();
        }
    });
    
    updateCount();
});

// Add product to selected list
function addProduct(id, name, category, price, image) {
    if (selectedProducts.length >= 20) {
        alert('Maximum 20 produits autorisés');
        return;
    }
    
    if (selectedProducts.includes(id)) {
        return;
    }
    
    selectedProducts.push(id);
    
    const selectedList = document.getElementById('selected-products-list');
    const emptyMessage = selectedList.querySelector('p');
    if (emptyMessage) emptyMessage.remove();
    
    const imageHtml = image 
        ? `<img src="${image}" alt="${name}" class="w-12 h-12 object-cover rounded">`
        : `<div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center"><i class="fas fa-image text-gray-400"></i></div>`;
    
    const productHtml = `
        <div class="selected-product-item bg-white border-2 border-gray-200 rounded-lg p-3 flex items-center space-x-3 cursor-move hover:shadow-md transition-all" data-product-id="${id}">
            <i class="fas fa-grip-vertical text-gray-400"></i>
            ${imageHtml}
            <div class="flex-1">
                <p class="text-sm font-semibold text-gray-900">${name}</p>
                <p class="text-xs text-gray-500">${category} • $${price.toFixed(2)}</p>
            </div>
            <button type="button" onclick="removeProduct(${id})" class="text-red-500 hover:text-red-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    selectedList.insertAdjacentHTML('beforeend', productHtml);
    
    // Disable in available list
    const availableProduct = document.querySelector(`.available-product[data-product-id="${id}"]`);
    if (availableProduct) {
        availableProduct.classList.add('opacity-50', 'pointer-events-none');
    }
    
    updateSelectedProducts();
    updateCount();
}

// Remove product from selected list
function removeProduct(id) {
    selectedProducts = selectedProducts.filter(pid => pid !== id);
    
    const productItem = document.querySelector(`.selected-product-item[data-product-id="${id}"]`);
    if (productItem) {
        productItem.remove();
    }
    
    // Enable in available list
    const availableProduct = document.querySelector(`.available-product[data-product-id="${id}"]`);
    if (availableProduct) {
        availableProduct.classList.remove('opacity-50', 'pointer-events-none');
    }
    
    const selectedList = document.getElementById('selected-products-list');
    if (selectedList.children.length === 0) {
        selectedList.innerHTML = '<p class="text-sm text-gray-500 text-center py-8">Aucun produit sélectionné. Cliquez sur les produits ci-dessous pour les ajouter.</p>';
    }
    
    updateSelectedProducts();
    updateCount();
}

// Update hidden input with current order
function updateSelectedProducts() {
    const items = document.querySelectorAll('.selected-product-item');
    selectedProducts = Array.from(items).map(item => parseInt(item.dataset.productId));
    document.getElementById('selected-products-input').value = JSON.stringify(selectedProducts);
}

// Update count
function updateCount() {
    document.getElementById('selected-count').textContent = selectedProducts.length;
}
</script>

<style>
.selected-product-item {
    transition: all 0.2s;
}

.selected-product-item:hover {
    transform: translateY(-2px);
}

.available-product:hover {
    transform: scale(1.02);
}
</style>
