<?php
include 'ketnoi.php'; // Kết nối đến cơ sở dữ liệu

// Lấy dữ liệu từ yêu cầu GET
$tenduan = isset($_GET['tenduan']) ? trim($_GET['tenduan']) : '';
$mapb = isset($_GET['mapb']) ? trim($_GET['mapb']) : '';

// Nếu không có giá trị `tenduan` hoặc `mapb`, không thực hiện truy vấn
if (empty($tenduan) || empty($mapb)) {
    echo json_encode([]);
    exit;
}

// Update trạng thái của các dự án dựa trên ngày hiện tại
$today = date('Y-m-d');
$updateSql = "
    UPDATE duan 
    SET trangthai = CASE
        WHEN ngayhoanthanh < ? THEN 'Đã hoàn thành'
        WHEN ngayhoanthanh > ? AND ngaybatdau < ? THEN 'Đang thực hiện'
        WHEN ngaybatdau > ? THEN 'Sắp thực hiện'
    END
    WHERE (trangthai != 'Đã hoàn thành' AND ngayhoanthanh < ?)
       OR (trangthai != 'Đang thực hiện' AND ngayhoanthanh > ? AND ngaybatdau < ?)
       OR (trangthai != 'Sắp thực hiện' AND ngaybatdau > ?)
";

$updateStmt = $conn->prepare($updateSql);
if ($updateStmt) {
    $updateStmt->bind_param("ssssssss", $today, $today, $today, $today, $today, $today, $today, $today);
    $updateStmt->execute();
    $updateStmt->close();
}

// Truy vấn lấy dữ liệu dự án dựa trên `mada` hoặc `tenda`
$sql = "SELECT da.mada, da.tenda, pb.tenpb, da.ngaybatdau, da.ngayhoanthanh, da.trangthai 
        FROM duan da
        JOIN phongban pb ON da.phongban = pb.mapb
        WHERE (da.mada = ? OR da.tenda LIKE ?) 
          AND da.status != 'Đã Xóa' 
          AND da.phongban = ?";

$stmt = $conn->prepare($sql);

if ($stmt) {
    // Chuẩn bị tham số để truyền vào
    $mada = is_numeric($tenduan) ? intval($tenduan) : 0; // Chuyển thành số nguyên nếu hợp lệ
    $searchTerm = "%" . $tenduan . "%"; // Thêm ký tự `%` để tìm kiếm chính xác hơn

    $stmt->bind_param("iss", $mada, $searchTerm, $mapb);
    $stmt->execute();
    $result = $stmt->get_result();

    $duanData = [];

    // Lấy dữ liệu từ kết quả truy vấn
    while ($row = $result->fetch_assoc()) {
        // Định dạng lại ngày bắt đầu và ngày hoàn thành sang DD/MM/YYYY
        $ngaybatdau = date('d/m/Y', strtotime($row['ngaybatdau']));
        $ngayhoanthanh = date('d/m/Y', strtotime($row['ngayhoanthanh']));
        
        $duanData[] = [
            'mada' => $row['mada'],
            'tenda' => $row['tenda'],
            'tenpb' => $row['tenpb'],
            'ngaybatdau' => $ngaybatdau,
            'ngayhoanthanh' => $ngayhoanthanh,
            'trangthai' => $row['trangthai'],
        ];
    }

    // Trả về kết quả dưới dạng JSON
    header('Content-Type: application/json');
    echo json_encode($duanData);

    // Đóng kết nối
    $stmt->close();
} else {
    // Trường hợp câu truy vấn không thành công
    echo json_encode(['error' => 'Không thể thực hiện truy vấn']);
}

$conn->close();
?>
