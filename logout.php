<?php
session_start();

// Clear session data
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the homepage or any other page you prefer
header('Location: index.php');
exit();
?>
