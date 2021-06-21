<?php
require_once "../connection.php";
require_once "check.php";
if (isset($_POST['btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    // if ($role == '0') {
    //     $role = 'false';
    // } else {
    //     $role = true;
    // }
    if ($username == "") {
        $kq1 = "*";
    } else if ($password == "") {
        $kq2 = "*";
    } else if ($email == "") {
        $kq3 = "*";
    } else if ($phone == "") {
        $kq4 = "*";
    } elseif ($_FILES['user_image']['size'] == "") {
        $kq5 = "*";
    } else {
        $mahoa_password = password_hash("$password", PASSWORD_DEFAULT);
        if ($_FILES['user_image']['size'] > 0) {
            $user_image = $_FILES['user_image']['name'];
        } else {
            $user_image = '';
        }

        $sql = "INSERT INTO users(user_name,user_image,password,phone,email,role) values 
            ('$username','$user_image','$mahoa_password','$phone','$email', $role=1)";
        // echo $sql;
        // die;
        $stm = $conn->prepare($sql);

        if ($stm->execute()) {
            if (!empty($user_image)) {
                move_uploaded_file($_FILES['user_image']['tmp_name'], "../image/" . $user_image);
            }
            header("location: user.php?message=them thanh cong");
            die;
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300&display=swap" rel="stylesheet">
    <!-- link css của ban than -->
    <link rel="stylesheet" href="../css/style.css">
    <title>Quản Trị</title>

</head>

<body>

    <div class="container-fluid">

        <div class="row">

            <!-- menu bên phải -->

            <div class="col-xl-2 content_left">

                <div class="menu_intro">
                    <ul class="detail_menu_intro">
                        <li>
                            <a href="index.php" class="color_white">
                                <img src="../image/header/logo.png" width="40px" alt="">
                                <span class="color_white">AdminLTE</span></a>

                        </li>
                        <li>
                            <img src="../image/person2.jpg" width="40px" class="p" alt="">
                            <span style="font-size: 17px">Vanh And Mỹ</span>
                        </li>
                    </ul>
                </div>

                <div class="menu-doc">
                    <ul class="menu_stand">
                        <li class="menu_one"> &ensp;&ensp;&ensp;&ensp;Menu</li>
                    </ul>

                    <ul class="detail_menu_stand">

                        <li><a href="../website/index.php"> &ensp;&ensp;<i class="fas fa-home"></i>&ensp;&ensp;Trang
                                Chủ</a>
                        </li>
                        <li><a href="categories.php"> &ensp;&ensp;<i class="far fa-credit-card"></i></i>&ensp;&ensp;Danh
                                Mục</a>
                        </li>
                        <li><a href="products.php"> &ensp;&ensp;<i class="fas fa-cart-plus"></i>&ensp;&ensp;Sản Phẩm</a>
                        </li>
                        <li><a href="slider.php"> &ensp;&ensp;<i class="far fa-credit-card"></i>&ensp;&ensp;Slider</a>
                        </li>
                        <li><a href="user.php"> &ensp;&ensp;<i class="fas fa-users"></i>&ensp;&ensp;User</a></li>
                        <li><a href="comment.php"> &ensp;&ensp;<i class="fas fa-comment"></i>&ensp;&ensp;Comment</a>
                        </li>
                        <li><a href="setting.php">&ensp;&ensp;<i class="fas fa-hammer">&ensp;&ensp;</i>Setting</a></li>
                        <li><a href="khuyenmai.php">&ensp;&ensp;<i class="fas fa-plus">&ensp;&ensp;</i>Khuyến Mại</a>
                        </li>

                        <li><a href="new.php"> &ensp;&ensp;<i class="fas fa-newspaper"></i>&ensp;&ensp;New</a></li>
                        <li><a href="about.php"> &ensp;&ensp;<i class="fas fa-address-book"></i>&ensp;&ensp;About</a>
                        <li><a href="../login/logout.php"> &ensp;&ensp;<i
                                    class="fas fa-sign-out-alt"></i>&ensp;&ensp;Đăng
                                Xuất</a></li>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-10 content_right pl-4 pr-0">
                <div>
                    <ul class="menu_header_right pl-0 ">
                        <li class="ml-5"><a href="../website/index.php"><i class="fas fa-list-ul"></i> &ensp;Trang
                                Chủ</a></li>
                        <li><a href="../website/sanpham.php">Sản Phẩm</a></li>
                        <li><a href="../website/lienhe.php">Liên Hệ</a></li>
                        <li><a href="../website/blog.php">Blog</a></li>
                        <li><a href="../website/about.php">Giới Thiệu</a></li>

                        <li>
                            <a class="pt-4">Xin chào Admin &ensp;<i class="fas fa-user-shield"></i></a>
                        </li>
                    </ul>
                    <div class="menu_main_right">

                        <h2 class="title_edit ml-5 mt-2 pt-4 pb-4">Quản Trị</h2>

                        <form action="" method="post" enctype="multipart/form-data" class="form_cate">
                            <div class="div">
                                <div class="title_form">
                                    Thêm User
                                </div>
                                <input type="text" name="username"
                                    class="username <?= isset($kq1) ? 'show_issue' : '' ?>" placeholder="Username"
                                    value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">


                                <input type="password" name="password"
                                    class="password <?= isset($kq2) ? 'show_issue' : '' ?>" placeholder="password"
                                    value="<?= isset($password) ? $password : '' ?>">



                            </div> <input type="email" name="email" class="email <?= isset($kq3) ? 'show_issue' : '' ?>"
                                placeholder="Email" value="<?= isset($email) ? $email : '' ?>">

                            <input type="text" name="phone" class="number <?= isset($kq4) ? 'show_issue' : '' ?>"
                                placeholder="Number" value="<?= isset($phone) ? $phone : '' ?>">

                            <input type="file" name="user_image"
                                class="user_image <?= isset($kq5) ? 'show_issue' : '' ?>">
                            <input type="hidden" name="role" value="0">
                            <button type="submit" name="btn" class="btn btn-info">Thêm Nhân Viên</button>

                        </form>

                    </div>







                </div>
            </div>

        </div>
    </div>
    </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>