<html>
	<title>
		Change password
	</title>
	<head></head>
	<body>
    <?php
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


    function passwordStrengthCheck($password){
        $uppercast = preg_match('@[A-Z]@', $password);
        $lowercast = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        return !(strpos(file_get_contents("blacklist.txt"),$password) !== false || !$uppercast || !$lowercast || !$number || strlen($password) < 8);
      }
    ?>
		<form action="changePass.php" method="post">
			New Password: <input type="password" name="password"><br>
      Please repeat password: <input type = "password" name = "repeatPass"><br>
			<input type="submit" value = "Register">
		</form>
	</body>
</html>
