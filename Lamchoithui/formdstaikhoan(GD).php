<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài Khoản</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    transition: box-shadow 0.3s ease; 
}

.label-box:hover {
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);  
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
</head>
<body>
    
    <div class="content">
        
    <div class="lable welcome"> Welcome Admin!!</div>
    <?php
include 'ketnoi.php'; // Ensure your database connection is included

// Query to count total employees
$sql1 = "SELECT COUNT(matk) as slnv from taikhoan where chucvu != 'Giám Đốc' ";
$result1 = $conn->query($sql1);

 
if ($result1) {
    if ($result1->num_rows > 0) {
       
        $row = $result1->fetch_assoc();
        $slnv = $row['slnv'];
    } else {
         
        $slnv = 0;
    }
} else {
    
    echo "Error in query 1: " . $conn->error;
}

 
$sql2 = "SELECT COUNT(matk) as slnv2 from taikhoan  WHERE trangthai = 'Đang Làm Việc' and chucvu != 'Giám Đốc'";
$result2 = $conn->query($sql2);

 
if ($result2) {
    if ($result2->num_rows > 0) {
        
        $row = $result2->fetch_assoc();
        $slnv2 = $row['slnv2'];
    } else {
         
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
        <i class="fas fa-user-check"></i>  
    Đang làm việc <?php echo "$slnv2"; ?>
    </div>
    <div class="label-box">
        <i class="fas fa-user-slash"></i>  
        Đã nghỉ việc <?php echo "$slnv3"; ?>
    </div>
</div>

<div class="container"><div class="search-bar">
<select name="txtphongban" id="phongban">
        <option value="" disabled selected>Chọn Phòng Ban</option>
    </select>
    <select name="txttrangthai" id="trangthai">
    <option value="" disabled selected>Chọn Trạng Thái</option>
        <option value="Đang Làm Việc" >Đang Làm Việc</option>
        <option value="Đã Nghỉ Việc" >Đã Nghỉ Việc</option>
    </select><br>
    <input type="text" name="txttimkiem" id="txttimkiem" placeholder="Tìm Kiếm...">
</div>
<div class="table-container"> 
<table id="tktable">
        <thead>
            <tr>
                <th>Mã Nhân Viên</th>
                <th>Họ Tên</th>
                <th>Tên Đăng Nhập</th>
                <th>Mật Khẩu</th>
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

</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const phongbanSelect = document.getElementById('phongban');
    const timkiemInput = document.getElementById('txttimkiem');
    const trangthaiSelect = document.getElementById('trangthai');
    const tableBody = document.getElementById('tktable').getElementsByTagName('tbody')[0];

    // Lấy dữ liệu phòng ban khi tải trang
    fetch('get_phongban.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Lỗi khi lấy dữ liệu phòng ban');
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

    // Lắng nghe sự kiện thay đổi của phòng ban và trạng thái
    phongbanSelect.addEventListener('change', fetchtkNhanVienData);
    trangthaiSelect.addEventListener('change', fetchtkNhanVienData);

    // Hàm lấy dữ liệu tài khoản theo phòng ban và trạng thái
    function fetchtkNhanVienData() {
        const phongbanId = phongbanSelect.value;
        const trangthai = trangthaiSelect.value;
        tableBody.innerHTML = ""; // Xóa dữ liệu trong bảng
        timkiemInput.value = "";

        if (phongbanId && trangthai) {
            fetch(`get_taikhoan.php?mapb=${phongbanId}&trangthai=${trangthai}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Lỗi mạng khi lấy dữ liệu tài khoản');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.length > 0) {
                        data.forEach(taikhoan => {
                            const row = tableBody.insertRow();
                            row.insertCell(0).textContent = taikhoan.manv;
                            row.insertCell(1).textContent = taikhoan.hoten;
                            row.insertCell(2).textContent = taikhoan.sdt;
                            row.insertCell(3).textContent = taikhoan.matkhau;
                            row.insertCell(4).textContent = taikhoan.chucvu;
                            row.insertCell(5).textContent = taikhoan.tenpb;
                            row.insertCell(6).textContent = taikhoan.trangthai;

                            const actionCell = row.insertCell(7);
                            const detailButton = document.createElement('button');
                            detailButton.className = 'action-button1';
                            detailButton.innerHTML = '<i class="fas fa-lock"></i>';
                            detailButton.onclick = () => khoatk(taikhoan.manv);
                            actionCell.appendChild(detailButton);
                        });
                    } else {
                        const row = tableBody.insertRow();
                        const cell = row.insertCell(0);
                        cell.colSpan = 8;
                        cell.textContent = 'Không có tài khoản nào phù hợp';
                        cell.style.textAlign = "center";
                    }
                })
                .catch(error => console.error('Lỗi khi xử lý dữ liệu tài khoản:', error));
        } else {
            const row = tableBody.insertRow();
            const cell = row.insertCell(0);
            cell.colSpan = 8;
            cell.textContent = 'Vui lòng chọn Phòng Ban và Trạng Thái';
            cell.style.textAlign = "center";
        }
    }

    // Tìm kiếm tài khoản khi nhập tên nhân viên
    timkiemInput.addEventListener('input', function () {
    const tenNhanVien = timkiemInput.value.trim();

    // Xóa bảng trước khi thêm dữ liệu mới
    tableBody.innerHTML = "";

    // Nếu tìm kiếm trống, gọi lại dữ liệu đầy đủ
    if (tenNhanVien === "") {
        fetchtkNhanVienData(); // Gọi lại hàm để lấy dữ liệu đầy đủ
    } else {
        // Nếu có giá trị tìm kiếm
        fetch(`timkiem_taikhoan.php?tennv=${encodeURIComponent(tenNhanVien)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Lỗi mạng khi lấy dữ liệu tài khoản');
                }
                return response.json();
            })
            .then(data => {
                // Reset dropdown về trạng thái mặc định
                phongbanSelect.selectedIndex = 0;
                trangthaiSelect.selectedIndex = 0;

                if (data.length > 0) {
                    data.forEach(taikhoan => {
                        const row = tableBody.insertRow();
                        row.insertCell(0).textContent = taikhoan.manv;        // Mã nhân viên
                        row.insertCell(1).textContent = taikhoan.hoten;       // Họ tên
                        row.insertCell(2).textContent = taikhoan.sdt;         // Số điện thoại
                        row.insertCell(3).textContent = taikhoan.matkhau;     // Mật khẩu
                        row.insertCell(4).textContent = taikhoan.chucvu;      // Chức vụ
                        row.insertCell(5).textContent = taikhoan.tenpb;       // Tên phòng ban
                        row.insertCell(6).textContent = taikhoan.trangthai;   // Trạng thái

                        // Cột hành động
                        const actionCell = row.insertCell(7);
                        const detailButton = document.createElement('button');
                        detailButton.className = 'action-button1';
                            detailButton.innerHTML = '<i class="fas fa-lock"></i>';
                        detailButton.onclick = () => khoatk(taikhoan.manv); // Gọi hàm khóa/mở
                        detailButton.style.cursor = 'pointer'; // Con trỏ chuột dạng pointer
                        actionCell.appendChild(detailButton);
                    });
                } else {
                    // Nếu không có tài khoản nào phù hợp
                    const row = tableBody.insertRow();
                    const cell = row.insertCell(0);
                    cell.colSpan = 8;
                    cell.textContent = 'Không có tài khoản nào phù hợp';
                    cell.style.textAlign = "center";
                }
            })
            .catch(error => {
                console.error('Lỗi khi xử lý dữ liệu tài khoản:', error);
                // Hiển thị thông báo lỗi trong giao diện
                const row = tableBody.insertRow();
                const cell = row.insertCell(0);
                cell.colSpan = 8;
                cell.textContent = 'Đã xảy ra lỗi khi tìm kiếm. Vui lòng thử lại.';
                cell.style.textAlign = "center";
                cell.style.color = "red";
            });
    }
});

    // Hàm khóa tài khoản
    function khoatk(manv) {
        const message = `Bạn có chắc chắn muốn khóa/mở khóa tài khoản này?`;

        if (confirm(message)) {
            fetch('khoatk.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json' // Định dạng dữ liệu gửi là JSON
                },
                body: JSON.stringify({ manv: manv }) // Gửi mã nhân viên trong body
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Lỗi khi khóa tài khoản');
                }
                return response.json();
            })
            .then(result => {
                if (result.success) {
                    alert('Tài khoản đã cập nhật.');
                    fetchtkNhanVienData(); // Cập nhật lại danh sách sau khi khóa tài khoản
                } else {
                    alert(result.message || 'Không thể khóa tài khoản. Vui lòng thử lại.');
                }
            })
            .catch(error => console.error('Lỗi khi gửi yêu cầu khóa tài khoản:', error));
        }
    }
});

</script>