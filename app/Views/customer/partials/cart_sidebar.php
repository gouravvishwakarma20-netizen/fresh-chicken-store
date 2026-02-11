<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-maroon to-maroon-dark p-4 flex items-center justify-between">
        <h3 class="text-white font-bold text-base">
            <i class="fas fa-shopping-bag mr-2"></i> Your Cart
            <span id="cartBadgeDesktop" class="ml-2 bg-gold text-maroon text-xs font-bold px-2 py-0.5 rounded-full hidden">0</span>
        </h3>
        <button onclick="clearCart()" class="text-white/70 hover:text-white text-xs transition min-h-[44px] flex items-center">
            <i class="fas fa-trash-alt mr-1"></i> Clear
        </button>
    </div>

    <!-- Empty State -->
    <div id="cartEmptyDesktop" class="p-8 text-center">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3 animate-float">
            <i class="fas fa-shopping-bag text-2xl text-gray-300"></i>
        </div>
        <p class="text-gray-500 font-medium text-sm">Your cart is empty</p>
        <p class="text-gray-400 text-xs mt-1">Add some delicious chicken!</p>
    </div>

    <!-- Cart Items -->
    <div id="cartFilledDesktop" class="hidden">
        <div id="cartItemsDesktop" class="p-4 max-h-96 overflow-y-auto">
            <!-- Filled via JS -->
        </div>

        <!-- Free Delivery Progress Bar -->
        <div id="deliveryProgressDesktop">
            <!-- Filled via JS -->
        </div>

        <!-- Footer -->
        <div class="border-t border-gray-100 p-4">
            <div class="flex justify-between items-center mb-4">
                <span class="text-gray-600 font-medium">Total</span>
                <span id="cartTotalDesktop" class="text-xl font-bold text-maroon">₹0</span>
            </div>
            <a href="<?= base_url('checkout') ?>"
               class="btn-ripple block w-full bg-gradient-to-r from-maroon to-maroon-dark text-white text-center py-3 rounded-xl font-semibold hover:shadow-lg transition-all text-sm">
                Proceed to Checkout <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</div>

<!-- Delivery Info Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mt-4">
    <h4 class="font-semibold text-gray-800 text-sm mb-3"><i class="fas fa-info-circle text-maroon mr-2"></i>Delivery Info</h4>
    <div class="space-y-2.5 text-xs text-gray-500">
        <p class="flex items-center"><span class="w-7 h-7 bg-yellow-50 rounded-lg flex items-center justify-center mr-2.5 flex-shrink-0"><i class="fas fa-clock text-gold text-[10px]"></i></span> Delivery within 90 minutes</p>
        <p class="flex items-center"><span class="w-7 h-7 bg-green-50 rounded-lg flex items-center justify-center mr-2.5 flex-shrink-0"><i class="fas fa-truck text-green-500 text-[10px]"></i></span> Free delivery on orders ₹499+</p>
        <p class="flex items-center"><span class="w-7 h-7 bg-blue-50 rounded-lg flex items-center justify-center mr-2.5 flex-shrink-0"><i class="fas fa-snowflake text-blue-500 text-[10px]"></i></span> Temperature controlled packaging</p>
        <p class="flex items-center"><span class="w-7 h-7 bg-red-50 rounded-lg flex items-center justify-center mr-2.5 flex-shrink-0"><i class="fas fa-shield-alt text-maroon text-[10px]"></i></span> 100% fresh guarantee</p>
    </div>
</div>
