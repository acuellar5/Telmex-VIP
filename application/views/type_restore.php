<div class="alert alert-danger alert-dismissible col-sm-8" align="center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <span class="fa fa-exclamation-triangle"> </span> <strong> Danger! </strong> Actualmente existen <strong><?php echo $cantidad['indefinidos'] ?></strong> registros con tipo de orden indefinido. <span class="fa fa-exclamation-triangle"></span>
</div>


<table class="table table-hover table-bordered table-striped dataTable_camilo">
	<thead>
		<th>Nombre Tipo</th>
		<th>cant registros afectados</th>
	</thead>
	<?php for ($i=0; $i < count($tipos); $i++) { ?>
		<tr>
			<td><?php echo $tipos[$i]->ot_hija; ?></td>
			<td><?php echo $tipos[$i]->cant; ?></td>
		</tr>
	<?php } ?>
		
</table>