<?php
require_once "connection.php";

class OrderDetail {
    public $idchitiet;
    public $iddonhang;
    public $masp;        
    public $soluongban;
    public $giaban;
    public $ghichu;

    function __construct($iddonhang, $masp, $soluongban, $giaban, $ghichu = null, $idchitiet = null) {
        $this->idchitiet = $idchitiet;
        $this->iddonhang = $iddonhang;
        $this->masp      = $masp;
        $this->soluongban = $soluongban;
        $this->giaban    = $giaban;
        $this->ghichu    = $ghichu;
    }

    // Thêm chi tiết đơn hàng
public function insert() {
    $db = DB::getInstance();
    $stmt = $db->prepare("
        INSERT INTO chitietdonhang (IDDONHANG, ID, SOLUONGBAN, GIABAN, GHICHU) 
        VALUES (?, ?, ?, ?, ?)
    ");
    return $stmt->execute([
        $this->iddonhang,
        $this->masp,
        $this->soluongban,
        $this->giaban,
        $this->ghichu
    ]);
}
public static function getOne($iddonhang, $masp)
{
    $db = DB::getInstance();
    $sql = "SELECT * FROM chitietdonhang WHERE IDDONHANG = :iddonhang AND ID = :masp";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':iddonhang' => $iddonhang,
        ':masp' => $masp
    ]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        return new OrderDetail(
            $row['IDDONHANG'],
            $row['ID'],
            $row['SOLUONGBAN'],
            $row['GIABAN'],
            $row['GHICHU'],
            $row['IDCHITIET'] ?? null
        );
    }

    return null;
}
public static function deleteOne($iddonhang, $masp) {
    $db = DB::getInstance();
    $sql = "DELETE FROM chitietdonhang WHERE IDDONHANG = :iddonhang AND ID = :masp";
    $stmt = $db->prepare($sql);
    return $stmt->execute([
        ':iddonhang' => $iddonhang,
        ':masp'      => $masp
    ]);
}


public static function getByOrderId($orderId) {
    $db = DB::getInstance();
    $sql = "SELECT 
                sp.ID AS masp, 
                sp.TENSP AS tensp, 
                ct.SOLUONGBAN AS soluongban, 
                ct.GIABAN AS giaban,   
                ct.GHICHU AS ghichu
            FROM chitietdonhang ct
            JOIN sanpham sp ON ct.ID = sp.ID
            WHERE ct.IDDONHANG = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $orderId]);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $rows = $stmt->fetchAll();

    // ✅ Trả về map [masp => object]
    $map = [];
    foreach ($rows as $r) {
        $map[(string)$r->masp] = $r;  // ép về string để tránh lệch kiểu
    }
    return $map;
}

    public static function deleteByOrderId($iddonhang) {
        $db = DB::getInstance();
        $sql = "DELETE FROM chitietdonhang WHERE IDDONHANG = :iddonhang";
        $stmt = $db->prepare($sql);
        return $stmt->execute([':iddonhang' => $iddonhang]);
    }
    public static function updateByOrderAndProduct($iddonhang, $masp, $soluong, $giaban, $ghichu) {
    $db = DB::getInstance();
    $sql = "UPDATE chitietdonhang
            SET SOLUONGBAN = :soluong, GIABAN = :giaban, GHICHU = :ghichu
            WHERE IDDONHANG = :iddonhang AND ID = :masp";
    $stmt = $db->prepare($sql);
    return $stmt->execute([
        ':soluong'   => $soluong,
        ':giaban'    => $giaban,
        ':ghichu'    => $ghichu,
        ':iddonhang' => $iddonhang,
        ':masp'      => $masp
    ]);
}


    
}
?>