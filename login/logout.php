<?php
session_start();
unset($_SESSION['users']); // xóa session login
header("location:../website/index.php");
die;
?>
