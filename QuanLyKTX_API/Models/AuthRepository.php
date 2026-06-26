<?php
namespace Models;

use Core\Repository;

class AuthRepository extends Repository {
    protected $table = 'taikhoan_admin';
    protected $primaryKey = 'username';

    /**
     * Tìm tài khoản quản trị theo username
     */
    public function findByUsername($username) {
        $sql = "SELECT * FROM {$this->table} WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        
        return $user;
    }
}
