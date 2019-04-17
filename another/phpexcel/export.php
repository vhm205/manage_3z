<?php

require('Classes/PHPExcel.php');
require('connect/db_connect.php');

if(isset($_POST['btnExport'])){
	$objExcel = new PHPExcel;
	$objExcel->setActiveSheetIndex(0);
	$sheet = $objExcel->getActiveSheet()->setTitle('10A1');

	$rowCount = 1;
	$sheet->setCellValue('A'.$rowCount,'Họ tên');
	$sheet->setCellValue('B'.$rowCount,'Toán');
	$sheet->setCellValue('C'.$rowCount,'Lý');
	$sheet->setCellValue('D'.$rowCount,'Hóa');

	$result = $mysqli->query("SELECT diem.name,toan,ly,hoa FROM diem INNER JOIN lop ON lop.id=diem.id_lop WHERE lop.name='10A1'");
	while($row = mysqli_fetch_array($result)){
		$rowCount++;
		$sheet->setCellValue('A'.$rowCount,$row['name']);
		$sheet->setCellValue('B'.$rowCount,$row['toan']);
		$sheet->setCellValue('C'.$rowCount,$row['ly']);
		$sheet->setCellValue('D'.$rowCount,$row['hoa']);
	}

	$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
	$filename = 'export.xlsx';
	$objWriter->save($filename);

	header('Content-Disposition: attachment; filename="' . $filename . '"');  
	header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');  
	header('Content-Length: ' . filesize($filename));  
	header('Content-Transfer-Encoding: binary');  
	header('Cache-Control: must-revalidate');  
	header('Pragma: no-cache');  
	readfile($filename);  
	return;

}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Export data</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<form method="POST">
		<button name="btnExport" type="submit">Xuất file</button>
	</form>
</body>
</html>