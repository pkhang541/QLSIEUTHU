<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
  <div class="card shadow-lg border-0">
    <
    <div class="card-header bg-warning  text-white">
      <h4 class="mb-0">Sửa Sản Phẩm</h4>
    </div>


    <div class="card-body bg-light">
      <form method="POST" action="index.php?controller=product&action=edit" enctype="multipart/form-data" id="productForm" name="productForm">
      
        <input type="hidden" name="ID" value="<?= $product->masp ?>">

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold" for="tensp">Tên sản phẩm</label>
            <input type="text" name="tensp" id="tensp" class="form-control"
                   value="<?= htmlspecialchars($product->tensp) ?>" required>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold" for="hansudung">Hạn sử dụng</label>
            <input type="date" name="hansudung" id="hansudung" class="form-control"
                   value="<?= $product->hansudung ?>" required>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label fw-semibold" for="mota">Mô tả</label>
          <textarea name="mota" id="mota" class="form-control" rows="3" placeholder="Nhập mô tả sản phẩm..."><?= htmlspecialchars($product->mota) ?></textarea>
        </div>

  <div class="mb-3">
  <label class="form-label fw-semibold" for="hinhanh">Hình ảnh</label>
  <input type="file" class="form-control" id="hinhanh" name="hinhanh" accept="image/*" onchange="uploadhinh()">
  
  <div id="preview-container" class="mt-3 text-start">
    <?php if (!empty($product->hinhanh)): ?>
      <img id="preview-img"
           src="<?= htmlspecialchars($product->hinhanh) ?>"
           alt="Ảnh sản phẩm"
           style="max-width: 220px; border: 1px solid #ccc; padding: 4px; border-radius: 6px;">
    <?php else: ?>
      <img id="preview-img"
           src=""
           alt="Ảnh xem trước"
           style="max-width: 220px; display: none; border: 1px solid #ccc; padding: 4px; border-radius: 6px;">
    <?php endif; ?>
  </div>
</div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold" for="quycach">Quy cách</label>
            <input type="text" name="quycach" id="quycach" class="form-control"
                   value="<?= htmlspecialchars($product->quycach) ?>" placeholder="Ví dụ: 500ml, hộp 10 cái...">
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label fw-semibold" for="dvt">Đơn vị tính</label>
            <input type="text" name="dvt" id="dvt" class="form-control"
                   value="<?= htmlspecialchars($product->dvt) ?>" placeholder="Ví dụ: cái, hộp, kg...">
          </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="button" onclick="kiemtraeditluu()" class="btn btn-primary px-4">
            <i class="bi bi-save"></i> Cập nhật
          </button>
          <a href="index.php?controller=product&action=hienthiproduct" class="btn btn-secondary px-4">
            Hủy
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
