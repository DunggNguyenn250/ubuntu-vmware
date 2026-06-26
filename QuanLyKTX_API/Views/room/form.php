<?php
$isEdit = isset($room);
$pageTitle = $isEdit ? 'Chỉnh Sửa Phòng' : 'Thêm Phòng Mới';
$actionUrl = $isEdit ? BASE_URL . 'room/update/' . $room['maphong'] : BASE_URL . 'room/store';
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/style.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI'; background: #f5f5f5; padding: 20px; }
        .form-container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 5px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #2c3e50; font-weight: 600; }
        .form-group input, .form-group select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .form-group input:focus, .form-group select:focus { outline: none; border-color: #3498db; }
        .form-actions { display: flex; gap: 10px; margin-top: 30px; }
        .btn { flex: 1; padding: 12px; border: none; border-radius: 5px; cursor: pointer; }
        .btn-success { background: #27ae60; color: white; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn:hover { opacity: 0.8; }
    </style>
</head>
<body>
    <div class="form-container">
        <a href="<?= BASE_URL ?>" style="color: #3498db; text-decoration: none; font-weight: 500; display: inline-block; margin-bottom: 15px;">⌂ Quay lại trang chính</a>
        <h1><?= htmlspecialchars($pageTitle) ?></h1>
        <form method="POST" action="<?= htmlspecialchars($actionUrl) ?>">
            <div class="form-group">
                <label>Mã Phòng</label>
                <input type="text" id="maphongInput" name="maphong" value="<?= htmlspecialchars($room['maphong'] ?? '') ?>" <?= $isEdit ? 'readonly style="background-color: #e9ecef; pointer-events: none;"' : 'required placeholder="VD: P101 hoặc A101"' ?>>
            </div>
            <div class="form-group">
                <label>Số Phòng</label>
                <input type="text" id="sophongInput" name="sophong" value="<?= htmlspecialchars($room['sophong'] ?? '') ?>" readonly style="background-color: #e9ecef; pointer-events: none;">
            </div>
            <div class="form-group">
                <label>Tòa</label>
                <input type="text" id="toaInput" name="toa" value="<?= htmlspecialchars($room['toa'] ?? '') ?>" readonly style="background-color: #e9ecef; pointer-events: none;" required placeholder="Tự động trích xuất từ Mã Phòng">
                <div id="toaError" style="color: #e74c3c; font-size: 13px; margin-top: 5px; display: none;"> Tòa không tồn tại! (Hệ thống chỉ nhận A, B, C, D)</div>
            </div>
            <div class="form-group">
                <label>Sức Chứa</label>
                <input type="number" name="succhua" value="<?= $room['succhua'] ?? 8 ?>" min="1" <?= $isEdit ? 'required' : 'readonly style="background-color: #e9ecef; pointer-events: none;"' ?>>
            </div>
            <div class="form-group">
                <label>Hiện Tại</label>
                <input type="number" name="phonghientai" value="<?= $room['phonghientai'] ?? 0 ?>" min="0" <?= $isEdit ? 'required' : 'readonly style="background-color: #e9ecef; pointer-events: none;"' ?>>
            </div>
            <div class="form-group">
                <label>Giá (VND)</label>
                <input type="number" name="gia" value="<?= $room['gia'] ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label>Trạng Thái</label>
                <select name="trangthai" <?= $isEdit ? 'required' : 'style="background-color: #e9ecef; pointer-events: none;"' ?>>
                    <option value="Trống" <?= ($room['trangthai'] ?? 'Trống') === 'Trống' ? 'selected' : '' ?>>Trống</option>
                    <option value="Đầy" <?= ($room['trangthai'] ?? '') === 'Đầy' ? 'selected' : '' ?>>Đầy</option>
                    <option value="Bảo Trì" <?= ($room['trangthai'] ?? '') === 'Bảo Trì' ? 'selected' : '' ?>>Bảo Trì</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success"><?= $isEdit ? 'Cập Nhật' : 'Thêm Mới' ?></button>
                <a href="<?= BASE_URL ?>room" class="btn btn-secondary" style="text-decoration: none;">Hủy</a>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var maphongInput = document.getElementById('maphongInput');
            var sophongInput = document.getElementById('sophongInput');
            var toaInput = document.getElementById('toaInput');
            var toaError = document.getElementById('toaError');
            var validToas = ['A', 'B', 'C', 'D']; // Danh sách các tòa hợp lệ
            
            if (maphongInput && sophongInput && toaInput) {
                maphongInput.addEventListener('input', function() {
                    var val = this.value;
                    
                    // Lọc lấy số để tự động điền Số phòng
                    var numbers = val.replace(/\D/g, '');
                    sophongInput.value = numbers;
                    
                    // Lọc lấy chữ cái đầu tiên, in hoa để tự động điền Tòa
                    var letters = val.replace(/[^a-zA-Z]/g, '').toUpperCase();
                    if (letters.length > 0) {
                        var firstLetter = letters.charAt(0);
                        if (validToas.includes(firstLetter)) {
                            // Hợp lệ
                            toaInput.value = firstLetter;
                            toaError.style.display = 'none';
                            maphongInput.setCustomValidity('');
                        } else {
                            // Không hợp lệ
                            toaInput.value = '';
                            toaError.style.display = 'block';
                            maphongInput.setCustomValidity('Tòa không tồn tại!');
                        }
                    } else {
                        toaInput.value = '';
                        toaError.style.display = 'none';
                        maphongInput.setCustomValidity('');
                    }
                });
            }
        });
    </script>
</body>
</html>
