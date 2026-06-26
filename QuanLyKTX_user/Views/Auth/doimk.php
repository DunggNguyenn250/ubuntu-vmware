<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cổng Sinh Viên - KTX</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>Public/css/style.css">
    <style>
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            height: 100vh; 
            margin: 0;
        }
        
        .login-box { 
            background: white; 
            padding: 40px 30px; 
            border-radius: 10px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
            width: 380px; 
            text-align: center; 
        }
        .login-box h2 { 
            margin-bottom: 25px; 
            color: #00796b; 
            font-size: 24px;
        }
        .form-group { 
            text-align: left; 
            margin-bottom: 20px; 
        }
        .form-group label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: 600; 
            color: #455a64;
            font-size: 14px;
        }
        .form-group input { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid #cfd8dc; 
            border-radius: 6px; 
            box-sizing: border-box;
            transition: all 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #00bcd4;
            box-shadow: 0 0 5px rgba(0, 188, 212, 0.4);
        }
        .btn-submit { 
            width: 100%; 
            padding: 14px; 
            background: #00796b; 
            color: white; 
            border: none; 
            border-radius: 6px; 
            font-size: 16px; 
            font-weight: bold;
            cursor: pointer; 
            margin-top: 10px; 
            transition: background 0.3s;
        }
        .btn-submit:hover {
            background: #004d40;
        }
        .alert { 
            padding: 12px; 
            margin-bottom: 20px; 
            background: #ffcdd2; 
            color: #c62828; 
            border-radius: 6px; 
            text-align: left; 
            font-size: 14px; 
        }
        .footer-link {
            margin-top: 25px; 
            font-size: 13px; 
            color: #607d8b; 
        }
        .footer-link a {
            color: #00796b;
            text-decoration: none;
            font-weight: bold;
        }
        .footer-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    
    <div class="login-box">
        
        <h2>Đổi mật khẩu</h2>
        
        <?php if (isset($_SESSION['success'])): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
            <?= $_SESSION['success']; ?>
            <?php unset($_SESSION['success']); // Hiển thị xong thì xóa để F5 không bị hiện lại ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
            <?= $_SESSION['error']; ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
        <form action="<?= BASE_URL ?>auth/updatePassword" method="POST">
            <div class="form-group">
                <label>Mật khẩu cũ</label>
                <input type="password" name="old_password"  required>
            </div>
            <div class="form-group">
                <label>Mật khẩu mới</label>
                <input type="password" name="new_password"  required>
            </div>
            <div class="form-group">
                <label>Nhập lại mật khẩu mới</label>
                <input type="password" name="confirm_password"  required>
            </div>
            <button class="btn-submit" type="submit">Cập nhật</button>
        </form>
        <div class="form-header">
            <a href="<?= BASE_URL ?>dashboard" class="back-link">← Quay lại trang chủ</a>
        </div>
    </div>
</body>
</html>
