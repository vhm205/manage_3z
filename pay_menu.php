<?php
	session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	include_once './config/config.php';
	include_once './inc/connect.php';

	$index = $_REQUEST['index'];
	$total_money = $_REQUEST['total_money'];
	$total_amount = $_REQUEST['total_amount'];
	$month = date('m');
	$date_create = date('Y-m-d h:i:sa');
	$detail = json_encode($_SESSION['ALL_MENU'][$index], JSON_UNESCAPED_UNICODE);
	$data = array($month, $total_money, $total_amount, $date_create, $detail);

	$conn = new Connection();

	if($conn->insert('reports_revenue', $data))
		unset($_SESSION['ALL_MENU'][$index]);
?>