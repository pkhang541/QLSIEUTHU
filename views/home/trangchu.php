<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Siêu Thị Xanh</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .banner-container {
      position: relative;
      overflow: hidden;
      margin-bottom: 40px;
    }
    .banner-img {
      width: 100%;
      height: 400px;
      object-fit: cover;
    }
    .banner-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.35);
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: #fff;
      opacity: 0;
      transition: opacity 0.4s ease;
    }
    .banner-container:hover .banner-overlay {
      opacity: 1;
    }
    .product-img {
      height: 200px;
      object-fit: cover;
    }
    .card-title {
      font-size: 1.1rem;
      font-weight: bold;
    }
    .card-text {
      font-size: 0.9rem;
    }
    ul.list-unstyled li {
      margin-bottom: 10px;
      font-size: 1rem;
    }
    
  </style>
</head>
<body>

  <div class="container-fluid p-0">
    <div class="banner-container">
      <img src="resources/images/banner.jpg" alt="Banner" class="banner-img" />
      <div class="banner-overlay">
        <div>
          <h1>Chào Mừng Đến Siêu Thị Xanh</h1>
          <p>Trái cây tươi – Giao tận nơi – Giá cực tốt</p>
        </div>
      </div>
    </div>
  </div>
  

<div class="container mb-5">
  <h2 class="text-center text-success mb-4 fw-bold">Sản Phẩm Nổi Bật</h2>
  <div class="row g-4">
    <?php foreach ($featuredProducts as $i => $sp): ?>
      <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="<?= ($i+1) * 100 ?>">
        <div class="card h-100 text-center shadow-sm">
        <img src="<?= !empty($sp['HINHANH']) ? htmlspecialchars($sp['HINHANH']) : 'resources/images/no-image.png' ?>" 
     class="card-img-top product-img" 
     alt="<?= htmlspecialchars($sp['TENSP']) ?>">


          <div class="card-body d-flex flex-column">
            <h5 class="card-title"><?= htmlspecialchars($sp['TENSP']) ?></h5>
            <a href="index.php?controller=product&action=hienthiproduct&id=<?= $sp['ID'] ?>" 
               class="btn btn-success mt-auto">Xem chi tiết</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

 
  <div class="container py-5 bg-light">
    <h2 class="text-center text-success mb-4 fw-bold">Tại Sao Chọn Siêu Thị Xanh</h2>
    <p class="text-center text-muted mb-5">
      Chúng tôi mong muốn trở thành bạn đồng hành đáng tin cậy của mọi gia đình,
      mang đến sản phẩm đa dạng, chất lượng tươi mới với giá cả phải chăng.
    </p>

    <div class="row text-center g-4">
      <div class="col-md-3 col-sm-6" data-aos="fade-right">
        <div class="card border-0 h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title fw-bold">LUÔN TƯƠI MỚI</h5>
            <p class="card-text small text-muted">
              Khu chợ hiện đại gần ngay bạn, cung cấp đa dạng sản phẩm tươi sống với mức giá tốt nhất.
            </p>
          </div>
          <img src="resources/images/anh3.png" class="card-img-bottom img-fluid px-3 pb-3" alt="Tươi mới">
        </div>
      </div>

      <div class="col-md-3 col-sm-6" data-aos="fade-up">
        <div class="card border-0 h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title fw-bold">HÀNG HÓA ĐA DẠNG</h5>
            <p class="card-text small text-muted">
              Địa điểm mua sắm lý tưởng với hàng ngàn sản phẩm nhập khẩu từ mọi nơi trên thế giới.
            </p>
          </div>
          <img src="resources/images/anh4.jpg" class="card-img-bottom img-fluid px-3 pb-3" alt="Hàng hóa đa dạng">
        </div>
      </div>
      <div class="col-md-3 col-sm-6" data-aos="fade-up">
        <div class="card border-0 h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title fw-bold">GIÁ CẢ HỢP LÝ</h5>
            <p class="card-text small text-muted">
              Cam kết sản phẩm chất lượng cao với giá tốt nhất và nhiều khuyến mãi hấp dẫn.
            </p>
          </div>
          <img src="resources/images/anh2.png" class="card-img-bottom img-fluid px-3 pb-3" alt="Giá hợp lý">
        </div>
      </div>

      <div class="col-md-3 col-sm-6" data-aos="fade-left">
        <div class="card border-0 h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title fw-bold">MUA SẮM TIỆN LỢI</h5>
            <p class="card-text small text-muted">
              Mua sắm nhanh chóng và dễ dàng, tiện lợi mọi lúc mọi nơi với ứng dụng trực tuyến và quầy tự động.
            </p>
          </div>
          <img src="resources/images/anh1.png" class="card-img-bottom img-fluid px-3 pb-3" alt="Mua sắm tiện lợi">
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 800,
      once: true
    });
  </script>
</body>
</html>
