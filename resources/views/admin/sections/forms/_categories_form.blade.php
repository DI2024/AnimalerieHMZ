{{-- Categories Section Form --}}

<div class="bg-gradient-to-br from-purple-50 to-pink-50 border border-purple-200 rounded-xl p-6 mb-6">
    <div class="flex items-start">
        <div class="flex-shrink-0">
            <i class="fas fa-info-circle text-purple-600 text-2xl"></i>
        </div>
        <div class="ml-4">
            <h3 class="text-lg font-semibold text-purple-900 mb-2">📦 Categories Section</h3>
            <p class="text-sm text-purple-800 mb-2">
                Cette section affiche automatiquement les catégories marquées comme "Importantes" (max 5).
            </p>
            <p class="text-sm text-purple-700">
                <i class="fas fa-lightbulb mr-1"></i>
                Pour ajouter une catégorie ici, allez dans <strong>Catégories → Éditer → Cocher "Catégorie Importante"</strong>
            </p>
        </div>
    </div>
</div>

{{-- Button Configuration --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
        <i class="fas fa-mouse-pointer text-primary mr-2"></i>
        Button Configuration
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        {{-- Button Text --}}
        <div>
            <label for="button-text-input" class="block text-sm font-medium text-gray-700 mb-2">
                Button Text <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   id="button-text-input"
                   name="button_text" 
                   value="{{ old('button_text', $section->button_text ?? 'SEE ALL') }}"
                   maxlength="30"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                   placeholder="SEE ALL"
                   oninput="updatePreview()">
            <p class="text-xs text-gray-500 mt-1">
                <span id="button-text-count">{{ strlen($section->button_text ?? 'SEE ALL') }}</span>/30 characters
            </p>
        </div>
        
        {{-- Button Link --}}
        <div>
            <label for="button-link-input" class="block text-sm font-medium text-gray-700 mb-2">
                Button Link
            </label>
            <input type="text" 
                   id="button-link-input"
                   name="button_link" 
                   value="{{ old('button_link', $section->button_link ?? '#categories') }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 cursor-not-allowed"
                   placeholder="#categories"
                   readonly>
            <p class="text-xs text-gray-500 mt-1">URL or anchor link</p>
        </div>
        
    </div>
</div>

{{-- Button Colors --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
        <i class="fas fa-palette text-primary mr-2"></i>
        Button Colors
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        {{-- Button Background Color --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">
                Background Color <span class="text-red-500">*</span>
            </label>
            <div class="flex items-center space-x-3">
                <div id="button-bg-color-picker"></div>
                <input type="hidden" 
                       id="button-bg-color-input"
                       name="data[button_bg_color]" 
                       value="{{ old('data.button_bg_color', $section->data['button_bg_color'] ?? '#9a7b2f') }}">
                <div class="flex-1">
                    <div id="button-preview-sample" 
                         class="px-6 py-3 rounded-lg text-center font-semibold text-sm transition-all"
                         style="background-color: {{ $section->data['button_bg_color'] ?? '#9a7b2f' }}; color: {{ $section->data['button_text_color'] ?? '#ffffff' }};">
                        BUTTON PREVIEW
                    </div>
                </div>
                <span id="button-bg-color-value" class="text-xs text-gray-600 font-mono">
                    {{ $section->data['button_bg_color'] ?? '#9a7b2f' }}
                </span>
            </div>
        </div>
        
        {{-- Button Text Color --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">
                Text Color <span class="text-red-500">*</span>
            </label>
            <div class="flex items-center space-x-3">
                <div id="button-text-color-picker"></div>
                <input type="hidden" 
                       id="button-text-color-input"
                       name="data[button_text_color]" 
                       value="{{ old('data.button_text_color', $section->data['button_text_color'] ?? '#ffffff') }}">
                <span id="button-text-color-value" class="text-xs text-gray-600 font-mono">
                    {{ $section->data['button_text_color'] ?? '#ffffff' }}
                </span>
            </div>
        </div>
        
    </div>
</div>

{{-- Categories Preview --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
        <i class="fas fa-th-large text-primary mr-2"></i>
        Important Categories (Max 5)
    </h3>
    
    @php
        $importantCategories = \App\Models\Category::where('is_important', true)
                                                   ->where('is_active', true)
                                                   ->withCount('products')
                                                   ->orderBy('order')
                                                   ->limit(5)
                                                   ->get();
    @endphp
    
    @if($importantCategories->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach($importantCategories as $category)
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow text-center">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" 
                             alt="{{ $category->name }}"
                             class="w-24 h-24 object-cover rounded-full mx-auto mb-3 border-2 border-primary">
                    @else
                        <div class="w-24 h-24 bg-gray-100 rounded-full mx-auto mb-3 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-2xl"></i>
                        </div>
                    @endif
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $category->name }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $category->products_count }} Products</p>
                    <span class="inline-block mt-2 px-2 py-0.5 bg-purple-100 text-purple-800 text-xs rounded-full">
                        <i class="fas fa-star mr-1"></i>Important
                    </span>
                </div>
            @endforeach
        </div>
        
        <div class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-sm text-green-800">
                <i class="fas fa-check-circle mr-2"></i>
                <strong>{{ $importantCategories->count() }}</strong> important categories will be displayed.
            </p>
        </div>
        
        @if($importantCategories->count() >= 5)
            <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-sm text-yellow-800">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Maximum limit reached (5 categories). Uncheck "Important" on other categories to add new ones.
                </p>
            </div>
        @endif
    @else
        <div class="p-8 text-center bg-yellow-50 border border-yellow-200 rounded-lg">
            <i class="fas fa-exclamation-triangle text-yellow-600 text-3xl mb-3"></i>
            <p class="text-sm text-yellow-800 mb-2">
                <strong>No important categories found!</strong>
            </p>
            <p class="text-xs text-yellow-700 mb-4">
                Go to Categories → Edit → Check "Important Category" to add categories to this section (max 5).
            </p>
            <a href="{{ route('admin.categories.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors text-sm">
                <i class="fas fa-cog mr-2"></i>
                Manage Categories
            </a>
        </div>
    @endif
    
    {{-- Image Resolution Info --}}
    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <p class="text-sm text-blue-800 font-semibold mb-2">
            <i class="fas fa-info-circle mr-2"></i>Image Requirements:
        </p>
        <ul class="text-xs text-blue-700 space-y-1 ml-6 list-disc">
            <li>Resolution: <strong>320x320px</strong> (required)</li>
            <li>Format: JPG, PNG, WEBP</li>
            <li>Max size: 2MB</li>
            <li>Shape: Square (will be displayed as circle)</li>
        </ul>
    </div>
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
