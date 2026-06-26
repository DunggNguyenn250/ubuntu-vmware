<?php
if (!isset($_SESSION['user_id'])) { header('Location: ../../index.php'); exit; }
if (!defined('BASE_URL')) { define('BASE_URL', 'http://localhost/HellomynameisPencilan/QuanLyKTX_MVC/'); }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập Dữ Liệu Hợp Đồng</title>
    <style>
        .import-container { max-width: 600px; margin: 40px auto; padding: 30px; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .import-container h2 { text-align: center; color: #333; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #555; }
        .form-group input[type="file"] { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .btn-group { display: flex; gap: 10px; justify-content: center; margin-top: 30px; }
        .btn { padding: 10px 30px; border: none; border-radius: 4px; cursor: pointer; font-weight: 600; text-decoration: none; display: inline-block; }
        .btn-primary { background: #3498db; color: white; }
        .btn-primary:hover { background: #2980b9; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn-secondary:hover { background: #7f8c8d; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; }
        .alert-error { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }
        .instructions { background: #ecf0f1; padding: 15px; border-left: 4px solid #3498db; margin-bottom: 20px; border-radius: 4px; }
        .csv-template { background: #fff3cd; padding: 10px; border-radius: 4px; margin: 10px 0; font-family: monospace; font-size: 12px; }
    </style>
</head>
<body>
    <div class="import-container">
        <h2>📤 Nhập Dữ Liệu Hợp Đồng</h2>
        <?php if ($msg['text']): ?>
            <div class="alert alert-<?= $msg['type'] === 'success' ? 'success' : 'error' ?>">
                <?= htmlspecialchars($msg['text']) ?>
            </div>
        <?php endif; ?>
        <div class="instructions">
            <h4>📋 Hướng Dẫn:</h4>
            <ul style="margin: 10px 0; padding-left: 25px;">
                <li>Chỉ hỗ trợ file <strong>.csv</strong></li>
                <li>Kích thước file tối đa: <strong>5MB</strong></li>
                <li>Dòng đầu: <strong>Mã Hợp Đồng, Mã SV, Mã Phòng, Bắt Đầu, Kết Thúc, Trạng Thái</strong></li>
                <li>Không được để trống Mã Hợp Đồng và Mã SV</li>
            </ul>
        </div>
        <div class="csv-template">
            <strong>📝 Mẫu CSV:</strong><br>
            Mã Hợp Đồng,Mã SV,Mã Phòng,Bắt Đầu,Kết Thúc,Trạng Thái<br>
            HD001,SV001,P001,2024-01-01,2025-01-01,Còn Hiệu Lực
        </div>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Chọn file CSV:</label>
                <input type="file" id="file" name="file" accept=".csv" required>
            </div>
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">📤 Nhập Dữ Liệu</button>
                <a href="<?= BASE_URL ?>contract" class="btn btn-secondary">← Quay Lại</a>
            </div>
        </form>
    </div>
</body>
</html>
