<?php 
	session_start();
	if(isset($_SESSION['USERNAME']))
		unset($_SESSION['USERNAME']);

	header('location: ./login.php');
	exit();
?>