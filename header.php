<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .message {
        position: sticky;
        top: 0;
        margin: 0 auto;
        max-width: 1200px;
        background-color: #37526F;
        padding: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 10000;
        gap: 0.5rem;
    }

    .message span {
        font-size: 1rem;
        color: var(--white);
    }

    .message i {
        cursor: pointer;
        color: var(--red);
        font-size: 1.5rem;
    }

    .message i:hover {
        transform: rotate(90deg);
    }
</style>

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
    }
}

?>
<!-- for user -->
<?php
if (isset($_SESSION["user_type"])) {
    if ($_SESSION["user_type"] == 'user') {
?>
        <header id="header-part">

            <!-- header top -->

            <div class="header-logo-support pt-30 pb-30">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="logo">
                                <a href="index.php">
                                    <img src="images/logo2.png" alt="Logo">
                                </a>
                            </div>
                        </div>
                        <!-- login signup button -->
                        <?php
                        if (isset($_SESSION["id"])) {
                        ?>

                            <div class="col-lg-8 col-md-8">
                                <div class="support-button float-right d-none d-md-block">
                                    <div class="button float-left">
                                        <a href="index.php" class="main-btn"><?php echo $_SESSION["name"]; ?></a>
                                    </div>
                                    <div class="button float-left">
                                        <a href="logout.php" class="main-btn">Log out</a>
                                    </div>
                                </div>
                            </div>

                        <?php }
                        ?>
                    </div> <!-- row -->
                </div>
            </div> <!-- container -->
            </div> <!-- header logo support -->

            <div class="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                            <nav class="navbar navbar-expand-lg">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>

                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item">
                                            <a class="active" href="index.php">Home</a>

                                        <li class="nav-item">
                                            <a href="about.php">About us</a>
                                        </li>


                                        <li class="nav-item">
                                            <a href="shop.php">Shop</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="orders.php">Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="contact.php">Contact</a>

                                        </li>
                                        <li class="nav-item">
                                            <a href="compform.php">Participate in Competition</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav> <!-- nav -->
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                            <div class="right-icon text-right">
                                <ul>
                                    <?php
                                    $select_cart_number = mysqli_query($connection, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                                    $cart_rows_number = mysqli_num_rows($select_cart_number);
                                    ?>
                                    <li><a href="cart.php"><i class="fa fa-shopping-bag"></i><span>(<?php echo $cart_rows_number; ?>)</span></a></li>
                                </ul>
                            </div> <!-- right icon -->
                        </div>
                    </div> <!-- row -->
                </div> <!-- container -->
            </div>

        </header>

        <!-- for admin -->
    <?php
    }
}
if (isset($_SESSION["user_type"])) {
    if ($_SESSION["user_type"] == 'admin') {
    ?>
        <header id="header-part">

            <!-- header top -->

            <div class="header-logo-support pt-30 pb-30">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="logo">
                                <a href="index.php">
                                    <img src="images/logo2.png" alt="Logo">
                                </a>
                            </div>
                        </div>
                        <!-- login signup button -->
                        <?php
                        if (isset($_SESSION["id"])) {
                        ?>

                            <div class="col-lg-8 col-md-8">
                                <div class="support-button float-right d-none d-md-block">
                                    <div class="button float-left">
                                        <a href="index.php" class="main-btn"><?php echo $_SESSION["name"]; ?></a>
                                    </div>
                                    <div class="button float-left">
                                        <a href="logout.php" class="main-btn">Log out</a>
                                    </div>
                                </div>
                            </div>

                        <?php }
                        ?>
                    </div> <!-- row -->

                </div>
            </div> <!-- container -->
            </div> <!-- header logo support -->

            <div class="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                            <nav class="navbar navbar-expand-lg">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>

                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item">
                                            <a class="active" href="admin_dashboard.php">Dashboard</a>
                                        <li class="nav-item">
                                            <a href="admin_products.php">Products</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="admin_orders.php">Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="admin_users.php">Users</a>

                                        </li>
                                        <li class="nav-item">
                                            <a href="compfiles.php">Comp Submissions</a>

                                        </li>
                                    </ul>
                                </div>
                            </nav> <!-- nav -->
                        </div>

                    </div> <!-- row -->
                </div> <!-- container -->
            </div>

        </header>

        <!-- for publisher -->
    <?php
    }
}
if (isset($_SESSION["user_type"])) {
    if ($_SESSION["user_type"] == 'publisher') {
    ?>
        <header id="header-part">

            <!-- header top -->

            <div class="header-logo-support pt-30 pb-30">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="logo">
                                <a href="index.php">
                                    <img src="images/logo2.png" alt="Logo">
                                </a>
                            </div>
                        </div>
                        <!-- login signup button -->
                        <?php
                        if (isset($_SESSION["id"])) {
                        ?>

                            <div class="col-lg-8 col-md-8">
                                <div class="support-button float-right d-none d-md-block">
                                    <div class="button float-left">
                                        <a href="index.php" class="main-btn"><?php echo $_SESSION["name"]; ?></a>
                                    </div>
                                    <div class="button float-left">
                                        <a href="logout.php" class="main-btn">Log out</a>
                                    </div>
                                </div>
                            </div>

                        <?php } else {
                        ?> <!-- row -->
                            <div class="col-lg-8 col-md-8">
                                <div class="support-button float-right d-none d-md-block">
                                    <div class="button float-left">
                                        <a href="signup.php" class="main-btn">Sign Up</a>
                                    </div>

                                    <div class="float-left">
                                        <a href="#" class="main-btn" style="background-color: white;border:none;">or</a>
                                    </div>
                                    <div class="button float-left">
                                        <a href="login.php" class="main-btn" style="margin-left: -69px;">Log in</a>
                                    </div>
                                </div>
                            </div>
                    </div> <!-- row -->
                <?php } ?>
                </div>
            </div> <!-- container -->
            </div> <!-- header logo support -->

            <div class="navigation">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                            <nav class="navbar navbar-expand-lg">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>

                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item">
                                            <a class="active" href="publisher_dashboard.php">Dashboard</a>

                                        <li class="nav-item">
                                            <a href="publisher_products.php">Products</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="publisher_reviews.php">Reviews</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="compfiles.php">Competition files</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav> <!-- nav -->
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                            <div class="right-icon text-right">

                            </div> <!-- right icon -->
                        </div>
                    </div> <!-- row -->
                </div> <!-- container -->
            </div>

        </header>
    <?php
    }
} else {
    ?>

    <header id="header-part">

        <!-- header top -->

        <div class="header-logo-support pt-30 pb-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="logo">
                            <a href="index.php">
                                <img src="images/logo2.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <!-- login signup button -->
                    <?php
                    if (isset($_SESSION["id"])) {
                    ?>

                        <div class="col-lg-8 col-md-8">
                            <div class="support-button float-right d-none d-md-block">
                                <div class="button float-left">
                                    <a href="index.php" class="main-btn"><?php echo $_SESSION["name"]; ?></a>
                                </div>
                                <div class="button float-left">
                                    <a href="logout.php" class="main-btn">Log out</a>
                                </div>
                            </div>
                        </div>

                    <?php } else {
                    ?> <!-- row -->
                        <div class="col-lg-8 col-md-8">
                            <div class="support-button float-right d-none d-md-block">
                                <div class="button float-left">
                                    <a href="signup.php" class="main-btn">Sign Up</a>
                                </div>

                                <div class="float-left">
                                    <a href="#" class="main-btn" style="background-color: white;border:none;">or</a>
                                </div>
                                <div class="button float-left">
                                    <a href="login.php" class="main-btn" style="margin-left: -69px;">Log in</a>
                                </div>
                            </div>
                        </div>
                </div> <!-- row -->
            <?php } ?>
            </div>
        </div> <!-- container -->
        </div> <!-- header logo support -->

        <div class="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class="active" href="index.php">Home</a>

                                    <li class="nav-item">
                                        <a href="about.php">About us</a>
                                    </li>


                                    <li class="nav-item">
                                        <a href="shop.php">Shop</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="orders.php">Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="contact.php">Contact</a>

                                    </li>
                                    <li class="nav-item">
                                        <a href="compform.php">Participate in Competition</a>
                                    </li>
                                </ul>
                            </div>
                        </nav> <!-- nav -->
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                        <div class="right-icon text-right">
                            <ul>
                                <li><a href="cart.php"><i class="fa fa-shopping-bag"></i><span>0</span></a></li>
                            </ul>
                        </div> <!-- right icon -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div>

    </header>
<?php
}
?>