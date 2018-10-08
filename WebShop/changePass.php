<html>
	<title>
		Change password
	</title>
	<head></head>
	<body>
    <?php
		
		session_start(); # Beginning of CSRF protection
		if(!isset($_SESSION['token'])){
			$token = $_SESSION['token'] = generateCSRFToken(); #Generates a CSRF token.
		}

		if(isset($_POST['submit'])){
			if($_POST['csrf'] == $_SESSION['token']){ # Makes sure the POSTed token is equal to that in the session.
    		if(isset($_COOKIE['username'])){
      		if(isset($_POST['password'])){
          		if($_POST['password'] == $_POST['repeatPass'] && passwordStrengthCheck($_POST['password'])){
            		$conn = new mysqli("localhost", "root", "","WebShopDB");
            		$name = $_COOKIE['username'];
            		$newPassHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
            		$query = "UPDATE users SET hash = '$newPassHash' WHERE name = '$name'";
            		mysqli_query($conn, $query);
            		echo "Password has been changed ";
            		echo '<br><a href="index.php">return home</a> ';
            		return;
          		}
          			echo "Passwords do not match or password is to weak!";
        			}
      		}else{
        		echo "Must be logged in to change password";
      		}
				}else{
					echo "<h1> CSRF ALERT!</h1>";
				}
		}


    function passwordStrengthCheck($password){
        $uppercast = preg_match('@[A-Z]@', $password);
        $lowercast = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        return !(strpos(file_get_contents("blacklist.txt"),$password) !== false || !$uppercast || !$lowercast || !$number || strlen($password) < 8);
      }

		function generateCSRFToken(){
			return bin2hex(random_bytes(128));
		}
    ?>
		<form action="changePass.php" method="post">
			New Password: <input type="password" name="password"><br>
      Please repeat password: <input type = "password" name = "repeatPass">
			<input type = "hidden" name ='csrf' value = <?php echo $_SESSION['token']; # Sends the CSRF token?> <br>
			<input type="submit" name = 'submit' value = "Change">
		</form>
	</body>
</html>
