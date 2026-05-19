/**
 * ============================================
 * SYSTÈME DE CAROUSEL HORIZONTAL UNIVERSEL
 * ============================================
 * 
 * Gère tous les carousels de l'application avec:
 * - Scroll horizontal fluide
 * - Boutons prev/next
 * - Indicateurs (dots)
 * - Swipe gestures sur mobile
 * - Keyboard navigation
 * - Auto-play optionnel
 */

class Carousel {
  constructor(element, options = {}) {
    this.container = element;
    this.wrapper = element.querySelector('.carousel-wrapper');
    this.track = element.querySelector('.carousel-track');
    this.prevBtn = element.querySelector('.carousel-btn.prev');
    this.nextBtn = element.querySelector('.carousel-btn.next');
    this.indicators = element.querySelector('.carousel-indicators');
    
    // Options
    this.options = {
      itemsToScroll: 1,
      autoPlay: false,
      autoPlayInterval: 5000,
      showIndicators: true,
      enableSwipe: true,
      enableKeyboard: true,
      ...options
    };
    
    // État
    this.currentIndex = 0;
    this.itemWidth = 0;
    this.gap = 0;
    this.autoPlayTimer = null;
    
    this.init();
  }
  
  init() {
    if (!this.wrapper || !this.track) {
      console.warn('Carousel: wrapper ou track manquant');
      return;
    }
    
    // Calculer dimensions
    this.calculateDimensions();
    
    // Event listeners
    this.attachEventListeners();
    
    // Créer indicateurs
    if (this.options.showIndicators && this.indicators) {
      this.createIndicators();
    }
    
    // État initial des boutons
    this.updateButtons();
    
    // Auto-play
    if (this.options.autoPlay) {
      this.startAutoPlay();
    }
    
    // Recalculer au resize
    window.addEventListener('resize', this.debounce(() => {
      this.calculateDimensions();
      this.updateButtons();
    }, 250));
  }
  
  calculateDimensions() {
    const firstItem = this.track.firstElementChild;
    if (!firstItem) return;
    
    this.itemWidth = firstItem.offsetWidth;
    const trackStyle = window.getComputedStyle(this.track);
    this.gap = parseInt(trackStyle.gap) || 0;
    
    // Calculer nombre d'items visibles
    this.visibleItems = Math.floor(this.wrapper.offsetWidth / (this.itemWidth + this.gap));
    this.totalItems = this.track.children.length;
    this.maxIndex = Math.max(0, this.totalItems - this.visibleItems);
  }
  
  attachEventListeners() {
    // Boutons prev/next
    if (this.prevBtn) {
      this.prevBtn.addEventListener('click', () => this.prev());
    }
    
    if (this.nextBtn) {
      this.nextBtn.addEventListener('click', () => this.next());
    }
    
    // Scroll event
    this.wrapper.addEventListener('scroll', this.debounce(() => {
      this.updateButtons();
      this.updateIndicators();
      
      // Pause auto-play pendant scroll manuel
      if (this.options.autoPlay) {
        this.stopAutoPlay();
        this.startAutoPlay();
      }
    }, 100));
    
    // Swipe gestures
    if (this.options.enableSwipe) {
      this.enableSwipe();
    }
    
    // Keyboard navigation
    if (this.options.enableKeyboard) {
      this.enableKeyboard();
    }
    
    // Pause auto-play au hover
    if (this.options.autoPlay) {
      this.container.addEventListener('mouseenter', () => this.stopAutoPlay());
      this.container.addEventListener('mouseleave', () => this.startAutoPlay());
    }
  }
  
  prev() {
    this.scrollToIndex(Math.max(0, this.currentIndex - this.options.itemsToScroll));
  }
  
  next() {
    this.scrollToIndex(Math.min(this.maxIndex, this.currentIndex + this.options.itemsToScroll));
  }
  
  scrollToIndex(index) {
    const scrollAmount = index * (this.itemWidth + this.gap);
    this.wrapper.scrollTo({
      left: scrollAmount,
      behavior: 'smooth'
    });
    this.currentIndex = index;
  }
  
  updateButtons() {
    const { scrollLeft, scrollWidth, clientWidth } = this.wrapper;
    
    if (this.prevBtn) {
      this.prevBtn.disabled = scrollLeft <= 5;
      this.prevBtn.style.opacity = scrollLeft <= 5 ? '0.3' : '1';
    }
    
    if (this.nextBtn) {
      const isAtEnd = scrollLeft >= scrollWidth - clientWidth - 5;
      this.nextBtn.disabled = isAtEnd;
      this.nextBtn.style.opacity = isAtEnd ? '0.3' : '1';
    }
    
    // Mettre à jour currentIndex basé sur scroll
    this.currentIndex = Math.round(scrollLeft / (this.itemWidth + this.gap));
  }
  
