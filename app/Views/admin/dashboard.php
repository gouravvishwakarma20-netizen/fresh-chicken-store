<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<!-- Stats Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
    <div class="stat-card bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-100 border-l-4 border-l-blue-500" data-aos="fade-up" data-aos-delay="0">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-shopping-bag text-blue-600 text-lg sm:text-xl"></i>
            </div>
            <span class="text-[10px] sm:text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">All Time</span>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-gray-800" data-count="<?= $stats['total_orders'] ?>">0</p>
        <p class="text-xs sm:text-sm text-gray-500">Total Orders</p>
    </div>

    <div class="stat-card bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-100 border-l-4 border-l-green-500" data-aos="fade-up" data-aos-delay="100">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-rupee-sign text-green-600 text-lg sm:text-xl"></i>
            </div>
            <span class="text-[10px] sm:text-xs font-semibold text-green-600 bg-green-50 px-2 py-1 rounded-full">Revenue</span>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-gray-800" data-count="<?= $stats['total_revenue'] ?>" data-prefix="₹">₹0</p>
        <p class="text-xs sm:text-sm text-gray-500">Total Revenue</p>
    </div>

    <div class="stat-card bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-100 border-l-4 border-l-yellow-500" data-aos="fade-up" data-aos-delay="200">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-clock text-yellow-600 text-lg sm:text-xl"></i>
            </div>
            <span class="text-[10px] sm:text-xs font-semibold text-yellow-600 bg-yellow-50 px-2 py-1 rounded-full">Pending</span>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-gray-800" data-count="<?= $stats['pending_orders'] ?>">0</p>
        <p class="text-xs sm:text-sm text-gray-500">Pending Orders</p>
    </div>

    <div class="stat-card bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-100 border-l-4 border-l-purple-500" data-aos="fade-up" data-aos-delay="300">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-drumstick-bite text-purple-600 text-lg sm:text-xl"></i>
            </div>
            <span class="text-[10px] sm:text-xs font-semibold text-purple-600 bg-purple-50 px-2 py-1 rounded-full">Menu</span>
        </div>
        <p class="text-xl sm:text-2xl font-bold text-gray-800" data-count="<?= $stats['total_products'] ?>">0</p>
        <p class="text-xs sm:text-sm text-gray-500">Total Products</p>
    </div>
</div>

<!-- Today Stats -->
<div class="bg-gradient-to-r from-maroon to-maroon-dark rounded-2xl p-6 mb-8 text-white relative overflow-hidden" data-aos="fade-up">
    <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="flex items-center justify-between relative">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="w-2.5 h-2.5 bg-green-400 rounded-full animate-pulse"></span>
                <h3 class="text-lg font-bold">Today's Orders</h3>
            </div>
            <p class="text-white/70 text-sm"><?= date('l, d M Y') ?></p>
        </div>
        <div class="text-right">
            <p class="text-3xl font-bold text-gold"><?= $stats['today_orders'] ?></p>
            <p class="text-white/70 text-sm">orders today</p>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" data-aos="fade-up">
    <div class="p-4 sm:p-6 border-b border-gray-100 flex items-center justify-between">
        <h3 class="font-bold text-gray-800"><i class="fas fa-clock text-maroon mr-2"></i> Recent Orders</h3>
        <a href="<?= base_url('admin/orders') ?>" class="text-sm text-maroon hover:underline font-medium">View All →</a>
    </div>

    <?php if (empty($recentOrders)): ?>
        <div class="p-12 text-center text-gray-400">
            <i class="fas fa-inbox text-4xl mb-3"></i>
            <p class="font-medium">No orders yet</p>
        </div>
    <?php else: ?>
        <!-- Desktop Table -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Order #</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Customer</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Amount</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($recentOrders as $order): ?>
                    <tr class="table-row">
                        <td class="px-6 py-4">
                            <a href="<?= base_url('admin/orders/' . $order['id']) ?>" class="text-maroon font-semibold text-sm hover:underline">
                                <?= esc($order['order_number']) ?>
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium text-sm text-gray-800"><?= esc($order['customer_name']) ?></p>
                            <p class="text-xs text-gray-500"><?= esc($order['customer_phone']) ?></p>
                        </td>
                        <td class="px-6 py-4 font-semibold text-sm">₹<?= number_format($order['total_amount'], 0) ?></td>
                        <td class="px-6 py-4">
                            <?php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'confirmed' => 'bg-blue-100 text-blue-800',
                                'preparing' => 'bg-orange-100 text-orange-800',
                                'ready' => 'bg-indigo-100 text-indigo-800',
                                'out_for_delivery' => 'bg-purple-100 text-purple-800',
                                'delivered' => 'bg-green-100 text-green-800',
                                'cancelled' => 'bg-red-100 text-red-800',
                            ];
                            $color = $statusColors[$order['order_status']] ?? 'bg-gray-100 text-gray-800';
                            $dotColors = [
                                'pending' => 'bg-yellow-500', 'confirmed' => 'bg-blue-500', 'preparing' => 'bg-orange-500',
                                'ready' => 'bg-indigo-500', 'out_for_delivery' => 'bg-purple-500', 'delivered' => 'bg-green-500', 'cancelled' => 'bg-red-500',
                            ];
                            $dot = $dotColors[$order['order_status']] ?? 'bg-gray-500';
                            ?>
                            <span class="<?= $color ?> text-xs font-semibold px-2.5 py-1 rounded-full inline-flex items-center">
                                <span class="w-1.5 h-1.5 <?= $dot ?> rounded-full mr-1.5"></span>
                                <?= ucwords(str_replace('_', ' ', $order['order_status'])) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <?= date('d M, h:i A', strtotime($order['created_at'])) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- Mobile Cards -->
        <div class="sm:hidden divide-y divide-gray-100">
            <?php foreach ($recentOrders as $order):
                $color = $statusColors[$order['order_status']] ?? 'bg-gray-100 text-gray-800';
                $dot = $dotColors[$order['order_status']] ?? 'bg-gray-500';
            ?>
            <a href="<?= base_url('admin/orders/' . $order['id']) ?>" class="block p-4 hover:bg-gray-50 transition">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <p class="font-semibold text-maroon text-sm"><?= esc($order['order_number']) ?></p>
                        <p class="text-xs text-gray-500"><?= esc($order['customer_name']) ?></p>
                    </div>
                    <span class="font-bold text-sm">₹<?= number_format($order['total_amount'], 0) ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="<?= $color ?> text-[10px] font-semibold px-2 py-0.5 rounded-full inline-flex items-center">
                        <span class="w-1.5 h-1.5 <?= $dot ?> rounded-full mr-1"></span>
                        <?= ucwords(str_replace('_', ' ', $order['order_status'])) ?>
                    </span>
                    <span class="text-[10px] text-gray-400"><?= date('d M, h:i A', strtotime($order['created_at'])) ?></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
