{{-- Gallery Section Live Preview --}}
<div class="w-full h-full bg-gray-50 p-8 overflow-auto">
    <div class="max-w-6xl mx-auto">
        
        {{-- Section Title --}}
        <div class="text-center mb-8">
            <h2 class="text-4xl font-bold mb-3" 
                id="preview-title"
                style="color: {{ $section->data['title_color'] ?? '#000000' }}; font-family: 'League Spartan', sans-serif;">
                {{ $section->title ?? 'Our Gallery' }}
            </h2>
            
            @if($section->description)
            <p class="text-base max-w-2xl mx-auto" 
               id="preview-description"
               style="color: {{ $section->data['description_color'] ?? '#666666' }}; font-family: 'League Spartan', sans-serif;">
                {{ $section->description }}
            </p>
            @endif
        </div>
        
        {{-- Gallery Grid --}}
        <div class="grid grid-cols-4 gap-4 mb-6">
            
            {{-- Left Images --}}
            <div class="col-span-1 space-y-4">
                @if($section->data['left_image_1'] ?? null)
                    <img src="{{ asset('storage/' . $section->data['left_image_1']) }}" 
                         alt="Gallery 1" 
                         class="w-full h-40 object-cover rounded-lg shadow-md hover:shadow-xl transition-shadow cursor-pointer"
                         id="gallery-left-1">
                @else
                    <div class="w-full h-40 bg-gray-200 rounded-lg flex items-center justify-center" id="gallery-left-1">
                        <i class="fas fa-image text-3xl text-gray-400"></i>
                    </div>
                @endif
                
                @if($section->data['left_image_2'] ?? null)
                    <img src="{{ asset('storage/' . $section->data['left_image_2']) }}" 
                         alt="Gallery 2" 
                         class="w-full h-40 object-cover rounded-lg shadow-md hover:shadow-xl transition-shadow cursor-pointer"
                         id="gallery-left-2">
                @else
                    <div class="w-full h-40 bg-gray-200 rounded-lg flex items-center justify-center" id="gallery-left-2">
                        <i class="fas fa-image text-3xl text-gray-400"></i>
                    </div>
                @endif
            </div>
            
            {{-- Center Content --}}
            <div class="col-span-2 flex items-center justify-center">
                <div class="text-center px-8">
                    <div class="mb-4">
                        <i class="fas fa-camera text-5xl" style="color: {{ $section->data['title_color'] ?? '#d4af37' }};"></i>
                    </div>
                    
                    @if($section->button_text)
                    <button class="px-8 py-3 rounded-lg font-bold text-sm uppercase tracking-wide transition-all hover:scale-105 shadow-md" 
                            id="preview-button"
                            style="background-color: {{ $section->data['button_bg_color'] ?? '#d4af37' }}; color: {{ $section->data['button_text_color'] ?? '#ffffff' }}; font-family: 'League Spartan', sans-serif;">
                        {{ $section->button_text }}
                    </button>
                    @endif
                    
                    @if($section->data['enable_lightbox'] ?? true)
                    <p class="text-xs text-gray-500 mt-3">
                        <i class="fas fa-expand-alt mr-1"></i> Lightbox enabled
                    </p>
                    @endif
                </div>
            </div>
            
            {{-- Right Images --}}
            <div class="col-span-1 space-y-4">
                @if($section->data['right_image_1'] ?? null)
                    <img src="{{ asset('storage/' . $section->data['right_image_1']) }}" 
                         alt="Gallery 3" 
                         class="w-full h-40 object-cover rounded-lg shadow-md hover:shadow-xl transition-shadow cursor-pointer"
                         id="gallery-right-1">
                @else
                    <div class="w-full h-40 bg-gray-200 rounded-lg flex items-center justify-center" id="gallery-right-1">
                        <i class="fas fa-image text-3xl text-gray-400"></i>
                    </div>
                @endif
                
                @if($section->data['right_image_2'] ?? null)
                    <img src="{{ asset('storage/' . $section->data['right_image_2']) }}" 
                         alt="Gallery 4" 
                         class="w-full h-40 object-cover rounded-lg shadow-md hover:shadow-xl transition-shadow cursor-pointer"
                         id="gallery-right-2">
                @else
                    <div class="w-full h-40 bg-gray-200 rounded-lg flex items-center justify-center" id="gallery-right-2">
                        <i class="fas fa-image text-3xl text-gray-400"></i>
                    </div>
                @endif
            </div>
            
        </div>
        
        {{-- Layout Badge --}}
        <div class="text-center">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-200 text-gray-700">
                <i class="fas fa-th mr-1"></i> Layout: {{ ucfirst($section->data['layout'] ?? 'grid') }}
            </span>
        </div>
        
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800;900&display=swap');
</style>
