<?php
session_start();
require('dbconnect.inc');

$pid = $_GET["pid"];

$querysingle = mysqli_query($con_srv, "SELECT p_id, p_name, p_image, p_image1, p_image2, p_image3, p_color, p_price, sale_price, tag, weight, total_review, p_availability, p_description, c_name, bdu_product.c_id FROM bdu_product, bdu_category WHERE bdu_product.c_id = bdu_category.c_id AND p_availability='In Store' AND p_id='" . $pid . "'");

$product_num_rows = mysqli_num_rows($querysingle);

$row = mysqli_fetch_array($querysingle);
//$_SESSION['c_id'] = $row['c_id'];

//echo $_SESSION['c_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Single Product</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="OneTech shop project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="styles/product_styles.css">
	<link rel="stylesheet" type="text/css" href="styles/product_responsive.css">

</head>

<body>

	<div class="super_container">

		<!-- Header -->
		<?php include_once('header-menu.php'); ?>

		<!-- Single Product -->

		<div class="single_product">
			<div class="container">
				<div class="row">

					<!-- Images -->
					<div class="col-lg-2 order-lg-1 order-2">
						<ul class="image_list">
							<li data-image="<?php echo "images/singleproduct/" . $row['p_image1']; ?>"><?php echo "<img src=\"images/singleproduct/" . $row['p_image1'] . "\">"; ?></li>
							<li data-image="<?php echo "images/singleproduct/" . $row['p_image2']; ?>"><?php echo "<img src=\"images/singleproduct/" . $row['p_image2'] . "\">"; ?></li>
							<li data-image="<?php echo "images/singleproduct/" . $row['p_image3']; ?>"><?php echo "<img src=\"images/singleproduct/" . $row['p_image3'] . "\">"; ?></li>

						</ul>
					</div>

					<!-- Selected Image -->
					<div class="col-lg-5 order-lg-2 order-1">
						<div class="image_selected"><?php echo "<img src=\"images/singleproduct/" . $row['p_image'] . " \" >"; ?></div>
					</div>

					<!-- Description -->
					<div class="col-lg-5 order-3">
						<div class="product_description">
							<div class="product_category"><a class="clc" href="category.php?category=<?php echo $row['c_id']; ?>"><?php echo $row['c_name']; ?></a></div>
							<div class="product_name"><?php echo $row['p_name']; ?></div>
							<div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
							<div class="product_text">
								<p><?php echo $row['p_description']; ?></p>
							</div>
							<div class="order_info d-flex flex-row">
								<form action="#">
									<div class="clearfix" style="z-index: 1000;">

										<!-- Product Quantity -->
										<div class="product_quantity clearfix">
											<span>Quantity: </span>
											<input id="quantity_input" name="quantity" type="text" pattern="[0-9]*" value="1">
											<div class="quantity_buttons">
												<div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
												<div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
											</div>
										</div>

										<!-- Product Color -->
										<ul class="product_color">
											<li>
												<span>Color: </span>
												<div class="color_mark_container">
													<div id="selected_color" class="color_mark"></div>
												</div>
												<div class="color_dropdown_button"><i class="fas fa-chevron-down"></i></div>

												<ul class="color_list">
													<li>
														<div class="color_mark" style="background: #999999;"></div>
													</li>
													<li>
														<div class="color_mark" style="background: #b19c83;"></div>
													</li>
													<li>
														<div class="color_mark" style="background: #000000;"></div>
													</li>
												</ul>
											</li>
										</ul>

									</div>

									<div class="product_price">$<?php echo $row['sale_price']; ?></div>
									<div class="button_container">
										<button type="button" class="button cart_button"><a href="cart-added.php?pid=<?php echo $pid ?>"> Add to Cart</a></button>
										<div class="product_fav"><i class="fas fa-heart"></i></div>
									</div>

								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- Related Product -->

		<div class="viewed">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="viewed_title_container">
							<h3 class="viewed_title">Related Products</h3>
							<div class="viewed_nav_container">
								<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
								<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
							</div>
						</div>

						<div class="viewed_slider_container">

							<!-- Related Product Slider -->

							<div class="owl-carousel owl-theme viewed_slider">

								<!-- Related Product Item -->
								<?php
								include_once 'dbconnect.inc';
								$selected = $db_selected;
								$query22 = mysqli_query($con_srv, "SELECT p_id, p_name, p_image, p_image1, p_image2, p_image3, p_color, p_price, sale_price, tag, weight, total_review, p_availability, p_description, c_name, bdu_product.c_id FROM bdu_product, bdu_category WHERE bdu_product.c_id = bdu_category.c_id AND bdu_product.c_id='" . $row['c_id'] . "'");
								$num_rows = mysqli_num_rows($query22);
								while ($row1 = mysqli_fetch_array($query22)) {
								?>
									<div class="viewed_item d-flex flex-column align-items-center justify-content-center text-center">
										<div class="viewed_image"><?php echo "<img src=\"images/products/" . $row1['p_image'] . "\" >"; ?></div>
										<div class="viewed_content text-center">
											<div class="viewed_price">$<?php echo $row1['sale_price']; ?></div>
											<div class="viewed_name"><a href="#"><?php echo $row1['p_name']; ?></a></div>
										</div>
										<ul class="item_marks">
											<li class="item_mark item_discount">-25%</li>
											<li class="item_mark item_new">new</li>
										</ul>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Brands -->
	<?php include_once('brand.php'); ?>
	<!-- Newsletter -->
	<?php include_once('subscribe.php'); ?>
	<!-- Footer -->
	<?php include_once('footer.php'); ?>
	<!-- Copyright -->
	<?php include_once('copyright.php'); ?>

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="styles/bootstrap4/popper.js"></script>
	<script src="styles/bootstrap4/bootstrap.min.js"></script>
	<script src="plugins/greensock/TweenMax.min.js"></script>
	<script src="plugins/greensock/TimelineMax.min.js"></script>
	<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
	<script src="plugins/greensock/animation.gsap.min.js"></script>
	<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
	<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<script src="plugins/easing/easing.js"></script>
	<script src="js/product_custom.js"></script>
</body>

</html>