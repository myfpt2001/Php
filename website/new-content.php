<?php
require_once "../connection.php";
$new_id = $_GET['id'];
$sql = "SELECT * FROM news where new_id=$new_id";
$stm = $conn->prepare($sql);
$stm->execute();
$n = $stm->fetch(PDO::FETCH_ASSOC);

require_once "../connection.php";
$sql = "SELECT * FROM news ";
$stm = $conn->prepare($sql);
$stm->execute();
$new = $stm->fetchAll(PDO::FETCH_ASSOC);


$sql = "SELECT * FROM categories ";
$stm = $conn->prepare($sql);
$stm->execute();
$cate = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../css/style.css">

<head>

</head>

<body>
    <div class="new-container">
        <?php
        require_once "../layout/header.php"
        ?>
        <div class="content">
            <div class="img-content">
                <img src="../image/header/ls-flower-prlx.png" alt="">
                <div class="image-once"><img src="../image/header/ls-flower-prlx.png" alt=""></div>
            </div>
            <div class="title">
                <img src="../image/header/story-flowers.png" alt="">
                <h1>Love story</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod temporincididunt ut labore et dolore magna aliqua
                    . Ut enim ad minim veniam, quis nostrudexercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur
                    . Excepteur sint occaecat cupidatat non proident,sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
        <div class="new-all">
            <div class="new-left">
                    <div class="new_ones">
                    <h3 style="text-align: center; margin-bottom: 15px; font-size: 30px;font-family: 'Rubik', sans-serif"><?= $n['new_name'] ?></h3>
                        <div class="new-images">
                                <center><img class="" src="../image/<?= $n['new_image'] ?>"></center>
                        </div>
                        <div class="new-title-1">
                            <p style="padding-left: 20px; padding-right: 50px; padding-top: 10px;"><?= $n['new_content'] ?></p>
                        </div>
                    </div>

            </div>
            <div class="new-right">
                <h3>Categories</h3>
                <div class='categorie-ones'>
                    <?php foreach ($cate as $c) : ?>
                        <a href="">
                            <h4><?= $c['cate_name'] ?></h4>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="user-all">
                    <h3>List of authors</h3>
                    <div class="user-image">
                      <img src="../image/user1.jpg" width="300px" alt="">
                      <h3>Jonh Meri</h3>
                      <p>New data recording system to better analyse road accidents</p>
                    </div>
                    <div class="user-image">
                      <img src="../image/user2.jpg" width="300px" alt="">
                      <h3>Jonh Meri</h3>
                      <p>New data recording system to better analyse road accidents</p>
                    </div>
                    <div class="user-image">
                      <img src="../image/user3.jpg" width="300px" alt="">
                      <h3>Jonh Meri</h3>
                      <p>New data recording system to better analyse road accidents</p>
                    </div>
                    <div class="user-image">
                      <img src="../image/user4.jpg" width="300px" alt="">
                      <h3>Jonh Meri</h3>
                      <p>New data recording system to better analyse road accidents</p>
                    </div>
                </div>
            </div>
            

        </div>

        <div class="topnew">
            <?php
            foreach ($new as $n) : ?>
                <div class="new_one">
                    <div class="new-image">
                        <a href="new-content.php?id=<?= $n['new_id'] ?>">
                            <center><img class="" width="200px" src="../image/<?= $n['new_image'] ?>"></center>
                        </a>
                    </div>
                    <h3><?= $n['new_name'] ?></h3>
                    <p><?= $n['new_introduce'] ?></p>

                </div>
            <?php endforeach ?>
        </div>

        <footer>
            <?php
            require_once "../layout/footer.php"
            ?>
        </footer>
    </div>
</body>

</html>

</body>
</html>