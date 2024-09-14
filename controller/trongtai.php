<?php
session_start();
include 'connect.php';


$sql = "SELECT * FROM trongtai";
$result = $conn->query($sql);
$arrTrongTai = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $arrTrongTai[] = $row;
    }
}


if ($_GET['keyword']) {
    $keyword = $_GET['keyword'];
    $arrTrongTai = array_filter($arrTrongTai, function ($item) use ($keyword) {
        return $item['MaTrongTai'] == $keyword;
    });
    $arrTrongTai = array_values($arrTrongTai);
}
