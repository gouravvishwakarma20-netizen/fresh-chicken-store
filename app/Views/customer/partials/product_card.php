<?php
// $product - single product array
// $cartItems - current cart items keyed by product_id
$inCart = isset($cartItems[$product['id']]);
$cartQty = $inCart ? $cartItems[$product['id']]['quantity'] : 0;
$isPopular = !empty($product['_popular']);

// Generate placeholder SVG based on category
$categoryColors = [
    'Fresh Chicken' => ['#FEE2E2', '#DC2626'],
    'Boneless' => ['#FEF3C7', '#D97706'],
    'Marinated' => ['#DBEAFE', '#2563EB'],
    'Kebabs & Seekh' => ['#D1FAE5', '#059669'],
    'Wings & Drumsticks' => ['#EDE9FE', '#7C3AED'],
    'Ready to Cook' => ['#FFE4E6', '#E11D48'],
];
$colors = $categoryColors[$product['category']] ?? ['#F3F4F6', '#6B7280'];

if ($product['image']) {
    $imageUrl = base_url('uploads/' . $product['image']);
    $imageTag = '<img src="' . esc($imageUrl) . '" alt="' . esc($product['name']) . '" class="w-full h-full object-cover product-img">';
} else {
    $imageTag = '<svg viewBox="0 0 200 200" class="w-full h-full product-img" xmlns="http://www.w3.org/2000/svg">
        <rect width="200" height="200" fill="' . $colors[0] . '"/>
        <text x="100" y="90" text-anchor="middle" fill="' . $colors[1] . '" font-size="40" font-family="Arial">&#127831;</text>
        <text x="100" y="130" text-anchor="middle" fill="' . $colors[1] . '" font-size="11" font-family="Arial" font-weight="bold">' . esc($product['name']) . '</text>
    </svg>';
}
?>

<div class="product-card bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 relative"
     data-name="<?= esc($product['name']) ?>" data-category="<?= esc($product['category']) ?>">

    <!-- Image -->
    <div class="relative h-36 sm:h-44 bg-gray-100 overflow-hidden">
        <?= $imageTag ?>
        <!-- Gradient Overlay -->
        <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-black/20 to-transparent pointer-events-none"></div>
        <!-- Unit Badge -->
        <div class="absolute top-2.5 left-2.5">
            <span class="glass text-xs font-semibold px-2 py-0.5 rounded-full text-maroon shadow-sm">
                <?= esc($product['unit']) ?>
            </span>
        </div>
        <?php if ($isPopular): ?>
        <!-- Popular Badge -->
        <div class="absolute top-2.5 right-2.5">
            <span class="bg-gradient-to-r from-amber-500 to-yellow-400 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm flex items-center">
                <i class="fas fa-fire text-[8px] mr-0.5"></i> Popular
            </span>
        </div>
        <?php endif; ?>
    </div>

    <!-- Info -->
    <div class="p-3 sm:p-4">
        <p class="text-[10px] uppercase tracking-wide text-gray-400 font-semibold mb-0.5"><?= esc($product['category']) ?></p>
        <h3 class="font-semibold text-gray-800 text-sm mb-1 line-clamp-1"><?= esc($product['name']) ?></h3>
        <p class="text-xs text-gray-500 mb-3 line-clamp-2 hidden sm:block"><?= esc($product['description']) ?></p>

        <div class="flex items-center justify-between">
            <div>
                <span class="text-lg font-bold text-maroon">₹<?= number_format($product['price'], 0) ?></span>
                <span class="text-[10px] text-gray-400 block">/<?= esc($product['unit']) ?></span>
            </div>

            <!-- Add Button -->
            <button id="addBtn-<?= $product['id'] ?>"
                    onclick="addToCart(<?= $product['id'] ?>)"
                    class="<?= $inCart ? 'hidden' : '' ?> btn-ripple bg-gradient-to-r from-maroon to-maroon-dark text-white px-4 py-2 rounded-xl text-sm font-semibold hover:shadow-lg transition-all flex items-center space-x-1 min-h-[44px] active:scale-95">
                <i class="fas fa-plus text-xs"></i>
                <span>ADD</span>
            </button>

            <!-- Quantity Controls -->
            <div id="qtyCtrl-<?= $product['id'] ?>"
                 class="<?= $inCart ? '' : 'hidden' ?> flex items-center bg-gradient-to-r from-maroon to-maroon-dark rounded-xl overflow-hidden shadow-md">
                <button onclick="updateQty(<?= $product['id'] ?>, -1)"
                        class="qty-btn w-10 h-10 sm:w-9 sm:h-9 flex items-center justify-center text-white hover:bg-white/10 font-bold text-lg min-h-[44px]">−</button>
                <span id="qty-<?= $product['id'] ?>" class="w-8 text-center text-white font-semibold text-sm"><?= $cartQty ?></span>
                <button onclick="updateQty(<?= $product['id'] ?>, 1)"
                        class="qty-btn w-10 h-10 sm:w-9 sm:h-9 flex items-center justify-center text-white hover:bg-white/10 font-bold text-lg min-h-[44px]">+</button>
            </div>
        </div>
    </div>
</div>
