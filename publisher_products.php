<?php
session_start();
include("config.php");

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
  header('location:login.php');
}

if (isset($_POST["submitbtn"])) {
  $name = $_POST["name"];
  $category = $_POST["category"];
  $author = $_POST["author"];
  $description = $_POST["description"];
  $price = $_POST["price"];
  $imgname = $_FILES["image"]["name"];
  $productname = $_FILES["image"]["tmp_name"];
  $randomnum = rand();
  $filename = $_FILES['bookfile']['name'];
  $file_size = $_FILES['bookfile']['size'];
  $filetmpname = $_FILES['bookfile']['tmp_name'];


  $select_product_name = "SELECT name FROM `products` WHERE name = '$name'" or die('query failed');
  $res = mysqli_query($connection, $select_product_name);
  if (mysqli_num_rows($res) > 0) {
    $message[] = 'product name already added';
  } else {


    $query = "insert into products (name,category,author,description,price,imgname,p_id,filename) values ('{$name}','{$category}','{$author}','{$description}','{$price}','{$randomnum}{$imgname}','{$user_id}','{$randomnum}{$filename}');";

    mysqli_query($connection, $query);


    move_uploaded_file($productname, "files/productimg/" . $randomnum . $imgname);
    move_uploaded_file($filetmpname, "files/bookfiles/" . $randomnum . $filename);
    $message[] = 'product added successfully!';
  }
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  $delete_image_query =  "SELECT imgname FROM `products` WHERE pid = '$delete_id'" or die('query failed');
  $res = mysqli_query($connection, $delete_image_query);
  $fetch_delete_image = mysqli_fetch_assoc($res);
  unlink('files/productimg/' . $fetch_delete_image['imgname']);
  $sql = "DELETE FROM `products` WHERE pid = '$delete_id'" or die('query failed');
  $res = mysqli_query($connection, $sql);
  header('location:admin_products.php');
}

if (isset($_POST['update_product'])) {

  $update_p_id = $_POST['update_p_id'];
  $update_name = $_POST['update_name'];
  $update_category = $_POST['update_category'];
  $update_author = $_POST['update_author'];
  $update_description = $_POST['update_description'];
  $update_price = $_POST['update_price'];

  $sql1 = "UPDATE `products` SET name = '$update_name', price = '$update_price', category='$update_category',author='$update_author',description ='$update_description', WHERE pid = '$update_p_id'" or die('query failed');
  $res = mysqli_query($connection, $sql1);
  $update_image = $_FILES['update_image']['name'];
  $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
  $update_image_size = $_FILES['update_image']['size'];
  $update_folder = 'files/productimg/' . $update_image;
  $update_old_image = $_POST['update_old_image'];

  if (!empty($update_image)) {
    if ($update_image_size > 2000000) {
      $message[] = 'image file size is too large';
    } else {
      $sql = "UPDATE `products` SET imagename = '$update_image' WHERE pid = '$update_p_id'" or die('query failed');
      $res = mysqli_query($connection, $sql);

      move_uploaded_file($update_image_tmp_name, $update_folder);
      unlink('files/productimg/' . $update_old_image);
    }
  }

  header('location:admin_products.php');
}

?>


<!doctype html>
<html lang="en">

