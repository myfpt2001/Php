<?php
require_once "../connection.php";
require_once "check.php";

$sale_id = $_GET['id'];
$sql = "DELETE FROM sale where sale_id='$sale_id';
      
";
$stm = $conn->prepare($sql);
// print_r($stm);
// die;
if ($stm->execute()) {
    header("location: khuyenmai.php");
    die;
} else {
    header("location: khuyenmai.php?mesage=thatbai");
    die;
}