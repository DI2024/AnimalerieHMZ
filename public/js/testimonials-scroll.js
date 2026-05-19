/**
 * SCROLL INDICATORS - HERO, TESTIMONIALS & CATEGORIES
 * Gère les indicateurs (dots) pour les sections Hero, Avis et Catégories en mode mobile
 */

document.addEventListener('DOMContentLoaded', function() {
    // Vérifier si on est en mode mobile (max-width: 767px)
    function isMobile() {
        return window.innerWidth <= 767;
    }

    // Initialiser les indicateurs pour le Hero
    function initHeroIndicators() {
        if (!isMobile()) return;

        const container = document.querySelector('.hero-slides-scroll');
        const indicatorsContainer = document.querySelector('.hero-indicators');
        
        if (!container || !indicatorsContainer) return;

        // Compter le nombre de slides
        const slides = container.querySelectorAll('.hero-slide');
        const count = slides.length;

        // Créer les dots
        indicatorsContainer.innerHTML = '';
        for (let i = 0; i < count; i++) {
            const dot = document.createElement('div');
            dot.className = 'hero-dot';
            if (i === 0) dot.classList.add('active');
            indicatorsContainer.appendChild(dot);
        }

        // Mettre à jour les dots lors du scroll
        let scrollTimeout;
        container.addEventListener('scroll', function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(function() {
                updateActiveDot(container, indicatorsContainer, slides, 'hero-dot');
            }, 100);
        });
    }

    // Initialiser les indicateurs pour les testimonials
    function initTestimonialsIndicators() {
        if (!isMobile()) return;

        const container = document.querySelector('.testimonials-mobile-scroll');
        const indicatorsContainer = document.querySelector('.testimonials-indicators');
        
        if (!container || !indicatorsContainer) return;

        // Compter le nombre d'avis
        const testimonials = container.querySelectorAll('.testimonials-mobile-scroll > div');
        const count = testimonials.length;

        // Créer les dots
        indicatorsContainer.innerHTML = '';
        for (let i = 0; i < count; i++) {
            const dot = document.createElement('div');
            dot.className = 'testimonials-dot';
            if (i === 0) dot.classList.add('active');
            indicatorsContainer.appendChild(dot);
        }

        // Mettre à jour les dots lors du scroll
        let scrollTimeout;
        container.addEventListener('scroll', function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(function() {
                updateActiveDot(container, indicatorsContainer, testimonials, 'testimonials-dot');
            }, 100);
        });
    }

    // Initialiser les indicateurs pour les catégories
    function initCategoriesIndicators() {
        if (!isMobile()) return;

        const container = document.querySelector('.categories-mobile-scroll');
        const indicatorsContainer = document.querySelector('.categories-indicators');
        
        if (!container || !indicatorsContainer) return;

        // Compter le nombre de catégories
        const categories = container.querySelectorAll('.categories-mobile-scroll > a');
        const count = categories.length;

        // Créer les dots
        indicatorsContainer.innerHTML = '';
        for (let i = 0; i < count; i++) {
            const dot = document.createElement('div');
            dot.className = 'categories-dot';
            if (i === 0) dot.classList.add('active');
            indicatorsContainer.appendChild(dot);
        }

        // Mettre à jour les dots lors du scroll
        let scrollTimeout;
        container.addEventListener('scroll', function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(function() {
                updateActiveDot(container, indicatorsContainer, categories, 'categories-dot');
            }, 100);
        });
    }

    // Fonction générique pour mettre à jour le dot actif
    function updateActiveDot(container, indicatorsContainer, items, dotClass) {
        const scrollLeft = container.scrollLeft;
        const itemWidth = items[0].offsetWidth;
        const gap = parseFloat(getComputedStyle(container).gap) || 16;
        const currentIndex = Math.round(scrollLeft / (itemWidth + gap));

        // Mettre à jour les dots
        const dots = indicatorsContainer.querySelectorAll('.' + dotClass);
        dots.forEach((dot, index) => {
            if (index === currentIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }

    // Initialiser au chargement
    initHeroIndicators();
    initTestimonialsIndicators();
    initCategoriesIndicators();

    // Réinitialiser lors du redimensionnement de la fenêtre
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            initHeroIndicators();
            initTestimonialsIndicators();
            initCategoriesIndicators();
        }, 250);
    });
});


/**
 * PRODUCT GALLERY SCROLL - PAGE DÉTAILS PRODUIT
 * Gère les indicateurs (dots) pour la galerie produit en mode mobile
 */

// Initialiser les indicateurs pour la galerie produit
function initProductGalleryIndicators() {
    if (!isMobile()) return;

    const container = document.querySelector('.product-gallery-scroll');
    const indicatorsContainer = document.querySelector('.product-gallery-indicators');
    
    if (!container || !indicatorsContainer) return;

    // Compter le nombre d'images
    const slides = container.querySelectorAll('.product-gallery-slide');
    const count = slides.length;

    // Ne créer les dots que s'il y a plusieurs images
    if (count <= 1) return;

    // Créer les dots
    indicatorsContainer.innerHTML = '';
    for (let i = 0; i < count; i++) {
        const dot = document.createElement('div');
        dot.className = 'product-gallery-dot';
        if (i === 0) dot.classList.add('active');
        indicatorsContainer.appendChild(dot);
    }

    // Mettre à jour les dots lors du scroll
    let scrollTimeout;
    container.addEventListener('scroll', function() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(function() {
            updateActiveDot(container, indicatorsContainer, slides, 'product-gallery-dot');
        }, 100);
    });
}

// Ajouter l'initialisation de la galerie produit au chargement
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser la galerie produit
    initProductGalleryIndicators();
});

// Réinitialiser lors du redimensionnement (ajouter à l'event listener existant)
window.addEventListener('resize', function() {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(function() {
        initHeroIndicators();
        initTestimonialsIndicators();
        initCategoriesIndicators();
        initProductGalleryIndicators(); // Ajouter cette ligne
    }, 250);
});
