<div class="product-card bg-white rounded-lg shadow overflow-hidden" data-product-id="<?php echo e($product->id); ?>">
    <!-- Badge -->
    <?php if($product->discount_percentage > 0): ?>
    <div class="absolute top-3 right-3 z-10">
        <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
            -<?php echo e($product->discount_percentage); ?>%
        </span>
    </div>
    <?php elseif($product->is_new): ?>
    <div class="absolute top-3 right-3 z-10">
        <span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">
            NOUVEAU
        </span>
    </div>
    <?php elseif($product->is_bestseller): ?>
    <div class="absolute top-3 right-3 z-10">
        <span class="bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded">
            ⭐ BEST
        </span>
    </div>
    <?php endif; ?>

    <!-- Product Image -->
    <div class="relative aspect-square bg-gray-100">
        <?php if($product->image): ?>
            <?php
                // Déterminer l'URL de l'image
                if (filter_var($product->image, FILTER_VALIDATE_URL)) {
                    // URL complète
                    $imageUrl = $product->image;
                } elseif (str_starts_with($product->image, 'products/')) {
                    // Chemin relatif depuis storage/app/public
                    $imageUrl = asset('storage/' . $product->image);
                } elseif (str_starts_with($product->image, 'storage/')) {
                    // Chemin qui commence déjà par storage/
                    $imageUrl = asset($product->image);
                } elseif (str_starts_with($product->image, 'images/')) {
                    // Chemin dans public/images
                    $imageUrl = asset($product->image);
                } else {
                    // Par défaut, essayer storage
                    $imageUrl = asset('storage/' . $product->image);
                }
            ?>
            <img src="<?php echo e($imageUrl); ?>" 
                 alt="<?php echo e($product->name); ?>" 
                 class="w-full h-full object-cover"
                 onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22400%22%3E%3Crect fill=%22%23f3f4f6%22 width=%22400%22 height=%22400%22/%3E%3Ctext fill=%22%239ca3af%22 font-family=%22sans-serif%22 font-size=%2224%22 dy=%2210.5%22 font-weight=%22bold%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22%3EImage non disponible%3C/text%3E%3C/svg%3E';">
        <?php else: ?>
            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                <i class="fas fa-image text-gray-400 text-4xl"></i>
            </div>
        <?php endif; ?>
        
        <!-- Quick Actions Overlay -->
        <div class="quick-actions absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center space-x-3">
            <button onclick="quickView(<?php echo e($product->id); ?>)" 
                    class="p-3 bg-white rounded-full hover:bg-gray-100 transition-colors shadow-lg" 
                    title="Aperçu rapide">
                <i class="fas fa-eye text-gray-700"></i>
            </button>
            <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" 
               class="p-3 bg-white rounded-full hover:bg-gray-100 transition-colors shadow-lg" 
               title="Modifier">
                <i class="fas fa-edit text-gray-700"></i>
            </a>
            <button onclick="deleteProduct(<?php echo e($product->id); ?>)" 
                    class="p-3 bg-white rounded-full hover:bg-red-100 transition-colors shadow-lg" 
                    title="Supprimer">
                <i class="fas fa-trash text-red-600"></i>
            </button>
        </div>
    </div>

    <!-- Product Info -->
    <div class="p-4">
        <p class="text-xs text-gray-500 mb-1"><?php echo e($product->category->name ?? 'Sans catégorie'); ?></p>
        <h3 class="text-base font-semibold text-gray-900 mb-2 truncate" title="<?php echo e($product->name); ?>"><?php echo e($product->name); ?></h3>

        <div class="mb-3">
            <div class="flex items-baseline space-x-2">
                <span class="text-xl font-bold text-[#003e87]"><?php echo e(number_format($product->price, 2)); ?> DH</span>
                <?php if($product->price_old && $product->price_old > $product->price): ?>
                    <span class="text-sm text-gray-400 line-through"><?php echo e(number_format($product->price_old, 2)); ?> DH</span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-3 gap-2 mb-3 text-xs text-gray-600">
            <div class="flex items-center space-x-1" title="SKU">
                <i class="fas fa-barcode text-gray-400"></i>
                <span class="truncate"><?php echo e($product->sku ?? 'N/A'); ?></span>
            </div>
            <div class="flex items-center space-x-1" title="Vues">
                <i class="fas fa-eye text-gray-400"></i>
                <span><?php echo e($product->view_count ?? 0); ?></span>
            </div>
            <div class="flex items-center space-x-1" title="Note">
                <i class="fas fa-star text-yellow-400"></i>
                <span><?php echo e(number_format($product->rating ?? 0, 1)); ?></span>
            </div>
        </div>

        <!-- Stock Status -->
        <div class="mb-3">
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-600">Stock:</span>
                <span class="font-medium px-2 py-1 rounded" 
                      <?php if($product->stock == 0): ?>
                          class="text-red-600"
                      <?php elseif($product->stock <= 10): ?>
                          class="text-orange-600"
                      <?php else: ?>
                          class="text-green-600"
                      <?php endif; ?>>
                    <?php echo e($product->stock); ?> unités
                </span>
            </div>
            <!-- Stock Progress Bar -->
            <?php
                $stockPercentage = min(($product->stock / 100) * 100, 100);
                $stockColor = $product->stock == 0 ? 'bg-red-500' : ($product->stock <= 10 ? 'bg-orange-500' : 'bg-green-500');
            ?>
            <div class="stock-progress mt-2">
                <div class="stock-progress-bar <?php echo e($stockColor); ?>" style="width: <?php echo e($stockPercentage); ?>%"></div>
            </div>
        </div>

        <!-- Status Display (Not Editable) -->
        <div class="flex items-center justify-between pt-3 border-t">
            <span class="text-sm text-gray-600">Statut:</span>
            <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo e($product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'); ?>">
                <?php echo e($product->is_active ? 'Actif' : 'Inactif'); ?>

            </span>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/admin/products/partials/card.blade.php ENDPATH**/ ?>