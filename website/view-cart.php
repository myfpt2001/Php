<?php
require_once "../connection.php";
require_once "../website/cart_funcition.php";
$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
$total_price = 0;
// lấy ngày hiện tại 
$date = date_format(date_create(), 'Y-m-d');
// lấy mã giảm giá đang hợp lệ 
$sql_sale = "SELECT * FROM sale WHERE DATEDIFF(CURDATE(), start_date) >=0 AND DATEDIFF(end_date, CURDATE()) >=0";
$stm = $conn->prepare($sql_sale);
$stm->execute();
$sales = $stm->fetchAll(PDO::FETCH_ASSOC);
// var_dump($sales);
// echo $sql_sale;
$giaGiam = 0;
// lấy số phần trăm được giảm của mã đã chọn
if (isset($_POST['apDung'])) {
    $sql_numbersale = "SELECT * FROM sale WHERE sale_id = '$_POST[sale_id]'";
    $stm = $conn->prepare($sql_numbersale);
    $stm->execute();
    $maGiam = $stm->fetch(PDO::FETCH_ASSOC);
    $giaGiam = $maGiam['sale_number'] / 100;
    $_SESSION['giaGiam'] = $maGiam['sale_number'] / 100;
}
if (isset($_POST['btn_Submit'])) {
    if ($cart != '') {
        // lấy thông tin khách hàng đã đăng nhâp vào hệ thống 
        $userName = $_SESSION['users'];
        $sql = "SELECT * FROM users where user_name = '$userName'";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $user = $stm->fetch(PDO::FETCH_ASSOC);

        // lấy user_id từ thông tin user 
        $user_id = $user['user_id'];
        // viết câu lệnh isert hóa đơn 
        $sql_HoaDon = "INSERT INTO INVOICE(date_created, status, user_id) VALUES ('$date', 1, '$user_id')";
        $stm = $conn->prepare($sql_HoaDon);
        $stm->execute();

        // lay thong tin hoa don moi nhat
        $sql_HD = "SELECT * FROM invoice ORDER BY invoice_id DESC LIMIT 1";
        $stm2 = $conn->prepare($sql_HD);
        $stm2->execute();
        $hoaDon =  $stm2->fetch(PDO::FETCH_ASSOC);
        // var_dump($hoaDon);
        // echo $sql_HD;
        $id_hoaDon = $hoaDon['invoice_id'];

        // thêm thông tin vào bảng hóa đơn chi tiết
        $i = 1;
        foreach ($cart as $p) :
            $pro_id = $p['pro_id'];
            $quantity = $p['quantity_mua'];
            $sql_HoaDonCT[$i] = "INSERT INTO invoice_details(pro_id, invoice_id, quanity) VALUES ('$pro_id','$id_hoaDon', '$quantity')";
            $stm = $conn->prepare($sql_HoaDonCT[$i]);
            $stm->execute();
            $i++;
        endforeach;
        $thanhToan = " Thanh Toán Thành Công";

        // gửi mail xác nhận 
        $username = $_SESSION['users'];
        $email = $user['email'];
        $subject = "New Order: #" . $id_hoaDon;
        $body = "
            <div style=' border: solid  #bebebe 1px; width: 550px; margin: auto;' >
            <div style=' background-color: rgb(20, 152, 204); color:white; text-align: center; font-size: 30px; font-weight: bold; height: 150px;
            line-height: 150px;margin: auto; width: 550px;'>
                        ".$subject."
            </div>

            <table style=' width: 500px; margin: 20px auto; border: 1px solid black;
            border-collapse: collapse;' >
                        <thead >
                            <tr >
                                <th style='border: 1px solid black; border-collapse: collapse;'>Name product</th>
                                <th style='border: 1px solid black; border-collapse: collapse;'>Quantity</th>
                                <th style='border: 1px solid black; border-collapse: collapse;'>Price</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        
        ";
        $tongTien = 0;
        foreach ($cart as $p) :
            $tongTien += $p['price'] * $p['quantity_mua'];
            $body .= "<tr >                 
                        <td style = ' text-align: center;border: 1px solid black; border-collapse: collapse; padding: 5px 5px;'>" . $p['pro_name'] . "</td>
                        <td style = ' text-align: center;border: 1px solid black; border-collapse: collapse; padding: 5px 5px;'>" . $p['quantity_mua'] . "</td>
                        <td style = ' text-align: center;border: 1px solid black; border-collapse: collapse; padding: 5px 5px;'>$" . $p['price'] * $p['quantity_mua'] . "</td>
                        
                    </tr>";
        endforeach;
        $Total = $tongTien + 70.5 - $tongTien * $_SESSION['giaGiam'];
        $body .= "
                    <tr >                 
                        <td style = ' text-align: center;border: 1px solid black; border-collapse: collapse; padding: 5px 5px;'><b>Subtotal: </b></td>
                        <td colspan='2' style = ' text-align: center;border: 1px solid black; border-collapse: collapse; padding: 5px 5px;'>$" . $tongTien . "</td>                      
                    </tr>
                    <tr >                 
                        <td style = ' text-align: center;border: 1px solid black; border-collapse: collapse; padding: 5px 5px;'><b>Ship: </b></td>
                        <td colspan='2' style = ' text-align: center;border: 1px solid black; border-collapse: collapse; padding: 5px 5px;'> $70.5</td>                      
                    </tr>
                    <tr >                 
                        <td style = ' text-align: center;border: 1px solid black; border-collapse: collapse; padding: 5px 5px;'><b>Sale: </b></td>
                        <td colspan='2' style = ' text-align: center;border: 1px solid black; border-collapse: collapse; padding: 5px 5px;'>$".$tongTien * $_SESSION['giaGiam']."</td>                      
                    </tr>
                    <tr>                 
                        <td style = ' text-align: center;border: 1px solid black; border-collapse: collapse; padding: 5px 5px;'><b>Total: </b></td>
                        <td colspan='2' style = ' text-align: center;border: 1px solid black; border-collapse: collapse; padding: 5px 5px;'>$" . $Total . "</td>                      
                    </tr>

        </tbody>
        </table>
        <p style= 'text-align: center;'>Congratulations on the sale.</p>
        </div>
        ";
        $file_name = '';

        // $cart = '';
        $_SESSION['cart'] = [];
        $cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];

        require_once('send.php');
        // echo $body;

    }
}


