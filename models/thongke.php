<?php
require_once 'connection.php';
    class Thongke  {
 public static function countAll()
{
    $db = DB::getInstance();
    $sql = "SELECT COUNT(*) as total FROM sanpham";
    $stmt = $db->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}
public static function getTopCustomers($limit = 5)
{
    $db = DB::getInstance(); // hoặc global $conn nếu dùng mysqli
    $sql = "
        SELECT kh.TENKH,  SUM(ct.SOLUONGBAN) as tongmua
        FROM khachhang kh
        JOIN donhang dh ON kh.MAKH = dh.MAKH
        JOIN chitietdonhang ct ON dh.IDDONHANG = ct.IDDONHANG
        GROUP BY kh.MAKH, kh.TENKH
        ORDER BY tongmua DESC
        LIMIT :limit
    ";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public static function getTopSelling($limit = 5)
{
    $db = DB::getInstance();
    $sql = "
        SELECT sp.ID, sp.TENSP, SUM(ct.SOLUONGBAN) as tongban
        FROM chitietdonhang ct
        INNER JOIN sanpham sp ON sp.ID = ct.ID
        GROUP BY sp.ID, sp.TENSP
        ORDER BY tongban DESC
        LIMIT :limit
    ";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    public static function getTopSellingEmployee($limit = 2) {
    $limit = (int)$limit;
    $db = DB::getInstance();  // Lấy kết nối PDO

    $sql = "SELECT nv.HOTENNV, COALESCE(SUM(ct.SOLUONGBAN),0) AS tongban
            FROM nhanvien nv
            JOIN donhang o ON nv.MANV = o.MANV
            JOIN chitietdonhang ct ON o.IDDONHANG = ct.IDDONHANG
            GROUP BY nv.MANV, nv.HOTENNV
            ORDER BY tongban DESC
            LIMIT :limit";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public static function getDoanhThuTheoThang()
{
    $db = DB::getInstance();
    $sql = "
        SELECT 
            DATE_FORMAT(d.NGAYLAP, '%Y-%m') AS thang,
            SUM(ct.GIABAN * ct.SOLUONGBAN) AS doanhthu
        FROM donhang d
        JOIN chitietdonhang ct ON d.IDDONHANG = ct.IDDONHANG
        GROUP BY thang
        ORDER BY thang DESC
    ";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>