@extends('layouts.admin')

@section('title', 'Modifier Produit')
@section('page-title', 'Modifier Produit')

@section('content')

@if(session('success'))
    <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg mb-6 flex items-center justify-between">
        <div>
            <i class="fas fa-check-circle mr-2"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.parentElement.remove()" class="text-white hover:text-gray-200">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if($errors->any())
    <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg mb-6">
        <div class="flex items-center mb-2">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span class="font-semibold">Erreurs de validation:</span>
        </div>
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <!-- Top Bar -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.products.index') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <h2 class="text-2xl font-bold">Modifier: {{ $product->name }}</h2>
            </div>
            
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times mr-2"></i>Annuler
                </a>
                <button type="submit" class="px-6 py-2 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] transition-colors">
                    <i class="fas fa-check mr-2"></i>Sauvegarder
                </button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-info-circle text-[#003e87] mr-2"></i>
                    Informations de base
                </h3>
                
                <div class="space-y-4">
                    <!-- Product Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nom du produit <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-[#003e87]"
                               placeholder="Ex: Croquettes Premium pour Chiens">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category & Subcategory -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Catégorie <span class="text-red-500">*</span>
                            </label>
                            <select name="category_id" required
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-[#003e87]">
                                <option value="">Sélectionner...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Sous-catégorie
                            </label>
                            <select name="subcategory_id"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-[#003e87]">
                                <option value="">Aucune</option>
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                        {{ $subcategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- SKU -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            SKU (Code produit)
                        </label>
                        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-[#003e87]"
                               placeholder="Ex: PRD-001">
                        @error('sku')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Short Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description courte
                        </label>
                        <textarea name="short_description" rows="2"
                                  class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-[#003e87]"
                                  placeholder="Brève description du produit...">{{ old('short_description', $product->short_description) }}</textarea>
                    </div>

                    <!-- Full Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description complète
                        </label>
                        <textarea name="description" rows="5"
                                  class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-[#003e87]"
                                  placeholder="Description détaillée du produit...">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Pricing -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-dollar-sign text-[#003e87] mr-2"></i>
                    Prix
                </h3>
                
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Prix actuel (DH) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" 
                               step="0.01" min="0" required
                               oninput="calculateDiscount()"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-[#003e87]"
                               placeholder="0.00">
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Ancien prix (DH)
                        </label>
                        <input type="number" name="price_old" id="price_old" value="{{ old('price_old', $product->price_old) }}" 
                               step="0.01" min="0"
                               oninput="calculateDiscount()"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-[#003e87]"
                               placeholder="0.00">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Réduction (%)
                        </label>
                        <input type="number" name="discount_percentage" id="discount_percentage" 
                               value="{{ old('discount_percentage', $product->discount_percentage) }}" 
                               min="0" max="100" readonly
                               class="w-full px-4 py-2 border rounded-lg bg-gray-100 cursor-not-allowed"
                               placeholder="0">
                        <p class="text-xs text-gray-500 mt-1">Calculé automatiquement</p>
                    </div>
                </div>
            </div>

            <!-- Inventory -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-box text-[#003e87] mr-2"></i>
                    Stock
                </h3>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Quantité en stock <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" 
                           min="0" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-[#003e87]"
                           placeholder="0">
                    @error('stock')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Image -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4 flex items-center">
                    <i class="fas fa-image text-[#003e87] mr-2"></i>
                    Image du produit
                </h3>
                
                @if($product->image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-600 mb-2">Image actuelle:</p>
                        @if(filter_var($product->image, FILTER_VALIDATE_URL))
                            <img src="{{ $product->image }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-32 h-32 object-cover rounded-lg border"
                                 onerror="this.src='{{ asset('images/placeholder-product.svg') }}'; this.onerror=null;">
                        @else
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-32 h-32 object-cover rounded-lg border"
                                 onerror="this.src='{{ asset('images/placeholder-product.svg') }}'; this.onerror=null;">
                        @endif
                    </div>
                @endif
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Changer l'image
                    </label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-[#003e87]">
                    <p class="text-xs text-gray-500 mt-1">Formats acceptés: JPG, PNG, GIF, WEBP (Max: 2MB)</p>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            
            <!-- Status & Visibility -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Statut</h3>
                
                <div class="space-y-4">
                    <!-- Active Status -->
                    <label class="flex items-center justify-between cursor-pointer">
                        <span class="text-sm font-medium text-gray-700">Produit actif</span>
                        <div class="relative">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" 
                                   {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Badges -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Badges</h3>
                
                <div class="space-y-3">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="hidden" name="is_new" value="0">
                        <input type="checkbox" name="is_new" value="1" 
                               {{ old('is_new', $product->is_new) ? 'checked' : '' }}
                               class="rounded text-[#003e87] focus:ring-[#003e87]">
                        <span class="text-sm text-gray-700">Nouveau produit</span>
                    </label>

                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="hidden" name="is_bestseller" value="0">
                        <input type="checkbox" name="is_bestseller" value="1" 
                               {{ old('is_bestseller', $product->is_bestseller) ? 'checked' : '' }}
                               class="rounded text-[#003e87] focus:ring-[#003e87]">
                        <span class="text-sm text-gray-700">Bestseller</span>
                    </label>

                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" value="1" 
                               {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                               class="rounded text-[#003e87] focus:ring-[#003e87]">
                        <span class="text-sm text-gray-700">Produit vedette</span>
                    </label>
                </div>
            </div>

            <!-- Product Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-4">Informations</h3>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">ID:</span>
                        <span class="font-medium">#{{ $product->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Créé le:</span>
                        <span class="font-medium">{{ $product->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Modifié le:</span>
                        <span class="font-medium">{{ $product->updated_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

<script>
// Calculate discount percentage automatically
function calculateDiscount() {
    const price = parseFloat(document.getElementById('price').value) || 0;
    const priceOld = parseFloat(document.getElementById('price_old').value) || 0;
    const discountField = document.getElementById('discount_percentage');
    
    if (priceOld > 0 && price > 0 && priceOld > price) {
        const discount = Math.round(((priceOld - price) / priceOld) * 100);
        discountField.value = discount;
    } else {
        discountField.value = 0;
    }
}

// Calculate on page load
document.addEventListener('DOMContentLoaded', function() {
    calculateDiscount();
});
</script>
@endsection
