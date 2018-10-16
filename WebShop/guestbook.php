<html>
<title> Guestbook </title>

<head></head>

<body>

  <p> Write something: </p>
  <form method="post" action="guestbook.php">
    Writing as: <?php if(isset($_COOKIE['username'])){ echo explode("_",$_COOKIE['username'])[0]; }else{ echo 'Must be logged in to comment!';} ?><br>
    <textarea rows = "10" cols = "50" name="guestComment"></textarea>
    <input type="submit" value = "Post comment">
  </form>
  <a href="index.php">Return home</a>
  <br><br>
  <?php
  $conn = new mysqli("localhost", "root", "", "WebShopDB");
  echo nl2br(file_get_contents('guestComments.txt'));
  if(authenticateUser($conn)){
    $username = explode("_",$_COOKIE['username'])[0];
    if(isset($_POST['guestComment']) && $_POST['guestComment'] != null){
      $input = $_POST['guestComment'];
      $input = htmlspecialchars($input); # Sanitizes input, making XSS impossible. Uncomment to make XSS possible.
      $gb = fopen('guestComments.txt', 'a');
      fwrite($gb, $username . "  " . date('d-m-y', time()) . ': <br>' . $input . "<hr/>");
      fclose($gb);
      header("guestbook.php");
    }
  }

  function authenticateUser($conn){
    if(isset($_COOKIE['username'])){
      list($name, $hash) = explode("_",$_COOKIE['username'], 2);
      $query = "SELECT hash FROM users WHERE name = '$name";
      $lookup = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE name = '$name'"));
      if($hash == $lookup['hash']) {
        return true;
      }else{
        #Prevents online brute force using forged cookies.
        mysqli_query($conn, "UPDATE loginAttempts SET attempts = attempts + 1 WHERE name = '$name'");
        return false;
      }
    }
    return false;
  }
  ?>
</body>












</html>
