/**
 * Cart Management System
 * Handles adding products to cart with animations and notifications
 */

class CartManager {
    constructor() {
        this.cartCount = 0;
        this.init();
    }

    init() {
        // Load cart count on page load
        this.updateCartCount();
        
        // Setup event listeners
        this.setupEventListeners();
    }

    setupEventListeners() {
        // Add to cart buttons
        document.addEventListener('click', (e) => {
            // Single product add button
            const addToCartBtn = e.target.closest('#addToCartBtn');
            if (addToCartBtn) {
                e.preventDefault();
                e.stopPropagation();
                const productId = addToCartBtn.dataset.productId;
                const quantity = parseInt(document.getElementById('qtyDisplay')?.textContent || 1);
                this.addToCart(productId, quantity, addToCartBtn);
                return;
            }
            
            // Quick add buttons (product cards)
            const productAddBtn = e.target.closest('.product-add-btn');
            if (productAddBtn) {
                e.preventDefault();
                e.stopPropagation();
                const productId = productAddBtn.dataset.productId;
                this.addToCart(productId, 1, productAddBtn);
                return;
            }

            // Quick add pack buttons (pack cards)
            const packAddBtn = e.target.closest('.pack-add-btn');
            if (packAddBtn) {
                e.preventDefault();
                e.stopPropagation();
                const packId = packAddBtn.dataset.packId;
                this.addPackToCart(packId, packAddBtn);
                return;
            }
        });
    }

    async addToCart(productId, quantity = 1, button = null) {
        if (!productId) {
            console.error('Product ID is required');
            return;
        }

        // Disable button and show loading
        if (button) {
            button.disabled = true;
            this.showButtonLoading(button);
        }

        try {
            const response = await fetch('/api/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            });

            const data = await response.json();

            if (data.success) {
                // Success animation and notification
                this.onAddSuccess(button, data);
                
                // Update cart count
                this.updateCartCount(data.cart_count);
                
                // Show toast notification
                if (window.showToast) {
                    showToast({
                        type: 'success',
                        title: 'Produit ajouté !',
                        message: 'Le produit a été ajouté à votre panier',
                        icon: 'shopping_cart',
                        duration: 3000
                    });
                }
                
                // Animate cart icon
                this.animateCartIcon();
                
            } else {
                // Error notification
                if (window.showToast) {
                    showToast({
                        type: 'error',
                        title: 'Erreur',
                        message: data.message || 'Impossible d\'ajouter le produit',
                        duration: 4000
                    });
                }
            }

        } catch (error) {
            console.error('Error adding to cart:', error);
            if (window.showToast) {
                showToast({
                    type: 'error',
                    title: 'Erreur',
                    message: 'Une erreur est survenue. Veuillez réessayer.',
                    duration: 4000
                });
            }
        } finally {
            // Re-enable button
            if (button) {
                setTimeout(() => {
                    this.resetButton(button);
                    button.disabled = false;
                }, 1000);
            }
        }
    }

    async addPackToCart(packId, button = null) {
        if (!packId) {
            console.error('Pack ID is required');
            return;
        }

        // Disable button and show loading
        if (button) {
            button.disabled = true;
            this.showButtonLoading(button);
        }

        try {
            const response = await fetch('/api/cart/add-pack', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    offer_id: packId
                })
            });

            const data = await response.json();

