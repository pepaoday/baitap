<?php
session_start();
include 'connect.php';
$magiaidau = 0;
if ($_GET['magiaidau']) {
    $magiaidau = $_GET['magiaidau'];
    //lay thong tin tran dau
    $sql = "SELECT * FROM giaidau WHERE MaGiaiDau = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $magiaidau);
    $stmt->execute();
    $result = $stmt->get_result();
    $arrInfoGiaiDau = array();
    if ($result && $result->num_rows > 0) {
        $arrInfoGiaiDau = $result->fetch_assoc();
        $result->close();
        $conn->next_result();
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaGiai = $_POST['MaGiai'];
    $TenGiai = $_POST['TenGiai'];
    $MoTa = $_POST['MoTa'];
    $NamBatDau = $_POST['NamBatDau'];
    $NamKetThuc = $_POST['NamKetThuc'];
    $HinhAnhGiaiDau = $_FILES['HinhAnhGiaiDau']['name'];
    $targetDir = "../QuanLyLichBongDa/images/";
    $targetFile = $targetDir . basename($_FILES["HinhAnhGiaiDau"]["name"]);

    if (move_uploaded_file($_FILES["HinhAnhGiaiDau"]["tmp_name"], $targetFile)) {
        echo "Tệp đã được tải lên: " . basename($_FILES["file"]["name"]);
    } else {
        echo "Đã xảy ra lỗi khi tải tệp lên.";
    }
    if ($MaGiai == 0) {
        $MaGiaiTemp = date('mdHis');
        $stmt = $conn->prepare("INSERT INTO giaidau (MaGiaiDau, TenGiaiDau, NamBatDau, NamKetThuc, MoTa, HinhAnhGiaiDau) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssssss", $MaGiaiTemp, $TenGiai, $NamBatDau, $NamKetThuc, $MoTa, $HinhAnhGiaiDau);
            if ($stmt->execute()) {
                echo "Thêm giải đấu thành công!";
                header('Location: giaibongda.php');
            } else {
                echo "Lỗi: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $stmt = $conn->prepare("UPDATE giaidau SET TenGiaiDau=?, MoTa=?, NamBatDau=?, NamKetThuc=?, HinhAnhGiaiDau=? WHERE MaGiaiDau=?");
        if ($stmt) {
            $stmt->bind_param("sssssi", $TenGiai, $MoTa, $NamBatDau, $NamKetThuc, $HinhAnhGiaiDau, $MaGiai);
            if ($stmt->execute()) {
                echo "Cập nhật giải đấu thành công!";
                header('Location: giaibongda.php');
            } else {
                echo "Lỗi: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}
