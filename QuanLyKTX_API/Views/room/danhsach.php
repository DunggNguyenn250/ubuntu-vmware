<?php
// Nếu framework đã extract thì $title và $room có sẵn.
// Nếu không, bạn có thể nhận mảng $data (tùy implementation của view()).
// Chuẩn hóa biến dùng trong view:
$pageTitle = 'Danh sách sinh viên - Phòng ' . ($room['sophong'] ?? '');
$students  = $room['students'] ?? [];

// Đảm bảo $students là mảng
if (!is_array($students)) {
    $students = [];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle) ?></title>
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

        /* Small responsive tweaks */
        @media (max-width: 720px) {
            .container { padding: 12px; }
            table, thead, tbody, th, td, tr { display: block; }
            thead { display: none; }
            tbody tr { margin-bottom: 12px; border: 1px solid #eee; border-radius: 6px; padding: 10px; background: #fff; }
            tbody td { padding: 8px 6px; border-bottom: 0; }
            tbody td[data-label] { display: flex; justify-content: space-between; }
            .back { display: inline-block; margin-bottom: 12px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <a class="back" href="<?= BASE_URL ?>room">← Quay lại danh sách phòng</a>
        <h1><?= htmlspecialchars($pageTitle) ?></h1>

        <?php if (empty($students)): ?>
            <p>Chưa có sinh viên trong phòng này.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th><strong>Số Phòng</strong></th>
                        <th><strong>Mã SV</strong></th>
                        <th><strong>Họ Tên</strong></th>
                        <th><strong>Lớp</strong></th>
                        <th><strong>Giới Tính</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $st): ?>
                        <tr>
                            <td><?= htmlspecialchars($room['sophong'] ?? '') ?></td>
                            <td><?= htmlspecialchars($st['masv'] ?? '') ?></td>
                            <td><?= htmlspecialchars($st['hoten'] ?? '') ?></td>
                            <td><?= htmlspecialchars($st['lop'] ?? '') ?></td>
                            <td><?= htmlspecialchars($st['gioitinh'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
