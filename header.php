<?php 
   //starting session to load products
   session_start();
   if(!isset($_SESSION["cartItems"])) $_SESSION["cartItems"]=array();

   require_once __DIR__.'/core.php';
   // defining home page url
   $baseURL="http://localhost/acmeco";
   // products (dummy data)
   
   $products      = [
      new Product('Red Widget', 'R01', 32.95),
      new Product('Green Widget', 'G01', 24.95),
      new Product('Blue Widget', 'B01', 7.95)
   ];
   //creating cart object
   $userCart  = new Cart($products);
   
   //clearing cart on checkout
   if(isset($_GET["clear"])) {
      if($_GET["clear"]=="true") {
         session_destroy();
         header('Location: '.$baseURL);
      }
   }
?>