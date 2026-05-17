<!-- Toast Notification Container -->
<div id="toastContainer" class="fixed top-24 right-6 z-[9999] space-y-3 pointer-events-none">
    <!-- Toasts will be inserted here -->
</div>

<!-- Toast Template -->
<template id="toastTemplate">
    <div class="toast pointer-events-auto bg-white dark:bg-[#1a1d2e] rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700 p-4 min-w-[320px] max-w-[400px] transform translate-x-[500px] opacity-0 transition-all duration-500">
        <div class="flex items-start gap-3">
            <!-- Icon -->
            <div class="toast-icon flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined text-xl"></span>
            </div>
            
            <!-- Content -->
            <div class="flex-1 min-w-0">
                <h4 class="toast-title font-bold text-sm text-on-surface dark:text-white mb-1"></h4>
                <p class="toast-message text-xs text-on-surface-variant dark:text-gray-400"></p>
            </div>
            
            <!-- Close Button -->
            <button class="toast-close flex-shrink-0 w-6 h-6 rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 flex items-center justify-center text-on-surface-variant dark:text-gray-400 transition">
                <span class="material-symbols-outlined text-sm">close</span>
            </button>
        </div>
        
        <!-- Progress Bar -->
        <div class="toast-progress mt-3 h-1 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden">
            <div class="toast-progress-bar h-full rounded-full transition-all duration-[5000ms] ease-linear" style="width: 100%"></div>
        </div>
    </div>
</template>

<style>
    .toast.show {
        transform: translateX(0);
        opacity: 1;
    }
    
    .toast.hide {
        transform: translateX(500px);
        opacity: 0;
    }
    
    /* Toast Types */
    .toast-success .toast-icon {
        background: #10b98120;
        color: #10b981;
    }
    
    .toast-success .toast-progress-bar {
        background: #10b981;
    }
    
    .toast-error .toast-icon {
        background: #ef444420;
        color: #ef4444;
    }
    
    .toast-error .toast-progress-bar {
        background: #ef4444;
    }
    
    .toast-warning .toast-icon {
        background: #f59e0b20;
        color: #f59e0b;
    }
    
    .toast-warning .toast-progress-bar {
        background: #f59e0b;
    }
    
    .toast-info .toast-icon {
        background: #3b82f620;
        color: #3b82f6;
    }
    
    .toast-info .toast-progress-bar {
        background: #3b82f6;
    }
</style>

<script>
    // Toast Notification System
    window.showToast = function(options) {
        const {
            type = 'success', // success, error, warning, info
            title = '',
            message = '',
            duration = 5000,
            icon = null
        } = options;
        
        const container = document.getElementById('toastContainer');
        const template = document.getElementById('toastTemplate');
        const toast = template.content.cloneNode(true).querySelector('.toast');
        
        // Set type class
        toast.classList.add(`toast-${type}`);
        
        // Set icon
        const iconElement = toast.querySelector('.toast-icon .material-symbols-outlined');
        if (icon) {
            iconElement.textContent = icon;
        } else {
            const defaultIcons = {
                success: 'check_circle',
                error: 'error',
                warning: 'warning',
                info: 'info'
            };
            iconElement.textContent = defaultIcons[type] || 'notifications';
        }
        
        // Set content
        toast.querySelector('.toast-title').textContent = title;
        toast.querySelector('.toast-message').textContent = message;
        
        // Add to container
        container.appendChild(toast);
        
        // Animate in
        setTimeout(() => toast.classList.add('show'), 10);
        
        // Start progress bar
        const progressBar = toast.querySelector('.toast-progress-bar');
        setTimeout(() => {
            progressBar.style.width = '0%';
        }, 100);
        
        // Close button
        const closeBtn = toast.querySelector('.toast-close');
        closeBtn.addEventListener('click', () => removeToast(toast));
        
        // Auto remove
        setTimeout(() => removeToast(toast), duration);
        
        return toast;
    };
    
    function removeToast(toast) {
        toast.classList.remove('show');
        toast.classList.add('hide');
        setTimeout(() => toast.remove(), 500);
    }
    
    // Shorthand methods
    window.toast = {
        success: (title, message, duration) => showToast({ type: 'success', title, message, duration }),
        error: (title, message, duration) => showToast({ type: 'error', title, message, duration }),
        warning: (title, message, duration) => showToast({ type: 'warning', title, message, duration }),
        info: (title, message, duration) => showToast({ type: 'info', title, message, duration })
    };
</script>
