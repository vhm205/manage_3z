<?php 
	include './inc/header.php';
	include './config/config.php';
	include './inc/connect.php';
	include './inc/nav.php';
?>
<script>
	const createLink = (rel, href) => {
		const link = document.createElement('link');
		link.rel = rel;
		link.href = href;
		document.head.appendChild(link);
	}
	createLink('stylesheet', './assets/css/main.css');
	createLink('stylesheet', './assets/css/sweetalert2.min.css');
</script>

<?php 
	$conn = new Connection();
	$countData = $conn->countData('product', 'ID');
	$count = ceil($countData / Connection::$limit); 

	if(isset($_POST['sm-search'])){
		$key_words = trim($_POST['search']);

		$where = "NAME LIKE '%{$key_words}%' OR DESCRIPTION LIKE '%{$key_words}%'";
		$data = $conn->getDataByWhere('product', $where, '*');
	}

	if(isset($_SESSION['MENU'])){
		echo '<pre>';
		var_dump($_SESSION['MENU']);
		echo '</pre>';
	}
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-8 col-lg-8">
			<ol class="breadcrumb">
			  <li class="breadcrumb-item"><a href="./">Trang chủ</a></li>
			  <li class="breadcrumb-item active">Chọn món</li>
			</ol>
			<div class="container">
				<div class="row product" id="data"></div>
				<div class="row">
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
		<div class="col-12 col-sm-12 col-md-4 col-lg-4 mt-5">
			<form method="POST" action="#" class="form-inline my-2 my-lg-0">
		      <input class="form-control search mr-sm-2" type="search" name="search" placeholder="Tìm kiếm...">
		      <button class="btn btn-primary my-2 my-sm-0" name="sm-search" type="submit">Search</button>
		    </form>
		     <p>
		     	<div class="form-group">
		     		<label class="col-form-label" for="name">Sắp xếp theo giá</label>
		     		<p>
	     				<div class="input-group">
		     				<button type="button" id="sm-price" name="sm-price" class="btn btn-primary"><i class="fa fa-caret-left" style="font-size: 20px"></i></button>
		     				<input type="number" name="min-price" id="min-price" class="form-control price col-3" required placeholder="Min">
		     				<input type="number" name="max-price" id="max-price" class="form-control price col-3" required placeholder="Max">
		     			</div>
		     		</p><br />
				    <div class="custom-control custom-radio">
				      	<input type="radio" id="price-up" name="radio-price" class="custom-control-input" checked>
				      	<label class="custom-control-label" for="price-up">Giá tăng dần</label>
					</div>
				    <div class="custom-control custom-radio">
				      	<input type="radio" id="price-down" name="radio-price" class="custom-control-input">
				      	<label class="custom-control-label" for="price-down">Giá giảm dần</label>
					</div>
				</div>
		     </p>
		     <p>
		     	<div class="form-group">
		     		<label class="col-form-label" for="name">Sắp xếp theo trạng thái</label>
				    <div class="custom-control custom-radio">
				      	<input type="radio" id="remain" name="radio-status" class="custom-control-input" checked>
				      	<label class="custom-control-label" for="remain">Còn hàng</label>
					</div>
				    <div class="custom-control custom-radio">
				      	<input type="radio" id="out-of-stock" name="radio-status" class="custom-control-input">
				      	<label class="custom-control-label" for="out-of-stock">Hết hàng</label>
					</div>
				</div>
		     </p>
		     <p>
		     	<div class="form-group">
		     		<label class="col-form-label" for="select-type">Sắp xếp theo loại</label>
		     		<select class="form-control col-6" name="type" id="select-type">
					    <option selected value="Thức ăn">Thức ăn</option>
					    <option value="Đồ uống">Đồ uống</option>
					</select>
				</div>
		     </p>
		</div>
	</div>
</div>
<div class="alert alert-dismissible alert-warning alert-require animated">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong id="message-require"></strong>
</div>
<div class="cart">
	<button type="button" id="btn-cart" class="btn btn-outline-danger"><i class="fa fa-shopping-cart"></i></button>
	<div class="contain-cart-product">
		<div class="card border-danger mb-3">
		  <div class="card-header">Giỏ hàng 
		  	(<?php 
		  		if(isset($_SESSION['COUNT_PRODUCT'])){
		  			$count = count($_SESSION['COUNT_PRODUCT']);
		  			if($count > 0) echo $count;
		  			else echo '0';
		  		} else{ echo '0'; }
		  	?>)
		  </div>
		  <div class="card-body">
		<?php
			if(isset($_SESSION['COUNT_PRODUCT'])){
			  	foreach ($_SESSION['COUNT_PRODUCT'] as $key => $value) {
			  		$items[] = $key;
			  	}
			  	$ids = implode(',', $items);
			  	$total = 0;
			  	$data = $conn->getDataByWhere('product', 'ID IN('.$ids.')', '*');
			  	$data = json_decode(json_encode($data), true);
				foreach ($data as $key => $value) {
					$total = $_SESSION['COUNT_PRODUCT'][$value['ID']];
		?>
					<div class="alert alert-dismissible alert-danger">
					  <a class="close" data-dismiss="alert">&times;</a>
					  <strong>x<?php echo $total . ' ' . $value['NAME']; ?></strong> - <?php echo number_format($value['PRICE'],0,',',','); ?>
					</div>
		<?php
				}
			}
		?>
		  </div>
		</div>
	</div>
