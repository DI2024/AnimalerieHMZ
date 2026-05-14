@extends('layouts.admin')

@section('title', 'Edit Section')
@section('page-title', '')

@push('styles')
<!-- Pickr Color Picker CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/nano.min.css"/>
<!-- Cropper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.1/dist/cropper.min.css"/>

<style>
    .form-container {
        max-width: 1100px;
        margin: 0.5rem auto 0.5rem;
        background: white;
        padding: 0.5rem 1.5rem;
        min-height: auto;
    }

    
    .color-picker-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .pickr {
        display: inline-block;
    }
    
    /* Custom Pickr button styling */
    .pcr-button {
        width: 44px !important;
        height: 44px !important;
        border-radius: 8px !important;
        border: 2px solid #e5e7eb !important;
        transition: all 0.2s !important;
    }
    
    .pcr-button:hover {
        border-color: #d4af37 !important;
        transform: scale(1.05) !important;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1) !important;
    }
    
    /* Cropper Modal */
    .cropper-modal {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
    }
    
    .cropper-modal.active {
        display: flex;
    }
    
    .cropper-container-wrapper {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        max-width: 90vw;
        max-height: 90vh;
        overflow: auto;
    }
    
    .cropper-image-container {
        max-width: 800px;
        max-height: 600px;
        margin: 0 auto;
    }
    
    /* Responsive Preview Frames */
    .preview-device-frame {
        transition: all 0.3s ease;
        margin: 0 auto;
    }
    
    .preview-device-frame[data-device="desktop"] {
        width: 100%;
    }
    
    .preview-device-frame[data-device="tablet"] {
        width: 768px;
        max-width: 100%;
    }
    
    .preview-device-frame[data-device="mobile"] {
        width: 375px;
        max-width: 100%;
    }
    
    /* Fullscreen Preview */
    .preview-fullscreen {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9998;
        background: rgba(0, 0, 0, 0.95);
        display: none;
        align-items: center;
        justify-content: center;
        padding: 2rem;
    }
    
    .preview-fullscreen.active {
        display: flex;
    }
    
    .preview-fullscreen-content {
        width: 100%;
        height: 100%;
        max-width: 1920px;
        background: white;
        border-radius: 1rem;
        overflow: hidden;
        position: relative;
    }
    
    .preview-fullscreen-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        z-index: 10;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .preview-fullscreen-close:hover {
        background: rgba(0, 0, 0, 0.9);
        transform: scale(1.1);
    }
</style>
@endpush

@section('content')
<div class="fixed top-0 left-64 right-0 bg-white border-b border-gray-200 z-10 px-6 py-4">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.sections.index') }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $section->name }}</h1>
                <div class="flex items-center space-x-3 mt-1">
                    <p class="text-sm text-gray-500">{{ $section->key }}</p>
                    <span class="text-xs text-gray-400">•</span>
                    <p class="text-xs text-gray-500">
                        <i class="far fa-clock mr-1"></i>
                        Last updated {{ $section->updated_at->diffForHumans() }}
                    </p>
                </div>
            </div>
        </div>
        
        <div class="flex items-center space-x-3">
            <button type="button" onclick="document.getElementById('section-form').reset()" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-undo mr-2"></i>Reset
            </button>
            <button type="submit" form="section-form" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-colors shadow-sm">
                <i class="fas fa-save mr-2"></i>Save Changes
            </button>
        </div>
    </div>
</div>

<div class="form-container">
    <form id="section-form" action="{{ route('admin.sections.update', $section) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        {{-- Load Section-Specific Form --}}
        @if($section->key === 'hero')
            @include('admin.sections.forms._hero_form')
        @elseif($section->key === 'about')
            @include('admin.sections.forms._about_form')
        @elseif($section->key === 'gallery')
            @include('admin.sections.forms._gallery_simple_form')
        @elseif($section->key === 'new_arrivals')
            @include('admin.sections.forms._new_arrivals_form')
        @elseif($section->key === 'categories')
            @include('admin.sections.forms._categories_form')
        @elseif($section->key === 'offer_banner' || $section->key === 'offer')
            @include('admin.sections.forms._offer_form')
        @elseif($section->key === 'hot_selling' || $section->key === 'bestsellers')
            @include('admin.sections.forms._bestsellers_form')
        @elseif($section->key === 'testimonials')
            @include('admin.sections.forms._testimonials_simple_form')
        @else
            @include('admin.sections.forms._default_form')
        @endif
        {{-- End Section-Specific Form --}}
        
    </form>
</div>

