<?php
include 'connect.php';
$mavongdau = 0;
if ($_GET['mavongdau'] || 1) {
    $mavongdau = $_GET['mavongdau'];
    $sql = "DELETE FROM vongdau WHERE MaVongDau=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $mavongdau);
        if ($stmt->execute()) {
            echo "Xóa trận đấu thành công!";
            header('Location: vongdau.php');
        } else {
            echo "Lỗi: " . $stmt->error;
        }
        $stmt->close();
    }
}
