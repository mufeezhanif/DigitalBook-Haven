<?php
session_start();
include("config.php");

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
    header('location:login.php');
}
$query = "select * from products";
$result = mysqli_query($connection, $query);


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
    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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

    <!--====== SEARCH BOX PART START ======-->

    <div class="search-box">
        <div class="serach-form">
            <div class="closebtn">
                <span></span>
                <span></span>
            </div>
            <form action="#">
                <input type="text" placeholder="Search by keyword">
                <button><i class="fa fa-search"></i></button>
            </form>
        </div> <!-- serach form -->
    </div>

    <!--====== SEARCH BOX PART ENDS ======-->

    <!--====== PAGE BANNER PART START ======-->

    <section id="page-banner" class="pt-105 pb-130 bg_cover" data-overlay="8" style="background-image: url(images/page-banner-5.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Shop</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shop</li>
                            </ol>
                        </nav>
                    </div> <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== SHOP PART START ======-->

    <section id="shop-page" class="pt-120 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 ">
                    <h1>Our Products</h1>
                </div>
                <div class="col-lg-6 " style="display:flex; justify-content:right; ">
                    <input type="text" class="search form-control" placeholder="search your desired book from here">
                </div>
            </div> <!-- row -->
            <script>
                $(document).ready(function() {

                    $('.search').keyup(function() {
                        searchinput = $('.search').val()

                        $.ajax({
                            url: "search.php",
                            type: "POST",
                            data: {
                                search: searchinput
                            },
                            success: function(result) {
                                // console.log(result)
                                mydata = JSON.parse(result)
                                table = document.querySelector(".pparent");
                                table.innerHTML = ""

                                for (i = 0; i < mydata.length; i++) {
                                    table.innerHTML += `
                <div class="col-lg-3 col-md-6 col-sm-8">
                                    <div class="singel-publication mt-30">
                                        <div class="image">
                                            <img src="files/productimg/${mydata[i]["imgname"]}" alt="Publication" width="130" height="240">
                                            <div class="add-cart">
                                                <ul>
                                                    <li><a href="shop-singel.php?pid=${mydata[i]["pid"]}"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cont">
                                            <div class="name">
                                                <a href="shop-singel.html?pid=${mydata[i]["pid"]}">
                                                    <h6>${mydata[i]["name"]}</h6>
                                                </a>
                                                <span>$${mydata[i]["price"]}</span>
                                            </div>
                                            <div class="button text-right">
                                                <a href="shop-singel.php?pid=${mydata[i]["pid"]}" class="main-btn">Buy Now</a>
                                            </div>
                                        </div>
                                    </div> <!-- singel publication -->
                                </div>
                `
                                }

                            }
                        })

                    })
                })
            </script>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="shop-grid" role="tabpanel" aria-labelledby="shop-grid-tab">
                    <div class="row pparent">
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <div class="col-lg-3 col-md-6 col-sm-8">
                                    <div class="singel-publication mt-30">
                                        <div class="image">
                                            <img src="files/productimg/<?php echo $row["imgname"]; ?>" alt="Publication" width="130" height="240">
                                            <div class="add-cart">
                                                <ul>
                                                    <li><a href="shop-singel.php?pid=<?php echo $row["pid"] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="cont">
                                            <div class="name">
                                                <a href="shop-singel.html?pid=<?php echo $row["pid"] ?>">
                                                    <h6><?php echo $row["name"]; ?></h6>
                                                </a>
                                                <span>$<?php echo $row["price"] ?></span>
                                            </div>
                                            <div class="button text-right">
                                                <a href="shop-singel.php?pid=<?php echo $row["pid"] ?>" class="main-btn">Buy Now</a>
                                            </div>
                                        </div>
                                    </div> <!-- singel publication -->
                                </div>
                        <?php  }
                        }
                        ?>

                    </div> <!-- row -->
                </div>

            </div> <!-- container -->
    </section>

    <!--====== COURSES PART ENDS ======-->

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