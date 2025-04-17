<?php
include 'ketnoi.php';

// Bật hiển thị lỗi (chỉ sử dụng khi debug)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu JSON từ body
    $data = json_decode(file_get_contents('php://input'), true);
    $manv = $data['manv'] ?? null;

    if (!empty($manv)) {
        try {
            // Kiểm tra trạng thái hiện tại của tài khoản
            $sql_check = "SELECT trangthai FROM taikhoan WHERE manv = ?";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bind_param("s", $manv);
            $stmt_check->execute();
            $stmt_check->store_result();
            $stmt_check->bind_result($current_status);

            if ($stmt_check->num_rows > 0) {
                $stmt_check->fetch(); // Lấy trạng thái hiện tại

                // Kiểm tra trạng thái và cập nhật
                if ($current_status === 'Đã Nghỉ Việc') {
                    // Nếu trạng thái là "Đã Nghỉ Việc", cập nhật thành "Đang Làm Việc"
                    $sql_update = "UPDATE taikhoan SET trangthai = 'Đang Làm Việc' WHERE manv = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param("s", $manv);

                    if ($stmt_update->execute()) {
                        echo json_encode([
                            'success' => true,
                            'message' => 'Tài khoản đã được khôi phục thành công.'
                        ]);
                    } else {
                        echo json_encode([
                            'success' => false,
                            'message' => 'Không thể cập nhật trạng thái tài khoản.'
                        ]);
                    }

                    $stmt_update->close();
                } elseif ($current_status === 'Đang Làm Việc') {
                    // Nếu trạng thái là "Đang Làm Việc", cập nhật thành "Đã Nghỉ Việc"
                    $sql_update = "UPDATE taikhoan SET trangthai = 'Đã Nghỉ Việc' WHERE manv = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param("s", $manv);

                    if ($stmt_update->execute()) {
                        echo json_encode([
                            'success' => true,
                            'message' => 'Tài khoản đã được khóa thành công.'
                        ]);
                    } else {
                        echo json_encode([
                            'success' => false,
                            'message' => 'Không thể cập nhật trạng thái tài khoản.'
                        ]);
                    }

                    $stmt_update->close();
                } else {
                    // Nếu trạng thái không phải "Đang Làm Việc" hoặc "Đã Nghỉ Việc"
                    echo json_encode([
                        'success' => false,
                        'message' => 'Trạng thái tài khoản không hợp lệ.'
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Mã tài khoản không tồn tại.'
                ]);
            }

            $stmt_check->close();
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Mã tài khoản không hợp lệ hoặc không được cung cấp.'
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
