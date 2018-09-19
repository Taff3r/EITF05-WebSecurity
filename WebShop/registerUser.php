<?php
$username = $_POST['name'];
$password = $_POST['password'];
$repeatPass = $_POST['repeatPass'];


$conn = new mysqli("localhost", "root", "","testdb") or die("Connect failed: %s\n". $conn -> error);
$lookupName = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE name = '$username'"));


  if($lookupName['name'] == $username){
    echo "Username not available";
  }elseif ($password != $repeatPass) {
    echo "Passwords are not equal";
  }else{
    $insertUser = "INSERT INTO users VALUES ('$username', '$password')";
    mysqli_query($conn, $insertUser);
    echo "Congratulations, $username, you're now ready to shop!";
  }
?>
