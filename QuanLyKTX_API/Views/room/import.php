<?php
/**
 * Room Import View
 * Vị trí: Modules/Room/Views/import.php
 */

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit;
}

if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://localhost/HellomynameisPencilan/QuanLyKTX_MVC/');
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập Dữ Liệu Phòng</title>
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/style.css">
    <style>
        .import-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .import-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        .form-group input[type="file"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
            background: #f9f9f9;
            font-size: 13px;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            padding: 10px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid transparent;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .instructions {
            background: #ecf0f1;
            padding: 15px;
            border-left: 4px solid #3498db;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .instructions h4 {
            margin-top: 0;
            color: #2c3e50;
        }

        .instructions ul {
            margin: 10px 0;
            padding-left: 25px;
        }

        .instructions li {
            margin: 5px 0;
            color: #555;
        }

        .csv-template {
            background: #fff3cd;
            padding: 10px;
            border-radius: 4px;
            margin: 10px 0;
            font-family: monospace;
            font-size: 12px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="import-container">
        <h2>📤 Nhập Dữ Liệu Phòng</h2>

        <?php if ($msg['text']): ?>
            <div class="alert alert-<?= $msg['type'] === 'success' ? 'success' : 'error' ?>">
                <?= htmlspecialchars($msg['text']) ?>
            </div>
        <?php endif; ?>

        <div class="instructions">
            <h4>📋 Hướng Dẫn:</h4>
            <ul>
                <li>Chỉ hỗ trợ file <strong>.csv</strong> (Comma Separated Values)</li>
                <li>Kích thước file tối đa: <strong>5MB</strong></li>
                <li>Dòng đầu tiên phải là: <strong>Mã Phòng, Số Phòng, Tòa, Sức Chứa, Phòng Hiện Tại, Giá, Trạng Thái</strong></li>
                <li>Không được để trống Mã Phòng và Số Phòng</li>
                <li>Các bản ghi có Mã Phòng trùng sẽ bị bỏ qua</li>
            </ul>
        </div>

        <div class="csv-template">
            <strong>📝 Mẫu CSV:</strong><br>
            Mã Phòng,Số Phòng,Tòa,Sức Chứa,Phòng Hiện Tại,Giá,Trạng Thái<br>
            P001,101,A,4,2,2000000,Đã Kín<br>
            P002,102,A,4,0,2000000,Trống
        </div>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Chọn file CSV:</label>
                <input type="file" id="file" name="file" accept=".csv,.xlsx,.xls" required>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">📤 Nhập Dữ Liệu</button>
                <a href="<?= BASE_URL ?>room" class="btn btn-secondary">← Quay Lại</a>
            </div>
        </form>
    </div>
</body>
</html>
