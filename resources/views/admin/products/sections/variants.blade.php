<div class="space-y-4">
    <!-- Enable Variants -->
    <div>
        <label class="flex items-center space-x-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
            <input type="checkbox" id="has-variants" name="has_variants" value="1"
                   checked
                   onchange="toggleVariants()"
                   class="rounded text-primary focus:ring-primary">
            <div>
                <span class="text-sm font-medium">Ce produit a des variantes</span>
                <p class="text-xs text-gray-500">Tailles, couleurs, matériaux, etc.</p>
            </div>
        </label>
    </div>

    <!-- Variants Configuration -->
    <div id="variants-config">
        
        <!-- Variant Types -->
        <div class="p-4 bg-blue-50 rounded-lg">
            <label class="block text-sm font-medium text-gray-700 mb-3">Types de variantes</label>
            
            <div class="flex flex-wrap gap-2 mb-3">
                <button type="button" onclick="addVariantType('size')" 
                        class="px-3 py-1 bg-white border rounded-lg hover:bg-gray-50 text-sm">
                    <i class="fas fa-ruler mr-1"></i>Taille
                </button>
                <button type="button" onclick="addVariantType('color')" 
                        class="px-3 py-1 bg-white border rounded-lg hover:bg-gray-50 text-sm">
                    <i class="fas fa-palette mr-1"></i>Couleur
                </button>
                <button type="button" onclick="addVariantType('material')" 
                        class="px-3 py-1 bg-white border rounded-lg hover:bg-gray-50 text-sm">
                    <i class="fas fa-cube mr-1"></i>Matériau
                </button>
                <button type="button" onclick="addVariantType('custom')" 
                        class="px-3 py-1 bg-white border rounded-lg hover:bg-gray-50 text-sm">
                    <i class="fas fa-plus mr-1"></i>Personnalisé
                </button>
            </div>

            <div id="variant-types-container" class="space-y-3">
                <!-- Variant types will be added here -->
            </div>
        </div>

        <!-- Variant Matrix -->
        <div id="variant-matrix-container" class="hidden">
            <div class="flex items-center justify-between mb-3">
                <label class="text-sm font-medium text-gray-700">Matrice des variantes</label>
                <div class="flex space-x-2">
                    <button type="button" onclick="generateVariants()" 
                            class="px-3 py-1 bg-primary text-white rounded text-sm hover:bg-yellow-600">
                        <i class="fas fa-magic mr-1"></i>Générer toutes les combinaisons
                    </button>
                    <button type="button" onclick="bulkEditVariants()" 
                            class="px-3 py-1 border rounded text-sm hover:bg-gray-50">
                        <i class="fas fa-edit mr-1"></i>Édition groupée
                    </button>
                </div>
            </div>

            <div class="variant-matrix border rounded-lg overflow-hidden">
                <table>
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Variante</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Prix (DH)</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Stock</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">SKU</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500">Image</th>
                            <th class="px-3 py-2 text-center text-xs font-medium text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="variants-table-body">
                        <!-- Static Variant Row 1 -->
                        <tr class="border-t">
                            <td class="px-3 py-2 text-sm">Taille: S - Couleur: Rouge</td>
                            <td class="px-3 py-2">
                                <input type="number" step="0.01" value="150.00" class="w-24 px-2 py-1 border rounded text-sm">
                            </td>
                            <td class="px-3 py-2">
                                <input type="number" value="10" class="w-20 px-2 py-1 border rounded text-sm">
                            </td>
                            <td class="px-3 py-2">
                                <input type="text" value="CROQ-S-RED" class="w-32 px-2 py-1 border rounded text-sm">
                            </td>
                            <td class="px-3 py-2">
                                <button type="button" class="text-blue-600 hover:text-blue-800 text-sm"><i class="fas fa-image"></i></button>
                            </td>
                            <td class="px-3 py-2 text-center">
                                <button type="button" class="text-red-600 hover:text-red-800"><i class="fas fa-trash text-sm"></i></button>
                            </td>
                        </tr>
                        <!-- Static Variant Row 2 -->
                        <tr class="border-t">
                            <td class="px-3 py-2 text-sm">Taille: M - Couleur: Rouge</td>
                            <td class="px-3 py-2">
                                <input type="number" step="0.01" value="160.00" class="w-24 px-2 py-1 border rounded text-sm">
                            </td>
                            <td class="px-3 py-2">
                                <input type="number" value="5" class="w-20 px-2 py-1 border rounded text-sm">
                            </td>
                            <td class="px-3 py-2">
                                <input type="text" value="CROQ-M-RED" class="w-32 px-2 py-1 border rounded text-sm">
                            </td>
                            <td class="px-3 py-2">
                                <button type="button" class="text-blue-600 hover:text-blue-800 text-sm"><i class="fas fa-image"></i></button>
                            </td>
                            <td class="px-3 py-2 text-center">
                                <button type="button" class="text-red-600 hover:text-red-800"><i class="fas fa-trash text-sm"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p class="text-xs text-gray-500 mt-2">
                <i class="fas fa-info-circle"></i>
                Les variantes héritent du prix de base si non spécifié
            </p>
        </div>

        <!-- Import/Export -->
        <div class="flex space-x-2">
            <button type="button" onclick="importVariants()" 
                    class="flex-1 px-4 py-2 border rounded-lg hover:bg-gray-50 text-sm">
                <i class="fas fa-file-import mr-2"></i>Importer depuis CSV
            </button>
            <button type="button" onclick="exportVariants()" 
                    class="flex-1 px-4 py-2 border rounded-lg hover:bg-gray-50 text-sm">
                <i class="fas fa-file-export mr-2"></i>Exporter vers CSV
            </button>
        </div>
    </div>
</div>

<script>
let variantTypes = [];
let variantOptions = {};

