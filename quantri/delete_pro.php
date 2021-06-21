<?php
require_once "../connection.php";
require_once "check.php";
$pro_id = $_GET['id'];
$sql = "
        DELETE FROM products where pro_id=$pro_id;
";
$stm = $conn->prepare($sql);
if ($stm->execute()) {
    header("location: products.php");
    die;
} else {
    header("location:  products.php?mesage=thatbai");
    die;
}