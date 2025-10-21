<div class="container-fluid my-4">
  <h3 class="mb-4">Danh sách khách hàng</h3>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<a href="index.php?controller=customer&action=hienthiadd" class="btn btn-success mb-4">Thêm khách hàng</a>
<form method="GET" action="index.php" class="mb-3">
  <input type="hidden" name="controller" value="customer">
  <input type="hidden" name="action" value="tim">

  <div class="input-group d-flex align-items-center" style="max-width: 480px;">
    <select name="type" class="form-select rounded-pill me-2" style="max-width: 140px; height: 38px;">
      <option value="ma" <?= (isset($_GET['type']) && $_GET['type'] === 'ma') ? 'selected' : '' ?>>Mã KH</option>
      <option value="ten" <?= (!isset($_GET['type']) || $_GET['type'] === 'ten') ? 'selected' : '' ?>>Tên KH</option>
      <option value="diachi" <?= (isset($_GET['type']) && $_GET['type'] == 'diachi') ? 'selected' : '' ?>>Địa chỉ</option>
      <option value="sdt" <?= (isset($_GET['type']) && $_GET['type'] == 'sdt') ? 'selected' : '' ?>>Số ĐT</option>
    </select>

    <input type="text" name="keyword" class="form-control rounded-pill me-2" 
           placeholder="Nhập nội dung tìm kiếm"
           style="height: 38px;"
           value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">

    <button class="btn btn-primary rounded-pill me-2 px-3" type="submit">Tìm</button>
    <a href="index.php?controller=customer&action=hienthicustomer" class="btn btn-secondary rounded-pill px-3">Tất cả</a>
  </div>
</form>

  
  <table class="table table-bordered table-hover">
    <thead class="table-secondary">
      <tr>
        <th>ID</th>
        <th>Tên khách hàng</th>
        <th>Địa chỉ</th>
        <th>SĐT</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($dscustomer)): ?>
        <?php foreach ($dscustomer as $customer): ?>
          <tr>
            <td><?= $customer->makh; ?></td>
            <td><?= $customer->tenkh; ?></td>
            <td><?= $customer->diachi; ?></td>
            <td><?= $customer->sdt; ?></td>
            <td>  
            <a href="index.php?controller=customer&action=sua&MAKH=<?= $customer->makh; ?>" class="btn btn-primary btn-sm">Sửa</a>
            <a href="index.php?controller=customer&action=xoa&MAKH=<?= $customer->makh; ?>" 
            class="btn btn-danger btn-sm"
            onclick="return confirm('Bạn có chắc muốn xóa khách hàng này?');">
            <i class="fa-solid fa-trash-can me-1"></i> Xóa
            </a>
           
          </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="7" class="text-center text-danger fw-bold py-3">Không có khách hàng nào.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>  
