<?php
session_start();
include 'connect.php';
$matrandau = 0;
if ($_GET['matrandau']) {
    $matrandau = $_GET['matrandau'];
    //lay thong tin tran dau
    $sql = "SELECT * FROM ketquatrandau WHERE MaTran = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $matrandau);
    $stmt->execute();
    $result = $stmt->get_result();
    $arrThongTinTranDau = array();
    if ($result && $result->num_rows > 0) {
        $arrThongTinTranDau = $result->fetch_assoc();
        $result->close();
        $conn->next_result();
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doiNha = $_POST['DiemDoiNha'];
    $doiKhach = $_POST['DiemDoiKhach'];
    $MoTa = $_POST['MoTa'];
    $maTran = $_POST['MaTran'];
    $stmt = $conn->prepare("UPDATE ketquatrandau SET BanThangDoiNha=?, BanThangDoiKhach=?, MoTa=? WHERE MaTran=?");
    if ($stmt) {
        $stmt->bind_param("sssi", $doiNha, $doiKhach, $MoTa, $maTran);
        if ($stmt->execute()) {
            echo "Cập nhật thành công!";
            header('Location: index.php');
        } else {
            echo "Lỗi: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
// exit;
