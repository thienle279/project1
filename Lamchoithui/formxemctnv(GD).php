<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Nhân Viên</title>
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

    $manv = $_POST['manv'];
    $sql = "SELECT * FROM nhanvien nv, phongban pb WHERE nv.mapb = pb.mapb and manv = '$manv'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        
        $row['ngaysinh'] = date("Y-m-d", strtotime($row['ngaysinh']));
        $row['ngayvaolam'] = date("Y-m-d", strtotime($row['ngayvaolam']));
        $row['ngaycap'] = date("Y-m-d", strtotime($row['ngaycap']));
    }

    $conn->close();
 
    ?>
    <form action="suanhanvien(GD).php" method="POST">
    <div style="text-align: center; margin-bottom: 20px;">
    <a href="chitiethinhanh.php?manv=<?php echo urlencode($row['manv']); ?>" target="_blank">
        <img src="<?php echo $row['hinhanh']; ?>" alt="Ảnh Nhân Viên" 
            style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;">
    </a>
</div>

        
        
        <div class="input-group">
            <div>
            <label for="txtmanv">Mã Nhân Viên:</label>
        <input type="text" name="txtmanv" id="txtmanv" value="<?php echo $manv; ?>" readonly>
            </div>
            <div>
                <label for="txthoten">Họ Và Tên:</label>
                <input type="text" name="txthoten" id="txthoten" placeholder="Họ và tên" value="<?php echo $row['hoten']; ?>">
            </div>
           
        </div>

        
        <div class="input-group">
            <div>
                <label for="gioitinh">Giới Tính:</label>
                <select name="txtgioitinh" id="gioitinh">
                    <option value="" disabled>Chọn giới tính</option>
                    <option value="Nam" <?php echo $row['gioitinh'] == 'Nam' ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?php echo $row['gioitinh'] == 'Nữ' ? 'selected' : ''; ?>>Nữ</option>
                    <option value="Khác" <?php echo $row['gioitinh'] == 'Khác' ? 'selected' : ''; ?>>Khác</option>
                </select>
            </div>
            <div>
                <label for="ngaysinh">Ngày Sinh:</label>
                <input type="date" name="txtngaysinh" id="ngaysinh" value="<?php echo $row['ngaysinh']; ?>">
            </div>
            
        </div>

        <div class="input-group">
        <div>
                <label for="txtquequan">Quê Quán:</label>
                <input type="text" name="txtquequan" id="txtquequan" placeholder="Quê quán" value="<?php echo $row['quequan']; ?>">
            </div>
            <div>
                <label for="txtnoisinh">Nơi Sinh:</label>
                <input type="text" name="txtnoisinh" id="txtnoisinh" placeholder="Nơi Sinh" value="<?php echo $row['noisinh']; ?>">
            </div>
            
        </div>

        <div class="input-group">
           
            <div>
                <label for="ngayvaolam">Ngày Vào Làm:</label>
                <input type="date" name="txtngayvaolam" id="ngayvaolam" value="<?php echo $row['ngayvaolam']; ?>">
            </div>
            <div>
                <label for="txtluong">Lương Cơ Bản:</label>
                <input type="text" name="txtluong" id="txtluong" placeholder="Lương cơ bản" value="<?php echo $row['luong']; ?>">
            </div>
         
        </div>

        <div class="input-group">
        <div>
                <label for="cccd">Căn Cước Công Dân:</label>
                <input type="text" name="txtcccd" id="cccd" placeholder="Căn cước công dân" value="<?php echo $row['cccd']; ?>">
            </div>
            <div>
                
                <label for="txtngaycap">Ngày Cấp:</label>
                <input type="date" name="txtngaycap" id="txtngaycap" value="<?php echo $row['ngaycap']; ?>">
            </div>
          
        </div>

        <div class="input-group">
        <div>
                <label for="txtnoicap">Nơi Cấp:</label>
                <input type="text" name="txtnoicap" id="txtnoicap" placeholder="Nơi cấp" value="<?php echo $row['noicap']; ?>">
            </div>
            <div>
                <label for="txtemail">Email:</label>
                <input type="text" name="txtemail" id="txtemail" placeholder="Địa chỉ email" value="<?php echo $row['email']; ?>">
            </div>
           
        </div>

        <div class="input-group">
        <div>
                <label for="txtsdt">Số Điện Thoại:</label>
                <input type="text" name="txtsdt" id="txtsdt" placeholder="Số điện thoại" value="<?php echo $row['sdt']; ?>">
            </div>
            <div>
                <label for="txtdiachi">Địa Chỉ Hiện Tại:</label>
                <input type="text" name="txtdiachi" id="txtdiachi" placeholder="Địa Chỉ Hiện Tại" value="<?php echo $row['diachi']; ?>">
            </div>
        </div>

        <div class="input-group">
            <div>
                <label for="chucvu">Chức Vụ:</label>
                <select name="txtchucvu" id="chucvu">
                    <option value="<?php echo $row['chucvu']; ?>"><?php echo $row['chucvu']; ?></option>
                </select>
            </div>
            <div>
                <label for="phongban">Phòng Ban:</label>
                <select name="txtphongban" id="phongban">
                    <option value="<?php echo $row['mapb']; ?>"><?php echo $row['tenpb']; ?></option>
                </select>
            </div>
        </div>

        <button type="submit" name="uploadButton" id="uploadButton">Cập Nhật</button>
    </form>
    <div class="content"></div>
