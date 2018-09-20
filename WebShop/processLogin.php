<?php
	$username = $_POST['name'];
	$password = $_POST['password'];

	$conn = new mysqli("localhost", "root", "","WebShopDB") or die("Connect failed: %s\n". $conn -> error);


	$lookup = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE name = '$username'"));
		if($lookup[0] == NULL){
			echo "No such user";
		}elseif($lookup['name'] == $username && $lookup['hash'] == hash("sha256", $lookup['salt']+$password)){
			echo "Login sucessfull";
		}else{
			echo "Wrong Username and/or password";
		}



?>
