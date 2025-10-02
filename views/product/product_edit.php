<div class="container my-4">
    <h3 class="mb-4">Sửa sản phẩm</h3>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <form method="POST" action="index.php?controller=product&action=edit" enctype="multipart/form-data" id="productForm" name="productForm">
        <!-- Giữ lại ID sản phẩm -->
        <input type="hidden" name="ID" value="<?= $product->masp ?>">

        <div class="mb-3">
            <label class="form-label" for="tensp">Tên sản phẩm:</label>
            <input type="text" name="tensp" id="tensp" class="form-control" 
                   value="<?= htmlspecialchars($product->tensp) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label" for="hansudung">Hạn sử dụng:</label>
            <input type="date" name="hansudung" id="hansudung" class="form-control" 
                   value="<?= $product->hansudung ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label" for="mota">Mô tả:</label>
            <textarea name="mota" id="mota" class="form-control" rows="3">
                <?= htmlspecialchars($product->mota) ?>
            </textarea>
        </div>

        <div class="mb-3">
            <label class="form-label" for="hinhanh">Hình ảnh:</label>
            <input type="file" class="form-control" id="hinhanh" name="hinhanh" 
                   accept="image/*" onchange="uploadhinh()">

            <div id="preview-container" class="mt-2">
                <?php if (!empty($product->hinhanh)): ?>
                    <img id="preview-img" 
                         src="<?= htmlspecialchars($product->hinhanh) ?>" 
                         alt="Ảnh sản phẩm" 
                         style="max-width: 200px; border: 1px solid #ccc; padding: 4px; border-radius: 6px;">
                <?php else: ?>
                    <img id="preview-img" 
                         src="" 
                         alt="Ảnh xem trước" 
                         style="max-width: 200px; display: none; border: 1px solid #ccc; padding: 4px; border-radius: 6px;">
                <?php endif; ?>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="quycach">Quy cách:</label>
            <input type="text" name="quycach" id="quycach" class="form-control" 
                   value="<?= htmlspecialchars($product->quycach) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label" for="dvt">Đơn vị tính:</label>
            <input type="text" name="dvt" id="dvt" class="form-control" 
                   value="<?= htmlspecialchars($product->dvt) ?>">
        </div>

        <!-- Nút bấm kiểm tra -->
        <button type="button" onclick="kiemtraeditluu()" class="btn btn-primary">Cập nhật</button>
        <a href="index.php?controller=product&action=hienthiproduct" class="btn btn-secondary">Hủy</a>
    </form>
</div>
