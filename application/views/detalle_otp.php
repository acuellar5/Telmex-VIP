<h3 align="center">Tabla de Detalles OTP ING: <?= $registros['otp'][0]->nombre ?></h3>

<table id="detalles_otp" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
	<thead>
		<th>OTP</th>
		<th>Nombre cliente</th>
		<th>Tipo OTP</th>
		<th>Servicio</th>
		<th>Estado OTP</th>
		<th>Programado</th>
		<th>Compromiso</th>
		<th>Creacion</th>
		<th>Ciudad</th>
		<th>Recurrente</th>
		<th>Lista</th>
		<th>Observacion</th>
	</thead>
<?php 
//$registros
for ($i=0; $i < count($registros['otp']); $i++) { 
	echo "<tr>";
		echo "<td>".$registros['otp'][$i]->k_id_ot_padre."</td>";
		echo "<td>".$registros['otp'][$i]->n_nombre_cliente."</td>";
		echo "<td>".$registros['otp'][$i]->orden_trabajo."</td>";
		echo "<td>".$registros['otp'][$i]->servicio."</td>";
		echo "<td>".$registros['otp'][$i]->estado_orden_trabajo."</td>";
		echo "<td>".$registros['otp'][$i]->fecha_programacion."</td>";
		echo "<td>".$registros['otp'][$i]->fecha_compromiso."</td>";
		echo "<td>".$registros['otp'][$i]->fecha_creacion."</td>";
		echo "<td>".$registros['otp'][$i]->ciudad."</td>";
		echo "<td>".$registros['otp'][$i]->recurrente."</td>";
		echo "<td><select class='form-control'>";
					echo "<option value=''>1</option>";
					echo "<option value=''>2</option>";
					echo "<option value=''>3</option>";
					echo "<option value=''>4</option>";
					echo "<option value=''>5</option>";
				echo "</select></td>";
		echo "<td><textarea rows='1'></textarea></td>";
	echo "</tr>";
			
}
?>
</table>



<h3 align="center">Tabla de Detalles OTH</h3>
<table id="detalles_oth" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
	<thead>
		<th>OTH</th>
		<th>Tipo OTH</th>
		<th>Estado OTH</th>
		<th>Creación OTH</th>
		<th>Ingeniero</th>
	</thead>
<?php 
//$registros
for ($i=0; $i < count($registros['oth']); $i++) { 
	echo "<tr>";
		echo "<td>".$registros['oth'][$i]->id_orden_trabajo_hija."</td>";
		echo "<td>".$registros['oth'][$i]->ot_hija."</td>";
		echo "<td>".$registros['oth'][$i]->estado_orden_trabajo_hija."</td>";
		echo "<td>".$registros['oth'][$i]->fecha_creacion_ot_hija."</td>";
		echo "<td>".$registros['oth'][$i]->nombre."</td>";
	echo "</tr>";
			
}
?>
</table>
<script>
	$(document).ready( function () {

	    $('#detalles_otp').DataTable();
	    $('#detalles_oth').DataTable();

	} );
</script>