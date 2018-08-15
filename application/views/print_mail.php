<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>correo Enviado</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?= URL::to('assets/img/logo_zte.png'); ?>">
	<link rel="stylesheet" href="<?= URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') ?>"/>
	<link rel="stylesheet" href="<?= URL::to('assets/css/styleModalCami.css') ?>"/>
</head>
<body>
	<div class="container marg-t-15px">
		<?php print_r($cuerpo); ?>
	</div>

	<script>
	function myFunction() {
	    window.print();
	}
	myFunction();
	</script>
</body>
</html>