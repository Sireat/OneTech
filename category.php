<!DOCTYPE html>
<html lang="en">
<head>
	<title>Category</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="OneTech shop project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="styles/cart_styles.css">
	<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">

</head>

<body>

	<!-- Header -->
	<?php include_once('header-menu.php'); ?>

	<!-- category part -->

	<?php
	include_once 'dbselect.inc';
	$selected = $db_selected;
	if (isset($_GET['category'])) {
		$selectedCategory = $_GET['category'];

		// Bind the category parameter to the prepared statement
		mysqli_stmt_bind_param($queryProducts, 'i', $selectedCategory);

		// Execute the query
		mysqli_stmt_execute($queryProducts);

		// Retrieve the results
		$result = mysqli_stmt_get_result($queryProducts);

		// Loop through the results and display the products
		while ($row = mysqli_fetch_array($result)) {
			// Retrieve the product information
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
			$cname = $row['c_name'];

			// Display the product information
	?>
		<div class="owl-item">
	<div class="banner_2_item" style="display: flex; justify-content: center; align-items: center;">
		<div class="container fill_height" style="height: 100%; width: 100%;">
			<div class="row fill_height">
				<div class="col-lg-4 col-md-6 fill_height" style="height: 100%;">
					<div class="banner_2_content" style="height: 100%; display: flex; flex-direction: column; justify-content: center;">
						<div class="banner_2_category" style="font-size: 24px;"><?php echo $cname ?></div>
						<div class="banner_2_title" style="font-size: 32px;"><a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo $pname ?></a></div>
						<div class="banner_2_text" style="font-size: 16px;"><?php echo $p_description ?></div>
						<div class="rating_r rating_r_4 banner_2_rating" style="margin-top: 10px; display: flex; align-items: center;">
							<i style="color: #FFD700;"></i>
							<i style="color: #FFD700;"></i>
							<i style="color: #FFD700;"></i>
							<i style="color: #FFD700;"></i>
							<i style="color: #FFD700;"></i>
						</div>
						<div class="button banner_2_button" style="margin-top: 20px;">
							<a href="singleproduct.php?pid=<?php echo $pid; ?>" style="background-color: #007bff; color: #fff; padding: 10px 20px; text-decoration: none;">Explore</a>
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-md-6 fill_height" style="height: 100%;">
					<div class="banner_2_image_container" style="height: 100%; display: flex; justify-content: center; align-items: center;">
						<div class="banner_2_image" style="height: 80%; width: 80%; position: relative;">
						<a target="_blank" href="singleproduct.php?pid=<?php echo $pid; ?>"><?php echo "<img src=\"images/singleproduct/" . $pimage . "\" style=\"height: 70%; width: 70%; object-fit: cover;\" >"; ?></a>
							<div class="image_description" style="position: absolute; bottom: 10px; left: 10px; color: #fff; font-size: 16px;"><?php echo $pname; ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>

	<?php
		}

		// Close the prepared statement
		mysqli_stmt_close($queryProducts);
	}

	// Close the database connection
	mysqli_close($con_srv);
	?>
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
	<script src="plugins/easing/easing.js"></script>
	<script src="js/cart_custom.js"></script>
</body>

</html>