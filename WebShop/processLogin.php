<?php
		$conn = new mysqli("localhost", "root", "","WebShopDB"); # or die("Connect failed: %s\n". $conn -> error);
		$username = $conn->real_escape_string($_POST['name']);
		$password = $_POST['password'];

		$lookup = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE name = '$username'"));
    $attempts = mysqli_fetch_array(mysqli_query($conn,"SELECT attempts FROM loginattempts WHERE name = '$username'"));

    if($attempts['attempts'] >= 5){
      echo "Too many attempts to login for this user was made, please contact the admin at admin@forget.it";
      echo ' <a href="index.php">return home</a> ';
    }elseif($lookup['name'] == $username && password_verify($password,$lookup['hash'])){
			$cValue = $username . "_" . $lookup['hash'];
			setcookie('username', $cValue, time() + 3600, '/WebShop'); # Sets cookie for the user, making him effectivly logged in for one hour.
			mysqli_query($conn, "UPDATE loginAttempts SET attempts = 0");
			echo "Login sucessfull!<br> You're now logged in for an hour, or until you log out. ";
      echo ' <a href="index.php">return home</a> ';
		}else{
      mysqli_query($conn, "UPDATE loginAttempts SET attempts = attempts + 1 WHERE name = '$username'");
			echo "Wrong Username and/or password";
      echo ' <a href="index.php">return home</a> ';
		}



?>
