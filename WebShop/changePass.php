<html>
	<title>
		Change password
	</title>
	<head></head>
	<body>
    <?php
		session_start();
		if(!isset($_SESSION['token'])){
			$token = $_SESSION['token'] = generateCSRFToken(); #Generates a CSRF token.
			$_SESSION['time'] = time();
		}

		if(isset($_POST['submit'])){
			if($_POST['csrf'] == $_SESSION['token']){ # Makes sure the POSTed token is equal to that in the session.

				if(time() - $_SESSION['time'] > 5*60){ # Tokens only last 5 minutes
					echo "Token expired, please try again ";
					echo '<br><a href="changePass.php">return home</a> ';
					$token = $_SESSION['token'] = generateCSRFToken(); #Regen CSRF token.
					$_SESSION['time'] = time();
					exit();
				}
				$conn = new mysqli("localhost", "root", "","WebShopDB");
    		if(authenticateUser($conn)){
      		if(isset($_POST['password'])){
          		if($_POST['password'] == $_POST['repeatPass'] && passwordStrengthCheck($_POST['password'])){
								$name = explode("_",$_COOKIE['username'])[0];
            		$newPassHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
            		$query = "UPDATE users SET hash = '$newPassHash' WHERE name = '$name'";
            		mysqli_query($conn, $query);
								setcookie("username", $name, time()-1, "WebShop");
								$cValue = $name . "_" . $newPassHash;
								setcookie('username', $cValue, time() + 3600, '/WebShop');
            		echo "Password has been changed ";
            		echo '<br><a href="index.php">return home</a> ';
								session_destroy();
								return;
          		}
          			echo "Passwords do not match or password is to weak!";
        			}
      		}else{
        		echo "Must be logged in to change password";
      		}
				}else{
					header("Location: csrf.php");
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

		function authenticateUser($conn){
			if(isset($_COOKIE['username'])){
				list($name, $hash) = explode("_",$_COOKIE['username'], 2);
				$name = $conn->real_escape_string($name);
				$query = "SELECT hash FROM users WHERE name = '$name";
				$lookup = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE name = '$name'"));
				if($hash == $lookup['hash']) {
					return true;
				}else{
					#Prevents online brute force using forged cookies.
					mysqli_query($conn, "UPDATE loginAttempts SET attempts = attempts + 1 WHERE name = '$name' ");
					return false;
				}
			}
			return false;
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
