<?php
include 'ketnoi.php';

// Đọc dữ liệu từ yêu cầu POST
$data = json_decode(file_get_contents("php://input"), true);
$manv = $data['manv'];
$hinhanh = $data['hinhanh'];

if (!empty($manv) && !empty($hinhanh)) {
    // Cập nhật đường dẫn ảnh
    $sql = "UPDATE nhanvien SET hinhanh = ? WHERE manv = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hinhanh, $manv);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    $stmt->close();
} else {
    echo "invalid";
}

$conn->close();
?>
