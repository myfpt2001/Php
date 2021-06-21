<?php
require_once "../connection.php";
$sql = "SELECT * FROM about  ";
$stm = $conn->prepare($sql);
$stm->execute();
$about = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container-about">
        <header>
            <?php
            require_once "../layout/header.php"
            ?>
        </header>
        <h3>Home>About</h3>
        <div class="content-about">
            <div class="image-about">
                <?php foreach ($about as $b) : ?>
                
                <img src="../image/<?= $b['image_about'] ?>?" width="500px" alt="">

              
            </div>
            <div class="title-about">
                <h1><?=$b['title_about']?></h1>
                <p><?=$b['content_about']?></p>
                <button>View Work</button>
                <?php endforeach ?>
            </div>

        </div>
        <div class="icons-about">
            <div class="icon-about-1">
                <div class="src">
                    <img src="https://cdn.shopify.com/s/files/1/0048/1289/8402/files/fun-fact1.png?v=1539677186" alt="">
                </div>
                <div class="title">
                    <h4>2169</h4>
                    <h5>HAPPY CUSTOMERS</h5>
                </div>
            </div>
            <div class="icon-about-2">
                <div class="src">
                    <img src="https://cdn.shopify.com/s/files/1/0048/1289/8402/files/fun-fact2.png?v=1539677196" alt="">
                </div>
                <div class="title">
                    <h4>869</h4>
                    <h5>AWERD WINNER</h5>
                </div>
            </div>
            <div class="icon-about-1">
                <div class="src">
                    <img src="https://cdn.shopify.com/s/files/1/0048/1289/8402/files/fun-fact3.png?v=1539677203" alt="">
                </div>
                <div class="title">
                    <h4>458</h4>
                    <h5>HAPPY CUSTOMERS</h5>
                </div>
            </div>
            <div class="icon-about-2">
                <div class="src">
                    <img src="https://cdn.shopify.com/s/files/1/0048/1289/8402/files/fun-fact4.png?v=1539677211" alt="">
                </div>
                <div class="title">
                    <h4>784</h4>
                    <h5>COMPLETE PROJECTS</h5>
                </div>
            </div>
        </div>
        <div class="content-about-1">
            <div class="title-about-1">
                <h1>WE HAVE SKILLS TO SHOW</h1>
                <div class="span1" style="margin-top: 15px; margin-left: 100px;" >
                    <span class="one" >80%</span>
                    <span class="2" style="font-size: 13px; width: 300px; background: #7b7b7b; height: 20px; margin-top: 16px; padding-left: 20px; color: white; border-radius: 5px;" >WEB DESIGN</span>
                    <span style="background: black;height: 20px;"></span>
                </div>
                <div class="span1" style="margin-top: 15px;  margin-left: 100px;">
                    <span class="one">85%</span>
                    <span class="2"  style="font-size: 13px; width: 330px; background: #7b7b7b; height: 20px; margin-top: 16px; padding-left: 20px; color: white; border-radius: 5px;">PHP JavaScript</span>
                    <span></span>
                </div>
                <div class="span1" style="margin-top: 15px;  margin-left: 100px;">
                    <span class="one">90%</span>
                    <span class="2" style="font-size: 13px; width: 360px; background: #7b7b7b; height: 20px; margin-top: 16px; padding-left: 20px; color: white; border-radius: 5px;">HTML5 & CSS3</span>
                    <span></span>
                </div>
                <div class="span1" style="margin-top: 15px;  margin-left: 100px;">
                    <span class="one">95%</span>
                    <span class="2"  style="font-size: 13px; width: 420px; background: #7b7b7b; height: 20px; margin-top: 16px; padding-left: 20px; color: white; border-radius: 5px;">WRPDPRESS</span>
                    <span></span>
                </div>
            </div>
            <div class="img-about-1">
                <img src="../image/about2.png" width="700px" alt="" style="padding-left: 50px;">
            </div>
        </div>






        <footer>
            <?php

            require_once "../layout/footer.php"
            ?>
        </footer>
    </div>

</body>

</html>