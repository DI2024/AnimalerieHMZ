@extends('layouts.admin')

@section('title', 'Hero Slides')
@section('page-title', 'Hero Slides Management')

@section('content')
<div class="space-y-6">
    
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">🖼️ Hero Slides</h1>
            <p class="text-gray-600 mt-1">Manage the hero images at the top of your homepage (Max 3 slides).</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.sections.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Sections
            </a>
            @if($slides->count() < 3)
                <a href="{{ route('admin.sections.hero.create') }}" class="inline-flex items-center px-4 py-2 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] transition-colors shadow-sm">
                    <i class="fas fa-plus mr-2"></i>
                    Add New Slide
                </a>
            @endif
        </div>
    </div>
    
    <!-- Warning if more than 3 slides -->
    @if($slides->count() > 3)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-yellow-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        <strong>Warning:</strong> You have {{ $slides->count() }} slides, but only the first 3 active slides will be displayed on the homepage.
                    </p>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Info Banner -->
    @if($slides->count() < 3)
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-blue-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        <strong>Slide Layout:</strong> Slide 1 = Main hero (left, 65%), Slides 2-3 = Right offers (stacked, 35%). You have {{ $slides->count() }}/3 slides.
                    </p>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Slides List -->
    @if($slides->count() > 0)
        <div class="grid grid-cols-1 gap-4">
            @foreach($slides as $slide)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-200">
                    <div class="flex items-center p-6">
                        <!-- Image Preview -->
                        <div class="flex-shrink-0 w-32 h-32 rounded-lg overflow-hidden bg-gray-100 mr-6">
                            @if($slide->image)
                                @php
                                    // Handle both URL and local path
                                    if (filter_var($slide->image, FILTER_VALIDATE_URL)) {
                                        $imageUrl = $slide->image;
                                    } elseif (str_starts_with($slide->image, 'images/')) {
                                        // Local public path (e.g., images/sec her.png)
                                        $imageUrl = asset($slide->image);
                                    } else {
                                        // Storage path (e.g., hero_slides/xyz.jpg)
                                        $imageUrl = asset('storage/' . $slide->image);
                                    }
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $slide->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-image text-4xl"></i>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Slide Info -->
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    {{ $slide->title ?: 'Untitled Slide' }}
                                </h3>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $slide->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $slide->is_active ? 'Active' : 'Inactive' }}
                                </span>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                    Order: {{ $slide->order }}
                                </span>
                            </div>
                            @if($slide->subtitle)
                                <p class="text-gray-600 text-sm mb-2">{{ $slide->subtitle }}</p>
                            @endif
                            @if($slide->button_text)
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <i class="fas fa-mouse-pointer"></i>
                                    <span>Button: "{{ $slide->button_text }}"</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.sections.hero.edit', $slide) }}" class="inline-flex items-center px-4 py-2 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] transition-colors text-sm">
                                <i class="fas fa-edit mr-2"></i>
                                Edit
                            </a>
                            <button onclick="confirmDelete({{ $slide->id }})" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm">
                                <i class="fas fa-trash mr-2"></i>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm p-12 text-center">
            <i class="fas fa-images text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Hero Slides Yet</h3>
            <p class="text-gray-600 mb-6">Create your first hero slide to display on the homepage.</p>
            <a href="{{ route('admin.sections.hero.create') }}" class="inline-flex items-center px-6 py-3 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] transition-colors shadow-sm">
                <i class="fas fa-plus mr-2"></i>
                Add First Slide
            </a>
        </div>
    @endif
    
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 overflow-hidden">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100 mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Delete Hero Slide?</h3>
            <p class="text-gray-600 text-center mb-6">This action cannot be undone. The slide will be permanently removed.</p>
            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmDelete(slideId) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = `/admin/sections/hero/${slideId}`;
        modal.classList.remove('hidden');
    }
    
    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
    }
    
    // Close modal on outside click
    document.getElementById('deleteModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
    
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
