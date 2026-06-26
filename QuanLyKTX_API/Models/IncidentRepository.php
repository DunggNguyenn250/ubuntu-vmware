<?php
namespace Models;

use Core\Repository;

class IncidentRepository extends Repository {
    protected $table = 'suco';
    protected $primaryKey = 'masuco';

    public function generateNextMaSuCo() {
        $sql = "SELECT masuco FROM {$this->table} ORDER BY masuco DESC LIMIT 1";
        $result = $this->db->query($sql);
        if ($row = $result->fetch_assoc()) {
            return intval($row['masuco']) + 1;
        }
        return 1;
    }

    public function getAll() {
        $sql = "SELECT s.*, p.sophong, p.toa, p.maphong FROM {$this->table} s 
                LEFT JOIN phong p ON s.maphong = p.maphong 
                ORDER BY s.masuco ASC";
        return $this->fetchAll($sql);
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (maphong, mota, ngaybao, trangthai) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssss', 
            $data['maphong'], $data['mota'], $data['ngaybao'], $data['trangthai']
        );
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function update($masuco, $data) {
        $sql = "UPDATE {$this->table} SET 
                maphong = ?, mota = ?, ngaybao = ?, trangthai = ? 
                WHERE masuco = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssssi', 
            $data['maphong'], $data['mota'], $data['ngaybao'], 
            $data['trangthai'], $masuco
        );
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function search($keyword) {
        $sql = "SELECT s.*, p.sophong, p.toa, p.maphong FROM {$this->table} s 
                LEFT JOIN phong p ON s.maphong = p.maphong 
                WHERE s.masuco LIKE ? OR s.maphong LIKE ? OR s.mota LIKE ? OR p.sophong LIKE ?
                ORDER BY s.masuco ASC";
        $search = '%' . $keyword . '%';
        return $this->fetchAll($sql, 'ssss', [$search, $search, $search, $search]);
    }
}
