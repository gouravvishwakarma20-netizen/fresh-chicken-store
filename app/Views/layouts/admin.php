<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin' ?> - Fresh Chicken Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maroon: { DEFAULT: '#8B0000', light: '#A52A2A', dark: '#5C0000', 50: '#fef2f2', 100: '#fde8e8' },
                        gold: { DEFAULT: '#D4AF37', light: '#E5C76B', dark: '#B8960C', 50: '#fefce8', 100: '#fef9c3' },
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                }
            }
        }
    </script>
    <style>
        .nav-item { transition: all 0.2s ease; }
        .nav-item:hover { transform: translateX(4px); }
        .stat-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,0.1); }
        .table-row { transition: all 0.15s ease; }
        .table-row:hover { background-color: #fef2f2; }
        @keyframes slideDown { from { transform: translateY(-10px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .flash-msg { animation: slideDown 0.4s ease-out; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #8B0000; border-radius: 3px; }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-maroon-dark to-[#3a0000] transform -translate-x-full lg:translate-x-0 transition-transform duration-200">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="p-5 border-b border-white/10">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gold rounded-lg flex items-center justify-center">
                            <i class="fas fa-drumstick-bite text-maroon-dark text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-white font-bold text-lg">Fresh Chicken</h2>
                            <p class="text-white/50 text-xs">Admin Panel</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 p-4 space-y-1">
                    <?php
                    $currentUrl = current_url();
                    $navItems = [
                        ['url' => 'admin/dashboard', 'icon' => 'fa-tachometer-alt', 'label' => 'Dashboard'],
                        ['url' => 'admin/orders', 'icon' => 'fa-shopping-bag', 'label' => 'Orders'],
                        ['url' => 'admin/products', 'icon' => 'fa-drumstick-bite', 'label' => 'Products'],
                    ];
                    foreach ($navItems as $nav):
                        $isActive = strpos($currentUrl, $nav['url']) !== false;
                    ?>
                    <a href="<?= base_url($nav['url']) ?>"
                       class="nav-item flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium min-h-[44px]
                              <?= $isActive ? 'bg-white/15 text-gold' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>">
                        <i class="fas <?= $nav['icon'] ?> w-5 text-center"></i>
                        <span><?= $nav['label'] ?></span>
                    </a>
                    <?php endforeach; ?>
                </nav>

                <!-- Footer -->
                <div class="p-4 border-t border-white/10">
                    <a href="<?= base_url() ?>" target="_blank"
                       class="nav-item flex items-center space-x-3 px-4 py-2.5 rounded-xl text-white/70 hover:bg-white/10 hover:text-white text-sm transition min-h-[44px]">
                        <i class="fas fa-external-link-alt w-5 text-center"></i>
                        <span>View Store</span>
                    </a>
                    <a href="<?= base_url('admin/logout') ?>"
                       class="nav-item flex items-center space-x-3 px-4 py-2.5 rounded-xl text-red-300 hover:bg-red-500/20 hover:text-red-200 text-sm transition mt-1 min-h-[44px]">
                        <i class="fas fa-sign-out-alt w-5 text-center"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Sidebar overlay (mobile) -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top bar -->
            <header class="bg-white shadow-sm border-b border-gray-100 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button onclick="toggleSidebar()" class="lg:hidden text-gray-600 hover:text-maroon min-h-[44px] min-w-[44px] flex items-center justify-center">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div>
                        <h1 class="text-lg font-bold text-gray-800"><?= $title ?? 'Dashboard' ?></h1>
                        <?php
                        $hour = (int)date('G');
                        if ($hour < 12) { $greeting = 'Good morning'; $gIcon = 'fa-sun text-yellow-500'; }
                        elseif ($hour < 17) { $greeting = 'Good afternoon'; $gIcon = 'fa-cloud-sun text-orange-500'; }
                        else { $greeting = 'Good evening'; $gIcon = 'fa-moon text-indigo-500'; }
                        ?>
                        <p class="text-xs text-gray-400 mt-0.5"><i class="fas <?= $gIcon ?> mr-1"></i> <?= $greeting ?>, <?= session()->get('admin_name') ?? 'Admin' ?></p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500 hidden sm:inline">
                        <i class="fas fa-calendar mr-1"></i>
                        <?= date('d M Y') ?>
                    </span>
                    <div class="w-9 h-9 bg-maroon/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-circle text-maroon"></i>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-4 sm:p-6">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="flash-msg bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center" id="flashSuccess">
                        <i class="fas fa-check-circle mr-2"></i> <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="flash-msg bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm flex items-center" id="flashError">
                        <i class="fas fa-exclamation-circle mr-2"></i> <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init({ duration: 600, once: true, offset: 50 });

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    // Auto-dismiss flash messages
    document.addEventListener('DOMContentLoaded', function() {
        ['flashSuccess', 'flashError'].forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                setTimeout(() => {
                    el.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(-10px)';
                    setTimeout(() => el.remove(), 400);
                }, 5000);
            }
        });

        // Animated counters
        const counters = document.querySelectorAll('[data-count]');
        if (counters.length > 0) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        const target = parseInt(el.dataset.count) || 0;
                        const duration = 1200;
                        const start = Date.now();
                        const startVal = 0;
                        const prefix = el.dataset.prefix || '';
                        const step = () => {
                            const elapsed = Date.now() - start;
                            const progress = Math.min(elapsed / duration, 1);
                            const eased = 1 - Math.pow(1 - progress, 3);
                            const current = Math.floor(startVal + (target - startVal) * eased);
                            el.textContent = prefix + current.toLocaleString('en-IN');
                            if (progress < 1) requestAnimationFrame(step);
                            else el.textContent = prefix + target.toLocaleString('en-IN');
                        };
                        step();
                        observer.unobserve(el);
                    }
                });
            }, { threshold: 0.3 });
            counters.forEach(c => observer.observe(c));
        }
    });
    </script>
</body>
</html>
