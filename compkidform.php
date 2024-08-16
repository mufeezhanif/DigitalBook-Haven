<?php

include 'config.php';

session_start();

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST["submitbtn"])) {

    $username = $_POST["name"];
    $email = $_POST["email"];


    $sql = "SELECT * FROM compkids WHERE username = '{$username}' or email = '{$email}'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        $message[] = 'Essay already added';
    } else {
        $username = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $topic = $_POST["topicname"];
        $randomnum = rand();
        $filename = $_FILES['userfile']['name'];
        $file_size = $_FILES['userfile']['size'];
        $filetmpname = $_FILES['userfile']['tmp_name'];

        $query = "INSERT INTO compkids (username,email,contact,topicname,`filename`,user_id) VALUES ('{$username}','{$email}','{$phone}','{$topic}','{$randomnum}{$filename}','{$user_id}')";

        mysqli_query($connection, $query);
        move_uploaded_file($filetmpname, "files/competitionfiles/" . $randomnum . $filename);
        $message[] = 'Essay submitted successfully!';
    }
};



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

    <!--====== HEADER PART ENDS ======-->

    <!--====== PAGE BANNER PART START ======-->

    <section id="page-banner" class="pt-105 pb-130 bg_cover" data-overlay="8" style="background-image: url(images/page-banner-6.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Registration</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Kids Essay Competition Registration</li>
                            </ol>
                        </nav>
                    </div> <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== CONTACT PART START ======-->

    <section id="contact-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="contact-from mt-30">
                        <div class="section-title">
                            <!-- data in form -->

                            <h5>REGISTER</h5>
                            <div class="exists"></div>
                            <br>
                            <h4>Participate To Compete Against Peers</h4>
                        </div> <!-- section title -->
                        <div class="main-form pt-45">
                            <form action="" method="post" data-toggle="validator" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="singel-form form-group">
                                            <input name="name" type="text" placeholder="Full Name" data-error="Name is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- singel form -->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="singel-form form-group">
                                            <input name="email" type="email" placeholder="Your Email" data-error="Email is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- singel form -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <input name="phone" type="text" placeholder="Phone" data-error="Phone is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- singel form -->
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <input name="topicname" type="text" placeholder="Topic" data-error="Topic is Required" required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- singel form -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <input name="userfile" type="file" accept=".pdf,.doc,.txt" placeholder="Upload Your File Here" data-error="Uploading Your File Is Neccesary" required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- singel form -->
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Sign Up Link -->
                                        <div class="singel-form form-group">
                                            <label class="form-label" for="form1Example23">Are You an Adult? Want to take part in Story Writing  competition?
                                                <a href="compform.php">Click Here</a></label>
                                        </div>
                                        <!-- singel form -->
                                    </div>
                                    <p class="form-message"></p>
                                    <div class="col-md-12">
                                        <div class="singel-form">
                                            <button type="submit" name="submitbtn" class="main-btn">Register</button>
                                        </div> <!-- singel form -->
                                    </div>
                                </div> <!-- row -->
                            </form>
                        </div> <!-- main form -->
                    </div> <!--  contact from -->
                </div>
                <div class="col-lg-5">
                    <div class="contact-address mt-30">
                        <ul>
                            <li>
                                <div class="singel-address">
                                    <div class="icon">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="cont">
                                        <p>Aptech North Nazimabad Karachi Pakistan</p>
                                    </div>
                                </div> <!-- singel address -->
                            </li>
                            <li>
                                <div class="singel-address">
                                    <div class="icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="cont">
                                        <p>+3 123 456 789</p>
                                        <p>+1 222 345 342</p>
                                    </div>
                                </div> <!-- singel address -->
                            </li>
                            <li>
                                <div class="singel-address">
                                    <div class="icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="cont">
                                        <p>info@yourmail.com</p>
                                        <p>info@yourmail.com</p>
                                    </div>
                                </div> <!-- singel address -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== CONTACT PART ENDS ======-->

    <!--====== FOOTER PART START ======-->

    <?php
    include "footer.php"
    ?>

    <!--====== FOOTER PART ENDS ======-->

    <!--====== BACK TO TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!--====== BACK TO TOP PART ENDS ======-->







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