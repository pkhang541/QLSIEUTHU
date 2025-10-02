<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container mt-5">
    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">➕ Thêm Đơn Hàng</h4>
        </div>
        <div class="card-body">


            <form method="POST" id="orderform" enctype="multipart/form-data" 
                  action="index.php?controller=order&action=hienthiadd">

                <!-- Nhân viên -->
                <div class="mb-3">
                    <label for="MANV" class="form-label fw-semibold">Nhân viên</label>
                    <select id="MANV" name="MANV" class="form-select" required>
                        <option value="" selected disabled>-- Chọn nhân viên --</option>
                        <?php if (!empty($employees)): ?>
                            <?php foreach ($employees as $emp): ?>
                                <option value="<?= $emp->manv ?>">
                                    <?= $emp->manv . " - " . htmlspecialchars($emp->hotennv) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Khách hàng -->
                <div class="mb-3">
                    <label for="MAKH" class="form-label fw-semibold">Khách hàng</label>
                    <select id="MAKH" name="MAKH" class="form-select" required>
                        <option value="" selected disabled>-- Chọn khách hàng --</option>
                        <?php if (!empty($customers)): ?>
                            <?php foreach ($customers as $cus): ?>
                                <option value="<?= $cus->makh ?>">
                                    <?= $cus->makh . " - " . htmlspecialchars($cus->tenkh) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Ngày đặt & Ngày lập -->
               
                    <div class="col-md-6 mb-3">
                        <label for="NGAYLAP" class="form-label fw-semibold">Ngày lập</label>
                        <input type="datetime-local" id="NGAYLAP" name="NGAYLAP" class="form-control" required>
                    </div>
                </div>

                <!-- Trạng thái -->
                <div class="mb-3">
                    <label for="TRANGTHAI" class="form-label fw-semibold">Trạng thái</label>
                    <select id="TRANGTHAI" name="TRANGTHAI" class="form-select" required>
                        <option value="" selected disabled>-- Chọn trạng thái --</option>
                        <option value="Chưa xử lý">Chưa xử lý</option>
                        <option value="Đang xử lý">Đang xử lý</option>
                        <option value="Hoàn thành">Hoàn thành</option>
                        <option value="Đã hủy">Đã hủy</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="index.php?controller=order&action=hienthiorder" class="btn btn-outline-secondary">
                        ⬅ Quay lại
                    </a>
                    <button type="button" id="submitBtn" name="submitBtn" onclick="kiemtraDH()" class="btn btn-success">
                        💾 Lưu đơn hàng
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
