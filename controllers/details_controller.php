<?php
require_once "models/details.php";
require_once "base_controller.php";
class DetailsController extends Basecontroller
{
    function __construct()
    {
        $this->folder = 'order';
    }

    public function hienthidetails()
{
    if (isset($_GET['iddonhang'])) {
        $iddonhang = $_GET['iddonhang'];

        // gọi đúng model
        $details = OrderDetail::getByOrderId($iddonhang);

        if ($details) {
            $data = ['details' => $details];
            $this->render('order_details', $data);
            return;
        }
    }
    $this->error();
}

    public function error()
    {
        $this->render('baoloi');
    }
}