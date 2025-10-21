  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-4">
  <h3>Sửa thông tin khách hàng</h3>

  <?php if (isset($error)) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
  } ?>

  <form method="POST" id="customerform" action="index.php?controller=customer&action=sua">
    <input type="hidden" name="MAKH" value="<?php echo isset($customer->makh) ? $customer->makh : ''; ?>">

    <div class="mb-3">
      <label for="TENKH" class="form-label">Tên khách hàng</label>
      <input type="text" id="TENKH" name="TENKH" class="form-control" required value="<?php echo isset($customer->tenkh) ? htmlspecialchars($customer->tenkh) : ''; ?>">
    </div>


    <div class="mb-3">
      <label for="DC" class="form-label">Địa chỉ</label>
      <input type="text" id="DC" name="DC" class="form-control" required value="<?php echo isset($customer->diachi) ? htmlspecialchars($customer->diachi) : ''; ?>">
    </div>

    <div class="mb-3">
      <label for="SDT" class="form-label">Số điện thoại</label>
      <input type="text" id="SDT" name="SDT" class="form-control" required value="<?php echo isset($customer->sdt) ? htmlspecialchars($customer->sdt) : ''; ?>">
    </div>

    <button type="button" class="btn btn-success" onclick="kiemtraKH()">Cập nhật</button>
    <a href="index.php?controller=customer&action=hienthicustomer" class="btn btn-secondary">Hủy</a>
  </form>
</div>
