<?php
	$username = $_POST['name'];
	$password = $_POST['password'];
	$conn = new mysqli("localhost", "root", "","WebShopDB"); # or die("Connect failed: %s\n". $conn -> error);

	$lookup = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE name = '$username'"));
		if($lookup['name'] == $username && password_verify($password,$lookup['hash'])){
			setcookie('username', $username, time() + 3600, '/'); # Sets cookie for the user, making him effectivly logged in for one hour.
			echo "Login sucessfull!<br> You're now logged in for an hour, or until you log out.";
      echo ' <a href="index.php">return home</a> ';
		}else{
			echo "Wrong Username and/or password";
      echo ' <a href="index.php">return home</a> ';
		}



?>
