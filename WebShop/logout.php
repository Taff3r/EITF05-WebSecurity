 <?php
  session_destroy();
	setcookie('username', $username, time() -1, '/WebShop');
	header("Location:index.php");
?>
