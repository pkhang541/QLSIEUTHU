<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
  <div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Thêm Khách Hàng Mới</h4>
    </div>

    <div class="card-body bg-light">
      
      <?php if (isset($error)) {
        echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
      } ?>

      <form id="customerform" method="POST" action="index.php?controller=customer&action=hienthiadd">
        <div class="mb-3">
          <label for="TENKH" class="form-label fw-semibold">Tên khách hàng</label>
          <input type="text" id="TENKH" name="TENKH" class="form-control" 
                 value="<?php echo isset($_POST['TENKH']) ? htmlspecialchars($_POST['TENKH']) : ''; ?>">
        </div>

        <div class="mb-3">
          <label for="DC" class="form-label fw-semibold">Địa chỉ</label>
          <input type="text" id="DC" name="DC" class="form-control" 
                 value="<?php echo isset($_POST['DC']) ? htmlspecialchars($_POST['DC']) : ''; ?>">
        </div>

        <div class="mb-3">
          <label for="SDT" class="form-label fw-semibold">Số điện thoại</label>
          <input type="text" id="SDT" name="SDT" class="form-control" 
                 value="<?php echo isset($_POST['SDT']) ? htmlspecialchars($_POST['SDT']) : ''; ?>">
        </div>

        <div class="d-flex justify-content-end gap-2">
          <button type="button" class="btn btn-success px-4" onclick="kiemtraKH()">Thêm khách hàng</button>
          <a href="index.php?controller=customer&action=hienthicustomer" class="btn btn-secondary px-4">Hủy</a>
        </div>
      </form>
    </div>
  </div>
</div>
