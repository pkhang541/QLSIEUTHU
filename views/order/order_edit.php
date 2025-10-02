<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<div class="container mt-5">
    <div class="card shadow-lg rounded-3">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">✏️ Sửa Đơn Hàng #<?= $order->iddonhang ?></h4>
        </div>
        <div class="card-body">

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" 
                  action="index.php?controller=order&action=hienthiedit&id=<?= $order->iddonhang; ?>">

                <!-- Nhân viên -->
                <div class="mb-3">
                    <label for="MANV" class="form-label fw-semibold">Nhân viên</label>
                    <select id="MANV" name="MANV" class="form-select" required>
                        <option value="" disabled>-- Chọn nhân viên --</option>
                        <?php foreach ($employees as $emp): ?>
                            <option value="<?= $emp->manv ?>"
                                <?= ($order->manv == $emp->manv) ? 'selected' : '' ?>>
                                <?= $emp->manv . " - " . htmlspecialchars($emp->hotennv) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Khách hàng -->
                <div class="mb-3">
                    <label for="MAKH" class="form-label fw-semibold">Khách hàng</label>
                    <select id="MAKH" name="MAKH" class="form-select" required>
                        <option value="" disabled>-- Chọn khách hàng --</option>
                        <?php foreach ($customers as $cus): ?>
                            <option value="<?= $cus->makh ?>"
                                <?= ($order->makh == $cus->makh) ? 'selected' : '' ?>>
                                <?= $cus->makh . " - " . htmlspecialchars($cus->tenkh) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Sản phẩm -->
               <!-- Sản phẩm -->
<div class="mb-3">
    <label class="form-label fw-semibold">Sản phẩm trong đơn</label>
    <div class="row g-2">
        <?php foreach ($products as $p): ?>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="btn-check" 
                           type="checkbox" 
                           id="sp<?= $p->masp ?>"
                           name="PRODUCTS[]" 
                           value="<?= $p->masp ?>"
                           autocomplete="off"
                           <?= in_array($p->masp, $currentProducts ?? []) ? 'checked' : '' ?>>
                    <label class="btn btn-outline-primary w-100 text-start" for="sp<?= $p->masp ?>">
                        <?= $p->masp . " - " . htmlspecialchars($p->tensp) ?>
                    </label>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


                <!-- Ngày đặt -->
                

                    <!-- Ngày lập -->
                    <div class="col-md-6 mb-3">
                        <label for="NGAYLAP" class="form-label fw-semibold">Ngày lập</label>
                        <input type="datetime-local" id="NGAYLAP" name="NGAYLAP" class="form-control"
                               value="<?= date('Y-m-d\TH:i', strtotime($order->ngaylap)) ?>" required>
                    </div>
                </div>

                <!-- Trạng thái -->
                <div class="mb-3">
                    <label for="TRANGTHAI" class="form-label fw-semibold">Trạng thái</label>
                    <select id="TRANGTHAI" name="TRANGTHAI" class="form-select" required>
                        <option value="" disabled>-- Chọn trạng thái --</option>
                        <?php
                        $statuses = ["Chưa xử lý", "Đang xử lý", "Hoàn thành", "Đã hủy"];
                        foreach ($statuses as $st): ?>
                            <option value="<?= $st ?>"
                                <?= ($order->trangthai == $st) ? 'selected' : '' ?>>
                                <?= $st ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="index.php?controller=order&action=hienthiorder" class="btn btn-outline-secondary">
                        ⬅ Quay lại
                    </a>
                    <button type="submit" name="updateBtn" class="btn btn-primary">
                        💾 Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
