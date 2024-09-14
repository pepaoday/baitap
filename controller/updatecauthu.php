<?php
session_start();
include 'connect.php';
$macauthu = 0;
if ($_GET['macauthu']) {
    $macauthu = $_GET['macauthu'];
    //lay thong tin cauthu
    $sql = "SELECT * FROM cauthu WHERE MaCauThu = ?";
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

// lay doi bong
$sql = "SELECT * FROM doibong";
$result = $conn->query($sql);
$arrDoiBong = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arrDoiBong[] = $row;
    }
}

// //lay trong tai
// $sql = "SELECT * FROM trongtai";
// $result = $conn->query($sql);
// $arrTrongTai = array();
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $arrTrongTai[] = $row;
//     }
// }

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
    $TenCauThu = $_POST['TenCauThu'];
    $Ngaysinh = $_POST['Ngaysinh'];
    $ViTri = $_POST['ViTri'];
    $SoAo = $_POST['SoAo'];
    $MaCauThu = $_POST['MaCauThu'];
    $MaDoiBong = $_POST['MaDoiBong'];
    $HinhAnh = $_FILES['HinhAnh']['name'];
    // print_r($_POST);
    // exit;
    $targetDir = "../QuanLyLichBongDa/images/";
    $targetFile = $targetDir . basename($_FILES["HinhAnh"]["name"]);

    if (move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], $targetFile)) {
        echo "Tệp đã được tải lên: " . basename($_FILES["file"]["name"]);
    } else {
        echo "Đã xảy ra lỗi khi tải tệp lên.";
    }
    if ($MaCauThu == 0) {
        $MaCTtemp = date('mdHis');
        $stmt = $conn->prepare("INSERT INTO cauthu (MaCauThu, TenCauThu, NgaySinh, ViTri, SoAo, MaDoiBong, HinhAnh) VALUES (?, ?, ?, ?, ?, ?,?)");
        if ($stmt) {
            $stmt->bind_param("sssssss", $MaCTtemp, $TenCauThu, $Ngaysinh, $ViTri, $SoAo, $MaDoiBong, $HinhAnh);
            if ($stmt->execute()) {
                echo "Thêm cầu thủ thành công!";
                header('Location: cauthu.php');
            } else {
                echo "Lỗi: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $stmt = $conn->prepare("UPDATE cauthu SET TenCauThu=?, NgaySinh=?, ViTri=?, SoAo =?, MaDoiBong=?, HinhAnh = ? WHERE MaCauThu=?");
        if ($stmt) {
            $stmt->bind_param("sssssi", $TenCauThu, $Ngaysinh, $ViTri, $SoAo, $MaDoiBong, $HinhAnh, $MaCauThu);
            if ($stmt->execute()) {
                echo "Cập nhật cầu thủ thành công!";
                header('Location: cauthu.php');
            } else {
                echo "Lỗi: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}
