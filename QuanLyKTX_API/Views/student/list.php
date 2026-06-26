<?php
/**
 * Student - List View
 */
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?> - Quản Lý Ký Túc Xá</title>
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #ecf0f1;
        }

        .header h1 {
            color: #2c3e50;
        }

        .header-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            font-size: 14px;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        .btn-success {
            background: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background: #229954;
        }

        .btn-warning {
            background: #f39c12;
            color: white;
        }

        .btn-warning:hover {
            background: #e67e22;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background: #c0392b;
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
        }

        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-box input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .search-box input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        .alert {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background: #34495e;
            color: white;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #ecf0f1;
        }

        table tbody tr:hover {
            background: #f9f9f9;
        }

        table tbody tr:nth-child(even) {
            background: #f5f5f5;
        }

        .action-links {
            display: flex;
            gap: 5px;
        }

        .action-links a {
            padding: 5px 10px;
            border-radius: 3px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
        }

        .action-links .edit {
            background: #3498db;
            color: white;
        }

        .action-links .delete {
            background: #e74c3c;
            color: white;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 20px;
        }

        .footer-info {
            text-align: center;
            color: #7f8c8d;
            margin-top: 15px;
            font-size: 14px;
        }

        .back-link {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #95a5a6;
        }

        .empty-state p {
            font-size: 16px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div>
                <h1><?= htmlspecialchars($title) ?></h1>
                <a href="<?= BASE_URL ?>auth/dashboard" class="back-link">← Quay lại Dashboard</a>
            </div>
            <div class="header-actions">
                <a href="<?= BASE_URL ?>student/export" class="btn" style="background: #27ae60; color: white;">Xuất Excel</a>
                <a href="<?= BASE_URL ?>student/import" class="btn" style="background: #2ea043; color: white;">Nhập Excel</a>
                <a href="<?= BASE_URL ?>student/create" class="btn btn-primary">+ Thêm Sinh Viên</a>
            </div>
        </div>

        <!-- Messages -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                ⚠️ <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                ✓ <?= $_SESSION['success'] ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Search -->
        <form method="GET" action="<?= BASE_URL ?>student" class="search-box">
            <input 
                type="text" 
                name="keyword" 
                placeholder="🔍 Tìm kiếm theo MSSV, tên hoặc email..." 
                value="<?= htmlspecialchars($keyword) ?>"
            >
            <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
            <?php if (!empty($keyword)): ?>
                <a href="<?= BASE_URL ?>student" class="btn btn-secondary">Reset</a>
            <?php endif; ?>
        </form>

        <!-- Table -->
        <?php if (!empty($students)): ?>
            <table>
                <thead>
                    <tr>
                        <th style="width: 10%;">MSSV</th>
                        <th style="width: 20%;">Họ Tên</th>
                        <th style="width: 10%;">Lớp</th>
                        <th style="width: 10%;">Giới Tính</th>
                        <th style="width: 15%;">Email</th>
                        <th style="width: 15%;">Số Điện Thoại</th>
                        <th style="width: 10%; text-align: center;">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($student['masv']) ?></strong></td>
                            <td><?= htmlspecialchars($student['hoten']) ?></td>
                            <td><?= htmlspecialchars($student['lop']) ?></td>
                            <td><?= htmlspecialchars($student['gioitinh']) ?></td>
                            <td><?= htmlspecialchars($student['email']) ?></td>
                            <td><?= htmlspecialchars($student['sodienthoai']) ?></td>
                            <td>
                                <div class="action-links">
                                    <a href="<?= BASE_URL ?>student/edit/<?= $student['masv'] ?>" class="edit">✏️ Sửa</a>
                                    <a href="<?= BASE_URL ?>student/delete/<?= $student['masv'] ?>" class="delete" onclick="return confirm('Bạn chắc chắn muốn xóa?')">🗑️ Xóa</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="footer-info">
                📊 Tìm thấy <strong><?= $total ?></strong> sinh viên
            </div>
        <?php else: ?>
            <div class="empty-state">
                <p>📭 Không tìm thấy sinh viên nào</p>
                <a href="<?= BASE_URL ?>student/create" class="btn btn-primary">+ Thêm Sinh Viên Mới</a>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Xác nhận trước khi xóa
        function confirmDelete(masv) {
            return confirm('Bạn chắc chắn muốn xóa sinh viên này?');
        }
    </script>
</body>
</html>
