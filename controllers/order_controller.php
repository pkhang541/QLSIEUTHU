<?php
require_once 'base_controller.php';
require_once 'models/order.php';
require_once 'models/employee.php';
require_once 'models/customer.php';
require_once 'models/product.php';
require_once 'models/details.php';

class OrderController extends Basecontroller
{
    function __construct()
    {
        $this->folder = 'order';
    }

    public function hienthiorder()
{
    $dsorder = Order::getallorder();

    $employees = Employee::getAllEmployees();
    $employeeMap = [];
    foreach ($employees as $e) {
        $employeeMap[$e->manv] = $e->hotennv;
    }

    $customers = Customer::getAllCustomers();
    $customerMap = [];
    foreach ($customers as $c) {
        $customerMap[$c->makh] = $c->tenkh;
    }

    $products = Product::getAllProduct();
    $productMap = [];
    foreach ($products as $p) {
        $productMap[$p->masp] = $p->tensp;
    }

    foreach ($dsorder as $o) {
        $o->hotennv = $employeeMap[$o->manv] ?? 'Không rõ';
        $o->tenkh = $customerMap[$o->makh] ?? 'Không rõ';

        $details = OrderDetail::getByOrderId($o->iddonhang);

        $tenSpArr = [];
        foreach ($details as $d) {
            $tenSpArr[] = $productMap[$d->masp] ?? 'Không rõ';
        }
        $o->tensp_list = implode(', ', $tenSpArr);
    }

    $this->render('order_list', ['dsorder' => $dsorder]);
}

    public function error()
    {
        $this->render('baoloi');
    }

    public function hienthiadd()
    {
        $employees = Employee::getAllEmployees();
        $customers = Customer::getAllCustomers();
        $products = Product::getAllProduct();

        $selected_product = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['xem_san_pham'])) {
                $masp = $_POST['ID'] ?? '';
                if ($masp) {
                    foreach ($products as $prod) {
                        if ($prod->masp == $masp) {
                            $selected_product = $prod;
                            break;
                        }
                    }
                }
                $this->render('order_add', [
                    'employees' => $employees,
                    'customers' => $customers,
                    'products' => $products,
                    'selected_product' => $selected_product
                ]);
                return;
            }

            $manv      = $_POST['MANV'] ?? '';
            $makh      = $_POST['MAKH'] ?? '';
            $trangthai = $_POST['TRANGTHAI'] ?? '';
            $ngaylap   = date('Y-m-d H:i:s');

            $ngaydat_formatted = date('Y-m-d H:i:s', strtotime($ngaydat));

            if ($manv && $makh && $ngaydat && $trangthai) {
                try {
                    $result = Order::insert($manv, $makh, $ngaydat_formatted, $trangthai, $ngaylap);
                    if ($result) {
                        $lastId = Order::getLastInsertId();
                        header("Location: index.php?controller=order&action=hienthiadddetail&id=" . $lastId);
                        exit;
                    }
                } catch (Exception $e) {
                    $this->render('order_add', [
                        'error' => $e->getMessage(),
                        'employees' => $employees,
                        'customers' => $customers,
                        'products' => $products,
                        'selected_product' => $selected_product
                    ]);
                    return;
                }
            }

            $this->render('order_add', [
                'error' => 'Vui lòng nhập đầy đủ thông tin.',
                'employees' => $employees,
                'customers' => $customers,
                'products' => $products,
                'selected_product' => $selected_product
            ]);
        } else {
            $this->render('order_add', [
                'employees' => $employees,
                'customers' => $customers,
                'products' => $products
            ]);
        }
    }

    public function hienthiadddetail()
    {
        $iddonhang = $_GET['id'] ?? null;

        if (!$iddonhang) {
            header("Location: index.php?controller=order&action=hienthiorder");
            exit;
        }

        $products = Product::getAllProduct();

        $selected_product = $products[0] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $masp    = $_POST['MASP'] ?? '';
            $soluong = $_POST['SOLUONG'] ?? 0;
            $dongia  = $_POST['DONGIA'] ?? 0;
            $ghichu  = $_POST['GHICHU'] ?? null;

            if ($masp && $soluong > 0 && $dongia > 0) {
                $detail = new OrderDetail($iddonhang, $masp, $soluong, $dongia, $ghichu);
                $detail->insert();

                header("Location: index.php?controller=order&action=hienthiorder");
                exit;
            } else {
                $error = "Vui lòng nhập đầy đủ chi tiết đơn hàng.";
            }
        }

        $this->render('order_detail_add', [
            'iddonhang' => $iddonhang,
            'products' => $products,
            'selected_product' => $selected_product,
            'error' => $error ?? null
        ]);
    }
