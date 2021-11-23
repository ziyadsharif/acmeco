<?php
   require_once __DIR__.'/header.php';
    if(isset($_GET["productcode"])) {
      $_SESSION["cartItems"]=$userCart->addItem($_GET["productcode"]);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Acme Widget Co | Checkout</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">
  
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
   <div class="container">
      <div class="row">
         <div class="col logo">
            <a href="<?php echo $baseURL; ?>">Acme Widget Co << Back to Catalogue</a>
         </div>
         <div class="col cart">
            <!-- Loading Checkout button with status checks -->
            <?php
               if(count($_SESSION["cartItems"])==0) 
                  echo '<input type="button"  value="YOUR CART '.CURRENCY_SYMBOL.'0" class="float-end" onclick="location.href=\''.$baseURL.'cart.php\'" />';
               else 
               {
                  $cartTotal=$userCart->getTotal($products,$_SESSION["cartItems"]);
                  echo '<input type="button" value="YOUR CART '.CURRENCY_SYMBOL.$cartTotal["grossTotal"].'" class="float-end" onclick="location.href=\''.$baseURL.'cart.php\'" />';
               }
            ?>
            
         </div>
      </div>
      <div class="row">
         <div class="col">
            <h2>Your Cart</h2>
         </div>
      </div>
      <div class="row">
         <div class="col">
            <!-- Loading Cart Items -->
            <?php
               if(count($_SESSION["cartItems"])==0) echo "0 Items in cart";
               else echo $userCart->showCart($products,$_SESSION["cartItems"]); 
            echo '<input class="btn btn-success float-end" type="button"  value="Checkout" onclick="location.href=\''.$baseURL.'cart.php?clear=true\'" />';
            ?>

         </div>
      </div>
   </div>
</body>
</html>
