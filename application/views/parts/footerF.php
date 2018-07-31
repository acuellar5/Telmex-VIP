	<!-- CIERRE CONTAINER-->   
	</div>
	<!-- INICIO FOOTER-->
	<div class="footerF">
		<p class="margenDelFooter">©1998-2018 ZTE Corporation - ZTE Colombia. All rights reserved</p>
	</div>
	<script> 
		var baseurl = "<?php echo URL::base(); ?>";
		const meses_anual = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		var formato_fecha=new Date();
		var fecha_actual = formato_fecha.getDate() + " de " + meses_anual[formato_fecha.getMonth()] + " de " + formato_fecha.getFullYear();
	</script>
	<!-- BOOTSTRAP CORE SCRIPT-->
	<script src="<?= URL::to('assets/plugins/bootstrap/js/bootstrap.min.js') ?>" /></script>
	<!-- SCRIPTS DEL FOOTER-->
	<script src="<?= URL::to('assets/plugins/jquery/jquery.min.js')?>"></script>
	<script src="<?= URL::to('assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
	<!-- STYLES  FOOTER -->
	<link rel="stylesheet" type="text/css" href="<?= URL::to('assets/css/styles_footer.css'); ?>">


<?php if ($this->uri->segment(1) == 'cargarOts'): ?>
<!-- **********************************************VISTA EDITAR OTS *********************************************-->
    <script src="<?= URL::to("assets/js/utils/app.global.js?v=1.2") ?>" type="text/javascript"></script>
    <script src="<?= URL::to("assets/js/utils/app.dom.js?v=" . time()) ?>" type="text/javascript"></script>
<?php endif ?>

<?php if ($this->uri->segment(1) == 'editarOts' || $this->uri->segment(1) == 'status_restore' || $this->uri->segment(1) == 'type_restore'): ?>
<!-- **********************************************VISTA EDITAR OTS *********************************************-->
    <script src="<?= URL::to('assets/plugins/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= URL::to('assets/plugins/datatables/js/dataTables.bootstrap.js?v=1.0') ?>"></script>
    <script src="<?= URL::to("assets/js/modules/moduleOts.js?v=" . time()) ?>"></script>    
    
<?php endif ?>

<?php if ($this->uri->segment(1) == 'generarMarcaciones'): ?>
<!-- **********************************************GENERAR MARCACIONES********************************************-->
    <script src="<?= URL::to("assets/js/utils/app.global.js?v=1.2") ?>" type="text/javascript"></script>
    <script src="<?= URL::to("assets/js/utils/app.dom.js?v=" . time()) ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?= URL::to("assets/js/modules/markings.js?v=" . time()) ?>"></script>

<?php endif ?>

<?php if ($this->uri->segment(1) == 'paginaPrincipal' || $this->uri->segment(1) == 'User'): ?>
    <script src="<?= URL::to('assets/plugins/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= URL::to('assets/plugins/datatables/js/dataTables.bootstrap.js?v=1.0') ?>"></script>
    <script src="<?= URL::to('assets/js/modules/principal.js?v='. time()) ?>"></script>
<?php endif ?>
<?php if ($this->uri->segment(1) == 'type_restore' || $this->uri->segment(1) == 'Type'): ?>
<!-- ***********************************REPARAR TIPOS Y ESTADOS*****************************************-->
    <script src="<?= URL::to('assets/js/modules/type_restore.js?v='. time()) ?>"></script>
    <script src="<?= URL::to('assets/plugins/bootstrap/js/bootstrap-selet.min.js') ?>"></script>
<?php endif ?>
    
<?php if ($this->uri->segment(1) == 'status_restore' || $this->uri->segment(1) == 'Status'): ?>
    <script src="<?= URL::to('assets/js/modules/status_restore.js?v='. time()) ?>"></script>
<?php endif ?>

<?php if ($this->uri->segment(1) == 'OTP'|| $this->uri->segment(1) == 'paginaPrincipal' || $this->uri->segment(1) == 'User'): ?>
<!-- ***********************************JS PARA ACORDEON OT PADRE*****************************************-->
    <script src="<?= URL::to('assets/plugins/charjs/chart.min.js'); ?>"></script>
    <script src="<?= URL::to('assets/js/modules/acordeon_otp.js?v='. time()) ?>"></script>
<?php endif ?>

<?php if ($this->uri->segment(1) == 'managementOtp'): ?>
<!-- **********************************************VISTA OTPADRE *********************************************-->
    <script src="<?= URL::to('assets/plugins/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= URL::to('assets/plugins/datatables/js/dataTables.bootstrap.js?v=1.0') ?>"></script>
    <script src="<?= URL::to("assets/js/modules/moduleOtpadre.js?v=" . time()) ?>"></script>    
    
<?php endif ?>

<!-- ***********************faber*********************************** -->
<?php if ($this->uri->segment(1) == 'editarOts' || $this->uri->segment(1) == 'paginaPrincipal' || $this->uri->segment(1) == 'User' || $this->uri->segment(1) == 'managementOtp'): ?>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<!-- COLVIs PARA MOSTRAR U OCULTAR COLUMNAS -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<!-- ***********************faber*********************************** -->
<?php endif ?>

<?php if ($this->uri->segment(1) == 'OtHija'): ?>
    <script src="<?= URL::to('assets/plugins/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= URL::to('assets/plugins/datatables/js/dataTables.bootstrap.js?v=1.0') ?>"></script>
    <script src="<?= URL::to('assets/js/modules/detalle_otp.js?v='. time()) ?>"></script>
<?php endif ?>

    <script src="<?= URL::to('assets/plugins/select2/select2.js') ?>"></script>

</body>
</html>
