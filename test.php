<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Web </title>
	<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
</head>
<body>
	<?php 	
		include './config/config.php';
		include './inc/connect.php';


		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$conn = new Connection();

			$date = $_REQUEST['date'];
			$date = date( 'Y-m-d', strtotime($_POST['date'] ) );
			echo $date . '<br />';
			echo date('h:i:s a');
			$where = "DATE_CREATE = '{$date}'";
			$data = $conn->getDataByWhere('reports_revenue', $where, '*');
			$data = json_decode(json_encode($data), true);
			echo '<pre>';
			var_dump($data);
			echo '</pre>';
		}
	?>
	<form method="post" action="">
		<p>
		 	<div class="input-group date col-6" data-provide="datepicker">
			    <input type="text" name="date" class="form-control datepicker" autocomplete="off">
			    <div class="input-group-addon">
			        <span class="glyphicon glyphicon-th"></span>
			    </div>
			</div>
			<input type="submit" name="sm" value="Submit">
		 </p>
	 </form>



	 <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
	 <script>
	 	$('.datepicker').datepicker({
		    startDate: '-3d'
		});


	 </script>
</body>
</html>


