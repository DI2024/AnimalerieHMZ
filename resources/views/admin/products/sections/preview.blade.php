<div class="bg-white rounded-lg shadow-lg p-6 space-y-4">
    <!-- Preview Header -->
    <div class="flex items-center justify-between pb-4 border-b">
        <h3 class="font-semibold text-gray-900">Aperçu en direct</h3>
        <div class="flex space-x-2">
            <button type="button" onclick="switchPreviewMode('desktop')" 
                    class="preview-mode-btn active px-3 py-1 text-sm border rounded" data-mode="desktop">
                <i class="fas fa-desktop"></i>
            </button>
            <button type="button" onclick="switchPreviewMode('mobile')" 
                    class="preview-mode-btn px-3 py-1 text-sm border rounded" data-mode="mobile">
                <i class="fas fa-mobile-alt"></i>
            </button>
        </div>
    </div>

    <!-- Desktop Preview -->
    <div id="preview-desktop" class="preview-container">
        <!-- Product Card Preview -->
        <div class="border rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
            <!-- Image -->
            <div class="relative aspect-square bg-gray-100">
                    <img id="preview-image" src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?auto=format&fit=crop&q=80&w=400" 
                         alt="Sample Product" 
                         class="w-full h-full object-cover">
                
                <!-- Badge -->
                <div id="preview-badge" class="absolute top-3 right-3 hidden">
                    <span class="px-3 py-1 rounded text-white text-xs font-bold" style="background: #d4af37;">
                        BADGE
                    </span>
                </div>
                
                <!-- Stock Status -->
                <div id="preview-stock-badge" class="absolute bottom-3 left-3">
                    <span class="px-2 py-1 bg-green-500 text-white text-xs rounded">
                        En stock
                    </span>
                </div>
            </div>

            <!-- Content -->
            <div class="p-4">
                <!-- Category -->
                <p id="preview-category" class="text-xs text-gray-500 mb-1">
                    Chiens
                </p>
                
                <!-- Name -->
                <h3 id="preview-name" class="font-semibold text-gray-900 mb-2 line-clamp-2">
                    Croquettes Premium Chien
                </h3>

                <!-- Description -->
                <p id="preview-description" class="text-sm text-gray-600 mb-3 line-clamp-2">
                    Croquettes de haute qualité pour chiens adultes de toutes races.
                </p>

                <!-- Rating -->
                <div class="flex items-center space-x-1 mb-3">
                    <div class="flex text-yellow-400">
                        <i class="fas fa-star text-xs"></i>
                        <i class="fas fa-star text-xs"></i>
                        <i class="fas fa-star text-xs"></i>
                        <i class="fas fa-star text-xs"></i>
                        <i class="fas fa-star text-xs"></i>
                    </div>
                    <span class="text-xs text-gray-500">(12)</span>
                </div>

                <!-- Price -->
                <div class="flex items-baseline space-x-2 mb-4">
                    <span id="preview-price" class="text-2xl font-bold text-primary">
                        150.00 DH
                    </span>
                    <span id="preview-old-price" class="text-sm text-gray-400 line-through hidden">
                        180.00 DH
                    </span>
                    <span id="preview-discount" class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded hidden">
                        -15%
                    </span>
                </div>

                <!-- Add to Cart Button -->
                <button class="w-full py-3 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-colors font-medium">
                    <i class="fas fa-shopping-cart mr-2"></i>
                    Ajouter au panier
                </button>

                <!-- Quick Actions -->
                <div class="flex items-center justify-center space-x-4 mt-3 pt-3 border-t">
                    <button class="text-gray-600 hover:text-primary transition-colors">
                        <i class="far fa-heart"></i>
                    </button>
                    <button class="text-gray-600 hover:text-primary transition-colors">
                        <i class="far fa-eye"></i>
                    </button>
                    <button class="text-gray-600 hover:text-primary transition-colors">
                        <i class="fas fa-share-alt"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Product Stats -->
        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
            <h4 class="text-sm font-medium text-gray-700 mb-3">Statistiques</h4>
            <div class="grid grid-cols-2 gap-3 text-center">
                <div>
                    <div class="text-2xl font-bold text-gray-900">25</div>
                    <div class="text-xs text-gray-600">Ventes</div>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">45</div>
                    <div class="text-xs text-gray-600">En stock</div>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">4.8</div>
                    <div class="text-xs text-gray-600">Note</div>
                </div>
                <div>
                    <div class="text-2xl font-bold text-gray-900">8</div>
                    <div class="text-xs text-gray-600">Favoris</div>
                </div>
            </div>
        </div>

        <!-- SEO Preview -->
        <div class="mt-4 p-4 bg-blue-50 rounded-lg">
            <h4 class="text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-search mr-1"></i>
                Aperçu Google
            </h4>
            <div class="space-y-1">
                <p class="text-blue-600 text-sm font-medium">Croquettes Premium Chien | Animalerie HMZ</p>
                <p class="text-green-700 text-xs">lotusdiamant.com › products › croquettes-premium-chien</p>
                <p class="text-gray-600 text-xs line-clamp-2">
                    Croquettes de haute qualité pour chiens adultes de toutes races.
                </p>
            </div>
        </div>
    </div>

    <!-- Mobile Preview -->
    <div id="preview-mobile" class="preview-container hidden">
        <div class="max-w-sm mx-auto border-4 border-gray-800 rounded-3xl overflow-hidden shadow-2xl">
            <!-- Mobile Screen -->
            <div class="bg-white" style="height: 600px; overflow-y: auto;">
                <!-- Same content as desktop but in mobile layout -->
                <div class="relative">
                        <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?auto=format&fit=crop&q=80&w=400" 
                             alt="Sample Product" 
                             class="w-full h-64 object-cover">
                </div>
                
                <div class="p-4">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Croquettes Premium Chien</h3>
                    <p class="text-sm text-gray-600 mb-3">Croquettes de haute qualité pour chiens adultes de toutes races.</p>
                    
                    <div class="flex items-baseline space-x-2 mb-4">
                        <span class="text-xl font-bold text-primary">150.00 DH</span>
                    </div>
                    
                    <button class="w-full py-3 bg-primary text-white rounded-lg font-medium">
                        Ajouter au panier
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Tips -->
    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
        <p class="text-xs text-yellow-800">
            <i class="fas fa-lightbulb mr-1"></i>
            <strong>Astuce:</strong> L'aperçu se met à jour automatiquement pendant que vous modifiez le produit
        </p>
    </div>
