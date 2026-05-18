@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                    Paramètres du compte
                </h1>
                <p class="text-gray-600">
                    Gérez vos informations personnelles et votre sécurité
                </p>
            </div>
            <a href="{{ route('dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition flex items-center gap-2">
                <span class="material-symbols-outlined">arrow_back</span>
                Retour
            </a>
        </div>

        <div class="space-y-6">
            <!-- Profile Information -->
            <div class="bg-white rounded-xl p-6 md:p-8 border border-gray-200 shadow-sm">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white rounded-xl p-6 md:p-8 border border-gray-200 shadow-sm">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-white rounded-xl p-6 md:p-8 border border-gray-200 shadow-sm">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
