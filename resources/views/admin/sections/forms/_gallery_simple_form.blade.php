{{-- Gallery Section Form - Simplified --}}

<div class="grid grid-cols-2 gap-6">
    
    <!-- Left Column: Images 1 & 2 -->
    <div class="space-y-6">
        <div class="flex items-center space-x-2 mb-4">
            <i class="fas fa-images text-primary text-xl"></i>
            <h3 class="text-xl font-semibold text-gray-900">Gallery Images (Left)</h3>
        </div>
        
        <!-- Left Image 1 (Wide) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Left Image 1 - Wide <span class="text-red-500">*</span>
            </label>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-2 mb-2">
                <p class="text-xs text-blue-800">
                    <i class="fas fa-info-circle mr-1"></i>
                    Ratio recommandé : <strong>16:10</strong> ou <strong>8:5</strong> (ex: 800x500px)
                </p>
            </div>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors bg-gray-50">
                <div id="left-image-1-preview" class="mb-3">
                    @if($section->data['left_image_1'] ?? null)
                        <img src="{{ asset('storage/' . $section->data['left_image_1']) }}" 
                             alt="Left 1" 
                             class="mx-auto max-h-32 w-auto object-cover rounded-lg shadow-md">
                    @else
                        <i class="fas fa-image text-6xl text-gray-400"></i>
                        <p class="text-gray-500 text-sm mt-2">No image uploaded</p>
                    @endif
                </div>
                <input type="file" 
                       name="data[left_image_1]" 
                       id="left-image-1-input"
                       accept="image/jpeg,image/jpg,image/png,image/webp"
                       class="hidden"
                       onchange="previewGalleryImage(this, 1)">
                <label for="left-image-1-input" class="cursor-pointer inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-all text-sm font-semibold">
                    <i class="fas fa-upload mr-2"></i>
                    Choose Image
                </label>
                <p class="text-xs text-gray-500 mt-2">JPG, PNG, WEBP • Max 2MB</p>
            </div>
        </div>
        
        <!-- Left Image 2 (Square) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Left Image 2 - Square <span class="text-red-500">*</span>
            </label>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-2 mb-2">
                <p class="text-xs text-blue-800">
                    <i class="fas fa-info-circle mr-1"></i>
                    Ratio recommandé : <strong>1:1</strong> (carré, ex: 400x400px)
                </p>
            </div>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors bg-gray-50">
                <div id="left-image-2-preview" class="mb-3">
                    @if($section->data['left_image_2'] ?? null)
                        <img src="{{ asset('storage/' . $section->data['left_image_2']) }}" 
                             alt="Left 2" 
                             class="mx-auto max-h-32 w-auto object-cover rounded-lg shadow-md">
                    @else
                        <i class="fas fa-image text-6xl text-gray-400"></i>
                        <p class="text-gray-500 text-sm mt-2">No image uploaded</p>
                    @endif
                </div>
                <input type="file" 
                       name="data[left_image_2]" 
                       id="left-image-2-input"
                       accept="image/jpeg,image/jpg,image/png,image/webp"
                       class="hidden"
                       onchange="previewGalleryImage(this, 2)">
                <label for="left-image-2-input" class="cursor-pointer inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-all text-sm font-semibold">
                    <i class="fas fa-upload mr-2"></i>
                    Choose Image
                </label>
                <p class="text-xs text-gray-500 mt-2">JPG, PNG, WEBP • Max 2MB</p>
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
                    <p class="text-sm text-gray-600">Display on homepage</p>
                </div>
            </label>
        </div>
    </div>
    
    <!-- Right Column: Images 3 & 4 -->
    <div class="space-y-6">
        <div class="flex items-center space-x-2 mb-4">
            <i class="fas fa-images text-primary text-xl"></i>
            <h3 class="text-xl font-semibold text-gray-900">Gallery Images (Right)</h3>
        </div>
        
        <!-- Right Image 1 (Square) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Right Image 1 - Square <span class="text-red-500">*</span>
            </label>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-2 mb-2">
                <p class="text-xs text-blue-800">
                    <i class="fas fa-info-circle mr-1"></i>
                    Ratio recommandé : <strong>1:1</strong> (carré, ex: 400x400px)
                </p>
            </div>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors bg-gray-50">
                <div id="right-image-1-preview" class="mb-3">
                    @if($section->data['right_image_1'] ?? null)
                        <img src="{{ asset('storage/' . $section->data['right_image_1']) }}" 
                             alt="Right 1" 
                             class="mx-auto max-h-32 w-auto object-cover rounded-lg shadow-md">
                    @else
                        <i class="fas fa-image text-6xl text-gray-400"></i>
                        <p class="text-gray-500 text-sm mt-2">No image uploaded</p>
                    @endif
                </div>
                <input type="file" 
                       name="data[right_image_1]" 
                       id="right-image-1-input"
                       accept="image/jpeg,image/jpg,image/png,image/webp"
                       class="hidden"
                       onchange="previewGalleryImage(this, 3)">
                <label for="right-image-1-input" class="cursor-pointer inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-all text-sm font-semibold">
                    <i class="fas fa-upload mr-2"></i>
                    Choose Image
                </label>
                <p class="text-xs text-gray-500 mt-2">JPG, PNG, WEBP • Max 2MB</p>
            </div>
        </div>
        
        <!-- Right Image 2 (Wide) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Right Image 2 - Wide <span class="text-red-500">*</span>
            </label>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-2 mb-2">
                <p class="text-xs text-blue-800">
                    <i class="fas fa-info-circle mr-1"></i>
                    Ratio recommandé : <strong>16:10</strong> ou <strong>8:5</strong> (ex: 800x500px)
                </p>
            </div>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors bg-gray-50">
                <div id="right-image-2-preview" class="mb-3">
                    @if($section->data['right_image_2'] ?? null)
                        <img src="{{ asset('storage/' . $section->data['right_image_2']) }}" 
                             alt="Right 2" 
                             class="mx-auto max-h-32 w-auto object-cover rounded-lg shadow-md">
                    @else
                        <i class="fas fa-image text-6xl text-gray-400"></i>
                        <p class="text-gray-500 text-sm mt-2">No image uploaded</p>
                    @endif
                </div>
                <input type="file" 
                       name="data[right_image_2]" 
                       id="right-image-2-input"
                       accept="image/jpeg,image/jpg,image/png,image/webp"
                       class="hidden"
                       onchange="previewGalleryImage(this, 4)">
                <label for="right-image-2-input" class="cursor-pointer inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-all text-sm font-semibold">
                    <i class="fas fa-upload mr-2"></i>
                    Choose Image
                </label>
                <p class="text-xs text-gray-500 mt-2">JPG, PNG, WEBP • Max 2MB</p>
            </div>
        </div>
        
        <!-- Info Box -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-600 mt-0.5 mr-2"></i>
                <div class="text-sm text-blue-900">
                    <p class="font-semibold mb-1">Structure de la Gallery:</p>
                    <ul class="text-xs space-y-1 ml-4 list-disc">
                        <li>Left Image 1: Grande image horizontale (16:10)</li>
                        <li>Left Image 2: Petite image carrée (1:1)</li>
                        <li>Right Image 1: Petite image carrée (1:1)</li>
                        <li>Right Image 2: Grande image horizontale (16:10)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script>
// Preview gallery images
function previewGalleryImage(input, number) {
    let previewId;
    if (number === 1) previewId = 'left-image-1-preview';
    else if (number === 2) previewId = 'left-image-2-preview';
    else if (number === 3) previewId = 'right-image-1-preview';
    else if (number === 4) previewId = 'right-image-2-preview';
    
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
            preview.innerHTML = `<img src="${e.target.result}" class="mx-auto max-h-32 w-auto object-cover rounded-lg shadow-md">`;
        };
        reader.readAsDataURL(file);
    }
}
</script>
