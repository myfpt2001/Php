<?php
require_once "../connection.php";
session_start();

if (isset($_GET['pro_id'])) {
    $id = $_GET['pro_id'];
    echo $id;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $id;
}
$action = (isset($_GET['action'])) ? $_GET['action'] : 'add';

$quantity = (isset($_GET['quantity_mua'])) ? $_GET['quantity_mua'] : 1;
if ($quantity <= 0) {
    $quantity = 1;
}
// $quantitycart=(isset($_GET['quantity_cart']))? $_GET['quantity_cart']:0;
// var_dump($_GET);
// die();
// echo $action;
// echo'<br>';
// echo $id;
//  die();
// var_dump($action);
// die();
$sql = "SELECT * FROM products where pro_id = '$id'";
$stm = $conn->prepare($sql);
$stm->execute();
$product = $stm->fetch(PDO::FETCH_ASSOC);
$items = [
    'pro_id' => $product['pro_id'],
    'pro_name' => $product['pro_name'],
    'pro_image' => $product['pro_image'],
    'price' => $product['price'],
    'quantity_mua' => $quantity
];
echo "<script>console.log('Debug Objects: " . $items . "' );</script>";

if ($action == 'add') {
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity_mua'] += $quantity;
    } else {

        $_SESSION['cart'][$id] = $items;
    }
}

if ($action == 'update') {
    $_SESSION['cart'][$id]['quantity_mua'] = $quantity;
}
if ($action == 'delete') {

    unset($_SESSION['cart'][$id]);
}
header('location: view-cart.php');
echo "<pre>";
print_r($_SESSION['cart']);


// them vao gio hang
// cap nhat gio hang
// Xoa san pham