            if (data.success) {
                // Success animation and notification
                this.onAddSuccess(button, data);
                
                // Update cart count
                this.updateCartCount(data.cart_count);
                
                // Show toast notification
                if (window.showToast) {
                    showToast({
                        type: 'success',
                        title: 'Pack ajouté !',
                        message: 'Le pack a été ajouté à votre panier',
                        icon: 'shopping_cart',
                        duration: 3000
                    });
                }
                
                // Animate cart icon
                this.animateCartIcon();
                
            } else {
                // Error notification
                if (window.showToast) {
                    showToast({
                        type: 'error',
                        title: 'Erreur',
                        message: data.message || 'Impossible d\'ajouter le pack',
                        duration: 4000
                    });
                }
            }

        } catch (error) {
            console.error('Error adding pack to cart:', error);
            if (window.showToast) {
                showToast({
                    type: 'error',
                    title: 'Erreur',
                    message: 'Une erreur est survenue. Veuillez réessayer.',
                    duration: 4000
                });
            }
        } finally {
            // Re-enable button
            if (button) {
                setTimeout(() => {
                    this.resetButton(button);
                    button.disabled = false;
                }, 1000);
            }
        }
    }

    showButtonLoading(button) {
        const originalContent = button.innerHTML;
        button.dataset.originalContent = originalContent;
        
        if (button.id === 'addToCartBtn') {
            // Large button (product detail page)
            button.innerHTML = `
                <span class="material-symbols-outlined animate-spin">sync</span>
                Ajout en cours...
            `;
        } else {
            // Small button (product card)
            button.innerHTML = `
                <span class="material-symbols-outlined animate-spin">sync</span>
            `;
        }
    }

    onAddSuccess(button, data) {
        if (!button) return;
        
        if (button.id === 'addToCartBtn') {
            // Large button
            button.innerHTML = `
                <span class="material-symbols-outlined">check_circle</span>
                Ajouté au panier !
            `;
            button.classList.add('bg-green-500', 'hover:bg-green-600');
            button.classList.remove('bg-primary', 'hover:bg-primary-container');
        } else {
            // Small button
            button.innerHTML = `
                <span class="material-symbols-outlined">check</span>
            `;
            button.classList.add('bg-green-500', 'text-white');
        }
    }

    resetButton(button) {
        if (!button) return;
        
        const originalContent = button.dataset.originalContent;
        if (originalContent) {
            button.innerHTML = originalContent;
        }
        
        // Reset classes
        button.classList.remove('bg-green-500', 'hover:bg-green-600', 'text-white');
        if (button.id === 'addToCartBtn') {
            button.classList.add('bg-primary', 'hover:bg-primary-container');
        }
    }

    async updateCartCount(count = null) {
        if (count !== null) {
            this.cartCount = count;
            this.updateCartBadge(count);
            return;
        }

        // Fetch from API
        try {
            const response = await fetch('/api/cart');
            const data = await response.json();
            
            if (data.success) {
                this.cartCount = data.count || 0;
                this.updateCartBadge(this.cartCount);
            }
        } catch (error) {
            console.error('Error fetching cart count:', error);
        }
    }

    updateCartBadge(count) {
        const badge = document.getElementById('cartCount');
        if (badge) {
            badge.textContent = count;
            
            // Animate badge
            badge.classList.add('scale-125');
            setTimeout(() => {
                badge.classList.remove('scale-125');
            }, 300);
            
            // Show/hide badge
            if (count > 0) {
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        }
    }

    animateCartIcon() {
        const cartIcon = document.querySelector('a[href*="cart"] .material-symbols-outlined');
        if (cartIcon) {
            cartIcon.classList.add('animate-bounce');
            setTimeout(() => {
                cartIcon.classList.remove('animate-bounce');
            }, 1000);
        }
    }

    // Flying cart animation (product image flies to cart icon)
    flyToCart(productElement) {
        if (!productElement) return;
        
        const productImg = productElement.querySelector('img');
        if (!productImg) return;
        
        const cartIcon = document.querySelector('a[href*="cart"]');
        if (!cartIcon) return;
        
        // Clone image
        const flyingImg = productImg.cloneNode(true);
        flyingImg.style.position = 'fixed';
        flyingImg.style.zIndex = '9999';
        flyingImg.style.width = '80px';
        flyingImg.style.height = '80px';
        flyingImg.style.objectFit = 'contain';
        flyingImg.style.pointerEvents = 'none';
        flyingImg.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        
        // Get positions
        const imgRect = productImg.getBoundingClientRect();
        const cartRect = cartIcon.getBoundingClientRect();
        
        // Set initial position
        flyingImg.style.left = imgRect.left + 'px';
        flyingImg.style.top = imgRect.top + 'px';
        
        document.body.appendChild(flyingImg);
        
        // Animate to cart
        setTimeout(() => {
            flyingImg.style.left = cartRect.left + 'px';
            flyingImg.style.top = cartRect.top + 'px';
            flyingImg.style.width = '20px';
            flyingImg.style.height = '20px';
            flyingImg.style.opacity = '0';
        }, 10);
        
        // Remove after animation
        setTimeout(() => {
            flyingImg.remove();
        }, 1000);
    }
}

// Initialize cart manager when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        window.cartManager = new CartManager();
    });
} else {
    window.cartManager = new CartManager();
}

// Export for use in other scripts
window.CartManager = CartManager;
