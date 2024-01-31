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
				$cartItem[$product["p_id"]]["quantity"] += 1;
			} else {
				// Add the product to the cart
				$cartItem[$product["p_id"]] = array(
					"p_name" => $product["p_name"],
					"p_id" => $product["p_id"],
					"quantity" => 1,
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
					"quantity" => 1,
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
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cart One Tech</title>
    <meta name="description" content="Cart Add to Cart of OneTech">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/flexslider.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />

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

        <div class="home-sec">
            <div class="overlay" style="background-color:#263958;">
                <div class="container">
                    <div class="row text-center">

                        <div class="col-lg-12  col-md-12 col-sm-12">

                            <div class="flexslider set-flexi" style="padding-top:5px; top:5px;">
                                <ul class="slides move-me">
                                    <div style="border-color: #FFF; border-radius:20px; padding-top:5px; top:5px;">
                                        <li>
                                            <h3>Added to Cart</h3></br>
                                            <?php if (!empty($_SESSION["cart_item"])) : ?>
                                                <?php foreach ($_SESSION["cart_item"] as $item) : ?>
                                            <center>
                                                <div style="align:center; width:20%; height:20%;"> <img src="images/singleproduct/<?php echo $item['p_image']; ?>" alt="book image" align="middle"></div>
                                            </center>
                                            <h5><?php echo $item['p_name']; ?></h5>
                                        
                                            <h5><?php echo'$'. $item['sale_price'] . '  ' . ' X ' . $item["quantity"] . ' =  $' . $item['sale_price'] * $item["quantity"] . ''; ?></h5>
                                            <?php endforeach; ?>
                                            <a href="category.php?category=<?php echo $product["c_id"]; ?>" class="btn btn-warning btn-lg">
                                                Shop Again
                                            </a>
                                            <a href="cart.php" class="btn btn-success btn-lg">
                                                View Cart
                                            </a>
                                            <a href="checkout.php" class="btn btn-primary btn-lg">
                                                Checkout
                                            </a>
                                        <?php endif; ?>
                                        </li></br></br>
                                    </div>
                                    <!-- End Slider 03 -->
                                </ul>
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
        </div>
    </div>
</body>

</html>