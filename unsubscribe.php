<?php
require_once('dbconnect.inc');

if (isset($_GET['email'])) {
	$unsub_email = $_GET['email'];

	// Remove the email from the subscription list
	$unsubscribeqry = "DELETE FROM bdu_subscription WHERE customer_email = '$unsub_email'";
	$run_unsubqry = mysqli_query($con_srv, $unsubscribeqry);

	if (!$run_unsubqry) {
		echo "Something went wrong. Please try again.";
	} else {
		echo "You have been successfully unsubscribed.";
	}
} else {
	echo "Invalid unsubscribe request.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Unsubscribe</title>
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

	<!-- Newsletter -->

	<?php include_once('subscribe.php'); ?>

	<!-- Footer -->
	<?php include_once('footer.php'); ?>
	<!-- Copyright -->
	<?php include_once('copyright.php'); ?>



</body>

</html>