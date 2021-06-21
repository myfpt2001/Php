<?php
require_once "../connection.php";
include_once "cart_funcition.php";


$pro_id = $_GET['id'];
$sql = "SELECT * FROM products where pro_id=$pro_id";
$stm = $conn->prepare($sql);
$stm->execute();
$product = $stm->fetch(PDO::FETCH_ASSOC);



$sql = "SELECT * FROM products where price_sale >10 ";
$stm = $conn->prepare($sql);
$stm->execute();
$p = $stm->fetchAll(PDO::FETCH_ASSOC);


// show cmt
$show_cmt = "SELECT content,user_name,date_cmt FROM comment join users on users.user_id = comment.user_id
where pro_id=$pro_id";
$stm = $conn->prepare($show_cmt);
$stm->execute();
$comment = $stm->fetchAll(PDO::FETCH_ASSOC);




// //  kiểm sesion 
if (isset($_SESSION['users'])) {
    // echo $_SESSION['users'];
    $user =   $_SESSION['users'];
    $sql_cmt = "SELECT * FROM users where user_name='$user'";
    $stm = $conn->prepare($sql_cmt);
    $stm->execute();
    $cmt_cus = $stm->fetch(PDO::FETCH_ASSOC);

    if (isset($cmt_cus['user_id'])) {
        // Lấy thông tin bình luận
        if (isset($_POST['btn'])) {
            $content = $_POST['content'];
            // lấy ngày tháng năm
            $date=date_format(date_create(), 'Y-m-d');

            // $pepole_cmt = $cmt_cus['username'];

            $user_id = $cmt_cus['user_id'];
            // echo $content;
            // Thêm vào CSDL
            $sql_echo = "INSERT INTO comment(content,user_id,pro_id,date_cmt) 
            VALUES('$content','$user_id','$pro_id','$date')";
            $stm = $conn->prepare($sql_echo);
            $stm->execute();

            //  cập nhật lại commet
            $show_cmt = "SELECT content,user_name,date_cmt FROM comment join users on users.user_id = comment.user_id
            where pro_id=$pro_id";
            $stm = $conn->prepare($show_cmt);
            $stm->execute();
            $comment = $stm->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        echo "test";
    }
} else {
    echo "
    alert('You are not logged in?');";
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/style.css">

   

</head>

<body>
    <?php
    include_once "../layout/header.php";
    ?>
    <div class="container-detail">
        <div class="detail">
            <div class="detail-1">
                <img src="../image/<?= $product['pro_image'] ?>" width="300px" alt="">
            </div>
            <div class="detail-2">
                <form action="cart.php" method="GET">
                    <h2><?= $product['pro_name'] ?></h2>
                    <div style="width: 400px; display: grid; grid-template-columns: auto auto auto;">
                    <div class="price-new"><i class="fas fa-dollar-sign"></i><?= (1 - $product['price_sale'] / 100) * $product['price'] ?></div>
                    <div class="price-old"><i class="fas fa-dollar-sign"></i><?= $product['price'] ?></div>
                    <div class="detail-sale">- <?= $product['price_sale'] ?>% OFF</div>
                </div>
                    <div class="describe"><?= $product['describe'] ?></div>
                    <div>
                    <p><i class="text-success fa fa-check-square-o" aria-hidden="true"></i> <strong>Bank Offer</strong> 20% Instant Discount on SBI Credit Cards</p>
                <p><i class="text-success fa fa-check-square-o" aria-hidden="true"></i> <strong>Bank Offer</strong> 5% Unlimited Cashback on Flipkart Axis Bank Credit Card </p>
                <p><i class="text-success fa fa-check-square-o" aria-hidden="true"></i> <strong>Bank Offer</strong> Extra 5% off* with Axis Bank Buzz Credit Card</p>
                <p><i class="text-success fa fa-check-square-o" aria-hidden="true"></i> <strong>Bank Offer</strong>20% Instant Discount on pay with <i class="fa fa-google-wallet" aria-hidden="true"></i> google wallet </p>
                    </div>
                    <div class="quantity">
                        Quantity of inventory: <?= $product['quantity'] ?>
                    </div>
                    <div class="quantity-1">
                        Quantity : <input type="number" value="1" name="quantity_mua">
                        <input width="100px" type="hidden" name="pro_id" value="<?= $product['pro_id'] ?>">
                    </div>
                    <div class="btn"><button type="submit">Add to cart</button></div>
                </form>
            </div>
        </div>
        <div class="conent-detail">
            <h2>Product information</h2>
            <div class="detail-3"><?= $product['detail'] ?></div>
        </div>
        <div class="comment">
            <h2>Comment</h2>
            <form action="" method="post" enctype="multipart/form-data">
                        <input type="text" name="content">
                        <?php
                        if (isset($_SESSION['users'])) {
                            echo '<button type="submit"  name="btn">
                            BÌnh luận
                        </button>';
                        } else {
                        ?>
                        <button type="submit" class="btn btn-success mt-4 mb-5 " name="btn">
                            <a href="../login/dangnhap.php"
                                onclick="return confirm('Bạn phải đăng nhập để thực hiện chức năng này')" class='color'>
                                Bình Luận</a>
                        </button>
                        <?php } ?>
                    </form>
            <br>
            <h2> Other comments</h2>
            <?php foreach ($comment as $t) : ?>
                <p style="margin-left: 50px; margin-top:10px;">
                    <label for=""><b> <?= $t['user_name'] ?> :  </b></label> 
                    <label for=""> <?= $t['content'] ?> </label> 
                    <label for=""> '<?= $t['date_cmt'] ?>'
                </p>
            <?php endforeach; ?>

        </div>
        <div class="products-c">
            <h2>Best Selling</h2>
            <div class="product-c">
                <?php foreach ($p as $p) : ?>
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
    <?php
    include_once "../layout/footer.php";
    ?>



</body>

</html>