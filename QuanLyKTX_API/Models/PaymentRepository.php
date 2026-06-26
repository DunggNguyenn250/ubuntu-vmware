<?php
namespace Models;

use Core\Repository;

class PaymentRepository extends Repository {
    protected $table = 'thanhtoan';
    protected $primaryKey = 'mathanhtoan';

    public function getAll() {
        $sql = "SELECT t.*, p.sophong, p.maphong FROM {$this->table} t 
                LEFT JOIN phong p ON t.maphong = p.maphong
                ORDER BY t.mathanhtoan DESC";
        return $this->fetchAll($sql);
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (maphong, sotien, ngaytra, trangthai) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sdss', 
            $data['maphong'], $data['sotien'], $data['ngaytra'], $data['trangthai']
        );
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function update($mathanhtoan, $data) {
        $sql = "UPDATE {$this->table} SET 
                maphong = ?, sotien = ?, ngaytra = ?, trangthai = ? 
                WHERE mathanhtoan = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('sdssi', 
            $data['maphong'], $data['sotien'], $data['ngaytra'], 
            $data['trangthai'], $mathanhtoan
        );
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function search($keyword) {
        $sql = "SELECT t.*, p.sophong, p.maphong FROM {$this->table} t 
                LEFT JOIN phong p ON t.maphong = p.maphong
                WHERE t.mathanhtoan LIKE ? OR p.sophong LIKE ? OR p.maphong LIKE ? OR t.trangthai LIKE ?
                ORDER BY t.mathanhtoan DESC";
        $search = '%' . $keyword . '%';
        return $this->fetchAll($sql, 'ssss', [$search, $search, $search, $search]);
    }
}
