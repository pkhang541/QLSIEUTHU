<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
<div class="container my-5">
    <div class="card shadow-lg rounded-3 border-0">
        <div class="card-header text-white bg-gradient" style="background: linear-gradient(90deg, #0062E6, #33AEFF);">
            <h4 class="mb-0">
                <i class="bi bi-receipt-cutoff me-2"></i> Chi tiết đơn hàng
            </h4>
        </div>

        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="index.php?controller=order&action=hienthiorder" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-1"></i> Quay lại danh sách
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle mb-0 shadow-sm">
                    <thead class="table-primary text-center">
                        <tr>
                            <th style="width: 10%;">Mã SP</th>
                            <th style="width: 30%;">Tên sản phẩm</th>
                            <th style="width: 15%;">Số lượng</th>
                            <th style="width: 20%;">Giá bán</th>
                            <th style="width: 15%;">Ghi chú</th>
                            <th style="width: 20%;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($details)): ?>
                            <?php foreach ($details as $row): ?>
                                <tr>
                                    <td class="text-center fw-bold"><?= htmlspecialchars($row->masp) ?></td>
                                    <td><?= htmlspecialchars($row->tensp) ?></td>
                                    <td class="text-center"><?= htmlspecialchars($row->soluongban) ?></td>
                                    <td class="text-end text-danger fw-semibold">
                                        <?= number_format($row->giaban, 0, ',', '.') ?> đ
                                    </td>
                                    <td class="text-center">
                                        <?= !empty($row->ghichu) 
                                            ? htmlspecialchars($row->ghichu) 
                                            : '<span class="text-muted fst-italic">Không có</span>' ?>
                                    </td>
                                     <td class="text-center">
                                        <a href="index.php?controller=details&action=edit&iddonhang=<?= urlencode($iddonhang) ?>&masp=<?= urlencode($row->masp) ?>"
                                           class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil-square"></i> Sửa
                                        </a>
                                        <a href="index.php?controller=details&action=delete&iddonhang=<?= urlencode($iddonhang) ?>&masp=<?= urlencode($row->masp) ?>"
                                            class="btn btn-sm btn-outline-danger"
                                                 onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi đơn hàng không?')">
                                                <i class="bi bi-trash"></i> Xóa
    </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-info-circle me-1"></i> Không có chi tiết nào
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
