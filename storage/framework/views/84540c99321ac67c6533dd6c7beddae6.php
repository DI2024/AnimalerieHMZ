<div class="list-view-item">
    <!-- Image -->
    <div class="w-12 h-12 bg-gray-100 rounded mr-4 overflow-hidden flex-shrink-0">
        <?php if($product->image): ?>
            <?php if(filter_var($product->image, FILTER_VALIDATE_URL)): ?>
                <img src="<?php echo e($product->image); ?>" 
                     alt="<?php echo e($product->name); ?>" 
                     class="w-full h-full object-cover"
                     onerror="this.src='<?php echo e(asset('images/placeholder-product.svg')); ?>'; this.onerror=null;">
            <?php else: ?>
                <img src="<?php echo e(asset('storage/' . $product->image)); ?>" 
                     alt="<?php echo e($product->name); ?>" 
                     class="w-full h-full object-cover"
                     onerror="this.src='<?php echo e(asset('images/placeholder-product.svg')); ?>'; this.onerror=null;">
            <?php endif; ?>
        <?php else: ?>
            <div class="w-full h-full flex items-center justify-center text-gray-400">
                <i class="fas fa-image"></i>
            </div>
        <?php endif; ?>
    </div>

    <!-- Info -->
    <div class="flex-1 min-w-0">
        <div class="flex items-center space-x-2">
            <h4 class="font-medium text-gray-900 truncate"><?php echo e($product->name); ?></h4>
            <?php if($product->is_new): ?>
                <span class="text-xs px-2 py-0.5 rounded bg-green-100 text-green-800">NEW</span>
            <?php endif; ?>
            <?php if($product->is_bestseller): ?>
                <span class="text-xs px-2 py-0.5 rounded bg-[#003e87] text-white">BEST</span>
            <?php endif; ?>
            <?php if($product->is_featured): ?>
                <span class="text-xs px-2 py-0.5 rounded bg-blue-100 text-blue-800">FEAT</span>
            <?php endif; ?>
        </div>
        <div class="flex items-center space-x-4 text-sm text-gray-600 mt-1">
            <span><?php echo e($product->category->name ?? 'N/A'); ?></span>
            <span>•</span>
            <span class="font-medium text-[#003e87]"><?php echo e(number_format($product->price, 2)); ?> DH</span>
            <span>•</span>
            <span class="<?php echo e($product->stock == 0 ? 'text-red-600' : ($product->stock < 10 ? 'text-orange-600' : 'text-green-600')); ?>">
                Stock: <?php echo e($product->stock); ?>

            </span>
        </div>
    </div>

    <!-- Status Display -->
    <span class="px-3 py-1 rounded-full text-xs font-medium <?php echo e($product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'); ?> mr-4">
        <?php echo e($product->is_active ? 'Actif' : 'Inactif'); ?>

    </span>

    <!-- Actions -->
    <div class="flex items-center space-x-2">
        <button onclick="quickView(<?php echo e($product->id); ?>)" class="p-2 text-blue-600 hover:bg-blue-50 rounded" title="Aperçu">
            <i class="fas fa-eye"></i>
        </button>
        <a href="<?php echo e(route('admin.products.edit', $product->id)); ?>" class="p-2 text-green-600 hover:bg-green-50 rounded" title="Modifier">
            <i class="fas fa-edit"></i>
        </a>
        <button onclick="deleteProduct(<?php echo e($product->id); ?>)" class="p-2 text-red-600 hover:bg-red-50 rounded" title="Supprimer">
            <i class="fas fa-trash"></i>
        </button>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\temp-laravel\AnimalerieHMZ\resources\views/admin/products/partials/list.blade.php ENDPATH**/ ?>