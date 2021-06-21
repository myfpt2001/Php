<?php
require_once "../connection.php";
require_once "check.php";
$slider_id = $_GET['id'];
$sql = "
        DELETE FROM slider where slider_id=$slider_id
";
$stm = $conn->prepare($sql);
// print_r($stm);
// die;
if ($stm->execute()) {
    header("location: slider.php");
    die;
} else {
    header("location: slider.php?mesage=thatbai");
    die;
}