<?php
session_start();
include("config.php");

$user_id = $_SESSION['id'];

if (!isset($user_id)) {
	header('location:login.php');
}


if (isset($_POST['update_product'])) {

	$update_p_id = $_POST['update_p_id'];
	$update_name = $_POST['update_name'];
	$update_category = $_POST['update_category'];
	$update_author = $_POST['update_author'];
	$update_description = $_POST['update_description'];
	$update_price = $_POST['update_price'];

	$sql1 = "UPDATE `products` SET name = '$update_name', price = '$update_price', category='$update_category',author='$update_author',description ='$update_description' WHERE pid = '$update_p_id'" or die('query failed');
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
			$sql = "UPDATE `products` SET imgname = '$update_image' WHERE pid = '$update_p_id'" or die('query failed');
			$res = mysqli_query($connection, $sql);

			move_uploaded_file($update_image_tmp_name, $update_folder);
			unlink('files/productimg/' . $update_old_image);
		}
	}

	$update_file = $_FILES['update_file']['name'];
	$update_file_tmp_name = $_FILES['update_file']['tmp_name'];
	$update_file_size = $_FILES['update_file']['size'];
	$update_folderf = 'files/bookfiles/' . $update_file;
	$update_old_file = $_POST['update_old_file'];

	if (!empty($update_file)) {
		if ($update_image_file > 10000000) {
			$message[] = 'image file size is too large';
		} else {
			$sql = "UPDATE `products` SET filename = '$update_file' WHERE pid = '$update_p_id'" or die('query failed');
			$res = mysqli_query($connection, $sql);

			move_uploaded_file($update_file_tmp_name, $update_folderf);
			unlink('files/bookfiles/' . $update_old_file);
		}
	}

	header('location:admin_products.php');
}

?>

<!doctype html>
<html lang="en">

<head>
	<title>Title</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS v5.2.1 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">



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



	<section class="edit-product-form">

		<?php
		if (isset($_GET['update'])) {
			$update_id = $_GET['update'];
			$update_query = "SELECT * FROM `products` WHERE pid = '$update_id'" or die('query failed');
			$res = mysqli_query($connection, $update_query);
			if (mysqli_num_rows($res) > 0) {
				while ($fetch_update = mysqli_fetch_assoc($res)) {
		?>
					<div class="container mt-5">
						<form class=" g-3 needs-validation" method="post" enctype="multipart/form-data">
							<div class="container">
								<header class="header">
									<h1 id="title" class="text-center">Update product Form</h1>
									<p id="description" class="text-center">
										Add your new product details here!
									</p>
								</header>

								<div class="form-wrap">
									<form id="survey-form" action="" method="post" enctype="multipart/form-data">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">

													<input type="hidden" name="update_p_id" value="<?php echo $fetch_update['pid']; ?>">
													<input type="hidden" name="update_old_image" value="<?php echo $fetch_update['imgname']; ?>">
													<input type="hidden" name="update_old_file" value="<?php echo $fetch_update['filename']; ?>">
													<label id="name-label" for="name">Book Name</label>
													<input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="form-control box" required placeholder="enter product name">

												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label id="email-label" for="email">Author</label>
													<input type="text" name="update_author" value="<?php echo $fetch_update['author']; ?>" class=" form-control box" required placeholder="enter product name">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Book Image</label>
													<input type="file" class="form-control box" name="update_image" accept="image/jpg, image/jpeg, image/png">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Book File</label>
													<input type="file" class="form-control box" name="update_file" accept=".pdf,.doc,.txt">
												</div>
											</div>


											<div class="col-md-6">
												<div class="form-group">
													<label id="number-label" for="number">Price <small>($)</small></label>
													<input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="form-control box" required placeholder="enter product price">
												</div>
											</div>

										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Select category of your book</label>
													<div class="custom-control custom-radio custom-control-inline">
														<input type="text" name="update_category" value="<?php echo $fetch_update['category']; ?>" class="box form-control" required placeholder="enter product name">

													</div>


												</div>
											</div>


										</div>


										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Description</label>
													<input type="text" name="update_description" value="<?php echo $fetch_update['description']; ?>" class="box form-control" required placeholder="enter product name">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<input type="submit" value="update" name="update_product" class="btn btn btn-success">
												<a href="admin_products.php" class="option-btn btn btn-danger">Cancel</a>
											</div>
										</div>

									</form>
								</div>

							</div>



				<?php
				}
			}
		} else {
			echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
		}
				?>

	</section>



	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
	</script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
	</script>
</body>

</html>