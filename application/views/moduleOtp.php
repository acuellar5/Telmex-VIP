<h1 id="como_vamos">¿Cómo vamos?</h1>
<div class="container_accordeon">
	<?php 
		for ($i=0; $i < count($ingenieros); $i++) { 
		    echo "<button class='accordion' data-iduser='".$ingenieros[$i]->k_id_user."'>".$ingenieros[$i]->nombre." <img src='".URL::base()."/assets/images/plus.png' class='rigth'> <a class='rigth btn btn-default' target='_blank' href='".URL::base()."/OtHija/detalle/".$ingenieros[$i]->k_id_user."'><span class='glyphicon glyphicon-eye-open' title='ver detalle'></span></a> <a class='rigth btn btn-default' target='_blank' href='".URL::base()."/OtHija/exportar/".$ingenieros[$i]->k_id_user."'><span class='glyphicon glyphicon-export' title='exportar a excel'></span></a> </button>";
		    echo "<div class='panel' ></div>";
		}
	 ?>
</div>

