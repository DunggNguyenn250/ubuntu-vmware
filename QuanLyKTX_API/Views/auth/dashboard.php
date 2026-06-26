<?php
// Kiểm tra đã login hay chưa (giả lập nếu chưa login)
$username = $_SESSION['username'] ?? 'Admin KTX';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Quản Lý Ký Túc Xá (API Architecture)</title>
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

        .container-fluid {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 20px;
            overflow-y: auto;
        }

        .sidebar h2 {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #34495e;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar li {
            margin-bottom: 10px;
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .sidebar a:hover {
            background: #3498db;
            padding-left: 20px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .header {
            background: white;
            padding: 15px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .header h1 {
            color: #2c3e50;
        }

        .user-info {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .user-info a {
            color: #e74c3c;
            text-decoration: none;
            padding: 8px 15px;
            background: #ecf0f1;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .user-info a:hover {
            background: #e74c3c;
            color: white;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .dashboard-card {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: block;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .dashboard-card .icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .dashboard-card h3 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .dashboard-card p {
            color: #7f8c8d;
            font-size: 14px;
        }

        .feature-list {
            background: white;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .feature-list h3 {
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .feature-list ul {
            list-style: none;
        }

        .feature-list li {
            padding: 8px 0;
            color: #555;
        }

        .feature-list li:before {
            content: "✓ ";
            color: #27ae60;
            font-weight: bold;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Sidebar -->
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

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <div>
                    <h1>Hệ Thống Quản Lý Ký Túc Xá</h1>
                </div>
                <div class="user-info">
                    <span>👤 <?= htmlspecialchars($username) ?></span>
                    <a href="<?= BASE_URL ?>auth/logout">Đăng Xuất</a>
                </div>
            </div>

            <!-- Welcome Message -->
            <div style="background: #3498db; color: white; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
                <h2>👋 Chào mừng, <?= htmlspecialchars($username) ?>!</h2>
                <p>Đây là phiên bản API Architecture mới nhất của hệ thống Quản Lý Ký Túc Xá</p>
            </div>

            <!-- Dashboard Grid -->
            <div class="dashboard-grid">
                <a href="<?= BASE_URL ?>student" class="dashboard-card">
                    <div class="icon">👥</div>
                    <h3>Sinh Viên</h3>
                    <p>Quản lý danh sách sinh viên</p>
                </a>

                <a href="<?= BASE_URL ?>room" class="dashboard-card">
                    <div class="icon">🛏️</div>
                    <h3>Phòng</h3>
                    <p>Quản lý phòng ký túc xá</p>
                </a>

                <a href="<?= BASE_URL ?>contract" class="dashboard-card">
                    <div class="icon">📄</div>
                    <h3>Hợp Đồng</h3>
                    <p>Quản lý hợp đồng thuê phòng</p>
                </a>

                <a href="<?= BASE_URL ?>payment" class="dashboard-card">
                    <div class="icon">💰</div>
                    <h3>Thanh Toán</h3>
                    <p>Quản lý thanh toán phí</p>
                </a>

                <a href="<?= BASE_URL ?>incident" class="dashboard-card">
                    <div class="icon">⚠️</div>
                    <h3>Sự Cố</h3>
                    <p>Báo cáo và quản lý sự cố</p>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
