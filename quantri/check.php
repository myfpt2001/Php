<?php
session_start();
if (!isset($_SESSION['users'])) {
    header("location: ../login/dangnhap.php");
    die;
}