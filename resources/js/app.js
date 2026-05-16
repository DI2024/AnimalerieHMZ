// ===================================
// Data - Products Database
// ===================================
const products = [
    {
        id: 1,
        name: 'Croquettes Premium Vitality',
        category: 'chiens',
        price: 24.99,
        discount: 20,
        rating: 5,
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A'
    },
    {
        id: 2,
        name: 'Litière Ultra Absorbante',
        category: 'chats',
        price: 12.50,
        rating: 4,
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCIgvNYgMNUX5dDqy9Ji_Xgxifl2RujROG1NGbtl-Mih2srLRpvr-ALYegp6tS66MyQnjGxpl4olvyw9hCamdiCkFivkf896OtEa385MGru_6Q019kTiqpbFtKgGowNvA-C_TqIx5l22H157bz1Kcvgw2kJCLW2ErRaYX-3bMGsSF7HTL6rLtQi-kLHDBGF2tudqZjjiCzdZKJopX7DanJL1aNaI1FjSwc8AKJscFoxJWMwFwX9dD2EIjNlqIw5XwkaHGF8gSSmNmY'
    },
    {
        id: 3,
        name: 'Cage Volière Design M',
        category: 'oiseaux',
        price: 89.00,
        rating: 5,
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuClYWz_RZMFkeB388ZG-bh97mfPIVfjx52xnIAnsFCry5DWZr8JkZXXkvrfCd2JOvT3T7_e_oaDJovqOm9TBKI3IPyEu2oy5WBERvzx8P9OZF6BSRW8An7kMKAtFYnnXop35gZx-PEXS_yHmFD-LtMRfnHJT1pW5KpMrlxiH3KmQsMgNQ4Tw1qRfUb6-hhALmKaLq4mLRU_KmVH0ZVgQ14sGqeKKwRf8YeIsbeMVZX3BKvf70UPS2eUrgW-ETcGeGK4Byx_hIfiVFw'
    },
    {
        id: 4,
        name: 'Shampoing Aloe Vera Bio',
        category: 'soins',
        price: 15.90,
        rating: 4,
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuAAKEbJd0Fwah11PJ5nNdxnkgqVAJujuKn1psVYULqfnCYm8DMKsGBvCL8rlDAYk5hL5fM9vKhA4vgnAcUrn-9EBeTIPHPC4Cy1suw7MLhKBOediIOy00h5Pp5oVPCSe52lku-11RZmr1IFDRpKb67AnZRw-IIZ7DvrDuWBj6rSgpSpO0uTPkLdrZDdpTygjpBnhOCIYlFniv_h-kIAML8WgCKAAATtuf1YkOsz15darvkZhc0AS1TpZLD9a2HWASeM7yKUFfVTeSU'
    },
    {
        id: 5,
        name: 'Aquarium Design 30L',
        category: 'poissons',
        price: 129.00,
        rating: 5,
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBqASyV7URQYtB7AufDQq3zsXl7XSv9FkFZ2rS7cvCY8SjFBpNtd44dmKeXIseCB9VNUADcDBsTZFb6lITNOv2FLAuO2mwJu_CqbbtFdL1nnCHvOh3gcNgP6etzuggSPuFxOHrjFd94gobAlyjJdlEbFYg-J5N8E9XGz90YLgl0NJs0XhBpPwWcq_WERVUX8hBqXIcEE5Wjyp6mSiNEde_o2uE8CHpFJxQr9iCfpJSCMSWgZ8U6B2nbcBOlsTz53qAdUrzB7JupVkA'
    },
    {
        id: 6,
        name: 'Croquettes Royal Canin',
        category: 'chats',
        price: 34.99,
        rating: 5,
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuDih_ShjrZl6FyKaaP3p3pH1ZQTlB2eVjlzZzXGETjTcpk5P0HKjbQ-wAo4yQ0YAdvsd1OrUi85liTwehVZhIkWVffjHGws8ZiIdDP5msHZ0MCQGEUGGRPAIQMC4sCxHf4znq18vnZ9Wex6KeiZT_lR874YUdp7Pd-pln-NZqJU53gjc7Od7aSf3GwaFTtuQPPI0rARb2Kq-nVLPdY6GK2QkbGJdXc7IfZ-IFMrZFjBvWWy1rTQ6bqrU_rgOA9FxrPErseQweskE4A'
    },
    {
        id: 7,
        name: 'Jouet Interactif Chien',
        category: 'chiens',
        price: 19.90,
        rating: 4,
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuAx-idpF478hzoaaBIUHLUhWNsH922i7ik4yZ4LO2wsFxOXaaH0vCZmjypSNPW30ShDtsjn1yqpnEmIm97kK9VU2iG19ZN0Q_Bc01sr9tKItR4y8LpQcFN8bjT3Gitg7YSmWhoFXxNmov5igt9yvFvKOsFHinogyokHHUyUpIb_jSnIM_foyONoR63ppruzz3Kjj8Q09IM4NcqFWBLcnyUiLmE9JLA5fHEoOWGVZ_SAE5fIRWwLEjQDLqOAa20bHz9MgNHftU0xCdA'
    },
    {
        id: 8,
        name: 'Graines Premium Oiseaux',
        category: 'oiseaux',
        price: 14.50,
        rating: 5,
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCQXx6hiUnOCX6DzOYQFjw2OrpfOIMoRhffQpWaGCqdsUlortBdVqSqAR_xd6Fn6gCZZUFji4VdfAmXhX5s9pzWEhG5UH0lcp21npAq9fuGnRxAzrecick6_ERfAUEza0zCesRzz7kF6nnzRK2ioGzio6gLFkdV9n4QIJMRSH5Rb4rk8a7uyW_yBHJxsVn-H1Qv975itGYfYFVHtLTgQnig4KiM5eMzekLdU-8CzNjmglwOOp0ov466FOPQqMVrFSAg8dhT_-nR4Ko'
    },
    {
        id: 9,
        name: 'Hamac pour Rongeur',
        category: 'rongeurs',
        price: 9.90,
        rating: 4,
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuC2MhSEf8FjMCevLsRaRKqkti7PBsncXuIrzRubKsRDP_HZeec262P_B_sWOr9guPjDTFbgaJE3O7A62ntCnlSVjU_OjdCGd2bGjG3SqDEuGMdxotUYLFiDHeTFsD0iIu9VEhVVdtrHSfJQOGVPpuwm7JvFtkGkXqLKUy6CxDJB8gg5BqQaD70iL7BzeTew7hnWhbEuifdKXB26Lr3dqyA8s2KdL7yk58YlQh9i-nmyLQhWYp2NRgJhdlhi9fVzKA1-Gm7NoNFLv4M'
    },
    {
        id: 10,
        name: 'Arbre à Chat Oasis',
        category: 'chats',
        price: 49.00,
        rating: 5,
        image: 'https://lh3.googleusercontent.com/aida-public/AB6AXuCf13j3hn9fIiDpqfSIlA9_FGHwtCP_eI4a3XaBc8PRii4W1Xpek9f00xWvJE9IUbjlRXdu8-LuGY5LKKcih9AXo-YkFHi7qYjMJd47ArOAqqoOoWn9leyXVBBQuw1n3PCI2GBC55QG4gMu1HBDQkpsFbkZS_WJ0_q_vf2YXJFxlB0HrVo3E1bjSgW_uyEks74dsBVn7FKDLKCduZjyu-6-aJScVW_a1dPEPCDq1rgNwr8q4NCWWeiWomcEutvwHdKGXHPcFYJEMAw'
    }
];

