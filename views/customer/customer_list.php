<div class="container-fluid my-4">
  <h3 class="mb-4">Danh sách khách hàng</h3>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Form tìm kiếm -->
<form method="GET" action="index.php" class="mb-3">
  <input type="hidden" name="controller" value="customer">
  <input type="hidden" name="action" value="tim">

  <div class="input-group" style="max-width: 400px;">
    <input type="text" name="MAKH" class="form-control" placeholder="Nhập mã hoặc tên khách hàng"
           value="<?= isset($_GET['MAKH']) ? htmlspecialchars($_GET['MAKH']) : '' ?>">
    <button class="btn btn-primary" type="submit">Tìm</button>
  </div>
</form>

  <a href="index.php?controller=customer&action=hienthiadd" class="btn btn-success mb-4">+ Thêm khách hàng</a>

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
          <td colspan="7" class="text-center">Không có khách hàng nào.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
