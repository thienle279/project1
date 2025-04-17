<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'ketnoi.php';  

    // Nhận dữ liệu JSON từ body của request
    $inputData = json_decode(file_get_contents('php://input'), true);

    // Kiểm tra xem dữ liệu đã được gửi đúng cách chưa
    if (isset($inputData['manv']) && isset($inputData['mapb'])) {
        $manv = $inputData['manv'];
        $mapb = $inputData['mapb'];

        $sql = "UPDATE nhanvien SET mapb = ? WHERE manv = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $mapb, $manv);

        if ($stmt->execute()) {
            // Trả về phản hồi dưới dạng JSON khi thành công
            echo json_encode(['status' => 'success', 'message' => 'Chuyển phòng ban thành công.']);
        } else {
            // Trả về phản hồi lỗi dưới dạng JSON
            echo json_encode(['status' => 'error', 'message' => 'Lỗi khi chuyển phòng ban.']);
        }

        $stmt->close();
    } else {
        // Trả về phản hồi lỗi nếu thiếu dữ liệu
        echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ.']);
    }

    $conn->close();
}
?>