  createIndicators() {
    if (!this.indicators) return;
    
    this.indicators.innerHTML = '';
    const dotsCount = Math.ceil(this.totalItems / this.visibleItems);
    
    for (let i = 0; i < dotsCount; i++) {
      const dot = document.createElement('button');
      dot.className = 'carousel-dot';
      dot.setAttribute('aria-label', `Aller à la page ${i + 1}`);
      dot.addEventListener('click', () => {
        this.scrollToIndex(i * this.visibleItems);
      });
      this.indicators.appendChild(dot);
    }
    
    this.updateIndicators();
  }
  
  updateIndicators() {
    if (!this.indicators) return;
    
    const dots = this.indicators.querySelectorAll('.carousel-dot');
    const activeDotIndex = Math.floor(this.currentIndex / this.visibleItems);
    
    dots.forEach((dot, index) => {
      dot.classList.toggle('active', index === activeDotIndex);
    });
  }
  
  enableSwipe() {
    let startX = 0;
    let startY = 0;
    let isDragging = false;
    
    this.wrapper.addEventListener('touchstart', (e) => {
      startX = e.touches[0].clientX;
      startY = e.touches[0].clientY;
      isDragging = true;
    }, { passive: true });
    
    this.wrapper.addEventListener('touchmove', (e) => {
      if (!isDragging) return;
      
      const currentX = e.touches[0].clientX;
      const currentY = e.touches[0].clientY;
      const diffX = startX - currentX;
      const diffY = startY - currentY;
      
      // Si swipe horizontal, empêcher scroll vertical
      if (Math.abs(diffX) > Math.abs(diffY)) {
        e.preventDefault();
      }
    }, { passive: false });
    
    this.wrapper.addEventListener('touchend', (e) => {
      if (!isDragging) return;
      
      const endX = e.changedTouches[0].clientX;
      const endY = e.changedTouches[0].clientY;
      const diffX = startX - endX;
      const diffY = startY - endY;
      
      isDragging = false;
      
      // Swipe horizontal si diffX > diffY et > 50px
      if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 50) {
        if (diffX > 0) {
          this.next();
        } else {
          this.prev();
        }
      }
    }, { passive: true });
  }
  
  enableKeyboard() {
    this.container.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowLeft') {
        e.preventDefault();
        this.prev();
      } else if (e.key === 'ArrowRight') {
        e.preventDefault();
        this.next();
      }
    });
    
    // Rendre le container focusable
    if (!this.container.hasAttribute('tabindex')) {
      this.container.setAttribute('tabindex', '0');
    }
  }
  
  startAutoPlay() {
    if (!this.options.autoPlay) return;
    
    this.stopAutoPlay();
    this.autoPlayTimer = setInterval(() => {
      if (this.currentIndex >= this.maxIndex) {
        this.scrollToIndex(0);
      } else {
        this.next();
      }
    }, this.options.autoPlayInterval);
  }
  
  stopAutoPlay() {
    if (this.autoPlayTimer) {
      clearInterval(this.autoPlayTimer);
      this.autoPlayTimer = null;
    }
  }
  
  destroy() {
    this.stopAutoPlay();
    // Retirer event listeners si nécessaire
  }
  
  // Utility: Debounce
  debounce(func, wait) {
    let timeout;
    return (...args) => {
      clearTimeout(timeout);
      timeout = setTimeout(() => func.apply(this, args), wait);
    };
  }
}

/**
 * ============================================
 * AUTO-INITIALISATION
 * ============================================
 */

document.addEventListener('DOMContentLoaded', () => {
  // Initialiser tous les carousels
  const carousels = document.querySelectorAll('.carousel-container');
  
  carousels.forEach(element => {
    // Options personnalisées via data attributes
    const options = {
      autoPlay: element.dataset.autoplay === 'true',
      autoPlayInterval: parseInt(element.dataset.interval) || 5000,
      showIndicators: element.dataset.indicators !== 'false',
      enableSwipe: element.dataset.swipe !== 'false',
      enableKeyboard: element.dataset.keyboard !== 'false',
    };
    
    new Carousel(element, options);
  });
  
  console.log(`✅ ${carousels.length} carousel(s) initialisé(s)`);
});

/**
 * ============================================
 * LAZY LOADING IMAGES
 * ============================================
 */

class LazyLoader {
  constructor() {
    this.images = document.querySelectorAll('img[data-src]');
    this.init();
  }
  
