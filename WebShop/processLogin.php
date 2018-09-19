<?php
	$username = $_POST['name'];
	$password = $_POST['password'];

	$conn = new mysqli("localhost", "root", "","testdb") or die("Connect failed: %s\n". $conn -> error);


	$lookup = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE name = '$username' AND password = '$password'"));

		if($lookup['name'] == $username && $lookup['password'] == $password){
			echo "Login sucessfull";
		}else{
			echo "Wrong Username and/or password";
		}



?>
