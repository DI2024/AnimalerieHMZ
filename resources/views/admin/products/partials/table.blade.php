<table class="w-full">
    <thead class="bg-gray-50 sticky top-0">
        <tr>
            <th class="px-4 py-3 text-left">
                <input type="checkbox" id="select-all-table" class="rounded text-primary focus:ring-primary">
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stats</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        <!-- Row 1 -->
        <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-4 py-4"><input type="checkbox" class="rounded text-primary"></td>
            <td class="px-6 py-4">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gray-100 rounded"></div>
                    <div>
                        <p class="font-medium text-gray-900">Croquettes Premium Bio</p>
                        <p class="text-xs text-gray-500">SKU: PRD-1024</p>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 text-sm text-gray-700">Chiens</td>
            <td class="px-6 py-4">
                <p class="text-sm font-bold text-gray-900">250.00 DH</p>
                <p class="text-xs text-gray-400 line-through">312.50 DH</p>
            </td>
            <td class="px-6 py-4">
                <span class="text-sm font-medium text-green-600">24 unités</span>
            </td>
            <td class="px-6 py-4">
                <div class="space-y-1 text-xs text-gray-600">
                    <div><i class="fas fa-shopping-cart mr-1"></i> 45 ventes</div>
                    <div><i class="fas fa-star text-yellow-400 mr-1"></i> 4.8</div>
                </div>
            </td>
            <td class="px-6 py-4">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-green-500 after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full"></div>
                </label>
            </td>
            <td class="px-6 py-4 text-sm">
                <div class="flex items-center space-x-2">
                    <button class="text-blue-600 hover:text-blue-800"><i class="fas fa-eye"></i></button>
                    <button class="text-green-600 hover:text-green-800"><i class="fas fa-edit"></i></button>
                    <button class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                </div>
            </td>
        </tr>
    </tbody>
</table>
