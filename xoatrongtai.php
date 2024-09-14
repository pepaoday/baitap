<?php
include 'connect.php';
$matrongtai = 0;
if ($_GET['matrongtai'] || $_GET['matrongtai'] == 0) {
    $matrongtai = $_GET['matrongtai'];
    $sql = "DELETE FROM trongtai WHERE MaTrongTai=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $matrongtai);
        if ($stmt->execute()) {
            echo "Xóa trọng tài thành công!";
            header('Location: trongtai.php');
        } else {
            echo "Lỗi: " . $stmt->error;
        }
        $stmt->close();
    }
}
