<div class="container-fluid my-4">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <h3 class="mb-4">Danh sách sản phẩm</h3>
<a href="index.php?controller=product&action=them" class="btn btn-success mb-3">+ Thêm sản phẩm</a>
    
  <form method="GET" action="index.php" class="row mb-4">
    <input type="hidden" name="controller" value="product">
    <input type="hidden" name="action" value="tim">
    <div class="col-auto">
      <input type="text" name="ID" class="form-control" placeholder="Nhập ID sản phẩm" required>
    </div>
    <div class="col-auto">
      <button type="submit" class="btn btn-primary">Tìm</button>
    </div>
  </form>
  
  <table class="table table-bordered table-hover ">
    <thead class="table-secondary">
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
    <?php
    foreach ($dsproduct as $product) {
    ?>
      <tr>
        <td><?php echo $product->masp ?></td>
        <td><?php echo $product->tensp ?></td>
        <td><?php echo $product->hansudung ?></td>
        <td><?php echo $product->mota ?></td>
        <td>
        <?php if (!empty($product->hinhanh)) : ?>
        <img src="<?= $product->hinhanh ?>" alt="Ảnh sản phẩm" style="max-width: 100px;">
        <?php else: ?>
        <span>Chưa có ảnh</span>
        <?php endif; ?>
        </td>
        <td><?php echo $product->quycach ?></td>
        <td><?php echo $product->dvt ?></td>
        <td>
         <a href="index.php?controller=product&action=hienthiedit&id=<?php echo $product->masp; ?>" 
        class="btn btn-warning btn-sm">
        <i class="fa-solid fa-pen-to-square me-1"></i> Sửa
        </a>
          <a href="index.php?controller=product&action=xoa&id=<?= $product->masp ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">   <i class="fa-solid fa-trash-can me-1"></i>Xóa</a>
        </td>
      </tr>
    <?php
    } ?>
  </table>
</div>