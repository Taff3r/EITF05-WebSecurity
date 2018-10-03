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

<div class ="row">

<?php
  $addedProduct = getProduct();
  if($addedProduct != NULL){
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

# Tur att inte Christian ser detta, verkligen inte Open-Closed.
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
  return NULL;
}

function isLoggedIn(){
  return isset($_COOKIE['username']);
}
?>
<img src='images/bird.jpg' alt ="Bird" width="150" height="200"/>
<p> Macaw parrot from South America </p>
<form  method="post" action="products.php">

    <input type="submit" name = "bird" value = "Add to cart">
  </form>
  <?php $test = "images/giraffe.jpg"; ?>
<img src="<?php echo $test ?>" alt ="Giraffe"  width="150" height="200"/>
<p> Giraff </p>
<form  method="post" action="products.php">

    <input type="submit" name = "giraffe" value = "Add to cart">
  </form>

<img src="images/tigers.jpg" alt ="Tiger" width="150" height="200"/>
<p> Beautiful tiger from Nepal </p>
<form  method="post" action="products.php">

    <input type="submit" name = "tiger" value = "Add to cart">
  </form>

<img src="images/lemur.jpg" alt ="Lemur"  width="150" height="200"/>
<p> Lemur from Ystaddjurpark </p>
<form  method="post" action="products.php">

    <input type="submit" name = "lemur" value = "Add to cart">
  </form>

<img src="images/lions.jpg" alt ="lion" width="150" height="200"/>
<p> White lion </p>
<form  method="post" action="products.php">

    <input type="submit" name ="lion" value = "Add to cart">
  </form>

</div>
</body>
</html>
