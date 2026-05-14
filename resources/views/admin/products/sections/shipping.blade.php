<div class="space-y-4">
    <!-- Weight -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Poids (kg)
        </label>
        <input type="number" step="0.01" name="weight" value="{{ old('weight', $product->weight ?? '') }}"
               placeholder="0.5"
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
        <p class="text-xs text-gray-500 mt-1">
            Poids du produit emballé
        </p>
    </div>

    <!-- Dimensions -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Dimensions (cm)
        </label>
        <div class="grid grid-cols-3 gap-3">
            <div>
                <input type="number" step="0.1" name="length" value="{{ old('length', $product->length ?? '') }}"
                       placeholder="Longueur"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                <p class="text-xs text-gray-500 mt-1 text-center">L</p>
            </div>
            <div>
                <input type="number" step="0.1" name="width" value="{{ old('width', $product->width ?? '') }}"
                       placeholder="Largeur"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                <p class="text-xs text-gray-500 mt-1 text-center">l</p>
            </div>
            <div>
                <input type="number" step="0.1" name="height" value="{{ old('height', $product->height ?? '') }}"
                       placeholder="Hauteur"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                <p class="text-xs text-gray-500 mt-1 text-center">H</p>
            </div>
        </div>
    </div>

    <!-- Shipping Class -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Classe d'expédition
        </label>
        <div class="space-y-2">
            <label class="flex items-center space-x-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                <input type="radio" name="shipping_class" value="standard"
                       {{ old('shipping_class', $product->shipping_class ?? 'standard') == 'standard' ? 'checked' : '' }}
                       class="text-primary focus:ring-primary">
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium">Standard</span>
                        <span class="text-xs text-gray-500">3-5 jours</span>
                    </div>
                    <p class="text-xs text-gray-500">Livraison normale</p>
                </div>
            </label>
            
            <label class="flex items-center space-x-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                <input type="radio" name="shipping_class" value="express"
                       {{ old('shipping_class', $product->shipping_class) == 'express' ? 'checked' : '' }}
                       class="text-primary focus:ring-primary">
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium">Express</span>
                        <span class="text-xs text-gray-500">1-2 jours</span>
                    </div>
                    <p class="text-xs text-gray-500">Livraison rapide</p>
                </div>
            </label>
            
            <label class="flex items-center space-x-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                <input type="radio" name="shipping_class" value="fragile"
                       {{ old('shipping_class', $product->shipping_class) == 'fragile' ? 'checked' : '' }}
                       class="text-primary focus:ring-primary">
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium">Fragile</span>
                        <span class="text-xs text-gray-500">4-6 jours</span>
                    </div>
                    <p class="text-xs text-gray-500">Emballage spécial requis</p>
                </div>
            </label>
        </div>
    </div>

    <!-- Free Shipping -->
    <div>
        <label class="flex items-center space-x-2 p-4 border-2 rounded-lg cursor-pointer hover:bg-gray-50">
            <input type="checkbox" name="free_shipping" value="1"
                   {{ old('free_shipping', $product->free_shipping ?? false) ? 'checked' : '' }}
                   class="rounded text-primary focus:ring-primary">
            <div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-shipping-fast text-primary"></i>
                    <span class="text-sm font-medium">Livraison gratuite pour ce produit</span>
                </div>
                <p class="text-xs text-gray-500 mt-1">Les frais de livraison ne seront pas appliqués</p>
            </div>
        </label>
    </div>

    <!-- Delivery Time -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Délai de livraison estimé
        </label>
        <div class="grid grid-cols-2 gap-3">
            <div>
                <input type="number" name="delivery_min_days" value="{{ old('delivery_min_days', $product->delivery_min_days ?? 3) }}"
                       min="1"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                <p class="text-xs text-gray-500 mt-1">Minimum (jours)</p>
            </div>
            <div>
                <input type="number" name="delivery_max_days" value="{{ old('delivery_max_days', $product->delivery_max_days ?? 5) }}"
                       min="1"
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                <p class="text-xs text-gray-500 mt-1">Maximum (jours)</p>
            </div>
        </div>
        <p class="text-xs text-gray-500 mt-2">
            <i class="fas fa-info-circle"></i>
            Affiché sur la page produit: "Livraison en 3-5 jours ouvrables"
        </p>
    </div>

    <!-- Shipping Cost Calculator -->
    <div class="p-4 bg-blue-50 rounded-lg">
        <label class="block text-sm font-medium text-gray-700 mb-3">
            <i class="fas fa-calculator mr-2"></i>
            Calculateur de frais de livraison
        </label>
        
        <div class="space-y-3">
            <div class="flex items-center space-x-3">
                <span class="text-sm text-gray-600 w-32">Poids:</span>
                <span id="calc-weight" class="text-sm font-medium">{{ $product->weight ?? 0 }} kg</span>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-sm text-gray-600 w-32">Dimensions:</span>
                <span id="calc-dimensions" class="text-sm font-medium">
                    {{ $product->length ?? 0 }} × {{ $product->width ?? 0 }} × {{ $product->height ?? 0 }} cm
                </span>
            </div>
            <div class="flex items-center space-x-3">
                <span class="text-sm text-gray-600 w-32">Volume:</span>
                <span id="calc-volume" class="text-sm font-medium">0 cm³</span>
            </div>
            <div class="pt-3 border-t border-blue-200">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-700">Frais estimés:</span>
                    <span id="calc-cost" class="text-lg font-bold text-primary">0.00 DH</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Special Instructions -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Instructions spéciales d'expédition
        </label>
        <textarea name="shipping_notes" rows="3"
                  placeholder="Ex: Manipuler avec précaution, garder au frais..."
                  class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ old('shipping_notes', $product->shipping_notes ?? '') }}</textarea>
    </div>
