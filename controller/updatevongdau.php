<?php
session_start();
include 'connect.php';
$mavongdau = 0;
if ($_GET['mavongdau']) {
    $mavongdau = $_GET['mavongdau'];
    //lay thong tin cauthu
    $sql = "SELECT * FROM vongdau WHERE MaVongDau = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $mavongdau);
    $stmt->execute();
    $result = $stmt->get_result();
    $arrInfoSan = array();
    if ($result && $result->num_rows > 0) {
        $arrInfoSan = $result->fetch_assoc();
        $result->close();
        $conn->next_result();
    }
}
// print_r($arrInfoTrongTai);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $TenVongDau = $_POST['TenVongDau'];
    $MaVongDau = $_POST['MaVongDau'];
    $MaGiaiDau = 1;
    if ($mavongdau == 0) {
        $MaCTtemp = date('mdHis');
        $stmt = $conn->prepare("INSERT INTO vongdau (MaVongDau, TenVongDau,MaGiaiDau) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $MaCTtemp, $TenVongDau,$MaGiaiDau);
            if ($stmt->execute()) {
                echo "Thêm vòng thành công!";
                header('Location: vongdau.php');
            } else {
                echo "Lỗi: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $stmt = $conn->prepare("UPDATE vongdau SET TenVongDau=? WHERE MaVongDau=?");
        if ($stmt) {
            $stmt->bind_param("si", $TenVongDau, $mavongdau);
            if ($stmt->execute()) {
                echo "Cập nhật vòng thành công!";
                header('Location: vongdau.php');
            } else {
                echo "Lỗi: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}
