<?php 
	error_reporting(E_ALL ^ E_NOTICE);
	session_start();
	$_SESSION['BASE_URL'] = 'http://localhost/blog/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Quản lý quán Coffee </title>
	<link crossorigin href="//use.fontawesome.com" rel="preconnect">
	<link crossorigin href="//maxcdn.bootstrapcdn.com" rel="preconnect">
	<link crossorigin href="//bootswatch.com" rel="preconnect">
	<link crossorigin href="//cdnjs.cloudflare.com" rel="preconnect">
	<link crossorigin href="//code.jquery.com" rel="preconnect">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" />
	<link rel="stylesheet" href="https://bootswatch.com/4/materia/bootstrap.min.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo $_SESSION['BASE_URL'] ?>assets/css/animate.min.css"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>
<body>