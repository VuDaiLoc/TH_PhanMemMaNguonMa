<?php include 'app/views/shares/header.php'; ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h4 mb-0"><i class="fas fa-plus-circle me-2"></i>Thêm sản phẩm mới</h2>
                </div>
                
                <div class="card-body">
                    <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Có lỗi xảy ra!</h5>
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="/WEBBANHANG/Product/save" enctype="multipart/form-data" onsubmit="return validateForm();">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name" class="form-control form-control-lg" required>
                            <div class="form-text">Nhập tên sản phẩm (tối đa 255 ký tự)</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Mô tả <span class="text-danger">*</span></label>
                            <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
                            <div class="form-text">Mô tả chi tiết về sản phẩm</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label fw-bold">Giá bán <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" id="price" name="price" class="form-control" step="1000" min="0" required>
                                    <span class="input-group-text">₫</span>
                                </div>
                                <div class="form-text">Giá bán tính theo VND</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label fw-bold">Danh mục <span class="text-danger">*</span></label>
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo $category->id; ?>">
                                            <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="image" class="form-label fw-bold">Hình ảnh sản phẩm</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*">
                            <div class="form-text">Chọn file ảnh (JPG, PNG, GIF - tối đa 2MB)</div>
                            <div class="mt-2" id="imagePreview"></div>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="/WEBBANHANG/Product/list" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Quay lại
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Lưu sản phẩm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Xem trước ảnh khi chọn file
document.getElementById('image').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-thumbnail mt-2';
            img.style.maxHeight = '200px';
            preview.appendChild(img);
        }
        
        reader.readAsDataURL(this.files[0]);
    }
});

// Validate form
function validateForm() {
    const price = document.getElementById('price').value;
    if (price <= 0) {
        alert('Giá sản phẩm phải lớn hơn 0');
        return false;
    }
    return true;
}
</script>

<?php include 'app/views/shares/footer.php'; ?>