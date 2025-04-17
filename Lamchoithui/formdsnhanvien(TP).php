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
    <title>Nhân Viên</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>

<body>
     

<?php
  include 'taskbar1.php';
  
include 'ketnoi.php';
  

$sql = "SELECT * FROM phongban pb, nhanvien nv where pb.mapb = nv.mapb and nv.sdt = '$sdt1'";
$result = $conn->query(query: $sql);


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $mapb = $row['mapb'];
        $tenpb = $row['tenpb'];
    }
}

$conn->close();
 

    ?>
   
    <?php
include 'ketnoi.php'; // Ensure your database connection is included

// Query to count total employees
$sql1 = "SELECT COUNT(nv.manv) AS slnv FROM phongban pb JOIN nhanvien nv ON pb.mapb = nv.mapb where nv.mapb = '$mapb'and nv.chucvu = 'Nhân Viên'";
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
$sql2 = "SELECT COUNT(nv.manv) AS slnv2 FROM phongban pb JOIN nhanvien nv ON pb.mapb = nv.mapb WHERE nv.trangthai = 'Đang Làm Việc' and nv.mapb = '$mapb' and nv.chucvu = 'Nhân Viên'";
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
        
        <div class="content">
        <div class="lable welcome">Xin Chào Trưởng Phòng <?php echo $tenpb;?>!</div>
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
                <select name="txtphongban" id="phongban">
                    <option value="<?php echo $mapb;?>"><?php echo $tenpb;?></option>
                </select>
                <select name="txttrangthai" id="trangthai">
                    <option value="" disabled selected>Chọn Trạng Thái</option>
                    <option value="Đang Làm Việc">Đang Làm Việc</option>
                    <option value="Đã Nghỉ Việc">Đã Nghỉ Việc</option>
                </select>
                <input type="text" name="txttimkiem" id="txttimkiem" placeholder="Tìm Kiếm...">
                <div class="btnthemnhanvien">
            <button id="them-nhan-vien" class="btn" onclick="location.href='formthemnv(TP).php';">
                <i class="fas fa-plus"></i> Nhân Viên
            </button>
        </div>
            </div>
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
                                <th>Trạng Thái</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                                <td colspan="9" class="no-data">Không có dữ liệu</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
    const phongbanSelect = document.getElementById('phongban');
    const timkiemInput = document.getElementById('txttimkiem');
    const timkiemButton = document.getElementById('btntimkiem');
   const trangthaiSelect = document.getElementById('trangthai');


    const phongbanId = phongbanSelect.value;
    const trangthai = trangthaiSelect.value;
    const tableBody = document.getElementById('nhanvienTable').getElementsByTagName('tbody')[0];
    tableBody.innerHTML = "";  // Xóa nội dung bảng cũ

    if (phongbanId && trangthai) {
        
        fetchNhanVienData();
    }


   
 trangthaiSelect.addEventListener('change', fetchNhanVienData);

