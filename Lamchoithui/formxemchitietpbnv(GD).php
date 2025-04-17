<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhân Viên</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
body {
    font-family: 'Arial', sans-serif;
    background-color:#DFF2EB;
    background-size: cover;
    color: #333;
    margin: 0;
    padding: 20px;
    min-height: 90vh;
    display: flex;
    flex-direction: column;
}

.form {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 20px;
    background: #f2f2f2;  
    border-radius: 10px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    height: full;
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

.search-bar {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-bottom: 20px;
}

.search-bar select, 
.search-bar input[type="text"] {
    padding: 5px 8px; /* Giảm kích thước padding */
    border: 2px solid #ddd;
    border-radius: 5px;
    margin-right: 10px;
    width: 200px; /* Giảm chiều rộng */
    font-size: 12px; /* Giảm kích thước font */
    transition: border-color 0.3s;
  
}

.search-bar select:focus, 
.search-bar input[type="text"]:focus {
    border-color: #00aaff; 
    outline: none;
}

 

button:hover {
    background-color: rgb(223, 226, 226); 
    transform: scale(1.05);
}

.action-button {
    background: transparent;  
    border: none;  
    cursor: pointer;  
    color: black;  
    font-size: 18px;  
}

.action-button1 {
    background: transparent; 
    border: none;  
    cursor: pointer;  
    color: red;  
    font-size: 18px;  
}

@media (max-width: 768px) {
    table {
        font-size: 12px;
    }

    .search-bar {
        flex-direction: column;
    }

    .search-bar input[type="text"] {
        width: 100%;
        margin-bottom: 10px;
    }
}

.ttnv {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    justify-content: flex-start;
    align-items: center;
    margin-left: 10px;
}

.label-box {
    background-color: white;
    color: #2c3e50;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    font-size: 16px;
    font-weight: 500;
    transition: box-shadow 0.3s ease; 
}

.label-box:hover {
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);  
}

.ttnv i {
    margin-right: 8px; 
    font-size: 20px; 
    color: rgb(74, 98, 138);
}

.lable.welcome {
    font-size: 24px;
    font-weight: bold;
    color: #2c3e50;
    margin-bottom: 20px;
    padding: 10px;
    border-radius: 5px;
}

.btnthemnhanvien {
    margin-left: auto;
}

.btnthemnhanvien .btn {
    padding: 10px 15px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
    font-size: 16px;
}

.btnthemnhanvien .btn:hover {
    background-color: #2980b9;
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}
.button1 {
    display: flex; /* Sắp xếp các nút ngang hàng */
    gap: 10px; /* Khoảng cách giữa các nút */
    justify-content: flex-start; /* Căn các nút sang trái */
    align-items: center; /* Căn giữa theo chiều dọc */
    margin-left: 10px; /* Đẩy cả nhóm nút qua phải 10px */
}

.button1 button {
    display: flex; /* Dùng flexbox để căn chỉnh icon và text */
    align-items: center; /* Căn giữa icon và text */
    padding: 10px 20px; /* Kích thước nút */
    font-size: 16px; /* Kích thước chữ */
    font-weight: bold; /* Chữ đậm */
    color: white; /* Màu chữ */
    border: none; /* Xóa viền */
    border-radius: 8px; /* Bo tròn góc */
    cursor: pointer; /* Hiển thị con trỏ khi rê chuột */
    transition: background-color 0.3s, transform 0.2s; /* Hiệu ứng hover */
}

/* Nút Lưu */
.btn-save {
    background-color: #3498db; /* Màu xanh */
}

.btn-save:hover {
    background-color: #2980b9; /* Màu xanh đậm hơn khi hover */
    transform: scale(1.05); /* Hiệu ứng phóng to */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Bóng đổ */
}

/* Nút Khóa */
.btn-lock {
    background-color: #e74c3c; /* Màu đỏ */
}

.btn-lock:hover {
    background-color: #c0392b; /* Màu đỏ đậm hơn khi hover */
    transform: scale(1.05); /* Hiệu ứng phóng to */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Bóng đổ */
}

