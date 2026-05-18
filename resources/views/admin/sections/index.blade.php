@extends('layouts.admin')

@section('title', 'Sections')
@section('page-title', 'Homepage Sections')

@section('content')
<div class="space-y-6">
    
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">📄 Homepage Sections</h1>
            <p class="text-gray-600 mt-1">Manage your homepage sections content.</p>
        </div>
    </div>
    
    <!-- Info Banner -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-600 text-xl"></i>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm text-blue-900 font-medium">
                        Customize hero slides and testimonials displayed on your homepage.
                    </p>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div class="flex items-center space-x-6 ml-6">
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-900">{{ $heroSlides->count() }}</p>
                    <p class="text-xs text-blue-700">Hero Slides</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-900">{{ $testimonials->count() }}</p>
                    <p class="text-xs text-blue-700">Testimonials</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sections Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Hero Section -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3 flex-1">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#003e87]/20 to-[#003e87]/10 flex items-center justify-center">
                                <i class="fas fa-images text-[#003e87] text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Hero Slides</h3>
                            <p class="text-sm text-gray-500">{{ $heroSlides->where('is_active', true)->count() }} active slides</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.sections.hero.index') }}" class="inline-flex items-center px-4 py-2 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] transition-colors text-sm font-medium shadow-sm">
                        <i class="fas fa-edit mr-2"></i> Manage Slides
                    </a>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3 flex-1">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-[#003e87]/20 to-[#003e87]/10 flex items-center justify-center">
                                <i class="fas fa-star text-[#003e87] text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Testimonials (Avis)</h3>
                            <p class="text-sm text-gray-500">{{ $testimonials->where('is_active', true)->count() }} active reviews</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.sections.testimonials.index') }}" class="inline-flex items-center px-4 py-2 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] transition-colors text-sm font-medium shadow-sm">
                        <i class="fas fa-edit mr-2"></i> Manage Reviews
                    </a>
                </div>
            </div>
        </div>
    </div>
    
</div>

@push('scripts')
<script>
    // Show notification if redirected after save
    @if(session('success'))
        document.addEventListener('DOMContentLoaded', function() {
            showNotification('{{ session('success') }}', 'success');
        });
    @endif
    
    @if(session('error'))
        document.addEventListener('DOMContentLoaded', function() {
            showNotification('{{ session('error') }}', 'error');
        });
    @endif
    
    // Show notification
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in ${
            type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
        }`;
        notification.innerHTML = `
            <div class="flex items-center space-x-2">
                <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
</script>

<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in {
        animation: fade-in 0.3s ease-out;
    }
</style>
@endpush
@endsection
