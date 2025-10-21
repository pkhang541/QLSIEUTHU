<?php
require_once "connection.php";
class Employee
{
    public $manv;
    public $hotennv;
    public $email;
    public $sdt;

    function __construct($manv, $hotennv, $email, $sdt)
    {
        $this->manv = $manv;
        $this->hotennv = $hotennv;
        $this->email = $email;
        $this->sdt = $sdt;
    }

    public static function getAllEmployees()
    {   
        $list = [];
        $db = DB::getInstance();
        $result = $db->query('SELECT * FROM nhanvien');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        foreach ($result as $item) {
            $list[] = new Employee($item['MANV'], $item['HOTENNV'], $item['EMAIL'], $item['SDT']);
        }
        return $list;
    }

    public static function getById($idnhanvien)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM nhanvien WHERE MANV = :manv";
        $stmt = $db->prepare($sql);
        $stmt->execute([':manv' => $idnhanvien]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($item) {
            return new Employee($item['MANV'], $item['HOTENNV'], $item['EMAIL'], $item['SDT']);
        }
        return null; 
    }
    public static function insert($hotennv, $email, $sdt)
    {
        try {
            $db = DB::getInstance();
            $sql = "INSERT INTO nhanvien (HOTENNV, EMAIL, SDT) VALUES (:hotennv, :email, :sdt)";
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':hotennv', $hotennv, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':sdt', $sdt, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public static function update($manv, $hotennv, $email, $sdt)
    {
        try {
            $db = DB::getInstance();
            $sql = "UPDATE nhanvien SET HOTENNV = :hotennv, EMAIL = :email, SDT = :sdt WHERE MANV = :manv";
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':manv', $manv, PDO::PARAM_STR);
            $stmt->bindValue(':hotennv', $hotennv, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':sdt', $sdt, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    public static function delete($manv)
    {
        try {
            $db = DB::getInstance();
            $sql = "DELETE FROM nhanvien WHERE MANV = :manv";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':manv', $manv, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public static function search($keyword, $type = 'ten')
    {
         $list = [];
    $db = DB::getInstance();

    switch ($type) {
        case 'ma':
            $sql = "SELECT * FROM nhanvien WHERE MANV = :kw";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':kw', $keyword, PDO::PARAM_STR);
            break;
        case 'email':
            $sql = "SELECT * FROM nhanvien WHERE EMAIL LIKE :kw";
            $stmt = $db->prepare($sql);
            $kw = "%" . $keyword . "%";
            $stmt->bindParam(':kw', $kw, PDO::PARAM_STR);
            break;
        case 'sdt':
            $sql = "SELECT * FROM nhanvien WHERE SDT = :kw";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':kw', $kw, PDO::PARAM_STR);
            break;
        default: // tìm theo tên
            $sql = "SELECT * FROM nhanvien WHERE HOTENNV LIKE :kw";
            $stmt = $db->prepare($sql);
            $kw = "%" . $keyword . "%";
            $stmt->bindParam(':kw', $kw, PDO::PARAM_STR);
    }

    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $r) {
        $list[] = new Employee($r['MANV'], $r['HOTENNV'], $r['EMAIL'], $r['SDT']);
    }

    return $list;
}
    
}
?>
