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

	function exportReports($title, $data, $type = '', $fileName = 'Thống kê hóa đơn.xlsx'){
		$objExcel = new PHPExcel();
		$objExcel->setActiveSheetIndex();
		$sheet = $objExcel->getActiveSheet()->setTitle($title);

		$rowCount = 1;
		if($type === 'default'){
			$sheet->setCellValue('A'.$rowCount, 'THÁNG');
			$sheet->setCellValue('B'.$rowCount, 'NĂM');
			$sheet->setCellValue('C'.$rowCount, 'SỐ LƯỢNG');
			$sheet->setCellValue('D'.$rowCount, 'TỔNG TIỀN');
			$sheet->setCellValue('E'.$rowCount, 'NGÀY TẠO');
			$sheet->setCellValue('F'.$rowCount, 'THỜI GIAN');

			$sheet->getColumnDimension('C')->setAutoSize(true);
			$sheet->getColumnDimension('D')->setAutoSize(true);
			$sheet->getColumnDimension('E')->setAutoSize(true);
			$sheet->getColumnDimension('F')->setAutoSize(true);
			$sheet->getColumnDimension('A')->setWidth(10);
			$sheet->getColumnDimension('B')->setWidth(13);
			$sheet->getStyle('A1:F1')->getFont()->setBold(true);
			$total_money = 0;
			$total_amount = 0;
			foreach ($data as $value) {
				$rowCount++;
				$sheet->setCellValue('A'.$rowCount, $value['MONTH']);
				$sheet->setCellValue('B'.$rowCount, $value['YEAR']);
				$sheet->setCellValue('C'.$rowCount, $value['TOTAL_AMOUNT']);
				$sheet->setCellValue('D'.$rowCount, number_format($value['TOTAL_MONEY'], 0, ',', ','));
				$sheet->setCellValue('E'.$rowCount, $value['DATE_CREATE']);
				$sheet->setCellValue('F'.$rowCount, $value['TIME']);
				$total_money += $value['TOTAL_MONEY'];
				$total_amount += $value['TOTAL_AMOUNT'];
			}
			$sheet->setCellValue('B'.($rowCount+1), 'Tổng cộng: ');
			$sheet->setCellValue('C'.($rowCount+1), number_format($total_amount, 0, ',', ','));
			$sheet->setCellValue('D'.($rowCount+1), number_format($total_money, 0, ',', ','));
			$sheet->getStyle("C".($rowCount+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle("D".($rowCount+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		} elseif($type === 'special'){
			$sheet->setCellValue('A'.$rowCount, 'ID');
			$sheet->setCellValue('B'.$rowCount, 'THÁNG');
			$sheet->setCellValue('C'.$rowCount, 'NĂM');
			$sheet->setCellValue('D'.$rowCount, 'SỐ LƯỢNG');
			$sheet->setCellValue('E'.$rowCount, 'THU NHẬP');

			$sheet->getColumnDimension('D')->setAutoSize(true);
			$sheet->getColumnDimension('E')->setAutoSize(true);
			$sheet->getColumnDimension('A')->setWidth(5);
			$sheet->getColumnDimension('B')->setWidth(10);
			$sheet->getColumnDimension('C')->setWidth(13);
			$sheet->getStyle('A1:E1')->getFont()->setBold(true);
			$total_money = 0;
			$total_amount = 0;
			foreach ($data as $value) {
				$rowCount++;
				$sheet->setCellValue('A'.$rowCount, $value['ID']);
				$sheet->setCellValue('B'.$rowCount, $value['MONTH']);
				$sheet->setCellValue('C'.$rowCount, $value['YEAR']);
				$sheet->setCellValue('D'.$rowCount, $value['SUM_AMOUNT']);
				$sheet->setCellValue('E'.$rowCount, number_format($value['SUM_MONEY'], 0, ',', ','));
				$total_money += $value['SUM_MONEY'];
				$total_amount += $value['SUM_AMOUNT'];
			}
			$sheet->setCellValue('C'.($rowCount+1), 'Tổng cộng: ');
			$sheet->setCellValue('D'.($rowCount+1), number_format($total_amount, 0, ',', ','));
			$sheet->setCellValue('E'.($rowCount+1), number_format($total_money, 0, ',', ','));
			$sheet->getStyle("D".($rowCount+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle("E".($rowCount+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}

		$sheet->getStyle("A1:A$rowCount")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("B1:B$rowCount")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("C1:C$rowCount")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("D1:D$rowCount")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("E1:E$rowCount")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle("F1:F$rowCount")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
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