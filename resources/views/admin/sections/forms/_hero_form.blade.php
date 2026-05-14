{{-- Hero Section Specific Form - Ultra Compact --}}

<div class="grid grid-cols-2 gap-6">
    <!-- Left: Upload Image -->
    <div>
        <div class="flex items-center space-x-2 mb-4">
            <i class="fas fa-image text-primary text-xl"></i>
            <h3 class="text-xl font-semibold text-gray-900">Hero Image</h3>
        </div>
        
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-primary transition-colors bg-gray-50">
            @if($section->data['image'] ?? $section->image ?? null)
                <img src="{{ asset('storage/' . ($section->data['image'] ?? $section->image)) }}" alt="Hero" class="mx-auto h-64 w-auto object-cover rounded-lg mb-4 shadow-lg" id="hero-image-preview">
            @else
                <div class="mb-4 py-12" id="hero-image-preview">
                    <i class="fas fa-image text-8xl text-gray-400"></i>
                    <p class="text-gray-500 text-lg mt-4">No image uploaded</p>
                </div>
            @endif
            <input type="file" 
                   name="image" 
                   id="hero-image-input"
                   accept="image/jpeg,image/jpg,image/png,image/webp"
                   class="hidden"
                   onchange="previewImage(this, 'hero-image-preview')"
                   required>
            <label for="hero-image-input" class="cursor-pointer inline-flex items-center px-8 py-4 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-all text-base font-semibold shadow-md">
                <i class="fas fa-upload mr-3 text-xl"></i>
                Choose Image
            </label>
            <p class="text-sm text-gray-600 mt-4 font-medium">1920 x 1080 pixels • Max 2MB</p>
        </div>
    </div>
    
    <!-- Right: Info & Settings -->
    <div class="space-y-6">
        <!-- Requirements -->
        <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-6">
            <div class="flex items-center space-x-2 mb-3">
                <i class="fas fa-info-circle text-blue-600 text-2xl"></i>
                <h4 class="text-lg font-semibold text-blue-900">Image Requirements</h4>
            </div>
            <div class="space-y-2 text-base text-blue-800">
                <p><strong>Recommended Size:</strong> 1920 x 1080 pixels</p>
                <p><strong>Aspect Ratio:</strong> 16:9 (widescreen)</p>
                <p><strong>Formats:</strong> JPG, PNG, WEBP</p>
                <p><strong>Maximum Size:</strong> 2MB</p>
            </div>
        </div>
        
        <!-- Settings -->
        <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-6">
            <div class="flex items-center space-x-2 mb-4">
                <i class="fas fa-cog text-primary text-2xl"></i>
                <h4 class="text-lg font-semibold text-gray-900">Section Settings</h4>
            </div>
            <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox" 
                       name="is_active" 
                       value="1" 
                       {{ old('is_active', $section->is_active) ? 'checked' : '' }}
                       class="w-6 h-6 rounded text-primary focus:ring-primary">
                <div>
                    <span class="text-base font-semibold text-gray-900">Section Active</span>
                    <p class="text-sm text-gray-600">Display this section on homepage</p>
                </div>
            </label>
        </div>
        
        <!-- Current Image -->
        @if($section->data['image'] ?? $section->image ?? null)
        <div class="bg-green-50 border-2 border-green-200 rounded-lg p-5">
            <div class="flex items-center space-x-2">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                <div>
                    <p class="text-sm font-semibold text-green-900">Current Image</p>
                    <p class="text-sm text-green-800">{{ basename($section->data['image'] ?? $section->image) }}</p>
                </div>
            </div>
        </div>
        @endif
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
            const img = new Image();
            img.onload = function() {
                if (img.width < 1600 || img.height < 900) {
                    alert('Warning: Image too small (min 1600x900)');
                }
                preview.innerHTML = `<img src="${e.target.result}" class="mx-auto h-64 w-auto object-cover rounded-lg shadow-lg">`;
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
</script>
