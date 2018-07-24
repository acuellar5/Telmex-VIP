<h3 align="center">Tabla de Detalles</h3>

<table id="tablaDetalles" class="table table-hover table-bordered table-striped dataTable_camilo" width="100%">
	<thead>
		<th>OTP</th>
		<th>Cliente</th>
		<th>tipo OTP</th>
		<th>Servicio</th>
		<th>Estado otp</th>
		<th>Programación</th>
		<th>Compromiso</th>
		<th>Creación</th>
		<th>Ingeniero</th>
		<th>OTH</th>
		<th>Tipo OTH</th>
		<th>Estado OTH</th>
	</thead>
<?php 
//$registros
for ($i=0; $i < count($registros); $i++) { 
	echo "<tr>";
		echo "<td>".$registros[$i]->k_id_ot_padre."</td>";
		echo "<td>".$registros[$i]->n_nombre_cliente."</td>";
		echo "<td>".$registros[$i]->orden_trabajo."</td>";
		echo "<td>".$registros[$i]->servicio."</td>";
		echo "<td>".$registros[$i]->estado_orden_trabajo."</td>";
		echo "<td>".$registros[$i]->fecha_programacion."</td>";
		echo "<td>".$registros[$i]->fecha_compromiso."</td>";
		echo "<td>".$registros[$i]->fecha_creacion."</td>";
		echo "<td>".$registros[$i]->nombre."</td>";
		echo "<td>".$registros[$i]->id_orden_trabajo_hija."</td>";
		echo "<td>".$registros[$i]->ot_hija."</td>";
		echo "<td>".$registros[$i]->estado_orden_trabajo_hija."</td>";
	echo "</tr>";
			
}
?>
</table>
<script>
	$(document).ready( function () {
	    $('#tablaDetalles').DataTable();
	} );

</script>
