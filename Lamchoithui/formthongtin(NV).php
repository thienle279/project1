<?php 
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['sdt'])) {
    // Nếu chưa đăng nhập, thông báo và chuyển hướng
    echo "<script>
        alert('Vui lòng đăng nhập!');
        window.location.href = 'formdangnhap.php';
    </script>";
    exit(); // Sử dụng exit() thay cho die() để dừng thực thi mã
}

// Nếu đã đăng nhập, lưu số điện thoại vào biến
$sdt1 = htmlspecialchars($_SESSION['sdt']); // Sử dụng htmlspecialchars để bảo mật

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ Sơ Nhân Viên</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        
            background-color:rgb(223, 242, 235);
            padding: 20px;
    }
    form {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        max-width: 800px;
        margin: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }
    label {
        display: block;
        font-weight: bold;
        margin: 5px 0;
        color: #333;
    }
    input, select, button {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;  /* Khoảng cách 10px giữa các input */
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        box-sizing: border-box;
    }
    input:focus, select:focus {
        border-color: #28a745;
        outline: none;
    }
    button {
            background-color: rgb(122, 178, 211);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 20px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: rgb(74, 98, 138);
        }
    .input-group {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    .input-group > div {
        flex: 1;
        min-width: 200px;  /* Đảm bảo các ô nhập liệu có độ rộng nhất định */
    }
    .input-group div label {
        font-weight: normal;
    }
    .input-group div input, .input-group div select {
        width: 100%;
    }
    .input-group div {
        padding: 5px;
    }
    .form-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
</style>

</head>
<body>
<?php
    include 'ketnoi.php';

   
    $sql = "SELECT * FROM nhanvien nv, phongban pb WHERE nv.mapb = pb.mapb and sdt = '$sdt1'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        
        $row['ngaysinh'] = date("d-m-Y", strtotime($row['ngaysinh']));
        $row['ngayvaolam'] = date("d-m-Y", strtotime($row['ngayvaolam']));
        $row['ngaycap'] = date("d-m-Y", strtotime($row['ngaycap']));
    }

    $conn->close();
     include 'taskbar2.php';
    ?>
    <form action="suanhanvien(GD).php" method="POST">
    <div style="text-align: center; margin-bottom: 20px;">
     
        <img src="<?php echo $row['hinhanh']; ?>" alt="Ảnh Nhân Viên" 
            style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
    
</div>

        
        
<div class="input-group">
    <div>
        <label for="txtmanv">Mã Nhân Viên:</label>
        <input type="text" name="txtmanv" id="txtmanv" value="<?php echo $row['manv']; ?>" readonly>
    </div>
    <div>
        <label for="txthoten">Họ Và Tên:</label>
        <input type="text" name="txthoten" id="txthoten" value="<?php echo $row['hoten']; ?>" readonly>
    </div>
</div>

<div class="input-group">
    <div>
        <label for="gioitinh">Giới Tính:</label>
        <input type="text" name="txtgioitinh" id="gioitinh" value="<?php echo $row['gioitinh']; ?>" readonly>
    </div>
    <div>
        <label for="ngaysinh">Ngày Sinh:</label>
        <input type="text" name="txtngaysinh" id="ngaysinh" value="<?php echo $row['ngaysinh']; ?>" readonly>
    </div>
</div>

<div class="input-group">
    <div>
        <label for="txtquequan">Quê Quán:</label>
        <input type="text" name="txtquequan" id="txtquequan" value="<?php echo $row['quequan']; ?>" readonly>
    </div>
    <div>
        <label for="txtnoisinh">Nơi Sinh:</label>
        <input type="text" name="txtnoisinh" id="txtnoisinh" value="<?php echo $row['noisinh']; ?>" readonly>
    </div>
</div>

<div class="input-group">
    <div>
        <label for="ngayvaolam">Ngày Vào Làm:</label>
        <input type="text" name="txtngayvaolam" id="ngayvaolam" value="<?php echo $row['ngayvaolam']; ?>" readonly>
    </div>
    <div>
        <label for="txtluong">Lương Cơ Bản:</label>
        <input type="text" name="txtluong" id="txtluong" value="<?php echo $row['luong']; ?>" readonly>
    </div>
</div>

<div class="input-group">
    <div>
        <label for="cccd">Căn Cước Công Dân:</label>
        <input type="text" name="txtcccd" id="cccd" value="<?php echo $row['cccd']; ?>" readonly>
    </div>
    <div>
        <label for="txtngaycap">Ngày Cấp:</label>
        <input type="text" name="txtngaycap" id="txtngaycap" value="<?php echo $row['ngaycap']; ?>" readonly>
    </div>
</div>

<div class="input-group">
    <div>
        <label for="txtnoicap">Nơi Cấp:</label>
        <input type="text" name="txtnoicap" id="txtnoicap" value="<?php echo $row['noicap']; ?>" readonly>
    </div>
    <div>
        <label for="txtemail">Email:</label>
        <input type="text" name="txtemail" id="txtemail" value="<?php echo $row['email']; ?>" readonly>
    </div>
</div>

<div class="input-group">
    <div>
        <label for="txtsdt">Số Điện Thoại:</label>
        <input type="text" name="txtsdt" id="txtsdt" value="<?php echo $row['sdt']; ?>" readonly>
    </div>
    <div>
        <label for="txtdiachi">Địa Chỉ Hiện Tại:</label>
        <input type="text" name="txtdiachi" id="txtdiachi" value="<?php echo $row['diachi']; ?>" readonly>
    </div>
</div>

<div class="input-group">
    <div>
        <label for="chucvu">Chức Vụ:</label>
        <input type="text" name="txtchucvu" id="chucvu" value="<?php echo $row['chucvu']; ?>" readonly>
    </div>
    <div>
        <label for="phongban">Phòng Ban:</label>
        <input type="text" name="txtphongban" id="phongban" value="<?php echo $row['tenpb']; ?>" readonly>
    </div>
</div>

        
    </form>
    <div class="content"></div>
</body>
</html>
 

