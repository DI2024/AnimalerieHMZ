{{-- Hero Section Live Preview --}}
@php
    $heroImage = $section->data['background_image'] ?? $section->data['image'] ?? $section->background_image ?? $section->image ?? null;
    $heroImageUrl = $heroImage ? asset('storage/' . $heroImage) : 'https://via.placeholder.com/1920x1080/e5e7eb/6b7280?text=Hero+Background';
@endphp
<div class="relative w-full h-full bg-cover bg-center" 
     style="background-image: url('{{ $heroImageUrl }}');"
     id="hero-preview-bg">
    
    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black" 
         id="hero-overlay"
         style="opacity: {{ ($section->data['overlay_opacity'] ?? 30) / 100 }}; background-color: {{ $section->data['overlay_color'] ?? '#000000' }};"></div>
    
    {{-- Content --}}
    <div class="relative h-full flex items-center justify-center p-8">
        <div class="max-w-4xl w-full text-{{ $section->data['text_align'] ?? 'center' }}" id="hero-content-align">
            
            {{-- Title --}}
            <h1 class="text-5xl md:text-6xl font-bold mb-4 leading-tight" 
                id="preview-title"
                style="color: {{ $section->data['title_color'] ?? '#ffffff' }}; font-family: 'League Spartan', sans-serif;">
                {{ $section->title ?? 'Welcome to Our Store' }}
            </h1>
            
            {{-- Subtitle --}}
            @if($section->subtitle)
            <p class="text-xl md:text-2xl mb-3" 
               id="preview-subtitle"
               style="color: {{ $section->data['subtitle_color'] ?? '#e5e7eb' }}; font-family: 'League Spartan', sans-serif;">
                {{ $section->subtitle }}
            </p>
            @endif
            
            {{-- Description --}}
            @if($section->description)
            <p class="text-base md:text-lg mb-8 max-w-2xl {{ ($section->data['text_align'] ?? 'center') === 'center' ? 'mx-auto' : '' }}" 
               id="preview-description"
               style="color: {{ $section->data['description_color'] ?? '#d1d5db' }}; font-family: 'League Spartan', sans-serif;">
                {{ $section->description }}
            </p>
            @endif
            
            {{-- CTA Button --}}
            @if($section->button_text)
            <div class="mt-6">
                <button class="px-8 py-4 rounded-lg font-bold text-base uppercase tracking-wide transition-all hover:scale-105 shadow-lg" 
                        id="preview-button"
                        style="background-color: {{ $section->data['button_bg_color'] ?? '#d4af37' }}; color: {{ $section->data['button_text_color'] ?? '#ffffff' }}; font-family: 'League Spartan', sans-serif;">
                    {{ $section->button_text }}
                </button>
            </div>
            @endif
            
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800;900&display=swap');
</style>
