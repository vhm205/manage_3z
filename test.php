<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Web Test </title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
	<?php
		include './inc/Classes/PHPExcel.php';
		include './config/config.php';
		include './inc/connect.php';

		$conn = new Connection();
		$fields = "MONTH, YEAR, SUM(TOTAL_AMOUNT) AS SUM_AMOUNT, SUM(TOTAL_MONEY)";
		$where 	= "0 = 0 GROUP BY MONTH, YEAR ORDER BY ID DESC";
		$data 	= $conn->getDataByWhere('reports_revenue', $where, $fields);
		$data 	= json_decode(json_encode($data), true);

		echo '<pre>';
		var_dump($data);
		echo '</pre>';


		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$objExcel = new PHPExcel();
			$objExcel->setActiveSheetIndex(0);
			$sheet = $objExcel->getActiveSheet()->setTitle('Demo Excel');

			$rowCount = 1;
			$sheet->setCellValue('A'.$rowCount, 'MONTH');
			$sheet->setCellValue('B'.$rowCount, 'YEAR');
			$sheet->setCellValue('C'.$rowCount, 'TOTAL MONEY');
			$sheet->setCellValue('D'.$rowCount, 'DATE CREATE');
			$sheet->setCellValue('E'.$rowCount, 'TIME');

			$sheet->getColumnDimension('C')->setAutoSize(true);
			$sheet->getColumnDimension('D')->setAutoSize(true);
			$sheet->getColumnDimension('E')->setAutoSize(true);
			$sheet->getColumnDimension('A')->setWidth(10);
			$sheet->getColumnDimension('B')->setWidth(10);
			$sheet->getStyle('A1:E1')->getFont()->setBold(true);

			$conn 	= new Connection();
			$fields = "MONTH, YEAR, TOTAL_MONEY, DATE_CREATE, TIME";
			$result = $conn->getDataByWhere('reports_revenue', "0 = 0", $fields);
			$result = json_decode(json_encode($result), true);

			foreach ($result as $value) {
				$rowCount++;
				$sheet->setCellValue('A'.$rowCount, $value['MONTH']);
				$sheet->setCellValue('B'.$rowCount, $value['YEAR']);
				$sheet->setCellValue('C'.$rowCount, $value['TOTAL_MONEY']);
				$sheet->setCellValue('D'.$rowCount, $value['DATE_CREATE']);
				$sheet->setCellValue('E'.$rowCount, $value['TIME']);
			}

			$sheet->getStyle("A1:A$rowCount")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle("B1:B$rowCount")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle("C1:C$rowCount")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle("D1:D$rowCount")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle("E1:E$rowCount")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
			$fileName = 'export.xlsx';
			$objWriter->save($fileName);

			header('Content-Disposition: attachment; filename="' . $fileName . '"');
			header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
			header('Content-Length: ' . filesize($fileName));
			header('Content-Tranfer-Encoding: binary');
			header('Cache-Control: must-revalidate');
			header('Pragma: no-cache');
			readfile($fileName);
			return;
		}
	?>


	<div class="container">
		<div class="row">
			<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
				<form action="" method="POST" role="form">
					<legend>Demo export excel</legend>
				
					<div class="form-group">
						<label for="excel">File Excel</label>
						<input type="text" class="form-control" id="excel" placeholder="Input field">
					</div>

					<button type="submit" name="sm" class="btn btn-primary">Export</button>
				</form>
			</div>
		</div>
	</div>

	 <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>


