<?php
  include_once 'dbsettings.php';
  error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
 // error_reporting(0);
  $con_srv = mysqli_connect($dbserver,$dbusername,$dbpassword) or die("No connection could be made please contact sys Admin.");
  $db_selected = mysqli_select_db($con_srv, $dbname) or die("Unable to Connect Please contact sysadmin.");
?>