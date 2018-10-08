<html>
<title> Guestbook </title>

<head></head>

<body>

  <p> Write something: </p>
  <form method="post" action="guestbook.php">
    Writing as: <?php if(isset($_COOKIE['username'])){ echo $_COOKIE['username']; }else{ echo 'Must be logged in to comment!';} ?><br>
    <textarea rows = "10" cols = "50" name="guestComment"></textarea>
    <input type="submit" value = "Post comment">
  </form>
  <a href="index.php">Return home</a>
  <br><br>
  <?php
  
  echo nl2br(file_get_contents('guestComments.txt'));
  if(isset($_COOKIE['username'])){
    $username = $_COOKIE['username'];
    if(isset($_POST['guestComment']) && $_POST['guestComment'] != null){
      $input = $_POST['guestComment'];
      $input = htmlspecialchars($input); # Sanitizes input, making XSS impossible. Uncomment to make XSS possible.
      $gb = fopen('guestComments.txt', 'a');
      fwrite($gb, $username . "  " . date('d-m-y', time()) . ': <br>' . $input . "<hr/>");
      fclose($gb);
    }
  }
  ?>
</body>












</html>