// ===================================
// State Management
// ===================================
const state = {
    cart: [],
    favorites: [],
    currentCategory: 'all'
};

// ===================================
// DOM Elements
// ===================================
const elements = {
    productsGrid: document.getElementById('productsGrid'),
    cartBtn: document.getElementById('cartBtn'),
    cartBadge: document.getElementById('cartBadge'),
    favoritesBadge: document.getElementById('favoritesBadge'),
    cartModal: document.getElementById('cartModal'),
    cartModalOverlay: document.getElementById('cartModalOverlay'),
    cartModalClose: document.getElementById('cartModalClose'),
    cartModalBody: document.getElementById('cartModalBody'),
    cartTotal: document.getElementById('cartTotal'),
    categoryItems: document.querySelectorAll('.category-card-rect'),
    mobileMenuBtn: document.getElementById('mobileMenuBtn'),
    mainNav: document.getElementById('mainNav')
};

// ===================================
// Utility Functions
// ===================================
function formatPrice(price) {
    return price.toFixed(2).replace('.', ',') + '€';
}

function createStarRating(rating) {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        const filled = i <= rating ? 'FILL' : '0';
        const className = i <= rating ? '' : 'empty';
        stars += `<span class="material-symbols-outlined ${className}" style="font-variation-settings: 'FILL' ${filled};">star</span>`;
    }
    return stars;
}

