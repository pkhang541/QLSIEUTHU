<?php
require_once 'connection.php';
    class Product {
    public static function countAll() {
        global $conn;
        $sql = "SELECT COUNT(*) as total FROM sanpham";
        $result = $conn->query($sql)->fetch_assoc();
        return $result['total'];
    }

    public static function getTopSelling($limit = 5) {
        global $conn;
        $sql = "SELECT sp.ID, sp.TENSP, SUM(ct.SOLUONGBAN) AS tongban
                FROM sanpham sp
                JOIN chitietdonhang ct ON sp.ID = ct.ID
                GROUP BY sp.ID, sp.TENSP
                ORDER BY tongban DESC
                LIMIT $limit";
        $result = $conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}
?>