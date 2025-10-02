<?php
require_once 'models/product.php';

require_once 'base_controller.php';
class ThongkeController extends BaseController {
    function __construct() {
        $this->folder = 'thongke'; // trỏ tới thư mục view
    }

    public function thongke() {
         $totalProducts = Product::countAll();

    // Lấy danh sách top sản phẩm bán chạy
    // nhớ đặt alias "tongban" trong SQL
    $topProducts = Product::getTopSelling();

    $data = [
        'totalProducts' => $totalProducts,
        'topProducts' => $topProducts
    ];

    $this->render('thongke_list', $data);
    }
}
