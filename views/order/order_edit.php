<form method="POST" class="p-3 border rounded bg-light">
    <div class="mb-3">
        <label for="manv" class="form-label">Nhân viên:</label>
        <select id="manv" name="MANV" class="form-select" required>
            <?php foreach ($employees as $e): ?>
                <option value="<?= $e->manv ?>" <?= ($e->manv == $order->manv) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($e->hotennv) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="makh" class="form-label">Khách hàng:</label>
        <select id="makh" name="MAKH" class="form-select" required>
            <?php foreach ($customers as $c): ?>
                <option value="<?= $c->makh ?>" <?= ($c->makh == $order->makh) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c->tenkh) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="trangthai" class="form-label">Trạng thái:</label>
        <select id="trangthai" name="TRANGTHAI" class="form-select" required>
            <?php 
            $states = ['Còn hàng', 'Hết hàng'];
            foreach ($states as $state): ?>
                <option value="<?= $state ?>" <?= ($order->trangthai == $state) ? 'selected' : '' ?>>
                    <?= $state ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="ngaylap" class="form-label">Ngày lập:</label>
        <input type="datetime-local" id="ngaylap" name="NGAYLAP" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($order->ngaylap)) ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger mt-3" role="alert"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success mt-3" role="alert"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
</form>
