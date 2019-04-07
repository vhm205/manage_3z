<?php
	include_once '../config/config.php';
	include_once '../inc/connect.php';

	$conn = new Connection();

	if(isset($_REQUEST['page'])){
		$page = $_REQUEST['page'];
		$where = '';

		if(isset($_REQUEST['where'])){
			if(isset($_REQUEST['word'])){
				$words = $_REQUEST['word'];
				$where = "NAME LIKE '%{$words}%' OR DESCRIPTION LIKE '%{$words}%'";
			}
			if(isset($_REQUEST['min']) && isset($_REQUEST['max'])){
				$min = $_REQUEST['min'];
				$max = $_REQUEST['max'];
				$where = "PRICE >= {$min} AND PRICE <= {$max}";
			}
			if(isset($_REQUEST['price'])){
				$price = $_REQUEST['price'];
				$where = ($price === 'up') ? "0 = 0 ORDER BY PRICE ASC" : "0 = 0 ORDER BY PRICE DESC";
			}
			if(isset($_REQUEST['status'])){
				$status = $_REQUEST['status'];
				$where = ($status === 'remain') ? "STATUS = 1" : "STATUS = 0";
			}
			if(isset($_REQUEST['select_by_type'])){
				$select_by_type = $_REQUEST['select_by_type'];
				$where = ($select_by_type === 'Món ăn') ? "TYPE = 'Món ăn'" : "TYPE = 'Đồ uống'";
			}
			$result = $conn -> getDataLimit('product', 0, $where);
			$countData = $conn -> getDataByWhere('product', $where, 'ID');
			$countData = count($countData);
		} else{
			$result = $conn->getDataLimit('product', $page);
			$countData = $conn->countData('product', 'ID');
		}
	} else{
		$result = $conn -> getDataLimit('product');
	}
	
	$limit = 6;
	$count = ceil($countData / $limit);
	$data = json_decode(json_encode($result), true);
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
	    	<a href="../admin/update_product.php?id=<?php echo $value['ID']; ?>" id="edit-product">
	    		<i class="fa fa-pen"></i>
	    	</a>
	    </td>
	    <td class="text-center icon">
	    	<a onclick="return confirm('Bạn có chắc chắn muốn xóa?');" href="../admin/delete_product.php?id=<?php echo $value['ID']; ?>" class="del-product">
	    		<i class="fa fa-trash"></i>
	    	</a>
	    </td>
	</tr>
<?php endforeach ?>
<?php } ?>

<!-- ------------------------------------------------------------------------- -->

<?php if(isset($_GET['type']) && $_GET['type'] === 'product_main') { ?>
<span id="count-pagi" data-count-pagi="<?php echo $count; ?>"></span>
<?php foreach ($data as $value): ?>
	<div class="col-12 col-sm-6 col-md-6 col-lg-4">
		<div class="card mb-3">
		  <h3 class="card-header">
		  	<span id="product-name-<?php echo $value['ID']; ?>" data-name="<?php echo $value['NAME']; ?>"><?php echo $value['NAME']; ?></span>
		  </h3>
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
					cache: false,
					data: { id: id }
				}).done(function(res) {
					window.location.reload();
				}).fail(function(err) {
					Swal.fire({
					  position: 'center',
					  text: err,
					  type: 'error',
					  title: 'Thêm sản phẩm thất bại',
					  showConfirmButton: false,
					  timer: 2000
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