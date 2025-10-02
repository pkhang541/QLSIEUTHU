<!-- views/home/trangchu.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SRoyal Ride</title>
  <!-- Bootstrap CSS -->
  <link href="resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #020203;
      color: #fff;
    }
    .header {
      background-color: #121417;
    }
    .logo img {
      width: 60px;
      height: 60px;
      border-radius: 8px;
    }
    .banner-img {
      width: 100%;
      height: 400px;
      object-fit: cover;
    }
    .dropdown-custom {
      position: absolute;
      top: 40px;
      right: 0;
      background-color: #2b2f3a;
      border-radius: 5px;
      padding: 10px;
      min-width: 200px;
      display: none;
      z-index: 10;
    }
    .dropdown-custom a {
      display: block;
      color: #fff;
      text-decoration: none;
      padding: 6px 0;
    }
    .dropdown-custom a:hover {
      text-decoration: underline;
    }
    .icon-group img {
      width: 30px;
      height: 30px;
      filter: brightness(0) invert(1);
      cursor: pointer;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="header py-3">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-3">
        <a href="?controller=home&action=trangchu" class="logo">
          <img src="https://png.pngtree.com/png-clipart/20230507/original/pngtree-save-the-animals-choose-vector-logos-in-black-and-white-png-image_9146944.png" alt="Logo Showroom">
        </a>
        <h1 class="h3 m-0">SRoyal Ride</h1>
      </div>

      <div class="d-flex align-items-center gap-3">
        <!-- Search -->
        <form class="d-flex bg-dark rounded px-2">
          <input class="form-control form-control-sm bg-dark text-white border-0" type="search" placeholder="Tìm xe...">
          <button class="btn btn-primary btn-sm ms-2">Tìm</button>
        </form>

        <!-- Icons -->
        <div class="icon-group position-relative">
          <img src="https://cdn-icons-png.flaticon.com/512/597/597177.png" alt="Phone" id="phoneIcon">
          <div class="dropdown-custom" id="phoneDropdown">
            <a href="tel:0123456789">📞 Gọi: 0123 456 789</a>
          </div>
        </div>

        <div class="icon-group position-relative">
          <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="Map" id="mapIcon">
          <div class="dropdown-custom" id="mapDropdown">
            <a href="https://www.google.com/maps" target="_blank">📍 Xem Google Maps</a>
            <a href="#">Địa chỉ: 123 Nguyễn Huệ, Q1</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Banner -->
  <section>
    <img src="https://thuthuat.vip/wp-content/uploads/2021/04/lamborghini-62.jpg" alt="Banner" class="banner-img">
  </section>

  <!-- Support Section -->
  <section class="py-5 bg-dark">
    <div class="container text-center">
      <h2 class="mb-4">Hỗ trợ từ chúng tôi</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card bg-secondary text-white h-100">
            <div class="card-body">
              <img src="https://cdn-icons-png.flaticon.com/512/1380/1380338.png" class="mb-3" style="width:40px;" alt="FAQ">
              <h5 class="card-title">Câu hỏi thường gặp</h5>
              <p class="card-text">Câu hỏi thường gặp dành cho khách hàng cá nhân</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card bg-secondary text-white h-100">
            <div class="card-body">
              <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" class="mb-3" style="width:40px;" alt="Email">
              <h5 class="card-title">Email cho chúng tôi</h5>
              <p class="card-text">Hãy gửi email cho chúng tôi để nhận phản hồi & tư vấn thắc mắc.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card bg-secondary text-white h-100">
            <div class="card-body">
              <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" class="mb-3" style="width:40px;" alt="Contact">
              <h5 class="card-title">Hướng dẫn liên hệ</h5>
              <p class="card-text">Thông tin liên hệ của Trung tâm Chăm sóc khách hàng</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Script -->
  <script src="resources/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    const phoneIcon = document.getElementById("phoneIcon");
    const phoneDropdown = document.getElementById("phoneDropdown");
    const mapIcon = document.getElementById("mapIcon");
    const mapDropdown = document.getElementById("mapDropdown");

    phoneIcon.addEventListener("click", () => {
      phoneDropdown.style.display = phoneDropdown.style.display === "block" ? "none" : "block";
      mapDropdown.style.display = "none";
    });

    mapIcon.addEventListener("click", () => {
      mapDropdown.style.display = mapDropdown.style.display === "block" ? "none" : "block";
      phoneDropdown.style.display = "none";
    });

    document.addEventListener("click", (e) => {
      if (!e.target.closest(".icon-group")) {
        phoneDropdown.style.display = "none";
        mapDropdown.style.display = "none";
      }
    });
  </script>
</body>
</html>
