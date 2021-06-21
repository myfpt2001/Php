<?php
require_once "../connection.php";
require_once "check.php";

$new_id = $_GET['id'];
$sql = "
        DELETE FROM news where new_id=$new_id;
      
";
$stm = $conn->prepare($sql);
// print_r($stm);
// die;
if ($stm->execute()) {
    header("location: new.php");
    die;
} else {
    header("location: new.php?mesage=thatbai");
    die;
}