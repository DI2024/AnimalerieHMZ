@extends('layouts.admin')

@section('title', 'Commande')
@section('page-title', 'Détails Commande #ORD-2024-001')

@push('styles')
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
@endpush

@section('content')
<div class="space-y-6">
    
    <!-- Order Info -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Status & Actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold text-gray-900 mb-4">Statut</h3>
            
            <form id="status-form" action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="space-y-4" onsubmit="return false;">
                @csrf
                <select name="status" id="status-select" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    <option value="pending" selected>En attente</option>
                    <option value="confirmed">Confirmée</option>
                    <option value="delivered">Livrée</option>
                    <option value="cancelled">Annulée</option>
                </select>
                
                <button type="button" onclick="handleStatusUpdate()" class="w-full px-4 py-2 bg-primary text-white rounded-lg hover:bg-yellow-600">
                    Mettre à jour
                </button>
            </form>
            
            <div class="mt-4 pt-4 border-t space-y-2">
                <a href="{{ route('admin.orders.index') }}"
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
                    <p class="font-medium">Jean Dupont</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="font-medium">jean.dupont@example.com</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Téléphone</p>
                    <p class="font-medium">06 12 34 56 78</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Date</p>
                    <p class="font-medium">14/05/2024 10:30</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-600">Adresse de livraison</p>
                    <p class="font-medium">123 Rue de la Paix, 75001 Paris, France</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm text-gray-600">Notes client</p>
                    <p class="font-medium">Merci de livrer après 18h si possible.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Order Items -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6 border-b">
            <h3 class="font-semibold text-gray-900">Articles commandés</h3>
        </div>
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produit</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix unitaire</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantité</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sous-total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Static Order Item 1 -->
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1583511655857-d19b40a7a54e?auto=format&fit=crop&q=80&w=100" 
                                 class="w-12 h-12 object-cover rounded mr-3">
                            <div>
                                <p class="font-medium">Croquettes Premium Chien</p>
                                <p class="text-sm text-gray-500">Sac 12kg</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">150.00 DH</td>
                    <td class="px-6 py-4 text-sm">2</td>
                    <td class="px-6 py-4 text-sm font-medium">300.00 DH</td>
                </tr>
                <!-- Static Order Item 2 -->
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1516734212186-a967f81ad0d7?auto=format&fit=crop&q=80&w=100" 
                                 class="w-12 h-12 object-cover rounded mr-3">
                            <div>
                                <p class="font-medium">Jouet Corde pour Chien</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">45.00 DH</td>
                    <td class="px-6 py-4 text-sm">1</td>
                    <td class="px-6 py-4 text-sm font-medium">45.00 DH</td>
                </tr>
            </tbody>
            <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="3" class="px-6 py-4 text-right font-medium">Sous-total</td>
                    <td class="px-6 py-4 font-medium">345.00 DH</td>
                </tr>
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-medium">Réduction</td>
                        <td class="px-6 py-4 font-medium text-red-600">-10.00 DH</td>
                    </tr>
                <tr class="text-lg">
                    <td colspan="3" class="px-6 py-4 text-right font-bold">Total</td>
                    <td class="px-6 py-4 font-bold text-primary">335.00 DH</td>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <!-- Admin Notes -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold text-gray-900 mb-4">Notes Admin</h3>
        <form action="{{ route('admin.orders.add-notes', $order) }}" method="POST">
            @csrf
            <textarea name="admin_notes" rows="3" placeholder="Ajouter des notes privées..."
                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary mb-2">Le client a demandé une livraison express.</textarea>
            <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
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

@endsection

@push('scripts')
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
            confirmBtn.className = 'flex-1 px-4 py-2.5 bg-primary text-white rounded-lg hover:bg-yellow-600 font-medium transition-colors';
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
        const currentStatus = 'pending';
        
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
                message = 'Êtes-vous sûr de vouloir annuler cette commande ? Cette action affectera le client et l\'inventaire.';
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
                message = 'Êtes-vous sûr de vouloir confirmer cette commande ? Le client sera notifié.';
                type = 'info';
                buttonText = 'Confirmer';
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
            form.submit();
        }, type);
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
@endpush
