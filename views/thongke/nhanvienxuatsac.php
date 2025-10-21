  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
  <div class="container my-5">
    <h2 class="text-center text-success mb-4 fw-bold">Thống Kê Nhân Viên Xuất Sắc</h2>


    <!-- Nhân viên bán hàng xuất sắc -->
    <?php if (!empty($topEmployees)): 
        $topEmployee = $topEmployees[0]; ?>
        <div class="my-4 p-3 border rounded bg-success text-white text-center">
          <h4>Nhân viên bán hàng xuất sắc</h4>
          <h3><?= htmlspecialchars($topEmployee['HOTENNV']) ?></h3>
          <p>Tổng số sản phẩm bán: <?= $topEmployee['tongban'] ?></p>
        </div>
    <?php endif; ?>
  </body>
  </html>
