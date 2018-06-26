	<!-- CIERRE CONTAINER-->
	</div>
	<!-- INICIO FOOTER-->
	<div class="footerF">
		<p>©1998-2018 ZTE Corporation - ZTE Colombia. All rights reserved</p>
	</div>
	<script> var baseurl = "<?php echo URL::base(); ?>";</script>
	<!-- BOOTSTRAP CORE SCRIPT-->
	<script src="<?= URL::to('assets/plugins/bootstrap/js/bootstrap.min.js') ?>" /></script>
	<!-- SCRIPTS DEL FOOTER-->
	<script src="<?= URL::to('assets/plugins/jquery/jquery.min.js')?>"></script>
	<script src="<?= URL::to('assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
	<!-- STYLES  FOOTER -->
	<link rel="stylesheet" type="text/css" href="<?= URL::to('assets/css/styles_footer.css'); ?>">

<!-- ***************************************NO MOSTRAR EN LA VISTA PRINCIPAL***************************************-->

<?php if ($this->uri->segment(1) != 'paginaPrincipal'): ?>

    <!-- DATATABLES -->
    <script src="<?= URL::to('assets/plugins/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js') ?>"></script>
    <!-- CORE JQUERY  -->
    <script src="<?= URL::to('assets/plugins/jquery-ui.min.js') ?>" /></script>
    <!-- PARALLAX SCRIPT   -->
    <script src="<?= URL::to('assets/plugins/4jquery.parallax-1.1.3.js') ?>" /></script>
    <!--BOOTSTRAP-TABLE SCRIPT-->
    <script src="<?= URL::to('assets/plugins/datatables/js/jquery.dataTables.js?v=1.0') ?>"></script>
    <!-- <link href="<?= URL::to("assets/plugins/select2/select2.css") ?>" rel="stylesheet" type="text/css"/> -->
    <!-- <script src="<?= URL::to("assets/plugins/select2/select2.js") ?>" type="text/javascript"></script> -->
    <script src="<?= URL::to('assets/plugins/datatables/js/dataTables.bootstrap.js?v=1.0') ?>"></script>
    <script src="<?= URL::to("assets/plugins/HelperForm.js?v=1.2") ?>" type="text/javascript"></script>
    <!-- <script src="<?= URL::to("assets/plugins/FormatDate.js") ?>" type="text/javascript"></script> -->
<?php endif ?>

<!-- **********************************************VISTA EDITAR OTS *********************************************-->
<?php if ($this->uri->segment(1) == 'cargarOts'): ?>
    <script src="<?= URL::to("assets/js/utils/app.global.js?v=1.2") ?>" type="text/javascript"></script>
    <script src="<?= URL::to("assets/js/utils/app.dom.js?v=" . time()) ?>" type="text/javascript"></script>
<?php endif ?>

<!-- **********************************************VISTA EDITAR OTS *********************************************-->
<?php if ($this->uri->segment(1) == 'editarOts'): ?>
    <script src="<?= URL::to('assets/js/modules/moduleOts.js') ?>"></script>	
<?php endif ?>


<!-- **********************************************GENERAR MARCACIONES********************************************-->
<?php if ($this->uri->segment(1) == 'generarMarcaciones'): ?>
    <script src="<?= URL::to("assets/js/utils/app.global.js?v=1.2") ?>" type="text/javascript"></script>
    <script src="<?= URL::to("assets/js/utils/app.dom.js?v=" . time()) ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?= URL::to("assets/js/modules/markings.js?v=" . time()) ?>"></script>

<?php endif ?>
</body>
</html>




