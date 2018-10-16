<html>
	<title>
		Your receipt
	</title>
	<head></head>
	<body>
	<div class = "header">
			<div class = "headerText">
	<form>

	<?php
	session_start();
	$conn = new mysqli("localhost", "root", "","WebShopDB");

 	if(authenticateUser($conn)){
		if(!validateToken()){
			header("Location: csrf.php");
			exit();
		}

	$user = explode("_",$_COOKIE['username'])[0];


	$getQuery = "SELECT * FROM itemsincart JOIN products USING (product_name) WHERE name = '$user'";
	$addressQuery = "SELECT name, address FROM users WHERE name = '$user'";
	$totalPriceQuery = "SELECT SUM(price) as total FROM itemsincart JOIN products USING (product_name) WHERE name = '$user'";
		if($result = mysqli_query($conn, $getQuery)){

			echo "Your receipt: <br>";
			while($row = mysqli_fetch_assoc($result)){
				echo($row["product_name"]  . "	" . $row["price"] . "	ETH");
				echo "<br>";
			}
			echo "Total price: " . mysqli_fetch_assoc(mysqli_query($conn, $totalPriceQuery))['total'] . " ETH";

			if($result = mysqli_query($conn, $addressQuery)){
				echo("<br>");
				echo "An invoice has been sent to: <br>";

				$row = mysqli_fetch_assoc($result);
				echo("User: " . $row["name"]);
				echo("<br>");
				echo("Address: " . $row["address"]);
				echo("<br>");
				$delete = "DELETE FROM itemsincart WHERE name = '$user'";
				mysqli_query($conn, $delete);
			}
			 }else{
			  echo "";
			  }

			}else{
				echo "You are not logged in";
			}

function authenticateUser($conn){
	if(isset($_COOKIE['username'])){
		$creds = explode("_",$_COOKIE['username']);
		$name = $creds[0];
		$query = "SELECT hash FROM users WHERE name = '$name";
		$lookup = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE name = '$name'"));
		if($creds[1] == $lookup['hash']) {
			return true;
		}else{
			#Prevents online brute force using forged cookies.
			mysqli_query($conn, "UPDATE loginAttempts SET attempts = attempts + 1 WHERE name = '$name' ");
			return false;
		}
	}
	return false;
}

function validateToken(){
	if(isset($_SESSION['checkoutToken'])){
		if(!($_POST['csrf'] == $_SESSION['checkoutToken']) || time() - $_SESSION['time'] > 5*60){
			return false;
		}
		return true;
	}else{
		return false;
	}
}


?>
<a href="index.php">Return home</a>
		</form>
	</body>
</html>
