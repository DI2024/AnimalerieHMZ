<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                Bonjour, <?php echo e($user->name); ?> 👋
            </h1>
            <p class="text-gray-600">
                Bienvenue sur votre tableau de bord
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Total Orders -->
            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-600 text-2xl">shopping_bag</span>
                    </div>
                    <span class="text-3xl font-bold text-blue-600"><?php echo e($stats['total_orders']); ?></span>
                </div>
                <h3 class="font-semibold text-gray-900">Commandes totales</h3>
                <p class="text-sm text-gray-500 mt-1">Depuis votre inscription</p>
            </div>

            <!-- Pending Orders -->
            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-orange-500 text-2xl">pending</span>
                    </div>
                    <span class="text-3xl font-bold text-orange-500"><?php echo e($stats['pending_orders']); ?></span>
                </div>
                <h3 class="font-semibold text-gray-900">En attente</h3>
                <p class="text-sm text-gray-500 mt-1">Commandes en cours</p>
            </div>

            <!-- Total Spent -->
            <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center">
                        <span class="material-symbols-outlined text-green-500 text-2xl">payments</span>
                    </div>
                    <span class="text-3xl font-bold text-green-500"><?php echo e(number_format($stats['total_spent'], 0, ',', ' ')); ?> MAD</span>
                </div>
                <h3 class="font-semibold text-gray-900">Total dépensé</h3>
                <p class="text-sm text-gray-500 mt-1">Commandes payées</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <a href="<?php echo e(route('products.index')); ?>" class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-xl mb-2">Continuer mes achats</h3>
                        <p class="text-blue-100 text-sm">Découvrez nos produits</p>
                    </div>
                    <span class="material-symbols-outlined text-5xl opacity-50">shopping_cart</span>
                </div>
            </a>

            <a href="<?php echo e(route('orders.index')); ?>" class="bg-gray-800 hover:bg-gray-900 text-white rounded-xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold text-xl mb-2">Mes commandes</h3>
                        <p class="text-gray-300 text-sm">Voir l'historique complet</p>
                    </div>
                    <span class="material-symbols-outlined text-5xl opacity-50">receipt_long</span>
                </div>
            </a>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white rounded-xl p-8 border border-gray-200 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Commandes récentes</h2>
                <a href="<?php echo e(route('orders.index')); ?>" class="text-blue-600 hover:text-blue-700 hover:underline font-semibold text-sm flex items-center gap-1">
                    Voir tout
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

            <?php if($recentOrders->count() > 0): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-sm transition">
                            <div class="flex items-center justify-between mb-3">
                                <div>
                                    <a href="<?php echo e(route('orders.show', $order->order_number)); ?>" class="font-semibold text-blue-600 hover:text-blue-700 hover:underline">
                                        <?php echo e($order->order_number); ?>

                                    </a>
                                    <p class="text-sm text-gray-500">
                                        <?php echo e($order->created_at->format('d/m/Y à H:i')); ?>

                                    </p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-<?php echo e($order->status_color); ?>/10 text-<?php echo e($order->status_color); ?>">
                                        <?php echo e($order->status_label); ?>

                                    </span>
                                    <p class="text-lg font-bold text-gray-900 mt-1"><?php echo e(number_format($order->total, 2, ',', ' ')); ?> MAD</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <span class="material-symbols-outlined text-sm">inventory_2</span>
                                <?php echo e($order->items->count()); ?> article<?php echo e($order->items->count() > 1 ? 's' : ''); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">shopping_bag</span>
                    <p class="text-lg text-gray-600 mb-4">Aucune commande pour le moment</p>
                    <a href="<?php echo e(route('products.index')); ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                        Découvrir nos produits
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/client/dashboard.blade.php ENDPATH**/ ?>