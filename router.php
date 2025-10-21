<?php
$controllers = array('home'=>['hienthitrangchu','error'],
        'product'=>['hienthiproduct','hienthiadd','them','hienthiedit','edit','xoa','tim','error'],
        'order'=>['hienthiorder','hienthiadd','xoa','hienthiedit','tim','error'],
        'customer'=>['hienthicustomer','hienthiadd','sua','xoa','tim','error'],
        'employee'=>['hienthiemployee','hienthiadd','hienthiedit','xoa','tim','error'],
        'thongke'=>['thongke','nhanvienxuatsac','khachhangmuanhieu','doanhthutheothang','error'],
        'details'=>['hienthidetails','add','edit','delete','error']
);

if(!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller]))
{
    $controller='home';
    $action='error';
}

include_once('controllers/' . $controller . '_controller.php');
$tenClass =str_replace('_','',ucwords($controller,'_')).'Controller';

$controller = new $tenClass;
$controller->$action();
?>