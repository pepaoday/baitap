<?php
include 'connect.php';
$macauthu = 0;
if ($_GET['macauthu'] || 1) {
    $macauthu = $_GET['macauthu'];
    $sql = "DELETE FROM cauthu WHERE MaCauThu=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $macauthu);
        if ($stmt->execute()) {
            echo "Xóa cầu thủ thành công!";
            header('Location: cauthu.php');
        } else {
            echo "Lỗi: " . $stmt->error;
        }
        $stmt->close();
    }
}
