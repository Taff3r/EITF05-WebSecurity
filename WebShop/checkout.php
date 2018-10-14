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


$conn = new mysqli("localhost", "root", "","WebShopDB");
if(authenticateUser($conn)){
	$user = explode("_",$_COOKIE['username'])[0];
	if(isset($_POST['delete'])){
				$delete = "DELETE FROM itemsincart WHERE name = '$user'";
				mysqli_query($conn, $delete);
	      echo "Your cart is now empty";
	  }

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

	function getPriceOfProduct($conn, $productName){
		$getPrice = "SELECT price FROM products WHERE product_name = '$productName'";
		return mysqli_fetch_array(mysqli_query($conn, $getPrice))['price'] . ' ETH';
	}

	function totalPrice($conn, $user){
		$query = "SELECT SUM(price) AS total FROM products LEFT JOIN itemsincart USING (product_name) WHERE name = '$user'";
		return mysqli_fetch_array(mysqli_query($conn, $query))['total'] . ' ETH';
	}

	function authenticateUser($conn){
		if(isset($_COOKIE['username'])){
			list($name, $hash) = explode("_",$_COOKIE['username'], 2);
			$query = "SELECT hash FROM users WHERE name = '$name";
			$lookup = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE name = '$name'"));
			if($hash == $lookup['hash']) {
				return true;
			}
		}
		return false;
	}

?>
<li><a href="kvitto.php">Buy</a></li>

<form  method="post" action="checkout.php">
<input type="submit" name = "delete" value = "Delete cart">
  </form>

</div>
</body>
</html>
