<?php
session_start();
include("config.php");


if (isset($_POST["submitbtn"])) {

    $username = $_POST["name"];
    $email = $_POST["email"];

    $sql = "SELECT * FROM userdata WHERE useremail = '{$email}'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('User Already Exists, Please change your email address')</script>";
    } else {
        $username = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $gender = $_POST["gender"];
        $phone = $_POST["phone"];
        $type = $_POST["user_type"];


        $query = "insert into userdata (username,useremail,userpassword,gender,usercontact,user_type) values ('{$username}','{$email}','{$password}','{$gender}','{$phone}','{$type}')";

        mysqli_query($connection, $query);

        $query1 = "select * from userdata where useremail = '{$email}'";
        $result1 = mysqli_query($connection, $query1);
        $rowcount = mysqli_num_rows($result1);
        $result2 = mysqli_fetch_assoc($result1);

        if ($rowcount > 0) {
            $_SESSION["id"] = $result2["userid"];
            $_SESSION["name"] = $result2["username"];
            $_SESSION["email"] = $result2["useremail"];
            $_SESSION["user_type"] = $result2["user_type"];

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
   <h1 style='margin-top: 0; color: #1E90FF;'>Welcome to our website!</h1>
   <p>Thank you for signing up!</p>
   <p>Your account has been successfully created. You can now enjoy the benefits of being a member.</p>
   <h2 style='margin-top: 0; color: #1E90FF;'>Account Details</h2>
   <p>Username: <strong>$username</strong></p>
   <p>Email: <strong>$email</strong></p>
   <p>Password: <strong>$password</strong></p><p>If you have any questions or concerns, please contact us at <a style='color: #1E90FF' href='mailto:example@example.com'>suport@ebooks.com</a>.</p>
 </div>";

            $mail->AltBody = "This is the plain text version of the email content";
            $mail->send();




            header("location:index.php");
        }
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
                        <h2>SIGN UP</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
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
                            <h4>Create Your Account</h4>
                        </div> <!-- section title -->
                        <div class="main-form pt-45">
                            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" data-toggle="validator">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <input name="name" type="text" placeholder="Full Name" data-error="Name is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- singel form -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <select name="gender" id="" class="w-100">
                                                <option value="Select Your Gender">
                                                    < ------- Select Your Gender ------->
                                                </option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Rather Not Say">Rather Not Say</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- singel form -->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="singel-form form-group">
                                            <input name="email" type="email" placeholder="Your Email" data-error="Email is required." required="required">
                                            <!-- usertype -->
                                            <input name="user_type" type="hidden" value="user" data-error="Email is required." required required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- singel form -->

                                    </div>
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <input name="password" type="password" placeholder="Password" data-error="Password is required." required="required">
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
                                        <!-- Sign Up Link -->
                                        <div class="singel-form form-group">
                                            <label class="form-label" for="form1Example23">Already have an account?
                                                <a href="login.php">Login</a></label>
                                        </div> <!-- singel form -->
                                    </div>
                                    <p class="form-message"></p>
                                    <div class="col-md-12">
                                        <div class="singel-form">
                                            <button type="submit" name="submitbtn" class="main-btn">SUBMIT</button>
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