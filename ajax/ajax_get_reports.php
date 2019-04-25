<?php
	include_once '../config/config.php';
	include_once '../inc/connect.php';

	$conn  = new Connection();
	$type  = $_REQUEST['type'];
	$count = 1;

	switch ($type) {
		case 'YEAR-MONTH':
			$month = $_REQUEST['month'];
			$year  = $_REQUEST['year'];
			$where = "MONTH = {$month} AND YEAR = {$year}";
			$data  = $conn->getDataByWhere('reports_revenue', $where, "*");
			break;
		case 'YEAR-MONTH-DAY':
			$date = $_REQUEST['date'];
			$date = date('Y-m-d', strtotime($date));
			$where = "DATE_CREATE = '{$date}'";
			$data  = $conn->getDataByWhere('reports_revenue', $where, "*");
			break;
		case 'INCOME':
			$fields = "ID, MONTH, YEAR, SUM(TOTAL_AMOUNT) AS SUM_AMOUNT, SUM(TOTAL_MONEY) AS SUM_MONEY";
			$where = "0 = 0 GROUP BY MONTH, YEAR ORDER BY ID DESC";
			$data = $conn->getDataByWhere('reports_revenue', $where, $fields);
			break;
		default:
			echo $type;
			exit();
			break;
	}
	
	$data  = json_decode(json_encode($data), true);
?>
<?php if($type === 'YEAR-MONTH' || $type === 'YEAR-MONTH-DAY') { ?>
<?php foreach ($data as $value): ?>
	<tr>
		<th scope="row">
			<?php echo $count; ?>
		</th>
	    <td>
	    	<?php 
	    		$date = date_create($value['DATE_CREATE']);
	    		echo date_format($date, 'm');
	    	?>
	    </td>
	    <td>
	    	<?php 
	    		$date = date_create($value['DATE_CREATE']);
	    		echo date_format($date, 'Y');
	    	?>
	    </td>
	    <td>
	    	<?php echo $value['TOTAL_AMOUNT']; ?>
	    </td>
	    <td>
	    	<?php echo $value['DATE_CREATE'] . ' | ' . $value['TIME']; ?>
	    </td>
	    <td>
	    	<?php echo number_format($value['TOTAL_MONEY'], 0, ',', ','); ?>	
	    </td>
	</tr>
	<?php $count++; ?>
<?php endforeach ?>
<?php } elseif($type === 'INCOME') { ?>
<?php foreach ($data as $value): ?>
	<tr>
		<th scope="row">
			<?php echo $count; ?>
		</th>
	    <td>
	    	<?php echo $value['MONTH']; ?>
	    </td>
	    <td>
	    	<?php echo $value['YEAR']; ?>
	    </td>
	    <td>
	    	<?php echo $value['SUM_AMOUNT']; ?>
	    </td>
	    <td>
	    	<?php echo number_format($value['SUM_MONEY'], 0, ',', ','); ?>
	    </td>
	</tr>
	<?php $count++; ?>
<?php endforeach ?>
<?php } ?>