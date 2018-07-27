<h1 id="como_vamos">¿Cómo vamos?</h1>
<div class="container_accordeon">
	<h4> <small> Última actualización: </small> <strong><?= $last_time->last_time ?></strong></h4>
	<h4 align="center" class="con_semaf">Total OTP: <span id="all_otp"class="badge all">...</span> &nbsp;&nbsp;&nbsp;En tiempo: <span id="in_time_otp" class="badge in_time">...</span>&nbsp;&nbsp;&nbsp;Fuera de tiempo: <span id="out_time_otp" class="badge out_time">...</span>&nbsp;&nbsp;&nbsp;Hoy: <span id="today_otp" class="badge today">...</span></h4><br>
	<?php 
		for ($i=0; $i < count($ingenieros); $i++) { 
		    echo "<button class='accordion btn_ingeniero' data-iduser='".$ingenieros[$i]->k_id_user."'>".$ingenieros[$i]->nombre." <img src='".URL::base()."/assets/images/plus.png' class='rigth'> <a class='rigth fontsize10' target='_blank' href='".URL::base()."/OtHija/detalle/".$ingenieros[$i]->k_id_user."'><span class='glyphicon glyphicon-eye-open' title='ver detalle'></span></a> <a class='rigth fontsize10' target='_blank' href='".URL::base()."/OtHija/exportar/".$ingenieros[$i]->k_id_user."'><span class='glyphicon glyphicon-export' title='exportar a excel'></span></a>
				<span class='h4_for' aling='center' id='".$ingenieros[$i]->k_id_user."'></span>	
					

		    </button>";
		    echo "<div class='panel' ></div>";
		}
	 ?>
</div>
<!-- badge -->
