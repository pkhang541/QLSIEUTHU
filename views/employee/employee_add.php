  <form id="employeeform" method="POST" 
        action="index.php?controller=employee&action=hienthiadd">

    <div class="mb-3">
      <label for="HOTENNV" class="form-label">Họ tên nhân viên</label>
      <input type="text" id="HOTENNV" name="HOTENNV" class="form-control">
    </div>

    <div class="mb-3">
      <label for="EMAIL" class="form-label">Email</label>
      <input type="email" id="EMAIL" name="EMAIL" class="form-control">
    </div>

    <div class="mb-3">
      <label for="SDT" class="form-label">Số điện thoại</label>
      <input type="text" id="SDT" name="SDT" class="form-control">
    </div>

    <!-- Nút gọi hàm kiểm tra -->
    <button type="button" class="btn btn-success" onclick="kiemtraNV()">Thêm nhân viên</button>
    <a href="index.php?controller=employee&action=hienthiemployee" class="btn btn-secondary">Hủy</a>
  </form>
</div>