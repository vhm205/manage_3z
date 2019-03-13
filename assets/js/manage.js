$(document).ready(function(){
	'use stricts';

	const num_btn = 20;

	const log = (type, content = 'Test message', color = '#F66060') => {
		const typeLower = type.toLowerCase();
		console.group('%cLog info: ', 'color:#F78383;font-size:20px;font-weight:bold');
		typeLower === 'log' && console.log(content);
		typeLower === 'info' && console.info(content);
		typeLower === 'table' && console.table(content);
		typeLower === 'error' && console.error(content);
		typeLower === 'warn' && console.warn(content);
		typeLower === 'dir' && console.dir(content);
		typeLower === 'clear' && console.clear();
		typeLower === 'logColor' && console.log('%c'+content,'color:'+color);
		console.groupEnd();
	}

	const wrapper  = document.getElementsByClassName('wrapper')[0],
		  add_table = document.getElementsByClassName('add-table')[0];


	// Vẽ sơ đồ quán lớn
	for (let i = 1; i <= num_btn; i++) {
		const val 	= `Bàn ${i}`;
			  label = document.createElement('label'),
			  input = document.createElement('input'),
			  txt	= document.createTextNode(val);

		label.classList.add('btn', 'btn-light', 'btn-menu');
		input.classList.add('ck-table');

		input.type = 'checkbox';
		input.autocomplete = 'off';
		input.value = val;
		label.dataset.val = 'ck-' + i;
		label.appendChild(input);
		label.appendChild(txt);
		wrapper.appendChild(label);
	}

	// Vẽ sơ đồ quán nhỏ
	for (let j = 1; j <= num_btn; j++) {
		const val 	 = `Bàn ${j}`,
			  common = 'ck-' + j,
			  label  = document.createElement('label'),
			  input  = document.createElement('input'),
			  txt	 = document.createTextNode(val);

		label.classList.add('btn', 'btn-light', 'btn-menu', 'lb-add');
		input.classList.add('ck-table');
		input.id = common;

		input.type = 'radio';
		input.autocomplete = 'off';
		input.value = val;
		input.name = 'table';
		input.required = 'required';
		label.setAttribute('for', input.id);
		label.appendChild(input);
		label.appendChild(txt);
		add_table.appendChild(label);
	}

	const ck_table = document.querySelectorAll('.add-table label.btn.btn-menu.lb-add input'),
		  lb_table = document.querySelectorAll('.add-table label.btn.btn-menu.lb-add'),
		  template_ck = document.querySelectorAll('.wrapper label.btn.btn-menu input'),
		  template_lb = document.querySelectorAll('.wrapper label.btn.btn-menu'),
		  ck_len = ck_table.length;

	for (let i = 0; i < ck_len; i++) {
		ck_table[i].addEventListener('input', function(){
			const class_this = this.classList,
				  class_parent = this.parentNode.classList;

			if(this.checked){
				for (let i = 0; i < ck_len; i++) {
					lb_table[i].classList.remove('active');
					if(template_lb[i].dataset.val === this.id){
						template_lb[i].classList.add('active');
					} else {
						template_lb[i].classList.remove('active');
					}
				}
				class_parent.add('active');
			}
			log('log', this.value)
		})
	}


	const session = document.getElementById('session_input').value,
		  split_session = session.split(','),
		  length_session = split_session.length;

	for (let i = 0; i < length_session - 1; i++) {
		for (let j = 0; j < ck_len; j++) {
			if(ck_table[j].value === split_session[i]){
				ck_table[j].disabled = true;
				template_lb[j].style.cursor = 'not-allowed';
				template_lb[j].style.boxShadow = 'none';
				template_lb[j].style.background = '#262626';
				template_lb[j].style.color = '#fff';
				ck_table[j].parentNode.style.cursor = 'not-allowed';
				ck_table[j].parentNode.style.boxShadow = 'none';
				ck_table[j].parentNode.style.background = '#e6e5e5';
			}
		}
	}
})