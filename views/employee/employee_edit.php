<div class="container my-4">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <h3>Sửa thông tin nhân viên</h3>

  <?php if (isset($error)) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
  } ?>

  <?php if (isset($employee)) { ?>
    <form method="POST" id="employeeform" action="index.php?controller=employee&action=hienthiedit">
      <!-- Ẩn MANV -->
      <input type="hidden" name="MANV" value="<?php echo htmlspecialchars($employee->manv); ?>">

      <div class="mb-3">
        <label for="HOTENNV" class="form-label">Họ tên nhân viên</label>
        <input type="text" id="HOTENNV" name="HOTENNV" class="form-control" required
               value="<?php echo htmlspecialchars($employee->hotennv); ?>">
      </div>

      <div class="mb-3">
        <label for="EMAIL" class="form-label">Email</label>
        <input type="email" id="EMAIL" name="EMAIL" class="form-control" required
               value="<?php echo htmlspecialchars($employee->email); ?>">
      </div>

      <div class="mb-3">
        <label for="SDT" class="form-label">Số điện thoại</label>
        <input type="text" id="SDT" name="SDT" class="form-control" required
               value="<?php echo htmlspecialchars($employee->sdt); ?>">
      </div>

       <button type="button" class="btn btn-success" onclick="kiemtraNV()">Cập nhật</button>
      <a href="index.php?controller=employee&action=hienthiemployee" class="btn btn-secondary">Hủy</a>
    </form>
  <?php } else { ?>
    <div class="alert alert-warning">Không tìm thấy nhân viên để sửa.</div>
  <?php } ?>
</div>
