<?php
$username = $_POST['name'];
$password = $_POST['password'];
$repeatPass = $_POST['repeatPass'];


$conn = new mysqli("localhost", "root", "","testdb") or die("Connect failed: %s\n". $conn -> error);
$lookupName = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE name = '$username'"));

  if()
  if($lookup['name'] = $username){
    echo "Username not available";
  }else{
    echo "Wrong Username and/or password";
  }
?>
