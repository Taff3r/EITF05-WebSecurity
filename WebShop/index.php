<html>
	<style>
	<?php include 'css/index.css'; ?>
	</style>

	<title>
		Welcome to eXoticPets.com
	</title>
	<head></head>
	<body>

		<div class = "header">
			<div class = "headerText">
				<h1> eXoticPets.com <p class ="italicsHeader"> - We're totally legal* </p></h1>
			</div>
		</div>

    <div class = "mainWindow">
		  <h1 class = "centerText"> Welcome to eXoticPets.com, your totally 100% legal* importer of exotic animals! </h1>
      <p class = centerText> Please choose one of the items from the menu to the left. </p>
      <p class = "footnote"> *Depends on what you mean by <i>legal</i> </p>
		</div>


		<div class= "sideMenu">
      <ul>
		 <?php
			if(isset($_COOKIE['username'])){
				echo "Inloggad som ",  $_COOKIE['username'];  
			}
		?>
       <li><a href="products.php">Browse products</a></li>
       <li><a href="guestbook.php">Guestbook</a></li>
       <li><a href="login.php">Login</a></li>
       <li><a href="register.php">Register</a></li>
       <li><a href="checkout.php">Checkout</a></li>
	<li><a href="logout.php">Logout</a></li>
     </ul>
		</div>



	</body>

</html>
