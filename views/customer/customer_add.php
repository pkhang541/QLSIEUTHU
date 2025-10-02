<div class="container my-4">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <h3>Thêm khách hàng mới</h3>

  <?php if (isset($error)) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
  } ?>

  <form id="customerform" method="POST" action="index.php?controller=customer&action=hienthiadd">
  
    <div class="mb-3">
      <label for="TENKH" class="form-label">Tên khách hàng</label>
      <input type="text" id="TENKH" name="TENKH" class="form-control" 
             value="<?php echo isset($_POST['TENKH']) ? htmlspecialchars($_POST['TENKH']) : ''; ?>">
    </div>

    <div class="mb-3">
      <label for="DC" class="form-label">Địa chỉ</label>
      <input type="text" id="DC" name="DC" class="form-control" 
             value="<?php echo isset($_POST['DC']) ? htmlspecialchars($_POST['DC']) : ''; ?>">
    </div>

    <div class="mb-3">
      <label for="SDT" class="form-label">Số điện thoại</label>
      <input type="text" id="SDT" name="SDT" class="form-control" 
             value="<?php echo isset($_POST['SDT']) ? htmlspecialchars($_POST['SDT']) : ''; ?>">
    </div>

    <!-- Nút đổi thành button, gọi hàm kiểm tra -->
    <button type="button" class="btn btn-success" onclick="kiemtraKH()">Thêm khách hàng</button>
    <a href="index.php?controller=customer&action=hienthicustomer" class="btn btn-secondary">Hủy</a>
  </form>
</div>
