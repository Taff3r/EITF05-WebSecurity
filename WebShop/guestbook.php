<html>
<title> Guestbook </title>

<head></head>

<body>

  <p> Write something: </p>
  <form method="post" action="guestbook.php">
    Name:<input type="text" name="name"><br>
    <textarea rows = "10" cols = "50" name="guestComment"></textarea>
    <input type="submit" value = "Post comment">
  </form>
  <a href="index.php">Return home</a>
  <br><br>
  <?php
    if(isset($_POST['guestComment']) && $_POST['guestComment'] != null){
      $gb = fopen('guestComments.txt', 'a');
      fwrite($gb, $_POST['name'] . "  " . date('d-m-y', time()) . ': <br>' . $_POST['guestComment'] . "<hr/>");
      fclose($gb);
    }
    echo nl2br(file_get_contents('guestComments.txt'));
  ?>
</body>












</html>