// echo "<pre>";
// print_r($cart)
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/style.css">
</head>
<style>

</style>

<body>
    <div class="view-cart">
        <header>
            <?php require_once "../layout/header.php" ?>
        </header>
        <div class="table-cart">
            <form action="" method="post">
                <h3>Home > Cart</h3>
                <center><?php if (isset($thanhToan)) {
                            echo $thanhToan;
                        } ?></center>
                <table>
                    <thead>
                        <tr>
                            <th>Image product</th>
                            <th>Name product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        if ($cart != '') {
                            foreach ($cart as $p) :
                                $total_price += $p['price'] * $p['quantity_mua'] ?>
                                <tr>
                                    <td><img src="../image/<?= $p['pro_image'] ?>" width="150px" alt=""></td>
                                    <td><?= $p['pro_name'] ?></td>
                                    ' '
                                        <td>
                                            <input type="hidden" name="action" value="update">
                                            <input type="hidden" name="pro_id" value="<?= $p['pro_id'] ?>">
                                            <div class="quantity-cart">
                                                <input type="number" name="quantity_mua" value="<?= $p['quantity_mua'] ?>">
                                                <button type="submit">Update</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="price-cart">$<?= $p['price'] * $p['quantity_mua'] ?></div>
                                        </td>
                                        <td>
                                            <div class="delete"><a onclick="confirm('Are you sure you want to remove the product?') " ; href="cart.php?id=<?= $p['pro_id'] ?>& action=delete "><i class="far fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                    </form>
                                </tr>
                        <?php endforeach;
                        }
                        ?>
                    </tbody>
                </table>
                <div class="total">
                    <div class="cart-one">
                        <p> Total price</p>
                    </div>
                    <div class="cart-two">
                        <p>$<?php echo $total_price ?></p>
                    </div>
                </div>
                <div class="sale_km">
                    <?php foreach ($sales as $s) : ?>
                        <div class="sale_km-one">
                            <center>
                                <p style=" color: red; padding: 2px 0px; font-size: 20px; font-family: 'Oswald', sans-serif;"><?= $s['sale_number'] ?>% OFF</p>
                                <p style="font-weight: bold; font-family: 'Oswald', sans-serif;"><?= $s['sale_id'] ?></p>
                                <p style="font-size: 12px; color: black;">HSD : <?= $s['end_date'] ?></p>
                            </center>
                        </div>

                    <?php endforeach; ?>
                </div>
                <div class="sale_input">
                    <input type="text" name="sale_id">
                    <button type="submit" name="apDung">Apply</button>
                </div>
                <div class="sum">
                    <h3>Cart Totals</h3>
                    <span>Total sub <p style="padding-left: 375px;">$<?php echo $total_price  ?></p> </span>
                    <span>Number sale <p style="padding-left: 345px;">$<?php echo $total_price * $giaGiam  ?></p> </span>
                    <span>Shipping <p style="padding-left: 375px;">$70.5</p> </span>
                    <span>Total <p style="padding-left: 405px; color: #058c52;    font-weight: bold;">$<?php echo $total_price + 70.5 - $total_price * $giaGiam  ?> </span>
                </div>
                <div class="btn-sum">
                    <button type="submit" name="btn_Submit">Proceed To Checkout</button>
                </div>
            </form>
        </div>
        <footer> <?php include_once "../layout/footer.php" ?></footer>
    </div>
</body>

</html>