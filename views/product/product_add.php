<h3>Thêm Sản Phẩm</h3>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php if (!empty($error)) : ?>
  <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST" action="index.php?controller=product&action=hienthiadd" id ="productForm" name="productForm" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="tensp">Tên sản phẩm</label>
        <input type="text" class="form-control" id="tensp" name="tensp" required>
    </div>
    <div class="mb-3">
        <label for="hansudung">Hạn sử dụng</label>
        <input type="date" class="form-control" id="hansudung" name="hansudung" required>
    </div>
    <div class="mb-3">
        <label for="mota">Mô tả</label>
        <textarea class="form-control" id="mota" name="mota"></textarea>
    </div>
   <div class="mb-3">
  <label for="hinhanh">Hình ảnh</label>
  <input type="file" class="form-control" id="hinhanh" onchange="uploadhinh()" name="hinhanh" accept="image/*">
  <div id="preview-container" class="mt-2">
    <img id="preview-img" src="" alt="Ảnh xem trước" style="max-width: 200px; display: none; border: 1px solid #ccc; padding: 4px; border-radius: 6px;" />
  </div>
</div>

    <div class="mb-3">
        <label for="quycach">Quy cách</label>
        <input type="text" class="form-control" id="quycach" name="quycach">
    </div>
    <div class="mb-3">
        <label for="dvt">Đơn vị tính</label>
        <input type="text" class="form-control" id="dvt" name="dvt">
    </div>
    <button type="button" id="submitBtn" name="submitBtn"  onclick ="kiemtraluu()" value="Thêm" class="btn btn-success">Thêm</button>
    <a href="index.php?controller=product&action=hienthiproduct" class="btn btn-secondary">Hủy</a>
</form>
