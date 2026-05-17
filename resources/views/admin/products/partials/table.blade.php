<table class="w-full">
    <thead class="bg-gray-50 sticky top-0">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Badges</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @forelse($products as $product)
        <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-6 py-4">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                        @if($product->image)
                            @if(filter_var($product->image, FILTER_VALIDATE_URL))
                                <img src="{{ $product->image }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover"
                                     onerror="this.src='{{ asset('images/placeholder-product.svg') }}'; this.onerror=null;">
                            @else
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover"
                                     onerror="this.src='{{ asset('images/placeholder-product.svg') }}'; this.onerror=null;">
                            @endif
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <i class="fas fa-image text-2xl"></i>
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">{{ $product->name }}</p>
                        @if($product->sku)
                            <p class="text-xs text-gray-500">SKU: {{ $product->sku }}</p>
                        @endif
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 text-sm text-gray-700">
                {{ $product->category->name ?? 'N/A' }}
                @if($product->subcategory)
                    <br><span class="text-xs text-gray-500">{{ $product->subcategory->name }}</span>
                @endif
            </td>
            <td class="px-6 py-4">
                <p class="text-sm font-bold text-gray-900">{{ number_format($product->price, 2) }} DH</p>
                @if($product->price_old && $product->price_old > $product->price)
                    <p class="text-xs text-gray-400 line-through">{{ number_format($product->price_old, 2) }} DH</p>
                @endif
            </td>
            <td class="px-6 py-4">
                <span class="text-sm font-medium {{ $product->stock == 0 ? 'text-red-600' : ($product->stock < 10 ? 'text-orange-600' : 'text-green-600') }}">
                    {{ $product->stock }} unités
                </span>
            </td>
            <td class="px-6 py-4">
                <div class="flex flex-wrap gap-1">
                    @if($product->is_new)
                        <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded-full text-xs font-medium">NEW</span>
                    @endif
                    @if($product->is_bestseller)
                        <span class="px-2 py-0.5 bg-[#003e87] text-white rounded-full text-xs font-medium">BEST</span>
                    @endif
                    @if($product->is_featured)
                        <span class="px-2 py-0.5 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">FEAT</span>
                    @endif
                </div>
            </td>
            <td class="px-6 py-4">
                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ $product->is_active ? 'Actif' : 'Inactif' }}
                </span>
            </td>
            <td class="px-6 py-4 text-sm">
                <div class="flex items-center space-x-2">
                    <button onclick="quickView({{ $product->id }})" class="text-blue-600 hover:text-blue-800" title="Aperçu">
                        <i class="fas fa-eye"></i>
                    </button>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-green-600 hover:text-green-800" title="Modifier">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button onclick="deleteProduct({{ $product->id }})" class="text-red-600 hover:text-red-800" title="Supprimer">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="px-6 py-12 text-center">
                <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Aucun produit trouvé</p>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
