<div class="product-card bg-white rounded-lg shadow overflow-hidden" data-product-id="{{ $product->id }}">
    <!-- Badge -->
    @if($product->discount_percentage > 0)
    <div class="absolute top-3 right-3 z-10">
        <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
            -{{ $product->discount_percentage }}%
        </span>
    </div>
    @elseif($product->is_new)
    <div class="absolute top-3 right-3 z-10">
        <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">
            NOUVEAU
        </span>
    </div>
    @elseif($product->is_bestseller)
    <div class="absolute top-3 right-3 z-10">
        <span class="bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded">
            ⭐ BEST
        </span>
    </div>
    @endif

    <!-- Product Image -->
    <div class="relative aspect-square bg-gray-100">
        @if($product->image)
            @if(filter_var($product->image, FILTER_VALIDATE_URL))
                <img src="{{ $product->image }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-full object-cover">
            @else
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-full object-cover">
            @endif
        @else
            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                <i class="fas fa-image text-gray-400 text-4xl"></i>
            </div>
        @endif
        
        <!-- Quick Actions Overlay -->
        <div class="quick-actions absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center space-x-3">
            <button onclick="quickView({{ $product->id }})" 
                    class="p-3 bg-white rounded-full hover:bg-gray-100 transition-colors shadow-lg" 
                    title="Aperçu rapide">
                <i class="fas fa-eye text-gray-700"></i>
            </button>
            <a href="{{ route('admin.products.edit', $product->id) }}" 
               class="p-3 bg-white rounded-full hover:bg-gray-100 transition-colors shadow-lg" 
               title="Modifier">
                <i class="fas fa-edit text-gray-700"></i>
            </a>
            <button onclick="deleteProduct({{ $product->id }})" 
                    class="p-3 bg-white rounded-full hover:bg-red-100 transition-colors shadow-lg" 
                    title="Supprimer">
                <i class="fas fa-trash text-red-600"></i>
            </button>
        </div>
    </div>

    <!-- Product Info -->
    <div class="p-4">
        <p class="text-xs text-gray-500 mb-1">{{ $product->category->name ?? 'Sans catégorie' }}</p>
        <h3 class="text-base font-semibold text-gray-900 mb-2 truncate" title="{{ $product->name }}">{{ $product->name }}</h3>

        <div class="mb-3">
            <div class="flex items-baseline space-x-2">
                <span class="text-xl font-bold text-[#003e87]">{{ number_format($product->price, 2) }} DH</span>
                @if($product->price_old && $product->price_old > $product->price)
                    <span class="text-sm text-gray-400 line-through">{{ number_format($product->price_old, 2) }} DH</span>
                @endif
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-2 mb-3 text-xs text-gray-600">
            <div class="flex items-center space-x-1" title="SKU">
                <i class="fas fa-barcode text-gray-400"></i>
                <span class="truncate">{{ $product->sku ?? 'N/A' }}</span>
            </div>
            <div class="flex items-center space-x-1" title="Vues">
                <i class="fas fa-eye text-gray-400"></i>
                <span>{{ $product->view_count ?? 0 }}</span>
            </div>
            <div class="flex items-center space-x-1" title="Note">
                <i class="fas fa-star text-yellow-400"></i>
                <span>{{ number_format($product->rating ?? 0, 1) }}</span>
            </div>
        </div>

        <!-- Stock Status -->
        <div class="mb-3">
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-600">Stock:</span>
                <span class="font-medium px-2 py-1 rounded" 
                      @if($product->stock == 0)
                          class="text-red-600"
                      @elseif($product->stock <= 10)
                          class="text-orange-600"
                      @else
                          class="text-green-600"
                      @endif>
                    {{ $product->stock }} unités
                </span>
            </div>
            <!-- Stock Progress Bar -->
            @php
                $stockPercentage = min(($product->stock / 100) * 100, 100);
                $stockColor = $product->stock == 0 ? 'bg-red-500' : ($product->stock <= 10 ? 'bg-orange-500' : 'bg-green-500');
            @endphp
            <div class="stock-progress mt-2">
                <div class="stock-progress-bar {{ $stockColor }}" style="width: {{ $stockPercentage }}%"></div>
            </div>
        </div>

        <!-- Status Display (Not Editable) -->
        <div class="flex items-center justify-between pt-3 border-t">
            <span class="text-sm text-gray-600">Statut:</span>
            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                {{ $product->is_active ? 'Actif' : 'Inactif' }}
            </span>
        </div>
    </div>
</div>
