<?php 
	session_start();

	$id 	= $_GET['id'];
	$index  = $_GET['index'];

	if($id !== 0)
		unset($_SESSION['ALL_MENU'][$index][$id]);

	header('location: ../detail_menu.php?index=' . $index);
?>