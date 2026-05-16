<!DOCTYPE html>
<html lang="fr" class="scroll-smooth" id="htmlRoot">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Animalerie HMZ - Animalerie en ligne premium pour tous vos animaux de compagnie. Croquettes, accessoires, soins et plus encore.">
    <meta name="keywords" content="animalerie, chien, chat, oiseau, poisson, croquettes, accessoires animaux">
    <title>Animalerie HMZ - Premium Care & Professional Reliability</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body text-on-surface bg-white antialiased overflow-x-hidden transition-colors duration-300 min-h-screen flex flex-col" id="bodyRoot">
    <!-- Dark Mode Init (run before paint to avoid flash) -->
    <script>
        (function() {
            if (localStorage.getItem('hmz-dark') === 'true') {
                document.documentElement.classList.add('dark');
                document.body && document.body.classList.add('dark');
            }
        })();
    </script>
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm" id="header">
        <div class="max-w-[1280px] mx-auto px-6 h-20 flex justify-between items-center">
            <div class="font-headline text-2xl font-bold text-primary-container tracking-tight flex items-center gap-3 cursor-pointer" id="mobileLogo">
                <img src="{{ asset('images/logo animalerie.png') }}" alt="Animalerie HMZ" class="h-12 w-auto object-contain">
                <span class="hidden sm:inline">Animalerie HMZ</span>
            </div>
            
            <nav class="hidden md:flex gap-8" id="mainNav">
                <a href="#" class="font-headline text-base font-semibold text-on-surface-variant hover:text-primary hover:scale-105 transition-all duration-200 relative py-2 nav-link group" data-category="chiens">
                    Chiens
                    <span class="absolute -bottom-[24px] left-0 right-0 h-[3px] bg-primary scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                </a>
                <a href="#" class="font-headline text-base font-semibold text-on-surface-variant hover:text-primary hover:scale-105 transition-all duration-200 relative py-2 nav-link group" data-category="chats">
                    Chats
                    <span class="absolute -bottom-[24px] left-0 right-0 h-[3px] bg-primary scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                </a>
                <a href="#" class="font-headline text-base font-semibold text-on-surface-variant hover:text-primary hover:scale-105 transition-all duration-200 relative py-2 nav-link group" data-category="pigeons">
                    Pigeons
                    <span class="absolute -bottom-[24px] left-0 right-0 h-[3px] bg-primary scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                </a>
                <a href="#" class="font-headline text-base font-semibold text-on-surface-variant hover:text-primary hover:scale-105 transition-all duration-200 relative py-2 nav-link group" data-category="oiseaux">
                    Oiseaux
                    <span class="absolute -bottom-[24px] left-0 right-0 h-[3px] bg-primary scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                </a>
                <a href="#offres" class="font-headline text-base font-bold text-primary hover:scale-105 transition-all duration-200 relative py-2 nav-link active">
                    🔥 Offres
                    <span class="absolute -bottom-[24px] left-0 right-0 h-[3px] bg-primary"></span>
                </a>
                <a href="#support" class="font-headline text-base font-semibold text-on-surface-variant hover:text-primary hover:scale-105 transition-all duration-200 relative py-2 nav-link group">
                    Support
                    <span class="absolute -bottom-[24px] left-0 right-0 h-[3px] bg-primary scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></span>
                </a>
            </nav>
            
            <div class="flex items-center gap-2">
                <!-- Dark Mode Toggle -->
                <button id="darkModeToggle" class="relative w-10 h-10 flex items-center justify-center text-on-surface-variant hover:text-primary hover:bg-surface-container-low dark:hover:bg-gray-800 transition rounded-md" aria-label="Mode sombre">
                    <span class="material-symbols-outlined" id="darkModeIcon">dark_mode</span>
                </button>
                <a href="{{ route('checkout') }}" class="relative w-10 h-10 flex items-center justify-center text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition rounded-md" aria-label="Panier" id="cartBtn">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span class="absolute top-1 right-1 bg-error text-white text-[10px] font-bold min-w-[16px] h-4 rounded-full flex items-center justify-center px-1 opacity-0 scale-0 transition duration-300" id="cartBadge">0</span>
                </a>
                <a href="{{ route('login') }}" class="relative w-10 h-10 flex items-center justify-center text-on-surface-variant hover:text-primary hover:bg-surface-container-low transition rounded-md" aria-label="Mon compte" id="accountBtn">
                    <span class="material-symbols-outlined">account_circle</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Mobile Sidebar -->
    <div class="fixed inset-0 bg-black/50 z-[100] opacity-0 pointer-events-none transition-opacity duration-300" id="sidebarOverlay"></div>
    <aside class="fixed top-0 left-0 bottom-0 w-[280px] bg-white z-[110] transform -translate-x-full transition-transform duration-300 shadow-2xl flex flex-col" id="sidebar">
        <div class="flex items-center justify-between p-6 border-b border-gray-100">
            <div class="font-headline text-lg font-bold text-primary-container flex items-center gap-3">
                <img src="{{ asset('images/logo animalerie.png') }}" alt="Animalerie HMZ" class="h-8 w-auto">
                <span>Animalerie HMZ</span>
            </div>
            <button class="w-8 h-8 flex items-center justify-center text-on-surface-variant rounded-full hover:bg-surface-container-low transition" id="sidebarClose" aria-label="Fermer">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <nav class="flex-1 overflow-y-auto py-4 px-3 flex flex-col gap-1 sidebar-nav">
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition font-medium sidebar-link" data-category="chiens">
                <span class="material-symbols-outlined">pets</span> Chiens
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition font-medium sidebar-link" data-category="chats">
                <span class="material-symbols-outlined">pets</span> Chats
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition font-medium sidebar-link" data-category="pigeons">
                <span class="material-symbols-outlined">flutter</span> Pigeons
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition font-medium sidebar-link" data-category="oiseaux">
                <span class="material-symbols-outlined">flutter</span> Oiseaux
            </a>
            <a href="#offres" class="flex items-center gap-3 px-4 py-3 rounded-lg bg-surface-container-low text-primary font-bold sidebar-link active">
                <span class="material-symbols-outlined">local_offer</span> 🔥 Offres
            </a>
            <a href="#support" class="flex items-center gap-3 px-4 py-3 rounded-lg text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition font-medium sidebar-link">
                <span class="material-symbols-outlined">support_agent</span> Support
            </a>
        </nav>
    </aside>

    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#13183f] pt-16 pb-8 mt-16 text-white" id="support">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12">
                <div>
                    <h3 class="font-headline text-2xl font-bold text-white mb-4">Animalerie HMZ</h3>
                    <p class="text-white/70 mb-6 max-w-md">Votre partenaire de confiance pour le bien-être de vos animaux depuis 2020.</p>
                    <div class="flex gap-4">
                        <a href="https://instagram.com" target="_blank" rel="noopener" class="w-10 h-10 rounded-md bg-white/10 text-white/70 flex items-center justify-center hover:bg-white hover:text-[#13183f] transition" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://facebook.com" target="_blank" rel="noopener" class="w-10 h-10 rounded-md bg-white/10 text-white/70 flex items-center justify-center hover:bg-white hover:text-[#13183f] transition" aria-label="Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        </a>
                        <a href="https://wa.me/33123456789" target="_blank" rel="noopener" class="w-10 h-10 rounded-md bg-white/10 text-white/70 flex items-center justify-center hover:bg-white hover:text-[#13183f] transition" aria-label="WhatsApp">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="font-headline font-bold text-lg mb-4 text-white">Boutique</h4>
                    <ul class="flex flex-col gap-2">
                        <li><a href="#" class="text-white/70 hover:text-white transition">Chiens</a></li>
                        <li><a href="#" class="text-white/70 hover:text-white transition">Chats</a></li>
                        <li><a href="#" class="text-white/70 hover:text-white transition">Oiseaux</a></li>
                        <li><a href="#" class="text-white/70 hover:text-white transition">Poissons</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-white/10 text-center text-sm text-white/50">
                <p>&copy; 2026 Animalerie HMZ. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const html    = document.getElementById('htmlRoot');
            const icon    = document.getElementById('darkModeIcon');
            const btn     = document.getElementById('darkModeToggle');

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

            // Restore saved preference
            applyDark(localStorage.getItem('hmz-dark') === 'true');

            if (btn) {
                btn.addEventListener('click', () => {
                    const isDark = html.classList.contains('dark');
                    localStorage.setItem('hmz-dark', String(!isDark));
                    applyDark(!isDark);
                });
            }
        });
    </script>
</body>
</html>
