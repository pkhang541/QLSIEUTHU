<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
  <div class="card shadow-lg rounded-3">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Thêm Đơn Hàng & Chi Tiết</h4>
    </div>

    <div class="card-body bg-light">
      <form method="POST" id="orderform" action="index.php?controller=order&action=hienthiadd">
        <div class="mb-3">
          <label for="MANV" class="form-label fw-semibold">Nhân viên</label>
          <select id="MANV" name="MANV" class="form-select" required>
            <option value="" selected disabled>-- Chọn nhân viên --</option>
            <?php foreach ($employees as $emp): ?>
              <option value="<?= $emp->manv ?>">
                <?= $emp->manv . " - " . htmlspecialchars($emp->hotennv) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="MAKH" class="form-label fw-semibold">Khách hàng</label>
          <select id="MAKH" name="MAKH" class="form-select" required>
            <option value="" selected disabled>-- Chọn khách hàng --</option>
            <?php foreach ($customers as $cus): ?>
              <option value="<?= $cus->makh ?>">
                <?= $cus->makh . " - " . htmlspecialchars($cus->tenkh) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label for="NGAYLAP" class="form-label fw-semibold">Ngày lập</label>
          <input type="datetime-local" id="NGAYLAP" name="NGAYLAP" class="form-control"
                 value="<?= date('Y-m-d\TH:i') ?>" required>
        </div>

        <div class="mb-3">
          <label for="TRANGTHAI" class="form-label fw-semibold">Trạng thái</label>
          <select id="TRANGTHAI" name="TRANGTHAI" class="form-select" required>
            <option value="" selected disabled>-- Chọn trạng thái --</option>
            <option value="đã hủy">đã hủy</option>
            <option value="Hoàn thành">Hoàn thành</option>
          </select>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
          <a href="index.php?controller=order&action=hienthiorder" class="btn btn-secondary px-4">
            ⬅ Quay lại
          </a>
          <button type="button" id="ktluu" name="save" class="btn btn-success px-4" onclick="kiemtraDH()">
            Lưu đơn hàng
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

