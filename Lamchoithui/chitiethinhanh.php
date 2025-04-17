<?php
include 'ketnoi.php';

$manv = isset($_GET['manv']) ? $_GET['manv'] : '';

if (!empty($manv)) {
    // Truy vấn thông tin nhân viên
    $sql = "SELECT * FROM nhanvien nv, phongban pb WHERE nv.mapb = pb.mapb AND manv = '$manv'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hinhanh = $row['hinhanh'];
        ?>
        <div style="text-align: center; margin-top: 50px;">
            <!-- Hiển thị ảnh hiện tại -->
            <img src="<?php echo $hinhanh; ?>" alt="Chi tiết hình ảnh" style="max-width: 300px; max-height: 300px; border-radius: 10px;">
            
            <!-- Nút quay lại -->
       

            <!-- Form cập nhật ảnh -->
            <form id="uploadForm" style="margin-top: 20px;">
                <input type="hidden" id="manv" name="manv" value="<?php echo $manv; ?>">
                
                <input type="file" name="filehinhanh" id="filehinhanh" accept="image/*" style="margin-top: 10px;" required>
                <br>
                <button type="button" onclick="uploadImage()" style="margin-top: 10px; padding: 5px 15px; background-color: #4CAF50; color: white; border: none; border-radius: 5px;">
                    Cập Nhật Ảnh
                </button>
            </form>

            <!-- Hiển thị trạng thái -->
            <p id="uploadStatus" style="color: green; text-align: center; margin-top: 10px;"></p>
        </div>

        <script>
            function uploadImage() {
                var formData = new FormData();
                var fileInput = document.getElementById("filehinhanh");
                var manv = document.getElementById("manv").value;

                // Kiểm tra xem người dùng đã chọn file chưa
                if (fileInput.files.length === 0) {
                    alert("Vui lòng chọn một hình ảnh trước khi tải lên!");
                    return;
                }

                // Thêm file ảnh vào FormData
                formData.append("image", fileInput.files[0]);

                // Gửi yêu cầu tới ImgBB API
                fetch('https://api.imgbb.com/1/upload?key=4492cd17ce112885a8956a72bf05b2a3', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 200) {
                        // Lấy URL ảnh trả về
                        var imageUrl = data.data.url;

                        // Cập nhật đường dẫn ảnh vào cơ sở dữ liệu
                        fetch('capnhathinhanh.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ manv: manv, hinhanh: imageUrl })
                        })
                        .then(response => response.text())
                        .then(result => {
                            if (result.trim() === "success") {
                                document.getElementById("uploadStatus").textContent = "Cập nhật ảnh thành công!";
                                document.getElementById("uploadStatus").style.color = "green";

                                // Hiển thị ảnh mới
                                setTimeout(() => location.reload(), 1000);
                            } else {
                                document.getElementById("uploadStatus").textContent = "Cập nhật ảnh thất bại!";
                                document.getElementById("uploadStatus").style.color = "red";
                            }
                        });
                    } else {
                        document.getElementById("uploadStatus").textContent = "Tải ảnh thất bại!";
                        document.getElementById("uploadStatus").style.color = "red";
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    document.getElementById("uploadStatus").textContent = "Đã xảy ra lỗi khi tải ảnh!";
                    document.getElementById("uploadStatus").style.color = "red";
                });
            }
        </script>
        <?php
    } else {
        echo "<p style='text-align: center; color: red;'>Không tìm thấy nhân viên.</p>";
    }
} else {
    echo "<p style='text-align: center; color: red;'>Mã nhân viên không hợp lệ.</p>";
}

$conn->close();
?>
