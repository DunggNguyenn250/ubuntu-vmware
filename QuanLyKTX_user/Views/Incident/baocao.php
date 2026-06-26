<?php

if (!isset($incident) || empty($incident)) {
    echo '<div class="alert alert-error" style="margin: 20px; font-family: sans-serif;">Chưa có sự cố nào được ghi nhận.</div>';
    return;
}

$pageTitle = 'Gửi Yêu Cầu Sự Cố';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> - Quản Lý Ký Túc Xá</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>Public/css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
     /* Alert success */
            .alert-success {
            display: block;              /* hiển thị dạng khối */
            max-width: 400px;            /* giới hạn chiều rộng */
            background: #ecfdf5;         /* nền xanh nhạt */
            color: #065f46;              /* chữ xanh đậm */
            border: 1px solid #a7f3d0;   /* viền xanh nhạt */
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            margin: 0 auto 16px;         /* căn giữa theo chiều ngang */
            box-shadow: 0 4px 12px rgba(6,95,70,0.08);
            text-align: center;          /* căn giữa nội dung bên trong */
            }





        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .form-header {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #ecf0f1;
        }

        .form-header h1 {
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        .form-group.required label::after {
            content: " *";
            color: #e74c3c;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
        }

        .btn-success {
            background: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background: #229954;
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .back-link {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 15px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .form-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="form-header" style="max-width: 600px; margin: 20px auto 0;">
        <a href="<?= BASE_URL ?>dashboard" class="back-link">← Quay lại trang chủ</a>
        <h1><?= htmlspecialchars($pageTitle) ?></h1>
    </div>

  <?php if (isset($_SESSION['success'])): ?>
    <div class="alert-success">✅ <?= $_SESSION['success'] ?></div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>




    <div class="form-container" style="margin-bottom: 20px;">
        <form method="POST" action="">
            <!-- Mã SV -->
            <div class="form-group required">
                <label for="masv">Mã Sinh Viên</label>
                <input
                    type="text"
                    id="masv"
                    name="masv"
                    value="<?= htmlspecialchars($_SESSION['masv'] ?? '') ?>"
                    readonly
                >
            </div>

            <!-- Mã Phòng -->
            <div class="form-group required">
                <label for="maphong">Mã Phòng</label>
                <input
                    type="text"
                    id="maphong"
                    name="maphong"
                    value="<?= htmlspecialchars($incident['maphong'] ?? '') ?>"
                    readonly
                >
            </div>

            <!-- Mô Tả -->
            <div class="form-group required">
                <label for="mota">Mô Tả Sự Cố</label>
                <textarea
                    id="mota"
                    name="mota"
                    rows="5"
                    required
                ></textarea>
            </div>

            <!-- Ngày Báo -->
            <div class="form-group required">
                <label for="ngaybao">Ngày Báo</label>
                <input
                    type="date"
                    id="ngaybao"
                    name="ngaybao"
                    value="<?= date('Y-m-d') ?>"
                    required
                >
            </div>

            <!-- Trạng Thái (mặc định cho_duyet) -->
            <div class="form-group">
                <label for="trangthai">Trạng Thái</label>
                <input
                    type="text"
                    id="trangthai"
                    name="trangthai"
                    value="Chờ duyệt"
                    readonly
                >
            </div>

            <!-- Nút gửi -->
            <div class="form-actions">
                <button type="submit" class="btn btn-success">Gửi Yêu Cầu</button>
                <a href="<?= BASE_URL ?>dashboard" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>
</body>
</html>
