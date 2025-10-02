    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <title>Siêu Thị Mini</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

         <style>
    body {
      background: #f8f9fa;
      font-family: "Segoe UI", sans-serif;
    }

    /* Banner */
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
    }

    .banner-container:hover .banner-overlay {
      opacity: 1;
    }

    .banner-overlay h2 {
      font-size: 2rem;
      font-weight: bold;
    }

    .banner-overlay p {
      font-size: 1.1rem;
      margin-top: 10px;
    }

    /* Card sản phẩm */
    .product-card {
      background: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      position: relative;
    }

    .product-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .product-card img {
      width: 100%;
      height: 220px;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .product-card:hover img {
      transform: scale(1.08);
    }

    /* Overlay chữ khi hover */
    .overlay-text {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.55);
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      font-weight: 600;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .product-card:hover .overlay-text {
      opacity: 1;
    }
    .product-card .card-body {
      padding: 16px;
    }

    .product-card h5 {
      font-size: 1rem;
      font-weight: 600;
      color: #333;
      margin-bottom: 6px;
    }

    .product-card p {
      font-size: 0.9rem;
      color: #666;
      margin-bottom: 8px;
    }
    .btn-primary {
      border-radius: 8px;
      font-weight: 500;
      padding: 6px 14px;
      background: #007bff;
      border: none;
      transition: all 0.2s ease;
    }

    .btn-primary:hover {
      background: #0056b3;
      transform: scale(1.05);
    }
  </style>
<script type="text/javascript">
function kiemtraluu() { 
  var productForm = document.getElementById("productForm");
  var tensp = document.getElementById("tensp");
  var hansudung = document.getElementById("hansudung");
  var mota = document.getElementById("mota");
  var hinhanh = document.getElementById("hinhanh");
  var quycach = document.getElementById("quycach");
  var dvt = document.getElementById("dvt");
  if (
    tensp.value.trim() === "" ||
    hansudung.value.trim() === "" ||
    mota.value.trim() === "" ||
    hinhanh.files.length === 0 ||
    quycach.value.trim() === "" ||
    dvt.value.trim() === ""
  ) {
    alert("Vui lòng điền đầy đủ thông tin.");
    return false;
  }
  if (tensp.value.trim().length > 50) {
    alert("Tên sản phẩm không được vượt quá 50 ký tự.");
    tensp.focus();
    return false;
  }
  if(mota . value.trim().length > 255) {
    alert("Mô tả không được vượt quá 255 ký tự.");
    mota.focus();
    return false;
  }
  productForm.submit();
  
}
function kiemtraeditluu() { 
  var productForm = document.getElementById("productForm");
  var tensp = document.getElementById("tensp");
  var hansudung = document.getElementById("hansudung");
  var mota = document.getElementById("mota");
  var hinhanh = document.getElementById("hinhanh");
  var quycach = document.getElementById("quycach");
  var dvt = document.getElementById("dvt");
  if (
    tensp.value.trim() === "" ||
    hansudung.value.trim() === "" ||
    mota.value.trim() === "" ||
    //hinhanh.files.length === 0 ||
    quycach.value.trim() === "" ||
    dvt.value.trim() === ""
  ) {
    alert("Vui lòng điền đầy đủ thông tin.");
    return false;
  }
  if (tensp.value.trim().length > 50) {
    alert("Tên sản phẩm không được vượt quá 50 ký tự.");
    tensp.focus();
    return false;
  }
  productForm.submit();
  
}


function uploadhinh() {
  const fileInput = document.getElementById("hinhanh");
  const file = fileInput.files[0];

  if (!file) {
    document.getElementById("preview-img").style.display = "none";
    return;
  }

  const reader = new FileReader();

  reader.onload = function(e) {
    const previewImg = document.getElementById("preview-img");
    previewImg.src = e.target.result;
    previewImg.style.display = "block";
  };

  reader.readAsDataURL(file);
}

function kiemtraDH() {
    // Lấy form (nếu form không có id, lấy form đầu tiên trên trang)
    var orderform = document.getElementById('orderform');

    var manv = document.getElementById('MANV').value.trim();
    var makh = document.getElementById('MAKH').value.trim();
    var ngaylap = document.getElementById('NGAYLAP').value.trim();
    var trangthai = document.getElementById('TRANGTHAI').value.trim();

    if (manv === "") {
        alert("Vui lòng chọn nhân viên!");
        return false;
    }
    if (makh === "") {
        alert("Vui lòng chọn khách hàng!");
        return false;
    }
    if (ngaylap === "") {
        alert("Vui lòng nhập ngày lập!");
        return false;
    }
    if (trangthai === "") {
        alert("Vui lòng chọn trạng thái!");
        return false;
    }

    var ngaydatDate = new Date(ngaydat);
    var ngaylapDate = new Date(ngaylap);

    if (ngaylapDate > ngaydatDate) {
        alert("Ngày lập phải lớn hơn hoặc bằng ngày đặt!");
        return false;
    }

    orderform.submit();
  }
function kiemtraNV() {
    var form  = document.getElementById('employeeform');
    var hoten = document.getElementById('HOTENNV');
    var email = document.getElementById('EMAIL');
    var sdt   = document.getElementById('SDT');

    if (hoten.value.trim() === "") {
        alert("Vui lòng nhập họ tên nhân viên!");
        hoten.focus();
        return;
    }
    if (email.value.trim() === "") {
        alert("Vui lòng nhập email!");
        email.focus();
        return;
    }
    if (sdt.value.trim() === "") {
        alert("Vui lòng nhập số điện thoại!");
        sdt.focus();
        return;
    }

    // ✅ nếu hợp lệ thì submit
    form.submit();
}
function kiemtraKH() {
    var form  = document.getElementById('customerform');
    var tenkh = document.getElementById('TENKH');
    var diachi = document.getElementById('DC');
    var sdt   = document.getElementById('SDT');

    if (tenkh.value.trim() === "") {
        alert("Vui lòng nhập tên khách hàng!");
        tenkh.focus();
        return;
    }
    if (diachi.value.trim() === "") {
        alert("Vui lòng nhập địa chỉ!");
        diachi.focus();
        return;
    }
    if (sdt.value.trim() === "") {
        alert("Vui lòng nhập số điện thoại!");
        sdt.focus();
        return;
    }

    // ✅ Kiểm tra SDT: chỉ cho phép số, từ 9-11 số
    var regexSDT = /^[0-9]{9,11}$/;
    if (!regexSDT.test(sdt.value.trim())) {
        alert("Số điện thoại không hợp lệ! (chỉ gồm số, 9-11 ký tự)");
        sdt.focus();
        return;
    }

    // Nếu hợp lệ → submit
    form.submit();
}


</script>
    </head>
    <body>
