<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-b from-surface-container-low to-white py-8">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold font-headline text-primary mb-2">
                Nos Produits
            </h1>
            <p class="text-on-surface-variant">
                <?php echo e($products->total()); ?> produit<?php echo e($products->total() > 1 ? 's' : ''); ?> disponible<?php echo e($products->total() > 1 ? 's' : ''); ?>

            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Sidebar Filters -->
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-md sticky top-6">
                    <h3 class="font-bold text-lg mb-4 text-primary">Filtres</h3>
                    
                    <form method="GET" action="<?php echo e(route('products.index')); ?>" class="space-y-6">
                        
                        <!-- Categories -->
                        <div>
                            <h4 class="font-bold text-sm mb-3 text-gray-900">Catégories</h4>
                            <div class="space-y-2">
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                    <input type="radio" name="category" value="" <?php echo e(!request('category') ? 'checked' : ''); ?> class="rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="ml-2 text-sm text-gray-700">Toutes</span>
                                </label>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                    <input type="radio" name="category" value="<?php echo e($category->slug); ?>" <?php echo e(request('category') == $category->slug ? 'checked' : ''); ?> class="rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="ml-2 text-sm text-gray-700"><?php echo e($category->name); ?> <span class="text-gray-400">(<?php echo e($category->products_count); ?>)</span></span>
                                </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <!-- Price Range - Accordion -->
                        <div class="border-b border-gray-200">
                            <button type="button" onclick="toggleAccordion('priceAccordion')" class="w-full flex items-center justify-between py-3 text-left">
                                <h4 class="font-bold text-sm text-gray-900">Prix</h4>
                                <span class="material-symbols-outlined text-gray-500 transition-transform duration-300" id="priceAccordionIcon">expand_more</span>
                            </button>
                            <div id="priceAccordion" class="space-y-2 pb-4 overflow-hidden transition-all duration-300">
                                <input type="number" name="min_price" placeholder="Prix minimum" value="<?php echo e(request('min_price')); ?>" class="w-full px-3 py-2 rounded-lg border border-gray-300 bg-white text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                                <input type="number" name="max_price" placeholder="Prix maximum" value="<?php echo e(request('max_price')); ?>" class="w-full px-3 py-2 rounded-lg border border-gray-300 bg-white text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                            </div>
                        </div>

                        <!-- Flags - Accordion -->
                        <div class="border-b border-gray-200">
                            <button type="button" onclick="toggleAccordion('optionsAccordion')" class="w-full flex items-center justify-between py-3 text-left">
                                <h4 class="font-bold text-sm text-gray-900">Options</h4>
                                <span class="material-symbols-outlined text-gray-500 transition-transform duration-300" id="optionsAccordionIcon">expand_more</span>
                            </button>
                            <div id="optionsAccordion" class="space-y-2 pb-4 overflow-hidden transition-all duration-300">
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                    <input type="checkbox" name="is_new" value="1" <?php echo e(request('is_new') ? 'checked' : ''); ?> class="rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="ml-2 text-sm text-gray-700">Nouveautés</span>
                                </label>
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                    <input type="checkbox" name="is_bestseller" value="1" <?php echo e(request('is_bestseller') ? 'checked' : ''); ?> class="rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="ml-2 text-gray-700">Best Sellers</span>
                                </label>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="space-y-2">
                            <button type="submit" class="w-full bg-primary hover:bg-primary-container text-white font-bold py-3 px-4 rounded-xl transition shadow-md hover:shadow-lg">
                                Appliquer les filtres
                            </button>
                            <a href="<?php echo e(route('products.index')); ?>" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 px-4 rounded-xl transition">
                                Réinitialiser
                            </a>
                        </div>
                    </form>
                </div>
            </aside>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                
                <!-- Sorting -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                    <p class="text-sm text-on-surface-variant">
                        Affichage de <span class="font-bold text-primary"><?php echo e($products->firstItem() ?? 0); ?></span> à <span class="font-bold text-primary"><?php echo e($products->lastItem() ?? 0); ?></span> sur <span class="font-bold text-primary"><?php echo e($products->total()); ?></span> produits
                    </p>
                    <form method="GET" action="<?php echo e(route('products.index')); ?>" class="flex items-center gap-2">
                        <?php $__currentLoopData = request()->except('sort'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <label class="text-sm text-gray-600 whitespace-nowrap">Trier par:</label>
                        <select name="sort" onchange="this.form.submit()" class="px-4 py-2 rounded-lg border border-gray-300 bg-white text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                            <option value="created_at" <?php echo e(request('sort') == 'created_at' ? 'selected' : ''); ?>>Plus récents</option>
                            <option value="price_asc" <?php echo e(request('sort') == 'price_asc' ? 'selected' : ''); ?>>Prix croissant</option>
                            <option value="price_desc" <?php echo e(request('sort') == 'price_desc' ? 'selected' : ''); ?>>Prix décroissant</option>
                            <option value="name" <?php echo e(request('sort') == 'name' ? 'selected' : ''); ?>>Nom A-Z</option>
                            <option value="rating" <?php echo e(request('sort') == 'rating' ? 'selected' : ''); ?>>Mieux notés</option>
                        </select>
                    </form>
                </div>

                <!-- Products -->
                <?php if($products->count() > 0): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $imageUrl = $product->image && str_starts_with($product->image, 'http') 
                                    ? $product->image 
                                    : asset($product->image);
                                $discount = $product->discount_percentage ?? 0;
                            ?>
                            
                            <article class="bg-white border border-gray-200 rounded-xl p-3 flex flex-col h-full transition duration-300 hover:shadow-xl group">
                                <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="block">
                                    <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg overflow-hidden aspect-square flex items-center justify-center p-3 mb-3">
                                        <?php if($discount > 0): ?>
                                            <span class="absolute top-2 left-2 bg-primary text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">-<?php echo e($discount); ?>%</span>
                                        <?php endif; ?>
                                        <?php if($product->is_new): ?>
                                            <span class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">Nouveau</span>
                                        <?php endif; ?>
                                        <img src="<?php echo e($imageUrl); ?>" 
                                             alt="<?php echo e($product->name); ?>" 
                                             class="w-full h-full object-contain" 
                                             loading="lazy"
                                             onerror="this.src='https://via.placeholder.com/300x300?text=No+Image'">
                                    </div>
                                    <div class="flex-grow flex flex-col">
                                        <span class="text-xs font-bold uppercase tracking-wider text-primary mb-1">
                                            <?php echo e($product->category->name ?? 'Produit'); ?>

                                        </span>
                                        <h3 class="text-sm font-bold mb-2 leading-tight text-gray-900 line-clamp-2 min-h-[38px]">
                                            <?php echo e($product->name); ?>

                                        </h3>
                                        <?php if($product->rating): ?>
                                            <div class="flex gap-0.5 mb-2 text-yellow-400 text-sm">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' <?php echo e($i <= $product->rating ? 1 : 0); ?>;">star</span>
                                                <?php endfor; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                                <div class="flex justify-between items-center mt-auto pt-2 border-t border-gray-100">
                                    <div>
                                        <span class="font-headline text-lg font-bold text-primary"><?php echo e(number_format($product->price, 2, ',', ' ')); ?>€</span>
                                        <?php if($product->old_price && $product->old_price > $product->price): ?>
                                            <span class="text-xs text-gray-400 line-through ml-1"><?php echo e(number_format($product->old_price, 2, ',', ' ')); ?>€</span>
                                        <?php endif; ?>
                                    </div>
                                    <button class="bg-primary text-white p-2 rounded-lg flex items-center justify-center transition hover:bg-primary-container hover:scale-110 shadow-md product-add-btn" 
                                            data-product-id="<?php echo e($product->id); ?>" 
                                            aria-label="Ajouter au panier">
                                        <span class="material-symbols-outlined text-[16px]">shopping_cart</span>
                                    </button>
                                </div>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        <?php echo e($products->links()); ?>

                    </div>
                <?php else: ?>
                    <div class="text-center py-16 bg-white rounded-2xl border border-gray-200">
                        <span class="material-symbols-outlined text-6xl text-gray-300 mb-4">search_off</span>
                        <p class="text-lg text-on-surface-variant mb-2">Aucun produit trouvé</p>
                        <p class="text-sm text-gray-500 mb-4">Essayez de modifier vos critères de recherche</p>
                        <a href="<?php echo e(route('products.index')); ?>" class="inline-block mt-4 bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-container transition font-bold">Réinitialiser les filtres</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
function toggleAccordion(id) {
    const accordion = document.getElementById(id);
    const icon = document.getElementById(id + 'Icon');
    
    if (accordion.style.maxHeight && accordion.style.maxHeight !== '0px') {
        accordion.style.maxHeight = '0px';
        accordion.style.paddingBottom = '0px';
        icon.style.transform = 'rotate(0deg)';
    } else {
        accordion.style.maxHeight = accordion.scrollHeight + 'px';
        accordion.style.paddingBottom = '1rem';
        icon.style.transform = 'rotate(180deg)';
    }
}

// Initialize accordions as open by default
document.addEventListener('DOMContentLoaded', function() {
    ['priceAccordion', 'optionsAccordion'].forEach(id => {
        const accordion = document.getElementById(id);
        const icon = document.getElementById(id + 'Icon');
        accordion.style.maxHeight = accordion.scrollHeight + 'px';
        icon.style.transform = 'rotate(180deg)';
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/client/products/index.blade.php ENDPATH**/ ?>