/* Icon trong nút */
.button1 i {
    margin-right: 8px; /* Khoảng cách giữa icon và text */
    font-size: 18px; /* Kích thước icon */
}

/* Container bao bọc các nút */
.action-container {
    display: flex;
    align-items: center;  /* Căn giữa các phần tử theo chiều dọc */
    gap: 10px;  /* Khoảng cách giữa các nút */
    justify-content: center;  /* Căn giữa các phần tử theo chiều ngang */
}

 

/* Hiệu ứng hover cho các nút */
button:hover {
    transform: scale(1.05);  /* Phóng to nhẹ khi hover */
}

/* Style cho icon trong nút */
button i {
    font-size: 16px;  /* Kích thước icon nhỏ hơn */
}

/* Style cho nút chuyển phòng ban (màu cam) */
button.btn-transfer {
    background-color: #fd7e14;  /* Màu cam */
    border-color: #fd7e14;  /* Đường viền cam */
    color: white;  /* Màu chữ trắng */
}

button.btn-transfer:hover {
    background-color: #e36e00;  /* Màu nền khi hover (màu cam đậm) */
}

/* Style cho nút "Chọn Làm Trưởng Phòng" (màu xanh) */
button.update-status-btn {
    background-color: #28a745;  /* Màu xanh */
    border-color: #28a745;  /* Đường viền xanh */
    color: white;  /* Màu chữ trắng */
    display: flex;
    align-items: center;  /* Căn chỉnh icon và chữ theo chiều dọc */
    gap: 5px;  /* Khoảng cách giữa icon và text */
    padding: 8px 12px;  /* Điều chỉnh kích thước padding */
    font-size: 14px;  /* Kích thước chữ nhỏ hơn */
    border-radius: 5px;  /* Bo tròn góc */
    cursor: pointer;  /* Hiển thị con trỏ chuột dạng bàn tay */
    transition: background-color 0.3s, transform 0.2s;  /* Hiệu ứng hover */
}

button.update-status-btn i {
    font-size: 16px;  /* Kích thước icon */
}

button.update-status-btn:hover {
    background-color: #218838;  /* Màu nền khi hover (màu xanh đậm) */
    transform: scale(1.05);  /* Hiệu ứng phóng to */
}

/* Hiệu ứng hover cho các nút */
button:hover {
    transform: scale(1.05);  /* Phóng to nhẹ khi hover */
}

/* Style cho icon trong nút */
button i {
    font-size: 16px;  /* Kích thước icon nhỏ hơn */
}

.btntk{
margin-bottom: 10px;


}
.btntk input{
height: 20px;

}



    </style>
</head>
<body>
<div class="content">
<?php
include 'ketnoi.php';
$mapb = $_POST['mapb'];



?>
    <div class="lable welcome"> Welcome Admin!!</div>
    <?php
include 'ketnoi.php'; // Ensure your database connection is included

// Query to count total employees
$sql1 = "SELECT COUNT(nv.manv) AS slnv FROM phongban pb JOIN nhanvien nv ON pb.mapb = nv.mapb where nv.mapb = '$mapb' and nv.chucvu != 'Giám Đốc'";
$result1 = $conn->query($sql1);

// Check if the first query was successful
if ($result1) {
    if ($result1->num_rows > 0) {
        // Fetch the result
        $row = $result1->fetch_assoc();
        $slnv = $row['slnv'];
    } else {
        // No employees found
        $slnv = 0;
    }
} else {
    // Handle query error
    echo "Error in query 1: " . $conn->error;
}

// Query to count active employees
$sql2 = "SELECT COUNT(nv.manv) AS slnv2 FROM phongban pb JOIN nhanvien nv ON pb.mapb = nv.mapb WHERE nv.trangthai = 'Đang Làm Việc' and nv.mapb = '$mapb' and nv.chucvu != 'Giám Đốc'";
$result2 = $conn->query($sql2);

// Check if the second query was successful
if ($result2) {
    if ($result2->num_rows > 0) {
        // Fetch the result
        $row = $result2->fetch_assoc();
        $slnv2 = $row['slnv2'];
    } else {
        // No active employees found
        $slnv2 = 0;
    }
} else {
    // Handle query error
    echo "Error in query 2: " . $conn->error;
}
$slnv3 = $slnv - $slnv2;
?>
        <?php include 'taskbar.php'; ?>
