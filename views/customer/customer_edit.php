<!-- Bootstrap CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
  <div class="card shadow-lg border-0">
    <div class="card-header bg-warning text-white">
      <h4 class="mb-0">Sửa Thông Tin Khách Hàng</h4>
    </div>

    <div class="card-body bg-light">
      <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" id="customerform" action="index.php?controller=customer&action=sua">
        <!-- Ẩn MAKH -->
        <input type="hidden" name="MAKH" value="<?= isset($customer->makh) ? htmlspecialchars($customer->makh) : '' ?>">

        <div class="mb-3">
          <label for="TENKH" class="form-label fw-semibold">Tên khách hàng</label>
          <input type="text" id="TENKH" name="TENKH" class="form-control" required 
                 value="<?= isset($customer->tenkh) ? htmlspecialchars($customer->tenkh) : '' ?>" 
                 placeholder="Nhập tên khách hàng">
        </div>

        <div class="mb-3">
          <label for="DC" class="form-label fw-semibold">Địa chỉ</label>
          <input type="text" id="DC" name="DC" class="form-control" required 
                 value="<?= isset($customer->diachi) ? htmlspecialchars($customer->diachi) : '' ?>" 
                 placeholder="Nhập địa chỉ">
        </div>

        <div class="mb-3">
          <label for="SDT" class="form-label fw-semibold">Số điện thoại</label>
          <input type="text" id="SDT" name="SDT" class="form-control" required 
                 value="<?= isset($customer->sdt) ? htmlspecialchars($customer->sdt) : '' ?>" 
                 placeholder="Nhập số điện thoại">
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
          <button type="button" class="btn btn-success px-4" onclick="kiemtraKH()">
            <i class="bi bi-pencil-square"></i> Cập nhật
          </button>
          <a href="index.php?controller=customer&action=hienthicustomer" class="btn btn-secondary px-4">
            Hủy
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
