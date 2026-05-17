<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Left: Images -->
    <div>
        @if($product->image)
            @if(filter_var($product->image, FILTER_VALIDATE_URL))
                <img src="{{ $product->image }}" 
                     alt="{{ $product->name }}" 
                     class="w-full rounded-lg mb-4 object-cover"
                     onerror="this.src='{{ asset('images/placeholder-product.svg') }}'; this.onerror=null;">
            @else
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full rounded-lg mb-4 object-cover"
                     onerror="this.src='{{ asset('images/placeholder-product.svg') }}'; this.onerror=null;">
            @endif
        @else
            <div class="w-full h-64 bg-gray-100 rounded-lg mb-4 flex items-center justify-center">
                <i class="fas fa-image text-6xl text-gray-300"></i>
            </div>
        @endif
    </div>

    <!-- Right: Info -->
    <div class="space-y-4">
        <div>
            <span class="text-sm text-gray-500">{{ $product->category->name ?? 'N/A' }}</span>
            <h2 class="text-2xl font-bold text-gray-900 mt-1">{{ $product->name }}</h2>
            @if($product->sku)
                <p class="text-sm text-gray-500 mt-1">SKU: {{ $product->sku }}</p>
            @endif
        </div>

        <!-- Badges -->
        @if($product->is_new || $product->is_bestseller || $product->is_featured)
            <div class="flex space-x-2">
                @if($product->is_new)
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Nouveau</span>
                @endif
                @if($product->is_bestseller)
                    <span class="px-3 py-1 bg-[#003e87] text-white rounded-full text-sm font-medium">Bestseller</span>
                @endif
                @if($product->is_featured)
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Featured</span>
                @endif
            </div>
        @endif

        <!-- Price -->
        <div>
            <div class="flex items-baseline space-x-3">
                <span class="text-3xl font-bold text-[#003e87]">{{ number_format($product->price, 2) }} DH</span>
                @if($product->price_old && $product->price_old > $product->price)
                    <span class="text-xl text-gray-400 line-through">{{ number_format($product->price_old, 2) }} DH</span>
                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm font-medium">
                        -{{ $product->discount_percentage }}%
                    </span>
                @endif
            </div>
        </div>

        <!-- Description -->
        @if($product->short_description || $product->description)
            <div>
                <h3 class="font-semibold text-gray-900 mb-2">Description</h3>
                <p class="text-gray-600 text-sm">{{ $product->short_description ?? Str::limit($product->description, 200) }}</p>
            </div>
        @endif

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
        @php
            $totalSales = $product->orderItems()->sum('quantity') ?? 0;
        @endphp
        @if($totalSales > 0)
            <div class="grid grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg">
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900">{{ $totalSales }}</div>
                    <div class="text-xs text-gray-600">Ventes totales</div>
                </div>
                <div class="text-center">
                    @php
                        $revenue = $product->orderItems()->get()->sum(function($item) {
                            return $item->quantity * $item->price;
                        });
                    @endphp
                    <div class="text-2xl font-bold text-green-600">{{ number_format($revenue, 0) }} DH</div>
                    <div class="text-xs text-gray-600">Revenu généré</div>
                </div>
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
               class="flex-1 px-4 py-2 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] text-center transition-colors">
                <i class="fas fa-edit mr-2"></i>Modifier le produit
            </a>
        </div>
    </div>
</div>
