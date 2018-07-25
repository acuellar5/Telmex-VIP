<h1 id="como_vamos">¿Cómo vamos?</h1>
<div class="container_accordeon">
	<h4 align="center">Total OTP: <span id="all_otp"class="badge all">22</span> &nbsp;&nbsp;&nbsp;En tiempo: <span id="in_time_otp" class="badge in_time">45</span>&nbsp;&nbsp;&nbsp;Fuera de tiempo: <span id="out_time_otp" class="badge out_time">22</span>&nbsp;&nbsp;&nbsp;Hoy: <span id="today_otp" class="badge today">12</span></h4><br>
	<?php 
		for ($i=0; $i < count($ingenieros); $i++) { 
		    echo "<button class='accordion' data-iduser='".$ingenieros[$i]->k_id_user."'>".$ingenieros[$i]->nombre." <img src='".URL::base()."/assets/images/plus.png' class='rigth'> <a class='rigth btn btn-default' target='_blank' href='".URL::base()."/OtHija/detalle/".$ingenieros[$i]->k_id_user."'><span class='glyphicon glyphicon-eye-open' title='ver detalle'></span></a> <a class='rigth btn btn-default' target='_blank' href='".URL::base()."/OtHija/exportar/".$ingenieros[$i]->k_id_user."'><span class='glyphicon glyphicon-export' title='exportar a excel'></span></a>
				<h4 align='center' class='h4_for'><span class='badge all'>22</span>  <span class='badge in_time'>45</span>  <span class='badge out_time'>22</span>  <span class='badge today'>12</span></h4><br>	
					

		    </button>";
		    echo "<div class='panel' ></div>";
		}
	 ?>
</div>
<!-- badge -->