<head>
  <!-- start css of product grid  -->
  <style>

  </style>
  <!-- end css of product grid  -->
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
    @import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&display=swap');


    .container {
      max-width: 1230px;
      width: 100%;
    }

    h1 {
      font-weight: 700;
      font-size: 45px;
      font-family: 'Roboto', sans-serif;
    }

    .header {
      margin-bottom: 80px;
    }

    #description {
      font-size: 24px;
    }

    .form-wrap {
      background: rgba(255, 255, 255, 1);
      width: 100%;
      max-width: 850px;
      padding: 50px;
      margin: 0 auto;
      position: relative;
      -webkit-border-radius: 10px;
      -moz-border-radius: 10px;
      border-radius: 10px;
      -webkit-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
      -moz-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
      box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
    }

    .form-wrap:before {
      content: "";
      width: 90%;
      height: calc(100% + 60px);
      left: 0;
      right: 0;
      margin: 0 auto;
      position: absolute;
      top: -30px;
      background: #F5D71E;
      z-index: -1;
      opacity: 0.8;
      -webkit-border-radius: 10px;
      -moz-border-radius: 10px;
      border-radius: 10px;
      -webkit-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
      -moz-box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
      box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.15);
    }

    .form-group {
      margin-bottom: 25px;
    }

    .form-group>label {
      display: block;
      font-size: 18px;
      color: #000;
    }

    .custom-control-label {
      color: #000;
      font-size: 16px;
    }

    .form-control {
      height: 50px;
      background: #ecf0f4;
      border-color: transparent;
      padding: 0 15px;
      font-size: 16px;
      -webkit-transition: all 0.3s ease-in-out;
      -moz-transition: all 0.3s ease-in-out;
      -o-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out;
    }

    .form-control:focus {
      border-color: #00bcd9;
      -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
      -moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
      box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
    }

    textarea.form-control {
      height: 160px;
      padding-top: 15px;
      resize: none;
    }

    .btn {
      padding: .657rem .75rem;
      font-size: 18px;
      letter-spacing: 0.050em;
      -webkit-transition: all 0.3s ease-in-out;
      -moz-transition: all 0.3s ease-in-out;
      -o-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out;
    }

    .btn-primary {
      color: #fff;
      background-color: #00bcd9;
      border-color: #00bcd9;
    }

    .btn-primary:hover {
      color: #00bcd9;
      background-color: #ffffff;
      border-color: #00bcd9;
      -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
      -moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
      box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
    }

    .btn-primary:focus,
    .btn-primary.focus {
      color: #00bcd9;
      background-color: #ffffff;
      border-color: #00bcd9;
      -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
      -moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
      box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
    }

    .btn-primary:not(:disabled):not(.disabled):active,
    .btn-primary:not(:disabled):not(.disabled).active,
    .show>.btn-primary.dropdown-toggle {
      color: #00bcd9;
      background-color: #ffffff;
      border-color: #00bcd9;
    }

    .btn-primary:not(:disabled):not(.disabled):active:focus,
    .btn-primary:not(:disabled):not(.disabled).active:focus,
    .show>.btn-primary.dropdown-toggle:focus {
      -webkit-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
      -moz-box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
      box-shadow: 0px 0px 20px rgba(0, 0, 0, .1);
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






  <div class="container mt-5">
    <form class=" g-3 needs-validation" method="post" enctype="multipart/form-data">
      <div class="container">
        <header class="header">
          <h1 id="title" class="text-center">product Form</h1>
          <p id="description" class="text-center">
            Add your new product details here!
          </p>
        </header>
        <div class="form-wrap">
          <form id="survey-form">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label id="name-label" for="name">Book Name</label>
                  <input type="text" name="name" id="name" placeholder="Enter your book name" class="form-control" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label id="email-label" for="email">Author</label>
                  <input type="text" name="author" id="validationCustom02" placeholder="Enter author name" class="form-control" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Book Image</label>
                  <input type="file" accept="image/jpg, image/jpeg, image/png" id="dropdown" class="form-control" name="image" aria-describedby="helpId" placeholder="">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Book File</label>
                  <input type="file" accept=".pdf,.doc,.txt" id="dropdown" class="form-control" name="bookfile" aria-describedby="helpId" placeholder="">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label id="number-label" for="number">Price <small>($)</small></label>
                  <input type="number" name="price" aria-describedby="helpId" id="number" min="10" max="99" class="form-control" placeholder="Age">
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Select category of your book</label>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" value="comic" name="category" class="custom-control-input" checked="">
                    <label class="custom-control-label" for="customRadioInline1">Comic</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="category" value="novel" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Novel</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline3" name="category" value="literature" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline3">Literature</label>
                  </div>
                </div>
              </div>


            </div>


            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Description</label>
                  <textarea id="comments" class="form-control" name="description" rows="3" placeholder="Book description here..."></textarea>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <button name="submitbtn" type="submit" class="btn btn-warning btn-block">Add Product</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </form>
  </div>
  <br>
  <br>
  <!-- books from database -->
  <section class="show-products mt-5 ">

    <div class="box-container container">
      <div class="row" style="display: flex; justify-content:center;">
        <?php
        $select_products = "SELECT * FROM `products` where p_id = $user_id " or die('query failed');
        $res = mysqli_query($connection, $select_products);

        if (mysqli_num_rows($res) > 0) {
          while ($fetch_products = mysqli_fetch_assoc($res)) {
        ?>
            <div class="box col-md-3 m-3 p-4 border">

              <img style="width:100%;" src="files\productimg\<?php echo $fetch_products['imgname']; ?>" alt="this is product img">
              <div class="name">
                <p><strong><?php echo $fetch_products['name']; ?></strong> </p>
              </div>
              <div class="name">
                <p><?php echo $fetch_products['author']; ?> </p>
              </div>
              <div class="name">
                <p style="width:190px;overflow:hidden;white-space:nowrap; text-overflow:ellipsis;"><?php echo $fetch_products['description']; ?> </p>
              </div>
              <div class="name">
                <p><?php echo $fetch_products['category']; ?> </p>
              </div>
              <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
              <a href="admin_product_update.php?update=<?php echo $fetch_products['pid']; ?>" class="option-btn btn btn-warning">update</a>
              <a href="admin_products.php?delete=<?php echo $fetch_products['pid']; ?>" class="delete-btn btn btn-danger" onclick="return confirm('delete this product?');">delete</a>
            </div>

        <?php
          }
        } else {
          echo '<p class="empty">No Products Added By You</p>';
        }
        ?>
      </div>
    </div>
  </section>
  <br>
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDC3Ip9iVC0nIxC6V14CKLQ1HZNF_65qEQ"></script>
  <script src="js/map-script.js"></script>

</body>

</html>