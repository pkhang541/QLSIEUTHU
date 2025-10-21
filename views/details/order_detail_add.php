<form method="POST" id="detailsForm" action="index.php?controller=details&action=add">
    <input type="hidden" name="IDDONHANG" value="<?= $iddonhang ?>">

    <div id="product-list">
        <div class="row mb-2">
            <div class="col-md-4">
                <select name="PRODUCTS[0][ID]" class="form-select">
                    <option value="">-- Chọn sản phẩm --</option>
                    <?php foreach ($products as $p): ?>
                        <option value="<?= $p->masp ?>"><?= $p->tensp ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="PRODUCTS[0][SOLUONG]" class="form-control" min="1">
            </div>
            <div class="col-md-2">
                <input type="number" name="PRODUCTS[0][GIABAN]" class="form-control" min="0">
            </div>
            <div class="col-md-3">
                <input type="text" name="PRODUCTS[0][GHICHU]" class="form-control" placeholder="Ghi chú">
            </div>
        </div>
    </div>


    <button type="button" class="btn btn-success" onclick="kiemtraCTDH()"> Lưu chi tiết</button>
</form>


<button type="button" class="btn btn-outline-primary mt-3" onclick="addProduct()"> Thêm sản phẩm</button>

<script>
let productIndex = 1;

function addProduct() {
    const productList = document.getElementById('product-list');
    const newProduct = document.createElement('div');
    newProduct.classList.add('row', 'mb-2');
    newProduct.innerHTML = `
        <div class="col-md-4">
            <select name="PRODUCTS[${productIndex}][ID]" class="form-select" required>
                <option value="">-- Chọn sản phẩm --</option>
                <?php foreach ($products as $p): ?>
                    <option value="<?= $p->masp ?>"><?= $p->tensp ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="PRODUCTS[${productIndex}][SOLUONG]" class="form-control" min="1" required>
        </div>
        <div class="col-md-2">
            <input type="number" name="PRODUCTS[${productIndex}][GIABAN]" class="form-control" min="0" required>
        </div>
        <div class="col-md-3">
            <input type="text" name="PRODUCTS[${productIndex}][GHICHU]" class="form-control" placeholder="Ghi chú">
        </div>
    `;
    productList.appendChild(newProduct);
    productIndex++;
}
function kiemtraCTDH() {
    const form = document.getElementById('detailsForm');
    const rows = form.querySelectorAll('#product-list .row');
    for (let i = 0; i < rows.length; i++) {
        const select = rows[i].querySelector('select');
        const soluong = rows[i].querySelector('input[name^="PRODUCTS"][name$="[SOLUONG]"]');
        const giaban = rows[i].querySelector('input[name^="PRODUCTS"][name$="[GIABAN]"]');
        if (select.value.trim() === "") {
            alert(`Vui lòng chọn sản phẩm ở dòng ${i + 1}!`);
            select.focus();
            return false;
        }
        if (soluong.value.trim() === "" || parseInt(soluong.value) <= 0) {
            alert(`Vui lòng nhập số lượng hợp lệ ở dòng ${i + 1}!`);
            soluong.focus();
            return false;
        }
        if (giaban.value.trim() === "" || parseFloat(giaban.value) < 0) {
            alert(`Vui lòng nhập giá bán hợp lệ ở dòng ${i + 1}!`);
            giaban.focus();
            return false;
        }
    }
    form.submit();
}
</script>
