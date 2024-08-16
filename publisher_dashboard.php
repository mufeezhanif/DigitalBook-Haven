<?php

session_start();
include 'config.php';


$publisher_id = $_SESSION['id'];

if (!isset($publisher_id)) {
   header('location:login.php');
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
      .dashhead {
         display: flex;
         justify-content: center;
         align-items: center;
      }

      .box-container {
         display: flex;
         align-items: center;
         justify-content: center;
      }

      .card {
         display: flex;
         align-items: center;
         justify-content: center;

      }

      .title {
         text-align: center;
         margin-bottom: 2rem;
         text-transform: uppercase;
         color: var(--black);
         font-size: 4rem;
      }

      .row {
         display: flex;
         justify-content: center;
         align-items: center;
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


   <!-- admin dashboard section starts  -->

   <section class="dashboard container-fluid">
      <h2 class="dashhead mb-5">Dashboard</h2>
      <div class="box-container ">
         <div class="row container ">

            <div class="card col-md-3 m-2">

               <div class="card-body ">
                  <?php
                  $select_product = "SELECT * FROM `products` where p_id = $publisher_id" or die('query failed');
                  $res = mysqli_query($connection, $select_product);
                  $number_of_products = mysqli_num_rows($res);
                  if ($number_of_products > 0) {
                  ?>
                     <h3><?php echo $number_of_products; ?></h3>
                  <?php } else { ?>
                     <h6>No Products Added</h6>
                  <?php } ?>
                  <p>Number Of Products</p>

               </div>
            </div>

            <div class="card col-md-3 m-2">

               <div class="card-body ">
                  <?php
                  $select_contest = "SELECT * FROM `compa`" or die('query failed');
                  $res = mysqli_query($connection, $select_contest);
                  $number_of_contest = mysqli_num_rows($res);
                  ?>
                  <h3><?php echo $number_of_contest; ?></h3>
                  <p>Total No of Contestant Stories</p>
               </div>
            </div>

            <div class="card col-md-3 m-2">

               <div class="card-body ">
                  <?php
                  $select_orders = "SELECT * FROM `orders`" or die('query failed');
                  $res = mysqli_query($connection, $select_orders);
                  $number_of_orders = mysqli_num_rows($res);
                  ?>
                  <h3><?php echo $number_of_orders; ?></h3>
                  <p>order placed</p>
               </div>
            </div>


            <div class="card col-md-3 m-2">

               <div class="card-body ">
                  <?php
                  $select_users = "SELECT * FROM `userdata` WHERE user_type = 'user'" or die('query failed');
                  $res = mysqli_query($connection, $select_users);
                  $number_of_users = mysqli_num_rows($res);
                  ?>
                  <h3><?php echo $number_of_users; ?></h3>
                  <p>Normal Users</p>
               </div>
            </div>


            <div class="card col-md-3 m-2">

               <div class="card-body ">
                  <?php
                  $select_admins = "SELECT * FROM `userdata` WHERE user_type = 'publisher'" or die('query failed');
                  $res = mysqli_query($connection, $select_admins);
                  $number_of_admins = mysqli_num_rows($res);
                  ?>
                  <h3><?php echo $number_of_admins; ?></h3>
                  <p>Other Publishers</p>

               </div>
            </div>


   </section>
   <br>

   <!-- admin dashboard section ends -->



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