</div>

<script>
function calculateShippingCost() {
    const weight = parseFloat(document.querySelector('input[name="weight"]').value) || 0;
    const length = parseFloat(document.querySelector('input[name="length"]').value) || 0;
    const width = parseFloat(document.querySelector('input[name="width"]').value) || 0;
    const height = parseFloat(document.querySelector('input[name="height"]').value) || 0;
    
    // Update display
    document.getElementById('calc-weight').textContent = weight + ' kg';
    document.getElementById('calc-dimensions').textContent = `${length} × ${width} × ${height} cm`;
    
    // Calculate volume
    const volume = length * width * height;
    document.getElementById('calc-volume').textContent = volume.toFixed(2) + ' cm³';
    
    // Simple cost calculation (customize based on your rates)
    let cost = 0;
    
    // Base cost by weight
    if (weight > 0) {
        cost += weight * 10; // 10 DH per kg
    }
    
    // Additional cost for large items
    if (volume > 10000) { // > 10L
        cost += 20;
    }
    
    // Shipping class modifier
    const shippingClass = document.querySelector('input[name="shipping_class"]:checked').value;
    if (shippingClass === 'express') {
        cost *= 1.5;
    } else if (shippingClass === 'fragile') {
        cost *= 1.3;
    }
    
    // Free shipping override
    const freeShipping = document.querySelector('input[name="free_shipping"]').checked;
    if (freeShipping) {
        cost = 0;
    }
    
    document.getElementById('calc-cost').textContent = cost.toFixed(2) + ' DH';
}

// Add event listeners
document.addEventListener('DOMContentLoaded', function() {
    const inputs = ['weight', 'length', 'width', 'height'];
    inputs.forEach(name => {
        const input = document.querySelector(`input[name="${name}"]`);
        if (input) {
            input.addEventListener('input', calculateShippingCost);
        }
    });
    
    document.querySelectorAll('input[name="shipping_class"]').forEach(radio => {
        radio.addEventListener('change', calculateShippingCost);
    });
    
    document.querySelector('input[name="free_shipping"]').addEventListener('change', calculateShippingCost);
    
    calculateShippingCost();
});
</script>
