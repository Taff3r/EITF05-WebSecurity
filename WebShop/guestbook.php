<html>
<title> Guestbook </title>

<head></head>

<body>

  <p> Write something: </p>
  <form method="post" action="guestbook.php">
    Writing as: <?php echo $_COOKIE['username']; ?><br>
    <textarea rows = "10" cols = "50" name="guestComment"></textarea>
    <input type="submit" value = "Post comment">
  </form>
  <a href="index.php">Return home</a>
  <br><br>
  <?php
  $username = $_COOKIE['username'];
  echo nl2br(file_get_contents('guestComments.txt'));
  if(isset($_COOKIE['username'])){
    if(isset($_POST['guestComment']) && $_POST['guestComment'] != null){
      $gb = fopen('guestComments.txt', 'a');
      fwrite($gb, $username . "  " . date('d-m-y', time()) . ': <br>' . $_POST['guestComment'] . "<hr/>");
      fclose($gb);
    }
  }else{
    echo 'Must be logged in to comment';
  }
  ?>
</body>












</html>
