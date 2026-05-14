<div class="space-y-4">
    <!-- Meta Title -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Titre SEO (Meta Title)
        </label>
        <input type="text" name="meta_title" id="meta-title" maxlength="60"
               value="{{ old('meta_title', $product->meta_title ?? $product->name) }}"
               oninput="updateCharCount(this, 60); calculateSEOScore()"
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
        <div class="flex justify-between text-xs mt-1">
            <span class="text-gray-500">Optimal: 50-60 caractères</span>
            <span class="char-counter" id="meta-title-counter">0/60</span>
        </div>
    </div>

    <!-- Meta Description -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Description SEO (Meta Description)
        </label>
        <textarea name="meta_description" id="meta-description" rows="3" maxlength="160"
                  oninput="updateCharCount(this, 160); calculateSEOScore()"
                  class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">{{ old('meta_description', $product->meta_description ?? $product->short_description) }}</textarea>
        <div class="flex justify-between text-xs mt-1">
            <span class="text-gray-500">Optimal: 150-160 caractères</span>
            <span class="char-counter" id="meta-description-counter">0/160</span>
        </div>
    </div>

    <!-- Focus Keyword -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Mot-clé principal
        </label>
        <input type="text" name="focus_keyword" id="focus-keyword"
               value="{{ old('focus_keyword', $product->focus_keyword ?? '') }}"
               placeholder="Ex: crème de beauté naturelle"
               oninput="calculateSEOScore()"
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
        <p class="text-xs text-gray-500 mt-1">
            Le mot-clé principal pour lequel vous souhaitez être référencé
        </p>
    </div>

    <!-- SEO Score -->
    <div class="p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg">
        <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-700">Score SEO</span>
            <span id="seo-score-value" class="text-2xl font-bold text-gray-900">0/100</span>
        </div>
        
        <div class="seo-score mb-3">
            <div class="seo-score-bar">
                <div id="seo-score-fill" class="seo-score-fill bg-gray-300" style="width: 0%"></div>
            </div>
        </div>

        <!-- SEO Checklist -->
        <div class="space-y-2 text-sm">
            <div id="seo-check-title" class="flex items-center space-x-2 text-gray-500">
                <i class="fas fa-circle text-xs"></i>
                <span>Le titre contient le mot-clé</span>
            </div>
            <div id="seo-check-description" class="flex items-center space-x-2 text-gray-500">
                <i class="fas fa-circle text-xs"></i>
                <span>La description contient le mot-clé</span>
            </div>
            <div id="seo-check-slug" class="flex items-center space-x-2 text-gray-500">
                <i class="fas fa-circle text-xs"></i>
                <span>L'URL contient le mot-clé</span>
            </div>
            <div id="seo-check-length-title" class="flex items-center space-x-2 text-gray-500">
                <i class="fas fa-circle text-xs"></i>
                <span>Longueur du titre optimale (50-60 car.)</span>
            </div>
            <div id="seo-check-length-desc" class="flex items-center space-x-2 text-gray-500">
                <i class="fas fa-circle text-xs"></i>
                <span>Longueur de la description optimale (150-160 car.)</span>
            </div>
            <div id="seo-check-images" class="flex items-center space-x-2 text-gray-500">
                <i class="fas fa-circle text-xs"></i>
                <span>Images avec texte alternatif</span>
            </div>
        </div>
    </div>

    <!-- Social Media Preview -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-3">
            Aperçu réseaux sociaux
        </label>
        
        <div class="border rounded-lg p-4 bg-gray-50">
            <div class="flex items-start space-x-3">
                <div class="w-24 h-24 bg-gray-200 rounded flex-shrink-0 overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-2xl"></i>
                        </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p id="social-title" class="font-medium text-blue-600 mb-1 truncate">
                        {{ $product->meta_title ?? $product->name }}
                    </p>
                    <p id="social-description" class="text-sm text-gray-600 line-clamp-2 mb-1">
                        {{ $product->meta_description ?? $product->short_description ?? 'Description du produit...' }}
                    </p>
                    <p class="text-xs text-gray-500">lotusdiamant.com</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Structured Data Preview -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Données structurées (JSON-LD)
        </label>
        <div class="bg-gray-900 text-green-400 p-4 rounded-lg text-xs font-mono overflow-x-auto">
