
<html>
  <head>
    <title>Log out?</title>
  </head>
  <body>
    <?php

    if(isset($_POST['yes'])){
      if(!validateToken()){
        header("Location: csrf.php");
      }
      session_destroy();
      setcookie('username', $username, time() -1, '/WebShop');
      header("Location:index.php");
    }elseif(isset($_POST['no'])){
      header("Location: index.php");
    }
    session_start();
    setToken();
      ?>
    <form  action="logout.php" method="post">
    <p> Are you sure you wish to log out? </p>
    <input type="submit" name="yes" value="yes">
    <input type="submit" name="no" value="no">
    <input type="hidden" name="csrf" value="<?php  echo $_SESSION['logoutToken']; ?>">
    </form>
  </body>
</html>
 <?php

 function setToken(){
   if(!isset($_SESSION['token']) || time() - $_SESSION['time'] > 5*60){
     $_SESSION['logoutToken'] = generateCSRFToken(); #Generates a CSRF token.
     $_SESSION['time'] = time();
   }
 }

 function generateCSRFToken(){
   return bin2hex(random_bytes(128));
 }




  function validateToken(){
  	if(isset($_SESSION['logoutToken'])){
  		if(!($_POST['csrf'] == $_SESSION['logoutToken']) || time() - $_SESSION['time'] > 5*60){
  			return false;
  		}
  		return true;
  	}else{
  		return false;
  	}
  }
?>
