<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Phòng Ban</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Căn lên trên */
            height: 100vh;
            margin: 0;
            padding-top: 50px; /* Khoảng cách từ trên xuống */
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
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-container textarea {
            height: 100px; /* Tăng chiều cao */
            resize: none; /* Không cho phép thay đổi kích thước */
        }

        .form-container input[type="text"]:focus,
        .form-container textarea:focus {
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

        .form-container p {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-top: 15px;
        }

        .form-container p a {
            color: #3498db;
            text-decoration: none;
        }

        .form-container p a:hover {
            text-decoration: underline;
        }
        body {
    font-family: 'Arial', sans-serif;
    background-color:#DFF2EB;
    background-size: cover;
    color: #333;
    
}
    </style>
</head>
<body>
    <?php include 'taskbar.php'; ?> 
    <div class="content"></div>
    <div class="form-container">
        <h2>Thêm Phòng Ban</h2>
        <form id="formthemphongban">
            <input name="tenphongban" id="tenphongban" type="text" placeholder="Tên phòng ban" required>
            <textarea name="mota" id="mota" placeholder="Mô tả" required></textarea>
            <button type="button" id="btnthempb">THÊM</button>
        </form>
       
    </div>

   
</body>
</html>
<script>
        document.getElementById('btnthempb').addEventListener('click', function() {
            const tenphongban = document.getElementById('tenphongban').value;
            const mota = document.getElementById('mota').value;

            fetch('themphongban.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `tenphongban=${encodeURIComponent(tenphongban)}&mota=${encodeURIComponent(mota)}`
            })
            .then(response => response.text())
            .then(data => {
                console.log(data); 
                alert("Phòng ban đã được thêm thành công!");
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Đã xảy ra lỗi!");
            });
        });
    </script>
