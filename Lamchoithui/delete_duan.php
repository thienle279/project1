<?php
include 'ketnoi.php';

// Bật hiển thị lỗi (chỉ sử dụng khi debug)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu JSON từ body
    $data = json_decode(file_get_contents('php://input'), true);
    $mada = $data['mada'] ?? null;

    if (!empty($mada)) {
        try {
            // Cập nhật trạng thái dự án thành "Đã Xóa"
            $sql = "UPDATE duan SET status = 'Đã Xóa' WHERE mada = ?";
            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new Exception('Chuẩn bị truy vấn thất bại: ' . $conn->error);
            }

            $stmt->bind_param("s", $mada);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Dự án đã được xóa thành công.'
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Không có dự án nào được cập nhật. Mã dự án có thể không tồn tại.'
                    ]);
                }
            } else {
                throw new Exception('Thực thi truy vấn thất bại: ' . $stmt->error);
            }

            $stmt->close();
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Mã dự án không hợp lệ hoặc không được cung cấp.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Phương thức không hợp lệ. Chỉ hỗ trợ POST.'
    ]);
}

$conn->close();
?>
