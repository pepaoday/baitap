<?php
include 'connect.php';
$madoibong = 0;
if ($_GET['madoibong'] || 1) {
    $madoibong = $_GET['madoibong'];
    $sql = "DELETE FROM doibong WHERE MaDoiBong=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $madoibong);
        if ($stmt->execute()) {
            echo "Xóa trận đấu thành công!";
            header('Location: team.php');
        } else {
            echo "Lỗi: " . $stmt->error;
        }
        $stmt->close();
    }
}
