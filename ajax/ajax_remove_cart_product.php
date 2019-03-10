<?php 
	session_start();
	$id = $_GET['id'];

	if($id == 0)
		unset($_SESSION['COUNT_PRODUCT']);
	else
		unset($_SESSION['COUNT_PRODUCT'][$id]);
	header('location: ../order.php');
	exit();
?>