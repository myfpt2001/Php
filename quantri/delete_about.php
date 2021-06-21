<?php
require_once "../connection.php";
require_once "check.php";

$about_id = $_GET['id'];
$sql = "
        DELETE FROM about where about_id=$about_id;
      
";
$stm = $conn->prepare($sql);
// print_r($stm);
// die;
if ($stm->execute()) {
    header("location: about.php");
    die;
} else {
    header("location: about.php?mesage=thatbai");
    die;
}