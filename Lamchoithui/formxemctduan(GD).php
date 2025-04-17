<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Chỉnh Sửa Dự Án</title>
    
    <?php
    include 'ketnoi.php'; 
    $mada = $_POST['mada'];
    $sql = "SELECT da.mada,da.trangthai as datt, da.tenda, da.ngaybatdau, da.ngayhoanthanh,pb.mapb, pb.tenpb, nv.manv, nv.hinhanh, nv.hoten, nv.ngaysinh, nv.chucvu, da.leader, da.filemota, da.ghichu, nv.email, nv.trangthai 
            FROM duan da 
            JOIN phongban pb ON da.phongban = pb.mapb 
            JOIN ctduan ctda ON da.mada = ctda.mada 
            JOIN nhanvien nv ON nv.manv = ctda.manv 
            WHERE da.mada = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $mada);
    $stmt->execute();
    $result = $stmt->get_result();

    $projectDetails = null;
    $employees = [];
    $leaderInfo = null;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (!$projectDetails) {
                $projectDetails = $row;  
            }
            $employees[] = $row;  
        }

        $leaderId = $projectDetails['leader'];
        if ($leaderId) {
            $leaderSql = "SELECT manv, hoten FROM nhanvien WHERE manv = ?";
            $leaderStmt = $conn->prepare($leaderSql);
            $leaderStmt->bind_param("s", $leaderId);
            $leaderStmt->execute();
            $leaderResult = $leaderStmt->get_result();
            if ($leaderResult->num_rows > 0) {
                $leaderInfo = $leaderResult->fetch_assoc();
            }
            $leaderStmt->close();
        }
    }
    $conn->close();
    ?>
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


    </style>
</head>
<body>
 
<div class="container">

   <div class="search-bar1"> 
      Mã Dự Án:<br>
    <input type="text" name="txtmada" value="<?php echo $projectDetails['mada']; ?>" readonly><br>
    Tên Dự Án: <br>
    <input type="text" name="txttendean" value="<?php echo $projectDetails['tenda']; ?>" placeholder="Nhập Tên Dự Án"><br>
    Trạng Thái: <br>
    <input type="text" name="txttrangthai" id="txttrangthai" value="<?php echo $projectDetails['datt']; ?>" readonly><br>
  
   
    Ngày Bắt Đầu: <br>
    <input type="date" name="txtngaybatdau" value="<?php echo $projectDetails['ngaybatdau']; ?>"><br>
    Ngày Kết Thúc: <br>
    <input type="date" name="txtngayketthuc" value="<?php echo $projectDetails['ngayhoanthanh']; ?>"><br>
    <span id="error-ngayketthuc" style="color: red; display: none;"></span>

    Phòng Ban: <br>
    <select name="txtphongban" id="phongban">
        <option value="<?php echo $projectDetails['mapb']; ?>" selected><?php echo $projectDetails['tenpb']; ?></option>
    </select><br>
    <form id="formXemThongTin" action="formxemctnv(GD).php" method="POST" >
        <input type="hidden" name="manv" id="manv">
    </form>
    </div>

  
    <div class="select-wrapper">
    Nhân Viên: <br>
    <select name="txtnhanvien" id="nhanvien">
        <option value="" disabled selected>Chọn Nhân Viên</option>
    </select>
    <button type="button" id="btnnhanvien" name="btnnhanvien" class="btn-chon" title="Chọn">
        <i class="fas fa-check"></i> <!-- Icon "dấu chọn" -->
    </button>
</div>
    <div class="table-container"> 
    <table id="nhanvienTable">
        <thead>
            <tr>
                <th>Mã Nhân Viên</th>
                <th>Hình Ảnh</th>
                <th>Họ Tên</th>
                <th>Ngày Sinh</th>
                <th>Chức Vụ</th>
                <th>Email</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($employees as $employee) { ?>
        <tr>
            <td class="employee-id"><?php echo $employee['manv']; ?></td>
            <td><img src="<?php echo $employee['hinhanh']; ?>" alt="Hình ảnh nhân viên" width="50" height="50"></td>
            <td><?php echo $employee['hoten']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($employee['ngaysinh'])); ?></td>
            <td><?php echo $employee['chucvu']; ?></td>
            <td><?php echo $employee['email']; ?></td>
            <td><?php echo $employee['trangthai']; ?></td>
            <td>
              
           <button type="button" class="xemttnv" data-id="<?php echo $employee['manv']; ?>" title="Xem Thông Tin">
    <i class="fas fa-eye"></i> <!-- Icon "mắt" -->
