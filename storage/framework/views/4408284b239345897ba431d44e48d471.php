<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Left: Images -->
    <div>
        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" 
             alt="<?php echo e($product->name); ?>" 
             class="w-full rounded-lg mb-4"
             onerror="this.src='<?php echo e(asset('images/placeholder-product.svg')); ?>'; this.onerror=null;">
        

    </div>

    <!-- Right: Info -->
    <div class="space-y-4">
        <div>
            <span class="text-sm text-gray-500"><?php echo e($product->category->name ?? 'N/A'); ?></span>
            <h2 class="text-2xl font-bold text-gray-900 mt-1"><?php echo e($product->name); ?></h2>
            <?php if($product->sku): ?>
                <p class="text-sm text-gray-500 mt-1">SKU: <?php echo e($product->sku); ?></p>
            <?php endif; ?>
        </div>

        <!-- Badges -->
        <?php if($product->is_new || $product->is_bestseller || $product->is_featured): ?>
            <div class="flex space-x-2">
                <?php if($product->is_new): ?>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Nouveau</span>
                <?php endif; ?>
                <?php if($product->is_bestseller): ?>
                    <span class="px-3 py-1 bg-[#003e87] text-white rounded-full text-sm font-medium">Bestseller</span>
                <?php endif; ?>
                <?php if($product->is_featured): ?>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Featured</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Price -->
        <div>
            <div class="flex items-baseline space-x-3">
                <span class="text-3xl font-bold text-[#003e87]"><?php echo e(number_format($product->price, 2)); ?> DH</span>
                <?php if($product->price_old && $product->price_old > $product->price): ?>
                    <span class="text-xl text-gray-400 line-through"><?php echo e(number_format($product->price_old, 2)); ?> DH</span>
                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm font-medium">
                        -<?php echo e($product->discount_percentage); ?>%
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Description -->
        <?php if($product->short_description || $product->description): ?>
            <div>
                <h3 class="font-semibold text-gray-900 mb-2">Description</h3>
                <p class="text-gray-600 text-sm"><?php echo e($product->short_description ?? Str::limit($product->description, 200)); ?></p>
            </div>
        <?php endif; ?>

        <!-- Stock -->
        <div>
            <h3 class="font-semibold text-gray-900 mb-2">Stock</h3>
            <div class="flex items-center space-x-3">
                <?php if($product->stock == 0): ?>
                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium">
                        <i class="fas fa-times-circle mr-1"></i>Rupture de stock
                    </span>
                <?php elseif($product->stock < 10): ?>
                    <span class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-medium">
                        <i class="fas fa-exclamation-triangle mr-1"></i>Stock faible: <?php echo e($product->stock); ?> unités
                    </span>
                <?php else: ?>
                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
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
            <div class="grid grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg">
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900"><?php echo e($totalSales); ?></div>
                    <div class="text-xs text-gray-600">Ventes totales</div>
                </div>
                <div class="text-center">
                    <?php
                        $revenue = $product->orderItems()->get()->sum(function($item) {
                            return $item->quantity * $item->price;
                        });
                    ?>
                    <div class="text-2xl font-bold text-green-600"><?php echo e(number_format($revenue, 0)); ?> DH</div>
                    <div class="text-xs text-gray-600">Revenu généré</div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Status -->
        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
            <span class="text-sm font-medium text-gray-700">Statut du produit</span>
            <span class="px-3 py-1 rounded-full text-sm font-medium <?php echo e($product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'); ?>">
                <?php echo e($product->is_active ? 'Actif' : 'Inactif'); ?>

            </span>
        </div>

        <!-- Actions -->
        <div class="flex space-x-3 pt-4 border-t">
            <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" 
               class="flex-1 px-4 py-2 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] text-center transition-colors">
                <i class="fas fa-edit mr-2"></i>Modifier le produit
            </a>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/admin/products/partials/quick-view.blade.php ENDPATH**/ ?>