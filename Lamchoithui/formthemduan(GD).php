
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Thêm Dự Án</title>
    <style>
body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(to bottom, #DFF2EB, #B8E5CF);
    color: #333;
    margin: 0;
    padding: 20px;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background: #f2f2f2;  
    border-radius: 10px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.table-container {
    max-width: 1400px;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    border: 2px solid rgb(122, 178, 211);  
}

th, td {
    padding: 12px;
    text-align: center;
    border: 2px solid rgb(122, 178, 211);  
    font-size: 16px;
}

th {
    background-color: rgb(122, 178, 211);  
    color: white;
    text-transform: uppercase;
}

td {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #e1f5fe;  
}

.search-bar1, .search-bar2 {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 20px;
}

input[type="text"], input[type="date"], select {
    padding: 10px 15px;
    border: 2px solid #ddd;
    border-radius: 5px;
    width: 250px;
    font-size: 14px;
    transition: border-color 0.3s, box-shadow 0.3s;
}

input[type="text"]:focus, input[type="date"]:focus, select:focus {
    border-color: #00aaff;
    box-shadow: 0 0 5px rgba(0, 170, 255, 0.5);
}

 

.label-box {
    background: #f5f5f5;
    padding: 15px 20px;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    font-size: 16px;
    font-weight: bold;
    color: #2c3e50;
    transition: all 0.3s;
}

.label-box:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

@media (max-width: 768px) {
    .search-bar1, .search-bar2 {
        flex-direction: column;
    }

    input[type="text"], input[type="date"], select {
        width: 100%;
    }

    table {
        font-size: 12px;
    }
}

/* CSS cho search-bar */
.search-bar1, .search-bar2 {
    display: grid; /* Sử dụng grid layout */
    grid-template-columns: 150px auto; /* 150px cho cột nhãn, phần còn lại cho input */
    gap: 10px; /* Khoảng cách giữa nhãn và input */
    align-items: center; /* Căn giữa nhãn và input theo chiều dọc */
    margin-bottom: 20px; /* Khoảng cách giữa các nhóm search-bar */
}

/* CSS cho các trường input, select */
.search-bar1 input[type="text"],
.search-bar2 input[type="text"], 
.search-bar2 input[type="date"], 
.search-bar2 select {
    padding: 8px; /* Nội dung trong input có khoảng cách thoải mái */
    border: 2px solid #ddd; /* Viền nhẹ nhàng */
    border-radius: 5px; /* Bo góc input */
    font-size: 14px; /* Kích thước chữ dễ đọc */
    width: 50%; /* Input chiếm toàn bộ chiều rộng của cột */
    box-sizing: border-box; /* Đảm bảo padding không làm thay đổi kích thước input */
}

/* CSS cho nhãn */
label {
    font-weight: bold; /* Tô đậm nhãn */
    color: #333; /* Màu chữ dễ nhìn */
}

/* CSS cho toàn bộ form để căn chỉnh */
 
.search-bar2
{
margin-top: 20px;
}
/* CSS cho nút bấm */
/* Kiểu dáng nút */
/* Kiểu dáng chung cho các nút */
button {
    background: none; /* Xóa nền nút */
    border: none; /* Xóa viền nút */
    cursor: pointer; /* Con trỏ thành tay khi hover */
    padding: 5px;
    margin: 0 5px; /* Khoảng cách giữa các nút */
}

/* Kích thước và màu biểu tượng */
button i {
    font-size: 18px; /* Kích thước icon */
    color: #333; /* Màu mặc định cho nút */
}

/* Màu và hiệu ứng cho nút "Xem Thông Tin" */
button.xemttnv i {
    color: black; /* Màu xanh */
}

button.xemttnv:hover i {
    color: black; /* Màu xanh đậm khi hover */
    transform: scale(1.2); /* Phóng to icon nhẹ khi hover */
    transition: all 0.2s ease-in-out;
}

/* Màu và hiệu ứng cho nút "Xóa" */
button.delete-btn i {
    color: #FF0000; /* Màu đỏ */
}

button.delete-btn:hover i {
    color: #B22222; /* Màu đỏ đậm khi hover */
    transform: scale(1.2); /* Phóng to icon nhẹ khi hover */
    transition: all 0.2s ease-in-out;
}


/* Bọc select và nút */
.select-wrapper {
    display: flex; /* Sử dụng flexbox để xếp cạnh nhau */
    align-items: center; /* Căn giữa theo chiều dọc */
    gap: 8px; /* Khoảng cách giữa select và nút */
}

/* Kiểu dáng cho select */
.select-wrapper select {
    font-size: 16px;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
}

/* Kiểu dáng nút vuông */
button.btn-chon {
    width: 40px; /* Chiều rộng nút */
    height: 40px; /* Chiều cao nút (tạo hình vuông) */
    background-color: #28a745; /* Màu nền xanh lá */
    border: none; /* Xóa viền */
    border-radius: 4px; /* Bo tròn nhẹ */
    display: flex; /* Đặt icon giữa nút */
    align-items: center; /* Căn giữa theo chiều dọc */
    justify-content: center; /* Căn giữa theo chiều ngang */
    cursor: pointer; /* Con trỏ tay khi hover */
}

/* Màu sắc và kích thước icon */
button.btn-chon i {
    font-size: 16px; /* Kích thước icon */
    color: white; /* Màu biểu tượng */
}

/* Hiệu ứng hover */
.btn-luu {
    width: 200px; /* Chiều rộng nút */
    height: 50px; /* Chiều cao nút */
    background-color: #3498db; /* Màu xanh cho nút */
    color: white; /* Màu chữ/icon */
    border: none; /* Xóa viền */
    border-radius: 5px; /* Góc bo tròn */
    font-size: 16px; /* Kích thước chữ */
    font-weight: bold; /* Chữ đậm */
  
  
   
}

.btn-luu i {
    color: white; /* Màu icon trắng */
    margin-left: 10px; /* Khoảng cách giữa chữ và icon */
}

.btn-luu:hover {
    background-color: #2980b9; /* Màu khi hover */
    background-color: #2980b9; /* Màu xanh đậm hơn khi hover */
    transform: scale(1.05); /* Hiệu ứng phóng to */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Bóng đổ */
}

.filemota {
    width: 500px; /* Độ rộng 100% của container cha */
    
    padding: 10px; /* Khoảng cách bên trong */
    font-size: 16px; /* Kích thước chữ */
    border: 2px solid #ccc; /* Viền */
    border-radius: 5px; /* Bo tròn góc */
    outline: none; /* Xóa đường viền khi focus */
    transition: border-color 0.3s, box-shadow 0.3s; /* Hiệu ứng khi focus */
}

.filemota:focus {
    border-color: #007bff; /* Đổi màu viền khi focus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Thêm hiệu ứng ánh sáng */
}

.filemota::placeholder {
    color: #999; /* Màu placeholder */
    font-style: italic; /* In nghiêng placeholder */
}

.btnthemduan {
    padding: 12px 20px; /* Khoảng cách bên trong nút */
    font-size: 18px; /* Kích thước chữ */
    font-weight: bold; /* Chữ in đậm */
    color: #fff; /* Màu chữ */
    background-color: #007bff; /* Màu nền */
    border: none; /* Xóa viền mặc định */
    border-radius: 8px; /* Bo tròn góc nút */
    cursor: pointer; /* Đổi con trỏ thành hình tay khi hover */
    transition: all 0.3s ease; /* Hiệu ứng khi hover */
}

.btnthemduan:hover {
    background-color: #0056b3; /* Màu nền khi hover */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Hiệu ứng đổ bóng khi hover */
}

.btnthemduan:active {
    background-color: #003f7f; /* Màu nền khi bấm nút */
    transform: scale(0.98); /* Hiệu ứng nút nhấn */
}

.input-date-small {
    width: 120px; /* Đặt độ rộng cụ thể */
    padding: 3px; /* Giảm khoảng cách bên trong */
    font-size: 12px; /* Kích thước chữ nhỏ hơn */
    border: 1px solid #ccc; /* Viền đơn giản */
    border-radius: 4px; /* Bo góc */
    box-sizing: border-box; /* Đảm bảo không bị tràn nội dung */
}

.input-date-small:focus {
    border-color: #007bff; /* Đổi màu viền khi focus */
    outline: none; /* Xóa viền mặc định */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Hiệu ứng ánh sáng */
}


    </style>
</head>
<body>
<form action="themduan(GD).php" id="formthemduan" method="post"  enctype="multipart/form-data">
    <?php
    include 'ketnoi.php'; 
    $sql = "SELECT mada FROM duan ORDER BY mada DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $mada = $row['mada'] + 1;
        }
    } else {
        $mada = 1;
    }

    $conn->close();
    ?>
    <div class="container">

    <div class="search-bar1"> 
   
    Mã Dự Án:<br>
    <input type="text" name="txtmada" value="<?php echo $mada; ?>" readonly><br>
    Tên Dự Án: <br>
    <input type="text" name="txttendean" placeholder="Nhập Tên Dự Án"><br>
    Ngày Bắt Đầu: <br>
    <input type="date" name="txtngaybatdau" id="txtngaybatdau"><br>
    Ngày Kết Thúc: <br>
    <input type="date" name="txtngayketthuc" id="txtngayketthuc"><br>
    <span id="error-ngayketthuc" style="color: red; display: none;"></span>  
    Phòng Ban: <br>
    <select name="txtphongban" id="phongban">
        <option value="" disabled selected>Chọn Phòng Ban</option>
    </select><br>
    
   
    <input type="hidden" name="manv_list" id="manv_list">
    </div>
   
    <div class="select-wrapper">
    Nhân Viên: <br>
    <select name="txtnhanvien" id="nhanvien">
        <option value="" disabled selected>Chọn Nhân Viên</option>
    </select>
    <button type="button" id="btnnhanvien" name="btnnhanvien" class="btn-chon" title="Chọn">
        <i class="fas fa-check"></i> <!-- Icon "dấu chọn" -->
    </button>    </div>
    <div class="table-container"> 
    <table id="nhanvienTable">
        <thead>
            <tr>
            <th>Mã Nhân Viên</th>
                <th>Hình Ảnh</th>
                <th>Họ Tên</th>
                <th>Ngày Tham Gia</th>
                <th>Ngày Hoàn Thành</th>
                <th>Mô Tả Công Việc</th>
               
                <th>Hành Động</th>
                
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="search-bar2"> 
    Leader: <br>
    <select name="txtleader" id="leader">
        <option value="" disabled selected>Chọn Nhân Viên</option>
    </select><br>

    Ghi Chú:<br>
    <input type="text" name="txtghichu" id="txtghichu" placeholder="Điền Ghi Chú"><br>

 Mô Tả:<br>
    <input type="input" id="filemota" class="filemota" name="filemota" ><br>
    </div>
 
    <button type="button" id="btnthemduan" name="btnthemduan" class="btnthemduan">Thêm Dự Án</button>
