<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
// Time-of-day greeting
$hour = (int)date('G');
if ($hour < 12) { $timeGreeting = 'Good Morning'; $timeIcon = '&#9728;&#65039;'; $timeBg = 'from-amber-50 to-orange-50'; }
elseif ($hour < 17) { $timeGreeting = 'Good Afternoon'; $timeIcon = '&#127774;'; $timeBg = 'from-sky-50 to-blue-50'; }
else { $timeGreeting = 'Good Evening'; $timeIcon = '&#127769;'; $timeBg = 'from-indigo-50 to-purple-50'; }

// Count total products
$totalProducts = 0;
foreach ($grouped as $products) { $totalProducts += count($products); }
?>

<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-maroon via-maroon-dark to-[#3a0000] rounded-2xl overflow-hidden mb-6" data-aos="fade-up">
    <!-- Floating Decorative Shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-10 -right-10 w-72 h-72 bg-white/5 rounded-full animate-float"></div>
        <div class="absolute bottom-0 -left-10 w-48 h-48 bg-white/5 rounded-full animate-float" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/2 right-1/4 w-32 h-32 bg-gold/10 rounded-full animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-10 right-10 w-20 h-20 bg-gold/5 rounded-full animate-float" style="animation-delay: 0.5s;"></div>
    </div>
    <div class="relative px-5 py-8 sm:px-10 sm:py-14 md:px-12 md:py-16">
        <div class="max-w-xl">
            <div class="inline-flex items-center bg-gold/20 text-gold text-xs font-semibold px-3 py-1.5 rounded-full mb-3 backdrop-blur-sm">
                <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span> Delivering Now in 90 min
            </div>
            <p class="text-white/60 text-sm mb-1"><?= $timeIcon ?> <?= $timeGreeting ?>!</p>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white leading-tight mb-3">
                Fresh <span class="gradient-text">Chicken</span><br class="sm:hidden"> Delivered<br>
                <span class="text-xl sm:text-2xl font-semibold text-white/50">to your doorstep</span>
            </h2>
            <p class="text-white/50 text-sm md:text-base mb-6 max-w-md">
                Farm-fresh, hygienically processed & vacuum packed. 100% quality guarantee on every order.
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="#menu" class="btn-ripple bg-gold text-maroon-dark px-6 py-3 rounded-xl font-bold text-sm hover:bg-gold-light transition-all inline-flex items-center min-h-[44px] shadow-lg shadow-gold/20">
                    <i class="fas fa-utensils mr-2"></i> Order Now
                </a>
                <a href="tel:+919999999999" class="btn-ripple bg-white/10 backdrop-blur-sm text-white px-6 py-3 rounded-xl font-semibold text-sm hover:bg-white/20 transition inline-flex items-center min-h-[44px] border border-white/10">
                    <i class="fas fa-phone mr-2"></i> Call Us
                </a>
            </div>
            <!-- Quick Stats -->
            <div class="flex gap-6 mt-6 pt-6 border-t border-white/10">
                <div>
                    <p class="text-2xl font-bold text-gold"><?= $totalProducts ?>+</p>
                    <p class="text-xs text-white/40">Products</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gold">90</p>
                    <p class="text-xs text-white/40">Min Delivery</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gold">4.8<i class="fas fa-star text-sm ml-0.5"></i></p>
                    <p class="text-xs text-white/40">Rating</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Promise Strip -->
<div class="grid grid-cols-4 gap-2 sm:gap-4 mb-6" data-aos="fade-up" data-aos-delay="100">
    <div class="bg-white rounded-xl p-2.5 sm:p-4 text-center border border-gray-100 shadow-sm border-t-2 border-t-red-500 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-1.5 group-hover:animate-wiggle">
            <i class="fas fa-certificate text-maroon text-xs sm:text-sm"></i>
        </div>
        <p class="text-[10px] sm:text-xs font-semibold text-gray-700">100% Fresh</p>
    </div>
    <div class="bg-white rounded-xl p-2.5 sm:p-4 text-center border border-gray-100 shadow-sm border-t-2 border-t-yellow-500 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-1.5 group-hover:animate-wiggle">
            <i class="fas fa-truck text-gold text-xs sm:text-sm"></i>
        </div>
        <p class="text-[10px] sm:text-xs font-semibold text-gray-700">90 Min Delivery</p>
    </div>
    <div class="bg-white rounded-xl p-2.5 sm:p-4 text-center border border-gray-100 shadow-sm border-t-2 border-t-blue-500 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-1.5 group-hover:animate-wiggle">
            <i class="fas fa-snowflake text-blue-500 text-xs sm:text-sm"></i>
        </div>
        <p class="text-[10px] sm:text-xs font-semibold text-gray-700">Cold Chain</p>
    </div>
    <div class="bg-white rounded-xl p-2.5 sm:p-4 text-center border border-gray-100 shadow-sm border-t-2 border-t-green-500 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-1.5 group-hover:animate-wiggle">
            <i class="fas fa-leaf text-green-500 text-xs sm:text-sm"></i>
        </div>
        <p class="text-[10px] sm:text-xs font-semibold text-gray-700">No Antibiotics</p>
    </div>
</div>

<!-- Promo Banners Slider -->
<div class="mb-8" data-aos="fade-up">
    <div class="flex gap-3 overflow-x-auto scrollbar-hide pb-2 snap-x snap-mandatory" id="promoBanners">
        <div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[32%] snap-start bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl p-5 text-white flex-shrink-0 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <span class="text-xs bg-white/20 px-2 py-1 rounded-full font-semibold">LIMITED OFFER</span>
            <h3 class="text-lg font-bold mt-2">Free Delivery</h3>
            <p class="text-sm text-white/80 mt-1">On orders above ₹499</p>
            <a href="#menu" class="inline-block mt-3 bg-white text-green-700 px-4 py-1.5 rounded-lg text-xs font-bold hover:shadow-lg transition">Shop Now</a>
        </div>
        <div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[32%] snap-start bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl p-5 text-white flex-shrink-0 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <span class="text-xs bg-white/20 px-2 py-1 rounded-full font-semibold">FRESH DAILY</span>
            <h3 class="text-lg font-bold mt-2">Farm Fresh Chicken</h3>
            <p class="text-sm text-white/80 mt-1">Sourced from certified farms</p>
            <a href="#menu" class="inline-block mt-3 bg-white text-orange-700 px-4 py-1.5 rounded-lg text-xs font-bold hover:shadow-lg transition">Explore</a>
        </div>
        <div class="min-w-[85%] sm:min-w-[45%] lg:min-w-[32%] snap-start bg-gradient-to-r from-violet-500 to-purple-600 rounded-2xl p-5 text-white flex-shrink-0 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <span class="text-xs bg-white/20 px-2 py-1 rounded-full font-semibold">PARTY PACK</span>
            <h3 class="text-lg font-bold mt-2">Kebab Platter</h3>
            <p class="text-sm text-white/80 mt-1">Perfect for weekend gatherings</p>
            <a href="#menu" class="inline-block mt-3 bg-white text-purple-700 px-4 py-1.5 rounded-lg text-xs font-bold hover:shadow-lg transition">Order Now</a>
        </div>
    </div>
</div>

<!-- Shop By Category - Visual Category Cards -->
<div class="mb-8" data-aos="fade-up">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800">
            <i class="fas fa-th-large text-maroon mr-2"></i> Shop by Category
        </h2>
    </div>
    <div class="flex gap-3 overflow-x-auto scrollbar-hide pb-2 snap-x">
        <?php
        $categoryIcons = [
            'Fresh Chicken' => ['fa-drumstick-bite', 'from-red-500 to-rose-600', 'bg-red-50'],
            'Boneless' => ['fa-bone', 'from-amber-500 to-orange-600', 'bg-amber-50'],
            'Marinated' => ['fa-pepper-hot', 'from-blue-500 to-indigo-600', 'bg-blue-50'],
            'Kebabs & Seekh' => ['fa-fire-alt', 'from-green-500 to-emerald-600', 'bg-green-50'],
            'Wings & Drumsticks' => ['fa-feather-alt', 'from-purple-500 to-violet-600', 'bg-purple-50'],
            'Ready to Cook' => ['fa-clock', 'from-pink-500 to-rose-600', 'bg-pink-50'],
        ];
        foreach ($categories as $cat):
            $info = $categoryIcons[$cat['category']] ?? ['fa-utensils', 'from-gray-500 to-gray-600', 'bg-gray-50'];
        ?>
        <button onclick="filterCategory('<?= esc($cat['category']) ?>')"
                class="min-w-[100px] sm:min-w-[120px] flex-shrink-0 snap-start group">
            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-br <?= $info[1] ?> flex items-center justify-center mx-auto mb-2 group-hover:scale-105 transition-transform shadow-sm">
                <i class="fas <?= $info[0] ?> text-white text-xl sm:text-2xl"></i>
            </div>
            <p class="text-xs font-semibold text-gray-700 text-center leading-tight"><?= esc($cat['category']) ?></p>
        </button>
        <?php endforeach; ?>
    </div>
</div>

<!-- Bestsellers / Trending Section -->
<?php
$allProducts = [];
foreach ($grouped as $cat => $prods) {
    foreach ($prods as $p) {
        $p['_category'] = $cat;
        $allProducts[] = $p;
    }
}
$bestSellers = array_slice($allProducts, 0, min(6, count($allProducts)));
?>
<?php if (!empty($bestSellers)): ?>
<div class="mb-8" data-aos="fade-up">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-800">
            <i class="fas fa-fire text-orange-500 mr-2"></i> Bestsellers
        </h2>
        <a href="#menu" class="text-sm text-maroon font-semibold hover:underline">See All <i class="fas fa-chevron-right text-xs ml-1"></i></a>
    </div>
    <div class="flex gap-3 overflow-x-auto scrollbar-hide pb-2 snap-x snap-mandatory">
        <?php foreach ($bestSellers as $i => $product):
            $product['_popular'] = true;
        ?>
        <div class="min-w-[160px] sm:min-w-[200px] flex-shrink-0 snap-start">
            <?= view('customer/partials/product_card', ['product' => $product, 'cartItems' => $cartItems]) ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<!-- Info Banner -->
<div class="bg-gradient-to-r <?= $timeBg ?> rounded-2xl p-5 sm:p-6 mb-8 border border-gray-100" data-aos="fade-up">
    <div class="flex flex-col sm:flex-row items-center gap-4">
        <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center flex-shrink-0">
            <i class="fas fa-shield-alt text-maroon text-2xl"></i>
        </div>
        <div class="text-center sm:text-left">
            <h3 class="font-bold text-gray-800 text-base">Our Quality Promise</h3>
            <p class="text-sm text-gray-500 mt-0.5">Every piece is sourced from certified farms, processed in FSSAI-approved facilities, and delivered in temperature-controlled packaging. Not satisfied? Get a full refund - no questions asked.</p>
        </div>
    </div>
</div>

<!-- Category Pills + Menu Section -->
<div id="menu" class="mb-6" data-aos="fade-up">
    <h2 class="text-xl font-bold text-gray-800 mb-4">
        <i class="fas fa-utensils text-maroon mr-2"></i> Full Menu
    </h2>
    <div class="flex gap-2 mb-6 overflow-x-auto scrollbar-hide pb-2">
        <button onclick="filterCategory('all')" class="category-pill active px-4 py-2 rounded-full text-sm font-semibold bg-maroon text-white border border-maroon transition flex-shrink-0 min-h-[44px]">
            All Items
        </button>
        <?php foreach ($categories as $cat): ?>
        <button onclick="filterCategory('<?= esc($cat['category']) ?>')"
                class="category-pill px-4 py-2 rounded-full text-sm font-semibold bg-white text-gray-600 border border-gray-200 hover:border-maroon hover:text-maroon transition flex-shrink-0 min-h-[44px]">
            <?= esc($cat['category']) ?>
        </button>
        <?php endforeach; ?>
    </div>
</div>

<!-- Products by Category -->
<?php foreach ($grouped as $category => $products): ?>
<section class="category-section mb-8" data-category="<?= esc($category) ?>" data-aos="fade-up">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-bold text-gray-800">
            <?= esc($category) ?>
            <span class="text-sm font-normal text-gray-400 ml-2">(<?= count($products) ?> items)</span>
        </h3>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
        <?php foreach ($products as $index => $product):
            if ($index < 2) $product['_popular'] = true;
        ?>
            <?= view('customer/partials/product_card', ['product' => $product, 'cartItems' => $cartItems]) ?>
        <?php endforeach; ?>
    </div>
</section>
<?php endforeach; ?>

<!-- Why Choose Us Section -->
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8 mb-8" data-aos="fade-up">
    <h2 class="text-xl font-bold text-gray-800 text-center mb-6">
        Why Customers Love Us
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        <div class="text-center">
            <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-heart text-maroon text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-800 text-sm mb-1">Handpicked Quality</h4>
            <p class="text-xs text-gray-500">Every piece is carefully selected and quality checked before packaging</p>
        </div>
        <div class="text-center">
            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-bolt text-blue-500 text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-800 text-sm mb-1">Lightning Fast</h4>
            <p class="text-xs text-gray-500">From our store to your kitchen in under 90 minutes, guaranteed</p>
        </div>
        <div class="text-center">
            <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-rupee-sign text-green-500 text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-800 text-sm mb-1">Best Prices</h4>
            <p class="text-xs text-gray-500">Competitive prices with no hidden charges. Free delivery on ₹499+</p>
        </div>
    </div>
</div>

<!-- Testimonials -->
<div class="mb-8" data-aos="fade-up">
    <h2 class="text-xl font-bold text-gray-800 mb-4">
        <i class="fas fa-quote-left text-gold mr-2"></i> What Our Customers Say
    </h2>
    <div class="flex gap-3 overflow-x-auto scrollbar-hide pb-2 snap-x snap-mandatory">
        <?php
        $testimonials = [
            ['name' => 'Priya M.', 'text' => 'Best chicken quality in Mumbai! Always fresh and the delivery is super quick. My family loves it!', 'rating' => 5, 'initials' => 'PM', 'color' => 'bg-pink-500'],
            ['name' => 'Rahul S.', 'text' => 'The marinated chicken is just amazing. Saves me so much time for dinner prep. Highly recommended!', 'rating' => 5, 'initials' => 'RS', 'color' => 'bg-blue-500'],
            ['name' => 'Anjali K.', 'text' => 'I was skeptical about ordering chicken online but the packaging and freshness won me over. A regular now!', 'rating' => 4, 'initials' => 'AK', 'color' => 'bg-green-500'],
            ['name' => 'Vikram P.', 'text' => 'The kebabs are restaurant quality. Perfect for our weekend barbecue. Great prices too!', 'rating' => 5, 'initials' => 'VP', 'color' => 'bg-purple-500'],
        ];
        foreach ($testimonials as $t):
        ?>
        <div class="min-w-[280px] sm:min-w-[300px] flex-shrink-0 snap-start bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 <?= $t['color'] ?> rounded-full flex items-center justify-center text-white font-bold text-sm"><?= $t['initials'] ?></div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm"><?= $t['name'] ?></p>
                    <div class="flex text-yellow-400 text-xs">
                        <?php for($s=0; $s<$t['rating']; $s++): ?><i class="fas fa-star"></i><?php endfor; ?>
                        <?php for($s=$t['rating']; $s<5; $s++): ?><i class="far fa-star text-gray-300"></i><?php endfor; ?>
                    </div>
                </div>
            </div>
            <p class="text-sm text-gray-600 leading-relaxed">"<?= $t['text'] ?>"</p>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- CTA Banner -->
<div class="bg-gradient-to-r from-maroon to-maroon-dark rounded-2xl p-6 sm:p-8 mb-6 text-white text-center relative overflow-hidden" data-aos="fade-up">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/5 rounded-full"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-gold/10 rounded-full"></div>
    </div>
    <div class="relative">
        <h3 class="text-xl sm:text-2xl font-bold mb-2">Craving Fresh Chicken?</h3>
        <p class="text-white/60 text-sm mb-5">Order now and get it delivered in 90 minutes. Fresh, fast & delicious!</p>
        <a href="#menu" class="btn-ripple inline-flex items-center bg-gold text-maroon-dark px-8 py-3 rounded-xl font-bold text-sm hover:bg-gold-light transition-all shadow-lg shadow-gold/20 min-h-[44px]">
            <i class="fas fa-shopping-bag mr-2"></i> Start Ordering
        </a>
    </div>
</div>

<script>
function filterCategory(category) {
    document.querySelectorAll('.category-pill').forEach(pill => {
        pill.classList.remove('active', 'bg-maroon', 'text-white');
        pill.classList.add('bg-white', 'text-gray-600');
    });
    event.target.classList.add('active', 'bg-maroon', 'text-white');
    event.target.classList.remove('bg-white', 'text-gray-600');

    document.querySelectorAll('.category-section').forEach(section => {
        if (category === 'all' || section.dataset.category === category) {
            section.style.display = '';
        } else {
            section.style.display = 'none';
        }
    });

    // Smooth scroll to menu
    if (category !== 'all') {
        document.getElementById('menu').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

// Auto-scroll promo banners on mobile
let promoScroll;
function autoScrollPromo() {
    const container = document.getElementById('promoBanners');
    if (!container || window.innerWidth > 640) return;
    let idx = 0;
    const children = container.children;
    promoScroll = setInterval(() => {
        idx = (idx + 1) % children.length;
        children[idx].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
    }, 4000);
}
document.addEventListener('DOMContentLoaded', autoScrollPromo);
</script>

<?= $this->endSection() ?>
