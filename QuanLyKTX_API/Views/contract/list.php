<?php
// Danh sách hợp đồng
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh Sách Hợp Đồng</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI'; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 5px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn { padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; }
        .btn-primary { background: #3498db; color: white; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table thead { background: #34495e; color: white; }
        table th, table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        table tbody tr:hover { background: #f9f9f9; }
        .alert { padding: 12px; margin-bottom: 15px; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-error { background: #f8d7da; color: #721c24; }
        .status-active { color: green; font-weight: bold; }
        .status-expired { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div style="margin-bottom: 20px;">
            <a href="<?= BASE_URL ?>" style="color: #3498db; text-decoration: none; font-weight: 500;">⌂ Quay lại trang chính</a>
        </div>
        <div class="header">
            <h1>Danh Sách Hợp Đồng</h1>
            <div>
                <a href="<?= BASE_URL ?>contract/export" class="btn" style="background: #27ae60; color: white;">Xuất Excel</a>
                <a href="<?= BASE_URL ?>contract/import" class="btn" style="background: #2ea043; color: white; margin-left: 10px;">Nhập Excel</a>
                <a href="<?= BASE_URL ?>contract/create" class="btn btn-primary" style="margin-left: 10px;">+ Thêm Hợp Đồng</a>
            </div>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">✓ <?= $_SESSION['success'] ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">⚠️ <?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (!empty($contracts)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Mã HĐ</th>
                        <th>MSSV</th>
                        <th>Sinh Viên</th>
                        <th>Phòng</th>
                        <th>Bắt Đầu</th>
                        <th>Hết Hạn</th>
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contracts as $c): ?>
                        <tr>
                            <td><?= htmlspecialchars($c['mahopdong']) ?></td>
                            <td><?= htmlspecialchars($c['masv']) ?></td>
                            <td><?= htmlspecialchars($c['hoten'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($c['maphong'] ?? 'N/A') ?></td>
                            <td><?= $c['batdau'] ?></td>
                            <td><?= $c['hethan'] ?></td>
                            <td><span class="status-<?= strtolower($c['trangthai']) ?>"><?= htmlspecialchars($c['trangthai']) ?></span></td>
                            <td>
                                <a href="<?= BASE_URL ?>contract/edit/<?= $c['mahopdong'] ?>" style="color: #3498db; margin-right: 5px; font-weight: 500; text-decoration: none;">✏️ Sửa</a> |
                                <a href="<?= BASE_URL ?>contract/terminate/<?= $c['mahopdong'] ?>" style="color: #f39c12; margin: 0 5px; font-weight: 500; text-decoration: none;" onclick="return confirm('Bạn có chắc chắn muốn kết thúc hợp đồng này? Hợp đồng sẽ chuyển sang trạng thái Đã Chấm Dứt thay vì xóa khỏi hệ thống.')">🛑 Kết Thúc</a> |
                                <a href="<?= BASE_URL ?>contract/delete/<?= $c['mahopdong'] ?>" style="color: #e74c3c; margin-left: 5px; font-weight: 500; text-decoration: none;" onclick="return confirm('Xóa luôn khỏi CSDL?')">🗑️ Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center; padding: 40px; color: #95a5a6;">📭 Không có hợp đồng nào</p>
        <?php endif; ?>
    </div>
</body>
</html>