</button>

<!-- Nút "Xóa" đổi thành biểu tượng -->
<button type="button" class="delete-btn" id="delete-btn" title="Xóa">
    <i class="fas fa-trash-alt"></i> <!-- Icon "thùng rác" -->
</button>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    </div>
<div class="search-bar2">
    Leader: <br>
    <select name="txtleader" id="leader">
        <?php if ($leaderInfo) { ?>
            <option value="" disabled selected>Chọn Nhân Viên</option>
            <option value="<?php echo $leaderInfo['manv']; ?>" selected>
                <?php echo $leaderInfo['hoten'] . " [" . $leaderInfo['manv'] . "]"; ?>
            </option>
        <?php } ?>

        <?php foreach ($employees as $employee) { 
            if ($employee['manv'] !== $leaderInfo['manv']) { ?>
                <option value="<?php echo $employee['manv']; ?>">
                    <?php echo $employee['hoten'] . " [" . $employee['manv'] . "]"; ?>
                </option>
        <?php } } ?>
    </select><br>

    Ghi Chú:<br>
    <input type="text" name="txtghichu" id="txtghichu" value="<?php echo $projectDetails['ghichu']; ?>" placeholder="Điền Ghi Chú"><br>

    File Mô Tả:<br>
    <input type="text" id="filemota" name="filemota" value="<?php echo $projectDetails['filemota']; ?>" ><br>
   
    </div>
    <button type="button" id="btnthemduan" name="btnthemduan" class="btn-luu" title="Lưu">
    <i class="fas fa-save"></i> Lưu
</button>

