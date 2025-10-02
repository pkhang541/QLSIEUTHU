<div class="container mt-4">
    <h2>Sửa chi tiết đơn hàng #<?= $order->iddonhang ?></h2>

    <form method="POST" 
          action="index.php?controller=order&action=updateDetails&id=<?= $order->iddonhang ?>">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Chọn</th>
                    <th>Mã SP</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá bán</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
             <?php foreach ($products as $p): ?>
    <?php 
         $masp = (string)$p->masp; // ép về string để khớp key
        $detail = isset($orderDetails[$p->masp]) ? $orderDetails[$p->masp] : null; 
    ?>
    <tr>
        <td>
            <input type="checkbox" 
                   name="DETAILS[<?= $p->masp ?>][SELECTED]" 
                   value="1" 
                   <?= $detail ? 'checked' : '' ?>>
        </td>
        <td><?= $p->masp ?></td>
        <td><?= htmlspecialchars($p->tensp) ?></td>
        <td>
            <input type="number" class="form-control"
                   name="DETAILS[<?= $p->masp ?>][SOLUONG]"
                   value="<?= $detail ? $detail->soluongban : '' ?>"
                   min="1">
        </td>
        <td>
            <input type="number" class="form-control"
                   name="DETAILS[<?= $p->masp ?>][GIABAN]"
                   value="<?= $detail ? $detail->giaban : '' ?>"
                   min="0" >
        </td>
        <td>
            <input type="text" class="form-control"
                   name="DETAILS[<?= $p->masp ?>][GHICHU]"
                   value="<?= $detail ? htmlspecialchars($detail->ghichu) : '' ?>">
        </td>
    </tr>
<?php endforeach; ?>


            </tbody>
        </table>

        <div class="d-flex gap-2">
            <button type="submit" name="saveDetails" class="btn btn-success">
                💾 Lưu chi tiết
            </button>
           <a href="index.php?controller=order&action=hienthiOrderDetails&id=<?= $order->iddonhang ?>" 
   class="btn btn-secondary">
    ⬅ Quay lại
</a>
        </div>
    </form>
</div>
