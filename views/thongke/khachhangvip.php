  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<div class="container my-5">
  <h2 class="text-center text-primary mb-4 fw-bold">Top Khách Hàng Mua Nhiều Nhất</h2>

  <table class="table table-bordered table-hover">
    <thead class="table-info">
      <tr>
        <th>#</th>
        <th>Tên Khách Hàng</th>
        <th>Tổng Số Lượng Mua</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; foreach ($topCustomers as $customer): ?>
        <tr>
          <td><?= $i++ ?></td>
          <td><?= htmlspecialchars($customer['TENKH']) ?></td>
          <td><?= $customer['tongmua'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
