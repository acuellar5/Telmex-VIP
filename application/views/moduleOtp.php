<h1 id="como_vamos">¿Cómo vamos?</h1>
<h4 align="center">Total: &nbsp;&nbsp;&nbsp;&nbsp;<input class="in_time">En tiempo: &nbsp;&nbsp;&nbsp;<input class="out_time">Fuera de tiempo: &nbsp;&nbsp;&nbsp;<input class="today">Hoy: </h4><br><br>
<div class="container_accordeon">
	<h4 align="center">Total: &nbsp;&nbsp;&nbsp;&nbsp;<input class="in_time">En tiempo: &nbsp;&nbsp;&nbsp;<input class="out_time">Fuera de tiempo: &nbsp;&nbsp;&nbsp;<input class="today">Hoy: </h4><br>
	<?php 
		for ($i=0; $i < count($ingenieros); $i++) { 
		    echo "<button class='accordion' data-iduser='".$ingenieros[$i]->k_id_user."'>".$ingenieros[$i]->nombre." <img src='".URL::base()."/assets/images/plus.png' class='rigth'> <a class='rigth btn btn-default' target='_blank' href='".URL::base()."/OtHija/detalle/".$ingenieros[$i]->k_id_user."'><span class='glyphicon glyphicon-eye-open' title='ver detalle'></span></a> <a class='rigth btn btn-default' target='_blank' href='".URL::base()."/OtHija/exportar/".$ingenieros[$i]->k_id_user."'><span class='glyphicon glyphicon-export' title='exportar a excel'></span></a></button>";
		    echo "<div class='panel' ></div>";
		}
	 ?>
</div>


<img >