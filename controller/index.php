<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
if (!$_SESSION['arrUserLogin']) {
    header('Location: login.php');
}
$sql = "CALL TatCaTranDau()";
$result = $conn->query($sql);
$arrTranDau = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arrTranDau[] = $row;
    }
}
$arrSearch = array();

if ($_GET['keyword']) {
    $keyword = $_GET['keyword'];
    $arrTranDau = array_filter($arrTranDau, function ($item) use ($keyword) {
        return $item['MaTran'] == $keyword;
    });
    $arrTranDau = array_values($arrTranDau);
}
