<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div class="flex items-center gap-3 flex-1">
        <p class="text-gray-500 text-sm"><?= count($products) ?> products</p>
        <div class="relative flex-1 max-w-xs">
            <input type="text" id="productSearch" placeholder="Search products..."
                   class="w-full pl-9 pr-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm transition-all duration-200">
            <i class="fas fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
        </div>
    </div>
    <a href="<?= base_url('admin/products/create') ?>"
       class="bg-gradient-to-r from-maroon to-maroon-dark text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:shadow-lg transition-all min-h-[44px] flex items-center justify-center">
        <i class="fas fa-plus mr-2"></i> Add Product
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" data-aos="fade-up">
    <?php if (empty($products)): ?>
        <div class="p-12 text-center text-gray-400">
            <i class="fas fa-drumstick-bite text-4xl mb-3"></i>
            <p class="font-medium">No products yet</p>
        </div>
    <?php else: ?>
        <!-- Desktop Table -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Product</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Category</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Price</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Unit</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="productsTable">
                    <?php foreach ($products as $product): ?>
                    <tr class="table-row product-row" data-name="<?= esc(strtolower($product['name'])) ?>" data-category="<?= esc(strtolower($product['category'])) ?>">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                                    <?php if ($product['image']): ?>
                                        <img src="<?= base_url('uploads/' . $product['image']) ?>" alt="" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <i class="fas fa-drumstick-bite text-gray-400"></i>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <p class="font-semibold text-sm text-gray-800"><?= esc($product['name']) ?></p>
                                    <p class="text-xs text-gray-500 truncate max-w-[200px]"><?= esc($product['description']) ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600"><?= esc($product['category']) ?></td>
                        <td class="px-6 py-4 text-sm font-semibold">₹<?= number_format($product['price'], 0) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-600"><?= esc($product['unit']) ?></td>
                        <td class="px-6 py-4">
                            <form action="<?= base_url('admin/products/toggle-availability/' . $product['id']) ?>" method="POST" class="inline">
                                <?= csrf_field() ?>
                                <button type="submit" class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors min-h-[44px] min-w-[44px] flex items-center justify-center
                                    <?= $product['is_available'] ? 'bg-green-500' : 'bg-gray-300' ?>">
                                    <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform shadow
                                        <?= $product['is_available'] ? 'translate-x-6' : 'translate-x-1' ?>"></span>
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <a href="<?= base_url('admin/products/edit/' . $product['id']) ?>"
                                   class="text-blue-600 hover:text-blue-800 text-sm min-h-[44px] flex items-center" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?= base_url('admin/products/delete/' . $product['id']) ?>" method="POST" class="inline"
                                      onsubmit="return confirm('Delete this product?')">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm min-h-[44px] flex items-center" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- Mobile Cards -->
        <div class="sm:hidden divide-y divide-gray-100" id="productsMobile">
            <?php foreach ($products as $product): ?>
            <div class="product-row p-4" data-name="<?= esc(strtolower($product['name'])) ?>" data-category="<?= esc(strtolower($product['category'])) ?>">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-14 h-14 bg-gray-100 rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden">
                        <?php if ($product['image']): ?>
                            <img src="<?= base_url('uploads/' . $product['image']) ?>" alt="" class="w-full h-full object-cover">
                        <?php else: ?>
                            <i class="fas fa-drumstick-bite text-gray-400 text-lg"></i>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-sm text-gray-800"><?= esc($product['name']) ?></p>
                        <p class="text-xs text-gray-500"><?= esc($product['category']) ?> &bull; <?= esc($product['unit']) ?></p>
                        <p class="text-sm font-bold text-maroon">₹<?= number_format($product['price'], 0) ?></p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="<?= base_url('admin/products/edit/' . $product['id']) ?>" class="text-blue-600"><i class="fas fa-edit"></i></a>
                        <span class="w-2.5 h-2.5 rounded-full <?= $product['is_available'] ? 'bg-green-500' : 'bg-red-400' ?>"></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
document.getElementById('productSearch')?.addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('.product-row').forEach(row => {
        const name = row.dataset.name || '';
        const cat = row.dataset.category || '';
        row.style.display = (name.includes(q) || cat.includes(q)) ? '' : 'none';
    });
});
</script>

<?= $this->endSection() ?>
