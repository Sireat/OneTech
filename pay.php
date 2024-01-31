<?php
require('dbconnect.inc');
error_reporting();
session_start();
require_once('dbconnect.inc');
if (isset($_GET['verify_code'])) {
	$vcode = mysqli_real_escape_string($con_srv, $_GET['verify_code']);
	$_SESSION['verify_code'] = $vcode;
	$chk_cust_pay = mysqli_query($con_srv, "SELECT * FROM bdu_payment_data, bdu_invoice_table WHERE bdu_payment_data.invoice_id=bdu_invoice_table.invoice_id AND bdu_payment_data.verify_code ='" . $vcode . "' ") or die("MISSION FAILEDs");

	$chk_cust_pay_rows = mysqli_num_rows($chk_cust_pay);
	if ($chk_cust_pay_rows == 0) {
		header("Location: 404.php");
		exit();
	} else {
		require_once('dbconnect.inc');
		$result_pay = mysqli_query($con_srv, "SELECT * FROM bdu_payment_data, bdu_invoice_table, bdu_shipment WHERE bdu_payment_data.invoice_id=bdu_invoice_table.invoice_id AND bdu_shipment.invoice_id=bdu_invoice_table.invoice_id AND bdu_payment_data.verify_code ='" . $_SESSION['verify_code'] . "' ") or die("MISSION FAILED");
		$pay_num_rows = mysqli_num_rows($result_pay);

		if ($pay_num_rows == 0) {
			header("Location:404.php");
			exit();
		} else {

			$pay_raw = mysqli_fetch_array($result_pay);
			$pay_made_data_id = $pay_raw['payment_data_id'];
			$_SESSION['pay_made_data_id'] = $pay_made_data_id;

			$pay_made_inv_id = $pay_raw['invoice_id'];
			$_SESSION['invoice_id'] = $pay_made_inv_id;

			$inv_num = $pay_raw['invoice_number'];
			$_SESSION['invoice_number'] = $inv_num;

			$shipment_id = $pay_raw['sh_id'];
			$_SESSION['shipment_id'] = $shipment_id;

			$qty = $pay_raw['qty_total'];
			$_SESSION['quantity_total'] = $qty;

			$tot_price = $pay_raw['final_price'];
			$_SESSION['final_price'] = $tot_price;
		}
	}
}
if (isset($_REQUEST['confirm_pay'])) {
	$fname = htmlspecialchars($_REQUEST['fname'], ENT_QUOTES);
	$lname = htmlspecialchars($_REQUEST['lname'], ENT_QUOTES);
	$billed_by = $fname . ' ' . $lname;
	$bdate = htmlspecialchars($_REQUEST['bdate'], ENT_QUOTES);
	$bmonth = htmlspecialchars($_REQUEST['bmonth'], ENT_QUOTES);
	$byear = htmlspecialchars($_REQUEST['byear'], ENT_QUOTES);
	$receipt_date = $byear . '-' . $bmonth . '-' . $bdate;
	$ref_num = htmlspecialchars($_REQUEST['ref_num'], ENT_QUOTES);
	$bank_name = htmlspecialchars($_REQUEST['bank'], ENT_QUOTES);

	require_once('dbconnect.inc');
	$chk_pay_dt = mysqli_query($con_srv, "SELECT * FROM bdu_payment_data WHERE invoice_id = '" . $_SESSION['invoice_id'] . "' AND payment_data_id ='" . $_SESSION['pay_made_data_id'] . "' AND bdu_payment_data.state='Paid' ") or die("MISSION FAILED");
	$pay_dt = mysqli_num_rows($chk_pay_dt);
	if ($pay_dt != 0) {
		//echo '<script language="javascript">alert("Payment Submitted. Please Wait Until Confirmed.")</script>';
		header("Location: payment-submitted.php");
		exit();
	} else {
		$confirm_payment_qry = "UPDATE bdu_payment_data SET bank_name='" . $bank_name . "', billed_by='" . $billed_by . "',reference_number='" . $ref_num . "',date_of_receipt='" . $receipt_date . "', state='Paid' WHERE bdu_payment_data.payment_data_id ='" . $_SESSION['pay_made_data_id'] . "' and bdu_payment_data.invoice_id ='" . $_SESSION['invoice_id'] . "'";
		$run_confirm_payment_qry = mysqli_query($con_srv, $confirm_payment_qry);
		if (!$run_confirm_payment_qry) {
			//echo '<script language="javascript">alert("Something Go Wrong. Please Try Again.")</script>';
			header("Location:index.php");
			exit();
		} else {
			$chk_pay_det = mysqli_query($con_srv, "SELECT * FROM bdu_payment_detail WHERE sh_id = '" . $_SESSION['shipment_id'] . "' AND payment_data_id ='" . $_SESSION['pay_made_data_id'] . "' ") or die("MISSION FAILED");
			$pay_det = mysqli_num_rows($chk_pay_det);
			if ($pay_det != 0) {
				echo '<script language="javascript">alert("Payment Submitted. Please Wait Until Confirmed.")</script>';
				header("Location:payment-submitted.php");
				exit();
			} else {
				$run_pay_detail_id = mysqli_query($con_srv, "SELECT MAX(CAST(payment_detail_id as SIGNED)) FROM bdu_payment_detail");
				$row_pay_detail_id = mysqli_fetch_row($run_pay_detail_id);
				$pay_detail_id = $row_pay_detail_id[0] + 1;
				//$pay_detail_qry = "INSERT INTO bdu_payment_detail(payment_detail_id,payment_data_id, shipment_id,  value) VALUES ('" . $pay_detail_id . "', '" . $_SESSION['pay_made_data_id'] . "','" . $_SESSION['sh_id'] . "', '" . $_SESSION['final_price'] . "')";
                $pay_detail_qry = "INSERT INTO `bdu_payment_detail`(`payment_detail_id`, `payment_data_id`, `sh_id`, `value`) VALUES ($pay_detail_id,$pay_made_data_id,$shipment_id,$tot_price)";
				$run_pay_detail_qry = mysqli_query($con_srv, $pay_detail_qry);
				$update_status_qry = "UPDATE bdu_shipment_status SET ship_stat_cat_code='2' WHERE bdu_shipment_status.sh_id ='" . $_SESSION['shipment_id'] . "' ";
				$run_update_status_qry = mysqli_query($con_srv, $update_status_qry);
				$email = $_SESSION['email'];

				$toEmail = $email;
				$ccEmail = "sireatag@gmail.com";
				$subject = "Your Payment Information has been received";
				$content = "Your Payment Information is Received for Invoice # " . $_SESSION['invoice_number'] . ". If the Payment Detail You Submitted is Correct, Your Order will be Approved and Processed. Get in touch with your Phone. Thank You For Shopping. OneTech https://localhost.com/";
				$mailHeaders = "From: localhost.com\r\n";
				mail($toEmail, $subject, $content, $mailHeaders);
				mail($ccEmail, $subject, $content, $mailHeaders);
				header("Location:payment-review.php");
				exit();
			}
		}
	}
}
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Pay | OneTech</title>
	<meta name="description" content="Pay Online Order Bank Transfer OneTech Home of Ethiopian Best Ethiopian Online Store Order and Buy Products Online ecommerce OneTech">
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
		<!-- Start Checkout Area -->
		<section class="wn__checkout__area bg__white">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-12">
					</div>
					<div class="col-lg-6 col-12">
						<div class="wn_checkout_wrap">
							<form method="post" action="pay.php">
								<div class="customer_details">
									<div class="payment">
										<div class="wn__order__box">
											<h3 class="onder__title">Please Confirm Your Payment</h3>
										</div>
									</div>
									<div class="collapse show">
									</div>
									<div class="account__form" style="background-color:#A93636; color:#FFFFFF;">
										<span>Please fill this form After You Make Payment!</span>
									</div>
									<div class="customar__field account__form">


										<div class="account__form" style="background-color:#efeffe; color:#366636;">
											<h5>Order Summary</h5>
											<p>Invoice #: <?php echo $inv_num; ?></p>
											<p>Quantity: <?php echo $qty ?></p>
											<p>Total: <?php echo "$" . number_format($tot_price, 2); ?></p>
										</div>
										<center><label><b>Select Bank</b></label></center>
										<div class="margin_between">


											<div class="input_box space_between account__form">
												<input type="radio" name="bank" value="CBE" <?php if (isset($_REQUEST['bank']) && $_REQUEST['bank'] == "CBE") { ?>checked<?php  } ?>>
												<center><label>Commercial Bank</label></center>
											</div>

											<div class="input_box space_between account__form">
												<input type="radio" name="bank" value=" Abyssinia" <?php if (isset($_REQUEST['bank']) && $_REQUEST['bank'] == " Abyssinia") { ?>checked<?php  } ?>>
												<center><label> Abyssinia Bank</label></center>
											</div>

											<div class="input_box space_between account__form">
												<input type="radio" name="bank" value="Dashen" <?php if (isset($_REQUEST['bank']) && $_REQUEST['bank'] == "Dashen") { ?>checked<?php  } ?>>
												<center><label>Dashen Bank</label></center>
											</div>
										</div>
										<div class="margin_between">
											<div class="input_box space_between">
												<label>First Name <span>*</span></label>
												<input type="text" name="fname" required>
											</div>
											<div class="input_box space_between">
												<label>Last Name <span>*</span></label>
												<input type="text" name="lname" required>
											</div>
										</div>
										<div class="input_box">
											<label>Reference Number</label>
											<input type="text" name="ref_num" placeholder="Ref # on Bank Slip" required>
										</div>

										<div class="margin_between">
											<div class="input_box space_between">

												<input type="text" name="bdate" placeholder="DD" required>
											</div>
											-
											<div class="input_box space_between">

												<input type="text" name="bmonth" placeholder="MM" required>
											</div>
											-
											<div class="input_box space_between">

												<input type="text" name="byear" placeholder="YYYY" required>
											</div>
										</div>

										<center>
											<div class="">
												<button type="submit" name="confirm_pay" style="background: #35938b none repeat scroll 0 0; color: #fff;  border-radius: 5px;  display: block;  font-size: 16px;  height: 50px;  line-height: 50px; width:300px">Confirm&nbsp;Payment</button>

											</div>
										</center>
									</div>
									<div class="">
										<small>
											እባክዎን ያስተውሉ-ትዕዛዝዎ በአንድ ቀን ውስጥ ይካሄዳል ፡፡ ለትዕዛዝ ማረጋገጫ እባክዎ የኢሜል / አይፈለጌ መልዕክት አቃፊዎን ይፈትሹ ወይም ትዕዛዞትን ለመቀበል «Confirm Payment» የሚለውን ጠቅ ካደረጉ በኋላ ትዕዛዞትን ለመቀበል ስልክዎን በአቅራቢያዎ ያኑሩ።
											</br></br>
										</small>
									</div>
									<div class="payment-body">
										</br>
										<p>
										<h5>Contact Info</h5>
										</p>
										<p><small class="icon-envelope icons">&nbsp; fastsales@gmail.com</small></p>
										<p><small class="icon-phone icons">&nbsp; +2519 0817 0601</small></p>
									</div>
									</br>
									</br>
								</div>
							</form>
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
	</div>
	<!-- JS Files -->
	<script src="js/vendor/jquery-3.2.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/active.js"></script>

</body>

</html>