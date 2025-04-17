<?php
include 'ketnoi.php';

// Thiết lập header cho JSON
header('Content-Type: application/json');

// Lấy dữ liệu từ fetch và giải mã JSON
$data = json_decode(file_get_contents('php://input'), true);
$mapb = $data['mapb'];

// Kiểm tra mã phòng ban có tồn tại không
if (!$mapb) {
    echo json_encode(['success' => false, 'message' => 'Mã phòng ban không hợp lệ.']);
    exit;
}

// Bước 1: Kiểm tra xem có nhân viên nào thuộc phòng ban này không
$sql_check_nhanvien = "SELECT COUNT(*) FROM nhanvien WHERE mapb = ?";
$stmt_check_nhanvien = $conn->prepare($sql_check_nhanvien);
$stmt_check_nhanvien->bind_param('i', $mapb);
$stmt_check_nhanvien->execute();
$stmt_check_nhanvien->bind_result($nhanvien_count);
$stmt_check_nhanvien->fetch();
$stmt_check_nhanvien->close();

if ($nhanvien_count > 0) {
    echo json_encode(['success' => false, 'message' => 'Phòng ban này vẫn còn nhân viên, không thể khóa.']);
    exit;
}

// Bước 2: Kiểm tra xem có dự án nào thuộc phòng ban này không
$sql_check_duan = "SELECT COUNT(*) FROM duan WHERE phongban = ?";
$stmt_check_duan = $conn->prepare($sql_check_duan);
$stmt_check_duan->bind_param('i', $mapb);
$stmt_check_duan->execute();
$stmt_check_duan->bind_result($duan_count);
$stmt_check_duan->fetch();
$stmt_check_duan->close();

if ($duan_count > 0) {
    echo json_encode(['success' => false, 'message' => 'Phòng ban này vẫn còn dự án, không thể khóa.']);
    exit;
}

// Bước 3: Cập nhật trạng thái phòng ban
$sql_update = "UPDATE phongban SET trangthai = 'locked' WHERE mapb = ?";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param('i', $mapb);

if ($stmt_update->execute()) {
    if ($stmt_update->affected_rows > 0) {
        echo json_encode(['success' => true, 'message' => 'Trạng thái phòng ban đã được cập nhật.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không tìm thấy phòng ban hoặc trạng thái đã được khóa.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Lỗi khi cập nhật trạng thái phòng ban.']);
}

$stmt_update->close();
$conn->close();
?>
