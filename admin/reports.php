<?php 
	include_once '../inc/header.php';
	include_once '../config/config.php';
	include_once '../inc/connect.php';
	include_once '../inc/nav.php';

	if(!isset($_SESSION['USERNAME'])){
		header('location: ./login.php');
		exit();
	}

	$limit     = 6;
	$conn      = new Connection();
	$where     = "0 = 0 ORDER BY ID DESC";

	if(isset($_GET['page']) && filter_var($_GET['page'], FILTER_VALIDATE_INT, array('min_range' => 1))){
		$page = $_GET['page'];
		$data = $conn->getDataLimit('reports_revenue', $page, $where, $limit);
	} else{
		$data = $conn->getDataLimit('reports_revenue', 0, $where, $limit);
	}

	$countData = $conn->countData('reports_revenue', 'ID');
	$count     = ceil($countData / $limit);
	$data      = json_decode(json_encode($data), true);
?>
<script>
	const createLink = (href, rel) => {
		const link = document.createElement('link');
		link.rel = rel;
		link.href = href;
		document.head.appendChild(link);
	}
	createLink('../assets/css/admin.css', 'stylesheet');
	createLink('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css', 'stylesheet');
</script>

<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="../">Trang chủ</a></li>
			  <li class="breadcrumb-item active">Báo cáo</li>
			</ol>
			<fieldset>
				<legend>Thống kê hóa đơn</legend>
				<table class="table table-inverse animated flash text-center">
					<thead>
						<tr>
						    <th scope="col">ID</th>
						    <th scope="col">Tháng</th>
						    <th scope="col">Năm</th>
						    <th scope="col">Số lượng</th>
						    <th scope="col">Thời gian</th>
						    <th scope="col">Tổng tiền</th>
						</tr>
					</thead>
					<tbody id="data">
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
					</tbody>
				</table>
			</fieldset>
			<!-- Pagination -->
			<div id="pagi">
			  <ul class="pagination">
			    <li class="page-item previous">
			      <a class="page-link" href="./reports.php?page=<?php 
			      	if(isset($_GET['page']) && $_GET['page'] > 1){$pre = $_GET['page'];echo $pre - 1;}
			      	else{$pre = $count;echo $pre;}?>">&laquo;</a>
			    </li>
			<?php for ($i = 1; $i <= $count; $i++) { ?>
				    <li class="page-item">
				      <a class="page-link" href="./reports.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
				    </li>
			<?php } ?>
			    <li class="page-item next">
			      <a class="page-link" href="./reports.php?page=<?php if(!isset($_GET['page'])){$next = 2;echo $next;}
			      	elseif(isset($_GET['page']) && $_GET['page'] < $count){$next = $_GET['page'];echo $next + 1;}else{$next=1;echo $next;}?>">&raquo;</a>
			    </li>
			  </ul>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 mt-5">
		     <p>
		     	<div class="form-group">
		     		<label class="col-form-label">Lọc theo tháng, năm</label>
		     		<?php 
		     			$dateAll = $conn->getDataByWhere('reports_revenue', '0 = 0', 'YEAR');
		     			$dateAll = json_decode(json_encode($dateAll), true);
		     			foreach ($dateAll as $value) {
		     				$years[]  = $value['YEAR'];
		     			}
		     			$years  = array_unique($years);
		     		?>
		     		<div class="input-group">
			     		<select class="form-control col-3" id="select-month">
			     			<?php for ($i = 1; $i <= 12; $i++) { ?>
			     				<option value="<?php echo $i; ?>">
				     				<?php echo $i; ?>
				     			</option>
			     			<?php } ?>
						</select>&ensp;
						<select class="form-control col-3" id="select-year">
				     		<?php foreach ($years as $value): ?>
				     			<option value="<?php echo $value; ?>">
				     				<?php echo $value; ?>
				     			</option>
				     		<?php endforeach ?>
						</select>
					</div>
				</div>
		     </p>
		     <p>
		     	<div class="form-group">
		     		<label class="col-form-label">Lọc chi tiết</label>
		     		<div class="input-group date col-6" data-provide="datepicker">
		     			<div class="input-group-prepend">
					      <span class="input-group-text">
					      	<i class="fa fa-calendar-alt" style="font-size: 20px"></i>
					      </span>
					    </div>
					    <input type="text" name="date" class="form-control datepicker" autocomplete="off">
					    <div class="input-group-addon">
					        <span class="glyphicon glyphicon-th"></span>
					    </div>
					</div>
					<input type="button" class="btn btn-primary btn-income col-6" value="Lọc thu nhập theo tháng">
					<input type="button" class="btn btn-danger btn-reset col-6" value="Reset">					
				</div>
		     </p>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		'use stricts';

		$('[data-provide="datepicker"]').datepicker();

		const selectMonth  = $('#select-month'),
			  selectYear   = $('#select-year'),
			  selectDetail = $('.datepicker');

		<?php if(isset($_GET['page'])) { ?>
			$('ul.pagination .page-item:not(.previous):not(.next):nth-child(' + <?php echo $_GET['page'] + 1; ?> + ')').addClass('active');
		<?php } else { ?>
			$('ul.pagination .page-item:not(.previous):not(.next):nth-child(2)').addClass('active');
		<?php } ?>

		$('#select-month, #select-year').change(function(e){
			_ajax('../ajax/ajax_get_reports.php', 'POST', false, {
				type: 'YEAR-MONTH',
				month: selectMonth.val(),
				year:  selectYear.val()
			})
			$('#pagi').html('');
		})

		selectDetail.change(function(event) {
			_ajax('../ajax/ajax_get_reports.php', 'POST', false, {
				type: 'YEAR-MONTH-DAY',
				date: selectDetail.val()
			})
			$('#pagi').html('');
		});

		$('.btn-income').click(function(e){
			$('table.table.table-inverse>thead>tr>th').eq(3).text('Tổng số lượng').next().text('Tổng thu nhập').next().remove();
			_ajax('../ajax/ajax_get_reports.php', 'POST', false, {
				type: 'INCOME'
			})
			$('#pagi').html('');
		})

		const _ajax = (url, type = 'POST', cache = false, data = {}, id = '#data') => {
			$.ajax({
				url: url,
				type: type,
				cache: cache,
				data: data
			})
			.done(function(res) {
				$(id).html(res);
			})
			.fail(function(err) {
				console.log(`error: ${err}`);
			})
		}

		$('.btn-reset').click(() => window.location.reload());
	})
</script>

<?php Connection::disconnect(); ?>
<?php include_once '../inc/footer.php'; ?>