
<!-- 
   @author: Ziyad Sharif
   @description: This application is a proof of concept for Acme Widget Co Products 
-->
 
<?php
   require_once __DIR__.'/header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Acme Widget Co</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">
 
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
   <div class="container">
      <div class="row">
         <div class="col logo">
         <a href="<?php echo $baseURL; ?>">Acme Widget Co<br/><br/></a>
         </div>
         <h2>Product Catalogue</h2>
         <div class="col cart">
            <!-- Loading Checkout button with status checks -->
         <?php
               if(count($_SESSION["cartItems"])==0) 
                  echo '<input type="button" value="YOUR CART '.CURRENCY_SYMBOL.'0" class="float-end" onclick="location.href=\''.$baseURL.'cart.php\'" />';
               else 
               {
                  $cartTotal=$userCart->getTotal($products,$_SESSION["cartItems"]);
                  echo '<input type="button" value="YOUR CART '.CURRENCY_SYMBOL.$cartTotal["grossTotal"].'" class="float-end" onclick="location.href=\''.$baseURL.'cart.php\'" />';
               }
            ?>
         </div>
      </div>
      <div class="row">
         <!-- Loading catalogue -->
            <?php
               $catalogue  = new Catalogue($products,$baseURL);
               echo $catalogue->showCatalogue($products);
            ?>
      </div>
   </div>
</body>
</html>
