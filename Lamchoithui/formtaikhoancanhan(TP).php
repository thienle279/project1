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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #DFF2EB;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            margin: 0;
            padding-top: 50px;
        }

        .form-container {
            background-color: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        .form-container input[type="text"], 
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-container input:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }

        .form-container button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .form-container button:hover {
            background-color: #2980b9;
            transform: scale(1.05);
        }

        .form-container button:active {
            background-color: #216994;
            transform: scale(1);
        }

        .error-message {
            color: red;
            font-size: 14px;
            text-align: center;
        }

        .success-message {
            color: green;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
 <?php
 include 'taskbar1.php';
 ?>
    <div class="form-container">
        <h2>Đổi Mật Khẩu</h2>
        <form id="doimatkhau-form">
            <input type="text" id="tendangnhap" name="tendangnhap" placeholder="Tên đăng nhập" value="<?php echo $sdt1; ?>" required>
            <input type="password" id="matkhaucu" name="matkhaucu" placeholder="Mật khẩu cũ" required>
            <input type="password" id="matkhaumoi" name="matkhaumoi" placeholder="Mật khẩu mới" required>
            <input type="password" id="matkhaumoi2" name="matkhaumoi2" placeholder="Nhập lại mật khẩu mới" required>
            <button type="button" id="luu-btn">Lưu</button>
        </form>
        <div id="message"></div>
    </div>

    <script>
        document.getElementById('luu-btn').addEventListener('click', function () {
            // Lấy dữ liệu từ form
            const tendangnhap = document.getElementById('tendangnhap').value.trim();
            const matkhaucu = document.getElementById('matkhaucu').value.trim();
            const matkhaumoi = document.getElementById('matkhaumoi').value.trim();
            const matkhaumoi2 = document.getElementById('matkhaumoi2').value.trim();

            // Kiểm tra mật khẩu mới và nhập lại
            if (matkhaumoi !== matkhaumoi2) {
                document.getElementById('message').innerHTML = `<p class="error-message">Mật khẩu mới và mật khẩu nhập lại không khớp!</p>`;
                return;
            }

            // Tạo đối tượng FormData
            const formData = new FormData();
            formData.append('tendangnhap', tendangnhap);
            formData.append('matkhaucu', matkhaucu);
            formData.append('matkhaumoi', matkhaumoi);

            // Gửi dữ liệu qua Fetch API
            fetch('capnhattk(GD).php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json()) // Parse JSON
                .then(data => {
                    if (data.success) {
                        document.getElementById('message').innerHTML = `<p class="success-message">${data.message}</p>`;
                    } else {
                        document.getElementById('message').innerHTML = `<p class="error-message">${data.message}</p>`;
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    document.getElementById('message').innerHTML = `<p class="error-message">Đã xảy ra lỗi, vui lòng thử lại!</p>`;
                });
        });
    </script>
</body>
</html>
