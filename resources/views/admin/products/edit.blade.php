@extends('layouts.admin')

@section('title', 'Modifier Produit')
@section('page-title', '')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<style>
    .split-screen {
        display: grid;
        grid-template-columns: 60% 40%;
        gap: 24px;
        min-height: calc(100vh - 200px);
    }
    
    .preview-panel {
        position: sticky;
        top: 24px;
        height: fit-content;
        max-height: calc(100vh - 100px);
        overflow-y: auto;
    }
    
    .accordion-section {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        margin-bottom: 16px;
        overflow: hidden;
    }
    
    .accordion-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
        background: #f9fafb;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .accordion-header:hover {
        background: #f3f4f6;
    }
    
    .accordion-header.active {
        background: #fef3c7;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }
    
    .accordion-content.open {
        max-height: 2000px;
        padding: 16px;
    }
    
    .image-upload-zone {
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        padding: 32px;
        text-align: center;
        transition: all 0.2s;
        cursor: pointer;
    }
    
    .image-upload-zone:hover {
        border-color: #d4af37;
        background: #fef3c7;
    }
    
    .image-upload-zone.dragover {
        border-color: #d4af37;
        background: #fef3c7;
    }
    
    .gallery-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        cursor: move;
    }
    
    .gallery-item img {
        width: 100%;
        height: 120px;
        object-fit: cover;
    }
    
    .gallery-item-actions {
        position: absolute;
        top: 4px;
        right: 4px;
        display: flex;
        gap: 4px;
    }
    
    .variant-matrix {
        overflow-x: auto;
    }
    
    .variant-matrix table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .variant-matrix th,
    .variant-matrix td {
        padding: 8px;
        border: 1px solid #e5e7eb;
        text-align: left;
    }
    
    .char-counter {
        font-size: 12px;
        color: #6b7280;
    }
    
    .char-counter.warning {
        color: #f59e0b;
    }
    
    .char-counter.error {
        color: #ef4444;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.3s ease-out;
    }
</style>
@endpush

@section('content')
<form id="product-form" action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <!-- Top Bar -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <div>
                    <input type="text" name="name" id="product-name" value="{{ old('name', $product->name) }}" 
                           placeholder="Nom du produit" required
                           class="text-2xl font-bold border-0 focus:ring-0 p-0 w-full"
                           oninput="updatePreview()">
                    <p class="text-sm text-gray-500 mt-1">
                        <span id="unsaved-indicator" class="hidden text-orange-500">
                            <i class="fas fa-circle text-xs"></i> Modifications non sauvegardées
                        </span>
                        <span id="saved-indicator" class="text-green-500">
                            <i class="fas fa-check-circle"></i> Sauvegardé
                        </span>
                    </p>
                </div>
            </div>
            
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times mr-2"></i>Annuler
                </a>
                <button type="submit" id="save-btn" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-colors">
                    <i class="fas fa-check mr-2"></i>Sauvegarder
                </button>
            </div>
        </div>
    </div>

    <!-- Success Message (hidden by default) -->
    <div id="success-message" class="hidden fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in">
        <i class="fas fa-check-circle mr-2"></i>
        <span>Produit mis à jour avec succès!</span>
    </div>

    <!-- Split Screen Layout -->
    <div class="split-screen">
        
        <!-- LEFT PANEL: Form -->
        <div class="space-y-4">
            
            <!-- Basic Information -->
            <div class="accordion-section">
                <div class="accordion-header active" onclick="toggleAccordion(this)">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-info-circle text-primary"></i>
                        <span class="font-semibold">Informations de base</span>
                    </div>
                    <i class="fas fa-chevron-down transition-transform"></i>
                </div>
                <div class="accordion-content open">
                    @include('admin.products.sections.basic-info', ['product' => $product, 'categories' => $categories])
                </div>
            </div>

            <!-- Images & Media -->
            <div class="accordion-section">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-images text-primary"></i>
                        <span class="font-semibold">Images & Médias</span>
                    </div>
                    <i class="fas fa-chevron-down transition-transform"></i>
                </div>
                <div class="accordion-content">
                    @include('admin.products.sections.images', ['product' => $product])
                </div>
            </div>

            <!-- Pricing (Simple) -->
            <div class="accordion-section">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-dollar-sign text-primary"></i>
                        <span class="font-semibold">Prix</span>
                    </div>
                    <i class="fas fa-chevron-down transition-transform"></i>
                </div>
                <div class="accordion-content">
                    @include('admin.products.sections.pricing', ['product' => $product])
                </div>
            </div>

            <!-- Inventory (Simple) -->
            <div class="accordion-section">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-box text-primary"></i>
                        <span class="font-semibold">Stock</span>
                    </div>
                    <i class="fas fa-chevron-down transition-transform"></i>
                </div>
                <div class="accordion-content">
                    @include('admin.products.sections.inventory', ['product' => $product])
                </div>
            </div>

            <!-- Variants -->
            <div class="accordion-section">
                <div class="accordion-header" onclick="toggleAccordion(this)">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-layer-group text-primary"></i>
                        <span class="font-semibold">Variantes du produit</span>
                    </div>
                    <i class="fas fa-chevron-down transition-transform"></i>
                </div>
                <div class="accordion-content">
                    @include('admin.products.sections.variants', ['product' => $product])
                </div>
            </div>

        </div>

        <!-- RIGHT PANEL: Live Preview -->
        <div class="preview-panel">
            @include('admin.products.sections.preview', ['product' => $product])
        </div>

    </div>
