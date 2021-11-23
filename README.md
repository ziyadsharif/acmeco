# Solution for Acme Widget
Acme Widget Co are the leading provider of made up widgets and they’ve contracted you to
create a proof of concept for their new sales system.

# Files Structure and thier Purpose #
There are 5 code files
**configurations.php** - contains basic configration for the system DELIVERY_RULES,OFFERS,CURRENCY,CURRENCY_SYMBOL  
**core.php** - All the classes required for the System 
**index.php** - Home page to show catalogue
**cart.php** - All the cart related operations like checkout and showing the cart details are available in this file
**header.php** - Basic initialization parameters are setup here.

Open **index.php** in your browser to and start adding products in the cart. You can click on the your cart button on right top to see all the products in the cart.

### Technical explanation ###
Apache with atleast php version 7 installed, is required to run this assignment.  
Before running the project you need to edit the header.php and configure the baseurl to your project directory.

#### Assumptions and Flow instructions ####
-- At the moment when the user add's a product on the home page, it will redirect the user to the cart page and if user needs to add more products user needs to go back to the home page again. This is problem can easily be resolve using ajax calls which I have not used at the moment in this project.
-- User can click on the checkout button to clear the cart.
