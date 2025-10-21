<?php
require_once "connection.php";

class Order {
    public $iddonhang;
    public $manv;
    public $makh;
    public $trangthai;
    public $ngaylap;
    public $masp_list; 

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
               nv.HOTENNV AS hotennv,
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
        $order->hotennv = $row['hotennv'] ?? '';
        $order->tenkh = $row['tenkh'] ?? '';
        $orders[] = $order;
    }
    return $orders;
}

public static function tim($keyword, $type = 'id')
{
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
    ";
    switch ($type) {
        case 'id':
            $sql .= " WHERE o.IDDONHANG = :kw";
            $params = [':kw' => $keyword];
            break;

        case 'nhanvien':
            $sql .= " WHERE nv.HOTENNV LIKE :kw";
            $params = [':kw' => "%$keyword%"];
            break;

        case 'khachhang':
            $sql .= " WHERE kh.TENKH LIKE :kw";
            $params = [':kw' => "%$keyword%"];
            break;

        case 'trangthai':
            $sql .= " WHERE o.TRANGTHAI LIKE :kw";
            $params = [':kw' => "%$keyword%"];
            break;

        case 'ngaylap':
            $sql .= " WHERE o.NGAYLAP LIKE :kw";
            $params = [':kw' => "%$keyword%"];
            break;

        default:
            $sql .= " WHERE o.IDDONHANG LIKE :kw";
            $params = [':kw' => "%$keyword%"];
    }

    $sql .= " GROUP BY o.IDDONHANG";

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $orders = [];
    foreach ($stmt as $row) {
        $order = new Order(
            $row['IDDONHANG'],
            $row['MANV'],
            $row['MAKH'],
            $row['TRANGTHAI'],
            $row['NGAYLAP']
        );
        $order->tensp_list = $row['tensp_list'] ?? '';
        $order->hotennv = $row['hotennv'] ?? '';
        $order->tenkh = $row['tenkh'] ?? '';
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

public static function update($id, $manv, $makh, $trangthai, $ngaylap) {
    $db = DB::getInstance();
    try {
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
        return true;
    } catch (Exception $e) {
        error_log("Update order error: " . $e->getMessage());
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