</div>

<script>
function switchPreviewMode(mode) {
    // Update buttons
    document.querySelectorAll('.preview-mode-btn').forEach(btn => {
        btn.classList.remove('active', 'bg-primary', 'text-white');
        btn.classList.add('text-gray-600');
    });
    
    const activeBtn = document.querySelector(`[data-mode="${mode}"]`);
    activeBtn.classList.add('active', 'bg-primary', 'text-white');
    activeBtn.classList.remove('text-gray-600');
    
    // Show/hide previews
    document.getElementById('preview-desktop').classList.toggle('hidden', mode !== 'desktop');
    document.getElementById('preview-mobile').classList.toggle('hidden', mode !== 'mobile');
}

// Update preview in real-time
function updatePreview() {
    // Update name
    const name = document.getElementById('product-name').value;
    document.getElementById('preview-name').textContent = name || 'Nom du produit';
    
    // Update price
    const price = document.querySelector('input[name="price"]').value;
    if (price) {
        document.getElementById('preview-price').textContent = parseFloat(price).toFixed(2) + ' DH';
    }
    
    // Update old price
    const oldPrice = document.querySelector('input[name="price_old"]').value;
    const oldPriceEl = document.getElementById('preview-old-price');
    const discountEl = document.getElementById('preview-discount');
    
    if (oldPrice && parseFloat(oldPrice) > parseFloat(price)) {
        oldPriceEl.textContent = parseFloat(oldPrice).toFixed(2) + ' DH';
        oldPriceEl.classList.remove('hidden');
        
        const discount = ((parseFloat(oldPrice) - parseFloat(price)) / parseFloat(oldPrice) * 100).toFixed(0);
        discountEl.textContent = '-' + discount + '%';
        discountEl.classList.remove('hidden');
    } else {
        oldPriceEl.classList.add('hidden');
        discountEl.classList.add('hidden');
    }
    
    // Update description
    const description = document.querySelector('textarea[name="short_description"]').value;
    document.getElementById('preview-description').textContent = description || 'Description du produit...';
    
    // Update badge
    const badgeText = document.getElementById('badge-text').value;
    const badgeColor = document.getElementById('badge-color').value;
    const badgeEl = document.getElementById('preview-badge');
    
    if (badgeText) {
        badgeEl.querySelector('span').textContent = badgeText;
        badgeEl.querySelector('span').style.background = badgeColor;
        badgeEl.classList.remove('hidden');
    } else {
        badgeEl.classList.add('hidden');
    }
    
    // Update stock status
    const stock = parseInt(document.getElementById('stock-quantity').value) || 0;
    const stockBadge = document.getElementById('preview-stock-badge');
    
    if (stock === 0) {
        stockBadge.innerHTML = '<span class="px-2 py-1 bg-red-500 text-white text-xs rounded">Rupture</span>';
    } else if (stock <= parseInt(document.getElementById('stock-alert').value)) {
        stockBadge.innerHTML = '<span class="px-2 py-1 bg-orange-500 text-white text-xs rounded">Stock faible</span>';
    } else {
        stockBadge.innerHTML = '<span class="px-2 py-1 bg-green-500 text-white text-xs rounded">En stock</span>';
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updatePreview();
});
</script>

<style>
.preview-mode-btn.active {
    background-color: #d4af37;
    color: white;
    border-color: #d4af37;
}
</style>