<pre>{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $product->name }}",
  "image": "{{ asset('storage/' . $product->image) }}",
  "description": "{{ $product->short_description }}",
  "sku": "PRD-{{ $product->id }}",
  "brand": {
    "@type": "Brand",
    "name": "Lotus Diamant"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{ url('/products/' . $product->slug) }}",
    "priceCurrency": "MAD",
    "price": "{{ $product->price }}",
    "availability": "{{ $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}"
  }
}</pre>
        </div>
        <p class="text-xs text-gray-500 mt-2">
            <i class="fas fa-info-circle"></i>
            Ces données aident Google à mieux comprendre votre produit
        </p>
    </div>

    <!-- Indexation -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Options d'indexation</label>
        <div class="space-y-2">
            <label class="flex items-center space-x-2 p-2 border rounded cursor-pointer hover:bg-gray-50">
                <input type="checkbox" name="no_index" value="1"
                       {{ old('no_index', $product->no_index ?? false) ? 'checked' : '' }}
                       class="rounded text-primary focus:ring-primary">
                <div>
                    <span class="text-sm font-medium">Ne pas indexer (noindex)</span>
                    <p class="text-xs text-gray-500">Empêcher les moteurs de recherche d'indexer cette page</p>
                </div>
            </label>
            
            <label class="flex items-center space-x-2 p-2 border rounded cursor-pointer hover:bg-gray-50">
                <input type="checkbox" name="no_follow" value="1"
                       {{ old('no_follow', $product->no_follow ?? false) ? 'checked' : '' }}
                       class="rounded text-primary focus:ring-primary">
                <div>
                    <span class="text-sm font-medium">Ne pas suivre les liens (nofollow)</span>
                    <p class="text-xs text-gray-500">Empêcher les moteurs de suivre les liens de cette page</p>
                </div>
            </label>
        </div>
    </div>
</div>

<script>
function calculateSEOScore() {
    const title = document.getElementById('meta-title').value.toLowerCase();
    const description = document.getElementById('meta-description').value.toLowerCase();
    const keyword = document.getElementById('focus-keyword').value.toLowerCase();
    const slug = document.getElementById('product-slug').value.toLowerCase();
    
    let score = 0;
    let checks = {
        title: false,
        description: false,
        slug: false,
        lengthTitle: false,
        lengthDesc: false,
        images: true // Assume true for now
    };
    
    // Check keyword in title
    if (keyword && title.includes(keyword)) {
        score += 20;
        checks.title = true;
    }
    
    // Check keyword in description
    if (keyword && description.includes(keyword)) {
        score += 20;
        checks.description = true;
    }
    
    // Check keyword in slug
    if (keyword && slug.includes(keyword.replace(/\s+/g, '-'))) {
        score += 15;
        checks.slug = true;
    }
    
    // Check title length
    if (title.length >= 50 && title.length <= 60) {
        score += 15;
        checks.lengthTitle = true;
    }
    
    // Check description length
    if (description.length >= 150 && description.length <= 160) {
        score += 15;
        checks.lengthDesc = true;
    }
    
    // Images check (placeholder)
    score += 15;
    
    // Update score display
    document.getElementById('seo-score-value').textContent = score + '/100';
    const fill = document.getElementById('seo-score-fill');
    fill.style.width = score + '%';
    
    // Update color based on score
    if (score >= 80) {
        fill.className = 'seo-score-fill bg-green-500';
    } else if (score >= 60) {
        fill.className = 'seo-score-fill bg-yellow-500';
    } else if (score >= 40) {
        fill.className = 'seo-score-fill bg-orange-500';
    } else {
        fill.className = 'seo-score-fill bg-red-500';
    }
    
    // Update checklist
    updateCheckItem('seo-check-title', checks.title);
    updateCheckItem('seo-check-description', checks.description);
    updateCheckItem('seo-check-slug', checks.slug);
    updateCheckItem('seo-check-length-title', checks.lengthTitle);
    updateCheckItem('seo-check-length-desc', checks.lengthDesc);
    updateCheckItem('seo-check-images', checks.images);
    
    // Update social preview
    document.getElementById('social-title').textContent = title || 'Titre du produit';
    document.getElementById('social-description').textContent = description || 'Description du produit...';
}

function updateCheckItem(id, passed) {
    const element = document.getElementById(id);
    if (passed) {
        element.className = 'flex items-center space-x-2 text-green-600';
        element.querySelector('i').className = 'fas fa-check-circle text-xs';
    } else {
        element.className = 'flex items-center space-x-2 text-gray-500';
        element.querySelector('i').className = 'fas fa-circle text-xs';
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    const metaTitle = document.getElementById('meta-title');
    const metaDesc = document.getElementById('meta-description');
    
    if (metaTitle) updateCharCount(metaTitle, 60);
    if (metaDesc) updateCharCount(metaDesc, 160);
    
    calculateSEOScore();
});
</script>
