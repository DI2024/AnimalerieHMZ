<?php $__env->startSection('title', 'Commande'); ?>

<?php $__env->startSection('page-title'); ?>
Détails Commande #<?php echo e($order->order_number); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Toast Notification */
    .toast {
        position: fixed;
        top: 24px;
        right: 24px;
        background: white;
        padding: 16px 24px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        display: none;
        align-items: center;
        gap: 12px;
        z-index: 9999;
        animation: slideIn 0.3s ease;
    }
    
    .toast.show {
        display: flex;
    }
    
    .toast.success {
        border-left: 4px solid #10B981;
    }
    
    .toast.error {
        border-left: 4px solid #EF4444;
    }
    
    .toast.warning {
        border-left: 4px solid #F59E0B;
    }
    
    .toast.info {
        border-left: 4px solid #3B82F6;
    }
    
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    
    <!-- Success Message -->
    <?php if(session('success')): ?>
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-3">
        <i class="fas fa-check-circle text-green-600"></i>
        <span class="font-medium"><?php echo e(session('success')); ?></span>
    </div>
    <?php endif; ?>
    
    <!-- Order Info -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Status & Actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold text-gray-900 mb-4">Statut</h3>
            
            <form id="status-form" action="<?php echo e(route('admin.orders.update-status', $order)); ?>" method="POST" class="space-y-4" onsubmit="return false;">
                <?php echo csrf_field(); ?>
                <select name="status" id="status-select" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#003e87]">
                    <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>En attente</option>
                    <option value="processing" <?php echo e($order->status == 'processing' ? 'selected' : ''); ?>>En traitement</option>
                    <option value="confirmed" <?php echo e($order->status == 'confirmed' ? 'selected' : ''); ?>>Confirmée</option>
                    <option value="shipped" <?php echo e($order->status == 'shipped' ? 'selected' : ''); ?>>Expédiée</option>
                    <option value="delivered" <?php echo e($order->status == 'delivered' ? 'selected' : ''); ?>>Livrée</option>
                    <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>Annulée</option>
                </select>
                
                <button type="button" onclick="handleStatusUpdate()" class="w-full px-4 py-2 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1]">
                    Mettre à jour
                </button>
            </form>
            
            <div class="mt-4 pt-4 border-t space-y-2">
                <a href="<?php echo e(route('admin.orders.index')); ?>"
                   class="block w-full text-center px-4 py-2 border rounded-lg hover:bg-gray-50">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </div>
        
        <!-- Customer Info -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold text-gray-900 mb-4">Informations Client</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Nom</p>
                    <p class="font-medium"><?php echo e($order->shipping_first_name); ?> <?php echo e($order->shipping_last_name); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="font-medium"><?php echo e($order->shipping_email); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Téléphone</p>
                    <p class="font-medium"><?php echo e($order->shipping_phone ?? 'Non fourni'); ?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Date</p>
                    <p class="font-medium"><?php echo e($order->created_at->format('d/m/Y H:i')); ?></p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-600">Adresse de livraison</p>
                    <p class="font-medium"><?php echo e($order->shipping_address); ?></p>
                </div>
                <?php if($order->customer_notes): ?>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-600">Notes client</p>
                    <p class="font-medium"><?php echo e($order->customer_notes); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Order Items -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b">
            <h3 class="font-semibold text-gray-900">Articles commandés</h3>
            <?php if($order->status === 'confirmed'): ?>
                <div class="mt-2 flex items-center gap-2 text-sm text-green-600">
                    <i class="fas fa-check-circle"></i>
                    <span>Stock réduit pour cette commande</span>
                </div>
            <?php elseif($order->status === 'cancelled'): ?>
                <div class="mt-2 flex items-center gap-2 text-sm text-gray-600">
                    <i class="fas fa-undo"></i>
                    <span>Stock restauré (commande annulée)</span>
                </div>
            <?php else: ?>
                <div class="mt-2 flex items-center gap-2 text-sm text-yellow-600">
                    <i class="fas fa-clock"></i>
                    <span>Stock non affecté (commande non confirmée)</span>
                </div>
            <?php endif; ?>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix unitaire</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock actuel</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sous-total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <?php if($item->product_image): ?>
                                    <?php if(filter_var($item->product_image, FILTER_VALIDATE_URL)): ?>
                                        <img src="<?php echo e($item->product_image); ?>" class="w-12 h-12 object-cover rounded mr-3" alt="<?php echo e($item->product_name); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('storage/' . $item->product_image)); ?>" class="w-12 h-12 object-cover rounded mr-3" alt="<?php echo e($item->product_name); ?>">
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="w-12 h-12 bg-gray-200 rounded mr-3 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <p class="font-medium"><?php echo e($item->product_name); ?></p>
                                    <?php if($item->product_sku): ?>
                                        <p class="text-sm text-gray-500">SKU: <?php echo e($item->product_sku); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm"><?php echo e(number_format($item->price, 2)); ?> DH</td>
                        <td class="px-6 py-4 text-sm">
                            <span class="font-medium"><?php echo e($item->quantity); ?></span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <?php if($item->product): ?>
                                <?php
                                    $stock = $item->product->stock;
                                    $stockClass = $stock <= 0 ? 'text-red-600' : ($stock < 10 ? 'text-yellow-600' : 'text-green-600');
                                ?>
                                <span class="<?php echo e($stockClass); ?> font-medium">
                                    <?php echo e($stock); ?> unités
                                </span>
                            <?php else: ?>
                                <span class="text-gray-400">Produit supprimé</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium"><?php echo e(number_format($item->price * $item->quantity, 2)); ?> DH</td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Aucun article dans cette commande
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-right font-medium">Sous-total</td>
                        <td class="px-6 py-4 font-medium"><?php echo e(number_format($order->subtotal, 2)); ?> DH</td>
                    </tr>
                    <?php if($order->discount > 0): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-right font-medium">Réduction</td>
                        <td class="px-6 py-4 font-medium text-red-600">-<?php echo e(number_format($order->discount, 2)); ?> DH</td>
                    </tr>
                    <?php endif; ?>
                    <tr class="text-lg">
                        <td colspan="4" class="px-6 py-4 text-right font-bold">Total</td>
                        <td class="px-6 py-4 font-bold text-[#003e87]"><?php echo e(number_format($order->total, 2)); ?> DH</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    
    <!-- Admin Notes -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-gray-900 mb-4">Notes Admin</h3>
        
        <?php if($errors->has('admin_notes')): ?>
        <div class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <i class="fas fa-exclamation-circle"></i>
            <?php echo e($errors->first('admin_notes')); ?>

        </div>
        <?php endif; ?>
        
        <form action="<?php echo e(route('admin.orders.add-notes', $order)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <textarea name="admin_notes" rows="3" placeholder="Ajouter des notes privées..."
                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#003e87] mb-2"><?php echo e(old('admin_notes', $order->admin_notes)); ?></textarea>
            <button type="submit" class="px-4 py-2 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1]">
                Enregistrer notes
            </button>
        </form>
    </div>
    
