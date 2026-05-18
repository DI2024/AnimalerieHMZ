@extends('layouts.admin')

@section('title', 'Paramètres')
@section('page-title', 'Paramètres Système')

@push('styles')
<style>
    .settings-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }
    
    .section-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .section-header {
        padding: 20px 24px;
        color: white;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 18px;
        font-weight: 700;
        background: linear-gradient(135deg, #003e87 0%, #0855b1 100%);
    }
    
    .section-body { 
        padding: 24px; 
    }
    
    .form-group { 
        margin-bottom: 20px; 
    }
    
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.2s;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #003e87;
        box-shadow: 0 0 0 3px rgba(0, 62, 135, 0.1);
    }
    
    .save-button {
        padding: 12px 32px;
        background: #003e87;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
    }
    
    .save-button:hover {
        background: #0855b1;
    }
    
    .help-text {
        font-size: 12px;
        color: #6B7280;
        margin-top: 4px;
    }

    @media (max-width: 1024px) {
        .settings-grid { 
            grid-template-columns: 1fr; 
        }
    }
</style>
@endpush

@section('content')
<div class="space-y-6">
    
    <!-- Contact Information -->
    <div class="section-card">
        <div class="section-header">
            <i class="fas fa-address-book"></i> 
            <span>Informations de Contact</span>
        </div>
        <div class="section-body">
            <form action="{{ route('admin.settings.update-contact') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope mr-2 text-gray-400"></i>
                            Email de contact
                        </label>
                        <input type="email" 
                               name="contact_email" 
                               class="form-input" 
                               value="{{ old('contact_email', $settings['contact_email']) }}"
                               required>
                        <p class="help-text">Email principal pour les clients</p>
                        @error('contact_email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-phone mr-2 text-gray-400"></i>
                            Téléphone / WhatsApp
                        </label>
                        <input type="text" 
                               name="contact_phone" 
                               class="form-input" 
                               value="{{ old('contact_phone', $settings['contact_phone']) }}"
                               required>
                        <p class="help-text">Numéro affiché sur le site</p>
                        @error('contact_phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="save-button">
                        <i class="fas fa-save"></i> 
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="settings-grid">
        <!-- Footer Settings -->
        <div class="section-card">
            <div class="section-header">
                <i class="fas fa-align-left"></i> 
                <span>Texte du Footer</span>
            </div>
            <div class="section-body">
                <form action="{{ route('admin.settings.update-footer') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">
                            Description courte
                        </label>
                        <textarea name="footer_description" 
                                  class="form-input" 
                                  rows="3"
                                  required>{{ old('footer_description', $settings['footer_description']) }}</textarea>
                        <p class="help-text">Texte affiché dans le footer du site</p>
                        @error('footer_description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Copyright
                        </label>
                        <input type="text" 
                               name="footer_copyright" 
                               class="form-input" 
                               value="{{ old('footer_copyright', $settings['footer_copyright']) }}"
                               required>
                        <p class="help-text">Texte de copyright</p>
                        @error('footer_copyright')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="save-button">
                            <i class="fas fa-save"></i> 
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security / Password Change -->
        <div class="section-card">
            <div class="section-header">
                <i class="fas fa-shield-alt"></i> 
                <span>Sécurité</span>
            </div>
            <div class="section-body">
                <form action="{{ route('admin.settings.update-password') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock mr-2 text-gray-400"></i>
                            Mot de passe actuel
                        </label>
                        <input type="password" 
                               name="current_password" 
                               class="form-input" 
                               required>
                        @error('current_password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-key mr-2 text-gray-400"></i>
                            Nouveau mot de passe
                        </label>
                        <input type="password" 
                               name="new_password" 
                               class="form-input" 
                               required>
                        <p class="help-text">Minimum 8 caractères</p>
                        @error('new_password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-check-circle mr-2 text-gray-400"></i>
                            Confirmer le mot de passe
                        </label>
                        <input type="password" 
                               name="new_password_confirmation" 
                               class="form-input" 
                               required>
                        @error('new_password_confirmation')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="save-button">
                            <i class="fas fa-key"></i> 
                            Mettre à jour le mot de passe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="fixed bottom-6 right-6 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 animate-slide-up">
            <i class="fas fa-check-circle text-xl"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed bottom-6 right-6 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3 animate-slide-up">
            <i class="fas fa-exclamation-circle text-xl"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif
</div>

<style>
    @keyframes slide-up {
        from {
            transform: translateY(100px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .animate-slide-up {
        animation: slide-up 0.3s ease-out;
    }
</style>

<script>
    // Auto-hide success/error messages after 5 seconds
    setTimeout(() => {
        const messages = document.querySelectorAll('.animate-slide-up');
        messages.forEach(msg => {
            msg.style.transition = 'opacity 0.3s, transform 0.3s';
            msg.style.opacity = '0';
            msg.style.transform = 'translateY(20px)';
            setTimeout(() => msg.remove(), 300);
        });
    }, 5000);
</script>
@endsection
