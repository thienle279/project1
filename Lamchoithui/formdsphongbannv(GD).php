<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Phòng Ban</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #DFF2EB;
            color: #333;
            margin: 0;
            padding: 20px;
            position: relative;
        }

        /* Nút Thêm Phòng Ban */
        .add-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .add-button button {
            background-color: #3498db; /* Màu xanh dương */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .add-button button i {
            margin-right: 8px; /* Khoảng cách giữa icon và chữ */
        }

        .add-button button:hover {
            background-color: #2980b9; /* Màu xanh dương đậm khi hover */
            transform: scale(1.1); /* Phóng to nhẹ khi hover */
        }

        .container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            max-width: 1000px;
            margin: 100px auto 0;
        }

        .phongban-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .phongban-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .phongban-card[data-color="green"] {
            border-top: 5px solid #27ae60;
        }

        .phongban-card[data-color="purple"] {
            border-top: 5px solid #9b59b6;
        }

        .phongban-card[data-color="orange"] {
            border-top: 5px solid #e67e22;
        }

        .phongban-card[data-color="blue"] {
            border-top: 5px solid #3498db;
        }

        .phongban-card h3 {
            font-size: 20px;
            color: #333;
        }

        .phongban-card button {
            margin-top: 15px;
            background-color: white;
            color: black;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 30px;
            transition: background 0.3s ease;
        }

        .phongban-card button:hover {
            background-color: grey;
        }

        .no-data {
            font-size: 18px;
            color: #e74c3c;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="content">
    <!-- Nút Thêm Phòng Ban -->
    <div class="add-button">
        <form action="formthemphongban.php" method="POST">
            <button type="submit">
                <i class="fas fa-plus"></i> Thêm Phòng Ban
            </button>
        </form>
    </div>

    <!-- Danh sách Phòng Ban -->
    <div class="container">
        <?php
        include 'ketnoi.php';
        $sql = "SELECT * FROM phongban WHERE trangthai != 'locked'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $colors = ['green', 'purple', 'orange', 'blue'];
            $index = 0;

            while ($row = $result->fetch_assoc()) {
                $color = $colors[$index % count($colors)];
                echo "<div class='phongban-card' data-color='$color'>";
                echo "<h3>" . $row['tenpb'] . "</h3>";
                echo "<form action='formxemchitietpbnv(GD).php' method='POST'>";
                echo "<input type='hidden' name='mapb' value='" . $row['mapb'] . "'>";
                echo "<button type='submit'><i class='fas fa-eye'></i></button>";
                echo "</form>";
                echo "</div>";
                $index++;
            }
        } else {
            echo "<div class='no-data'>Không có dữ liệu.</div>";
        }
        include 'taskbar.php';
        $conn->close();
        ?>
        </div>
    </div>
</body>
</html>