function updateBadge(element, count) {
    element.textContent = count;
    if (count > 0) {
        element.classList.remove('opacity-0', 'scale-0');
        element.classList.add('opacity-100', 'scale-100');
    } else {
        element.classList.add('opacity-0', 'scale-0');
        element.classList.remove('opacity-100', 'scale-100');
    }
}

function saveToLocalStorage() {
    localStorage.setItem('pettrustCart', JSON.stringify(state.cart));
    localStorage.setItem('pettrustFavorites', JSON.stringify(state.favorites));
}

function loadFromLocalStorage() {
    const savedCart = localStorage.getItem('pettrustCart');
    const savedFavorites = localStorage.getItem('pettrustFavorites');
    
    if (savedCart) {
        state.cart = JSON.parse(savedCart);
        updateBadge(elements.cartBadge, state.cart.length);
    }
    
    if (savedFavorites) {
        state.favorites = JSON.parse(savedFavorites);
        updateBadge(elements.favoritesBadge, state.favorites.length);
    }
}

// ===================================
// Product Rendering
// ===================================
function renderProducts(category = 'all') {
    if (!elements.productsGrid) return;
    
    const filteredProducts = category === 'all' 
        ? products 
        : products.filter(p => p.category === category);
    
    elements.productsGrid.innerHTML = filteredProducts.map(product => `
        <article class="bg-white border border-gray-200 rounded-3xl p-5 flex flex-col h-full transition duration-300 hover:shadow-xl hover:-translate-y-1" data-product-id="${product.id}">
            <div class="relative bg-surface rounded-xl overflow-hidden aspect-square flex items-center justify-center p-4 mb-4">
                ${product.discount ? `<span class="absolute top-2 left-2 bg-primary text-white text-[10px] font-bold px-2 py-1 rounded-sm">-${product.discount}%</span>` : ''}
                <img src="${product.image}" alt="${product.name}" class="w-full h-full object-contain" loading="lazy">
            </div>
            <div class="flex-grow flex flex-col">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-400">${product.category}</span>
                <h3 class="text-sm font-bold mt-1 mb-2 leading-tight">${product.name}</h3>
                <div class="flex gap-0.5 mb-2 text-yellow-400 text-sm">
                    ${createStarRating(product.rating)}
                </div>
            </div>
            <div class="flex justify-between items-center mt-auto">
                <span class="font-headline text-lg font-bold text-primary">${formatPrice(product.price)}</span>
                <button class="bg-primary text-white w-8 h-8 rounded-md flex items-center justify-center transition hover:bg-primary-container product-add-btn" data-product-id="${product.id}" aria-label="Ajouter au panier">
                    <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'wght' 200;">shopping_cart</span>
                </button>
            </div>
        </article>
    `).join('');
    
    // Add event listeners to add buttons
    document.querySelectorAll('.product-add-btn').forEach(btn => {
        btn.addEventListener('click', handleAddToCart);
    });
}

// ===================================
// Cart Functions
// ===================================
function handleAddToCart(e) {
    const productId = parseInt(e.currentTarget.dataset.productId);
    const product = products.find(p => p.id === productId);
    
    if (product) {
        const existingItem = state.cart.find(item => item.id === productId);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            state.cart.push({ ...product, quantity: 1 });
        }
        
        updateBadge(elements.cartBadge, state.cart.length);
        saveToLocalStorage();
        
        // Visual feedback
        e.currentTarget.style.transform = 'scale(1.2)';
        setTimeout(() => {
            e.currentTarget.style.transform = '';
        }, 200);
        
        showNotification('Produit ajouté au panier');
    }
}

function removeFromCart(productId) {
    state.cart = state.cart.filter(item => item.id !== productId);
    updateBadge(elements.cartBadge, state.cart.length);
    saveToLocalStorage();
    renderCart();
}

