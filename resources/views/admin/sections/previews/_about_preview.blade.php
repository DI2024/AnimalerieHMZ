{{-- About Section Live Preview --}}
<div class="w-full h-full bg-white p-8 overflow-auto">
    <div class="max-w-6xl mx-auto">
        
        {{-- Section Title --}}
        <div class="text-center mb-8">
            <h2 class="text-4xl font-bold mb-3" 
                id="preview-title"
                style="color: {{ $section->data['title_color'] ?? '#000000' }}; font-family: 'League Spartan', sans-serif;">
                {{ $section->title ?? 'About Our Brand' }}
            </h2>
        </div>
        
        {{-- Content Grid --}}
        <div class="grid grid-cols-3 gap-6 items-center mb-8">
            
            {{-- Left Image --}}
            <div class="col-span-1">
                @if($section->data['left_image'] ?? null)
                    <img src="{{ asset('storage/' . $section->data['left_image']) }}" 
                         alt="Left" 
                         class="w-full h-64 object-cover rounded-lg shadow-lg"
                         id="about-left-image">
                @else
                    <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center" id="about-left-image">
                        <i class="fas fa-image text-4xl text-gray-400"></i>
                    </div>
                @endif
            </div>
            
            {{-- Center Content --}}
            <div class="col-span-1 text-center px-4">
                {{-- Logo --}}
                @if($section->image)
                    <img src="{{ $section->image_url }}" 
                         alt="Logo" 
                         class="w-32 h-32 object-contain mx-auto mb-4"
                         id="about-logo">
                @else
                    <div class="w-32 h-32 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-4" id="about-logo">
                        <i class="fas fa-copyright text-3xl text-gray-400"></i>
                    </div>
                @endif
                
                {{-- Brand Quote --}}
                @if($section->data['brand_quote'] ?? null)
                    <p class="text-lg italic font-medium" 
                       id="about-quote"
                       style="color: {{ $section->data['quote_color'] ?? '#d4af37' }}; font-family: 'League Spartan', sans-serif;">
                        "{{ $section->data['brand_quote'] }}"
                    </p>
                @endif
            </div>
            
            {{-- Right Image --}}
            <div class="col-span-1">
                @if($section->data['right_image'] ?? null)
                    <img src="{{ asset('storage/' . $section->data['right_image']) }}" 
                         alt="Right" 
                         class="w-full h-64 object-cover rounded-lg shadow-lg"
                         id="about-right-image">
                @else
                    <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center" id="about-right-image">
                        <i class="fas fa-image text-4xl text-gray-400"></i>
                    </div>
                @endif
            </div>
            
        </div>
        
        {{-- Description Text --}}
        <div class="max-w-3xl mx-auto text-center mb-6">
            <p class="text-base leading-relaxed" 
               id="preview-description"
               style="color: {{ $section->data['description_color'] ?? '#666666' }}; font-family: 'League Spartan', sans-serif;">
                {{ $section->description ?? 'Tell your brand story here...' }}
            </p>
        </div>
        
        {{-- CTA Button --}}
        @if($section->button_text)
        <div class="text-center">
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
