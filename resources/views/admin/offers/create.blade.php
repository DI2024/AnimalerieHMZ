@extends('layouts.admin')

@section('title', 'Nouvelle Offre')
@section('page-title', 'Créer une Offre')

@section('content')
<!-- Back Button -->
<div class="mb-6">
    <a href="{{ route('admin.offers.index') }}" 
       class="inline-flex items-center text-gray-600 transition-colors" 
       style="color: #6b7280;"
       onmouseover="this.style.color='#003e87'" 
       onmouseout="this.style.color='#6b7280'">
        <i class="fas fa-arrow-left mr-2"></i>
        <span>Retour à la liste des offres</span>
    </a>
</div>

<!-- Form Container -->
<div class="bg-white rounded-lg shadow p-8">
    <form action="{{ route('admin.offers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Titre <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}"
                           required
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='#003e87'; this.style.boxShadow='0 0 0 3px rgba(0,62,135,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="Ex: Jusqu'à 25% de remise">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subtitle -->
                <div>
                    <label for="subtitle" class="block text-sm font-semibold text-gray-700 mb-2">
                        Sous-titre
                    </label>
                    <input type="text" 
                           name="subtitle" 
                           id="subtitle" 
                           value="{{ old('subtitle') }}"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='#003e87'; this.style.boxShadow='0 0 0 3px rgba(0,62,135,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="Ex: Sur toute la gamme Chien">
                    @error('subtitle')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Badge -->
                <div>
                    <label for="badge" class="block text-sm font-semibold text-gray-700 mb-2">
                        Badge
                    </label>
                    <input type="text" 
                           name="badge" 
                           id="badge" 
                           value="{{ old('badge') }}"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='#003e87'; this.style.boxShadow='0 0 0 3px rgba(0,62,135,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="Ex: 🔥 Offre Spéciale">
                    @error('badge')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Image
                    </label>
                    <div class="border-2 border-dashed rounded-lg p-6 text-center" style="border-color: #d1d5db;">
                        <input type="file" 
                               name="image" 
                               id="image" 
                               accept="image/*"
                               class="hidden"
                               onchange="previewImage(event)">
                        <label for="image" class="cursor-pointer">
                            <div id="imagePreview" class="mb-4">
                                <i class="fas fa-cloud-upload-alt text-5xl text-gray-400"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">Cliquez pour télécharger une image</p>
                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF jusqu'à 2MB</p>
                        </label>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Background Color -->
                <div>
                    <label for="bg_color" class="block text-sm font-semibold text-gray-700 mb-2">
                        Couleur de fond
                    </label>
                    <input type="text" 
                           name="bg_color" 
                           id="bg_color" 
                           value="{{ old('bg_color', '#003e87') }}"
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2" 
                           style="border-color: #e5e7eb;"
                           onfocus="this.style.borderColor='#003e87'; this.style.boxShadow='0 0 0 3px rgba(0,62,135,0.1)'"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'"
                           placeholder="#003e87">
                    @error('bg_color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active Status -->
                <div>
                    <label class="flex items-center cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" 
                               name="is_active" 
                               value="1" 
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="w-5 h-5 rounded" 
                               style="color: #003e87;">
                        <span class="ml-3 text-sm font-semibold text-gray-700">Offre active</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="mt-8 flex items-center gap-4">
            <button type="submit" 
                    class="px-6 py-3 text-white rounded-lg font-semibold transition-colors" 
                    style="background: #003e87;"
                    onmouseover="this.style.background='#0855b1'" 
                    onmouseout="this.style.background='#003e87'">
                <i class="fas fa-save mr-2"></i>Créer l'offre
            </button>
            <a href="{{ route('admin.offers.index') }}" 
               class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                Annuler
            </a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="max-h-48 mx-auto rounded-lg">`;
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endpush
