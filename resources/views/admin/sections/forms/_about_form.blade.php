{{-- About Section Specific Form - Simplified --}}

<div class="grid grid-cols-2 gap-6">
    <!-- Left Column: Images -->
    <div class="space-y-6">
        <div class="flex items-center space-x-2 mb-4">
            <i class="fas fa-images text-primary text-xl"></i>
            <h3 class="text-xl font-semibold text-gray-900">About Images</h3>
        </div>
        
        <!-- Left & Right Images - Side by Side -->
        <div class="grid grid-cols-2 gap-4">
            <!-- Left Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Left Image <span class="text-red-500">*</span>
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-primary transition-colors bg-gray-50">
                    @if($section->data['left_image'] ?? null)
                        <img src="{{ asset('storage/' . $section->data['left_image']) }}" alt="Left" class="mx-auto h-32 w-auto object-cover rounded-lg mb-2 shadow-md" id="left-image-preview">
                    @else
                        <div class="mb-2 py-6" id="left-image-preview">
                            <i class="fas fa-image text-5xl text-gray-400"></i>
                        </div>
                    @endif
                    <input type="file" 
                           name="data[left_image]" 
                           id="left-image-input"
                           accept="image/jpeg,image/jpg,image/png,image/webp"
                           class="hidden"
                           onchange="previewImage(this, 'left-image-preview')">
                    <label for="left-image-input" class="cursor-pointer inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-all text-xs font-semibold">
                        <i class="fas fa-upload mr-1"></i>
                        Choose
                    </label>
                    <p class="text-xs text-gray-500 mt-2">Max 2MB</p>
                </div>
            </div>
            
            <!-- Right Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Right Image <span class="text-red-500">*</span>
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-primary transition-colors bg-gray-50">
                    @if($section->data['right_image'] ?? null)
                        <img src="{{ asset('storage/' . $section->data['right_image']) }}" alt="Right" class="mx-auto h-32 w-auto object-cover rounded-lg mb-2 shadow-md" id="right-image-preview">
                    @else
                        <div class="mb-2 py-6" id="right-image-preview">
                            <i class="fas fa-image text-5xl text-gray-400"></i>
                        </div>
                    @endif
                    <input type="file" 
                           name="data[right_image]" 
                           id="right-image-input"
                           accept="image/jpeg,image/jpg,image/png,image/webp"
                           class="hidden"
                           onchange="previewImage(this, 'right-image-preview')">
                    <label for="right-image-input" class="cursor-pointer inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-all text-xs font-semibold">
                        <i class="fas fa-upload mr-1"></i>
                        Choose
                    </label>
                    <p class="text-xs text-gray-500 mt-2">Max 2MB</p>
                </div>
            </div>
        </div>
        
        <!-- Brand Logo (Center) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Brand Logo (Center) <span class="text-red-500">*</span>
            </label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors bg-gray-50">
                @if($section->data['image'] ?? $section->image ?? null)
                    <img src="{{ asset('storage/' . ($section->data['image'] ?? $section->image)) }}" alt="Logo" class="mx-auto h-32 w-auto object-contain rounded-lg mb-3" id="logo-preview">
                @else
                    <div class="mb-3 py-6" id="logo-preview">
                        <i class="fas fa-copyright text-6xl text-gray-400"></i>
                    </div>
                @endif
                <input type="file" 
                       name="image" 
                       id="logo-input"
                       accept="image/jpeg,image/jpg,image/png,image/webp"
                       class="hidden"
                       onchange="previewImage(this, 'logo-preview')">
                <label for="logo-input" class="cursor-pointer inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-all text-sm font-semibold">
                    <i class="fas fa-upload mr-2"></i>
                    Choose Logo
                </label>
                <p class="text-xs text-gray-500 mt-2">PNG transparent • Max 2MB</p>
            </div>
        </div>
    </div>
    
    <!-- Right Column: Texts & Settings -->
    <div class="space-y-6">
        <div class="flex items-center space-x-2 mb-4">
            <i class="fas fa-text text-primary text-xl"></i>
            <h3 class="text-xl font-semibold text-gray-900">About Content</h3>
        </div>
        
        <!-- Text 1: Description above logo -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Description (Above Logo) <span class="text-red-500">*</span>
            </label>
            <textarea name="data[brand_quote]" 
                      rows="4"
                      maxlength="300"
                      class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all resize-none"
                      placeholder="Une entreprise établie depuis 1989, spécialisée dans les cosmétiques..."
                      required>{{ old('data.brand_quote', $section->data['brand_quote'] ?? '') }}</textarea>
            <p class="text-xs text-gray-500 mt-1">
                <span id="quote-count">{{ strlen($section->data['brand_quote'] ?? '') }}</span>/300 characters
            </p>
        </div>
        
        <!-- Text 2: Main text (Pourquoi Choisir) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Main Text (Pourquoi Choisir Notre Marque) <span class="text-red-500">*</span>
            </label>
            <textarea name="description" 
                      rows="6"
                      maxlength="500"
                      class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all resize-none"
                      placeholder="Lotus Diamant est une marque cosmétique dédiée à l'innovation beauté..."
                      required>{{ old('description', $section->description) }}</textarea>
            <p class="text-xs text-gray-500 mt-1">
                <span id="desc-count">{{ strlen($section->description ?? '') }}</span>/500 characters
            </p>
        </div>
        
        <!-- Settings -->
        <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-6">
            <div class="flex items-center space-x-2 mb-4">
                <i class="fas fa-cog text-primary text-xl"></i>
                <h4 class="text-lg font-semibold text-gray-900">Settings</h4>
            </div>
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
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
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
            const heightClass = previewId === 'logo-preview' ? 'h-32' : 'h-32';
            preview.innerHTML = `<img src="${e.target.result}" class="mx-auto ${heightClass} w-auto object-cover rounded-lg shadow-md">`;
        };
        reader.readAsDataURL(file);
    }
}

// Character counters
document.addEventListener('DOMContentLoaded', function() {
    const quoteInput = document.querySelector('textarea[name="data[brand_quote]"]');
    const descInput = document.querySelector('textarea[name="description"]');
    
    if (quoteInput) {
        quoteInput.addEventListener('input', function() {
            document.getElementById('quote-count').textContent = this.value.length;
        });
    }
    
    if (descInput) {
        descInput.addEventListener('input', function() {
            document.getElementById('desc-count').textContent = this.value.length;
        });
    }
});
</script>
