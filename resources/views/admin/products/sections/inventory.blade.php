<div class="space-y-4">
    <!-- Stock Quantity -->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Quantité en stock <span class="text-red-500">*</span>
            </label>
            <input type="number" name="stock" id="stock-quantity" 
                   value="45" required min="0"
                   oninput="updateStockStatus()"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            <p class="text-xs text-gray-500 mt-1">Nombre d'unités disponibles</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Seuil d'alerte <span class="text-red-500">*</span>
            </label>
            <input type="number" name="stock_alert" id="stock-alert" 
                   value="10" required min="0"
                   oninput="updateStockStatus()"
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            <p class="text-xs text-gray-500 mt-1">Alerte si stock ≤ ce seuil</p>
        </div>
    </div>

    <!-- Stock Status Indicator -->
    <div id="stock-status" class="p-4 rounded-lg">
        <!-- Dynamically updated by JavaScript -->
    </div>
</div>

<script>
function updateStockStatus() {
    const stock = parseInt(document.getElementById('stock-quantity').value) || 0;
    const alert = parseInt(document.getElementById('stock-alert').value) || 0;
    const statusDiv = document.getElementById('stock-status');
    
    if (stock === 0) {
        statusDiv.className = 'p-4 rounded-lg bg-red-50 border border-red-200';
        statusDiv.innerHTML = `
            <div class="flex items-center space-x-2">
                <i class="fas fa-times-circle text-red-600 text-xl"></i>
                <div>
                    <span class="text-sm font-medium text-red-800">Rupture de stock</span>
                    <p class="text-xs text-red-600 mt-1">Le produit n'est pas disponible à la vente</p>
                </div>
            </div>
        `;
    } else if (stock <= alert) {
        statusDiv.className = 'p-4 rounded-lg bg-orange-50 border border-orange-200';
        statusDiv.innerHTML = `
            <div class="flex items-center space-x-2">
                <i class="fas fa-exclamation-triangle text-orange-600 text-xl"></i>
                <div>
                    <span class="text-sm font-medium text-orange-800">Stock faible</span>
                    <p class="text-xs text-orange-600 mt-1">Réapprovisionnement recommandé (${stock} unités restantes)</p>
                </div>
            </div>
        `;
    } else {
        statusDiv.className = 'p-4 rounded-lg bg-green-50 border border-green-200';
        statusDiv.innerHTML = `
            <div class="flex items-center space-x-2">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                <div>
                    <span class="text-sm font-medium text-green-800">Stock suffisant</span>
                    <p class="text-xs text-green-600 mt-1">${stock} unités disponibles</p>
                </div>
            </div>
        `;
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updateStockStatus();
});
</script>
