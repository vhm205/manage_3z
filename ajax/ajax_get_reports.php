<?php
	include_once '../config/config.php';
	include_once '../inc/connect.php';

	$conn  = new Connection();
	$type  = $_REQUEST['type'];

	if($type === 'YEAR-MONTH'){
		$month = $_REQUEST['month'];
		$year  = $_REQUEST['year'];
		$where = "MONTH = {$month} AND YEAR = {$year}";
		$data  = $conn->getDataByWhere('reports_revenue', $where, "*");
	} elseif($type === 'YEAR-MONTH-DAY'){
		$date = $_REQUEST['date'];
		$date = date('Y-m-d', strtotime($date));
		$where = "DATE_CREATE = '{$date}'";
		$data  = $conn->getDataByWhere('reports_revenue', $where, "*");
	} elseif($type === 'INCOME'){
		$data = $conn->getDataLimit('reports_revenue', 0, '', 10);
		$data  = json_decode(json_encode($data), true);
		echo '<pre>';
		var_dump($data);
		echo '</pre>';
	}
	
	$data  = json_decode(json_encode($data), true);
?>
<?php if($type === 'YEAR-MONTH' || $type === 'YEAR-MONTH-DAY') { ?>
<?php foreach ($data as $value): ?>
	<tr>
		<th scope="row">
			<?php echo $value['ID']; ?>
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
<?php endforeach ?>
<?php } elseif($type === 'INCOME') { ?>
<?php foreach ($data as $value): ?>
	<!-- <tr>
		<th scope="row">
			<?php echo $value['ID']; ?>
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
	</tr> -->
<?php endforeach ?>
<?php } ?>