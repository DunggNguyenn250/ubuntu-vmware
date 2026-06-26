<?php
/**
 * Incident - Form View (Thêm & Sửa)
 * @var Controller $this
 */
$isEdit = isset($incident);
$pageTitle = $isEdit ? 'Cập Nhật Sự Cố' : 'Báo Cáo Sự Cố Mới';
$actionUrl = $isEdit ? BASE_URL . 'incident/update/' . $incident['masuco'] : BASE_URL . 'incident/store';
$today = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> - Quản Lý Ký Túc Xá</title>
    <link rel="stylesheet" href="<?= PUBLIC_URL ?>css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f5f5f5; padding: 20px; }
        .form-container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .form-header { margin-bottom: 30px; padding-bottom: 15px; border-bottom: 2px solid #ecf0f1; }
        .form-header h1 { color: #2c3e50; margin-bottom: 5px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #2c3e50; font-weight: 600; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; box-sizing: border-box; transition: border-color 0.3s; }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: #3498db; box-shadow: 0 0 5px rgba(52, 152, 219, 0.3); }
        .form-group.required label::after { content: " *"; color: #e74c3c; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .form-row .form-group { margin-bottom: 0; }
        .form-actions { display: flex; gap: 10px; margin-top: 30px; }
        .btn { flex: 1; padding: 12px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; transition: all 0.3s; font-size: 14px; font-weight: 600; text-align: center; }
        .btn-success { background: #27ae60; color: white; }
        .btn-success:hover { background: #229954; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn-secondary:hover { background: #7f8c8d; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 12px; margin-bottom: 20px; border-radius: 5px; }
        .back-link { color: #3498db; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-block; margin-bottom: 15px; }
        .back-link:hover { text-decoration: underline; }
        .select2-container .select2-selection--single { height: 38px; border: 1px solid #ddd; border-radius: 5px; }
        .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 38px; font-size: 14px; }
        .select2-container--default .select2-selection--single .select2-selection__arrow { height: 36px; }
        .readonly-field { background-color: #e9ecef !important; pointer-events: none; }
        @media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="form-container">
        <!-- Header -->
        <div class="form-header">
            <a href="<?= BASE_URL ?>incident" class="back-link">← Quay lại Danh Sách</a>
            <a href="<?= BASE_URL ?>" class="back-link" style="margin-left: 15px;">⌂ Quay lại trang chính</a>
            <h1><?= htmlspecialchars($pageTitle) ?></h1>
        </div>

        <!-- Messages -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert-error">
                ⚠️ <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" action="<?= htmlspecialchars($actionUrl) ?>">
            <div class="form-row">
                <div class="form-group required">
                    <label for="masuco">Mã Yêu Cầu / Sự Cố</label>
                    <input type="text" id="masuco" name="masuco" value="<?= htmlspecialchars($incident['masuco'] ?? $nextMaSuCo ?? '') ?>" readonly class="readonly-field">
                </div>

                <div class="form-group required">
                    <label for="maphong">Mã Phòng</label>
                    <select id="maphong" name="maphong" class="select2-search" required>
                        <option value="">-- Chọn Phòng --</option>
                        <?php foreach ($rooms ?? [] as $room): ?>
                            <?php $selected = ($isEdit && $incident['maphong'] === $room['maphong']) ? 'selected' : ''; ?>
                            <option value="<?= htmlspecialchars($room['maphong']) ?>" <?= $selected ?>>
                                <?= htmlspecialchars($room['maphong'] . ' - Tòa ' . $room['toa']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group required" style="margin-top: 15px;">
                <label for="mota">Mô Tả Sự Cố</label>
                <textarea id="mota" name="mota" rows="4" placeholder="Nhập chi tiết về sự cố hoặc yêu cầu..." required><?= htmlspecialchars($incident['mota'] ?? '') ?></textarea>
            </div>

            <div class="form-row" style="margin-top: 15px;">
                <div class="form-group required">
                    <label for="ngaybao">Ngày Báo</label>
                    <input type="date" id="ngaybao" name="ngaybao" value="<?= htmlspecialchars($incident['ngaybao'] ?? $today) ?>" required>
                </div>

                <div class="form-group required">
                    <label for="trangthai">Trạng Thái</label>
                    <select id="trangthai" name="trangthai" required>
                        <option value="Chờ Xử Lý" <?= ($incident['trangthai'] ?? '') === 'Chờ Xử Lý' ? 'selected' : '' ?>>Chờ Xử Lý</option>
                        <option value="Đang Xử Lý" <?= ($incident['trangthai'] ?? '') === 'Đang Xử Lý' ? 'selected' : '' ?>>Đang Xử Lý</option>
                        <option value="Đã Xử Lý" <?= ($incident['trangthai'] ?? '') === 'Đã Xử Lý' ? 'selected' : '' ?>>Đã Xử Lý</option>
                    </select>
                </div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-success">✓ <?= $isEdit ? 'Cập Nhật' : 'Thêm Mới' ?></button>
                <a href="<?= BASE_URL ?>incident" class="btn btn-secondary">✕ Hủy</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-search').select2({
                width: '100%'
            });
        });
    </script>
</body>
</html>
