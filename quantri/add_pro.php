<?php
require_once "../connection.php";
require_once "check.php";
if (isset($_POST['btn'])) {


    extract($_REQUEST);
    if ($pro_name == "" || $cate_id == "" || $price == "" || $price_sale == "" || $detail == "" || $quantity == "" || $date_added == "" || $_FILES['pro_image']['size'] == "") {
        $thongbao = "Bạn  đang bỏ trống 1 trong các trường trên";
    } else {
        if ($_FILES['pro_image']['size'] > 0) {
            $pro_image = $_FILES['pro_image']['name'];
        } else {
            $pro_image = '';
        }

        $sql = "INSERT INTO products(pro_name,cate_id,price,price_sale,detail,pro_image,quantity,date_added)VALUES('$pro_name','$cate_id','$price','$price_sale','$detail','$pro_image','$quantity','$date_added')";
        $stm = $conn->prepare($sql);

        if ($stm->execute()) {
            if (!empty($pro_image)) {
                move_uploaded_file($_FILES['pro_image']['tmp_name'], "../image/" . $pro_image);
            }
            header("location: products.php?message=them thanh cong");
            die;
        }
    }
}
// Lấy toàn bộ danh mục trên database
$sql_cate = "SELECT * FROM categories ";
$stm = $conn->prepare($sql_cate);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="../css/style.css">
    <title>Quản Trị</title>

    <title>Quản Trị</title>
    <style>

    </style>

</head>

<body>

    <div class="container-fluid">

        <div class="row">

            <!-- menu bên phải -->

            <div class="col-xl-2 content_left_add_pro">

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
                    <div class="menu_main_right_pro ml-4">
                        <h2 class="title_edit ml-5">Quản Trị</h2>

                        <form class="form_add_pro" action="" method="post" enctype="multipart/form-data">
                            <div class="title_form">
                                Thêm Sản Phẩm
                            </div>
                            <center style="color: red; margin-top: 10px;">
                                <?php if (isset($thongbao)) {
                                    echo $thongbao;
                                }

                                ?>
                            </center>
                            <div class="form_grid">
                                <div class="text_name">
                                    <h5 for="" class="title_input "> Tên Sản Phẩm: </h5>
                                    <p><input type="text" name="pro_name" id="ten1"></p>
                                </div>

                                <div class="">
                                    <h5 class="title_input"> Danh mục:</h5>
                                    <select name="cate_id" id="ten1">
                                        <?php foreach ($result as $c) :
                                        ?>
                                        <option value="<?= $c['cate_id'] ?>"> <?= $c['cate_name'] ?> </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                                <div class="">


                                    <h5 class="title_input">Giá :</h5>
                                    <input type="number" name="price" id="ten1">

                                </div>

                                <div>
                                    <h5 class="title_input">Giá Giảm :</h5>
                                    <input type="number" name="price_sale" id="ten1">

                                </div>


                                <div>
                                    <p>
                                    <h5 class="title_input">Số lượng</h5>
                                    <input type="number" name="quantity" id="ten1">
                                    </p>
                                </div>
                                <div>
                                    <p>
                                    <h5 class="title_input">Ngày đăng :</h5>

                                    <input type="date" name="date_added" id="ten1">
                                    </p>
                                </div>

                                <div>
                                    <p>
                                    <h5 class="title_input"> Lượt view</h5>
                                    <input type="number" name="view" id="ten1">
                                    </p>

                                </div>
                                <div>
                                    <p>
                                    <h5 class="title_input"> Hình ảnh:

                                    </h5>
                                    <input type="file" name="pro_image" class="mt-3 ml-3">
                                    </p>
                                </div>
                                <div class="mt-5 pt-5">
                                    <button type="submit" name="btn" class="btn btn-info ml-2">Thêm Sản Phẩm</button>
                                </div>
                                <div>
                                    <p>
                                    <h5 class="title_input mb-3">Chi tiết:</h5>
                                    <p>
                                        <textarea name="detail" id="boder" cols="40" rows="7" class="ml-3"></textarea>
                                    </p>
                                    </p>
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