<?php
session_start();
include 'connect.php';
$matrongtai = 0;
if ($_GET['matrongtai']) {
    $matrongtai = $_GET['matrongtai'];
    //lay thong tin cauthu
    $sql = "SELECT * FROM trongtai WHERE MaTrongTai = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $matrongtai);
    $stmt->execute();
    $result = $stmt->get_result();
    $arrInfoTrongTai = array();
    if ($result && $result->num_rows > 0) {
        $arrInfoTrongTai = $result->fetch_assoc();
        $result->close();
        $conn->next_result();
    }
}
// print_r($arrInfoTrongTai);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $TenTrongTai = $_POST['TenTrongTai'];
    $NgaySinh = $_POST['NgaySinh'];
    $QuocTich = $_POST['QuocTich'];
    $MaTrongTai = $_POST['MaTrongTai'];

    if ($MaTrongTai == 0) {
        $MaCTtemp = date('mdHis');
        $stmt = $conn->prepare("INSERT INTO trongtai (MaTrongTai, TenTrongTai, NgaySinh, QuocTich) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssss", $MaCTtemp, $TenTrongTai, $NgaySinh, $QuocTich);
            if ($stmt->execute()) {
                echo "Thêm trọng tài thành công!";
                header('Location: trongtai.php');
            } else {
                echo "Lỗi: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $stmt = $conn->prepare("UPDATE trongtai SET TenTrongTai=?, NgaySinh=?, QuocTich=? WHERE MaTrongTai=?");
        if ($stmt) {
            $stmt->bind_param("sssi", $TenTrongTai, $NgaySinh, $QuocTich, $MaTrongTai);
            if ($stmt->execute()) {
                echo "Cập nhật cầu thủ thành công!";
                header('Location: trongtai.php');
            } else {
                echo "Lỗi: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}
