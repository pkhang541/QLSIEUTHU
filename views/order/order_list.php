<h2 class="mb-4">Danh sách đơn hàng</h2>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <form method="GET" action="index.php" class="row mb-4">
    <input type="hidden" name="controller" value="order">
    <input type="hidden" name="action" value="tim">
    <div class="col-auto">
      <input type="text" name="ID" class="form-control" placeholder="Nhập ID " required>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary">Tìm</button>
    </div>
  </form>
<div class="mb-3">
    <a href="index.php?controller=order&action=hienthiadd" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Thêm đơn hàng
    </a>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID Đơn</th>
                <th>Nhân viên</th>
                <th>Khách hàng</th>
                <th>Trạng thái</th>
                <th>Ngày lập</th>
                <th>Sản phẩm</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dsorder)): ?>
                <?php foreach ($dsorder as $o): ?>
                    <tr>
                        <td><?= $o->iddonhang ?></td>
                        <td><?= $o->hotennv ?></td>
                        <td><?= $o->tenkh ?></td>
                        <td>
                            <span class="badge <?= $o->trangthai == 'Hoàn thành' ? 'bg-success' : 'bg-warning' ?>">
                                <?= $o->trangthai ?>
                            </span>
                        </td>
                        <td><?= $o->ngaylap ?></td>
                        <td><?= $o->tensp_list ?></td>
                        <td>
                            <a href="index.php?controller=order&action=hienthiedit&id=<?= $o->iddonhang ?>" class="btn btn-sm btn-info">Sửa</a>
                            <a href="index.php?controller=order&action=hienthixoa&id=<?= $o->iddonhang ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Xóa đơn hàng?')">Xóa</a>
                            <a href="index.php?controller=order&action=hienthiOrderDetails&id=<?= $o->iddonhang ?>" 
                               class="btn btn-sm btn-secondary">Chi tiết</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Không có đơn hàng nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
