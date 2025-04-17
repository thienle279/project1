<?php
header('Content-Type: application/json');

// Kết nối cơ sở dữ liệu
include 'ketnoi.php';

// Kiểm tra kết nối
if ($conn->connect_error) {
    echo json_encode(['error' => 'Không thể kết nối cơ sở dữ liệu']);
    exit;
}

// Lấy dữ liệu từ yêu cầu GET và kiểm tra đầu vào
$tennv = isset($_GET['tennv']) ? $_GET['tennv'] : '';

// Nếu không có tên nhân viên, trả về tất cả
$searchTerm = "%$tennv%";  // Thêm ký tự % cho tìm kiếm chính xác hơn

// Truy vấn dữ liệu
$sql = "SELECT tk.manv, nv.hoten, tk.sdt, nv.chucvu, pb.tenpb, tk.trangthai, tk.matkhau 
        FROM taikhoan tk 
        JOIN nhanvien nv ON nv.manv = tk.manv 
        JOIN phongban pb ON nv.mapb = pb.mapb 
        WHERE nv.hoten LIKE ? OR nv.manv LIKE ? and tk.chucvu != 'Giám Đốc'";  // Sử dụng LIKE để tìm kiếm tên nhân viên

$stmt = $conn->prepare($sql);

// Kiểm tra nếu truy vấn không hợp lệ
if (!$stmt) {
    echo json_encode(['error' => 'Truy vấn không hợp lệ']);
    exit;
}

// Gắn tham số và thực thi truy vấn
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

// Chuyển dữ liệu thành mảng JSON
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Trả kết quả JSON
if (empty($data)) {
    echo json_encode(['message' => 'Không có tài khoản phù hợp']);
} else {
    echo json_encode($data);
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
