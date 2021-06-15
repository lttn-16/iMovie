<?php session_start(); ?>

<?php
$_SESSION['username'] = null;
$_SESSION['user_role'] = null;
$_SESSION['user_password'] = null;
$_SESSION['user_email'] = null;
$_SESSION['userId'] = null;
unset($_SESSION['access_token']);

header("Location: ../index.php");

?>