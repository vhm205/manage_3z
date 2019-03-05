<?php 
	include '../config/config.php';
	include '../inc/connect.php';

	$conn = new Connection();
	$data = $conn->getDataAll('product', 'PRICE', 'ASC');
?>
<?php foreach ($data as $value): ?>
		<div class="col-4 col-sm-4 col-md-4 col-lg-4">
			<div class="card mb-3">
			  <h3 class="card-header"><?php echo $value->NAME; ?></h3>
			  <img style="height: 200px; width: 100%; display: block;" src="<?php echo substr($value->IMAGE, 1, strlen($value->IMAGE)) ?>" alt="Card image">
			  <div class="card-body">
			  	<h5 class="card-title"><?php echo number_format($value->PRICE, 0, ',',','); ?></h5>
			    <p class="card-text"><?php echo $value->DESCRIPTION; ?></p>
			    <a href="#" class="btn btn-warning btn-block card-link">Thêm món</a>
			  </div>
			  <div class="card-footer text-muted">
			  	
			    <?php 
			    	if($value->STATUS){
			    		echo "<label class='circle green'></label> Trạng thái: Còn hàng";
			    	}
			    	else {
			    		echo "<label class='circle red'></label> Trạng thái: hết hàng";
			    	}
			    ?>
			  </div>
			</div>
		</div>
<?php endforeach ?>