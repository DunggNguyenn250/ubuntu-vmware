<?php
namespace Config;

class Database {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            // SỬA Ở ĐÂY: Thay 'localhost' thành 'db' (tên service trong docker-compose)
            $host = 'db'; 
            $user = 'root';
            // SỬA Ở ĐÂY: Mật khẩu root đã đặt trong file docker-compose.yml
            $pass = 'root_password'; 
            $db   = 'quanlykytucxa';
            // SỬA Ở ĐÂY: Trả về cổng mặc định chuẩn của MySQL là 3306
            $port = 3306; 

            self::$connection = new \mysqli($host, $user, $pass, $db, $port);

            if (self::$connection->connect_error) {
                die("Lỗi kết nối CSDL: " . self::$connection->connect_error);
            }
            self::$connection->set_charset("utf8");
        }
        return self::$connection;
    }
}