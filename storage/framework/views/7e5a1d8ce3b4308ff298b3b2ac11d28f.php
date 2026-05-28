<?php
    $isPack = request('type') === 'pack';
?>

<?php $__env->startSection('title', $isPack ? 'Nouveau Pack' : 'Nouvelle Offre'); ?>
<?php $__env->startSection('page-title', $isPack ? 'Créer un Pack' : 'Créer une Offre'); ?>

<?php $__env->startSection('content'); ?>
<!-- Back Button -->
<div class="mb-6">
    <a href="<?php echo e(route('admin.offers.index')); ?>" 
       class="inline-flex items-center text-gray-600 transition-colors" 
       style="color: #6b7280;"
       onmouseover="this.style.color='#003e87'" 
       onmouseout="this.style.color='#6b7280'">
        <i class="fas fa-arrow-left mr-2"></i>
        <span>Retour à la liste des offres</span>
    </a>
</div>

<!-- Form Container -->
<div class="bg-white rounded-lg shadow p-8">
    <form action="<?php echo e(route('admin.offers.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        <!-- Hidden input for type -->
        <input type="hidden" name="type" value="<?php echo e($isPack ? 'pack' : 'offer'); ?>">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Title / Pack Name -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        <?php echo e($isPack ? 'Nom du pack' : 'Titre'); ?> <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="<?php echo e(old('title')); ?>"
                           required
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='<?php echo e($isPack ? '#7c3aed' : '#003e87'); ?>'; this.style.boxShadow='0 0 0 3px <?php echo e($isPack ? 'rgba(124,58,237,0.1)' : 'rgba(0,62,135,0.1)'); ?>'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="<?php echo e($isPack ? 'Ex: Pack Chiot Premium' : 'Ex: Jusqu\'à 25% de remise'); ?>">
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <?php if(!$isPack): ?>
                <!-- Subtitle -->
                <div>
                    <label for="subtitle" class="block text-sm font-semibold text-gray-700 mb-2">
                        Sous-titre
                    </label>
                    <input type="text" 
                           name="subtitle" 
                           id="subtitle" 
                           value="<?php echo e(old('subtitle')); ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='#003e87'; this.style.boxShadow='0 0 0 3px rgba(0,62,135,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="Ex: Sur toute la gamme Chien">
                    <?php $__errorArgs = ['subtitle'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Badge -->
                <div>
                    <label for="badge" class="block text-sm font-semibold text-gray-700 mb-2">
                        Badge
                    </label>
                    <input type="text" 
                           name="badge" 
                           id="badge" 
                           value="<?php echo e(old('badge')); ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='#003e87'; this.style.boxShadow='0 0 0 3px rgba(0,62,135,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="Ex: 🔥 Offre Spéciale">
                    <?php $__errorArgs = ['badge'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Link -->
                <div>
                    <label for="link" class="block text-sm font-semibold text-gray-700 mb-2">
                        Lien de redirection
                    </label>
                    <input type="text" 
                           name="link" 
                           id="link" 
                           value="<?php echo e(old('link')); ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='#003e87'; this.style.boxShadow='0 0 0 3px rgba(0,62,135,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="Ex: /categories/chiens">
                    <?php $__errorArgs = ['link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <?php else: ?>
                <!-- Pack Price -->
                <div>
                    <label for="pack_price" class="block text-sm font-semibold text-gray-700 mb-2">
                        Prix du Pack (DH) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           name="pack_price" 
                           id="pack_price" 
                           value="<?php echo e(old('pack_price')); ?>"
                           required
                           min="0"
                           step="0.01"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='#7c3aed'; this.style.boxShadow='0 0 0 3px rgba(124,58,237,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="Ex: 199.00">
                    <?php $__errorArgs = ['pack_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Products Selection -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Sélectionner les produits du pack <span class="text-red-500">*</span>
                    </label>
                    
                    <!-- Search Box -->
                    <input type="text" 
                           id="productSearch" 
                           placeholder="Rechercher un produit..." 
                           class="w-full px-4 py-2 mb-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           style="border-color: #e5e7eb;">
                           
                    <!-- Products Checklist -->
                    <div class="border rounded-lg p-4 max-h-72 overflow-y-auto space-y-2" style="border-color: #e5e7eb;">
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <label class="flex items-center justify-between p-2 rounded-lg hover:bg-purple-50/50 cursor-pointer product-checkbox-label">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" 
                                           name="product_ids[]" 
                                           value="<?php echo e($product->id); ?>" 
                                           data-price="<?php echo e($product->price); ?>"
                                           data-name="<?php echo e($product->name); ?>"
                                           class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500 product-checkbox"
                                           <?php echo e((is_array(old('product_ids')) && in_array($product->id, old('product_ids'))) ? 'checked' : ''); ?>>
                                    <div>
                                        <span class="font-medium text-gray-800 product-name"><?php echo e($product->name); ?></span>
                                        <?php if($product->category): ?>
                                            <span class="text-xs text-gray-500 block"><?php echo e($product->category->name); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <span class="font-semibold text-gray-700"><?php echo e(number_format($product->price, 2, ',', ' ')); ?> DH</span>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <p class="text-sm text-gray-500 text-center py-4">Aucun produit actif disponible</p>
                        <?php endif; ?>
                    </div>
                    <?php $__errorArgs = ['product_ids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    
                    <!-- Real-time Summary Card -->
                    <div class="mt-4 p-4 bg-purple-50 border border-purple-100 rounded-xl space-y-2">
                        <div class="flex justify-between text-sm text-purple-900">
                            <span>Prix total normal (barré) :</span>
                            <span class="font-bold"><span id="totalOriginalDisplay">0,00</span> DH</span>
                        </div>
                        <div class="flex justify-between text-sm text-purple-900">
                            <span>Prix du pack :</span>
                            <span class="font-bold"><span id="packPriceDisplay">0,00</span> DH</span>
                        </div>
                        <div class="h-px bg-purple-200 my-2"></div>
                        <div class="flex justify-between text-base font-bold text-purple-950">
                            <span>Économie client :</span>
                            <span><span id="savingsDisplay">0,00</span> DH (<span id="savingsPercentDisplay">0</span>%)</span>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <?php echo e($isPack ? 'Photo du pack' : 'Image'); ?>

                    </label>
                    <div class="border-2 border-dashed rounded-lg p-6 text-center" style="border-color: #d1d5db;">
                        <input type="file" 
                               name="image" 
                               id="image" 
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(event)">
                        <label for="image" class="cursor-pointer">
                            <div id="imagePreview" class="mb-4">
                                <i class="fas fa-cloud-upload-alt text-5xl text-gray-400"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">Cliquez pour télécharger une image</p>
                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF jusqu'à 2MB</p>
                        </label>
                    </div>
                    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <?php if(!$isPack): ?>
                <!-- Background Color -->
                <div>
                    <label for="bg_color" class="block text-sm font-semibold text-gray-700 mb-2">
                        Couleur de fond
                    </label>
                    <input type="text" 
                           name="bg_color" 
                           id="bg_color" 
                           value="<?php echo e(old('bg_color', '#003e87')); ?>"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='#003e87'; this.style.boxShadow='0 0 0 3px rgba(0,62,135,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="#003e87">
                    <?php $__errorArgs = ['bg_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <?php endif; ?>

                <!-- Active Status -->
                <div>
                    <label class="flex items-center cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" 
                               name="is_active" 
                               value="1" 
                               <?php echo e(old('is_active', true) ? 'checked' : ''); ?>

                               class="w-5 h-5 rounded" 
                               style="color: <?php echo e($isPack ? '#7c3aed' : '#003e87'); ?>;">
                        <span class="ml-3 text-sm font-semibold text-gray-700"><?php echo e($isPack ? 'Pack actif' : 'Offre active'); ?></span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="mt-8 flex items-center gap-4">
            <button type="submit" 
                    class="px-6 py-3 text-white rounded-lg font-semibold transition-colors" 
                    style="background: <?php echo e($isPack ? '#7c3aed' : '#003e87'); ?>;"
                    onmouseover="this.style.background='<?php echo e($isPack ? '#6d28d9' : '#0855b1'); ?>'" 
                    onmouseout="this.style.background='<?php echo e($isPack ? '#7c3aed' : '#003e87'); ?>'">
                <i class="fas fa-save mr-2"></i><?php echo e($isPack ? 'Créer le pack' : 'Créer l\'offre'); ?>

            </button>
            <a href="<?php echo e(route('admin.offers.index')); ?>" 
               class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                Annuler
            </a>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="max-h-48 mx-auto rounded-lg">`;
        }
        reader.readAsDataURL(file);
    }
}

<?php if($isPack): ?>
document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const totalOriginalDisplay = document.getElementById('totalOriginalDisplay');
    const packPriceInput = document.getElementById('pack_price');
    const packPriceDisplay = document.getElementById('packPriceDisplay');
    const savingsDisplay = document.getElementById('savingsDisplay');
    const savingsPercentDisplay = document.getElementById('savingsPercentDisplay');
    
    function calculateTotals() {
        let totalOriginal = 0;
        checkboxes.forEach(cb => {
            if (cb.checked) {
                totalOriginal += parseFloat(cb.dataset.price);
            }
        });
        
        const packPrice = parseFloat(packPriceInput.value) || 0;
        const savings = totalOriginal - packPrice;
        const savingsPercent = totalOriginal > 0 ? Math.round((savings / totalOriginal) * 100) : 0;
        
        totalOriginalDisplay.textContent = totalOriginal.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        packPriceDisplay.textContent = packPrice.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        
        if (savings > 0) {
            savingsDisplay.textContent = savings.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
            savingsPercentDisplay.textContent = savingsPercent;
        } else {
            savingsDisplay.textContent = '0,00';
            savingsPercentDisplay.textContent = '0';
        }
    }
    
    if (checkboxes.length > 0 && packPriceInput) {
        checkboxes.forEach(cb => cb.addEventListener('change', calculateTotals));
        packPriceInput.addEventListener('input', calculateTotals);
        calculateTotals(); // Initial call
    }
    
    // Product Search Filter
    const productSearch = document.getElementById('productSearch');
    if (productSearch) {
        productSearch.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            const labels = document.querySelectorAll('.product-checkbox-label');
            
            labels.forEach(label => {
                const name = label.querySelector('.product-name').textContent.toLowerCase();
                if (name.includes(query)) {
                    label.style.display = 'flex';
                } else {
                    label.style.display = 'none';
                }
            });
        });
    }
});
<?php endif; ?>
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/admin/offers/create.blade.php ENDPATH**/ ?>