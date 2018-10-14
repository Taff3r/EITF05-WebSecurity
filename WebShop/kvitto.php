<html>
<style>
	<?php #include 'css/index.css'; ?>
	</style>
	<title>
		Your receipt
	</title>
	<head></head>
	<body>
	<div class = "header">
			<div class = "headerText">
	<form>

	<?php
	$conn = new mysqli("localhost", "root", "","WebShopDB");
 	if(authenticateUser($conn)){
	$user = explode("_",$_COOKIE['username'])[0];

	#har döpt product_name men vet ej vad den heter i er WebShopDB
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
		}
	}
	return false;
}

?>
<a href="index.php">Return home</a>
		</form>
	</body>
</html>
