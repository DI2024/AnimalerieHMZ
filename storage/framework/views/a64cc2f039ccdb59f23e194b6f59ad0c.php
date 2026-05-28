<table class="w-full">
    <thead class="bg-gray-50 sticky top-0">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Catégorie</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Badges</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr class="hover:bg-gray-50 transition-colors cursor-pointer">
            <td class="px-6 py-4">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                        <?php if($product->image): ?>
                            <?php
                                // Déterminer l'URL de l'image
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
                            ?>
                            <img src="<?php echo e($imageUrl); ?>" 
                                 alt="<?php echo e($product->name); ?>" 
                                 class="w-full h-full object-cover"
                                 onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23f3f4f6%22 width=%22100%22 height=%22100%22/%3E%3Ctext fill=%22%239ca3af%22 font-family=%22sans-serif%22 font-size=%2212%22 dy=%2210.5%22 x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22%3ENo img%3C/text%3E%3C/svg%3E';">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <i class="fas fa-image text-2xl"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900"><?php echo e($product->name); ?></p>
                        <?php if($product->sku): ?>
                            <p class="text-xs text-gray-500">SKU: <?php echo e($product->sku); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 text-sm text-gray-700 hidden md:table-cell">
                <?php echo e($product->category->name ?? 'N/A'); ?>

                <?php if($product->subcategory): ?>
                    <br><span class="text-xs text-gray-500"><?php echo e($product->subcategory->name); ?></span>
                <?php endif; ?>
            </td>
            <td class="px-6 py-4">
                <p class="text-sm font-bold text-gray-900"><?php echo e(number_format($product->price, 2)); ?> DH</p>
                <?php if($product->price_old && $product->price_old > $product->price): ?>
                    <p class="text-xs text-gray-400 line-through"><?php echo e(number_format($product->price_old, 2)); ?> DH</p>
                <?php endif; ?>
            </td>
            <td class="px-6 py-4">
                <span class="text-sm font-medium <?php echo e($product->stock == 0 ? 'text-red-600' : ($product->stock < 10 ? 'text-orange-600' : 'text-green-600')); ?>">
                    <?php echo e($product->stock); ?> unités
                </span>
            </td>
            <td class="px-6 py-4 hidden md:table-cell">
                <div class="flex flex-wrap gap-1">
                    <?php if($product->is_new): ?>
                        <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded-full text-xs font-medium">NEW</span>
                    <?php endif; ?>
                    <?php if($product->is_bestseller): ?>
                        <span class="px-2 py-0.5 bg-[#003e87] text-white rounded-full text-xs font-medium">BEST</span>
                    <?php endif; ?>
                    <?php if($product->is_featured): ?>
                        <span class="px-2 py-0.5 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">FEAT</span>
                    <?php endif; ?>
                </div>
            </td>
            <td class="px-6 py-4">
                <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo e($product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'); ?>">
                    <?php echo e($product->is_active ? 'Actif' : 'Inactif'); ?>

                </span>
            </td>
            <td class="px-6 py-4 text-sm hidden md:table-cell">
                <div class="flex items-center space-x-2">
                    <button onclick="quickView(<?php echo e($product->id); ?>)" class="text-blue-600 hover:text-blue-800" title="Aperçu">
                        <i class="fas fa-eye"></i>
                    </button>
                    <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="text-green-600 hover:text-green-800" title="Modifier">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button onclick="deleteProduct(<?php echo e($product->id); ?>)" class="text-red-600 hover:text-red-800" title="Supprimer">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
            <td colspan="7" class="px-6 py-12 text-center">
                <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Aucun produit trouvé</p>
            </td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>
<?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/admin/products/partials/table.blade.php ENDPATH**/ ?>