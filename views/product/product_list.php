<div class="container-fluid my-4">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <h3 class="mb-4">Danh sách sản phẩm</h3>

  <a href="index.php?controller=product&action=them" class="btn btn-success mb-3">+ Thêm sản phẩm</a>

  <form method="GET" action="index.php" class="mb-3">
    <input type="hidden" name="controller" value="product">
    <input type="hidden" name="action" value="tim">

    <div class="input-group" style="max-width: 500px;">
      <select name="type" class="form-select rounded-start-pill" style="max-width: 140px;">
        <option value="id" <?= isset($_GET['type']) && $_GET['type'] == 'id' ? 'selected' : '' ?>>Theo mã</option>
        <option value="ten" <?= isset($_GET['type']) && $_GET['type'] == 'ten' ? 'selected' : '' ?>>Theo tên</option>
      </select>

      <input type="text" name="keyword" class="form-control rounded-pill me-2"
             placeholder="Nhập nội dung tìm kiếm"
             style="height: 38px;"
             value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">

      <button class="btn btn-primary rounded-pill me-2 px-3" type="submit">Tìm</button>
      <a href="index.php?controller=product&action=hienthiproduct" class="btn btn-secondary rounded-pill px-3">Tất cả</a>
    </div>
  </form>

  <?php if (!empty($dsproduct)) : ?>
    <table class="table table-bordered table-hover">
      <thead class="table-dark text-center">
        <tr>
          <th>ID</th> 
          <th>Tên sản phẩm</th> 
          <th>Hạn Sử Dụng</th> 
          <th>Mô Tả</th>
          <th>Hình Ảnh</th>
          <th>Quy Cách</th>
          <th>Đơn Vị Tính</th>
          <th>Thao Tác</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($dsproduct as $product): ?>
          <tr class="align-middle text-center">
            <td><?= htmlspecialchars($product->masp) ?></td>
            <td><?= htmlspecialchars($product->tensp) ?></td>
            <td><?= htmlspecialchars($product->hansudung) ?></td>
            <td><?= htmlspecialchars($product->mota) ?></td>
            <td>
              <?php if (!empty($product->hinhanh)) : ?>
                <img src="<?= htmlspecialchars($product->hinhanh) ?>" alt="Ảnh sản phẩm" style="max-width: 100px;">
              <?php else : ?>
                <span class="text-muted">Chưa có ảnh</span>
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($product->quycach) ?></td>
            <td><?= htmlspecialchars($product->dvt) ?></td>
            <td>
              <a href="index.php?controller=product&action=hienthiedit&id=<?= $product->masp ?>" class="btn btn-warning btn-sm me-1">
                <i class="fa-solid fa-pen-to-square me-1"></i> Sửa
              </a>
              <a href="index.php?controller=product&action=xoa&id=<?= $product->masp ?>" 
                 class="btn btn-danger btn-sm"
                 onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                 <i class="fa-solid fa-trash-can me-1"></i> Xóa
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="text-center text-danger fw-bold py-3">
       Không có sản phẩm nào được tìm thấy!
    </div>
  <?php endif; ?>
</div>
