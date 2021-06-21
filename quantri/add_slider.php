<?php
require_once "../connection.php";
require_once "check.php";
if (isset($_POST['btn'])) {
    extract($_REQUEST);


    $url = $_POST['url'];

    if ($url == ""  || $_FILES['slider_image']['size'] == "") {
        $thongbao = "Bạn chưa điền trường tên hoặc trường ảnh hoặc mô tả";
    } else {
        if ($_FILES['slider_image']['size'] > 0) {
            $slider_image = $_FILES['slider_image']['name'];
        } else {
            $slider_image = '';
        }

        $sql = "INSERT INTO slider(slider_image,URL)VALUES('$slider_image','$url')";
        $stm = $conn->prepare($sql);

        if ($stm->execute()) {
            if (!empty($slider_image)) {
                move_uploaded_file($_FILES['slider_image']['tmp_name'], "../image/" . $slider_image);
            }
            header("location: slider.php?message=them thanh cong");
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
    <style>

    </style>

</head>

<body>

    <div class="container-fluid">

        <div class="row">

            <!-- menu bên phải -->


            <div class="col-xl-2 content_left">

                <div class="menu_intro">
                    <ul class="detail_menu_intro">
                        <li>
                            <a href="admin.php" class="color_white">
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
            <div class="col-xl-10 content_right pl-0 pr-0">
                <div>
                    <ul class="menu_header_right pl-0 ">
                        <li class="ml-5"><a href=""><i class="fas fa-list-ul"></i> &ensp;Trang Chủ</a></li>
                        <li><a href="">Sản Phẩm</a></li>
                        <li><a href="">Liên Hệ</a></li>
                        <li></li>
                        <li>
                            <a class="pt-4">Xin chào Admin &ensp;<i class="fas fa-user-shield"></i></a>
                        </li>
                    </ul>
                    <div class="menu_main_right ml-3">
                        <h2 class="title_edit">Quản Trị</h2>

                        <form action="" method="post" enctype="multipart/form-data" class="form_add_slider">
                            <div class="div">
                                <div class="title_form">
                                    Thêm Slider
                                </div>
                                <center style="color: red; margin-top: 10px;"> <?php if (isset($thongbao)) {
                                                                                    echo $thongbao;
                                                                                }

                                                                                ?>
                                </center>


                                <p class="name"> <label for="" class="img_cate"> Ảnh Sản Phẩm:</label> <input
                                        type="file" name="slider_image" id="file"></p>

                                <p class="name"> <label for="" class="name_cate"> Đường Dẫn:</label> <br> <input
                                        type="text" name="url" id="ten" placeholder="Đường Dẫn"></p>





                            </div>



                            <!-- <button type="submit" name="btn" class="add">Thêm</button> -->
                            &emsp; <button type="submit" name="btn" class="btn btn-info ml-4">Thêm</button>
                        </form>
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