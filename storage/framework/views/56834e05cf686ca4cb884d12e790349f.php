<?php $__env->startSection('content'); ?>
<style>
/* Scrollbar fin pour la sidebar des filtres */
.filter-scroll::-webkit-scrollbar {
    width: 4px;
}
.filter-scroll::-webkit-scrollbar-track {
    background: transparent;
}
.filter-scroll::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 99px;
}
.filter-scroll::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}
/* Firefox */
.filter-scroll {
    scrollbar-width: thin;
    scrollbar-color: #d1d5db transparent;
}
</style>

<?php
    $selectedPack = null;
    if (request('is_pack') && request('pack_id')) {
        $selectedPack = $allPacks->firstWhere('id', request('pack_id'));
    }
    $selectedOffer = null;
    if (request('is_offer') && request('offer_id')) {
        $selectedOffer = $allOffers->firstWhere('id', request('offer_id'));
    }
?>
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
            
            <!-- Sidebar Filters (Desktop uniquement) -->
            <aside class="lg:col-span-1 hidden lg:block">
                <div class="bg-white rounded-2xl border border-gray-200 shadow-md sticky top-6 flex flex-col" style="max-height: calc(100vh - 3rem);">
                    <div class="px-6 pt-6 pb-3 flex items-center justify-between flex-shrink-0 border-b border-gray-100">
                        <h3 class="font-bold text-lg text-primary">Filtres</h3>
                        <a href="<?php echo e(route('products.index')); ?>" class="text-xs text-gray-400 hover:text-primary transition font-medium">Réinitialiser</a>
                    </div>
                    
                    <div class="overflow-y-auto flex-1 px-6 py-4 filter-scroll">
                    <form method="GET" action="<?php echo e(route('products.index')); ?>" class="space-y-6" id="desktopFilterForm">
                        
                        <!-- Categories with Subcategories Accordion -->
                        <div>
                            <h4 class="font-bold text-sm mb-3 text-gray-900">Catégories</h4>
                            <div class="space-y-1">
                                <!-- Option "Toutes" -->
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                    <input type="radio" 
                                           name="filter_type" 
                                           value="all" 
                                           <?php echo e(!request('category') && !request('subcategory') ? 'checked' : ''); ?> 
                                           class="rounded border-gray-300 text-primary focus:ring-primary" 
                                           onchange="clearFilters(this.form)">
                                    <span class="ml-2 text-sm text-gray-700 font-medium">Toutes les catégories</span>
                                </label>
                                
                                <!-- Categories with Accordion -->
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="border-b border-gray-100 last:border-0">
                                    <!-- Category Header (clickable to expand) -->
                                    <div class="flex items-center justify-between hover:bg-gray-50 rounded-lg transition">
                                        <label class="flex items-center cursor-pointer p-2 flex-1">
                                            <input type="radio" 
                                                   name="filter_type" 
                                                   value="category_<?php echo e($category->slug); ?>" 
                                                   <?php echo e(request('category') == $category->slug && !request('subcategory') ? 'checked' : ''); ?> 
                                                   class="rounded border-gray-300 text-primary focus:ring-primary"
                                                   onchange="selectCategory(this.form, '<?php echo e($category->slug); ?>')">
                                            <span class="ml-2 text-sm text-gray-700 font-medium">
                                                <?php echo e($category->name); ?> 
                                                <span class="text-gray-400">(<?php echo e($category->products_count); ?>)</span>
                                            </span>
                                        </label>
                                        
                                        <?php if($category->subcategories->count() > 0): ?>
                                        <button type="button" 
                                                onclick="toggleCategoryAccordion('category<?php echo e($category->id); ?>')" 
                                                class="p-2 hover:bg-gray-100 rounded-lg transition">
                                            <span class="material-symbols-outlined text-gray-500 text-sm transition-transform duration-300" 
                                                  id="category<?php echo e($category->id); ?>Icon">
                                                expand_more
                                            </span>
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Subcategories (collapsible) -->
                                    <?php if($category->subcategories->count() > 0): ?>
                                    <div id="category<?php echo e($category->id); ?>" 
                                         class="ml-6 space-y-1 overflow-hidden transition-all duration-300"
                                         style="max-height: 0; padding-bottom: 0;">
                                        <?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                            <input type="radio" 
                                                   name="filter_type" 
                                                   value="subcategory_<?php echo e($subcategory->slug); ?>" 
                                                   <?php echo e(request('subcategory') == $subcategory->slug ? 'checked' : ''); ?> 
                                                   class="rounded border-gray-300 text-primary focus:ring-primary"
                                                   onchange="selectSubcategory(this.form, '<?php echo e($subcategory->slug); ?>')">
                                            <span class="ml-2 text-xs text-gray-600">
                                                <?php echo e($subcategory->name); ?> 
                                                <span class="text-gray-400">(<?php echo e($subcategory->products_count); ?>)</span>
                                            </span>
                                        </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        
                        <!-- Hidden inputs for category and subcategory -->
                        <input type="hidden" name="category" id="categoryInput" value="<?php echo e(request('category')); ?>">
                        <input type="hidden" name="subcategory" id="subcategoryInput" value="<?php echo e(request('subcategory')); ?>">

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
                            <div id="optionsAccordion" class="space-y-1 pb-4 overflow-hidden transition-all duration-300">
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                    <input type="checkbox" name="is_new" value="1" <?php echo e(request('is_new') ? 'checked' : ''); ?> class="rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="ml-2 text-sm text-gray-700">Nouveautés</span>
                                </label>
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                    <input type="checkbox" name="is_bestseller" value="1" <?php echo e(request('is_bestseller') ? 'checked' : ''); ?> class="rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="ml-2 text-gray-700">Best Sellers</span>
                                </label>

                                <!-- Packs accordion item -->
                                <div class="border-b border-gray-100 last:border-0">
                                    <div class="flex items-center justify-between hover:bg-gray-50 rounded-lg transition">
                                        <label class="flex items-center cursor-pointer p-2 flex-1">
                                            <input type="checkbox" id="isPackCheckbox" name="is_pack" value="1"
                                                   <?php echo e(request('is_pack') ? 'checked' : ''); ?>

                                                   class="rounded border-gray-300 text-purple-600 focus:ring-purple-600"
                                                   onchange="togglePackAccordion()">
                                            <span class="ml-2 text-sm font-bold text-purple-600">Packs 🔥</span>
                                        </label>
                                        <?php if($allPacks->count() > 0): ?>
                                        <button type="button" onclick="toggleCategoryAccordion('packsAccordion')" class="p-2 hover:bg-gray-100 rounded-lg transition">
                                            <span class="material-symbols-outlined text-gray-500 text-sm transition-transform duration-300" id="packsAccordionIcon">expand_more</span>
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                    <?php if($allPacks->count() > 0): ?>
                                    <div id="packsAccordion"
                                         class="ml-6 space-y-1 overflow-hidden transition-all duration-300"
                                         style="max-height: <?php echo e(request('is_pack') ? '500px' : '0'); ?>; padding-bottom: <?php echo e(request('is_pack') ? '0.5rem' : '0'); ?>;">
                                        <!-- "Tous" option -->
                                        <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                            <input type="radio" name="pack_id" value=""
                                                   <?php echo e(request('is_pack') && !request('pack_id') ? 'checked' : ''); ?>

                                                   class="rounded border-gray-300 text-purple-600 focus:ring-purple-600"
                                                   onchange="selectPack(this.form, '')">
                                            <span class="ml-2 text-xs text-gray-600">Tous les packs</span>
                                        </label>
                                        <?php $__currentLoopData = $allPacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                            <input type="radio" name="pack_id" value="<?php echo e($p->id); ?>"
                                                   <?php echo e(request('pack_id') == $p->id ? 'checked' : ''); ?>

                                                   class="rounded border-gray-300 text-purple-600 focus:ring-purple-600"
                                                   onchange="selectPack(this.form, '<?php echo e($p->id); ?>')">
                                            <span class="ml-2 text-xs text-gray-600"><?php echo e($p->title); ?></span>
                                        </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Offres accordion item -->
                                <div class="border-b border-gray-100 last:border-0">
                                    <div class="flex items-center justify-between hover:bg-gray-50 rounded-lg transition">
                                        <label class="flex items-center cursor-pointer p-2 flex-1">
                                            <input type="checkbox" id="isOfferCheckbox" name="is_offer" value="1"
                                                   <?php echo e(request('is_offer') ? 'checked' : ''); ?>

                                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-600"
                                                   onchange="toggleOfferAccordion()">
                                            <span class="ml-2 text-sm font-bold text-blue-600">Offres 🏷️</span>
                                        </label>
                                        <?php if($allOffers->count() > 0): ?>
                                        <button type="button" onclick="toggleCategoryAccordion('offersAccordion')" class="p-2 hover:bg-gray-100 rounded-lg transition">
                                            <span class="material-symbols-outlined text-gray-500 text-sm transition-transform duration-300" id="offersAccordionIcon">expand_more</span>
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                    <?php if($allOffers->count() > 0): ?>
                                    <div id="offersAccordion"
                                         class="ml-6 space-y-1 overflow-hidden transition-all duration-300"
                                         style="max-height: <?php echo e(request('is_offer') ? '500px' : '0'); ?>; padding-bottom: <?php echo e(request('is_offer') ? '0.5rem' : '0'); ?>;">
                                        <!-- "Toutes" option -->
                                        <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                            <input type="radio" name="offer_id" value=""
                                                   <?php echo e(request('is_offer') && !request('offer_id') ? 'checked' : ''); ?>

                                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-600"
                                                   onchange="selectOffer(this.form, '')">
                                            <span class="ml-2 text-xs text-gray-600">Toutes les offres</span>
                                        </label>
                                        <?php $__currentLoopData = $allOffers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                            <input type="radio" name="offer_id" value="<?php echo e($o->id); ?>"
                                                   <?php echo e(request('offer_id') == $o->id ? 'checked' : ''); ?>

                                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-600"
                                                   onchange="selectOffer(this.form, '<?php echo e($o->id); ?>')">
                                            <span class="ml-2 text-xs text-gray-600"><?php echo e($o->title); ?></span>
                                        </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="space-y-2 pt-2">
                            <button type="submit" class="w-full bg-primary hover:bg-primary-container text-white font-bold py-3 px-4 rounded-xl transition shadow-md hover:shadow-lg">
                                Appliquer les filtres
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </aside>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                
                <!-- Barre de recherche + Bouton Filtres (Mobile) -->
                <div class="flex gap-3 mb-6">
                    <!-- Barre de recherche -->
                    <form method="GET" action="<?php echo e(route('products.index')); ?>" class="flex-1">
                        <?php $__currentLoopData = request()->except(['search', 'page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(is_array($value)): ?>
                                <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input type="hidden" name="<?php echo e($key); ?>[]" value="<?php echo e($v); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                            <input type="text" 
                                   name="search" 
                                   value="<?php echo e(request('search')); ?>" 
                                   placeholder="Rechercher un produit..." 
                                   class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-300 bg-white text-sm focus:ring-2 focus:ring-primary focus:border-primary shadow-sm"
                                   onchange="this.form.submit()">
                        </div>
                    </form>
                    
                    <!-- Bouton Filtres (Mobile uniquement) -->
                    <button id="openFiltersBtn" class="lg:hidden bg-primary text-white px-5 py-3.5 rounded-xl shadow-md hover:bg-primary-container transition-all flex items-center justify-center gap-2 relative">
                        <span class="material-symbols-outlined">tune</span>
                        <?php if(request('category') || request('subcategory') || request('min_price') || request('max_price') || request('is_new') || request('is_bestseller') || request('is_pack') || request('is_offer')): ?>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white w-5 h-5 rounded-full flex items-center justify-center text-xs font-bold">!</span>
                        <?php endif; ?>
                    </button>
                </div>
                
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

                <!-- Premium Header Banners -->
                <?php if(isset($selectedPack) && $selectedPack): ?>
                    <!-- Premium Pack Header Banner -->
                    <div class="mb-6 p-6 rounded-2xl bg-gradient-to-r from-purple-600 to-purple-800 text-white shadow-md flex items-center justify-between gap-6">
                        <div>
                            <span class="bg-white/20 text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Pack Sélectionné</span>
                            <h2 class="text-xl md:text-2xl font-black mt-1"><?php echo e($selectedPack->title); ?></h2>
                            <?php if($selectedPack->subtitle): ?>
                                <p class="text-xs text-white/80 mt-1"><?php echo e($selectedPack->subtitle); ?></p>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo e(route('packs.show', $selectedPack->id)); ?>" class="bg-white text-purple-700 hover:bg-purple-50 transition px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap shadow-sm">
                            Voir le détail du pack
                        </a>
                    </div>
                <?php endif; ?>

                <?php if(isset($selectedOffer) && $selectedOffer): ?>
                    <!-- Premium Offer Header Banner -->
                    <div class="mb-6 p-6 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-850 text-white shadow-md flex items-center justify-between gap-6">
                        <div>
                            <span class="bg-white/20 text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-wider">Offre Sélectionnée</span>
                            <h2 class="text-xl md:text-2xl font-black mt-1"><?php echo e($selectedOffer->title); ?></h2>
                            <?php if($selectedOffer->subtitle): ?>
                                <p class="text-xs text-white/80 mt-1"><?php echo e($selectedOffer->subtitle); ?></p>
                            <?php endif; ?>
                        </div>
                        <a href="<?php echo e(route('offers.show', $selectedOffer->id)); ?>" class="bg-white text-blue-700 hover:bg-blue-50 transition px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap shadow-sm">
                            Voir le détail de l'offre
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Products -->
                <?php if($products->count() > 0): ?>
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-5 mb-8">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $isPackItem = isset($product->is_pack) && $product->is_pack;
                                $isOfferItem = isset($product->is_offer) && $product->is_offer;
                                $imageUrl = $product->image_url;
                                $discount = $isPackItem 
                                    ? ($product->old_price > $product->price ? round((($product->old_price - $product->price) / $product->old_price) * 100) : 0)
                                    : ($product->discount_percentage ?? 0);
                            ?>
                            
                            <article class="bg-white border border-gray-200 rounded-xl p-3 flex flex-col h-full transition duration-300 hover:shadow-xl group <?php echo e($isPackItem ? 'border-purple-300 hover:border-purple-500' : ($isOfferItem ? 'border-blue-300 hover:border-blue-500' : '')); ?>">
                                <a href="<?php echo e(($isPackItem || $isOfferItem) ? ($product->link ?: '#') : route('products.show', $product->slug)); ?>" class="block">
                                    <div class="relative bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg overflow-hidden aspect-square flex items-center justify-center p-2 lg:p-3 mb-3">
                                        <?php if($isPackItem): ?>
                                            <span class="absolute top-1 left-1 lg:top-2 lg:left-2 bg-purple-600 text-white text-[10px] lg:text-xs font-bold px-1.5 py-0.5 lg:px-2 lg:py-1 rounded-full shadow-lg">PACK</span>
                                        <?php elseif($isOfferItem): ?>
                                            <span class="absolute top-1 left-1 lg:top-2 lg:left-2 bg-blue-600 text-white text-[10px] lg:text-xs font-bold px-1.5 py-0.5 lg:px-2 lg:py-1 rounded-full shadow-lg">OFFRE</span>
                                        <?php elseif($discount > 0): ?>
                                            <span class="absolute top-1 left-1 lg:top-2 lg:left-2 bg-primary text-white text-[10px] lg:text-xs font-bold px-1.5 py-0.5 lg:px-2 lg:py-1 rounded-full shadow-lg">-<?php echo e($discount); ?>%</span>
                                        <?php endif; ?>
                                        <?php if($product->is_new): ?>
                                            <span class="absolute top-1 right-1 lg:top-2 lg:right-2 bg-green-500 text-white text-[10px] lg:text-xs font-bold px-1.5 py-0.5 lg:px-2 lg:py-1 rounded-full shadow-lg">Nouveau</span>
                                        <?php endif; ?>
                                        <img src="<?php echo e($imageUrl); ?>" 
                                             alt="<?php echo e($product->name); ?>" 
                                             class="w-full h-full object-contain" 
                                             loading="lazy"
                                             onerror="this.src='<?php echo e(asset('images/placeholder.svg')); ?>'">
                                    </div>
                                    <div class="flex-grow flex flex-col">
                                        <span class="text-[10px] lg:text-xs font-bold uppercase tracking-wider <?php echo e($isPackItem ? 'text-purple-600' : ($isOfferItem ? 'text-blue-600' : 'text-primary')); ?> mb-1">
                                            <?php echo e($product->category->name ?? 'Produit'); ?>

                                        </span>
                                        <h3 class="text-xs lg:text-sm font-bold mb-2 leading-tight text-gray-900 line-clamp-2 min-h-[32px] lg:min-h-[38px]">
                                            <?php echo e($product->name); ?>

                                        </h3>
                                        <?php if($product->rating): ?>
                                            <div class="flex gap-0.5 mb-2 text-yellow-400 text-xs lg:text-sm">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <span class="material-symbols-outlined text-xs lg:text-sm" style="font-variation-settings: 'FILL' <?php echo e($i <= $product->rating ? 1 : 0); ?>;">star</span>
                                                <?php endfor; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                                <div class="flex justify-between items-center mt-auto pt-2 border-t border-gray-100">
                                    <?php if($isOfferItem): ?>
                                        <div class="flex flex-col">
                                            <span class="font-headline text-sm font-bold text-blue-600">Offre Spéciale</span>
                                            <span class="text-[10px] text-gray-400">Voir les produits</span>
                                        </div>
                                        <a href="<?php echo e($product->link); ?>" class="bg-blue-600 text-white p-2 rounded-lg flex items-center justify-center transition hover:bg-blue-700 hover:scale-110 shadow-md" aria-label="Voir l'offre">
                                            <span class="material-symbols-outlined text-sm lg:text-base">arrow_forward</span>
                                        </a>
                                    <?php else: ?>
                                        <div class="flex flex-col">
                                            <span class="font-headline text-sm lg:text-lg font-bold <?php echo e($isPackItem ? 'text-purple-600' : 'text-primary'); ?>"><?php echo e(number_format($product->price, 2, ',', ' ')); ?> MAD</span>
                                            <?php if($product->old_price && $product->old_price > $product->price): ?>
                                                <span class="text-[10px] lg:text-xs text-gray-400 line-through"><?php echo e(number_format($product->old_price, 2, ',', ' ')); ?> MAD</span>
                                            <?php endif; ?>
                                        </div>
                                        <?php if($isPackItem): ?>
                                        <button class="bg-purple-600 text-white p-2 rounded-lg flex items-center justify-center transition hover:bg-purple-700 hover:scale-110 shadow-md pack-add-btn animate-pulse" 
                                                data-pack-id="<?php echo e($product->id); ?>" 
                                                aria-label="Ajouter le pack au panier">
                                            <span class="material-symbols-outlined text-sm lg:text-base">shopping_cart</span>
                                        </button>
                                        <?php else: ?>
                                        <button class="bg-primary text-white p-2 rounded-lg flex items-center justify-center transition hover:bg-primary-container hover:scale-110 shadow-md product-add-btn" 
                                                data-product-id="<?php echo e($product->id); ?>" 
                                                aria-label="Ajouter au panier">
                                            <span class="material-symbols-outlined text-sm lg:text-base">shopping_cart</span>
                                        </button>
                                        <?php endif; ?>
                                    <?php endif; ?>
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

<!-- Bottom Sheet Filtres (Mobile uniquement) -->
<div id="filtersBottomSheet" class="fixed inset-0 z-[9999] pointer-events-none hidden">
    <!-- Overlay -->
    <div id="filtersOverlay" class="absolute inset-0 bg-black/50 opacity-0 transition-opacity duration-300 pointer-events-none"></div>
    
    <!-- Bottom Sheet Content -->
    <div id="filtersSheet" class="absolute bottom-0 left-0 right-0 bg-white rounded-t-3xl shadow-2xl transform translate-y-full transition-transform duration-300 max-h-[85vh] overflow-y-auto">
        <div class="sticky top-0 bg-white z-10 px-6 py-4 border-b border-gray-200 rounded-t-3xl">
            <div class="flex items-center justify-between">
                <h3 class="font-bold text-xl text-primary">Filtres</h3>
                <button id="closeFiltersBtn" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition">
                    <span class="material-symbols-outlined text-gray-600">close</span>
                </button>
            </div>
        </div>
        
        <div class="p-6">
            <form method="GET" action="<?php echo e(route('products.index')); ?>" class="space-y-6" id="mobileFiltersForm">
                
                <!-- Categories with Subcategories Accordion -->
                <div>
                    <h4 class="font-bold text-sm mb-3 text-gray-900">Catégories</h4>
                    <div class="space-y-1">
                        <!-- Option "Toutes" -->
                        <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                            <input type="radio" 
                                   name="filter_type_mobile" 
                                   value="all" 
                                   <?php echo e(!request('category') && !request('subcategory') ? 'checked' : ''); ?> 
                                   class="rounded border-gray-300 text-primary focus:ring-primary" 
                                   onchange="clearFiltersMobile(this.form)">
                            <span class="ml-2 text-sm text-gray-700 font-medium">Toutes les catégories</span>
                        </label>
                        
                        <!-- Categories with Accordion -->
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border-b border-gray-100 last:border-0">
                            <!-- Category Header (clickable to expand) -->
                            <div class="flex items-center justify-between hover:bg-gray-50 rounded-lg transition">
                                <label class="flex items-center cursor-pointer p-2 flex-1">
                                    <input type="radio" 
                                           name="filter_type_mobile" 
                                           value="category_<?php echo e($category->slug); ?>" 
                                           <?php echo e(request('category') == $category->slug && !request('subcategory') ? 'checked' : ''); ?> 
                                           class="rounded border-gray-300 text-primary focus:ring-primary"
                                           onchange="selectCategoryMobile(this.form, '<?php echo e($category->slug); ?>')">
                                    <span class="ml-2 text-sm text-gray-700 font-medium">
                                        <?php echo e($category->name); ?> 
                                        <span class="text-gray-400">(<?php echo e($category->products_count); ?>)</span>
                                    </span>
                                </label>
                                
                                <?php if($category->subcategories->count() > 0): ?>
                                <button type="button" 
                                        onclick="toggleCategoryAccordionMobile('categoryMobile<?php echo e($category->id); ?>')" 
                                        class="p-2 hover:bg-gray-100 rounded-lg transition">
                                    <span class="material-symbols-outlined text-gray-500 text-sm transition-transform duration-300" 
                                          id="categoryMobile<?php echo e($category->id); ?>Icon">
                                        expand_more
                                    </span>
                                </button>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Subcategories (collapsible) -->
                            <?php if($category->subcategories->count() > 0): ?>
                            <div id="categoryMobile<?php echo e($category->id); ?>" 
                                 class="ml-6 space-y-1 overflow-hidden transition-all duration-300"
                                 style="max-height: 0; padding-bottom: 0;">
                                <?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                    <input type="radio" 
                                           name="filter_type_mobile" 
                                           value="subcategory_<?php echo e($subcategory->slug); ?>" 
                                           <?php echo e(request('subcategory') == $subcategory->slug ? 'checked' : ''); ?> 
                                           class="rounded border-gray-300 text-primary focus:ring-primary"
                                           onchange="selectSubcategoryMobile(this.form, '<?php echo e($subcategory->slug); ?>')">
                                    <span class="ml-2 text-xs text-gray-600">
                                        <?php echo e($subcategory->name); ?> 
                                        <span class="text-gray-400">(<?php echo e($subcategory->products_count); ?>)</span>
                                    </span>
                                </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                
                <!-- Hidden inputs for category and subcategory -->
                <input type="hidden" name="category" id="categoryInputMobile" value="<?php echo e(request('category')); ?>">
                <input type="hidden" name="subcategory" id="subcategoryInputMobile" value="<?php echo e(request('subcategory')); ?>">

                <!-- Price Range - Accordion -->
                <div class="border-b border-gray-200">
                    <button type="button" onclick="toggleAccordionMobile('priceAccordionMobile')" class="w-full flex items-center justify-between py-3 text-left">
                        <h4 class="font-bold text-sm text-gray-900">Prix</h4>
                        <span class="material-symbols-outlined text-gray-500 transition-transform duration-300" id="priceAccordionMobileIcon">expand_more</span>
                    </button>
                    <div id="priceAccordionMobile" class="space-y-2 pb-4 overflow-hidden transition-all duration-300">
                        <input type="number" name="min_price" placeholder="Prix minimum" value="<?php echo e(request('min_price')); ?>" class="w-full px-3 py-2 rounded-lg border border-gray-300 bg-white text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                        <input type="number" name="max_price" placeholder="Prix maximum" value="<?php echo e(request('max_price')); ?>" class="w-full px-3 py-2 rounded-lg border border-gray-300 bg-white text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>
                </div>

                <!-- Flags - Accordion -->
                <div class="border-b border-gray-200">
                    <button type="button" onclick="toggleAccordionMobile('optionsAccordionMobile')" class="w-full flex items-center justify-between py-3 text-left">
                        <h4 class="font-bold text-sm text-gray-900">Options</h4>
                        <span class="material-symbols-outlined text-gray-500 transition-transform duration-300" id="optionsAccordionMobileIcon">expand_more</span>
                    </button>
                    <div id="optionsAccordionMobile" class="space-y-1 pb-4 overflow-hidden transition-all duration-300">
                        <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                            <input type="checkbox" name="is_new" value="1" <?php echo e(request('is_new') ? 'checked' : ''); ?> class="rounded border-gray-300 text-primary focus:ring-primary">
                            <span class="ml-2 text-sm text-gray-700">Nouveautés</span>
                        </label>
                        <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                            <input type="checkbox" name="is_bestseller" value="1" <?php echo e(request('is_bestseller') ? 'checked' : ''); ?> class="rounded border-gray-300 text-primary focus:ring-primary">
                            <span class="ml-2 text-gray-700">Best Sellers</span>
                        </label>

                        <!-- Packs accordion item (Mobile) -->
                        <div class="border-b border-gray-100 last:border-0">
                            <div class="flex items-center justify-between hover:bg-gray-50 rounded-lg transition">
                                <label class="flex items-center cursor-pointer p-2 flex-1">
                                    <input type="checkbox" id="isPackCheckboxMobile" name="is_pack" value="1"
                                           <?php echo e(request('is_pack') ? 'checked' : ''); ?>

                                           class="rounded border-gray-300 text-purple-600 focus:ring-purple-600"
                                           onchange="togglePackAccordionMobile()">
                                    <span class="ml-2 text-sm font-bold text-purple-600">Packs 🔥</span>
                                </label>
                                <?php if($allPacks->count() > 0): ?>
                                <button type="button" onclick="toggleCategoryAccordionMobile('packsAccordionMobile')" class="p-2 hover:bg-gray-100 rounded-lg transition">
                                    <span class="material-symbols-outlined text-gray-500 text-sm transition-transform duration-300" id="packsAccordionMobileIcon">expand_more</span>
                                </button>
                                <?php endif; ?>
                            </div>
                            <?php if($allPacks->count() > 0): ?>
                            <div id="packsAccordionMobile"
                                 class="ml-6 space-y-1 overflow-hidden transition-all duration-300"
                                 style="max-height: <?php echo e(request('is_pack') ? '500px' : '0'); ?>; padding-bottom: <?php echo e(request('is_pack') ? '0.5rem' : '0'); ?>;">
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                    <input type="radio" name="pack_id" value=""
                                           <?php echo e(request('is_pack') && !request('pack_id') ? 'checked' : ''); ?>

                                           class="rounded border-gray-300 text-purple-600 focus:ring-purple-600"
                                           onchange="selectPackMobile(this.form, '')">
                                    <span class="ml-2 text-xs text-gray-600">Tous les packs</span>
                                </label>
                                <?php $__currentLoopData = $allPacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                    <input type="radio" name="pack_id" value="<?php echo e($p->id); ?>"
                                           <?php echo e(request('pack_id') == $p->id ? 'checked' : ''); ?>

                                           class="rounded border-gray-300 text-purple-600 focus:ring-purple-600"
                                           onchange="selectPackMobile(this.form, '<?php echo e($p->id); ?>')">
                                    <span class="ml-2 text-xs text-gray-600"><?php echo e($p->title); ?></span>
                                </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Offres accordion item (Mobile) -->
                        <div class="border-b border-gray-100 last:border-0">
                            <div class="flex items-center justify-between hover:bg-gray-50 rounded-lg transition">
                                <label class="flex items-center cursor-pointer p-2 flex-1">
                                    <input type="checkbox" id="isOfferCheckboxMobile" name="is_offer" value="1"
                                           <?php echo e(request('is_offer') ? 'checked' : ''); ?>

                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-600"
                                           onchange="toggleOfferAccordionMobile()">
                                    <span class="ml-2 text-sm font-bold text-blue-600">Offres 🏷️</span>
                                </label>
                                <?php if($allOffers->count() > 0): ?>
                                <button type="button" onclick="toggleCategoryAccordionMobile('offersAccordionMobile')" class="p-2 hover:bg-gray-100 rounded-lg transition">
                                    <span class="material-symbols-outlined text-gray-500 text-sm transition-transform duration-300" id="offersAccordionMobileIcon">expand_more</span>
                                </button>
                                <?php endif; ?>
                            </div>
                            <?php if($allOffers->count() > 0): ?>
                            <div id="offersAccordionMobile"
                                 class="ml-6 space-y-1 overflow-hidden transition-all duration-300"
                                 style="max-height: <?php echo e(request('is_offer') ? '500px' : '0'); ?>; padding-bottom: <?php echo e(request('is_offer') ? '0.5rem' : '0'); ?>;">
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                    <input type="radio" name="offer_id" value=""
                                           <?php echo e(request('is_offer') && !request('offer_id') ? 'checked' : ''); ?>

                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-600"
                                           onchange="selectOfferMobile(this.form, '')">
                                    <span class="ml-2 text-xs text-gray-600">Toutes les offres</span>
                                </label>
                                <?php $__currentLoopData = $allOffers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="flex items-center cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                                    <input type="radio" name="offer_id" value="<?php echo e($o->id); ?>"
                                           <?php echo e(request('offer_id') == $o->id ? 'checked' : ''); ?>

                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-600"
                                           onchange="selectOfferMobile(this.form, '<?php echo e($o->id); ?>')">
                                    <span class="ml-2 text-xs text-gray-600"><?php echo e($o->title); ?></span>
                                </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="space-y-2 pb-6">
                    <button type="submit" class="w-full bg-primary hover:bg-primary-container text-white font-bold py-4 px-4 rounded-xl transition shadow-md hover:shadow-lg">
                        Appliquer les filtres
                    </button>
                    <a href="<?php echo e(route('products.index')); ?>" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-4 px-4 rounded-xl transition">
                        Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// ============================================
// BOTTOM SHEET FILTRES (MOBILE)
// ============================================
const filtersBottomSheet = document.getElementById('filtersBottomSheet');
const filtersSheet = document.getElementById('filtersSheet');
const filtersOverlay = document.getElementById('filtersOverlay');
const openFiltersBtn = document.getElementById('openFiltersBtn');
const closeFiltersBtn = document.getElementById('closeFiltersBtn');

// Ouvrir le bottom sheet
if (openFiltersBtn) {
    openFiltersBtn.addEventListener('click', function() {
        filtersBottomSheet.classList.remove('pointer-events-none', 'hidden');
        filtersOverlay.classList.remove('opacity-0', 'pointer-events-none');
        filtersOverlay.classList.add('pointer-events-auto');
        filtersSheet.classList.remove('translate-y-full');
        document.body.style.overflow = 'hidden';
    });
}

// Fermer le bottom sheet
function closeFiltersBottomSheet() {
    filtersOverlay.classList.add('opacity-0', 'pointer-events-none');
    filtersOverlay.classList.remove('pointer-events-auto');
    filtersSheet.classList.add('translate-y-full');
    document.body.style.overflow = '';
    setTimeout(() => {
        filtersBottomSheet.classList.add('pointer-events-none', 'hidden');
    }, 300);
}

if (closeFiltersBtn) {
    closeFiltersBtn.addEventListener('click', closeFiltersBottomSheet);
}

if (filtersOverlay) {
    filtersOverlay.addEventListener('click', closeFiltersBottomSheet);
}

// ============================================
// FONCTIONS FILTRES MOBILE
// ============================================
function toggleAccordionMobile(id) {
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

function toggleCategoryAccordionMobile(id) {
    const accordion = document.getElementById(id);
    const icon = document.getElementById(id + 'Icon');
    
    if (accordion.style.maxHeight && accordion.style.maxHeight !== '0px') {
        accordion.style.maxHeight = '0px';
        accordion.style.paddingBottom = '0px';
        icon.style.transform = 'rotate(0deg)';
    } else {
        accordion.style.maxHeight = accordion.scrollHeight + 'px';
        accordion.style.paddingBottom = '0.5rem';
        icon.style.transform = 'rotate(180deg)';
    }
}

function clearFiltersMobile(form) {
    document.getElementById('categoryInputMobile').value = '';
    document.getElementById('subcategoryInputMobile').value = '';
    form.submit();
}

function selectCategoryMobile(form, categorySlug) {
    document.getElementById('categoryInputMobile').value = categorySlug;
    document.getElementById('subcategoryInputMobile').value = '';
    form.submit();
}

function selectSubcategoryMobile(form, subcategorySlug) {
    document.getElementById('categoryInputMobile').value = '';
    document.getElementById('subcategoryInputMobile').value = subcategorySlug;
    form.submit();
}

// Initialiser les accordions mobile comme ouverts
document.addEventListener('DOMContentLoaded', function() {
    ['priceAccordionMobile', 'optionsAccordionMobile'].forEach(id => {
        const accordion = document.getElementById(id);
        const icon = document.getElementById(id + 'Icon');
        if (accordion && icon) {
            accordion.style.maxHeight = accordion.scrollHeight + 'px';
            icon.style.transform = 'rotate(180deg)';
        }
    });
    
    // Auto-ouvrir l'accordéon de catégorie si une sous-catégorie est sélectionnée
    const selectedSubcategoryMobile = document.querySelector('input[name="filter_type_mobile"][value^="subcategory_"]:checked');
    if (selectedSubcategoryMobile) {
        const parentAccordion = selectedSubcategoryMobile.closest('[id^="categoryMobile"]');
        if (parentAccordion) {
            const accordionId = parentAccordion.id;
            const icon = document.getElementById(accordionId + 'Icon');
            parentAccordion.style.maxHeight = parentAccordion.scrollHeight + 'px';
            parentAccordion.style.paddingBottom = '0.5rem';
            if (icon) icon.style.transform = 'rotate(180deg)';
        }
    }

    // Auto-rotate Pack accordion icon (Mobile) if is_pack active
    const packCbMobile = document.getElementById('isPackCheckboxMobile');
    if (packCbMobile && packCbMobile.checked) {
        const icon = document.getElementById('packsAccordionMobileIcon');
        if (icon) icon.style.transform = 'rotate(180deg)';
    }

    // Auto-rotate Offer accordion icon (Mobile) if is_offer active
    const offerCbMobile = document.getElementById('isOfferCheckboxMobile');
    if (offerCbMobile && offerCbMobile.checked) {
        const icon = document.getElementById('offersAccordionMobileIcon');
        if (icon) icon.style.transform = 'rotate(180deg)';
    }
});


// ============================================
// FONCTIONS FILTRES DESKTOP (EXISTANTES)
// ============================================
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

function toggleCategoryAccordion(id) {
    const accordion = document.getElementById(id);
    const icon = document.getElementById(id + 'Icon');
    
    if (accordion.style.maxHeight && accordion.style.maxHeight !== '0px') {
        accordion.style.maxHeight = '0px';
        accordion.style.paddingBottom = '0px';
        icon.style.transform = 'rotate(0deg)';
    } else {
        accordion.style.maxHeight = accordion.scrollHeight + 'px';
        accordion.style.paddingBottom = '0.5rem';
        icon.style.transform = 'rotate(180deg)';
    }
}

// Clear all filters (show all products)
function clearFilters(form) {
    document.getElementById('categoryInput').value = '';
    document.getElementById('subcategoryInput').value = '';
    form.submit();
}

// Select a category (clear subcategory)
function selectCategory(form, categorySlug) {
    document.getElementById('categoryInput').value = categorySlug;
    document.getElementById('subcategoryInput').value = '';
    form.submit();
}

// Select a subcategory (clear category)
function selectSubcategory(form, subcategorySlug) {
    document.getElementById('categoryInput').value = '';
    document.getElementById('subcategoryInput').value = subcategorySlug;
    form.submit();
}

// Initialize accordions as open by default
document.addEventListener('DOMContentLoaded', function() {
    // Open price and options accordions
    ['priceAccordion', 'optionsAccordion'].forEach(id => {
        const accordion = document.getElementById(id);
        const icon = document.getElementById(id + 'Icon');
        if (accordion && icon) {
            accordion.style.maxHeight = accordion.scrollHeight + 'px';
            icon.style.transform = 'rotate(180deg)';
        }
    });
    
    // Auto-open category accordion if a subcategory is selected
    const selectedSubcategory = document.querySelector('input[name="filter_type"][value^="subcategory_"]:checked');
    if (selectedSubcategory) {
        const parentAccordion = selectedSubcategory.closest('[id^="category"]');
        if (parentAccordion) {
            const accordionId = parentAccordion.id;
            const icon = document.getElementById(accordionId + 'Icon');
            parentAccordion.style.maxHeight = parentAccordion.scrollHeight + 'px';
            parentAccordion.style.paddingBottom = '0.5rem';
            if (icon) icon.style.transform = 'rotate(180deg)';
        }
    }

    // Auto-rotate Pack accordion icon if is_pack is active
    const packCheckbox = document.getElementById('isPackCheckbox');
    if (packCheckbox && packCheckbox.checked) {
        const icon = document.getElementById('packsAccordionIcon');
        if (icon) icon.style.transform = 'rotate(180deg)';
    }

    // Auto-rotate Offer accordion icon if is_offer is active
    const offerCheckbox = document.getElementById('isOfferCheckbox');
    if (offerCheckbox && offerCheckbox.checked) {
        const icon = document.getElementById('offersAccordionIcon');
        if (icon) icon.style.transform = 'rotate(180deg)';
    }
});


// ============================================
// ACCORDION PACKS & OFFRES (DESKTOP)
// ============================================
function togglePackAccordion() {
    const isPack = document.getElementById('isPackCheckbox').checked;
    const accordion = document.getElementById('packsAccordion');
    const icon = document.getElementById('packsAccordionIcon');
    if (!accordion) return;
    if (isPack) {
        accordion.style.maxHeight = accordion.scrollHeight + 'px';
        accordion.style.paddingBottom = '0.5rem';
        if (icon) icon.style.transform = 'rotate(180deg)';
    } else {
        accordion.style.maxHeight = '0';
        accordion.style.paddingBottom = '0';
        if (icon) icon.style.transform = 'rotate(0deg)';
    }
}

function toggleOfferAccordion() {
    const isOffer = document.getElementById('isOfferCheckbox').checked;
    const accordion = document.getElementById('offersAccordion');
    const icon = document.getElementById('offersAccordionIcon');
    if (!accordion) return;
    if (isOffer) {
        accordion.style.maxHeight = accordion.scrollHeight + 'px';
        accordion.style.paddingBottom = '0.5rem';
        if (icon) icon.style.transform = 'rotate(180deg)';
    } else {
        accordion.style.maxHeight = '0';
        accordion.style.paddingBottom = '0';
        if (icon) icon.style.transform = 'rotate(0deg)';
    }
}

function selectPack(form, packId) {
    // Ensure is_pack checkbox is checked
    const cb = document.getElementById('isPackCheckbox');
    if (cb) cb.checked = true;
    form.submit();
}

function selectOffer(form, offerId) {
    // Ensure is_offer checkbox is checked
    const cb = document.getElementById('isOfferCheckbox');
    if (cb) cb.checked = true;
    form.submit();
}

// ============================================
// ACCORDION PACKS & OFFRES (MOBILE)
// ============================================
function togglePackAccordionMobile() {
    const isPack = document.getElementById('isPackCheckboxMobile').checked;
    const accordion = document.getElementById('packsAccordionMobile');
    const icon = document.getElementById('packsAccordionMobileIcon');
    if (!accordion) return;
    if (isPack) {
        accordion.style.maxHeight = accordion.scrollHeight + 'px';
        accordion.style.paddingBottom = '0.5rem';
        if (icon) icon.style.transform = 'rotate(180deg)';
    } else {
        accordion.style.maxHeight = '0';
        accordion.style.paddingBottom = '0';
        if (icon) icon.style.transform = 'rotate(0deg)';
    }
}

function toggleOfferAccordionMobile() {
    const isOffer = document.getElementById('isOfferCheckboxMobile').checked;
    const accordion = document.getElementById('offersAccordionMobile');
    const icon = document.getElementById('offersAccordionMobileIcon');
    if (!accordion) return;
    if (isOffer) {
        accordion.style.maxHeight = accordion.scrollHeight + 'px';
        accordion.style.paddingBottom = '0.5rem';
        if (icon) icon.style.transform = 'rotate(180deg)';
    } else {
        accordion.style.maxHeight = '0';
        accordion.style.paddingBottom = '0';
        if (icon) icon.style.transform = 'rotate(0deg)';
    }
}

function selectPackMobile(form, packId) {
    const cb = document.getElementById('isPackCheckboxMobile');
    if (cb) cb.checked = true;
    form.submit();
}

function selectOfferMobile(form, offerId) {
    const cb = document.getElementById('isOfferCheckboxMobile');
    if (cb) cb.checked = true;
    form.submit();
}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/client/products/index.blade.php ENDPATH**/ ?>