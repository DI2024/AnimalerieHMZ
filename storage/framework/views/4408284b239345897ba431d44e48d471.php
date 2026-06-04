<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Left: Images -->
    <div>
        <?php
            if ($product->image) {
                if (filter_var($product->image, FILTER_VALIDATE_URL)) {
                    $imageUrl = $product->image;
                } elseif (str_starts_with($product->image, 'products/')) {
                    $imageUrl = asset('storage/' . $product->image);
                } elseif (str_starts_with($product->image, 'storage/')) {
                    $imageUrl = asset($product->image);
                } elseif (str_starts_with($product->image, 'images/')) {
                    $imageUrl = asset($product->image);
                } else {
                    $imageUrl = asset('storage/' . $product->image);
                }
            } else {
                $imageUrl = null;
            }
        ?>

        <?php if($imageUrl): ?>
            <img src="<?php echo e($imageUrl); ?>" 
                 alt="<?php echo e($product->name); ?>" 
                 class="w-full rounded-lg mb-4 object-contain max-h-[300px] bg-gray-50"
                 onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22400%22 height=%22400%22%3E%3Crect fill=%22%23f3f4f6%22 width=%22400%22 height=%22400%22/%3E%3Ctext fill=%22%239ca3af%22 font-family=%22sans-serif%22 font-size=%2224%22 dy=%2210.5%22 font-weight=%22bold%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22%3EImage non disponible%3C/text%3E%3C/svg%3E';">
        <?php else: ?>
            <div class="w-full aspect-square rounded-lg mb-4 flex items-center justify-center bg-gray-100 border border-gray-200">
                <i class="fas fa-image text-gray-400 text-5xl"></i>
            </div>
        <?php endif; ?>
    </div>

    <!-- Right: Info -->
    <div class="space-y-4">
        <div>
            <span class="text-xs md:text-sm text-gray-500"><?php echo e($product->category->name ?? 'N/A'); ?></span>
            <h2 class="text-lg md:text-2xl font-bold text-gray-900 mt-1"><?php echo e($product->name); ?></h2>
            <?php if($product->sku): ?>
                <p class="text-xs md:text-sm text-gray-500 mt-1">SKU: <?php echo e($product->sku); ?></p>
            <?php endif; ?>
        </div>

        <!-- Badges -->
        <?php if($product->is_new || $product->is_bestseller || $product->is_featured): ?>
            <div class="flex space-x-2">
                <?php if($product->is_new): ?>
                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs md:text-sm font-medium">Nouveau</span>
                <?php endif; ?>
                <?php if($product->is_bestseller): ?>
                    <span class="px-2 py-1 bg-[#003e87] text-white rounded-full text-xs md:text-sm font-medium">Bestseller</span>
                <?php endif; ?>
                <?php if($product->is_featured): ?>
                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs md:text-sm font-medium">Featured</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Price -->
        <div>
            <div class="flex items-baseline space-x-2 md:space-x-3">
                <span class="text-xl md:text-3xl font-bold text-[#003e87]"><?php echo e(number_format($product->price, 2)); ?> DH</span>
                <?php if($product->price_old && $product->price_old > $product->price): ?>
                    <span class="text-sm md:text-xl text-gray-400 line-through"><?php echo e(number_format($product->price_old, 2)); ?> DH</span>
                    <span class="px-1.5 py-0.5 bg-red-100 text-red-800 rounded text-xs md:text-sm font-medium">
                        -<?php echo e($product->discount_percentage); ?>%
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Description -->
        <?php if($product->short_description || $product->description): ?>
            <div>
                <h3 class="text-sm md:text-base font-semibold text-gray-900 mb-1">Description</h3>
                <p class="text-gray-600 text-xs md:text-sm"><?php echo e($product->short_description ?? Str::limit($product->description, 200)); ?></p>
            </div>
        <?php endif; ?>

        <!-- Stock -->
        <div>
            <h3 class="text-sm md:text-base font-semibold text-gray-900 mb-1">Stock</h3>
            <div class="flex items-center space-x-3">
                <?php if($product->stock == 0): ?>
                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs md:text-sm font-medium">
                        <i class="fas fa-times-circle mr-1"></i>Rupture de stock
                    </span>
                <?php elseif($product->stock < 10): ?>
                    <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded-full text-xs md:text-sm font-medium">
                        <i class="fas fa-exclamation-triangle mr-1"></i>Stock faible: <?php echo e($product->stock); ?> unités
                    </span>
                <?php else: ?>
                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs md:text-sm font-medium">
                        <i class="fas fa-check-circle mr-1"></i>En stock: <?php echo e($product->stock); ?> unités
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Stats -->
        <?php
            $totalSales = $product->orderItems()->sum('quantity') ?? 0;
        ?>
        <?php if($totalSales > 0): ?>
            <div class="grid grid-cols-2 gap-4 p-3 bg-gray-50 rounded-lg">
                <div class="text-center">
                    <div class="text-lg md:text-2xl font-bold text-gray-900"><?php echo e($totalSales); ?></div>
                    <div class="text-[10px] md:text-xs text-gray-600">Ventes totales</div>
                </div>
                <div class="text-center">
                    <?php
                        $revenue = $product->orderItems()->get()->sum(function($item) {
                            return $item->quantity * $item->price;
                        });
                    ?>
                    <div class="text-lg md:text-2xl font-bold text-green-600"><?php echo e(number_format($revenue, 0)); ?> DH</div>
                    <div class="text-[10px] md:text-xs text-gray-600">Revenu généré</div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Status -->
        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
            <span class="text-xs md:text-sm font-medium text-gray-700">Statut du produit</span>
            <span class="px-2 py-1 rounded-full text-xs md:text-sm font-medium <?php echo e($product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'); ?>">
                <?php echo e($product->is_active ? 'Actif' : 'Inactif'); ?>

            </span>
        </div>

        <!-- Actions -->
        <div class="flex space-x-3 pt-3 border-t">
            <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" 
               class="flex-1 px-4 py-2 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] text-center text-xs md:text-sm font-medium transition-colors">
                <i class="fas fa-edit mr-2"></i>Modifier le produit
            </a>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/admin/products/partials/quick-view.blade.php ENDPATH**/ ?>