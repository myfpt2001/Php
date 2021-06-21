<?php
require_once "../connection.php";
// lấy ra sản phẩm để hiển thị trên trang chủ
$sql = "SELECT * FROM categories ";
$stm = $conn->prepare($sql);
$stm->execute();
$cate = $stm->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM products where price_sale >10 ";
$stm = $conn->prepare($sql);
$stm->execute();
$pro = $stm->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM products  ";
$stm = $conn->prepare($sql);
$stm->execute();
$pro1 = $stm->fetchAll(PDO::FETCH_ASSOC);


$sql = "SELECT * FROM slider ";
$stm = $conn->prepare($sql);
$stm->execute();
$slider = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- //link bootrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>

    </style>
</head>

<body>

    <div class="products-all">
        <header>
            <?php
            require_once "../layout/header.php";
            ?>
        </header>
        <div class="cate-products">
            <div class="cate-one">
                <div class="cate-two">
                    <h3>Categories</h3>
                    <?php
                    foreach ($cate as $c) : ?>
                    <div class="categories-one">
                        <a href="products-on-categories.php?id=<?= $c['cate_id'] ?>">
                            <p><?= $c['cate_name'] ?></p>
                        </a>
                    </div>
                    <?php
                    endforeach; ?>
                </div>
                <div class="topten">
                    <h3>Top 5 products</h3>
                    <?php
                    foreach ($pro as $p) : ?>
                    <div class="pro_one">
                        <a href="detail.php?id=<?= $p['pro_id'] ?>">
                            <img class="" src="../image/<?= $p['pro_image'] ?>">
                        </a>
                        <p><?= $p['pro_name'] ?></p>

                    </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="products-one">
                <div class="container">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../image/banner.jpg" class="d-block  w-100" alt="..." class="img-fluid">
                            </div>
                            <?php
                            foreach ($slider as $c) : ?>
                            <div class="carousel-item ">
                                <img src="../image/<?= $c['slider_image'] ?>" class="d-block w-100" alt="...">
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="a">
                    <div class="ab">
                        <h3>Home >Products</h3>
                    </div>
                    <div class="search">
                        <form action="../website/search.php">
                            <input type="search" name="keyword" placeholder="Search here...">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="products-two">
                    <?php foreach ($pro1 as $p) : ?>
                    <div class="pro-two">
                        <a href="detail.php?id=<?= $p['pro_id'] ?>">
                            <center><img class="" width="200px" src="../image/<?= $p['pro_image'] ?>"></center>
                        </a>
                        <h3><?= $p['pro_name'] ?></h3>
                        <div class="price">$<?= $p['price'] ?> </div>
                        <div class="price_sale"><?= $p['price_sale'] ?>%</div>
                        <ul class="img-icons">
                            <li><a href="cart.php?id=<?= $p['pro_id'] ?>"><i class="fa fa-shopping-bag"></i></a></li>
                            <li><a href="detail.php?id=<?= $p['pro_id'] ?>"><i class="fas fa-eye"></i></a></li>
                        </ul>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="sale-all">
            <div class="sale-all-image">
                <img src="../image/b23.jpg" alt="">
            </div>
            <div class="sale-all-title">
                <h1>The secret to choosing luxury wedding flowers</h1>
                <p>The weather in summer is the time when brides have a little less choice of flower patterns. The
                    weather is quite hot, so the flowers are often not durable. Want beautiful and durable wedding
                    bouquets, you should choose flowers such as carnation, or white rose, or sunflower Dalat, ... You
                    can coordinate with local flowers to create masterpieces. The bouquets of flowers are bold in
                    nature.</p>
            </div>
        </div>
        <div class="icon-alls">
            <div class="freeship">
                <center><img src="../image/icon1.jpg" width="200px" alt=""></center>
                <h4>
                    Nationwide shipment</h4>
                <p>
                    Nationwide shipment. Fast ship 2-3 days</p>
            </div>
            <div class="customer">
                <center><img src="../image/icon2.jpg" width="200px" alt=""></center>
                <h4>

                    Customer support</h4>
                <p>
                    24/7 customer support. Right and always all the time</p>
            </div>
            <div class="gift">
                <center><img src="../image/icon3.1.jpg" width="200px" alt=""></center>
                <h4>

                    Free flower package</h4>
                <p>
                    Free flower package. Give love and happiness to every family</p>
            </div>
        </div>
        <footer>
            <?php
            require_once "../layout/footer.php"
            ?>
        </footer>




        <!-- link-boostrap-js -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
</body>

</html>