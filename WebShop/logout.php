 <?php
	setcookie('username', $username, time() -1, '/'); 
	header("Location:index.php");
?>