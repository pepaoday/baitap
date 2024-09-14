<?php
session_start();
include 'connect.php';
$masan = 0;
if ($_GET['masan']) {
    $masan = $_GET['masan'];
    //lay thong tin cauthu
    $sql = "SELECT * FROM sanvandong WHERE MaSan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $masan);
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
    $TenSan = $_POST['TenSan'];
    $DiaChi = $_POST['DiaChi'];
    $MaSan = $_POST['MaSan'];

    if ($MaSan == 0) {
        $MaCTtemp = date('mdHis');
        $stmt = $conn->prepare("INSERT INTO sanvandong (MaSan, TenSan, DiaChi) VALUES (?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sss", $MaCTtemp, $TenSan, $DiaChi);
            if ($stmt->execute()) {
                echo "Thêm sân thành công!";
                header('Location: sanvandong.php');
            } else {
                echo "Lỗi: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $stmt = $conn->prepare("UPDATE sanvandong SET TenSan=?, DiaChi=? WHERE MaSan=?");
        if ($stmt) {
            $stmt->bind_param("ssi", $TenSan, $DiaChi, $MaSan);
            if ($stmt->execute()) {
                echo "Cập nhật sân thành công!";
                header('Location: sanvandong.php');
            } else {
                echo "Lỗi: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}
