<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
include 'connect.php';
$matrandau = 0;
if ($_GET['matrandau']) {
    $matrandau = $_GET['matrandau'];
    //lay thong tin tran dau
    $sql = "SELECT * FROM lichbongda WHERE MaTran = ?";
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
$sql = "SELECT * FROM doibong";
$result = $conn->query($sql);
$arrDoiBong = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arrDoiBong[] = $row;
    }
}

if ($_GET['keyword']) {
    $keyword = $_GET['keyword'];
    $arrDoiBong = array_filter($arrDoiBong, function ($item) use ($keyword) {
        return $item['MaDoiBong'] == $keyword;
    });
    $arrDoiBong = array_values($arrDoiBong);
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
// $sql = "SELECT * FROM giaibongda";
// $result = $conn->query($sql);
// $arrGiaiDau = array();
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $arrGiaiDau[] = $row;
//     }
// }




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doiNha = $_POST['DoiNha'];
    $doiKhach = $_POST['DoiKhach'];
    $sanDau = $_POST['SanDau'];
    $trongTai = $_POST['TrongTai'];
    $giaiDau = $_POST['GiaiDau'];
    $ngayGio = $_POST['NgayGio'];
    $datetime = date("Y-m-d H:i:s", strtotime($ngayGio));
    $maTran = $_POST['MaTran'];

    if ($matrandau == 0) {
        $stmt = $conn->prepare("INSERT INTO lichbongda (DoiNha, DoiKhach, SanDau, MaTrongTai, MaGiai, NgayGio) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssssss", $doiNha, $doiKhach, $sanDau, $trongTai, $giaiDau, $datetime);
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
        $stmt = $conn->prepare("UPDATE lichbongda SET DoiNha=?, DoiKhach=?, SanDau=?, MaTrongTai=?, MaGiai=?, NgayGio=? WHERE MaTran=?");
        if ($stmt) {
            $stmt->bind_param("sssssss", $doiNha, $doiKhach, $sanDau, $trongTai, $giaiDau, $datetime, $maTran);
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
