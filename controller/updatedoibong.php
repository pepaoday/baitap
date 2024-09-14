<?php
session_start();
include 'connect.php';
$madoibong = 0;
if ($_GET['madoibong']) {
    $madoibong = $_GET['madoibong'];
    //lay thong tin tran dau
    $sql = "SELECT * FROM doibong WHERE MaDoiBong = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $madoibong);
    $stmt->execute();
    $result = $stmt->get_result();
    $arrInfoDoiBong = array();
    if ($result && $result->num_rows > 0) {
        $arrInfoDoiBong = $result->fetch_assoc();
        $result->close();
        $conn->next_result();
    }
}
// print_r($arrInfoDoiBong);

// lay doi bong
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

// //lay giai dau
// $sql = "SELECT * FROM giaibongda";
// $result = $conn->query($sql);
// $arrGiaiDau = array();
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $arrGiaiDau[] = $row;
//     }
// }




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaDoi = $_POST['MaDoi'];
    $TenDoi = $_POST['TenDoi'];
    $SanNha = $_POST['SanNha'];
    $HLV = $_POST['HLV'];
    $Logo = $_FILES['Logo']['name'];
    $targetDir = "../QuanLyLichBongDa/images/";
    $targetFile = $targetDir . basename($_FILES["Logo"]["name"]);
    if (move_uploaded_file($_FILES["Logo"]["tmp_name"], $targetFile)) {
        echo "Tệp đã được tải lên: " . basename($_FILES["Logo"]["name"]);
    } else {
        echo "Đã xảy ra lỗi khi tải tệp lên.";
    }
    // exit;
    if ($MaDoi == 0) {
        // INSERT
        $MaDoiTemp = date('mdHis');
        $stmt = $conn->prepare("INSERT INTO doibong (MaDoiBong, TenDoiBong, SanNha, HLV, Logo) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssss", $MaDoiTemp, $TenDoi, $SanNha, $HLV, $Logo);
            if ($stmt->execute()) {
                echo "Thêm đội bóng thành công!";
                header('Location: team.php');
            } else {
                echo "Lỗi: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        // UPDATE
        $stmt = $conn->prepare("UPDATE doibong SET TenDoiBong=?, SanNha=?, HLV=?, Logo=? WHERE MaDoiBong=?");
        if ($stmt) {
            $stmt->bind_param("sssss", $TenDoi, $SanNha, $HLV, $Logo, $MaDoi);
            if ($stmt->execute()) {
                echo "Cập nhật đội bóng thành công!";
                header('Location: team.php');
            } else {
                echo "Lỗi: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}
// exit;
