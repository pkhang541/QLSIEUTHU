<?php
require_once 'base_controller.php';
require_once 'models/product.php';

class ProductController extends Basecontroller
{
    function __construct()
    {
        $this->folder = 'product';
    }

    public function hienthiproduct()
    {
        $dsproduct = Product::getAllProduct();
        $data = array('dsproduct' => $dsproduct);
        $this->render('product_list', $data);
    }

    public function error()
    {
        $this->render('baoloi');
    }

    public function them()
    {
        $this->render('product_add');
    }

    public function hienthiadd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tensp = $_POST['tensp'];
            $hansudung = $_POST['hansudung'];
            $mota = $_POST['mota'];
            $quycach = $_POST['quycach'];
            $dvt = $_POST['dvt'];

            // Xử lý upload ảnh
            $hinhanh = '';
            if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] === 0) {
                $target_dir = "resources/images/";
                $file_name = basename($_FILES["hinhanh"]["name"]);
                $target_file = $target_dir . time() . "_" . $file_name;

                if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                    $hinhanh = $target_file;
                }
            }

            $result = Product::addProduct($tensp, $hansudung, $mota, $hinhanh, $quycach, $dvt);

            if ($result) {
                header("Location: index.php?controller=product&action=hienthiproduct");
                exit;
            } else {
                $this->render('product_add', ['error' => 'Thêm sản phẩm thất bại!']);
            }
        }
    }

public function hienthiedit()
{
    if (isset($_GET['id'])) {
        $masp = $_GET['id'];
        $product = Product::getProductById($masp);
        if ($product) {
            $data = array('product' => $product);
            $this->render("product_edit", $data);
            return;
        } else {
            echo "Không tìm thấy sản phẩm!";
            return;
        }
    }
    $this->render("product_edit");
}
public function edit()
{
    if (isset($_POST['ID'])) {
        $masp = $_POST['ID'];
        $tensp = $_POST['tensp'];
        $hansudung = $_POST['hansudung'];
        $mota = $_POST['mota'];
        $quycach = $_POST['quycach'];
        $dvt = $_POST['dvt'];

        // Lấy sản phẩm cũ
        $product = Product::getProductById($masp);
        if (!$product) {
            echo "Không tìm thấy sản phẩm để cập nhật!";
            return;
        }

        // Xử lý ảnh
        $hinhanh = $product->hinhanh; // giữ nguyên ảnh cũ

        if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] === 0) {
            $target_dir = "resources/images/";
            $file_name = basename($_FILES["hinhanh"]["name"]);
            $target_file = $target_dir . time() . "_" . $file_name;

            if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
                $hinhanh = $target_file;
            }
        }

        $result = Product::updateProduct($masp, $tensp, $hansudung, $mota, $hinhanh, $quycach, $dvt);

        if ($result) {
            header("Location: index.php?controller=product&action=hienthiproduct");
            exit;
        } else {
            echo "Cập nhật thất bại!";
        }
    } else {
        echo "Thiếu ID sản phẩm!";
    }
}

    // Xóa sản phẩm
    public function xoa()
    {
        if (isset($_GET['id'])) {
            $masp = $_GET['id'];
            $result = Product::deleteProduct($masp);

            if ($result) {
                header("Location: index.php?controller=product&action=hienthiproduct");
                exit;
            } else {
                $this->render('baoloi', ['error' => 'Xóa sản phẩm thất bại!']);
            }
        } else {
            $this->render('baoloi', ['error' => 'Không xác định sản phẩm cần xóa!']);
        }
    }
public function tim()
{ 
    $keyword = $_GET['keyword'] ?? '';
    $type = $_GET['type'] ?? 'ten';

    if (!empty($keyword)) {
        $dsproduct = Product::tim($keyword, $type);

        $this->render('product_list', [
            'dsproduct' => $dsproduct,
        ]);
    } else {
        $this->hienthiproduct();
    }
}
}
?>
