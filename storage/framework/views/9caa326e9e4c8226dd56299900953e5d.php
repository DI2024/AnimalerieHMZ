<?php $__env->startSection('content'); ?>
<?php
    $imageUrl = $product->image_url;
    $discount = $product->discount_percentage ?? 0;
?>

<div class="min-h-screen bg-gradient-to-b from-surface-container-low to-white transition-colors duration-300 pb-20">
    <!-- Breadcrumbs -->
    <div class="max-w-[1280px] mx-auto px-6 py-6">
        <nav class="flex text-sm font-medium text-on-surface-variant/60">
            <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($breadcrumb['url']): ?>
                    <a href="<?php echo e($breadcrumb['url']); ?>" class="hover:text-primary transition"><?php echo e($breadcrumb['name']); ?></a>
                    <span class="mx-2 text-gray-400">/</span>
                <?php else: ?>
                    <?php
                        $words = explode(' ', $breadcrumb['name']);
                        $shortName = count($words) > 3 ? implode(' ', array_slice($words, 0, 3)) . '...' : $breadcrumb['name'];
                    ?>
                    <span class="hidden md:inline text-on-surface"><?php echo e($breadcrumb['name']); ?></span>
                    <span class="inline md:hidden text-on-surface"><?php echo e($shortName); ?></span>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </nav>
    </div>

    <!-- Main Product Section -->
    <div class="max-w-[1280px] mx-auto px-6 grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Left: Gallery -->
        <div class="lg:col-span-6 space-y-4">
            <?php if(!empty($product->gallery) && count($product->gallery) > 0): ?>
                <!-- Gallery Thumbnails (Above Main Image) -->
                <div class="flex flex-wrap gap-2 justify-center mb-2">
                    <div class="w-16 h-16 rounded-xl border-2 border-primary overflow-hidden bg-white cursor-pointer hover:border-primary transition p-1 thumbnail-item active-thumbnail" 
                         onclick="changeMainImage('<?php echo e($imageUrl); ?>', this)">
                        <img src="<?php echo e($imageUrl); ?>" class="w-full h-full object-contain" alt="<?php echo e($product->name); ?>">
                    </div>
                    <?php $__currentLoopData = $product->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galleryImg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $galleryUrl = filter_var($galleryImg, FILTER_VALIDATE_URL) ? $galleryImg : asset('storage/' . $galleryImg);
                        ?>
                        <div class="w-16 h-16 rounded-xl border-2 border-gray-200 overflow-hidden bg-white cursor-pointer hover:border-primary transition p-1 thumbnail-item" 
                             onclick="changeMainImage('<?php echo e($galleryUrl); ?>', this)">
                            <img src="<?php echo e($galleryUrl); ?>" class="w-full h-full object-contain" alt="<?php echo e($product->name); ?>">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <!-- Image principale (Desktop) ou Galerie scroll (Mobile si plusieurs images) -->
            <div class="relative aspect-square rounded-[2.5rem] overflow-hidden bg-white shadow-xl group max-w-[500px] mx-auto">
                <img id="mainImage" 
                     src="<?php echo e($imageUrl); ?>" 
                     alt="<?php echo e($product->name); ?>" 
                     class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-105 p-8"
                     onerror="this.src='https://via.placeholder.com/800x800?text=No+Image'">
                
                <!-- Wishlist Button - Top Right -->
                <button id="likeBtn" class="absolute top-6 right-6 w-12 h-12 bg-white/80 backdrop-blur-md rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition group/like z-10">
                    <span class="material-symbols-outlined text-error transition duration-300" style="font-variation-settings: 'FILL' 0;">favorite</span>
                </button>
            </div>
        </div>

        <!-- Right: Info -->
        <div class="lg:col-span-6 flex flex-col gap-8">
            <div class="space-y-4">
                <h1 class="text-3xl md:text-4xl font-extrabold font-headline leading-tight text-gray-900">
                    <?php echo e($product->name); ?>

                </h1>
                
                <?php if($product->short_description): ?>
                    <p class="text-on-surface-variant">
                        <?php echo e($product->short_description); ?>

                    </p>
                <?php endif; ?>

                <div class="flex items-center gap-2">
                    <div class="flex text-yellow-400">
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <span class="material-symbols-outlined <?php echo e($i <= ($product->rating ?? 5.0) ? 'fill-1' : ''); ?>">star</span>
                        <?php endfor; ?>
                    </div>
                    <span class="text-sm text-on-surface-variant">(<?php echo e(number_format($product->rating ?? 5.0, 1)); ?>/5 - <?php echo e($product->reviews->count()); ?> <?php echo e($product->reviews->count() > 1 ? 'avis' : 'avis'); ?>)</span>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <div class="space-y-1">
                    <span class="text-2xl md:text-4xl font-black text-primary whitespace-nowrap"><?php echo e(number_format($product->price, 2, ',', ' ')); ?> MAD</span>
                    <?php if($product->old_price && $product->old_price > $product->price): ?>
                        <div class="flex items-center gap-2">
                            <span class="text-sm md:text-lg text-on-surface-variant/50 line-through whitespace-nowrap"><?php echo e(number_format($product->old_price, 2, ',', ' ')); ?> MAD</span>
                            <span class="bg-error/10 text-error px-2 py-0.5 rounded-md text-xs font-bold">-<?php echo e($discount); ?>%</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="h-12 w-px bg-gray-200"></div>
                <div class="text-sm font-medium text-on-surface-variant">
                    <?php if($product->stock > 0): ?>
                        <div class="flex items-center gap-2 text-green-600">
                            <span class="material-symbols-outlined text-lg">check_circle</span>
                            En stock (<?php echo e($product->stock); ?>)
                        </div>
                        <p>Livraison estimée : 2-3 jours</p>
                    <?php else: ?>
                        <div class="flex items-center gap-2 text-red-600">
                            <span class="material-symbols-outlined text-lg">cancel</span>
                            Rupture de stock
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-row gap-3 md:gap-4 pt-4">
                <div class="flex items-center bg-surface-container-low rounded-full p-1 border border-gray-200 shrink-0">
                    <button class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center text-lg md:text-xl font-bold hover:bg-white rounded-full transition" onclick="updateQty(-1)">-</button>
                    <span id="qtyDisplay" class="w-8 md:w-12 text-center font-bold text-base md:text-lg">1</span>
                    <button class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center text-lg md:text-xl font-bold hover:bg-white rounded-full transition" onclick="updateQty(1)">+</button>
                </div>
                <button id="addToCartBtn" 
                        data-product-id="<?php echo e($product->id); ?>"
                        <?php echo e($product->stock <= 0 ? 'disabled' : ''); ?>

                        class="flex-1 bg-primary hover:bg-primary-container text-white font-bold py-3 md:py-4 px-4 md:px-8 rounded-full transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1 active:translate-y-0 flex items-center justify-center gap-2 md:gap-3 group disabled:opacity-50 disabled:cursor-not-allowed text-sm md:text-base">
                    <span class="material-symbols-outlined group-hover:animate-bounce text-xl md:text-2xl">shopping_cart</span>
                    <span class="hidden sm:inline"><?php echo e($product->stock > 0 ? 'Ajouter au panier' : 'Rupture de stock'); ?></span>
                    <span class="sm:hidden"><?php echo e($product->stock > 0 ? 'Ajouter' : 'Rupture'); ?></span>
                </button>
            </div>

            <!-- Perks -->
            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary/5 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">local_shipping</span>
                    </div>
                    <span class="text-xs font-bold leading-tight">Livraison Gratuite</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-secondary/5 flex items-center justify-center text-secondary">
                        <span class="material-symbols-outlined">verified</span>
                    </div>
                    <span class="text-xs font-bold leading-tight">Garantie 2 ans HMZ</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs Section -->
    <div class="max-w-[1280px] mx-auto px-6 mt-24">
        <div class="flex gap-10 border-b border-gray-200 mb-10 overflow-x-auto hide-scrollbar">
            <button class="tab-btn active pb-4 text-lg font-bold border-b-2 border-primary transition relative group" onclick="switchTab('description', this)">
                Description
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-primary rounded-full scale-100 transition"></div>
            </button>

            <button class="tab-btn pb-4 text-lg font-bold text-on-surface-variant border-b-2 border-transparent hover:text-primary transition relative group" onclick="switchTab('reviews', this)">
                Avis Clients (<?php echo e($product->reviews->count()); ?>)
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-primary rounded-full scale-0 group-hover:scale-50 transition"></div>
            </button>
        </div>

        <div id="tabContent" class="min-h-[300px]">
            <div id="description" class="tab-pane animate-in fade-in slide-in-from-bottom-4 duration-500">
                <div class="prose max-w-none">
                    <?php if($product->description): ?>
                        <?php echo nl2br(e($product->description)); ?>

                    <?php else: ?>
                        <p class="text-on-surface-variant">Aucune description disponible pour ce produit.</p>
                    <?php endif; ?>
                </div>
                
                <?php if($product->sku): ?>
                    <div class="mt-8 p-6 bg-surface-container-low rounded-2xl border border-gray-200">
                        <h3 class="text-lg font-bold mb-4">Informations produit</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="font-bold text-on-surface-variant text-sm">SKU</span>
                                <span class="text-sm"><?php echo e($product->sku); ?></span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-200">
                                <span class="font-bold text-on-surface-variant text-sm">Catégorie</span>
                                <span class="text-sm"><?php echo e($product->category->name); ?></span>
                            </div>
                            <?php if($product->subcategory): ?>
                                <div class="flex justify-between py-2">
                                    <span class="font-bold text-on-surface-variant text-sm">Sous-catégorie</span>
                                    <span class="text-sm"><?php echo e($product->subcategory->name); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div id="reviews" class="tab-pane hidden animate-in fade-in slide-in-from-bottom-4 duration-500">
                <?php
                    $approvedReviews = $product->reviews;
                    $totalReviewsCount = $approvedReviews->count();
                    
                    $starsCount = [
                        5 => 0,
                        4 => 0,
                        3 => 0,
                        2 => 0,
                        1 => 0
                    ];
                    
                    foreach ($approvedReviews as $rev) {
                        $starsCount[$rev->rating] = ($starsCount[$rev->rating] ?? 0) + 1;
                    }
                ?>
                <div class="flex flex-col gap-8">
                    <div class="bg-surface-container-low p-8 rounded-3xl flex flex-col md:flex-row items-center gap-10 shadow-sm border border-gray-100">
                        <div class="text-center">
                            <div class="text-6xl font-black text-primary"><?php echo e(number_format($product->rating ?? 5.0, 1)); ?></div>
                            <div class="flex text-amber-400 mt-2 justify-center">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <span class="material-symbols-outlined <?php echo e($i <= ($product->rating ?? 5) ? 'fill-1' : ''); ?>">star</span>
                                <?php endfor; ?>
                            </div>
                            <div class="text-sm font-bold text-on-surface-variant/60 mt-2">
                                Basé sur <?php echo e($totalReviewsCount); ?> <?php echo e($totalReviewsCount > 1 ? 'avis' : 'avis'); ?>

                            </div>
                        </div>
                        
                        <div class="flex-1 space-y-3 w-full">
                            <?php for($star = 5; $star >= 1; $star--): ?>
                                <?php
                                    $count = $starsCount[$star];
                                    $pct = $totalReviewsCount > 0 ? ($count / $totalReviewsCount) * 100 : 0;
                                ?>
                                <div class="flex items-center gap-4">
                                    <span class="w-4 text-xs font-bold text-gray-700"><?php echo e($star); ?></span>
                                    <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-primary rounded-full" style="width: <?php echo e($pct); ?>%"></div>
                                    </div>
                                    <span class="w-8 text-xs text-right text-on-surface-variant/60 font-bold"><?php echo e($count); ?></span>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>

                    <!-- Individual Reviews List -->
                    <div class="space-y-6">
                        <?php $__empty_1 = true; $__currentLoopData = $approvedReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="p-6 rounded-2xl border border-gray-100 hover:shadow-md transition bg-white">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-[#003e87]/10 flex items-center justify-center font-bold text-[#003e87]">
                                            <?php echo e(strtoupper(substr($review->user->name, 0, 2))); ?>

                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900"><?php echo e($review->user->name); ?></div>
                                            <div class="text-xs text-on-surface-variant/60">Acheteur vérifié • <?php echo e($review->created_at->diffForHumans()); ?></div>
                                        </div>
                                    </div>
                                    <div class="flex text-amber-400">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <span class="material-symbols-outlined text-sm <?php echo e($i <= $review->rating ? 'fill-1' : ''); ?>">star</span>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-sm whitespace-pre-line leading-relaxed"><?php echo e($review->comment); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="text-center py-12 text-on-surface-variant/60 bg-surface-container-low rounded-2xl border border-dashed border-gray-200">
                                <span class="material-symbols-outlined text-4xl mb-2 text-gray-400">rate_review</span>
                                <p class="text-sm font-medium">Aucun avis pour le moment. Soyez le premier à donner votre avis après votre achat !</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <?php if($relatedProducts->count() > 0): ?>
        <div class="max-w-[1280px] mx-auto px-6 mt-16">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold font-headline">Articles Similaires</h2>
                    <p class="text-on-surface-variant/60 mt-2">D'autres produits qui pourraient vous plaire</p>
                </div>
                <a href="<?php echo e(route('products.index', ['category' => $product->category->slug])); ?>" class="flex items-center gap-2 font-bold text-primary hover:gap-4 transition-all">
                    Voir tout <span class="material-symbols-outlined">arrow_forward</span>
                </a>
            </div>

            <!-- Mobile: Scroll horizontal avec 1 produit visible -->
            <!-- Desktop: Grid 4 colonnes -->
            <div class="related-products-scroll grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php $__currentLoopData = $relatedProducts->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $relatedImageUrl = $related->image && str_starts_with($related->image, 'http') 
                            ? $related->image 
                            : asset($related->image);
                    ?>
                    
                    <div class="related-product-card group relative bg-white rounded-[2rem] p-4 shadow-md hover:shadow-2xl transition duration-500 border border-gray-200">
                        <a href="<?php echo e(route('products.show', $related->slug)); ?>">
                            <div class="aspect-square rounded-[1.5rem] overflow-hidden mb-4 relative bg-gradient-to-br from-gray-50 to-gray-100">
                                <img src="<?php echo e($relatedImageUrl); ?>" 
                                     class="w-full h-full object-contain p-4"
                                     onerror="this.src='<?php echo e(asset('images/placeholder.svg')); ?>'">
                            </div>
                            <h3 class="font-bold text-base px-2 line-clamp-2"><?php echo e($related->name); ?></h3>
                            <p class="text-on-surface-variant/60 text-sm px-2 mb-4"><?php echo e($related->category->name); ?></p>
                            <div class="flex justify-between items-center px-2">
                                <span class="text-xl font-black text-primary"><?php echo e(number_format($related->price, 2, ',', ' ')); ?> MAD</span>
                                <button class="w-10 h-10 rounded-full bg-primary/5 text-primary hover:bg-primary hover:text-white transition-colors flex items-center justify-center product-add-btn" data-product-id="<?php echo e($related->id); ?>">
                                    <span class="material-symbols-outlined">add_shopping_cart</span>
                                </button>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <!-- Indicateurs (dots) pour mobile uniquement -->
            <div class="related-products-indicators md:hidden"></div>
        </div>
    <?php endif; ?>
</div>

<style>
    .tab-pane.hidden { display: none; }
    .fill-1 { font-variation-settings: 'FILL' 1; }
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-in { animation: slideIn 0.5s ease forwards; }
    .thumbnail-item {
        transition: all 0.2s ease;
    }
    .thumbnail-item.active-thumbnail {
        border-color: var(--md-sys-color-primary, #003e87);
        transform: scale(1.05);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
</style>

<script>
    let currentQty = 1;
    const maxStock = <?php echo e($product->stock); ?>;

    function updateQty(delta) {
        currentQty += delta;
        if (currentQty < 1) currentQty = 1;
        if (currentQty > maxStock) currentQty = maxStock;
        document.getElementById('qtyDisplay').textContent = currentQty;
    }

    function changeMainImage(url, element) {
        const mainImage = document.getElementById('mainImage');
        if (mainImage) {
            mainImage.src = url;
        }
        
        // Remove active classes
        document.querySelectorAll('.thumbnail-item').forEach(el => {
            el.classList.remove('border-primary', 'active-thumbnail');
            el.classList.add('border-gray-200');
        });
        
        // Add active classes
        element.classList.add('border-primary', 'active-thumbnail');
        element.classList.remove('border-gray-200');
    }

    function switchTab(id, btn) {
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.add('hidden'));
        document.getElementById(id).classList.remove('hidden');
        
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('active', 'border-primary');
            b.classList.add('text-on-surface-variant', 'border-transparent');
            b.querySelector('div').classList.remove('scale-100');
            b.querySelector('div').classList.add('scale-0');
        });
        
        btn.classList.add('active', 'border-primary');
        btn.classList.remove('text-on-surface-variant', 'border-transparent');
        btn.querySelector('div').classList.remove('scale-0');
        btn.querySelector('div').classList.add('scale-100');
    }

    document.getElementById('likeBtn').addEventListener('click', function() {
        const icon = this.querySelector('.material-symbols-outlined');
        const isFilled = icon.style.fontVariationSettings.includes("'FILL' 1");
        icon.style.fontVariationSettings = isFilled ? "'FILL' 0" : "'FILL' 1";
        if (!isFilled) {
            icon.classList.add('scale-150', 'text-error');
            setTimeout(() => icon.classList.remove('scale-150'), 300);
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/client/products/show.blade.php ENDPATH**/ ?>