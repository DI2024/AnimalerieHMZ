<div class="product-card bg-white rounded-lg shadow overflow-hidden" data-product-id="1">
    <!-- Selection Checkbox -->
    <div class="absolute top-3 left-3 z-10">
        <input type="checkbox" class="product-checkbox rounded text-primary focus:ring-primary w-5 h-5" value="1">
    </div>

    <!-- Badge -->
    <div class="absolute top-3 right-3 z-10">
        <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
            -20%
        </span>
    </div>

    <!-- Product Image -->
    <div class="relative aspect-square bg-gray-100">
        <img src="/images/placeholder-product.svg" 
             alt="Produit Sample" 
             class="w-full h-full object-cover">
        
        <!-- Quick Actions Overlay -->
        <div class="quick-actions absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center space-x-3">
            <button class="p-3 bg-white rounded-full hover:bg-gray-100 transition-colors shadow-lg" title="Aperçu rapide">
                <i class="fas fa-eye text-gray-700"></i>
            </button>
            <a href="#" class="p-3 bg-white rounded-full hover:bg-gray-100 transition-colors shadow-lg" title="Modifier">
                <i class="fas fa-edit text-gray-700"></i>
            </a>
            <button class="p-3 bg-white rounded-full hover:bg-red-100 transition-colors shadow-lg" title="Supprimer">
                <i class="fas fa-trash text-red-600"></i>
            </button>
        </div>
    </div>

    <!-- Product Info -->
    <div class="p-4">
        <p class="text-xs text-gray-500 mb-1">Chiens</p>
        <h3 class="text-base font-semibold text-gray-900 mb-2 truncate">Croquettes Premium Bio</h3>

        <div class="mb-3">
            <div class="flex items-baseline space-x-2">
                <span class="text-xl font-bold text-primary">250.00 DH</span>
                <span class="text-sm text-gray-400 line-through">312.50 DH</span>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-2 mb-3 text-xs text-gray-600">
            <div class="flex items-center space-x-1" title="Ventes">
                <i class="fas fa-shopping-cart text-gray-400"></i>
                <span>45</span>
            </div>
            <div class="flex items-center space-x-1" title="Vues">
                <i class="fas fa-eye text-gray-400"></i>
                <span>120</span>
            </div>
            <div class="flex items-center space-x-1" title="Note">
                <i class="fas fa-star text-yellow-400"></i>
                <span>4.8</span>
            </div>
        </div>

        <!-- Stock Status -->
        <div class="mb-3">
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-600">Stock:</span>
                <span class="font-medium text-green-600">24 unités</span>
            </div>
        </div>

        <!-- Status Toggle -->
        <div class="flex items-center justify-between pt-3 border-t">
            <span class="text-sm text-gray-600">Statut:</span>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" class="sr-only peer" checked>
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-yellow-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
            </label>
        </div>
    </div>
</div>
