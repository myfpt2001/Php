<?php

require_once "../connection.php";
include_once "../website/cart_funcition.php";
if (isset($_POST['btn'])) {
    // $user_name=$_POST['user_name'];
    // $password = $_POST['password'];
    extract($_REQUEST);
    $sql = "SELECT * FROM users where user_name = '$user_name'";
    $stm = $conn->prepare($sql);
    $stm->execute();
    $user = $stm->fetch(PDO::FETCH_ASSOC);

    if ($user != false) {

        if (password_verify($password, $user['password'])) {
            $_SESSION['users'] = $user_name;
            if ($user['role'] == '1') {
                header('location: ../website/index.php');
                die;
            } else if ($user['role'] == '0') {
                header('location: ../website/index.php');
                die;
            }
        } else {
            $pass_error = "Mật Khẩu chưa đúng!";
        }
    } else if ($user_name == "") {
        $kq1 = "Bạn chưa nhập Username";
    } else if ($password == "") {
        $kq = "Bạn chưa nhập Password";
    } else {
        $user_error = "Tên đăng nhập sai";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Account</title>
    <link rel="stylesheet" href="../css/style-login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Signika:wght@300&display=swap" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="img-login">
            <h1 class="title-register">
                Login Account
            </h1>
            <img src="../image/header/story-flowers.png" alt="">
        </div>
        <div class="from-login" style="padding-top: 60px;">
            <div class="title-login">
                <h3 style="margin-left: 150px;  border-right: 2px solid black; padding-right:20px ;color:red;font-family: 'Pacifico', cursive;
            font-family: 'Signika', sans-serif; font-size: 25px;">Login</h3>
                <h3 style="margin-left: 20px; font-family: 'Pacifico', cursive;
            font-family: 'Signika', sans-serif; font-size: 25px;"><a style="color: black; color:black; text-decoration: none; " href="dangki.php">Register </a></h3>
            </div>
            <form action="" method="post">

                <i class="fas fa-user"></i> <input type="text" name="user_name" id="username" placeholder="Username"><br>
                <?php
                if (isset($kq1)) {
                    echo $kq1;
                }
                ?>
                <?php
                if (isset($user_error)) {
                    echo $user_error;
                }
                ?>


                <br> <i class="fas fa-key"></i> <input style="margin-top: 30px;" type="password" name="password" id="password" placeholder="password">
                <br>
                <?php
                if (isset($kq)) {
                    echo $kq;
                }
                ?>
                <?php
                if (isset($pass_error)) {
                    echo $pass_error;
                }
                ?>
                <br>

                <div class="remember">
                    <span class="checkbox1">
                        <input type="checkbox" name="remember" id=""> Remember me
                    </span>
                    <a href="quenmk.php" class="forgot">
                        Forgot Password ?
                    </a>
                </div>
                <button class="btn" name="btn">
                    Login
                </button>

            </form>
            <ul class="social-agileinfo wthree2">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
            </ul>
        </div>
        <div class="reset">
            <a href="../website/index.php" style="color: black; text-decoration: none; "><i class="fas fa-undo-alt"></i>Back to Home</a>
        </div>
    </div>
    <div>
    </div>
</body>

</html>