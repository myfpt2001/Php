<?php
require_once "../connection.php";
require_once "check.php";
if (isset($_POST['btn'])) {
    extract($_REQUEST);
    if ($user_name == "" || $user_image == "" || $phone == "") {
        $thongbao = "Bạn chưa điền trường tên hoặc trường ảnh hoặc mô tả";
    } else {
        if (($_FILES['user_image']['size'] > 0)) {
            $user_image = $_FILES['user_image']['name'];
        }
        $sql = "UPDATE users SET user_name = '$user_name', user_image = '$user_image', phone='$phone'
    where user_id=$user_id";
        $stm = $conn->prepare($sql);
        // print_r($stm);
        // die;

        // thực thi

        if ($stm->execute()) {
            $mess = "cập nhật thành công";
            // nếu có ảnh
            if ($_FILES['cate_image']) {
                move_uploaded_file($_FILES['cate_image']['tmp_name'], "../image/" . $cate_image);
            }
            header("location: user.php");
        } else {
            $mess = "cập nhật thất bại";
        }
    }
}
// lấy từ thanh url
$user_id = $_GET['id'];
// viết câu lệnh sql select có đk
$sql = "select * from users WHERE user_id=$user_id";
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

    <!-- link css của ban than -->
    <link rel="stylesheet" href="../css/style.css">
    <title>Quản Trị</title>

</head>

<body>

    <div class="container-fluid">

        <div class="row">

            <!-- menu bên phải -->
            <div class="col-xl-2 content_left_cate">

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
                    <div class="menu_main_right ml-3 ">
                        <div class="test mb-3"></div>
                        <h2 class="title_edit_cate mb-0 ">Sửa User</h2>
                        <form action="" method="post" enctype="multipart/form-data " class="form_edit_Cate">
                            <center style="color: red; margin-top: 10px;"> <?php if (isset($thongbao)) {
                                                                                echo $thongbao;
                                                                            }

                                                                            ?>
                            </center>
                            <input type="hidden" name="user_id" value="<?= $result['user_id'] ?>">
                            <label for="" class="name">Tên User</label>
                            <input type="text" name="user_name" id="ten" value="<?= $result['user_name'] ?>">
                            <p></p>
                            <label for="" class="name">Hình ảnh</label>&nbsp;&nbsp;&nbsp;&nbsp;&emsp;
                            <input type="file" id="file" name="user_image">
                            <?php if (!empty($result['user_image'])) : ?>
                            <input type="hidden" name="user_image" value="<?= $result['user_image'] ?>">
                            <br>
                            <img src="../image/<?= $result['user_image'] ?>" width="200px" alt="" class="img">
                            <?php endif; ?>
                            <p></p>
                            <label for="" class="name">Số Điện Thoại</label>
                            <input type="text" name="phone" id="ten" value="<?= $result['phone'] ?>">
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