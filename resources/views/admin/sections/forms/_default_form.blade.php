{{-- Default/Generic Section Form --}}

<!-- Content Section -->
<div class="space-y-6">
    <div class="flex items-center space-x-2 pb-3 border-b border-gray-200">
        <i class="fas fa-align-left text-primary"></i>
        <h3 class="text-lg font-semibold text-gray-900">📝 Content</h3>
    </div>
    
    <!-- Title -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Title <span class="text-red-500">*</span>
        </label>
        <div class="flex items-center space-x-3">
            <input type="text" 
                   name="title" 
                   id="title-input"
                   value="{{ old('title', $section->title) }}"
                   class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                   placeholder="Enter section title..."
                   oninput="updatePreview()">
            
            <!-- Color Picker -->
            <div class="color-picker-wrapper">
                <div class="pickr-container" id="title-color-picker"></div>
                <input type="hidden" name="data[title_color]" id="title-color-input" value="{{ old('data.title_color', $section->data['title_color'] ?? '#000000') }}">
            </div>
        </div>
        <p class="text-xs text-gray-500 mt-1">
            <span id="title-count">{{ strlen($section->title ?? '') }}</span>/100 characters
        </p>
    </div>
    
    <!-- Subtitle -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
        <div class="flex items-center space-x-3">
            <input type="text" 
                   name="subtitle" 
                   id="subtitle-input"
                   value="{{ old('subtitle', $section->subtitle) }}"
                   class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                   placeholder="Enter subtitle..."
                   oninput="updatePreview()">
            
            <!-- Color Picker -->
            <div class="color-picker-wrapper">
                <div class="pickr-container" id="subtitle-color-picker"></div>
                <input type="hidden" name="data[subtitle_color]" id="subtitle-color-input" value="{{ old('data.subtitle_color', $section->data['subtitle_color'] ?? '#666666') }}">
            </div>
        </div>
    </div>
    
    <!-- Description -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
        <div class="space-y-2">
            <textarea name="description" 
                      id="description-input"
                      rows="4"
                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all resize-none"
                      placeholder="Enter description..."
                      oninput="updatePreview()">{{ old('description', $section->description) }}</textarea>
            
            <div class="flex items-center justify-between">
                <p class="text-xs text-gray-500">
                    <span id="desc-count">{{ strlen($section->description ?? '') }}</span>/500 characters
                </p>
                
                <!-- Color Picker -->
                <div class="color-picker-wrapper">
                    <span class="text-xs text-gray-600 mr-2">Text Color:</span>
                    <div class="pickr-container" id="description-color-picker"></div>
                    <input type="hidden" name="data[description_color]" id="description-color-input" value="{{ old('data.description_color', $section->data['description_color'] ?? '#666666') }}">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Media Section -->
<div class="space-y-6">
    <div class="flex items-center space-x-2 pb-3 border-b border-gray-200">
        <i class="fas fa-image text-primary"></i>
        <h3 class="text-lg font-semibold text-gray-900">🖼️ Media</h3>
    </div>
    
    <!-- Background Image -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-3">Background Image</label>
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors">
            @if($section->data['background_image'] ?? $section->background_image ?? null)
                <img src="{{ asset('storage/' . ($section->data['background_image'] ?? $section->background_image)) }}" alt="Background" class="mx-auto h-32 w-auto object-cover rounded-lg mb-3" id="bg-preview">
            @else
                <div class="mb-3" id="bg-preview">
                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                </div>
            @endif
            <input type="file" 
                   name="background_image" 
                   id="bg-image-input"
                   accept="image/*"
                   class="hidden"
                   onchange="previewImage(this, 'bg-preview')">
            <label for="bg-image-input" class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-upload mr-2"></i>
                Choose File
            </label>
            <p class="text-xs text-gray-500 mt-2">JPG, PNG, WEBP - Max 2MB</p>
        </div>
    </div>
    
    <!-- Main Image -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-3">Main Image</label>
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors">
            @if($section->data['image'] ?? $section->image ?? null)
                <img src="{{ asset('storage/' . ($section->data['image'] ?? $section->image)) }}" alt="Main" class="mx-auto h-32 w-auto object-cover rounded-lg mb-3" id="main-preview">
            @else
                <div class="mb-3" id="main-preview">
                    <i class="fas fa-image text-4xl text-gray-400"></i>
                </div>
            @endif
            <input type="file" 
                   name="image" 
                   id="main-image-input"
                   accept="image/*"
                   class="hidden"
                   onchange="previewImage(this, 'main-preview')">
            <label for="main-image-input" class="cursor-pointer inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-upload mr-2"></i>
                Choose File
            </label>
            <p class="text-xs text-gray-500 mt-2">JPG, PNG, WEBP - Max 2MB</p>
        </div>
    </div>
