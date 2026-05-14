<div class="space-y-4">
    <!-- Regular Price -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Prix (DH) <span class="text-red-500">*</span>
        </label>
        <input type="number" step="0.01" name="price" id="regular-price" 
               value="150.00" required
               oninput="updatePreview()"
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
        <p class="text-xs text-gray-500 mt-1">Prix de vente du produit</p>
    </div>

    <!-- Old Price (for discount display) -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Ancien prix (DH)
            <span class="text-xs text-gray-500">(Optionnel - pour afficher une réduction)</span>
        </label>
        <input type="number" step="0.01" name="price_old" id="old-price"
               value="180.00"
               oninput="calculateDiscount()"
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
        <p class="text-xs text-gray-500 mt-1">Si renseigné, affichera une réduction sur le produit</p>
    </div>

    <!-- Discount Preview -->
    <div id="discount-preview" class="p-4 bg-green-50 rounded-lg border border-green-200 hidden">
        <div class="flex items-center justify-between">
            <span class="text-sm font-medium text-gray-700">Réduction affichée:</span>
            <span id="discount-percentage" class="text-xl font-bold text-green-600">0%</span>
        </div>
        <p class="text-xs text-gray-500 mt-2">
            <i class="fas fa-info-circle"></i>
            Le client verra: <span class="line-through" id="preview-old-price">0.00 DH</span> 
            <span class="text-green-600 font-bold" id="preview-new-price">0.00 DH</span>
        </p>
    </div>
</div>

<script>
function calculateDiscount() {
    const regularPrice = parseFloat(document.getElementById('regular-price').value) || 0;
    const oldPrice = parseFloat(document.getElementById('old-price').value) || 0;
    const preview = document.getElementById('discount-preview');
    
    if (oldPrice > 0 && regularPrice > 0 && oldPrice > regularPrice) {
        const discount = ((oldPrice - regularPrice) / oldPrice * 100).toFixed(0);
        document.getElementById('discount-percentage').textContent = '-' + discount + '%';
        document.getElementById('preview-old-price').textContent = oldPrice.toFixed(2) + ' DH';
        document.getElementById('preview-new-price').textContent = regularPrice.toFixed(2) + ' DH';
        preview.classList.remove('hidden');
    } else {
        preview.classList.add('hidden');
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    calculateDiscount();
});
</script>
