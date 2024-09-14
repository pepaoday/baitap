<?php
session_start();
$error_message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = md5(trim($_POST['password']));
    $MaCTtemp = date('mdHis');
    $email = trim($_POST['email']);
    $sql = "INSERT INTO taikhoan (MaTaiKhoan, TenDangNhap, MatKhau, Email) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $MaCTtemp, $username, $password, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    header('Location: login.php');
}