<div class="ttnv">
    <div class="label-box">
        <i class="fas fa-user"></i>  
        Tổng số <?php echo "$slnv"; ?>
    </div>
    <div class="label-box">
        <i class="fas fa-user-check"></i> <!-- Icon người đang làm việc -->
    Đang làm việc <?php echo "$slnv2"; ?>
    </div>
    <div class="label-box">
        <i class="fas fa-user-slash"></i> <!-- Icon người đã nghỉ -->
        Đã nghỉ việc <?php echo "$slnv3"; ?>
    </div>
</div>
<div class="container">
<div class="search-bar">
<?php
include 'ketnoi.php';

$sql = "SELECT * FROM phongban WHERE mapb = '$mapb'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mapb = $row['mapb'];
        $tenpb = $row['tenpb'];
        $mota = $row['mota'];
        $ngaytao = date('Y-m-d', strtotime($row['ngaytao']));

        echo "Mã Phòng Ban: ";
        echo "<input type='text' name='txtmapb' id='txtmapb' value='$mapb' readonly>";
        echo "Tên Phòng Ban: ";
        echo "<input type='text' name='txttenpb' id='txttenpb' value='$tenpb'>";
        echo "Mô Tả: ";
        echo "<input type='text' name='txtmota' id='txtmota' value='$mota'>";
        echo "Ngày Tạo: ";
        echo "<input type='date' name='txtngaytao' id='txtngaytao' value='$ngaytao'>";
    }
}

$conn->close();
?>

<div class="button1">
    <button type="button" name="btnluutt" id="btnluuttt" class="btn-save">
        <i class="fas fa-save"></i> Lưu
    </button>
    <input type="hidden" name="txtkhoapb" id="txtkhoapb" value="<?php echo $mapb; ?>">
    <button type="button" id="btnkhoapb" name="btnkhoapb" class="btn-lock">
        <i class="fas fa-lock"></i> Khóa
    </button>
</div>

<input type="hidden" name="txttrangthai" id="trangthai"  value="Đang Làm Việc">
</div>
<div class="btntk"><input type="text" name="txttimkiem" id="txttimkiem" placeholder="Tìm Kiếm..."></div>


 

<div class="form"> 
                <div class="table-container"> 
<table id="nhanvienTable">
    <thead>
        <tr>
            <th>Mã Nhân Viên</th>
            <th>Hình Ảnh</th>
            <th>Họ Tên</th>
            <th>Ngày Sinh</th>
            <th>Giới Tính</th>
            <th>Chức Vụ</th>
            <th>Phòng Ban</th>
            <th>Email</th>
            <th>Trạng Thái</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>
</div>
</div>
</div>
</body>
</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const phongbanSelect = document.getElementById('txtmapb');
    const timkiemInput = document.getElementById('txttimkiem');
    const timkiemButton = document.getElementById('btntimkiem');
    const trangthaiSelect = document.getElementById('trangthai');


    document.getElementById('btnkhoapb').addEventListener('click', function() {
    // Lấy giá trị từ input ẩn
    const mapb = document.getElementById('txtkhoapb').value;

    // Gửi dữ liệu qua fetch đến capnhattrangthaipb.php
    fetch('capnhattrangthaipb.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ mapb: mapb })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Trạng thái phòng ban đã được cập nhật thành công!");
        } else {
            alert("" + data.message);
        }
    })
    .catch(error => {
        console.error('Lỗi khi cập nhật trạng thái phòng ban:', error);
        alert("Có lỗi xảy ra khi cập nhật trạng thái phòng ban.");
    });
});


