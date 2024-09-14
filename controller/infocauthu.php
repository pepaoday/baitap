<?php
session_start();
include 'connect.php';
$macauthu = 0;
if ($_GET['macauthu']) {
    $macauthu = $_GET['macauthu'];
    //lay thong tin cauthu
    $sql = "SELECT * FROM thongkecauthu WHERE MaCauThu = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $macauthu);
    $stmt->execute();
    $result = $stmt->get_result();
    $arrInfoCauThu = array();
    if ($result && $result->num_rows > 0) {
        $arrInfoCauThu = $result->fetch_assoc();
        $result->close();
        $conn->next_result();
    }
}

$macauthu = $_GET['macauthu'];
//lay thong tin cauthu
$sql = "SELECT * FROM cauthu WHERE MaCauThu = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $macauthu);
$stmt->execute();
$result = $stmt->get_result();
$arrInfoCauThu2 = array();
if ($result && $result->num_rows > 0) {
    $arrInfoCauThu2 = $result->fetch_assoc();
    $result->close();
    $conn->next_result();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $SoBanThang = $_POST['SoBanThang'];
    $SoTheVang = $_POST['SoTheVang'];
    $SoTheDo = $_POST['SoTheDo'];
    $SoTranDau = $_POST['SoTranDau'];
    $MaCauThu = $_POST['MaCauThu'];

    $stmt = $conn->prepare("UPDATE thongkecauthu SET SoBanThang=?, SoTheVang=?, SoTheDo=?, SoTranDau =? WHERE MaCauThu=?");
    if ($stmt) {
        $stmt->bind_param("ssssi", $SoBanThang, $SoTheVang, $SoTheDo, $SoTranDau, $MaCauThu);
        if ($stmt->execute()) {
            echo "Cập nhật cầu thủ thành công!";
            header('Location: cauthu.php');
        } else {
            echo "Lỗi: " . $stmt->error;
        }
        $stmt->close();
    }
}
