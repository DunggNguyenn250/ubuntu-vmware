<?php
/**
 * Student - Form View (Thêm/Sửa)
 */
$isEdit = isset($student);
$pageTitle = $isEdit ? 'Chỉnh Sửa Sinh Viên' : 'Thêm Sinh Viên Mới';
$actionUrl = $isEdit ? BASE_URL . 'student/update/' . $student['masv'] : BASE_URL . 'student/store';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> - Quản Lý Ký Túc Xá</title>
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

        .form-header p {
            color: #7f8c8d;
            font-size: 14px;
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
        .form-group select,
        .form-group textarea {
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
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
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

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .back-link {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .field-hint {
            font-size: 12px;
            color: #95a5a6;
            margin-top: 5px;
        }

        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .form-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <!-- Header -->
        <div class="form-header">
            <h1><?= htmlspecialchars($pageTitle) ?></h1>
            <a href="<?= BASE_URL ?>student" class="back-link">← Quay lại Danh Sách</a>
        </div>

        <!-- Messages -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                ⚠️ <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" action="<?= htmlspecialchars($actionUrl) ?>">
            <!-- Row 1: MSSV & Họ Tên (có thể full width) -->
            <div class="form-row">
                <div class="form-group required">
                    <label for="masv">MSSV</label>
                    <input 
                        type="text" 
                        id="masv" 
                        name="masv" 
                        placeholder="VD: SV001"
                        value="<?= htmlspecialchars($student['masv'] ?? $nextMaSV ?? '') ?>"
                        readonly style="background-color: #e9ecef; pointer-events: none;"
                    >
                    <?php if (!$isEdit): ?>
                        <div class="field-hint">Mã số sinh viên tự động sinh và không thể sửa.</div>
                    <?php endif; ?>
                </div>

                <div class="form-group required">
                    <label for="hoten">Họ Tên</label>
                    <input 
                        type="text" 
                        id="hoten" 
                        name="hoten" 
                        placeholder="VD: Nguyễn Văn A"
                        value="<?= htmlspecialchars($student['hoten'] ?? '') ?>"
                        required
                    >
                </div>
            </div>

            <!-- Row 2: Lớp & Giới Tính -->
            <div class="form-row">
                <div class="form-group required">
                    <label for="lop">Lớp</label>
                    <input 
                        type="text" 
                        id="lop" 
                        name="lop" 
                        placeholder="VD: CT07A, CDTH21"
                        value="<?= htmlspecialchars($student['lop'] ?? '') ?>"
                        required
                    >
                </div>

                <div class="form-group required">
                    <label for="gioitinh">Giới Tính</label>
                    <select id="gioitinh" name="gioitinh" required>
                        <option value="">-- Chọn Giới Tính --</option>
                        <option value="Nam" <?= ($student['gioitinh'] ?? '') === 'Nam' ? 'selected' : '' ?>>Nam</option>
                        <option value="Nữ" <?= ($student['gioitinh'] ?? '') === 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                        <option value="Khác" <?= ($student['gioitinh'] ?? '') === 'Khác' ? 'selected' : '' ?>>Khác</option>
                    </select>
                </div>
            </div>

            <!-- Row 3: CCCD & Số Điện Thoại -->
            <div class="form-row">
                <div class="form-group">
                    <label for="cccd">CCCD</label>
                    <input 
                        type="text" 
                        id="cccd" 
                        name="cccd" 
                        placeholder="VD: 123456789012"
                        value="<?= htmlspecialchars($student['cccd'] ?? '') ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="sodienthoai">Số Điện Thoại</label>
                    <input 
                        type="text" 
                        id="sodienthoai" 
                        name="sodienthoai" 
                        placeholder="VD: 0123456789"
                        value="<?= htmlspecialchars($student['sodienthoai'] ?? '') ?>"
                    >
                </div>
            </div>

            <!-- Row 4: Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="VD: nguyenvana@example.com"
                    value="<?= htmlspecialchars($student['email'] ?? '') ?>"
                >
            </div>

            <!-- Row 5: Địa Chỉ -->
            <div class="form-group">
                <label for="diachi">Địa Chỉ</label>
                <textarea 
                    id="diachi" 
                    name="diachi" 
                    placeholder="Nhập địa chỉ đầy đủ"
                ><?= htmlspecialchars($student['diachi'] ?? '') ?></textarea>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-success">
                    <?= $isEdit ? '✓ Cập Nhật' : '✓ Thêm Mới' ?>
                </button>
                <a href="<?= BASE_URL ?>student" class="btn btn-secondary">✕ Hủy</a>
            </div>
        </form>
    </div>
</body>
</html>