</form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<script>
    let hasUnsavedChanges = false;
    let autoSaveTimer;

    // Accordion Toggle
    function toggleAccordion(header) {
        const content = header.nextElementSibling;
        const icon = header.querySelector('.fa-chevron-down');
        
        header.classList.toggle('active');
        content.classList.toggle('open');
        icon.style.transform = content.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0deg)';
    }

    // Track Changes
    document.getElementById('product-form').addEventListener('input', function() {
        hasUnsavedChanges = true;
        document.getElementById('unsaved-indicator').classList.remove('hidden');
        document.getElementById('saved-indicator').classList.add('hidden');
    });

    // Handle Form Submission
    document.getElementById('product-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const saveBtn = document.getElementById('save-btn');
        const originalText = saveBtn.innerHTML;
        
        // Disable button and show loading
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sauvegarde...';
        
        // Submit form
        const formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur de sauvegarde');
            }
            return response.text();
        })
        .then(html => {
            // Success
            hasUnsavedChanges = false;
            document.getElementById('unsaved-indicator').classList.add('hidden');
            document.getElementById('saved-indicator').classList.remove('hidden');
            
            // Show success message
            const successMsg = document.getElementById('success-message');
            successMsg.classList.remove('hidden');
            
            // Hide after 3 seconds
            setTimeout(() => {
                successMsg.classList.add('hidden');
            }, 3000);
            
            // Re-enable button
            saveBtn.disabled = false;
            saveBtn.innerHTML = originalText;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Erreur lors de la sauvegarde. Veuillez réessayer.');
            
            // Re-enable button
            saveBtn.disabled = false;
            saveBtn.innerHTML = originalText;
        });
    });

    // Warn before leaving
    window.addEventListener('beforeunload', function(e) {
        if (hasUnsavedChanges) {
            e.preventDefault();
            e.returnValue = '';
        }
    });

    // Update Preview
    function updatePreview() {
        const name = document.getElementById('product-name').value;
        document.getElementById('preview-name').textContent = name || 'Nom du produit';
        
        const price = document.querySelector('input[name="price"]').value;
        if (price) {
            document.getElementById('preview-price').textContent = parseFloat(price).toFixed(2) + ' DH';
        }
        
        const description = document.querySelector('textarea[name="short_description"]').value;
        document.getElementById('preview-description').textContent = description || 'Description du produit...';
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize date pickers
        flatpickr('.datepicker', {
            dateFormat: 'Y-m-d',
            minDate: 'today'
        });
        
        // Open first accordion by default
        const firstAccordion = document.querySelector('.accordion-header');
        if (firstAccordion && !firstAccordion.classList.contains('active')) {
            toggleAccordion(firstAccordion);
        }
    });
</script>
@endpush
