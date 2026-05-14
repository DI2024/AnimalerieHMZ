<div class="filter-sidebar bg-white rounded-lg shadow-sm p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-900">
            <i class="fas fa-filter mr-2 text-primary"></i>
            Filtres
        </h3>
        <button type="button" onclick="clearAllFilters()" class="text-sm text-gray-500 hover:text-primary">
            Réinitialiser
        </button>
    </div>
    
    <form id="filterForm" method="GET" action="{{ route('admin.orders.index') }}">
        
        <!-- Status Filter -->
        <div class="filter-section mb-6">
            <button type="button" class="filter-section-header" onclick="toggleFilterSection('status')">
                <i class="fas fa-circle-notch mr-2"></i>
                <span>Statut</span>
                <i class="fas fa-chevron-down ml-auto transition-transform" id="chevron-status"></i>
            </button>
            <div class="filter-section-content collapsed" id="section-status">
                <div class="space-y-2 mt-3">
                    <label class="flex items-center p-2 hover:bg-gray-50 rounded cursor-pointer">
                        <input type="checkbox" name="status_filter[]" value="pending" 
                               {{ in_array('pending', request('status_filter', [])) ? 'checked' : '' }}
                               class="rounded text-primary focus:ring-primary mr-3">
                        <span class="status-badge status-pending">
                            <i class="fas fa-clock"></i>
                            En attente
                        </span>
                    </label>
                    <label class="flex items-center p-2 hover:bg-gray-50 rounded cursor-pointer">
                        <input type="checkbox" name="status_filter[]" value="confirmed"
                               {{ in_array('confirmed', request('status_filter', [])) ? 'checked' : '' }}
                               class="rounded text-primary focus:ring-primary mr-3">
                        <span class="status-badge status-confirmed">
                            <i class="fas fa-check-circle"></i>
                            Confirmée
                        </span>
                    </label>
                    <label class="flex items-center p-2 hover:bg-gray-50 rounded cursor-pointer">
                        <input type="checkbox" name="status_filter[]" value="delivered"
                               {{ in_array('delivered', request('status_filter', [])) ? 'checked' : '' }}
                               class="rounded text-primary focus:ring-primary mr-3">
                        <span class="status-badge status-delivered">
                            <i class="fas fa-check-double"></i>
                            Livrée
                        </span>
                    </label>
                    <label class="flex items-center p-2 hover:bg-gray-50 rounded cursor-pointer">
                        <input type="checkbox" name="status_filter[]" value="cancelled"
                               {{ in_array('cancelled', request('status_filter', [])) ? 'checked' : '' }}
                               class="rounded text-primary focus:ring-primary mr-3">
                        <span class="status-badge status-cancelled">
                            <i class="fas fa-times-circle"></i>
                            Annulée
                        </span>
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Date Range Filter -->
        <div class="filter-section mb-6">
            <button type="button" class="filter-section-header" onclick="toggleFilterSection('date')">
                <i class="fas fa-calendar-alt mr-2"></i>
                <span>Période</span>
                <i class="fas fa-chevron-down ml-auto transition-transform" id="chevron-date"></i>
            </button>
            <div class="filter-section-content collapsed" id="section-date">
                <div class="space-y-3 mt-3">
                    <!-- Quick Date Presets -->
                    <div class="grid grid-cols-2 gap-2">
                        <button type="button" onclick="setDateRange('today')" 
                                class="px-3 py-2 text-xs bg-gray-100 hover:bg-primary hover:text-white rounded transition-colors">
                            Aujourd'hui
                        </button>
                        <button type="button" onclick="setDateRange('week')" 
                                class="px-3 py-2 text-xs bg-gray-100 hover:bg-primary hover:text-white rounded transition-colors">
                            Cette semaine
                        </button>
                        <button type="button" onclick="setDateRange('month')" 
                                class="px-3 py-2 text-xs bg-gray-100 hover:bg-primary hover:text-white rounded transition-colors">
                            Ce mois
                        </button>
                        <button type="button" onclick="setDateRange('last30')" 
                                class="px-3 py-2 text-xs bg-gray-100 hover:bg-primary hover:text-white rounded transition-colors">
                            30 derniers jours
                        </button>
                    </div>
                    
                    <!-- Custom Date Range -->
                    <div class="pt-3 border-t">
                        <label class="block text-xs font-medium text-gray-700 mb-2">Date de début</label>
                        <input type="date" name="date_from" id="dateFrom" value="{{ request('date_from') }}"
                               class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-2">Date de fin</label>
                        <input type="date" name="date_to" id="dateTo" value="{{ request('date_to') }}"
                               class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Amount Range Filter -->
        <div class="filter-section mb-6">
            <button type="button" class="filter-section-header" onclick="toggleFilterSection('amount')">
                <i class="fas fa-dollar-sign mr-2"></i>
                <span>Montant</span>
                <i class="fas fa-chevron-down ml-auto transition-transform" id="chevron-amount"></i>
            </button>
            <div class="filter-section-content collapsed" id="section-amount">
                <div class="space-y-3 mt-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-2">Montant minimum (DH)</label>
                        <input type="number" name="amount_min" value="{{ request('amount_min') }}" 
                               min="0" step="0.01" placeholder="0.00"
                               class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-2">Montant maximum (DH)</label>
                        <input type="number" name="amount_max" value="{{ request('amount_max') }}" 
                               min="0" step="0.01" placeholder="10000.00"
                               class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Apply Filters Button -->
        <button type="submit" class="w-full px-4 py-3 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-colors font-medium">
            <i class="fas fa-check mr-2"></i>
            Appliquer les filtres
        </button>
    </form>
