@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary/5 via-surface to-secondary/5 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo animalerie.png') }}" alt="Animalerie HMZ" class="h-16">
            </div>
            <h2 class="text-3xl font-extrabold font-headline text-on-surface">
                Connexion
            </h2>
            <p class="mt-2 text-sm text-on-surface-variant">
                Accédez à votre compte Animalerie HMZ
            </p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200">
                    <p class="text-sm text-green-600">{{ session('status') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200">
                    <p class="text-sm text-red-600">{{ session('error') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-bold text-on-surface mb-2">
                        Email
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-surface text-on-surface focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    @error('email')
                        <p class="mt-2 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-on-surface mb-2">
                        Mot de passe
                    </label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="current-password"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-surface text-on-surface focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    @error('password')
                        <p class="mt-2 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" 
                               type="checkbox" 
                               name="remember"
                               class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary">
                        <span class="ml-2 text-sm text-on-surface-variant">Se souvenir de moi</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary hover:text-primary-container transition">
                            Mot de passe oublié?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-primary hover:bg-primary-container text-white font-bold py-4 px-6 rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">login</span>
                    Se connecter
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-on-surface-variant">
                    Pas encore de compte?
                    <a href="{{ route('register') }}" class="font-bold text-primary hover:text-primary-container transition">
                        Créer un compte
                    </a>
                </p>
            </div>

            <!-- Back to Home -->
            <div class="mt-4 text-center">
                <a href="{{ route('home') }}" class="text-sm text-on-surface-variant hover:text-primary transition flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Retour à l'accueil
                </a>
            </div>
        </div>

        <!-- Admin Info (for demo) -->
        <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-200">
            <p class="text-xs text-blue-600 text-center">
                <strong>Admin:</strong> admin@hmz.com / password
            </p>
        </div>
    </div>
</div>
@endsection
