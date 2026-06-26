<?php
/**
 * Student - List View
 */

// Lấy student từ mảng students nếu controller truyền 'students' => [$student]
$student = $students[0] ?? null;

// Nếu không có student thì dừng và báo lỗi (hoặc bạn có thể redirect từ controller)
if (!$student) {
    echo '<div class="alert alert-error">Không tìm thấy sinh viên để chỉnh sửa.</div>';
    return;
}

// Luôn ở chế độ chỉnh sửa
$isEdit = true;
$pageTitle = 'Chỉnh Sửa Sinh Viên';
$actionUrl = BASE_URL . 'student/update/' . urlencode($student['masv']);
$title = 'Thông tin sinh viên';


?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASE_URL ?>Public/css/style.css">
    <style>
        /* Layout cơ bản */
* { margin: 0; padding: 0; box-sizing: border-box; }
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(180deg,#f7fbff 0%, #f5f7fa 100%);
  color: #2c3e50;
  padding: 30px 16px;
}

/* Khung chính */
.container {
  max-width: 980px;
  margin: 0 auto;
  background: #ffffff;
  padding: 26px;
  border-radius: 12px;
  box-shadow: 0 8px 30px rgba(34, 49, 63, 0.08);
}

/* Header */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 12px;
  margin-bottom: 18px;
}
.header h1 { font-size: 20px; color: #1f2d3d; font-weight: 700; }

/* Field hint */
.field-hint {
  font-size: 13px;
  color: #6b7280;
  background: #f1f5f9;
  border-left: 4px solid #60a5fa;
  padding: 10px 12px;
  border-radius: 6px;
  margin-bottom: 14px;
}

/* Form grid */
.form-row {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 14px;
  margin-bottom: 14px;
}
@media (max-width: 720px) {
  .form-row { grid-template-columns: 1fr; }
}

/* Form group */
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-group.required label::after {
  content: " *";
  color: #e11d48;
  font-weight: 600;
  margin-left: 4px;
}

/* Inputs and textarea */
input[type="text"],
input[type="email"],
input[type="date"],
input[type="number"],
textarea {
  padding: 10px 12px;
  border: 1px solid #e6e9ee;
  border-radius: 8px;
  background: #fff;
  font-size: 14px;
  color: #0f172a;
  transition: box-shadow .18s, border-color .18s;
}
input[readonly], textarea[readonly] {
  background: #f8fafc;
  color: #334155;
  border-style: dashed;
}
input:focus, textarea:focus {
  outline: none;
  border-color: #60a5fa;
  box-shadow: 0 6px 18px rgba(96,165,250,0.12);
}

/* Buttons */
.form-actions {
  display: flex;
  gap: 10px;
  justify-content: flex-end;
  margin-top: 8px;
}
.btn {
  padding: 10px 16px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  font-weight: 600;
  font-size: 14px;
}
.btn-success { background: #16a34a; color: #fff; }
.btn-secondary {
  background: transparent;
  color: #334155;
  border: 1px solid #e6e9ee;
}

/* Small helpers */
.helper-row { display:flex; gap:10px; align-items:center; margin-top:8px; }
.small-note { font-size:13px; color:#64748b; }

/* Table and list adjustments if used on homepage */
.table-compact td, .table-compact th { padding: 10px; }
.empty-state { padding: 28px; text-align:center; color:#94a3b8; }

/* Visual polish */
label { font-size: 13px; color: #0f172a; font-weight: 600; }
textarea { resize: vertical; min-height: 100px; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div>
                <h1><?= htmlspecialchars($title) ?></h1>
                <a href="<?= BASE_URL ?>dashboard" class="back-link">← Quay lại trang chủ</a>
    </div>
        </div>

        <!-- Messages -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                ⚠️ <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                ✓ <?= $_SESSION['success'] ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Search -->
        

       <!-- Form -->
        <form method="POST" action="<?= htmlspecialchars($actionUrl) ?>">
            <!-- Row 1: MSSV & Họ Tên (có thể full width) -->
        
        <div class="field-hint">
    Mã số sinh viên, họ tên, lớp, giới tính, CCCD không thể thay đổi
  </div>

  <form method="POST" action="<?= htmlspecialchars($actionUrl ?? '') ?>">
    <div class="form-row">
      <div class="form-group required">
        <label for="masv">MSSV</label>
        <input type="text" id="masv" name="masv" placeholder="VD: SV001"
               value="<?= htmlspecialchars($student['masv'] ?? '') ?>" required readonly>
      </div>

      <div class="form-group required">
        <label for="hoten">Họ Tên</label>
        <input type="text" id="hoten" name="hoten" placeholder="VD: Nguyễn Văn A"
               value="<?= htmlspecialchars($student['hoten'] ?? '') ?>" required readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group required">
        <label for="lop">Lớp</label>
        <input type="text" id="lop" name="lop" placeholder="VD: CT07A"
               value="<?= htmlspecialchars($student['lop'] ?? '') ?>" required readonly>
      </div>

      <div class="form-group required">
        <label for="gioitinh">Giới Tính</label>
        <input type="text" id="gioitinh" name="gioitinh"
               value="<?= htmlspecialchars($student['gioitinh'] ?? '') ?>" required readonly>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="cccd">CCCD</label>
        <input type="text" id="cccd" name="cccd" placeholder="VD: 123456789012"
               value="<?= htmlspecialchars($student['cccd'] ?? '') ?>" required readonly>
      </div>

      <div class="form-group">
        <label for="sodienthoai">Số Điện Thoại</label>
        <input type="text" id="sodienthoai" name="sodienthoai" placeholder="VD: 0123456789"
               value="<?= htmlspecialchars($student['sodienthoai'] ?? '') ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="VD: nguyenvana@example.com"
             value="<?= htmlspecialchars($student['email'] ?? '') ?>" required>
    </div>

    <div class="form-group">
      <label for="diachi">Địa Chỉ</label>
      <textarea id="diachi" name="diachi" placeholder="Nhập địa chỉ đầy đủ" required><?= htmlspecialchars($student['diachi'] ?? '') ?></textarea>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-success"><?= $isEdit ? '✓ Cập Nhật' : '✓ Thêm Mới' ?></button>
    </div>
  </form>
</div>


</body>
</html>