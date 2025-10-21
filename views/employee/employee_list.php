<div class="container mt-4">
    <h2>Danh sách nhân viên</h2>
    <a href="index.php?controller=employee&action=hienthiadd" class="btn btn-success mb-3"> Thêm nhân viên</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <form method="GET" action="index.php" class="mb-3">
  <input type="hidden" name="controller" value="employee">
  <input type="hidden" name="action" value="tim">

  <div class="input-group d-flex align-items-center" style="max-width: 500px;">
    <select name="type" class="form-select rounded-pill me-2" style="max-width: 140px; height: 38px;">
      <option value="ma" <?= (isset($_GET['type']) && $_GET['type'] === 'ma') ? 'selected' : '' ?>>Mã NV</option>
      <option value="ten" <?= (!isset($_GET['type']) || $_GET['type'] === 'ten') ? 'selected' : '' ?>>Tên NV</option>
      <option value="email" <?= (isset($_GET['type']) && $_GET['type'] === 'email') ? 'selected' : '' ?>>Email</option>
      <option value="sdt" <?= (isset($_GET['type']) && $_GET['type'] === 'sdt') ? 'selected' : '' ?>>SĐT</option>
    </select>

    <input type="text" name="keyword" class="form-control rounded-pill me-2"
           placeholder="Nhập nội dung tìm kiếm"
           style="height: 38px;"
           value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">

    <button class="btn btn-primary rounded-pill me-2 px-3" type="submit">Tìm</button>
    <a href="index.php?controller=employee&action=hienthiemployee" class="btn btn-secondary rounded-pill px-3">Tất cả</a>
  </div>
</form>


    <table class="table table-bordered table-hover">
        <thead class="table-secondary">
            <tr>
                <th>Mã NV</th>
                <th>Họ tên</th>             
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($dsemployee)) {
            foreach ($dsemployee as $emp) { ?>
                <tr>
                    <td><?php echo $emp->manv; ?></td>
                    <td><?php echo htmlspecialchars($emp->hotennv); ?></td>
                    <td><?php echo htmlspecialchars($emp->email); ?></td>
                    <td><?php echo htmlspecialchars($emp->sdt); ?></td>
                    <td>  
                    <a href="index.php?controller=employee&action=hienthiedit&MANV=<?= $emp->manv; ?>" class="btn btn-primary btn-sm">Sửa</a>
                    <a href="index.php?controller=employee&action=xoa&MANV=<?= $emp->manv; ?>" 
                    class="btn btn-danger btn-sm" 
                    onclick="return confirm('Bạn có chắc muốn xóa nhân viên này?');">
                    <i class="fa-solid fa-trash-can me-1"></i> Xóa
            </a>            
          </td>
                </tr>
        <?php }
        } else { ?>
            <tr><td colspan="5" class="text-center text-danger fw-bold py-3">Chưa có nhân viên nào</td></tr>
        <?php } ?>
        </tbody>
    </table>
</div>