public function updatedetails() {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        header("Location: index.php?controller=order&action=hienthiorder");
        exit;
    }

    if (isset($_POST['saveDetails'])) {
        $details = $_POST['DETAILS'] ?? [];

        // Lấy dữ liệu chi tiết cũ (đã là map [masp => object])
        $oldDetails = OrderDetail::getByOrderId($id);

        foreach ($details as $masp => $d) {
            $selected = isset($d['SELECTED']); // checkbox
            $soluong  = trim($d['SOLUONG'] ?? '');
            $giaban   = trim($d['GIABAN'] ?? '');
            $ghichu   = trim($d['GHICHU'] ?? '');

            if ($selected) {
                // Nếu để trống thì giữ giá trị cũ
                if ($soluong === '' && isset($oldDetails[$masp])) {
                    $soluong = $oldDetails[$masp]->soluongban;
                }
                if ($giaban === '' && isset($oldDetails[$masp])) {
                    $giaban = $oldDetails[$masp]->giaban;
                }
                if ($ghichu === '' && isset($oldDetails[$masp])) {
                    $ghichu = $oldDetails[$masp]->ghichu;
                }

                if (isset($oldDetails[$masp])) {
                    OrderDetail::updateByOrderAndProduct($id, $masp, $soluong, $giaban, $ghichu);
                } else {
                    // insert
                    if ($soluong !== '' && $giaban !== '') {
                        $detail = new OrderDetail($id, $masp, $soluong, $giaban, $ghichu);
                        $detail->insert();
                    }
                }
            }
        }

        header("Location: index.php?controller=order&action=hienthiOrderDetails&id=" . $id);
        exit();
    }
}

public function editdetails() {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        header("Location: index.php?controller=order&action=hienthiorder");
        exit;
    }

    $order = Order::getById($id);
    $products = Product::getAllProduct();
    $orderDetails = OrderDetail::getByOrderId($id); // đã là map

    $this->render('order_details_edit', [
        'order'       => $order,
        'products'    => $products,
        'orderDetails'=> $orderDetails
    ]);
}


  public function hienthiedit() {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        die("Không tìm thấy đơn hàng");
    }

    // Lấy thông tin đơn hàng
    $order = Order::getById($id);
    $employees = Employee::getAllEmployees();
    $customers = Customer::getAllCustomers();
    $products  = Product::getAllProduct();

    // ✅ Lấy danh sách chi tiết sản phẩm trong đơn hàng
    $orderDetails = OrderDetail::getByOrderId($id);
    $currentProducts = [];
    foreach ($orderDetails as $d) {
        $currentProducts[] = $d->masp;
    }

    // Nếu submit form update
 if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateBtn'])) {
    // Giữ lại dữ liệu cũ nếu form không nhập gì
    $manv      = !empty($_POST['MANV']) ? $_POST['MANV'] : $order->manv;
    $makh      = !empty($_POST['MAKH']) ? $_POST['MAKH'] : $order->makh;
    $ngaylap   = !empty($_POST['NGAYLAP']) ? $_POST['NGAYLAP'] : $order->ngaylap;
    $trangthai = !empty($_POST['TRANGTHAI']) ? $_POST['TRANGTHAI'] : $order->trangthai;

    // Nếu không chọn sản phẩm mới thì giữ lại danh sách cũ
    $products_selected = $_POST['PRODUCTS'] ?? $currentProducts;

    if (Order::update($order->iddonhang, $manv, $makh, $trangthai, $ngaylap, $products_selected)) {
        header("Location: index.php?controller=order&action=editdetails&id=" . $order->iddonhang);
        exit;
    } else {
        $error = "Cập nhật thất bại!";
    }
}


    // Render sang view order_edit.php
    $this->render('order_edit', [
        'order'           => $order,
        'employees'       => $employees,
        'customers'       => $customers,
        'products'        => $products,
        'currentProducts' => $currentProducts, // ✅ truyền biến này sang view
        'error'           => $error ?? null
    ]);
}


    public function hienthiOrderDetails() {
        $id = $_GET['id'];
        $details = OrderDetail::getByOrderId($id);

        $products = Product::getAllProduct();
        $productMap = [];
        foreach ($products as $p) {
            $productMap[$p->masp] = $p->tensp;
        }

        foreach ($details as $d) {
            $d->tensp = $productMap[$d->masp] ?? 'Không rõ';
        }

        $orderId = $id;
$data = [
    'details' => $details,
    'orderId' => $id
];
$this->render('order_details', $data);
    }
    public function hienthixoa()
{
    if (!isset($_GET['id'])) {
        $this->render('baoloi', ['error' => 'Thiếu ID đơn hàng']);
        return;
    }

    $id = $_GET['id'];

    try {
        // Xoá chi tiết đơn hàng trước (nếu có ràng buộc khoá ngoại)
        OrderDetail::deleteByOrderId($id);

        // Xoá đơn hàng chính
        $result = Order::delete($id);

        if ($result) {
            header("Location: index.php?controller=order&action=hienthiorder");
            exit;
        } else {
            $this->render('baoloi', ['error' => 'Xóa đơn hàng thất bại!']);
        }
    } catch (Exception $e) {
        $this->render('baoloi', ['error' => $e->getMessage()]);
    }
}
 public function tim()
{
    if (isset($_GET['ID']) && !empty($_GET['ID'])) {
        $id = $_GET['ID'];
        $dsorder = Order::searchById($id);

        if (!empty($dsorder)) {
            $this->render('order_list', ['dsorder' => $dsorder]);
            return;
        }

        // Không tìm thấy
        $this->render('order_list', [
            'dsorder' => [],
            'error'   => 'Không tìm thấy đơn hàng với ID: ' . htmlspecialchars($id)
        ]);
    } else {
        $this->render('order_list', [
            'dsorder' => [],
            'error'   => 'ID đơn hàng không hợp lệ!'
        ]);
    }
}



    
}
?>
