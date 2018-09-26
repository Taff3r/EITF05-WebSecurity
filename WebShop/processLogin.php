<?php
	$username = $_POST['name'];
	$password = $_POST['password'];

	$conn = new mysqli("localhost", "root", "","WebShopDB") or die("Connect failed: %s\n". $conn -> error);


	$lookup = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE name = '$username'"));

		if($lookup['name'] == $username && password_verify($password,$lookup['hash'])){  // Verifies the password to the hashed one.
			echo "Login sucessfull";
      echo ' <a href="index.php">return home</a> ';
		}else{
			echo "Wrong Username and/or password";
      echo ' <a href="index.php">return home</a> ';
		}



?>
