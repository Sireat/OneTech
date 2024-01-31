<?php
require('dbconnect.inc');
error_reporting(0);
session_start();
         if(isset($_REQUEST['logout'])){
                unset($_SESSION['User_Name']);
				unset($_SESSION["cart_item"]);
				session_destroy();
            header('Location: index.php');
            exit();
        }
	if(isset($_SESSION['User_Name'])){
		$uname=$_SESSION['User_Name'];
		//$utype=$_SESSION['U_Type'];
		$ufname=$_SESSION['User_Fname'];
		$umname=$_SESSION['User_Mname'];
		$queryUser = mysqli_query($con_srv, "SELECT * FROM bdu_user_account WHERE user_email = '".$_SESSION['User_Name']."'");
	    $r = mysqli_fetch_array($queryUser);
		$name=$r['user_fname'];
		$email=$r['user_email'];
		$id=$r['user_id'];
	}
		$verifycode = $_SESSION['verify_code'];
		$_SESSION['verify_code'] = $verifycode;
		$c_email=$_SESSION['email'];
		$_SESSION['email']=$c_email;
?>

<?php
//session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "pay":
		if(!empty($verifycode))
		{
		    header("Location:pay.php?verify_code=$verifycode");
		    exit();
		}
		else{
			header("Location:cart.php");
			exit();
		}
	
	case "logout":
		unset($_SESSION["User_Name"]);
		unset($_SESSION["cart_item"]);
		header('Location: index.php');
		exit();
	case "checkout":
		if(empty($_SESSION["cart_item"])) {
			header('Location:cart.php');
			exit();
		}
		else{
			header('Location:checkout.php');
			exit();
		}
}
}
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Order Received | One Tech</title>
	<meta name="description" content="Checkout onetech Home of Ethiopian Best Store Order and Buy Online ecommerce ">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<script src="scripts.js"></script>
	<!-- Custom css -->
	<link rel="stylesheet" href="css/custom.css">

	<!-- Modernizer js -->
	<script src="js/vendor/modernizr-3.5.0.min.js"></script>
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
	<?php include_once("header-menu.php"); ?>
   </div>
	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		
        <!-- End Bradcaump area -->
        <!-- Start Checkout Area -->
		<?php
  require('dbconnect.inc');
  if (isset($_GET['order_number'])){
    $ord_num = $_GET['order_number'];
	//$o_statement="SELECT * FROM bdu_order, bdu_order_detail, bdu_product, bdu_payment_type, bdu_shipment_type, bdu_shipment, bdu_invoice_table WHERE bdu_order.o_id=bdu_order_detail.o_id AND bdu_order_detail.p_id=bdu_product.p_id AND bdu_order.payment_type_code=bdu_payment_type.payment_type_code AND bdu_order.shipment_type_code=bdu_shipment_type.shipment_type_code AND bdu_order.order_number=bdu_shipment.order_number AND bdu_shipment.invoice_id=bdu_invoice_tabl.invoice_id AND bdu_order_detail.order_number='".$ord_num."'";
	$o_statement="SELECT * FROM bdu_order, bdu_order_detail, bdu_invoice_table WHERE bdu_order.o_id=bdu_order_detail.o_id  AND bdu_order_detail.order_number='".$ord_num."'";
	$o_book2=mysqli_query($con_srv, $o_statement);
	
	$o_row2=mysqli_fetch_array($o_book2);
?>	
        <section class="wn__checkout__area section-padding--lg bg__white">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-12">
        				<div class="wn_checkout_wrap">
        					<div class="checkout_info" align="justify">Thank You. Order Received Successfully</div>
							<div class="checkout_info" align="justify">
        						
								
								<p>Please make payment, after you are placing orders. To make payment please check your email or </p>
								<!--<p>If you are using <b>Mobile Banking</b> take Screenshot of the payment for your Confirmation.</p>-->
								
								<p>User Our Bank Account Numbers</p>
								<p>&nbsp;<b>* Commercial Bank</b> 100000000 xyz abc</p>
								<p>&nbsp;<b>* Dashen Bank</b> 1000000002 xyz abc</p>
								<p>&nbsp;<b>* Abyssinia Bank</b> 1000000003 xyz abc</p>
								
								
        					</div>
        					<div class="checkout_info" align="justify">
							<!--Order number: <b><?php //echo "$ord_num";?></b>-->
							
							Total: <b>$<?php echo number_format($o_row2["o_total_price"]+$o_row2['shipping_charge'], 2);?></b>  Payment Method: <b><?php echo $o_row2['payment_type_code'];?></b> Shipping Method: <b><?php echo $o_row2['shipment_type_code'];?></b> 
							Invoice Number: <b><?php echo $o_row2['invoice_number'];?></b>
							<!--Reference number: <b><?php //echo $o_row2['reference_number'];?></b>-->
							Date: <b><?php echo $o_row2['ordered_delivery_date'];?></b>  
							</div>
        				</div>
        			</div>
        		</div>
        		<div class="row">
        			
        			<div class="col-lg-12 md-mt-40 sm-mt-40">
						
        				<div class="wn__order__box">
        					<h3 class="onder__title">Your Order Details</h3>
        					<ul class="order__total">
        						<li>Items</li>
        						<li>Total</li>
        					</ul>
							<!--
						<?php
							$o_book=mysqli_query($con_srv, $o_statement);
							while ($o_row=mysqli_fetch_array($o_book))
							{
						?>
							<ul class="order_product">
        						<li><?php echo $o_product_name; ?> × <?php echo $o_book_qty; ?><span><?php echo " $". number_format($o_book_sub_total,2) .""; ?></span></li>	
        					</ul>
							<?php  } ?>-->
        					<ul class="shipping__method">
        						<li>Sub Total (<?php echo $o_row2["o_total_qty"]; ?> Items) <span><?php echo " $".number_format($o_row2["o_total_price"], 2).""; ?></span></li>
        						
								<li>Payment Method: <span><?php echo $o_row2['payment_type_code'];?></span></li>
								<li>Shipping Method: <span><?php echo $o_row2['shipment_type_code'];?></span></li>
								<li>Shipping Charge: <span>$<?php echo $o_row2['shipping_charge']."";?></span></li>
        					</ul>
        					<ul class="total__amount">
        						<li>Grand Total <?php //echo $o_row2["quantity_total"]; ?> <span><?php echo " $".number_format($o_row2["o_total_price"]+$o_row2['shipping_charge'], 2).""; ?></span></li>
        					</ul>
        				</div>
						<div class="cartbox__btn">
								<ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
									<li><a href="shop.php">Shop Again</a></li>
									<li><a href="order-received.php?action=pay">Confirm Payment</a></li>
									<li><a href="order-received.php?action=logout">Log Out</a></li>
								</ul>
							</div>
        			</div>
        		</div>
				<div class="payment-body">
							</br>
							<p><h5>For More info</h5></p>
							<p><small class="icon-envelope icons">&nbsp; fastsales@gmail.com</small></p>
							<p><small class="icon-phone icons">&nbsp; +2519 0817 0601</small></p>
							</div>
        	</div>
        </section>
<?php }else { ?>
 <section class="wn__checkout__area section-padding--lg bg__white">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-12">
        				<div class="wn_checkout_wrap">
        					<div class="checkout_info" align="justify">ይቅርታ! ትዕዛዝዎ አልደረሰም።</div>
							<div class="checkout_info" align="justify">
        						እባክዎን የራስዎን የኢሜል አድራሻ ይጠቀሙ ፡፡
        					</div>
							<div class="checkout_info" align="justify">
        						እባክዎን በኢሜል ወይም በስልክ ቁጥር ያነጋግሩን፡፡
        					</div>
        					
        				</div>
        			</div>
        		</div>
        		
        	</div>
        </section>
<?php } ?>
        <!-- End Checkout Area -->
		<!-- Footer Area -->
   <?php include_once("footer.php"); ?>

	</div>
	<!-- JS Files -->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/active.js"></script>
	
</body>
</html>