<h1 id="como_vamos">¿Cómo vamos?</h1>
<div class="container_accordeon">
	<h4 align="center">Total OTP: <span id="all_otp"class="badge all">22</span> &nbsp;&nbsp;&nbsp;En tiempo: <span id="in_time_otp" class="badge in_time">45</span>&nbsp;&nbsp;&nbsp;Fuera de tiempo: <span id="out_time_otp" class="badge out_time">22</span>&nbsp;&nbsp;&nbsp;Hoy: <span id="today_otp" class="badge today">12</span></h4><br>
	<?php 
		for ($i=0; $i < count($ingenieros); $i++) { 
		    echo "<button class='accordion' data-iduser='".$ingenieros[$i]->k_id_user."'>".$ingenieros[$i]->nombre." <img src='".URL::base()."/assets/images/plus.png' class='rigth'> <a class='rigth btn btn-default' target='_blank' href='".URL::base()."/OtHija/detalle/".$ingenieros[$i]->k_id_user."'><span class='glyphicon glyphicon-eye-open' title='ver detalle'></span></a> <a class='rigth btn btn-default' target='_blank' href='".URL::base()."/OtHija/exportar/".$ingenieros[$i]->k_id_user."'><span class='glyphicon glyphicon-export' title='exportar a excel'></span></a>
				<span class='h4_for' aling='center'><span class='span_all'>232</span> <span class='span_in_time'>234</span> <span class='span_out_time'>324</span> <span class='span_today'>232</span> </span>	
					

		    </button>";
		    echo "<div class='panel' ></div>";
		}
	 ?>
</div>
<!-- badge -->
