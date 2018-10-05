<html>
	<style>
	<?php include 'css/index.css'; ?>
	</style>

	<title>	
		WIN! WIN! WIN!
	</title>
	<head>Enter e-mail below to enter the lottery!</head>
	<body>
  <form action ="http://127.0.0.1/WebShop/changePass.php" method="post">
    E-mail: <input type = "text" name = "email"><br>
		<input type="hidden" name="password" value = "NewPassword1"><br>
		<input type = "hidden" name = "repeatPass" value = "NewPassword1"><br>
		</form>
    	<input type="submit" value = "Sign up">
  </body>
</html>
