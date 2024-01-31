<?php
require('dbconnect.inc');
error_reporting(1);
session_start();
if (isset($_GET['logout'])) {
	unset($_SESSION['User_Name']);
	unset($_SESSION["cart_item"]);
	header('Location: index.php');
	exit();
}
if (isset($_SESSION['User_Name'])) {
	header('Location: cart.php');
	exit();
}
$errors5 = '';
if (isset($_REQUEST['submit'])) {
	$unam = htmlspecialchars($_REQUEST['Username'], ENT_QUOTES);
	$upas = htmlspecialchars($_REQUEST['Userpassword'], ENT_QUOTES);
	$epass = md5($upas);
	$st = "select * from bdu_user_account where user_email ='" . $unam . "' and user_password =ENCODE('" . $epass . "','balesouq') and User_Status='1'";
	$qry = mysqli_query($con_srv, $st);
	$num_rows = mysqli_num_rows($qry);
	if ($num_rows == 0) {
		$errors5 .= " Invalid Account! ";
	}
	if (empty($errors4) && empty($errors5)) {
		while ($rs = mysqli_fetch_array($qry)) {
			$_SESSION['User_Name'] = $rs['user_email'];
			$_SESSION['User_Id'] = $rs['user_id'];
			$_SESSION['User_Fname'] = $rs['user_fname'];
			$_SESSION['User_Mname'] = $rs['user_mname'];
			$uid = $rs['user_id'];
			$redirect = 'cart.php';
			header('Location: ' . $redirect);
			exit();
		}
	}
}
// Function to validate against any email injection attempts
function IsInjected($str)
{
	$injections = array(
		'(\n+)',
		'(\r+)',
		'(\t+)',
		'(%0A+)',
		'(%0D+)',
		'(%08+)',
		'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if (preg_match($inject, $str)) {
		return true;
	} else {
		return false;
	}
}
$errors6 = '';
$errors7 = '';
$errors8 = '';
$errors9 = '';
$errors10 = '';
$conf_msg = '';
$msg_subscribe = '';
require_once('dbconnect.inc');
if (isset($_REQUEST['register'])) {
	$Ufname = htmlspecialchars($_REQUEST['Ufname'], ENT_QUOTES);
	$Umname = htmlspecialchars($_REQUEST['Umname'], ENT_QUOTES);
	$Upass = htmlspecialchars($_REQUEST['Upass'], ENT_QUOTES);
	$Rupass = htmlspecialchars($_REQUEST['Rupass'], ENT_QUOTES);
	$Uemail = htmlspecialchars($_REQUEST['Uemail'], ENT_QUOTES);
	if (strlen($Upass) < 6) {
		$errors10 .= "Password length should be More Than 6";
	}
	if (strcmp($Upass, $Rupass) != 0) {
		$errors8 .= "Password Do Not Match";
	}
	$regstatement = "SELECT * FROM bdu_user_account WHERE user_email= '" . $Uemail . "'";
	$creg = mysqli_query($con_srv, $regstatement);
	$creg_num_rows = mysqli_num_rows($creg);
	if ($creg_num_rows != 0) {
		$errors7 .= "This User Account is already registered. Thanks.!";
	}
	if (empty($errors7) && empty($errors8) && empty($errors10)) {
		$hashedPassword = md5($_POST["Upass"]);
		$regqry = "INSERT INTO bdu_user_account (user_id, user_fname, user_mname, user_email, user_password, user_status, registration_date) VALUES (NULL, '" . $Ufname . "', '" . $Umname . "', '" . $Uemail . "', ENCODE('" . $hashedPassword . "','balesouq'), '1', CURRENT_TIMESTAMP)";
		if (mysqli_query($con_srv, $regqry)) {
			$conf_msg = "Registered successfully.";
		} else {
			$errors9 .= "Registration Error: " . mysqli_error($con_srv); // Debugging: Display the specific error message from MySQL
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login & Registration</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		.container {
			margin-top: 50px;
		}

		.error {
			color: #FF0000;
		}

		.success {
			color: #006600;
		}

		.link {
			cursor: pointer;
			color: #337ab7;
			text-decoration: underline;
		}
	</style>
</head>

<body>
	<div class="super_container">
		<!-- Header -->
		<?php include_once('header-menu.php'); ?>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2 id="login">Login</h2>
				<form action="" method="post" name="login">
					<div class="form-group">
						<label for="Username">Username:</label>
						<input type="text" class="form-control" name="Username" required>
					</div>
					<div class="form-group">
						<label for="Userpassword">Password:</label>
						<input type="password" class="form-control" name="Userpassword" required>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" name="submit" value="Login">
					</div>
					<div class="error"><?php echo $errors5; ?></div>
				</form>
			</div>
			<div class="col-md-6">
				<h2 id="register">Registration</h2>
				<form action="" method="post" name="register">
					<div class="form-group">
						<label for="Ufname">First Name:</label>
						<input type="text" class="form-control" name="Ufname" required>
					</div>
					<div class="form-group">
						<label for="Umname">Middle Name:</label>
						<input type="text" class="form-control" name="Umname">
					</div>
					<div class="form-group">
						<label for="Uemail">Email:</label>
						<input type="email" class="form-control" name="Uemail" required>
					</div>
					<div class="form-group">
						<label for="Upass">Password:</label>
						<input type="password" class="form-control" name="Upass" required>
					</div>
					<div class="form-group">
						<label for="Rupass">Repeat Password:</label>
						<input type="password" class="form-control" name="Rupass" required>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" name="register" value="Register">
					</div>
					<div class="success"><?php echo $conf_msg; ?></div>
					<div class="error"><?php echo $errors7; ?></div>
					<div class="error"><?php echo $errors8; ?></div>
					<div class="error"><?php echo $errors10; ?></div>
					<div class="error"><?php echo $errors9; ?></div>
				</form>
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