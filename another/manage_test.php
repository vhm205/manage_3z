<?php 
	include './inc/header.php'; 
	include './inc/nav.php';
?>

<script>
	var link = document.createElement('link');
	link.rel = 'stylesheet';
	link.href = './assets/css/main.css';
	document.head.appendChild(link);
</script>

<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$table = $_POST['table-num'];
		$people = $_POST['people'];

		echo $table . ' ' . $people;
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
			<fieldset class="table-detail">
			    <form method="POST">
			    	<legend class="table-num"></legend>
			    	<input class="table-num" type="hidden" name="table-num" value="">
				    <div class="form-group">
					    <label for="people">Số người</label>
					    <select name="people" class="form-control" id="people">
					        <option value="1">1</option>
					        <option value="2">2</option>
					        <option value="3">3</option>
					        <option value="4">4</option>
					    </select>
				    </div>
				    <button type="submit" class="btn btn-primary">Thêm thực đơn vào <span class="table-num"></span></button>
				    <button type="button" id="btn-cancel" class="btn btn-danger">Hủy bỏ</button>
			    </form>
			</fieldset>
		</div>
	</div>
</div>	


<script>
	$(document).ready(function(){
		'use stricts';

		const log = (type, content = '') => {
			const typeLower = type.toLowerCase();
			console.group('%cLog info: ', 'color:#F78383;font-size:20px;font-weight:bold');
			typeLower === 'log' && console.log(content);
			typeLower === 'info' && console.info(content);
			typeLower === 'table' && console.table(content);
			typeLower === 'error' && console.error(content);
			typeLower === 'warning' && console.warn(content);
			typeLower === 'dir' && console.dir(content);
			typeLower === 'clear' && console.clear();
			console.groupEnd();
		}

		const wrapper  = document.getElementsByClassName('wrapper')[0];

		for (let i = 1; i <= 20; i++) {
			const val 	= `Bàn ${i}`;
				  label = document.createElement('label'),
				  input = document.createElement('input'),
				  txt	= document.createTextNode(val);

			label.classList.add('btn', 'btn-light', 'btn-menu');
			input.classList.add('ck-table');
			input.id = 'ck-' + i;

			input.type = 'checkbox';
			input.autocomplete = 'off';
			input.value = val;
			label.setAttribute('for', input.id);
			label.appendChild(input);
			label.appendChild(txt);
			wrapper.appendChild(label);
		}

		let ck_table = document.getElementsByClassName('ck-table'),
			table_detail = document.getElementsByClassName('table-detail')[0];
			num_table = document.getElementsByClassName('table-num'),
			btn_cancel = document.getElementById('btn-cancel'),
			ck_len = ck_table.length,
			thisVal = '',
			arr = [];

		const checkClass = function(el, index, className){
			const btn_active = document.getElementsByClassName(el)[index];
				  attr_active = btn_active.attributes[0].value,
				  split_class = attr_active.split(' ')[3];
			if(split_class === className){
				btn_active.style.background = '#393939';
				btn_active.style.color = '#fff';
			}
		}

		btn_cancel.addEventListener('click', function(){
			const removeClass = document.querySelectorAll('label.btn.btn-menu'),
				  attr_for = thisVal.getAttribute('for'),
				  attr_val = thisVal.children[0].value,
				  nodeArr = [].slice.call(removeClass);
			nodeArr.filter((e) => {
				if(e.classList.contains('active') && e.getAttribute('for') == attr_for){
					e.style.background = '#fff';
					e.style.color = '#000'
				}
			})
			arr = arr.filter(e => e != attr_val);
			log('clear');
			log('log', ('Value: ' + arr));
		})

		for (let i = 0; i < ck_len; i++) {
			ck_table[i].addEventListener('input', function(){
				const thisClass = this.parentNode.classList;
				!thisClass.contains('active') && thisClass.add('active');  

				if(arr.includes(this.value) !== true && thisClass.contains('active')){
					arr = [...arr, this.value];
				}
				log('clear');
				log('log', ('Value: ' + arr));

				checkClass('btn-menu', i, 'active');
			})
			ck_table[i].addEventListener('click', function(){
				thisVal = this.parentNode;
				table_detail.style.display = 'block';
				num_table[0].innerHTML = this.value;
				num_table[2].innerHTML = this.value;
				num_table[1].value = this.value;
			})
		}
	})
</script>
<?php include './inc/footer.php'; ?>