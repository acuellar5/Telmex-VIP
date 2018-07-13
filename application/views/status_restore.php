<div class="cssparaeldiv">
    <div class="alert alert-danger alert-dismissible col-md-8 col-sm-12" align="center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span class="fa fa-exclamation-triangle"> </span> <strong> Danger! </strong> Actualmente existen <strong><?php echo $cantidad['nulos'] ?></strong> registros sin estar asociados a un estado existente. <span class="fa fa-exclamation-triangle"></span>
    </div>
</div>
<div class="cssparaeldiv">
    <div class="alert alert-warning alert-dismissible col-md-8 col-sm-12" align="center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <span class="fa fa-exclamation-triangle"> </span> <strong> Importante! </strong> La información que se edite en este modulo debe ser idéntica a cómo esté en el excel <span class="fa fa-exclamation-triangle"></span>
    </div>
</div>
<table class="table table-hover table-bordered table-striped dataTable_camilo csstable" id="table_new_types"  cellspacing="2">
    <thead>
    <th class="csscolumna">Nombre Tipo</th>
    <th class="csscolumna">Estado Nuevo</th>
    <th>cant registros con éste estado</th>
    <th>Agregar Estado</th>
</thead>
<?php for ($i = 0; $i < count($estados); $i++) { ?>
    <tr class="cssformtext" >
        <td><strong><?php echo $estados[$i]->ot_hija; ?></strong></td>
        <td><strong><?php echo $estados[$i]->estado_orden_trabajo_hija; ?></strong></td>
        <td><?php echo $estados[$i]->cant; ?></td>
        <td>
            <div class="btn-group">
                <a class="btn btn-default btn-xs ver-det btn-success" title="Agregar Estado" onclick="showModalNewType(<?= "'" . $estados[$i]->ot_hija . "'"; ?>)">
                    <span class="fa fa-plus"></span>
                </a>
            </div>
        </td>
    </tr>
<?php } ?>

</table>

<!------------------------------- MODAL GUARDAR NUEVO TIPO----------------------------- -->
<div id="mdl_new_type" class="modal fade " role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header cssnewtypem">
                <button type="button" class="close cssicerrar" data-dismiss="modal" aria-label="Close"><img src="<?= URL::to('/assets/images/cerrar (7).png') ?>"></img></button>
                <h3 class="modal-title" id="mdl_title_new_type" align="center">Añadir Nuevo Estado</h3>
            </div>
            <div class="modal-body">
                <form class="well form-horizontal" id="mdl_form_new_type" action="<?= URL::to('Status/save_new_status'); ?>"  method="post" onsubmit="return validar_form()">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <td colspan="2" align="center" id="mdl_tbl_title_tipo" class="csstypesubtitle"></td>
                            </tr>
                            <tr>
                                <td class="anchotable"><b>NOMBRE ESTADO</b></td>
                                <td align="center"><b>ORDEN JERARQUIA</b></td>
                            </tr>
                        </thead>
                        <tbody id="mdl_tbl_new_type">	
                        </tbody>
                        <input type="hidden" name="name_type" value="" id="mdl_tbl_name_type">
                    </table>
                </form>
                <center>
                    <button class="btn-cami_cool " id="añadir_estado"> Añadir estado  <span class="fa fa-plus"></span></button>
                </center>



            </div>
            <div class="modal-footer cssnewtypem">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
                <button type="submit" class="btn btn-success" id="mdl_save_new_type" form="mdl_form_new_type"><i class='glyphicon glyphicon-send'></i>&nbsp;Guardar</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= URL::to("assets/plugins/sweetalert2/sweetalert2.all.js") ?>"></script>

<?php
if ($msj) {
    if ($msj == 'error') {
        ?>
        <script> swal('ERROR', 'existió un error al insertar el tipo nuevo y actualizar los registros', 'error');</script>
    <?php } else if ($msj == 'No existen') { ?>
        <script>  swal('Atención', 'El estado que esta intentando insertar pertence a un tipo nuevo, por favor dirigase al modulo <a href="<?= URL::to('type_restore') ?>" target="_blank"><strong> TYPE RESTORE </strong></a> para corregir este caso.', 'info');</script>
    <?php } else {
        ?>
        <script> swal('BIEN!', 'Se actualizaron ' + <?= $msj ?> + ' registros exitosamente.', 'success');</script>
    <?php
    }
}
?>