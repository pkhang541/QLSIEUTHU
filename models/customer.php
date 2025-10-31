<?php
require_once "connection.php";
class Customer
{
    public $makh;
    public $tenkh;
    public $diachi;
    public $sdt;

    function __construct($makh, $tenkh, $diachi, $sdt)
    {
        $this->makh   = $makh;
        $this->tenkh  = $tenkh;
        $this->diachi = $diachi;
        $this->sdt    = $sdt;
    }

    public static function getAllCustomers()
    {
        $list = [];
        $db = DB::getInstance();
        $result = $db->query('SELECT * FROM khachhang');
        $result->setFetchMode(PDO::FETCH_ASSOC);

        foreach ($result as $item) {
            $list[] = new Customer(
                $item['MAKH'],
                $item['TENKH'],
                $item['DC'],
                $item['SDT']
            );
        }
        return $list;
    }


public static function addCustomer($tenkh, $diachi, $sdt)
{
    try {
        $db = DB::getInstance();
        $sql = "INSERT INTO khachhang (TENKH, DC, SDT) VALUES (:tenkh, :dc, :sdt)";
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':tenkh', $tenkh, PDO::PARAM_STR);
        $stmt->bindValue(':dc',    $diachi, PDO::PARAM_STR);
        $stmt->bindValue(':sdt',   $sdt, PDO::PARAM_STR);

        $ok = $stmt->execute();

        if ($ok) {
            return $db->lastInsertId();
        } else {
            $err = $stmt->errorInfo();
            error_log("AddCustomer failed: " . print_r($err, true));
            return false;
        }
    } catch (PDOException $e) {
        error_log("PDOException in addCustomer: " . $e->getMessage());
        return false;
    } catch (Throwable $t) {
        error_log("Throwable in addCustomer: " . $t->getMessage());
        return false;
    }
}


    public static function updateCustomer($makh, $tenkh, $diachi, $sdt)
{
    $db = DB::getInstance();
    $sql = "UPDATE khachhang SET TENKH = ?, DC = ?, SDT = ? WHERE MAKH = ?";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$tenkh, $diachi, $sdt, $makh]);
}
    public static function getCustomerById($id)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM khachhang WHERE MAKH = :makh";
        $stmt = $db->prepare($sql);
        $stmt->execute([':makh' => $id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($item) {
            return new Customer($item['MAKH'], $item['TENKH'], $item['DC'], $item['SDT']);
        }
        return null; 
    }
    public static function deleteCustomer($id)
    {
        $db = DB::getInstance();
        $sql = "DELETE FROM khachhang WHERE MAKH = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$id]);
    }
public static function tim($keyword, $type)
{
    $db = DB::getInstance();
    $list = [];

    switch ($type) {
        case 'ma':
            $sql = "SELECT * FROM khachhang WHERE MAKH = :kw";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':kw', $keyword, PDO::PARAM_STR);
            break;

        case 'ten':
            $sql = "SELECT * FROM khachhang WHERE TENKH LIKE :kw";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':kw', '%' . $keyword . '%', PDO::PARAM_STR);
            break;

        case 'diachi':
            $sql = "SELECT * FROM khachhang WHERE DC LIKE :kw";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':kw', '%' . $keyword . '%', PDO::PARAM_STR);
            break;

        case 'sdt':
            $sql = "SELECT * FROM khachhang WHERE SDT = :kw";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':kw', $keyword, PDO::PARAM_STR);
            break;

        default:
            $sql = "SELECT * FROM khachhang WHERE TENKH LIKE :kw";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':kw', '%' . $keyword . '%', PDO::PARAM_STR);
            break;
    }

    $stmt->execute();

    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $item) {
        $list[] = new Customer(
            $item['MAKH'],
            $item['TENKH'],
            $item['DC'],
            $item['SDT']
        );
    }

    return $list;
}


}
?>
