<?php 
	session_start();
	$id = strip_tags($_REQUEST['id']);
	
	if(isset($_SESSION['COUNT_PRODUCT'][$id]))
		$count = $_SESSION['COUNT_PRODUCT'][$id] + 1;
	else
		$count = 1;

	$_SESSION['COUNT_PRODUCT'][$id] = $count;
?>