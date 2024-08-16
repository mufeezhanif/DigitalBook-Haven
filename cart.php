<?php

include 'config.php';

session_start();

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['update_cart'])) {
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   $sql = "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'" or die('query failed');
   $res = mysqli_query($connection, $sql);
   $message[] = 'cart quantity updated!';
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $sql = "DELETE FROM `cart` WHERE id = '$delete_id'" or die('query failed');
   $res = mysqli_query($connection, $sql);
   header('location:cart.php');
}

if (isset($_GET['delete_all'])) {
   $sql = "DELETE FROM `cart` WHERE user_id = '$user_id'" or die('query failed');
   $res = mysqli_query($connection, $sql);

   header('location:cart.php');
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

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <style>
      .box-container {
         display: flex;
         flex-direction: column;

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



   <div class="container">
      <br>
      <br><br>
      <section class="shopping-cart ">

         <h1 class="title">Products Added</h1>
         <hr>

         <div class="box-container box mt-5">
            <div class="container">
               <div class="row">
                  <?php
                  $grand_total = 0;
                  $select_cart = "SELECT * FROM `cart` WHERE user_id = '$user_id'" or die('query failed');
                  $res = mysqli_query($connection, $select_cart);

                  if (mysqli_num_rows($res) > 0) {
                     while ($fetch_cart = mysqli_fetch_assoc($res)) {
                  ?>
                        <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" style="font-size:xx-large;color:red; align-self:right;" onclick="return confirm('delete this from cart?');"></a>
                        <div class=" col-md-4 ">
                           <img class="card-img-top" style="width: 100%;" src="files/productimg/<?php echo $fetch_cart['image']; ?>" alt="this is an image">
                           <div class="name card-title"><?php echo $fetch_cart['itemname']; ?></div>
                           <div class="price card-text">$<?php echo $fetch_cart['price']; ?>/-</div>
                           <form action="" method="post">
                              <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                              <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                              <input type="submit" name="update_cart" value="update" class=" btn btn-primary option-btn">
                           </form>
                           <div class="sub-total"> sub total : <span>$<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>/-</span> </div>
                        </div>
                  <?php
                        $grand_total += $sub_total;
                     }
                  } else {
                     echo '<p class="empty text-center" style= "border : 2px solid red; background-color:red; padding:35px; width:50%;margin-left:25%;font-size:28px;color:white;">YOUR CART IS EMPTY </p>';
                  }
                  ?>
               </div>
            </div>
         </div>

         <div class="cart-total mt-5 mb-4">
            <hr>
            <p class="box " style="font-size: 28px; justify-content:right;">Grand Total : <span>$<?php echo $grand_total; ?>/-</span></p>
            <br>
            <div class="flex text-center">
               <a href="cart.php?delete_all" style="width:12rem" class="delete-btn btn btn-danger   <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from cart?');">Delete All</a>
               <a href="shop.php" style="width:12rem" class="option-btn btn btn-primary">Continue Shopping</a>
               <a href="checkout.php" style="width:12rem" class="btn btn btn-success <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed To Checkout</a>
            </div>
         </div>




      </section>
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