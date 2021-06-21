<?php
require_once "../connection.php";
require_once "check.php";
if (isset($_POST['btn'])) {
    extract($_REQUEST);
    if ($pro_name == "" || $price == "" || $price_sale == "" || $detail == "") {
        $thongbao = "Bạn  đang bỏ trống 1 trong các trường trên";
    } else {
        if (($_FILES['pro_image']['size'] > 0)) {
            $pro_image = $_FILES['pro_image']['name'];
        }
        $sql = "UPDATE products SET pro_name = '$pro_name', pro_image = '$pro_image', price = '$price', price_sale = '$price_sale', detail = '$detail'
    where pro_id=$pro_id";
        $stm = $conn->prepare($sql);
        // print_r($stm);
        // die;

        // thực thi

        if ($stm->execute()) {
            $mess = "cập nhật thành công";
            // nếu có ảnh
            if ($_FILES['pro_image']) {
                move_uploaded_file($_FILES['pro_image']['tmp_name'], "../image/" . $pro_image);
            }
            header("location: products.php");
        } else {
            $mess = "cập nhật thất bại";
        }
    }
}
// lấy từ thanh url
$pro_id = $_GET['id'];
// viết câu lệnh sql select có đk
$sql = "select * from products WHERE pro_id=$pro_id";
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

            <div class="col-xl-2 content_left_pro">

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
                        <h3 class="pt-3 pl-4 pb-3">
                            Quản Trị
                        </h3>
                        <form action="" method="post" enctype="multipart/form-data" class=" ml-3">
                            <div class="title_edit_pro">Sửa Sản Phẩm</div>
                            <center style="color: red; margin-top: 10px;"> <?php if (isset($thongbao)) {
                                                                                echo $thongbao;
                                                                            }

                                                                            ?>
                            </center>
                            <input type="hidden" name="pro_id" value="<?= $result['pro_id'] ?>">
                            <div class="form_grid">
                                <div class="ml-2 mt-3">
                                    <label for="" class="title_Cate">Tên danh mục</label><br>
                                    <input type="text" name="pro_name" id="ten_cate" value="<?= $result['pro_name'] ?>">
                                </div>
                                <div class="ml-2 mt-3">
                                    <label for="" class="title_Cate">Hình ảnh</label>&nbsp;&nbsp;&nbsp;&nbsp;&emsp;
                                    <input type="file" id="file" name="pro_image">
                                    <?php if (!empty($result['pro_image'])) : ?>
                                    <input type="hidden" name="pro_image" value="<?= $result['pro_image'] ?>">
                                    <br>
                                    <img src="../image/<?= $result['pro_image'] ?>" width="150px" alt="" class="img">
                                    <?php endif; ?>
                                    <p></p>
                                </div>
                                <div class="ml-2 mt-3">
                                    <label for="" class="title_Cate">Giá</label><br>
                                    <input type="text" name="price" id="ten_cate" value="<?= $result['price'] ?>">
                                </div>
                                <div class="ml-2 mt-3">
                                    <label for="" class="title_Cate">Giá Giảm</label><br>
                                    <input type="text" name="price_sale" id="ten_cate"
                                        value="<?= $result['price_sale'] ?>">
                                </div>

                                <div class="di"></div>
                                <div class="">
                                    &ensp;&ensp; &ensp; <button type="submit" name="btn"
                                        class="btn btn-success mt-5">Cập
                                        Nhật</button>
                                </div>
                                <div class="">
                                    <label for="" class="title_Cate mt-5">Mô tả</label>
                                    <textarea name="detail" id="" cols="37" rows="7"><?= $result['detail'] ?></textarea>
                                </div>
                            </div>

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