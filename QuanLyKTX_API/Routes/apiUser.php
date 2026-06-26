<?php
// Routes/apiUser.php

require_once __DIR__ . '/../Core/Controller.php';      // ✅ Base class trước
require_once __DIR__ . '/../Models/UserRepository.php'; // ✅ Repositories
require_once __DIR__ . '/../Controllers/UserController.php'; // ✅ Controller sau

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Xử lý preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$controller = new UserController(); // ✅ Giữ nguyên
$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'login':
        // POST: masv, password
        $controller->login();
        break;

    case 'student':
        // GET/POST: masv
        $controller->student();
        break;

    case 'student_update':
        // POST: masv, hoten, lop, gioitinh, cccd, sodienthoai, email, diachi
        $controller->student_update();
        break;

    case 'change_password':
        // POST: masv, old_password, new_password
        $controller->change_password();
        break;

    case 'room':
        // GET/POST: masv
        $controller->room();
        break;

    case 'contract':
        // GET/POST: masv
        $controller->contract();
        break;

    case 'incident':
        // GET/POST: masv
        $controller->incident();
        break;

    case 'reportIncident':
        // POST: masv, maphong, mota, ngaybao
        $controller->reportIncident();
        break;

    default:
        http_response_code(404);
        echo json_encode([
            'status'  => 'error',
            'message' => "Action '$action' không tồn tại",
            'available_actions' => [
                'login', 'student', 'student_update', 'change_password',
                'room', 'contract', 'incident', 'reportIncident'
            ]
        ]);
        break;
}