<?php
require_once "../connection.php";
if (isset($_POST['btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    if ($username == "") {
        $kq1 = "*";
    } else if ($password == "") {
        $kq2 = "*";
    } else if ($email == "") {
        $kq3 = "*";
    } else if ($phone == "") {
        $kq4 = "*";
    } else {
        $mahoa_password = password_hash("$password", PASSWORD_DEFAULT);


        $sql = "INSERT INTO users(user_name,password,phone,email,role) values 
            ('$username','$mahoa_password','$phone','$email','$role')";
        $stm = $conn->prepare($sql);

        if ($stm->execute()) {
            header("location: dangnhap.php?message=them thanh cong");
            die;
        }
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
        <div class="from-login">
            <div class="title-login">
                <h3 style="margin-left: 150px;  border-right: 2px solid black; padding-right:20px ;font-family: 'Pacifico', cursive;
            font-family: 'Signika', sans-serif; font-size: 25px;"> <a style="color: black; text-decoration: none;" href="dangnhap.php"> Login</a>
           </h3>
                <h3 style="margin-left: 20px; font-family: 'Pacifico', cursive;
            font-family: 'Signika', sans-serif; font-size: 25px;"><a style="color:red; text-decoration: none; " href="dangki.php">Register </a></h3>
            </div>
            <form action="" method="post">
                <i class="fas fa-user"></i> <input type="text" name="username" id="username" placeholder="Username" class="username <?= isset($kq1) ? 'show_issue' : '' ?>"
                placeholder="Username" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">
                <br>

                <i class="fas fa-key"></i> <input style="margin-top: 30px;" type="password" name="password" id="password" placeholder="password" class="password <?= isset($kq2) ? 'show_issue' : '' ?>"
                placeholder="password" value="<?= isset($password) ? $password : '' ?>">
                <br>
                <i class="fas fa-envelope"></i> <input  style="margin-top: 30px;" type="email" name="email" id="email" <?= isset($kq3) ? 'show_issue' : '' ?>"
                placeholder="Email" value="<?= isset($email) ? $email : '' ?>">
                <br>
                <i class="fas fa-phone"></i> <input  style="margin-top: 30px;" type="text" name="phone" id="number" <?= isset($kq4) ? 'show_issue' : '' ?>" placeholder="Number"
                value="<?= isset($phone) ? $phone : '' ?>">
                <input type="hidden" name="role" value="1">
                <button type="submit" class="btn" name="btn" style="margin-top: 20px;">
                    Register
                </button>

            </form>
            <ul class="social-agileinfo wthree2">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
            </ul>
        </div>
        <div class="reset" >
            <a href="../website/index.php" style="color: black; text-decoration: none; "><i class="fas fa-undo-alt"></i>Back to Home</a>
        </div>
    </div>
</body>

</html>