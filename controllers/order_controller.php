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

    // Hiển thị danh sách đơn hàng
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

        // Map tên vào danh sách đơn hàng
        foreach ($dsorder as $o) {
            $o->hotennv = $employeeMap[$o->manv] ?? 'Không rõ';
            $o->tenkh   = $customerMap[$o->makh] ?? 'Không rõ';
        }

        $this->render('order_list', ['dsorder' => $dsorder]);
    }

    // Trang lỗi
    public function error()
    {
        $this->render('baoloi');
    }

    // Thêm đơn hàng
    public function hienthiadd()
    {
        $employees = Employee::getAllEmployees();
        $customers = Customer::getAllCustomers();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $manv      = $_POST['MANV'] ?? '';
            $makh      = $_POST['MAKH'] ?? '';
            $trangthai = $_POST['TRANGTHAI'] ?? '';
            $ngaylap = $_POST['NGAYLAP'] ?? '';


            if ($manv && $makh && $trangthai) {
                try {
                    // ✅ Thêm đơn hàng
                    $result = Order::insert($manv, $makh, $trangthai, $ngaylap);
                    if ($result) {
                        $lastId = Order::getLastInsertId();

                        // 🚀 Sau khi thêm xong đơn hàng, có thể chuyển sang form thêm chi tiết
                        header("Location: index.php?controller=details&action=add&order_id=" . $lastId);
                        exit;
                    }
                } catch (Exception $e) {
                    $this->render('order_add', [
                        'error'     => $e->getMessage(),
                        'employees' => $employees,
                        'customers' => $customers,
                    ]);
                    return;
                }
            } else {
                $error = "Vui lòng nhập đầy đủ thông tin!";
                $this->render('order_add', compact('employees','customers','error'));
                return;
            }
        }

        // Hiển thị form thêm
        $this->render('order_add', compact('employees','customers'));
    }

public function hienthiedit()
{
    $id = $_GET['id'] ?? null;
    if (!$id) {
        die("Không tìm thấy đơn hàng");
    }

    $order = Order::getById($id);
    if (!$order) {
        die("Không tìm thấy đơn hàng ID = $id");
    }

    $employees = Employee::getAllEmployees();
    $customers = Customer::getAllCustomers();

    $error = null;
    $success = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $manv      = $_POST['MANV'] ?? $order->manv;
        $makh      = $_POST['MAKH'] ?? $order->makh;
        $trangthai = $_POST['TRANGTHAI'] ?? $order->trangthai;

        if (!empty($_POST['NGAYLAP'])) {
            $ngaylap = str_replace('T', ' ', $_POST['NGAYLAP']) . ':00';
        } else {
            $ngaylap = $order->ngaylap;
        }

        if (Order::update($id, $manv, $makh, $trangthai, $ngaylap)) {
            $order = Order::getById($id);
              header("Location: index.php?controller=order&action=hienthiorder");
             exit;
            $success = "Cập nhật thành công!";
        } else {
            $error = "Cập nhật thất bại!";
        }
    }

    $this->render('order_edit', [
        'order'     => $order,
        'employees' => $employees,
        'customers' => $customers,
        'error'     => $error,
        'success'   => $success,
    ]);
}



   public function tim()
{
    $keyword = $_GET['keyword'] ?? '';
    $type = $_GET['type'] ?? 'id';

    if (!empty($keyword)) {
        $dsorder = Order::tim($keyword, $type);
        $this->render('order_list', ['dsorder' => $dsorder]);
    } else {
        $this->hienthiorder();
    }
}

    public function xoa()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("Không tìm thấy ID đơn hàng để xóa");
        }

        if (Order::delete($id)) {
            // Xóa thành công → quay lại danh sách đơn hàng
            header("Location: index.php?controller=order&action=hienthiorder");
            exit();
        } else {
            // Xóa thất bại → hiển thị thông báo lỗi
            $this->render('baoloi', [
                'error' => "Xóa đơn hàng thất bại hoặc đơn hàng không tồn tại!"
            ]);
        }
    }
}
?>
