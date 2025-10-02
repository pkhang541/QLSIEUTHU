<?php
require_once "connection.php";

class Order {
    public $iddonhang;
    public $manv;
    public $makh;
    public $trangthai;
    public $ngaylap;
    public $masp_list; // danh sách sản phẩm trong đơn

    function __construct($iddonhang, $manv, $makh,$trangthai, $ngaylap) {
        $this->iddonhang = $iddonhang;
        $this->manv = $manv;
        $this->makh = $makh;
        $this->trangthai = $trangthai;
        $this->ngaylap = $ngaylap;
    }

   public static function getAllOrder() {
    $db = DB::getInstance();
    $sql = "
        SELECT o.*, 
               GROUP_CONCAT(p.TENSP SEPARATOR ', ') AS tensp_list,
               nv.HOTENNV AS tennv,
               kh.TENKH AS tenkh
        FROM donhang o
        LEFT JOIN chitietdonhang d ON o.IDDONHANG = d.IDDONHANG
        LEFT JOIN sanpham p ON d.ID = p.ID
        LEFT JOIN nhanvien nv ON o.MANV = nv.MANV
        LEFT JOIN khachhang kh ON o.MAKH = kh.MAKH
        GROUP BY o.IDDONHANG
    ";
    $req = $db->query($sql);

    $orders = [];
    foreach ($req->fetchAll() as $row) {
        $order = new Order(
            $row['IDDONHANG'],
            $row['MANV'],
            $row['MAKH'],
            $row['TRANGTHAI'],
            $row['NGAYLAP']
        );
        $order->tensp_list = $row['tensp_list'] ?? '';
        $order->tennv = $row['tennv'] ?? '';
        $order->tenkh = $row['tenkh'] ?? '';
        $orders[] = $order;
    }
    return $orders;
}

public static function searchById($id) {
    $db = DB::getInstance();
    $sql = "
        SELECT o.*, 
               GROUP_CONCAT(p.TENSP SEPARATOR ', ') AS tensp_list,
               nv.HOTENNV AS hotennv,
               kh.TENKH AS tenkh
        FROM donhang o
        LEFT JOIN chitietdonhang d ON o.IDDONHANG = d.IDDONHANG
        LEFT JOIN sanpham p ON d.ID = p.ID
        LEFT JOIN nhanvien nv ON o.MANV = nv.MANV
        LEFT JOIN khachhang kh ON o.MAKH = kh.MAKH
        WHERE o.IDDONHANG = :id
        GROUP BY o.IDDONHANG
    ";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $id]);
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $orders = [];
    if ($row) {
        $order = new Order(
            $row['IDDONHANG'],
            $row['MANV'],
            $row['MAKH'],
            $row['TRANGTHAI'],
            $row['NGAYLAP']
        );
        $order->tensp_list = $row['tensp_list'] ?? '';
        $order->hotennv      = $row['hotennv'] ?? '';
        $order->tenkh      = $row['tenkh'] ?? '';
        $orders[] = $order;
    }

    return $orders;
}


    public static function getById($id) {
        $db = DB::getInstance();
        $sql = "SELECT * FROM donhang WHERE IDDONHANG = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($item) {
            return new Order(
                $item['IDDONHANG'],
                $item['MANV'],
                $item['MAKH'],
                $item['TRANGTHAI'],
                $item['NGAYLAP']
            );
        }
        return null;
    }
    public static function getLastInsertId()
{
    $db = DB::getInstance();
    return $db->lastInsertId();
}


    public static function insert($manv, $makh, $trangthai, $ngaylap) {
        $db = DB::getInstance();
        $sql = "INSERT INTO donhang (MANV, MAKH,  TRANGTHAI, NGAYLAP)
                VALUES (:manv, :makh, :trangthai, :ngaylap)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            ':manv' => $manv,
            ':makh' => $makh,
            ':trangthai' => $trangthai,
            ':ngaylap' => $ngaylap
        ]);
    }

 public static function update($id, $manv, $makh, $trangthai, $ngaylap, $products) {
    $db = DB::getInstance();
    try {
        $db->beginTransaction();

        // Cập nhật thông tin đơn hàng
        $sql = "UPDATE donhang
                SET MANV = :manv, MAKH = :makh, TRANGTHAI = :trangthai, NGAYLAP = :ngaylap
                WHERE IDDONHANG = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':manv' => $manv,
            ':makh' => $makh,
            ':trangthai' => $trangthai,
            ':ngaylap' => $ngaylap
        ]);

        // Xóa sản phẩm cũ
        $stmt = $db->prepare("DELETE FROM chitietdonhang WHERE IDDONHANG = :id");
        $stmt->execute([':id' => $id]);

        // Thêm lại sản phẩm mới
        $stmt = $db->prepare("INSERT INTO chitietdonhang (IDDONHANG, ID) VALUES (:iddonhang, :masp)");
        foreach ($products as $masp) {
            $stmt->execute([
                ':iddonhang' => $id,
                ':masp' => $masp
            ]);
        }

        $db->commit();
        return true;
    } catch (Exception $e) {
        $db->rollBack();
        return false;
    }
}
      
    public static function delete($iddonhang) {
        $db = DB::getInstance();
        $stmt = $db->prepare("DELETE FROM chitietdonhang WHERE IDDONHANG = :iddonhang");
        $stmt->execute([':iddonhang' => $iddonhang]);
        $stmt = $db->prepare("DELETE FROM donhang WHERE IDDONHANG = :iddonhang");
        return $stmt->execute([':iddonhang' => $iddonhang]);
    }
    
}
