<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<!-- Status Filter Tabs -->
<div class="flex gap-2 mb-6 overflow-x-auto scrollbar-hide pb-2" data-aos="fade-down" style="-ms-overflow-style:none;scrollbar-width:none;">
    <?php
    $statuses = [
        'all' => ['label' => 'All Orders', 'icon' => 'fa-list'],
        'pending' => ['label' => 'Pending', 'icon' => 'fa-clock'],
        'confirmed' => ['label' => 'Confirmed', 'icon' => 'fa-check'],
        'preparing' => ['label' => 'Preparing', 'icon' => 'fa-fire'],
        'ready' => ['label' => 'Ready', 'icon' => 'fa-box'],
        'out_for_delivery' => ['label' => 'Out for Delivery', 'icon' => 'fa-truck'],
        'delivered' => ['label' => 'Delivered', 'icon' => 'fa-check-double'],
        'cancelled' => ['label' => 'Cancelled', 'icon' => 'fa-times'],
    ];
    foreach ($statuses as $key => $s):
        $isActive = $currentStatus === $key;
    ?>
    <a href="<?= base_url('admin/orders?status=' . $key) ?>"
       class="px-4 py-2 rounded-full text-sm font-semibold transition flex-shrink-0 min-h-[44px] flex items-center
              <?= $isActive ? 'bg-maroon text-white' : 'bg-white text-gray-600 border border-gray-200 hover:border-maroon hover:text-maroon' ?>">
        <i class="fas <?= $s['icon'] ?> mr-1"></i> <?= $s['label'] ?>
    </a>
    <?php endforeach; ?>
</div>

<!-- Orders -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" data-aos="fade-up">
    <?php if (empty($orders)): ?>
        <div class="p-12 text-center text-gray-400">
            <i class="fas fa-inbox text-4xl mb-3"></i>
            <p class="font-medium">No orders found</p>
        </div>
    <?php else: ?>
        <!-- Desktop Table -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Order #</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Customer</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Type</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Amount</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Date</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($orders as $order): ?>
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
                        <td class="px-6 py-4">
                            <span class="text-sm capitalize <?= $order['order_type'] === 'delivery' ? 'text-blue-600' : 'text-green-600' ?>">
                                <i class="fas <?= $order['order_type'] === 'delivery' ? 'fa-motorcycle' : 'fa-store' ?> mr-1"></i>
                                <?= esc($order['order_type']) ?>
                            </span>
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
                        <td class="px-6 py-4">
                            <a href="<?= base_url('admin/orders/' . $order['id']) ?>"
                               class="text-maroon hover:text-maroon-dark text-sm font-medium">
                                <i class="fas fa-eye mr-1"></i> View
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- Mobile Cards -->
        <div class="sm:hidden divide-y divide-gray-100">
            <?php foreach ($orders as $order):
                $color = $statusColors[$order['order_status']] ?? 'bg-gray-100 text-gray-800';
                $dot = $dotColors[$order['order_status']] ?? 'bg-gray-500';
            ?>
            <a href="<?= base_url('admin/orders/' . $order['id']) ?>" class="block p-4 hover:bg-gray-50 transition">
                <div class="flex justify-between items-start mb-1.5">
                    <div>
                        <p class="font-semibold text-maroon text-sm"><?= esc($order['order_number']) ?></p>
                        <p class="text-xs text-gray-500"><?= esc($order['customer_name']) ?> &bull; <?= esc($order['customer_phone']) ?></p>
                    </div>
                    <span class="font-bold text-sm">₹<?= number_format($order['total_amount'], 0) ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <span class="<?= $color ?> text-[10px] font-semibold px-2 py-0.5 rounded-full inline-flex items-center">
                            <span class="w-1.5 h-1.5 <?= $dot ?> rounded-full mr-1"></span>
                            <?= ucwords(str_replace('_', ' ', $order['order_status'])) ?>
                        </span>
                        <span class="text-xs capitalize <?= $order['order_type'] === 'delivery' ? 'text-blue-500' : 'text-green-500' ?>">
                            <i class="fas <?= $order['order_type'] === 'delivery' ? 'fa-motorcycle' : 'fa-store' ?>"></i>
                        </span>
                    </div>
                    <span class="text-[10px] text-gray-400"><?= date('d M, h:i A', strtotime($order['created_at'])) ?></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
