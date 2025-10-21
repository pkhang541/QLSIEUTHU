<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống kê doanh thu theo tháng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Thống kê doanh thu theo tháng</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-success">
            <tr>
                <th>Tháng</th>
                <th>Doanh thu (VNĐ)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($doanhThu as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['thang']) ?></td>
                    <td><?= number_format($item['doanhthu'], 0, ',', '.') ?> ₫</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>