<?php
namespace Models;

use Core\Repository;

class StudentRepository extends Repository {
    protected $table = 'sinhvien';
    protected $primaryKey = 'masv';

    public function generateNextMaSV() {
        $sql = "SELECT masv FROM {$this->table} ORDER BY LENGTH(masv) DESC, masv DESC LIMIT 1";
        $result = $this->db->query($sql);
        if ($row = $result->fetch_assoc()) {
            $lastMa = $row['masv'];
            if (preg_match('/^SV(\d+)$/i', $lastMa, $matches)) {
                $number = intval($matches[1]) + 1;
                $length = strlen($matches[1]);
                $nextSo = str_pad($number, $length, '0', STR_PAD_LEFT);
                return 'SV' . $nextSo;
            }
        }
        return 'SV001';
    }

    public function getAllStudents() {
        $sql = "SELECT * FROM {$this->table} ORDER BY LENGTH(masv) ASC, masv ASC";
        return $this->fetchAll($sql);
    }

    public function getEligibleStudents() {
        $sql = "SELECT s.* FROM {$this->table} s 
                WHERE s.masv NOT IN (
                    SELECT masv FROM hopdong WHERE trangthai = 'Đang Hoạt Động'
                )
                ORDER BY LENGTH(s.masv) ASC, s.masv ASC";
        return $this->fetchAll($sql);
    }

    public function create($data) {
        $sql = "INSERT INTO {$this->table} (masv, hoten, lop, gioitinh, cccd, sodienthoai, email, diachi) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssssssss', 
            $data['masv'], $data['hoten'], $data['lop'], $data['gioitinh'], 
            $data['cccd'], $data['sodienthoai'], $data['email'], $data['diachi']
        );
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function update($masv, $data) {
        $sql = "UPDATE {$this->table} SET 
                hoten=?, lop=?, gioitinh=?, cccd=?, sodienthoai=?, email=?, diachi=? 
                WHERE masv=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssssssss', 
            $data['hoten'], $data['lop'], $data['gioitinh'], 
            $data['cccd'], $data['sodienthoai'], $data['email'], $data['diachi'], 
            $masv
        );
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function search($keyword) {
        $sql = "SELECT * FROM {$this->table} 
                WHERE masv LIKE ? OR hoten LIKE ? OR cccd LIKE ? OR sodienthoai LIKE ?
                ORDER BY LENGTH(masv) ASC, masv ASC";
        $search = '%' . $keyword . '%';
        return $this->fetchAll($sql, 'ssss', [$search, $search, $search, $search]);
    }
}
