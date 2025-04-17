<?php
include 'ketnoi.php';

// Kiểm tra xem giá trị 'mapb' có tồn tại trong URL không
if (isset($_GET['mapb'])) {
    $mapb = $conn->real_escape_string($_GET['mapb']);  // Escape giá trị để tránh SQL Injection

    // Câu lệnh SQL đã được sửa để thêm điều kiện AND
    $sql = "SELECT mapb, tenpb FROM phongban WHERE mapb != '$mapb' AND trangthai != 'locked'";

    // Thực thi câu lệnh SQL
    $result = $conn->query($sql);

    // Mảng để lưu danh sách phòng ban
    $phongbanList = [];
    
    // Kiểm tra nếu có dữ liệu
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $phongbanList[] = [
                'mapb' => $row['mapb'],
                'tenpb' => $row['tenpb'],
            ];
        }
    }

    // Trả về dữ liệu dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($phongbanList);
} else {
    // Nếu không có tham số 'mapb' trong URL
    echo json_encode(["error" => "Không có mã phòng ban (mapb)"]);
}

// Đóng kết nối
$conn->close();
?>
