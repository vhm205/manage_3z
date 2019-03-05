<?php 
	include '../inc/header.php';
	include '../config/config.php';
	include '../inc/connect.php';
	include '../inc/nav.php';

	$conn = new Connection();
	$countData = $conn->countData('product', 'ID');
	$count = ceil($countData / Connection::$limit);
?>
<script>
	const link = document.createElement('link');
	link.rel = 'stylesheet';
	link.href = '../assets/css/admin.css';
	document.head.appendChild(link);
</script>

<div class="container">
	<div class="row">
		<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 m-auto">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="../">Trang chủ</a></li>
			  <li class="breadcrumb-item active">Danh sách sản phẩm</li>
			</ol>
			<fieldset>
				<legend>Danh sách sản phẩm</legend>
				<table class="table table-inverse animated flash">
					<thead>
						<tr>
						    <th scope="col">ID</th>
						    <th scope="col">Tên sản phẩm</th>
						    <th scope="col">Giá sản phẩm</th>
						    <th scope="col">Hình ảnh</th>
						    <th scope="col">Loại sản phẩm</th>
						    <th scope="col">Trạng thái</th>
						    <th class="text-center" scope="col">Sửa</th>
						    <th class="text-center" scope="col">Xóa</th>
						</tr>
					</thead>
					<tbody id="data"></tbody>
				</table>
			</fieldset>
			<div>
			  <ul class="pagination pagination-md">
			    <li class="page-item pre">
			      <button class="page-link" title="<?php echo $count; ?>">&laquo;</button>
			    </li>
			<?php for ($i = 1; $i <= $count; $i++) { ?>
				    <li class="page-item">
				      	<button class="page-link button-link" title="<?php echo $i; ?>"><?php echo $i; ?></button>
				    </li>
			<?php } ?>
			    <li class="page-item next">
			      <button class="page-link" title="2">&raquo;</button>
			    </li>
			  </ul>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		document.cookie = `page=`;

		$.ajax({
			url: '../ajax/ajax_get_product.php',
			data: { 
				page: 0,
				type: 'product_admin'
			},
			success: function(result){
				$('#data').html(result);
			}
		});

	
		// Set active pagi khi mới load
		var li = 'ul.pagination li.page-item:not(.pre):not(.next)';
		$(li + ':nth-child(2) .button-link').addClass('active');

		$('.page-link').click(function(){
			var page = parseInt($(this).attr('title')),
				linkLen = $(li + ' .button-link').length,
				activeLi = page;


			// Xóa và thêm Class active của Pagi
			for (var i = 0; i < linkLen; i++) $(li + ' .button-link').removeClass('active');
			$(li + ':nth-child(' + (++activeLi) + ') .button-link').addClass('active');

			// Set Cookie trang hiện tại
			document.cookie = `page=${page}`;
			
			$.ajax({
				url: '../ajax/ajax_get_product.php',
				data: { 
					page: page,
					type: 'product_admin'
				},
				success: function(result){
					$('#data').html(result);
				}
			});

			var pre = document.cookie.match(/\d/g)[0],
				nxt = document.cookie.match(/\d/g)[0];

			if(pre == 1){
				$('.pre .page-link').attr('title', <?php echo $count; ?>);
			} else {
				$('.pre .page-link').attr('title', --pre);
			}

			if(nxt == <?php echo $count; ?>){
				$('.next .page-link').attr('title', '1');
			} else {
				$('.next .page-link').attr('title', ++nxt);
			}
		});
	})
</script>

<?php include '../inc/footer.php'; ?>