function renderCart() {
    if (state.cart.length === 0) {
        elements.cartModalBody.innerHTML = `
            <div class="cart-empty">
                <span class="material-symbols-outlined" style="font-size: 4rem; opacity: 0.3;">shopping_cart</span>
                <p>Votre panier est vide</p>
            </div>
        `;
        elements.cartTotal.textContent = '0,00€';
        return;
    }
    
    const total = state.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    
    elements.cartModalBody.innerHTML = state.cart.map(item => `
        <div class="flex items-center gap-4 py-4 border-b border-gray-100 last:border-0">
            <img src="${item.image}" alt="${item.name}" class="w-16 h-16 rounded-xl object-contain bg-surface p-1">
            <div class="flex-1">
                <div class="font-bold text-sm leading-tight">${item.name}</div>
                <div class="text-primary font-bold mt-1">${formatPrice(item.price)} × ${item.quantity}</div>
            </div>
            <button class="w-8 h-8 flex items-center justify-center text-error rounded-full hover:bg-error/10 transition cart-item-remove" data-product-id="${item.id}" aria-label="Retirer du panier">
                <span class="material-symbols-outlined">delete</span>
            </button>
        </div>
    `).join('');
    
    elements.cartTotal.textContent = formatPrice(total);
    
    // Add remove listeners
    document.querySelectorAll('.cart-item-remove').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const productId = parseInt(e.currentTarget.dataset.productId);
            removeFromCart(productId);
        });
    });
}

function toggleCartModal() {
    elements.cartModal.classList.toggle('hidden');
    elements.cartModal.classList.toggle('flex');
    if (elements.cartModal.classList.contains('flex')) {
        renderCart();
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = '';
    }
}

// ===================================
// Category Filter
// ===================================
function handleCategoryChange(e) {
    const category = e.currentTarget.dataset.category;
    state.currentCategory = category;
    
    // Update active state
    elements.categoryItems.forEach(item => item.classList.remove('active'));
    e.currentTarget.classList.add('active');
    
    // Render filtered products
    renderProducts(category);
}

// ===================================
// Notifications
// ===================================
function showNotification(message) {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        background: var(--primary);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-xl);
        z-index: 2000;
        animation: slideIn 0.3s ease;
    `;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 2000);
}

// Add animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
`;
document.head.appendChild(style);

// ===================================
// Mobile Menu
// ===================================
function toggleMobileMenu() {
    elements.mainNav.classList.toggle('active');
}

// ===================================
// Smooth Scroll
// ===================================
function smoothScroll(target) {
    const element = document.querySelector(target);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

// ===================================
// Event Listeners
// ===================================
function initEventListeners() {
    // Cart modal
    elements.cartBtn.addEventListener('click', toggleCartModal);
    elements.cartModalOverlay.addEventListener('click', toggleCartModal);
    elements.cartModalClose.addEventListener('click', toggleCartModal);
    
    // Category filters
    elements.categoryItems.forEach(item => {
        item.addEventListener('click', handleCategoryChange);
    });
    
    // Hero button
    document.getElementById('heroBtn').addEventListener('click', () => {
        smoothScroll('#productsGrid');
    });
    
    // Keyboard accessibility for modal
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && elements.cartModal.classList.contains('active')) {
            toggleCartModal();
        }
        if (e.key === 'Escape' && document.getElementById('sidebar').classList.contains('active')) {
            toggleSidebar();
        }
    });
    
    // Mobile sidebar
    const mobileLogo = document.getElementById('mobileLogo');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const sidebarClose = document.getElementById('sidebarClose');
    
    if (mobileLogo) {
        mobileLogo.addEventListener('click', () => {
            if (window.innerWidth <= 767) {
                toggleSidebar();
            }
        });
    }
    if (sidebarClose) {
        sidebarClose.addEventListener('click', toggleSidebar);
    }
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', toggleSidebar);
    }
    
    // Sidebar links
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            if (link.dataset.category) {
                e.preventDefault();
                filterProducts(link.dataset.category);
                toggleSidebar();
            }
        });
    });
}

// ===================================
// Sidebar Toggle
// ===================================
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    sidebar.classList.toggle('-translate-x-full');
    sidebar.classList.toggle('translate-x-0');
    overlay.classList.toggle('opacity-0');
    overlay.classList.toggle('opacity-100');
    overlay.classList.toggle('pointer-events-none');
    
    // Prevent body scroll when sidebar is open
    if (sidebar.classList.contains('translate-x-0')) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = '';
    }
}

// ===================================
// Initialization
// ===================================
function init() {
    loadFromLocalStorage();
    renderProducts();
    initEventListeners();
    console.log('🐾 PetTrust initialized successfully!');
}

// Start the app when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}
