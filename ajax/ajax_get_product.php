<?php
	include '../config/config.php';
	include '../inc/connect.php';

	$conn = new Connection();
	
	if(isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT, array('min_range'  => 1))){
		$page = $_GET['page'];
		$result = $conn -> getDataLimit('product', $page);
		$data = json_decode(json_encode($result), true);
	} else{
		$result = $conn -> getDataLimit('product');
		$data = json_decode(json_encode($result), true);
	}
?>

<?php if(isset($_GET['type']) && $_GET['type'] === 'product_admin') { ?>
<?php foreach ($data as $value): ?>
	<tr>
		<th scope="row"><?php echo $value['ID']; ?></th>
	    <td><?php echo $value['NAME']; ?></td>
	    <td><?php echo number_format($value['PRICE'], 0, ',',','); ?></td>
	    <td>
	    	<img class="img-thumbnail img-responsive" src="<?php echo $value['IMAGE']; ?>" alt="<?php echo $value['NAME']; ?>">
	    </td>
	    <td><?php echo $value['TYPE']; ?></td>
	    <td><?php 
	    	if($value['STATUS'] == 1) echo 'Còn hàng';
	    	else echo 'Hết hàng'; 
	    ?></td>
	    <td class="text-center icon">
	    	<a href="#" id="edit-product">
	    		<i class="fa fa-pen"></i>
	    	</a>
	    </td>
	    <td class="text-center icon">
	    	<a href="../admin/delete_product.php?id=<?php echo $value['ID']; ?>" class="del-product">
	    		<i class="fa fa-trash"></i>
	    	</a>
	    </td>
	</tr>
<?php endforeach ?>
<?php } ?>
<?php if(isset($_GET['type']) && $_GET['type'] === 'product_main') { ?>
<?php foreach ($data as $value): ?>
		<div class="col-12 col-sm-6 col-md-6 col-lg-4">
			<div class="card mb-3">
			  <h3 class="card-header"><span id="product-name-<?php echo $value['ID']; ?>" data-name="<?php echo $value['NAME']; ?>"><?php echo $value['NAME']; ?></span></h3>
			  <img style="height: 200px; width: 100%; display: block;" src="<?php echo substr($value['IMAGE'], 1, strlen($value['IMAGE'])) ?>" alt="Card image">
			  <div class="card-body">
			  	<h5 class="card-title">
			  		<span id="price-<?php echo $value['ID']; ?>" data-price="<?php echo number_format($value['PRICE'], 0, ',',','); ?>">
			  			<?php echo number_format($value['PRICE'], 0, ',',','); ?>
			  		</span>
			  	</h5>
			    <p class="card-text"><?php echo $value['DESCRIPTION']; ?></p>
			    <a href="#" id="product-<?php echo $value['ID']; ?>" data-id="<?php echo $value['ID']; ?>" class="btn btn-warning btn-block card-link">Thêm món</a>
			  </div>
			  <div class="card-footer text-muted" id="product-status-<?php echo $value['ID']; ?>">
			    <?php 
			    	if($value['STATUS']){
			    		echo "<label class='circle green'></label> Trạng thái: Còn hàng";
			    	}
			    	else {
			    		echo "<label class='circle red'></label> Trạng thái: hết hàng";
			    	}
			    ?>
			  </div>
			</div>
		</div>
		<script>
			document.getElementById('product-'+<?php echo $value['ID'] ?>).addEventListener('click', function(e){
				e.preventDefault();
				const id = this.dataset.id,
					  status = document.getElementById('product-status-<?php echo $value['ID']; ?>');

				if(!status.children[0].classList.contains('red')){
					$.ajax({
						url: './ajax/ajax_add_product.php',
						type: 'POST',
						cache: false,
						data: { id: id }
					}).done(function(res) {
						location.reload();
					}).fail(function() {
						Swal.fire({
						  position: 'center',
						  type: 'error',
						  title: 'Thêm sản phẩm thất bại',
						  showConfirmButton: false,
						  timer: 1500
						})
					})
				} else{
					Swal.fire({
					  position: 'center',
					  type: 'warning',
					  title: 'Hết hàng',
					  showConfirmButton: false,
					  timer: 1500
					})
				}
			})
		</script>
<?php endforeach ?>
<?php } ?>