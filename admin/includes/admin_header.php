<!-- This function ob_start will send everything at once, avoiding issues like header() -->
<?php ob_start(); ?>
<!-- Use the session started in Login.php -->
<?php session_start(); ?>

<!-- Show the admin page only to ADMIN users -->
<?php 
    
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {

        header("Location: ../index.php");

    }
?>

<!-- This will avoid to have it in different files such as index and categories -->
<?php include "../includes/db.php" ?>

<!-- Includes the functions file -->
<?php include "functions.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- tinyMCE issues with substr() since it breaks the html 
    <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
    -->
</head>

<body>