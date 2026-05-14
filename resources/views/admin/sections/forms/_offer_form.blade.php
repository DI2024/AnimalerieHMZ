{{-- Offer Banner Section Form - Simplified --}}

<div class="grid grid-cols-2 gap-6">
    
    <!-- Left Column: Image + Reduction + Countdown -->
    <div class="space-y-6">
        <div class="flex items-center space-x-2 mb-4">
            <i class="fas fa-percentage text-primary text-xl"></i>
            <h3 class="text-xl font-semibold text-gray-900">Offer Banner</h3>
        </div>
        
        <!-- Banner Image -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Banner Image <span class="text-red-500">*</span>
            </label>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-2 mb-2">
                <p class="text-xs text-blue-800">
                    <i class="fas fa-info-circle mr-1"></i>
                    Ratio recommandé : <strong>16:9</strong> ou <strong>4:3</strong>
                </p>
            </div>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors bg-gray-50">
                <div id="banner-image-preview" class="mb-3">
                    @if($section->data['banner_image'] ?? null)
                        <img src="{{ asset('storage/' . $section->data['banner_image']) }}" 
                             alt="Banner" 
                             class="mx-auto max-h-48 w-auto object-cover rounded-lg shadow-md">
                    @else
                        <i class="fas fa-image text-6xl text-gray-400"></i>
                        <p class="text-gray-500 text-sm mt-2">No image uploaded</p>
                    @endif
                </div>
                <input type="file" 
                       name="data[banner_image]" 
                       id="banner-image-input"
                       accept="image/jpeg,image/jpg,image/png,image/webp"
                       class="hidden"
                       onchange="previewBannerImage(this)"
                       required>
                <label for="banner-image-input" class="cursor-pointer inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-all text-sm font-semibold">
                    <i class="fas fa-upload mr-2"></i>
                    Choose Image
                </label>
                <p class="text-xs text-gray-500 mt-2">JPG, PNG, WEBP • Max 2MB</p>
            </div>
        </div>
        
        <!-- Maximum Reduction Percentage -->
        <div>
            <label for="max-reduction-input" class="block text-sm font-medium text-gray-700 mb-2">
                Maximum Reduction Percentage <span class="text-red-500">*</span>
            </label>
            <div class="flex items-center space-x-3">
                <input type="number" 
                       id="max-reduction-input"
                       name="data[max_reduction]" 
                       value="{{ old('data.max_reduction', $section->data['max_reduction'] ?? 50) }}"
                       min="1"
                       max="100"
                       class="w-32 px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-center text-3xl font-bold"
                       required>
                <span class="text-3xl font-bold text-primary">%</span>
            </div>
            <p class="text-xs text-gray-500 mt-1">Pourcentage de réduction à afficher</p>
        </div>
        
        <!-- Countdown Date -->
        <div>
            <label for="countdown-date-input" class="block text-sm font-medium text-gray-700 mb-2">
                Discount Limited Time (Countdown) <span class="text-red-500">*</span>
            </label>
            <input type="datetime-local" 
                   id="countdown-date-input"
                   name="data[countdown_date]" 
                   value="{{ old('data.countdown_date', $section->data['countdown_date'] ?? '') }}"
                   class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                   required>
            <p class="text-xs text-gray-500 mt-1">
                <i class="fas fa-clock mr-1"></i>
                Date et heure de fin du countdown
            </p>
        </div>
    </div>
    
    <!-- Right Column: 3 Product Selectors -->
    <div class="space-y-6">
        <div class="flex items-center space-x-2 mb-4">
            <i class="fas fa-box-open text-primary text-xl"></i>
            <h3 class="text-xl font-semibold text-gray-900">Featured Products (3)</h3>
        </div>
        
        @php
            $categories = \App\Models\Category::where('is_active', true)->orderBy('name')->get();
            $selectedProducts = [
                $section->data['product_1'] ?? null,
                $section->data['product_2'] ?? null,
                $section->data['product_3'] ?? null
            ];
        @endphp
        
        @for($i = 1; $i <= 3; $i++)
            <div class="bg-white border-2 border-gray-200 rounded-lg p-4">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Product {{ $i }} <span class="text-red-500">*</span>
                </label>
                
                <!-- Category Selector -->
                <div class="mb-3">
                    <label class="block text-xs text-gray-600 mb-1">1. Choisir la catégorie</label>
                    <select id="category-select-{{ $i }}" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary"
                            onchange="loadProductsByCategory({{ $i }}, this.value)">
                        <option value="">-- Sélectionner une catégorie --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Product Selector -->
                <div>
                    <label class="block text-xs text-gray-600 mb-1">2. Choisir le produit</label>
                    <select id="product-select-{{ $i }}" 
                            name="data[product_{{ $i }}]"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary"
                            disabled
                            required>
                        <option value="">-- Sélectionner un produit --</option>
                    </select>
                </div>
                
                <!-- Selected Product Preview -->
                <div id="product-preview-{{ $i }}" class="mt-3">
                    @if($selectedProducts[$i-1])
                        @php
                            $product = \App\Models\Product::find($selectedProducts[$i-1]);
                        @endphp
                        @if($product)
                            <div class="flex items-center space-x-3 p-3 bg-green-50 border border-green-200 rounded-lg">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <p class="text-xs font-semibold text-gray-900">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-500">${{ number_format($product->price, 2) }}</p>
                                </div>
                                <i class="fas fa-check-circle text-green-600"></i>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        @endfor
        
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
                    <p class="text-sm text-gray-600">Display on homepage</p>
                </div>
            </label>
        </div>
    </div>
    
