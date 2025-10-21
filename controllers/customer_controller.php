<?php
require_once 'base_controller.php';
require_once 'models/customer.php';

class customerController extends Basecontroller
{
    function __construct()
    {
        $this->folder='customer';
    }
    public function hienthicustomer()
    {
        $dscustomer = Customer::getAllCustomers();
        $data = array('dscustomer' => $dscustomer);
        $this->render('customer_list', $data);
    }
    public function error()
    {
        
        $this->render('baoloi');
    }
   public function hienthiadd()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenkh = $_POST['TENKH'] ?? '';
            $diachi = $_POST['DC'] ?? '';
            $sdt = $_POST['SDT'] ?? '';

            $result = Customer::addCustomer($tenkh, $diachi, $sdt);

            if ($result) {
                header("Location: index.php?controller=customer&action=hienthicustomer");
                exit;
            } else {
                $this->render('customer_add', ['error' => 'Thêm khách hàng thất bại!']);
            }
        } else {
            $this->render('customer_add');
        }
    }


    public function sua()
    {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $makh   = $_POST['MAKH'] ?? '';
        $tenkh  = $_POST['TENKH'] ?? '';
        $diachi = $_POST['DC'] ?? '';   
        $sdt    = $_POST['SDT'] ?? '';

        $result = Customer::updateCustomer($makh, $tenkh, $diachi, $sdt);

        if ($result) {
            header("Location: index.php?controller=customer&action=hienthicustomer");
            exit;
        } else {
            $this->render('customer_edit', [
                'error' => 'Cập nhật khách hàng thất bại!',
                'customer' => Customer::getCustomerById($makh)
            ]);
        }
    } else {
        if (isset($_GET['MAKH'])) {
            $makh = $_GET['MAKH'];
            $customer = Customer::getCustomerById($makh);
            $this->render('customer_edit', ['customer' => $customer]);
        }
    }
}

public function tim()
{
    $keyword = $_GET['keyword'] ?? ''; // lấy từ ô nhập
    $type = $_GET['type'] ?? 'ten';    // lấy từ select

    if (!empty($keyword)) {
        $dscustomer = Customer::tim($keyword, $type);
        $data = ['dscustomer' => $dscustomer];
        $this->render('customer_list', $data);
    } else {
        $this->hienthicustomer();
    }
}




    public function xoa()
    {
        if (isset($_GET['MAKH'])) {
            $id = $_GET['MAKH'];
            $result = Customer::deleteCustomer($id);

            if ($result) {
                header("Location: index.php?controller=customer&action=hienthicustomer");
                exit;
            } else {
                $this->render('baoloi', ['error' => 'Xóa khách hàng thất bại!']);
            }
        } else {
            $this->render('baoloi', ['error' => 'ID khách hàng không hợp lệ!']);
        }
    }
}
?>