<h2 class="mb-4">Danh sách đơn hàng</h2>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </script>

<div class="mb-3">
    <a href="index.php?controller=order&action=hienthiadd" class="btn btn-success">
        <i class="bi bi-plus-lg"></i> Thêm đơn hàng
    </a>
</div>
<form method="GET" action="index.php" class="mb-3">
  <input type="hidden" name="controller" value="order">
  <input type="hidden" name="action" value="tim">

  <div class="input-group d-flex align-items-center" style="max-width: 500px;">
    <select name="type" class="form-select rounded-pill me-2" style="max-width: 160px; height: 38px;">
      <option value="id" <?= (isset($_GET['type']) && $_GET['type'] == 'id') ? 'selected' : '' ?>>Mã đơn</option>
      <option value="nhanvien" <?= (isset($_GET['type']) && $_GET['type'] == 'nhanvien') ? 'selected' : '' ?>>Nhân viên</option>
      <option value="khachhang" <?= (isset($_GET['type']) && $_GET['type'] == 'khachhang') ? 'selected' : '' ?>>Khách hàng</option>
      <option value="trangthai" <?= (isset($_GET['type']) && $_GET['type'] == 'trangthai') ? 'selected' : '' ?>>Trạng thái</option>
      <option value="ngaylap" <?= (isset($_GET['type']) && $_GET['type'] == 'ngaylap') ? 'selected' : '' ?>>Ngày lập</option>
    </select>

    <input type="text" name="keyword" class="form-control rounded-pill me-2"
           placeholder="Nhập nội dung tìm kiếm"
           style="height: 38px;"
           value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">

    <button class="btn btn-primary rounded-pill me-2 px-3" type="submit">Tìm</button>
    <a href="index.php?controller=order&action=hienthiorder" class="btn btn-secondary rounded-pill px-3">Tất cả</a>
  </div>
</form>


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
                            <span class="badge <?= strtolower($o->trangthai) == 'đã hủy' ? 'bg-warning' : 'bg-success' ?>">
                             <?= htmlspecialchars($o->trangthai) ?>
                            </span>


                        </td>
                        <td><?= $o->ngaylap ?></td>
                        <td><?= $o->tensp_list ?></td>
                        <td>
                            <a href="index.php?controller=order&action=hienthiedit&id=<?= $o->iddonhang ?>" class="btn btn-sm btn-info">Sửa</a>
                            <a href="index.php?controller=order&action=xoa&id=<?= $o->iddonhang ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Xóa đơn hàng?')">Xóa</a>
                           <a href="index.php?controller=details&action=hienthidetails&iddonhang=<?= $o->iddonhang ?>" 
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
