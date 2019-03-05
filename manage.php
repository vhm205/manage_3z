<?php 
	include './inc/header.php'; 
	include './inc/nav.php';
?>

<script>
	const link = document.createElement('link'),
		  script = document.createElement('script');
	link.rel = 'stylesheet';
	link.href = './assets/css/main.css';
	script.src = './assets/js/manage.js';
	document.head.appendChild(link);
	document.body.appendChild(script);
</script>

<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$people = $_POST['people'];
		$table = $_POST['table'];

		if(!isset($_SESSION['ARR_MENU'])){
			$_SESSION['ARR_MENU']['PEOPLE'] = $people . ',';
			$_SESSION['ARR_MENU']['TABLE'] = $table . ',';
			$_SESSION['SPLIT_TABLE'] = explode(',', ($table . ','));
		} elseif(isset($_SESSION['ARR_MENU'])){
			$split_table = explode(',', $_SESSION['ARR_MENU']['TABLE']);
			$exist = null;

			foreach ($split_table as $value) {
				if($value === $table)
					$exist = 1;
			}
			if($exist !== 1){
				$_SESSION['ARR_MENU']['PEOPLE'] .= $people . ',';
				$_SESSION['ARR_MENU']['TABLE'] .= $table . ',';
			}
			$_SESSION['SPLIT_TABLE'] = explode(',',$_SESSION['ARR_MENU']['TABLE']);
		}
		$_SESSION['MENU']['PEOPLE'] = $people;
		$_SESSION['MENU']['TABLE'] = $table;

		header('location: order.php');
	}
?>


<div class="container-fluid">
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="./">Trang chủ</a></li>
			  <li class="breadcrumb-item active">Sơ đồ quán</li>
			</ol>
			<div class="btn-group btn-group-toggle wrapper"></div>
		</div>
		<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-4" style="margin-top: 70px">
			<ul class="nav nav-tabs">
			  <li class="nav-item">
			    <a class="nav-link active" data-toggle="tab" href="#addTable">Thêm bàn</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#menu">Menu</a>
			  </li>
			</ul>
			<div id="myTabContent" class="tab-content">
			  <div class="tab-pane fade show active" id="addTable">
			  	<form method="POST" action="">
				    <p>
				    	<div class="form-group">
					      <label for="people">Số người</label>
					      <select class="form-control" name="people" id="people">
					        <option value="1">1</option>
					        <option value="2">2</option>
					        <option value="3">3</option>
					        <option value="4">4</option>
					      </select>
					    </div>
					    <input type="hidden" id="session_input" name="session_input" value="<?php if(isset($_SESSION['SPLIT_TABLE'])) echo implode(',',$_SESSION['SPLIT_TABLE']); ?>">
				    </p>
				    <p>
				    	<div class="btn-group btn-group-toggle add-table"></div>
				    </p>
				    <p>
				    	<button type="submit" name="sm" class="btn btn-block btn-primary">Thêm menu vào bàn</button>
				    </p>
				</form>
			  </div>
			  <div class="tab-pane fade" id="menu">
			    <p>
			    	<div class="alert alert-dismissible alert-info">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Heads up!</strong> This <a href="#" class="alert-link">alert needs your attention</a>, but it's not super important.
					</div>
			    </p>
			    <p>
			    	<div class="alert alert-dismissible alert-warning">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Heads up!</strong> This <a href="#" class="alert-link">alert needs your attention</a>, but it's not super important.
					</div>
			    </p>
			    <p>
			    	<div class="alert alert-dismissible alert-danger">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Heads up!</strong> This <a href="#" class="alert-link">alert needs your attention</a>, but it's not super important.
					</div>
			    </p>
			    <p>
			    	<div class="alert alert-dismissible alert-success">
					  <button type="button" class="close" data-dismiss="alert">&times;</button>
					  <strong>Heads up!</strong> This <a href="#" class="alert-link">alert needs your attention</a>, but it's not super important.
					</div>
			    </p>
			  </div>
			</div>
		</div>
	</div>
</div>	

<?php include './inc/footer.php'; ?>