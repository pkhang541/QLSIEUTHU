<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<div class="container my-5">
  <h2 class="text-center text-success mb-4 fw-bold">Top Nhân Viên Bán Hàng Xuất Sắc</h2>

  <table class="table table-bordered table-hover">
    <thead class="table-success">
      <tr>
        <th>#</th>
        <th>Tên Nhân Viên</th>
        <th>Tổng Sản Phẩm Bán</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; foreach ($topEmployees as $employee): ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= htmlspecialchars($employee['HOTENNV']) ?></td>
          <td><?= $employee['tongban'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
