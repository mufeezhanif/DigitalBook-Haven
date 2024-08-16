<?php

include 'config.php';

session_start();

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
  header('location:login.php');
}

if (isset($_POST['btn'])) {

  $name = mysqli_real_escape_string($connection, $_POST['name']);
  $number = $_POST['number'];
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $method = 'credit card';
  $address = mysqli_real_escape_string($connection, 'address. ' . $_POST['address'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['zip']);
  $placed_on = date('d-M-Y');
  $card_name = $_POST['cardname'];
  $card_number = $_POST['cardnumber'];
  $exp_month = $_POST['expmonth'];
  $exp_year = $_POST['expyear'];
  $cvv = $_POST['cvv'];

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

  $order_query = "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND method = '$method' AND email = '$email'  AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'" or die('query failed');
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
    } else if ($method == 'credit card') {
      $sql = "INSERT INTO `orders`(`user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `card_name`, `card_number`, `exp_month`, `exp_year`, `cvv`, `payment_status`, `product_id`) VALUES('$user_id', '$name', '$number', '$email', 'credit card', '$address','$total_products', '$cart_total','$placed_on','$card_name','$card_number','$exp_month','$exp_year',$cvv,'pending',{$productid})" or die('query failed');
      $res = mysqli_query($connection, $sql);

      $message[] = 'order placed successfully!';

      $sql1 =  "DELETE FROM `cart` WHERE user_id = '$user_id'" or die('query failed');
      $res = mysqli_query($connection, $sql1);
    }

    if ($method == 'cash on delivery') {

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

  $mail->From = "aliyanmuhammad840@gmail.com";
  $mail->FromName = "Ebooks";

  $mail->addAddress($email, "Order");
  //$mail->AddCC($varEmail,'');

  $mail->isHTML(true);

  $mail->Subject = "Your Order has been placed - Ebooks";
  $mail->Body = "
       <div style='font-family: Arial, sans-serif; padding: 20px; background-color: #f2f2f2;'>

  <h1 style='margin-top: 0; color: #1E90FF;'>Order Confirmation</h1>

  <p>Thank you for your order! We have received your payments & your items are on their way.</p>

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
    form {
      font-family: Arial;
      font-size: 17px;
      padding: 8px;
    }

    * {
      box-sizing: border-box;
    }

    .row {
      display: -ms-flexbox;
      /* IE10 */
      display: flex;
      -ms-flex-wrap: wrap;
      /* IE10 */
      flex-wrap: wrap;
      margin: 0 -16px;
    }

    .col-25 {
      -ms-flex: 25%;
      /* IE10 */
      flex: 25%;
    }

    .col-50 {
      -ms-flex: 50%;
      /* IE10 */
      flex: 50%;
    }

    .col-75 {
      -ms-flex: 75%;
      /* IE10 */
      flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
      padding: 0 16px;
    }

    .containerss {
      background-color: #f2f2f2;
      padding: 5px 20px 15px 20px;
      border: 1px solid lightgrey;
      border-radius: 3px;
    }

    input[type=text],
    [type=number] {
      width: 100%;
      margin-bottom: 20px;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    .lb {
      margin-bottom: 10px;
      display: block;
    }

    .icon-container {
      margin-bottom: 20px;
      padding: 7px 0;
      font-size: 24px;
    }

    .btns {
      background-color: #04AA6D;
      color: white;
      padding: 12px;
      margin: 10px 0;
      border: none;
      width: 100%;
      border-radius: 3px;
      cursor: pointer;
      font-size: 17px;
    }

    .btn:hover {
      background-color: #45a049;
    }

    a {
      color: #2196F3;
    }

    hr {
      border: 1px solid lightgrey;
    }

    span.price {
      float: right;
      color: grey;
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

    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
    @media (max-width: 800px) {
      .row {
        flex-direction: column-reverse;
      }

      .col-25 {
        margin-bottom: 20px;
      }
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


    <div style="margin:50px;">
      <form action="" method="post">
        <div class="col-75">
          <div class="containerss">
            <form action="/action_page.php">

              <div class="row" style="display: -ms-flexbox;  display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin: 0 -16px;">
                <div class="col-50" style="-ms-flex: 50%; /* IE10 */ flex: 50%;">
                  <label class="lb" for="fname"><i class="fa fa-user"></i> Full Name</label>
                  <input name="name" type="text" id="fname" required placeholder="John M. Doe">
                  <label class="lb" for="fname"><i class="fa fa-user"></i>Phone No</label>
                  <input name="number" type="number" id="fname" required placeholder="+923323940589">
                  <label class="lb" for="email"><i class="fa fa-envelope"></i> Email</label>
                  <input name="email" class="lb" type="text" id="email" required placeholder="john@example.com">
                  <label class="lb" for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                  <input type="text" id="adr" name="address" required placeholder="542 W. 15th Street">
                  <label class="lb" for="city"><i class="fa fa-institution"></i> City</label>
                  <input type="text" id="city" name="city" required placeholder="New York">
                  <label class="lb" for="city"><i class="fa fa-institution"></i> Country</label>
                  <input type="text" id="city" name="country" required placeholder="Pakistan">
                  <div class="row">
                    <div class="col-50" style="-ms-flex: 50%; /* IE10 */ flex: 50%;">
                      <label class="lb" for="state">State</label>
                      <input type="text" id="state" name="state" required placeholder="NY">
                    </div>
                    <div class="col-50" style="-ms-flex: 50%; /* IE10 */ flex: 50%;">
                      <label class="lb" for="zip">Zip</label>
                      <input type="text" id="zip" name="zip" required placeholder="10001">
                    </div>
                  </div>
                </div>

                <div class="col-50" style="-ms-flex: 50%; /* IE10 */ flex: 50%;">
                  <h3>Payment</h3>
                  <label class="lb" for="fname">Accepted Cards</label>
                  <div class="icon-container">
                    <i class="fa-brands fa-cc-visa" style="color:navy;"></i>
                    <i class="fa-brands fa fa-cc-amex" style="color:blue;"></i>
                    <i class="fa-brands fa fa-cc-mastercard" style="color:red;"></i>
                    <i class="fa-brands fa fa-cc-discover" style="color:orange;"></i>
                  </div>
                  <label class="lb" for="cname">Name on Card</label>
                  <input type="text" id="cname" name="cardname" required placeholder="John More Doe">
                  <label class="lb" for="ccnum">Credit card number</label>
                  <input type="text" id="ccnum" name="cardnumber" required placeholder="1111-2222-3333-4444">
                  <label class="lb" for="expmonth">Exp Month</label>
                  <input type="text" id="expmonth" name="expmonth" required placeholder="September">

                  <div class="row">
                    <div class="col-50" style="-ms-flex: 50%; /* IE10 */ flex: 50%;">
                      <label class="lb" for="expyear">Exp Year</label>
                      <input type="text" id="expyear" name="expyear" required placeholder="2018">
                    </div>
                    <div class="col-50" style="-ms-flex: 50%; /* IE10 */ flex: 50%;">
                      <label class="lb" for="cvv">CVV</label>
                      <input type="text" id="cvv" name="cvv" required placeholder="352">
                    </div>
                  </div>
                </div>

              </div>
              <label class="lb">
                <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
              </label>
              <input type="submit" value="Continue to checkout" name="btn" class="btns">
            </form>
          </div>
        </div>

      </form>
    </div>





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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
    <script src="js/map-script.js"></script>

</body>

</html>