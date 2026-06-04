<?php $__env->startSection('content'); ?>
<?php
    $imageUrl = $offer->image 
        ? (filter_var($offer->image, FILTER_VALIDATE_URL) ? $offer->image : asset('storage/' . $offer->image))
        : null;
?>

<div class="min-h-screen bg-gradient-to-b from-blue-50 via-white to-white transition-colors duration-300 pb-20">
    <!-- Breadcrumbs -->
    <div class="max-w-[1280px] mx-auto px-6 py-6">
        <nav class="flex text-sm font-medium text-on-surface-variant/60">
            <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($breadcrumb['url']): ?>
                    <a href="<?php echo e($breadcrumb['url']); ?>" class="hover:text-primary transition"><?php echo e($breadcrumb['name']); ?></a>
                    <span class="mx-2 text-gray-400">/</span>
                <?php else: ?>
                    <span class="text-on-surface font-bold"><?php echo e($breadcrumb['name']); ?></span>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>
    </div>

    <!-- Offer Header Banner -->
    <div class="max-w-[1280px] mx-auto px-6 mb-12">
        <div class="relative rounded-[2rem] overflow-hidden bg-gradient-to-br from-primary/90 to-primary-container p-8 md:p-12 text-white shadow-xl flex flex-col md:flex-row items-center justify-between gap-8 min-h-[220px]">
            <?php if($offer->bg_color): ?>
                <!-- Custom background fallback if needed, but the gradient is already extremely premium -->
                <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-color: <?php echo e($offer->bg_color); ?>"></div>
            <?php endif; ?>
            
            <div class="space-y-4 relative z-10 flex-1">
                <?php if($offer->badge): ?>
                    <span class="inline-block bg-white/20 backdrop-blur-md text-white text-xs font-bold px-3 py-1 rounded-full border border-white/10 uppercase tracking-wider"><?php echo e($offer->badge); ?></span>
                <?php endif; ?>
                <h1 class="text-3xl md:text-5xl font-black font-headline tracking-tight leading-tight">
                    <?php echo e($offer->title); ?>

                </h1>
                <?php if($offer->subtitle): ?>
                    <p class="text-lg text-white/80 max-w-2xl font-medium">
                        <?php echo e($offer->subtitle); ?>

                    </p>
                <?php endif; ?>
                <div class="text-xs text-white/60 font-bold uppercase tracking-widest pt-2">
                    <?php echo e($offer->products->count()); ?> produit<?php echo e($offer->products->count() > 1 ? 's associés' : ' associé'); ?> à cette offre
                </div>
            </div>

            <?php if($imageUrl): ?>
                <div class="w-48 h-48 md:w-56 md:h-56 relative z-10 flex-shrink-0 bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20 shadow-2xl overflow-hidden flex items-center justify-center">
                    <img src="<?php echo e($imageUrl); ?>" alt="<?php echo e($offer->title); ?>" class="w-full h-full object-contain filter drop-shadow-md">
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="max-w-[1280px] mx-auto px-6">
        <h2 class="text-2xl md:text-3xl font-extrabold font-headline mb-8 text-primary flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">local_offer</span>
            Découvrir les offres
        </h2>

        <?php if($offer->products->count() > 0): ?>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php $__currentLoopData = $offer->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $prodUrl = route('products.show', $product->slug);
                        $prodImg = $product->image_url;
                        $discount = $product->discount_percentage ?? 0;
                    ?>
                    <article class="bg-white border border-gray-200 rounded-3xl p-4 flex flex-col h-full transition duration-300 hover:shadow-xl group relative overflow-hidden">
                        <a href="<?php echo e($prodUrl); ?>" class="block">
                            <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl overflow-hidden aspect-square flex items-center justify-center p-3 mb-4">
                                <?php if($discount > 0): ?>
                                    <span class="absolute top-3 left-3 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">-<?php echo e($discount); ?>%</span>
                                <?php endif; ?>
                                <?php if($product->is_new): ?>
                                    <span class="absolute top-3 right-3 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">Nouveau</span>
                                <?php endif; ?>
                                <img src="<?php echo e($prodImg); ?>" 
                                     alt="<?php echo e($product->name); ?>" 
                                     class="w-full h-full object-contain group-hover:scale-105 transition duration-300" 
                                     loading="lazy"
                                     onerror="this.src='<?php echo e(asset('images/placeholder.svg')); ?>'">
                            </div>
                            <div class="flex-grow flex flex-col">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-primary mb-1">
                                    <?php echo e($product->category->name ?? 'Produit'); ?>

                                </span>
                                <h3 class="text-xs lg:text-sm font-bold mb-2 leading-tight text-gray-900 line-clamp-2 min-h-[36px] lg:min-h-[40px]">
                                    <?php echo e($product->name); ?>

                                </h3>
                                <?php if($product->rating): ?>
                                    <div class="flex gap-0.5 mb-3 text-yellow-400 text-xs">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' <?php echo e($i <= $product->rating ? 1 : 0); ?>;">star</span>
                                        <?php endfor; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </a>
                        <div class="flex justify-between items-center mt-auto pt-3 border-t border-gray-100">
                            <div class="flex flex-col">
                                <span class="font-headline text-base lg:text-lg font-bold text-primary"><?php echo e(number_format($product->price, 2, ',', ' ')); ?> MAD</span>
                                <?php if($product->old_price && $product->old_price > $product->price): ?>
                                    <span class="text-xs text-gray-400 line-through"><?php echo e(number_format($product->old_price, 2, ',', ' ')); ?> MAD</span>
                                <?php endif; ?>
                            </div>
                            <button class="bg-primary text-white p-2.5 rounded-xl flex items-center justify-center transition hover:bg-primary-container hover:scale-110 shadow-md product-add-btn" 
                                    data-product-id="<?php echo e($product->id); ?>" 
                                    aria-label="Ajouter au panier">
                                <span class="material-symbols-outlined text-sm lg:text-base">shopping_cart</span>
                            </button>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="text-center py-16 bg-white rounded-2xl border border-gray-200">
                <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">search_off</span>
                <p class="text-lg text-on-surface-variant mb-2">Aucun produit associé à cette offre pour le moment.</p>
                <a href="<?php echo e(route('products.index')); ?>" class="inline-block mt-4 bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-container transition font-bold">Retour aux produits</a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/client/offers/show.blade.php ENDPATH**/ ?>