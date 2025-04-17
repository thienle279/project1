<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'ketnoi.php';  

    $manv = $_POST['manv']; // Mã nhân viên sẽ được chọn làm trưởng phòng
    $mapb = $_POST['mapb']; // Mã phòng ban

    // Bắt đầu giao dịch
    $conn->begin_transaction();

    try {
        // Bước 1: Cập nhật tất cả nhân viên trong phòng ban này thành 'Nhân Viên'
        $sql = "UPDATE nhanvien SET chucvu = 'Nhân Viên' WHERE mapb = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $mapb);
        
        // Thực hiện Bước 1
        if ($stmt->execute()) {
            // Bước 2: Cập nhật nhân viên được chọn thành 'Trưởng Phòng'
            $sql = "UPDATE nhanvien SET chucvu = 'Trưởng Phòng' WHERE mapb = ? AND manv = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $mapb, $manv);
            
            // Thực hiện Bước 2
            if ($stmt->execute()) {
                // Bước 3: Cập nhật bảng `taikhoan` cho tất cả nhân viên trong phòng ban
                $sql = "SELECT manv FROM nhanvien WHERE mapb = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $mapb);
                $stmt->execute();
                $result = $stmt->get_result();

                // Cập nhật `taikhoan` cho tất cả nhân viên trong phòng ban
                while ($row = $result->fetch_assoc()) {
                    $manv_emp = $row['manv'];
                    $sql = "UPDATE taikhoan SET chucvu = 'Nhân Viên' WHERE manv = ?";
                    $stmt_taikhoan = $conn->prepare($sql);
                    $stmt_taikhoan->bind_param('s', $manv_emp);
                    if (!$stmt_taikhoan->execute()) {
                        throw new Exception('Lỗi khi cập nhật tài khoản cho nhân viên.');
                    }
                }

                // Cập nhật lại cho nhân viên làm trưởng phòng trong bảng `taikhoan`
                $sql = "UPDATE taikhoan SET chucvu = 'Trưởng Phòng' WHERE manv = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('s', $manv);
                if ($stmt->execute()) {
                    // Commit giao dịch nếu mọi thứ đều ổn
                    $conn->commit();
                    // Trả về thông báo thành công
                    echo json_encode(["status" => "success", "message" => "Cập nhật trưởng phòng thành công."]);
                }

            } else {
                throw new Exception('Lỗi khi cập nhật trưởng phòng.');
            }

        } else {
            throw new Exception('Lỗi khi cập nhật trạng thái nhân viên.');
        }

    } catch (Exception $e) {
        // Nếu có lỗi, hoàn tác giao dịch
        $conn->rollback();
        // Trả về lỗi
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }

    // Đóng statement và kết nối
    $stmt->close();
    $conn->close();
}
?>
