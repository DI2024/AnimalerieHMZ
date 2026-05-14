{{-- Testimonials Section Form - Simplified with Accordion --}}

<div class="space-y-6">
    
    <div class="flex items-center space-x-2 mb-4">
        <i class="fas fa-star text-primary text-xl"></i>
        <h3 class="text-xl font-semibold text-gray-900">Testimonials (3)</h3>
    </div>
    
    @for($i = 1; $i <= 3; $i++)
        <div class="bg-white border-2 border-gray-200 rounded-xl overflow-hidden">
            <!-- Accordion Header -->
            <button type="button" 
                    onclick="toggleTestimonial({{ $i }})"
                    class="w-full flex items-center justify-between p-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-comment-dots text-primary"></i>
                    <h4 class="text-lg font-semibold text-gray-900">Testimonial {{ $i }}</h4>
                    @if($section->data["testimonial_{$i}_name"] ?? null)
                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                            <i class="fas fa-check mr-1"></i>Rempli
                        </span>
                    @else
                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">
                            <i class="fas fa-circle mr-1"></i>Vide
                        </span>
                    @endif
                </div>
                <i class="fas fa-chevron-down transition-transform duration-200" id="testimonial-{{ $i }}-icon"></i>
            </button>
            
            <!-- Accordion Content -->
            <div id="testimonial-{{ $i }}-content" class="hidden border-t border-gray-200 p-6">
            
            <div class="grid grid-cols-2 gap-6">
                
                <!-- Left: Avatar + Name -->
                <div class="space-y-4">
                    <!-- Avatar Upload -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Photo de profil
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-primary transition-colors bg-gray-50">
                            <div id="testimonial-{{ $i }}-avatar-preview" class="mb-3">
                                @if($section->data["testimonial_{$i}_avatar"] ?? null)
                                    <img src="{{ asset('storage/' . $section->data["testimonial_{$i}_avatar"]) }}" 
                                         alt="Avatar {{ $i }}" 
                                         class="mx-auto w-24 h-24 rounded-full object-cover shadow-md border-2 border-primary">
                                @else
                                    <div class="mx-auto w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-user text-3xl text-gray-400"></i>
                                    </div>
                                @endif
                            </div>
                            <input type="file" 
                                   name="data[testimonial_{{ $i }}_avatar]" 
                                   id="testimonial-{{ $i }}-avatar-input"
                                   accept="image/jpeg,image/jpg,image/png,image/webp"
                                   class="hidden"
                                   onchange="previewTestimonialAvatar(this, {{ $i }})">
                            <label for="testimonial-{{ $i }}-avatar-input" class="cursor-pointer inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-yellow-600 transition-all text-sm font-semibold">
                                <i class="fas fa-upload mr-2"></i>
                                Choose Photo
                            </label>
                            <p class="text-xs text-gray-500 mt-2">JPG, PNG, WEBP • Max 2MB • Carré recommandé</p>
                        </div>
                    </div>
                    
                    <!-- Client Name -->
                    <div>
                        <label for="testimonial-{{ $i }}-name" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom du client
                        </label>
                        <input type="text" 
                               id="testimonial-{{ $i }}-name"
                               name="data[testimonial_{{ $i }}_name]" 
                               value="{{ old("data.testimonial_{$i}_name", $section->data["testimonial_{$i}_name"] ?? '') }}"
                               maxlength="100"
                               class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Ex: Marie Dupont">
                    </div>
                    
                    <!-- Rating -->
                    <div>
                        <label for="testimonial-{{ $i }}-rating" class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre d'étoiles
                        </label>
                        <select id="testimonial-{{ $i }}-rating"
                                name="data[testimonial_{{ $i }}_rating]" 
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            @for($star = 5; $star >= 1; $star--)
                                <option value="{{ $star }}" {{ old("data.testimonial_{$i}_rating", $section->data["testimonial_{$i}_rating"] ?? 5) == $star ? 'selected' : '' }}>
                                    {{ str_repeat('⭐', $star) }} ({{ $star }}/5)
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
                
                <!-- Right: Message -->
                <div>
                    <label for="testimonial-{{ $i }}-message" class="block text-sm font-medium text-gray-700 mb-2">
                        Message d'avis
                    </label>
                    <textarea id="testimonial-{{ $i }}-message"
                              name="data[testimonial_{{ $i }}_message]" 
                              rows="10"
                              maxlength="500"
                              class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent resize-none"
                              placeholder="Écrivez le témoignage du client ici...">{{ old("data.testimonial_{$i}_message", $section->data["testimonial_{$i}_message"] ?? '') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">
                        <span id="testimonial-{{ $i }}-message-count">{{ strlen($section->data["testimonial_{$i}_message"] ?? '') }}</span>/500 caractères
                    </p>
                </div>
                
            </div>
            <!-- End Accordion Content -->
        </div>
    @endfor
    
    <!-- Settings -->
    <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-6">
        <label class="flex items-center space-x-3 cursor-pointer">
            <input type="checkbox" 
                   name="is_active" 
                   value="1" 
                   {{ old('is_active', $section->is_active) ? 'checked' : '' }}
                   class="w-6 h-6 rounded text-primary focus:ring-primary">
            <div>
                <span class="text-base font-semibold text-gray-900">Section Active</span>
                <p class="text-sm text-gray-600">Display on homepage</p>
            </div>
        </label>
    </div>
    
</div>

<script>
// Toggle accordion for testimonials
function toggleTestimonial(number) {
    const content = document.getElementById(`testimonial-${number}-content`);
    const icon = document.getElementById(`testimonial-${number}-icon`);
    
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.style.transform = 'rotate(180deg)';
    } else {
        content.classList.add('hidden');
        icon.style.transform = 'rotate(0deg)';
    }
}

// Preview testimonial avatar
function previewTestimonialAvatar(input, number) {
    const preview = document.getElementById(`testimonial-${number}-avatar-preview`);
    const file = input.files[0];
    
    if (file) {
        if (file.size > 2 * 1024 * 1024) {
            alert('File must be less than 2MB');
            input.value = '';
            return;
        }
        
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            alert('Invalid format. Use JPG, PNG or WEBP');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="mx-auto w-24 h-24 rounded-full object-cover shadow-md border-2 border-primary">`;
        };
        reader.readAsDataURL(file);
    }
}

// Character counter for messages
document.addEventListener('DOMContentLoaded', function() {
    // Open first testimonial by default
    toggleTestimonial(1);
    
    for (let i = 1; i <= 3; i++) {
        const textarea = document.getElementById(`testimonial-${i}-message`);
        const counter = document.getElementById(`testimonial-${i}-message-count`);
        
        if (textarea && counter) {
            textarea.addEventListener('input', function() {
                counter.textContent = this.value.length;
            });
        }
    }
});
</script>
