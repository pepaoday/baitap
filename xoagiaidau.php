<?php
include 'connect.php';
$magiaidau = 0;
if ($_GET['magiaidau'] || $_GET['magiaidau'] == 0) {
    $magiaidau = $_GET['magiaidau'];
    $sql = "DELETE FROM giaidau WHERE MaGiaiDau=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $magiaidau);
        if ($stmt->execute()) {
            echo "Xóa trận đấu thành công!";
            header('Location: giaibongda.php');
        } else {
            echo "Lỗi: " . $stmt->error;
        }
        $stmt->close();
    }
}
