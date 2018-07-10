<div class="alert alert-danger alert-dismissible col-sm-8 cssparaeldiv" align="center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <span class="fa fa-exclamation-triangle"> </span> <strong> Danger! </strong> Actualmente existen <strong><?php echo $cantidad['indefinidos'] ?></strong> registros con tipo de orden indefinido. <span class="fa fa-exclamation-triangle"></span>
</div>


<table class="table table-hover table-bordered table-striped dataTable_camilo csstable" id="table_new_types"  cellspacing="2">
	<thead>
		<th class="csscolumna">Nombre Tipo</th>
		<th>cant registros con éste estado</th>
		<th>Es Nuevo?</th>
		<th>Es Variante?</th>
	</thead>
	<?php for ($i=0; $i < count($tipos); $i++) { ?>
		<tr class="cssformtext" >
			<td><strong><?php echo $tipos[$i]->ot_hija; ?></strong></td>
			<td><?php echo $tipos[$i]->cant; ?></td>
			<td>
				<div class="btn-group">
                    <a class="btn btn-default btn-xs ver-det btn-success" title="Editar Ots" onclick="showModalNewType(<?= "'".$tipos[$i]->ot_hija."'"; ?>)">
                    	<span class="fa fa-plus"></span>
                    </a>
                </div>
            </td>
			<td>
				<div class="btn-group">
                    <a class="btn btn-default btn-xs ver-det btn-primary" title="Editar Ots">
                    	<span class="fa fa-handshake-o"></span>
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
				<h3 class="modal-title" id="mdl_title_new_type">Añadir Nuevo Tipo</h3>
			</div>
			<div class="modal-body">
				<table class="table table-hover table-bordered table-striped">
					<thead>
						<tr>
							<td colspan="2" align="center" id="mdl_tbl_title_tipo" class="csstypesubtitle"></td>
						</tr>
						<tr>
							<td class="anchotable">Estado</td>
							<td>Orden Jerarquia</td>
						</tr>
					</thead>
					<tbody id="mdl_tbl_new_type">	
					</tbody>
				</table>
				<center>
					<button class="btn-cami_cool " id="añadir_estado"> Añadir estado  <span class="fa fa-plus ubicacionboton"></span></button>
				</center>



			</div>
			<div class="modal-footer cssnewtypem">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
				<button type="button" class="btn btn-success" id="mdl_save_new_type"><i class='glyphicon glyphicon-send'></i>&nbsp;Guardar</button>
			</div>
		</div>
	</div>
</div>