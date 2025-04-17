<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên</title>
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color:rgb(223, 242, 235);
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Style for the form */
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            margin: 0 auto;
        }

        /* Style for the form elements */
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px; /* Space between fields */
        }

        .form-group input,
        .form-group select {
            width: 320px; /* Each input takes 48% width */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Style for the readonly input */
        input[readonly] {
            background-color: #e9e9e9;
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

        /* Responsive design for small screens */
        @media screen and (max-width: 768px) {
            form {
                width: 90%;
            }

            .form-group input,
.form-group select {
    width: 250px; /* Độ rộng cố định */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
.content{
    height: 1px;
}
        }
    </style>
</head>

<body>
  
     
    <form action="themnhanvien(GD).php" id="formthemnv" method="POST" enctype="multipart/form-data">
        <?php
        include 'ketnoi.php';
        $sql = "SELECT manv FROM nhanvien ORDER BY manv DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $manv = $row['manv'] + 1;
            }
        } else {
            $manv = 1;
        }
          include 'taskbar.php'; 
        $conn->close();
        ?>
        <div class="form-group">
            <div>
                <label for="manv">Mã Nhân Viên:</label>
                <input type="text" name="txtmanv" id="manv" value="<?php echo $manv; ?>" readonly>
            </div>
            <div>
                <label for="txthoten">Họ Và Tên:</label>
                <input type="text" name="txthoten" placeholder="Họ Và Tên" required>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="ngaysinh">Ngày Sinh:</label>
                <input type="date" name="txtngaysinh" id="ngaysinh" required>
            </div>
            <div>
                <label for="gioitinh">Giới Tính:</label>
                <select name="txtgioitinh" id="gioitinh" required>
                    <option value="" disabled selected>Chọn Giới Tính</option>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="txtquequan">Quê Quán:</label>
                <input type="text" name="txtquequan" placeholder="Quê Quán" required>
            </div>
            <div>
                <label for="ngayvaolam">Ngày Vào Làm:</label>
                <input type="date" name="txtngayvaolam" id="ngayvaolam" required>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="txtnoisinh">Nơi Sinh:</label>
                <input type="text" name="txtnoisinh" placeholder="Nơi Sinh" required>
            </div>
            <div>
                <label for="sdt">Số Điện Thoại:</label>
                <input type="text" name="txtsdt" placeholder="Số Điện Thoại" id="sdt" required>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="txtdiachi">Địa Chỉ Hiện Tại:</label>
                <input type="text" name="txtdiachi" placeholder="Địa Chỉ Hiện Tại" required>
            </div>
            <div>
                <label for="txtluong">Lương Cơ Bản:</label>
                <input type="text" name="txtluong" placeholder="Lương Cơ Bản" required>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="cccd">Căn Cước Công Dân:</label>
                <input type="text" name="txtcccd" placeholder="Căn Cước Công Dân" id="cccd" required>
            </div>
            <div>
                <label for="ngaycap">Ngày Cấp:</label>
                <input type="date" name="txtngaycap" id="ngaycap" required>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="txtnoicap">Nơi Cấp:</label>
                <input type="text" name="txtnoicap" placeholder="Nơi Cấp" required>
            </div>
            <div>
                <label for="chucvu">Chức Vụ:</label>
                <select name="txtchucvu" id="chucvu" required>
                    <option value="" disabled selected>Chọn Chức Vụ</option>
                    <option value="Nhân Viên">Nhân Viên</option>
                    <option value="Trưởng Phòng">Trưởng Phòng</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="email">Địa Chỉ Email:</label>
                <input type="email" name="txtemail" placeholder="Địa Chỉ Email" id="email" required>
            </div>
            <div>
                <label for="filehinhanh">Hình Ảnh:</label>
                <input type="file" name="filehinhanh" placeholder="Hình Ảnh" id="filehinhanh" accept="image/*" required>
                <input type="hidden" name="filehinhanhhidden" id="filehinhanhhidden">
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="phongban">Phòng Ban:</label>
                <select name="txtphongban" id="phongban" required>
                    <option value="" disabled selected>Chọn Phòng Ban</option>
                </select>
            </div>
        </div>

        <button name="uploadButton" type="button" id="uploadButton">THÊM</button>
    </form>
     
    <div class="content"></div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
             
            fetch('get_phongban.php')
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById('phongban');
                    data.forEach(chucvu => {
                        const option = document.createElement('option');
                        option.value = chucvu.value;
                        option.textContent = chucvu.name;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error('Lỗi khi lấy dữ liệu:', error));

                document.getElementById('uploadButton').addEventListener('click', function (event) {
            if (validateForm()) {
                checkExistenceAndSubmit();
            } else {
                event.preventDefault();
            }
        });

        function checkExistenceAndSubmit() {
            const email = document.getElementById('email').value;
            const sdt = document.getElementById('sdt').value;
            const cccd = document.getElementById('cccd').value;
            const phongban = document.getElementById('phongban').value;
            const chucvu = document.getElementById('chucvu').value;

          
            fetch('check_existence.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ email, sdt, cccd }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    alert('Email, Số điện thoại hoặc CCCD đã tồn tại trong CSDL.');
                } else{
                    if (chucvu === "Trưởng Phòng") {
              
                    fetch('check_truongphong.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ phongban }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.hasTruongPhong) {
                            alert('Phòng ban này đã có trưởng phòng.');
                        } else {
                            submitForm();
                        }
                    });
                } else {
                    submitForm();
                }
                }
            });
        }

        function submitForm() {
            uploadImage();  // Gọi hàm upload ảnh
        }

           
function uploadImage() {

var formData = new FormData();
formData.append("image", document.getElementById("filehinhanh").files[0]);

fetch('https://api.imgbb.com/1/upload?key=4492cd17ce112885a8956a72bf05b2a3', {
    method: 'POST',
    body: formData,
})
.then(response => response.json())
.then(data => {
 
    var imageUrl = data.data.url;


    saveImageToDatabase(imageUrl);
})
.catch(error => {
    console.error('Lỗi:', error);
});

}

function saveImageToDatabase(idh) {
var xhr = new XMLHttpRequest();
xhr.open("POST", "themnhanvien(GD).php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr.onreadystatechange = function() {
if (this.readyState === XMLHttpRequest.DONE) {
if (this.status === 200) {
    console.log("Ảnh đã được lưu trữ vào cơ sở dữ liệu.");
    


document.getElementById("filehinhanhhidden").value = idh;

    document.getElementById("formthemnv").submit();
    
} else {
    
    console.error("Lỗi khi lưu trữ ảnh vào cơ sở dữ liệu.");
}
}
};
xhr.send("idh=" + idh);
}

            
            function validateField(field, message) {
                if (field.value.trim() === '' || field.value === null) {
                    field.setCustomValidity(message);
                    field.reportValidity();
                } else {
                    field.setCustomValidity('');
                }
            }

            // Xác thực form
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
                    { selector: 'input[name="txtngaysinh"]', message: 'Hãy chọn ngày sinh' }
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

        // Xử lý lại trang
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || localStorage.getItem('reload') === 'true') {
                localStorage.removeItem('reload');
                location.reload();
            }
        });
    </script>
</body>

</html>
