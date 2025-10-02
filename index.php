<?php
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  require_once('connection.php');
  if(isset($_GET['controller'])){
    $controller=$_GET['controller'];
    if(isset($_GET['action'])){
      $action=$_GET['action'];
    }
    else {
      $action='index';
    }
    require_once("router.php");
  }
  else {
    if(isset($_POST['controller'])){

      $controller=$_POST['controller'];
      if(isset($_POST['action'])){
        $action=$_POST['action'];
      }
      else {
        $action='index';
      }
    }
    else {
      $controller='home';
      $action='hienthitrangchu';
    }
    require_once("router.php");
  }
?>