<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container mt-4">
    <div class="card shadow-lg border-0">
       
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Sửa Đơn Hàng</h4>
        </div>
        <form method="POST" class="p-4 bg-light rounded-bottom">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="manv" class="form-label fw-semibold">Nhân viên:</label>
                    <select id="manv" name="MANV" class="form-select" required>
                        <?php foreach ($employees as $e): ?>
                            <option value="<?= $e->manv ?>" <?= ($e->manv == $order->manv) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($e->hotennv) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="makh" class="form-label fw-semibold">Khách hàng:</label>
                    <select id="makh" name="MAKH" class="form-select" required>
                        <?php foreach ($customers as $c): ?>
                            <option value="<?= $c->makh ?>" <?= ($c->makh == $order->makh) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c->tenkh) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="trangthai" class="form-label fw-semibold">Trạng thái:</label>
                    <select id="trangthai" name="TRANGTHAI" class="form-select" required>
                        <?php 
                        $states = ['hoàn thành', 'đã hủy'];
                        foreach ($states as $state): ?>
                            <option value="<?= $state ?>" <?= ($order->trangthai == $state) ? 'selected' : '' ?>>
                                <?= ucfirst($state) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="ngaylap" class="form-label fw-semibold">Ngày lập:</label>
                    <input type="datetime-local" id="ngaylap" name="NGAYLAP" 
                           class="form-control" 
                           value="<?= date('Y-m-d\TH:i', strtotime($order->ngaylap)) ?>" required>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="index.php?controller=order&action=hienthiorder"class="btn btn-secondary">← Quay lại</a>
                <button type="submit" class="btn btn-success">💾 Cập nhật</button>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger mt-3 mb-0" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success mt-3 mb-0" role="alert">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>
