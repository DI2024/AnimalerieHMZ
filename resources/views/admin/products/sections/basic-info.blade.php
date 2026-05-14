<div class="space-y-4">
    <!-- Category -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Catégorie <span class="text-red-500">*</span>
        </label>
        <select name="category_id" required onchange="updatePreview()"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            <option value="">Sélectionner une catégorie</option>
            <option value="1" selected>Chiens</option>
            <option value="2">Chats</option>
            <option value="3">Oiseaux</option>
        </select>
    </div>

    <!-- Slug -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            URL Slug
        </label>
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-500">/products/</span>
            <input type="text" name="slug" id="product-slug" value="croquettes-premium-chien"
                   class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            <button type="button" onclick="generateSlug()" class="px-3 py-2 border rounded-lg hover:bg-gray-50">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
        <p class="text-xs text-gray-500 mt-1">
            <span id="slug-status" class="text-green-600"><i class="fas fa-check-circle"></i> Disponible</span>
        </p>
    </div>

    <!-- Short Description -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Description courte
            <span class="text-xs text-gray-500">(Pour les cartes produits)</span>
        </label>
        <textarea name="short_description" id="short-description" rows="2" maxlength="150"
                  oninput="updateCharCount(this, 150); updatePreview()"
                  class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">Croquettes de haute qualité pour chiens adultes de toutes races.</textarea>
        <div class="flex justify-between text-xs mt-1">
            <span class="text-gray-500">Idéal pour les aperçus</span>
            <span class="char-counter" id="short-description-counter">0/150</span>
        </div>
    </div>

    <!-- Full Description -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Description complète <span class="text-red-500">*</span>
        </label>
        <textarea name="description" id="description" rows="6" required
                  oninput="updatePreview()"
                  class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">Nos croquettes premium sont formulées avec des ingrédients naturels pour assurer une digestion optimale et un pelage brillant à votre chien. Riches en protéines et sans additifs artificiels.</textarea>
        <p class="text-xs text-gray-500 mt-1">
            Décrivez votre produit en détail. Utilisez des paragraphes pour une meilleure lisibilité.
        </p>
    </div>

    <!-- Product Flags -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-3">Drapeaux du produit</label>
        <div class="grid grid-cols-2 gap-3">
            <label class="flex items-center space-x-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                <input type="checkbox" name="is_featured" value="1" checked
                       class="rounded text-primary focus:ring-primary">
                <div>
                    <span class="text-sm font-medium">En vedette</span>
                    <p class="text-xs text-gray-500">Affiché en priorité</p>
                </div>
            </label>
            
            <label class="flex items-center space-x-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                <input type="checkbox" name="is_bestseller" value="1" checked
                       class="rounded text-primary focus:ring-primary">
                <div>
                    <span class="text-sm font-medium">Bestseller</span>
                    <p class="text-xs text-gray-500">Produit populaire</p>
                </div>
            </label>
            
            <label class="flex items-center space-x-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                <input type="checkbox" name="is_new" value="1" id="is-new-checkbox" checked
                       onchange="toggleNewOptions()"
                       class="rounded text-primary focus:ring-primary">
                <div>
                    <span class="text-sm font-medium">Nouveau</span>
                    <p class="text-xs text-gray-500">Badge "NEW"</p>
                </div>
            </label>
            
            <label class="flex items-center space-x-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                <input type="checkbox" name="is_active" value="1" checked
                       class="rounded text-primary focus:ring-primary">
                <div>
                    <span class="text-sm font-medium">Actif</span>
                    <p class="text-xs text-gray-500">Visible sur le site</p>
                </div>
            </label>
        </div>
        
        <!-- Auto-remove New Badge -->
        <div id="new-options" class="mt-3 p-3 bg-blue-50 rounded-lg">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="auto_remove_new" value="1" class="rounded text-primary focus:ring-primary">
                <span class="text-sm">Retirer automatiquement le badge "NEW" après</span>
                <input type="number" name="new_days" value="30" min="1" class="w-16 px-2 py-1 border rounded text-sm">
                <span class="text-sm">jours</span>
            </label>
        </div>
    </div>

    <!-- Custom Badge -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Badge personnalisé</label>
        <div class="flex items-center space-x-3">
            <input type="text" name="badge" id="badge-text" value="PROMO"
                   placeholder="Ex: -50%, HOT, PROMO"
                   oninput="updateBadgePreview()"
                   class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
            <input type="color" name="badge_color" id="badge-color" value="#d4af37"
                   onchange="updateBadgePreview()"
                   class="w-16 h-10 border rounded cursor-pointer">
            <div id="badge-preview" class="px-3 py-1 rounded text-white text-sm font-bold" style="background: #d4af37;">
                BADGE
            </div>
        </div>
    </div>
</div>

<script>
function generateSlug() {
    const name = document.getElementById('product-name').value;
    const slug = name.toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
    document.getElementById('product-slug').value = slug;
    checkSlugAvailability(slug);
}

function checkSlugAvailability(slug) {
    // Simulate slug check (implement actual check via AJAX)
    document.getElementById('slug-status').innerHTML = '<i class="fas fa-check-circle"></i> Disponible';
}

function updateCharCount(textarea, max) {
    const counter = document.getElementById(textarea.id + '-counter');
    const length = textarea.value.length;
    counter.textContent = length + '/' + max;
    
    if (length > max * 0.9) {
        counter.classList.add('warning');
    } else {
        counter.classList.remove('warning');
    }
    
    if (length >= max) {
        counter.classList.add('error');
    } else {
        counter.classList.remove('error');
    }
}

function toggleNewOptions() {
    const checkbox = document.getElementById('is-new-checkbox');
    const options = document.getElementById('new-options');
    options.classList.toggle('hidden', !checkbox.checked);
}

function updateBadgePreview() {
    const text = document.getElementById('badge-text').value || 'BADGE';
    const color = document.getElementById('badge-color').value;
    const preview = document.getElementById('badge-preview');
    preview.textContent = text;
    preview.style.background = color;
}

// Initialize char counters
document.addEventListener('DOMContentLoaded', function() {
    const shortDesc = document.getElementById('short-description');
    if (shortDesc) {
        updateCharCount(shortDesc, 150);
    }
    updateBadgePreview();
});
</script>
