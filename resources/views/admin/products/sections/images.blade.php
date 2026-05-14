<div class="images-media-grid">
    <!-- Left Column: Main Image (40%) -->
    <div class="main-image-panel">
        <div class="panel-header">
            <label class="block text-sm font-semibold text-gray-900 mb-3">
                Image principale <span class="text-red-500">*</span>
            </label>
        </div>
        
        <div class="main-image-container">
                <div class="main-image-preview" id="main-image-preview">
                    <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?auto=format&fit=crop&q=80&w=400" alt="Sample Product" 
                         class="main-image-img">
                    <div class="badge-principale">
                        <i class="fas fa-star mr-1"></i>PRINCIPALE
                    </div>
                </div>
            
            <button type="button" onclick="document.getElementById('main-image-input').click()" 
                    class="upload-main-btn">
                <i class="fas fa-upload mr-2"></i>
                Changer l'image
            </button>
            
            <input type="file" name="image" id="main-image-input" accept="image/*" class="hidden">
            
            <p class="help-text">
                <i class="fas fa-info-circle mr-1"></i>
                PNG, JPG, WEBP - Max 2MB
            </p>
        </div>
    </div>

    <!-- Right Column: Gallery (60%) -->
    <div class="gallery-panel">
        <div class="panel-header">
            <label class="block text-sm font-semibold text-gray-900 mb-1">
                Galerie d'images
            </label>
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs text-gray-500">Glissez pour réorganiser</span>
                <span class="gallery-counter">
                    <i class="fas fa-images mr-1"></i>
                    <span id="gallery-count">3</span>/10
                </span>
            </div>
        </div>
        
        <div class="gallery-grid" id="sortable-gallery">
            <!-- Static Gallery Item 1 -->
            <div class="gallery-item" data-image-id="101">
                <img src="https://images.unsplash.com/photo-1544568100-847a948585b9?auto=format&fit=crop&q=80&w=200" class="gallery-item-img">
                <div class="gallery-item-overlay">
                    <div class="gallery-item-actions">
                        <button type="button" class="action-btn action-btn-star"><i class="fas fa-star"></i></button>
                        <button type="button" class="action-btn action-btn-delete"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
                <div class="drag-handle"><i class="fas fa-grip-vertical"></i></div>
            </div>
            
            <!-- Static Gallery Item 2 -->
            <div class="gallery-item" data-image-id="102">
                <img src="https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&q=80&w=200" class="gallery-item-img">
                <div class="gallery-item-overlay">
                    <div class="gallery-item-actions">
                        <button type="button" class="action-btn action-btn-star"><i class="fas fa-star"></i></button>
                        <button type="button" class="action-btn action-btn-delete"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
                <div class="drag-handle"><i class="fas fa-grip-vertical"></i></div>
            </div>
            
            <!-- Add More Button -->
            <div class="gallery-add-btn" onclick="document.getElementById('gallery-images-input').click()">
                <i class="fas fa-plus text-3xl text-gray-400"></i>
                <span class="text-xs text-gray-500 mt-2">Ajouter</span>
            </div>
        </div>
        
        <input type="file" name="images[]" id="gallery-images-input" accept="image/*" multiple class="hidden">
        
        <p class="help-text">
            <i class="fas fa-lightbulb mr-1"></i>
            Cliquez sur <i class="fas fa-star text-yellow-500 mx-1"></i> pour définir une image comme principale
        </p>
    </div>
</div>

<style>
/* Images & Media Grid Layout */
.images-media-grid {
    display: grid;
    grid-template-columns: 40% 60%;
    gap: 24px;
    margin-bottom: 16px;
}

