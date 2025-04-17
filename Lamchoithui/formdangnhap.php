<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('image/z6053073639214_8464031245f8c728c3dd03b5194283d2(1)(1)(1).jpg') no-repeat center center fixed;
            background-size: cover;
        }

        #formdangnhap {
            background: rgba(0, 0, 0, 0.7);
            width: 100%;
            max-width: 350px;
            padding: 40px 20px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        #formdangnhap h2 {
            color: white;
            margin-bottom: 20px;
            font-size: 24px;
        }

        #formdangnhap input[type="text"],
        #formdangnhap input[type="password"] {
            width: 100%;
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            color: white;
            font-size: 16px;
            margin-bottom: 20px;
            padding: 10px 5px;
            outline: none;
        }

        #formdangnhap input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        #formdangnhap button {
            width: 100%;
            border: none;
            padding: 10px;
            margin-top: 20px;
            font-size: 16px;
            color:#5DADE2; /* Màu chữ ban đầu */
            background: white; /* Nền nút ban đầu */
            border-radius: 5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        #formdangnhap button:hover {
            background: #5DADE2; /* Nền nút khi hover */
            color: white; /* Màu chữ khi hover */
        }
    </style>
</head>
<body>
    <form action="dangnhap.php" id="formdangnhap" method="post" autocomplete="off">
        <h2>Login</h2>
        <input type="text" placeholder="Username" name="txtsdt" autocomplete="off">
        <input type="password" placeholder="Password" name="txtpass" autocomplete="off">
        <button type="submit">Login</button>
    </form>
</body>
</html>
