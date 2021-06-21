<?php

require_once "../connection.php";
// lấy ra sản phẩm để hiển thị trên trang chủ
$sql = "SELECT * FROM categories ";
$stm = $conn->prepare($sql);
$stm->execute();
$cate = $stm->fetchAll(PDO::FETCH_ASSOC);



// San Pham
$sql1 = "SELECT * FROM products order by pro_id limit 8 ";
$stm = $conn->prepare($sql1);
$stm->execute();
$product = $stm->fetchAll(PDO::FETCH_ASSOC);
//sale

$sql = "SELECT * FROM sales ";
$stm = $conn->prepare($sql);
$stm->execute();
$sale = $stm->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/style.css">
   

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>

</head>

<body>
    <div class="container">
        <header>
            <?php
            require_once "../layout/header.php"
            ?>
        </header>
        <div class="content">
            <div class="img-content">
                <img src="image/header/ls-flower-prlx.png" alt="">
                <div class="image-once"><img src="../image/header/ls-flower-prlx.png" alt=""></div>
            </div>
            <div class="title">
                <img src="../image/header/story-flowers.png" alt="">
                <h1>Love story</h1>
                <p>Each flower has a meaning and a story of that flower. Sunflowers represent longing, always aiming for good. Roses represent love. Each bouquet of flowers we always try to put the love in it. Hope our bouquets will send you full love to the recipient. We are always trying our best to improve, it will be one of the top shop selling flowers.</p>
            </div>
        </div>
        <article class='categorie'>
            <?php foreach ($cate as $c) : ?>
                <div class="categories">
                    <div class="img_cate">
                        <a href="products-on-categories.php?id=<?= $c['cate_id'] ?>"> <img src="../image/<?= $c['cate_image'] ?>" /></a>
                    </div>
                    <h4><?= $c['cate_name'] ?></h4>
                </div>
            <?php endforeach; ?>
        </article>
        <div class="counter-up">
            <div class="content">
                <div class="box">
                    <div class="icon"><i class="fas fa-history"></i></div>
                    <div class="counter">724</div>
                    <div class="text">Working Hours</div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fas fa-gift"></i></div>
                    <div class="counter">508</div>
                    <div class="text">Completed Projects</div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fas fa-users"></i></div>
                    <div class="counter">436</div>
                    <div class="text">Happy Clients</div>
                </div>
                <div class="box">
                    <div class="icon"><i class="fas fa-award"></i></div>
                    <div class="counter">120</div>
                    <div class="text">Awards Received</div>
                </div>
            </div>
        </div>
        <!-- //SanPham -->
        <div class="title-products">
            <h1>Best Selling</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="show_products">
            <?php foreach ($product as $p) : ?>
                <div class="product">
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
        <div class="section-01">
            <div class="title-section-01">
                <h1>Gallery</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="slide-container">
                <div class="carousel-slider owl-carousel owl-theme">
                    <img src="../image/gallery-2.jpg" alt="">
                    <img src="../image/gallery-3.jpg" alt="">
                    <img src="../image/gallery-4.jpg" alt="">
                    <img src="../image/gallery-5.jpg" alt="">
                    <img src="../image/gallery-2.jpg" alt="">
                    <img src="../image/gallery-3.jpg" alt="">
                    <img src="../image/gallery-4.jpg" alt="">
                    <img src="../image/gallery-5.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="teams-all">
        <div class="title-section-01">
            <h1>Wishes</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
        </div>
        <div class="teams">
            <div class="carousel-slider-2">
                <img src="../image/my.jpg" alt="">
                <img src="../image/va.jpg" alt="">

            </div>
        </div>
        <div class="title-teams">
            <h3>Teams 7</h3>
            <p>"True love stories never end! Happy wedding day and may there be many
                more chapters in the wonderful story of your love for one another."</p>
        </div>
        <button id="leftBtn" onclick="next1()"></button>
        <button id="rightBtn" onclick="back1()"></button>

    </div>
    <div class="gifts">
        <div class="title-section-01">
            <h1>Gift registry</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="gifts-image">
           <img src="../image/banner1.jpg" width="400px" alt="">
           <img src="../image/banner2.jpg" width="400px" alt="">
           <img src="../image/banner3.jpg" width="400px" alt="">
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
    </div>



    <!-- ///////////////// -->
    <script>
        function next1() {
            if (mgLeft < 150) {
                mgLeft += 150;
            } else {
                mgLeft = 0;
            }

            CarouseSlider2.style.marginLeft = "-" + mgLeft + "px";
        }

        function back1() {
            if (mgLeft > 0) {
                mgLeft -= 150;
            } else {
                mgLeft = 0;
            }

            CarouseSlider2.style.marginLeft = "-" + mgLeft + "px";
        }
    </script>
    <script>
        $('.carousel-slider').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.counter').counterUp({
                delay: 10,
                time: 1200
            });
        });
    </script>

</body>

</html>