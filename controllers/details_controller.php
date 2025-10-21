<?php
require_once "models/details.php";
require_once "models/product.php";
require_once "models/order.php";
require_once "base_controller.php";

class DetailsController extends Basecontroller
{
    function __construct()
    {
        $this->folder = 'details'; // tách riêng view cho chi tiết
    }

    // Hiển thị chi tiết của 1 đơn hàng
    public function hienthidetails()
    {
        $iddonhang = $_GET['iddonhang'] ?? null;
        if (!$iddonhang) {
            $this->error();
            return;
        }

        $details = OrderDetail::getByOrderId($iddonhang);
        $products = Product::getAllProduct();

        // Map mã sp => tên sp
        $productMap = [];
        foreach ($products as $p) {
            $productMap[$p->masp] = $p->tensp;
        }

        foreach ($details as $d) {
            $d->tensp = $productMap[$d->masp] ?? 'Không rõ';
        }

        $this->render('order_details', [
            'iddonhang' => $iddonhang,
            'details'   => $details
        ]);
    }

public function add()
{
    // Nhận ID đơn hàng từ GET (khi vừa thêm xong) hoặc từ POST (khi submit form chi tiết)
    $iddonhang = $_POST['IDDONHANG'] ?? ($_GET['order_id'] ?? null);
    $products  = Product::getAllProduct();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productList = $_POST['PRODUCTS'] ?? [];

        if ($iddonhang && !empty($productList)) {
            foreach ($productList as $prod) {
                $masp    = $prod['ID'] ?? '';
                $soluong = $prod['SOLUONG'] ?? 0;
                $dongia  = $prod['GIABAN'] ?? 0;
                $ghichu  = $prod['GHICHU'] ?? null;

                if ($masp && $soluong > 0 && $dongia > 0) {
                    $detail = new OrderDetail($iddonhang, $masp, $soluong, $dongia, $ghichu);
                    $detail->insert();
                }
            }

            // Sau khi lưu chi tiết xong → quay về danh sách đơn hàng
            header("Location: index.php?controller=order&action=hienthiorder");
            exit;
        } else {
            $error = "Vui lòng nhập ít nhất một sản phẩm hợp lệ.";
        }
    }

    $this->render('order_detail_add', [
        'iddonhang' => $iddonhang,
        'products'  => $products,
        'error'     => $error ?? null
    ]);
}

    // Sửa chi tiết
   public function edit()
{
    $iddonhang = $_GET['iddonhang'] ?? null;
    $old_masp = $_GET['masp'] ?? null;

    if (!$iddonhang || !$old_masp) {
        $this->error();
        return;
    }

    $detail = OrderDetail::getOne($iddonhang, $old_masp);
    $products = Product::getAllProduct();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_masp = $_POST['MASP'] ?? $old_masp;
        $soluong = $_POST['SOLUONG'] ?? $detail->soluongban;
        $dongia = $_POST['DONGIA'] ?? $detail->giaban;
        $ghichu = $_POST['GHICHU'] ?? $detail->ghichu;

        // Nếu đổi mã sản phẩm, phải xóa chi tiết cũ và thêm mới
        if ($new_masp != $old_masp) {
            // Xóa chi tiết cũ
            OrderDetail::deleteOne($iddonhang, $old_masp);

            // Thêm chi tiết mới với mã sản phẩm mới
            $newDetail = new OrderDetail($iddonhang, $new_masp, $soluong, $dongia, $ghichu);
            $newDetail->insert();
        } else {
            // Cập nhật chi tiết theo mã sản phẩm cũ
            OrderDetail::updateByOrderAndProduct($iddonhang, $old_masp, $soluong, $dongia, $ghichu);
        }

        // Chuyển hướng về trang hiển thị chi tiết đơn hàng
        header("Location: index.php?controller=details&action=hienthidetails&iddonhang=$iddonhang");
        exit;
    }

    $this->render('order_details_edit', [
        'iddonhang' => $iddonhang,
        'detail' => $detail,
        'products' => $products
    ]);
}


    // Xóa chi tiết
    public function delete()
    {
        $iddonhang = $_GET['iddonhang'] ?? null;
        $masp      = $_GET['masp'] ?? null;

        if ($iddonhang && $masp) {
            OrderDetail::deleteOne($iddonhang, $masp);
            header("Location: index.php?controller=details&action=hienthidetails&iddonhang=$iddonhang");
            exit;
        }

        $this->error();
    }

    public function error()
    {
        $this->render('baoloi');
    }
}
?>
