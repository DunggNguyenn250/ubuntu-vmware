<?php
if (!isset($incidents) || empty($incidents)) {
    echo '<div class="alert alert-error" style="margin: 20px; font-family: sans-serif;">Chưa có sự cố nào được ghi nhận.</div>';
    return;
}




$pageTitle = 'Thông tin Sự cố Của Tôi';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
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
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        .form-group.required label::after {
            content: " *";
            color: #e74c3c;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-row .form-group {
            margin-bottom: 0;
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


    table.incident-table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        margin: 20px 0;
    }

    table.incident-table th, 
    table.incident-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    table.incident-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    table.incident-table tr:nth-child(even) {
        background-color: #fafafa;
    }

    table.incident-table tr:hover {
        background-color: #f1f1f1;
    }

    .btn-success {
        display: inline-block;
        margin-top: 15px;
        padding: 8px 15px;
        background-color: #28a745;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
    }

    .btn-success:hover {
        background-color: #218838;
    }

        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="form-header" style="max-width: 600px; margin: 20px auto 0;">
        <a href="<?= BASE_URL ?>dashboard" class="back-link">← Quay lại trang chủ</a>
        <h1><?= htmlspecialchars($pageTitle) ?></h1>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
        <div style="max-width: 600px; margin: 0 auto;">
            <div class="alert-error">⚠️ <?= $_SESSION['error'] ?></div>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

  
        <!-- Row 1: Mã Sự Cố & Mã Phòng -->
    <table class="incident-table">
    <thead>
        <tr>
            <th>Mã Sự Cố</th>
            <th>Mã Phòng</th>
            <th>Mô Tả</th>
            <th>Ngày Báo</th>
            <th>Trạng Thái</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($incidents as $incident): ?>
        <tr>
            <td><?= htmlspecialchars($incident['masuco'] ?? '') ?></td>
            <td><?= htmlspecialchars($incident['maphong'] ?? '') ?></td>
            <td><?= htmlspecialchars($incident['mota'] ?? '') ?></td>
            <td><?= htmlspecialchars($incident['ngaybao'] ?? '') ?></td>
            <td><?= htmlspecialchars($incident['trangthai'] ?? '') ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>

</table>
            <a href="<?= BASE_URL ?>incident/baocao" class="btn btn-success">
                ✍️ Báo cáo sự cố
            </a>



 
</body>
</html>