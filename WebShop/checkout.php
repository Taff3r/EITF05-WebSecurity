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
	#har döpt product_name men vet ej vad den heter i er WebShopDB
	$getQuery = "SELECT product_name FROM itemsincart WHERE name = '$user'";

		if($result = mysqli_query($conn, $getQuery)){

			while($row = mysqli_fetch_assoc($result)){
				echo( $row["product_name"]);
				echo "<br>";
			}
			 }else{
			  echo "0 products in cart";
			  }
}else{
echo "You are not logged in and therfore have no items in your cart";
}

function isLoggedIn(){
  return isset($_COOKIE['username']);
}


if(isset($_POST['delete'])){
      $command ="DELETE FROM itemsincart WHERE username = '$user'";
      mysqli_query($conn,$command);
      echo "Your cart is now empty";
  }
 
  
?>
<li><a href="kvitto.php">Buy</a></li>

<form  method="post" action="checkout.php">
<input type="submit" name = "delete" value = "Delete cart">
  </form>

</div>
</body>
</html>
