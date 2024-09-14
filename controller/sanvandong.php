<?php
session_start();
include 'connect.php';


$sql = "SELECT * FROM sanvandong";
$result = $conn->query($sql);
$arrSanVanDong = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arrSanVanDong[] = $row;
    }
}


if ($_GET['keyword']) {
    $keyword = $_GET['keyword'];
    $arrSanVanDong = array_filter($arrSanVanDong, function ($item) use ($keyword) {
        return $item['MaSan'] == $keyword;
    });
    $arrSanVanDong = array_values($arrSanVanDong);
}
