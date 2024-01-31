<?php
require('dbconnect.inc');
error_reporting();
session_start();
			if(!(isset($_SESSION['cart_item']))){
			header("location:cart.php");
			exit();
        }
        else if(isset($_REQUEST['logout'])){
                unset($_SESSION['User_Name']);
				unset($_SESSION["cart_item"]);
		   session_destroy();
            header('Location: index.php');
            exit();
        }
	if(isset($_SESSION['User_Name'])){
		$uname=$_SESSION['User_Name'];
		$ufname=$_SESSION['User_Fname'];
		$umname=$_SESSION['User_Mname'];
	$queryUser = mysqli_query($con_srv, "SELECT * FROM bdu_user_account WHERE user_email = '" . $_SESSION['User_Name'] . "'");
	$r = mysqli_fetch_array($queryUser);
	$fname=$r['user_fname'];
	$mname=$r['user_mname'];
	$name=$fname.' '.$mname;
	$email=$r['user_email'];
	$id=$r['user_id'];
}
?>
<?php
require_once('dbconnect.inc');
if(isset($_REQUEST['placeorders']) AND isset($_SESSION["cart_item"]))
{
		if(empty($_SESSION["cart_item"])) {
		header('Location: cart.php');
		exit();
	}
	else{
	ini_set('precision', 8);
	$qty_total = $_SESSION['qty_total'];
	$ord_price_total = $_SESSION['g_price'];
	$_SESSION['g_price'] = $ord_price_total;
	$discount = 0;
	$coupon_price = 0;
	$ord_status = '1';

	$bank_name = $_POST['bank_name'];
	$pay_mthd = $_POST['payment_method'];
	$shipment_type = $_POST['shipment_type'];
	$fname = htmlspecialchars($_REQUEST['fname'],ENT_QUOTES);
	$lname = htmlspecialchars($_REQUEST['lname'],ENT_QUOTES);
	$c_email = htmlspecialchars($_REQUEST['c_email'],ENT_QUOTES);
	$company = '';
	$billaddress = htmlspecialchars($_REQUEST['billaddress'],ENT_QUOTES);
	$subcity = htmlspecialchars($_REQUEST['subcity'],ENT_QUOTES);
	$phone1 = htmlspecialchars($_REQUEST['phone1'],ENT_QUOTES);
	$phone2 = htmlspecialchars($_REQUEST['phone2'],ENT_QUOTES);
	$zipcode = htmlspecialchars($_REQUEST['zipcode'],ENT_QUOTES);
	$additional_info = htmlspecialchars($_REQUEST['additional_info'],ENT_QUOTES);
	$name=$fname.' '.$lname;
	$_SESSION['email']=$c_email;
	$ship_address='';
	$ship_address .= $additional_info;
	$d_location = htmlspecialchars($_REQUEST['d_location'],ENT_QUOTES);
	$shipment_type = $_POST['shipment_type'];
	if($shipment_type == '1'){ $shipping_charge = 0; } else {
		$shipping_charge = 30;
	}
	$shipment_type = $_POST['shipment_type'];
		require_once('dbconnect.inc');
		$run_maxordnum = mysqli_query($con_srv, "SELECT MAX(CAST(order_number as SIGNED)) from bdu_order");
		$row_maxordnum = mysqli_fetch_row($run_maxordnum);
		$ord_num = $row_maxordnum[0] + 1;
		$cust_statement = "SELECT * FROM bdu_customer WHERE cu_phone= '" . $phone1 . "'";
		$c_reg = mysqli_query($con_srv, $cust_statement);
		$c_reg_num_rows = mysqli_num_rows($c_reg);
		if ($c_reg_num_rows != 0) {
			$cust_raw = mysqli_fetch_array($c_reg);
			$cust_id = $cust_raw['cu_id'];
		} else {
			$run_max_cust_id = mysqli_query($con_srv, "SELECT MAX(CAST(cu_id as SIGNED)) FROM bdu_customer");
			$row_max_cust_id = mysqli_fetch_row($run_max_cust_id);
			$cust_id = $row_max_cust_id[0] + 1;
			$cust_shipment_qry = "INSERT INTO bdu_customer(cu_id, cu_fname, cu_mname, cu_lname, cu_email, cu_phone, cu_country, cu_city, cu_address, cu_pobox) 
			                                        VALUES ('".$cust_id."','".$fname."','','".$lname."','".$c_email."','".$phone1."','".$company."','','".$billaddress."','".$zipcode."')";
			$run_shipqry = mysqli_query($con_srv, $cust_shipment_qry);
		}
		$run_max_inv_id = mysqli_query($con_srv, "SELECT MAX(CAST(invoice_id as SIGNED)) from bdu_invoice_table");
		$row_max_inv_id = mysqli_fetch_row($run_max_inv_id);
		$inv_id = $row_max_inv_id[0] + 1;
		$run_max_inv_num = mysqli_query($con_srv, "SELECT CAST(invoice_number as SIGNED) FROM bdu_invoice_table WHERE invoice_id='" . $row_max_inv_id[0] . "'");
		$row_max_inv_num = mysqli_fetch_row($run_max_inv_num);
		$inv_num = $row_max_inv_num[0] + 1;
		$run_max_ref_num = mysqli_query($con_srv, "SELECT CAST(reference_number as SIGNED) FROM bdu_invoice_table WHERE invoice_id='" . $row_max_inv_id[0] . "'");
		$row_max_ref_num = mysqli_fetch_row($run_max_ref_num);
		$ref_num = $row_max_ref_num[0] + 1;
		$inv_qry = "INSERT INTO bdu_invoice_table(invoice_id, invoice_number, cu_id, reference_number, creation_date) VALUES ('" . $inv_id . "','" . $inv_num . "', '" . $cust_id . "', '" . $ref_num . "', CURRENT_TIMESTAMP)";
		$run_inv_qry = mysqli_query($con_srv, $inv_qry);
		$run_max_ship_id = mysqli_query($con_srv, "SELECT MAX(CAST(invoice_id as SIGNED)) from bdu_invoice_table");
		$row_max_ship_id = mysqli_fetch_row($run_max_ship_id);
		$ship_id = $row_max_ship_id[0] + 1;
		$final_price = $ord_price_total + $shipping_charge;
		$shipment_qry = "INSERT INTO `bdu_shipment`(`sh_id`, `billing_address`, `cu_id`, `delivery_cost`, `disount`, `final_price`, `invoice_id`, `order_number`, `payment_type_code`, `price_total`, `qty_total`, `sh_type_code`, `sh_address`, `total_weight`, `time_created`) VALUES($ship_id, 1,$cust_id,$shipping_charge,$discount,$final_price,$inv_id,$ord_num,$pay_mthd,$ord_price_total,$qty_total,$shipment_type,1 ,1,CURRENT_TIME);";
		$run_shipment_qry = mysqli_query($con_srv, $shipment_qry);
		function genRandomString()
		{
			$characters_on_image = 10;
			$possible_letters = 'ABCDEFGHLNRTXWYZ23456789bdfghjkmnpqrstv';
			$strings = '';
			$i = 0;
			while ($i < $characters_on_image) {
				$strings .= substr($possible_letters, mt_rand(0, strlen($possible_letters) - 1), 1);
				$i++;
			}
			return $strings;
		}
		$code = genRandomString();
		$verifycode = md5($code);
		$_SESSION['verify_code'] = $verifycode;
		$run_max_pay_data_id = mysqli_query($con_srv, "SELECT MAX(CAST(payment_data_id as SIGNED)) from bdu_payment_data");
		$row_max_pay_data_id = mysqli_fetch_row($run_max_pay_data_id);
		$pay_data_id = $row_max_pay_data_id[0] + 1;
		$_SESSION['payment_data_id'] = $pay_data_id;
		$payment_data_qry = "INSERT INTO bdu_payment_data(payment_data_id, payment_type_code, bank_name, billed_by, reference_number, date_of_receipt, invoice_id, verify_code) VALUES ('" . $pay_data_id . "', '" . $pay_mthd . "', '" . $bank_name . "', '" . $name . "', '" . $ref_num . "', CURRENT_TIMESTAMP, '" . $inv_id . "', '" . $verifycode . "')";
		$run_payment_data_qry = mysqli_query($con_srv, $payment_data_qry);
		$run_max_shipment_status_id = mysqli_query($con_srv, "SELECT MAX(CAST(shipment_status_id as SIGNED)) from bdu_shipment_status");
		$row_max_shipment_status_id = mysqli_fetch_row($run_max_shipment_status_id);
		$shipment_status_id = $row_max_shipment_status_id[0] + 1;
		$shipment_status_qry = "INSERT INTO bdu_shipment_status(shipment_status_id, sh_id, ship_stat_cat_code, status_time, notes) VALUES ('" . $shipment_status_id . "', '" . $ship_id . "', '" . $ord_status . "', CURRENT_TIMESTAMP, '')";
		$run_shipment_status_qry = mysqli_query($con_srv, $shipment_status_qry);
		//$orderqry = "INSERT INTO bdu_order(o_id, cu_id, o_total_qty, o_date, o_status, o_total_price, coupon_code, cu_email, discout, ordered_delivery_date, order_paid_date, order_number,order_remark, payment_type_code, shipment_status_cat_code, shipment_type_code, shipping_charge, total_wight)  VALUES ('',  '" . $cust_id . "', '" . $qty_total . "',  CURRENT_TIMESTAMP, '', '" . $_SESSION['g_price'] . "', '".$coupon_price."', '" . $c_email . "', '" . $discount . "', '',  '', '" . $ord_num . "', '', '" . $pay_mthd . "', '" . $ord_status . "', '" . $shipment_type . "',  '" . $shipping_charge . "', '')";
        $orderqry = "INSERT INTO `bdu_order`(`o_id`, `cu_id`, `o_total_qty`, `o_date`, `o_status`, `o_total_price`, `coupon_code`, `cu_email`, `discout`,  `ordered_delivery_date`, `order_paid_date`, `order_number`, `order_remark`, `payment_type_code`, `shipment_status_cat_code`, `shipment_type_code`, `shipping_charge`, `total_wight`)VALUES ($shipment_status_id,$cust_id,$qty_total,CURRENT_TIMESTAMP,1,$ord_price_total ,$coupon_price,1,$discount,CURRENT_TIME,CURRENT_TIMESTAMP,$ord_num,1,$pay_mthd,$ord_status,$shipment_type,$shipping_charge,1)";
		$run_ordqry = mysqli_query($con_srv, $orderqry);
		if (!$run_ordqry) {
			echo '<script language="javascript">alert("Something Go Wrong. Please Try Again.")</script>';
		} else {
			//FOR LOCALHOST ONLY - OFFLINE TEST
								//header("Location: order-received.php?order_number=$ord_num");
								//unset($_SESSION["cart_item"]);
							//FOR LOCALHOST ONLY - OFFLINE TEST
			echo '<script language="javascript">alert("Thank You. Order Submitted Successfully.")</script>';
			$run_ord_id = mysqli_query($con_srv, "SELECT CAST(o_id as SIGNED) FROM bdu_order WHERE order_number='" . $ord_num . "'");
			$row_ord_id = mysqli_fetch_row($run_ord_id);
			$ord_id = $row_ord_id[0];
			foreach ($_SESSION["cart_item"] as $item_d) {
				$item_price = $item_d["quantity"] * $item_d["sale_price"];
				//$order_detail_qry = "INSERT INTO bdu_order_detail(od_id, o_id, od_qty, p_id, od_price, order_number, sub_total_price, unit_price) VALUES ('" . $ord_id . "', '" . $ord_id . "', '" . $item_d["quantity"] . "', '" . $item_d["p_id"] . "',  '" . $item_price . "', '" . $ord_num . "', '" . $item_d["sale_price"] . "', '')";
				$quantity=$item_d["quantity"];
				$pid=$item_d["p_id"];
				$price=$item_d["sale_price"];
				$order_detail_qry ="INSERT INTO `bdu_order_detail`(`od_id`, `o_id`, `od_qty`, `p_id`, `od_price`, `order_number`, `sub_total_price`, `unit_price`) VALUES ($ord_id,$ord_id,$quantity,$pid,$item_price,$ord_num,$price,1)";
				$run_ord_detail = mysqli_query($con_srv, $order_detail_qry);
			}
			$toEmail = $c_email;
			$ccEmail = "sireatag@gmail.com";
			$subject = "Your Order has been Received";
			$content = "Your Order Details - Invoice #: " . $inv_num . ", Number of Products: " . $qty_total . ", Total Price: " . $final_price . ".  Bank Accounts- Commercial Bank: 1000000 xyz, Dashen Bank: 10000002 xyz, United Bank: 10000003 xyz. After Making Payment Use this link to Confirm your Payment. " . "https://localhost/pay.php?verify_code=" . $_SESSION['verify_code'];
			$mailHeaders = "From: localhost\r\n";
			mail($toEmail, $subject, $content, $mailHeaders);
			mail($ccEmail, $subject, $content, $mailHeaders);
			unset($_SESSION["cart_item"]);
			//if($pay_mthd =3||$pay_mthd =4){
				//header("Location: index.php");
			//}else{
			header("Location: order-received.php?order_number=$ord_num");
		    //}
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
	<title>Checkout | One Tech</title>
	<meta name="description" content="Checkout onetech Home of Ethiopian Best online Store Order and Buy Online ecommerce ">
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

<body oncontextmenu="return false;">
	<div class="super_container">
		<!-- Header -->
		<?php include_once('header-menu.php');
		?><?php include_once('header-menu.php');
		?>
	</div>
	<section class="wn__checkout__area section-padding--lg bg__white">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="wn_checkout_wrap">
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
					<?php
					if (isset($_SESSION["cart_item"])) {
						$total_quantity = 0;
						$total_price = 0;
					?>
						<div class="wn__order__box">
							<h3 class="onder__title">Your Order Review</h3>
							<ul class="order__total">
								<li>Product</li>
								<li>Total</li>
							</ul>
							<?php
							foreach ($_SESSION["cart_item"] as $item) {
								$item_price = $item["quantity"] * $item["sale_price"];
							?>
								<ul class="order_product">
									<li><?php echo $item["p_name"]; ?> × <?php echo $item["quantity"]; ?><span><?php echo " $" . $item_price . " "; ?></span></li>
								</ul>
						<?php
								$total_quantity += $item["quantity"];
								$total_price += ($item["sale_price"] * $item["quantity"]);
							}
						} else {
							$total_quantity = 0;
							$total_price = 0;
						}
						?>
						<ul class="shipping__method">
							<li>Subtotal (<?php echo $total_quantity; ?> Products) <span><?php echo " $" . $total_price . " "; ?></span></li>
						</ul>
						<ul class="total__amount">
							<li>Total (<?php echo $total_quantity;
										$_SESSION['qty_total'] = $total_quantity; ?> Products) <span><?php echo " $" . $total_price . " ";
																								$_SESSION['g_price'] = $total_price; ?></span></li>
						</ul>
						</div>
						<div id="accordion" class="checkout_accordion mt--30" role="tablist">
							<form method="post" action="checkout.php">
								<div class="payment">
									<div class="che__header" role="tab">
										<a class="checkout__title" aria-expanded="true">
											<h3>Select Bank</h3>
										</a>
									</div>
								</div>
								<div class="payment">
									<div class="che__header" role="tab" id="headingOne">
										<a class="checkout__title" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
											<input type="radio" name="bank_name" value="CBE" checked> <span>Commercial Bank</span>
										</a>
									</div>
									<div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
										<div class="payment-body">0000000 abc xyz</div>
									</div>
								</div>
								<div class="payment">
									<div class="che__header" role="tab" id="headingOne">
										<a class="checkout__title" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
											<input type="radio" name="bank_name" value="Dashen"> <span>Dashen Bank</span>
										</a>
									</div>
									<div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
										<div class="payment-body">10000000 abc xyz</div>
									</div>
								</div>
								<div class="payment">
									<div class="che__header" role="tab" id="headingOne">
										<a class="checkout__title" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
											<input type="radio" name="bank_name" value="Abyssinia"> <span>Abyssinia Bank</span>
										</a>
									</div>
									<div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
										<div class="payment-body">20000000 abc xyz</div>
									</div>
								</div>
								<div class="payment">
									<div class="che__header" role="tab">
										<a class="checkout__title" aria-expanded="true">
											<h3>Payment Methods</h3>
										</a>
									</div>
								</div>
								<div class="payment">
									<div class="che__header" role="tab" id="headingOne">
										<a class="checkout__title" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
											<input type="radio" name="payment_method" value="1" checked> <span>Direct Bank Transfer</span>
										</a>
									</div>
									<div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
										<div class="payment-body">Make your payment directly into our bank account. Your order won’t be shipped until the funds have cleared in our account.</div>
									</div>
								</div>
								<div class="payment">
									<div class="che__header" role="tab" id="headingTwo">
										<a class="collapsed checkout__title" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
											<input type="radio" name="payment_method" value="2"><span>Mobile Banking</span>
										</a>
									</div>
									<div id="" class="" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
										<div class="payment-body">Pay with your Phone. You can keep the Screen Capture of your payment details for confirmation.</div>
									</div>
								</div>
								<div class="payment">
									<div class="che__header" role="tab" id="headingThree">
										<a class="collapsed checkout__title" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree">
											<input type="radio" name="payment_method" value="3"><span>Cash Payment at Store</span>
										</a>
									</div>
									<div id="collapseThree" class="" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
										<div class="payment-body">Pay with cash in Store after Putting your order.</div>
									</div>
								</div>
								<div class="payment">
									<div class="che__header" role="tab" id="headingThree">
										<a class="collapsed checkout__title" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree">
											<input type="radio" name="payment_method" value="4"><span>Cash Payment at Delivery</span>
										</a>
									</div>
									<div id="collapseThree" class="" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
										<div class="payment-body">Pay with cash while Receiving your Order.</div>
									</div>
								</div>
								<div class="payment">
									<div class="che__header" role="tab">
										<a class="checkout__title" aria-expanded="true">
											<h3>Shipment Type</h3>
										</a>
									</div>
								</div>
								<div class="payment">
									<div class="che__header" role="tab" id="headingOne">
										<a class="checkout__title" data-toggle="collapse" aria-expanded="true" aria-controls="collapseOne">
											<input type="radio" name="shipment_type" value="3" checked> <span>Home Delivery</span>
										</a>
									</div>
									<div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
										<div class="payment-body">After Making your payment, We will process your shipment and deliver your Products to the provided Home Address. Please Get in touch with your phone to Receive your Orders.</div>
									</div>
								</div>
								<div class="payment">
									<div class="che__header" role="tab" id="headingOne">
										<a class="collapsed checkout__title" data-toggle="collapse" href="#collapseThree1" aria-expanded="false" aria-controls="collapseThree">
											<input type="radio" name="shipment_type" value="1"> <span>Pick From Store</span>
										</a>
									</div>
									<div id="collapseTwo1" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
										<div class="payment-body">After Making your payment directly into our bank account, We will Organize and make ready of your Products. Please Come and Pick your Products Package instantly from Our Store.</div>
									</div>
								</div>
								<?php
								require_once('dbconnect.inc');
								$rum_maxordnum = mysqli_query($con_srv, "SELECT MAX(CAST(order_number as SIGNED)) from bdu_order");
								$row_maxordnum = mysqli_fetch_row($rum_maxordnum);
								$ord_num = $row_maxordnum[0] + 1;
								?>
						</div>
				</div>
				<div class="col-lg-6 col-12">
					<div class="customer_details">
						<div class="payment">
							<div class="wn__order__box">
								<h3 class="onder__title">Billing Details</h3>
							</div>
						</div>
						<small>The Following Information will help us for Delivery Option, Please Mention Your Address Information.</small>
						<div class="customer_details mt--20">
							<div class="customar__field mt--40">
								<div class="margin_between">
									<div class="input_box space_between">
										<label>First Name<span>*</span></label>
										<input type="text" name="fname" required value="<?php if (isset($_SESSION['User_Name'])) {
																							echo $ufname;
																						} else {
																						} ?>">
									</div>
									<div class="input_box space_between">
										<label>Last Name <span>*</span></label>
										<input type="text" name="lname" required value="<?php if (isset($_SESSION['User_Name'])) echo $umname;
																						else {
																						} ?>">
									</div>
								</div>
								<div class="margin_between">
									<div class="input_box space_between">
										<label>Country<span>*</span></label>
										<select class="select__option" name="country" required>
											<option>Select a country…</option>
											<option selected>Ethiopia</option>
										</select>
									</div>
									<div class="input_box space_between">
										<label>City/Town/Region<span>*</span></label>
										<select class="select__option" name="d_location" required>
											<option>Select a city</option>
											<option selected>Bahir Dar</option>
										</select>
									</div>
								</div>
								<div class="margin_between">
									<div class="input_box space_between">
										<label>Area<span>*</span></label>
										<select class="select__option" name="subcity" required class="form-control" id="env-select">
											<option selected>Select your Location</option>
											<option value="16">Kebelie 16</option>
											<option value="14">Kebelie 14</option>
											<option value="13">Kebelie 13</option>
											<option value="poly">Poly</option>
											<option value="abay">Abay Mado</option>
											<option value="poly">Poly</option>
											<option value="Lideta">Lideta</option>
											<option value="sebatamit">Sebatamit</option>
										</select>
									</div>
									<div class="input_box space_between">
										<label>Specific Address<span></span></label>
										<input type="text" name="billaddress" placeholder="Apartment, Block, House Number, etc" required>
									</div>
								</div>
								<div class="margin_between">
									<div class="input_box space_between">
										<label>Phone / Primary<span>*</span></label>
										<input type="text" name="phone1" placeholder="Your Current Mobile" required>
									</div>
									<div class="input_box space_between">
										<label>Phone / Secondary<span></span></label>
										<input type="text" name="phone2" placeholder="Additional Phone Number">
									</div>
								</div>
								<div class="margin_between">
									<div class="input_box space_between">
										<label>Postcode / ZIP<span></span></label>
										<input type="text" name="zipcode" placeholder="post code here">
									</div>
									<div class="input_box space_between">
										<label>Email address<span></span></label>
										<input type="email" name="c_email" placeholder="Your email to receive order details" value="<?php if (isset($_SESSION['User_Name'])) {
																																		echo $email;
																																	} else {
																																	} ?>">
									</div>
								</div>
								<div class="input_box">
									<label>Additional Information <span>(Optional)</span></label>
									<input type="text" placeholder="Notes about your Orders" name="additional_info">
								</div>
							</div>
						</div>
					</div>
					<?php
					?>
					<div class="">
						<div class="">
							<small>
								Please Note: Your Order will be Processed within A Day. Please check your email / spam folder for order confirmation after you click "place order" button OR Please Get in touch with your PHONE to Receive your Orders.
							</small>
							</br></br>
							<p>
							<h6>
								<p>
								<h6>Total item price: <?php echo " $" . $total_price . " "; ?></h6>
								</p>
								</br>
						</div>
					</div>
					<?php
					?>
					<div class="cartbox__btn">
						<ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
							<li><a href="shop.php">Shop</a></li>
							<li><button type="submit" name='placeorders' style="background: #35938b none repeat scroll 0 0; color: #fff;  border-radius: 5px;  display: block;  font-size: 16px;  height: 50px;  line-height: 50px;  padding: 0 26px;">Place&nbsp;Order</button></li>
						</ul>
					</div>
					</form>
					</br>
					<div class="payment-body">Get in touch
						</br></br>
						<p>
						<h5>CONTACT INFORMATION</h5>
						</p>
						<p><small class="icon-envelope icons">&nbsp; fastsales@gmail.com</small></p>
						<p><small class="icon-phone icons">&nbsp; +2519 0817 0601</small></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Checkout Area -->
	<!-- Newsletter -->
	<?php include_once('subscribe.php'); ?>
	<!-- Footer Area -->
	<?php include_once("footer.php"); ?>
	<!-- Copyright-->
	<?php include_once('copyright.php'); ?>
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/active.js"></script>

</body>

</html>
<script type="text/javascript">
	$(document).ready(function() {
		$('#env-select').on('change', function(e) {
			var source = $(this),
				val = $.trim(source.val()),
				target = $('#env_ddl');
			$(target).empty();
			if (typeof(_data[val]) != "undefined") {
				var options = (typeof(_data[val]) != "undefined") ? _data[val] : {};
				$('<option>Select your best location</option>').appendTo(target);
				$.each(options, function(value, index) {
					$('<option value="' + value + '">' + index + '</option>').appendTo(target);
				});
			}

		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#env_ddl').on('change', function(e) {
			var source = $(this),
				val = $.trim(source.val()),
				target = $('#env_ddl1');
			$(target).empty();
			if (typeof(_data1[val]) != "undefined") {
				var options = (typeof(_data1[val]) != "undefined") ? _data1[val] : {};
				//$('<option>Shipping Charge</option>').appendTo(target);
				$.each(options, function(value, index) {
					$('<option value="' + value + '">' + index + '</option>').appendTo(target);
				});
			}

		});
	});
</script>