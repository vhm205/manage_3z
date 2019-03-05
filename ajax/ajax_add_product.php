<?php 
	session_start();
	$id = $_POST['id'];
	$price = $_POST['price'];
	
	// if(isset($_SESSION['PRODUCT'][$id])){
	// 	$count = $_SESSION['PRODUCT'][$id] + 1;
	// } else{
	// 	$count = 1;
	// }

	if(isset($_SESSION['PRODUCT'])){
		$json = array('ID' => $id, 'PRICE' => $price);
		$json = json_encode($_SESSION['PRODUCT']['DETAIL']);
		// $json = json_decode($_SESSION['PRODUCT']['DETAIL'], TRUE);
		echo $json . ' ' . gettype($json);
	} else {
		$arr = array('ID' => $id, 'PRICE' => $price);
		$json = json_encode($arr);
		echo $json . ' ' . gettype($json);
	}

	// $_SESSION['PRODUCT'][$id] = $count;
	$_SESSION['PRODUCT']['DETAIL'] = $json;
?>