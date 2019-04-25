<?php
	session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	include_once '../config/config.php';
	include_once '../inc/connect.php';

	$index        = $_REQUEST['index'];
	$total_money  = $_REQUEST['total_money'];
	$total_amount = $_REQUEST['total_amount'];
	$month        = date('m');
	$year         = date('Y');
	$date_create  = date('Y-m-d');
	$time 		  = date('h:i:s a');
	$detail       = json_encode($_SESSION['ALL_MENU'][$index], JSON_UNESCAPED_UNICODE);
	$data         = array($month, $year, $total_money, $total_amount, $date_create, $time, $detail);

	$conn = new Connection();

	if($conn->insert('reports_revenue', $data))
		unset($_SESSION['ALL_MENU'][$index]);
?>