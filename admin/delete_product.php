<?php 
	include '../config/config.php';
	include '../inc/connect.php';

	$conn = new Connection();
	
	if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT, array('min_range' => 1))){
		$id = $_GET['id'];
		$where = "ID = {$id}";
		$result = $conn -> getRowByWhere('product', $where, 'IMAGE');
		unlink($result['IMAGE']);
		$conn -> remove('product', $id);
		header('location: list_product.php');
	} else {
		header('location: list_product.php');
		exit();
	}
?>