</body>
</html>



 

<script>
    document.addEventListener('DOMContentLoaded', function() {
      



        document.getElementById('uploadButton').addEventListener('click', function (event) {
                if (!validateForm()) {
                    event.preventDefault();
                } else {
                    checkExistence(); 
                }
            });

            async function checkExistence() {
    const manv = document.getElementById('txtmanv').value;
    const email = document.getElementById('email').value;
    const sdt = document.getElementById('sdt').value;
    const cccd = document.getElementById('cccd').value;
    const phongban = document.getElementById('phongban').value;
    const chucvu = document.getElementById('chucvu').value;
    try {
        const response = await fetch('kiemtra_thongtin.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `email=${encodeURIComponent(email)}&sdt=${encodeURIComponent(sdt)}&cccd=${encodeURIComponent(cccd)}&manv=${encodeURIComponent(manv)}`
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const data = await response.json();

        if (data.exists) {
            alert('Email, số điện thoại hoặc căn cước công dân đã tồn tại.');
        } else {
            if (chucvu === "Trưởng Phòng") {
              
              fetch('check_truongphong1.php', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                  },
                  body: JSON.stringify({ phongban, manv }),
              })
              .then(response => response.json())
              .then(data => {
                  if (data.hasTruongPhong) {
                      alert('Phòng ban này đã có trưởng phòng.');
                  } else {
                    const userConfirmed = confirm("Bạn có chắc chắn muốn chỉnh sửa thông tin này không?");
        if (userConfirmed) {
            document.getElementById("formthemnv").submit();        
        }          
                       }
              });
          } else {
            const userConfirmed = confirm("Bạn có chắc chắn muốn chỉnh sửa thông tin này không?");
        if (userConfirmed) {
            document.getElementById("formthemnv").submit();        
        }          
          }
           
        }
    } catch (error) {
        console.error('Lỗi khi kiểm tra dữ liệu:', error);
        alert('Có lỗi xảy ra trong quá trình kiểm tra thông tin. Vui lòng thử lại sau.');
    }
}

            
            function validateField(field, message) {
                if (field.value.trim() === '' || field.value === null) {
                    field.setCustomValidity(message);
                    field.reportValidity();
                } else {
                    field.setCustomValidity('');
                }
            }

            function validateForm() {
                let isValid = true;

                const fields = [
                    { selector: 'select[name="txtphongban"]', message: 'Hãy chọn phòng ban' },
                    { selector: 'input[name="filehinhanh"]', message: 'Hãy thêm hình ảnh' },
                    { selector: 'input[name="txtemail"]', message: 'Hãy nhập địa chỉ email' },
                    { selector: 'select[name="txtchucvu"]', message: 'Hãy chọn chức vụ' },
                    { selector: 'input[name="txtnoicap"]', message: 'Hãy nhập nơi cấp' },
                    { selector: 'input[name="txtngaycap"]', message: 'Hãy chọn ngày cấp' },
                    { selector: 'input[name="txtcccd"]', message: 'Hãy nhập CCCD' },
                    { selector: 'input[name="txtluong"]', message: 'Hãy nhập lương cơ bản' },
                    { selector: 'input[name="txtdiachi"]', message: 'Hãy nhập địa chỉ hiện tại' },
                    { selector: 'input[name="txtsdt"]', message: 'Hãy nhập số điện thoại' },
                    { selector: 'input[name="txtnoisinh"]', message: 'Hãy nhập nơi sinh' },
                    { selector: 'input[name="txtngayvaolam"]', message: 'Hãy chọn ngày vào làm' },
                    { selector: 'input[name="txtquequan"]', message: 'Hãy nhập quê quán' },
                    { selector: 'select[name="txtgioitinh"]', message: 'Hãy chọn giới tính' },
                    { selector: 'input[name="txtngaysinh"]', message: 'Hãy chọn ngày sinh' },
                    { selector: 'input[name="txthoten"]', message: 'Hãy nhập họ tên' }
                ];

                fields.forEach(field => {
                    const element = document.querySelector(field.selector);
                    if (element && (element.value.trim() === '' || element.value === null)) {
                        validateField(element, field.message);
                        isValid = false;
                    }
                });

                if (!validateDateFields()) {
                    isValid = false;
                }

                return isValid;
            }

            function validateDateFields() {
    const today = new Date();
    today.setHours(today.getHours() + 7);
    const todayString = today.toISOString().split('T')[0];

    let isValid = true;

    const ngaySinh = document.getElementById('ngaysinh');
    if (ngaySinh && ngaySinh.value > todayString) {
        ngaySinh.setCustomValidity('Ngày sinh không được lớn hơn ngày hiện tại');
        ngaySinh.reportValidity();
        isValid = false;
    } else {
        ngaySinh.setCustomValidity('');
    }

    const ngayCap = document.getElementById('ngaycap');
    if (ngayCap && ngayCap.value > todayString) {
        ngayCap.setCustomValidity('Ngày cấp không được lớn hơn ngày hiện tại');
        ngayCap.reportValidity();
        isValid = false;
    } else if (ngayCap && ngaySinh && ngayCap.value < ngaySinh.value) {
        ngayCap.setCustomValidity('Ngày cấp không thể trước ngày sinh');
        ngayCap.reportValidity();
        isValid = false;
    } else {
        ngayCap.setCustomValidity('');
    }

    const ngayVaoLam = document.getElementById('ngayvaolam');
    if (ngayVaoLam && ngayVaoLam.value > todayString) {
        ngayVaoLam.setCustomValidity('Ngày vào làm không được lớn hơn ngày hiện tại');
        ngayVaoLam.reportValidity();
        isValid = false;
    } else if (ngayVaoLam && ngaySinh && ngayVaoLam.value < ngaySinh.value) {
        ngayVaoLam.setCustomValidity('Ngày vào làm không thể trước ngày sinh');
        ngayVaoLam.reportValidity();
        isValid = false;
    } else if (ngayVaoLam && ngayCap && ngayVaoLam.value < ngayCap.value) {
        ngayVaoLam.setCustomValidity('Ngày vào làm không thể trước ngày cấp');
        ngayVaoLam.reportValidity();
        isValid = false;
    } else {
        ngayVaoLam.setCustomValidity('');
    }

    return isValid;
}


    });

    window.addEventListener('pageshow', function(event) {
            if (event.persisted || localStorage.getItem('reload') === 'true') {
                localStorage.removeItem('reload');
                location.reload();
            }
        });
</script>
