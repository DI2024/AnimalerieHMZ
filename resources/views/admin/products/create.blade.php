@extends('layouts.admin')

@section('title', 'Nouveau Produit')
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
</style>
@endpush

@section('content')
<form id="product-form" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <!-- Top Bar -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <div>
                    <input type="text" name="name" id="product-name" value="{{ old('name') }}" 
                           placeholder="Nom du produit" required
                           class="text-2xl font-bold border-0 focus:ring-0 p-0 w-full"
                           oninput="updatePreview()">
                    <p class="text-sm text-gray-500 mt-1">Nouveau produit</p>
                </div>
            </div>
            
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.products.index') }}" 
                   class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                    <i class="fas fa-times mr-2"></i>Annuler
                </a>
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-yellow-600">
                    <i class="fas fa-check mr-2"></i>Créer le produit
                </button>
            </div>
        </div>
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
                    <div class="space-y-4">
                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Catégorie <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id" required
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                                <option value="">Sélectionner une catégorie</option>
                                <option value="1">Chiens</option>
                                <option value="2">Chats</option>
                                <option value="3">Oiseaux</option>
                            </select>
                        </div>

                        <!-- Short Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Description courte
                            </label>
                            <textarea name="short_description" rows="2" maxlength="500"
                                      placeholder="Résumé du produit en une phrase..."
                                      oninput="updatePreview()"
                                      class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ old('short_description') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Maximum 500 caractères</p>
                        </div>

                        <!-- Full Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Description complète <span class="text-red-500">*</span>
                            </label>
                            <textarea name="description" rows="6" required
                                      placeholder="Description détaillée du produit..."
                                      class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ old('description') }}</textarea>
                        </div>

                        <!-- Badges & Flags -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Badge</label>
                                <input type="text" name="badge" value="{{ old('badge') }}" 
                                       placeholder="Ex: NOUVEAU, PROMO..."
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Couleur badge</label>
                                <select name="badge_color" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                                    <option value="">Par défaut</option>
                                    <option value="red">Rouge</option>
                                    <option value="green">Vert</option>
                                    <option value="blue">Bleu</option>
                                    <option value="orange">Orange</option>
                                </select>
                            </div>
                        </div>

                        <!-- Product Flags -->
                        <div class="grid grid-cols-2 gap-3">
                            <label class="flex items-center space-x-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                       class="rounded text-primary focus:ring-primary">
                                <span class="text-sm">En vedette</span>
                            </label>
                            
                            <label class="flex items-center space-x-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="checkbox" name="is_bestseller" value="1" {{ old('is_bestseller') ? 'checked' : '' }}
                                       class="rounded text-primary focus:ring-primary">
                                <span class="text-sm">Bestseller</span>
                            </label>
                            
                            <label class="flex items-center space-x-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="checkbox" name="is_new" value="1" {{ old('is_new') ? 'checked' : '' }}
                                       class="rounded text-primary focus:ring-primary">
                                <span class="text-sm">Nouveau</span>
                            </label>
                            
                            <label class="flex items-center space-x-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                       class="rounded text-primary focus:ring-primary">
                                <span class="text-sm">Actif</span>
                            </label>
                        </div>
                    </div>
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
                    <div class="images-media-grid-create">
                        <!-- Left Column: Main Image (40%) -->
                        <div class="main-image-panel-create">
                            <label class="block text-sm font-semibold text-gray-900 mb-3">
                                Image principale <span class="text-red-500">*</span>
                            </label>
                            
                            <div class="main-image-upload-zone" id="main-upload-zone">
                                <i class="fas fa-cloud-upload-alt text-5xl text-gray-300 mb-3"></i>
                                <p class="text-sm font-medium text-gray-700 mb-1">Cliquez ou glissez-déposez</p>
                                <p class="text-xs text-gray-500">PNG, JPG, WEBP - Max 2MB</p>
                            </div>
                            
                            <input type="file" name="image" id="main-image-create" accept="image/*" required class="hidden">
                            
                            <div id="main-preview-create" class="hidden mt-3">
                                <img src="" alt="Preview" class="w-full aspect-square object-cover rounded-lg border-2 border-primary">
                            </div>
                        </div>

                        <!-- Right Column: Gallery (60%) -->
                        <div class="gallery-panel-create">
                            <div class="flex items-center justify-between mb-3">
                                <label class="block text-sm font-semibold text-gray-900">
                                    Galerie d'images
                                </label>
                                <span class="gallery-counter">
                                    <i class="fas fa-images mr-1"></i>
                                    <span id="gallery-count-create">0</span>/10
                                </span>
                            </div>
                            
                            <div class="gallery-upload-zone" id="gallery-upload-zone">
                                <i class="fas fa-images text-4xl text-gray-300 mb-2"></i>
                                <p class="text-sm font-medium text-gray-700 mb-1">Ajouter plusieurs images</p>
                                <p class="text-xs text-gray-500">Cliquez ou glissez-déposez jusqu'à 10 images</p>
                            </div>
                            
                            <input type="file" name="images[]" id="gallery-images-create" accept="image/*" multiple class="hidden">
                            
                            <div id="gallery-preview-create" class="hidden grid grid-cols-4 gap-3 mt-3">
                                <!-- Gallery previews will be added here -->
                            </div>
                            
                            <p class="help-text mt-3">
                                <i class="fas fa-lightbulb mr-1"></i>
                                Les images seront ajoutées à la galerie du produit
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <style>
            .images-media-grid-create {
                display: grid;
                grid-template-columns: 40% 60%;
                gap: 24px;
            }
            
            .main-image-panel-create {
                border: 2px solid #d4af37;
                border-radius: 12px;
                padding: 20px;
                background: linear-gradient(to bottom, #fef3c7 0%, #ffffff 100%);
            }
            
            .main-image-upload-zone {
                border: 2px dashed #d1d5db;
                border-radius: 8px;
                padding: 40px 20px;
                text-align: center;
                cursor: pointer;
                transition: all 0.2s;
                background: white;
            }
            
            .main-image-upload-zone:hover {
                border-color: #d4af37;
                background: #fef3c7;
            }
            
            .gallery-panel-create {
                border: 1px solid #e5e7eb;
                border-radius: 12px;
                padding: 20px;
                background: white;
            }
            
            .gallery-upload-zone {
                border: 2px dashed #d1d5db;
                border-radius: 8px;
                padding: 30px 20px;
                text-align: center;
                cursor: pointer;
                transition: all 0.2s;
                background: #f9fafb;
            }
            
            .gallery-upload-zone:hover {
                border-color: #d4af37;
                background: #fef3c7;
            }
            
            @media (max-width: 768px) {
                .images-media-grid-create {
                    grid-template-columns: 1fr;
                    gap: 20px;
                }
            }
            </style>
            
            <script>
            // Main Image Upload for Create Form
            document.getElementById('main-upload-zone').addEventListener('click', function() {
                document.getElementById('main-image-create').click();
            });
            
            document.getElementById('main-image-create').addEventListener('change', function(e) {
                if (e.target.files.length > 0) {
                    const file = e.target.files[0];
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('main-preview-create');
                        preview.querySelector('img').src = e.target.result;
                        preview.classList.remove('hidden');
                        document.getElementById('main-upload-zone').style.display = 'none';
                    };
                    reader.readAsDataURL(file);
                }
            });
            
            // Gallery Images Upload for Create Form
            document.getElementById('gallery-upload-zone').addEventListener('click', function() {
                document.getElementById('gallery-images-create').click();
            });
            
            document.getElementById('gallery-images-create').addEventListener('change', function(e) {
                const preview = document.getElementById('gallery-preview-create');
                const files = Array.from(e.target.files).slice(0, 10);
                
                preview.innerHTML = '';
                preview.classList.remove('hidden');
                document.getElementById('gallery-upload-zone').style.display = 'none';
                
                files.forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative aspect-square rounded-lg overflow-hidden border-2 border-gray-200';
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">
                        `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
                
                document.getElementById('gallery-count-create').textContent = files.length;
            });
            
            // Drag & Drop for Main Image
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                document.getElementById('main-upload-zone').addEventListener(eventName, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }, false);
            });
            
            ['dragenter', 'dragover'].forEach(eventName => {
                document.getElementById('main-upload-zone').addEventListener(eventName, function() {
                    this.style.borderColor = '#d4af37';
                    this.style.background = '#fef3c7';
                });
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                document.getElementById('main-upload-zone').addEventListener(eventName, function() {
                    this.style.borderColor = '#d1d5db';
                    this.style.background = 'white';
                });
            });
            
            document.getElementById('main-upload-zone').addEventListener('drop', function(e) {
                const files = e.dataTransfer.files;
                document.getElementById('main-image-create').files = files;
                document.getElementById('main-image-create').dispatchEvent(new Event('change'));
            });
            
            // Drag & Drop for Gallery
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                document.getElementById('gallery-upload-zone').addEventListener(eventName, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }, false);
            });
            
            ['dragenter', 'dragover'].forEach(eventName => {
                document.getElementById('gallery-upload-zone').addEventListener(eventName, function() {
                    this.style.borderColor = '#d4af37';
                    this.style.background = '#fef3c7';
                });
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                document.getElementById('gallery-upload-zone').addEventListener(eventName, function() {
                    this.style.borderColor = '#d1d5db';
                    this.style.background = '#f9fafb';
                });
            });
            
            document.getElementById('gallery-upload-zone').addEventListener('drop', function(e) {
                const files = e.dataTransfer.files;
                document.getElementById('gallery-images-create').files = files;
                document.getElementById('gallery-images-create').dispatchEvent(new Event('change'));
            });
            </script>

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
                    <div class="space-y-4">
                        <!-- Regular Price -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Prix (DH) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.01" name="price" id="regular-price" 
                                   value="{{ old('price') }}" required
                                   oninput="updatePreview(); calculateDiscount()"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                            <p class="text-xs text-gray-500 mt-1">Prix de vente du produit</p>
                        </div>

                        <!-- Old Price -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ancien prix (DH)
                                <span class="text-xs text-gray-500">(Optionnel - pour afficher une réduction)</span>
                            </label>
                            <input type="number" step="0.01" name="price_old" id="old-price"
                                   value="{{ old('price_old') }}"
                                   oninput="calculateDiscount()"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                            <p class="text-xs text-gray-500 mt-1">Si renseigné, affichera une réduction sur le produit</p>
                        </div>

                        <!-- Discount Preview -->
                        <div id="discount-preview" class="p-4 bg-green-50 rounded-lg border border-green-200 hidden">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Réduction affichée:</span>
                                <span id="discount-percentage" class="text-xl font-bold text-green-600">0%</span>
                            </div>
                        </div>
                    </div>
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
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Quantité en stock <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="stock" id="stock-quantity" 
                                       value="{{ old('stock', 0) }}" required min="0"
                                       oninput="updateStockStatus()"
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                                <p class="text-xs text-gray-500 mt-1">Nombre d'unités disponibles</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Seuil d'alerte <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="stock_alert" id="stock-alert" 
                                       value="{{ old('stock_alert', 5) }}" required min="0"
                                       oninput="updateStockStatus()"
                                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                                <p class="text-xs text-gray-500 mt-1">Alerte si stock ≤ ce seuil</p>
                            </div>
                        </div>

                        <!-- Stock Status Indicator -->
                        <div id="stock-status" class="p-4 rounded-lg"></div>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT PANEL: Live Preview -->
        <div class="preview-panel">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-eye text-primary mr-2"></i>
                    Aperçu du produit
                </h3>
                
                <div class="border rounded-lg p-4">
                    <div class="aspect-square bg-gray-100 rounded-lg mb-4 flex items-center justify-center">
                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                    </div>
                    
                    <h4 id="preview-name" class="text-xl font-bold mb-2">Nom du produit</h4>
                    
                    <div class="flex items-center space-x-2 mb-3">
                        <span id="preview-price" class="text-2xl font-bold text-primary">0.00 DH</span>
                    </div>
                    
                    <p id="preview-description" class="text-sm text-gray-600">Description du produit...</p>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection

@push('scripts')
<script>
    // Accordion Toggle
    function toggleAccordion(header) {
        const content = header.nextElementSibling;
        const icon = header.querySelector('.fa-chevron-down');
        
        header.classList.toggle('active');
        content.classList.toggle('open');
        icon.style.transform = content.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0deg)';
    }

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

    // Calculate Discount
    function calculateDiscount() {
        const regularPrice = parseFloat(document.getElementById('regular-price').value) || 0;
        const oldPrice = parseFloat(document.getElementById('old-price').value) || 0;
        const preview = document.getElementById('discount-preview');
        
        if (oldPrice > 0 && regularPrice > 0 && oldPrice > regularPrice) {
            const discount = ((oldPrice - regularPrice) / oldPrice * 100).toFixed(0);
            document.getElementById('discount-percentage').textContent = '-' + discount + '%';
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
        }
    }

    // Update Stock Status
    function updateStockStatus() {
        const stock = parseInt(document.getElementById('stock-quantity').value) || 0;
        const alert = parseInt(document.getElementById('stock-alert').value) || 0;
        const statusDiv = document.getElementById('stock-status');
        
        if (stock === 0) {
            statusDiv.className = 'p-4 rounded-lg bg-red-50 border border-red-200';
            statusDiv.innerHTML = `
                <div class="flex items-center space-x-2">
                    <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    <div>
                        <span class="text-sm font-medium text-red-800">Rupture de stock</span>
                        <p class="text-xs text-red-600 mt-1">Le produit n'est pas disponible à la vente</p>
                    </div>
                </div>
            `;
        } else if (stock <= alert) {
            statusDiv.className = 'p-4 rounded-lg bg-orange-50 border border-orange-200';
            statusDiv.innerHTML = `
                <div class="flex items-center space-x-2">
                    <i class="fas fa-exclamation-triangle text-orange-600 text-xl"></i>
                    <div>
                        <span class="text-sm font-medium text-orange-800">Stock faible</span>
                        <p class="text-xs text-orange-600 mt-1">Réapprovisionnement recommandé (${stock} unités restantes)</p>
                    </div>
                </div>
            `;
        } else {
            statusDiv.className = 'p-4 rounded-lg bg-green-50 border border-green-200';
            statusDiv.innerHTML = `
                <div class="flex items-center space-x-2">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    <div>
                        <span class="text-sm font-medium text-green-800">Stock suffisant</span>
                        <p class="text-xs text-green-600 mt-1">${stock} unités disponibles</p>
                    </div>
                </div>
            `;
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateStockStatus();
    });
</script>
@endpush
