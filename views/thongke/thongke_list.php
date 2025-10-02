  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<div class="container my-5">
  <h2 class="text-center text-success mb-4 fw-bold">Thống Kê Sản Phẩm</h2>

  <div class="row text-center mb-5">
    <div class="col-md-4 mx-auto">
      <div class="card shadow-sm p-3">
        <h5 class="fw-bold">Tổng số sản phẩm</h5>
        <p class="fs-3 text-success"><?= $totalProducts ?></p>
      </div>
    </div>
  </div>

  <h4 class="text-success mb-3">Top sản phẩm bán chạy</h4>
  <table class="table table-bordered table-hover">
    <thead class="table-success">
      <tr>
        <th>#</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng bán</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; foreach ($topProducts as $p): ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= htmlspecialchars($p['TENSP']) ?></td>
          <td><?= $p['tongban'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