function loadNhanVien() {
    const phongbanId = phongbanSelect.value;
    const trangthai = trangthaiSelect.value;
    const tableBody = document.getElementById('nhanvienTable').getElementsByTagName('tbody')[0];
    tableBody.innerHTML = "";  

    if (phongbanId && trangthai) {
        fetch(`get_nhanvien3.php?phongban=${phongbanId}&trangthai=${trangthai}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Không thể lấy dữ liệu');
                }
                return response.json();
            })
            .then(data => {
                if (data.length > 0) {
                    data.forEach(nhanvien => {
                        const row = tableBody.insertRow();
                        row.insertCell(0).textContent = nhanvien.manv;
                        row.insertCell(1).innerHTML = `<img src="${nhanvien.hinhanh}" alt="Hình ảnh" width="50">`;
                        row.insertCell(2).textContent = nhanvien.hoten;
                        row.insertCell(3).textContent = nhanvien.ngaysinh;
                        row.insertCell(4).textContent = nhanvien.gioitinh;
                        row.insertCell(5).textContent = nhanvien.chucvu;
                        row.insertCell(6).textContent = nhanvien.tenpb;
                        row.insertCell(7).textContent = nhanvien.email;
                        row.insertCell(8).textContent = nhanvien.trangthai;

                        const actionCell = row.insertCell(9);
                        
                        // Tạo div bao bọc dropdown và nút chuyển phòng ban
                        const actionContainer = document.createElement('div');
                        actionContainer.style.display = 'flex';  // Sử dụng flexbox để căn chỉnh
                        actionContainer.style.alignItems = 'center'; // Căn giữa các phần tử theo chiều dọc

                        // Dropdown chọn phòng ban
                        const phongbanDropdown = document.createElement('select');
                        const currentPhongBan = phongbanSelect.value;
                        fillPhongBanDropdown(phongbanDropdown, currentPhongBan);
                        actionContainer.appendChild(phongbanDropdown);

                        // Nút chuyển phòng ban
                        const detailButton = document.createElement('button');
                        detailButton.innerHTML = '<i class="fas fa-exchange-alt"></i>'; // Thay đổi thành icon
                        detailButton.classList.add('btn-transfer');
                        detailButton.onclick = function() {
                            const chucvu = nhanvien.chucvu;
                            const phongbanDropdown = actionContainer.querySelector('select');
                            checkTruongPhong(phongbanDropdown, chucvu, nhanvien.manv);
                        };
                        actionContainer.appendChild(detailButton);

                        // Nút "Chọn Làm Trưởng Phòng"
                        const updateStatusButton = document.createElement('button');
                      updateStatusButton.innerHTML = '<i class="fas fa-user-tie"></i>';
                        updateStatusButton.onclick = function() {
                            capNhatTruongphong(nhanvien.manv);
                        };
                        actionContainer.appendChild(updateStatusButton);

                        // Thêm actionContainer vào cell hành động
                        actionCell.appendChild(actionContainer);
                    });
                } else {
                    const row = tableBody.insertRow();
                    const cell = row.insertCell(0);
                    cell.colSpan = 10;
                    cell.textContent = 'Không có nhân viên';
                    cell.style.textAlign = "center";
                }
            })
            .catch(error => console.error('Lỗi khi lấy dữ liệu nhân viên:', error));
    } else {
        const row = tableBody.insertRow();
        const cell = row.insertCell(0);
        cell.colSpan = 10;
        cell.textContent = 'Vui lòng chọn Phòng ban và Trạng thái';
        cell.style.textAlign = "center";
    }
}


  

timkiemInput.addEventListener('input', function() {
  
    const tenNhanVien = timkiemInput.value.trim();
    const phongbanId = phongbanSelect.value;

if(tenNhanVien==""){

loadNhanVien();

}

    if (tenNhanVien !="") {
        fetch(`timkiem_nhanvien3.php?tennv=${tenNhanVien}&phongban=${phongbanId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Không thể tìm kiếm');
                }
                return response.json();
            })
            .then(data => {
                const tableBody = document.getElementById('nhanvienTable').getElementsByTagName('tbody')[0];
                tableBody.innerHTML = "";
                if (data.length > 0) {
                    data.forEach(nhanvien => {
                        const row = tableBody.insertRow();
                        row.insertCell(0).textContent = nhanvien.manv;
                        row.insertCell(1).innerHTML = `<img src="${nhanvien.hinhanh}" alt="Hình ảnh" width="50">`;
                        row.insertCell(2).textContent = nhanvien.hoten;
                        row.insertCell(3).textContent = nhanvien.ngaysinh;
                        row.insertCell(4).textContent = nhanvien.gioitinh;
                        row.insertCell(5).textContent = nhanvien.chucvu;
                        row.insertCell(6).textContent = nhanvien.tenpb;
                        row.insertCell(7).textContent = nhanvien.email;
                        row.insertCell(8).textContent = nhanvien.trangthai;

                        const actionCell = row.insertCell(9);

                        const actionContainer = document.createElement('div');
                        actionContainer.style.display = 'flex';  // Sử dụng flexbox để căn chỉnh
                        actionContainer.style.alignItems = 'center'; // Căn giữa các phần tử theo chiều dọc



                        const phongbanDropdown = document.createElement('select');
                        fillPhongBanDropdown(phongbanDropdown);  
                        actionCell.appendChild(phongbanDropdown);

                        const detailButton = document.createElement('button');
                        detailButton.innerHTML = '<i class="fas fa-exchange-alt"></i>'; // Thay đổi thành icon
                        detailButton.classList.add('btn-transfer');
                        detailButton.onclick = function() {
                            const chucvu = nhanvien.chucvu; 
                            const phongbanDropdown = actionCell.querySelector('select');  
                            checkTruongPhong(phongbanDropdown, chucvu, nhanvien.manv);
                        };
                        actionCell.appendChild(detailButton);

                        const updateStatusButton = document.createElement('button');
                        updateStatusButton.innerHTML = '<i class="fas fa-user-tie"></i>';
                        updateStatusButton.onclick = function() {
                            capNhatTruongphong(nhanvien.manv);
                        };
                        actionCell.appendChild(updateStatusButton);
                        actionCell.appendChild(actionContainer);
                    });
                } else {
                    const row = tableBody.insertRow();
                    const cell = row.insertCell(0);
                    cell.colSpan = 10;
                    cell.textContent = 'Không tìm thấy nhân viên';
                }
            })
            .catch(error => console.error('Lỗi khi tìm kiếm nhân viên:', error));
    } 
});

