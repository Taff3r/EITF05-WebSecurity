<html>
<style> <?php include 'css/index.css'; ?>
</style>
<head>
<title> Browse Products </title>
<link rel="stylessheet" type="text/css" href="css/index.css">
</head>
<body>

<h1> Products </h1>
<a href="index.php">Return home</a>
<div class = "row">
  <form action="testProducts.php" method="post">
    Search for product: <input type="text" name="input">
    <input type="submit" value = "Search">
  </form>
  <?php
    if(isset($_POST['input'])){
      $input = $_POST['input'];
      $test = "SELECT * FROM products WHERE product_name LIKE '%%' UNION(SELECT name, hash FROM users);#";
      $query = "SELECT * FROM products WHERE product_name LIKE '%$input%'";
      $conn = new mysqli("localhost", "root", "","WebShopDB");
      $result = mysqli_query($conn, $test);
      while ($row = mysqli_fetch_assoc($result)) {
         echo $row['product_name'] . " " . $row['price'] . "<br><br>";
      }

    }
  ?>

</div>

</body>
