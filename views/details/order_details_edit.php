    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<div class="container mt-4">
    <h2 class="mb-3">✏️ Sửa chi tiết đơn hàng #<?= htmlspecialchars($iddonhang) ?></h2>

    <form method="POST" id="detailsForm" action="">
        <table class="table table-bordered table-hover">
            <thead class="table-dark text-center">
                <tr>
                    <th>Mã SP</th>
                    <th>Số lượng</th>
                    <th>Giá bán</th>
                    <th>Ghi chú</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="MASP" class="form-select" required>
                            <?php foreach ($products as $product): ?>
                                <option value="<?= htmlspecialchars($product->masp) ?>" <?= $product->masp == $detail->masp ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($product->tensp) ?> (<?= htmlspecialchars($product->masp) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <input type="number" name="SOLUONG" class="form-control" min="1" required
                               value="<?= htmlspecialchars($detail->soluongban) ?>">
                    </td>
                    <td>
                        <input type="number" name="DONGIA" class="form-control" min="0" required
                               value="<?= htmlspecialchars($detail->giaban) ?>">
                    </td>
                    <td>
                        <input type="text" name="GHICHU" class="form-control"
                               value="<?= htmlspecialchars($detail->ghichu) ?>">
                    </td>
                </tr>
            </tbody>
        </table>
       <button type="button" class="btn btn-success" onclick="kiemtraSuaCTDH()"> cập nhật</button>
        <a href="index.php?controller=details&action=hienthidetails&iddonhang=<?= $iddonhang ?>" class="btn btn-secondary">⬅ Quay lại</a>
    </form>
</div>
<script>
function kiemtraSuaCTDH() {
    const form = document.getElementById('detailsForm');
    const masp = form.querySelector('select[name="MASP"]');
    const soluong = form.querySelector('input[name="SOLUONG"]');
    const dongia = form.querySelector('input[name="DONGIA"]');
    if (masp.value.trim() === "") {
        alert("Vui lòng chọn sản phẩm!");
        masp.focus();
        return false;
    }
    if (soluong.value.trim() === "" || parseInt(soluong.value) <= 0) {
        alert("Số lượng phải lớn hơn 0!");
        soluong.focus();
        return false;
    }
    if (dongia.value.trim() === "" || parseFloat(dongia.value) < 0) {
        alert("Giá bán không được âm!");
        dongia.focus();
        return false;
    }
    form.submit();
}
</script>

