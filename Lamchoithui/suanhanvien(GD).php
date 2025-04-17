<?php
include 'ketnoi.php';

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
$phongban = $_POST['txtphongban'];
// $hinhanh = $_POST['filehinhanhhidden'];  // Bỏ qua trường hình ảnh
$chucvu = $_POST['txtchucvu'];

// Kiểm tra dữ liệu nhập
if (!empty($manv) && !empty($hoten) && !empty($ngaysinh) && !empty($gioitinh) && !empty($quequan) && !empty($ngayvaolam) && !empty($noisinh) && !empty($sdt) && !empty($diachi) && !empty($luong) && !empty($phongban) && !empty($cccd) && !empty($ngaycap) && !empty($noicap) && !empty($email)) {

    $conn->begin_transaction(); 
    try {
        // Cập nhật thông tin nhân viên mà không cập nhật hình ảnh
        $sql = "UPDATE nhanvien SET 
                    hoten = ?, 
                    ngaysinh = ?, 
                    gioitinh = ?, 
                    quequan = ?, 
                    ngayvaolam = ?, 
                    noisinh = ?, 
                    sdt = ?, 
                    diachi = ?, 
                    luong = ?, 
                    mapb = ?, 
                    cccd = ?, 
                    ngaycap = ?, 
                    noicap = ?, 
                    email = ?, 
                    chucvu = ? 
                WHERE manv = ?";

        // Sửa lại kiểu dữ liệu trong bind_param để khớp với số lượng tham số
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssssssss", $hoten, $ngaysinh, $gioitinh, $quequan, $ngayvaolam, $noisinh, $sdt, $diachi, $luong, $phongban, $cccd, $ngaycap, $noicap, $email, $chucvu, $manv);

        if ($stmt->execute()) {
            // Cập nhật thông tin tài khoản
            $sql_taikhoan = "UPDATE taikhoan SET sdt = ?, chucvu = ? WHERE manv = ?";
            $stmt_taikhoan = $conn->prepare($sql_taikhoan);
            $stmt_taikhoan->bind_param("sss", $sdt, $chucvu, $manv);

            if ($stmt_taikhoan->execute()) {
                $conn->commit(); 
                echo "<script>
                    alert('Cập Nhật Nhân Viên Thành Công!');
                    localStorage.setItem('reload', 'true');
                    window.history.go(-1); // Quay lại trang trước
                </script>";
            } else {
                throw new Exception("Lỗi khi cập nhật tài khoản");
            }
        } else {
            throw new Exception("Lỗi khi cập nhật nhân viên");
        }
    } catch (Exception $e) {
        $conn->rollback(); 
        echo "Lỗi: " . $e->getMessage();
    }
} else {
    echo "<script>
        alert('Hãy Nhập Đủ Thông Tin');
        window.history.go(-1); // Quay lại trang trước
    </script>";
}

$conn->close(); 
?>
