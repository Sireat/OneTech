<?php
require('dbconnect.inc');
error_reporting();
session_start();
			if(isset($_REQUEST['logout'])){
                unset($_SESSION['User_Name']);
				unset($_SESSION["cart_item"]);
            $_GLOBALS['message']="You are Loggged Out Successfully.";
			session_destroy();
            header('Location: index.php');
        }
	if(isset($_SESSION['User_Name'])){
		$uname=$_SESSION['User_Name'];
		
		$ufname=$_SESSION['User_Fname'];
		$umname=$_SESSION['User_Mname'];
		$queryUser = mysqli_query($con_srv, "SELECT * FROM bdu_user_account WHERE user_email = '".$_SESSION['User_Name']."'");
	    $r = mysqli_fetch_array($queryUser);
		
		$fname=$r['user_fname'];
		$mname=$r['user_mname'];
		$fullname=$fname.' '.$mname;
		$email=$r['user_email'];
		$id=$r['user_id'];
	}
	//require_once('dbconnect.inc');
 $inv_num=$_SESSION['invoice_number'];
		
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Payment-Review | OneTech</title>
	<meta name="description" content="Payment Review Confirm Payment OneTech Home of Ethiopian Best Ethiopian Online Store Order and Buy Products Online ecommerce OneTech">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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

	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/icon.png">

	<!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="style.css">

	<!-- Custom css -->
   <link rel="stylesheet" href="css/custom.css">

	<!-- Modernizer js -->
	<script src="js/vendor/modernizr-3.5.0.min.js"></script>
</head>
<body>
	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		
		<!-- Header -->
		
		<?php include_once("header-menu.php"); ?>
        <!-- End Bradcaump area -->
        <!-- Start Checkout Area -->
        <section class="wn__checkout__area bg__white">
        	<div class="container">
        		<div class="row">
				
			<div class="col-lg-3 col-12">
			</div>
        	<div class="col-lg-6 col-12">
        		<div class="wn_checkout_wrap">
					
        				<div class="customer_details">
        					
							<div class="payment">
						        <div class="wn__order__box">
        					<h3 class="onder__title">Payment Status</h3>
								</div>
						    </div>
							<div class="collapse show">
							</div>
							<div class="account__form" style="background-color:#36A936; color:#FFFFFF;">
						          	
						                <center><span><h6>Under Review!</h6></span></center>
						          	
						    </div>
							
        					<div class="customar__field account__form" style="background-color:#efeffe; color:#366636;">
							
							<div class="" >       
								<h5>Payment Status</h5>
								<p>Hello, ጤና ይስጥልኝ ፣ Payment Confirmation Detail  <b>Invoice: #  <?php echo $inv_num; ?> Received</p></b>
								<p>If your payment details are correct, your orders will be processed with in hours. Please be ready to receive your products.</p>
								<b><p>Thank You for Shoping</p></b>
								<b><p>ስለግብይትዎ እናመሰግናለን</p></b>
						    </div>
								
        					</div>
							<div class="payment-body">
							</br>
							<p><h5>Contact Info</h5></p>
							<p><small class="icon-envelope icons">&nbsp; fastsales@gmail.com</small></p>
							<p><small class="icon-phone icons">&nbsp; +2519 0817 0601</small></p>
							
							</div>
							</br>
							</br>
							
        				</div>
        				
        			</div>
        	</div>	
			
			<div class="col-lg-3 col-12">
			</div>
			
			</div>
        	</div>
        </section>
        <!-- End Checkout Area -->
		<!-- Footer Area -->
   <?php include_once("footer.php"); ?>
  <!-- //Footer Area -->

	</div>
	<!-- //Main wrapper -->

	<!-- JS Files -->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/active.js"></script>
	
</body>
</html>