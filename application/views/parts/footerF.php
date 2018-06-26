	<!-- CIERRE CONTAINER-->   
	</div>
	<!-- INICIO FOOTER-->
	<div class="footerF">
		<p class="margenDelFooter">©1998-2018 ZTE Corporation - ZTE Colombia. All rights reserved</p>
	</div>
	<script> var baseurl = "<?php echo URL::base(); ?>";</script>
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

<?php if ($this->uri->segment(1) == 'editarOts'): ?>
<!-- **********************************************VISTA EDITAR OTS *********************************************-->
    <script src="<?= URL::to('assets/js/modules/moduleOts.js') ?>"></script>    
    <script src="<?= URL::to('assets/plugins/datatables/js/jquery.dataTables.js?v=1.0') ?>"></script>
    
<?php endif ?>

<?php if ($this->uri->segment(1) == 'generarMarcaciones'): ?>
<!-- **********************************************GENERAR MARCACIONES********************************************-->
    <script src="<?= URL::to("assets/js/utils/app.global.js?v=1.2") ?>" type="text/javascript"></script>
    <script src="<?= URL::to("assets/js/utils/app.dom.js?v=" . time()) ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?= URL::to("assets/js/modules/markings.js?v=" . time()) ?>"></script>

<?php endif ?>

<?php if ($this->uri->segment(1) == 'paginaPrincipal'): ?>
    <script src="<?= URL::to('assets/plugins/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= URL::to('assets/plugins/datatables/js/dataTables.bootstrap.js?v=1.0') ?>"></script>
    <script src="<?= URL::to('assets/js/modules/principal.js') ?>"></script>
<?php endif ?>

</body>
</html>
