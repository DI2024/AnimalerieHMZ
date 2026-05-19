@extends('layouts.admin')

@section('title', 'Edit Hero Slide')
@section('page-title', 'Edit Hero Slide')

@section('content')
<div class="space-y-6">
    
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">✏️ Edit Hero Slide</h1>
            <p class="text-gray-600 mt-1">Update hero slide information.</p>
        </div>
        <a href="{{ route('admin.sections.hero.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Slides
        </a>
    </div>
    
    <!-- Form -->
    <form action="{{ route('admin.sections.hero.update', $slide) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            
            <!-- Current Image -->
            @if($slide->image)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Current Image
                    </label>
                    <div class="border-2 border-gray-200 rounded-lg p-4 bg-gray-50">
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
                        <img src="{{ $imageUrl }}" alt="{{ $slide->title }}" class="max-w-full max-h-64 mx-auto rounded-lg shadow-md">
                    </div>
                </div>
            @endif
            
            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Change Image (Optional)
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-[#003e87] transition-colors bg-gray-50">
                    <div id="image-preview" class="mb-4">
                        <i class="fas fa-image text-gray-400 text-6xl"></i>
                    </div>
                    <input type="file" name="image" id="image-input" accept="image/jpeg,image/jpg,image/png,image/webp" class="hidden" onchange="previewImage(this)">
                    <label for="image-input" class="cursor-pointer inline-flex items-center px-6 py-3 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] transition-all text-sm font-semibold">
                        <i class="fas fa-upload mr-2"></i>
                        Choose New Image
                    </label>
                    <p class="text-xs text-gray-500 mt-2">Recommended: 1920x600px, Max 2MB (JPG, PNG, WEBP)</p>
                </div>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-400 mb-2">
                    Title (Auto: Links to Products)
                </label>
                <input type="text" id="title" name="title" value="Automatic - Links to Products Page" disabled class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed" placeholder="Automatically set">
                <p class="text-xs text-gray-500 mt-1">This field is automatically managed</p>
            </div>
            
            <!-- Subtitle -->
            <div>
                <label for="subtitle" class="block text-sm font-medium text-gray-400 mb-2">
                    Subtitle (Auto: Links to Products)
                </label>
                <input type="text" id="subtitle" name="subtitle" value="Automatic - Links to Products Page" disabled class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed" placeholder="Automatically set">
                <p class="text-xs text-gray-500 mt-1">This field is automatically managed</p>
            </div>
            
            <!-- Button Text -->
            <div>
                <label for="button_text" class="block text-sm font-medium text-gray-400 mb-2">
                    Button Text (Auto: "Voir nos produits")
                </label>
                <input type="text" id="button_text" name="button_text" value="Voir nos produits" disabled class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed" placeholder="Automatically set">
                <p class="text-xs text-gray-500 mt-1">This field is automatically managed</p>
            </div>
            
            <!-- Button Link -->
            <div>
                <label for="button_link" class="block text-sm font-medium text-gray-400 mb-2">
                    Button Link (Auto: Products Page)
                </label>
                <input type="text" id="button_link" name="button_link" value="{{ route('products.index') }}" disabled class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed" placeholder="Automatically set">
                <p class="text-xs text-gray-500 mt-1">All slides automatically link to products page</p>
            </div>
            
            <!-- Order -->
            <div>
                <label for="order" class="block text-sm font-medium text-gray-400 mb-2">
                    Display Order
                </label>
                <input type="number" id="order" name="order" value="{{ old('order', $slide->order) }}" disabled class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed">
                <p class="text-xs text-gray-500 mt-1">Order is managed from the slides list</p>
            </div>
            
            <!-- Active Status -->
            <div class="flex items-center">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $slide->is_active) ? 'checked' : '' }} class="w-5 h-5 text-[#003e87] border-gray-300 rounded focus:ring-[#003e87]">
                <label for="is_active" class="ml-3 text-sm font-medium text-gray-700">
                    Active (Display on homepage)
                </label>
            </div>
            
            <!-- Submit Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-6 border-t">
                <a href="{{ route('admin.sections.hero.index') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors font-medium">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-3 bg-[#003e87] text-white rounded-lg hover:bg-[#0855b1] transition-colors font-medium shadow-sm">
                    <i class="fas fa-save mr-2"></i>
                    Update Slide
                </button>
            </div>
            
        </div>
    </form>
    
</div>

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const file = input.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="max-w-full max-h-64 mx-auto rounded-lg shadow-md">`;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
@endsection
