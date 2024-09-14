<?php
session_start();
include 'connect.php';
$matrandau = 0;
if ($_GET['matrandau']) {
    $matrandau = $_GET['matrandau'];
    //lay thong tin tran dau
    $sql = "SELECT * FROM lichthidau WHERE MaTran = ?";
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


//lay doi bong
$sql = "SELECT * FROM sanvandong";
$result = $conn->query($sql);
$arrSanDau = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arrSanDau[] = $row;
    }
}

$sql = "SELECT * FROM doibong";
$result = $conn->query($sql);
$arrDoiBong = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arrDoiBong[] = $row;
    }
}

//lay trong tai
$sql = "SELECT * FROM trongtai";
$result = $conn->query($sql);
$arrTrongTai = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arrTrongTai[] = $row;
    }
}

//lay giai dau
$sql = "SELECT * FROM vongdau";
$result = $conn->query($sql);
$arrVongDau = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arrVongDau[] = $row;
    }
}
// print_r($arrVongDau);





if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doiNha = $_POST['DoiNha'];
    $doiKhach = $_POST['DoiKhach'];
    $sanDau = $_POST['SanDau'];
    $trongTai = $_POST['TrongTai'];
    $VongDau = $_POST['VongDau'];
    $ngayGio = $_POST['NgayGio'];
    $MoTa = $_POST['MoTa'];
    $datetime = date("Y-m-d H:i:s", strtotime($ngayGio));
    $maTran = $_POST['MaTran'];

    if ($maTran == 0) {
        $maTranTemp = date('mdHis');
        $stmt = $conn->prepare("INSERT INTO lichthidau (MaTran, MaDoiNha, MaDoiKhach, MaSan, MaTrongTai, MaVongDau, NgayGio, MoTa) VALUES (?, ?, ?, ?, ?, ?, ? ,?)");
        if ($stmt) {
            $stmt->bind_param("ssssssss", $maTranTemp, $doiNha, $doiKhach, $sanDau, $trongTai, $VongDau, $datetime, $MoTa);
            if ($stmt->execute()) {
                echo "Thêm mới thành công!";
                header('Location: index.php');
            } else {
                echo "Lỗi: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        $stmt = $conn->prepare("UPDATE lichthidau SET MaDoiNha=?, MaDoiKhach=?, MaSan=?, MaTrongTai=?, MaVongDau=?, NgayGio=?, MoTa= ? WHERE MaTran=?");
        if ($stmt) {
            $stmt->bind_param("ssssssss", $doiNha, $doiKhach, $sanDau, $trongTai, $VongDau, $datetime, $MoTa, $maTran);
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
}
// exit;
