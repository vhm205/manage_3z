<?php 
	error_reporting(E_ALL ^ E_NOTICE);
	include_once '../inc/header.php';
	include_once '../config/config.php';
	include_once '../inc/connect.php';
	include_once '../inc/nav.php';
	

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$name = $_POST['name'];
		$price = $_POST['price'];
		$description = $_POST['description'];
		$type = $_POST['type'];

		if(empty($_POST['status'])){
			$status = 0;
		} else{
			$status = 1;
		}

		$uploadOK = 1;
		$err = array();
		$target_dir = '../upload/';
		$target_file = $target_dir . basename($_FILES['image']['name']);
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		if(file_exists($target_file)){
			$err[] = 'File ảnh đã tồn tại';
			$uploadOK = 0;
		}

		if($_FILES['image']['size'] > 500000){
			$err[] = 'File ảnh quá lớn';
			$uploadOK = 0;
		}

		if( $imageFileType !== 'png' &&
		    $imageFileType !== 'jpg' &&
			$imageFileType !== 'jpeg' && 
			$imageFileType !== 'bmp' &&
			$imageFileType !== 'gif'){
			$err[] = 'Ảnh phải là định dạng JPG, JPEG, PNG, BMP or GIF';
			$uploadOK = 0;
		}

		$data = array($name, $price, $target_file, $description, $type, $status);
		$conn = new Connection();

		if($uploadOK == 1){
			if($conn->insert('product', $data)){
				move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
				$msg = 'Thêm sản phẩm thành công!';
			} else{
				$msg = 'Thêm sản phẩm thất bại!';
			}
		} else{
			$err[] = 'Có lỗi khi upload ảnh';
		}
	}

?>
<script>
	const link = document.createElement('link');
	link.rel = 'stylesheet';
	link.href = '../assets/css/admin.css';
	document.head.appendChild(link);
</script>

<div class="container">
	<div class="row">
		<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-8 m-auto">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="../">Trang chủ</a></li>
			  <li class="breadcrumb-item active">Thêm sản phẩm</li>
			</ol>
			<form action="#" method="POST" enctype="multipart/form-data">
				<fieldset>
					<legend>Thêm sản phẩm</legend>
					<div class="form-group">
					  <label class="col-form-label" for="name">Tên sản phẩm</label>
					  <input type="text" class="form-control input-edit" placeholder="Name" name="name" id="name" autocomplete="off" required>
					</div>
					<div class="form-group">
					  <label class="col-form-label" for="price">Giá sản phẩm</label>
					  <input type="number" class="form-control input-edit" placeholder="Price" name="price" id="price" autocomplete="off" required>
					</div>
					 <div class="form-group">
					 	<label class="col-form-label" for="image">Hình ảnh</label>
					    <div class="input-group mb-3">
					      <div class="custom-file">
					        <input type="file" class="custom-file-input" name="image" id="image" required accept="image/*">
					        <label class="custom-file-label" for="image">Choose file</label>
					      </div>
					    </div>
					</div>
					<div class="form-group">
				        <label class="col-form-label" for="type">Loại sản phẩm</label>
				      	<select class="form-control col-4" id="type" name="type">
					        <option value="Đồ uống" selected>Đồ uống</option>
					        <option value="Món ăn">Món ăn</option>
				      	</select>
				    </div>
					<div class="form-group">
					    <div class="custom-control custom-switch">
					      	<input type="checkbox" class="custom-control-input" name="status" id="status" value="1" checked>
					      	<label class="custom-control-label" for="status">Trạng thái</label>
					    </div>
					</div>
					<div class="form-group">
					  <label class="col-form-label" for="description">Mô tả</label>
					  <textarea class="form-control input-edit" id="description" name="description" rows="3" autocomplete="off"></textarea>
					</div>
					<button type="submit" class="btn btn-block btn-primary">Thêm sản phẩm</button>
					<button type="reset" class="btn btn-block btn-outline-danger">Reset</button>
				</fieldset>
			</form><br />
		</div>
	</div>
</div>

<script>
	function showMsg(className){
		var msg = document.getElementsByClassName(className)[0];
			msg.classList.add('fadeInUp');
		setTimeout(() => {
			msg.classList.remove('fadeInUp');
			msg.classList.add('fadeOutDown');
			setTimeout(() => {
				msg.style.display='none';
			}, 2000)
		}, 5000)
	}
</script>

<?php if(!empty($err)){ ?>
<div class="alert alert-dismissible alert-danger msg animated">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>
  	<?php foreach ($err as $key => $value) echo $value . '<br />'; ?>
  </strong>
</div>
<script>showMsg('msg')</script>
<?php } ?>
<?php if(isset($msg)){ ?>
<div class="alert alert-dismissible alert-success msg animated">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>
  	<?php echo $msg; ?>
  </strong>
</div>
<script>showMsg('msg')</script>
<?php } ?>

<?php Connection::disconnect(); ?>
<?php include_once '../inc/footer.php'; ?>