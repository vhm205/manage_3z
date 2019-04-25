<?php
	include_once './inc/header.php';
	include_once './config/config.php';
	include_once './inc/connect.php';

	if(isset($_SESSION['USERNAME'])){
		header('location: ./');
		exit();
	}
?>
<script src="./assets/js/sweetalert2.min.js"></script>
<script>
	const createLink = (href, rel = "stylesheet") => {
		const link = document.createElement('link');
		link.rel   = rel;
		link.href  = href;
		document.head.appendChild(link);
	}
	createLink('./assets/css/sweetalert2.min.css');
	createLink('./assets/css/admin.css');
</script>

<?php 
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		$username = safe($_POST['username']);
		$password = safe($_POST['password']);

		$conn = new Connection();
		$salt = $conn->getRowByWhere('login', "USERNAME = '$username'", 'SALT');
		
		if(!empty($username) && !empty($password)){
			if($salt){
				$staticSalt = "vhm102";
				$password = md5($staticSalt.$password.$salt['SALT']);
				$where = "USERNAME = '$username' AND PASSWORD = '$password'";
				$data = $conn->getRowByWhere('login', $where, '*');
				if($data){
					$_SESSION['USERNAME'] = $data['USERNAME'];
					echo "<script> Swal.fire({
								 title: 'Đăng nhập thành công',
								 text: '',
								 type: 'success',
								 showConfirmButton: false,
								 timer: 2000
							 })
							 setTimeout(() => location.href = './', 3000)
						</script>";
				} else{
					echo "<script> Swal.fire({
								 title: 'Đăng nhập thất bại',
								 text: 'Sai username hoặc password',
								 type: 'error',
								 showConfirmButton: false,
								 timer: 2000
							 })
						</script>";
				}
			} else{
				echo "<script> Swal.fire({
							 title: 'Đăng nhập thất bại',
							 text: 'Tài khoản không tồn tại',
							 type: 'question',
							 showConfirmButton: false,
							 timer: 2000
						 })
					</script>";
			}
		} else {
			echo "<script> Swal.fire({
						 title: 'Đăng nhập thất bại',
						 text: 'Bạn cần nhập đầy đủ username và password',
						 type: 'warning',
						 showConfirmButton: false,
						 timer: 2000
					 })
				</script>";
		}
	}
?>

<div class="container-fluid container-login">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="login-form">
				<div class="card border-info mb-3">
				  <div class="card-header text-info">
				  	<h1>Login</h1>
				  </div>
				  <div class="card-body">
				    <form method="post" action="#">
			    		<fieldset class="form-group">
			    			<label for="username">Email/Username</label>
			    			<input type="text" class="form-control" id="username" placeholder="Tên đăng nhập..." name="username" autocomplete="off">
			    		</fieldset>
			    		<fieldset class="form-group">
			    			<label for="pass">Password</label>
			    			<input type="password" class="form-control" id="pass" placeholder="Mật khẩu..." name="password" autocomplete="off">
			    		</fieldset>
			    		<button type="submit" class="btn btn-block btn-info" name="sm-login">Login</button>
				    </form>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once './inc/footer.php'; ?>