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
	$getQuery = "SELECT product_name FROM itemsincart WHERE username = '$user'";
	
		if($result = mysqli_query($conn, $getQuery)){
			
			while($row = mysqli_fetch_assoc($result)){
				#printf("(%s \n )", $row["product_name"]);
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
?>

<form  method="post" action="checkout.php">

    <input type="submit" name = "" value = "Buy">
  </form>

</div>
</body>
</html>