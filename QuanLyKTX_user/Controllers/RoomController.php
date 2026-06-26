<?php
/**
 * Room Controller (Phía Sinh Viên - User)
 * Sinh viên xem DANH SÁCH TẤT CẢ CÁC PHÒNG để tra cứu giá/thông tin (Trạng thái Read Only).
 */
require_once __DIR__ . '/../Models/Room.php';

class RoomController extends Controller {
    private $roomModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!$this->getSession('user_id')) {
            $this->redirect(BASE_URL . 'auth');
        }
        $this->roomModel = new RoomModel();
    }

    public function index() {
        $rooms = $this->roomModel->timphong();

        if (!$rooms || empty($rooms)) {
            $_SESSION['error'] = 'Không tìm thấy thông tin phòng.';
            $this->redirect(BASE_URL . 'auth/dashboard');
            return;
        }

        $room = $rooms[0] ?? null;

        $this->view('room/list', [
            'title' => 'Thông tin Phòng của tôi',
            'room'  => $room
        ]);
    }
}