function fetchNhanVienData() {
    const phongbanId = phongbanSelect.value;
    const trangthai = trangthaiSelect.value;
    timkiemInput.value ="";
    const tableBody = document.getElementById('nhanvienTable').getElementsByTagName('tbody')[0];
    tableBody.innerHTML = "";  

    if (phongbanId && trangthai) {
       
        fetch(`get_nhanvien2.php?phongban=${phongbanId}&trangthai=${trangthai}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Không thể lấy dữ liệu');
                }
                return response.json();
            })
            .then(data => {
                // Kiểm tra và hiển thị dữ liệu
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
                        
                        row.insertCell(7).textContent = nhanvien.trangthai;

                        const actionCell = row.insertCell(8);

                        // Tạo nút 'Xem Chi Tiết'
                        const detailButton = document.createElement('button');
                                    detailButton.className = 'action-button';
                                    detailButton.innerHTML = '<i class="fas fa-eye"></i>'; // Eye icon
                                    detailButton.onclick = function() {
                                        xemChiTietNhanVien(nhanvien.manv);
                                    };
                                    actionCell.appendChild(detailButton);

                                    const updateStatusButton = document.createElement('button');
                                    updateStatusButton.className = 'action-button1';
                                    updateStatusButton.innerHTML = '<i class="fas fa-pencil-alt"></i>'; // Pencil icon
                                    updateStatusButton.onclick = function() {
                                        capNhatTrangThai(nhanvien.manv);
                                    };
                                    actionCell.appendChild(updateStatusButton);
                    });
                } else {
                    // Khi không có nhân viên
                    const row = tableBody.insertRow();
                    const cell = row.insertCell(0);
                    cell.colSpan = 9;
                    cell.textContent = 'Không có nhân viên';
                    cell.style.textAlign = "center";  // Canh giữa thông báo
                }
            })
            .catch(error => console.error('Lỗi khi lấy dữ liệu nhân viên:', error));
    } else {
        // Nếu chưa chọn đủ Phòng ban và Trạng thái, hiển thị thông báo
        const row = tableBody.insertRow();
        const cell = row.insertCell(0);
        cell.colSpan = 9;
        cell.textContent = 'Vui lòng chọn Phòng ban và Trạng thái';
        cell.style.textAlign = "center";  // Canh giữa thông báo
    }
}


// Thay sự kiện click bằng change
timkiemInput.addEventListener('input', function() {
    const tenNhanVien = timkiemInput.value.trim();
    const phongbanId = phongbanSelect.value;
    

if(tenNhanVien==""){
    fetchNhanVienData();

}



if (tenNhanVien !="") {
        fetch(`timkiem_nhanvien2.php?tennv=${tenNhanVien}&phongban=${phongbanId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Không thể tìm kiếm');
                }
                return response.json();
            })
            .then(data => {
                trangthaiSelect.selectedIndex = 0;

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
                       
                        row.insertCell(7).textContent = nhanvien.trangthai;

                        const actionCell = row.insertCell(8);

                        // Nút xem chi tiết
                        const detailButton = document.createElement('button');
                                    detailButton.className = 'action-button';
                                    detailButton.innerHTML = '<i class="fas fa-eye"></i>'; // Eye icon
                                    detailButton.onclick = function() {
                                        xemChiTietNhanVien(nhanvien.manv);
                                    };
                                    actionCell.appendChild(detailButton);

                                    const updateStatusButton = document.createElement('button');
                                    updateStatusButton.className = 'action-button1';
                                    updateStatusButton.innerHTML = '<i class="fas fa-pencil-alt"></i>'; // Pencil icon
                                    updateStatusButton.onclick = function() {
                                        capNhatTrangThai(nhanvien.manv);
                                    };
                                    actionCell.appendChild(updateStatusButton);
                    });
                } else {
                    const row = tableBody.insertRow();
                    const cell = row.insertCell(0);
                    cell.colSpan = 10;
                    cell.classList.add('no-result');
                    cell.textContent = 'Không tìm thấy nhân viên';
                }
            })
            .catch(error => {
                console.error('Lỗi khi tìm kiếm nhân viên:', error);
                alert("Đã có lỗi xảy ra trong quá trình tìm kiếm. Vui lòng thử lại.");
            });
    } 
});



     function xemChiTietNhanVien(manv) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'formxemctnv(TP).php';
        form.target = '_blank';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'manv';
        input.value = manv;
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
    }
  function capNhatTrangThai(manv) {
        if (!manv) {
            alert("Mã nhân viên không hợp lệ!");
            return;
        }

        const confirmUpdate = confirm("Bạn có chắc chắn muốn cập nhật trạng thái cho nhân viên này không?");
        if (confirmUpdate) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'capnhattrangthainv.php';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'manv';
            input.value = manv;
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        }
    }
});

    </script>
</body>
<style>
       body {
    font-family: 'Arial', sans-serif;
    background-color:#DFF2EB;
    background-size: cover;
    color: #333;
    margin: 0;
    padding: 20px;
    min-height: 90vh; /* Đảm bảo body chiếm toàn bộ viewport */
    display: flex; /* Sử dụng Flexbox */
    flex-direction: column; /* Sắp xếp các phần tử theo chiều dọc */
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
            background-color:rgb(122, 178, 211);  
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
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
            width: 250px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .search-bar select:focus, 
        .search-bar input[type="text"]:focus {
            border-color: #00aaff; 
            outline: none;
        }

        button {
            padding: 10px 15px;
            font-size: 14px;
            background-color: black;  
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
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
    display: flex; /* Use flexbox for layout */
    gap: 20px; /* Space between label boxes */
    margin-bottom: 20px; /* Space below the section */
    justify-content: flex-start; /* Align items to the left */
    align-items: center; /* Center items vertically */
    margin-left: 10px;
}

.label-box {
    background-color: white; /* White background for each label box */
    color: #2c3e50; /* Darker blue-gray text */
    padding: 15px 20px; /* Padding for each label box */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    font-size: 16px; /* Font size */
    font-weight: 500; /* Medium font weight */
    transition: box-shadow 0.3s ease; /* Smooth shadow transition */
}

.label-box:hover {
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
}

.ttnv i {
    margin-right: 8px; /* Khoảng cách giữa icon và text */
    font-size: 20px; /* Kích thước icon */
    color: rgb(74, 98, 138); /* Màu sắc của icon */
}
.lable.welcome {
    font-size: 24px; /* Kích thước chữ */
    font-weight: bold; /* Chữ đậm */
    color: #2c3e50; /* Màu chữ */
    margin-bottom: 20px; /* Khoảng cách dưới */
     
     /* Màu nền nhẹ cho thông báo */
    padding: 10px; /* Padding cho thông báo */
    border-radius: 5px; /* Bo góc cho thông báo */
}
.btnthemnhanvien {
    margin-left: auto;
}

.btnthemnhanvien .btn {
    padding: 10px 15px;
    background-color: #3498db; /* Màu nền */
    color: white; /* Màu chữ */
    border: none; /* Không có đường viền */
    border-radius: 5px; /* Bo góc */
    cursor: pointer; /* Con trỏ chuột khi hover */
    transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s; /* Hiệu ứng chuyển màu, phóng to và bóng đổ */
    font-size: 16px; /* Kích thước chữ */
}

.btnthemnhanvien .btn:hover {
    background-color: #2980b9; /* Màu khi hover */
    transform: scale(1.05); /* Phóng to 5% */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Bóng đổ */
}
    </style>
</html>
