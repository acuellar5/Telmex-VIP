<script src="<?= URL::to('assets/plugins/charjs/chart.min.js'); ?>"></script>

<h2 align="center"><i><img src="<?= URL::to('assets/images/BBVAicon.png') ?>" style="height: 39px; position: fixed; width: 140px; margin: -2.5% -41.6%;"></i>EFECTIVIDAD</h2><br>
<div class="row">
    <div class="col-md-6">
        <div style="position: relative;width: 46em;height: 13cm;">
            <canvas id="barras_1"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div id="contentGraphics" style="position: relative;width: 46em;height: 13cm;">
            <canvas id="torta_1"></canvas>
        </div>
    </div>
    <!--              cominezo jhonChaparro              -->
    <div class="col-md-12">
        <canvas id="barras_2"></canvas>
    </div>
    <!--                 fin jhonChaparro                 -->
</div>

