<?php
include 'ketnoi.php'; // Kết nối đến cơ sở dữ liệu

if (isset($_GET['tennv']) && isset($_GET['phongban'])) {
    $tennv = $_GET['tennv'];
    $phongban = $_GET['phongban'];

    // Chuẩn bị câu truy vấn SQL
    $sql = "SELECT nv.*, pb.tenpb 
            FROM nhanvien nv 
            JOIN phongban pb ON nv.mapb = pb.mapb 
            WHERE (nv.hoten LIKE ? OR nv.sdt LIKE ? OR nv.manv LIKE ?) 
            AND nv.mapb = ? AND nv.chucvu = 'Nhân Viên'";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $searchTerm = "%" . $tennv . "%";

        // Gắn tham số cho câu truy vấn
        $stmt->bind_param('ssss', $searchTerm, $searchTerm, $searchTerm, $phongban);
        $stmt->execute();
        $result = $stmt->get_result();

        // Tạo mảng để chứa danh sách nhân viên
        $nhanvienList = [];
        while ($row = $result->fetch_assoc()) {
            // Định dạng lại ngày sinh sang DD/MM/YYYY
            $ngaysinh = date('d/m/Y', strtotime($row['ngaysinh']));
            
            $nhanvienList[] = [
                'manv' => $row['manv'],
                'hinhanh' => $row['hinhanh'],
                'hoten' => $row['hoten'],
                'ngaysinh' => $ngaysinh, // Ngày sinh đã được định dạng
                'gioitinh' => $row['gioitinh'],
                'chucvu' => $row['chucvu'],
                'email' => $row['email'],
                'trangthai' => $row['trangthai'],
                'tenpb' => $row['tenpb'], // Tên phòng ban
            ];
        }

        // Trả về dữ liệu dưới dạng JSON
        header('Content-Type: application/json');
        echo json_encode($nhanvienList);

        // Đóng statement và kết nối
        $stmt->close();
    } else {
        // Trường hợp không thể chuẩn bị truy vấn, trả về lỗi
        echo json_encode(['error' => 'Không thể thực hiện truy vấn']);
    }

    $conn->close();
} else {
    // Trường hợp không nhận được tham số cần thiết, trả về lỗi
    echo json_encode(['error' => 'Thiếu tham số tennv hoặc phongban']);
}
?>
