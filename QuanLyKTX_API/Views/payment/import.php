<?php
if (!defined('BASE_URL')) { define('BASE_URL', 'http://localhost/HellomynameisPencilan/QuanLyKTX_MVC/'); }
?>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập Dữ Liệu Thanh Toán</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f5f5; }
        .container-fluid { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #2c3e50; color: white; padding: 20px; }
        .sidebar h2 { margin-bottom: 30px; border-bottom: 2px solid #34495e; padding-bottom: 15px; }
        .sidebar ul { list-style: none; }
        .sidebar li { margin-bottom: 10px; }
        .sidebar a { color: #ecf0f1; text-decoration: none; padding: 10px 15px; display: block; border-radius: 5px; transition: 0.3s; }
        .sidebar a:hover { background: #3498db; padding-left: 20px; }
        .main-content { flex: 1; padding: 20px; }
        .header { background: white; padding: 15px 20px; border-radius: 5px; margin-bottom: 20px; display: flex; justify-content: space-between; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .header h1 { color: #2c3e50; }
        .user-info { display: flex; gap: 15px; align-items: center; }
        .user-info a { color: white; text-decoration: none; padding: 8px 15px; background: #e74c3c; border-radius: 5px; }
        .user-info a:hover { background: #c0392b; }
        .content-box { background: white; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .message { padding: 15px; margin-bottom: 20px; border-radius: 5px; display: none; }
        .message.show { display: block; }
        .message.success { background: #d4edda; color: #155724; }
        .message.error { background: #f8d7da; color: #721c24; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: 500; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .btn { padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 14px; text-decoration: none; display: inline-block; }
        .btn-primary { background: #3498db; color: white; }
        .btn-primary:hover { background: #2980b9; }
        .btn-secondary { background: #95a5a6; color: white; }
        .button-group { display: flex; gap: 10px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="sidebar">
            <h2>📋 MENU</h2>
            <ul>
                <li><a href="<?= BASE_URL ?>auth/dashboard">🏠 Trang Chủ</a></li>
                <li><a href="<?= BASE_URL ?>student">👥 Quản Lý Sinh Viên</a></li>
                <li><a href="<?= BASE_URL ?>room">🛏️ Quản Lý Phòng</a></li>
                <li><a href="<?= BASE_URL ?>contract">📄 Quản Lý Hợp Đồng</a></li>
                <li><a href="<?= BASE_URL ?>payment">💰 Quản Lý Thanh Toán</a></li>
                <li><a href="<?= BASE_URL ?>incident">⚠️ Quản Lý Sự Cố</a></li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                <h1>📤 Nhập Dữ Liệu Thanh Toán</h1>
                <div class="user-info">
                    <span>👤 <?= htmlspecialchars($_SESSION['username']) ?></span>
                    <a href="<?= BASE_URL ?>auth/logout">Đăng Xuất</a>
                </div>
            </div>
            <?php if (!empty($msg['text'])): ?>
            <div class="message show <?= $msg['type'] ?>">
                <?= htmlspecialchars($msg['text']) ?>
            </div>
            <?php endif; ?>
            <div class="content-box">
                <h2>Chọn File CSV Để Nhập</h2>
                <p style="margin-bottom: 20px; color: #666;">File CSV phải có các cột: Mã TT, Mã SV, Số Tiền, Ngày Trả, Trạng Thái (phân cách bằng dấu ;)</p>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Chọn File CSV:</label>
                        <input type="file" name="file" accept=".csv" required>
                    </div>
                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">Nhập Dữ Liệu</button>
                        <a href="<?= BASE_URL ?>payment" class="btn btn-secondary">Quay Lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
