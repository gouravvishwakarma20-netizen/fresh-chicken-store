<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="max-w-3xl">
    <!-- Breadcrumb -->
    <div class="flex items-center text-sm text-gray-500 mb-6">
        <a href="<?= base_url() ?>" class="hover:text-maroon transition">Home</a>
        <i class="fas fa-chevron-right text-xs mx-2"></i>
        <span class="text-maroon font-medium">Checkout</span>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        <i class="fas fa-shopping-bag text-maroon mr-2"></i> Checkout
    </h2>

    <!-- Step Indicator -->
    <div class="flex items-center justify-between mb-8" data-aos="fade-down">
        <?php
        $steps = [
            ['icon' => 'fa-user', 'label' => 'Details'],
            ['icon' => 'fa-truck', 'label' => 'Delivery'],
            ['icon' => 'fa-credit-card', 'label' => 'Payment'],
            ['icon' => 'fa-check', 'label' => 'Confirm'],
        ];
        foreach ($steps as $i => $step):
        ?>
        <div class="flex items-center <?= $i < count($steps) - 1 ? 'flex-1' : '' ?>">
            <div class="flex flex-col items-center">
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold
                     <?= $i === 0 ? 'bg-maroon text-white' : 'bg-gray-200 text-gray-500' ?>">
                    <i class="fas <?= $step['icon'] ?> text-xs"></i>
                </div>
                <span class="text-[10px] font-medium mt-1 <?= $i === 0 ? 'text-maroon' : 'text-gray-400' ?>"><?= $step['label'] ?></span>
            </div>
            <?php if ($i < count($steps) - 1): ?>
            <div class="flex-1 h-0.5 bg-gray-200 mx-2 mt-[-12px]"></div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
            <i class="fas fa-exclamation-circle mr-2"></i> <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
            <ul class="list-disc list-inside">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('checkout/process') ?>" method="POST" id="checkoutForm">
        <?= csrf_field() ?>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
            <!-- Form Section -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Personal Details -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100" data-aos="fade-up">
                    <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-user text-maroon mr-2"></i> Your Details</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" name="customer_name" value="<?= old('customer_name') ?>" required
                                   class="checkout-input w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm transition-all duration-200"
                                   placeholder="Enter your name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                            <input type="tel" name="customer_phone" value="<?= old('customer_phone') ?>" required
                                   class="checkout-input w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm transition-all duration-200"
                                   placeholder="10-digit mobile number">
                        </div>
                    </div>
                </div>

                <!-- Order Type -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-truck text-maroon mr-2"></i> Order Type</h3>
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="order_type" value="delivery" checked class="peer hidden" onchange="toggleAddress()">
                            <div class="border-2 border-gray-200 peer-checked:border-maroon peer-checked:bg-maroon/5 rounded-xl p-4 text-center transition min-h-[44px]">
                                <i class="fas fa-motorcycle text-2xl text-maroon mb-2"></i>
                                <p class="font-semibold text-sm">Delivery</p>
                                <p class="text-xs text-gray-500">To your doorstep</p>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="order_type" value="pickup" class="peer hidden" onchange="toggleAddress()">
                            <div class="border-2 border-gray-200 peer-checked:border-maroon peer-checked:bg-maroon/5 rounded-xl p-4 text-center transition min-h-[44px]">
                                <i class="fas fa-store text-2xl text-maroon mb-2"></i>
                                <p class="font-semibold text-sm">Pickup</p>
                                <p class="text-xs text-gray-500">From our store</p>
                            </div>
                        </label>
                    </div>
                    <div id="addressField" class="transition-all duration-300 overflow-hidden" style="max-height: 200px; opacity: 1;">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Delivery Address *</label>
                        <textarea name="customer_address" rows="3"
                                  class="checkout-input w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm transition-all duration-200"
                                  placeholder="Full address with landmark"><?= old('customer_address') ?></textarea>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-credit-card text-maroon mr-2"></i> Payment Method</h3>
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border-2 border-gray-200 rounded-xl cursor-pointer has-[:checked]:border-maroon has-[:checked]:bg-maroon/5 transition min-h-[44px]">
                            <input type="radio" name="payment_method" value="cod" checked class="mr-3 accent-[#8B0000]">
                            <i class="fas fa-money-bill-wave text-green-600 mr-3"></i>
                            <div>
                                <p class="font-semibold text-sm">Cash on Delivery</p>
                                <p class="text-xs text-gray-500">Pay when you receive</p>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border-2 border-gray-200 rounded-xl cursor-pointer has-[:checked]:border-maroon has-[:checked]:bg-maroon/5 transition min-h-[44px]">
                            <input type="radio" name="payment_method" value="upi" class="mr-3 accent-[#8B0000]">
                            <i class="fas fa-mobile-alt text-purple-600 mr-3"></i>
                            <div>
                                <p class="font-semibold text-sm">UPI</p>
                                <p class="text-xs text-gray-500">GPay, PhonePe, Paytm</p>
                            </div>
                        </label>
                        <label class="flex items-center p-3 border-2 border-gray-200 rounded-xl cursor-pointer has-[:checked]:border-maroon has-[:checked]:bg-maroon/5 transition min-h-[44px]">
                            <input type="radio" name="payment_method" value="card" class="mr-3 accent-[#8B0000]">
                            <i class="fas fa-credit-card text-blue-600 mr-3"></i>
                            <div>
                                <p class="font-semibold text-sm">Card Payment</p>
                                <p class="text-xs text-gray-500">Credit or Debit card</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Notes -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100" data-aos="fade-up" data-aos-delay="300">
                    <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-comment text-maroon mr-2"></i> Special Instructions</h3>
                    <textarea name="notes" rows="2"
                              class="checkout-input w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm transition-all duration-200"
                              placeholder="Any special requests? (Optional)"><?= old('notes') ?></textarea>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-2" data-aos="fade-left">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-24">
                    <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-receipt text-maroon mr-2"></i> Order Summary</h3>

                    <div class="space-y-3 mb-4">
                        <?php foreach ($cart as $item): ?>
                        <div class="flex justify-between items-start text-sm">
                            <div class="flex-1 mr-2">
                                <p class="font-medium text-gray-800"><?= esc($item['name']) ?></p>
                                <p class="text-xs text-gray-500"><?= esc($item['unit']) ?> x <?= $item['quantity'] ?></p>
                            </div>
                            <span class="font-semibold text-gray-800">₹<?= number_format($item['subtotal'], 0) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Subtotal</span>
                            <span class="font-medium">₹<?= number_format($total, 0) ?></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Delivery</span>
                            <span class="font-medium <?= $total >= 499 ? 'text-green-600' : '' ?>"><?= $total >= 499 ? 'FREE' : '₹49' ?></span>
                        </div>
                        <?php if ($total >= 499): ?>
                        <div class="flex justify-between text-sm">
                            <span class="text-green-600"><i class="fas fa-tag mr-1"></i> You save</span>
                            <span class="font-medium text-green-600">₹49</span>
                        </div>
                        <?php endif; ?>
                        <div class="flex justify-between text-lg font-bold border-t border-gray-100 pt-3">
                            <span class="text-gray-800">Total</span>
                            <span class="text-maroon">₹<?= number_format($total < 499 ? $total + 49 : $total, 0) ?></span>
                        </div>
                    </div>

                    <button type="submit" id="placeOrderBtn"
                            class="btn-ripple w-full bg-gradient-to-r from-maroon to-maroon-dark text-white py-3.5 rounded-xl font-bold text-sm mt-6 hover:shadow-lg transition-all flex items-center justify-center min-h-[44px]">
                        <i class="fas fa-lock mr-2"></i> Place Order — ₹<?= number_format($total < 499 ? $total + 49 : $total, 0) ?>
                    </button>

                    <p class="text-xs text-gray-400 text-center mt-3">
                        <i class="fas fa-shield-alt mr-1"></i> Your details are secure with us
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function toggleAddress() {
    const delivery = document.querySelector('input[value="delivery"]').checked;
    const field = document.getElementById('addressField');
    if (delivery) {
        field.style.maxHeight = '200px';
        field.style.opacity = '1';
    } else {
        field.style.maxHeight = '0';
        field.style.opacity = '0';
    }
}

// Input validation visual feedback
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.checkout-input').forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() && this.checkValidity()) {
                this.classList.add('border-green-400');
                this.classList.remove('border-gray-200', 'border-red-400');
            } else if (this.value.trim() && !this.checkValidity()) {
                this.classList.add('border-red-400');
                this.classList.remove('border-gray-200', 'border-green-400');
            } else {
                this.classList.add('border-gray-200');
                this.classList.remove('border-green-400', 'border-red-400');
            }
        });
    });
});
</script>

<?= $this->endSection() ?>
