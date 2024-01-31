<?php
session_start();
include_once('dbconnect.inc');
error_reporting();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>OneTech</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="OneTech shop project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="plugins/slick-1.8.0/slick.css">
	<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
	<link rel="stylesheet" type="text/css" href="styles/responsive.css">

</head>

<body>
	<div class="super_container">
		<!-- Header -->
		<?php include_once('header-menu.php'); ?>
		<!-- Banner -->
		<div class="banner">
			<div class="banner_background" style="background-image:url(images/banner_background.jpg)"></div>
			<div class="container fill_height">
				<div class="row fill_height">
					<div class="banner_product_image"><a href="singleproduct.php?pid=9"><img src="images/banner_product.png" alt=""></a></div>
					<div class="col-lg-5 offset-lg-4 fill_height">
						<div class="banner_content">
							<h1 class="banner_text">new era of smartphones</h1>
							<div class="banner_price"><span>$500</span>$450</div>
							<div class="banner_product_name"><a href="singleproduct.php?pid=9">Apple Iphone 6s</a></div>
							<div class="button banner_button"><a href="singleproduct.php?pid=9">Shop Now</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Characteristics -->
		<div class="characteristics">
			<div class="container">
				<div class="row">
					<!-- Char. Item -->
					<div class="col-lg-3 col-md-6 char_col">
						<div class="char_item d-flex flex-row align-items-center justify-content-start">
							<div class="char_icon"><img src="images/char_1.png" alt=""></div>
							<div class="char_content">
								<div class="char_title">Free Delivery</div>
								<div class="char_subtitle">from $50</div>
							</div>
						</div>
					</div>
					<!-- Char. Item -->
					<div class="col-lg-3 col-md-6 char_col">
						<div class="char_item d-flex flex-row align-items-center justify-content-start">
							<div class="char_icon"><img src="images/char_2.png" alt=""></div>
							<div class="char_content">
								<div class="char_title">Free Delivery</div>
								<div class="char_subtitle">from $50</div>
							</div>
						</div>
					</div>
					<!-- Char. Item -->
					<div class="col-lg-3 col-md-6 char_col" <div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="images/char_3.png" alt=""></div>
						<div class="char_content">
							<div class="char_title">Free Delivery</div>
							<div class="char_subtitle">from $50</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Deals of the week -->
	<div class="deals_featured">
		<div class="container">
			<div class="row">
				<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">
					<!-- Deals -->
					<div class="deals">
						<div id="deals_titlee">Deals of the Week</div>
						<div class="deals_slider_container">
							<!-- Deals Slider -->
							<div class="owl-carousel owl-theme deals_slider">
								<!-- Deals Item -->
								<?php
								include_once 'dbselect.inc';
								$selected = $db_selected;
								$num_rows = mysqli_num_rows($query1);
								while ($row = mysqli_fetch_array($query1)) {
									$pid = $row['p_id'];
									$pname = $row['p_name'];
									$pimage = $row['p_image'];
									$pprice = $row['p_price'];
									$saleprice = $row['sale_price'];
									$p_availability = $row['p_availability'];
									$p_description = $row['p_description'];
									$c_id = $row['c_id'];
									$cname = $row['c_name'];
								?>
									<div class="owl-item deals_item">
										<div class="deals_image"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo "<img src=\"images/singleproduct/" . $pimage . "\" >"; ?> </a></div>
										<div class="deals_content">
											<div class="deals_info_line d-flex flex-row justify-content-start">
												<div class="deals_item_category"><a href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo $pname ?></a></div>
												<div class="deals_item_price_a ml-auto"><?php echo "price = $$pprice" ?></div>
											</div>
											<div class="deals_info_line d-flex flex-row justify-content-start">
												<div class="deals_item_name"><a class="clc" href="category.php?category=<?php echo $c_id; ?>"><?php echo $cname; ?></a></div>
												<div class="deals_item_price ml-auto"><?php echo "$$saleprice sold" ?></div>
											</div>
											<div class="available">
												<div class="available_line d-flex flex-row justify-content-start">
													<div class="available_title">Available: <span><?php echo $p_availability ?></span></div>
													<div class="sold_title ml-auto">Already sold: <span>28</span></div>
												</div>
												<div class="available_bar"><span style="width:17%"></span></div>
											</div>
											<div class="deals_timer d-flex flex-row align-items-center justify-content-start">
												<div class="deals_timer_title_container">
													<div class="deals_timer_title">Hurry Up</div>
													<div class="deals_timer_subtitle">Offer ends in:</div>
												</div>
												<div class="deals_timer_content ml-auto">
													<div class="deals_timer_box clearfix" data-target-time="">
														<div class="deals_timer_unit">
															<div id="deals_timer1_hr" class="deals_timer_hr"></div>
															<span>hours</span>
														</div>
														<div class="deals_timer_unit">
															<div id="deals_timer1_min" class="deals_timer_min"></div>
															<span>mins</span>
														</div>
														<div class="deals_timer_unit">
															<div id="deals_timer1_sec" class="deals_timer_sec"></div>
															<span>secs</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
						<div class="deals_slider_nav_container">
							<div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
							<div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
						</div>
					</div>
					<!-- Featured -->
					<div class="featured">
						<div class="tabbed_container">
							<div class="tabs">
								<ul class="clearfix">
									<li class="active">Featured</li>
									<li>On Sale</li>
									<li>Best Rated</li>
								</ul>
								<div class="tabs_line"><span></span></div>
							</div>
							<!-- Product Panel -->
							<div class="product_panel panel active">
								<div class="featured_slider slider">
									<!-- Slider Item -->
									<?php
									include_once 'dbselect.inc';
									$selected = $db_selected;
									$num_rows = mysqli_num_rows($queryFeatured);
									while ($row = mysqli_fetch_array($queryFeatured)) {
										$pid = $row['p_id'];
										$pname = $row['p_name'];
										$pimage = $row['p_image'];
										$pprice = $row['p_price'];
										$saleprice = $row['sale_price'];
										$p_availability = $row['p_availability'];
										$pstatus = $row['p_status'];
										$c_id = $row['c_id'];
									?>
										<div class="featured_slider_item">
											<div class="border_active"></div>
											<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo "<img src=\"images/singleproduct/" . $pimage . "\" >"; ?> </a></div>
												<div class="product_content">
													<div class="product_price discount"><?php echo "$$saleprice"; ?><span><?php echo "$$pprice"; ?></span></div>
													<div class="product_name">
														<div><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo $pname; ?></a></div>
													</div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button"><a href="singleproduct.php?pid=<?php echo $pid; ?>">Explore</a></button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount">-25%</li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>
									<?php } ?>
								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>
							<!-- Product Panel -->
							<div class="product_panel panel active">
								<div class="featured_slider slider">
									<!-- Slider Item -->
									<?php
									include_once 'dbselect.inc';
									$selected = $db_selected;
									$num_rows = mysqli_num_rows($queryOnSale);
									while ($row = mysqli_fetch_array($queryOnSale)) {
										$pid = $row['p_id'];
										$pname = $row['p_name'];
										$pimage = $row['p_image'];
										$pprice = $row['p_price'];
										$saleprice = $row['sale_price'];
										$p_availability = $row['p_availability'];
										$pstatus = $row['p_status'];
										$c_id = $row['c_id'];
									?>
										<div class="featured_slider_item">
											<div class="border_active"></div>
											<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo "<img src=\"images/singleproduct/" . $pimage . "\" >"; ?> </a></div>
												<div class="product_content">
													<div class="product_price discount"><?php echo "$$saleprice"; ?><span><?php echo "$$pprice"; ?></span></div>
													<div class="product_name">
														<div><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo $pname; ?></a></div>
													</div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button"><a href="singleproduct.php?pid=<?php echo $pid; ?>">Explore</a></button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount">-25%</li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>
									<?php } ?>
								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>
							<!-- Product Panel -->
							<div class="product_panel panel active">
								<div class="featured_slider slider">
									<!-- Slider Item -->
									<?php
									include_once 'dbselect.inc';
									$selected = $db_selected;
									$num_rows = mysqli_num_rows($queryBestRated);
									while ($row = mysqli_fetch_array($queryBestRated)) {
										$pid = $row['p_id'];
										$pname = $row['p_name'];
										$pimage = $row['p_image'];
										$pprice = $row['p_price'];
										$saleprice = $row['sale_price'];
										$p_availability = $row['p_availability'];
										$pstatus = $row['p_status'];
										$c_id = $row['c_id'];
									?>
										<div class="featured_slider_item">
											<div class="border_active"></div>
											<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo "<img src=\"images/singleproduct/" . $pimage . "\" >"; ?> </a></div>
												<div class="product_content">
													<div class="product_price discount"><?php echo "$$saleprice"; ?><span><?php echo "$$pprice"; ?></span></div>
													<div class="product_name">
														<div><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo $pname; ?></a></div>
													</div>
													<div class="product_extras">
														<div class="product_color">
															<input type="radio" checked name="product_color" style="background:#b19c83">
															<input type="radio" name="product_color" style="background:#000000">
															<input type="radio" name="product_color" style="background:#999999">
														</div>
														<button class="product_cart_button"><a href="singleproduct.php?pid=<?php echo $pid; ?>">Explore</a></button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													<li class="product_mark product_discount">-25%</li>
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>
									<?php } ?>
								</div>
								<div class="featured_slider_dots_cover"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Popular Categories -->
	<div class="popular_categories">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="popular_categories_content">
						<div class="popular_categories_title">Popular Categories</div>
						<div class="popular_categories_slider_nav">
							<div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
							<div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
						</div>
						<div class="popular_categories_link"><a href="#">full catalog</a></div>
					</div>
				</div>
				<!-- Popular Categories Slider -->
				<div class="col-lg-9">
					<div class="popular_categories_slider_container">
						<div class="owl-carousel owl-theme popular_categories_slider">
							<!-- Popular Categories Item -->
							<?php
							include_once 'dbselect.inc';
							$selected = $db_selected;
							$num_rows = mysqli_num_rows($queryPopularCategory);
							while ($row = mysqli_fetch_array($queryPopularCategory)) {
								$cid = $row['c_id'];
								$cname = $row['c_name'];
								$cimage = $row['c_image'];
							?>
								<div class="owl-item">
									<div class="popular_category d-flex flex-column align-items-center justify-content-center">
										<div class="popular_category_image"><a target="_blank" href="category.php?category=<?php echo $cid; ?>"><?php echo "<img src=\"images/category/" . $cimage . "\" >"; ?> </a></div>
										<div class="popular_category_text"><a class="clc" href="category.php?category=<?php echo $cid; ?>"><?php echo $cname; ?></a></div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Banner -->
	<div class="banner_2">
		<div class="banner_2_background" style="background-image:url(images/banner_2_background.jpg)"></div>
		<div class="banner_2_container">
			<div class="banner_2_dots"></div>
			<!-- Banner 2 Slider -->
			<div class="owl-carousel owl-theme banner_2_slider">
				<!-- Banner 2 Slider Item -->
				<?php
				include_once 'dbselect.inc';
				$selected = $db_selected;
				$num_rows = mysqli_num_rows($queryBanner);
				while ($row = mysqli_fetch_array($queryBanner)) {
					$pid = $row['p_id'];
					$pname = $row['p_name'];
					$pimage = $row['p_image'];
					$p_description = $row['p_description'];
					$c_id = $row['c_id'];
					$cname = $row['c_name'];
				?>
					<div class="owl-item">
						<div class="banner_2_item">
							<div class="container fill_height">
								<div class="row fill_height">
									<div class="col-lg-4 col-md-6 fill_height">
										<div class="banner_2_content">
											<div class="banner_2_category"><a class="clc" href="category.php?category=<?php echo $c_id; ?>"><?php echo $cname; ?></a></div>
											<div class="banner_2_title"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo $pname; ?></a></div>
											<div class="banner_2_text"><?php echo $p_description ?></div>
											<div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
											<div class="button banner_2_button"><a href="singleproduct.php?pid=<?php echo $pid; ?>">Explore</a></div>
										</div>
									</div>
									<div class="col-lg-8 col-md-6 fill_height">
										<div class="banner_2_image_container">
											<div class="banner_2_image"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo "<img src=\"images/singleproduct/" . $pimage . "\" >"; ?></a></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- Hot New Arrivals -->
	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
							<div class="new_arrivals_title">Hot New Arrivals</div>
							<ul class="clearfix">
								<li class="active">Featured</li>
								<li>Ipades & Phones </li>
								<li>Laptops & Computers</li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>
						<div class="row">
							<div class="col-lg-9" style="z-index:1;">
								<!-- Product Panel -->
								<!-- Product Panel -->
								<div class="product_panel panel active">
									<div class="arrivals_slider slider">
										<!-- Slider Item -->
										<?php
										include_once 'dbselect.inc';
										$selected = $db_selected;
										$num_rows = mysqli_num_rows($queryFeatured2);
										while ($row = mysqli_fetch_array($queryFeatured2)) {
											$pid = $row['p_id'];
											$pname = $row['p_name'];
											$pimage = $row['p_image'];
											$pprice = $row['p_price'];
											$saleprice = $row['sale_price'];
											$weight = $row['weight'];
											$c_id = $row['c_id'];
										?>
											<div class="arrivals_slider_item">
												<div class="border_active"></div>
												<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
													<div class="product_image d-flex flex-column align-items-center justify-content-center"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo "<img src=\"images/singleproduct/" . $pimage . "\" >"; ?></a></div>
													<div class="product_content">
														<div class="product_price"><?php echo "$$pprice" ?></div>
														<div class="product_name">
															<div><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo $pname; ?></a></div>
														</div>
														<div class="product_extras">
															<div class="product_color">
																<input type="radio" checked name="product_color" style="background:#b19c83">
																<input type="radio" name="product_color" style="background:#000000">
																<input type="radio" name="product_color" style="background:#999999">
															</div>
															<button class="product_cart_button"><a href="singleproduct.php?pid=<?php echo $pid; ?>">Explore</a></button>
														</div>
													</div>
													<div class="product_fav"><i class="fas fa-heart"></i></div>
													<ul class="product_marks">
														<li class="product_mark product_new">-25%</li>
													</ul>
												</div>
											</div>
										<?php } ?>
									</div>
									<div class="arrivals_slider_dots_cover"></div>
								</div>
								<div class="product_panel panel">
									<div class="arrivals_slider slider">
										<!-- Slider Item -->
										<?php
										include_once 'dbselect.inc';
										$selected = $db_selected;
										$num_rows = mysqli_num_rows($queryPhone);
										while ($row = mysqli_fetch_array($queryPhone)) {
											$pid = $row['p_id'];
											$pname = $row['p_name'];
											$pimage = $row['p_image'];
											$pprice = $row['p_price'];
											$saleprice = $row['sale_price'];
											$c_id = $row['c_id'];
										?>
											<div class="arrivals_slider_item">
												<div class="border_active"></div>
												<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
													<div class="product_image d-flex flex-column align-items-center justify-content-center"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo "<img src=\"images/singleproduct/" . $pimage . "\" >"; ?></a></div>
													<div class="product_content">
														<div class="product_price"><?php echo "$$pprice" ?></div>
														<div class="product_name">
															<div><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo $pname; ?></a></div>
														</div>
														<div class="product_extras">
															<div class="product_color">
																<input type="radio" checked name="product_color" style="background:#b19c83">
																<input type="radio" name="product_color" style="background:#000000">
																<input type="radio" name="product_color" style="background:#999999">
															</div>
															<button class="product_cart_button"><a href="singleproduct.php?pid=<?php echo $pid; ?>">Explore</a></button>
														</div>
													</div>
													<div class="product_fav"><i class="fas fa-heart"></i></div>
													<ul class="product_marks">
														<li class="product_mark product_discount">-25%</li>
														<li class="product_mark product_new">-25%</li>
													</ul>
												</div>
											</div>
										<?php } ?>
									</div>
									<div class="arrivals_slider_dots_cover"></div>
								</div>
								<!-- Product Panel -->
								<div class="product_panel panel">
									<div class="arrivals_slider slider">
										<!-- Slider Item -->
										<?php
										include_once 'dbselect.inc';
										$selected = $db_selected;
										$num_rows = mysqli_num_rows($queryLaptop);
										while ($row = mysqli_fetch_array($queryLaptop)) {
											$pid = $row['p_id'];
											$pname = $row['p_name'];
											$pimage = $row['p_image'];
											$pprice = $row['p_price'];
											$saleprice = $row['sale_price'];
											$c_id = $row['c_id'];
										?>
											<div class="arrivals_slider_item">
												<div class="border_active"></div>
												<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
													<div class="product_image d-flex flex-column align-items-center justify-content-center"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo "<img src=\"images/singleproduct/" . $pimage . "\" >"; ?></a></div>
													<div class="product_content">
														<div class="product_price"><?php echo "$$pprice" ?></div>
														<div class="product_name">
															<div><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo $pname; ?></a></div>
														</div>
														<div class="product_extras">
															<div class="product_color">
																<input type="radio" checked name="product_color" style="background:#b19c83">
																<input type="radio" name="product_color" style="background:#000000">
																<input type="radio" name="product_color" style="background:#999999">
															</div>
															<button class="product_cart_button"><a href="singleproduct.php?pid=<?php echo $pid; ?>">Explore</a></button>
														</div>
													</div>
													<div class="product_fav"><i class="fas fa-heart"></i></div>
													<ul class="product_marks">
														<li class="product_mark product_discount">-25%</li>
														<li class="product_mark product_new">-25%</li>
													</ul>
												</div>
											</div>
										<?php } ?>
										/div>
									</div>
									<div class="arrivals_slider_dots_cover"></div>
								</div>
								<div class="arrivals_slider_dots_cover"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Best Sellers -->
	<div class="best_sellers">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
							<div class="new_arrivals_title">Hot Best Sellers</div>
							<ul class="clearfix">
								<li class="active">Top 20</li>
								<li>Ipades & Phones</li>
								<li>Laptops & Computers</li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>
						<div class="bestsellers_panel panel active">
							<!-- Best Sellers Slider -->
							<div class="bestsellers_slider slider" id="shop_back">
								<!-- Best Sellers Item -->
								<?php
								include_once 'dbselect.inc';
								$selected = $db_selected;
								$num_rows = mysqli_num_rows($queryTop20);
								while ($row = mysqli_fetch_array($queryTop20)) {
									$pid = $row['p_id'];
									$pname = $row['p_name'];
									$pimage = $row['p_image'];
									$pprice = $row['p_price'];
									$saleprice = $row['sale_price'];
									$c_id = $row['c_id'];
									$cname = $row['c_name'];
								?>
									<div class="bestsellers_item discount">
										<div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
											<div class="bestsellers_image"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo "<img src=\"images/singleproduct/" . $pimage . "\" >"; ?></a></div>
											<div class="bestsellers_content">
												<div class="bestsellers_category"><a class="clc" href="category.php?category=<?php echo $c_id; ?>"><?php echo $cname; ?></a></div>
												<div class="bestsellers_name"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo $pname; ?></a></a></div>
												<div class="rating_r rating_r_4 bestsellers_rating"><i></i><i></i><i></i><i></i><i></i></div>
												<div class="bestsellers_price discount"><?php echo "$$saleprice"; ?><span><?php echo "$$pprice"; ?></div>
											</div>
										</div>
										<div class="bestsellers_fav active"><i class="fas fa-heart"></i></div>
										<ul class="bestsellers_marks">
											<li class="bestsellers_mark bestsellers_discount">-25%</li>
											<li class="bestsellers_mark bestsellers_new">new</li>
										</ul>
									</div>
								<?php } ?>
							</div>
						</div>
						<div class="bestsellers_panel panel">
							<!-- Best Sellers Slider -->
							<div class="bestsellers_slider slider">
								<!-- Best Sellers Item -->
								<?php
								include_once 'dbselect.inc';
								$selected = $db_selected;
								$num_rows = mysqli_num_rows($queryPhone2);
								while ($row = mysqli_fetch_array($queryPhone2)) {
									$pid = $row['p_id'];
									$pname = $row['p_name'];
									$pimage = $row['p_image'];
									$pcolor = $row['p_color'];
									$pprice = $row['p_price'];
									$saleprice = $row['sale_price'];
									$tag = $row['tag'];
									$weight = $row['weight'];
									$total_review = $row['total_review'];
									$p_availability = $row['p_availability'];
									$p_description = $row['p_description'];
									$pstatus = $row['p_status'];
									$c_id = $row['c_id'];
								?>
									<div class="bestsellers_item discount">
										<div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
											<div class="bestsellers_image"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo "<img src=\"images/singleproduct/" . $pimage . "\" >"; ?></a></div>
											<div class="bestsellers_content">
												<div class="bestsellers_category">
													<a target="_blank" href="category.php?category=<?php echo $c_id; ?>"><?php echo "Ipades $ phones"; ?></a>
												</div>
												<div class="bestsellers_name"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo $pname; ?></a></div>
												<div class="rating_r rating_r_4 bestsellers_rating"><i></i><i></i><i></i><i></i><i></i></div>
												<div class="bestsellers_price discount"><?php echo "$$saleprice"; ?><span><?php echo "$$pprice"; ?></div>
											</div>
										</div>
										<div class="bestsellers_fav active"><i class="fas fa-heart"></i></div>
										<ul class="bestsellers_marks">
											<li class="bestsellers_mark bestsellers_discount">-25%</li>
											<li class="bestsellers_mark bestsellers_new">new</li>
										</ul>
									</div>
								<?php } ?>
							</div>
						</div>
						<div class="bestsellers_panel panel">
							<!-- Best Sellers Slider -->
							<div class="bestsellers_slider slider">
								<!-- Best Sellers Item -->
								<?php
								include_once 'dbselect.inc';
								$selected = $db_selected;
								$num_rows = mysqli_num_rows($queryLaptop2);
								while ($row = mysqli_fetch_array($queryLaptop2)) {
									$pid = $row['p_id'];
									$pname = $row['p_name'];
									$pimage = $row['p_image'];
									$pcolor = $row['p_color'];
									$pprice = $row['p_price'];
									$saleprice = $row['sale_price'];
									$tag = $row['tag'];
									$weight = $row['weight'];
									$total_review = $row['total_review'];
									$p_availability = $row['p_availability'];
									$p_description = $row['p_description'];
									$pstatus = $row['p_status'];
									$c_id = $row['c_id'];
								?>
									<div class="bestsellers_item discount">
										<div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
											<div class="bestsellers_image"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo "<img src=\"images/singleproduct/" . $pimage . "\" >"; ?></a></div>
											<div class="bestsellers_content">
												<div class="bestsellers_category">
													<a target="_blank" href="category.php?category=<?php echo $c_id; ?>"><?php echo "Camera $ photos"; ?></a>
												</div>
												<div class="bestsellers_name"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo $pname; ?></a></div>
												<div class="rating_r rating_r_4 bestsellers_rating"><i></i><i></i><i></i><i></i><i></i></div>
												<div class="bestsellers_price discount"><?php echo "$$saleprice"; ?><span><?php echo "$$pprice"; ?></div>
											</div>
										</div>
										<div class="bestsellers_fav active"><i class="fas fa-heart"></i></div>
										<ul class="bestsellers_marks">
											<li class="bestsellers_mark bestsellers_discount">-25%</li>
											<li class="bestsellers_mark bestsellers_new">new</li>
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
	<!-- Adverts -->
	<div class="adverts">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 advert_col">
					<!-- Advert Item -->
					<div class="advert d-flex flex-row align-items-center justify-content-start">
						<div class="advert_content">
							<div class="advert_title"><a href="#">Trends In 2022</a></div>
							<div class="advert_text">Description</div>
						</div>
						<div class="ml-auto">
							<div class="advert_image"><img src="images/adv_1.png" alt=""></div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 advert_col">
					<!-- Advert Item -->
					<div class="advert d-flex flex-row align-items-center justify-content-start">
						<div class="advert_content">
							<div class="advert_subtitle">Trends In 2022</div>
							<div class="advert_title_2"><a href="#">Soled -45%</a></div>
							<div class="advert_text">Description</div>
						</div>
						<div class="ml-auto">
							<div class="advert_image"><img src="images/adv_2.png" alt=""></div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 advert_col">
					<!-- Advert Item -->
					<div class="advert d-flex flex-row align-items-center justify-content-start">
						<div class="advert_content">
							<div class="advert_title"><a href="#">Trends In 2022</a></div>
							<div class="advert_text">Description</div>
						</div>
						<div class="ml-auto">
							<div class="advert_image"><img src="images/adv_3.png" alt=""></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Trends -->
	<div class="trends">
		<div class="trends_background" style="background-image:url(images/trends_background.jpg)"></div>
		<div class="trends_overlay"></div>
		<div class="container">
			<div class="row">
				<!-- Trends Content -->
				<div class="col-lg-3">
					<div class="trends_container">
						<h2 class="trends_title">Trends 2023</h2>
						<div class="trends_text">
							<p>Products that are more preparable on 2023</p>
						</div>
						<div class="trends_slider_nav">
							<div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
							<div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
						</div>
					</div>
				</div>
				<!-- Trends Slider -->
				<div class="col-lg-9">
					<div class="trends_slider_container">
						<!-- Trends Slider -->
						<div class="owl-carousel owl-theme trends_slider">
							<!-- Trends Slider Item -->
							<?php
							include_once 'dbselect.inc';
							$selected = $db_selected;
							$num_rows = mysqli_num_rows($querytrend);
							while ($row = mysqli_fetch_array($querytrend)) {
								$pid = $row['p_id'];
								$pname = $row['p_name'];
								$pimage = $row['p_image'];
								$pprice = $row['p_price'];
								$saleprice = $row['sale_price'];
								$p_availability = $row['p_availability'];
								$p_description = $row['p_description'];
								$c_id = $row['c_id'];
								$cname = $row['c_name'];
							?>
								<div class="owl-item">
									<div class="trends_item is_new">
										<div class="trends_image d-flex flex-column align-items-center justify-content-center"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo "<img src=\"images/singleproduct/" . $pimage . "\" >"; ?> </a></div>
										<div class="trends_content">
											<div class="trends_category"><a class="clc" href="category.php?category=<?php echo $c_id; ?>"><?php echo $cname; ?></a></div>
											<div class="trends_info clearfix">
												<div class="trends_name"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo $pname; ?></a></div>
												<div class="trends_price"><?php echo "$$pprice" ?></div>
											</div>
										</div>
										<ul class="trends_marks">
											<li class="trends_mark trends_discount">-25%</li>
											<li class="trends_mark trends_new">-25%</li>
										</ul>
										<div class="trends_fav"><i class="fas fa-heart"></i></div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Reviews -->
	<div class="reviews">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="reviews_title_container">
						<h3 class="reviews_title">Latest Reviews</h3>
						<div class="reviews_all ml-auto"><a href="#">view all <span>reviews</span></a></div>
					</div>
					<div class="reviews_slider_container">
						<!-- Reviews Slider -->
						<div class="owl-carousel owl-theme reviews_slider">
							<!-- Reviews Slider Item -->
							<div class="owl-item">
								<div class="review d-flex flex-row align-items-start justify-content-start">
									<div>
										<div class="review_image"><img src="images/review_1.jpg" alt=""></div>
									</div>
									<div class="review_content">
										<div class="review_name">Roberto Sanchez</div>
										<div class="review_rating_container">
											<div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
											<div class="review_time">2 day ago</div>
										</div>
										<div class="review_text">
											<p>Description</p>
										</div>
									</div>
								</div>
							</div>
							<!-- Reviews Slider Item -->
							<div class="owl-item">
								<div class="review d-flex flex-row align-items-start justify-content-start">
									<div>
										<div class="review_image"><img src="images/review_2.jpg" alt=""></div>
									</div>
									<div class="review_content">
										<div class="review_name">Brandon Flowers</div>
										<div class="review_rating_container">
											<div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
											<div class="review_time">2 day ago</div>
										</div>
										<div class="review_text">
											<p>Description</p>
										</div>
									</div>
								</div>
							</div>
							<!-- Reviews Slider Item -->
							<div class="owl-item">
								<div class="review d-flex flex-row align-items-start justify-content-start">
									<div>
										<div class="review_image"><img src="images/review_3.jpg" alt=""></div>
									</div>
									<div class="review_content">
										<div class="review_name">Emilia Clarke</div>
										<div class="review_rating_container">
											<div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
											<div class="review_time">2 day ago</div>
										</div>
										<div class="review_text">
											<p>Description</p>
										</div>
									</div>
								</div>
							</div>
							<!-- Reviews Slider Item -->
							<div class="owl-item">
								<div class="review d-flex flex-row align-items-start justify-content-start">
									<div>
										<div class="review_image"><img src="images/review_1.jpg" alt=""></div>
									</div>
									<div class="review_content">
										<div class="review_name">Roberto Sanchez</div>
										<div class="review_rating_container">
											<div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
											<div class="review_time">2 day ago</div>
										</div>
										<div class="review_text">
											<p>Description</p>
										</div>
									</div>
								</div>
							</div>
							<!-- Reviews Slider Item -->
							<div class="owl-item">
								<div class="review d-flex flex-row align-items-start justify-content-start">
									<div>
										<div class="review_image"><img src="images/review_2.jpg" alt=""></div>
									</div>
									<div class="review_content">
										<div class="review_name">Brandon Flowers</div>
										<div class="review_rating_container">
											<div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
											<div class="review_time">2 day ago</div>
										</div>
										<div class="review_text">
											<p>Description</p>
										</div>
									</div>
								</div>
							</div>
							<!-- Reviews Slider Item -->
							<div class="owl-item">
								<div class="review d-flex flex-row align-items-start justify-content-start">
									<div>
										<div class="review_image"><img src="images/review_3.jpg" alt=""></div>
									</div>
									<div class="review_content">
										<div class="review_name">Emilia Clarke</div>
										<div class="review_rating_container">
											<div class="rating_r rating_r_4 review_rating"><i></i><i></i><i></i><i></i><i></i></div>
											<div class="review_time">2 day ago</div>
										</div>
										<div class="review_text">
											<p>Description</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="reviews_dots"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Available Product -->
	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Available Product</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>
					<div class="viewed_slider_container">
						<!-- Available Product Slider -->
						<div class="owl-carousel owl-theme viewed_slider" id="products">
							<!-- Available Product Item -->
							<?php
							include_once 'dbselect.inc';
							$selected = $db_selected;
							$num_rows = mysqli_num_rows($queryrecent);
							while ($row = mysqli_fetch_array($queryrecent)) {
								$pid = $row['p_id'];
								$pname = $row['p_name'];
								$pimage = $row['p_image'];
								$saleprice = $row['sale_price'];
								$p_availability = $row['p_availability'];
								$p_description = $row['p_description'];
								$c_id = $row['c_id'];
								$cname = $row['c_name'];
							?>
								<div class="owl-item">
									<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
										<div class="viewed_image"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo "<img src=\"images/singleproduct/" . $pimage . "\" >"; ?> </a></div>
										<div class="viewed_content text-center">
											<div class="viewed_price"><?php echo "$$saleprice" ?><span><?php echo "$$pprice" ?></span></div>
											<div class="viewed_name"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo $pname; ?></a></div>
										</div>
										<ul class="item_marks">
											<li class="item_mark item_discount">-25%</li>
											<li class="item_mark item_new">new</li>
										</ul>
									</div>
								</div>
							<?php } ?>
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
	<script src="plugins/slick-1.8.0/slick.js"></script>
	<script src="plugins/easing/easing.js"></script>
	<script src="js/custom.js"></script>
</body>

</html>