<?php session_start(); ?>
<?php
$_SESSION['username'] = null;
$_SESSION['user_role'] = null;
$_SESSION['user_password'] = null;
$_SESSION['user_email'] = null;
$_SESSION['userId'] = null;

header("Location: ../index.php");

?>