</form>
</div>


</body>
</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const addedNhanVienIds = new Set(); 
    const leaderSelect = document.getElementById('leader');
    const phongbanSelect = document.getElementById('phongban'); 
    let phongbanSelectedValue = null;  

    fetch('get_phongban.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            data.forEach(phongban => {
                const option = document.createElement('option');
                option.value = phongban.value;
                option.textContent = phongban.name;
                phongbanSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Lỗi khi lấy dữ liệu phòng ban:', error));

        function disableOtherOptions() {
        for (let i = 0; i < phongbanSelect.options.length; i++) {
            if (phongbanSelect.options[i].value !== phongbanSelectedValue) {
                phongbanSelect.options[i].disabled = true;   
            }
        }
    }

    
    function checkTableData() {
        const table = document.getElementById('nhanvienTable').getElementsByTagName('tbody')[0];
        if (table.rows.length > 0) {
            phongbanSelectedValue = phongbanSelect.value;   
            disableOtherOptions();   
        } else {
            enableAllOptions();   
        }
    }

    
    function enableAllOptions() {
        for (let i = 0; i < phongbanSelect.options.length; i++) {
            phongbanSelect.options[i].disabled = false;  
        }
    }
    phongbanSelect.addEventListener('change', function() {
        const phongbanId = this.value;
        const nhanvienSelect = document.getElementById('nhanvien');
        nhanvienSelect.innerHTML = '<option value="" disabled selected>Chọn Nhân Viên</option>'; 

        if (phongbanId) {
            fetch(`get_nhanvien.php?phongban=${phongbanId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    data.forEach(nhanvien => {
                        const option = document.createElement('option');
                        option.value = nhanvien.value;
                        option.textContent = nhanvien.name;
                        nhanvienSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Lỗi khi lấy dữ liệu nhân viên:', error));
        }
    });

    document.getElementById('btnnhanvien').addEventListener('click', function() {
        const selectedNhanVienId = document.getElementById('nhanvien').value;

        if (selectedNhanVienId) {
            fetch(`get_nhanvien_detail.php?manhanvien=${selectedNhanVienId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(nhanvienInfo => {
                    const table = document.getElementById('nhanvienTable').getElementsByTagName('tbody')[0];
                    const row = table.insertRow();
                    
                    const cell0 = row.insertCell(0);  
                    const cell1 = row.insertCell(1); 
                    const cell2 = row.insertCell(2);  
                    const cell3 = row.insertCell(3); 
                    const cell4 = row.insertCell(4); 
                    const cell5 = row.insertCell(5); 
                    const cell6 = row.insertCell(6);  
                    

                    cell0.textContent = nhanvienInfo.manv; 
                    cell1.innerHTML = `<img src="${nhanvienInfo.hinhanh}" alt="Hình ảnh" width="50">`; 
                    cell2.textContent = nhanvienInfo.hoten; 
                    cell3.innerHTML = `<input type="date" class="input-date-small" id="ngaythamgia">`; 
                    cell4.innerHTML = `<input type="date" class="input-date-small" id="ngayhoanthanh">`; 

                    cell5.innerHTML = `<input type="text" class="inputmota">`; 

                  
        

                    const deleteBtn = document.createElement('button');
                    deleteBtn.innerHTML = '<i class="fas fa-trash-alt"></i>'; 
                    deleteBtn.className = 'delete-btn';
                    deleteBtn.addEventListener('click', function() {
                        row.remove();  
                        addedNhanVienIds.delete(selectedNhanVienId); 
                        updateNhanVienSelect();  
                        updateLeaderSelect(); 
                        checkTableData();
                    });
                    cell6.appendChild(deleteBtn);

                    addedNhanVienIds.add(selectedNhanVienId);
                    document.getElementById('nhanvien').selectedIndex = 0; 
                    updateNhanVienSelect();
                    updateLeaderSelect();
                    checkTableData();
                })
                .catch(error => console.error('Lỗi khi lấy dữ liệu chi tiết nhân viên:', error));
        }
    });

    
    checkTableData();

   
    function updateNhanVienSelect() {
        const nhanvienSelect = document.getElementById('nhanvien');
        const options = nhanvienSelect.options;

        for (let i = 1; i < options.length; i++) { 
            options[i].disabled = addedNhanVienIds.has(options[i].value); 
        }
    }

    function updateLeaderSelect() {
        leaderSelect.innerHTML = '<option value="" disabled selected>Chọn Nhân Viên</option>'; 
        addedNhanVienIds.forEach(nhanvienId => {
            fetch(`get_nhanvien_detail.php?manhanvien=${nhanvienId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(nhanvienInfo => {
                    const option = document.createElement('option');
                    option.value = nhanvienInfo.manv;
                    option.textContent = nhanvienInfo.hoten + ' [' + nhanvienInfo.manv + ']';
                    leaderSelect.appendChild(option);
                })
                .catch(error => console.error('Lỗi khi lấy dữ liệu chi tiết nhân viên:', error));
        });
    }

    
 


 
const form = document.getElementById('formthemduan');
    const fields = [
        { selector: 'select[name="txtleader"]', message: 'Hãy chọn Leader' },
        { selector: 'select[name="txtphongban"]', message: 'Hãy chọn Phòng Ban' },
        { selector: 'input[name="txtngayketthuc"]', message: 'Hãy chọn Ngày Kết Thúc' },
        { selector: 'input[name="txtngaybatdau"]', message: 'Hãy chọn Ngày Bắt Đầu' },
        { selector: 'input[name="txttendean"]', message: 'Hãy nhập Tên Dự Án' },
      
      
        
        
    ];

  
    fields.forEach(field => {
        const element = document.querySelector(field.selector);
        if (element) {
            element.addEventListener('input', () => validateField(element, field.message));
            element.addEventListener('change', () => validateField(element, field.message));
        }
    });

 
    document.getElementById('btnthemduan').addEventListener('click', function(event) {
     
        if (!validateForm()) {
            event.preventDefault();
        } else {
            const manvList = Array.from(addedNhanVienIds).join(',');
            document.getElementById('manv_list').value = manvList;
            form.submit();
        }
    });
 
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

    // Kiểm tra các trường bắt buộc
    fields.forEach(field => {
        const element = document.querySelector(field.selector);
        if (element && (element.value.trim() === '' || element.value === null)) {
            validateField(element, field.message);
            isValid = false;
        }
    });

    // Lấy các trường ngày tháng
    const ngayBatDau = document.querySelector('input[name="txtngaybatdau"]');
    const ngayKetThuc = document.querySelector('input[name="txtngayketthuc"]');
    const ngayThamGia = document.querySelector('input[name="ngaythamgia"]');
    const ngayHoanThanh = document.querySelector('input[name="ngayhoanthanh"]');

    // Lấy các phần tử hiển thị lỗi
    const errorNgayKetThuc = document.getElementById('error-ngayketthuc');
    const errorNgayThamGia = document.getElementById('error-ngaythamgia');
    const errorNgayHoanThanh = document.getElementById('error-ngayhoanthanh');

    // Kiểm tra ngày kết thúc so với ngày bắt đầu
    if (ngayBatDau.value && ngayKetThuc.value) {
        if (new Date(ngayKetThuc.value) < new Date(ngayBatDau.value)) {
            errorNgayKetThuc.textContent = 'Ngày kết thúc không được nhỏ hơn ngày bắt đầu.';
            errorNgayKetThuc.style.display = 'block';
            isValid = false;
        } else {
            errorNgayKetThuc.textContent = '';
            errorNgayKetThuc.style.display = 'none';
        }
    }

    // Kiểm tra ngày tham gia so với ngày bắt đầu
    if (ngayBatDau.value && ngayThamGia.value) {
        if (new Date(ngayThamGia.value) < new Date(ngayBatDau.value)) {
            errorNgayThamGia.textContent = 'Ngày tham gia không được nhỏ hơn ngày bắt đầu.';
            errorNgayThamGia.style.display = 'block';
            isValid = false;
        } else {
            errorNgayThamGia.textContent = '';
            errorNgayThamGia.style.display = 'none';
        }
    }

    // Kiểm tra ngày hoàn thành so với ngày kết thúc
    if (ngayKetThuc.value && ngayHoanThanh.value) {
        if (new Date(ngayHoanThanh.value) > new Date(ngayKetThuc.value)) {
            errorNgayHoanThanh.textContent = 'Ngày hoàn thành không được lớn hơn ngày kết thúc.';
            errorNgayHoanThanh.style.display = 'block';
            isValid = false;
        } else {
            errorNgayHoanThanh.textContent = '';
            errorNgayHoanThanh.style.display = 'none';
        }
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
