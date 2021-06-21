<?php
require_once "../connection.php";
if (isset($_POST['btn'])) {
    extract($_REQUEST);
    $err=[];
    $sql = "SELECT * FROM users where user_name = '$username'";
    $stm = $conn->prepare($sql);
    $stm->execute();
    $user = $stm->fetchAll(PDO::FETCH_ASSOC);
    
    if ($user['email'] != $email) {
        $err[]='Sai email';
        
    } else {
        echo "Password : ".$user['password'];
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
                <h3 style="margin-left: 150px; padding-right:20px ;color:red;font-family: 'Pacifico', cursive;
            font-family: 'Signika', sans-serif; font-size: 25px;">Reset password</h3>
             
            </div>
            <form action="" method="post">

                <i class="fas fa-user"></i> <input type="text" name="username" id="username" placeholder="Username"><br>

                <i class="fas fa-key"></i> <input style="margin-top: 30px;" type="email" name="email" id="password" placeholder="password">

                <div class="remember">
                    <span class="checkbox1">
                        <input type="checkbox" name="remember" id=""> Remember me
                    </span>
                    <a href="" class="forgot">
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
        <div class="reset" >
            <a href="../website/index.php" style="color: black; text-decoration: none; "><i class="fas fa-undo-alt"></i>Back to Home</a>
        </div>
    </div>
</body>

</html>