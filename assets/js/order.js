$(document).ready(function() {
	'use stricts';

	// window.onbeforeunload = function(){
	// 	return 'Are you sure you want to refresh?';
	// }

	const requiredMess = document.getElementById('message-require'),
		  requiredAlert = document.getElementsByClassName('alert-require')[0],
		  btnCart = document.getElementById('btn-cart'),
		  btnSearch = document.getElementById('sm-search'),
		  btnCustom = document.getElementById('sm-price'),
		  priceUp = document.getElementById('price-up'),
		  priceDown = document.getElementById('price-down'),
		  remain = document.getElementById('remain'),
		  outOfStock = document.getElementById('out-of-stock'),
		  selectType = document.getElementById('select-type');
		  

	btnCart.addEventListener('click', function(){
		$('.contain-cart-product').toggleClass('active');
	})

	selectType.addEventListener('input', function(){
		ajax('./ajax/ajax_get_product.php', '#data', {
			page: 0,
			type: 'product_main',
			where: true,
			select_by_type: this.value
		});
	})

	remain.addEventListener('input', function(){
		if(priceUp.checked){
			ajax('./ajax/ajax_get_product.php', '#data', {
				page: 0,
				type: 'product_main',
				where: true,
				status: 'remain'
			});
		}
	})
	outOfStock.addEventListener('input', function(){
		if(priceUp.checked){
			ajax('./ajax/ajax_get_product.php', '#data', {
				page: 0,
				type: 'product_main',
				where: true,
				status: 'out-of-stock'
			});
		}
	})


	priceUp.addEventListener('input', function(){
		if(priceUp.checked){
			ajax('./ajax/ajax_get_product.php', '#data', {
				page: 0,
				type: 'product_main',
				where: true,
				price: 'up'
			});
		}
	})
	priceDown.addEventListener('input', function(){
		if(priceDown.checked){
			ajax('./ajax/ajax_get_product.php', '#data', {
				page: 0,
				type: 'product_main',
				where: true,
				price: 'down'
			});
		}
	})

	btnCustom.addEventListener('click', function(){
		const minPrice = parseInt(document.getElementById('min-price').value) || 0,
			  maxPrice = parseInt(document.getElementById('max-price').value) || 0;

		if(minPrice === 0 || maxPrice === 0){
			showAlert(requiredAlert, 'Bạn cần nhập đầy đủ min và max');
			return;
		}

		if(minPrice >= maxPrice){
			showAlert(requiredAlert, 'Bạn cần nhập min bé hơn max');
			return;
		}

		ajax('./ajax/ajax_get_product.php', '#data', {
			page: 0,
			type: 'product_main',
			where: true,
			min: minPrice,
			max: maxPrice
		});
	})

	btnSearch.addEventListener('click', function(){
		const wordSearch = document.getElementById('search-order').value || '';

		if(wordSearch !== ''){
			ajax('./ajax/ajax_get_product.php', '#data', {
				  page: 0,
				  type: 'product_main',
				  where: true,
				  word: wordSearch
			 });
		}
		else{
			ajax('./ajax/ajax_get_product.php', '#data', {
				page:0,
				type:'product_main'
			});
		}
	})

	const ajax = function(url, elRes = '', data = {}, cache = true){
		$.ajax({
			url: url,
			cache: cache,
			data: data
		})
		.done(function(res) {
			$(elRes).html(res);
		})
		.fail(function(err) {
			console.log(`Error: ${err}`);
		})
	}

	const showAlert = function(el, mess = 'Hello World'){
		el.style.display = 'block';
		el.classList.add('fadeInUp');
		requiredMess.innerHTML = mess;
		setTimeout(()=>{
			el.classList.remove('fadeInUp');
			el.style.display = 'none';
		}, 3000)
	}

	$(document).ajaxStart(function() {
		$('.load-ajax').css('display', 'block');
	});
	$(document).ajaxComplete(function() {
		$('.load-ajax').css('display', 'none');
	});
});