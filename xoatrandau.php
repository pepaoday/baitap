<?php
include 'connect.php';
$matrandau = 0;
if ($_GET['matrandau'] || $_GET['matrandau'] == 0) {
    $matrandau = $_GET['matrandau'];
    $sql = "DELETE FROM lichthidau WHERE MaTran=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $matrandau);
        if ($stmt->execute()) {
            echo "Xóa trận đấu thành công!";
            header('Location: index.php');
        } else {
            echo "Lỗi: " . $stmt->error;
        }
        $stmt->close();
    }
}
