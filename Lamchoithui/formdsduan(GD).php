<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Dự Án</title>
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
$sql1 = "SELECT COUNT(mada) as count1 from duan where status != 'Đã Xóa'";
$result1 = $conn->query($sql1);

// Check if the first query was successful
if ($result1) {
    if ($result1->num_rows > 0) {
        // Fetch the result
        $row = $result1->fetch_assoc();
        $slnv = $row['count1'];
    } else {
        // No employees found
        $slnv = 0;
    }
} else {
    // Handle query error
    echo "Error in query 1: " . $conn->error;
}

// Query to count active employees
$sql2 = "SELECT COUNT(mada) as count2 from duan  WHERE trangthai = 'Sắp thực hiện' and status != 'Đã Xóa'";
$result2 = $conn->query($sql2);

// Check if the second query was successful
if ($result2) {
    if ($result2->num_rows > 0) {
        // Fetch the result
        $row = $result2->fetch_assoc();
        $slnv2 = $row['count2'];
    } else {
        // No active employees found
        $slnv2 = 0;
    }
} else {
    // Handle query error
    echo "Error in query 2: " . $conn->error;
}
$sql3 = "SELECT COUNT(mada) as count3 from duan  WHERE trangthai = 'Đang thực hiện' and status != 'Đã Xóa'";
$result3 = $conn->query($sql3);

// Check if the second query was successful
if ($result3) {
    if ($result3->num_rows > 0) {
        // Fetch the result
        $row = $result3->fetch_assoc();
        $slnv3 = $row['count3'];
    } else {
        // No active employees found
        $slnv2 = 0;
    }
} else {
    // Handle query error
    echo "Error in query 2: " . $conn->error;
}
$sql4 = "SELECT COUNT(mada) as count4 from duan  WHERE trangthai = 'Đã hoàn thành' and status != 'Đã Xóa'";
$result4 = $conn->query($sql4);

// Check if the second query was successful
if ($result4) {
    if ($result4->num_rows > 0) {
        // Fetch the result
        $row = $result4->fetch_assoc();
        $slnv4 = $row['count4'];
    } else {
        // No active employees found
        $slnv2 = 0;
    }
} else {
    // Handle query error
    echo "Error in query 2: " . $conn->error;
}
?>
        <?php include 'taskbar.php'; ?>
<div class="ttnv">
    <div class="label-box">
        <i class="fas fa-database"></i>  
        Tổng số <?php echo "$slnv"; ?>
    </div>
    <div class="label-box">
        <i class="fas fa-clock"></i> <!-- Icon người đang làm việc -->
   Sắp thực hiện <?php echo "$slnv2"; ?>
    </div>
    <div class="label-box">
        <i class="fas fa-spinner"></i> <!-- Icon người đã nghỉ -->
       Đang thực hiện <?php echo "$slnv3"; ?>
    </div>
    <div class="label-box">
        <i class="fas fa-check"></i>  
        Đã hoàn thành <?php echo "$slnv4"; ?>
    </div>
</div>
<div class="container"><div class="search-bar">
    <select name="txtphongban" id="phongban">
        <option value="" disabled selected>Chọn Phòng Ban</option>
    </select>
    <select name="txttrangthai" id="trangthai">
        <option value="" disabled selected>Chọn Trạng Thái</option>
        <option value="Sắp thực hiện">Sắp thực hiện</option>
        <option value="Đang thực hiện">Đang thực hiện</option>
        <option value="Đã hoàn thành">Đã hoàn thành</option>
    </select><br>
    <input type="text" name="txttimkiem" id="txttimkiem" placeholder="Tìm Kiếm...">
    <div class="btnthemnhanvien">
            <button id="them-nhan-vien" class="btn" onclick="location.href='formthemduan(GD).php';">
                <i class="fas fa-plus"></i> Dự án
            </button>
            </div>
</div>
<div class="form"> 
<div class="table-container">  <table id="duanTable">
        <thead>
            <tr>
                <th>Mã Dự Án</th>
                <th>Tên Dự Án</th>
                <th>Phòng Ban</th>
                <th>Ngày Bắt Đầu</th>
                <th>Ngày Hoàn Thành</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
        <tr>
                                <td colspan="7" class="no-data">Không có dữ liệu</td>
                            </tr>
        </tbody>
    </table></div>
  
</div>
</div>

</div>
   
