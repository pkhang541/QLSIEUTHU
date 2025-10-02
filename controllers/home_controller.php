<?php
require_once 'base_controller.php';
require_once 'models/product.php';


class HomeController extends Basecontroller
{
    function __construct()
    {
        $this->folder='home';
    }
    public function hienthitrangchu()
    {
        $featuredProducts = Product::getFeaturedProducts();
        $this->render('trangchu', ['featuredProducts' => $featuredProducts]);
    }
    public function error()
    {
        $this->render('baoloi');
    }
}
?>