</div>

<style>
    .filter-sidebar {
        position: sticky;
        top: 24px;
        max-height: calc(100vh - 120px);
        overflow-y: auto;
    }
    
    .filter-section-header {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 12px 0;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        border-bottom: 1px solid #E5E7EB;
        cursor: pointer;
        transition: color 0.2s;
    }
    
    .filter-section-header:hover {
        color: #d4af37;
    }
    
    .filter-section-content {
        max-height: 500px;
        overflow: hidden;
        transition: max-height 0.3s ease, opacity 0.3s ease;
        opacity: 1;
    }
    
    .filter-section-content.collapsed {
        max-height: 0;
        opacity: 0;
    }
</style>

<script>
    function toggleFilterSection(sectionId) {
        const content = document.getElementById('section-' + sectionId);
        const chevron = document.getElementById('chevron-' + sectionId);
        
        if (content.classList.contains('collapsed')) {
            content.classList.remove('collapsed');
            chevron.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('collapsed');
            chevron.style.transform = 'rotate(0deg)';
        }
    }
    
    function setDateRange(preset) {
        const today = new Date();
        const dateFrom = document.getElementById('dateFrom');
        const dateTo = document.getElementById('dateTo');
        
        dateTo.value = today.toISOString().split('T')[0];
        
        switch(preset) {
            case 'today':
                dateFrom.value = today.toISOString().split('T')[0];
                break;
            case 'week':
                const weekAgo = new Date(today);
                weekAgo.setDate(today.getDate() - 7);
                dateFrom.value = weekAgo.toISOString().split('T')[0];
                break;
            case 'month':
                const monthAgo = new Date(today);
                monthAgo.setMonth(today.getMonth() - 1);
                dateFrom.value = monthAgo.toISOString().split('T')[0];
                break;
            case 'last30':
                const thirtyDaysAgo = new Date(today);
                thirtyDaysAgo.setDate(today.getDate() - 30);
                dateFrom.value = thirtyDaysAgo.toISOString().split('T')[0];
                break;
        }
    }
    
    function clearAllFilters() {
        window.location.href = '{{ route('admin.orders.index') }}';
    }
</script>
