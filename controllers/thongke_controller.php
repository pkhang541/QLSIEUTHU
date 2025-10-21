<?php
require_once 'base_controller.php';
require_once 'models/thongke.php';
class ThongkeController extends BaseController {
    function __construct() {
        $this->folder = 'thongke'; // trỏ tới thư mục view
    }

    public function thongke()
{
         $totalProducts = Thongke::countAll();

    // Lấy danh sách top sản phẩm bán chạy
    // nhớ đặt alias "tongban" trong SQL
    $topProducts = Thongke::getTopSelling();
    // Lấy danh sách nhân viên bán hàng xuất sắc
  
    $data = [
        'totalProducts' => $totalProducts,
        'topProducts' => $topProducts,
    ];

    $this->render('thongke_list', $data);
}
    public function nhanvienxuatsac() {
    $topEmployees = Thongke::getTopSellingEmployee(); // Lấy nhân viên bán tốt nhất
    $data = ['topEmployees' => $topEmployees];
    $this->render('nhanvienxuatsac', $data); // Load file views/thongke/nhanvienxuatsac.php
}
    public function khachhangmuanhieu() {
    $topCustomers = Thongke::getTopCustomers(); // gọi model
    $data = ['topCustomers' => $topCustomers];
    $this->render('khachhangvip', $data); // gọi view
}
     public function doanhthutheothang() {
        $doanhThu = Thongke::getDoanhThuTheoThang();
        $this->render('doanhthu', ['doanhThu' => $doanhThu]);
    }
}
