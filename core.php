<?php

 require_once __DIR__.'/configurations.php';

 /* Products class having product information */
  
class Product {
   // Attributes

   private $name;
   private $code;
   private $price;
   // Constructor for products data
   function __construct(String $name, String $code, Float $price) {
      $this->name       = $name;
      $this->code       = $code;
      $this->price      = $price;
   }
   // Attribute getters

   public function getName() {
      return $this->name;
   }

   public function getCode() {
      return $this->code;
   }

   public function getPrice() {
      return $this->price;
   }
}

class Catalogue{
   // Attributes

   private $Products;
   private $baseURL;
   // Constructor for Catalogue
   function __construct(Array $Products,String $baseURL) {
      $this->Products = $Products;
      $this->baseURL = $baseURL;
   }
   // Method to load Catalogue porducts
   public function showCatalogue($Products)
   {
      $catalogueStr="";
      foreach($Products as $product)
      {
         $catalogueStr.= '<div class="col">'.$product->getName()."</br>".$product->getCode()."</br>".$product->getPrice().'</br><input type="button" value="Add"  onclick="location.href=\''.$this->baseURL.'cart.php?productcode='.$product->getCode().'\'" />'.'</div>';
      }
      return $catalogueStr;
   }
   //Method to calculate delivery charges
   public function getDeliveryCharges($TotalAmount){
      $delCharges=0;
      foreach(DELIVERY_RULES as $rule) {
         if($TotalAmount < $rule["Limit"]){
            $delCharges=$rule["cost"];
            break;
         }
      }
      return $delCharges;
   }
   //Method to calculate Offers
   public function calculateOffer($code,$qty,$price) {
      $totalCost= $qty * $price;
      $offerDiscount=0;
      foreach(OFFERS as $offer){
         if($offer["itemCode"]==$code && $qty>=$offer["qtyApplicable"]){
            
            $discountCount    = floor($qty / $offer['qtyApplicable']); 
               // Checking if offer amount is a fixed amount or percentage
               if($offer['isPercentage'] ) {
                  $offerDiscount = $price * ($offer['offerDiscount'] * ($discountCount) / 100);
                  $totalCost     = $totalCost - ( $offerDiscount );
               } else {

                  $offerDiscount = $product['product']->getPrice() - $offer['offerDiscount'];
                  $totalCost     = $totalCost - ( $offerDiscount );
               }
         }
      }
      
      return array("totalCost"=>$totalCost,"totalDiscount"=>$offerDiscount);
   }
   
   //Method to Check oif article is on offer
   public function checkOfferOnArticle($code) {
      $isOffer=false;
      foreach(OFFERS as $offer){
         if($offer["itemCode"]==$code){
            $isOffer=true;
         }
      }
      return $isOffer;
   }
}
// Shopping cart class
class Cart extends Catalogue {
   
   private $Products;

   function __construct(Array $Products) {
      $this->Products = $Products;
   }
   
   //  Add item to basket
   public function addItem($code) {
      $cartItems=$_SESSION["cartItems"];
      
      
      //checking if item already exists in cart
      if(array_key_exists($code, $cartItems)) $cartItems[$code]["qty"]=$cartItems[$code]["qty"] + 1;
      else{
         $new_array[$code]=array("qty"=>1);
         $cartItems= array_merge($cartItems, $new_array);
      }
      return $cartItems;
   }
   //showing carts on catalogue
   public function showCart($products,$cartItems) {
      $str='<div class="row"><div class="col">Item</div><div class="col">Quantity</div><div class="col">Price/widget</div></div>';

      foreach($products as $product) {
         if(isset($cartItems[$product->getCode()])) {
            $str.='<div class="row">';
            $str.='<div class="col">'.$product->getName().'</div>';
            
            $str.='<div class="col">'.$cartItems[$product->getCode()]["qty"].'</div>';
            $str.='<div class="col">'.CURRENCY_SYMBOL.$product->getPrice().'</div>';
            $str.='</div>';
         }
      }

      $deliveryCharges=parent::getDeliveryCharges($this->getTotal($products,$cartItems)["grossTotal"]);
      
      $str.='<div class="row"><div class="col"></div><div class="col" style="text-align:right"><b>Delivery Charges</b></div><div class="col">'.CURRENCY_SYMBOL.$deliveryCharges.'</div></div>';
      $cartTotal=$this->getTotal($products,$cartItems);
      $str.='<div class="row"><div class="col"></div><div class="col" style="text-align:right"><b>Discount</b></div><div class="col">'.CURRENCY_SYMBOL.strval($cartTotal["totalDiscount"]).'</div></div>';
      $str.='<div class="row"><div class="col"></div><div class="col" style="text-align:right"><b>Total</b></div><div class="col">'.CURRENCY_SYMBOL.strval($cartTotal["grossTotal"]+$deliveryCharges).'</div></div>';

      return $str;
   }
   //get gross total method
   public function getTotal($products,$cartItems) {
      $total=0;
      $totalDiscount=0;
      foreach($products as $product){
         if(isset($cartItems[$product->getCode()])){
            if(parent::checkOfferOnArticle($product->getCode())) {
               $offeredprice=parent::calculateOffer($product->getCode(),$cartItems[$product->getCode()]["qty"],$product->getPrice());
               $total+=$offeredprice["totalCost"];
               $totalDiscount=$offeredprice["totalDiscount"];

            }
            else{
               $qty=$cartItems[$product->getCode()]["qty"];
               $price=$product->getPrice();
               $total+=($price*$qty);
            }
            
         }
         
      }
      return array("grossTotal"=>$this->convertToNumberFormat($total),"totalDiscount"=>$this->convertToNumberFormat($totalDiscount));
   }

   public function convertToNumberFormat($num)
   {
      return number_format(floor($num*100)/100,2, '.', '');
   }

}


?>