<?php 
	include_once './inc/header.php'; 
	include_once './inc/nav.php';

	if(!isset($_SESSION['USERNAME'])){
		header('location: ./login.php');
		exit();
	}
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
		$table  = $_POST['table'];

		$_SESSION['MENU']['PEOPLE'] = $people;
		$_SESSION['MENU']['TABLE'] = $table;

		if(isset($_SESSION['COUNT_PRODUCT'])){
			unset($_SESSION['DETAIL_PRODUCT']);
			unset($_SESSION['COUNT_PRODUCT']);
		}

		header('location: ./order.php');
	}

	if(isset($_SESSION['ALL_MENU'])){
		$items = [];
		$all_datas = json_decode(json_encode($_SESSION['ALL_MENU']), true);
		foreach ($all_datas as $key => $value) {
			$items[] = $value[0]['TABLE'];
		}
		$_SESSION['SPLIT_TABLE'] = $items;
	}

	if(isset($_SESSION['DETAIL_PRODUCT'])){
		$people = $_SESSION['MENU']['PEOPLE'];
		$table  = $_SESSION['MENU']['TABLE'];
		$char   = ',';

		if(!isset($_SESSION['ARR_MENU'])){
			$_SESSION['ARR_MENU']['PEOPLE'] = ($people . $char);
			$_SESSION['ARR_MENU']['TABLE'] = ($table . $char);
			$_SESSION['SPLIT_TABLE'] = explode(',', $table);
		} elseif(isset($_SESSION['ARR_MENU'])){
			$split_table = explode(',', $_SESSION['ARR_MENU']['TABLE']);
			$exist = null;

			foreach ($split_table as $value) {
				if($value === $table)
					$exist = 1;
			}
			if($exist !== 1){
				$_SESSION['ARR_MENU']['PEOPLE'] .= ($people . $char);
				$_SESSION['ARR_MENU']['TABLE'] .= ($table . $char);
			}
		}

		if(isset($_SESSION['ALL_MENU'])){
			$items = [];
			$all_datas = json_decode(json_encode($_SESSION['ALL_MENU']), true);
			array_push($all_datas, $_SESSION['DETAIL_PRODUCT']);
			foreach ($all_datas as $key => $value) {
				$items[] = $value[0]['TABLE'];
			}
			$_SESSION['SPLIT_TABLE'] = $items;
		} else{
			$all_datas = [];
			array_push($all_datas, $_SESSION['DETAIL_PRODUCT']);
		}


		$_SESSION['ALL_MENU'] = $all_datas;
		unset($_SESSION['DETAIL_PRODUCT']);
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
		<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-4" style="margin-top: 10px">
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
			  	<form method="POST">
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
					    <input type="hidden" id="session_input" name="session_input" value="<?php if(isset($_SESSION['SPLIT_TABLE'])) echo implode(',',$_SESSION['SPLIT_TABLE']) . ','; ?>">
				    </p>
				    <p>
				    	<div class="btn-group btn-group-toggle add-table"></div>
				    </p>
				    <p>
				    	<button type="submit" name="sm" class="btn btn-block btn-primary">Thêm menu vào bàn</button>
				    	<button type="reset" name="reset" class="btn btn-block btn-outline-danger">Reset</button>
				    </p>
				</form>
			  </div>
			  <div class="tab-pane fade" id="menu">
			  	<div class="detail-menu">
			<?php if(isset($_SESSION['ALL_MENU'])){ 
					$all_datas = $_SESSION['ALL_MENU'];
					foreach ($all_datas as $key => $value) {
			?>
 				<p>
			    	<div class="alert alert-dismissible alert-info">
					  <a href="./remove_menu.php?index=<?php echo $key; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger btn-sm float-right">Xóa</a>
					  <a href="./detail_menu.php?index=<?php echo $key; ?>" class="btn btn-primary btn-sm float-right">Chi tiết</a>
					  <strong>Thực đơn <?php echo $value[0]['TABLE']; ?></strong>
					</div>
			    </p>
				<?php } ?>
			<?php } ?>
				</div>
			  </div>
			</div>
		</div>
	</div>
</div>	

<?php include_once './inc/footer.php'; ?>