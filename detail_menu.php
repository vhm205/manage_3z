<?php 
	include_once './inc/header.php';
	include_once './config/config.php';
	include_once './inc/connect.php';
	include_once './inc/nav.php';
	
	if(isset($_GET['index']) || filter_var($_GET['index'], FILTER_VALIDATE_INT)){
		$index = strip_tags($_GET['index']);

		if(isset($_SESSION['ALL_MENU'][$index]) && count($_SESSION['ALL_MENU'][$index]) <= 1){
			unset($_SESSION['ALL_MENU'][$index]);
			header('location: ./manage.php');
		}

		if(isset($_SESSION['ALL_MENU'])){
			$datas = $_SESSION['ALL_MENU'][$index];
			$total_amount = 0;
			$total_money = 0;
		}
	} else{
		header('location: ./manage.php');
		die();
	}
?>
<script>
	const createLink = (rel, href) => {
		const link = document.createElement('link');
		link.rel   = rel;
		link.href  = href;
		document.head.appendChild(link);
	}
	createLink('stylesheet', './assets/css/main.css');
	createLink('stylesheet', './assets/css/sweetalert2.min.css');
</script>

<?php
	if(isset($_POST['sm-update'])){
		$amount = $_POST['amount'];
		$key    = $_POST['key'];
		$items  = array_combine($key, $amount);

		foreach ($items as $key => $val) {
			if($val == 0 && is_numeric($val)){
				unset($datas[$key]);
			}
			if($val > 0 && is_numeric($val)){
				$datas[$key][0] = (int)$val;
			}
		}

		$_SESSION['ALL_MENU'][$index] = $datas;
	}
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-8 col-sm-8 col-md-8 col-lg-8">
			<form method="POST" action="#">
				<table class="table table-hover">
				  <thead class="bg-dark text-light">
				    <tr>
				      <th scope="col">ID</th>
				      <th scope="col">TÊN MÓN ĂN</th>
				      <th scope="col">ẢNH</th>
				      <th scope="col">GIÁ</th>
				      <th scope="col">LOẠI</th>
				      <th scope="col" class="text-center">SỐ LƯỢNG</th>
				      <th scope="col" class="text-center">THÀNH TIỀN</th>
				      <th scope="col" class="text-center">XÓA</th>
				    </tr>
				  </thead>
				  <tbody class="text-left">
				<?php foreach ($datas as $key => $value): ?>
					<?php if($key !== 0) { ?>
					<tr>
				      <th scope="row"><?php echo $value['ID'] ?></th>
				      <td><?php echo $value['NAME'] ?></td>
				      <td>
				      	<img class="img-thumbnail img-responsive" src="<?php echo substr($value['IMAGE'],1,strlen($value['IMAGE'])) ?>" alt="<?php echo $value['NAME'] ?>">
				      </td>
				      <td><?php echo number_format($value['PRICE'],0,',',',') ?></td>
				      <td><?php echo $value['TYPE'] ?></td>
				      <td class="text-center">
				      	<span class="amount"><?php echo $value[0] ?></span>
				      	<input type="number" name="amount[]" class="form-control amount_input hidden" value="<?php echo $value[0]; ?>">
				      	<input type="hidden" name="key[]" value="<?php echo $key ?>">
				      </td>
				      <td class="text-center">
				      	<?php echo number_format($value[0] * $value['PRICE'],0,',',',') ?>
				      </td>
				      <td class="text-center">
				      	<a href="./ajax/ajax_delete_product.php?id=<?php echo $key ?>&index=<?php echo $index; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
				      </td>
				    </tr>
				    <?php 
				    	$total_amount += $value[0];
				    	$total_money += $value[0] * $value['PRICE'];
				    }
				    ?>
				<?php endforeach ?>
					<tr class="bg-primary text-light">
						<th colspan="6" scope="col" class="text-right">SỐ LƯỢNG: <?php if(isset($total_amount)) echo $total_amount; ?></th>
						<th colspan="1" scope="col" class="text-center">TỔNG TIỀN: <?php if(isset($total_money)) echo number_format($total_money,0,',',','); ?></th>
						<th colspan="1" scope="col"></th>
					</tr>
					<tr class="bg-light">
						<td colspan="4">
							<button type="submit" name="sm-update" class="btn btn-block btn-outline-danger">Cập nhật</button>
						</td>
						<td colspan="4">
							<button type="button" name="sm-pay" class="btn btn-block btn-outline-warning btn-pay">Thanh toán</button>
						</td>
					</tr>
				  </tbody>
				</table>
			</form>
		</div>
	</div>
</div>


<script src="./assets/js/sweetalert2.min.js"></script>
<script>
	$(document).ready(function(){
		'use stricts';

		const amount 	   = document.getElementsByClassName('amount'),
			  amount_input = document.getElementsByClassName('amount_input'),
			  btn_pay 	   = document.getElementsByClassName('btn-pay')[0],
			  length 	   = amount.length;

		for (let i = 0; i < length; i++) {
			amount[i].addEventListener('click', function(){
				for (let i = 0; i < length; i++) {
					amount[i].classList.add('hidden');
					amount_input[i].classList.remove('hidden');
				}
			})
			amount_input[i].addEventListener('dblclick', function(){
				for (let i = 0; i < length; i++) {
					amount[i].classList.remove('hidden');
					amount_input[i].classList.add('hidden');
					amount[i].innerHTML = amount_input[i].value;
				}
			})
		}

		btn_pay.addEventListener('click', function(){
			Swal.fire({
			  title: 'Hoàn tất thanh toán?',
			  type: 'info',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes'
			}).then((result) => {
			  if (result.value) {
			    Swal.fire({
			      title: 'Thanh toán thành công!',
			      type: 'success',
			      showConfirmButton: false,
			      timer: 1500
			    })
			    setTimeout(() => window.location.href = './manage.php', 2000);
			  }
			})
		})
	})
</script>
<?php include_once './inc/footer.php'; ?>