
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
  <div class="card shadow-lg border-0">
  
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Thêm Sản Phẩm</h4>
    </div>

    <div class="card-body bg-light">
      <?php if (!empty($error)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" action="index.php?controller=product&action=hienthiadd" id="productForm" name="productForm" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="tensp" class="form-label fw-semibold">Tên sản phẩm</label>
            <input type="text" class="form-control" id="tensp" name="tensp" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="hansudung" class="form-label fw-semibold">Hạn sử dụng</label>
            <input type="date" class="form-control" id="hansudung" name="hansudung" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="mota" class="form-label fw-semibold">Mô tả</label>
          <textarea class="form-control" id="mota" name="mota" rows="3" placeholder="Nhập mô tả sản phẩm..."></textarea>
        </div>

        <div class="mb-3">
          <label for="hinhanh" class="form-label fw-semibold">Hình ảnh</label>
          <input type="file" class="form-control" id="hinhanh" name="hinhanh" onchange="uploadhinh()" accept="image/*">
          <div id="preview-container" class="mt-3 text-center">
            <img id="preview-img" src="" alt="Ảnh xem trước" 
                 style="max-width: 220px; display: none; border: 1px solid #ccc; padding: 4px; border-radius: 6px;" />
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="quycach" class="form-label fw-semibold">Quy cách</label>
            <input type="text" class="form-control" id="quycach" name="quycach" placeholder="Ví dụ: 500ml / hộp 10 cái...">
          </div>

          <div class="col-md-6 mb-3">
            <label for="dvt" class="form-label fw-semibold">Đơn vị tính</label>
            <input type="text" class="form-control" id="dvt" name="dvt" placeholder="Ví dụ: cái, hộp, kg...">
          </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="button" id="submitBtn" name="submitBtn" onclick="kiemtraluu()" value="Thêm" class="btn btn-success px-4">
            <i class="bi bi-plus-circle"></i> Thêm
          </button>
          <a href="index.php?controller=product&action=hienthiproduct" class="btn btn-secondary px-4">
            Hủy
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