<!-- Image Cropper Modal -->
<div id="cropper-modal" class="cropper-modal">
    <div class="cropper-container-wrapper">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900">Crop Image</h3>
            <button onclick="closeCropperModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        
        <div class="cropper-image-container mb-4">
            <img id="cropper-image" src="" alt="Crop" style="max-width: 100%;">
        </div>
        
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
                <button onclick="cropperRotateLeft()" class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-undo"></i> Rotate Left
                </button>
                <button onclick="cropperRotateRight()" class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-redo"></i> Rotate Right
                </button>
                <button onclick="cropperFlipH()" class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-arrows-alt-h"></i> Flip H
                </button>
                <button onclick="cropperFlipV()" class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-arrows-alt-v"></i> Flip V
                </button>
            </div>
            
            <div class="flex items-center space-x-2">
                <label class="text-sm text-gray-600">Aspect Ratio:</label>
                <select id="aspect-ratio-select" onchange="changeAspectRatio(this.value)" class="px-3 py-2 border border-gray-300 rounded-lg">
                    <option value="free">Free</option>
                    <option value="16/9">16:9</option>
                    <option value="4/3">4:3</option>
                    <option value="1/1">1:1 (Square)</option>
                    <option value="3/2">3:2</option>
                </select>
            </div>
        </div>
        
        <div class="flex items-center justify-end space-x-3">
            <button onclick="closeCropperModal()" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                Cancel
            </button>
            <button onclick="applyCrop()" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-colors">
                <i class="fas fa-check mr-2"></i>Apply Crop
            </button>
        </div>
    </div>
</div>



@push('scripts')
<!-- Pickr Color Picker JS -->
<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
<!-- Cropper JS -->
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.1/dist/cropper.min.js"></script>

