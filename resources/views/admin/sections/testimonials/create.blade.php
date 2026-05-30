@extends('layouts.admin')

@section('title', 'Add Testimonial')
@section('page-title', 'Add New Testimonial')

@section('content')
<div class="space-y-6">
    
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">➕ Add New Testimonial</h1>
            <p class="text-gray-600 mt-1 text-sm md:text-base">Create a new customer review for your homepage.</p>
        </div>
        <a href="{{ route('admin.sections.testimonials.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium w-full sm:w-auto">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Reviews
        </a>
    </div>
    
    <!-- Form -->
    <form action="{{ route('admin.sections.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        @csrf
        
        <div class="space-y-6">
            
            <!-- Avatar Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Customer Avatar (Optional)
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-[#003e87] transition-colors bg-gray-50">
                    <div id="avatar-preview" class="mb-4">
                        <i class="fas fa-user-circle text-gray-400 text-6xl"></i>
                    </div>
                    <input type="file" name="avatar" id="avatar-input" accept="image/jpeg,image/jpg,image/png,image/webp" class="hidden" onchange="previewAvatar(this)">
                    <label for="avatar-input" class="cursor-pointer inline-flex items-center px-6 py-3 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] transition-all text-sm font-semibold">
                        <i class="fas fa-upload mr-2"></i>
                        Choose Avatar
                    </label>
                    <p class="text-xs text-gray-500 mt-2">Recommended: Square image, Max 2MB (JPG, PNG, WEBP)</p>
                </div>
                @error('avatar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Customer Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Customer Name <span class="text-red-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" maxlength="255" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-transparent" placeholder="e.g., Sophie Martin">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                    Role/Title (Optional)
                </label>
                <input type="text" id="role" name="role" value="{{ old('role', 'Client vérifié') }}" maxlength="255" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-transparent" placeholder="e.g., Client vérifié">
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Rating -->
            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">
                    Rating <span class="text-red-500">*</span>
                </label>
                <select id="rating" name="rating" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-transparent">
                    <option value="5" {{ old('rating', 5) == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5/5)</option>
                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (4/5)</option>
                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>⭐⭐⭐ (3/5)</option>
                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>⭐⭐ (2/5)</option>
                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>⭐ (1/5)</option>
                </select>
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    Review Content <span class="text-red-500">*</span>
                </label>
                <textarea id="content" name="content" rows="6" maxlength="1000" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-transparent resize-none" placeholder="Write the customer's review here...">{{ old('content') }}</textarea>
                <p class="text-xs text-gray-500 mt-1">
                    <span id="content-count">{{ strlen(old('content', '')) }}</span>/1000 characters
                </p>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Order -->
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                    Display Order <span class="text-red-500">*</span>
                </label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}" min="0" required class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#003e87] focus:border-transparent" placeholder="0">
                <p class="text-xs text-gray-500 mt-1">Lower numbers appear first</p>
                @error('order')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Active Status -->
            <div class="flex items-center">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 text-[#003e87] border-gray-300 rounded focus:ring-[#003e87]">
                <label for="is_active" class="ml-3 text-sm font-medium text-gray-700">
                    Active (Display on homepage)
                </label>
            </div>
            
            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t">
                <a href="{{ route('admin.sections.testimonials.index') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] transition-colors font-medium shadow-sm">
                    <i class="fas fa-save mr-2"></i>
                    Create Testimonial
                </button>
            </div>
            
        </div>
    </form>
    
</div>

@push('scripts')
<script>
    function previewAvatar(input) {
        const preview = document.getElementById('avatar-preview');
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-32 h-32 mx-auto rounded-full shadow-md object-cover">`;
            };
            reader.readAsDataURL(file);
        }
    }
    
    // Character counter
    document.getElementById('content')?.addEventListener('input', function() {
        document.getElementById('content-count').textContent = this.value.length;
    });
</script>
@endpush
@endsection
