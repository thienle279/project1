<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['sdt'])) {
    echo "<script>
        alert('Vui lòng đăng nhập!');
        window.location.href = 'formdangnhap.php';
    </script>";
    exit();
}

$sdt1 = htmlspecialchars($_SESSION['sdt']); // Sử dụng htmlspecialchars để bảo mật
include 'ketnoi.php';

// Lấy thông tin phòng ban của người dùng đăng nhập
$sql = "SELECT * FROM nhanvien WHERE sdt = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $sdt1);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $mapb = $row['mapb']; // Lấy mã phòng ban
} else {
    echo "<script>
        alert('Không tìm thấy thông tin nhân viên.');
        window.history.go(-1);
    </script>";
    exit();
}
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $manv = $_POST['txtmanv'];
    $hoten = $_POST['txthoten'];
    $ngaysinh = $_POST['txtngaysinh'];
    $gioitinh = $_POST['txtgioitinh'];
    $quequan = $_POST['txtquequan'];
    $ngayvaolam = $_POST['txtngayvaolam'];
    $noisinh = $_POST['txtnoisinh'];
    $sdt = $_POST['txtsdt'];
    $diachi = $_POST['txtdiachi'];
    $luong = $_POST['txtluong'];
    $cccd = $_POST['txtcccd'];
    $ngaycap = $_POST['txtngaycap'];
    $noicap = $_POST['txtnoicap'];
    $email = $_POST['txtemail'];
    $hinhanh = $_POST['filehinhanhhidden'];
    $chucvu = 'Nhân Viên';

    if (!empty($hoten) && !empty($ngaysinh) && !empty($gioitinh) && !empty($quequan) && !empty($ngayvaolam) && !empty($noisinh) && !empty($sdt) && !empty($diachi) && !empty($luong) && !empty($hinhanh) && !empty($cccd) && !empty($ngaycap) && !empty($noicap) && !empty($email)) {

        $conn->begin_transaction(); // Bắt đầu giao dịch
        try {
            // Thêm nhân viên vào bảng `nhanvien`
            $stmt_nhanvien = $conn->prepare("INSERT INTO nhanvien (hoten, ngaysinh, gioitinh, quequan, ngayvaolam, noisinh, sdt, diachi, luong, mapb, hinhanh, trangthai, cccd, ngaycap, noicap, email, chucvu) 
                                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Đang Làm Việc', ?, ?, ?, ?, ?)");
            $stmt_nhanvien->bind_param("ssssssssssssssss", $hoten, $ngaysinh, $gioitinh, $quequan, $ngayvaolam, $noisinh, $sdt, $diachi, $luong, $mapb, $hinhanh, $cccd, $ngaycap, $noicap, $email, $chucvu);
            if (!$stmt_nhanvien->execute()) {
                throw new Exception("Lỗi khi thêm nhân viên: " . $stmt_nhanvien->error);
            }

            // Lấy `manv` vừa được thêm (nếu là AUTO_INCREMENT)
            $manv = $conn->insert_id;

            // Thêm tài khoản vào bảng `taikhoan`
            $stmt_taikhoan = $conn->prepare("INSERT INTO taikhoan (sdt, matkhau, manv, trangthai, chucvu) VALUES (?, '1111', ?, 'Đang Làm Việc', ?)");
            $stmt_taikhoan->bind_param("sss", $sdt, $manv, $chucvu);
            if (!$stmt_taikhoan->execute()) {
                throw new Exception("Lỗi khi tạo tài khoản: " . $stmt_taikhoan->error);
            }

            $conn->commit(); // Hoàn thành giao dịch
            echo "<script>
                alert('Thêm Nhân Viên Thành Công!');
                localStorage.setItem('reload', 'true');
                window.history.go(-1);
            </script>";

        } catch (Exception $e) {
            $conn->rollback(); // Khôi phục nếu lỗi
            echo "<script>
                alert('Lỗi: " . $e->getMessage() . "');
                window.history.go(-1);
            </script>";
        }

        $stmt_nhanvien->close();
        $stmt_taikhoan->close();
    } else {
        echo "<script>
            alert('Hãy Nhập Đủ Thông Tin');
            window.history.go(-1);
        </script>";
    }
} else {
    echo "<script>
        alert('Yêu cầu không hợp lệ');
        window.history.go(-1);
    </script>";
}

$conn->close();
?>
