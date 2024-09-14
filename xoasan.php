<?php
include 'connect.php';
$masan = 0;
if ($_GET['masan'] || $_GET['masan'] == 0) {
    $masan = $_GET['masan'];
    $sql = "DELETE FROM sanvandong WHERE MaSan=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $masan);
        if ($stmt->execute()) {
            echo "Xóa sân vận động thành công!";
            header('Location: sanvandong.php');
        } else {
            echo "Lỗi: " . $stmt->error;
        }
        $stmt->close();
    }
}