</div>

<script src="./assets/js/sweetalert2.min.js"></script>
<script>
	$(document).ready(function(){
		'use stricts';
		const al_require = document.getElementsByClassName('alert-require')[0],
			  product = document.getElementsByClassName('product')[0],
			  num = document.getElementsByClassName('price'),
			  price_up = document.getElementById('price-up'),
			  remain = document.getElementById('remain'),
			  sm_price = document.getElementById('sm-price'),
			  outOfStock = document.getElementById('out-of-stock'),
			  price_down = document.getElementById('price-down'),
			  select_type = document.getElementById('select-type'),
			  mess_require = document.getElementById('message-require'),
			  btn_cart = document.getElementById('btn-cart'),
			  cart = document.getElementsByClassName('contain-cart-product')[0];

		// num[0].addEventListener('input', function(){
		// 	this.value = accounting.formatMoney(this.value, "", 0);
		// })
		// num[1].addEventListener('input', function(){
		// 	this.value = accounting.formatMoney(this.value, "", 0);
		// })

		const show_alert = function(el, mess = ''){
			el.classList.contains('fadeOutDown') && el.classList.remove('fadeOutDown');
			al_require.children[1].innerHTML = mess;
			el.style.display = 'block';
			el.classList.add('fadeInUp');
			setTimeout(()=>{
				el.classList.remove('fadeInUp');
				el.classList.add('fadeOutDown');
				setTimeout(()=>{
					el.style.display = 'none';
				}, 2000)
			}, 3000)
		}

		const ajax = function(src){
			$.ajax({
				url: src,
				success(res){
					product.innerHTML = res;
				}
			})
		}

		btn_cart.addEventListener('click', function(){
			cart.classList.toggle('active');
		})

		sm_price.addEventListener('click', function(){
			const min_price = document.getElementById('min-price').value,
			      max_price = document.getElementById('max-price').value;

			if(min_price === '' || max_price === ''){
				show_alert(al_require, 'Bạn cần nhập đầy đủ Min và Max');
				return;
			}
			if(min_price >= max_price){
				show_alert(al_require, 'Min phải bé hơn Max');
				return;
			}

			$.ajax({
				url: './ajax/ajax_price_custom.php',
				data: {
					min: min_price,
					max: max_price
				},
				success(res){
					product.innerHTML = res;
				}
			})
		})

		select_type.addEventListener('input', function(){
			$.ajax({
				url: './ajax/ajax_product_type.php',
				data: {type: this.value},
				success(res){
					product.innerHTML = res;
				}
			})
		})

		price_up.addEventListener('input', function(){
			this.checked && ajax('./ajax/ajax_price_up.php');
		});

		price_down.addEventListener('input', function(){
			this.checked && ajax('./ajax/ajax_price_down.php');
		})

		remain.addEventListener('input', function(){
			this.checked && ajax('./ajax/ajax_remaining_product.php');
		})

		outOfStock.addEventListener('input', function(){
			this.checked && ajax('./ajax/ajax_out_of_stock.php');
		})


		document.cookie = `page=`;

		$.ajax({
			url: './ajax/ajax_get_product.php',
			data: { 
				page: 0,
				type: 'product_main'
			},
			success: function(res){
				$('#data').html(res);
			}
		});

		// Pagination
		const li = 'ul.pagination li.page-item:not(.pre):not(.next)';
		$(li + ':nth-child(2) .button-link').addClass('active');

		$('.page-link').click(function(){
			let page = parseInt($(this).attr('title')),
				linkLen = $(li + ' .button-link').length,
				activeLi = page;

			for (let i = 0; i < linkLen; i++) $(li + ' .button-link').removeClass('active');
			$(li + ':nth-child(' + (++activeLi) + ') .button-link').addClass('active');

			document.cookie = `page=${page}`;
			
			$.ajax({
				url: './ajax/ajax_get_product.php',
				data: { 
					page: page,
					type: 'product_main'
				},
				success(res){
					$('#data').html(res);
				}
			});

			let pre = document.cookie.match(/\d/g)[0],
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
	});
</script>
<?php include './inc/footer.php'; ?>