</div>
</body>
</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nhanvienTable = document.getElementById('nhanvienTable');
    const leaderSelect = document.getElementById('leader');
    const phongbanSelect = document.getElementById('phongban'); 
    const nhanvienSelect = document.getElementById('nhanvien'); 

    const phongbanId = phongbanSelect.value; 
   
    if (phongbanId) {
        // Lấy danh sách mã nhân viên từ bảng
        const existingEmployeeIds = Array.from(nhanvienTable.querySelectorAll('.employee-id'))
            .map(elem => elem.textContent.trim())
            .join(','); // Nối các ID lại thành một chuỗi
        
        // Gọi API để lấy danh sách nhân viên
        fetch(`get_nhanvien4.php?phongban=${phongbanId}&existingIds=${existingEmployeeIds}`)
            .then(response => response.json())
            .then(data => {
                nhanvienSelect.innerHTML = '<option value="" disabled selected>Chọn Nhân Viên</option>'; // Đặt lại danh sách chọn nhân viên
                
                // Thêm các tùy chọn nhân viên vào dropdown
                data.forEach(nhanvien => {
                    const option = document.createElement('option');
                    option.value = nhanvien.value; 
                    option.textContent = nhanvien.name; 
                    nhanvienSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Lỗi khi lấy dữ liệu nhân viên:', error));
    }
    function upadtenv() {
    const phongbanId = phongbanSelect.value; // Lấy giá trị của phongban
    if (phongbanId) {
        // Lấy danh sách mã nhân viên từ bảng
        const existingEmployeeIds = Array.from(nhanvienTable.querySelectorAll('.employee-id'))
            .map(elem => elem.textContent.trim())
            .join(','); // Nối các ID lại thành một chuỗi
        
        // Gọi API để lấy danh sách nhân viên
        fetch(`get_nhanvien4.php?phongban=${phongbanId}&existingIds=${existingEmployeeIds}`)
            .then(response => response.json())
            .then(data => {
                nhanvienSelect.innerHTML = '<option value="" disabled selected>Chọn Nhân Viên</option>';  
                
                 
                data.forEach(nhanvien => {
                    const option = document.createElement('option');
                    option.value = nhanvien.value; 
                    option.textContent = nhanvien.name; 
                    nhanvienSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Lỗi khi lấy dữ liệu nhân viên:', error));
    }
}



document.querySelectorAll('.xemttnv').forEach(button => {
            button.addEventListener('click', function() {
                const employeeId = this.getAttribute('data-id');
                document.getElementById('manv').value = employeeId;  // Set the employee ID
                document.getElementById('formXemThongTin').submit(); // Submit the form
            });
        });

const btnNhanVien = document.getElementById('btnnhanvien');

btnNhanVien.addEventListener('click', function() {
    const selectedOption = nhanvienSelect.options[nhanvienSelect.selectedIndex];

    if (selectedOption && selectedOption.value) {
        const employeeId = selectedOption.value;

        fetch(`get_nhanvien_detail.php?manhanvien=${employeeId}`)
            .then(response => response.json())
            .then(data => {

                if (data) {

                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td class="employee-id">${data.manv}</td>
                        <td><img src="${data.hinhanh}" alt="Hình ảnh nhân viên" width="50" height="50"></td>
                        <td>${data.hoten}</td>
                        <td>${data.ngaysinh}</td>
                        <td>${data.chucvu}</td>
                        <td>${data.email}</td>
                        <td>${data.trangthai}</td>
                        <td>
                            <button type="button" class="xemttnv" data-id="${data.manv}" title="Xem Thông Tin">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="delete-btn" data-id="${data.manv}" title="Xóa">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    `;
                    nhanvienTable.querySelector('tbody').appendChild(newRow);

                    const leaderOption = document.createElement('option');
                    leaderOption.value = data.manv;
                    leaderOption.textContent = `${data.hoten} [${data.manv}]`;
                    leaderSelect.appendChild(leaderOption);

                    nhanvienSelect.remove(nhanvienSelect.selectedIndex);
                    upadtenv();
                    nhanvienSelect.innerHTML = '<option value="" disabled selected>Chọn Nhân Viên</option>';

                    // Gắn lại sự kiện cho nút xóa
                    const deleteButtons = document.querySelectorAll('.delete-btn');
                    deleteButtons.forEach(function(button) {
                        button.addEventListener('click', function() {
                            const row = button.closest('tr');
                            const employeeIdToDelete = button.getAttribute('data-id');
                            const confirmDelete = confirm("Bạn có chắc chắn muốn xóa nhân viên này?");
                            if (confirmDelete) {
                                row.remove();  // Xóa dòng nhân viên
                                // Cập nhật lại leader nếu cần
                                if (leaderSelect.value === employeeIdToDelete) {
                                    leaderSelect.selectedIndex = 0;
                                }
                                // Xóa nhân viên khỏi danh sách leader
                                for (let i = 0; i < leaderSelect.options.length; i++) {
                                    if (leaderSelect.options[i].value === employeeIdToDelete) {
                                        leaderSelect.remove(i);
                                        break;
                                    }
                                }
                                upadtenv();
                            }
                        });
                    });

                    // Gắn lại sự kiện cho nút xem thông tin
                    const xemttnvButtons = document.querySelectorAll('.xemttnv');
                    xemttnvButtons.forEach(function(button) {
                        button.addEventListener('click', function() {
                            const employeeIdToView = button.getAttribute('data-id');
                            window.location.href = `formxemctnv(GD).php?manv=${employeeIdToView}`;
                        });
                    });

                } else {
                    alert("Không tìm thấy thông tin nhân viên.");
                }
            })
            .catch(error => console.error('Lỗi khi lấy dữ liệu chi tiết nhân viên:', error));
    }
});


    document.querySelectorAll('.delete-btn').forEach(function(button) {
    button.addEventListener('click', function(event) {
        const row = event.target.closest('tr');  // Tìm dòng chứa nút xóa
        if (row) {
            const employeeId = row.querySelector('.employee-id').textContent.trim();  // Lấy ID nhân viên
            const confirmDelete = confirm("Bạn có chắc chắn muốn xóa nhân viên này?");
            if (confirmDelete) {
                row.remove();  // Xóa dòng khỏi bảng

                // Nếu cần, thêm mã logic xử lý sau khi xóa (ví dụ: cập nhật leader, danh sách nhân viên)
                // Ví dụ: cập nhật leader nếu nhân viên bị xóa là leader
                if (leaderSelect.value === employeeId) {
                    leaderSelect.selectedIndex = 0;  // Reset leader về giá trị đầu tiên
                }

                // Xóa nhân viên khỏi danh sách leader
                for (let i = 0; i < leaderSelect.options.length; i++) {
                    if (leaderSelect.options[i].value === employeeId) {
                        leaderSelect.remove(i);
                        break;
                    }
                }

                // Gọi hàm update nếu cần
                upadtenv();
            }
        }
    });
});


document.getElementById('btnthemduan').addEventListener('click', function(event) {
    event.preventDefault(); // Ngăn gửi form mặc định

    
    const mada = document.querySelector('input[name="txtmada"]').value.trim();
    const tenda = document.querySelector('input[name="txttendean"]').value.trim();
    const ngaybatdau = document.querySelector('input[name="txtngaybatdau"]').value;
    const ngayketthuc = document.querySelector('input[name="txtngayketthuc"]').value;
    const phongban = document.getElementById('phongban').value;
    const leader = document.getElementById('leader').value;
    const ghichu = document.getElementById('txtghichu').value.trim();
    const filemota = document.getElementById('filemota').value.trim();

    // Hàm lấy mã nhân viên từ bảng nhanvientable
    function getEmployeeIdsFromTable() {
        const nhanvienTable = document.getElementById('nhanvienTable');
        return Array.from(nhanvienTable.querySelectorAll('.employee-id')).map(elem => elem.textContent.trim());
    }

    const nhanvienArray = getEmployeeIdsFromTable();

    // Kiểm tra các trường bắt buộc không được để trống
    if (!tenda || !ngaybatdau || !ngayketthuc || !phongban || nhanvienArray.length === 0 || !leader ) {
        alert("Vui lòng điền đầy đủ các trường bắt buộc.");
        return;
    }

    // Kiểm tra ngày kết thúc phải sau ngày bắt đầu
    if (new Date(ngayketthuc) < new Date(ngaybatdau)) {
        alert("Ngày kết thúc phải sau ngày bắt đầu.");
        return;
    }

    // Yêu cầu người dùng xác nhận
    const confirmSubmission = confirm("Bạn có chắc chắn muốn chỉnh sửa dự án này?");
    if (!confirmSubmission) {
        return; // Hủy gửi nếu người dùng chọn "Cancel"
    }

    // Gửi dữ liệu qua fetch đến capnhatduan.php
    fetch('capnhatduan.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            mada : mada,
            tenda: tenda,
            ngaybatdau: ngaybatdau,
            ngayhoanthanh: ngayketthuc,
            phongban: phongban,
            nhanvien: nhanvienArray, 
            leader: leader,
            ghichu: ghichu,
            filemota: filemota
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Dự án đã được cập nhật thành công!");
            
        } else {
            alert("Có lỗi xảy ra khi cập nhật dự án.");
        }
    })
    .catch(error => {
        console.error('Lỗi khi cập nhật dự án:', error);
        alert("Có lỗi xảy ra khi cập nhật dự án.");
    });


// Gọi fetch để lấy trạng thái dự án
fetch('get_trangthai.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        mada: mada // Truyền mã dự án vào
    })
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        // Cập nhật ô input trạng thái
        const trangThaiElement = document.getElementById('txttrangthai'); // Lấy input trạng thái
        trangThaiElement.value = data.trangthai; // Cập nhật giá trị
      
    } else {
        alert("Có lỗi xảy ra khi lấy trạng thái dự án: " + data.message);
    }
})
.catch(error => {
    console.error('Lỗi khi lấy trạng thái dự án:', error);
    alert("Có lỗi xảy ra khi lấy trạng thái dự án.");
});

    
});

 
});
</script>