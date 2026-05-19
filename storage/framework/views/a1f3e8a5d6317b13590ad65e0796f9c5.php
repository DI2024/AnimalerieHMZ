<?php $__env->startSection('title', 'Offres'); ?>
<?php $__env->startSection('page-title', 'Gestion des Offres'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Statistics Cards */
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    /* Layout with Sidebar */
    .content-with-sidebar {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 24px;
        align-items: start;
    }
    @media (max-width: 1024px) {
        .content-with-sidebar {
            grid-template-columns: 1fr;
        }
    }
    
    /* Filter Chips */
    .filter-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 16px;
    }
    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: #fef3c7;
        color: #92400e;
        border-radius: 9999px;
        font-size: 13px;
        font-weight: 500;
    }
    .filter-chip button {
        background: none;
        border: none;
        color: inherit;
        cursor: pointer;
        padding: 0;
        display: flex;
        align-items: center;
    }
    
    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 500;
        gap: 4px;
    }
    .status-active { background: #d1fae5; color: #065f46; }
    .status-expiring { background: #fef3c7; color: #92400e; }
    .status-expired { background: #fee2e2; color: #991b1b; }
    .status-inactive { background: #f3f4f6; color: #4b5563; }
    
    /* Countdown Timer */
    .countdown {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        color: #059669;
        background: #d1fae5;
        padding: 2px 8px;
        border-radius: 4px;
    }
    .countdown.warning { color: #d97706; background: #fef3c7; }
    .countdown.danger { color: #dc2626; background: #fee2e2; }
    
    /* Bulk Action Bar */
    .bulk-action-bar {
        position: fixed;
        bottom: 24px;
        left: 50%;
        transform: translateX(-50%);
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        padding: 16px 24px;
        display: none;
        align-items: center;
        gap: 16px;
        z-index: 50;
        min-width: 600px;
    }
    .bulk-action-bar.active {
        display: flex;
    }
    
    /* Quick Actions Dropdown */
    .dropdown {
        position: relative;
    }
    .dropdown-menu {
        position: absolute;
        right: 0;
        top: 100%;
        margin-top: 8px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        min-width: 200px;
        display: none;
        z-index: 10;
    }
    .dropdown-menu.active {
        display: block;
    }
    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        color: #374151;
        text-decoration: none;
        transition: background 0.2s;
        cursor: pointer;
    }
    .dropdown-item:hover {
        background: #f3f4f6;
    }
    .dropdown-item:first-child {
        border-radius: 8px 8px 0 0;
    }
    .dropdown-item:last-child {
        border-radius: 0 0 8px 8px;
    }
    .dropdown-divider {
        height: 1px;
        background: #e5e7eb;
        margin: 4px 0;
    }
    
    /* Type Filter */
    .type-filter {
        display: flex;
        gap: 8px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 4px;
        background: #f9fafb;
    }
    .type-filter button {
        padding: 8px 16px;
        background: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 14px;
        font-weight: 500;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .type-filter button:hover {
        background: #f3f4f6;
        color: #374151;
    }
    .type-filter button.active {
        background: #d4af37;
        color: white;
        box-shadow: 0 2px 4px rgba(212, 175, 55, 0.3);
    }
    .type-filter .count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 20px;
        height: 20px;
        padding: 0 6px;
        background: rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        font-size: 11px;
        font-weight: 600;
    }
    .type-filter button.active .count-badge {
        background: rgba(255, 255, 255, 0.3);
    }
    
    /* View Toggle */
    .view-toggle {
        display: flex;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
    }
    .view-toggle button {
        padding: 8px 16px;
        background: white;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    .view-toggle button.active {
        background: #d4af37;
        color: white;
    }
    
    /* Grid View */
    .offers-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    
    /* Responsive breakpoints */
    @media (max-width: 1400px) {
        .offers-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .offers-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .offer-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .offer-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        border-color: #d4af37;
    }
    
    /* Line clamp utility */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Inline Edit */
    .inline-edit {
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 4px;
        transition: background 0.2s;
    }
    .inline-edit:hover {
        background: #f3f4f6;
    }
    .inline-edit-input {
        padding: 4px 8px;
        border: 2px solid #d4af37;
        border-radius: 4px;
        font-size: inherit;
        font-weight: inherit;
    }
    
    /* Details Modal */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        backdrop-filter: blur(4px);
    }
    .modal-overlay.hidden {
        display: none;
    }
    .modal-container {
        background: white;
        border-radius: 16px;
        max-width: 1200px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: modalSlideIn 0.3s ease-out;
    }
    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 24px;
        border-bottom: 1px solid #e5e7eb;
        position: sticky;
        top: 0;
        background: white;
        z-index: 10;
    }
    .close-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f4f6;
        color: #6b7280;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    .close-btn:hover {
        background: #e5e7eb;
        color: #374151;
    }
    .modal-body {
        padding: 24px;
    }
    .modal-grid {
        display: grid;
        grid-template-columns: 60% 40%;
        gap: 24px;
    }
    .modal-left, .modal-right {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    /* Modal Sections */
    .modal-section {
        background: #f9fafb;
        border-radius: 12px;
        padding: 20px;
    }
    .modal-section-title {
        font-size: 14px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    /* Pack Image */
    .pack-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .pack-image-placeholder {
        width: 100%;
        height: 300px;
        background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 80px;
        color: white;
    }
    
    /* Pricing Card */
    .pricing-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    .pricing-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f3f4f6;
    }
    .pricing-row:last-child {
        border-bottom: none;
    }
    .pricing-row.highlight {
        background: #d1fae5;
        margin: 0 -20px;
        padding: 12px 20px;
        border-radius: 8px;
        border-bottom: none;
    }
    
    /* Products Grid */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 16px;
        margin-top: 16px;
    }
    .product-card-modal {
        background: white;
        border-radius: 8px;
        padding: 12px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s;
    }
    .product-card-modal:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .product-card-modal img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 6px;
        margin-bottom: 8px;
    }
    .product-card-modal h4 {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 4px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .product-card-modal .price {
        font-size: 16px;
        font-weight: 700;
        color: #d4af37;
        margin-bottom: 4px;
    }
    .product-card-modal .discounted-price {
        font-size: 14px;
        color: #10b981;
        font-weight: 600;
    }
    .product-card-modal .original-price {
        font-size: 12px;
        color: #9ca3af;
        text-decoration: line-through;
    }
    .category-badge-modal {
        display: inline-block;
        padding: 4px 8px;
        background: #e5e7eb;
        color: #6b7280;
        border-radius: 4px;
        font-size: 11px;
        font-weight: 500;
    }
    
    /* Categories List */
    .categories-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 16px;
    }
    .category-item {
        background: white;
        padding: 12px 16px;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
    .category-item-name {
        font-weight: 600;
        color: #374151;
    }
    .category-item-count {
        background: #e5e7eb;
        padding: 4px 12px;
        border-radius: 12px;
        font-size: 12px;
        color: #6b7280;
    }
    
    /* Info Rows */
    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border-bottom: 1px solid #e5e7eb;
    }
    .info-row:last-child {
        border-bottom: none;
    }
    .info-label {
        color: #6b7280;
        font-size: 14px;
    }
    .info-value {
        color: #374151;
        font-weight: 600;
        font-size: 14px;
    }
    
    /* Action Buttons */
    .modal-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    .modal-action-btn {
        padding: 12px 16px;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .modal-action-btn.full-width {
        grid-column: 1 / -1;  /* Span all columns for delete button */
    }
    .modal-action-btn.primary {
        background: #d4af37;
        color: white;
    }
    .modal-action-btn.primary:hover {
        background: #c19b2e;
    }
    .modal-action-btn.secondary {
        background: #f3f4f6;
        color: #374151;
    }
    .modal-action-btn.secondary:hover {
        background: #e5e7eb;
    }
    .modal-action-btn.danger {
        background: #fee2e2;
        color: #dc2626;
    }
    .modal-action-btn.danger:hover {
        background: #fecaca;
    }
    
    /* Type Badges */
    .type-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
    }
    .badge-pack {
        background: #e9d5ff;
        color: #7c3aed;
    }
    .badge-percentage {
        background: #dbeafe;
        color: #2563eb;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .modal-grid {
            grid-template-columns: 1fr;
        }
        .products-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .modal-actions {
            grid-template-columns: 1fr;  /* Stack all buttons on mobile */
        }
        .modal-action-btn.full-width {
            grid-column: 1;  /* Reset to single column on mobile */
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Offres</p>
                    <p class="text-3xl font-bold text-gray-900"><?php echo e($stats['total']); ?></p>
                </div>
                <div class="stat-icon" style="background: linear-gradient(135deg, #003e87 0%, #0855b1 100%);">
                    <i class="fas fa-tags text-white"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Offres Actives</p>
                    <p class="text-3xl font-bold text-green-600"><?php echo e($stats['active']); ?></p>
                </div>
                <div class="stat-icon bg-green-100 text-green-600">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Offres Inactives</p>
                    <p class="text-3xl font-bold text-gray-600"><?php echo e($stats['total'] - $stats['active']); ?></p>
                </div>
                <div class="stat-icon bg-gray-100 text-gray-600">
                    <i class="fas fa-pause-circle"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Search & Actions Bar -->
    <div class="bg-white rounded-lg shadow p-4">
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <!-- Search -->
            <div class="relative flex-1 max-w-md">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" 
                       id="searchInput" 
                       class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                       style="border-color: #e5e7eb; focus:ring-color: #003e87;"
                       placeholder="Rechercher une offre..."
                       value="<?php echo e(request('search')); ?>">
            </div>
            
            <!-- New Offer Button -->
            <a href="<?php echo e(route('admin.offers.create')); ?>" 
               class="px-6 py-2 text-white rounded-lg transition-colors flex items-center gap-2" 
               style="background: #003e87;" 
               onmouseover="this.style.background='#0855b1'" 
               onmouseout="this.style.background='#003e87'">
                <i class="fas fa-plus"></i>
                <span>Nouvelle Offre</span>
            </a>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="space-y-4">
            <!-- Table View -->
            <div id="tableView" class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Image
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Titre
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Badge
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Date Création
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Statut
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <?php if($offer->image): ?>
                                    <?php if(filter_var($offer->image, FILTER_VALIDATE_URL)): ?>
                                        <img src="<?php echo e($offer->image); ?>" class="w-16 h-16 rounded-lg object-cover" alt="<?php echo e($offer->title); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('storage/' . $offer->image)); ?>" class="w-16 h-16 rounded-lg object-cover" alt="<?php echo e($offer->title); ?>">
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="w-16 h-16 rounded-lg flex items-center justify-center text-white" style="background: linear-gradient(135deg, #003e87 0%, #0855b1 100%);">
                                        <i class="fas fa-tag text-xl"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-900"><?php echo e($offer->title); ?></p>
                                    <?php if($offer->subtitle): ?>
                                        <p class="text-sm text-gray-500 mt-1"><?php echo e($offer->subtitle); ?></p>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <?php if($offer->badge): ?>
                                    <span class="inline-block px-3 py-1 text-xs font-medium rounded-full" style="background: #dbeafe; color: #1e40af;">
                                        <?php echo e($offer->badge); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="text-sm text-gray-400">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">
                                    <?php echo e($offer->created_at->format('d/m/Y')); ?>

                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <form action="<?php echo e(route('admin.offers.toggle-status', $offer)); ?>" method="POST" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" 
                                               class="sr-only peer" 
                                               <?php echo e($offer->is_active ? 'checked' : ''); ?>

                                               onchange="this.form.submit()">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                    </label>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="<?php echo e(route('admin.offers.edit', $offer)); ?>" 
                                       class="px-3 py-1.5 text-white rounded-lg text-sm transition-opacity" 
                                       style="background: #003e87;"
                                       onmouseover="this.style.opacity='0.9'" 
                                       onmouseout="this.style.opacity='1'">
                                        <i class="fas fa-edit mr-1"></i>Modifier
                                    </a>
                                    <button type="button" 
                                            onclick="openDeleteModal(<?php echo e($offer->id); ?>, '<?php echo e(addslashes($offer->title)); ?>')"
                                            class="px-3 py-1.5 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700 transition-colors">
                                        <i class="fas fa-trash mr-1"></i>Supprimer
                                    </button>
                                    <form id="deleteForm<?php echo e($offer->id); ?>" action="<?php echo e(route('admin.offers.destroy', $offer)); ?>" method="POST" class="hidden">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2"></i>
                                <p>Aucune offre trouvée</p>
                                <a href="<?php echo e(route('admin.offers.create')); ?>" class="inline-block mt-4 px-6 py-2 text-white rounded-lg" style="background: #003e87;">
                                    <i class="fas fa-plus mr-2"></i>Créer une offre
                                </a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
    </div>
    
</div>

<!-- Details Modal (if needed in future) -->
<div id="detailsModal" class="modal-overlay hidden">
    <div class="modal-container">
        <div class="modal-header">
            <div class="flex items-center gap-3">
                <span id="modalTypeBadge" class="type-badge"></span>
                <h2 id="modalTitle" class="text-2xl font-bold text-gray-900"></h2>
            </div>
            <button onclick="closeDetailsModal()" class="close-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="modal-body">
            <div id="modalLoading" class="text-center py-12">
                <i class="fas fa-spinner fa-spin text-4xl text-primary mb-4"></i>
                <p class="text-gray-600">Chargement...</p>
            </div>
            
            <div id="modalContent" class="modal-grid hidden">
                <!-- Left Column -->
                <div class="modal-left">
                    <div id="modalImageSection"></div>
                    <div id="modalPricingSection"></div>
                    <div id="modalProductsSection"></div>
                </div>
                
                <!-- Right Column -->
                <div class="modal-right">
                    <div id="modalPeriodSection"></div>
                    <div id="modalStatusSection"></div>
                    <div id="modalInfoSection"></div>
                    <div id="modalActionsSection"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal-overlay hidden">
    <div class="modal-container" style="max-width: 500px;">
        <div class="modal-header" style="background: #fee2e2; border-bottom-color: #fecaca;">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-900">Confirmer la suppression</h2>
            </div>
            <button onclick="closeDeleteModal()" class="close-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="text-center py-6">
                <p class="text-gray-700 text-lg mb-2">Êtes-vous sûr de vouloir supprimer cette offre ?</p>
                <p class="text-gray-900 font-semibold text-xl mb-4" id="deleteOfferTitle"></p>
                <p class="text-sm text-gray-500">Cette action est irréversible.</p>
            </div>
            
            <div class="flex gap-3 justify-end">
                <button onclick="closeDeleteModal()" 
                        class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                    <i class="fas fa-times mr-2"></i>Annuler
                </button>
                <button onclick="confirmDelete()" 
                        class="px-6 py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    <i class="fas fa-trash mr-2"></i>Supprimer
                </button>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Number Formatting Utilities
    function formatPrice(value, decimals = 2) {
        if (value === null || value === undefined || value === '') return '0.00';
        return parseFloat(value).toFixed(decimals);
    }

    function formatPercentage(value, decimals = 0) {
        if (value === null || value === undefined || value === '') return '0';
        return parseFloat(value).toFixed(decimals);
    }

    // Filter Accordion Functions
    function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        const icon = document.getElementById(sectionId + 'Icon');
        
        if (section && icon) {
            section.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }
    }

    function clearAllFilters() {
        const url = new URL(window.location.href);
        const search = url.searchParams.get('search');
        
        window.location.href = search 
            ? '<?php echo e(route("admin.offers.index")); ?>?search=' + search
            : '<?php echo e(route("admin.offers.index")); ?>';
    }

    // Search with debounce
    let searchTimeout;
    const searchInput = document.getElementById('searchInput');
    
    searchInput?.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const url = new URL(window.location.href);
            if (this.value) {
                url.searchParams.set('search', this.value);
            } else {
                url.searchParams.delete('search');
            }
            window.location.href = url.toString();
        }, 500);
    });
    
    // View Toggle
    function switchView(view) {
        const tableView = document.getElementById('tableView');
        const gridView = document.getElementById('gridView');
        const tableBtn = document.getElementById('tableViewBtn');
        const gridBtn = document.getElementById('gridViewBtn');
        
        if (view === 'table') {
            tableView.classList.remove('hidden');
            gridView.classList.add('hidden');
            tableBtn.classList.add('active');
            gridBtn.classList.remove('active');
            localStorage.setItem('offersView', 'table');
        } else {
            tableView.classList.add('hidden');
            gridView.classList.remove('hidden');
            tableBtn.classList.remove('active');
            gridBtn.classList.add('active');
            localStorage.setItem('offersView', 'grid');
        }
    }
    
    // Load saved view preference
    document.addEventListener('DOMContentLoaded', function() {
        const savedView = localStorage.getItem('offersView') || 'table';
        switchView(savedView);
        
        // Initialize type filter counts
        updateTypeCounts();
        
        // Load saved type filter
        const savedFilter = localStorage.getItem('offersTypeFilter') || 'all';
        filterByType(savedFilter);
    });
    
    // Type Filter
    function filterByType(type) {
        // Update button states
        document.querySelectorAll('.type-filter button').forEach(btn => {
            btn.classList.remove('active');
        });
        document.getElementById('filter' + type.charAt(0).toUpperCase() + type.slice(1)).classList.add('active');
        
        // Filter table rows
        const tableRows = document.querySelectorAll('#tableView tbody tr[data-offer-type]');
        tableRows.forEach(row => {
            const rowType = row.dataset.offerType;
            if (type === 'all' || rowType === type) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        // Filter grid cards
        const gridCards = document.querySelectorAll('#gridView .offer-card[data-offer-type]');
        gridCards.forEach(card => {
            const cardType = card.dataset.offerType;
            if (type === 'all' || cardType === type) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
        
        // Save preference
        localStorage.setItem('offersTypeFilter', type);
        
        // Update empty state visibility
        updateEmptyState();
    }
    
    // Update type counts
    function updateTypeCounts() {
        const allItems = document.querySelectorAll('[data-offer-type]');
        const packs = document.querySelectorAll('[data-offer-type="pack"]');
        const offers = document.querySelectorAll('[data-offer-type="offer"]');
        
        // Count unique items (avoid counting both table and grid)
        const uniqueIds = new Set();
        allItems.forEach(item => uniqueIds.add(item.dataset.offerId));
        
        const packIds = new Set();
        packs.forEach(item => packIds.add(item.dataset.offerId));
        
        const offerIds = new Set();
        offers.forEach(item => offerIds.add(item.dataset.offerId));
        
        document.getElementById('countAll').textContent = uniqueIds.size;
        document.getElementById('countPack').textContent = packIds.size;
        document.getElementById('countOffer').textContent = offerIds.size;
    }
    
    // Update empty state based on filter
    function updateEmptyState() {
        const tableView = document.getElementById('tableView');
        const gridView = document.getElementById('gridView');
        const currentView = tableView.classList.contains('hidden') ? 'grid' : 'table';
        
        if (currentView === 'table') {
            const visibleRows = document.querySelectorAll('#tableView tbody tr[data-offer-type]:not([style*="display: none"])');
            const emptyRow = document.querySelector('#tableView tbody tr:not([data-offer-type])');
            
            if (visibleRows.length === 0 && !emptyRow) {
                // Add empty state row
                const tbody = document.querySelector('#tableView tbody');
                const emptyHtml = `
                    <tr class="empty-state-row">
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <i class="fas fa-filter text-6xl mb-4"></i>
                                <p class="text-lg font-medium text-gray-600">Aucun résultat</p>
                                <p class="text-sm text-gray-500 mt-1">Essayez un autre filtre</p>
                            </div>
                        </td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', emptyHtml);
            } else if (visibleRows.length > 0) {
                // Remove empty state if exists
                const emptyStateRow = document.querySelector('.empty-state-row');
                if (emptyStateRow) emptyStateRow.remove();
            }
        } else {
            const visibleCards = document.querySelectorAll('#gridView .offer-card[data-offer-type]:not([style*="display: none"])');
            const emptyState = document.querySelector('#gridView .empty-state-grid');
            
            if (visibleCards.length === 0 && !emptyState) {
                // Add empty state
                const gridView = document.getElementById('gridView');
                const emptyHtml = `
                    <div class="empty-state-grid col-span-full flex flex-col items-center justify-center text-gray-400 py-12">
                        <i class="fas fa-filter text-6xl mb-4"></i>
                        <p class="text-lg font-medium text-gray-600">Aucun résultat</p>
                        <p class="text-sm text-gray-500 mt-1">Essayez un autre filtre</p>
                    </div>
                `;
                gridView.insertAdjacentHTML('beforeend', emptyHtml);
            } else if (visibleCards.length > 0) {
                // Remove empty state if exists
                const emptyStateGrid = document.querySelector('.empty-state-grid');
                if (emptyStateGrid) emptyStateGrid.remove();
            }
        }
    }
    
    // Dropdown Toggle
    function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;
        const isOpen = dropdown.classList.contains('active');
        
        // Close all dropdowns
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.remove('active');
        });
        
        // Toggle current dropdown
        if (!isOpen) {
            dropdown.classList.add('active');
        }
    }
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu').forEach(d => d.classList.remove('active'));
        }
    });
    
    // Toggle Offer Status (AJAX)
    async function toggleOfferStatus(offerId, checkbox) {
        try {
            const response = await fetch(`/admin/offers/${offerId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            });
            
            const data = await response.json();
            if (!data.success) {
                checkbox.checked = !checkbox.checked;
                alert('Erreur lors de la mise à jour');
            }
        } catch (error) {
            checkbox.checked = !checkbox.checked;
            alert('Erreur lors de la mise à jour');
        }
    }
    
    // Quick View - Open Details Modal
    async function quickView(offerId, offerType = 'offer') {
        // Show modal with loading state
        const modal = document.getElementById('detailsModal');
        const loading = document.getElementById('modalLoading');
        const content = document.getElementById('modalContent');
        
        modal.classList.remove('hidden');
        loading.classList.remove('hidden');
        content.classList.add('hidden');
        
        try {
            const response = await fetch(`/admin/offers/${offerType}/${offerId}/details`);
            const result = await response.json();
            
            if (result.success) {
                // Hide loading, show content
                loading.classList.add('hidden');
                content.classList.remove('hidden');
                
                // Render based on type
                if (result.type === 'pack') {
                    renderPackDetails(result.data);
                } else {
                    renderOfferDetails(result.data);
                }
            } else {
                throw new Error('Failed to load details');
            }
        } catch (error) {
            console.error('Error fetching details:', error);
            alert('Erreur lors du chargement des détails');
            closeDetailsModal();
        }
    }
    
    // Render Pack Details
    function renderPackDetails(pack) {
        // Set header
        document.getElementById('modalTypeBadge').innerHTML = '<i class="fas fa-box-open"></i> Pack';
        document.getElementById('modalTypeBadge').className = 'type-badge badge-pack';
        document.getElementById('modalTitle').textContent = pack.name;
        
        // Set image
        const imageHTML = pack.image 
            ? `<img src="/storage/${pack.image}" alt="${pack.name}" class="pack-image">`
            : `<div class="pack-image-placeholder"><i class="fas fa-box-open"></i></div>`;
        document.getElementById('modalImageSection').innerHTML = imageHTML;
        
        // Set pricing
        document.getElementById('modalPricingSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-coins"></i> Tarification
                </div>
                <div class="pricing-card">
                    <div class="pricing-row">
                        <span>Prix Total Produits:</span>
                        <span class="text-gray-500 line-through">${formatPrice(pack.total_product_price)} DH</span>
                    </div>
                    <div class="pricing-row">
                        <span>Prix du Pack:</span>
                        <span class="text-primary font-bold text-xl">${formatPrice(pack.pack_price)} DH</span>
                    </div>
                    <div class="pricing-row highlight">
                        <span class="font-semibold">Économie Client:</span>
                        <span class="text-green-600 font-bold text-lg">${formatPrice(pack.savings)} DH (-${formatPercentage(pack.savings_percentage)}%)</span>
                    </div>
                </div>
            </div>
        `;
        
        // Set products
        const productsHTML = pack.products.map(p => `
            <div class="product-card-modal">
                <img src="/${p.image}" alt="${p.name}" onerror="this.src='/images/products/default.jpg'">
                <h4 title="${p.name}">${p.name}</h4>
                <p class="price">${formatPrice(p.price)} DH</p>
                <span class="category-badge-modal">${p.category}</span>
            </div>
        `).join('');
        
        document.getElementById('modalProductsSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-box"></i> Produits Inclus (${pack.products.length})
                </div>
                <div class="products-grid">${productsHTML}</div>
            </div>
        `;
        
        // Set period
        const daysRemaining = pack.days_remaining;
        const countdownClass = daysRemaining <= 1 ? 'danger' : (daysRemaining <= 7 ? 'warning' : '');
        const countdownText = daysRemaining <= 0 ? 'Expiré' : 
                             daysRemaining === 1 ? 'Expire demain' : 
                             `${daysRemaining} jours restants`;
        
        document.getElementById('modalPeriodSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-calendar-alt"></i> Période
                </div>
                <div class="info-row">
                    <span class="info-label">Début:</span>
                    <span class="info-value">${pack.start_date}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Fin:</span>
                    <span class="info-value">${pack.end_date}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Temps restant:</span>
                    <span class="countdown ${countdownClass}">
                        <i class="fas fa-clock"></i> ${countdownText}
                    </span>
                </div>
            </div>
        `;
        
        // Set status
        document.getElementById('modalStatusSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-toggle-on"></i> Statut
                </div>
                <div class="flex items-center justify-between">
                    <span class="font-semibold">${pack.is_active ? 'Actif' : 'Inactif'}</span>
                    <span class="status-badge ${pack.is_active ? 'status-active' : 'status-inactive'}">
                        ${pack.is_active ? 'Actif' : 'Inactif'}
                    </span>
                </div>
            </div>
        `;
        
        // Set info
        document.getElementById('modalInfoSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-info-circle"></i> Informations
                </div>
                <div class="info-row">
                    <span class="info-label">Créé le:</span>
                    <span class="info-value">${pack.created_at}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Modifié le:</span>
                    <span class="info-value">${pack.updated_at}</span>
                </div>
            </div>
        `;
        
        // Set actions
        document.getElementById('modalActionsSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-cog"></i> Actions
                </div>
                <div class="modal-actions">
                    <button class="modal-action-btn secondary" onclick="alert('Édition de pack à venir')">
                        <i class="fas fa-edit"></i> Modifier
                    </button>
                    <button class="modal-action-btn danger full-width" onclick="closeDetailsModal(); deleteOffer(${pack.id})">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </div>
            </div>
        `;
    }
    
    // Render Offer Details
    function renderOfferDetails(offer) {
        // Set header
        document.getElementById('modalTypeBadge').innerHTML = '<i class="fas fa-percent"></i> Réduction';
        document.getElementById('modalTypeBadge').className = 'type-badge badge-percentage';
        document.getElementById('modalTitle').textContent = offer.name;
        
        // Set discount icon
        document.getElementById('modalImageSection').innerHTML = `
            <div class="pack-image-placeholder">
                <i class="fas fa-percent"></i>
            </div>
        `;
        
        // Set pricing
        document.getElementById('modalPricingSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-tag"></i> Réduction
                </div>
                <div class="pricing-card">
                    <div class="pricing-row">
                        <span>Type:</span>
                        <span class="font-bold">Pourcentage</span>
                    </div>
                    <div class="pricing-row highlight">
                        <span class="font-semibold">Valeur:</span>
                        <span class="text-primary font-bold text-2xl">-${formatPercentage(offer.discount_percentage)}%</span>
                    </div>
                    ${offer.code ? `
                    <div class="pricing-row">
                        <span>Code Promo:</span>
                        <span class="font-mono font-bold">${offer.code}</span>
                    </div>
                    ` : ''}
                </div>
            </div>
        `;
        
        // Set products or categories
        if (offer.target_type === 'products' && offer.products.length > 0) {
            const productsHTML = offer.products.map(p => `
                <div class="product-card-modal">
                    <img src="/${p.image}" alt="${p.name}" onerror="this.src='/images/products/default.jpg'">
                    <h4 title="${p.name}">${p.name}</h4>
                    <p class="original-price">${formatPrice(p.price)} DH</p>
                    <p class="discounted-price">${formatPrice(p.discounted_price)} DH</p>
                    <span class="category-badge-modal">${p.category}</span>
                </div>
            `).join('');
            
            document.getElementById('modalProductsSection').innerHTML = `
                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="fas fa-box"></i> Produits Ciblés (${offer.products.length})
                    </div>
                    <div class="products-grid">${productsHTML}</div>
                </div>
            `;
        } else if (offer.target_type === 'categories' && offer.categories.length > 0) {
            const categoriesHTML = offer.categories.map(c => `
                <div class="category-item">
                    <span class="category-item-name">
                        <i class="fas fa-folder mr-2"></i>${c.name}
                    </span>
                    <span class="category-item-count">${c.products_count} produits</span>
                </div>
            `).join('');
            
            document.getElementById('modalProductsSection').innerHTML = `
                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="fas fa-folder"></i> Catégories Ciblées (${offer.categories.length})
                    </div>
                    <div class="categories-list">${categoriesHTML}</div>
                    <p class="text-sm text-gray-600 mt-3">
                        <i class="fas fa-info-circle mr-1"></i>
                        Cette offre s'applique à tous les produits de ces catégories
                    </p>
                </div>
            `;
        } else {
            document.getElementById('modalProductsSection').innerHTML = `
                <div class="modal-section">
                    <div class="modal-section-title">
                        <i class="fas fa-globe"></i> Cible
                    </div>
                    <p class="text-gray-600">Cette offre s'applique à tous les produits</p>
                </div>
            `;
        }
        
        // Set period
        const daysRemaining = offer.days_remaining;
        const countdownClass = daysRemaining <= 1 ? 'danger' : (daysRemaining <= 7 ? 'warning' : '');
        const countdownText = daysRemaining <= 0 ? 'Expiré' : 
                             daysRemaining === 1 ? 'Expire demain' : 
                             `${daysRemaining} jours restants`;
        
        document.getElementById('modalPeriodSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-calendar-alt"></i> Période
                </div>
                <div class="info-row">
                    <span class="info-label">Début:</span>
                    <span class="info-value">${offer.start_date}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Fin:</span>
                    <span class="info-value">${offer.end_date}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Temps restant:</span>
                    <span class="countdown ${countdownClass}">
                        <i class="fas fa-clock"></i> ${countdownText}
                    </span>
                </div>
            </div>
        `;
        
        // Set status
        document.getElementById('modalStatusSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-toggle-on"></i> Statut
                </div>
                <div class="flex items-center justify-between">
                    <span class="font-semibold">${offer.is_active ? 'Actif' : 'Inactif'}</span>
                    <span class="status-badge ${offer.is_active ? 'status-active' : 'status-inactive'}">
                        ${offer.is_active ? 'Actif' : 'Inactif'}
                    </span>
                </div>
            </div>
        `;
        
        // Set info
        document.getElementById('modalInfoSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-info-circle"></i> Informations
                </div>
                ${offer.code ? `
                <div class="info-row">
                    <span class="info-label">Code:</span>
                    <span class="info-value font-mono">${offer.code}</span>
                </div>
                ` : ''}
                <div class="info-row">
                    <span class="info-label">Créé le:</span>
                    <span class="info-value">${offer.created_at}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Modifié le:</span>
                    <span class="info-value">${offer.updated_at}</span>
                </div>
            </div>
        `;
        
        // Set actions
        document.getElementById('modalActionsSection').innerHTML = `
            <div class="modal-section">
                <div class="modal-section-title">
                    <i class="fas fa-cog"></i> Actions
                </div>
                <div class="modal-actions">
                    <button class="modal-action-btn primary" onclick="window.location.href='/admin/offers/${offer.id}/edit'">
                        <i class="fas fa-edit"></i> Modifier
                    </button>
                    <button class="modal-action-btn danger full-width" onclick="closeDetailsModal(); deleteOffer(${offer.id})">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </div>
            </div>
        `;
    }
    
    // Close Details Modal
    function closeDetailsModal() {
        document.getElementById('detailsModal').classList.add('hidden');
    }
    
    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDetailsModal();
        }
    });
    
    // Close modal on overlay click
    document.getElementById('detailsModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDetailsModal();
        }
    });
    
    // Duplicate Offer
    async function duplicateOffer(offerId) {
        if (!confirm('Dupliquer cette offre ?')) return;
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/offers/${offerId}/duplicate`;
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '<?php echo e(csrf_token()); ?>';
        form.appendChild(csrf);
        
        document.body.appendChild(form);
        form.submit();
    }
    
    // Delete Offer
    async function deleteOffer(offerId) {
        if (!confirm('Supprimer cette offre ?')) return;
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/offers/${offerId}`;
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '<?php echo e(csrf_token()); ?>';
        form.appendChild(csrf);
        
        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'DELETE';
        form.appendChild(method);
        
        document.body.appendChild(form);
        form.submit();
    }
    
    // Inline Edit
    function startInlineEdit(element) {
        const offerId = element.dataset.offerId;
        const field = element.dataset.field;
        const currentValue = element.textContent.trim();
        
        if (field === 'end_date') {
            // Extract date from text
            const dateMatch = currentValue.match(/\d{2}\/\d{2}\/\d{4}/);
            if (!dateMatch) return;
            
            const [day, month, year] = dateMatch[0].split('/');
            const dateValue = `${year}-${month}-${day}`;
            
            const input = document.createElement('input');
            input.type = 'date';
            input.value = dateValue;
            input.className = 'inline-edit-input';
            
            element.textContent = '';
            element.appendChild(input);
            input.focus();
            
            input.addEventListener('blur', () => saveInlineEdit(element, offerId, field, input.value));
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    saveInlineEdit(element, offerId, field, input.value);
                }
            });
        } else {
            const input = document.createElement('input');
            input.type = 'text';
            input.value = currentValue;
            input.className = 'inline-edit-input';
            
            element.textContent = '';
            element.appendChild(input);
            input.focus();
            input.select();
            
            input.addEventListener('blur', () => saveInlineEdit(element, offerId, field, input.value));
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    saveInlineEdit(element, offerId, field, input.value);
                }
            });
        }
    }
    
    async function saveInlineEdit(element, offerId, field, value) {
        try {
            const response = await fetch(`/admin/offers/${offerId}/inline-update`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({ field, value })
            });
            
            const data = await response.json();
            
            if (data.success) {
                if (field === 'end_date') {
                    const date = new Date(value);
                    const formatted = date.toLocaleDateString('fr-FR');
                    element.innerHTML = `<i class="fas fa-calendar-check mr-1"></i>${formatted}`;
                } else {
                    element.textContent = value;
                }
            } else {
                alert('Erreur lors de la mise à jour');
                window.location.reload();
            }
        } catch (error) {
            alert('Erreur lors de la mise à jour');
            window.location.reload();
        }
    }
    
    // Remove Filter
    function removeFilter(filterName, value) {
        const url = new URL(window.location.href);
        const params = url.searchParams.getAll(filterName + '[]');
        
        // Remove all instances of this filter
        url.searchParams.delete(filterName + '[]');
        
        // Re-add all except the one we're removing
        params.forEach(param => {
            if (param !== value) {
                url.searchParams.append(filterName + '[]', param);
            }
        });
        
        window.location.href = url.toString();
    }
    
    // Delete Modal Functions
    let deleteOfferId = null;
    let deleteOfferTitle = '';
    
    function openDeleteModal(offerId, offerTitle) {
        deleteOfferId = offerId;
        deleteOfferTitle = offerTitle;
        document.getElementById('deleteOfferTitle').textContent = offerTitle;
        document.getElementById('deleteModal').classList.remove('hidden');
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        deleteOfferId = null;
        deleteOfferTitle = '';
    }
    
    function confirmDelete() {
        if (deleteOfferId) {
            document.getElementById('deleteForm' + deleteOfferId).submit();
        }
    }
    
    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\temp-laravel\AnimalerieHMZ\resources\views/admin/offers/index.blade.php ENDPATH**/ ?>