<?php 
	session_start();

	$index = strip_tags($_GET['index']);

	if(isset($_SESSION['ALL_MENU']))
		unset($_SESSION['ALL_MENU'][$index]);

	if(isset($_SESSION['SPLIT_TABLE'])){
		$items = [];
		$all_datas = $_SESSION['ALL_MENU'];
		foreach ($all_datas as $key => $value) {
			$items[] = $value[0]['TABLE'];
		}
		$_SESSION['SPLIT_TABLE'] = $items;
	}

	header('location: ./manage.php');
	exit();
?>