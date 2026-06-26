<?php
namespace Services;

use Models\AuthRepository;

class AuthService {
    private $authRepo;

    public function __construct() {
        $this->authRepo = new AuthRepository();
    }

    /**
     * Xác thực thông tin đăng nhập
     */
    public function authenticate($username, $password) {
        if (empty($username) || empty($password)) {
            throw new \Exception("Tên đăng nhập và mật khẩu không được để trống!");
        }

        $user = $this->authRepo->findByUsername($username);

        if (!$user) {
            throw new \Exception("Tên đăng nhập không tồn tại!");
        }

        // Mật khẩu lưu dạng MD5 trong database
        if ($user['password'] !== md5($password)) {
            throw new \Exception("Mật khẩu không chính xác!");
        }

        return $user;
    }
}
