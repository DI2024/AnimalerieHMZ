<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Left: Images -->
    <div>
        <img src="{{ asset('storage/' . $product->image) }}" 
             alt="{{ $product->name }}" 
             class="w-full rounded-lg mb-4"
             onerror="this.src='{{ asset('images/placeholder-product.svg') }}'; this.onerror=null;">
        
        @if($product->images->count() > 0)
            <div class="grid grid-cols-4 gap-2">
                @foreach($product->images as $image)
                    <img src="{{ asset('storage/' . $image->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-20 object-cover rounded"
                         onerror="this.src='{{ asset('images/placeholder-product.svg') }}'; this.onerror=null;">
                @endforeach
            </div>
        @endif
    </div>

    <!-- Right: Info -->
    <div class="space-y-4">
        <div>
            <span class="text-sm text-gray-500">{{ $product->category->name }}</span>
            <h2 class="text-2xl font-bold text-gray-900 mt-1">{{ $product->name }}</h2>
        </div>

        <!-- Badges -->
        @if($product->is_new || $product->is_bestseller || $product->is_featured)
            <div class="flex space-x-2">
                @if($product->is_new)
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Nouveau</span>
                @endif
                @if($product->is_bestseller)
                    <span class="px-3 py-1 bg-primary text-white rounded-full text-sm font-medium">Bestseller</span>
                @endif
                @if($product->is_featured)
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Featured</span>
                @endif
            </div>
        @endif

        <!-- Price -->
        <div>
            <div class="flex items-baseline space-x-3">
                <span class="text-3xl font-bold text-primary">{{ number_format($product->price, 2) }} DH</span>
                @if($product->price_old && $product->price_old > $product->price)
                    <span class="text-xl text-gray-400 line-through">{{ number_format($product->price_old, 2) }} DH</span>
                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm font-medium">
                        -{{ $product->discount_percentage }}%
                    </span>
                @endif
            </div>
        </div>

        <!-- Description -->
        <div>
            <h3 class="font-semibold text-gray-900 mb-2">Description</h3>
            <p class="text-gray-600 text-sm">{{ $product->short_description ?? Str::limit($product->description, 200) }}</p>
        </div>

        <!-- Stock -->
        <div>
            <h3 class="font-semibold text-gray-900 mb-2">Stock</h3>
            <div class="flex items-center space-x-3">
                @if($product->stock == 0)
                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">
                        <i class="fas fa-times-circle mr-1"></i>Rupture de stock
                    </span>
                @elseif($product->stock < 10)
                    <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-medium">
                        <i class="fas fa-exclamation-triangle mr-1"></i>Stock faible: {{ $product->stock }} unités
                    </span>
                @else
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                        <i class="fas fa-check-circle mr-1"></i>En stock: {{ $product->stock }} unités
                    </span>
                @endif
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-4 p-4 bg-gray-50 rounded-lg">
            <div class="text-center">
                <div class="text-2xl font-bold text-gray-900">{{ $product->orderItems->sum('quantity') ?? 0 }}</div>
                <div class="text-xs text-gray-600">Ventes</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-gray-900">{{ number_format($product->rating, 1) }}</div>
                <div class="text-xs text-gray-600">Note moyenne</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-gray-900">{{ $product->review_count }}</div>
                <div class="text-xs text-gray-600">Avis</div>
            </div>
        </div>

        <!-- Revenue -->
        @php
            $revenue = $product->orderItems->sum(function($item) {
                return $item->quantity * $item->price;
            });
        @endphp
        @if($revenue > 0)
            <div class="p-4 bg-green-50 rounded-lg">
                <div class="text-sm text-gray-600">Revenu généré</div>
                <div class="text-2xl font-bold text-green-600">{{ number_format($revenue, 2) }} DH</div>
            </div>
        @endif

        <!-- Status -->
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <span class="text-sm font-medium text-gray-700">Statut du produit</span>
            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                {{ $product->is_active ? 'Actif' : 'Inactif' }}
            </span>
        </div>

        <!-- Actions -->
        <div class="flex space-x-3 pt-4 border-t">
            <a href="{{ route('admin.products.edit', $product->id) }}" 
               class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-yellow-600 text-center">
                <i class="fas fa-edit mr-2"></i>Modifier le produit
            </a>
        </div>
    </div>
</div>
