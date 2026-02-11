<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
// Random celebration messages
$celebrations = [
    "Your chicken is on its way!",
    "Cluck yeah! Order confirmed!",
    "Fresh & fabulous, just like you!",
    "Winner winner, chicken dinner!",
    "Sit tight, deliciousness incoming!",
];
$celebrationMsg = $celebrations[array_rand($celebrations)];
?>

<div class="max-w-lg mx-auto text-center py-8">
    <!-- Confetti Container -->
    <div id="confettiContainer" class="fixed inset-0 pointer-events-none z-50"></div>

    <!-- Success Animation -->
    <div class="mb-6" data-aos="zoom-in">
        <svg class="w-24 h-24 mx-auto" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="45" fill="none" stroke="#22c55e" stroke-width="3" opacity="0.2"/>
            <circle cx="50" cy="50" r="45" fill="none" stroke="#22c55e" stroke-width="3"
                    stroke-dasharray="283" stroke-dashoffset="283" stroke-linecap="round"
                    style="animation: drawCircle 0.8s ease-out 0.3s forwards;"/>
            <path d="M30 50 L45 65 L70 35" fill="none" stroke="#22c55e" stroke-width="4"
                  stroke-linecap="round" stroke-linejoin="round"
                  stroke-dasharray="60" stroke-dashoffset="60"
                  style="animation: drawCheck 0.5s ease-out 1s forwards;"/>
        </svg>
    </div>
    <style>
        @keyframes drawCircle { to { stroke-dashoffset: 0; } }
        @keyframes drawCheck { to { stroke-dashoffset: 0; } }
    </style>

    <h2 class="text-2xl font-bold text-gray-800 mb-2" data-aos="fade-up" data-aos-delay="200">Order Placed Successfully!</h2>
    <p class="text-gray-500 mb-1" data-aos="fade-up" data-aos-delay="300"><?= $celebrationMsg ?></p>
    <p class="text-sm text-gray-400 mb-6" data-aos="fade-up" data-aos-delay="350">Thank you for your order. We'll prepare your fresh chicken right away.</p>

    <!-- Order Timeline -->
    <div class="flex items-center justify-center gap-0 mb-8" data-aos="fade-up" data-aos-delay="400">
        <?php
        $timeline = [
            ['icon' => 'fa-receipt', 'label' => 'Placed', 'active' => true],
            ['icon' => 'fa-fire', 'label' => 'Preparing', 'active' => false],
            ['icon' => 'fa-motorcycle', 'label' => 'On the Way', 'active' => false],
            ['icon' => 'fa-check-double', 'label' => 'Delivered', 'active' => false],
        ];
        foreach ($timeline as $i => $step):
        ?>
        <div class="flex items-center">
            <div class="flex flex-col items-center">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs
                     <?= $step['active'] ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-400' ?>">
                    <i class="fas <?= $step['icon'] ?>"></i>
                </div>
                <span class="text-[10px] mt-1 <?= $step['active'] ? 'text-green-600 font-semibold' : 'text-gray-400' ?>"><?= $step['label'] ?></span>
            </div>
            <?php if ($i < count($timeline) - 1): ?>
            <div class="w-8 sm:w-12 h-0.5 <?= $step['active'] ? 'bg-green-500' : 'bg-gray-200' ?> mt-[-12px]"></div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Order Details Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-left mb-6" data-aos="fade-up" data-aos-delay="500">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-gray-800"><i class="fas fa-receipt text-maroon mr-2"></i> Order Details</h3>
            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">
                <?= ucfirst(esc($order['order_status'])) ?>
            </span>
        </div>

        <div class="space-y-3 text-sm">
            <div class="flex justify-between">
                <span class="text-gray-500">Order Number</span>
                <span class="font-bold text-maroon"><?= esc($order['order_number']) ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Name</span>
                <span class="font-medium"><?= esc($order['customer_name']) ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Phone</span>
                <span class="font-medium"><?= esc($order['customer_phone']) ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Order Type</span>
                <span class="font-medium capitalize"><?= esc($order['order_type']) ?></span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Payment</span>
                <span class="font-medium uppercase"><?= esc($order['payment_method']) ?></span>
            </div>
            <div class="border-t pt-3 flex justify-between">
                <span class="font-semibold text-gray-800">Total Amount</span>
                <span class="text-xl font-bold text-maroon">₹<?= number_format($order['total_amount'], 0) ?></span>
            </div>
        </div>
    </div>

    <!-- WhatsApp Link -->
    <?php
    $whatsappMsg = urlencode("Hi! I just placed an order.\nOrder Number: {$order['order_number']}\nName: {$order['customer_name']}\nTotal: ₹" . number_format($order['total_amount'], 0));
    ?>
    <div class="space-y-3" data-aos="fade-up" data-aos-delay="600">
        <a href="https://wa.me/919999999999?text=<?= $whatsappMsg ?>" target="_blank"
           class="btn-ripple w-full bg-green-500 text-white py-3.5 rounded-xl font-semibold text-sm hover:bg-green-600 transition flex items-center justify-center min-h-[44px] hover:shadow-lg">
            <i class="fab fa-whatsapp text-xl mr-2"></i> Share on WhatsApp
        </a>

        <a href="<?= base_url() ?>"
           class="btn-ripple w-full bg-gradient-to-r from-maroon to-maroon-dark text-white py-3.5 rounded-xl font-semibold text-sm hover:shadow-lg transition-all flex items-center justify-center min-h-[44px]">
            <i class="fas fa-home mr-2"></i> Continue Shopping
        </a>
    </div>

    <!-- Delivery Estimate -->
    <div class="bg-blue-50 rounded-xl p-4 mt-6 text-sm text-blue-700" data-aos="fade-up" data-aos-delay="700">
        <i class="fas fa-clock mr-2"></i>
        Estimated delivery time: <strong>60-90 minutes</strong>
    </div>
</div>

<script>
// Confetti
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('confettiContainer');
    const colors = ['#8B0000', '#D4AF37', '#22c55e', '#3b82f6', '#f59e0b', '#ec4899', '#8b5cf6'];
    for (let i = 0; i < 40; i++) {
        const confetti = document.createElement('div');
        confetti.style.cssText = `
            position: fixed;
            width: ${Math.random() * 10 + 5}px;
            height: ${Math.random() * 10 + 5}px;
            background: ${colors[Math.floor(Math.random() * colors.length)]};
            left: ${Math.random() * 100}vw;
            top: -20px;
            border-radius: ${Math.random() > 0.5 ? '50%' : '2px'};
            animation: confettiFall ${Math.random() * 2 + 2}s ease-in ${Math.random() * 1}s forwards;
            opacity: 0.9;
        `;
        container.appendChild(confetti);
    }
    setTimeout(() => container.remove(), 5000);
});
</script>

<?= $this->endSection() ?>
