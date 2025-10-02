<?php
    define('DB_URL', 'http://localhost/QLSieuThi/');
    class DB{
        private static $instance = null;
        public static function getInstance(){
            if(!self::$instance) {
                try{   
                    self::$instance = new PDO("mysql:host=localhost;port=3306;dbname=quanlysieuthi;charset=utf8", "root","");
                    //echo"ketnoithanhcong";
                }
                catch(PDOException $ex) {
                    die("Ket noi that bai: " . $ex->getMessage());
                }
            }
            return self::$instance;
        }
    }
    DB::getInstance();
?>