</div>

<script>
// Preview banner image
function previewBannerImage(input) {
    const preview = document.getElementById('banner-image-preview');
    const file = input.files[0];
    
    if (file) {
        if (file.size > 2 * 1024 * 1024) {
            alert('File must be less than 2MB');
            input.value = '';
            return;
        }
        
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            alert('Invalid format. Use JPG, PNG or WEBP');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="mx-auto max-h-48 w-auto object-cover rounded-lg shadow-md">`;
        };
        reader.readAsDataURL(file);
    }
}

// Load products by category
async function loadProductsByCategory(selectorNumber, categoryId) {
    const productSelect = document.getElementById(`product-select-${selectorNumber}`);
    const productPreview = document.getElementById(`product-preview-${selectorNumber}`);
    
    // Reset
    productSelect.innerHTML = '<option value="">-- Sélectionner un produit --</option>';
    productSelect.disabled = true;
    productPreview.innerHTML = '';
    
    if (!categoryId) return;
    
    try {
        const response = await fetch(`https://lotusdiamant.ma/api_admin/public/api/v1/products?category_id=${categoryId}&per_page=100`);
        const data = await response.json();
        
        if (data.success && data.data.length > 0) {
            data.data.forEach(product => {
                const option = document.createElement('option');
                option.value = product.id;
                option.textContent = `${product.name} - $${product.price}`;
                productSelect.appendChild(option);
            });
            productSelect.disabled = false;
            
            // Add change event to show preview
            productSelect.onchange = function() {
                if (this.value) {
                    const selectedProduct = data.data.find(p => p.id == this.value);
                    if (selectedProduct) {
                        showProductPreview(selectorNumber, selectedProduct);
                    }
                } else {
                    productPreview.innerHTML = '';
                }
            };
        } else {
            productSelect.innerHTML = '<option value="">Aucun produit dans cette catégorie</option>';
        }
    } catch (error) {
        console.error('Error loading products:', error);
        productSelect.innerHTML = '<option value="">Erreur de chargement</option>';
    }
}

// Show product preview
function showProductPreview(selectorNumber, product) {
    const preview = document.getElementById(`product-preview-${selectorNumber}`);
    const imageHtml = product.image 
        ? `<img src="https://lotusdiamant.ma/api_admin/public/storage/${product.image}" alt="${product.name}" class="w-12 h-12 object-cover rounded">`
        : `<div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center"><i class="fas fa-image text-gray-400"></i></div>`;
    
    preview.innerHTML = `
        <div class="flex items-center space-x-3 p-3 bg-green-50 border border-green-200 rounded-lg">
            ${imageHtml}
            <div class="flex-1">
                <p class="text-xs font-semibold text-gray-900">${product.name}</p>
                <p class="text-xs text-gray-500">$${product.price}</p>
            </div>
            <i class="fas fa-check-circle text-green-600"></i>
        </div>
    `;
}

// Load selected products on page load
document.addEventListener('DOMContentLoaded', function() {
    @foreach($selectedProducts as $index => $productId)
        @if($productId)
            @php
                $product = \App\Models\Product::find($productId);
            @endphp
            @if($product && $product->category_id)
                // Pre-select category and load products
                const categorySelect{{ $index + 1 }} = document.getElementById('category-select-{{ $index + 1 }}');
                categorySelect{{ $index + 1 }}.value = {{ $product->category_id }};
                loadProductsByCategory({{ $index + 1 }}, {{ $product->category_id }}).then(() => {
                    const productSelect{{ $index + 1 }} = document.getElementById('product-select-{{ $index + 1 }}');
                    productSelect{{ $index + 1 }}.value = {{ $productId }};
                });
            @endif
        @endif
    @endforeach
});
</script>