function toggleVariants() {
    const checkbox = document.getElementById('has-variants');
    const config = document.getElementById('variants-config');
    config.classList.toggle('hidden', !checkbox.checked);
}

function addVariantType(type) {
    const container = document.getElementById('variant-types-container');
    const id = 'variant-type-' + Date.now();
    
    let typeName = type === 'custom' ? prompt('Nom du type de variante:') : type;
    if (!typeName) return;
    
    const div = document.createElement('div');
    div.className = 'p-3 bg-white border rounded-lg';
    div.id = id;
    div.innerHTML = `
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium capitalize">${typeName}</span>
            <button type="button" onclick="removeVariantType('${id}')" class="text-red-600 hover:text-red-800">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="flex flex-wrap gap-2 mb-2" id="${id}-options">
            <!-- Options will be added here -->
        </div>
        <div class="flex space-x-2">
            <input type="text" id="${id}-input" placeholder="Ajouter une option..." 
                   class="flex-1 px-3 py-1 border rounded text-sm"
                   onkeypress="if(event.key==='Enter'){event.preventDefault();addVariantOption('${id}','${typeName}');}">
            <button type="button" onclick="addVariantOption('${id}','${typeName}')" 
                    class="px-3 py-1 bg-primary text-white rounded text-sm hover:bg-yellow-600">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    `;
    
    container.appendChild(div);
    variantTypes.push({id, type: typeName});
    variantOptions[id] = [];
    
    document.getElementById('variant-matrix-container').classList.remove('hidden');
}

function removeVariantType(id) {
    document.getElementById(id).remove();
    variantTypes = variantTypes.filter(t => t.id !== id);
    delete variantOptions[id];
    
    if (variantTypes.length === 0) {
        document.getElementById('variant-matrix-container').classList.add('hidden');
    }
}

function addVariantOption(typeId, typeName) {
    const input = document.getElementById(typeId + '-input');
    const value = input.value.trim();
    if (!value) return;
    
    const optionsContainer = document.getElementById(typeId + '-options');
    const optionId = 'option-' + Date.now();
    
    const span = document.createElement('span');
    span.className = 'px-3 py-1 bg-gray-100 rounded-full text-sm flex items-center space-x-2';
    span.id = optionId;
    span.innerHTML = `
        <span>${value}</span>
        <button type="button" onclick="removeVariantOption('${optionId}','${typeId}')" 
                class="text-gray-600 hover:text-red-600">
            <i class="fas fa-times text-xs"></i>
        </button>
    `;
    
    optionsContainer.appendChild(span);
    variantOptions[typeId].push({id: optionId, value});
    input.value = '';
}

function removeVariantOption(optionId, typeId) {
    document.getElementById(optionId).remove();
    variantOptions[typeId] = variantOptions[typeId].filter(o => o.id !== optionId);
}

function generateVariants() {
    if (variantTypes.length === 0) {
        alert('Veuillez d\'abord ajouter des types de variantes');
        return;
    }
    
    // Generate all combinations
    const combinations = generateCombinations();
    const tbody = document.getElementById('variants-table-body');
    tbody.innerHTML = '';
    
    combinations.forEach((combo, index) => {
        const row = document.createElement('tr');
        row.className = 'border-t';
        row.innerHTML = `
            <td class="px-3 py-2 text-sm">${combo.name}</td>
            <td class="px-3 py-2">
                <input type="number" step="0.01" name="new_variants[${index}][price]" 
                       placeholder="Prix de base"
                       class="w-24 px-2 py-1 border rounded text-sm">
            </td>
            <td class="px-3 py-2">
                <input type="number" name="new_variants[${index}][stock]" value="0"
                       class="w-20 px-2 py-1 border rounded text-sm">
            </td>
            <td class="px-3 py-2">
                <input type="text" name="new_variants[${index}][sku]" value="${combo.sku}"
                       class="w-32 px-2 py-1 border rounded text-sm">
            </td>
            <td class="px-3 py-2">
                <button type="button" class="text-blue-600 hover:text-blue-800 text-sm">
                    <i class="fas fa-image"></i>
                </button>
            </td>
            <td class="px-3 py-2 text-center">
                <button type="button" onclick="this.closest('tr').remove()" 
                        class="text-red-600 hover:text-red-800">
                    <i class="fas fa-trash text-sm"></i>
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });
    
    alert(`${combinations.length} variantes générées`);
}

function generateCombinations() {
    const allOptions = Object.values(variantOptions);
    if (allOptions.length === 0) return [];
    
    function cartesian(arrays) {
        return arrays.reduce((acc, array) => 
            acc.flatMap(x => array.map(y => [...x, y])), [[]]
        );
    }
    
    const optionArrays = allOptions.map(opts => opts.map(o => o.value));
    const combinations = cartesian(optionArrays);
    
    return combinations.map((combo, index) => ({
        name: combo.join(' - '),
        sku: `VAR-${index + 1}`
    }));
}

function bulkEditVariants() {
    const price = prompt('Prix pour toutes les variantes (laisser vide pour ignorer):');
    const stock = prompt('Stock pour toutes les variantes (laisser vide pour ignorer):');
    
    if (price) {
        document.querySelectorAll('input[name*="[price]"]').forEach(input => {
            input.value = price;
        });
    }
    
    if (stock) {
        document.querySelectorAll('input[name*="[stock]"]').forEach(input => {
            input.value = stock;
        });
    }
}

function deleteVariant(variantId) {
    if (confirm('Supprimer cette variante ?')) {
        // AJAX delete
        fetch(`/admin/products/variants/${variantId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }
}

function importVariants() {
    alert('Fonctionnalité d\'import CSV à venir');
}

function exportVariants() {
    alert('Fonctionnalité d\'export CSV à venir');
}
</script>