</body>
</html>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const timkiemInput = document.getElementById('txttimkiem');
            const phongbanSelect = document.getElementById('phongban');
            const trangthaiSelect = document.getElementById('trangthai');
            const tableBody = document.getElementById('duanTable').getElementsByTagName('tbody')[0];

             fetch('get_phongban.php')
                .then(response => response.json())
                .then(data => {
                    data.forEach(phongban => {
                        const option = document.createElement('option');
                        option.value = phongban.value;
                        option.textContent = phongban.name;
                        phongbanSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Lỗi khi lấy dữ liệu phòng ban:', error));

       
            phongbanSelect.addEventListener('change', fetchDuAnData);
            trangthaiSelect.addEventListener('change', fetchDuAnData);

            function fetchDuAnData() {
                timkiemInput.value="";
    const phongbanId = phongbanSelect.value;
    const trangthai = trangthaiSelect.value;
    tableBody.innerHTML = "";  
    if (phongbanId && trangthai) {
        fetch(`get_duan.php?phongban=${phongbanId}&trangthai=${trangthai}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data); 

                if (data.length > 0) {
                    data.forEach(duan => {
                        const row = tableBody.insertRow();
                        row.insertCell(0).textContent = duan.mada;  
                        row.insertCell(1).textContent = duan.tenda;  
                        row.insertCell(2).textContent = duan.tenpb;  
                        row.insertCell(3).textContent = duan.ngaybatdau;  
                        row.insertCell(4).textContent = duan.ngayhoanthanh;  
                        row.insertCell(5).textContent = duan.trangthai;  

                        const actionCell = row.insertCell(6);

                        // Nút "Xem Chi Tiết"
                        const detailButton = document.createElement('button');
                        detailButton.className = 'action-button';
                        detailButton.innerHTML = '<i class="fas fa-eye"></i>'; // Eye icon
                        detailButton.onclick = () => xemChiTietDuAn(duan.mada);
                        actionCell.appendChild(detailButton);

                        // Nút "Xóa"
                        const deleteButton = document.createElement('button');
                        deleteButton.className = 'action-button1';
                        deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
                        deleteButton.onclick = () => xoaDuAn(duan.mada);  
                        actionCell.appendChild(deleteButton);
                    });
                } else {
                    const row = tableBody.insertRow();
                    const cell = row.insertCell(0);
                    cell.colSpan = 8; 
                    cell.textContent = 'Không có dự án nào';
                    cell.style.textAlign = "center";
                }
            })
            .catch(error => console.error('Lỗi khi lấy dữ liệu dự án:', error));
    } else {
        const row = tableBody.insertRow();
        const cell = row.insertCell(0);
        cell.colSpan = 7; 
        cell.textContent = 'Vui lòng chọn Phòng ban và Trạng thái';
        cell.style.textAlign = "center";
    }
}

                
             timkiemInput.addEventListener('input', function() {
                const tenduan = timkiemInput.value.trim();
                if (tenduan!="") {
                    tableBody.innerHTML = "";  
                    phongbanSelect.selectedIndex = 0;
                    trangthaiSelect.selectedIndex = 0;
               
                    fetch(`timkiem_duan.php?tenduan=${tenduan}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log(data); 

                            if (data.length > 0) {
                                data.forEach(duan => {
                                    const row = tableBody.insertRow();
                                    row.insertCell(0).textContent = duan.mada;  
                                    row.insertCell(1).textContent = duan.tenda;  
                                    row.insertCell(2).textContent = duan.tenpb;  
                                    row.insertCell(3).textContent = duan.ngaybatdau;  
                                    row.insertCell(4).textContent = duan.ngayhoanthanh;  
                                    row.insertCell(5).textContent = duan.trangthai;  

                                    const actionCell = row.insertCell(6);
                                    const detailButton = document.createElement('button');
                                    detailButton.className = 'action-button';
                                    detailButton.innerHTML = '<i class="fas fa-eye"></i>'; // Eye icon
                                    detailButton.onclick = () => xemChiTietDuAn(duan.mada);
                                    actionCell.appendChild(detailButton);


                                    const deleteButton = document.createElement('button');
                                    deleteButton.className = 'action-button1';
                        deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
                        deleteButton.onclick = () => xoaDuAn(duan.mada, duan.tenda);  // Gọi hàm xóa dự án
                        actionCell.appendChild(deleteButton);
                                });
                            } else {
                                const row = tableBody.insertRow();
                                const cell = row.insertCell(0);
                                cell.colSpan = 7; 
                                cell.textContent = 'Không có dự án nào';
                                cell.style.textAlign = "center";
                            }
                        })
                        .catch(error => console.error('Lỗi khi lấy dữ liệu dự án:', error));
               
                } 
                if(tenduan==""){

                    fetchDuAnData();
                }
            });



            function xemChiTietDuAn(mada) {
               
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'formxemctduan(GD).php';
                form.target = '_blank';

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'mada';
                input.value = mada;
                form.appendChild(input);

                document.body.appendChild(form);
                form.submit();
            }

            function xoaDuAn(mada, tenda) {
    // Hiển thị thông báo xác nhận kèm tên dự án
    const message = `Bạn có chắc chắn muốn xóa dự án ${mada} không?`;
    
    if (confirm(message)) {
        fetch('delete_duan.php', {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/json' // Định dạng dữ liệu gửi là JSON
            },
            body: JSON.stringify({ mada: mada }) // Gửi mã dự án trong body
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Lỗi khi xóa dự án');
            }
            return response.json();
        })
        .then(result => {
            if (result.success) {
                alert('Dự án đã được xóa thành công.');
                fetchDuAnData(); // Cập nhật lại danh sách dự án sau khi xóa
            } else {
                alert(result.message || 'Không thể xóa dự án. Vui lòng thử lại.');
            }
        })
        .catch(error => console.error('Lỗi khi gửi yêu cầu xóa dự án:', error));
    }
}

window.addEventListener('pageshow', function(event) {
    trangthaiSelect.selectedIndex = 0;
});






        });
    </script>