function fillPhongBanDropdown(dropdown, currentPhongBan) {
    // Gửi yêu cầu GET tới API với tham số currentPhongBan
    fetch(`get_phongban2.php?mapb=${currentPhongBan}`)
        .then(response => {
            // Kiểm tra xem phản hồi có thành công không
            if (!response.ok) {
                throw new Error('Không thể lấy danh sách phòng ban');
            }
            return response.json();  // Phản hồi là JSON
        })
        .then(phongbanList => {
            // Xóa tất cả các tùy chọn hiện tại trong dropdown
            dropdown.innerHTML = '';

            // Thêm tùy chọn mặc định (Chọn phòng ban)
            const defaultOption = document.createElement('option');
            defaultOption.value = '';  // Giá trị rỗng để yêu cầu người dùng chọn
            defaultOption.text = 'Chọn phòng ban';  // Văn bản hiển thị
            defaultOption.disabled = true;  // Không thể chọn
            defaultOption.selected = true;  // Được chọn mặc định
            dropdown.appendChild(defaultOption);

            // Điền dữ liệu phòng ban vào dropdown
            phongbanList.forEach(phongban => {
                const option = document.createElement('option');
                option.value = phongban.mapb;  // Gán giá trị mapb của phòng ban
                option.text = phongban.tenpb;  // Gán tên phòng ban
                dropdown.appendChild(option);  // Thêm tùy chọn vào dropdown
            });
        })
        .catch(error => {
            console.error('Lỗi khi lấy danh sách phòng ban:', error);  // Xử lý lỗi
            alert('Lỗi khi tải dữ liệu phòng ban!');
        });
}

  



