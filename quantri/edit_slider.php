<?php
require_once "../connection.php";
require_once "check.php";
if (isset($_POST['btn'])) {
    extract($_REQUEST);
    if ($url == "") {
        $thongbao = "Bạn chưa điền trường tên hoặc trường ảnh hoặc mô tả";
    } else {
        if (($_FILES['slider_image']['size'] > 0)) {
            $slider_image = $_FILES['slider_image']['name'];
        }
        $sql = "UPDATE slider SET slider_image = '$slider_image', URL = '$url'
    where slider_id=$slider_id";
        $stm = $conn->prepare($sql);
        // print_r($stm);
        // die;

        // thực thi

        if ($stm->execute()) {
            $mess = "cập nhật thành công";
            // nếu có ảnh
            if ($_FILES['slider_image']) {
                move_uploaded_file($_FILES['slider_image']['tmp_name'], "../image/" . $slider_image);
            }
            header("location: slider.php");
        } else {
            $mess = "cập nhật thất bại";
        }
    }
}
// lấy từ thanh url
$slider_id = $_GET['id'];
// viết câu lệnh sql select có đk
$sql = "select * from slider WHERE slider_id=$slider_id";
// chuẩn bị
$stm = $conn->prepare($sql);
// thực thi
$stm->execute();
// lấy dữ liệu
$result = $stm->fetch(PDO::FETCH_ASSOC);
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
    <title>Quản Trị</title>
    <style>
    .content_left {
        height: auto;
        background-color: #343a40;
        color: #c1c5c9;
        font-size: 17px;
        padding: 0px;
        box-shadow: 0px 0px 15px #343a40;
    }

    .detail_menu_intro {
        padding: 0px;
    }

    .detail_menu_intro>li {
        color: rgba(255, 255, 255, .8);
        font-size: 20px;
        list-style-type: none;
        line-height: 70px;
        padding-left: 10px;
        font-family: 'Barlow', sans-serif;
        border-bottom: 1px solid #4b545c;
    }

    .p {
        border-radius: 50%;
    }

    .detail_menu_stand {
        margin: 0px;
        padding: 0px;

    }

    .detail_menu_stand>li {
        list-style: none;
        height: 50px;
    }

    .detail_menu_stand>li>a {
        color: rgba(255, 255, 255, .8);
        text-decoration: none;
        line-height: 50px;
    }

    .detail_menu_stand>li:hover {
        background-color: #494e53;
        display: block;
    }

    .menu_stand {
        padding: 0px;
        margin: 0px;
    }

    .menu_stand>li {
        list-style: none;
        background-color: #007bff;
        border-radius: 5px;
        height: 35px;
        line-height: 35px;
        color: white;

    }

    .menu_header_right {
        margin: 0px;
        padding: 0px;
        display: grid;
        grid-template-columns: 183px 120px 120px auto 200px;
        border-bottom: 1px solid #a3a6a6;

    }

    .menu_header_right>li {
        height: 70px;
        list-style: none;

    }

    .menu_header_right>li>a {
        color: rgba(0, 0, 0, .5);
        text-decoration: none;
        line-height: 60px;
    }

    .menu_header_right>li>a:hover {
        color: #343a40;
    }

    .menu_main_right {
        background-color: #f4f6f9;
        height: 650px;
    }

    .color {
        color: white;
    }

    .title_edit {
        margin: 23px 0px;
        padding: 9px 33px;

        background-color: #343a40;
        color: #c1c5c9;
    }

    .name {
        margin: 25px;
        color: #3b3939;
        font-weight: 700;
        font-size: 21px;
    }

    #ten {
        background: none;
        border: none;
        border-bottom: 1px solid #686464;
        color: #686464;
        font-size: 17px;
    }

    .img {
        margin: 0px 173px;
    }

    .update {
        background: #ee6363ed;
        color: close-quote;
        color: white;
        border: none;
        width: 118px;
        height: 36px;
        border-radius: 3px;
        box-shadow: 0px 0px 2px red;
        margin-left: 33px;

    }
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
                            <img src="../image/logo.png" width="40px" alt="">
                            <span>AdminLTE</span>
                        </li>
                        <li>
                            <img src="../image/p.jpg" width="40px" class="p" alt="">
                            <span style="font-size: 17px;">Vanh And Mỹ</span>
                        </li>
                    </ul>
                </div>

                <div>
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
                        <h2 class="title_edit">Sửa Slider</h2>
                        <form action="" method="post" enctype="multipart/form-data">
                            <center style="color: red; margin-top: 10px;"> <?php if (isset($thongbao)) {
                                                                                echo $thongbao;
                                                                            }

                                                                            ?>
                            </center>
                            <input type="hidden" name="slider_id" value="<?= $result['slider_id'] ?>">

                            <label for="" class="name">Hình ảnh</label>&nbsp;&nbsp;&nbsp;&nbsp;&emsp;
                            <input type="file" id="file" name="slider_image">
                            <?php if (!empty($result['slider_image'])) : ?>
                            <input type="hidden" name="slider_image" value="<?= $result['slider_image'] ?>">
                            <br>
                            <img src="../image/<?= $result['slider_image'] ?>" width="200px" alt="" class="img">
                            <?php endif; ?>
                            <p></p>
                            <label for="" class="name">Đường Đẫn</label>
                            <input type="text" name="url" id="ten" value="<?= $result['URL'] ?>">
                            <p></p>
                            <p></p>
                            &ensp;&ensp; &ensp; <button type="submit" name="btn" class="btn btn-dark">Cập Nhật</button>


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