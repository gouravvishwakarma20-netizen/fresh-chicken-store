<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Fresh Chicken Store' ?> - Premium Chicken Delivery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
    <meta name="csrf-header" content="<?= csrf_header() ?>">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maroon: { DEFAULT: '#8B0000', light: '#A52A2A', dark: '#5C0000', 50: '#fef2f2', 100: '#fde8e8' },
                        gold: { DEFAULT: '#D4AF37', light: '#E5C76B', dark: '#B8960C', 50: '#fefce8', 100: '#fef9c3' },
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    animation: {
                        'bounce-in': 'bounceIn 0.6s ease-out',
                        'slide-up': 'slideUp 0.4s ease-out',
                        'wiggle': 'wiggle 0.5s ease-in-out',
                        'float': 'float 3s ease-in-out infinite',
                        'shimmer': 'shimmer 2s linear infinite',
                        'cart-pop': 'cartPop 0.3s ease-out',
                        'ripple': 'ripple 0.6s linear',
                    },
                    keyframes: {
                        bounceIn: {
                            '0%': { transform: 'scale(0.3)', opacity: '0' },
                            '50%': { transform: 'scale(1.05)' },
                            '70%': { transform: 'scale(0.9)' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        wiggle: {
                            '0%, 100%': { transform: 'rotate(0deg)' },
                            '25%': { transform: 'rotate(-8deg)' },
                            '75%': { transform: 'rotate(8deg)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '-200% 0' },
                            '100%': { backgroundPosition: '200% 0' },
                        },
                        cartPop: {
                            '0%': { transform: 'scale(1)' },
                            '50%': { transform: 'scale(1.3)' },
                            '100%': { transform: 'scale(1)' },
                        },
                        ripple: {
                            '0%': { transform: 'scale(0)', opacity: '0.5' },
                            '100%': { transform: 'scale(4)', opacity: '0' },
                        },
                    },
                }
            }
        }
    </script>
    <style>
        /* Glassmorphism */
        .glass { background: rgba(255,255,255,0.8); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.3); }
        .glass-dark { background: rgba(0,0,0,0.3); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }

        /* Gradient Text */
        .gradient-text { background: linear-gradient(135deg, #D4AF37, #E5C76B); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

        /* Button Ripple */
        .btn-ripple { position: relative; overflow: hidden; }
        .btn-ripple .ripple-effect { position: absolute; border-radius: 50%; background: rgba(255,255,255,0.4); animation: ripple 0.6s linear; pointer-events: none; }

        /* Cart Badge */
        .cart-badge { animation: pulse 2s infinite; }
        @keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); } }
        .cart-badge-pop { animation: cartPop 0.3s ease-out; }
        @keyframes cartPop { 0% { transform: scale(1); } 50% { transform: scale(1.3); } 100% { transform: scale(1); } }

        /* Product Card */
        .product-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .product-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(139,0,0,0.12); }
        .product-card:hover .product-img { transform: scale(1.08); }
        .product-img { transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1); }

        /* Category Pill */
        .category-pill.active { background: #8B0000; color: white; }
        .category-pill { transition: all 0.2s ease; }

        /* Qty Button */
        .qty-btn { transition: all 0.15s ease; }
        .qty-btn:active { transform: scale(0.9); }

        /* Animations */
        .slide-in { animation: slideIn 0.3s ease; }
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        .fade-in { animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* Toast */
        .toast-enter { animation: toastSlideUp 0.4s ease-out; }
        .toast-exit { animation: toastSlideOut 0.3s ease-in forwards; }
        @keyframes toastSlideUp { from { transform: translate(-50%, 20px); opacity: 0; } to { transform: translate(-50%, 0); opacity: 1; } }
        @keyframes toastSlideOut { from { transform: translate(-50%, 0); opacity: 1; } to { transform: translate(-50%, -20px); opacity: 0; } }

        /* Stagger children */
        .stagger-children > *:nth-child(1) { animation-delay: 0ms; }
        .stagger-children > *:nth-child(2) { animation-delay: 80ms; }
        .stagger-children > *:nth-child(3) { animation-delay: 160ms; }
        .stagger-children > *:nth-child(4) { animation-delay: 240ms; }

        /* Confetti */
        @keyframes confettiFall { 0% { transform: translateY(-100vh) rotate(0deg); opacity: 1; } 100% { transform: translateY(100vh) rotate(720deg); opacity: 0; } }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #8B0000; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #A52A2A; }

        /* Hide scrollbar for category pills */
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

        /* Bottom Nav */
        .bottom-nav-item { transition: all 0.2s ease; }
        .bottom-nav-item:active { transform: scale(0.9); }
        .bottom-nav-item.active { color: #8B0000; }

        /* Skeleton */
        .skeleton { background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%); background-size: 200% 100%; animation: shimmer 1.5s infinite; }

        /* Mobile search */
        .search-mobile-enter { animation: fadeIn 0.2s ease-out; }
    </style>
</head>
<body class="bg-gray-50 font-sans pb-[72px] sm:pb-0">

    <!-- Top Banner -->
    <div class="bg-gradient-to-r from-maroon to-maroon-dark text-white text-center py-2 text-xs sm:text-sm font-medium">
        <i class="fas fa-truck mr-1 sm:mr-2"></i> Free delivery on orders above ₹499 <span class="hidden sm:inline">|</span> <br class="sm:hidden"><i class="fas fa-clock ml-0 sm:ml-2 mr-1"></i> Delivery in 90 minutes
    </div>

    <!-- Header -->
    <header class="glass sticky top-0 z-40 shadow-md border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <!-- Logo -->
            <a href="<?= base_url() ?>" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 bg-maroon rounded-full flex items-center justify-center group-hover:animate-wiggle transition-transform">
                    <i class="fas fa-drumstick-bite text-gold text-lg"></i>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-maroon leading-tight">Fresh Chicken</h1>
                    <p class="text-xs text-gray-500">Farm to Kitchen</p>
                </div>
            </a>

            <!-- Search (Desktop) -->
            <div class="hidden md:flex flex-1 max-w-md mx-8">
                <div class="relative w-full">
                    <input type="text" id="searchInput" placeholder="Search chicken, kebabs, wings..."
                           class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm transition-all duration-200 bg-white/80">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <!-- Right Actions -->
            <div class="flex items-center space-x-2 sm:space-x-4">
                <!-- Mobile Search Toggle -->
                <button id="mobileSearchToggle" class="md:hidden p-2.5 text-gray-600 hover:text-maroon min-h-[44px] min-w-[44px] flex items-center justify-center" onclick="toggleMobileSearch()">
                    <i class="fas fa-search text-lg"></i>
                </button>
                <a href="tel:+919999999999" class="hidden md:flex items-center text-sm text-gray-600 hover:text-maroon transition min-h-[44px]">
                    <i class="fas fa-phone mr-2"></i> Support
                </a>
                <!-- Mobile Cart Button -->
                <button id="mobileCartBtn" class="lg:hidden relative p-2.5 text-maroon min-h-[44px] min-w-[44px] flex items-center justify-center" onclick="toggleMobileCart()">
                    <i class="fas fa-shopping-bag text-xl"></i>
                    <span id="cartBadgeMobile" class="absolute -top-1 -right-1 bg-gold text-maroon text-xs font-bold w-5 h-5 rounded-full flex items-center justify-center cart-badge hidden">0</span>
                </button>
            </div>
        </div>

        <!-- Mobile Search Bar (collapsible) -->
        <div id="mobileSearchBar" class="hidden md:hidden px-4 pb-3">
            <div class="relative w-full search-mobile-enter">
                <input type="text" id="mobileSearchInput" placeholder="Search chicken, kebabs, wings..."
                       class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm bg-white">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>
    </header>

    <!-- Main Content: 3 Column Layout -->
    <div class="max-w-7xl mx-auto px-4 py-6">
        <div class="flex gap-6">
            <!-- Main Content Area -->
            <main class="flex-1 min-w-0">
                <?= $this->renderSection('content') ?>
            </main>

            <!-- Cart Sidebar (Desktop) -->
            <aside id="cartSidebar" class="hidden lg:block w-80 flex-shrink-0">
                <div class="sticky top-24">
                    <?= view('customer/partials/cart_sidebar') ?>
                </div>
            </aside>
        </div>
    </div>

    <!-- Mobile Cart Overlay -->
    <div id="mobileCartOverlay" class="fixed inset-0 bg-black/50 z-50 hidden lg:hidden" onclick="toggleMobileCart()">
        <div id="mobileCartPanel" class="absolute right-0 top-0 h-full w-full max-w-sm bg-white shadow-2xl slide-in" onclick="event.stopPropagation()">
            <div class="p-4 bg-gradient-to-r from-maroon to-maroon-dark text-white flex items-center justify-between">
                <h3 class="font-bold text-lg"><i class="fas fa-shopping-bag mr-2"></i> Your Cart</h3>
                <button onclick="toggleMobileCart()" class="text-white text-xl min-h-[44px] min-w-[44px] flex items-center justify-center"><i class="fas fa-times"></i></button>
            </div>
            <div id="mobileCartContent" class="overflow-y-auto" style="height: calc(100% - 60px)">
                <!-- Filled via AJAX -->
            </div>
        </div>
    </div>

    <!-- Mobile Bottom Nav -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-40 sm:hidden">
        <div class="flex items-center justify-around py-2">
            <a href="<?= base_url() ?>" class="bottom-nav-item flex flex-col items-center px-3 py-1.5 text-maroon min-h-[44px] justify-center">
                <i class="fas fa-home text-lg"></i>
                <span class="text-[10px] font-semibold mt-0.5">Home</span>
            </a>
            <a href="#menu" class="bottom-nav-item flex flex-col items-center px-3 py-1.5 text-gray-500 hover:text-maroon min-h-[44px] justify-center">
                <i class="fas fa-utensils text-lg"></i>
                <span class="text-[10px] font-semibold mt-0.5">Menu</span>
            </a>
            <button onclick="toggleMobileCart()" class="bottom-nav-item relative flex flex-col items-center px-3 py-1.5 text-gray-500 hover:text-maroon min-h-[44px] justify-center">
                <i class="fas fa-shopping-bag text-lg"></i>
                <span id="cartBadgeBottomNav" class="absolute -top-0.5 right-1 bg-gold text-maroon text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center hidden">0</span>
                <span class="text-[10px] font-semibold mt-0.5">Cart</span>
            </button>
            <a href="tel:+919999999999" class="bottom-nav-item flex flex-col items-center px-3 py-1.5 text-gray-500 hover:text-maroon min-h-[44px] justify-center">
                <i class="fas fa-phone text-lg"></i>
                <span class="text-[10px] font-semibold mt-0.5">Call</span>
            </a>
        </div>
    </nav>

    <!-- Back to Top Button -->
    <button id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})"
            class="fixed bottom-20 sm:bottom-8 right-4 w-11 h-11 bg-maroon text-white rounded-full shadow-lg flex items-center justify-center z-30 opacity-0 invisible transition-all duration-300 hover:bg-maroon-dark hover:shadow-xl">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 mt-16">
        <!-- Gradient Top Stripe -->
        <div class="h-1 bg-gradient-to-r from-maroon via-gold to-maroon"></div>
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8" data-aos="fade-up">
                <!-- Brand + Social -->
                <div class="col-span-2 md:col-span-1">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-maroon rounded-full flex items-center justify-center">
                            <i class="fas fa-drumstick-bite text-gold text-lg"></i>
                        </div>
                        <h3 class="text-white font-bold text-lg">Fresh Chicken</h3>
                    </div>
                    <p class="text-sm mb-4">Premium quality farm-fresh chicken delivered to your doorstep. Hygienically processed and vacuum packed.</p>
                    <div class="flex space-x-2">
                        <a href="#" class="w-9 h-9 bg-white/10 rounded-full flex items-center justify-center hover:bg-blue-600 transition text-white text-sm"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-9 h-9 bg-white/10 rounded-full flex items-center justify-center hover:bg-pink-600 transition text-white text-sm"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-9 h-9 bg-white/10 rounded-full flex items-center justify-center hover:bg-green-600 transition text-white text-sm"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="<?= base_url() ?>" class="hover:text-gold transition">Home</a></li>
                        <li><a href="<?= base_url('checkout') ?>" class="hover:text-gold transition">Checkout</a></li>
                        <li><a href="#" class="hover:text-gold transition">About Us</a></li>
                        <li><a href="#" class="hover:text-gold transition">Contact</a></li>
                    </ul>
                </div>
                <!-- Contact -->
                <div>
                    <h4 class="text-white font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-2 text-sm">
                        <li><i class="fas fa-phone mr-2 text-gold"></i> +91 99999 99999</li>
                        <li><i class="fas fa-envelope mr-2 text-gold"></i> order@freshchicken.com</li>
                        <li><i class="fas fa-map-marker-alt mr-2 text-gold"></i> Mumbai, Maharashtra</li>
                    </ul>
                </div>
                <!-- Trust Badges -->
                <div>
                    <h4 class="text-white font-semibold mb-4">We Promise</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-green-900/50 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-certificate text-green-400 text-xs"></i></div>
                            <span>100% Fresh</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-blue-900/50 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-snowflake text-blue-400 text-xs"></i></div>
                            <span>Cold Chain</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-yellow-900/50 rounded-lg flex items-center justify-center flex-shrink-0"><i class="fas fa-shield-alt text-yellow-400 text-xs"></i></div>
                            <span>Safe & Hygienic</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm">
                &copy; <?= date('Y') ?> Fresh Chicken Store. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 600, once: true, offset: 50 });

        const BASE_URL = '<?= base_url() ?>';

        // CSRF token helpers for AJAX requests
        function getCSRFHeader() {
            const header = document.querySelector('meta[name="csrf-header"]')?.content || 'X-CSRF-TOKEN';
            const token = document.querySelector('meta[name="csrf-token"]')?.content || '';
            return { [header]: token };
        }
        function updateCSRFToken(headers) {
            const newToken = headers?.get('X-CSRF-TOKEN');
            if (newToken) {
                const meta = document.querySelector('meta[name="csrf-token"]');
                if (meta) meta.content = newToken;
            }
        }
        function csrfFetch(url, options = {}) {
            options.headers = { ...options.headers, ...getCSRFHeader() };
            return fetch(url, options).then(response => {
                updateCSRFToken(response.headers);
                return response;
            });
        }

        // Mobile search toggle
        function toggleMobileSearch() {
            const bar = document.getElementById('mobileSearchBar');
            bar.classList.toggle('hidden');
            if (!bar.classList.contains('hidden')) {
                document.getElementById('mobileSearchInput').focus();
            }
        }

        // Mobile search input mirroring
        document.addEventListener('DOMContentLoaded', function() {
            const mobileInput = document.getElementById('mobileSearchInput');
            const desktopInput = document.getElementById('searchInput');
            if (mobileInput) {
                mobileInput.addEventListener('input', function() {
                    const query = this.value.toLowerCase();
                    filterProducts(query);
                });
            }
        });

        function filterProducts(query) {
            document.querySelectorAll('.product-card').forEach(card => {
                const name = card.dataset.name?.toLowerCase() || '';
                const cat = card.dataset.category?.toLowerCase() || '';
                card.style.display = (name.includes(query) || cat.includes(query)) ? '' : 'none';
            });
        }

        // Toggle mobile cart
        function toggleMobileCart() {
            const overlay = document.getElementById('mobileCartOverlay');
            overlay.classList.toggle('hidden');
            if (!overlay.classList.contains('hidden')) {
                loadCartContents();
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        // Add to cart
        function addToCart(productId) {
            csrfFetch(BASE_URL + 'cart/add', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({ product_id: productId, quantity: 1 })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    updateCartBadge();
                    loadCartContents();
                    showToast('Added to cart!');
                    const addBtn = document.getElementById('addBtn-' + productId);
                    const qtyCtrl = document.getElementById('qtyCtrl-' + productId);
                    if (addBtn && qtyCtrl) {
                        addBtn.classList.add('hidden');
                        qtyCtrl.classList.remove('hidden');
                        document.getElementById('qty-' + productId).textContent = data.quantity;
                    }
                }
            });
        }

        // Update quantity
        function updateQty(productId, change) {
            const qtyEl = document.getElementById('qty-' + productId);
            let newQty = parseInt(qtyEl.textContent) + change;
            if (newQty < 1) {
                removeFromCart(productId);
                return;
            }
            csrfFetch(BASE_URL + 'cart/update', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({ product_id: productId, quantity: newQty })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    qtyEl.textContent = newQty;
                    updateCartBadge();
                    loadCartContents();
                }
            });
        }

        // Remove from cart
        function removeFromCart(productId) {
            csrfFetch(BASE_URL + 'cart/remove', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({ product_id: productId })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    const addBtn = document.getElementById('addBtn-' + productId);
                    const qtyCtrl = document.getElementById('qtyCtrl-' + productId);
                    if (addBtn && qtyCtrl) {
                        addBtn.classList.remove('hidden');
                        qtyCtrl.classList.add('hidden');
                    }
                    updateCartBadge();
                    loadCartContents();
                }
            });
        }

        // Clear entire cart
        function clearCart() {
            csrfFetch(BASE_URL + 'cart/clear', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    updateCartBadge();
                    loadCartContents();
                    document.querySelectorAll('[id^="addBtn-"]').forEach(btn => btn.classList.remove('hidden'));
                    document.querySelectorAll('[id^="qtyCtrl-"]').forEach(ctrl => ctrl.classList.add('hidden'));
                    showToast('Cart cleared');
                }
            });
        }

        // Update cart badge count - syncs 3 badge elements
        function updateCartBadge() {
            fetch(BASE_URL + 'cart/count')
            .then(r => r.json())
            .then(data => {
                const badges = document.querySelectorAll('#cartBadgeMobile, #cartBadgeDesktop, #cartBadgeBottomNav');
                badges.forEach(badge => {
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.classList.remove('hidden');
                        // Pop animation
                        badge.classList.remove('cart-badge-pop');
                        void badge.offsetWidth;
                        badge.classList.add('cart-badge-pop');
                    } else {
                        badge.classList.add('hidden');
                    }
                });
            });
        }

        // Load cart contents (sidebar + mobile)
        function loadCartContents() {
            fetch(BASE_URL + 'cart/contents')
            .then(r => r.json())
            .then(data => {
                renderCartSidebar(data);
                renderMobileCart(data);
            });
        }

        function renderCartSidebar(data) {
            const container = document.getElementById('cartItemsDesktop');
            const totalEl = document.getElementById('cartTotalDesktop');
            const emptyEl = document.getElementById('cartEmptyDesktop');
            const filledEl = document.getElementById('cartFilledDesktop');

            if (!container) return;

            if (!data.items || data.items.length === 0) {
                emptyEl.classList.remove('hidden');
                filledEl.classList.add('hidden');
                return;
            }

            emptyEl.classList.add('hidden');
            filledEl.classList.remove('hidden');

            // Calculate delivery progress
            const total = parseFloat(data.total) || 0;
            const threshold = 499;
            const progress = Math.min((total / threshold) * 100, 100);
            const remaining = Math.max(threshold - total, 0);

            let progressBarHTML = '';
            if (total < threshold) {
                progressBarHTML = `
                    <div class="px-4 pb-3">
                        <div class="bg-orange-50 rounded-lg p-2.5">
                            <div class="flex items-center justify-between text-xs mb-1.5">
                                <span class="text-orange-700 font-medium"><i class="fas fa-truck mr-1"></i> Add ₹${Math.ceil(remaining)} for free delivery</span>
                            </div>
                            <div class="w-full bg-orange-200 rounded-full h-1.5">
                                <div class="bg-orange-500 h-1.5 rounded-full transition-all duration-500" style="width: ${progress}%"></div>
                            </div>
                        </div>
                    </div>`;
            } else {
                progressBarHTML = `
                    <div class="px-4 pb-3">
                        <div class="bg-green-50 rounded-lg p-2.5 text-center">
                            <span class="text-green-700 text-xs font-medium"><i class="fas fa-check-circle mr-1"></i> You get FREE delivery!</span>
                        </div>
                    </div>`;
            }

            container.innerHTML = data.items.map(item => `
                <div class="flex items-center justify-between py-3 border-b border-gray-100 fade-in">
                    <div class="flex-1 min-w-0 mr-3">
                        <p class="text-sm font-medium text-gray-800 truncate">${item.name}</p>
                        <p class="text-xs text-gray-500">${item.unit} × ${item.quantity}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="flex items-center bg-maroon/5 rounded-lg">
                            <button onclick="updateQty(${item.product_id}, -1)" class="qty-btn w-7 h-7 flex items-center justify-center text-maroon hover:bg-maroon/10 rounded-l-lg text-sm font-bold">−</button>
                            <span class="w-7 text-center text-sm font-semibold text-maroon">${item.quantity}</span>
                            <button onclick="updateQty(${item.product_id}, 1)" class="qty-btn w-7 h-7 flex items-center justify-center text-maroon hover:bg-maroon/10 rounded-r-lg text-sm font-bold">+</button>
                        </div>
                        <span class="text-sm font-semibold text-gray-800 w-16 text-right">₹${item.subtotal}</span>
                    </div>
                </div>
            `).join('');

            // Insert progress bar before the footer
            const progressContainer = document.getElementById('deliveryProgressDesktop');
            if (progressContainer) progressContainer.innerHTML = progressBarHTML;

            totalEl.textContent = '₹' + data.total;
        }

        function renderMobileCart(data) {
            const container = document.getElementById('mobileCartContent');
            if (!container) return;

            if (!data.items || data.items.length === 0) {
                container.innerHTML = `
                    <div class="flex flex-col items-center justify-center h-64 text-gray-400">
                        <div class="animate-float">
                            <i class="fas fa-shopping-bag text-5xl mb-4 text-gray-300"></i>
                        </div>
                        <p class="font-medium text-gray-500">Your cart is empty</p>
                        <p class="text-sm mt-1">Add some delicious chicken!</p>
                    </div>`;
                return;
            }

            const total = parseFloat(data.total) || 0;
            const threshold = 499;
            const progress = Math.min((total / threshold) * 100, 100);
            const remaining = Math.max(threshold - total, 0);

            let progressBarHTML = '';
            if (total < threshold) {
                progressBarHTML = `
                    <div class="bg-orange-50 rounded-lg p-3 mx-4 mb-3">
                        <div class="flex items-center justify-between text-xs mb-1.5">
                            <span class="text-orange-700 font-medium"><i class="fas fa-truck mr-1"></i> Add ₹${Math.ceil(remaining)} for free delivery</span>
                        </div>
                        <div class="w-full bg-orange-200 rounded-full h-1.5">
                            <div class="bg-orange-500 h-1.5 rounded-full transition-all duration-500" style="width: ${progress}%"></div>
                        </div>
                    </div>`;
            } else {
                progressBarHTML = `
                    <div class="bg-green-50 rounded-lg p-3 mx-4 mb-3 text-center">
                        <span class="text-green-700 text-xs font-medium"><i class="fas fa-check-circle mr-1"></i> You get FREE delivery!</span>
                    </div>`;
            }

            container.innerHTML = `
                <div class="p-4 space-y-0">
                    ${data.items.map(item => `
                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                            <div class="flex-1 min-w-0 mr-3">
                                <p class="text-sm font-medium text-gray-800 truncate">${item.name}</p>
                                <p class="text-xs text-gray-500">₹${item.price} × ${item.quantity}</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="flex items-center bg-maroon/5 rounded-lg">
                                    <button onclick="updateQty(${item.product_id}, -1)" class="qty-btn w-10 h-10 flex items-center justify-center text-maroon rounded-l-lg font-bold">−</button>
                                    <span class="w-8 text-center text-sm font-semibold text-maroon">${item.quantity}</span>
                                    <button onclick="updateQty(${item.product_id}, 1)" class="qty-btn w-10 h-10 flex items-center justify-center text-maroon rounded-r-lg font-bold">+</button>
                                </div>
                                <span class="text-sm font-semibold w-16 text-right">₹${item.subtotal}</span>
                            </div>
                        </div>
                    `).join('')}
                </div>
                ${progressBarHTML}
                <div class="fixed bottom-0 left-0 right-0 max-w-sm ml-auto bg-white border-t p-4 shadow-lg">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-semibold text-gray-700">Total</span>
                        <span class="text-xl font-bold text-maroon">₹${data.total}</span>
                    </div>
                    <a href="${BASE_URL}checkout" class="block w-full bg-gradient-to-r from-maroon to-maroon-dark text-white text-center py-3.5 rounded-xl font-semibold hover:shadow-lg transition-all">
                        Proceed to Checkout <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>`;
        }

        // Toast notification
        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-24 sm:bottom-6 left-1/2 -translate-x-1/2 bg-gray-800 text-white px-6 py-3 rounded-xl shadow-lg z-[100] flex items-center space-x-2 toast-enter';
            toast.innerHTML = '<i class="fas fa-check-circle text-green-400"></i><span class="text-sm font-medium">' + message + '</span>';
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.classList.remove('toast-enter');
                toast.classList.add('toast-exit');
                setTimeout(() => toast.remove(), 300);
            }, 1700);
        }

        // Back to top visibility
        function handleScroll() {
            const btn = document.getElementById('backToTop');
            if (window.scrollY > 300) {
                btn.style.opacity = '1';
                btn.style.visibility = 'visible';
            } else {
                btn.style.opacity = '0';
                btn.style.visibility = 'hidden';
            }
        }
        window.addEventListener('scroll', handleScroll, { passive: true });

        // Button ripple effect
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-ripple');
            if (!btn) return;
            const ripple = document.createElement('span');
            ripple.className = 'ripple-effect';
            const rect = btn.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size/2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size/2) + 'px';
            btn.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });

        // Search filter
        document.addEventListener('DOMContentLoaded', function() {
            updateCartBadge();
            loadCartContents();

            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    filterProducts(this.value.toLowerCase());
                });
            }
        });
    </script>
</body>
</html>
