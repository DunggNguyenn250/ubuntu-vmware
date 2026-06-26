<?php
// Danh sách thanh toán
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh Sách Thanh Toán</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI'; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 5px; }
        .header { display: flex; justify-content: space-between; margin-bottom: 20px; }
        .btn { padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; background: #3498db; color: white; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table thead { background: #34495e; color: white; }
        table th, table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        .alert { padding: 12px; margin-bottom: 15px; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; }
    </style>
</head>
<body>
    <div class="container">
        <div style="margin-bottom: 20px;">
            <a href="<?= BASE_URL ?>" style="color: #3498db; text-decoration: none; font-weight: 500;">⌂ Quay lại trang chính</a>
        </div>
        <div class="header">
            <h1>Danh Sách Thanh Toán</h1>
            <div>
                <a href="<?= BASE_URL ?>payment/export" class="btn" style="background: #27ae60; color: white;">Xuất Excel</a>
                <a href="<?= BASE_URL ?>payment/import" class="btn" style="background: #2ea043; color: white; margin-left: 10px;">Nhập Excel</a>
                <a href="<?= BASE_URL ?>payment/create" class="btn" style="margin-left: 10px;">+ Thêm</a>
            </div>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">✓ <?= $_SESSION['success'] ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Mã TT</th>
                    <th>Phòng</th>
                    <th>Số Tiền (VND)</th>
                    <th>Ngày Trả</th>
                    <th>Trạng Thái</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($payments)): ?>
                    <?php foreach ($payments as $p): ?>
                        <tr>
                            <td><?= $p['mathanhtoan'] ?></td>
                            <td><?= htmlspecialchars($p['maphong'] ?? 'N/A') ?></td>
                            <td><?= number_format($p['sotien']) ?></td>
                            <td><?= $p['ngaytra'] ?></td>
                            <td><?= htmlspecialchars($p['trangthai']) ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>payment/edit/<?= $p['mathanhtoan'] ?>" style="color: #3498db; text-decoration: none; margin-right: 10px;">✏️ Sửa</a>
                                <a href="<?= BASE_URL ?>payment/delete/<?= $p['mathanhtoan'] ?>" style="color: #e74c3c; text-decoration: none;" onclick="return confirm('Xóa?')">🗑️ Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" style="text-align: center; padding: 40px;">📭 Không có thanh toán nào</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
