@extends('layouts.admin')

@section('title', 'Nouvelle Offre')
@section('page-title', 'Créer une Offre')

@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* Main Tab Navigation */
    .offer-type-tabs {
        display: flex;
        gap: 8px;
        margin-bottom: 32px;
        border-bottom: 2px solid #e5e7eb;
        padding: 0 4px;
    }
    
    .offer-type-tab {
        position: relative;
        padding: 16px 24px;
        background: transparent;
        border: none;
        border-bottom: 3px solid transparent;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 16px;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 220px;
        border-radius: 12px 12px 0 0;
        margin-bottom: -2px;
    }
    
    .offer-type-tab:hover {
        background: #f9fafb;
        color: #374151;
    }
    
    .offer-type-tab:hover .tab-icon-container {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .offer-type-tab.active {
        background: #fffbeb;
        border-bottom-color: #d4af37;
        color: #92400e;
    }
    
    /* Tab Icon Container */
    .tab-icon-container {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        flex-shrink: 0;
    }
    
    .tab-icon-container.pack-icon {
        background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
    }
    
    .tab-icon-container.discount-icon {
        background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
    }
    
    .offer-type-tab:not(.active) .tab-icon-container {
        background: #f3f4f6;
        color: #9ca3af;
        box-shadow: none;
    }
    
    .tab-text-content {
        display: flex;
        flex-direction: column;
        gap: 2px;
        text-align: left;
    }
    
    .offer-type-tab-title {
        font-size: 16px;
        font-weight: 600;
        line-height: 1.2;
    }
    
    .offer-type-tab-subtitle {
        font-size: 12px;
        font-weight: 400;
        color: #9ca3af;
        line-height: 1.2;
    }
    
    .offer-type-tab.active .offer-type-tab-subtitle {
        color: #b45309;
    }
    
    /* Form Content Sections */
    .offer-form-content {
        display: none;
        animation: fadeIn 0.3s ease-in-out;
    }
    
    .offer-form-content.active {
        display: block;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Form Container */
    .form-container {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 24px;
    }
    
    @media (max-width: 1024px) {
        .form-container {
            grid-template-columns: 1fr;
        }
        
        .offer-type-tabs {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .offer-type-tab {
            min-width: 180px;
            padding: 12px 16px;
        }
        
        .tab-icon-container {
            width: 36px;
            height: 36px;
            font-size: 18px;
        }
    }
    
    /* Section Headers with Icon Badges */
    .section-header {
        font-size: 16px;
        font-weight: 600;
        color: #111827;
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 2px solid #f3f4f6;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .section-icon-badge {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: white;
        flex-shrink: 0;
    }
    
    .section-icon-badge.info {
        background: #3b82f6;
    }
    
    .section-icon-badge.target {
        background: #8b5cf6;
    }
    
    .section-icon-badge.products {
        background: #10b981;
    }
    
    .section-icon-badge.image {
        background: #f59e0b;
    }
    
    .section-icon-badge.calendar {
        background: #06b6d4;
    }
    
    .section-icon-badge.settings {
        background: #6366f1;
    }
    
    /* Input Groups with Icons */
    .input-group {
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .input-prefix {
        position: absolute;
        left: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
        font-size: 16px;
        pointer-events: none;
        z-index: 1;
    }
    
    .input-with-prefix {
        padding-left: 40px !important;
    }
    
    .input-suffix {
        position: absolute;
        right: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-size: 14px;
        font-weight: 600;
        pointer-events: none;
    }
    
    .input-with-suffix {
        padding-right: 50px !important;
    }
    
    /* Pricing Inputs Grid */
    .pricing-inputs-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 12px;
    }
    
    @media (max-width: 768px) {
        .pricing-inputs-grid {
            grid-template-columns: 1fr;
        }
    }
    
    /* Pack Info Grid (Name + Image) */
    .pack-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        align-items: start;
    }
    
    @media (max-width: 768px) {
        .pack-info-grid {
            grid-template-columns: 1fr;
        }
        
        .pack-info-grid > div:first-child {
            order: 2; /* Image comes second on mobile */
        }
        
        .pack-info-grid > div:last-child {
            order: 1; /* Name comes first on mobile */
        }
    }
    
    /* Image Upload Zone */
    .pack-image-upload-zone {
        position: relative;
        height: 240px;
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        background: #f9fafb;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .pack-image-upload-zone:hover {
        border-color: #d4af37;
        background: #fffbeb;
    }
    
    .pack-image-upload-zone.drag-over {
        border-style: solid;
        border-color: #d4af37;
        background: #fef3c7;
    }
    
    .pack-image-upload-zone.has-image {
        border-style: solid;
        border-color: #e5e7eb;
        padding: 0;
    }
    
    /* Upload Empty State */
    .upload-empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        pointer-events: none;
    }
    
    .upload-icon {
        font-size: 48px;
        color: #9ca3af;
        margin-bottom: 12px;
    }
    
    .upload-text-primary {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 4px;
    }
    
    .upload-text-secondary {
        font-size: 12px;
        color: #6b7280;
    }
    
    /* Image Preview */
    .pack-image-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }
    
    /* Image Overlay (on hover) */
    .pack-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 12px;
        pointer-events: none;
    }
    
    .pack-image-upload-zone.has-image:hover .pack-image-overlay {
        opacity: 1;
    }
    
    .change-image-btn {
        padding: 10px 20px;
        background: white;
        color: #374151;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
    }
    
    .change-image-btn:hover {
        background: #f9fafb;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    
    /* Name Input Zone */
    .pack-name-input-zone {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .pack-name-hint {
        font-size: 12px;
        color: #6b7280;
        margin-top: 8px;
        line-height: 1.5;
    }
    
    /* Tab Buttons (for discount form tabs) */
    .target-tabs {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
    }
    
    .tab-btn {
        flex: 1;
        padding: 16px 24px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        background: white;
        cursor: pointer;
        transition: all 0.2s;
        font-weight: 600;
        text-align: center;
    }
    
    .tab-btn:hover {
        border-color: #d4af37;
        background: #fffbeb;
    }
    
    .tab-btn.active {
        border-color: #d4af37;
        background: #fef3c7;
        color: #92400e;
    }
    
    .tab-btn-icon {
        font-size: 24px;
        margin-bottom: 8px;
        display: block;
    }
    
    /* Target Sections */
    .target-section {
        padding: 20px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: #f9fafb;
    }
    
    /* Select2 Styling */
    .select2-container--default .select2-selection--multiple {
        min-height: 120px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 8px;
    }
    
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #fef3c7;
        border-color: #d4af37;
        color: #92400e;
        padding: 4px 8px;
        margin: 4px;
    }
    
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #92400e;
        margin-right: 5px;
    }
    
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: #dc2626;
    }
    
    /* Preview Card */
    .preview-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 24px;
    }
    
    .discount-badge {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #d4af37 0%, #f59e0b 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 8px 16px rgba(212, 175, 55, 0.3);
    }
    
    .discount-value {
        font-size: 36px;
        font-weight: bold;
        color: white;
    }
    
    /* Pack Preview */
    .pack-preview-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 16px;
    }
    
    .pack-price-display {
        font-size: 28px;
        font-weight: bold;
        color: #d4af37;
    }
    
    .pack-savings {
        font-size: 14px;
        color: #059669;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('admin.offers.index') }}" 
       class="inline-flex items-center text-gray-600 hover:text-primary transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>
        <span>Retour à la liste des offres</span>
    </a>
</div>

<!-- Tab Navigation -->
<div class="offer-type-tabs">
    <button type="button" 
            class="offer-type-tab active" 
            data-tab="pack"
            onclick="switchOfferType('pack')">
        <div class="tab-icon-container pack-icon">
            <i class="fas fa-box-open"></i>
        </div>
        <div class="tab-text-content">
            <span class="offer-type-tab-title">Pack Produits</span>
            <span class="offer-type-tab-subtitle">Bundle à prix réduit</span>
        </div>
    </button>
    
    <button type="button" 
            class="offer-type-tab" 
            data-tab="discount"
            onclick="switchOfferType('discount')">
        <div class="tab-icon-container discount-icon">
            <i class="fas fa-percentage"></i>
        </div>
        <div class="tab-text-content">
            <span class="offer-type-tab-title">Réduction</span>
            <span class="offer-type-tab-subtitle">Pourcentage de remise</span>
        </div>
    </button>
</div>

<!-- Form Container -->
<form action="{{ route('admin.offers.store') }}" method="POST" id="offerForm" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="offer_type" id="offer_type" value="pack">
    
    <!-- Pack Form Content -->
    <div id="pack-form" class="offer-form-content active">
        @include('admin.offers.partials.pack-form')
    </div>
    
    <!-- Discount Form Content -->
    <div id="discount-form" class="offer-form-content">
        @include('admin.offers.partials.discount-form')
    </div>
</form>

@endsection

@push('scripts')
<script>
// Global function to switch between offer types
function switchOfferType(type) {
    // Update tab active states
    document.querySelectorAll('.offer-type-tab').forEach(tab => {
        if (tab.dataset.tab === type) {
            tab.classList.add('active');
        } else {
            tab.classList.remove('active');
        }
    });
    
    // Update form content visibility
    document.querySelectorAll('.offer-form-content').forEach(content => {
        content.classList.remove('active');
    });
    document.getElementById(type + '-form').classList.add('active');
    
    // Update hidden input for form submission
    document.getElementById('offer_type').value = type;
    
    // Update URL without reload (optional - for shareable links)
    if (history.pushState) {
        const newUrl = new URL(window.location);
        newUrl.searchParams.set('type', type);
        history.pushState({type: type}, '', newUrl);
    }
}

// Handle browser back/forward buttons
window.addEventListener('popstate', function(event) {
    if (event.state && event.state.type) {
        switchOfferType(event.state.type);
    }
});

// Initialize from URL parameter on page load
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const typeParam = urlParams.get('type');
    
    if (typeParam && (typeParam === 'pack' || typeParam === 'discount')) {
        switchOfferType(typeParam);
    }
});
</script>
@endpush
