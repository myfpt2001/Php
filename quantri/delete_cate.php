<?php
require_once "../connection.php";
require_once "check.php";

$cate_id = $_GET['id'];
$sql = "
        DELETE FROM products where cate_id=$cate_id;
        DELETE FROM categories where cate_id=$cate_id;
";
$stm = $conn->prepare($sql);
// print_r($stm);
// die;
if ($stm->execute()) {
    header("location: categories.php");
    die;
} else {
    header("location: categories.php?mesage=thatbai");
    die;
}