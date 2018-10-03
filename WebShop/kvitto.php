<html>
<style>
	<?php include 'css/index.css'; ?>
	</style>
	<title>
		Your receipt
	</title>
	<head></head>
	<body>
	<div class = "header">
			<div class = "headerText">
	<form>
		
	<?php if(isLoggedIn()){
	$user = $_COOKIE['username'];
	$conn = new mysqli("localhost", "root", "","WebShopDB");
	#har döpt product_name men vet ej vad den heter i er WebShopDB
	$getQuery = "SELECT product_name FROM itemsincart WHERE username = '$user'";
	
		if($result = mysqli_query($conn, $getQuery)){
			echo "Your receipt: <br>";
			while($row = mysqli_fetch_assoc($result)){
				echo($row["product_name"]);
				echo "<br>";
			}
			 }else{
			  echo "";
			  }
}else{
echo "You are not logged in";
}

function isLoggedIn(){
  return isset($_COOKIE['username']);
}

?>
<a href="index.php">Return home</a>
		</form>
	</body>
</html>