  init() {
    if ('IntersectionObserver' in window) {
      this.observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            this.loadImage(entry.target);
          }
        });
      }, {
        rootMargin: '50px'
      });
      
      this.images.forEach(img => this.observer.observe(img));
    } else {
      // Fallback pour navigateurs anciens
      this.images.forEach(img => this.loadImage(img));
    }
  }
  
  loadImage(img) {
    const src = img.dataset.src;
    if (!src) return;
    
    img.src = src;
    img.removeAttribute('data-src');
    
    img.addEventListener('load', () => {
      img.classList.add('loaded');
    });
    
    if (this.observer) {
      this.observer.unobserve(img);
    }
  }
}

// Initialiser lazy loading
document.addEventListener('DOMContentLoaded', () => {
  new LazyLoader();
});

/**
 * ============================================
 * MOBILE MENU
 * ============================================
 */

class MobileMenu {
  constructor() {
    this.menu = document.querySelector('.mobile-menu');
    this.overlay = document.querySelector('.mobile-menu-overlay');
    this.openBtn = document.querySelector('[data-mobile-menu-open]');
    this.closeBtn = document.querySelector('[data-mobile-menu-close]');
    
    if (this.menu) {
      this.init();
    }
  }
  
  init() {
    if (this.openBtn) {
      this.openBtn.addEventListener('click', () => this.open());
    }
    
    if (this.closeBtn) {
      this.closeBtn.addEventListener('click', () => this.close());
    }
    
    if (this.overlay) {
      this.overlay.addEventListener('click', () => this.close());
    }
    
    // Fermer avec Escape
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && this.isOpen()) {
        this.close();
      }
    });
  }
  
  open() {
    this.menu.classList.add('active');
    if (this.overlay) {
      this.overlay.classList.add('active');
    }
    document.body.style.overflow = 'hidden';
  }
  
  close() {
    this.menu.classList.remove('active');
    if (this.overlay) {
      this.overlay.classList.remove('active');
    }
    document.body.style.overflow = '';
  }
  
  isOpen() {
    return this.menu.classList.contains('active');
  }
}

// Initialiser mobile menu
document.addEventListener('DOMContentLoaded', () => {
  new MobileMenu();
});

/**
 * ============================================
 * SMOOTH SCROLL POUR ANCRES
 * ============================================
 */

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const href = this.getAttribute('href');
      
      // Ignorer # seul
      if (href === '#') return;
      
      const target = document.querySelector(href);
      if (target) {
        e.preventDefault();
        
        const offsetTop = target.offsetTop - 80; // 80px pour navbar sticky
        
        window.scrollTo({
          top: offsetTop,
          behavior: 'smooth'
        });
        
        // Fermer mobile menu si ouvert
        const mobileMenu = document.querySelector('.mobile-menu');
        if (mobileMenu && mobileMenu.classList.contains('active')) {
          mobileMenu.classList.remove('active');
          const overlay = document.querySelector('.mobile-menu-overlay');
          if (overlay) overlay.classList.remove('active');
          document.body.style.overflow = '';
        }
      }
    });
  });
});

/**
 * ============================================
 * SCROLL TO TOP BUTTON
 * ============================================
 */

class ScrollToTop {
  constructor() {
    this.button = this.createButton();
    this.init();
  }
  
  createButton() {
    const btn = document.createElement('button');
    btn.className = 'fixed bottom-6 right-6 w-12 h-12 bg-primary text-white rounded-full shadow-lg hover:bg-primary-container transition-all duration-300 z-40 opacity-0 pointer-events-none';
    btn.innerHTML = '<span class="material-symbols-outlined">arrow_upward</span>';
    btn.setAttribute('aria-label', 'Retour en haut');
    document.body.appendChild(btn);
    return btn;
  }
  
  init() {
    window.addEventListener('scroll', this.debounce(() => {
      if (window.scrollY > 500) {
        this.button.style.opacity = '1';
        this.button.style.pointerEvents = 'auto';
      } else {
        this.button.style.opacity = '0';
        this.button.style.pointerEvents = 'none';
      }
    }, 100));
    
    this.button.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }
  
  debounce(func, wait) {
    let timeout;
    return (...args) => {
      clearTimeout(timeout);
      timeout = setTimeout(() => func.apply(this, args), wait);
    };
  }
}

// Initialiser scroll to top
document.addEventListener('DOMContentLoaded', () => {
  new ScrollToTop();
});

/**
 * ============================================
 * EXPORT POUR UTILISATION EXTERNE
 * ============================================
 */

window.Carousel = Carousel;
window.LazyLoader = LazyLoader;
window.MobileMenu = MobileMenu;
window.ScrollToTop = ScrollToTop;
