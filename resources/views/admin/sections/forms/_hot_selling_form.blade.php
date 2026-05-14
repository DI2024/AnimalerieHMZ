{{-- Best Sellers Section Form - Simplified --}}

<div class="grid grid-cols-2 gap-6">
    
    <!-- Left Column: Promo Images -->
    <div class="space-y-6">
        <div class="flex items-center space-x-2 mb-4">
            <i class="fas fa-fire text-primary text-xl"></i>
            <h3 class="text-xl font-semibold text-gray-900">Best Sellers</h3>
        </div>
        
        <!-- Promo Image 1 -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Promo Image 1 <span class="text-red-500">*</span>
            </label>
            <div 
    </div>
</div>

{{-- Top Promo Image --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
        <i class="fas fa-image text-primary mr-2"></i>
        Top Promo Image
    </h3>
    
    <div class="space-y-6">
        
        {{-- Top Image Upload --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Top Image <span class="text-red-500">*</span>
            </label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors">
                <input type="file" 
                       id="top-image-input"
                       name="data[top_image]" 
                       accept="image/jpeg,image/jpg,image/png,image/webp"
                       class="hidden"
                       onchange="previewImageWithValidation(this, 'top-image-preview', 600, 800)">
                <label for="top-image-input" class="cursor-pointer">
                    <div id="top-image-preview" class="mb-3">
                        @if(isset($section->data['top_image']))
                            <img src="{{ asset('storage/' . $section->data['top_image']) }}" 
                                 class="mx-auto h-32 w-auto object-cover rounded-lg">
                        @else
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600 font-medium">Click to upload top image</p>
                    <p class="text-xs text-gray-500 mt-1">
                        <strong>Required:</strong> 600x800px | JPG, PNG, WEBP | Max 2MB
                    </p>
                </label>
            </div>
        </div>
        
        {{-- Top Text --}}
        <div>
            <label for="top-text-input" class="block text-sm font-medium text-gray-700 mb-2">
                Top Text
            </label>
            <textarea id="top-text-input"
                      name="data[top_text]" 
                      rows="3"
                      maxlength="200"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                      placeholder="Beauty Glow Cream - Transform your skin...">{{ old('data.top_text', $section->data['top_text'] ?? '') }}</textarea>
            <p class="text-xs text-gray-500 mt-1">
                <span id="top-text-count">{{ strlen($section->data['top_text'] ?? '') }}</span>/200 characters
            </p>
        </div>
        
        {{-- Top Button --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="top-button-text-input" class="block text-sm font-medium text-gray-700 mb-2">
                    Top Button Text
                </label>
                <input type="text" 
                       id="top-button-text-input"
                       name="data[top_button_text]" 
                       value="{{ old('data.top_button_text', $section->data['top_button_text'] ?? 'SHOP NOW') }}"
                       maxlength="30"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                       placeholder="SHOP NOW">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Top Button Color
                </label>
                <div class="flex items-center space-x-3">
                    <div id="top-button-color-picker"></div>
                    <input type="hidden" 
                           id="top-button-color-input"
                           name="data[top_button_color]" 
                           value="{{ old('data.top_button_color', $section->data['top_button_color'] ?? '#9a7b2f') }}">
                    <span id="top-button-color-value" class="text-xs text-gray-600 font-mono">
                        {{ $section->data['top_button_color'] ?? '#9a7b2f' }}
                    </span>
                </div>
            </div>
        </div>
        
    </div>
</div>

{{-- Bottom Promo Image --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
        <i class="fas fa-image text-primary mr-2"></i>
        Bottom Promo Image
    </h3>
    
    <div class="space-y-6">
        
        {{-- Bottom Image Upload --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Bottom Image <span class="text-red-500">*</span>
            </label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors">
                <input type="file" 
                       id="bottom-image-input"
                       name="data[bottom_image]" 
                       accept="image/jpeg,image/jpg,image/png,image/webp"
                       class="hidden"
                       onchange="previewImageWithValidation(this, 'bottom-image-preview', 600, 800)">
                <label for="bottom-image-input" class="cursor-pointer">
                    <div id="bottom-image-preview" class="mb-3">
                        @if(isset($section->data['bottom_image']))
                            <img src="{{ asset('storage/' . $section->data['bottom_image']) }}" 
                                 class="mx-auto h-32 w-auto object-cover rounded-lg">
                        @else
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600 font-medium">Click to upload bottom image</p>
                    <p class="text-xs text-gray-500 mt-1">
                        <strong>Required:</strong> 600x800px | JPG, PNG, WEBP | Max 2MB
                    </p>
                </label>
            </div>
        </div>
        
        {{-- Bottom Text --}}
        <!-- <div>
            <label for="bottom-text-input" class="block text-sm font-medium text-gray-700 mb-2">
                Bottom Text
            </label>
            <textarea id="bottom-text-input"
                      name="data[bottom_text]" 
                      rows="3"
                      maxlength="200"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                      placeholder="10% Off This Summer Offer!">{{ old('data.bottom_text', $section->data['bottom_text'] ?? '') }}</textarea>
            <p class="text-xs text-gray-500 mt-1">
                <span id="bottom-text-count">{{ strlen($section->data['bottom_text'] ?? '') }}</span>/200 characters
            </p>
        </div> -->
        
        {{-- Bottom Button --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="bottom-button-text-input" class="block text-sm font-medium text-gray-700 mb-2">
                    Bottom Button Text
                </label>
                <input type="text" 
                       id="bottom-button-text-input"
                       name="data[bottom_button_text]" 
                       value="{{ old('data.bottom_button_text', $section->data['bottom_button_text'] ?? 'SHOP NOW') }}"
                       maxlength="30"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                       placeholder="SHOP NOW">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Bottom Button Color
                </label>
                <div class="flex items-center space-x-3">
                    <div id="bottom-button-color-picker"></div>
                    <input type="hidden" 
                           id="bottom-button-color-input"
                           name="data[bottom_button_color]" 
                           value="{{ old('data.bottom_button_color', $section->data['bottom_button_color'] ?? '#9a7b2f') }}">
                    <span id="bottom-button-color-value" class="text-xs text-gray-600 font-mono">
                        {{ $section->data['bottom_button_color'] ?? '#9a7b2f' }}
                    </span>
                </div>
            </div>
        </div>
        
    </div>
</div>

{{-- Best Selling Products Preview --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
        <i class="fas fa-fire text-primary mr-2"></i>
        Best Selling Products (Auto-loaded)
    </h3>
    
    @php
        $bestSellers = \App\Models\Product::where('is_bestseller', true)
                                          ->where('is_active', true)
                                          ->with('category')
                                          ->orderBy('order')
                                          ->limit(6)
                                          ->get();
    @endphp
    
    @if($bestSellers->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($bestSellers as $product)
                <div class="border border-gray-200 rounded-lg p-3 hover:shadow-md transition-shadow">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-32 object-cover rounded-lg mb-2">
                    @else
                        <div class="w-full h-32 bg-gray-100 rounded-lg mb-2 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-2xl"></i>
                        </div>
                    @endif
                    <p class="text-xs font-semibold text-gray-900 truncate">{{ $product->name }}</p>
                    <p class="text-xs text-gray-500">{{ $product->category->name ?? 'N/A' }}</p>
                    <p class="text-sm font-bold text-primary mt-1">${{ number_format($product->price, 2) }}</p>
                    <span class="inline-block mt-1 px-2 py-0.5 bg-red-100 text-red-800 text-xs rounded-full">
                        <i class="fas fa-fire mr-1"></i>Best Seller
                    </span>
                </div>
            @endforeach
        </div>
        
        <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-sm text-green-800">
                <i class="fas fa-check-circle mr-2"></i>
                <strong>{{ $bestSellers->count() }}</strong> best selling products will be displayed.
            </p>
        </div>
    @else
        <div class="p-8 text-center bg-yellow-50 border border-yellow-200 rounded-lg">
            <i class="fas fa-exclamation-triangle text-yellow-600 text-3xl mb-3"></i>
            <p class="text-sm text-yellow-800 mb-2">
                <strong>No best selling products found!</strong>
            </p>
            <p class="text-xs text-yellow-700 mb-4">
                Go to Products → Edit → Check "Best Seller" to add products to this section.
            </p>
            <a href="{{ route('admin.products.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors text-sm">
                <i class="fas fa-plus mr-2"></i>
                Manage Products
            </a>
        </div>
    @endif
</div>

{{-- Status Toggle --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-6">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-sm font-semibold text-gray-900">Section Status</h3>
            <p class="text-xs text-gray-500 mt-1">Enable or disable this section on the homepage</p>
        </div>
        <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" 
                   name="is_active" 
                   value="1" 
                   {{ old('is_active', $section->is_active) ? 'checked' : '' }}
                   class="sr-only peer">
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
        </label>
    </div>
</div>

<script>
// Image validation with exact resolution
function previewImageWithValidation(input, previewId, requiredWidth, requiredHeight) {
    const file = input.files[0];
    const preview = document.getElementById(previewId);
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = new Image();
            img.onload = function() {
                if (this.width === requiredWidth && this.height === requiredHeight) {
                    preview.innerHTML = `<img src="${e.target.result}" class="mx-auto h-32 w-auto object-cover rounded-lg">`;
                } else {
                    alert(`Image resolution must be exactly ${requiredWidth}x${requiredHeight}px. Your image is ${this.width}x${this.height}px.`);
                    input.value = '';
                    preview.innerHTML = `<i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>`;
                }
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
</script>
