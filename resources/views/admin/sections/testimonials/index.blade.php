@extends('layouts.admin')

@section('title', 'Testimonials')
@section('page-title', 'Testimonials Management')

@section('content')
<div class="space-y-6">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">⭐ Testimonials (Avis)</h1>
            <p class="text-gray-600 mt-1 text-sm md:text-base">Manage customer reviews displayed on your homepage.</p>
        </div>
        <div class="flex items-center gap-2 w-full sm:w-auto">
            <a href="{{ route('admin.sections.index') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium">
                <i class="fas fa-arrow-left mr-2"></i>
                Back
            </a>
            <a href="{{ route('admin.sections.testimonials.create') }}" class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] transition-colors shadow-sm text-sm font-medium whitespace-nowrap">
                <i class="fas fa-plus mr-2"></i>
                Add Review
            </a>
        </div>
    </div>
    
    <!-- Testimonials List -->
    @if($testimonials->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $testimonial)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-200">
                    <div class="p-6">
                        <!-- Header with Avatar and Info -->
                        <div class="flex items-start gap-4 mb-4">
                            <div class="flex-shrink-0">
                                @if($testimonial->avatar)
                                    @php
                                        $avatarUrl = filter_var($testimonial->avatar, FILTER_VALIDATE_URL) 
                                            ? $testimonial->avatar 
                                            : asset('storage/' . $testimonial->avatar);
                                    @endphp
                                    <img src="{{ $avatarUrl }}" alt="{{ $testimonial->name }}" class="w-16 h-16 rounded-full object-cover border-2 border-gray-200">
                                @else
                                    <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400 text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $testimonial->name }}</h3>
                                @if($testimonial->role)
                                    <p class="text-sm text-gray-500">{{ $testimonial->role }}</p>
                                @endif
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="flex gap-0.5">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-sm {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="text-xs text-gray-500">({{ $testimonial->rating }}/5)</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <p class="text-gray-700 text-sm leading-relaxed mb-4 line-clamp-3">
                            {{ $testimonial->content }}
                        </p>
                        
                        <!-- Status and Order -->
                        <div class="flex items-center gap-2 mb-4">
                            <form action="{{ route('admin.sections.testimonials.toggle-status', $testimonial) }}" method="POST" class="inline">
                                @csrf
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" 
                                           class="sr-only peer" 
                                           {{ $testimonial->is_active ? 'checked' : '' }}
                                           onchange="this.form.submit()">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                </label>
                            </form>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                Order: {{ $testimonial->order }}
                            </span>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.sections.testimonials.edit', $testimonial) }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] transition-colors text-sm">
                                <i class="fas fa-edit mr-2"></i>
                                Edit
                            </a>
                            <button onclick="confirmDelete({{ $testimonial->id }})" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm">
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
            <i class="fas fa-star text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Testimonials Yet</h3>
            <p class="text-gray-600 mb-6">Create your first testimonial to display on the homepage.</p>
            <a href="{{ route('admin.sections.testimonials.create') }}" class="inline-flex items-center px-6 py-3 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] transition-colors shadow-sm">
                <i class="fas fa-plus mr-2"></i>
                Add First Review
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
            <h3 class="text-xl font-bold text-gray-900 text-center mb-2">Delete Testimonial?</h3>
            <p class="text-gray-600 text-center mb-6">This action cannot be undone. The testimonial will be permanently removed.</p>
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
    function confirmDelete(testimonialId) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = `/admin/sections/testimonials/${testimonialId}`;
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
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
@endsection
