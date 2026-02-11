<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="mb-6">
    <a href="<?= base_url('admin/products') ?>" class="text-sm text-gray-500 hover:text-maroon transition">
        <i class="fas fa-arrow-left mr-1"></i> Back to Products
    </a>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
        <ul class="list-disc list-inside">
            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                <li><?= esc($err) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="max-w-2xl" data-aos="fade-up">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <form action="<?= base_url('admin/products/update/' . $product['id']) ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                    <input type="text" name="name" value="<?= old('name') ?: esc($product['name']) ?>" required
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm transition-all duration-200">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                        <input type="text" name="category" value="<?= old('category') ?: esc($product['category']) ?>" required list="categories"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm transition-all duration-200">
                        <datalist id="categories">
                            <option value="Fresh Chicken">
                            <option value="Boneless">
                            <option value="Marinated">
                            <option value="Kebabs & Seekh">
                            <option value="Wings & Drumsticks">
                            <option value="Ready to Cook">
                        </datalist>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Unit *</label>
                        <input type="text" name="unit" value="<?= old('unit') ?: esc($product['unit']) ?>" required
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm transition-all duration-200">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price (₹) *</label>
                    <input type="number" name="price" value="<?= old('price') ?: $product['price'] ?>" required step="0.01" min="1"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm transition-all duration-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" rows="3" id="descField" maxlength="500"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:outline-none focus:border-maroon focus:ring-3 focus:ring-maroon/20 text-sm transition-all duration-200"><?= old('description') ?: esc($product['description']) ?></textarea>
                    <p class="text-xs text-gray-400 mt-1 text-right"><span id="charCount">0</span>/500</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                    <?php if ($product['image']): ?>
                        <div class="mb-3 relative inline-block group">
                            <img src="<?= base_url('uploads/' . $product['image']) ?>" alt="" class="w-24 h-24 object-cover rounded-xl border" id="currentImage">
                            <div class="absolute inset-0 bg-black/40 rounded-xl opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <span class="text-white text-xs font-semibold">Change</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- Upload Zone -->
                    <label class="block border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-maroon hover:bg-maroon/5 transition-all duration-200" id="dropZone">
                        <div id="uploadPlaceholder">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <p class="text-sm text-gray-500 font-medium">Click to upload new image</p>
                            <p class="text-xs text-gray-400 mt-1">Leave empty to keep current image</p>
                        </div>
                        <img id="imagePreview" class="mx-auto max-h-40 rounded-xl hidden" alt="Preview">
                        <input type="file" name="image" accept="image/*" class="hidden" id="imageInput" onchange="previewImage(this)">
                    </label>
                </div>

                <div>
                    <label class="flex items-center space-x-3 cursor-pointer min-h-[44px]">
                        <input type="checkbox" name="is_available" value="1"
                               <?= $product['is_available'] ? 'checked' : '' ?>
                               class="w-4 h-4 accent-[#8B0000] rounded">
                        <span class="text-sm font-medium text-gray-700">Available for order</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-100">
                <a href="<?= base_url('admin/products') ?>"
                   class="px-6 py-2.5 border border-gray-200 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 transition min-h-[44px] flex items-center">
                    Cancel
                </a>
                <button type="submit"
                        class="bg-gradient-to-r from-maroon to-maroon-dark text-white px-6 py-2.5 rounded-xl font-semibold text-sm hover:shadow-lg transition-all min-h-[44px]">
                    <i class="fas fa-save mr-1"></i> Update Product
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Image preview
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('uploadPlaceholder');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Character counter
const descField = document.getElementById('descField');
const charCount = document.getElementById('charCount');
if (descField) {
    charCount.textContent = descField.value.length;
    descField.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });
}
</script>

<?= $this->endSection() ?>
