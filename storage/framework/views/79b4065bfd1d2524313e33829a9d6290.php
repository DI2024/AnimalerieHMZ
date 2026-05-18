<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                    Mes Commandes
                </h1>
                <p class="text-gray-600">
                    <?php echo e($orders->total()); ?> commande<?php echo e($orders->total() > 1 ? 's' : ''); ?>

                </p>
            </div>
            <a href="<?php echo e(route('home')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition flex items-center gap-2">
                <span class="material-symbols-outlined">arrow_back</span>
                Retour
            </a>
        </div>

        <?php if($orders->count() > 0): ?>
            <div class="space-y-6">
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition">
                        <!-- Order Header -->
                        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 pb-6 border-b border-gray-200">
                            <div>
                                <a href="<?php echo e(route('orders.show', $order->order_number)); ?>" class="text-2xl font-bold text-blue-600 hover:text-blue-700 hover:underline">
                                    <?php echo e($order->order_number); ?>

                                </a>
                                <p class="text-sm text-gray-500 mt-1">
                                    Commandé le <?php echo e($order->created_at->format('d/m/Y à H:i')); ?>

                                </p>
                            </div>
                            <div class="flex items-center gap-4 mt-4 md:mt-0">
                                <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-<?php echo e($order->status_color); ?>/10 text-<?php echo e($order->status_color); ?>">
                                    <?php echo e($order->status_label); ?>

                                </span>
                                <span class="text-2xl font-bold text-gray-900"><?php echo e(number_format($order->total, 2, ',', ' ')); ?> MAD</span>
                            </div>
                        </div>

                        <!-- Order Items Preview -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <?php $__currentLoopData = $order->items->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $imageUrl = $item->product_image && str_starts_with($item->product_image, 'http') 
                                        ? $item->product_image 
                                        : asset($item->product_image);
                                ?>
                                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg">
                                    <img src="<?php echo e($imageUrl); ?>" 
                                         alt="<?php echo e($item->product_name); ?>" 
                                         class="w-16 h-16 object-contain rounded-lg"
                                         onerror="this.src='https://via.placeholder.com/100x100?text=No+Image'">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-sm text-gray-900 line-clamp-1"><?php echo e($item->product_name); ?></h4>
                                        <p class="text-xs text-gray-500">Qté: <?php echo e($item->quantity); ?></p>
                                    </div>
                                    <p class="font-semibold text-gray-900 text-sm"><?php echo e(number_format($item->subtotal, 2, ',', ' ')); ?> MAD</p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <?php if($order->items->count() > 2): ?>
                            <p class="text-sm text-gray-500 mb-4">
                                + <?php echo e($order->items->count() - 2); ?> autre<?php echo e($order->items->count() - 2 > 1 ? 's' : ''); ?> article<?php echo e($order->items->count() - 2 > 1 ? 's' : ''); ?>

                            </p>
                        <?php endif; ?>

                        <!-- Order Info -->
                        <div class="flex flex-col md:flex-row gap-4 text-sm">
                            <div class="flex items-center gap-2 text-gray-600">
                                <span class="material-symbols-outlined text-sm">local_shipping</span>
                                <span><?php echo e($order->shipping_city); ?>, <?php echo e($order->shipping_country); ?></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <span class="material-symbols-outlined text-sm">payments</span>
                                <span><?php echo e(ucfirst(str_replace('_', ' ', $order->payment_method))); ?></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <span class="material-symbols-outlined text-sm">inventory_2</span>
                                <span><?php echo e($order->items->count()); ?> article<?php echo e($order->items->count() > 1 ? 's' : ''); ?></span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3 mt-6 pt-6 border-t border-gray-200">
                            <a href="<?php echo e(route('orders.show', $order->order_number)); ?>" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition text-center flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-sm">visibility</span>
                                Voir les détails
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                <?php echo e($orders->links()); ?>

            </div>
        <?php else: ?>
            <div class="bg-white rounded-xl p-12 text-center border border-gray-200">
                <span class="material-symbols-outlined text-8xl text-gray-300 mb-4">shopping_bag</span>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Aucune commande</h3>
                <p class="text-gray-600 mb-6">Vous n'avez pas encore passé de commande</p>
                <a href="<?php echo e(route('products.index')); ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-8 rounded-lg transition">
                    Découvrir nos produits
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\temp-laravel\AnimalerieHMZ\resources\views/client/orders/index.blade.php ENDPATH**/ ?>