</div>

<!-- Toast Notification -->
<div class="toast" id="toast">
    <i class="fas fa-check-circle text-xl" id="toast-icon"></i>
    <span id="toast-message">Message</span>
</div>

<!-- Custom Confirmation Modal -->
<div id="confirmation-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full transform transition-all">
        <div class="p-6">
            <!-- Icon -->
            <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full" id="confirm-icon-container">
                <i class="fas fa-exclamation-triangle text-3xl" id="confirm-icon"></i>
            </div>
            
            <!-- Title -->
            <h3 class="text-xl font-bold text-gray-900 text-center mb-2" id="confirm-title">
                Confirmer l'action
            </h3>
            
            <!-- Message -->
            <p class="text-gray-600 text-center mb-6" id="confirm-message">
                Êtes-vous sûr de vouloir effectuer cette action ?
            </p>
            
            <!-- Actions -->
            <div class="flex space-x-3">
                <button onclick="closeConfirmation()" 
                        class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 font-medium transition-colors">
                    Annuler
                </button>
                <button onclick="confirmAction()" 
                        id="confirm-button"
                        class="flex-1 px-4 py-2.5 rounded-lg font-medium transition-colors">
                    Confirmer
                </button>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    let confirmCallback = null;

    // Toast Notification Function
    function showToast(message, type = 'info') {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');
        const icon = document.getElementById('toast-icon');
        
        // Set message
        toastMessage.textContent = message;
        
        // Set icon and color based on type
        if (type === 'success') {
            icon.className = 'fas fa-check-circle text-green-600 text-xl';
            toast.className = 'toast show success';
        } else if (type === 'error') {
            icon.className = 'fas fa-exclamation-circle text-red-600 text-xl';
            toast.className = 'toast show error';
        } else if (type === 'warning') {
            icon.className = 'fas fa-exclamation-triangle text-yellow-600 text-xl';
            toast.className = 'toast show warning';
        } else {
            icon.className = 'fas fa-info-circle text-blue-600 text-xl';
            toast.className = 'toast show info';
        }
        
        // Auto-hide after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }

    // Show confirmation modal with dynamic content
    function showConfirmation(title, message, onConfirm, type = 'info') {
        const modal = document.getElementById('confirmation-modal');
        const iconContainer = document.getElementById('confirm-icon-container');
        const icon = document.getElementById('confirm-icon');
        const confirmBtn = document.getElementById('confirm-button');
        
        // Set content
        document.getElementById('confirm-title').textContent = title;
        document.getElementById('confirm-message').textContent = message;
        
        // Set style based on type
        if (type === 'danger') {
            iconContainer.className = 'flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-red-100';
            icon.className = 'fas fa-exclamation-triangle text-3xl text-red-600';
            confirmBtn.className = 'flex-1 px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium transition-colors';
        } else if (type === 'warning') {
            iconContainer.className = 'flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-yellow-100';
            icon.className = 'fas fa-exclamation-circle text-3xl text-yellow-600';
            confirmBtn.className = 'flex-1 px-4 py-2.5 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 font-medium transition-colors';
        } else {
            iconContainer.className = 'flex items-center justify-center w-16 h-16 mx-auto mb-4 rounded-full bg-blue-100';
            icon.className = 'fas fa-info-circle text-3xl text-blue-600';
            confirmBtn.className = 'flex-1 px-4 py-2.5 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] font-medium transition-colors';
        }
        
        confirmCallback = onConfirm;
        modal.classList.remove('hidden');
    }

    function closeConfirmation() {
        document.getElementById('confirmation-modal').classList.add('hidden');
        confirmCallback = null;
    }

    function confirmAction() {
        if (confirmCallback) {
            confirmCallback();
        }
        closeConfirmation();
    }

    // Handle status update with confirmation
    function handleStatusUpdate() {
        const form = document.getElementById('status-form');
        const select = document.getElementById('status-select');
        const newStatus = select.value;
        const currentStatus = '<?php echo e($order->status); ?>';
        
        // Don't show confirmation if status hasn't changed
        if (newStatus === currentStatus) {
            showToast('Le statut n\'a pas changé.', 'warning');
            return;
        }
        
        // Determine modal type and message based on new status
        let title, message, type, buttonText;
        
        switch(newStatus) {
            case 'cancelled':
                title = 'Annuler la commande ?';
                if (currentStatus === 'confirmed') {
                    message = 'Êtes-vous sûr de vouloir annuler cette commande ? Le stock des produits sera automatiquement restauré.';
                } else {
                    message = 'Êtes-vous sûr de vouloir annuler cette commande ? Cette action affectera le client.';
                }
                type = 'danger';
                buttonText = 'Annuler la commande';
                break;
                
            case 'delivered':
                title = 'Marquer comme livrée ?';
                message = 'Confirmez que cette commande a été livrée et que le paiement a été collecté. Cette action affectera le chiffre d\'affaires.';
                type = 'warning';
                buttonText = 'Confirmer livraison';
                break;
                
            case 'confirmed':
                title = 'Confirmer la commande ?';
                if (currentStatus === 'cancelled') {
                    message = 'Êtes-vous sûr de vouloir confirmer cette commande ? Le stock des produits sera automatiquement réduit à nouveau.';
                } else {
                    message = 'Êtes-vous sûr de vouloir confirmer cette commande ? Le stock des produits sera automatiquement réduit.';
                }
                type = 'info';
                buttonText = 'Confirmer';
                break;
                
            case 'processing':
                title = 'Mettre en traitement ?';
                message = 'Êtes-vous sûr de vouloir mettre cette commande en traitement ?';
                type = 'info';
                buttonText = 'Confirmer';
                break;
                
            case 'shipped':
                title = 'Marquer comme expédiée ?';
                message = 'Confirmez que cette commande a été expédiée. Le client sera notifié.';
                type = 'info';
                buttonText = 'Confirmer expédition';
                break;
                
            case 'pending':
                title = 'Remettre en attente ?';
                message = 'Êtes-vous sûr de vouloir remettre cette commande en attente ?';
                type = 'info';
                buttonText = 'Confirmer';
                break;
        }
        
        // Update button text
        document.getElementById('confirm-button').textContent = buttonText;
        
        // Show confirmation
        showConfirmation(title, message, function() {
            updateOrderStatus(newStatus);
        }, type);
    }
    
    // Update order status via AJAX
    function updateOrderStatus(newStatus) {
        const orderId = <?php echo e($order->id); ?>;
        
        fetch(`/admin/orders/${orderId}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Statut mis à jour avec succès!', 'success');
                // Reload page after 1 second to show updated status
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                showToast(data.message || 'Erreur lors de la mise à jour', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Erreur de connexion', 'error');
        });
    }

    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeConfirmation();
        }
    });

    // Close modal on outside click
    document.getElementById('confirmation-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeConfirmation();
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>