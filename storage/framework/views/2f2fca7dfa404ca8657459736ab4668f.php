<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-blue-50 py-12">
    <div class="max-w-[800px] mx-auto px-6">
        
        <!-- Success Icon -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-green-500 rounded-full mb-6 animate-bounce">
                <span class="material-symbols-outlined text-white text-5xl">check_circle</span>
            </div>
            <h1 class="text-4xl font-extrabold font-headline text-gray-900 mb-3">
                Commande confirmée !
            </h1>
            <p class="text-lg text-gray-600">
                Merci pour votre confiance
            </p>
        </div>

        <!-- Order Info Card -->
        <div class="bg-white rounded-3xl p-8 shadow-2xl border border-gray-200 mb-8">
            <div class="flex items-center justify-between mb-6 pb-6 border-b border-gray-200">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Numéro de commande</p>
                    <p class="text-2xl font-bold text-blue-600"><?php echo e($order->order_number); ?></p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600 mb-1">Date</p>
                    <p class="font-bold text-gray-900"><?php echo e($order->created_at->format('d/m/Y H:i')); ?></p>
                </div>
            </div>

            <!-- Order Items -->
            <div class="space-y-4 mb-6">
                <h3 class="font-bold text-lg text-gray-900">Articles commandés</h3>
                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $imageUrl = $item->product_image && str_starts_with($item->product_image, 'http') 
                            ? $item->product_image 
                            : asset($item->product_image);
                    ?>
                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <img src="<?php echo e($imageUrl); ?>" 
                             alt="<?php echo e($item->product_name); ?>" 
                             class="w-16 h-16 object-contain rounded-lg"
                             onerror="this.src='<?php echo e(asset('images/placeholder.svg')); ?>'">
                        <div class="flex-1">
                            <h4 class="font-bold text-gray-900"><?php echo e($item->product_name); ?></h4>
                            <p class="text-sm text-gray-600">Quantité: <?php echo e($item->quantity); ?></p>
                        </div>
                        <p class="font-bold text-blue-600"><?php echo e(number_format($item->subtotal, 2, ',', ' ')); ?> MAD</p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Totals -->
            <div class="space-y-2 pt-6 border-t border-gray-200">
                <div class="flex justify-between text-gray-700">
                    <span>Sous-total</span>
                    <span><?php echo e(number_format($order->subtotal, 2, ',', ' ')); ?> MAD</span>
                </div>
                <?php if($order->discount > 0): ?>
                    <div class="flex justify-between text-green-600">
                        <span>Réduction</span>
                        <span>-<?php echo e(number_format($order->discount, 2, ',', ' ')); ?> MAD</span>
                    </div>
                <?php endif; ?>
                <div class="flex justify-between text-gray-700">
                    <span>Frais de livraison</span>
                    <?php if($order->shipping_cost == 0): ?>
                        <span class="text-green-500 font-bold">Gratuit</span>
                    <?php else: ?>
                        <span><?php echo e(number_format($order->shipping_cost, 2, ',', ' ')); ?> MAD</span>
                    <?php endif; ?>
                </div>
                <div class="flex justify-between text-gray-700">
                    <span>TVA</span>
                    <span><?php echo e(number_format($order->tax, 2, ',', ' ')); ?> MAD</span>
                </div>
                <div class="flex justify-between items-center pt-4 text-xl font-bold">
                    <span class="text-gray-900">Total</span>
                    <span class="text-blue-600"><?php echo e(number_format($order->total, 2, ',', ' ')); ?> MAD</span>
                </div>
            </div>
        </div>

        <!-- Delivery Info -->
        <div class="bg-white rounded-3xl p-8 shadow-2xl border border-gray-200 mb-8">
            <h3 class="font-bold text-lg mb-4 text-gray-900 flex items-center gap-2">
                <span class="material-symbols-outlined text-blue-600">local_shipping</span>
                Adresse de livraison
            </h3>
            <div class="text-gray-700">
                <p class="font-bold text-gray-900"><?php echo e($order->shipping_name); ?></p>
                <p><?php echo e($order->shipping_address_line_1); ?></p>
                <?php if($order->shipping_address_line_2): ?>
                    <p><?php echo e($order->shipping_address_line_2); ?></p>
                <?php endif; ?>
                <p><?php echo e($order->shipping_postal_code); ?> <?php echo e($order->shipping_city); ?></p>
                <p><?php echo e($order->shipping_country); ?></p>
                <p class="mt-2">
                    <span class="material-symbols-outlined text-sm align-middle">phone</span>
                    <?php echo e($order->shipping_phone); ?>

                </p>
                <p>
                    <span class="material-symbols-outlined text-sm align-middle">email</span>
                    <?php echo e($order->shipping_email); ?>

                </p>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="bg-blue-50 rounded-3xl p-8 border border-blue-200 mb-8">
            <h3 class="font-bold text-lg mb-4 text-blue-900 flex items-center gap-2">
                <span class="material-symbols-outlined">info</span>
                Prochaines étapes
            </h3>
            <ul class="space-y-3 text-blue-900">
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-sm mt-0.5">check</span>
                    <span>Vous recevrez un email de confirmation à <strong><?php echo e($order->shipping_email); ?></strong></span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-sm mt-0.5">check</span>
                    <span>Notre équipe prépare votre commande</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-sm mt-0.5">check</span>
                    <span>Livraison estimée: 2-3 jours ouvrés</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="material-symbols-outlined text-sm mt-0.5">check</span>
                    <span>Paiement à la livraison (espèces ou carte)</span>
                </li>
            </ul>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="<?php echo e(route('home')); ?>" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-full transition text-center flex items-center justify-center gap-2">
                <span class="material-symbols-outlined">home</span>
                Retour à l'accueil
            </a>
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('orders.show', $order->order_number)); ?>" class="flex-1 bg-white hover:bg-gray-50 text-blue-600 border-2 border-blue-600 font-bold py-4 px-6 rounded-full transition text-center flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">receipt_long</span>
                    Voir ma commande
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    .animate-bounce {
        animation: bounce 1s ease-in-out 3;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/checkout-confirmation.blade.php ENDPATH**/ ?>