
<script src="<?= URL::to('assets/plugins/charjs/chart.min.js'); ?>"></script>
<i><img src="<?= URL::to('assets/images/BBVAicon.png') ?>" style="height: 39px; position: fixed; width: 140px; margin: 1.5% -5.6%;"></i>
<div style="background: #d0cfcf63; border: 1px solid; border-radius: 15px; display: flow-root;">
	<h2 align="center">SEGUIMIENTO EFECTIVIDAD</h2>
    <div class="col-md-12" style="margin-top: 20px;">
        <canvas id="barras_1" height="100" style="margin-bottom: 40px"></canvas>
    </div>

    <div class="col-md-12" style="margin-top: 50px;">
            <canvas id="torta_1" height="150"></canvas>
    </div>
    <div class="col-md-12" style="margin-top: 50px;">
        <canvas id="barras_2" height="100"></canvas>
    </div>
</div>

<br><br><br>
<div style="background: #d0cfcf63; border: 1px solid; border-radius: 15px; display: flow-root;">
	<h2 align="center">CONSOLIDADO GENERAL EFECTIVIDAD</h2>
	<div>
	    <div class="col-md-12" style="margin-top: 50px;">
	        <canvas id="barras_3" height="100"></canvas>
	    </div>
	    <div class="col-md-12" style="margin-top: 50px;">
	        <canvas id="torta_3"></canvas>
	    </div>
	    <div class="col-md-12" style="margin-top: 50px;">
	        <canvas id="barras_4" height="200"></canvas>
	    </div>
	</div>
</div>
