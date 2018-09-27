<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>txt</title>

  <link rel="icon" href="<?= URL::to('assets/img/logo_zte.png'); ?>">
  <link rel="stylesheet" href="<?= URL::to('assets/plugins/bootstrap/css/bootstrap.min.css') ?>"/>
  <link rel="stylesheet" href="<?= URL::to('assets/css/helper-class.css?v=1.0') ?>">

  <script src="<?= URL::to("assets/plugins/jquery/jquery.min.js") ?>"></script>
  <script src="<?= URL::to("assets/plugins/bootstrap/js/bootstrap.min.js") ?>"></script>

<style type="text/css">
	pre {
		    display: block;
		    padding: 9.5px;
		    margin: 0 0 10px;
		    font-size: 11px;
		    line-height: 1;
		    color: #000;
		    word-break: break-all;
		    word-wrap: break-word;
		    background-color: #f5f5f5;
		    border: 1px solid #ccc;
		    border-radius: 10px;
		    box-shadow: 5px 5px 15px #67676f;
	}
</style>


</head>
<body>
	<div class="container m-t-40">
		<?php 
			echo '<pre>'; print_r($this->session->tempdata('textarea')); echo '</pre>';
		?>
	</div>

	<script src="<?= URL::to("assets/plugins/sweetalert2/sweetalert2.all.js"); ?> "></script>
	<script src="<?= URL::to("assets/js/utils/helper.js") ?>"></script>
	<script>
		$(function () {
			helper.miniAlert('Se actualizó Correctamente', 'success');  
		});
	</script>

</body>
</html>