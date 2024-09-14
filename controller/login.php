<?php
session_start();
$error_message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $sql = "SELECT * FROM taikhoan WHERE TenDangNhap = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $userLogin = $result->fetch_assoc();
    }
    if (md5($password) == $userLogin['MatKhau']) {
        $_SESSION['arrUserLogin'] = $userLogin;
        header('Location: dashboard.php');
    } else {
        $error_message = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}
