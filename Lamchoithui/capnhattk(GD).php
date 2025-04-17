<?php
header('Content-Type: application/json');
include 'ketnoi.php';

$tendangnhap = $_POST['tendangnhap'];
$matkhaucu = $_POST['matkhaucu'];
$matkhaumoi = $_POST['matkhaumoi'];

// Kiểm tra người dùng
$sql = "SELECT matkhau FROM taikhoan WHERE sdt = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $tendangnhap);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    if ($row['matkhau'] === $matkhaucu) {
       
        $updateSql = "UPDATE taikhoan SET matkhau = ? WHERE sdt = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ss", $matkhaumoi, $tendangnhap);

        if ($updateStmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Đổi mật khẩu thành công!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Cập nhật thất bại, thử lại sau!']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Mật khẩu cũ không đúng!']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Tên đăng nhập không tồn tại!']);
}

$stmt->close();
$conn->close();
