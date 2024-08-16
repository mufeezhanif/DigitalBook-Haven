<?php
session_start();
include("config.php");

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['update_usertype'])) {

   $user_update_id = $_POST['user_id'];
   $update_type = $_POST['update_type'];
   $sql = "UPDATE `userdata` SET user_type = '$update_type' WHERE userid = '$user_update_id'" or die('query failed');
   $res = mysqli_query($connection, $sql);
   $message[] = 'user type has been updated!';
}
if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $sql = "DELETE FROM `userdata` WHERE userid = '$delete_id'" or die('query failed');
   $res = mysqli_query($connection, $sql);
   header('location:admin_users.php');
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
      .users .box-container {
         display: grid;
         grid-template-columns: repeat(auto-fit, 30rem);
         justify-content: center;
         gap: 1.5rem;
         max-width: 1200px;
         margin: 0 auto;
         align-items: flex-start;
      }

      .users .box-container .box {
         background-color: var(--white);
         padding: 2rem;
         border: var(--border);
         box-shadow: var(--box-shadow);
         border-radius: .5rem;
         text-align: center;
      }

      .users .box-container .box p {
         padding-bottom: 1.5rem;
         font-size: 2rem;
         color: var(--light-color);
      }

      .users .box-container .box p span {
         color: var(--purple);
      }

      .users .box-container .box .delete-btn {
         margin-top: 0;
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


   <section class="users">

      <h1 class="title"> ACCOUNTS </h1>

      <div class="box-container container mt-4 mb-4">
         <?php
         $sql = "SELECT * FROM `userdata`" or die('query failed');
         $res = mysqli_query($connection, $sql);
         while ($fetch_users = mysqli_fetch_assoc($res)) {
         ?>
            <div class="row">
               <div style="   background-color:#fff;" class=" py-4 border border-info col-md-12 ">
                  <p> User ID : <span><?php echo $fetch_users['userid']; ?></span> </p>
                  <p> Username : <span><?php echo $fetch_users['username']; ?></span> </p>
                  <p> Email : <span><?php echo $fetch_users['useremail']; ?></span> </p>
                  <p> User Type : <span style="color:<?php if ($fetch_users['user_type'] == 'admin') {
                                                         echo 'var(--green)';
                                                      } ?>"><?php echo $fetch_users['user_type']; ?></span> </p>

                  <form action="" method="post" class="mt-2">
                     <input type="hidden" name="user_id" value="<?php echo $fetch_users['userid']; ?>">
                     <select name="update_type">
                        <option value="" selected disabled><?php echo $fetch_users['user_type']; ?></option>
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                        <option value="publisher">publisher</option>
                     </select>
                     <input type="submit" value="update" name="update_usertype" class="option-btn btn btn-success">
                     <a href="admin_users.php?delete=<?php echo $fetch_users['userid']; ?>" onclick="return confirm('delete this acoount?');" class="delete-btn btn btn-danger">Delete</a>
                  </form>
               </div>
            </div>
         <?php
         };
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