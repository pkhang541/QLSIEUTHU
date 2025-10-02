<div class="container mt-4">
    <h2>Thêm chi tiết đơn hàng #<?= $iddonhang ?></h2>

    <form method="POST">
        <input type="hidden" name="IDDONHANG" value="<?= htmlspecialchars($iddonhang) ?>">

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
                    <tr>
                        <td>
                            <input type="checkbox" name="DETAILS[<?= $p->masp ?>][SELECTED]" value="1">
                        </td>
                        <td><?= $p->masp ?></td>
                        <td><?= htmlspecialchars($p->tensp) ?></td>
                        <td>
                            <input type="number" class="form-control" 
                                   name="DETAILS[<?= $p->masp ?>][SOLUONG]" 
                                   min="1">
                        </td>
                        <td>
                            <input type="number" class="form-control" 
                                   name="DETAILS[<?= $p->masp ?>][GIABAN]" 
                                   min="0" step="1000">
                        </td>
                        <td>
                            <input type="text" class="form-control" 
                                   name="DETAILS[<?= $p->masp ?>][GHICHU]">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="d-flex gap-2">
            <button type="submit" name="saveDetails" class="btn btn-primary">
                <i class="bi bi-save"></i> Lưu chi tiết
            </button>
            <a href="index.php?controller=order&action=hienthiorder" class="btn btn-secondary">
                Quay lại
            </a>
        </div>
    </form>
</div>
