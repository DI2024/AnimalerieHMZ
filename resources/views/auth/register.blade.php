<!DOCTYPE html>
<html lang="fr" class="scroll-smooth" id="htmlRoot">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte - Animalerie HMZ</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body text-on-surface bg-surface antialiased overflow-x-hidden transition-colors duration-300" id="bodyRoot">
    <div class="min-h-screen flex">
        <!-- Left Side: Hero Section -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-primary overflow-hidden items-center justify-center p-12">
            <!-- Animated Background Blobs -->
            <div class="absolute top-0 -left-4 w-72 h-72 bg-tertiary rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-0 -right-4 w-72 h-72 bg-primary-container rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-secondary rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

            <!-- Content Container -->
            <div class="relative z-10 w-full max-w-lg">
                <!-- Large Pets Visual -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-tertiary to-primary-container rounded-[2rem] blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative bg-white rounded-[2rem] overflow-hidden shadow-2xl transform transition duration-500 hover:scale-[1.02] flex items-center justify-center">
                        <img src="{{ asset('images/pets_hero_login.png') }}" alt="Pets" class="w-full h-auto object-cover block">
                    </div>

                    <!-- Floating Badges -->
                    <div class="absolute -top-6 -right-6 glass p-4 rounded-2xl shadow-xl animate-float flex items-center justify-center min-w-[140px]">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary shrink-0">
                                <span class="material-symbols-outlined text-[20px] leading-none">star</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[10px] uppercase tracking-wider font-bold text-primary/60 leading-tight">Avantages</span>
                                <span class="font-bold text-sm leading-tight">Membre VIP</span>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -bottom-6 -left-6 glass p-4 rounded-2xl shadow-xl animate-float-slow flex items-center justify-center min-w-[140px]">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-secondary/10 flex items-center justify-center text-secondary shrink-0">
                                <span class="material-symbols-outlined text-[20px] leading-none">card_giftcard</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[10px] uppercase tracking-wider font-bold text-secondary/60 leading-tight">Offert</span>
                                <span class="font-bold text-sm leading-tight">Pack Bienvenue</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catchphrase -->
                <div class="mt-16 space-y-6">
                    <h1 class="font-headline text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                        Rejoignez notre <span class="text-tertiary">communauté</span> aujourd'hui.
                    </h1>
                    <p class="text-white/70 text-lg max-w-md">
                        Créez votre compte gratuit et profitez d'offres exclusives, de récompenses fidélité et bien plus encore.
                    </p>
                    <div class="flex gap-4 items-center">
                        <div class="flex -space-x-3">
                            <img src="https://i.pravatar.cc/150?img=1" alt="" class="w-10 h-10 rounded-full border-2 border-primary shadow-sm">
                            <img src="https://i.pravatar.cc/150?img=12" alt="" class="w-10 h-10 rounded-full border-2 border-primary shadow-sm">
                            <img src="https://i.pravatar.cc/150?img=5" alt="" class="w-10 h-10 rounded-full border-2 border-primary shadow-sm">
                            <div class="w-10 h-10 rounded-full bg-tertiary border-2 border-primary shadow-sm flex items-center justify-center text-[10px] font-bold text-white">+2k</div>
                        </div>
                        <span class="text-white/60 text-sm font-medium">Déjà adoptés par 10,000+ propriétaires</span>
                    </div>
                </div>
            </div>
            
            <!-- Decorative Elements -->
            <div class="absolute top-10 left-10 opacity-10">
                <span class="material-symbols-outlined text-[120px] text-white rotate-12">pets</span>
            </div>
            <div class="absolute bottom-10 right-10 opacity-10">
                <span class="material-symbols-outlined text-[120px] text-white -rotate-12">favorite</span>
            </div>
        </div>

        <!-- Right Side: Register Form -->
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8 sm:p-16 bg-white dark:bg-gray-900 relative min-h-screen overflow-y-auto transition-colors duration-300" id="registerSide">
            <!-- Back to Home Button -->
            <div class="absolute top-6 left-6 lg:top-10 lg:left-10 z-30">
                <a href="/" class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition font-bold group bg-white dark:bg-gray-800 px-5 py-2.5 rounded-full shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md">
                    <span class="material-symbols-outlined text-[20px] group-hover:-translate-x-1 transition leading-none">arrow_back</span>
                    Retour au site
                </a>
            </div>

            <!-- Dark Mode Toggle -->
            <div class="absolute top-6 right-6 lg:top-10 lg:right-10 z-30">
                <button id="darkToggleRegister" class="w-11 h-11 flex items-center justify-center rounded-full bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition text-on-surface-variant hover:text-primary" aria-label="Basculer le mode sombre">
                    <span class="material-symbols-outlined text-[22px] leading-none" id="darkIconRegister">dark_mode</span>
                </button>
            </div>

            <div class="w-full max-w-md space-y-10 animate-[fadeIn_0.5s_ease-out] relative z-10 py-28">
                <!-- Header -->
                <div class="text-center lg:text-left space-y-4 mb-4">
                    <img src="{{ asset('images/logo animalerie.png') }}" alt="Logo" class="h-12 w-auto mx-auto lg:mx-0 mb-6">
                    <h2 class="font-headline text-4xl font-extrabold tracking-tight text-on-surface dark:text-white">Créer un compte</h2>
                    <p class="text-on-surface-variant dark:text-gray-400 text-lg">Bienvenue ! Rejoignez-nous en quelques instants.</p>
                </div>

                <!-- Form Card with Grand Ticket Shadow -->
                <div class="ticket-card">
                    <div class="ticket-inner dark:bg-gray-800/50">
                        <form action="#" class="space-y-8">
                            <!-- Name Fields -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-3">
                                    <label for="prenom" class="text-sm font-bold text-on-surface dark:text-gray-200 ml-3">Prénom</label>
                                    <div class="flex items-center gap-4 bg-white dark:bg-gray-900 border-2 border-black dark:border-gray-600 rounded-[1.5rem] px-6 transition-all duration-300 focus-within:ring-8 focus-within:ring-primary/5 dark:focus-within:ring-primary/10">
                                        <input type="text" id="prenom" name="prenom" required placeholder="Jean"
                                            class="w-full py-5 bg-transparent border-none outline-none text-on-surface dark:text-white placeholder:text-outline/60 text-base font-medium">
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label for="nom" class="text-sm font-bold text-on-surface dark:text-gray-200 ml-3">Nom</label>
                                    <div class="flex items-center gap-4 bg-white dark:bg-gray-900 border-2 border-black dark:border-gray-600 rounded-[1.5rem] px-6 transition-all duration-300 focus-within:ring-8 focus-within:ring-primary/5">
                                        <input type="text" id="nom" name="nom" required placeholder="Dupont"
                                            class="w-full py-5 bg-transparent border-none outline-none text-on-surface dark:text-white placeholder:text-outline/60 text-base font-medium">
                                    </div>
                                </div>
                            </div>

                            <!-- Email Field -->
                            <div class="space-y-3">
                                <label for="email" class="text-sm font-bold text-on-surface dark:text-gray-200 ml-3">Adresse Email</label>
                                <div class="flex items-center gap-5 bg-white dark:bg-gray-900 border-2 border-black dark:border-gray-600 rounded-[2rem] px-8 transition-all duration-300 focus-within:ring-8 focus-within:ring-primary/5">
                                    <span class="material-symbols-outlined text-black dark:text-gray-400 leading-none shrink-0 text-[24px]">mail</span>
                                    <input type="email" id="email" name="email" required placeholder="votre@email.com" 
                                        class="w-full py-6 bg-transparent border-none outline-none text-on-surface dark:text-white placeholder:text-outline/60 text-lg font-medium">
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="space-y-3">
                                <label for="password" class="text-sm font-bold text-on-surface dark:text-gray-200 ml-3">Mot de passe</label>
                                <div class="flex items-center gap-5 bg-white dark:bg-gray-900 border-2 border-black dark:border-gray-600 rounded-[2rem] px-8 transition-all duration-300 focus-within:ring-8 focus-within:ring-primary/5">
                                    <span class="material-symbols-outlined text-black dark:text-gray-400 leading-none shrink-0 text-[24px]">lock</span>
                                    <input type="password" id="password" name="password" required placeholder="••••••••" 
                                        class="w-full py-6 bg-transparent border-none outline-none text-on-surface dark:text-white placeholder:text-outline/60 text-lg font-medium">
                                    <button type="button" class="text-black dark:text-gray-400 hover:text-primary transition shrink-0" id="togglePasswordReg">
                                        <span class="material-symbols-outlined text-[24px] leading-none">visibility</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="space-y-3">
                                <label for="password_confirm" class="text-sm font-bold text-on-surface dark:text-gray-200 ml-3">Confirmer le mot de passe</label>
                                <div class="flex items-center gap-5 bg-white dark:bg-gray-900 border-2 border-black dark:border-gray-600 rounded-[2rem] px-8 transition-all duration-300 focus-within:ring-8 focus-within:ring-primary/5">
                                    <span class="material-symbols-outlined text-black dark:text-gray-400 leading-none shrink-0 text-[24px]">lock_reset</span>
                                    <input type="password" id="password_confirm" name="password_confirmation" required placeholder="••••••••" 
                                        class="w-full py-6 bg-transparent border-none outline-none text-on-surface dark:text-white placeholder:text-outline/60 text-lg font-medium">
                                </div>
                            </div>

                            <!-- Terms Checkbox -->
                            <div class="flex items-start gap-4 py-2">
                                <label class="flex items-start gap-4 cursor-pointer group w-fit">
                                    <div class="relative flex items-center mt-0.5">
                                        <input type="checkbox" class="peer sr-only" required>
                                        <div class="w-7 h-7 border-2 border-black dark:border-gray-500 rounded-xl peer-checked:bg-black peer-checked:border-black dark:peer-checked:bg-primary dark:peer-checked:border-primary transition shrink-0"></div>
                                        <span class="material-symbols-outlined absolute text-[18px] text-white opacity-0 peer-checked:opacity-100 transition left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 font-bold leading-none">check</span>
                                    </div>
                                    <span class="text-sm font-medium text-on-surface-variant dark:text-gray-400 group-hover:text-primary transition leading-relaxed">
                                        J'accepte les <a href="#" class="text-primary font-bold hover:underline">conditions d'utilisation</a> et la <a href="#" class="text-primary font-bold hover:underline">politique de confidentialité</a>
                                    </span>
                                </label>
                            </div>

                            <!-- Register Button -->
                            <div class="pt-4">
                                <button type="submit" class="w-full bg-primary hover:bg-primary-container text-white font-bold py-6 rounded-[2rem] shadow-xl shadow-primary/20 hover:shadow-primary/30 transform hover:-translate-y-1 active:translate-y-0 transition-all duration-300 flex items-center justify-center gap-3 text-lg group">
                                    Créer mon compte
                                    <span class="material-symbols-outlined text-[24px] group-hover:translate-x-1 transition leading-none">arrow_forward</span>
                                </button>
                            </div>
                        </form>

                        <!-- Social Login Separator -->
                        <div class="relative my-10">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-100 dark:border-gray-700"></div>
                            </div>
                            <div class="relative flex justify-center text-xs">
                                <span class="px-5 bg-white dark:bg-gray-800 rounded-full border border-gray-100 dark:border-gray-700 text-outline font-bold uppercase tracking-widest py-1">Ou</span>
                            </div>
                        </div>

                        <!-- Social Login Buttons -->
                        <div class="grid grid-cols-2 gap-4">
                            <button class="flex items-center justify-center gap-3 py-5 border-2 border-black dark:border-gray-600 rounded-xl hover:bg-white hover:border-primary dark:hover:border-primary transition-all duration-300">
                                <svg class="w-5 h-5" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                    <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                    <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                                    <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.66l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                                </svg>
                                <span class="text-xs font-bold text-on-surface dark:text-gray-300">Google</span>
                            </button>
                            <button class="flex items-center justify-center gap-3 py-5 border-2 border-black dark:border-gray-600 rounded-xl hover:bg-white hover:border-primary dark:hover:border-primary transition-all duration-300">
                                <svg class="w-5 h-5 text-[#1877F2]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                <span class="text-xs font-bold text-on-surface dark:text-gray-300">Facebook</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <p class="text-center text-on-surface-variant dark:text-gray-400 text-sm">
                    Déjà inscrit ? 
                    <a href="{{ route('login') }}" class="text-primary font-bold hover:underline">Se connecter</a>
                </p>
            </div>
            
            <!-- Blob for Right Side Depth -->
            <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-surface-container rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Password toggle
            const passInput = document.getElementById('password');
            const toggleBtn = document.getElementById('togglePasswordReg');
            
            if (toggleBtn && passInput) {
                toggleBtn.addEventListener('click', () => {
                    const isPass = passInput.type === 'password';
                    passInput.type = isPass ? 'text' : 'password';
                    toggleBtn.querySelector('span').textContent = isPass ? 'visibility_off' : 'visibility';
                });
            }

            // Dark mode toggle (sync with global)
            const html = document.getElementById('htmlRoot');
            const icon = document.getElementById('darkIconRegister');
            const btn = document.getElementById('darkToggleRegister');
            const side = document.getElementById('registerSide');

            function applyDark(isDark) {
                if (isDark) {
                    html.classList.add('dark');
                    document.body.classList.add('dark');
                    if (icon) icon.textContent = 'light_mode';
                } else {
                    html.classList.remove('dark');
                    document.body.classList.remove('dark');
                    if (icon) icon.textContent = 'dark_mode';
                }
            }

            const saved = localStorage.getItem('hmz-dark');
            applyDark(saved === 'true');

            if (btn) {
                btn.addEventListener('click', () => {
                    const isDark = html.classList.contains('dark');
                    localStorage.setItem('hmz-dark', !isDark);
                    applyDark(!isDark);
                });
            }
        });
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>
