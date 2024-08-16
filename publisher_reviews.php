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

    <div class="container" id="reviews">
        <div class="reviews-cont">
            <ul>
                <?php
                $query2 = "select * from products where p_id = $publisher_id ";
                $result = mysqli_query($connection, $query2);
                $result3 = mysqli_fetch_assoc($result);
                $productid= $result3['pid'];
                $query3= "select * from review where pid = $productid ";
                $result2 = mysqli_query($connection, $query3);
                
                if (mysqli_num_rows($result2) == 0) {
                ?>
                    <p class="m-5">No Reviews yet.</p>
                    <?php
                } else {
                    while ($row2 = mysqli_fetch_assoc($result2)) {

                    ?>
                        <li>
                            <div class="singel-reviews">
                                <div class="reviews-author">
                                    <div class="author-thum">
                                        <img src="images/usericon.png" width="53px" height="53px" alt="Reviews">
                                    </div>
                                    <div class="author-name">
                                        <h6><?php echo $row2['username'] ?></h6>

                                    </div>
                                </div>
                                <div class="reviews-description pt-20">
                                    <p><?php echo $row2['review'] ?></p>

                                </div>
                            </div> <!-- singel reviews -->
                        </li>
                <?php
                    }
                }
                ?>

            </ul>


        </div>
    </div>

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