<?php

include 'config.php';

session_start();

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
   header('location:login.php');
}


if (isset($_POST['order_btn'])) {

   $name = mysqli_real_escape_string($connection, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($connection, $_POST['email']);
   $method = mysqli_real_escape_string($connection, $_POST['method']);
   $address = mysqli_real_escape_string($connection, 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code']);
   $placed_on = date('d-M-Y');


   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = "SELECT * FROM `cart` WHERE user_id = '$user_id'" or die('query failed');
   $res = mysqli_query($connection, $cart_query);
   if (mysqli_num_rows($res) > 0) {
      while ($cart_item = mysqli_fetch_assoc($res)) {
         $cart_products[] = $cart_item['itemname'] . ' (' . $cart_item['quantity'] . ') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ', $cart_products);

   $order_query = "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'" or die('query failed');
   $res = mysqli_query($connection, $order_query);



   // getting product id
   $cart_query1 = "SELECT * FROM `cart` WHERE user_id = '$user_id'" or die('query failed');
   $res1 = mysqli_query($connection, $cart_query1);
   if (mysqli_num_rows($res1) > 0) {
      $cart_item1 = mysqli_fetch_assoc($res1);
      $productname = $cart_item1['itemname'];
      $queryid = "select * from `products` where name = '$productname'";
      $resultid = mysqli_query($connection, $queryid);
      $resultid1 = mysqli_fetch_assoc($resultid);
      $productid  = $resultid1['pid'];
   }

   // getting product id end

   if ($cart_total == 0) {
      $message[] = 'your cart is empty';
   } else {
      if (mysqli_num_rows($res) > 0) {
         $message[] = 'order already placed!';
      } else if ($method == 'cash on delivery') {
         $sql = "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on,payment_status,product_id) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on','pending','$productid')" or die('query failed');
         $res = mysqli_query($connection, $sql);

         //  $message[] = 'order placed successfully!';

         $sql1 =  "DELETE FROM `cart` WHERE user_id = '$user_id'" or die('query failed');
         $res = mysqli_query($connection, $sql1);
      }

      if ($method == 'credit card') {

         header('location: card.php');
      }
   }

   require_once "PHPMailer/PHPMailerAutoload.php";

   //==Email Process===================
   $mail = new PHPMailer;
   //Enable SMTP debugging. 
   //$mail->SMTPDebug = 3;                               
   //Set PHPMailer to use SMTP.
   $mail->isSMTP();
   //Set SMTP host name                          
   $mail->Host = "smtp.gmail.com";
   //Set this to true if SMTP host requires authentication to send email
   $mail->SMTPAuth = true;
   //Provide username and password     
   $mail->Username = "mufeez.admani123@gmail.com";
   $mail->Password = "eashjgglculpmqei";
   //If SMTP requires TLS encryption then set it
   $mail->SMTPSecure = "tls";
   //Set TCP port to connect to 
   $mail->Port = 587;

   $mail->From = "mufeez.admani123@gmail.com";
   $mail->FromName = "Ebooks";

   $mail->addAddress($email, "Order");
   //$mail->AddCC($varEmail,'');

   $mail->isHTML(true);

   $mail->Subject = "Your Order has been placed - Ebooks";
   $mail->Body = "
       <div style='font-family: Arial, sans-serif; padding: 20px; background-color: #f2f2f2;'>

  <h1 style='margin-top: 0; color: #1E90FF;'>Order Confirmation</h1>

  <p>Thank you for your order! your items are on their way.</p>

  <p>Order Date: <strong>$placed_on</strong></p>

  <h2 style='margin-top: 0; color: #1E90FF;'>Customer Details</h2>

  <p>Name: <strong>$name</strong></p>
  <p>Contact Number: <strong> $number</strong></p>
  <p>Address: <strong>$address</strong></p>
  <p>Shipping Method: <strong>$method </strong></p>
  <h2 style='margin-top: 0; color: #1E90FF;'>Order Details</h2>
  <table style='border-collapse: collapse; width: 100%;'>
    <tr>
      <th style='border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #1E90FF; color: #ffffff;'>Item</th>
      <th style='border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #1E90FF; color: #ffffff;'>Quantity</th>
      <th style='border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #1E90FF; color: #ffffff;'>Price</th>
    </tr>
  </table>
  <h3 style='margin-top: 0; color: #1E90FF;'>Total Products:  $total_products </h3>
  <h3 style='margin-top: 0; color: #1E90FF;'>Total Price: $$cart_total/-</h3>
  <p>You will receive a shipping confirmation email once your items have been shipped.</p>
  <p>If you have any questions or concerns, please contact us at <a style='color: #1E90FF' href='mailto:support@ebooks.com'>support@ebooks.com</a>.</p>
</div>";

   $mail->AltBody = "This is the plain text version of the email content";
   $mail->send();

   $message[] = 'order placed successfully!';
}

?>

<!doctype html>
<html lang="en">

<head>

   <!--====== Required meta tags ======-->
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!--====== Title ======-->
   <title>Ebooks</title>

   <!--====== Favicon Icon ======-->
   <link rel="shortcut icon" href="images/favicon.png" type="image/png">

   <!--====== Slick css ======-->
   <link rel="stylesheet" href="css/slick.css">

   <!--====== Animate css ======-->
   <link rel="stylesheet" href="css/animate.css">

   <!--====== Nice Select css ======-->
   <link rel="stylesheet" href="css/nice-select.css">

   <!--====== Nice Number css ======-->
   <link rel="stylesheet" href="css/jquery.nice-number.min.css">

   <!--====== Magnific Popup css ======-->
   <link rel="stylesheet" href="css/magnific-popup.css">

   <!--====== Bootstrap css ======-->
   <link rel="stylesheet" href="css/bootstrap.min.css">

   <!--====== Fontawesome css ======-->
   <link rel="stylesheet" href="css/font-awesome.min.css">

   <!--====== Default css ======-->
   <link rel="stylesheet" href="css/default.css">

   <!--====== Style css ======-->
   <link rel="stylesheet" href="css/style.css">

   <!--====== Responsive css ======-->
   <link rel="stylesheet" href="css/responsive.css">

   <style>
      @import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap');


      .container {
         max-width: 1230px;
         width: 100%;
      }

      h1 {
         font-weight: 700;
         font-size: 45px;
         font-family: 'Roboto', sans-serif;
      }

      .header {
         margin-bottom: 80px;
      }

      #description {
         font-size: 24px;
      }

      .form-wrap {
         background: rgba(255, 255, 255, 1);
         width: 100%;
         max-width: 850px;
         padding: 50px;
         margin: 0 auto;
         position: relative;
         -webkit-border-radius: 10px;
         -moz-border-radius: 10px;
         border-radius: 10px;
         -webkit-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
         -moz-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
         box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
      }

      .form-wrap:before {
         content: "";
         width: 90%;
         height: calc(100% + 60px);
         left: 0;
         right: 0;
         margin: 0 auto;
         position: absolute;
         top: -30px;
         background: #F5D71E;
         z-index: -1;
         opacity: 0.8;
         -webkit-border-radius: 10px;
         -moz-border-radius: 10px;
         border-radius: 10px;
         -webkit-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
         -moz-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
         box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
      }

      .form-group {
         margin-bottom: 25px;
      }

      .form-group>label {
         display: block;
         font-size: 18px;
         color: #000;
      }

      .custom-control-label {
         color: #000;
         font-size: 16px;
      }

      .form-control {
         height: 50px;
         background: #ecf0f4;
         border-color: transparent;
         padding: 0 15px;
         font-size: 16px;
         -webkit-transition: all 0.3s ease-in-out;
         -moz-transition: all 0.3s ease-in-out;
         -o-transition: all 0.3s ease-in-out;
         transition: all 0.3s ease-in-out;
      }

      .form-control:focus {
         border-color: #00bcd9;
         -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
         -moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
         box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
      }

      textarea.form-control {
         height: 160px;
         padding-top: 15px;
         resize: none;
      }

      .btn {
         padding: .657rem .75rem;
         font-size: 18px;
         letter-spacing: 0.050em;
         -webkit-transition: all 0.3s ease-in-out;
         -moz-transition: all 0.3s ease-in-out;
         -o-transition: all 0.3s ease-in-out;
         transition: all 0.3s ease-in-out;
      }

      .btn-primary {
         color: #fff;
         background-color: #00bcd9;
         border-color: #00bcd9;
      }

      .btn-primary:hover {
         color: #00bcd9;
         background-color: #ffffff;
         border-color: #00bcd9;
         -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
         -moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
         box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
      }

      .btn-primary:focus,
      .btn-primary.focus {
         color: #00bcd9;
         background-color: #ffffff;
         border-color: #00bcd9;
         -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
         -moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
         box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
      }

      .btn-primary:not(:disabled):not(.disabled):active,
      .btn-primary:not(:disabled):not(.disabled).active,
      .show>.btn-primary.dropdown-toggle {
         color: #00bcd9;
         background-color: #ffffff;
         border-color: #00bcd9;
      }

      .btn-primary:not(:disabled):not(.disabled):active:focus,
      .btn-primary:not(:disabled):not(.disabled).active:focus,
      .show>.btn-primary.dropdown-toggle:focus {
         -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
         -moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
         box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
      }

      /* end of new form css------------ */
      .checkout form {
         max-width: 1200px;
         padding: 2rem;
         margin: 0 auto;
         border: var(--border);
         background-color: var(--light-bg);
         border-radius: .5rem;
      }

      .checkout form h3 {
         text-align: center;
         margin-bottom: 2rem;
         color: var(--black);
         text-transform: uppercase;
         font-size: 3rem;
      }

      .checkout form .flex {
         display: flex;
         flex-wrap: wrap;
         gap: 1.5rem;
      }

      .checkout form .flex .inputBox {
         flex: 1 1 40rem;
      }

      .checkout form .flex span {
         font-size: 2rem;
         color: var(--black);
      }

      .checkout form .flex select,
      .checkout form .flex input {
         border: var(--border);
         width: 100%;
         border-radius: .5rem;
         width: 100%;
         background-color: var(--white);
         padding: 1.2rem 1.4rem;
         font-size: 1.8rem;
         margin: 1rem 0;
      }

      .heading {
         min-height: 30vh;
         display: flex;
         flex-flow: column;
         align-items: center;
         justify-content: center;
         gap: 1rem;
         background: url(../images/heading-bg.webp) no-repeat;
         background-size: cover;
         background-position: center;
         text-align: center;
      }

      .heading h3 {
         font-size: 5rem;
         color: var(--black);
         text-transform: uppercase;
      }

      .heading p {
         font-size: 2.5rem;
         color: var(--light-color);
      }

      .heading p a {
         color: var(--purple);
      }

      .heading p a:hover {
         text-decoration: underline;
      }

      .display-order {
         max-width: 1200px;
         margin: 0 auto;
         text-align: center;
         padding-bottom: 0;
      }

      .display-order p {
         background-color: var(--light-bg);
         color: var(--black);
         font-size: 2rem;
         padding: 1rem 1.5rem;
         border: var(--border);
         display: inline-block;
         margin: .5rem;
      }

      .display-order p span {
         color: var(--red);
      }

      .display-order .grand-total {
         margin-top: 2rem;
         font-size: 2.5rem;
         color: var(--light-color);
      }

      .display-order .grand-total span {
         color: var(--red);
      }
   </style>
</head>

<body>

   <!--====== PRELOADER PART START ======-->
   <?php

   include "preloader.php"
   ?>

   <!--====== PRELOADER PART START ======-->

   <!--====== HEADER PART START ======-->
   <?php

   include "header.php"
   ?>


   <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url(images/page-banner-1.jpg)">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="page-banner-cont">
                  <h2>Checkout</h2>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                     </ol>
                  </nav>
               </div> <!-- page banner cont -->
            </div>
         </div> <!-- row -->
      </div> <!-- container -->
   </section>


   <section class="display-order">

      <?php
      $grand_total = 0;
      $select_cart = "SELECT * FROM `cart` WHERE user_id = '$user_id'" or die('query failed');
      $res = mysqli_query($connection, $select_cart);

      if (mysqli_num_rows($res) > 0) {
         while ($fetch_cart = mysqli_fetch_assoc($res)) {
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
      ?>
            <p> <?php echo $fetch_cart['itemname']; ?> <span>(<?php echo '$' . $fetch_cart['price'] . '/-' . ' x ' . $fetch_cart['quantity']; ?>)</span> </p>
      <?php
         }
      } else {
         echo '<p class="empty">your cart is empty</p>';
      }
      ?>
      <div class="grand-total"> grand total : <span>$<?php echo $grand_total; ?>/-</span> </div>

   </section>

   <section class="checkout">

      <form action="" method="post">
         <header class="header">
            <p id="description" class="text-center">
               Thank you for Buying Book From Us
            </p>
         </header>
         <div class=" form-wrap row ">
            <div class="inputBox col-md-6 form-group">
               <span>your name :</span>
               <input type="text" name="name" class="form-control" required placeholder="enter your name">
            </div>

            <div class="inputBox col-md-6">
               <span>your email :</span>
               <input type="email" name="email" class="form-control" required placeholder="enter your email">
            </div>
            <div class="form-group col-md-6">
               <label>Payment Type</label>
               <select id="dropdown" name="method" class="form-control" required>
                  <option disabled selected value>select payment type</option>
                  <option value="cash on delivery">cash on delivery</option>
                  <option value="credit card">credit card</option>
                  <option value="paypal">paypal</option>
                  <option value="paytm">paytm</option>
               </select>
            </div>

            <div class="inputBox col-md-6 ">
               <span>city :</span>
               <input type="text" name="city" class="form-control" required placeholder="e.g. mumbai">
            </div>

            <div class="inputBox col-md-6 form-group">
               <span>your number :</span>
               <input type="number" name="number" class="form-control" required placeholder="enter your number">
            </div>

            <div class="inputBox col-md-6 ">
               <span>address line 01 :</span>
               <input type="number" min="0" name="flat" class="form-control" required placeholder="e.g. flat no.">
            </div>
            <div class="inputBox col-md-6">
               <span>address line 01 :</span>
               <input type="text" name="street" class="form-control" required placeholder="e.g. street name">
            </div>

            <div class="inputBox col-md-6">
               <span>state :</span>
               <input type="text" name="state" class="form-control" required placeholder="e.g. maharashtra">
            </div>
            <div class="inputBox col-md-6">
               <span>country :</span>
               <input type="text" name="country" class="form-control" required placeholder="e.g. india">
            </div>
            <div class="inputBox col-md-6">
               <span>pin code :</span>
               <input type="text" min="0" class="form-control" name="pin_code" required placeholder="e.g. 123456">
            </div>

            <input type="submit" value="order now" class=" mt-4 btn col-md-4 btn btn-warning" name="order_btn">
         </div>

      </form>

   </section>
   <br>





   <!--====== FOOTER PART START ======-->

   <?php
   include "footer.php"
   ?>

   <!--====== FOOTER PART ENDS ======-->

   <!--====== BACK TO TP PART START ======-->

   <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

   <!--====== BACK TO TP PART ENDS ======-->








   <!--====== jquery js ======-->
   <script src="js/vendor/modernizr-3.6.0.min.js"></script>
   <script src="js/vendor/jquery-1.12.4.min.js"></script>

   <!--====== Bootstrap js ======-->
   <script src="js/bootstrap.min.js"></script>

   <!--====== Slick js ======-->
   <script src="js/slick.min.js"></script>

   <!--====== Magnific Popup js ======-->
   <script src="js/jquery.magnific-popup.min.js"></script>

   <!--====== Counter Up js ======-->
   <script src="js/waypoints.min.js"></script>
   <script src="js/jquery.counterup.min.js"></script>

   <!--====== Nice Select js ======-->
   <script src="js/jquery.nice-select.min.js"></script>

   <!--====== Nice Number js ======-->
   <script src="js/jquery.nice-number.min.js"></script>

   <!--====== Count Down js ======-->
   <script src="js/jquery.countdown.min.js"></script>

   <!--====== Validator js ======-->
   <script src="js/validator.min.js"></script>

   <!--====== Ajax Contact js ======-->
   <script src="js/ajax-contact.js"></script>

   <!--====== Main js ======-->
   <script src="js/main.js"></script>

   <!--====== Map js ======-->
   
   <script src="js/map-script.js"></script>

</body>

</html>