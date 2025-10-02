<div class="container mt-4">
    <h2>Danh sách nhân viên</h2>
    <a href="index.php?controller=employee&action=hienthiadd" class="btn btn-success mb-3">+ Thêm nhân viên</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <form method="POST" action="index.php?controller=employee&action=tim" class="row mb-4">
  <div class="col-auto">
    <input 
      type="text" 
      id="id" 
      name="id" 
      class="form-control" 
      placeholder="Nhập ID, tên">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary">Tìm</button>
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
            <tr><td colspan="5" class="text-center">Chưa có nhân viên nào</td></tr>
        <?php } ?>
        </tbody>
    </table>
</div>
