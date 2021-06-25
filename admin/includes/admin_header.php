<?php ob_start() ?>
<?php session_start(); ?>
<?php include "../include/db.php"; ?>
<?php include "admin_function.php"; ?>

<!-- đăng nhập mới vào đc page admin -->
<?php
if (!isset($_SESSION['user_role'])) {
    header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/logo_transparent.png" type="image/gif" sizes="20x20">
    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">



    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">




    <!-- Text Editor -->
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script> -->
    <script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>

    <!-- Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- CKFinder -->
    <script src="../admin/ckfinder/ckfinder.js"></script>
    <!-- Data table -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Custom CSS -->
    <link href="../admin/css/style.css" rel="stylesheet">

    <script src="../js/index1.js"></script>

<body>