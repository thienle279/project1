<?php
include 'ketnoi.php';  

 
$phongbanId = isset($_GET['phongban']) ? intval($_GET['phongban']) : 0;  
$trangthai = isset($_GET['trangthai']) ? trim($_GET['trangthai']) : '';

 
if ($phongbanId == 0 || empty($trangthai)) {
    echo json_encode([]);
    exit;
}

 
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
$updateStmt->bind_param("ssssssss", $today, $today, $today, $today, $today, $today, $today, $today);
$updateStmt->execute();
$updateStmt->close();

// Truy vấn lấy dữ liệu và sắp xếp theo mã dự án giảm dần
$sql = "SELECT da.mada, da.tenda, pb.tenpb, da.ngaybatdau, da.ngayhoanthanh, da.trangthai 
        FROM duan da
        JOIN phongban pb ON da.phongban = pb.mapb
        WHERE da.phongban = ? AND da.trangthai = ? and da.status != 'Đã Xóa'
        ORDER BY da.mada DESC"; // Sắp xếp theo mã dự án giảm dần

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $phongbanId, $trangthai);
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
$conn->close();
?>
