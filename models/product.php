<?php
class Product
{
    public $masp;
    public $tensp;
    public $hansudung;
    public $mota;
    public $hinhanh;
    public $quycach;
    public $dvt;

    function __construct($masp,$tensp,$hansudung,$mota,$hinhanh,$quycach,$dvt)
    {
        $this->masp=$masp;
        $this->tensp=$tensp;
        $this->hansudung=$hansudung;
        $this->mota=$mota;
        $this->hinhanh=$hinhanh;
        $this->quycach=$quycach;
        $this->dvt=$dvt;
    }

    public static function getAllProduct()
    {
        $list = [];
        $db = DB::getInstance();
        $result = $db->query('SELECT * FROM sanpham');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($result as $item) {
            $list[] = new Product($item['ID'], $item['TENSP'], $item['HANSD'], $item['MOTA'], $item['HINHANH'], $item['QUYCACH'], $item['DONVT']);
        }
        return $list;
    }
    public static function countAll()
{
    $db = DB::getInstance();
    $sql = "SELECT COUNT(*) as total FROM sanpham";
    $stmt = $db->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
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
public static function getFeaturedProducts($limit = 4)
{
    $db = DB::getInstance();
    $sql = "
        SELECT sp.ID, sp.TENSP, sp.HINHANH, SUM(ct.SOLUONGBAN) as tongban
        FROM chitietdonhang ct
        INNER JOIN sanpham sp ON sp.ID = ct.ID
        GROUP BY sp.ID, sp.TENSP, sp.HINHANH
        ORDER BY tongban DESC
        LIMIT :limit
    ";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




    public static function addProduct($tensp, $hansudung, $mota, $hinhanh, $quycach, $dvt)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare("INSERT INTO sanpham (TENSP, HANSD, MOTA, HINHANH, QUYCACH, DONVT) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$tensp, $hansudung, $mota, $hinhanh, $quycach, $dvt]);
    }

    public static function getProductById($masp)
    {
        $db = DB::getInstance();
        $result = $db->prepare('SELECT * FROM sanpham WHERE ID = :id');
        $result->bindParam(':id', $masp);
        $result->execute();
        $item = $result->fetch(PDO::FETCH_ASSOC);
        if ($item) {
            return new Product($item['ID'], $item['TENSP'], $item['HANSD'], $item['MOTA'], $item['HINHANH'], $item['QUYCACH'], $item['DONVT']);
        }
        return null;
    }
    

    public static function hienthiedit($masp, $tensp, $hansudung, $mota, $hinhanh, $quycach, $dvt)
    {
        $db = DB::getInstance();
        $sql = "UPDATE sanpham 
                SET TENSP = ?, HANSD = ?, MOTA = ?, HINHANH = ?, QUYCACH = ?, DONVT = ? 
                WHERE ID = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$tensp, $hansudung, $mota, $hinhanh, $quycach, $dvt, $masp]);
    }
    public static function updateProduct($masp, $tensp, $hansudung, $mota, $hinhanh, $quycach, $dvt)
{
    $db = DB::getInstance(); 
    $stmt = $db->prepare("UPDATE sanpham SET TENSP = ?, HANSD = ?, MOTA = ?, HINHANH = ?, QUYCACH = ?, DONVT = ? 
    WHERE ID = ?");
    return $stmt->execute([$tensp, $hansudung, $mota, $hinhanh, $quycach, $dvt, $masp]);
}


    public static function deleteProduct($masp)
    {
        $db = DB::getInstance();
        $sql = "DELETE FROM sanpham WHERE ID = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$masp]);
    }
    public static function tim($keyword)
{
    $db = DB::getInstance();
    $sql = "SELECT * FROM sanpham 
            WHERE TENSP LIKE :kw OR ID LIKE :kw";
    $stmt = $db->prepare($sql);
    $stmt->execute([':kw' => '%' . $keyword . '%']);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $list = [];
    foreach ($stmt as $item) {
        $list[] = new Product(
            $item['ID'], 
            $item['TENSP'], 
            $item['HANSD'], 
            $item['MOTA'], 
            $item['HINHANH'], 
            $item['QUYCACH'], 
            $item['DONVT']
        );
    }
    return $list;
}

}
?>
