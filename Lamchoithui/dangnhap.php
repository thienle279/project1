<?php
session_start();
include 'ketnoi.php';
$sdt = $_POST['txtsdt'];
$pass = $_POST['txtpass'];

if (!empty($sdt) && !empty($pass)) {
    $sql = "SELECT * FROM taikhoan WHERE sdt = '$sdt' AND matkhau = '$pass'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['trangthai'] === 'Đã Nghỉ Việc') {
                echo "<script>
                    alert('Tài Khoản Của Bạn Đã Bị Khóa!');
                    window.history.go(-1);
                </script>";
                die();
            }
            // Lưu thông tin người dùng vào session
            $_SESSION['sdt'] = $sdt;
            $_SESSION['chucvu'] = $row['chucvu'];

            if ($row['chucvu'] === 'Giám Đốc') {
                header("Location: formdsnhanvien(GD).php?");
                die();
            } elseif ($row['chucvu'] === 'Trưởng Phòng') {
                header("Location: formdsnhanvien(TP).php?");
                die();
            } elseif ($row['chucvu'] === 'Nhân Viên') {
                header("Location: formthongtin(NV).php");
                die();
            }
        }
    } else {
        echo "<script>
            alert('Tên Đăng Nhập Hoặc Mật Khẩu Không Đúng!');
            window.history.go(-1);
        </script>";
    }
} else {
    echo "<script>
        alert('Hãy Nhập Đủ Thông Tin');
        window.history.go(-1);
    </script>";
}
?>