<script>
    // Disable Dropzone auto-discover
    if (typeof Dropzone !== 'undefined') {
        Dropzone.autoDiscover = false;
    }
    
    // Color picker instances
    let colorPickers = {};
    
    // Cropper instance
    let cropper = null;
    let currentCropTarget = null;
    
    // Brand color palette
    const brandColors = [
        '#d4af37', // Primary Gold
        '#000000', // Black
        '#ffffff', // White
        '#666666', // Gray
        '#333333', // Dark Gray
        '#f9fafb', // Light Gray
        '#10B981', // Green
        '#EF4444', // Red
        '#3B82F6', // Blue
    ];
    
    // Initialize color pickers
    function initColorPickers() {
        // Title Color
        colorPickers.title = createColorPicker('title-color-picker', '#title-color-input', (color) => {
            const previewTitle = document.getElementById('preview-title');
            if (previewTitle) previewTitle.style.color = color;
        });
        
        // Subtitle Color (if exists)
        if (document.getElementById('subtitle-color-picker')) {
            colorPickers.subtitle = createColorPicker('subtitle-color-picker', '#subtitle-color-input');
        }
        
        // Description Color
        if (document.getElementById('description-color-picker')) {
            colorPickers.description = createColorPicker('description-color-picker', '#description-color-input', (color) => {
                const previewDesc = document.getElementById('preview-description');
                if (previewDesc) previewDesc.style.color = color;
            });
        }
        
        // Button Background Color
        colorPickers.buttonBg = createColorPicker('button-bg-color-picker', '#button-bg-color-input', (color) => {
            const previewBtn = document.getElementById('preview-button');
            const sampleBtn = document.getElementById('button-preview-sample');
            if (previewBtn) previewBtn.style.backgroundColor = color;
            if (sampleBtn) sampleBtn.style.backgroundColor = color;
            const valueSpan = document.getElementById('button-bg-color-value');
            if (valueSpan) valueSpan.textContent = color;
        });
        
        // Button Text Color
        colorPickers.buttonText = createColorPicker('button-text-color-picker', '#button-text-color-input', (color) => {
            const previewBtn = document.getElementById('preview-button');
            const sampleBtn = document.getElementById('button-preview-sample');
            if (previewBtn) previewBtn.style.color = color;
            if (sampleBtn) sampleBtn.style.color = color;
            const valueSpan = document.getElementById('button-text-color-value');
            if (valueSpan) valueSpan.textContent = color;
        });
        
        // Hero Section: Overlay Color
        if (document.getElementById('overlay-color-picker')) {
            colorPickers.overlay = createColorPicker('overlay-color-picker', '#overlay-color-input');
        }
        
        // About Section: Quote Color
        if (document.getElementById('quote-color-picker')) {
            colorPickers.quote = createColorPicker('quote-color-picker', '#quote-color-input');
        }
    }
    
    // Create color picker instance
    function createColorPicker(containerId, inputId, onChange) {
        const container = document.getElementById(containerId);
        const input = document.querySelector(inputId);
        
        if (!container || !input) return null;
        
        const pickr = Pickr.create({
            el: container,
            theme: 'nano',
            default: input.value || '#000000',
            swatches: brandColors,
            components: {
                preview: true,
                opacity: false,
                hue: true,
                interaction: {
                    hex: true,
                    rgba: false,
                    hsla: false,
                    hsva: false,
                    cmyk: false,
                    input: true,
                    clear: false,
                    save: true
                }
            }
        });
        
        // On color change
        pickr.on('save', (color, instance) => {
            const hexColor = color.toHEXA().toString();
            input.value = hexColor;
            
            if (onChange) {
                onChange(hexColor);
            }
            
            pickr.hide();
        });
        
        // On color change (live)
        pickr.on('change', (color, instance) => {
            const hexColor = color.toHEXA().toString();
            
            if (onChange) {
                onChange(hexColor);
            }
        });
        
        return pickr;
    }
    
    // Live preview update
    function updatePreview() {
        const titleInput = document.getElementById('title-input');
        const descriptionInput = document.getElementById('description-input');
        const buttonTextInput = document.getElementById('button-text-input');
        
        if (titleInput) {
            const title = titleInput.value;
            const previewTitle = document.getElementById('preview-title');
            if (previewTitle) previewTitle.textContent = title || 'Section Title';
            const titleCount = document.getElementById('title-count');
            if (titleCount) titleCount.textContent = title.length;
        }
        
        if (descriptionInput) {
            const description = descriptionInput.value;
            const previewDesc = document.getElementById('preview-description');
            if (previewDesc) previewDesc.textContent = description || 'Section description will appear here...';
            const descCount = document.getElementById('desc-count');
            if (descCount) descCount.textContent = description.length;
        }
        
        if (buttonTextInput) {
            const buttonText = buttonTextInput.value;
            const previewButton = document.getElementById('preview-button');
            const sampleButton = document.getElementById('button-preview-sample');
            if (previewButton) previewButton.textContent = buttonText || 'BUTTON TEXT';
            if (sampleButton) sampleButton.textContent = buttonText || 'BUTTON TEXT';
            const buttonCount = document.getElementById('button-text-count');
            if (buttonCount) buttonCount.textContent = buttonText.length;
        }
        
        // Update subtitle count if exists
        const subtitleInput = document.getElementById('subtitle-input');
        if (subtitleInput) {
            const subtitleCount = document.getElementById('subtitle-count');
            if (subtitleCount) subtitleCount.textContent = subtitleInput.value.length;
        }
    }
    
    // Image preview
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="mx-auto h-32 w-auto object-cover rounded-lg">`;
            }
            reader.readAsDataURL(file);
        }
    }
    
    // Open Cropper Modal
    function openCropperModal(file, targetId) {
        const modal = document.getElementById('cropper-modal');
        const image = document.getElementById('cropper-image');
        
        currentCropTarget = targetId;
        
        const reader = new FileReader();
        reader.onload = function(e) {
            image.src = e.target.result;
            modal.classList.add('active');
            
            // Initialize cropper
            if (cropper) {
                cropper.destroy();
            }
            
            cropper = new Cropper(image, {
                aspectRatio: NaN, // Free aspect ratio
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 1,
                restore: false,
                guides: true,
                center: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false,
            });
        };
        reader.readAsDataURL(file);
    }
    
    // Close Cropper Modal
    function closeCropperModal() {
        const modal = document.getElementById('cropper-modal');
        modal.classList.remove('active');
        
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        
        currentCropTarget = null;
    }
    
    // Cropper Controls
    function cropperRotateLeft() {
        if (cropper) cropper.rotate(-90);
    }
    
    function cropperRotateRight() {
        if (cropper) cropper.rotate(90);
    }
    
    function cropperFlipH() {
        if (cropper) {
            const data = cropper.getData();
            cropper.scaleX(data.scaleX === 1 ? -1 : 1);
        }
    }
    
    function cropperFlipV() {
        if (cropper) {
            const data = cropper.getData();
            cropper.scaleY(data.scaleY === 1 ? -1 : 1);
        }
    }
    
    function changeAspectRatio(ratio) {
        if (!cropper) return;
        
        if (ratio === 'free') {
            cropper.setAspectRatio(NaN);
        } else {
            cropper.setAspectRatio(eval(ratio));
        }
    }
    
    // Apply Crop
    function applyCrop() {
        if (!cropper || !currentCropTarget) return;
        
        cropper.getCroppedCanvas({
            maxWidth: 2048,
            maxHeight: 2048,
            fillColor: '#fff',
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        }).toBlob(function(blob) {
            // Create preview
            const preview = document.getElementById(currentCropTarget);
            const url = URL.createObjectURL(blob);
            preview.innerHTML = `<img src="${url}" class="mx-auto h-32 w-auto object-cover rounded-lg">`;
            
            // Store blob for upload (you'll need to handle this in form submission)
            const file = new File([blob], 'cropped-image.jpg', { type: 'image/jpeg' });
            
            // Update file input (create a DataTransfer object)
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            
            // Find the corresponding input and update it
            const inputId = currentCropTarget.replace('-preview', '-input');
            const input = document.getElementById(inputId);
            if (input) {
                input.files = dataTransfer.files;
            }
            
            closeCropperModal();
        }, 'image/jpeg', 0.9);
    }
    
    // Enhanced image preview with crop option
    function previewImageWithCrop(input, previewId) {
        const file = input.files[0];
        
        if (file) {
            // Show crop modal
            openCropperModal(file, previewId);
        }
    }
    
    // Change Preview Device
    function changePreviewDevice(device) {
        const frame = document.getElementById('preview-frame');
        const buttons = {
            desktop: document.getElementById('preview-desktop'),
            tablet: document.getElementById('preview-tablet'),
            mobile: document.getElementById('preview-mobile')
        };
        
        // Update frame
        frame.setAttribute('data-device', device);
        
        // Update button states
        Object.keys(buttons).forEach(key => {
            if (key === device) {
                buttons[key].classList.remove('text-gray-400');
                buttons[key].classList.add('text-primary');
            } else {
                buttons[key].classList.remove('text-primary');
                buttons[key].classList.add('text-gray-400');
            }
        });
    }
    
    // Toggle Fullscreen Preview
    function toggleFullscreenPreview() {
        const fullscreenModal = document.getElementById('fullscreen-preview');
        const fullscreenContent = document.getElementById('fullscreen-preview-content');
        const previewContainer = document.getElementById('preview-container');
        
        if (fullscreenModal.classList.contains('active')) {
            // Close fullscreen
            fullscreenModal.classList.remove('active');
        } else {
            // Open fullscreen
            fullscreenContent.innerHTML = previewContainer.innerHTML;
            fullscreenModal.classList.add('active');
        }
    }
    
    // Update preview for Hero section specific elements
    function updateHeroPreview() {
        // Update overlay opacity
        const overlayOpacity = document.getElementById('overlay-opacity-input');
        const heroOverlay = document.getElementById('hero-overlay');
        if (overlayOpacity && heroOverlay) {
            heroOverlay.style.opacity = overlayOpacity.value / 100;
        }
        
        // Update text alignment
        const textAlignInputs = document.querySelectorAll('input[name="data[text_align]"]');
        const heroContentAlign = document.getElementById('hero-content-align');
        if (textAlignInputs.length && heroContentAlign) {
            textAlignInputs.forEach(input => {
                if (input.checked) {
                    heroContentAlign.className = heroContentAlign.className.replace(/text-(left|center|right)/, `text-${input.value}`);
                }
            });
        }
    }
    
    // Update preview for About section specific elements
    function updateAboutPreview() {
        // Update brand quote
        const quoteInput = document.getElementById('brand-quote-input');
        const quotePreview = document.getElementById('about-quote');
        if (quoteInput && quotePreview) {
            quotePreview.textContent = `"${quoteInput.value}"`;
        }
    }
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        initColorPickers();
        updatePreview();
        
        // Apply initial colors to preview (if elements exist)
        const titleColorInput = document.getElementById('title-color-input');
        const descColorInput = document.getElementById('description-color-input');
        const btnBgColorInput = document.getElementById('button-bg-color-input');
        const btnTextColorInput = document.getElementById('button-text-color-input');
        
        const previewTitle = document.getElementById('preview-title');
        const previewDesc = document.getElementById('preview-description');
        const previewButton = document.getElementById('preview-button');
        
        if (titleColorInput && previewTitle) {
            previewTitle.style.color = titleColorInput.value;
        }
        if (descColorInput && previewDesc) {
            previewDesc.style.color = descColorInput.value;
        }
        if (btnBgColorInput && previewButton) {
            previewButton.style.backgroundColor = btnBgColorInput.value;
        }
        if (btnTextColorInput && previewButton) {
            previewButton.style.color = btnTextColorInput.value;
        }
        
        // Initialize section-specific previews
        updateHeroPreview();
        updateAboutPreview();
        
        // Close fullscreen on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const fullscreenModal = document.getElementById('fullscreen-preview');
                if (fullscreenModal.classList.contains('active')) {
                    toggleFullscreenPreview();
                }
            }
        });
    });
</script>
@endpush
@endsection
