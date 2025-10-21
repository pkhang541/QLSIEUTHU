<?php
require_once 'models/employee.php';
require_once 'base_controller.php';

class EmployeeController extends Basecontroller {
    function __construct()
    {
        $this->folder = 'employee';
    }

    public function hienthiemployee()
    {
        $dsemployee = Employee::getAllEmployees();
        $data = array('dsemployee' => $dsemployee);
        $this->render('employee_list', $data);
    }
    public function hienthiadd()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['HOTENNV'], $_POST['EMAIL'], $_POST['SDT'])) {
            Employee::insert($_POST['HOTENNV'], $_POST['EMAIL'], $_POST['SDT']);
        }
        header("Location: index.php?controller=employee&action=hienthiemployee");
        exit;
    } else {
        $this->render('employee_add');
    }
}
     public function hienthiedit() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['MANV'], $_POST['HOTENNV'], $_POST['EMAIL'], $_POST['SDT'])) {
            Employee::update($_POST['MANV'], $_POST['HOTENNV'], $_POST['EMAIL'], $_POST['SDT']);
        }
        header("Location: index.php?controller=employee&action=hienthiemployee");
        exit();
    }

    if (isset($_GET['MANV'])) {
        $nv = Employee::getById($_GET['MANV']);
        if ($nv) {
            $this->render('employee_edit', ['employee' => $nv]);
            return;
        }
    }

    $this->error();
}



    public function xoa()
    {
        if (isset($_GET['MANV'])) {
            Employee::delete($_GET['MANV']);
        }
        header("Location: index.php?controller=employee&action=hienthiemployee");
    }

public function tim()
{
     if (isset($_GET['keyword']) && trim($_GET['keyword']) !== '') {
        $keyword = trim($_GET['keyword']);
        $type = isset($_GET['type']) ? $_GET['type'] : 'ten';
        $list = Employee::search($keyword, $type);
        $this->render('employee_list', ['dsemployee' => $list]);
    } else {
        $this->hienthiemployee();
    }
}
}
?>
