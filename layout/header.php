<?php

require_once "../connection.php";
include_once "../website/cart_funcition.php";
$sql = "SELECT * FROM setting";
$stm = $conn->prepare($sql);
$stm->execute();
$setting = $stm->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700%7CPT+Serif:400,700,400italic' rel='stylesheet'>
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">



</head>

<body>

	<div class="bgimage">
		<div class="menu">

			<div class="leftmenu">
				<?php foreach($setting as $s): ?>
				<a href="#"><img src="../image/header/<?=$s['logo']?>" alt=""></a>
				<?php endforeach?>
			</div>

			<div class="rightmenu">
				<ul>
					<li id="fisrtlist"><a href="../website/index.php"> HOME </a></li>
					<li><a href="../website/sanpham.php">Products</a> </li>
					<li><a href="../website/blog.php"> Blogs </a> </li>
					<li><a href="../website/about.php"> Aboust us</a></li>
					<li><a href="../website/lienhe.php"> contact us</a></li>
				</ul>
				

				<div class="rightoncemenu">
					<?php
					if (isset($_SESSION['users'])) {
						$user = $_SESSION['users'];
						
						echo "<span style='font-size: 15px; padding-right:5px'><a href='../login/logout.php' style='color: black; ' >Hello , $user </a></span>";
					} else {
						echo '	<a href="../login/dangnhap.php" style=" border-right:2px solid black;"><i class="fas fa-user" style="padding-right: 20px;"></i></a>';
					}

					?>
					<?php
					if (isset($_SESSION['users']['role'])==0 && isset($_SESSION['users']) ) {	
						echo "<span style='font-size: 15px; padding-left:5px ; padding-right:5px'><a href='../quantri/index.php' style='color: black; ' >Admin</a></span>";
					} else {
						
					}

					?>

					<a href="view-cart.php" style="color:red; padding-left:20px ; font-weight: bold; font-size: 18px;"><i style="padding-right: 5px;" class="fas fa-shopping-basket"></i>(<?php echo total_amount($cart) ?>)</a>

				</div>
			</div>
			<div class="bottommenu">
				<img width="100%" src="../image/header/mask.png" alt="">
			</div>

		</div>
		<div class="text">
			<h1> PERFECT PLANT</h1>
			<h3> SALE IN LOOKBOOK</h3>
			<button id="buttonone"> like share </button>
			<button id="buttontwo"> Subscribe </button> 
		</div>


	</div>


</body>

</html>