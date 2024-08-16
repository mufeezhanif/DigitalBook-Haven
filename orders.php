<?php

include 'config.php';

session_start();

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
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
                        <h2>Placed Orders</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Orders</li>
                            </ol>
                        </nav>
                    </div> <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <section class="placed-orders mt-5">


        <div class="box-container container mt-4  ">

            <?php
            $order_query = mysqli_query($connection, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
            if (mysqli_num_rows($order_query) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($order_query)) {
            ?>
                    <div class="row mt-4">
                        <div style="   background-color:#ffff;" class=" py-4 border border-warning col-md-12">
                            <p> Placed On : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                            <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
                            <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
                            <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                            <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
                            <p> Payment Method : <span><?php echo $fetch_orders['method']; ?></span> </p>
                            <p> Your Orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                            <p> Total Price : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
                            <p> Payment Status : <span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') {
                                                                        echo 'red';
                                                                    } else {
                                                                        echo 'green';
                                                                    } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
                            <?php
                            if ($fetch_orders['payment_status'] == 'completed') {
                                // getting productFileName
                                $productid = $fetch_orders['product_id'];
                                $queryid = "select * from `products` where pid = '$productid'";
                                $resultid = mysqli_query($connection, $queryid);
                                $resultid1 = mysqli_fetch_assoc($resultid);
                                $productfilename  = $resultid1['filename'];

                                // getting productFileName end
                            ?>
                                <a href="files/bookfiles/<?php echo $productfilename; ?>" class="btn btn-info mt-2" download='<?php echo $fetch_orders['total_products']; ?>'>Download</a>
                        </div>
                    <?php
                            }
                    ?>

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