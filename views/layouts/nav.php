  <!DOCTYPE html>
  <html lang="vi">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siêu Thị Xanh</title>

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-success py-3">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="index.php">
        <img src="resources/images/LOGO.jpg" alt="Logo" style="height: 40px; width: auto; margin-right: 10px;">
        Siêu Thị Xanh
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Menu">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">

          <li class="nav-item">
            <a class="nav-link active" href="index.php">Trang chủ</a>
          </li>

        
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="sanphamDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Quản Lý
            </a>
            <ul class="dropdown-menu" aria-labelledby="sanphamDropdown">
              <li><a class="dropdown-item" href="index.php?controller=product&action=hienthiproduct">Danh sách sản phẩm</a></li>
              <li><a class="dropdown-item" href="index.php?controller=customer&action=hienthicustomer">Danh sách khách hàng</a></li>
              <li><a class="dropdown-item" href="index.php?controller=order&action=hienthiorder">Danh sách đơn hàng</a></li>
              <li><a class="dropdown-item" href="index.php?controller=employee&action=hienthiemployee">Danh sách nhân viên</a></li>
              <li><hr class="dropdown-divider"></li>
            </ul>
          </li>

              <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="sanphamDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Thống Kê
            </a>
            <ul class="dropdown-menu" aria-labelledby="sanphamDropdown">
              <li><a class="dropdown-item" href="index.php?controller=thongke&action=thongke">Danh sách sản phẩm bán chạy </a></li>
              <li><a class="dropdown-item" href="index.php?controller=thongke&action=nhanvienxuatsac">Danh sách nhân viên xuất sắc</a></li>
              <li><a class="dropdown-item" href="index.php?controller=thongke&action=khachhangmuanhieu">Danh sách khách hàng mua nhiều</a></li>
              <li><a class="dropdown-item" href="index.php?controller=thongke&action=doanhthutheothang">Doanh thu theo tháng</a></li>
              <li><hr class="dropdown-divider"></li>
            </ul>
          </li>
          
        </ul>
      </div>
    </div>
  </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>
