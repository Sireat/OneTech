<?php
session_start();
require('dbconnect.inc');
require_once("dbcontroller.php");

// Check if the product ID is provided in the URL
if (!empty($_GET["pid"])) {
	$pid = $_GET["pid"];

	// Fetch product details from the database
	$querycart = mysqli_query($con_srv, "SELECT p_id, p_name, p_image, p_color, p_price, sale_price, p_availability, p_description, c_name, bdu_product.c_id 
        FROM bdu_product, bdu_category 
        WHERE bdu_product.c_id = bdu_category.c_id 
        AND p_availability = 'In Store' 
        AND p_id = '" . $pid . "'");

	// Check if the product exists
	if (mysqli_num_rows($querycart) > 0) {
		$product = mysqli_fetch_assoc($querycart);

		// Check if 'cart_item' session variable is set
		if (isset($_SESSION["cart_item"])) {
			$cartItem = $_SESSION["cart_item"];

			// Check if the product is already in the cart
			if (isset($cartItem[$product["p_id"]])) {
				// Update the quantity of the existing product
				$cartItem[$product["p_id"]]["quantity"] += $_POST["quantity"];
			} else {
				// Add the product to the cart
				$cartItem[$product["p_id"]] = array(
					"p_name" => $product["p_name"],
					"p_id" => $product["p_id"],
					"quantity" => $_POST["quantity"],
					"sale_price" => $product["sale_price"],
					"p_image" => $product["p_image"]
				);
			}
		} else {
			// Create a new cart item
			$cartItem = array(
				$product["p_id"] => array(
					"p_name" => $product["p_name"],
					"p_id" => $product["p_id"],
					"quantity" => $_POST["quantity"],
					"sale_price" => $product["sale_price"],
					"p_image" => $product["p_image"]
				)
			);
		}

		// Store the updated cart item in the session
		$_SESSION["cart_item"] = $cartItem;
	}
}

// Function to calculate the total price of the cart items
function calculateCartTotal($cartItems)
{
	$totalPrice = 0;
	foreach ($cartItems as $item) {
		$totalPrice += $item["sale_price"] * $item["quantity"];
	}
	return $totalPrice;
}

// Remove item from cart
if (isset($_GET["action"]) && $_GET["action"] == "remove" && isset($_GET["p_id"])) {
	$removeProductId = $_GET["p_id"];

	if (isset($_SESSION["cart_item"][$removeProductId])) {
		unset($_SESSION["cart_item"][$removeProductId]);
	}
}

// Empty the cart
if (isset($_GET["action"]) && $_GET["action"] == "empty") {
	unset($_SESSION["cart_item"]);
}

// Check if the user is logged out
if (isset($_REQUEST['logout'])) {
	unset($_SESSION['User_Name']);
	header('Location: index.php');
	exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Cart Page</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="OneTech shop project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="styles/cart_styles.css">
	<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">

	<style>

	</style>
</head>

<body>

	<div class="super_container">

		<!-- Header -->
		<?php include_once('header-menu.php'); ?>

		<!-- Cart -->
		<div class="cart_section">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1">
						<div class="cart_container">
							<div class="cart_title">Shopping Cart</div>

							<?php if (!empty($_SESSION["cart_item"])) : ?>
								<div class="cart_items">
									<ul class="cart_list">
										<?php foreach ($_SESSION["cart_item"] as $item) : ?>
											<li class="cart_item clearfix">
												<div class="cart_item_image"><img src="images/singleproduct/<?php echo $item['p_image']; ?>" alt=""></div>
												<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
													<div class="cart_item_name cart_info_col">
														<div class="cart_item_title">Name</div>
														<div class="cart_item_text"><?php echo $item['p_name']; ?></div>
													</div>
													<div class="cart_item_color cart_info_col">
														<div class="cart_item_title">Color</div>
														<?php if (isset($item['p_color'])) : ?>
															<div class="cart_item_text"><span style="background-color:#999999;"></span><?php echo $item['p_color']; ?></div>
														<?php else : ?>
															<div class="cart_item_text">N/A</div>
														<?php endif; ?>
													</div>

													<div class="cart_item_quantity cart_info_col">
														<div class="cart_item_title">Quantity</div>
														<div class="cart_item_text"><?php echo $item['quantity']; ?></div>
													</div>
													<div class="cart_item_price cart_info_col">
														<div class="cart_item_title">Price</div>
														<div class="cart_item_text"><?php echo '$'.$item['sale_price']; ?></div>
													</div>
													<div class="cart_item_total cart_info_col">
														<div class="cart_item_title">Total</div>
														<div class="cart_item_text"><?php echo '$'.$item['sale_price'] * $item['quantity']; ?></div>
													</div>
													<div class="col-lg-2 col-8">
														<div class="product product__thumb" align="center" style="padding-right: 0px">
															<a href="cart.php?action=remove&p_id=<?php echo $item['p_id']; ?>" class="btnRemoveAction">
																<img src="images/icon-delete.png" alt="Remove Item" width="32" height="35" />
															</a>
														</div>
													</div>
												</div>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>

								<!-- Order Total -->
								<div class="order_total">
									<div class="order_total_content text-md-right">
										<div class="order_total_title">Order Total:</div>
										<div class="order_total_amount"><?php echo '$'. calculateCartTotal($_SESSION["cart_item"]); ?></div>
									</div>
								</div>
							<?php else : ?>
								<div class="no-records">Your Cart is Empty</div>
							<?php endif; ?>

							<div class="cartbox__btn">
								<ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
									<li><a href="cart.php?action=empty">Empty Cart</a></li>
									<li><a href="#">Update Cart</a></li>
									<li><a href="index.php#shop_back">Shop Back</a></li>
									<li><a href="checkout.php?">Check Out</a></li>
									<li><a href="index.php?action=logout">Log Out</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Newsletter -->

		<?php include_once('subscribe.php'); ?>


		<!-- Footer -->
		<?php include_once('footer.php'); ?>

		<!-- Copyright -->
		<?php include_once('copyright.php'); ?>

</body>

</html>