/* Main Image Panel */
.main-image-panel {
    border: 2px solid #d4af37;
    border-radius: 12px;
    padding: 20px;
    background: linear-gradient(to bottom, #fef3c7 0%, #ffffff 100%);
    box-shadow: 0 2px 8px rgba(212, 175, 55, 0.1);
}

.main-image-container {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.main-image-preview {
    width: 100%;
    aspect-ratio: 1;
    border-radius: 8px;
    overflow: hidden;
    position: relative;
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.main-image-preview.main-image-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.main-image-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.badge-principale {
    position: absolute;
    top: 12px;
    left: 12px;
    background: linear-gradient(135deg, #d4af37 0%, #f59e0b 100%);
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
}

.upload-main-btn {
    width: 100%;
    padding: 12px 16px;
    background: white;
    border: 2px solid #d4af37;
    border-radius: 8px;
    color: #d4af37;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.upload-main-btn:hover {
    background: #d4af37;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
}

/* Gallery Panel */
.gallery-panel {
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
    background: white;
}

.gallery-counter {
    display: inline-flex;
    align-items: center;
    padding: 4px 12px;
    background: #f3f4f6;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    color: #374151;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-bottom: 12px;
}

.gallery-item {
    aspect-ratio: 1;
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    cursor: move;
    border: 2px solid #e5e7eb;
    transition: all 0.2s;
}

.gallery-item:hover {
    border-color: #d4af37;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.gallery-item-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.gallery-item-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    opacity: 0;
    transition: opacity 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gallery-item:hover .gallery-item-overlay {
    opacity: 1;
}

.gallery-item-actions {
    display: flex;
    gap: 8px;
}

.action-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    font-size: 14px;
}

.action-btn-star {
    background: #fbbf24;
    color: white;
}

.action-btn-star:hover {
    background: #f59e0b;
    transform: scale(1.1);
}

.action-btn-delete {
    background: #ef4444;
    color: white;
}

.action-btn-delete:hover {
    background: #dc2626;
    transform: scale(1.1);
}

.drag-handle {
    position: absolute;
    top: 8px;
    left: 8px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    cursor: move;
}

.gallery-add-btn {
    aspect-ratio: 1;
    border: 2px dashed #d1d5db;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    background: #f9fafb;
}

.gallery-add-btn:hover {
    border-color: #d4af37;
    background: #fef3c7;
}

.gallery-add-btn:hover i {
    color: #d4af37 !important;
}

.help-text {
    font-size: 12px;
    color: #6b7280;
    margin-top: 8px;
    display: flex;
    align-items: center;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .images-media-grid {
        grid-template-columns: 45% 55%;
        gap: 16px;
    }
    
    .gallery-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }
}

@media (max-width: 768px) {
    .images-media-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .main-image-panel {
        order: 1;
    }
    
    .gallery-panel {
        order: 2;
    }
    
    .gallery-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
}
</style>

<script>
// Main Image Upload Preview
document.getElementById('main-image-input').addEventListener('change', function(e) {
    if (e.target.files.length > 0) {
        const file = e.target.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('main-image-preview');
            preview.className = 'main-image-preview';
            preview.innerHTML = `
                <img src="${e.target.result}" alt="Nouvelle image" class="main-image-img">
                <div class="badge-principale">
                    <i class="fas fa-star mr-1"></i>PRINCIPALE
                </div>
                <div style="position: absolute; bottom: 12px; left: 12px; right: 12px; background: rgba(34, 197, 94, 0.95); color: white; padding: 8px 12px; border-radius: 6px; font-size: 12px; text-align: center;">
                    <i class="fas fa-check-circle mr-1"></i>
                    Nouvelle image sélectionnée
                </div>
            `;
        };
        reader.readAsDataURL(file);
    }
});

// Gallery Images Upload
document.getElementById('gallery-images-input').addEventListener('change', function(e) {
    const container = document.getElementById('sortable-gallery');
    const addButton = container.querySelector('.gallery-add-btn');
    const currentCount = container.querySelectorAll('.gallery-item').length;
    
    Array.from(e.target.files).slice(0, 10 - currentCount).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'gallery-item';
            div.innerHTML = `
                <img src="${e.target.result}" alt="" class="gallery-item-img">
                <div class="gallery-item-overlay">
                    <div class="gallery-item-actions">
                        <button type="button" class="action-btn action-btn-star" title="Définir comme principale">
                            <i class="fas fa-star"></i>
                        </button>
                        <button type="button" class="action-btn action-btn-delete" title="Supprimer">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="drag-handle">
                    <i class="fas fa-grip-vertical"></i>
                </div>
            `;
            
            if (addButton) {
                container.insertBefore(div, addButton);
            } else {
                container.appendChild(div);
            }
            
            updateGalleryCount();
        };
        reader.readAsDataURL(file);
    });
});

// Set as Main Image
function setAsMainImage(imageId, imageUrl) {
    const preview = document.getElementById('main-image-preview');
    preview.className = 'main-image-preview';
    preview.innerHTML = `
        <img src="${imageUrl}" alt="Image principale" class="main-image-img">
        <div class="badge-principale">
            <i class="fas fa-star mr-1"></i>PRINCIPALE
        </div>
    `;
    
    // Show success notification
    showNotification('Image principale mise à jour', 'success');
    
    // Update via AJAX
    fetch(`/admin/products/images/${imageId}/set-main`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            showNotification('Erreur lors de la mise à jour', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Delete Gallery Image
function deleteGalleryImage(imageId) {
    if (!confirm('Supprimer cette image de la galerie ?')) {
        return;
    }
    
    fetch(`/admin/products/images/${imageId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.querySelector(`[data-image-id="${imageId}"]`).remove();
            updateGalleryCount();
            showNotification('Image supprimée', 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Erreur lors de la suppression', 'error');
    });
}

// Update Gallery Count
function updateGalleryCount() {
    const count = document.querySelectorAll('.gallery-item').length;
    document.getElementById('gallery-count').textContent = count;
    
    // Show/hide add button based on count
    const addBtn = document.querySelector('.gallery-add-btn');
    if (addBtn) {
        addBtn.style.display = count >= 10 ? 'none' : 'flex';
    }
}

// Show Notification
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.innerHTML = `
        <div class="flex items-center space-x-2">
            <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Initialize Sortable for Gallery
if (typeof Sortable !== 'undefined') {
    new Sortable(document.getElementById('sortable-gallery'), {
        animation: 150,
        handle: '.drag-handle',
        ghostClass: 'opacity-50',
        filter: '.gallery-add-btn',
        onEnd: function(evt) {
            console.log('Gallery reordered');
            // You can add AJAX call here to save new order
        }
    });
}

// Drag & Drop for Main Image
const mainImageZone = document.querySelector('.main-image-preview');
if (mainImageZone) {
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        mainImageZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        mainImageZone.addEventListener(eventName, function() {
            this.style.borderColor = '#d4af37';
            this.style.background = '#fef3c7';
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        mainImageZone.addEventListener(eventName, function() {
            this.style.borderColor = '#e5e7eb';
            this.style.background = '#f9fafb';
        });
    });

    mainImageZone.addEventListener('drop', function(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        document.getElementById('main-image-input').files = files;
        document.getElementById('main-image-input').dispatchEvent(new Event('change'));
    });
}
</script>
