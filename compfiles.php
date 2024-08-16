<?php
session_start();
include("config.php");

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $sql = "DELETE FROM `compa` WHERE id = '$delete_id'" or die('query failed');
   $res = mysqli_query($connection, $sql);
   header('location:admin_competition.php');
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
      .orders .box-container {
         display: grid;
         grid-template-columns: repeat(auto-fit, 30rem);
         justify-content: center;
         gap: 1.5rem;
         max-width: 1200px;
         margin: 0 auto;
         align-items: flex-start;
      }

      .orders .box-container .box {
         background-color: var(--white);
         padding: 2rem;
         border: var(--border);
         box-shadow: var(--box-shadow);
         border-radius: .5rem;
      }

      .orders .box-container .box p {
         padding-bottom: 1rem;
         font-size: 2rem;
         color: var(--light-color);
      }

      .orders .box-container .box p span {
         color: var(--purple);
      }

      .orders .box-container .box form {
         text-align: center;
      }

      .orders .box-container .box form select {
         border-radius: .5rem;
         margin: .5rem 0;
         width: 100%;
         background-color: var(--light-bg);
         border: var(--border);
         padding: 1.2rem 1.4rem;
         font-size: 1.8rem;
         color: var(--black);
      }

      .title {
         text-align: center;
         margin-bottom: 2rem;
         text-transform: uppercase;
         color: var(--black);
         font-size: 4rem;
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


   <!-- admin products section starts  -->


   <h1 class="title mt-3">Submitted Files</h1>
   <section class="orders">
      
      <h3 class=" mt-3 text-center fa-border">Story Writing Competition</h3>

      <div class="box-container container">
         <?php
         $sql = "SELECT * FROM `compa`" or die('query failed');
         $res = mysqli_query($connection, $sql);
         if (mysqli_num_rows($res) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($res)) {
         ?>
               <div class="row  mt-4">
                  <div style="padding:29px; background-color:#fff; " class=" mt-4  border border-info col-md-10">
                     <p> <strong> Name </strong>: <span><?php echo $fetch_orders['username']; ?></span> </p>
                     <p> <strong> Number </strong>: <span><?php echo $fetch_orders['contact']; ?></span> </p>
                     <p> <strong> Email </strong>: <span><?php echo $fetch_orders['email']; ?></span> </p>
                     <p> <strong> Subject </strong>: <span><?php echo $fetch_orders['subjects']; ?></span> </p>
                     <p> <strong> Topic </strong>: <span><?php echo $fetch_orders['topicname']; ?></span> </p>
                     <p> <strong> User Id </strong>: <span><?php echo $fetch_orders['user_id']; ?></span> </p>
                     <form action="" method="post" class="mt-2">
                        <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                        <a href="files/competitionfiles/<?php echo $fetch_orders['filename']; ?>" class="btn btn-info " download='<?php echo $fetch_orders['username']; ?>'>Download</a>
                        <a href="admin_competition.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn btn btn-danger">Delete</a>
                     </form>
                  </div>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">No Files Submitted Yet!</p>';
         }
         ?>
      </div>

   </section>
   <br>
   <section class="orders">
      
      <h3 class=" mt-3 text-center fa-border">Essay Writing Competition</h3>

      <div class="box-container container">
         <?php
         $sql = "SELECT * FROM `compkids`" or die('query failed');
         $res = mysqli_query($connection, $sql);
         if (mysqli_num_rows($res) > 0) {
            while ($fetchfile = mysqli_fetch_assoc($res)) {
         ?>
               <div class="row  mt-4">
                  <div style="padding:29px; background-color:#fff; " class=" mt-4  border border-info col-md-10">
                     <p> <strong> Name </strong>: <span><?php echo $fetchfile['username']; ?></span> </p>
                     <p> <strong> Number </strong>: <span><?php echo $fetchfile['contact']; ?></span> </p>
                     <p> <strong> Email </strong>: <span><?php echo $fetchfile['email']; ?></span> </p>
                     <p> <strong> Topic </strong>: <span><?php echo $fetchfile['topicname']; ?></span> </p>
                     <p> <strong> User Id </strong>: <span><?php echo $fetchfile['user_id']; ?></span> </p>
                     <form action="" method="post" class="mt-2">
                        <input type="hidden" name="order_id" value="<?php echo $fetchfile['id']; ?>">
                        <a href="files/competitionfiles/<?php echo $fetchfile['filename']; ?>" class="btn btn-info " download='<?php echo $fetchfile['username']; ?>'>Download</a>
                        <a href="admin_competition.php?delete=<?php echo $fetchfile['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn btn btn-danger">Delete</a>
                     </form>
                  </div>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">No Files Submitted Yet!</p>';
         }
         ?>
      </div>

   </section>
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
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
   <script src="js/map-script.js"></script>

</body>

</html>