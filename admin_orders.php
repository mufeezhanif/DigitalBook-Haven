<?php
session_start();
include("config.php");

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['update_order'])) {

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $sql = "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'" or die('query failed');
   $res = mysqli_query($connection, $sql);
   $message[] = 'payment status has been updated!';
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $sql = "DELETE FROM `orders` WHERE id = '$delete_id'" or die('query failed');
   $res = mysqli_query($connection, $sql);
   header('location:admin_orders.php');
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
      .title {
         text-align: center;
         margin-bottom: 2rem;
         text-transform: uppercase;
         color: var(--black);
         font-size: 4rem;
      }

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


   <section class="orders">

      <h1 class="title">Placed orders</h1>

      <div class="box-container container">
         <?php
         $sql = "SELECT * FROM `orders`" or die('query failed');
         $res = mysqli_query($connection, $sql);
         if (mysqli_num_rows($res) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($res)) {
         ?>
               <div class="row  mt-4">
                  <div style="height:350px; background-color:#fff; " class=" mt-4  border border-info p-2 col-md-10">
                     <p> User Id : <span><?php echo $fetch_orders['user_id']; ?></span> </p>
                     <p> Placed On : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                     <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                     <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
                     <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                     <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
                     <p> Total Products : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                     <p> Total Price : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
                     <p> Payment Method : <span><?php echo $fetch_orders['method']; ?></span> </p>
                     <form action="" method="post">
                        <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                        <select name="update_payment">
                           <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                           <option value="pending">pending</option>
                           <option value="completed">completed</option>
                        </select>
                        <input type="submit" value="update" name="update_order" class="option-btn btn btn-success">
                        <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn btn btn-danger">Delete</a>
                     </form>
                  </div>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>
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