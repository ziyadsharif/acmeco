<?php
// Delivery rules array
define('DELIVERY_RULES', [[
   'Limit'  => 50,
   'cost'   => 4.95
], [
   'Limit'  => 90,
   'cost'   => 2.95
]]);

// Offers array

define('OFFERS',[[
   'title'           => 'Buy 1 red widget, get the 2nd half price',
   'itemCode'        => 'R01',
   'qtyApplicable'   => 2,
   'offerDiscount'   => '50',
   'isPercentage'    => true
]]);
// Currency and Symbol
define('CURRENCY', 'USD');
define('CURRENCY_SYMBOL', '$');

?>