function checkTruongPhong(phongbanDropdown, chucvu, manv) {
    if (chucvu !== 'Trưởng Phòng') {
        const mapb = phongbanDropdown.value;

        if (!mapb) {
            alert('Vui lòng chọn phòng ban.');
            return;
        }

        const confirmChange = confirm('Bạn có chắc chắn muốn chuyển nhân viên này sang phòng ban mới không?');
        if (!confirmChange) {
            return;
        }

        // Sử dụng fetch để gửi dữ liệu
        fetch('capnhatphongban.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                manv: manv,
                mapb: mapb
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Lỗi khi cập nhật phòng ban.');
            }
            return response.json();
        })
        .then(data => {
            // Xử lý dữ liệu trả về nếu cần
            alert('Cập nhật phòng ban thành công.');
            loadNhanVien();
        })
        .catch(error => {
            console.error('Lỗi:', error);
            alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
        });

        return;
    }

    if(chucvu == 'Trưởng Phòng') {
        const phongban = phongbanDropdown.value;
        if (!phongban) {
            alert('Vui lòng chọn phòng ban.');
            return;
        }

        fetch('check_truongphong3.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ phongban })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Lỗi khi kiểm tra trưởng phòng.');
            }
            return response.json();
        })
        .then(data => {
            if (data.hasTruongPhong) {
                alert('Phòng ban này đã có trưởng phòng.');
            } else {
                const confirmChange = confirm('Bạn có chắc chắn muốn chuyển nhân viên này sang phòng ban mới không?');
                if (!confirmChange) {
                    return;
                }

                // Sử dụng fetch để gửi dữ liệu
                fetch('capnhatphongban.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        manv: manv,
                        mapb: phongban
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Lỗi khi cập nhật phòng ban.');
                    }
                    return response.json();
                })
                .then(data => {
                    // Xử lý dữ liệu trả về nếu cần
                    alert('Cập nhật phòng ban thành công.');
                    loadNhanVien();
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
                });
            }
        })
        .catch(error => {
            console.error('Lỗi:', error);
            alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
        });
    }
}


function capNhatTruongphong(manv) {
    if (!manv) {
        alert("Mã nhân viên không hợp lệ!");
        return;
    }
    
    const phongbanSelect = document.getElementById('txtmapb');
    const phongbanId = phongbanSelect.value;
    
    if (!phongbanId) {
        alert("Vui lòng chọn phòng ban.");
        return;
    }

    const confirmUpdate = confirm("Bạn có chắc chắn muốn chọn nhân viên này làm trưởng phòng không?");
    if (confirmUpdate) {
        const data = new FormData();
        data.append('manv', manv);
        data.append('mapb', phongbanId);

        fetch('capnhattruongphong.php', {
            method: 'POST',
            body: data,
        })
        .then(response => response.text()) // hoặc .json() nếu bạn mong đợi dữ liệu trả về là JSON
        .then(result => {
            // Xử lý kết quả trả về nếu cần
            alert("Cập nhật thành công");
            loadNhanVien();
            
        })
        .catch(error => {
            console.error('Lỗi:', error);
            alert("Có lỗi xảy ra trong quá trình cập nhật trưởng phòng.");
        });
    }
}


    loadNhanVien();
});




    document.getElementById('btnluuttt').addEventListener('click', function() {
    
    const mapb = document.getElementById('txtmapb').value;
    const tenpb = document.getElementById('txttenpb').value;
    const mota = document.getElementById('txtmota').value;
    const ngaytao = document.getElementById('txtngaytao').value;

    
    const vietnamDate = new Date();
    vietnamDate.setHours(vietnamDate.getHours() + 7);
    const todayVN = vietnamDate.toISOString().split('T')[0];

    
    if (ngaytao > todayVN) {
        alert("Ngày tạo không được lớn hơn hôm nay. Vui lòng chọn lại.");
        return;  
    }

   
    if (confirm("Bạn có chắc chắn muốn lưu thông tin phòng ban?")) {
        
        const data = {
            mapb: mapb,
            tenpb: tenpb,
            mota: mota,
            ngaytao: ngaytao,
        };
 
        fetch('suattpb.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(responseData => {
             if (responseData.status === "success") {
                alert("Thông Tin Phòng Ban Đã Được Cập Nhật Thành Công");
            } else {
                alert("Có lỗi xảy ra: " + responseData.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Có lỗi xảy ra trong quá trình cập nhật thông tin phòng ban.");
        });
    }
});


</script>