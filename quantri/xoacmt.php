<?php
require_once "../connection.php";
require_once "check.php";
$id_comment = $_GET['id'];
$sql = "DELETE FROM comment where comment_id=$id_comment";
$stm = $conn->prepare($sql);
// print_r($stm);
// die;
if ($stm->execute()) {
    header("location: comment.php");
    die;
} else {
    header("location: comment.php?mesage=thatbai");
    die;
}