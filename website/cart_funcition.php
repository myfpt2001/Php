<?php
session_start();
$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
function total_amount($cart){
	$total=0;
	if($cart != []){
		// var_dump($_SESSION['cart']);
		foreach($cart as $p ){
			$total +=$p['quantity_mua'];
		}
	}
	return $total;

}
