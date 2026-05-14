{{-- Default Section Live Preview --}}
<div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center p-8">
    <div class="text-center max-w-2xl">
        
        {{-- Title --}}
        <h2 class="text-4xl font-bold mb-4" 
            id="preview-title"
            style="color: {{ $section->data['title_color'] ?? '#000000' }}; font-family: 'League Spartan', sans-serif;">
            {{ $section->title ?? 'Section Title' }}
        </h2>
        
        {{-- Subtitle --}}
        @if($section->subtitle)
        <p class="text-xl mb-3" 
           id="preview-subtitle"
           style="color: {{ $section->data['subtitle_color'] ?? '#666666' }}; font-family: 'League Spartan', sans-serif;">
            {{ $section->subtitle }}
        </p>
        @endif
        
        {{-- Description --}}
        @if($section->description)
        <p class="text-base mb-6" 
           id="preview-description"
           style="color: {{ $section->data['description_color'] ?? '#666666' }}; font-family: 'League Spartan', sans-serif;">
            {{ $section->description }}
        </p>
        @endif
        
        {{-- Images Preview --}}
        <div class="flex justify-center space-x-4 mb-6">
            @if($section->background_image)
                <div class="relative">
                    <img src="{{ $section->background_image_url }}" 
                         alt="Background" 
                         class="w-32 h-32 object-cover rounded-lg shadow-md">
                    <span class="absolute -top-2 -right-2 bg-purple-500 text-white text-xs px-2 py-1 rounded-full">BG</span>
                </div>
            @endif
            
            @if($section->image)
                <div class="relative">
                    <img src="{{ $section->image_url }}" 
                         alt="Main" 
                         class="w-32 h-32 object-cover rounded-lg shadow-md">
                    <span class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs px-2 py-1 rounded-full">IMG</span>
                </div>
            @endif
        </div>
        
        {{-- CTA Button --}}
        @if($section->button_text)
        <div>
            <button class="px-8 py-3 rounded-lg font-bold text-sm uppercase tracking-wide transition-all hover:scale-105 shadow-md" 
                    id="preview-button"
                    style="background-color: {{ $section->data['button_bg_color'] ?? '#d4af37' }}; color: {{ $section->data['button_text_color'] ?? '#ffffff' }}; font-family: 'League Spartan', sans-serif;">
                {{ $section->button_text }}
            </button>
        </div>
        @endif
        
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800;900&display=swap');
</style>
