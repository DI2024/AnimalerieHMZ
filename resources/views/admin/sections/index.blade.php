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
        <div class="flex items-center space-x-3">
            <!-- Preview Site -->
            <a href="http://localhost:8080/index.html" target="_blank" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-external-link-alt mr-2"></i>
                Preview Site
            </a>
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
                        Customize each section with text, images, colors, and buttons. All sections are displayed on your homepage.
                    </p>
                </div>
            </div>
            
            <!-- Quick Stats -->
            <div class="flex items-center space-x-6 ml-6">
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-900">4</p>
                    <p class="text-xs text-blue-700">Total Sections</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sections Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Static Hero Section -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3 flex-1">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-primary/20 to-primary/10 flex items-center justify-center">
                                <i class="fas fa-home text-primary text-xl"></i>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Hero Section</h3>
                    </div>
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-colors text-sm font-medium shadow-sm">
                        <i class="fas fa-edit mr-2"></i> Edit Section
                    </a>
                </div>
                <p class="text-xs text-gray-500 ml-15"><i class="far fa-clock mr-1"></i> Last updated Il y a 2 jours</p>
            </div>
        </div>

        <!-- Static About Section -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3 flex-1">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-primary/20 to-primary/10 flex items-center justify-center">
                                <i class="fas fa-info-circle text-primary text-xl"></i>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">About Section</h3>
                    </div>
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-colors text-sm font-medium shadow-sm">
                        <i class="fas fa-edit mr-2"></i> Edit Section
                    </a>
                </div>
                <p class="text-xs text-gray-500 ml-15"><i class="far fa-clock mr-1"></i> Last updated Il y a 5 jours</p>
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
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
@endsection
