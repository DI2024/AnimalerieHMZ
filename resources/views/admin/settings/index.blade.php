@extends('layouts.admin')

@section('title', 'Paramètres')

@push('styles')
<style>
    /* Settings Dashboard Styles */
    .settings-dashboard {
        max-width: 100%;
        padding: 0;
    }
    
    .settings-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
        padding: 20px 24px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    
    .back-button {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F3F4F6;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        color: #6B7280;
        font-size: 18px;
    }
    
    .settings-title {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
        flex: 1;
    }
    
    .settings-grid {
        display: grid;
        grid-template-columns: 60% 40%;
        gap: 24px;
        margin-bottom: 24px;
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
    }
    
    .section-header.blue { background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%); }
    .section-header.red { background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%); }
    
    .section-body { padding: 24px; }
    
    .form-group { margin-bottom: 20px; }
    
    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }
    
    .form-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #E5E7EB;
        border-radius: 6px;
        font-size: 14px;
    }
    
    .images-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .image-preview-compact {
        width: 100%;
        height: 120px;
        object-fit: contain;
        border-radius: 8px;
        border: 2px solid #E5E7EB;
        background: #F9FAFB;
        padding: 8px;
    }
    
    .upload-btn-compact {
        width: 100%;
        padding: 10px 16px;
        border: 2px dashed #D1D5DB;
        border-radius: 6px;
        text-align: center;
        cursor: pointer;
        font-size: 13px;
        display: block;
        margin-top: 8px;
    }
    
    .save-button {
        padding: 12px 32px;
        background: linear-gradient(135deg, #d4af37 0%, #f59e0b 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    @media (max-width: 768px) {
        .settings-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="settings-dashboard">
    <div class="settings-header">
        <button type="button" class="back-button"><i class="fas fa-arrow-left"></i></button>
        <h1 class="settings-title">Paramètres Système</h1>
    </div>
    
    <div class="settings-grid">
        <!-- Site Info -->
        <div class="section-card">
            <div class="section-header blue">
                <i class="fas fa-store"></i> <span>Informations du Site</span>
            </div>
            <div class="section-body">
                <div class="form-group">
                    <label class="form-label">Description du site</label>
                    <textarea class="form-input" rows="3">Animalerie HMZ - Votre boutique en ligne pour tous vos animaux de compagnie au Maroc.</textarea>
                </div>
                
                <div class="images-grid">
                    <div class="form-group">
                        <label class="form-label">Logo</label>
                        <img src="/images/logo.png" class="image-preview-compact">
                        <label class="upload-btn-compact"><i class="fas fa-upload mr-2"></i>Changer le Logo</label>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Favicon</label>
                        <div class="w-12 h-12 bg-gray-100 rounded mx-auto border flex items-center justify-center">
                            <i class="fas fa-paw text-primary"></i>
                        </div>
                        <label class="upload-btn-compact"><i class="fas fa-upload mr-2"></i>Changer Favicon</label>
                    </div>
                </div>

                <div class="border-t pt-6 mt-6">
                    <h3 class="font-bold text-gray-800 mb-4">Contact & Support</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="form-label">Email de contact</label>
                            <input type="email" class="form-input" value="contact@animaleriehmz.ma">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Téléphone / WhatsApp</label>
                            <input type="text" class="form-input" value="+212 626-911209">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Adresse</label>
                        <textarea class="form-input" rows="2">Casablanca, Maroc</textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button class="save-button"><i class="fas fa-save"></i> Enregistrer les modifications</button>
                </div>
            </div>
        </div>

        <!-- Security -->
        <div class="section-card">
            <div class="section-header red">
                <i class="fas fa-shield-alt"></i> <span>Sécurité</span>
            </div>
            <div class="section-body">
                <div class="form-group">
                    <label class="form-label">Mot de passe actuel</label>
                    <input type="password" class="form-input" value="********">
                </div>
                <div class="form-group">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-input" placeholder="Laissez vide pour ne pas changer">
                </div>
                <div class="form-group">
                    <label class="form-label">Confirmer le nouveau mot de passe</label>
                    <input type="password" class="form-input">
                </div>
                <button class="save-button w-full justify-center mt-4">
                    <i class="fas fa-key"></i> Mettre à jour le mot de passe
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
