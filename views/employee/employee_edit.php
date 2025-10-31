<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
  <div class="card shadow-lg border-0">
    <div class="card-header bg-warning text-white">
      <h4 class="mb-0">Sửa Thông Tin Nhân Viên</h4>
    </div>

    <div class="card-body bg-light">
      <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <?php if (isset($employee)) : ?>
        <form method="POST" id="employeeform" action="index.php?controller=employee&action=hienthiedit">
          <!-- Ẩn MANV -->
          <input type="hidden" name="MANV" value="<?= htmlspecialchars($employee->manv) ?>">

          <div class="mb-3">
            <label for="HOTENNV" class="form-label fw-semibold">Họ tên nhân viên</label>
            <input type="text" id="HOTENNV" name="HOTENNV" class="form-control" required
                   value="<?= htmlspecialchars($employee->hotennv) ?>" placeholder="Nhập họ tên nhân viên">
          </div>

          <div class="mb-3">
            <label for="EMAIL" class="form-label fw-semibold">Email</label>
            <input type="email" id="EMAIL" name="EMAIL" class="form-control" required
                   value="<?= htmlspecialchars($employee->email) ?>" placeholder="Nhập email">
          </div>

          <div class="mb-3">
            <label for="SDT" class="form-label fw-semibold">Số điện thoại</label>
            <input type="text" id="SDT" name="SDT" class="form-control" required
                   value="<?= htmlspecialchars($employee->sdt) ?>" placeholder="Nhập số điện thoại">
          </div>

          <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="button" class="btn btn-success px-4" onclick="kiemtraNV()">
              <i class="bi bi-pencil-square"></i> Cập nhật
            </button>
            <a href="index.php?controller=employee&action=hienthiemployee" class="btn btn-secondary px-4">
              Hủy
            </a>
          </div>
        </form>
      <?php else : ?>
        <div class="alert alert-warning">Không tìm thấy nhân viên để sửa.</div>
      <?php endif; ?>
    </div>
  </div>
</div>