</div>

<!-- Button Section -->
<div class="space-y-6">
    <div class="flex items-center space-x-2 pb-3 border-b border-gray-200">
        <i class="fas fa-mouse-pointer text-primary"></i>
        <h3 class="text-lg font-semibold text-gray-900">🔘 Call to Action</h3>
    </div>
    
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
            <input type="text" 
                   name="button_text" 
                   id="button-text-input"
                   value="{{ old('button_text', $section->button_text) }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                   placeholder="SHOP NOW"
                   oninput="updatePreview()">
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Button Link</label>
            <input type="text" 
                   name="button_link" 
                   value="{{ old('button_link', $section->button_link) }}"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 cursor-not-allowed"
                   placeholder="/shop"
                   readonly>
        </div>
    </div>
    
    <!-- Button Colors -->
    <div class="bg-gray-50 rounded-lg p-4 space-y-4">
        <p class="text-sm font-medium text-gray-700">Button Styling</p>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs text-gray-600 mb-2">Background Color</label>
                <div class="flex items-center space-x-2">
                    <div class="pickr-container" id="button-bg-color-picker"></div>
                    <input type="hidden" name="data[button_bg_color]" id="button-bg-color-input" value="{{ old('data.button_bg_color', $section->data['button_bg_color'] ?? '#d4af37') }}">
                    <span class="text-xs text-gray-500" id="button-bg-color-value">{{ $section->data['button_bg_color'] ?? '#d4af37' }}</span>
                </div>
            </div>
            
            <div>
                <label class="block text-xs text-gray-600 mb-2">Text Color</label>
                <div class="flex items-center space-x-2">
                    <div class="pickr-container" id="button-text-color-picker"></div>
                    <input type="hidden" name="data[button_text_color]" id="button-text-color-input" value="{{ old('data.button_text_color', $section->data['button_text_color'] ?? '#ffffff') }}">
                    <span class="text-xs text-gray-500" id="button-text-color-value">{{ $section->data['button_text_color'] ?? '#ffffff' }}</span>
                </div>
            </div>
        </div>
        
        <!-- Button Preview -->
        <div class="pt-3 border-t border-gray-200">
            <p class="text-xs text-gray-600 mb-2">Preview:</p>
            <button type="button" 
                    id="button-preview-sample"
                    class="px-6 py-3 rounded-lg font-medium transition-all"
                    style="background-color: {{ $section->data['button_bg_color'] ?? '#d4af37' }}; color: {{ $section->data['button_text_color'] ?? '#ffffff' }};">
                {{ $section->button_text ?? 'BUTTON TEXT' }}
            </button>
        </div>
    </div>
</div>

<!-- Settings Section -->
<div class="space-y-6">
    <div class="flex items-center space-x-2 pb-3 border-b border-gray-200">
        <i class="fas fa-cog text-primary"></i>
        <h3 class="text-lg font-semibold text-gray-900">⚙️ Settings</h3>
    </div>
    
    <div class="bg-gray-50 rounded-lg p-4">
        <label class="flex items-center space-x-3 cursor-pointer">
            <input type="checkbox" 
                   name="is_active" 
                   value="1" 
                   {{ old('is_active', $section->is_active) ? 'checked' : '' }}
                   class="w-5 h-5 rounded text-primary focus:ring-primary">
            <div>
                <span class="text-sm font-medium text-gray-900">Section Active</span>
                <p class="text-xs text-gray-500">Make this section visible on the homepage</p>
            </div>
        </label>
    </div>
</div>
