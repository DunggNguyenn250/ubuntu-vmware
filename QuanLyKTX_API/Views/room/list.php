<?php
// Danh sách phòng - tương tự student list.php
// Views được tạo tương tự Student module
// (Chi tiết view xem trong Student/Views/list.php)
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/style.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI'; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 5px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #ecf0f1; }
        .btn { padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; }
        .btn-primary { background: #3498db; color: white; }
        .btn-primary:hover { background: #2980b9; }
        .search-box { display: flex; gap: 10px; margin-bottom: 20px; }
        .search-box input { flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; }
        table thead { background: #34495e; color: white; }
        table th, table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        table tbody tr:hover { background: #f9f9f9; }
        .alert { padding: 12px; margin-bottom: 15px; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <div style="margin-bottom: 20px;">
            <a href="<?= BASE_URL ?>" style="color: #3498db; text-decoration: none; font-weight: 500;">⌂ Quay lại trang chính</a>
        </div>
        <div class="header">
            <div>
                <h1><?= htmlspecialchars($title) ?></h1>
            </div>
            <div class="header-actions">
                <a href="<?= BASE_URL ?>room/export" class="btn" style="background: #27ae60; color: white;">Xuất Excel</a>
                <a href="<?= BASE_URL ?>room/import" class="btn" style="background: #2ea043; color: white; margin-left: 10px;">Nhập Excel</a>
                <a href="<?= BASE_URL ?>room/create" class="btn btn-primary" style="margin-left: 10px;">+ Thêm Phòng</a>
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

        <form method="GET" class="search-box">
            <input type="text" name="keyword" placeholder="🔍 Tìm kiếm phòng..." value="<?= htmlspecialchars($keyword) ?>">
            <button type="submit" class="btn btn-primary">Tìm</button>
        </form>

        <?php if (!empty($rooms)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Mã Phòng</th>
                        <th>Số Phòng</th>
                        <th>Tòa</th>
                        <th>Sức Chứa</th>
                        <th>Hiện Tại</th>
                        <th>Giá (VND)</th>
                        <th>Trạng Thái</th>
                        <th style="text-align: center;">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rooms as $room): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($room['maphong']) ?></strong></td>
                            <td><?= htmlspecialchars($room['sophong']) ?></td>
                            <td><?= htmlspecialchars($room['toa']) ?></td>
                            <td><?= $room['succhua'] ?></td>
                            <td><?= $room['phonghientai'] ?></td>
                            <td><?= number_format($room['gia']) ?></td>
                            <td><?= htmlspecialchars($room['trangthai']) ?></td>
                            <td style="text-align: center;">
                                <a href="<?= BASE_URL ?>room/danhsach/<?= $room['maphong'] ?>" style="color: #3498db; text-decoration: none;">Xem</a>
                                <a href="<?= BASE_URL ?>room/edit/<?= $room['maphong'] ?>" style="color: #3498db; text-decoration: none;">✏️ Sửa</a>
                                <a href="<?= BASE_URL ?>room/delete/<?= $room['maphong'] ?>" style="color: #e74c3c; text-decoration: none;" onclick="return confirm('Xác nhận xóa?')">🗑️ Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center; padding: 40px; color: #95a5a6;">📭 Không tìm thấy phòng nào</p>
        <?php endif; ?>
    </div>
</body>
</html>
