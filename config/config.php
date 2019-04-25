<?php 
	define('BASE_URL', 'http://localhost/blog/');
	define('HOSTNAME', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', '');
	define('DBNAME', 'ql_nhahang');

	function safe($dataStr){
		$dataStr = strip_tags($dataStr);
		$dataStr = stripcslashes($dataStr);
		$dataStr = trim($dataStr);
		return $dataStr;
	}
?>