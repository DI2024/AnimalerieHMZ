<?php $__env->startSection('title', 'Modifier Catégorie'); ?>
<?php $__env->startSection('page-title', 'Modifier la Catégorie'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Two-column layout */
    .form-container {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 24px;
    }
    
    @media (max-width: 1024px) {
        .form-container {
            grid-template-columns: 1fr;
        }
    }
    
    /* Image upload zone */
    .image-upload-zone {
        position: relative;
        width: 100%;
        aspect-ratio: 16/9;
        background: #f9fafb;
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
    }
    .image-upload-zone:hover {
        border-color: #003e87;
        background: #eff6ff;
    }
    .image-upload-zone.dragover {
        border-color: #003e87;
        background: #dbeafe;
        transform: scale(1.02);
    }
    .image-upload-zone img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .image-upload-placeholder {
        text-align: center;
        color: #6b7280;
        padding: 20px;
    }
    .remove-image-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(239, 68, 68, 0.95);
        color: white;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        z-index: 10;
    }
    .remove-image-btn:hover {
        background: rgba(220, 38, 38, 1);
        transform: scale(1.1);
    }
    
    /* Live preview card */
    .preview-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 24px;
    }
    .preview-card-image {
        width: 100%;
        aspect-ratio: 16/9;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
    }
    .preview-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    /* Character counter */
    .char-counter {
        font-size: 12px;
        color: #6b7280;
        text-align: right;
        margin-top: 4px;
    }
    .char-counter.warning {
        color: #f59e0b;
    }
    .char-counter.error {
        color: #ef4444;
    }
    
    /* Section headers */
    .section-header {
        font-size: 16px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 2px solid #f3f4f6;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('admin.categories.update', $category)); ?>" method="POST" enctype="multipart/form-data" id="categoryForm">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    
    <div class="form-container">
        <!-- Left Column: Form Fields -->
        <div class="space-y-6">
            
            <!-- Basic Information Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="section-header">
                    <i class="fas fa-info-circle text-primary mr-2"></i>
                    Informations de base
                </h3>
                
                <!-- Name -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nom de la catégorie *
                    </label>
                    <input type="text" name="name" id="categoryName" value="<?php echo e(old('name', $category->name)); ?>" required
                           oninput="updateSlug(); updatePreview(); countChars('categoryName', 100)"
                           class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#003e87] text-lg">
                    <div class="char-counter" id="nameCounter">0/100</div>
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <!-- Slug (Editable) -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        URL (Slug) *
                        <span class="text-gray-400 text-xs ml-1">(généré automatiquement)</span>
                    </label>
                    <div class="flex items-center">
                        <span class="px-3 py-3 bg-gray-100 border border-r-0 rounded-l-lg text-sm text-gray-600">
                            /categories/
                        </span>
                        <input type="text" name="slug" id="categorySlug" value="<?php echo e(old('slug', $category->slug)); ?>"
                               oninput="updateSlugPreview()"
                               class="flex-1 px-4 py-3 border rounded-r-lg focus:outline-none focus:ring-2 focus:ring-[#003e87] font-mono text-sm">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Modifiable manuellement si nécessaire
                    </p>
                    <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                        <span class="text-gray-400 text-xs ml-1">(optionnel)</span>
                    </label>
                    <textarea name="description" id="categoryDescription" rows="4"
                              oninput="updatePreview(); countChars('categoryDescription', 500)"
                              class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#003e87]"><?php echo e(old('description', $category->description)); ?></textarea>
                    <div class="char-counter" id="descriptionCounter">0/500</div>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            
            <!-- Image Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="section-header">
                    <i class="fas fa-image text-primary mr-2"></i>
                    Image de la catégorie
                </h3>
                
                <!-- Image Upload Zone -->
                <div class="image-upload-zone" id="imageUploadZone" onclick="document.getElementById('imageInput').click()">
                    <?php if($category->image): ?>
                        <?php if(filter_var($category->image, FILTER_VALIDATE_URL)): ?>
                            <img id="imagePreview" src="<?php echo e($category->image); ?>" alt="<?php echo e($category->name); ?>">
                        <?php else: ?>
                            <img id="imagePreview" src="<?php echo e(asset('storage/' . $category->image)); ?>" alt="<?php echo e($category->name); ?>">
                        <?php endif; ?>
                    <?php else: ?>
                        <img id="imagePreview" src="" alt="" class="hidden">
                    <?php endif; ?>
                    <div class="image-upload-placeholder <?php echo e($category->image ? 'hidden' : ''); ?>" id="imagePlaceholder">
                        <i class="fas fa-cloud-upload-alt text-6xl mb-3 text-gray-300"></i>
                        <p class="text-base font-medium mb-1">Cliquez ou glissez-déposez une image</p>
                        <p class="text-sm text-gray-400">JPG, PNG, WEBP (Max 2MB)</p>
                        <p class="text-xs text-gray-400 mt-2">Recommandé: 1200x675px (16:9)</p>
                    </div>
                    <button type="button" id="removeImageBtn" class="remove-image-btn <?php echo e($category->image ? '' : 'hidden'); ?>" onclick="event.stopPropagation(); removeImage()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <input type="file" name="image" id="imageInput" accept="image/jpeg,image/jpg,image/png,image/webp"
                       onchange="previewImage(this)" class="hidden">
                <input type="hidden" name="remove_image" id="removeImageFlag" value="0">
                
                <div id="imageInfo" class="hidden mt-3 text-sm text-gray-600 bg-gray-50 p-3 rounded-lg">
                    <div class="flex items-center justify-between">
                        <span><i class="fas fa-file-image mr-2"></i><span id="fileName"></span></span>
                        <span id="fileSize" class="text-xs"></span>
                    </div>
                </div>
                
                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <!-- Settings Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="section-header">
                    <i class="fas fa-cog text-primary mr-2"></i>
                    Paramètres
                </h3>
                
                <div class="space-y-4">
                    <!-- Status -->
                    <label class="flex items-center space-x-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $category->is_active) ? 'checked' : ''); ?>

                               class="rounded text-primary focus:ring-primary w-5 h-5">
                        <div class="flex-1">
                            <span class="text-sm font-medium text-gray-900">Catégorie active</span>
                            <p class="text-xs text-gray-500">Visible sur le site</p>
                        </div>
                    </label>

                    <!-- Order -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Ordre d'affichage
                        </label>
                        <input type="number" name="order" value="<?php echo e(old('order', $category->order)); ?>" min="0" required
                               class="w-full px-4 py-2.5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#003e87] text-sm">
                        <p class="text-xs text-gray-500 mt-1">
                            Contrôle la position d'affichage de la catégorie (les valeurs plus petites apparaissent en premier).
                        </p>
                        <?php $__errorArgs = ['order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="flex justify-between items-center bg-white rounded-lg shadow p-6">
                <a href="<?php echo e(route('admin.categories.index')); ?>" 
                   class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Annuler
                </a>
                <div class="flex gap-3">
                    <button type="submit"
                            class="px-6 py-3 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] transition-colors">
                        <i class="fas fa-save mr-2"></i>Mettre à jour
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Right Column: Live Preview -->
        <div>
            <div class="preview-card">
                <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b">
                    <h3 class="text-sm font-semibold text-gray-700">
                        <i class="fas fa-eye mr-2"></i>Aperçu en direct
                    </h3>
                </div>
                
                <div class="preview-card-image" id="previewImage">
                    <?php if($category->image): ?>
                        <?php if(filter_var($category->image, FILTER_VALIDATE_URL)): ?>
                            <img src="<?php echo e($category->image); ?>" alt="<?php echo e($category->name); ?>">
                        <?php else: ?>
                            <img src="<?php echo e(asset('storage/' . $category->image)); ?>" alt="<?php echo e($category->name); ?>">
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="text-center">
                            <i class="fas fa-image text-6xl mb-2"></i>
                            <p class="text-sm">Aucune image</p>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="p-6">
                    <h4 class="text-xl font-bold text-gray-900 mb-2" id="previewName"><?php echo e($category->name); ?></h4>
                    <p class="text-sm text-gray-600 mb-4" id="previewDescription"><?php echo e($category->description ?? 'Aucune description'); ?></p>
                    
                    <div class="flex items-center justify-between pt-4 border-t">
                        <div class="text-sm text-gray-500">
                            <i class="fas fa-box mr-1"></i>
                            <span><?php echo e($category->products_count ?? 0); ?> produits</span>
                        </div>
                        <div class="text-sm">
                            <span class="px-3 py-1 <?php echo e($category->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'); ?> rounded-full text-xs font-medium">
                                <?php echo e($category->is_active ? 'Actif' : 'Inactif'); ?>

                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Tips -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h4 class="text-sm font-semibold text-blue-900 mb-2">
                    <i class="fas fa-lightbulb mr-2"></i>Conseils
                </h4>
                <ul class="text-xs text-blue-800 space-y-1">
                    <li>• Utilisez un nom court et descriptif</li>
                    <li>• L'image doit être claire et représentative</li>
                    <li>• La description aide au référencement (SEO)</li>
                    <li>• L'ordre contrôle l'affichage sur le site</li>
                </ul>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Slug generation
    function updateSlug() {
        const name = document.getElementById('categoryName').value;
        const slugInput = document.getElementById('categorySlug');
        
        // Only auto-generate if slug is empty or hasn't been manually edited
        if (!slugInput.dataset.manuallyEdited) {
            const slug = name.toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Remove accents
                .replace(/[^a-z0-9]+/g, '-') // Replace non-alphanumeric with dash
                .replace(/^-+|-+$/g, ''); // Remove leading/trailing dashes
            
            slugInput.value = slug;
        }
    }
    
    // Mark slug as manually edited
    document.getElementById('categorySlug')?.addEventListener('input', function() {
        this.dataset.manuallyEdited = 'true';
    });
    
    function updateSlugPreview() {
        // Optional: Add any slug preview logic here
    }
    
    // Character counter
    function countChars(fieldId, maxChars) {
        const field = document.getElementById(fieldId);
        const counter = document.getElementById(fieldId === 'categoryName' ? 'nameCounter' : 'descriptionCounter');
        const length = field.value.length;
        
        counter.textContent = `${length}/${maxChars}`;
        counter.classList.remove('warning', 'error');
        
        if (length > maxChars * 0.9) {
            counter.classList.add('warning');
        }
        if (length > maxChars) {
            counter.classList.add('error');
        }
    }
    
    // Live preview update
    function updatePreview() {
        const name = document.getElementById('categoryName').value || 'Nom de la catégorie';
        const description = document.getElementById('categoryDescription').value || 'La description apparaîtra ici...';
        
        document.getElementById('previewName').textContent = name;
        document.getElementById('previewDescription').textContent = description;
    }
    
    // Image preview with drag & drop
    const uploadZone = document.getElementById('imageUploadZone');
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadZone.addEventListener(eventName, () => uploadZone.classList.add('dragover'), false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, () => uploadZone.classList.remove('dragover'), false);
    });
    
    uploadZone.addEventListener('drop', function(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        document.getElementById('imageInput').files = files;
        previewImage(document.getElementById('imageInput'));
    });
    
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('imagePlaceholder');
        const removeBtn = document.getElementById('removeImageBtn');
        const previewImage = document.getElementById('previewImage');
        const imageInfo = document.getElementById('imageInfo');
        const removeFlag = document.getElementById('removeImageFlag');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // Validate file size (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('La taille de l\'image ne doit pas dépasser 2MB');
                input.value = '';
                return;
            }
            
            // Validate file type
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            if (!validTypes.includes(file.type)) {
                alert('Format d\'image non valide. Utilisez JPG, PNG ou WEBP');
                input.value = '';
                return;
            }
            
            // Reset remove flag when new image is selected
            removeFlag.value = '0';
            
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                removeBtn.classList.remove('hidden');
                
                // Update preview card
                previewImage.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                
                // Show file info
                imageInfo.classList.remove('hidden');
                document.getElementById('fileName').textContent = file.name;
                document.getElementById('fileSize').textContent = (file.size / 1024).toFixed(1) + ' KB';
            };
            
            reader.readAsDataURL(file);
        }
    }
    
    function removeImage() {
        const input = document.getElementById('imageInput');
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('imagePlaceholder');
        const removeBtn = document.getElementById('removeImageBtn');
        const previewImage = document.getElementById('previewImage');
        const imageInfo = document.getElementById('imageInfo');
        const removeFlag = document.getElementById('removeImageFlag');
        
        input.value = '';
        preview.src = '';
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');
        removeBtn.classList.add('hidden');
        imageInfo.classList.add('hidden');
        
        // Set flag to remove image on server
        removeFlag.value = '1';
        
        // Reset preview card
        previewImage.innerHTML = `
            <div class="text-center">
                <i class="fas fa-image text-6xl mb-2"></i>
                <p class="text-sm">Aucune image</p>
            </div>
        `;
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateSlug();
        updatePreview();
        countChars('categoryName', 100);
        countChars('categoryDescription', 500);
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/admin/categories/edit.blade.php ENDPATH**/ ?>