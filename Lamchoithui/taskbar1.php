<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ẩn/Hiện Taskbar</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .menu-toggle {
            position: fixed;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            font-size: 30px;
            cursor: pointer;
            z-index: 1000;
            color: white;
            padding: 10px;
            background-color: black;
            border-radius: 0 5px 5px 0;
            transition: color 0.3s ease;
        }

        .menu-toggle.hidden {
            display: none;
        }

        .menu-toggle:hover {
            color: #ccc;
        }

        .taskbar {
            position: fixed;
            top: 0;
            left: -200px;
            width: 200px;
            height: 100%;
            background-color: #333;
            color: white;
            transition: left 0.3s ease;
            box-shadow: 3px 0 5px rgba(0, 0, 0, 0.2);
            z-index: 999;
        }

        .taskbar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .taskbar ul li {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #444;
        }

        .taskbar ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .taskbar ul li a:hover {
            text-decoration: underline;
        }

        .taskbar-visible {
            left: 0;
        }

        .content {
            transition: margin-left 0.3s ease;
            margin-left: 0;
            padding: 20px;
        }

        .content-shifted {
            margin-left: 200px;
        }
    </style>
</head>
<body>
    <!-- Nút mở taskbar -->
    <div class="menu-toggle">
        &raquo;
    </div>

    <!-- Taskbar -->
    <div class="taskbar">
        <ul>
        <li><a href="formdsnhanvien(TP).php">Nhân VIên</a></li>
             <li><a href="formdsduan(TP).php">Dự Án</a></li>
             <li><a href="formdstaikhoan(TP).php">Tài Khoản</a></li>
             <li><a href="formtaikhoancanhan(TP).php">Đổi Mật Khẩu</a></li>
        </ul>
    </div>
 

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menuToggle = document.querySelector(".menu-toggle");
            const taskbar = document.querySelector(".taskbar");
            const content = document.querySelector(".content");

            // Khi click vào menu-toggle, hiển thị taskbar và đẩy content sang phải
            menuToggle.addEventListener("click", () => {
                taskbar.classList.add("taskbar-visible"); // Hiển thị taskbar
                content.classList.add("content-shifted"); // Đẩy content sang phải
                menuToggle.classList.add("hidden"); // Ẩn menu-toggle
            });

            // Khi click ra ngoài taskbar, ẩn taskbar và đưa content về vị trí cũ
            document.addEventListener("click", (event) => {
                if (!taskbar.contains(event.target) && event.target !== menuToggle) {
                    taskbar.classList.remove("taskbar-visible"); // Ẩn taskbar
                    content.classList.remove("content-shifted"); // Đưa content về vị trí cũ
                    menuToggle.classList.remove("hidden"); // Hiện lại menu-toggle
                }
            });
        });
    </script>
</body>
</html>
