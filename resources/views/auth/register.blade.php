@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary/5 via-surface to-secondary/5 dark:from-[#0f1117] dark:via-[#13162a] dark:to-[#0f1117] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo animalerie.png') }}" alt="Animalerie HMZ" class="h-16">
            </div>
            <h2 class="text-3xl font-extrabold font-headline text-on-surface dark:text-white">
                Créer un compte
            </h2>
            <p class="mt-2 text-sm text-on-surface-variant dark:text-gray-400">
                Rejoignez la communauté Animalerie HMZ
            </p>
        </div>

        <!-- Register Card -->
        <div class="bg-white dark:bg-[#1a1d2e] rounded-3xl shadow-2xl p-8 border border-gray-100 dark:border-gray-800">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-bold text-on-surface dark:text-white mb-2">
                        Nom complet
                    </label>
                    <input id="name" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus 
                           autocomplete="name"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-surface dark:bg-[#13162a] text-on-surface dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    @error('name')
                        <p class="mt-2 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-bold text-on-surface dark:text-white mb-2">
                        Email
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="username"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-surface dark:bg-[#13162a] text-on-surface dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    @error('email')
                        <p class="mt-2 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-on-surface dark:text-white mb-2">
                        Mot de passe
                    </label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="new-password"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-surface dark:bg-[#13162a] text-on-surface dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    @error('password')
                        <p class="mt-2 text-sm text-error">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-on-surface-variant dark:text-gray-500">
                        Minimum 8 caractères
                    </p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-on-surface dark:text-white mb-2">
                        Confirmer le mot de passe
                    </label>
                    <input id="password_confirmation" 
                           type="password" 
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-surface dark:bg-[#13162a] text-on-surface dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Terms -->
                <div class="flex items-start">
                    <input id="terms" 
                           type="checkbox" 
                           required
                           class="mt-1 rounded border-gray-300 dark:border-gray-700 text-primary shadow-sm focus:ring-primary">
                    <label for="terms" class="ml-2 text-sm text-on-surface-variant dark:text-gray-400">
                        J'accepte les <a href="#" class="text-primary hover:underline">conditions d'utilisation</a> et la <a href="#" class="text-primary hover:underline">politique de confidentialité</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-primary hover:bg-primary-container text-white font-bold py-4 px-6 rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">person_add</span>
                    Créer mon compte
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-on-surface-variant dark:text-gray-400">
                    Vous avez déjà un compte?
                    <a href="{{ route('login') }}" class="font-bold text-primary hover:text-primary-container transition">
                        Se connecter
                    </a>
                </p>
            </div>

            <!-- Back to Home -->
            <div class="mt-4 text-center">
                <a href="{{ route('home') }}" class="text-sm text-on-surface-variant dark:text-gray-400 hover:text-primary transition flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Retour à l'accueil
                </a>
            </div>
        </div>

        <!-- Info -->
        <div class="mt-6 p-4 bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800">
            <p class="text-xs text-green-600 dark:text-green-400 text-center">
                <strong>Note:</strong> Les nouveaux comptes sont automatiquement créés en tant que clients
            </p>
        </div>
    </div>
</div>
@endsection
