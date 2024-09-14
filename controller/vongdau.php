<?php
session_start();
include 'connect.php';


$sql = "SELECT * FROM vongdau";
$result = $conn->query($sql);
$arrVongDau = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arrVongDau[] = $row;
    }
}


if ($_GET['keyword']) {
    $keyword = $_GET['keyword'];
    $arrVongDau = array_filter($arrVongDau, function ($item) use ($keyword) {
        return $item['MaVongDau'] == $keyword;
    });
    $arrVongDau = array_values($arrVongDau);
}
