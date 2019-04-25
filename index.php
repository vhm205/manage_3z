<?php
	include_once './inc/header.php'; 
	include_once './inc/nav.php';

	if(!isset($_SESSION['USERNAME'])){
		header('location: ./login.php');
		exit();
	}
?>

<script>
	var link = document.createElement('link');
	link.rel = 'stylesheet';
	link.href = './assets/css/main.css';
	document.head.appendChild(link);
</script>
	
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="jumbotron">
				<h1 class="display-3">Hello <?php echo $_SESSION['USERNAME'] ?>!</h1>
				<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
				<hr class="m-y-md">
				<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
				<p class="lead">
					<a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
				</p>
			</div>
		</div>
	</div>
</div>	


<script>
	var script = document.createElement('script');
	script.src = './assets/js/main.js';
	document.body.appendChild(script);
</script>
<?php include_once './inc/footer.php'; ?>

	