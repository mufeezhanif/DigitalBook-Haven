<?php
session_start();
include("config.php");

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
    header('location:login.php');
}
$id = $_GET["pid"];
$query = "select * from products where pid = '{$id}';";
$result = mysqli_query($connection, $query);


$row = mysqli_fetch_assoc($result);
$name = $row["name"];
$description = $row["description"];
$price = $row["price"];
$image = $row["imgname"];
$category = $row["category"];
$author = $row["author"];





if (isset($_POST["commentbtn"])) {
    $name1 = $_POST["username"];
    $email = $_POST["useremail"];
    $pdcId = $id;
    $comment = $_POST["usercomment"];

    $query0 = "insert into review (username,email,review,user_id,pid) values ('{$name1}','{$email}','{$comment}',{$user_id},{$pdcId})";
    mysqli_query($connection, $query0);
}

// add to cart


if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = "SELECT * FROM `cart` WHERE itemname = '$product_name' AND user_id = '$user_id'" or die('query failed');
    $res = mysqli_query($connection, $check_cart_numbers);
    if (mysqli_num_rows($res) > 0) {
        $message[] = 'already added to cart!';
    } else {
        $sql = "INSERT INTO `cart`(user_id, itemname, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')" or die('query failed');
        $res = mysqli_query($connection, $sql);
        $message[] = 'product added to cart!';
    }
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

    <section id="shop-singel" class="pt-120 pb-120 gray-bg">
        <div class="container">
            <div class="shop-destails">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="shop-left pt-30">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-image-1" role="tabpanel" aria-labelledby="pills-image-1-tab">
                                    <div class="shop-image">
                                        <a href="images/shop-singel/ss-1.jpg" class="shop-items"><img src="files/productimg/<?php echo $image; ?>" alt="Shop"></a>
                                    </div>
                                </div>

                            </div>

                        </div> <!-- shop left -->
                    </div>
                    <div class="col-lg-6">
                        <form action="" method="post" class="box">
                            <div class="shop-right pt-30">
                                <h6><?php echo $name ?></h6>
                                <span>$<?php echo $price ?></span>
                                <p><?php echo $description ?></p>
                                <div class="nice-number pt-15">
                                    <input type="number" min="1" name="product_quantity" value="1" class="qty">
                                </div>
                                <div class="add-btn pt-15">

                                    <input type="hidden" name="product_name" value="<?php echo $name; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $price; ?>">
                                    <input type="hidden" name="product_image" value="<?php echo $image; ?>">
                                    <button type="submit" class="main-btn" name="add_to_cart">Add to Cart</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-reviews mt-60">
                        <ul class="nav" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                            </li>
                        </ul> <!-- nav -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <div class="description-cont pt-40">
                                    <p><?php echo $description ?></p>
                                </div>
                            </div> <!-- row -->

                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="reviews-cont">
                                    <ul>
                                        <?php
                                        $query2 = "select * from review where pid = $id ";
                                        $result2 = mysqli_query($connection, $query2);

                                        if (mysqli_num_rows($result2) == 0) {
                                        ?>
                                            <p class="mt-5">No Reviews yet. Be the first to review the product.</p>
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

                                    <div class="reviews-form">
                                        <form action="#" method="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-singel">
                                                        <input type="text" name="username" required="required" required placeholder="Fast name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-singel">
                                                        <input type="email" name="useremail" required="required" required placeholder="Your email">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-singel">
                                                        <textarea placeholder="Comment" name="usercomment" required required="required"> </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-singel">
                                                        <button type="submit" class="main-btn" name="commentbtn">Post Comment</button>
                                                    </div>
                                                </div>
                                            </div> <!-- row -->
                                        </form>
                                    </div> <!-- reviews form -->
                                </div>
                            </div> <!-- row -->
                        </div> <!-- tab-content -->
                    </div> <!-- shop reviews -->
                </div>
            </div> <!-- row -->
        </div> <!-- shop-destails -->
        <div class="releted-item pt-110">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title pb-10">
                        <h3>Related products</h3>
                    </div>
                </div>
            </div> <!-- row -->
            <div class="row ">
                <?php

                $query2 = "select * from products limit 4";
                $result = mysqli_query($connection, $query2);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>

                        <div class="col-lg-3 col-md-6 col-sm-8">
                            <div class="singel-publication mt-30">
                                <div class="image">
                                    <img src="files/productimg/<?php echo $row["imgname"]; ?>" alt="Publication" width="100%">
                                    <div class="add-cart">
                                        <ul>
                                            <li><a href="shop-singel.php?id=<?php echo $row["pid"]; ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="cont">
                                    <div class="name">
                                        <a href="shop-singel.html">
                                            <h6><?php echo $row["name"]; ?></h6>
                                        </a>
                                        <span>By <?php echo $row["author"]; ?></span>
                                    </div>
                                    <div class="button text-right">
                                        <a href="shop-singel.php?pid=<?php echo $row["pid"]; ?>" class="main-btn">Buy Now ($<?php echo $row["price"] ?>)</a>
                                    </div>
                                </div>
                            </div> <!-- singel publication -->
                        </div>
                <?php }
                } ?>

            </div> <!-- row -->
        </div> <!-- releted item -->
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
    
    <script src="js/map-script.js"></script>

</body>

</html>