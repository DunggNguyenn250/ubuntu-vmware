<?php
namespace Services;

class ExportService {
    /**
     * Xuất dữ liệu ra file CSV
     * @param string $filename Tên file
     * @param array $headers Mảng tiêu đề cột
     * @param array $data Mảng dữ liệu (mỗi phần tử là mảng chứa các giá trị)
     */
    public function exportCsv($filename, $headers, $data) {
        // Đặt header để trình duyệt hiểu đây là file tải về
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        // Thêm thẻ BOM để Excel đọc đúng tiếng Việt (UTF-8)
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Ghi tiêu đề
        fputcsv($output, $headers);
        
        // Ghi dữ liệu
        foreach ($data as $row) {
            fputcsv($output, $row);
        }
        
        fclose($output);
        exit;
    }
}
