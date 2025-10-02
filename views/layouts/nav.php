  <!DOCTYPE html>
  <html lang="vi">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siêu Thị Xanh</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      /* Navbar */
      .navbar {
        position: relative;
        z-index: 2000; 
      }

      .dropdown-menu {
        z-index: 2001;
      }
      .banner-container {
        position: relative;
        overflow: hidden;
        margin-bottom: 40px;
        border-radius: 12px;
      }

      .banner-img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        border-radius: 12px;
      }

      .banner-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.45);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #fff;
        opacity: 0;
        transition: opacity 0.4s ease;
        border-radius: 12px;
        z-index: 1; /* Thấp hơn navbar */
      }

      .banner-container:hover .banner-overlay {
        opacity: 1;
      }
    </style>
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

          <!-- Dropdown -->
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

          <li class="nav-item">
            <a class="nav-link" href="index.php?controller=thongke&action=thongke">Thông Kê</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="lienhe.php">Liên hệ</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>
