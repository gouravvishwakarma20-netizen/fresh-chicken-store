<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6">
    <a href="<?= base_url('admin/orders') ?>" class="text-sm text-gray-500 hover:text-maroon transition">
        <i class="fas fa-arrow-left mr-1"></i> Back to Orders
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Order Details -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Customer Info -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100" data-aos="fade-up">
            <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-user text-maroon mr-2"></i> Customer Information</h3>
            <div class="flex items-center gap-4 mb-4">
                <?php
                $initials = strtoupper(substr($order['customer_name'], 0, 1) . (strpos($order['customer_name'], ' ') !== false ? substr($order['customer_name'], strpos($order['customer_name'], ' ') + 1, 1) : ''));
                ?>
                <div class="w-12 h-12 bg-maroon/10 rounded-full flex items-center justify-center text-maroon font-bold text-lg flex-shrink-0">
                    <?= $initials ?>
                </div>
                <div>
                    <p class="font-semibold text-gray-800"><?= esc($order['customer_name']) ?></p>
                    <p class="text-sm text-gray-500"><?= esc($order['customer_phone']) ?></p>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500 mb-1">Order Type</p>
                    <p class="font-semibold capitalize"><?= esc($order['order_type']) ?></p>
                </div>
                <div>
                    <p class="text-gray-500 mb-1">Payment Method</p>
                    <p class="font-semibold uppercase"><?= esc($order['payment_method']) ?></p>
                </div>
                <?php if ($order['customer_address']): ?>
                <div class="sm:col-span-2">
                    <p class="text-gray-500 mb-1">Address</p>
                    <p class="font-semibold"><?= esc($order['customer_address']) ?></p>
                </div>
                <?php endif; ?>
                <?php if ($order['notes']): ?>
                <div class="sm:col-span-2">
                    <p class="text-gray-500 mb-1">Notes</p>
                    <p class="font-semibold"><?= esc($order['notes']) ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
            <div class="p-6 border-b border-gray-100">
                <h3 class="font-bold text-gray-800"><i class="fas fa-list text-maroon mr-2"></i> Order Items</h3>
            </div>
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Product</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Price</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Qty</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($items as $item): ?>
                    <tr class="table-row">
                        <td class="px-6 py-4 font-medium text-sm"><?= esc($item['product_name']) ?></td>
                        <td class="px-6 py-4 text-sm">₹<?= number_format($item['product_price'], 0) ?></td>
                        <td class="px-6 py-4 text-sm"><?= $item['quantity'] ?></td>
                        <td class="px-6 py-4 text-sm font-semibold">₹<?= number_format($item['subtotal'], 0) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50">
                        <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-800">Total</td>
                        <td class="px-6 py-4 font-bold text-maroon text-lg">₹<?= number_format($order['total_amount'], 0) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Sidebar: Status + Timeline + Actions -->
    <div class="space-y-6">
        <!-- Current Status -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100" data-aos="fade-left">
            <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-info-circle text-maroon mr-2"></i> Order Status</h3>
            <div class="text-sm space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-500">Order Number</span>
                    <span class="font-bold text-maroon"><?= esc($order['order_number']) ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Placed On</span>
                    <span class="font-medium"><?= date('d M Y, h:i A', strtotime($order['created_at'])) ?></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Status</span>
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
                    ?>
                    <span class="<?= $color ?> text-xs font-semibold px-3 py-1 rounded-full">
                        <?= ucwords(str_replace('_', ' ', $order['order_status'])) ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Order Timeline -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100" data-aos="fade-left" data-aos-delay="100">
            <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-route text-maroon mr-2"></i> Order Progress</h3>
            <?php
            $timelineSteps = ['pending', 'confirmed', 'preparing', 'ready', 'out_for_delivery', 'delivered'];
            $timelineLabels = ['Order Placed', 'Confirmed', 'Preparing', 'Ready', 'Out for Delivery', 'Delivered'];
            $timelineIcons = ['fa-receipt', 'fa-check', 'fa-fire', 'fa-box', 'fa-truck', 'fa-check-double'];
            $currentIdx = array_search($order['order_status'], $timelineSteps);
            if ($currentIdx === false) $currentIdx = -1;
            ?>
            <div class="space-y-0">
                <?php foreach ($timelineSteps as $i => $step): ?>
                <div class="flex items-start gap-3">
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs flex-shrink-0
                             <?= $i <= $currentIdx ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-400' ?>">
                            <i class="fas <?= $timelineIcons[$i] ?>"></i>
                        </div>
                        <?php if ($i < count($timelineSteps) - 1): ?>
                        <div class="w-0.5 h-6 <?= $i < $currentIdx ? 'bg-green-500' : 'bg-gray-200' ?>"></div>
                        <?php endif; ?>
                    </div>
                    <div class="pt-1">
                        <p class="text-sm font-medium <?= $i <= $currentIdx ? 'text-gray-800' : 'text-gray-400' ?>"><?= $timelineLabels[$i] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Update Status -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100" data-aos="fade-left" data-aos-delay="200">
            <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-edit text-maroon mr-2"></i> Update Status</h3>
            <form action="<?= base_url('admin/orders/update-status/' . $order['id']) ?>" method="POST">
                <?= csrf_field() ?>
                <select name="order_status"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm mb-3 transition-all duration-200">
                    <?php
                    $allStatuses = ['pending', 'confirmed', 'preparing', 'ready', 'out_for_delivery', 'delivered', 'cancelled'];
                    foreach ($allStatuses as $s):
                    ?>
                    <option value="<?= $s ?>" <?= $order['order_status'] === $s ? 'selected' : '' ?>>
                        <?= ucwords(str_replace('_', ' ', $s)) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit"
                        class="w-full bg-gradient-to-r from-maroon to-maroon-dark text-white py-2.5 rounded-xl font-semibold text-sm hover:shadow-lg transition-all min-h-[44px]">
                    <i class="fas fa-save mr-1"></i> Update Status
                </button>
            </form>
        </div>

        <!-- Delete -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100" data-aos="fade-left" data-aos-delay="300">
            <h3 class="font-bold text-gray-800 mb-4"><i class="fas fa-trash text-red-500 mr-2"></i> Danger Zone</h3>
            <form action="<?= base_url('admin/orders/delete/' . $order['id']) ?>" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this order?')">
                <?= csrf_field() ?>
                <button type="submit"
                        class="w-full bg-red-500 text-white py-2.5 rounded-xl font-semibold text-sm hover:bg-red-600 transition min-h-[44px]">
                    <i class="fas fa-trash mr-1"></i> Delete Order
                </button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
