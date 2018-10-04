<html>
<style> <?php include 'css/index.css'; ?>
</style>
<head>
<title> Checkout </title>
<link rel="stylessheet" type="text/css" href="css/index.css">
</head>
<body>

<h1> Cart </h1>
<div class ="row">

<a href="index.php">Return home</a>
<br>
<?php
if(isLoggedIn()){
	$user = $_COOKIE['username'];
	$conn = new mysqli("localhost", "root", "","WebShopDB");

	if(isset($_POST['delete'])){
				$delete = "DELETE FROM itemsincart WHERE name = '$user'";
				mysqli_query($conn, $delete);
	      echo "Your cart is now empty";
	  }
	#har döpt product_name men vet ej vad den heter i er WebShopDB
	$getQuery = "SELECT product_name FROM itemsincart WHERE name = '$user'";

		if($result = mysqli_query($conn, $getQuery)){

			while($row = mysqli_fetch_assoc($result)){
				echo( $row["product_name"] . "	" . getPriceOfProduct($conn, $row["product_name"]));
				echo "<br>";
			}
			echo "<br>" . "Total price: " . totalPrice($conn,$user);

			 }else{
			  	echo "0 products in cart";
			  }
}else{
	echo "You are not logged in and therfore have no items in your cart";
}



	function isLoggedIn(){
	  return isset($_COOKIE['username']);
	}

	function getPriceOfProduct($conn, $productName){
		$getPrice = "SELECT price FROM products WHERE product_name = '$productName'";
		return mysqli_fetch_array(mysqli_query($conn, $getPrice))['price'] . ' ETH';
	}

	function totalPrice($conn, $user){
		$query = "SELECT SUM(price) AS total FROM products LEFT JOIN itemsincart USING (product_name) WHERE name = '$user'";
		return mysqli_fetch_array(mysqli_query($conn, $query))['total'] . ' ETH';
	}


?>
<li><a href="kvitto.php">Buy</a></li>

<form  method="post" action="checkout.php">
<input type="submit" name = "delete" value = "Delete cart">
  </form>

</div>
</body>
</html>
