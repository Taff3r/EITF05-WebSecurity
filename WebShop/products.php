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
  <form action="products.php" method="post">
    Search for product: <input type="text" name="input">
    <input type="submit" value = "Search">
  </form>
  <?php

    $addedProduct = getProduct();
    if($addedProduct != "noSuchProduct"){
      if(isLoggedIn()){
        $user = $_COOKIE['username'];
        $conn = new mysqli("localhost", "root", "","WebShopDB");
        $insertQuery =  "INSERT INTO itemsincart VALUES ('$addedProduct', '$user')";
        mysqli_query($conn,$insertQuery);
        echo "$addedProduct has been added to your cart!<br><br>";
      }else{
        echo "Must be logged in to add items to chart!<br><br>";
      }
    }
    if(isset($_POST['input'])){
      $conn = new mysqli("localhost", "root", "","WebShopDB");
      $input = $_POST['input'];
      $input = $conn->real_escape_string($input); #Förhindrar SQL-injektion. Kommenterar du bort denna så går det att göra injektioner.
      # Försök härma denna för injektion
      #$injection = "SELECT * FROM products WHERE product_name LIKE '%' UNION(SELECT name, hash FROM users); #'%' ";
      $query = "SELECT * FROM products WHERE product_name LIKE '%$input%'";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        constructProduct($row['product_name'], $row['price']);
        echo "<br><br>";
      }

    }

    function constructProduct($productName, $price){
      echo '<img src = images/' . $productName . ".jpg alt = ". $productName . ' width="150" height="200"/>
      <p>  &nbsp&nbsp&nbsp' . $price . ' ETH </p>
      <form  method="post" action="products.php"> <br>
      <input type="submit" name = ' . $productName . ' value = "Add to cart">
      </form>';
    }

    function getProduct(){
      if(isset($_POST['bird'])){
          return "bird";
      }
      if(isset($_POST['giraffe'])){
          return "giraffe";
      }
      if(isset($_POST['lemur'])){
          return "lemur";
      }
      if(isset($_POST['tiger'])){
          return "tiger";
      }
      if(isset($_POST['lion'])){
          return "lion";
      }
      return "noSuchProduct";
    }

    function isLoggedIn(){
      return isset($_COOKIE['username']);
    }



  ?>

</div>

</body>
